<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Blog;
use App\Models\DatePlace;
use App\Models\Message;
use App\Models\Idea;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
                // Get all admin user IDs so their views NEVER pollute analytics
                $adminUserIds = User::where('is_admin', 1)->pluck('id')->toArray();

                $basePvQuery = DB::table('page_views')
                    ->where('url', 'not like', '/admin%')
                    ->where('url', 'not like', 'admin%');

                if (!empty($adminUserIds)) {
                    $basePvQuery->where(function($q) use ($adminUserIds) {
                        $q->whereNull('user_id')->orWhereNotIn('user_id', $adminUserIds);
                    });
                }

                $totalViews = (clone $basePvQuery)->count();
                $uniqueVisitors = (clone $basePvQuery)->distinct()->count('ip_address');
                
                $todayDate = date('Y-m-d');
                $viewsToday = (clone $basePvQuery)->where('created_at', 'like', "{$todayDate}%")->count();
                $uniqueToday = (clone $basePvQuery)->where('created_at', 'like', "{$todayDate}%")->distinct()->count('ip_address');

                $viewsPerPage = (clone $basePvQuery)
                    ->select('url', DB::raw('count(*) as total'), DB::raw('count(distinct ip_address) as uniques'))
                    ->groupBy('url')
                    ->orderBy('total', 'desc')
                    ->take(12)
                    ->get();

                // Deduplicated Unique Recent Visitors by IP: Each person appears once with their hit count
                $query = (clone $basePvQuery)
                    ->leftJoin('users', 'page_views.user_id', '=', 'users.id')
                    ->select(
                        'page_views.ip_address',
                        DB::raw('MAX(page_views.id) as id'),
                        DB::raw('MAX(page_views.created_at) as created_at'),
                        DB::raw('MAX(page_views.url) as url'),
                        DB::raw('MAX(page_views.method) as method'),
                        DB::raw('MAX(page_views.user_agent) as user_agent'),
                        DB::raw('MAX(users.full_name) as user_name'),
                        DB::raw('MAX(users.email) as user_email'),
                        DB::raw('COUNT(*) as total_hits')
                    );

                if ($searchIp) {
                    $query->where('page_views.ip_address', 'like', "%{$searchIp}%");
                }

                $recentVisitors = $query->groupBy('page_views.ip_address')
                    ->orderBy('id', 'desc')
                    ->take(40)
                    ->get();
            }
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::warning('Admin analytics error: ' . $e->getMessage());
        }

        // User & Content Metrics
        $searchIp = is_string($searchIp) ? trim($searchIp) : null;
        $totalUsers = 0;
        $verifiedUsers = 0;
        $users = collect();
        $totalBlogs = 0;
        $totalPlaces = 0;
        $messages = collect();
        $ideas = collect();

        try {
            $totalUsers = User::count();
            $verifiedUsers = User::where('is_verified', 1)->count();
            $users = User::orderBy('id', 'desc')->take(30)->get();
        } catch (\Throwable $e) {}

        try {
            $messages = Message::with(['sender', 'receiver'])->orderBy('id', 'desc')->take(40)->get();
        } catch (\Throwable $e) {}

        try {
            $ideas = Idea::with('user')->orderBy('id', 'desc')->take(30)->get();
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
            'messages',
            'ideas',
            'totalBlogs',
            'totalPlaces',
            'searchIp'
        ));
    }

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
     * Toggle User Block / Active Status
     */
    public function toggleBlock($id)
    {
        try {
            if ((int) $id === (int) Auth::id()) {
                return back()->with('error', 'You cannot block your own administrator account.');
            }

            $user = User::findOrFail($id);
            $user->status = ($user->status === 'blocked') ? 'active' : 'blocked';
            $user->save();

            $statusText = $user->status === 'blocked' ? 'BLOCKED 🚫' : 'UNBLOCKED & ACTIVE ✅';
            return back()->with('success', "User '{$user->full_name}' is now {$statusText}.");
        } catch (\Throwable $e) {
            return back()->with('error', 'Could not update user block status: ' . $e->getMessage());
        }
    }

    /**
     * Delete Inappropriate Message
     */
    public function deleteMessage($id)
    {
        try {
            Message::where('id', $id)->delete();
            return back()->with('success', 'Message deleted by administrator.');
        } catch (\Throwable $e) {
            return back()->with('error', 'Could not delete message: ' . $e->getMessage());
        }
    }

    /**
     * Delete Date Idea from Feed
     */
    public function deleteIdea($id)
    {
        try {
            Idea::where('id', $id)->delete();
            return back()->with('success', 'Date idea removed from community feed.');
        } catch (\Throwable $e) {
            return back()->with('error', 'Could not delete date idea: ' . $e->getMessage());
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

    public function login(Request $request)
    {
        if ($request->isMethod('get')) {
            if (Auth::check() && Auth::user()->is_admin && Auth::user()->status !== 'blocked') {
                return redirect()->route('admin.dashboard');
            }
            return view('admin.login');
        }

        $credentials = $request->validate([
            'email' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'max:255'],
        ]);
        $identifier = strtolower(trim($credentials['email']));
        $admin = User::where(function ($query) use ($identifier) {
            $query->whereRaw('LOWER(email) = ?', [$identifier])
                ->orWhereRaw('LOWER(member_code) = ?', [$identifier]);
        })->where('is_admin', true)->where('status', '!=', 'blocked')->first();

        if (!$admin || !$admin->password || !Hash::check($credentials['password'], $admin->password)) {
            return back()->withErrors(['email' => 'The administrator ID or password is incorrect.'])->withInput($request->only('email'));
        }

        Auth::login($admin, false);
        $request->session()->regenerate();

        return redirect()->intended(route('admin.dashboard'))->with('success', 'Welcome back.');
    }

    /**
     * Admin Logout
     */
    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('admin.login')->with('success', 'Admin session terminated.');
    }
}
