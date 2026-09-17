@extends('layouts.app')

@section('title', 'Admin Command Center Login — CupDate')

@section('content')
<div class="min-h-[calc(100vh-140px)] flex items-center justify-center px-4 py-12 bg-gradient-to-br from-[#120806] via-[#1a0c08] to-[#24100b]">
    <div class="w-full max-w-md bg-[#1f100c]/95 border border-[#ff007f]/30 rounded-3xl p-6 sm:p-8 shadow-[0_0_50px_rgba(255,0,127,0.15)] text-white backdrop-blur-xl">
        
        <!-- Header Moniker -->
        <div class="text-center mb-6">
            <div class="w-14 h-14 rounded-full bg-[#160a08] border-2 border-[#ff007f] mx-auto mb-3 flex items-center justify-center shadow-[0_0_20px_rgba(255,0,127,0.4)]">
                <span class="material-symbols-outlined text-[#ff007f] text-2xl">shield_lock</span>
            </div>
            <span class="text-[10px] font-mono tracking-widest uppercase text-[#ff80bf] font-bold bg-[#ff007f]/10 border border-[#ff007f]/30 px-3 py-0.5 rounded-full">
                Restricted Command Center
            </span>
            <h1 class="font-headline-sm text-2xl font-black mt-2 text-white">
                Cup<span class="neon-pink-text">Date</span> Admin
            </h1>
            <p class="text-xs text-stone-400 mt-1">
                Moderation, real-time analytics &amp; identity clearance portal.
            </p>
        </div>

        @if(session('success'))
            <div class="mb-4 p-3 rounded-xl bg-emerald-950/80 border border-emerald-500/50 text-emerald-300 text-xs font-bold flex items-center gap-2">
                <span class="material-symbols-outlined text-sm text-emerald-400">check_circle</span>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if($errors->any())
            <div class="mb-4 p-3 rounded-xl bg-rose-950/80 border border-rose-500/50 text-rose-300 text-xs font-bold flex items-center gap-2">
                <span class="material-symbols-outlined text-sm text-rose-400">error</span>
                <span>{{ $errors->first() }}</span>
            </div>
        @endif

        <!-- Secure One-Click Admin Access (Authorized Admins Only) -->
        <div class="mb-5 p-3 rounded-2xl bg-[#160a08] border border-amber-500/30 text-xs flex items-center justify-between">
            <div class="text-[11px] text-stone-300 flex items-center gap-2">
                <span class="material-symbols-outlined text-amber-400 text-sm">shield_person</span>
                <span>Authorized Admin Console Login</span>
            </div>
            <button type="button" onclick="autofillAdmin()" class="px-2.5 py-1 rounded-lg bg-amber-500/20 hover:bg-amber-500/30 text-amber-300 border border-amber-500/40 text-[10px] font-bold cursor-pointer transition flex items-center gap-1">
                <span class="material-symbols-outlined text-xs">key</span>
                <span>Fill ID</span>
            </button>
        </div>

        <!-- Admin Login Form -->
        <form action="{{ route('admin.login') }}" method="POST" class="flex flex-col gap-4" autocomplete="off">
            @csrf

            <div>
                <label class="block text-xs font-bold text-stone-300 mb-1" for="admin-email">Admin ID / Email</label>
                <div class="relative flex items-center">
                    <span class="material-symbols-outlined absolute left-3 text-stone-500 text-lg">admin_panel_settings</span>
                    <input type="text" name="email" id="admin-email" value="{{ old('email') }}" required
                           class="w-full pl-10 pr-4 py-2.5 rounded-xl bg-[#160a08] border border-stone-700 focus:border-[#ff007f] focus:outline-none text-white text-xs font-semibold placeholder:text-stone-600 transition"
                           placeholder="Enter Admin ID">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-stone-300 mb-1" for="admin-password">Password</label>
                <div class="relative flex items-center">
                    <span class="material-symbols-outlined absolute left-3 text-stone-500 text-lg">key</span>
                    <input type="password" name="password" id="admin-password" value="" required
                           class="w-full pl-10 pr-10 py-2.5 rounded-xl bg-[#160a08] border border-stone-700 focus:border-[#ff007f] focus:outline-none text-white text-xs font-semibold placeholder:text-stone-600 transition"
                           placeholder="••••••••">
                    <button type="button" onclick="toggleAdminPass()" class="absolute right-3 text-stone-400 hover:text-white text-sm">
                        <span class="material-symbols-outlined text-base" id="adminEyeIcon">visibility</span>
                    </button>
                </div>
            </div>

            <button type="submit" class="w-full py-3 rounded-xl bg-gradient-to-r from-[#ff007f] to-[#d6006c] hover:opacity-95 text-white font-bold text-xs uppercase tracking-wider shadow-[0_0_20px_rgba(255,0,127,0.4)] transition active:scale-98 cursor-pointer mt-2">
                Access Admin Command Center →
            </button>
        </form>

        <div class="mt-6 pt-4 border-t border-stone-800 text-center">
            <a href="{{ route('home') }}" class="text-xs text-stone-400 hover:text-white transition flex items-center justify-center gap-1">
                <span class="material-symbols-outlined text-sm">arrow_back</span>
                <span>Return to CupDate Public Site</span>
            </a>
        </div>
    </div>
</div>

<script>
function autofillAdmin() {
    const emailField = document.getElementById('admin-email');
    if (emailField) emailField.value = 'admin';
    const passField = document.getElementById('admin-password');
    if (passField) passField.focus();
}
function toggleAdminPass() {
    const input = document.getElementById('admin-password');
    const icon = document.getElementById('adminEyeIcon');
    if (input.type === 'password') {
        input.type = 'text';
        icon.textContent = 'visibility_off';
    } else {
        input.type = 'password';
        icon.textContent = 'visibility';
    }
}
</script>
@endsection
