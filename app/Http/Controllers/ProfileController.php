<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function show($id = null)
    {
        $currentUser = Auth::user();
        $targetUser = $id ? User::findOrFail($id) : $currentUser;

        if (!$targetUser && !$currentUser) {
            return redirect()->route('login');
        }

        $isOwnProfile = $currentUser && ($targetUser->id === $currentUser->id);

        // Calculate profile completeness
        $score = 30;
        if (!empty($targetUser->bio)) $score += 20;
        if (!empty($targetUser->mbti)) $score += 15;
        if (!empty($targetUser->astrology)) $score += 10;
        if (!empty($targetUser->interests)) $score += 15;
        if ($targetUser->is_verified) $score += 10;
        $completeness = min(100, $score);

        return view('profile', compact('targetUser', 'currentUser', 'isOwnProfile', 'completeness'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login');
        }

        $validated = $request->validate([
            'full_name' => 'required|string|max:100',
            'bio' => 'nullable|string|max:500',
            'interests' => 'nullable|string|max:255',
            'astrology' => 'nullable|string|max:50',
            'mbti' => 'nullable|string|max:10',
            'gender' => 'required|in:male,female,nonbinary,other',
            'country' => 'nullable|string|max:100',
            'coffee_style' => 'nullable|string|max:100',
            'instagram' => 'nullable|string|max:100',
            'snapchat' => 'nullable|string|max:100',
            'avatar_file' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        if ($request->hasFile('avatar_file')) {
            $file = $request->file('avatar_file');
            $filename = 'avatar_' . $user->id . '_' . time() . '.' . $file->getClientOriginalExtension();
            $destDir = public_path('uploads/avatars');
            if (!is_dir($destDir)) {
                @mkdir($destDir, 0755, true);
            }
            $file->move($destDir, $filename);
            $validated['avatar'] = 'uploads/avatars/' . $filename;
        }

        unset($validated['avatar_file']);
        $user->update($validated);

        return back()->with('success', 'Profile and traits updated successfully! ✨');
    }

    public function claimStreak(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Please log in to claim daily streak.'], 401);
        }

        $streakRewards = [1 => 10, 2 => 15, 3 => 20, 4 => 25, 5 => 35, 6 => 50, 7 => 100];
        $today = now()->format('Y-m-d');
        $yesterday = now()->subDay()->format('Y-m-d');

        try {
            // Check if already claimed today using safe ID ordering
            $lastClaim = null;
            try {
                $lastClaim = DB::table('daily_rewards')
                    ->where('user_id', $user->id)
                    ->orderBy('id', 'desc')
                    ->first();
            } catch (\Throwable $eCheck) {}

            $lastDate = $lastClaim ? ($lastClaim->reward_date ?? ($lastClaim->claimed_date ?? null)) : null;
            $lastStreak = $lastClaim ? (int)($lastClaim->day_streak ?? ($lastClaim->streak_count ?? 1)) : 0;

            if ($lastDate === $today) {
                return response()->json([
                    'success' => false,
                    'message' => 'Already claimed today! Return tomorrow for your next reward. ☕',
                    'streak_day' => $lastStreak ?: 1,
                    'claimed_today' => true,
                    'coins' => (int)($user->coins ?? 0),
                ]);
            }

            $currentStreak = 1;
            if ($lastDate === $yesterday) {
                $currentStreak = ($lastStreak % 7) + 1;
            }

            $rewardCoins = $streakRewards[$currentStreak] ?? 10;

            try {
                DB::table('daily_rewards')->insert([
                    'user_id'        => $user->id,
                    'reward_date'    => $today,
                    'claimed_date'   => $today,
                    'day_streak'     => $currentStreak,
                    'streak_count'   => $currentStreak,
                    'coins_rewarded' => $rewardCoins,
                    'reward_coins'   => $rewardCoins,
                    'created_at'     => now(),
                    'updated_at'     => now(),
                ]);
            } catch (\Throwable $eInsert) {
                try {
                    DB::table('daily_rewards')->insert([
                        'user_id'      => $user->id,
                        'claimed_date' => $today,
                        'streak_count' => $currentStreak,
                        'reward_coins' => $rewardCoins,
                        'created_at'   => now(),
                    ]);
                } catch (\Throwable $eInsert2) {}
            }

            $user->coins = ($user->coins ?? 0) + $rewardCoins;
            $user->save();

            return response()->json([
                'success' => true,
                'message' => "Day {$currentStreak} Daily Streak Claimed! You earned +{$rewardCoins} Coffee Coins! 🔥",
                'streak_day' => $currentStreak,
                'reward_coins' => $rewardCoins,
                'claimed_today' => true,
                'coins' => (int)$user->coins,
            ]);
        } catch (\Throwable $e) {
            $user->coins = ($user->coins ?? 0) + 10;
            $user->save();

            return response()->json([
                'success' => true,
                'message' => "Daily Coffee Streak Claimed! +10 bonus coins added! ☕",
                'streak_day' => 1,
                'reward_coins' => 10,
                'claimed_today' => true,
                'coins' => (int)$user->coins,
            ]);
        }
    }

    public function showSetup()
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login');
        }
        // If profile already complete (has bio & avatar), skip to feed
        if (!empty($user->bio) && !empty($user->avatar)) {
            return redirect()->route('feed');
        }
        return view('auth.profile-setup', compact('user'));
    }

    public function completeSetup(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login');
        }

        $validated = $request->validate([
            'bio' => 'nullable|string|max:500',
            'interests' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:100',
            'coffee_style' => 'nullable|string|max:100',
            'mbti' => 'nullable|string|max:10',
            'astrology' => 'nullable|string|max:50',
            'avatar_file' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        if ($request->hasFile('avatar_file')) {
            $file = $request->file('avatar_file');
            $filename = 'avatar_' . $user->id . '_' . time() . '.' . $file->getClientOriginalExtension();
            $destDir = public_path('uploads/avatars');
            if (!is_dir($destDir)) {
                @mkdir($destDir, 0755, true);
            }
            $file->move($destDir, $filename);
            $validated['avatar'] = 'uploads/avatars/' . $filename;
        }

        unset($validated['avatar_file']);
        $user->update($validated);

        return redirect()->route('feed')->with('success', '🎉 Profile all set! Welcome to the CupDate community! Start discovering amazing singles. ☕');
    }

    public function boostProfile(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Please log in.'], 401);
        }

        $boostCost = 50;
        if ($user->coins < $boostCost) {
            return response()->json([
                'success' => false,
                'message' => "Insufficient coins! Profile Boost costs $boostCost coins. You currently have {$user->coins} coins.",
            ]);
        }

        $user->decrement('coins', $boostCost);
        $user->is_boosted = 1;
        $user->boosted_until = now()->addHours(24);
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Profile Boost Activated! Your profile will appear at the top of Swipes for the next 24 hours! 🚀⚡',
            'coins' => $user->coins,
            'boosted_until' => $user->boosted_until->toIso8601String(),
        ]);
    }
}
