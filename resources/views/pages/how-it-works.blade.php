@extends('layouts.app')

@section('title', 'How CupDate Works — Simple 3-Step Coffee Dating Guide & Directions')
@section('meta_desc', 'Learn how CupDate connects verified singles for casual 45-minute coffee dates. Discover our 3-step journey from match to cafe meet, safety guidelines, and etiquette.')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-12 font-['Inter']">
    <!-- Header Banner -->
    <div class="text-center mb-12 bg-white border border-[#f0d9df] rounded-3xl p-8 md:p-12 shadow-sm">
        <span class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full text-xs font-extrabold uppercase tracking-wider bg-[#fff0f3] text-[#a8334e] border border-[#f1b7c1] mb-3">
            <span class="material-symbols-outlined text-sm">route</span> The CupDate Method
        </span>
        <h1 class="font-['Plus_Jakarta_Sans'] font-extrabold text-3xl md:text-5xl text-[#1b1b21] mb-4">
            How CupDate Works
        </h1>
        <p class="text-sm md:text-base text-[#584143] max-w-xl mx-auto leading-relaxed">
            Three simple, natural steps designed to take you from a mutual digital match to an authentic real-world conversation over artisanal coffee.
        </p>
    </div>

    <!-- 3 Big Steps Breakdown -->
    <div class="space-y-6 mb-12">
        <!-- Step 1 -->
        <div class="bg-white border border-[#f0d9df] rounded-3xl p-8 flex flex-col md:flex-row items-center gap-6 shadow-xs hover:shadow-md transition">
            <div class="w-20 h-20 rounded-3xl bg-[#ffd9dd] border border-[#f1b7c1] text-[#b0284b] flex items-center justify-center text-3xl font-black shrink-0 font-mono">
                01
            </div>
            <div class="space-y-2 text-center md:text-left flex-1">
                <span class="text-xs font-bold text-[#a8334e] uppercase tracking-wider">Step One • Identity Verification</span>
                <h2 class="font-['Plus_Jakarta_Sans'] font-extrabold text-xl text-[#1b1b21]">Create Profile &amp; Complete Selfie Pass</h2>
                <p class="text-xs md:text-sm text-[#584143] leading-relaxed">
                    Sign up free and take a quick 3-second live selfie. Once verified, choose your favorite coffee archetype (e.g. Vanilla Oat Latte, Cold Brew, or Dark Espresso) and showcase your genuine personality.
                </p>
                <div class="pt-2 flex flex-wrap gap-2 text-[11px] text-[#a8334e] font-bold">
                    <span class="bg-[#fff0f3] px-2.5 py-1 rounded-full border border-[#f1b7c1]">✓ Zero bot tolerance</span>
                    <span class="bg-[#fff0f3] px-2.5 py-1 rounded-full border border-[#f1b7c1]">✓ Ghost location fuzzing</span>
                    <span class="bg-[#fff0f3] px-2.5 py-1 rounded-full border border-[#f1b7c1]">✓ Blue Verified Badge</span>
                </div>
            </div>
        </div>

        <!-- Step 2 -->
        <div class="bg-white border border-[#f0d9df] rounded-3xl p-8 flex flex-col md:flex-row items-center gap-6 shadow-xs hover:shadow-md transition">
            <div class="w-20 h-20 rounded-3xl bg-[#ffd9dd] border border-[#f1b7c1] text-[#b0284b] flex items-center justify-center text-3xl font-black shrink-0 font-mono">
                02
            </div>
            <div class="space-y-2 text-center md:text-left flex-1">
                <span class="text-xs font-bold text-[#a8334e] uppercase tracking-wider">Step Two • Natural Discovery</span>
                <h2 class="font-['Plus_Jakarta_Sans'] font-extrabold text-xl text-[#1b1b21]">Discover &amp; Chat in Clutter-Free Direct Messages</h2>
                <p class="text-xs md:text-sm text-[#584143] leading-relaxed">
                    Discover singles across your city or mountain hub. When mutual interest sparks, enjoy clean, real-time messaging without spam or intrusive popups. Exchange ideas about your favorite cafes and books.
                </p>
                <div class="pt-2 flex flex-wrap gap-2 text-[11px] text-[#a8334e] font-bold">
                    <span class="bg-[#fff0f3] px-2.5 py-1 rounded-full border border-[#f1b7c1]">✓ No phone number shared</span>
                    <span class="bg-[#fff0f3] px-2.5 py-1 rounded-full border border-[#f1b7c1]">✓ Instant spam protection</span>
                    <span class="bg-[#fff0f3] px-2.5 py-1 rounded-full border border-[#f1b7c1]">✓ Zero pressure conversations</span>
                </div>
            </div>
        </div>

        <!-- Step 3 -->
        <div class="bg-white border border-[#f0d9df] rounded-3xl p-8 flex flex-col md:flex-row items-center gap-6 shadow-xs hover:shadow-md transition">
            <div class="w-20 h-20 rounded-3xl bg-[#ffd9dd] border border-[#f1b7c1] text-[#b0284b] flex items-center justify-center text-3xl font-black shrink-0 font-mono">
                03
            </div>
            <div class="space-y-2 text-center md:text-left flex-1">
                <span class="text-xs font-bold text-[#a8334e] uppercase tracking-wider">Step Three • The First Date</span>
                <h2 class="font-['Plus_Jakarta_Sans'] font-extrabold text-xl text-[#1b1b21]">Meet for a 45-Minute Coffee Date at Landmark Cafes</h2>
                <p class="text-xs md:text-sm text-[#584143] leading-relaxed">
                    Pick a curated partner cafe (like Blue Tokai, Wake &amp; Bake, Cafe Simla Times, or Illiterati). Enjoy 15% member savings, daylight public ambiance, and relaxed conversation. If chemistry strikes, stay for a second cup!
                </p>
                <div class="pt-2 flex flex-wrap gap-2 text-[11px] text-[#a8334e] font-bold">
                    <span class="bg-[#fff0f3] px-2.5 py-1 rounded-full border border-[#f1b7c1]">✓ 15% Member bill savings</span>
                    <span class="bg-[#fff0f3] px-2.5 py-1 rounded-full border border-[#f1b7c1]">✓ Vetted public locations</span>
                    <span class="bg-[#fff0f3] px-2.5 py-1 rounded-full border border-[#f1b7c1]">✓ Natural, graceful duration</span>
                </div>
            </div>
        </div>
    </div>

    <!-- The 45-Minute Rule Guide -->
    <div class="bg-[#fffafc] border border-[#f0d9df] rounded-3xl p-8 mb-10">
        <h3 class="font-['Plus_Jakarta_Sans'] font-extrabold text-xl text-[#1b1b21] mb-3 flex items-center gap-2">
            <span class="material-symbols-outlined text-[#b0284b]">schedule</span>
            The Magic of the 45-Minute Coffee Date
        </h3>
        <p class="text-xs md:text-sm text-[#584143] leading-relaxed mb-4">
            First dates often feel high-stress because people commit to long 2-hour dinners or expensive drinks with someone they have never met in person. With CupDate, our community operates on a shared understanding:
        </p>
        <div class="grid sm:grid-cols-2 gap-4 text-xs text-[#584143]">
            <div class="bg-white p-4 rounded-2xl border border-[#f0d9df]">
                <strong class="text-[#1b1b21] block mb-1">☕ Low Financial &amp; Time Pressure:</strong>
                A single cup of pour-over or cappuccino costs very little and respects both people's schedules.
            </div>
            <div class="bg-white p-4 rounded-2xl border border-[#f0d9df]">
                <strong class="text-[#1b1b21] block mb-1">🚶 Easy, Polite Conclusion:</strong>
                If there is no mutual romantic spark, finishing your coffee allows a warm, respectful departure with no awkward excuses needed.
            </div>
            <div class="bg-white p-4 rounded-2xl border border-[#f0d9df]">
                <strong class="text-[#1b1b21] block mb-1">✨ Organic Extension:</strong>
                If fireworks go off, you can spontaneously order a second round, share pastries, or take a scenic stroll down Mall Road or the promenade!
            </div>
            <div class="bg-white p-4 rounded-2xl border border-[#f0d9df]">
                <strong class="text-[#1b1b21] block mb-1">🛡️ Total Public Safety:</strong>
                Vetted partner cafés feature attentive staff and active foot traffic, putting everyone at ease.
            </div>
        </div>
    </div>

    <!-- CTA -->
    <div class="text-center py-6">
        <a href="{{ route('register') }}" class="inline-flex items-center gap-2 px-8 py-4 bg-[#ff6584] hover:bg-[#b0284b] text-white rounded-full font-extrabold text-sm shadow-lg shadow-[#ff6584]/30 transition hover:-translate-y-0.5">
            <span>Join CupDate Free Today</span>
            <span class="material-symbols-outlined text-sm">arrow_forward</span>
        </a>
    </div>
</div>
@endsection
