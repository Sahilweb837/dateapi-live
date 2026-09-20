<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! auth()->check() || ! auth()->user()->is_admin || auth()->user()->status === 'blocked') {
            auth()->logout();

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Administrator access is required.',
                    'redirect' => route('admin.login'),
                ], 403);
            }

            return redirect()->route('admin.login')
                ->withErrors(['email' => 'Please sign in with an administrator account.']);
        }

        return $next($request);
    }
}
