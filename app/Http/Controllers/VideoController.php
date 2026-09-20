<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class VideoController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Simulated online video partners from active users
        try {
            $partners = User::where('status', 'active')
                ->where('is_admin', 0)
                ->whereNotNull('full_name')
                ->where('full_name', '!=', '')
                ->whereNotNull('avatar')
                ->where('avatar', '!=', '')
                ->when($user, function($query) use ($user) {
                    return $query->where('id', '!=', $user->id);
                })
                ->where(function ($query) {
                    $query->whereNull('last_active')
                        ->orWhere('last_active', '>=', now()->subHours(24));
                })
                ->orderByDesc('is_verified')
                ->orderByDesc('last_active')
                ->take(20)
                ->get();
        } catch (\Throwable $e) {
            $partners = collect();
        }

        return view('video', compact('user', 'partners'));
    }
}
