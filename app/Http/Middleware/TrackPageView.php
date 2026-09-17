<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class TrackPageView
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Run tracking in a silent block so it never slows down or affects user requests
        try {
            // 1. Never track Admin actions, admin console, or admin users
            if ($request->is('admin*') || $request->is('*/admin*') || session('admin_authenticated')) {
                return $response;
            }
            if (Auth::check() && Auth::user()->is_admin) {
                return $response;
            }

            // 2. Ignore assets, health-checks, API heartbeats, and internal pings
            $path = $request->path();
            if ($request->is('up', 'favicon.ico', 'robots.txt', 'sitemap.xml', 'api/messages/fetch*', 'api/messages/conversation*', '*.css', '*.js', '*.png', '*.jpg', '*.svg', '*.webp', '*.woff2')) {
                return $response;
            }

            // 3. Filter out automated bots, spiders, and crawlers
            $ua = substr((string)$request->userAgent(), 0, 500);
            $lowerUa = strtolower($ua);
            if (empty($ua) || str_contains($lowerUa, 'bot') || str_contains($lowerUa, 'crawl') || 
                str_contains($lowerUa, 'spider') || str_contains($lowerUa, 'slurp') || 
                str_contains($lowerUa, 'headless') || str_contains($lowerUa, 'curl') || 
                str_contains($lowerUa, 'wget') || str_contains($lowerUa, 'python') ||
                str_contains($lowerUa, 'postman')) {
                return $response;
            }

            // 4. Detect accurate client IP (Cloudflare & reverse proxy support)
            $ip = $request->header('CF-Connecting-IP')
                ?: ($request->header('X-Forwarded-For') ? trim(explode(',', $request->header('X-Forwarded-For'))[0]) : $request->ip());

            $cleanIp = trim($ip ?: '127.0.0.1');

            // Exclude loopback or local development IP from polluting production analytics if configured
            if ($cleanIp === '::1') {
                $cleanIp = '127.0.0.1';
            }

            $url = '/' . ltrim($request->path(), '/');

            // 5. Deduplicate repeat visits from the same IP (Prevent refreshing/reloading duplicate spam)
            // Cache debounce: 1 unique pageview per IP per URL every 10 minutes
            $cacheKey = 'pv_dedup_' . md5($cleanIp . '_' . $url);
            if (Cache::has($cacheKey)) {
                return $response;
            }
            // Mark IP + URL as visited for 10 minutes (600 seconds)
            Cache::put($cacheKey, 1, 600);

            $routeName = $request->route() ? $request->route()->getName() : null;
            $method = $request->method();
            $referer = substr((string)$request->header('referer'), 0, 255);
            $userId = Auth::id() ?: null;
            $now = now()->toDateTimeString();

            DB::table('page_views')->insert([
                'ip_address' => $cleanIp,
                'url'        => $url,
                'route_name' => $routeName,
                'method'     => $method,
                'user_agent' => $ua,
                'referer'    => $referer,
                'user_id'    => $userId,
                'created_at' => $now,
            ]);
        } catch (\Throwable $e) {
            // Silently ignore if table is pending
        }

        return $response;
    }
}
