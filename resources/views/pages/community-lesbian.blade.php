@extends('layouts.app')

@section('title', 'CupDate — Lesbian & Queer Women Dating')
@section('meta_desc', 'Connect with verified single women for intentional coffee dates, authentic chemistry, and real companionship in your city.')

@section('content')
<div class="min-h-screen bg-[#FFFDF9] text-[#1e1e24] font-['Plus_Jakarta_Sans',sans-serif]">

    <!-- Hero -->
    <section class="relative pt-12 pb-16 overflow-hidden border-b border-[#f3e5e8] bg-gradient-to-b from-[#FFF5F7] to-[#FFFDF9]">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 relative">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white border border-[#fed7aa] text-xs font-bold text-[#ea580c] mb-4 shadow-xs">
                <span>Women Loving Women &amp; Sapphic Dating</span>
            </div>

            <h1 class="text-3xl sm:text-5xl font-black text-[#1e1e24] tracking-tight leading-tight">
                Slow Dating for <br class="hidden sm:block"/>
                <span class="text-[#FF3366] font-serif italic">Lesbian &amp; Queer Women.</span>
            </h1>

            <p class="mt-4 text-base sm:text-lg text-[#5a484c] max-w-2xl leading-relaxed">
                Tired of the infinite "U-Haul vs. endless texting" trope? Meet verified lesbian and queer women who actually want to get coffee, talk about favorite albums, and see where sparks lead.
            </p>

            <div class="mt-8 flex flex-wrap items-center gap-3">
                @guest
                    <button type="button" onclick="openQuickAuthModal('register')" class="px-6 py-3 rounded-full bg-[#FF3366] text-white text-sm font-bold shadow-md hover:bg-[#e02857] transition">
                        Meet Lesbian Singles
                    </button>
                @else
                    <a href="{{ route('swipes') }}" class="px-6 py-3 rounded-full bg-[#FF3366] text-white text-sm font-bold shadow-md hover:bg-[#e02857] transition">
                        Discover Matches
                    </a>
                @endguest
                <a href="{{ route('radar') }}" class="px-5 py-3 rounded-full bg-white border border-[#dfbfc2] text-[#1e1e24] text-sm font-bold hover:bg-stone-50 transition">
                    Find Cozy Date Spots
                </a>
            </div>
        </div>
    </section>

    <!-- 3 Pillars -->
    <section class="py-14 bg-white border-b border-[#f3e5e8]">
        <div class="max-w-5xl mx-auto px-4 sm:px-6">
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                <div class="p-6 rounded-2xl bg-[#FFF1F2] border border-[#FECDD3]">
                    <h3 class="text-base font-bold text-[#1e1e24] mb-2">Intentional Vibes</h3>
                    <p class="text-xs text-[#5a484c] leading-relaxed">Filter matches seeking committed long-term romance, creative dates, or deep queer friendships.</p>
                </div>
                <div class="p-6 rounded-2xl bg-[#FEF9C3] border border-[#FDE047]">
                    <h3 class="text-base font-bold text-[#1e1e24] mb-2">Zero Catfishing</h3>
                    <p class="text-xs text-[#5a484c] leading-relaxed">Mandatory selfie verification prevents fake profiles, unicorn hunters, and bots from entering your feed.</p>
                </div>
                <div class="p-6 rounded-2xl bg-[#E8F4FD] border border-[#BAE6FD]">
                    <h3 class="text-base font-bold text-[#1e1e24] mb-2">Cozy First Meets</h3>
                    <p class="text-xs text-[#5a484c] leading-relaxed">45-minute pour-over dates at indie book cafes, garden verandas, and sunny coffee bars.</p>
                </div>
            </div>
        </div>
    </section>

</div>
@endsection
