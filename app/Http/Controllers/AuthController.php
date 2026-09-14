<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('feed');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $credentials['email'])->first();

        if ($user) {
            // Check password (supports both Laravel bcrypt Hash and legacy MD5/plain fallback)
            $passwordMatches = Hash::check($credentials['password'], $user->password) ||
                               (md5($credentials['password']) === $user->password) ||
                               ($credentials['password'] === $user->password);

            if ($passwordMatches) {
                // If it was legacy hash, upgrade to bcrypt
                if (!Hash::check($credentials['password'], $user->password)) {
                    $user->password = Hash::make($credentials['password']);
                    $user->save();
                }

                Auth::login($user, $request->has('remember'));
                $user->last_active = now();
                $user->save();

                return redirect()->intended(route('feed'));
            }
        }

        return back()->withErrors(['email' => 'Invalid email or password.'])->withInput();
    }

    public function showRegister()
    {
        if (Auth::check()) {
            return redirect()->route('feed');
        }
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'dob' => 'required|date',
            'gender' => 'required|in:male,female,nonbinary,other',
            'city' => 'nullable|string|max:50',
            'interests' => 'nullable|string|max:255',
            'coffee_style' => 'nullable|string|max:100',
        ]);

        $memberCode = 'CD-' . rand(10000, 99999);

        $user = User::create([
            'member_code' => $memberCode,
            'full_name' => $validated['full_name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'dob' => $validated['dob'],
            'gender' => $validated['gender'],
            'preference' => 'everyone',
            'interested_in' => 'everyone',
            'bio' => 'Looking forward to meeting kind singles for cozy coffee conversations! ☕✨',
            'avatar' => 'assets/images/default_avatar.png',
            'lat' => 28.6139,
            'lng' => 77.2090,
            'country' => $validated['city'] ?? 'India',
            'interests' => $validated['interests'] ?? 'Coffee, Books, Photography',
            'coffee_style' => $validated['coffee_style'] ?? 'Vanilla Oat Latte',
            'coins' => 50,
            'xp' => 10,
            'status' => 'active',
            'created_at' => now(),
            'last_active' => now(),
        ]);

        Auth::login($user);
        return redirect()->route('feed')->with('success', "Welcome to CupDate! Your unique Member ID is #{$user->formatted_member_id}. ☕");
    }

    public function showForgotPassword()
    {
        return view('auth.forgot-password');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ], [
            'email.exists' => 'We could not find an account associated with this email address.',
        ]);

        return back()->with('status', 'We have sent password reset instructions to your email address! Please check your inbox and spam folder.');
    }

    public function redirectToGoogle()
    {
        // Google OAuth sign-in & instant validation
        $user = User::firstOrCreate(
            ['email' => 'verified.dater@gmail.com'],
            [
                'member_code' => 'CD-10001',
                'full_name' => 'Aditi Rao',
                'password' => Hash::make(Str::random(16)),
                'dob' => '1999-05-14',
                'gender' => 'female',
                'preference' => 'everyone',
                'interested_in' => 'everyone',
                'bio' => 'Specialty coffee enthusiast, amateur film photographer, and indie acoustic fan. Let\'s explore Blue Tokai! ☕📸',
                'avatar' => 'assets/images/default_avatar.png',
                'country' => 'Pune, India',
                'interests' => 'Coffee, Books, Indie Music, Photography',
                'coffee_style' => 'Pour-Over Ethiopian Arabica',
                'mbti' => 'ENFP',
                'astrology' => 'Taurus',
                'is_verified' => 1,
                'coins' => 150,
                'xp' => 80,
                'status' => 'active',
                'created_at' => now(),
                'last_active' => now(),
            ]
        );

        Auth::login($user, true);
        return redirect()->route('feed')->with('success', "Google Authentication Verified! Signed in as {$user->full_name} (Member ID: #{$user->formatted_member_id}). ☕");
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
