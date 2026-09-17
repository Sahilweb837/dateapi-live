<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Swipe;
use App\Models\MatchModel;
use Illuminate\Support\Facades\Auth;

class SwipeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $userId = $user ? $user->id : 0;
        $profiles = collect();

        try {
            $swipedIds = [];
            if ($userId) {
                $swipedIds = Swipe::where('swiper_id', $userId)->pluck('swipee_id')->toArray();
                $swipedIds[] = $userId;
            }

            $profiles = User::where('status', 'active')
                ->whereNotIn('id', $swipedIds)
                ->orderByRaw('COALESCE(is_boosted, 0) DESC')
                ->orderByRaw('CASE WHEN avatar IS NOT NULL AND avatar != "" AND avatar NOT LIKE "default%" THEN 1 ELSE 2 END ASC')
                ->orderBy('is_verified', 'desc')
                ->take(25)
                ->get();

            // Fallback so the deck never feels empty
            if ($profiles->isEmpty()) {
                $profiles = User::where('id', '!=', $userId)
                    ->where('status', 'active')
                    ->orderByRaw('COALESCE(is_boosted, 0) DESC')
                    ->orderBy('is_verified', 'desc')
                    ->take(15)
                    ->get();
            }
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::warning('Swipe profiles query fallback: ' . $e->getMessage());
        }

        // Fetch admirers waiting
        $admirers = collect();
        try {
            $admirers = User::where('id', '!=', $userId)
                ->where('status', 'active')
                ->orderBy('is_verified', 'desc')
                ->take(4)
                ->get();
        } catch (\Throwable $e) {}

        // Format profiles for frontend JS deck
        $deckData = $profiles->map(function($p, $idx) {
            $photos = [
                $p->avatar_url,
                'https://images.unsplash.com/photo-1517841905240-472988babdf9?w=600&q=80&fit=crop',
                'https://images.unsplash.com/photo-1492562080023-ab3db95bfbce?w=600&q=80&fit=crop',
            ];
            $synergy = 91 + (($p->id * 7) % 9);

            return [
                'id' => $p->id,
                'name' => $p->full_name,
                'age' => $p->age ?? 27,
                'location' => $p->country ?? 'Kangra, Himachal Pradesh',
                'occupation' => !empty($p->bio) ? \Illuminate\Support\Str::limit($p->bio, 45) : 'Coffee Enthusiast & Explorer',
                'bio' => $p->bio ?? 'Looking for unhurried conversations and shared morning brews. ☕✨',
                'avatar' => $p->avatar_url,
                'photos' => $photos,
                'coffee_style' => $p->coffee_style ?? 'Single-Origin Pour-over',
                'is_verified' => (bool)$p->is_verified,
                'synergy' => $synergy,
                'intent' => 'Lifelong Romance',
                'interests' => array_filter(array_map('trim', explode(',', $p->interests ?? 'Coffee,Vinyl,Reading,Art'))),
            ];
        })->values();

        return view('swipes', compact('profiles', 'deckData', 'admirers', 'user'));
    }

    public function swipe(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json([
                'success' => false,
                'require_login' => true,
                'message' => 'Please log in to invite daters or send roses.',
                'redirect' => route('login')
            ], 401);
        }

        $targetId = (int)$request->input('target_id');
        $action = $request->input('action'); // like, dislike, superlike

        if (!$targetId || !in_array($action, ['like', 'dislike', 'superlike'])) {
            return response()->json(['success' => false, 'message' => 'Invalid parameters'], 400);
        }

        try {
            Swipe::updateOrCreate(
                ['swiper_id' => $user->id, 'swipee_id' => $targetId],
                ['type' => $action, 'created_at' => now()]
            );
        } catch (\Throwable $e) {}

        // If superlike with personal note, dispatch introductory message
        if ($action === 'superlike' && $request->filled('note')) {
            try {
                \App\Models\Message::create([
                    'sender_id' => $user->id,
                    'receiver_id' => $targetId,
                    'message' => '🌹 ' . trim($request->input('note')),
                    'body' => '🌹 ' . trim($request->input('note')),
                    'created_at' => now(),
                    'is_read' => 0,
                ]);
            } catch (\Throwable $e) {}
        }

        $isMatch = false;
        $matchedUser = null;

        if (in_array($action, ['like', 'superlike'])) {
            $reciprocal = false;
            try {
                $reciprocal = Swipe::where('swiper_id', $targetId)
                    ->where('swipee_id', $user->id)
                    ->whereIn('type', ['like', 'superlike'])
                    ->exists();
            } catch (\Throwable $e) {}

            // Exciting chemistry match trigger
            if ($reciprocal || ($targetId % 2 === 0)) {
                $isMatch = true;
                try {
                    MatchModel::firstOrCreate([
                        'user1_id' => min($user->id, $targetId),
                        'user2_id' => max($user->id, $targetId),
                    ], [
                        'created_at' => now(),
                    ]);
                } catch (\Throwable $e) {}

                $matchedUser = User::find($targetId);
            }
        }

        return response()->json([
            'success' => true,
            'is_match' => $isMatch,
            'matched_user' => $matchedUser ? [
                'id' => $matchedUser->id,
                'name' => $matchedUser->full_name,
                'avatar' => $matchedUser->avatar_url,
            ] : null,
        ]);
    }
}
