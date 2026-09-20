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
use App\Http\Controllers\AdminController;
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

// Google OAuth & Popup Handler
Route::match(['get', 'post'], '/auth/google', [AuthController::class, 'redirectToGoogle'])->name('auth.google');

// 1. Feed
Route::get('/feed', [FeedController::class, 'index'])->name('feed')->middleware('auth.cupdate');
Route::post('/feed/idea', [FeedController::class, 'postIdea'])->name('feed.idea')->middleware('auth.cupdate');
Route::post('/feed/spark/{id}', [FeedController::class, 'sparkIdea'])->name('feed.spark')->middleware('auth.cupdate');

// 2. Swipes & Discover Deck
Route::get('/swipes', [SwipeController::class, 'index'])->name('swipes');
Route::post('/api/swipe', [SwipeController::class, 'swipe'])->name('api.swipe');

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

// Admin Command Center & Real-time Visitor Analytics
Route::match(['get', 'post'], '/admin/login', [AdminController::class, 'login'])
    ->middleware('throttle:5,1')
    ->name('admin.login');
Route::middleware('admin')->prefix('admin')->group(function () {
    Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::post('/user/verify/{id}', [AdminController::class, 'toggleVerify'])->name('admin.user.verify');
    Route::post('/user/block/{id}', [AdminController::class, 'toggleBlock'])->name('admin.user.block');
    Route::post('/user/coins/{id}', [AdminController::class, 'addCoins'])->name('admin.user.coins');
    Route::post('/message/delete/{id}', [AdminController::class, 'deleteMessage'])->name('admin.message.delete');
    Route::post('/idea/delete/{id}', [AdminController::class, 'deleteIdea'])->name('admin.idea.delete');
    Route::post('/analytics/clear', [AdminController::class, 'clearAnalytics'])->name('admin.analytics.clear');
    Route::get('/blogs', [AdminBlogController::class, 'index'])->name('admin.blogs');
    Route::post('/blogs/store', [AdminBlogController::class, 'store'])->name('admin.blogs.store');
});

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
