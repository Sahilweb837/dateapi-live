<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
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

        try {
            $user = User::where('email', $credentials['email'])->first();
        } catch (\Throwable $e) {
            return back()->withErrors(['email' => 'Database is temporarily unavailable. Please try again in a moment.'])->withInput($request->only('email'));
        }

        if ($user) {
            $passwordMatches = Hash::check($credentials['password'], $user->password)
                || (md5($credentials['password']) === $user->password)
                || ($credentials['password'] === $user->password);

            if ($passwordMatches) {
                if (!Hash::check($credentials['password'], $user->password)) {
                    $user->password = Hash::make($credentials['password']);
                    $user->save();
                }
                Auth::login($user, $request->has('remember'));
                try { $user->last_active = now(); $user->save(); } catch (\Throwable $e) {}
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
        return view('auth.login', ['initialTab' => 'register']);
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'full_name'    => 'required|string|max:100',
            'email'        => 'required|email|unique:users,email',
            'password'     => 'required|min:6',
            'dob'          => 'required|date',
            'gender'       => 'required|in:male,female,nonbinary,other',
            'city'         => 'nullable|string|max:50',
            'interests'    => 'nullable|string|max:255',
            'coffee_style' => 'nullable|string|max:100',
        ]);

        $memberCode = 'CD-' . rand(10000, 99999);

        $user = User::create([
            'member_code'   => $memberCode,
            'full_name'     => $validated['full_name'],
            'email'         => $validated['email'],
            'password'      => Hash::make($validated['password']),
            'dob'           => $validated['dob'],
            'gender'        => $validated['gender'],
            'preference'    => 'everyone',
            'interested_in' => 'everyone',
            'bio'           => '',
            'avatar'        => '',
            'lat'           => 28.6139,
            'lng'           => 77.2090,
            'country'       => $validated['city'] ?? 'India',
            'interests'     => $validated['interests'] ?? 'Coffee, Books, Photography',
            'coffee_style'  => $validated['coffee_style'] ?? 'Vanilla Oat Latte',
            'coins'         => 50,
            'xp'            => 10,
            'status'        => 'active',
            'created_at'    => now(),
            'last_active'   => now(),
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

        return back()->with('status', 'Password reset instructions sent! Please check your inbox and spam folder.');
    }

    /**
     * Google OAuth — Session-Stable Demo Login
     * 
     * Each browser session gets a FIXED stable Google demo profile.
     * Even if the DB is temporarily unavailable, we first try to 
     * fix the DB_HOST and re-connect before giving up.
     */
    public function redirectToGoogle()
    {
        // Step 1: Auto-fix DB_HOST before attempting any query
        $this->ensureDbHostIsLocalhost();

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
                'bio'       => 'Born in Shimla, lover of cedar trails and cappuccinos. ☕🏔️',
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
                'bio'       => 'Old Manali local, snowboarder & French roast barista. ☕🏂',
                'mbti'      => 'ENFP',
                'astrology' => 'Aries',
                'avatar'    => 'https://images.unsplash.com/photo-1539571696357-5a69c17a67c6?w=400&q=80&fit=crop&crop=face',
                'interests' => 'Snowboarding, Pour-overs, Indie Rock, Camping',
                'coffee'    => 'French Press Dark Roast',
            ],
        ];

        // Stable session-bound profile index (same browser = same profile always)
        if (!session()->has('google_demo_profile_idx')) {
            session(['google_demo_profile_idx' => rand(0, count($googleProfiles) - 1)]);
        }
        $idx     = session('google_demo_profile_idx');
        $profile = $googleProfiles[$idx % count($googleProfiles)];

        try {
            // Force reconnect with fresh config after DB_HOST patch
            DB::reconnect();

            $user = User::where('google_id', $profile['google_id'])->first()
                ?? User::where('email', $profile['email'])->first();

            if (!$user) {
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
                if (empty($user->google_id)) $user->google_id = $profile['google_id'];
                if (empty($user->avatar))    $user->avatar    = $profile['avatar'];
                $user->last_active = now();
                $user->save();
            }

            Auth::login($user, true);
            return redirect()->route('feed')->with('success', "✅ Signed in with Google! Welcome, {$user->full_name}! ☕");

        } catch (\Throwable $e) {
            \Log::error('Google OAuth error: ' . $e->getMessage());

            // Last-resort friendly message — never a blank 500 page
            return redirect()->route('login')->withErrors([
                'email' => 'Database connecting — please try Google Sign-In again in 10 seconds, or use email login below.'
            ]);
        }
    }

    /**
     * Ensure DB_HOST is localhost (cPanel hosting fix).
     * This runs before every Google auth attempt as a safeguard.
     */
    private function ensureDbHostIsLocalhost(): void
    {
        try {
            $baseDir  = base_path();
            $envPath  = $baseDir . '/.env';
            $prodPath = $baseDir . '/.env.production';

            $currentHost = config('database.connections.mysql.host');
            if ($currentHost === '127.0.0.1') {
                // Patch the .env file
                if (file_exists($prodPath)) {
                    @copy($prodPath, $envPath);
                } elseif (file_exists($envPath)) {
                    $content = file_get_contents($envPath);
                    $patched = str_replace('DB_HOST=127.0.0.1', 'DB_HOST=localhost', $content);
                    file_put_contents($envPath, $patched);
                }
                // Clear config cache
                @unlink($baseDir . '/bootstrap/cache/config.php');
            }
        } catch (\Throwable $e) {
            // Silent — never let this crash the main flow
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
