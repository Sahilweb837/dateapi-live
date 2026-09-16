<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FeedController;
use App\Http\Controllers\SwipeController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\AdminBlogController;
use App\Http\Controllers\SitemapController;

use App\Http\Controllers\PageController;
use App\Http\Controllers\CityController;

// Public Animated Homepage (with dynamic after-login shortcuts)
Route::get('/', [HomeController::class, 'index'])->name('home');

// Authentication Suite
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Forgot Password
Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');

// Google OAuth
Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])->name('auth.google');

// 1. Feed
Route::get('/feed', [FeedController::class, 'index'])->name('feed')->middleware('auth.cupdate');
Route::post('/feed/idea', [FeedController::class, 'postIdea'])->name('feed.idea')->middleware('auth.cupdate');
Route::post('/feed/spark/{id}', [FeedController::class, 'sparkIdea'])->name('feed.spark')->middleware('auth.cupdate');

// 2. Swipes
Route::get('/swipes', [SwipeController::class, 'index'])->name('swipes')->middleware('auth.cupdate');
Route::post('/api/swipe', [SwipeController::class, 'swipe'])->name('api.swipe')->middleware('auth.cupdate');

// 3. Messages (Simple clean chat, zero-refresh AJAX + photo upload)
Route::get('/messages', [MessageController::class, 'index'])->name('messages')->middleware('auth.cupdate');
Route::post('/api/messages/send', [MessageController::class, 'sendMessage'])->name('api.messages.send')->middleware('auth.cupdate');
Route::get('/api/messages/fetch', [MessageController::class, 'fetchMessages'])->name('api.messages.fetch')->middleware('auth.cupdate');
Route::get('/api/messages/conversation', [MessageController::class, 'getConversation'])->name('api.messages.conversation')->middleware('auth.cupdate');

// 4. Profile Setup (MUST be before the wildcard profile/{id?} route)
Route::get('/profile/setup', [ProfileController::class, 'showSetup'])->name('profile.setup')->middleware('auth.cupdate');
Route::post('/profile/setup', [ProfileController::class, 'completeSetup'])->name('profile.setup.save')->middleware('auth.cupdate');

// 4b. Profile — wildcard comes AFTER specific routes
Route::get('/profile/{id?}', [ProfileController::class, 'show'])->name('profile')->middleware('auth.cupdate');
Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update')->middleware('auth.cupdate');
Route::post('/api/streak/claim', [ProfileController::class, 'claimStreak'])->name('api.streak.claim')->middleware('auth.cupdate');
Route::post('/api/profile/boost', [ProfileController::class, 'boostProfile'])->name('api.profile.boost')->middleware('auth.cupdate');

// Standalone Video Portal
Route::get('/video', [VideoController::class, 'index'])->name('video');

// Coffee Date Spots Directory across India & Himachal Pradesh
Route::get('/dates', [PageController::class, 'dates'])->name('dates');

// Traditional Matrimony & Serious Relationship Hub
Route::get('/rishta', [PageController::class, 'rishta'])->name('rishta');

// City Dating Guides & Himachal Pradesh Hubs
Route::get('/cities', [CityController::class, 'index'])->name('cities.index');
Route::get('/city/{slug}', [CityController::class, 'show'])->name('city.show');

// AdSense E-E-A-T & Trust Pages
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/contact', [PageController::class, 'submitContact'])->name('contact.submit');
Route::get('/privacy', [PageController::class, 'privacy'])->name('privacy');
Route::get('/terms', [PageController::class, 'terms'])->name('terms');
Route::get('/safety', [PageController::class, 'safety'])->name('safety');
Route::get('/community-guidelines', [PageController::class, 'communityGuidelines'])->name('community.guidelines');
Route::get('/cookie-policy', [PageController::class, 'cookiePolicy'])->name('cookie.policy');
Route::get('/faq', [PageController::class, 'faq'])->name('faq');
Route::get('/how-it-works', [PageController::class, 'howItWorks'])->name('how.it.works');
Route::get('/disclaimer', [PageController::class, 'disclaimer'])->name('disclaimer');

// Interactive Tools & Date Guides
Route::get('/ai-bio-generator', [PageController::class, 'aiBioGenerator'])->name('ai.bio.generator');
Route::get('/coffee-date-ideas', [PageController::class, 'coffeeDateIdeas'])->name('coffee.date.ideas');

// Editorial Blogs & AdSense Compliance
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');

// Admin Automated Blogging Engine
Route::get('/admin/blogs', [AdminBlogController::class, 'index'])->name('admin.blogs');
Route::post('/admin/blogs/store', [AdminBlogController::class, 'store'])->name('admin.blogs.store');

