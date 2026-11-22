@extends('layouts.app')

@section('title', 'CupDate — LGBTQ+ Dating, Pride & Queer Community')
@section('meta_desc', 'A welcoming, safe, and affirming space for lesbian, gay, bisexual, transgender, and queer singles to meet over coffee for genuine connection.')

@section('content')
<div class="min-h-screen bg-[#FFFDF9] text-[#1e1e24] font-['Plus_Jakarta_Sans',sans-serif]">

    <!-- Pride Inclusivity Hero Banner -->
    <section class="relative pt-12 pb-16 overflow-hidden border-b border-[#f3e5e8]">
        <div class="absolute -top-24 -left-20 w-96 h-96 rounded-full bg-gradient-to-tr from-pink-200/40 via-purple-200/40 to-sky-200/40 blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-24 -right-20 w-96 h-96 rounded-full bg-gradient-to-tr from-amber-200/30 via-rose-200/30 to-emerald-200/30 blur-3xl pointer-events-none"></div>

        <div class="max-w-5xl mx-auto px-4 sm:px-6 relative">
            <!-- Subtle Pride Ribbon -->
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white border border-[#ecd5dc] text-xs font-bold text-[#b0284b] mb-4 shadow-xs">
                <span class="flex h-2.5 w-6 rounded-full bg-gradient-to-r from-red-500 via-amber-400 via-emerald-400 via-blue-500 to-purple-500"></span>
                <span>LGBTQ+ Affirming Dating Community</span>
            </div>

            <h1 class="text-3xl sm:text-5xl font-black text-[#1e1e24] tracking-tight leading-tight">
                Authentic Queer Dating, <br class="hidden sm:block"/>
                <span class="text-[#FF3366] font-serif italic">Free from Judgment &amp; Pretense.</span>
            </h1>

            <p class="mt-4 text-base sm:text-lg text-[#5a484c] max-w-2xl leading-relaxed">
                CupDate is built with intention for lesbian, gay, bisexual, transgender, nonbinary, and queer singles. Connect over low-pressure 45-minute coffee dates in vetted, affirming spaces.
            </p>

            <div class="mt-8 flex flex-wrap items-center gap-3">
                @guest
                    <button type="button" onclick="openQuickAuthModal('register')" class="px-6 py-3 rounded-full bg-[#FF3366] text-white text-sm font-bold shadow-md hover:bg-[#e02857] transition">
                        Join Queer Community
                    </button>
                    <button type="button" onclick="openQuickAuthModal('signin')" class="px-6 py-3 rounded-full bg-white border border-[#dfbfc2] text-[#1e1e24] text-sm font-bold hover:bg-stone-50 transition">
                        Sign In
                    </button>
                @else
                    <a href="{{ route('feed') }}" class="px-6 py-3 rounded-full bg-[#FF3366] text-white text-sm font-bold shadow-md hover:bg-[#e02857] transition">
                        Explore Feed
                    </a>
                @endguest
                <a href="{{ route('radar') }}" class="px-5 py-3 rounded-full bg-[#E8F4FD] border border-[#BAE6FD] text-[#006699] text-sm font-bold hover:bg-[#d8edfd] transition">
                    Nearby Radar
                </a>
            </div>
        </div>
    </section>

    <!-- Specific Communities Hub Grid -->
    <section class="py-14 bg-white border-b border-[#f3e5e8]">
        <div class="max-w-5xl mx-auto px-4 sm:px-6">
            <h2 class="text-2xl font-black text-[#1e1e24] mb-2">Dedicated Identity Hubs</h2>
            <p class="text-sm text-[#5a484c] mb-8">Find singles and spaces that celebrate exactly who you are.</p>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                <!-- Lesbian Dating -->
                <a href="{{ route('community.lesbian') }}" class="group p-6 rounded-2xl bg-[#FFF1F2] border border-[#FECDD3] hover:shadow-md transition">
                    <div class="w-10 h-10 rounded-xl bg-rose-500 text-white flex items-center justify-center font-bold mb-4 group-hover:scale-105 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                    </div>
                    <h3 class="text-lg font-bold text-[#1e1e24] mb-2 group-hover:text-rose-600 transition">Lesbian Dating</h3>
                    <p class="text-xs text-[#5a484c] leading-relaxed">Thoughtful dates for women loving women, sapphics, and queer femmes.</p>
                    <span class="inline-flex items-center gap-1 text-xs font-bold text-rose-600 mt-4">Explore Hub &rarr;</span>
                </a>

                <!-- Gay Dating -->
                <a href="{{ route('community.gay') }}" class="group p-6 rounded-2xl bg-[#E8F4FD] border border-[#BAE6FD] hover:shadow-md transition">
                    <div class="w-10 h-10 rounded-xl bg-blue-500 text-white flex items-center justify-center font-bold mb-4 group-hover:scale-105 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    </div>
                    <h3 class="text-lg font-bold text-[#1e1e24] mb-2 group-hover:text-blue-600 transition">Gay Dating</h3>
                    <p class="text-xs text-[#5a484c] leading-relaxed">Authentic dates for men loving men, free from ghosting and hookup pressure.</p>
                    <span class="inline-flex items-center gap-1 text-xs font-bold text-blue-600 mt-4">Explore Hub &rarr;</span>
                </a>

                <!-- Trans & Nonbinary -->
                <a href="{{ route('community.transgender') }}" class="group p-6 rounded-2xl bg-[#F0FDF4] border border-[#BBF7D0] hover:shadow-md transition">
                    <div class="w-10 h-10 rounded-xl bg-emerald-500 text-white flex items-center justify-center font-bold mb-4 group-hover:scale-105 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    </div>
                    <h3 class="text-lg font-bold text-[#1e1e24] mb-2 group-hover:text-emerald-600 transition">Trans &amp; Nonbinary</h3>
                    <p class="text-xs text-[#5a484c] leading-relaxed">A strictly verified safe space where pronouns and gender identities are deeply respected.</p>
                    <span class="inline-flex items-center gap-1 text-xs font-bold text-emerald-600 mt-4">Explore Hub &rarr;</span>
                </a>
            </div>
        </div>
    </section>

    <!-- Safety & Affirmation Pillars -->
    <section class="py-14 bg-[#FFF8F8]">
        <div class="max-w-5xl mx-auto px-4 sm:px-6">
            <div class="max-w-2xl mb-8">
                <h2 class="text-2xl font-black text-[#1e1e24]">Queer Safety Is Non-Negotiable</h2>
                <p class="text-xs sm:text-sm text-[#5a484c] mt-1">Our team actively moderates to ensure an affirming, zero-harassment environment.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div class="p-5 rounded-2xl bg-white border border-[#ecd5dc] shadow-2xs">
                    <h3 class="font-bold text-sm text-[#1e1e24] mb-1">Pronoun &amp; Identity Autonomy</h3>
                    <p class="text-xs text-[#5a484c] leading-relaxed">Display your pronouns, gender identity, and dating orientation clearly. Filter match decks based on your personal comfort.</p>
                </div>
                <div class="p-5 rounded-2xl bg-white border border-[#ecd5dc] shadow-2xs">
                    <h3 class="font-bold text-sm text-[#1e1e24] mb-1">Queer-Friendly Cafe Partners</h3>
                    <p class="text-xs text-[#5a484c] leading-relaxed">We partner with independent, arts-friendly, inclusive cafes across cities so your first coffee date is peaceful and welcoming.</p>
                </div>
            </div>
        </div>
    </section>

</div>
@endsection
