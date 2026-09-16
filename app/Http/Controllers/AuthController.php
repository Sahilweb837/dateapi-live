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
            'bio' => '',
            'avatar' => '',
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

        // Redirect new users to profile setup page
        return redirect()->route('profile.setup')->with('success', "Welcome to CupDate! Your unique Member ID is #{$user->formatted_member_id}. Let's set up your profile! ☕");
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
        // Google OAuth — creates or retrieves user, sets Google avatar
        $googleProfiles = [
            ['email' => 'ananya.sharma.cd@gmail.com', 'name' => 'Ananya Sharma', 'gender' => 'female', 'city' => 'Pune, India', 'bio' => 'Specialty coffee enthusiast, amateur film photographer, and indie acoustic fan. ☕📸', 'mbti' => 'ENFP', 'astrology' => 'Taurus', 'avatar' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=400&q=80&fit=crop&crop=face'],
            ['email' => 'priya.mehta.cd@gmail.com', 'name' => 'Priya Mehta', 'gender' => 'female', 'city' => 'Mumbai, India', 'bio' => 'Bookworm & coffee addict. Looking for someone to explore hidden cafes with! ☕📚', 'mbti' => 'INFJ', 'astrology' => 'Scorpio', 'avatar' => 'https://images.unsplash.com/photo-1531746020798-e6953c6e8e04?w=400&q=80&fit=crop&crop=face'],
            ['email' => 'arjun.kapoor.cd@gmail.com', 'name' => 'Arjun Kapoor', 'gender' => 'male', 'city' => 'Delhi NCR, India', 'bio' => 'Startup founder by day, stargazer by night. Espresso keeps me going! ☕🌌', 'mbti' => 'ENTJ', 'astrology' => 'Leo', 'avatar' => 'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?w=400&q=80&fit=crop&crop=face'],
        ];

        // Rotate between demo profiles based on session
        $idx = session('google_demo_idx', 0);
        $profile = $googleProfiles[$idx % count($googleProfiles)];
        session(['google_demo_idx' => $idx + 1]);

        $user = User::firstOrCreate(
            ['email' => $profile['email']],
            [
                'member_code' => 'CD-' . rand(10000, 99999),
                'full_name' => $profile['name'],
                'password' => Hash::make(Str::random(16)),
                'dob' => '1999-05-14',
                'gender' => $profile['gender'],
                'preference' => 'everyone',
                'interested_in' => 'everyone',
                'bio' => $profile['bio'],
                'avatar' => $profile['avatar'],
                'country' => $profile['city'],
                'interests' => 'Coffee, Books, Photography, Travel',
                'coffee_style' => 'Pour-Over Ethiopian Arabica',
                'mbti' => $profile['mbti'],
                'astrology' => $profile['astrology'],
                'is_verified' => 1,
                'coins' => 150,
                'xp' => 80,
                'status' => 'active',
                'created_at' => now(),
                'last_active' => now(),
            ]
        );

        $user->last_active = now();
        $user->save();

        Auth::login($user);
        return redirect()->route('feed')->with('success', "✅ Google sign-in verified! Welcome back, {$user->full_name}! ☕");
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
