@extends('layouts.app')

@section('title', 'How CupDate Works — Simple 3-Step Coffee Dating Guide')
@section('meta_desc', 'Learn how CupDate connects verified singles for casual 45-minute coffee dates. Discover our 3-step journey from match to cafe meet.')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-12 font-['Inter']">
    <div class="text-center mb-12 bg-white border border-[#e5d5ca] rounded-3xl p-8 md:p-12 shadow-none">
        <span class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-[#f5ede6] text-[#8b5a2b] border border-[#e5d5ca] mb-3">
            <i class="fa-solid fa-route"></i> The CupDate Method
        </span>
        <h1 class="font-['Plus_Jakarta_Sans'] font-extrabold text-3xl md:text-5xl text-[#24140d] mb-4">
            How CupDate Works
        </h1>
        <p class="text-sm md:text-base text-[#7d6558] max-w-xl mx-auto leading-relaxed">
            Three simple, natural steps designed to take you from a mutual digital match to an authentic real-world conversation over artisanal coffee.
        </p>
    </div>

    <!-- 3 Big Steps Breakdown -->
    <div class="space-y-8 mb-12">
        <!-- Step 1 -->
        <div class="bg-white border border-[#e5d5ca] rounded-3xl p-8 flex flex-col md:flex-row items-center gap-6 shadow-none">
            <div class="w-20 h-20 rounded-3xl bg-[#f5ede6] border border-[#e5d5ca] text-[#8b5a2b] flex items-center justify-center text-3xl font-black shrink-0">
                01
            </div>
            <div class="space-y-2 text-center md:text-left">
                <span class="text-xs font-bold text-[#8b5a2b] uppercase tracking-wider">Step One • Identity Verification</span>
                <h2 class="font-['Plus_Jakarta_Sans'] font-extrabold text-xl text-[#24140d]">Create Profile & Complete Selfie Pass</h2>
                <p class="text-xs md:text-sm text-[#7d6558] leading-relaxed">
                    Sign up free and take a quick 3-second live selfie. Once verified, choose your favorite coffee archetype (e.g. Vanilla Oat Latte, Cold Brew, or Dark Espresso) and showcase your genuine personality.
                </p>
            </div>
        </div>

        <!-- Step 2 -->
        <div class="bg-white border border-[#e5d5ca] rounded-3xl p-8 flex flex-col md:flex-row items-center gap-6 shadow-none">
            <div class="w-20 h-20 rounded-3xl bg-[#f5ede6] border border-[#e5d5ca] text-[#8b5a2b] flex items-center justify-center text-3xl font-black shrink-0">
                02
            </div>
            <div class="space-y-2 text-center md:text-left">
                <span class="text-xs font-bold text-[#8b5a2b] uppercase tracking-wider">Step Two • Natural Discovery</span>
                <h2 class="font-['Plus_Jakarta_Sans'] font-extrabold text-xl text-[#24140d]">Swipe & Chat in Clutter-Free Direct Messages</h2>
                <p class="text-xs md:text-sm text-[#7d6558] leading-relaxed">
                    Discover singles across your city or mountain hub. When mutual interest sparks, enjoy clean, real-time messaging without spam or intrusive video popups. Exchange ideas about your favorite cafes and books.
                </p>
            </div>
        </div>

        <!-- Step 3 -->
        <div class="bg-white border border-[#e5d5ca] rounded-3xl p-8 flex flex-col md:flex-row items-center gap-6 shadow-none">
            <div class="w-20 h-20 rounded-3xl bg-[#f5ede6] border border-[#e5d5ca] text-[#8b5a2b] flex items-center justify-center text-3xl font-black shrink-0">
                03
            </div>
            <div class="space-y-2 text-center md:text-left">
                <span class="text-xs font-bold text-[#8b5a2b] uppercase tracking-wider">Step Three • The First Date</span>
                <h2 class="font-['Plus_Jakarta_Sans'] font-extrabold text-xl text-[#24140d]">Meet for a 45-Minute Coffee Date at Landmark Cafes</h2>
                <p class="text-xs md:text-sm text-[#7d6558] leading-relaxed">
                    Pick a curated partner cafe (like Blue Tokai, Subko, or Araku). Enjoy 15% member savings, safe public ambiance, and relaxed conversation. If chemistry strikes, stay for a second cup!
                </p>
            </div>
        </div>
    </div>

    <!-- CTA -->
    <div class="text-center py-8">
        <a href="{{ route('register') }}" class="px-8 py-3.5 bg-[#8b5a2b] text-white rounded-full font-bold text-xs hover:bg-[#6d421d] transition shadow-none">
            Join CupDate Free Today ☕
        </a>
    </div>
</div>
@endsection
