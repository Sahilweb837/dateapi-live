@extends('layouts.app')

@section('title', 'Admin Command Center Access — CupDate')

@section('content')
<div class="min-h-[calc(100vh-140px)] flex items-center justify-center px-4 py-12 bg-[#0b0f19]">
    <div class="w-full max-w-md bg-[#111827] border border-[#1f2937] rounded-3xl p-6 sm:p-8 shadow-2xl text-white">
        
        <!-- Header Moniker -->
        <div class="text-center mb-6">
            <div class="mb-3 flex justify-center">
                <img src="{{ asset('assets/images/cupdate_logo_main.png') }}" alt="CupDate Logo" class="h-10 w-auto object-contain">
            </div>
            <span class="text-[10px] font-mono tracking-widest uppercase text-emerald-400 font-bold bg-emerald-950/80 border border-emerald-800/60 px-3 py-1 rounded-full">
                RESTRICTED COMMAND CENTER
            </span>
            <h1 class="text-2xl font-black mt-2 text-white">
                Admin <span class="text-[#FF3366]">Security Portal</span>
            </h1>
            <p class="text-xs text-[#94a3b8] mt-1">
                Real-time user telemetries, cafe listings &amp; moderation.
            </p>
        </div>

        @if(session('success'))
            <div class="mb-4 p-3 rounded-xl bg-emerald-950/80 border border-emerald-500/50 text-emerald-300 text-xs font-bold flex items-center gap-2">
                <span>✓</span>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if(isset($errors) && $errors->any())
            <div class="mb-4 p-3 rounded-xl bg-rose-950/80 border border-rose-500/50 text-rose-300 text-xs font-bold flex items-center gap-2">
                <span>⚠</span>
                <span>{{ $errors->first() }}</span>
            </div>
        @endif

        <!-- Admin Login Form -->
        <form action="{{ route('admin.login') }}" method="POST" class="flex flex-col gap-4" autocomplete="on">
            @csrf

            <div>
                <label class="block text-xs font-bold text-[#cbd5e1] mb-1" for="admin-email">Admin ID / Email</label>
                <div class="relative flex items-center">
                    <input type="text" name="email" id="admin-email" value="{{ old('email', '') }}" required autocomplete="username" autofocus
                           class="w-full px-4 py-2.5 rounded-xl bg-[#1e293b] border border-[#334155] focus:border-[#ff6584] focus:outline-none text-white text-xs font-semibold placeholder-[#64748b] transition"
                           placeholder="Enter Admin ID">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-[#cbd5e1] mb-1" for="admin-password">Password</label>
                <div class="relative flex items-center">
                    <input type="password" name="password" id="admin-password" value="" required autocomplete="current-password"
                           class="w-full px-4 py-2.5 rounded-xl bg-[#1e293b] border border-[#334155] focus:border-[#ff6584] focus:outline-none text-white text-xs font-semibold placeholder-[#64748b] transition"
                           placeholder="Enter Admin Password">
                    <button type="button" onclick="toggleAdminPass()" class="absolute right-3 text-[#94a3b8] hover:text-white text-xs cursor-pointer">
                        <span id="adminEyeText">Show</span>
                    </button>
                </div>
            </div>

            <button type="submit" class="w-full py-3 rounded-xl bg-gradient-to-r from-[#b0284b] to-[#ff6584] hover:brightness-105 text-white font-bold text-xs uppercase tracking-wider shadow-lg shadow-[#b0284b]/25 transition active:scale-98 cursor-pointer mt-2">
                Access Admin Command Center &rarr;
            </button>

            <!-- Quick Credential Pill for Test Convenience -->
            <button type="button" onclick="fillAdminDemo()" class="w-full py-2 rounded-xl bg-[#1e293b] hover:bg-[#334155] text-emerald-400 text-xs font-mono font-bold border border-emerald-900/60 transition cursor-pointer">
                ⚡ Auto-Fill: admin / admin123
            </button>
        </form>

        <script>
        function fillAdminDemo() {
            document.getElementById('admin-email').value = 'admin';
            document.getElementById('admin-password').value = 'admin123';
        }
        </script>

        <div class="mt-6 pt-4 border-t border-[#1e293b] text-center">
            <a href="{{ route('home') }}" class="text-xs text-[#94a3b8] hover:text-white transition flex items-center justify-center gap-1">
                <span>&larr;</span>
                <span>Return to CupDate Public Site</span>
            </a>
        </div>
    </div>
</div>

<script>
function toggleAdminPass() {
    const input = document.getElementById('admin-password');
    const text = document.getElementById('adminEyeText');
    if (!input) return;
    if (input.type === 'password') {
        input.type = 'text';
        if (text) text.textContent = 'Hide';
    } else {
        input.type = 'password';
        if (text) text.textContent = 'Show';
    }
}
</script>
@endsection
