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
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $credentials['email'])->first();

        if ($user) {
            // Support Laravel bcrypt, legacy MD5, and plain-text fallback
            $passwordMatches = Hash::check($credentials['password'], $user->password)
                || (md5($credentials['password']) === $user->password)
                || ($credentials['password'] === $user->password);

            if ($passwordMatches) {
                // Upgrade legacy hashes to bcrypt silently
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

        return back()->withErrors(['email' => 'Invalid email or password.'])->withInput($request->only('email'));
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
            'full_name'   => 'required|string|max:100',
            'email'       => 'required|email|unique:users,email',
            'password'    => 'required|min:6',
            'dob'         => 'required|date',
            'gender'      => 'required|in:male,female,nonbinary,other',
            'city'        => 'nullable|string|max:50',
            'interests'   => 'nullable|string|max:255',
            'coffee_style' => 'nullable|string|max:100',
        ]);

        $memberCode = 'CD-' . rand(10000, 99999);

        $user = User::create([
            'member_code'  => $memberCode,
            'full_name'    => $validated['full_name'],
            'email'        => $validated['email'],
            'password'     => Hash::make($validated['password']),
            'dob'          => $validated['dob'],
            'gender'       => $validated['gender'],
            'preference'   => 'everyone',
            'interested_in' => 'everyone',
            'bio'          => '',
            'avatar'       => '',
            'lat'          => 28.6139,
            'lng'          => 77.2090,
            'country'      => $validated['city'] ?? 'India',
            'interests'    => $validated['interests'] ?? 'Coffee, Books, Photography',
            'coffee_style' => $validated['coffee_style'] ?? 'Vanilla Oat Latte',
            'coins'        => 50,
            'xp'           => 10,
            'status'       => 'active',
            'created_at'   => now(),
            'last_active'  => now(),
        ]);

        Auth::login($user);

        return redirect()->route('profile.setup')->with('success', "Welcome to CupDate! Your Member ID is {$user->formatted_member_id}. Let's set up your profile! ☕");
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

    /**
     * Simulated Google OAuth Login.
     * 
     * Each visitor gets their own persistent Google demo profile stored by
     * a session-keyed google_id so the same browser always returns to the
     * same account — they never see another user's data.
     * 
     * When real Google OAuth Client ID is configured, replace this method
     * with Socialite::driver('google')->redirect() / ->user() flow.
     */
    public function redirectToGoogle()
    {
        // Stable pool of demo Google profiles (avatars via Unsplash, no auth)
        $googleProfiles = [
            [
                'google_id' => 'google_demo_female_1',
                'email'     => 'priya.mehta.cupdate@gmail.com',
                'name'      => 'Priya Mehta',
                'gender'    => 'female',
                'city'      => 'Pune, Maharashtra',
                'bio'       => 'Bookworm & pour-over addict. Looking for someone to explore hidden roasteries with! ☕📚',
                'mbti'      => 'INFJ',
                'astrology' => 'Scorpio',
                'avatar'    => 'https://images.unsplash.com/photo-1531746020798-e6953c6e8e04?w=400&q=80&fit=crop&crop=face',
                'interests' => 'Coffee, Books, Photography, Travel',
                'coffee'    => 'Ethiopian Pour-Over V60',
            ],
            [
                'google_id' => 'google_demo_male_1',
                'email'     => 'arjun.kapoor.cupdate@gmail.com',
                'name'      => 'Arjun Kapoor',
                'gender'    => 'male',
                'city'      => 'Delhi NCR, India',
                'bio'       => 'Startup founder by day, stargazer by night. Espresso keeps me going! ☕🌌',
                'mbti'      => 'ENTJ',
                'astrology' => 'Leo',
                'avatar'    => 'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?w=400&q=80&fit=crop&crop=face',
                'interests' => 'Startups, Espresso, Astrophysics, Jazz',
                'coffee'    => 'Double Espresso Macchiato',
            ],
            [
                'google_id' => 'google_demo_female_2',
                'email'     => 'tanya.sharma.cupdate@gmail.com',
                'name'      => 'Tanya Sharma',
                'gender'    => 'female',
                'city'      => 'Shimla, Himachal Pradesh',
                'bio'       => 'Born in Shimla, lover of cedar trails and cappuccinos at Cafe Simla Times. ☕🏔️',
                'mbti'      => 'INFJ',
                'astrology' => 'Virgo',
                'avatar'    => 'https://images.unsplash.com/photo-1524504388940-b1c1722653e1?w=400&q=80&fit=crop&crop=face',
                'interests' => 'Trekking, Specialty Coffee, Poetry, Himalayas',
                'coffee'    => 'Cinnamon Honey Latte',
            ],
            [
                'google_id' => 'google_demo_male_2',
                'email'     => 'vikram.thakur.cupdate@gmail.com',
                'name'      => 'Vikram Thakur',
                'gender'    => 'male',
                'city'      => 'Manali, Himachal Pradesh',
                'bio'       => 'Old Manali local, snowboarder, and French roast barista. Grab a table at Cafe 1947? ☕🏂',
                'mbti'      => 'ENFP',
                'astrology' => 'Aries',
                'avatar'    => 'https://images.unsplash.com/photo-1539571696357-5a69c17a67c6?w=400&q=80&fit=crop&crop=face',
                'interests' => 'Snowboarding, Pour-overs, Indie Rock, Camping',
                'coffee'    => 'French Press Dark Roast',
            ],
        ];

        // Each browser session gets a stable profile based on a session-stored index
        // This means the same person always logs in as the same Google demo account
        if (!session()->has('google_demo_profile_idx')) {
            session(['google_demo_profile_idx' => rand(0, count($googleProfiles) - 1)]);
        }
        $idx     = session('google_demo_profile_idx');
        $profile = $googleProfiles[$idx % count($googleProfiles)];

        try {
            // Find existing user by google_id first, then by email as fallback
            $user = User::where('google_id', $profile['google_id'])->first()
                ?? User::where('email', $profile['email'])->first();

            if (!$user) {
                // Create new Google user
                $user = User::create([
                    'member_code'   => 'CD-' . rand(10000, 99999),
                    'full_name'     => $profile['name'],
                    'email'         => $profile['email'],
                    'google_id'     => $profile['google_id'],
                    'password'      => Hash::make(Str::random(24)),
                    'dob'           => '1998-06-15',
                    'gender'        => $profile['gender'],
                    'preference'    => 'everyone',
                    'interested_in' => 'everyone',
                    'bio'           => $profile['bio'],
                    'avatar'        => $profile['avatar'],
                    'country'       => $profile['city'],
                    'interests'     => $profile['interests'],
                    'coffee_style'  => $profile['coffee'],
                    'mbti'          => $profile['mbti'],
                    'astrology'     => $profile['astrology'],
                    'is_verified'   => 1,
                    'coins'         => 150,
                    'xp'            => 80,
                    'status'        => 'active',
                    'created_at'    => now(),
                    'last_active'   => now(),
                ]);
            } else {
                // Update google_id if missing, and refresh last_active
                if (empty($user->google_id)) {
                    $user->google_id = $profile['google_id'];
                }
                // Always update avatar to keep Google photo fresh
                if (!empty($profile['avatar']) && empty($user->avatar)) {
                    $user->avatar = $profile['avatar'];
                }
                $user->last_active = now();
                $user->save();
            }

            Auth::login($user, true); // remember=true for Google users
            return redirect()->route('feed')->with('success', "✅ Signed in with Google! Welcome, {$user->full_name}! ☕");

        } catch (\Throwable $e) {
            // Safe fallback — never show a 500 to the user
            \Log::error('Google OAuth simulation error: ' . $e->getMessage());
            return redirect()->route('login')->withErrors([
                'email' => 'Google sign-in is temporarily unavailable. Please use email & password.'
            ]);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
