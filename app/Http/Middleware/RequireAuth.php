<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RequireAuth
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            if ($request->expectsJson() || $request->is('api/*') || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Please log in to continue.',
                    'redirect' => route('login')
                ], 401);
            }

            return redirect()->route('login')
                ->with('status', '☕ Please log in to access this feature and start meeting verified singles!');
        }

        return $next($request);
    }
}
