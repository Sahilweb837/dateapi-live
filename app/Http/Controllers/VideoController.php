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
                ->when($user, function($query) use ($user) {
                    return $query->where('id', '!=', $user->id);
                })
                ->orderByRaw('CASE WHEN avatar IS NOT NULL AND avatar != "" AND avatar NOT LIKE "default%" THEN 1 ELSE 2 END ASC')
                ->orderBy('last_active', 'desc')
                ->take(15)
                ->get();
        } catch (\Throwable $e) {
            $partners = collect();
        }

        return view('video', compact('user', 'partners'));
    }
}
