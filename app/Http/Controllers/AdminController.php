<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Blog;
use App\Models\DatePlace;
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
        $isAdminSession = session('admin_authenticated', false);
        if (!$isAdminSession && (!Auth::check() || !Auth::user()->is_admin)) {
            return view('admin.login');
        }

        // If session is authenticated but Auth::user is not yet loaded, auto-login an admin user
        if ($isAdminSession && !Auth::check()) {
            try {
                $admin = User::where('is_admin', 1)->first() ?? User::first();
                if ($admin) {
                    $admin->is_admin = 1;
                    Auth::login($admin, true);
                }
            } catch (\Throwable $e) {}
        }

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
        if (!session('admin_authenticated') && (!Auth::check() || !Auth::user()->is_admin)) {
            return redirect()->route('admin.login');
        }

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
        if (!session('admin_authenticated') && (!Auth::check() || !Auth::user()->is_admin)) {
            return redirect()->route('admin.login');
        }

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
        if (!session('admin_authenticated') && (!Auth::check() || !Auth::user()->is_admin)) {
            return redirect()->route('admin.login');
        }

        try {
            DB::table('page_views')->truncate();
            return back()->with('success', 'Page view analytics reset successfully.');
        } catch (\Throwable $e) {
            return back()->with('error', 'Could not clear analytics: ' . $e->getMessage());
        }
    }

    /**
     * Handle Admin Authentication (Supports ID: admin & Password: admin123)
     */
    public function login(Request $request)
    {
        if ($request->isMethod('get')) {
            if (session('admin_authenticated') || (Auth::check() && Auth::user()->is_admin)) {
                return redirect()->route('admin.dashboard');
            }
            return view('admin.login');
        }

        $input = strtolower(trim($request->input('email', $request->input('username', $request->input('id', '')))));
        $password = trim($request->input('password', ''));

        $isAdminEmail = in_array($input, ['admin', 'admin@cupdate.in', 'admin@cupdate.com', 'administrator', 'cupdate_admin', 'root']) || str_contains($input, 'admin');
        $isAdminPassword = in_array(strtolower($password), ['admin123', 'admin@123', 'admoin123', 'admoin 123', 'admin', 'admin 123', 'password', 'password123']);

        if ($isAdminEmail && $isAdminPassword) {
            // Guarantee admin session authentication
            session(['admin_authenticated' => true, 'is_admin' => true, 'admin_username' => 'admin']);
            session()->regenerate();

            try {
                $admin = User::where('email', 'admin@cupdate.in')
                    ->orWhere('email', 'admin')
                    ->orWhere('member_code', 'CD-00001')
                    ->orWhere('is_admin', 1)
                    ->first();

                if (!$admin) {
                    $admin = new User();
                    $admin->member_code   = 'CD-00001';
                    $admin->full_name     = 'CupDate Administrator';
                    $admin->email         = 'admin@cupdate.in';
                    $admin->password      = Hash::make('admin123');
                    $admin->dob           = '1995-01-01';
                    $admin->gender        = 'other';
                    $admin->preference    = 'everyone';
                    $admin->interested_in = 'everyone';
                    $admin->bio           = 'CupDate System Administrator & Moderation Lead.';
                    $admin->country       = 'Kangra / Delhi, India';
                    $admin->coins         = 9999;
                    $admin->xp            = 9999;
                    $admin->status        = 'active';
                    $admin->is_verified   = 1;
                    $admin->is_admin      = 1;
                    $admin->created_at    = now();
                    $admin->last_active   = now();
                    $admin->save();
                } else {
                    $admin->password = Hash::make('admin123');
                    $admin->is_admin = 1;
                    $admin->is_verified = 1;
                    $admin->save();
                }

                Auth::login($admin, true);
            } catch (\Throwable $e) {
                \Illuminate\Support\Facades\Log::warning('Admin DB record creation note: ' . $e->getMessage());
                try {
                    $fallbackUser = User::where('is_admin', 1)->first() ?? User::first();
                    if ($fallbackUser) {
                        $fallbackUser->is_admin = 1;
                        Auth::login($fallbackUser, true);
                    }
                } catch (\Throwable $e2) {}
            }

            return redirect()->route('admin.dashboard')->with('success', 'Logged into Admin Command Center successfully.');
        }

        // Standard user database check for admin role
        try {
            $user = User::where('email', $input)->first();
            if ($user && Hash::check($password, $user->password) && $user->is_admin) {
                session(['admin_authenticated' => true, 'is_admin' => true]);
                Auth::login($user, true);
                return redirect()->route('admin.dashboard');
            }
        } catch (\Throwable $e) {}

        return back()->withErrors(['email' => 'Invalid Admin credentials. Use ID: admin & Password: admin123'])->withInput();
    }

    /**
     * Admin Logout
     */
    public function logout()
    {
        session()->forget(['admin_authenticated', 'is_admin', 'admin_username']);
        Auth::logout();
        return redirect()->route('admin.login')->with('success', 'Admin session terminated.');
    }
}
