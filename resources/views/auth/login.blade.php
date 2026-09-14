@extends('layouts.app')

@section('title', 'Log In to CupDate — Meet Singles Over Coffee')

@section('content')
<div class="max-w-md mx-auto px-4 py-12">
    <div class="bg-white border border-[#e5d5ca] rounded-3xl p-8 shadow-none">
        <div class="text-center mb-6">
            <div class="w-12 h-12 rounded-2xl bg-[#f5ede6] border border-[#e5d5ca] flex items-center justify-center text-xl text-[#8b5a2b] mx-auto mb-3 shadow-none">
                <i class="fa-solid fa-mug-hot"></i>
            </div>
            <span class="inline-flex items-center gap-1.5 px-3 py-0.5 rounded-full text-[10px] font-extrabold uppercase tracking-wider bg-[#f5ede6] text-[#8b5a2b] border border-[#e5d5ca] mb-2">
                <i class="fa-solid fa-certificate text-[#8b5a2b]"></i> Verified Coffee Club Portal
            </span>
            <h1 class="font-['Plus_Jakarta_Sans'] font-extrabold text-2xl text-[#24140d]">Welcome Back</h1>
            <p class="text-xs text-[#7a666c] mt-1">Log in to meet verified singles over artisanal coffee.</p>
        </div>

        @if(session('status'))
            <div class="mb-4 p-3.5 bg-[#ecfdf5] border border-[#a7f3d0] rounded-2xl text-xs font-bold text-[#065f46] flex items-center gap-2">
                <i class="fa-solid fa-circle-check text-base shrink-0"></i>
                <span>{{ session('status') }}</span>
            </div>
        @endif

        @if(isset($errors) && $errors->any())
            <div class="mb-4 p-3.5 bg-[#fef2f2] border border-[#fecaca] rounded-2xl text-xs font-bold text-[#dc2626] flex items-center gap-2">
                <i class="fa-solid fa-triangle-exclamation text-base shrink-0"></i>
                <span>{{ $errors->first() }}</span>
            </div>
        @endif

        <!-- 1-Click Google Sign In with Member ID badge -->
        <a href="{{ route('auth.google') }}" class="w-full py-3 bg-white border border-[#e5d5ca] rounded-xl text-xs font-bold text-[#24140d] hover:bg-[#fbf8f5] transition flex items-center justify-center gap-2.5 mb-2 cursor-pointer shadow-none">
            <svg class="w-4 h-4 shrink-0" viewBox="0 0 24 24">
                <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z"/>
                <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z"/>
            </svg>
            <span>Continue with Google</span>
            <span class="ml-1 text-[10px] bg-[#f5ede6] text-[#8b5a2b] font-extrabold px-2 py-0.5 rounded-full border border-[#e5d5ca]">Instant ID #CD-10001</span>
        </a>
        <p class="text-[11px] text-center text-[#7a666c] mb-5">Auto-verifies your profile & allocates your unique Member ID.</p>

        <div class="relative flex items-center justify-center mb-5">
            <div class="border-t border-[#e5d5ca] w-full"></div>
            <span class="bg-white px-3 text-[11px] text-[#7a666c] font-bold uppercase tracking-wider relative">or login with email</span>
        </div>

        <form action="{{ route('login.submit') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-bold text-[#7a666c] mb-1">Email Address</label>
                <input type="email" name="email" value="{{ old('email') }}" required placeholder="you@example.com" class="w-full bg-[#fbf8f5] border border-[#e5d5ca] rounded-xl px-4 py-2.5 text-xs text-[#24140d] focus:outline-none focus:border-[#8b5a2b]">
            </div>

            <div>
                <div class="flex items-center justify-between mb-1">
                    <label class="text-xs font-bold text-[#7a666c]">Password</label>
                    <a href="{{ route('password.request') }}" class="text-xs font-bold text-[#8b5a2b] hover:underline">Forgot Password?</a>
                </div>
                <div class="relative">
                    <input type="password" id="passwordInput" name="password" required placeholder="Enter your password" class="w-full bg-[#fbf8f5] border border-[#e5d5ca] rounded-xl px-4 py-2.5 text-xs text-[#24140d] focus:outline-none focus:border-[#8b5a2b] pr-10">
                    <button type="button" onclick="togglePasswordVisibility()" class="absolute right-3 top-2.5 text-gray-400 hover:text-gray-600 text-sm cursor-pointer">
                        <i id="passwordEyeIcon" class="fa-solid fa-eye"></i>
                    </button>
                </div>
            </div>

            <div class="flex items-center justify-between text-xs pt-1">
                <label class="flex items-center gap-1.5 text-[#7a666c] cursor-pointer">
                    <input type="checkbox" name="remember" class="accent-[#8b5a2b]"> Remember me on this device
                </label>
            </div>

            <button type="submit" class="w-full py-3 bg-[#8b5a2b] text-white rounded-xl font-extrabold text-xs hover:bg-[#6d441e] transition cursor-pointer mt-2 shadow-none">
                Log In to CupDate ☕
            </button>
        </form>

        <p class="text-center text-xs text-[#7a666c] mt-6">
            Don't have an account? <a href="{{ route('register') }}" class="font-bold text-[#8b5a2b] hover:underline">Join Free</a>
        </p>
    </div>
</div>

<script>
function togglePasswordVisibility() {
    const input = document.getElementById('passwordInput');
    const icon = document.getElementById('passwordEyeIcon');
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}
</script>
@endsection
