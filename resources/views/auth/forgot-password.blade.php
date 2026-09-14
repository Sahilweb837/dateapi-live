@extends('layouts.app')

@section('title', 'Forgot Password — CupDate')

@section('content')
<div class="max-w-md mx-auto px-4 py-12">
    <div class="bg-white border border-[#e5d5ca] rounded-3xl p-8 shadow-none">
        <div class="text-center mb-6">
            <div class="w-12 h-12 rounded-2xl bg-[#f5ede6] border border-[#e5d5ca] flex items-center justify-center text-xl text-[#8b5a2b] mx-auto mb-3 shadow-none">
                <i class="fa-solid fa-key"></i>
            </div>
            <h1 class="font-['Plus_Jakarta_Sans'] font-extrabold text-2xl text-[#24140d]">Reset Your Password</h1>
            <p class="text-xs text-[#7a666c] mt-1">Enter your registered email address and we will send you instructions to reset your password.</p>
        </div>

        @if(session('status'))
            <div class="mb-5 p-4 bg-[#ecfdf5] border border-[#a7f3d0] rounded-2xl text-xs font-bold text-[#065f46] flex items-center gap-2">
                <i class="fa-solid fa-circle-check text-base shrink-0"></i>
                <span>{{ session('status') }}</span>
            </div>
        @endif

        @if(isset($errors) && $errors->any())
            <div class="mb-4 p-3 bg-[#fef2f2] border border-[#fecaca] rounded-xl text-xs font-bold text-[#dc2626]">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('password.email') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-bold text-[#7a666c] mb-1">Registered Email Address</label>
                <input type="email" name="email" value="{{ old('email') }}" required placeholder="you@example.com" class="w-full bg-[#fbf8f5] border border-[#e5d5ca] rounded-xl px-4 py-2.5 text-xs text-[#24140d] focus:outline-none focus:border-[#8b5a2b]">
            </div>

            <button type="submit" class="w-full py-3 bg-[#8b5a2b] text-white rounded-xl font-extrabold text-xs hover:bg-[#6d441e] transition cursor-pointer shadow-none">
                Send Password Reset Link
            </button>
        </form>

        <div class="pt-6 mt-6 border-t border-[#e5d5ca] text-center">
            <a href="{{ route('login') }}" class="text-xs font-bold text-[#7a666c] hover:text-[#8b5a2b] flex items-center justify-center gap-1.5">
                <i class="fa-solid fa-arrow-left text-[10px]"></i> Back to Login
            </a>
        </div>
    </div>
</div>
@endsection
