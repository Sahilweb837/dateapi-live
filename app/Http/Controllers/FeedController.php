<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Idea;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FeedController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        try {
            $ideas = Idea::with('user')
                ->orderBy('created_at', 'desc')
                ->take(30)
                ->get();
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::warning('Feed ideas query fallback: ' . $e->getMessage());
            $ideas = collect();
        }

        try {
            $activeDaters = User::where('status', 'active')
                ->when($user, function($query) use ($user) {
                    return $query->where('id', '!=', $user->id);
                })
                ->orderByRaw('CASE WHEN avatar IS NOT NULL AND avatar != "" AND avatar NOT LIKE "default%" THEN 1 ELSE 2 END ASC')
                ->orderBy('last_active', 'desc')
                ->take(12)
                ->get();
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::warning('Feed activeDaters query fallback: ' . $e->getMessage());
            $activeDaters = collect();
        }

        return view('feed', compact('user', 'ideas', 'activeDaters'));
    }

    public function postIdea(Request $request)
    {
        $request->validate([
            'content' => 'required|string|max:500',
            'cafe_name' => 'nullable|string|max:100',
            'city' => 'nullable|string|max:50',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        $user = Auth::user();
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Please log in.'], 401);
        }

        $imagePath = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = 'idea_' . $user->id . '_' . time() . '.' . $file->getClientOriginalExtension();
            $destDir = public_path('uploads/ideas');
            if (!is_dir($destDir)) {
                @mkdir($destDir, 0755, true);
            }
            $file->move($destDir, $filename);
            $imagePath = 'uploads/ideas/' . $filename;
        }

        $idea = Idea::create([
            'user_id' => $user->id,
            'content' => $request->content,
            'cafe_name' => $request->cafe_name ?? 'Cozy Coffee Spot',
            'city' => $request->city ?? ($user->country ?? 'India'),
            'image' => $imagePath,
            'sparks_count' => 0,
            'created_at' => now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Your coffee date idea was published! ☕',
            'idea' => [
                'id' => $idea->id,
                'content' => $idea->content,
                'cafe_name' => $idea->cafe_name,
                'city' => $idea->city,
                'image_url' => $idea->image_url,
                'sparks_count' => 0,
                'user_id' => $user->id,
                'user_name' => $user->full_name,
                'user_avatar' => $user->avatar_url,
                'time_ago' => 'Just now',
            ],
        ]);
    }

    public function sparkIdea(Request $request, $id)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Please log in.'], 401);
        }

        $idea = Idea::findOrFail($id);
        $idea->increment('sparks_count');

        return response()->json([
            'success' => true,
            'sparks' => $idea->sparks_count,
        ]);
    }
}
