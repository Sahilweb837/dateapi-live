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
                ->where('is_admin', 0)
                ->whereNotIn('id', $swipedIds)
                ->whereNotNull('full_name')
                ->where('full_name', '!=', '')
                ->whereNotNull('avatar')
                ->where('avatar', '!=', '')
                ->orderByRaw('COALESCE(is_boosted, 0) DESC')
                ->orderBy('is_verified', 'desc')
                ->orderByDesc('last_active')
                ->take(30)
                ->get();
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
            $synergy = 91 + (($p->id * 7) % 9);

            return [
                'id' => $p->id,
                'name' => $p->full_name,
                'age' => $p->age,
                'location' => $p->country ?: 'Location not shared',
                'occupation' => !empty($p->bio) ? \Illuminate\Support\Str::limit($p->bio, 45) : 'CupDate member',
                'bio' => $p->bio ?: 'This member has not added a bio yet.',
                'avatar' => $p->avatar_url,
                'photos' => [$p->avatar_url],
                'coffee_style' => $p->coffee_style ?: 'Open to a good conversation',
                'is_verified' => (bool)$p->is_verified,
                'synergy' => $synergy,
                'intent' => 'Meaningful connection',
                'interests' => array_filter(array_map('trim', explode(',', $p->interests ?: ''))),
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
            if ($reciprocal) {
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
