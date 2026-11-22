@extends('layouts.app')

@section('title', 'CupDate — Gay Dating & Meaningful Connections')
@section('meta_desc', 'A refreshing dating experience for gay and bisexual men looking for meaningful connections, genuine conversation, and coffee dates.')

@section('content')
<div class="min-h-screen bg-[#FFFDF9] text-[#1e1e24] font-['Plus_Jakarta_Sans',sans-serif]">

    <!-- Hero -->
    <section class="relative pt-12 pb-16 overflow-hidden border-b border-[#f3e5e8] bg-gradient-to-b from-[#F0F9FF] to-[#FFFDF9]">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 relative">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white border border-[#bae6fd] text-xs font-bold text-[#0284c7] mb-4 shadow-xs">
                <span>Gay &amp; Bi Men Dating</span>
            </div>

            <h1 class="text-3xl sm:text-5xl font-black text-[#1e1e24] tracking-tight leading-tight">
                Beyond Hookup Culture: <br class="hidden sm:block"/>
                <span class="text-[#0284c7] font-serif italic">Real Connection for Gay Men.</span>
            </h1>

            <p class="mt-4 text-base sm:text-lg text-[#5a484c] max-w-2xl leading-relaxed">
                Skip the headless torsos, ghosting, and late-night regrets. CupDate provides verified profiles, shared interests, and relaxed daylight coffee dates for gay singles who want real chemistry.
            </p>

            <div class="mt-8 flex flex-wrap items-center gap-3">
                @guest
                    <button type="button" onclick="openQuickAuthModal('register')" class="px-6 py-3 rounded-full bg-[#0284c7] text-white text-sm font-bold shadow-md hover:bg-[#0369a1] transition">
                        Meet Gay Singles
                    </button>
                @else
                    <a href="{{ route('swipes') }}" class="px-6 py-3 rounded-full bg-[#0284c7] text-white text-sm font-bold shadow-md hover:bg-[#0369a1] transition">
                        Discover Deck
                    </a>
                @endguest
                <a href="{{ route('radar') }}" class="px-5 py-3 rounded-full bg-white border border-[#bae6fd] text-[#0369a1] text-sm font-bold hover:bg-sky-50 transition">
                    Nearby Radar
                </a>
            </div>
        </div>
    </section>

    <!-- 3 Pillars -->
    <section class="py-14 bg-white border-b border-[#f3e5e8]">
        <div class="max-w-5xl mx-auto px-4 sm:px-6">
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                <div class="p-6 rounded-2xl bg-[#E8F4FD] border border-[#BAE6FD]">
                    <h3 class="text-base font-bold text-[#1e1e24] mb-2">Faces First</h3>
                    <p class="text-xs text-[#5a484c] leading-relaxed">Verified profile faces only. Know who you are talking to before you say hello.</p>
                </div>
                <div class="p-6 rounded-2xl bg-[#FEF9C3] border border-[#FDE047]">
                    <h3 class="text-base font-bold text-[#1e1e24] mb-2">Intentional Alignment</h3>
                    <p class="text-xs text-[#5a484c] leading-relaxed">Clearly express what you are looking for: monogamy, intentional dating, or exploring with respect.</p>
                </div>
                <div class="p-6 rounded-2xl bg-[#FFF1F2] border border-[#FECDD3]">
                    <h3 class="text-base font-bold text-[#1e1e24] mb-2">Safe Public Spots</h3>
                    <p class="text-xs text-[#5a484c] leading-relaxed">Meet comfortably at vetted cafes in your city with no awkward pressure.</p>
                </div>
            </div>
        </div>
    </section>

</div>
@endsection
