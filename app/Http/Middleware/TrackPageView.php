<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TrackPageView
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Run tracking in a silent block so it never affects user requests
        try {
            // Ignore asset and ping requests
            $path = $request->path();
            if ($request->is('up', 'favicon.ico', 'robots.txt', '*.css', '*.js', '*.png', '*.jpg', '*.svg')) {
                return $response;
            }

            // Detect accurate client IP (Cloudflare support)
            $ip = $request->header('CF-Connecting-IP')
                ?: ($request->header('X-Forwarded-For') ? trim(explode(',', $request->header('X-Forwarded-For'))[0]) : $request->ip());

            $routeName = $request->route() ? $request->route()->getName() : null;
            $url = '/' . ltrim($request->path(), '/');
            $method = $request->method();
            $ua = substr((string)$request->userAgent(), 0, 500);
            $referer = substr((string)$request->header('referer'), 0, 255);
            $userId = Auth::id() ?: null;
            $now = now()->toDateTimeString();

            DB::table('page_views')->insert([
                'ip_address' => $ip ?: '127.0.0.1',
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
