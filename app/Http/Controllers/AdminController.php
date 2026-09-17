<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Blog;
use App\Models\DatePlace;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AdminController extends Controller
{
    /**
     * Display the Admin Analytics & Management Dashboard
     */
    public function index(Request $request)
    {
        $searchIp = $request->query('ip');

        // Analytics Metrics
        $totalViews = 0;
        $uniqueVisitors = 0;
        $viewsToday = 0;
        $uniqueToday = 0;
        $viewsPerPage = collect();
        $recentVisitors = collect();

        try {
            if (Schema::hasTable('page_views')) {
                $totalViews = DB::table('page_views')->count();
                $uniqueVisitors = DB::table('page_views')->distinct()->count('ip_address');
                
                $todayDate = date('Y-m-d');
                $viewsToday = DB::table('page_views')->where('created_at', 'like', "{$todayDate}%")->count();
                $uniqueToday = DB::table('page_views')->where('created_at', 'like', "{$todayDate}%")->distinct()->count('ip_address');

                $viewsPerPage = DB::table('page_views')
                    ->select('url', DB::raw('count(*) as total'), DB::raw('count(distinct ip_address) as uniques'))
                    ->groupBy('url')
                    ->orderBy('total', 'desc')
                    ->take(12)
                    ->get();

                $query = DB::table('page_views')
                    ->leftJoin('users', 'page_views.user_id', '=', 'users.id')
                    ->select('page_views.*', 'users.full_name as user_name', 'users.email as user_email');

                if ($searchIp) {
                    $query->where('page_views.ip_address', 'like', "%{$searchIp}%");
                }

                $recentVisitors = $query->orderBy('page_views.id', 'desc')->take(30)->get();
            }
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::warning('Admin analytics error: ' . $e->getMessage());
        }

        // User & Content Metrics
        $totalUsers = 0;
        $verifiedUsers = 0;
        $users = collect();
        $totalBlogs = 0;
        $totalPlaces = 0;

        try {
            $totalUsers = User::count();
            $verifiedUsers = User::where('is_verified', 1)->count();
            $users = User::orderBy('created_at', 'desc')->take(15)->get();
        } catch (\Throwable $e) {}

        try {
            $totalBlogs = Blog::count();
            $totalPlaces = DatePlace::count();
        } catch (\Throwable $e) {}

        return view('admin.dashboard', compact(
            'totalViews',
            'uniqueVisitors',
            'viewsToday',
            'uniqueToday',
            'viewsPerPage',
            'recentVisitors',
            'totalUsers',
            'verifiedUsers',
            'users',
            'totalBlogs',
            'totalPlaces',
            'searchIp'
        ));
    }

    /**
     * Toggle User Verification Status
     */
    public function toggleVerify($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->is_verified = $user->is_verified ? 0 : 1;
            $user->save();

            $statusText = $user->is_verified ? 'verified' : 'unverified';
            return back()->with('success', "User '{$user->full_name}' is now marked as {$statusText}.");
        } catch (\Throwable $e) {
            return back()->with('error', 'Could not update user verification: ' . $e->getMessage());
        }
    }

    /**
     * Add bonus coins to user
     */
    public function addCoins($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->coins = ($user->coins ?? 0) + 100;
            $user->save();

            return back()->with('success', "Added 100 bonus coffee coins to {$user->full_name}! Current total: {$user->coins}.");
        } catch (\Throwable $e) {
            return back()->with('error', 'Could not add coins: ' . $e->getMessage());
        }
    }

    /**
     * Clear Analytics logs if requested
     */
    public function clearAnalytics()
    {
        try {
            DB::table('page_views')->truncate();
            return back()->with('success', 'Page view analytics reset successfully.');
        } catch (\Throwable $e) {
            return back()->with('error', 'Could not clear analytics: ' . $e->getMessage());
        }
    }
}
