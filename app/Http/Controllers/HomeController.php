<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Idea;
use App\Models\Blog;
use App\Models\DatePlace;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // 1. Featured verified active singles for hero and discovery showcase
        $featuredDaters = User::where('status', 'active')
            ->orderByRaw('CASE WHEN avatar IS NOT NULL AND avatar != "" AND avatar NOT LIKE "default%" THEN 1 ELSE 2 END ASC')
            ->orderBy('is_verified', 'desc')
            ->orderBy('last_active', 'desc')
            ->take(8)
            ->get();

        // 2. Curated Landmark Coffee Date Spots
        $hotspots = DatePlace::orderBy('rating', 'desc')->take(5)->get();

        // 3. Recent coffee date ideas from the community
        $recentIdeas = Idea::with('user')
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get();

        // 4. Editorial guides for E-E-A-T AdSense compliance
        $editorialBlogs = Blog::orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        // 5. If logged in, calculate profile completeness percentage
        $profileCompleteness = 0;
        if ($user) {
            $score = 40; // baseline for existing account
            if (!empty($user->bio)) $score += 15;
            if (!empty($user->mbti)) $score += 15;
            if (!empty($user->astrology)) $score += 10;
            if (!empty($user->interests)) $score += 10;
            if ($user->is_verified) $score += 10;
            $profileCompleteness = min(100, $score);
        }

        return view('welcome', compact(
            'user',
            'featuredDaters',
            'hotspots',
            'recentIdeas',
            'editorialBlogs',
            'profileCompleteness'
        ));
    }
}
