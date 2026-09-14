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

        $swipedIds = Swipe::where('swiper_id', $userId)->pluck('swipee_id')->toArray();
        $swipedIds[] = $userId;

        $profiles = User::where('status', 'active')
            ->whereNotIn('id', $swipedIds)
            ->orderByRaw('COALESCE(is_boosted, 0) DESC')
            ->orderByRaw('CASE WHEN avatar IS NOT NULL AND avatar != "" AND avatar NOT LIKE "default%" THEN 1 ELSE 2 END ASC')
            ->orderBy('is_verified', 'desc')
            ->take(25)
            ->get();

        return view('swipes', compact('profiles', 'user'));
    }

    public function swipe(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
        }

        $targetId = $request->input('target_id');
        $action = $request->input('action'); // like, dislike, superlike

        if (!$targetId || !in_array($action, ['like', 'dislike', 'superlike'])) {
            return response()->json(['success' => false, 'message' => 'Invalid parameters'], 400);
        }

        Swipe::updateOrCreate(
            ['swiper_id' => $user->id, 'swipee_id' => $targetId],
            ['type' => $action, 'created_at' => now()]
        );

        $isMatch = false;
        $matchedUser = null;

        if (in_array($action, ['like', 'superlike'])) {
            $reciprocal = Swipe::where('swiper_id', $targetId)
                ->where('swipee_id', $user->id)
                ->whereIn('type', ['like', 'superlike'])
                ->exists();

            if ($reciprocal) {
                $isMatch = true;
                MatchModel::firstOrCreate([
                    'user1_id' => min($user->id, $targetId),
                    'user2_id' => max($user->id, $targetId),
                ], [
                    'created_at' => now(),
                ]);

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
