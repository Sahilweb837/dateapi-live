@extends('layouts.app')

@section('title', 'CupDate — Transgender & Non-Binary Dating')
@section('meta_desc', 'A deeply respectful, verified, and safe dating space for transgender and non-binary individuals to connect over coffee.')

@section('content')
<div class="min-h-screen bg-[#FFFDF9] text-[#1e1e24] font-['Plus_Jakarta_Sans',sans-serif]">

    <!-- Hero -->
    <section class="relative pt-12 pb-16 overflow-hidden border-b border-[#f3e5e8] bg-gradient-to-b from-[#F0FDF4] to-[#FFFDF9]">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 relative">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white border border-[#bbf7d0] text-xs font-bold text-[#16a34a] mb-4 shadow-xs">
                <span>Transgender &amp; Non-Binary Dating Space</span>
            </div>

            <h1 class="text-3xl sm:text-5xl font-black text-[#1e1e24] tracking-tight leading-tight">
                Dating That Honors <br class="hidden sm:block"/>
                <span class="text-[#16a34a] font-serif italic">Your True Identity.</span>
            </h1>

            <p class="mt-4 text-base sm:text-lg text-[#5a484c] max-w-2xl leading-relaxed">
                You deserve dates where your pronouns are honored, your gender is affirmed, and you are celebrated as your authentic self. Zero chasers, zero transphobia, strict human moderation.
            </p>

            <div class="mt-8 flex flex-wrap items-center gap-3">
                @guest
                    <button type="button" onclick="openQuickAuthModal('register')" class="px-6 py-3 rounded-full bg-[#16a34a] text-white text-sm font-bold shadow-md hover:bg-[#15803d] transition">
                        Join Safe Community
                    </button>
                @else
                    <a href="{{ route('swipes') }}" class="px-6 py-3 rounded-full bg-[#16a34a] text-white text-sm font-bold shadow-md hover:bg-[#15803d] transition">
                        Discover Singles
                    </a>
                @endguest
                <a href="{{ route('radar') }}" class="px-5 py-3 rounded-full bg-white border border-[#bbf7d0] text-[#16a34a] text-sm font-bold hover:bg-emerald-50 transition">
                    Find Friendly Cafes
                </a>
            </div>
        </div>
    </section>

    <!-- 3 Safety Commitments -->
    <section class="py-14 bg-white border-b border-[#f3e5e8]">
        <div class="max-w-5xl mx-auto px-4 sm:px-6">
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                <div class="p-6 rounded-2xl bg-[#F0FDF4] border border-[#BBF7D0]">
                    <h3 class="text-base font-bold text-[#1e1e24] mb-2">Zero-Tolerance Safety</h3>
                    <p class="text-xs text-[#5a484c] leading-relaxed">Transphobic comments, fetishization, or intrusive inquiries result in immediate, permanent bans.</p>
                </div>
                <div class="p-6 rounded-2xl bg-[#E8F4FD] border border-[#BAE6FD]">
                    <h3 class="text-base font-bold text-[#1e1e24] mb-2">Custom Pronoun Fields</h3>
                    <p class="text-xs text-[#5a484c] leading-relaxed">Display she/her, he/him, they/them, or custom pronouns proudly on your profile badge.</p>
                </div>
                <div class="p-6 rounded-2xl bg-[#FFF1F2] border border-[#FECDD3]">
                    <h3 class="text-base font-bold text-[#1e1e24] mb-2">Affirming Coffee Spots</h3>
                    <p class="text-xs text-[#5a484c] leading-relaxed">Every cafe featured in our guide is curated for welcoming staff and open, inclusive atmospheres.</p>
                </div>
            </div>
        </div>
    </section>

</div>
@endsection