// Sitemaps (XML & HTML)
Route::get('/sitemap.xml', [SitemapController::class, 'xml'])->name('sitemap.xml');
Route::get('/sitemap', [SitemapController::class, 'html'])->name('sitemap.html');

// Legacy 301 SEO Redirects (Protects indexed Google URLs)
Route::redirect('/about.php', '/about', 301);
Route::redirect('/contact.php', '/contact', 301);
Route::redirect('/privacy.php', '/privacy', 301);
Route::redirect('/terms.php', '/terms', 301);
Route::redirect('/safety.php', '/safety', 301);
Route::redirect('/community-guidelines.php', '/community-guidelines', 301);
Route::redirect('/cookie-policy.php', '/cookie-policy', 301);
Route::redirect('/faq.php', '/faq', 301);
Route::redirect('/how-it-works.php', '/how-it-works', 301);
Route::redirect('/dates.php', '/dates', 301);
Route::redirect('/rishta.php', '/rishta', 301);
Route::redirect('/disclaimer.php', '/disclaimer', 301);
Route::redirect('/ai-bio-generator.php', '/ai-bio-generator', 301);
Route::redirect('/coffee-date-ideas.php', '/coffee-date-ideas', 301);
Route::redirect('/shimla.php', '/city/shimla', 301);
Route::redirect('/manali.php', '/city/manali', 301);
Route::redirect('/dharamshala.php', '/city/dharamshala', 301);
Route::redirect('/kasauli.php', '/city/kasauli', 301);
Route::redirect('/pune.php', '/city/pune', 301);
Route::redirect('/mumbai.php', '/city/mumbai', 301);
Route::redirect('/bangalore.php', '/city/bangalore', 301);
Route::redirect('/delhi.php', '/city/delhi', 301);
Route::redirect('/chandigarh.php', '/city/chandigarh', 301);
Route::redirect('/jaipur.php', '/city/jaipur', 301);
Route::redirect('/goa.php', '/city/goa', 301);
Route::redirect('/sitemap.php', '/sitemap', 301);

// Emergency One-Time Database Initialization & Cache Clear (Secured)
Route::get('/system/setup-db', function (\Illuminate\Http\Request $request) {
    if ($request->query('key') !== 'cupdate_secure_init_2026') {
        abort(403, 'Unauthorized setup access');
    }
    try {
        $sqlPath = base_path('safe.sql');
        if (!file_exists($sqlPath)) {
            return response()->json(['status' => 'error', 'message' => 'safe.sql file not found'], 404);
        }
        \Illuminate\Support\Facades\DB::unprepared(file_get_contents($sqlPath));
        \Illuminate\Support\Facades\Artisan::call('config:clear');
        \Illuminate\Support\Facades\Artisan::call('cache:clear');
        return response()->json([
            'status' => 'success',
            'message' => 'Database tables and initial seed data imported successfully! Cache cleared.',
            'database' => config('database.connections.mysql.database'),
        ]);
    } catch (\Throwable $e) {
        return response()->json([
            'status' => 'error',
            'message' => $e->getMessage()
        ], 500);
    }
});

// Diagnostic System Status Endpoint
Route::get('/system/status', function () {
    $envPath = base_path('.env');
    $hasEnv = file_exists($envPath);
    $appKeySet = !empty(config('app.key'));
    $dbConnected = false;
    $dbError = null;
    $tables = [];
    try {
        \Illuminate\Support\Facades\DB::connection()->getPdo();
        $dbConnected = true;
        $tables = \Illuminate\Support\Facades\DB::select('SHOW TABLES');
    } catch (\Throwable $e) {
        $dbError = $e->getMessage();
    }
    return response()->json([
        'laravel_version' => app()->version(),
        'app_env' => config('app.env'),
        'app_debug' => config('app.debug'),
        'app_key_present' => $appKeySet,
        'dot_env_file_exists' => $hasEnv,
        'db_connection' => [
            'connected' => $dbConnected,
            'database' => config('database.connections.mysql.database'),
            'username' => config('database.connections.mysql.username'),
            'tables_count' => count($tables),
            'error' => $dbError,
        ]
    ]);
});

// Diagnostic Log Viewer (Secured)
Route::get('/system/error-log', function (\Illuminate\Http\Request $request) {
    if ($request->query('key') !== 'cupdate_secure_init_2026') {
        abort(403, 'Unauthorized log access');
    }
    $logFile = storage_path('logs/laravel.log');
    if (!file_exists($logFile)) {
        return response()->json(['message' => 'No log file found yet.']);
    }
    $lines = file($logFile);
    $lastLines = array_slice($lines, -80);
    return response('<pre>'.htmlspecialchars(implode('', $lastLines)).'</pre>');
});

