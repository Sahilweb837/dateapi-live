@extends('layouts.app')

@section('title', 'Join CupDate Free — 100% Selfie Verified Coffee Dating')

@section('content')
<div class="max-w-md mx-auto px-4 py-10">
    <div class="bg-white border border-[#e5d5ca] rounded-3xl p-8 shadow-none">
        <div class="text-center mb-6">
            <span class="inline-flex items-center gap-1.5 bg-[#f5ede6] text-[#8b5a2b] border border-[#e5d5ca] px-3.5 py-1 rounded-full text-xs font-bold uppercase tracking-wider mb-2">
                <i class="fa-solid fa-circle-check text-[#8b5a2b]"></i> 100% Selfie Verified Coffee Club
            </span>
            <h1 class="font-['Plus_Jakarta_Sans'] font-extrabold text-2xl text-[#24140d]">Create Your Profile</h1>
            <p class="text-xs text-[#7a666c] mt-1">Join verified singles meeting for curated coffee dates.</p>
        </div>

        @if(isset($errors) && $errors->any())
            <div class="mb-4 p-3.5 bg-[#fef2f2] border border-[#fecaca] rounded-2xl text-xs font-bold text-[#dc2626] flex items-center gap-2">
                <i class="fa-solid fa-triangle-exclamation text-base shrink-0"></i>
                <span>{{ $errors->first() }}</span>
            </div>
        @endif

        <!-- 1-Click Google Sign Up -->
        <a href="{{ route('auth.google') }}" class="w-full py-3 bg-white border border-[#e5d5ca] rounded-xl text-xs font-bold text-[#24140d] hover:bg-[#fbf8f5] transition flex items-center justify-center gap-2.5 mb-2 cursor-pointer shadow-none">
            <svg class="w-4 h-4 shrink-0" viewBox="0 0 24 24">
                <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z"/>
                <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z"/>
            </svg>
            <span>Sign up with Google</span>
            <span class="ml-1 text-[10px] bg-[#f5ede6] text-[#8b5a2b] font-extrabold px-2 py-0.5 rounded-full border border-[#e5d5ca]">Fast Setup</span>
        </a>
        <p class="text-[11px] text-center text-[#7a666c] mb-5">Generates your unique Member ID (#CD-XXXXX) automatically.</p>

        <div class="relative flex items-center justify-center mb-5">
            <div class="border-t border-[#e5d5ca] w-full"></div>
            <span class="bg-white px-3 text-[11px] text-[#7a666c] font-bold uppercase tracking-wider relative">or standard signup</span>
        </div>

        <form action="{{ route('register.submit') }}" method="POST" class="space-y-3.5">
            @csrf
            <div>
                <label class="block text-xs font-bold text-[#7a666c] mb-1">Full Name</label>
                <input type="text" name="full_name" value="{{ old('full_name') }}" required placeholder="e.g. Ananya Sharma" class="w-full bg-[#fbf8f5] border border-[#e5d5ca] rounded-xl px-4 py-2.5 text-xs text-[#24140d] focus:outline-none focus:border-[#8b5a2b]">
            </div>

            <div>
                <label class="block text-xs font-bold text-[#7a666c] mb-1">Email Address</label>
                <input type="email" name="email" value="{{ old('email') }}" required placeholder="ananya@example.com" class="w-full bg-[#fbf8f5] border border-[#e5d5ca] rounded-xl px-4 py-2.5 text-xs text-[#24140d] focus:outline-none focus:border-[#8b5a2b]">
            </div>

            <div>
                <label class="block text-xs font-bold text-[#7a666c] mb-1">Password</label>
                <input type="password" name="password" required minlength="6" placeholder="Choose a safe password" class="w-full bg-[#fbf8f5] border border-[#e5d5ca] rounded-xl px-4 py-2.5 text-xs text-[#24140d] focus:outline-none focus:border-[#8b5a2b]">
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-bold text-[#7a666c] mb-1">Date of Birth</label>
                    <input type="date" name="dob" value="{{ old('dob', '2001-05-15') }}" required class="w-full bg-[#fbf8f5] border border-[#e5d5ca] rounded-xl px-3 py-2 text-xs text-[#24140d] focus:outline-none focus:border-[#8b5a2b]">
                </div>
                <div>
                    <label class="block text-xs font-bold text-[#7a666c] mb-1">Gender</label>
                    <select name="gender" required class="w-full bg-[#fbf8f5] border border-[#e5d5ca] rounded-xl px-3 py-2 text-xs text-[#24140d] focus:outline-none focus:border-[#8b5a2b]">
                        <option value="female">Female</option>
                        <option value="male">Male</option>
                        <option value="nonbinary">Non-binary</option>
                        <option value="other">Other</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-bold text-[#7a666c] mb-1">City / Region</label>
                    <select name="city" class="w-full bg-[#fbf8f5] border border-[#e5d5ca] rounded-xl px-3 py-2 text-xs text-[#24140d] focus:outline-none focus:border-[#8b5a2b]">
                        <option value="Pune, India">Pune</option>
                        <option value="Delhi NCR, India">Delhi NCR</option>
                        <option value="Mumbai, India">Mumbai</option>
                        <option value="Bangalore, India">Bangalore</option>
                        <option value="Chandigarh, India">Chandigarh</option>
                        <option value="Jaipur, India">Jaipur</option>
                        <option value="Hyderabad, India">Hyderabad</option>
                        <option value="Kolkata, India">Kolkata</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold text-[#7a666c] mb-1">Coffee Persona</label>
                    <select name="coffee_style" class="w-full bg-[#fbf8f5] border border-[#e5d5ca] rounded-xl px-3 py-2 text-xs text-[#24140d] focus:outline-none focus:border-[#8b5a2b]">
                        <option value="Vanilla Oat Latte">Vanilla Oat Latte</option>
                        <option value="Espresso Macchiato">Espresso Macchiato</option>
                        <option value="Cold Brew Nitro">Cold Brew Nitro</option>
                        <option value="Cappuccino Cinnamon">Cappuccino Cinnamon</option>
                        <option value="Dark Roast Mocha">Dark Roast Mocha</option>
                        <option value="Pour-Over Arabica">Pour-Over Arabica</option>
                    </select>
                </div>
            </div>

            <div class="pt-2 text-[11px] text-[#7a666c]">
                By joining, you agree to our <a href="/terms.php" class="text-[#8b5a2b] underline">Terms</a> and <a href="/privacy.php" class="text-[#8b5a2b] underline">Privacy Policy</a>.
            </div>

            <button type="submit" class="w-full py-3.5 bg-[#8b5a2b] text-white rounded-xl font-extrabold text-xs hover:bg-[#6d441e] transition cursor-pointer mt-2 shadow-none">
                Join CupDate Free ☕
            </button>
        </form>

        <p class="text-center text-xs text-[#7a666c] mt-6">
            Already have an account? <a href="{{ route('login') }}" class="font-bold text-[#8b5a2b] hover:underline">Log In</a>
        </p>
    </div>
</div>
@endsection
