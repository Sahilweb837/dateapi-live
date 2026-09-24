@extends('layouts.app')

@section('title', 'CupDate — Genuine Dating, Online Chat & Verified Coffee Dates in India')
@section('meta_desc', 'Meet verified singles in Himachal Pradesh, Punjab, and major Indian cities. CupDate makes dating simple, intentional, and safe with 45-minute coffee dates.')

@section('content')
<div class="cupdate-home min-h-screen overflow-hidden bg-[#fbf8ff] text-[#1b1b21] font-['Plus_Jakarta_Sans',sans-serif]">

    <!-- HERO SECTION -->
    <section class="relative">
        <div class="pointer-events-none absolute -left-32 top-16 h-80 w-80 rounded-full bg-[#ffd9dd]/60 blur-3xl"></div>
        <div class="pointer-events-none absolute -right-24 top-0 h-96 w-96 rounded-full bg-[#fdc5d0]/45 blur-3xl"></div>

        <div class="relative mx-auto grid max-w-7xl items-center gap-12 px-5 pb-16 pt-12 sm:px-8 lg:grid-cols-2 lg:px-12 lg:pb-24 lg:pt-20">
            <div class="max-w-2xl">
                <div class="mb-6 inline-flex items-center gap-2 rounded-full border border-[#f1b7c1] bg-white/85 px-4 py-2 text-xs font-extrabold uppercase tracking-[.13em] text-[#a8334e] shadow-sm backdrop-blur">
                    <span class="h-2.5 w-2.5 animate-pulse rounded-full bg-[#fd748e]"></span>
                    Dating with intention
                </div>
                <h1 class="max-w-xl text-5xl font-extrabold leading-[1.06] tracking-[-.04em] sm:text-6xl lg:text-7xl">
                    Find someone who makes your heart
                    <span class="relative inline-block text-[#b0284b]">
                        smile like this
                        <span class="absolute -bottom-2 left-0 h-1.5 w-full rounded-full bg-[#fd748e]/55"></span>
                    </span>
                    <span class="ml-1 align-middle text-3xl">♥</span>
                </h1>
                <p class="mt-6 max-w-xl text-base leading-8 text-[#584143] sm:text-lg">
                    Skip the exhausting swipe cycle. Meet real, selfie-verified people through honest profiles,
                    easy conversation, and relaxed 45-minute coffee dates that feel natural.
                </p>
                <div class="mt-8 flex flex-wrap gap-3">
                    @guest
                        <button type="button" onclick="openQuickAuthModal('register')" 
                                class="inline-flex items-center gap-2 rounded-full bg-gradient-to-r from-[#ff6584] via-[#fd748e] to-[#b0284b] px-7 py-4 text-sm font-extrabold text-white shadow-lg shadow-[#ff6584]/30 transition hover:-translate-y-0.5 hover:brightness-105 active:scale-95 cursor-pointer">
                            <span>Find your person</span>
                            <span aria-hidden="true">♥</span>
                        </button>
                        <button type="button" onclick="openQuickAuthModal('signin')" 
                                class="inline-flex items-center gap-2 rounded-full border border-[#dfbfc2] bg-white/90 px-7 py-4 text-sm font-extrabold text-[#a8334e] transition hover:bg-[#fff0f3] active:scale-95 cursor-pointer">
                            <span>Sign in</span>
                        </button>
                    @else
                        <a href="{{ route('swipes') }}" class="inline-flex items-center gap-2 rounded-full bg-gradient-to-r from-[#ff6584] via-[#fd748e] to-[#b0284b] px-7 py-4 text-sm font-extrabold text-white shadow-lg shadow-[#ff6584]/30 transition hover:-translate-y-0.5 hover:brightness-105">
                            Explore your matches <span aria-hidden="true">→</span>
                        </a>
                        <a href="{{ route('cities.index') }}" class="inline-flex items-center gap-2 rounded-full border border-[#dfbfc2] bg-white/90 px-7 py-4 text-sm font-extrabold text-[#a8334e] transition hover:bg-[#fff0f3]">
                            Explore local sparks
                        </a>
                    @endguest
                </div>
                <div class="mt-8 flex flex-wrap gap-x-6 gap-y-3 text-xs font-bold text-[#6c595f]">
                    <span class="inline-flex items-center gap-2"><span class="material-symbols-outlined text-base text-[#b0284b]">verified_user</span> 100% Real profiles</span>
                    <span class="inline-flex items-center gap-2"><span class="material-symbols-outlined text-base text-[#b0284b]">lock</span> Private by design</span>
                    <span class="inline-flex items-center gap-2"><span class="material-symbols-outlined text-base text-[#b0284b]">local_cafe</span> Low-pressure coffee</span>
                </div>
            </div>

            <!-- Hero Image with Shimmer Skeleton -->
            <div class="relative mx-auto w-full max-w-xl">
                <div class="absolute -left-8 top-14 h-28 w-28 rounded-[2rem] bg-[#ffd9dd]"></div>
                <div class="absolute -right-6 bottom-6 h-36 w-36 rounded-full bg-[#f6dce3]"></div>
                <div class="relative overflow-hidden rounded-[2.5rem] border-8 border-white bg-white shadow-[0_24px_70px_rgba(176,40,75,.22)]">
                    <div class="relative aspect-[4/3] overflow-hidden img-skeleton-wrapper">
                        <img src="{{ asset('assets/images/hero_couple_4.png') }}" alt="A happy couple enjoying a genuine CupDate connection" class="h-full w-full object-cover" loading="eager">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#25181d]/65 via-transparent to-transparent pointer-events-none z-10"></div>
                        <div class="absolute left-5 right-5 top-5 flex items-center justify-between rounded-2xl bg-white/85 px-4 py-3 backdrop-blur z-20">
                            <div>
                                <p class="text-[10px] font-extrabold uppercase tracking-[.16em] text-[#a8334e]">Your people</p>
                                <p class="font-extrabold text-[#1b1b21]">Around you</p>
                            </div>
                            <span class="material-symbols-outlined text-[#b0284b]">favorite</span>
                        </div>
                        <div class="absolute bottom-5 left-5 right-5 flex items-end justify-between gap-4 text-white z-20">
                            <div>
                                <p class="text-xs font-bold uppercase tracking-[.15em] text-[#ffd9dd]">A calmer way to date</p>
                                <p class="mt-1 text-xl font-extrabold">Start with a real hello.</p>
                            </div>
                            <span class="rounded-full bg-white/20 px-3 py-2 text-xs font-bold backdrop-blur">♥ genuine</span>
                        </div>
                    </div>
                    <div class="grid grid-cols-3 gap-3 bg-white p-4 text-center">
                        <div><p class="text-lg font-extrabold text-[#b0284b]">100%</p><p class="text-[10px] font-bold uppercase tracking-wider text-[#6c595f]">verified people</p></div>
                        <div><p class="text-lg font-extrabold text-[#b0284b]">1:1</p><p class="text-[10px] font-bold uppercase tracking-wider text-[#6c595f]">conversation</p></div>
                        <div><p class="text-lg font-extrabold text-[#b0284b]">45 min</p><p class="text-[10px] font-bold uppercase tracking-wider text-[#6c595f]">coffee dates</p></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- REAL MEMBERS SHOWCASE SECTION (HIGH USER DEMAND) -->
    <section class="border-t border-[#f0d6dc] bg-white py-16" id="verified-singles">
        <div class="mx-auto max-w-7xl px-5 sm:px-8 lg:px-12">
            <div class="flex flex-wrap items-end justify-between gap-4 mb-10">
                <div>
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-[#fff0f3] text-[#a8334e] border border-[#f1b7c1] mb-2">
                        <span class="material-symbols-outlined text-sm text-[#b0284b]">verified</span> 100% Selfie-Verified Members
                    </span>
                    <h2 class="text-3xl sm:text-4xl font-extrabold tracking-tight text-[#1b1b21]">
                        Meet Intentional Singles Ready for Coffee
                    </h2>
                    <p class="text-xs sm:text-sm text-[#584143] mt-1">
                        Real people looking for real conversation in Himachal Pradesh, Punjab, and major Indian cities.
                    </p>
                </div>
                @guest
                    <button type="button" onclick="openQuickAuthModal('register')" class="text-xs sm:text-sm font-bold text-[#b0284b] hover:underline flex items-center gap-1 cursor-pointer">
                        <span>Join &amp; Say Hello</span>
                        <span class="material-symbols-outlined text-sm">arrow_forward</span>
                    </button>
                @else
                    <a href="{{ route('swipes') }}" class="text-xs sm:text-sm font-bold text-[#b0284b] hover:underline flex items-center gap-1">
                        <span>Explore Full Deck</span>
                        <span class="material-symbols-outlined text-sm">arrow_forward</span>
                    </a>
                @endguest
            </div>

            <!-- Singles Grid with Lazy Skeleton Image Shimmer -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                @php
                    $displayDaters = $featuredDaters->isNotEmpty() ? $featuredDaters : collect([
                        (object)[
                            'id' => 1,
                            'full_name' => 'Priya Mehta',
                            'age' => 25,
                            'country' => 'Shimla, Himachal Pradesh',
                            'coffee_style' => 'Vanilla Oat Milk Latte',
                            'avatar_url' => 'https://images.unsplash.com/photo-1531746020798-e6953c6e8e04?w=400&q=80&fit=crop&crop=face',
                            'is_verified' => 1,
                            'formatted_member_id' => 'CD-10001'
                        ],
                        (object)[
                            'id' => 2,
                            'full_name' => 'Arjun Kapoor',
                            'age' => 27,
                            'country' => 'Pune, Maharashtra',
                            'coffee_style' => 'Double Espresso Macchiato',
                            'avatar_url' => 'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?w=400&q=80&fit=crop&crop=face',
                            'is_verified' => 1,
                            'formatted_member_id' => 'CD-10002'
                        ],
                        (object)[
                            'id' => 3,
                            'full_name' => 'Tanya Sharma',
                            'age' => 26,
                            'country' => 'Shimla, Himachal Pradesh',
                            'coffee_style' => 'Cinnamon Honey Latte',
                            'avatar_url' => 'https://images.unsplash.com/photo-1524504388940-b1c1722653e1?w=400&q=80&fit=crop&crop=face',
                            'is_verified' => 1,
                            'formatted_member_id' => 'CD-10003'
                        ],
                        (object)[
                            'id' => 4,
                            'full_name' => 'Vikram Thakur',
                            'age' => 28,
                            'country' => 'Manali, Himachal Pradesh',
                            'coffee_style' => 'French Press Dark Roast',
                            'avatar_url' => 'https://images.unsplash.com/photo-1539571696357-5a69c17a67c6?w=400&q=80&fit=crop&crop=face',
                            'is_verified' => 1,
                            'formatted_member_id' => 'CD-10004'
                        ],
                    ]);
                @endphp

                @foreach($displayDaters as $dater)
                    <div class="group relative rounded-3xl border border-[#f0d9df] bg-[#fffafc] overflow-hidden shadow-xs hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col">
                        <!-- Profile Image with Skeleton Shimmer -->
                        <div class="relative aspect-[4/5] w-full overflow-hidden img-skeleton-wrapper">
                            <img src="{{ $dater->avatar_url }}" alt="{{ $dater->full_name }}" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105" loading="lazy">
                            <div class="absolute inset-0 bg-gradient-to-t from-[#1b1b21]/80 via-transparent to-transparent z-10"></div>
                            
                            <!-- Badges -->
                            <div class="absolute top-3 left-3 z-20 flex items-center gap-1.5">
                                <span class="bg-[#1b1b21]/70 backdrop-blur-md text-white text-[10px] font-mono font-bold px-2.5 py-0.5 rounded-full">
                                    {{ $dater->formatted_member_id ?? 'CD-10001' }}
                                </span>
                            </div>

                            @if($dater->is_verified ?? true)
                                <div class="absolute top-3 right-3 z-20 w-7 h-7 rounded-full bg-[#ff6584] text-white flex items-center justify-center shadow-md" title="100% Selfie Verified">
                                    <span class="material-symbols-outlined text-sm">verified</span>
                                </div>
                            @endif

                            <!-- Name & Location Over Image -->
                            <div class="absolute bottom-3 left-3 right-3 z-20 text-white">
                                <div class="flex items-center justify-between">
                                    <h3 class="font-extrabold text-lg drop-shadow-sm">
                                        {{ explode(' ', $dater->full_name)[0] }}, {{ $dater->age ?? '25' }}
                                    </h3>
                                    <span class="text-xs text-[#ffd9dd] font-bold">★ Active</span>
                                </div>
                                <p class="text-xs text-white/80 flex items-center gap-1 mt-0.5 truncate">
                                    <span class="material-symbols-outlined text-xs">location_on</span>
                                    <span>{{ $dater->country ?? 'Himachal Pradesh' }}</span>
                                </p>
                            </div>
                        </div>

                        <!-- Card Body -->
                        <div class="p-4 flex flex-col justify-between flex-1 bg-white">
                            <div class="mb-3">
                                <span class="text-[10px] font-bold text-[#a8334e] bg-[#fff0f3] border border-[#f1b7c1] px-2.5 py-1 rounded-full inline-block truncate max-w-full">
                                    ☕ {{ $dater->coffee_style ?? 'Artisan Coffee' }}
                                </span>
                            </div>

                            <!-- Interactive Button -->
                            @guest
                                <button type="button" onclick="openQuickAuthModal('signin')" 
                                        class="w-full py-2.5 px-3 rounded-full bg-gradient-to-r from-[#ff6584] to-[#b0284b] hover:brightness-105 text-white text-xs font-extrabold shadow-sm flex items-center justify-center gap-1.5 transition active:scale-95 cursor-pointer">
                                    <span class="material-symbols-outlined text-sm">local_cafe</span>
                                    <span>Invite for Coffee</span>
                                </button>
                            @else
                                <a href="{{ route('profile', $dater->id) }}" 
                                   class="w-full py-2.5 px-3 rounded-full bg-gradient-to-r from-[#ff6584] to-[#b0284b] hover:brightness-105 text-white text-xs font-extrabold shadow-sm flex items-center justify-center gap-1.5 transition text-center">
                                    <span class="material-symbols-outlined text-sm">chat</span>
                                    <span>Say Hello</span>
                                </a>
                            @endguest
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- PROPER USER DIRECTIONS: HOW CUPDATE WORKS IN 3 STEPS -->
    <section class="border-t border-[#f0d6dc] bg-[#fbf8ff] py-16" id="how-it-works">
        <div class="mx-auto max-w-7xl px-5 sm:px-8 lg:px-12">
            <div class="text-center max-w-2xl mx-auto mb-12">
                <span class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-[#fff0f3] text-[#a8334e] border border-[#f1b7c1] mb-3">
                    <span class="material-symbols-outlined text-sm">route</span> Simple User Directions
                </span>
                <h2 class="text-3xl sm:text-4xl font-extrabold tracking-tight text-[#1b1b21]">
                    How CupDate Works in 3 Simple Steps
                </h2>
                <p class="mt-3 text-sm sm:text-base text-[#584143]">
                    No confusing algorithms or endless swiping. Here is your step-by-step path from a digital hello to a relaxed real-world coffee meetup.
                </p>
            </div>

            <div class="grid gap-8 md:grid-cols-3">
                <!-- Step 01 -->
                <div class="relative flex flex-col rounded-3xl border border-[#f2dfe0] bg-white p-8 shadow-xs transition hover:-translate-y-1 hover:shadow-md">
                    <div class="flex items-center justify-between mb-6">
                        <span class="text-4xl font-black text-[#fd748e]/40 font-mono">01</span>
                        <div class="w-12 h-12 rounded-2xl bg-[#ffd9dd] text-[#b0284b] flex items-center justify-center">
                            <span class="material-symbols-outlined text-2xl">badge</span>
                        </div>
                    </div>
                    <span class="text-xs font-bold uppercase tracking-wider text-[#a8334e] mb-1">Step One • Join &amp; Pass Check</span>
                    <h3 class="text-xl font-extrabold text-[#1b1b21] mb-3">Create Profile &amp; Selfie Pass</h3>
                    <p class="text-sm leading-6 text-[#6c595f] flex-grow">
                        Sign up free in seconds. Take a quick 3-second live selfie check to verify your identity. Choose your favorite coffee archetype (e.g. Oat Milk Latte, Cold Brew, or Espresso) and showcase your authentic passions.
                    </p>
                    <div class="mt-6 pt-4 border-t border-[#f0d9df] text-xs font-bold text-[#b0284b] flex items-center gap-1">
                        <span class="material-symbols-outlined text-base">verified</span>
                        <span>Blue verification badge awarded</span>
                    </div>
                </div>

                <!-- Step 02 -->
                <div class="relative flex flex-col rounded-3xl border border-[#f2dfe0] bg-white p-8 shadow-xs transition hover:-translate-y-1 hover:shadow-md">
                    <div class="flex items-center justify-between mb-6">
                        <span class="text-4xl font-black text-[#fd748e]/40 font-mono">02</span>
                        <div class="w-12 h-12 rounded-2xl bg-[#ffd9dd] text-[#b0284b] flex items-center justify-center">
                            <span class="material-symbols-outlined text-2xl">chat</span>
                        </div>
                    </div>
                    <span class="text-xs font-bold uppercase tracking-wider text-[#a8334e] mb-1">Step Two • Natural Discovery</span>
                    <h3 class="text-xl font-extrabold text-[#1b1b21] mb-3">Discover &amp; Spark Clean Chat</h3>
                    <p class="text-sm leading-6 text-[#6c595f] flex-grow">
                        Browse verified singles in your city or hill station. When mutual interest sparks, start a direct message with zero spam, zero aggressive bots, and full privacy. Discuss your favorite cafés, hobbies, and ideas.
                    </p>
                    <div class="mt-6 pt-4 border-t border-[#f0d9df] text-xs font-bold text-[#b0284b] flex items-center gap-1">
                        <span class="material-symbols-outlined text-base">security</span>
                        <span>Private messaging without sharing phone #</span>
                    </div>
                </div>

                <!-- Step 03 -->
                <div class="relative flex flex-col rounded-3xl border border-[#f2dfe0] bg-white p-8 shadow-xs transition hover:-translate-y-1 hover:shadow-md">
                    <div class="flex items-center justify-between mb-6">
                        <span class="text-4xl font-black text-[#fd748e]/40 font-mono">03</span>
                        <div class="w-12 h-12 rounded-2xl bg-[#ffd9dd] text-[#b0284b] flex items-center justify-center">
                            <span class="material-symbols-outlined text-2xl">local_cafe</span>
                        </div>
                    </div>
                    <span class="text-xs font-bold uppercase tracking-wider text-[#a8334e] mb-1">Step Three • The First Date</span>
                    <h3 class="text-xl font-extrabold text-[#1b1b21] mb-3">Meet for a 45-Min Coffee Date</h3>
                    <p class="text-sm leading-6 text-[#6c595f] flex-grow">
                        Choose a vetted public coffee spot (like Wake &amp; Bake, Cafe Simla Times, or Blue Tokai). Enjoy daytime public safety, 15% member savings, and a calm first conversation. If chemistry strikes, order cup number two!
                    </p>
                    <div class="mt-6 pt-4 border-t border-[#f0d9df] text-xs font-bold text-[#b0284b] flex items-center gap-1">
                        <span class="material-symbols-outlined text-base">storefront</span>
                        <span>Curated daylight cafés across India</span>
                    </div>
                </div>
            </div>

            <div class="mt-10 text-center">
                <a href="{{ route('how.it.works') }}" class="inline-flex items-center gap-2 text-sm font-bold text-[#a8334e] hover:underline">
                    <span>Read complete guide &amp; safety rules</span>
                    <span class="material-symbols-outlined text-sm">arrow_forward</span>
                </a>
            </div>
        </div>
    </section>

    <!-- EXPLORE SINGLES BY CITY (HIGH SEO VALUE & INTERNAL LINKING) -->
    <section class="border-t border-[#f0d6dc] bg-white py-16">
        <div class="mx-auto max-w-7xl px-5 sm:px-8 lg:px-12">
            <div class="flex flex-wrap items-end justify-between gap-4 mb-8">
                <div>
                    <span class="text-xs font-extrabold uppercase tracking-[.16em] text-[#a8334e]">Local Dating Chapters</span>
                    <h2 class="mt-1 text-3xl font-extrabold tracking-tight text-[#1b1b21]">
                        Explore Singles Across Himachal Pradesh &amp; India
                    </h2>
                </div>
                <a href="{{ route('cities.index') }}" class="font-bold text-[#a8334e] hover:underline flex items-center gap-1 text-sm">
                    <span>View all cities</span>
                    <span class="material-symbols-outlined text-sm">arrow_forward</span>
                </a>
            </div>

            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                <!-- Shimla -->
                <a href="{{ route('city.show', 'shimla') }}" class="group block rounded-2xl border border-[#f0d9df] bg-[#fffafc] p-5 transition hover:-translate-y-1 hover:shadow-md hover:border-[#b0284b]/40">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-xl">🏔️</span>
                        <span class="text-[10px] font-bold uppercase tracking-wider text-[#a8334e] bg-[#ffd9dd] px-2 py-0.5 rounded-full">Himachal</span>
                    </div>
                    <h3 class="font-extrabold text-base text-[#1b1b21] group-hover:text-[#b0284b] transition">Shimla</h3>
                    <p class="text-xs text-[#6c595f] mt-1">The Mall Road, The Ridge &amp; cozy pine-scented cafés like Cafe Simla Times.</p>
                </a>

                <!-- Manali -->
                <a href="{{ route('city.show', 'manali') }}" class="group block rounded-2xl border border-[#f0d9df] bg-[#fffafc] p-5 transition hover:-translate-y-1 hover:shadow-md hover:border-[#b0284b]/40">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-xl">🌲</span>
                        <span class="text-[10px] font-bold uppercase tracking-wider text-[#a8334e] bg-[#ffd9dd] px-2 py-0.5 rounded-full">Himachal</span>
                    </div>
                    <h3 class="font-extrabold text-base text-[#1b1b21] group-hover:text-[#b0284b] transition">Manali &amp; Old Manali</h3>
                    <p class="text-xs text-[#6c595f] mt-1">Riverside espresso decks, mountain trails &amp; wooden cafés along Manalsu river.</p>
                </a>

                <!-- Dharamshala -->
                <a href="{{ route('city.show', 'dharamshala') }}" class="group block rounded-2xl border border-[#f0d9df] bg-[#fffafc] p-5 transition hover:-translate-y-1 hover:shadow-md hover:border-[#b0284b]/40">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-xl">📚</span>
                        <span class="text-[10px] font-bold uppercase tracking-wider text-[#a8334e] bg-[#ffd9dd] px-2 py-0.5 rounded-full">Himachal</span>
                    </div>
                    <h3 class="font-extrabold text-base text-[#1b1b21] group-hover:text-[#b0284b] transition">Dharamshala &amp; McLeodGanj</h3>
                    <p class="text-xs text-[#6c595f] mt-1">Artisan Tibetan brews, bookshops, and soulful mountain conversations at Illiterati.</p>
                </a>

                <!-- Kangra -->
                <a href="{{ route('city.show', 'kangra') }}" class="group block rounded-2xl border border-[#f0d9df] bg-[#fffafc] p-5 transition hover:-translate-y-1 hover:shadow-md hover:border-[#b0284b]/40">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-xl">🍵</span>
                        <span class="text-[10px] font-bold uppercase tracking-wider text-[#a8334e] bg-[#ffd9dd] px-2 py-0.5 rounded-full">Himachal</span>
                    </div>
                    <h3 class="font-extrabold text-base text-[#1b1b21] group-hover:text-[#b0284b] transition">Kangra Valley</h3>
                    <p class="text-xs text-[#6c595f] mt-1">Lush terraced tea estates, historic fort walks &amp; stream-side romantic lounges.</p>
                </a>

                <!-- Solan -->
                <a href="{{ route('city.show', 'solan') }}" class="group block rounded-2xl border border-[#f0d9df] bg-[#fffafc] p-5 transition hover:-translate-y-1 hover:shadow-md hover:border-[#b0284b]/40">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-xl">🍄</span>
                        <span class="text-[10px] font-bold uppercase tracking-wider text-[#a8334e] bg-[#ffd9dd] px-2 py-0.5 rounded-full">Himachal</span>
                    </div>
                    <h3 class="font-extrabold text-base text-[#1b1b21] group-hover:text-[#b0284b] transition">Solan</h3>
                    <p class="text-xs text-[#6c595f] mt-1">Pine-scented walks, Mohan Park overlooks, and peaceful heritage dating havens.</p>
                </a>

                <!-- Chandigarh -->
                <a href="{{ route('city.show', 'chandigarh') }}" class="group block rounded-2xl border border-[#f0d9df] bg-[#fffafc] p-5 transition hover:-translate-y-1 hover:shadow-md hover:border-[#b0284b]/40">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-xl">🏙️</span>
                        <span class="text-[10px] font-bold uppercase tracking-wider text-emerald-800 bg-emerald-100 px-2 py-0.5 rounded-full">Tri-City</span>
                    </div>
                    <h3 class="font-extrabold text-base text-[#1b1b21] group-hover:text-[#b0284b] transition">Chandigarh &amp; Mohali</h3>
                    <p class="text-xs text-[#6c595f] mt-1">Sector 8 &amp; 35 coffee spots, Sukhna Lake promenades, and ambitious young singles.</p>
                </a>

                <!-- Delhi NCR -->
                <a href="{{ route('city.show', 'delhi') }}" class="group block rounded-2xl border border-[#f0d9df] bg-[#fffafc] p-5 transition hover:-translate-y-1 hover:shadow-md hover:border-[#b0284b]/40">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-xl">🏛️</span>
                        <span class="text-[10px] font-bold uppercase tracking-wider text-amber-800 bg-amber-100 px-2 py-0.5 rounded-full">Metro</span>
                    </div>
                    <h3 class="font-extrabold text-base text-[#1b1b21] group-hover:text-[#b0284b] transition">Delhi NCR</h3>
                    <p class="text-xs text-[#6c595f] mt-1">Saket, Hauz Khas Village, and specialty roasteries across Delhi and Gurgaon.</p>
                </a>

                <!-- Pune -->
                <a href="{{ route('city.show', 'pune') }}" class="group block rounded-2xl border border-[#f0d9df] bg-[#fffafc] p-5 transition hover:-translate-y-1 hover:shadow-md hover:border-[#b0284b]/40">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-xl">☕</span>
                        <span class="text-[10px] font-bold uppercase tracking-wider text-purple-800 bg-purple-100 px-2 py-0.5 rounded-full">Metro</span>
                    </div>
                    <h3 class="font-extrabold text-base text-[#1b1b21] group-hover:text-[#b0284b] transition">Pune &amp; Mumbai</h3>
                    <p class="text-xs text-[#6c595f] mt-1">Koregaon Park artisan roasters, Bandra cafés, and genuine young professionals.</p>
                </a>
            </div>
        </div>
    </section>

    <!-- EDITORIAL JOURNAL & ARTICLES -->
    @if($editorialBlogs->isNotEmpty())
        <section class="mx-auto max-w-7xl px-5 py-16 sm:px-8 lg:px-12">
            <div class="flex flex-wrap items-end justify-between gap-4 mb-8">
                <div>
                    <span class="text-xs font-extrabold uppercase tracking-[.16em] text-[#a8334e]">From the Journal</span>
                    <h2 class="mt-1 text-3xl font-extrabold tracking-tight text-[#1b1b21]">Better Dates Start Here</h2>
                </div>
                <a href="{{ route('blog.index') }}" class="font-bold text-[#a8334e] hover:underline flex items-center gap-1 text-sm">
                    <span>Read all guides</span>
                    <span class="material-symbols-outlined text-sm">arrow_forward</span>
                </a>
            </div>
            <div class="grid gap-6 md:grid-cols-3">
                @foreach($editorialBlogs as $blog)
                    <a href="{{ route('blog.show', $blog->slug) }}" class="rounded-3xl border border-[#f0d9df] bg-white p-6 transition hover:-translate-y-1 hover:shadow-xl hover:shadow-[#b0284b]/10 flex flex-col justify-between">
                        <div>
                            <span class="text-[10px] font-extrabold uppercase tracking-[.15em] text-[#a8334e]">{{ $blog->category }}</span>
                            <h3 class="mt-3 line-clamp-2 font-extrabold text-[#1b1b21] text-lg">{{ $blog->title }}</h3>
                            <p class="mt-2 line-clamp-3 text-sm leading-6 text-[#6c595f]">{{ $blog->excerpt }}</p>
                        </div>
                        <div class="mt-6 pt-4 border-t border-stone-100 flex items-center justify-between text-xs font-bold text-[#a8334e]">
                            <span>Read Article</span>
                            <span class="material-symbols-outlined text-sm">arrow_forward</span>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>
    @endif

    <!-- FREQUENTLY ASKED QUESTIONS (WITH RICH ACCORDION & GOOGLE FAQ SCHEMA) -->
    <section class="border-t border-[#f0d6dc] bg-[#fffafc] py-16">
        <div class="mx-auto max-w-4xl px-5 sm:px-8">
            <div class="text-center mb-10">
                <span class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-[#ffd9dd] text-[#a8334e] mb-3">
                    <span class="material-symbols-outlined text-sm">help</span> Frequently Asked Questions
                </span>
                <h2 class="text-3xl font-extrabold tracking-tight text-[#1b1b21]">Got Questions? We Have Answers</h2>
                <p class="mt-2 text-sm text-[#584143]">Everything you need to know about CupDate, safety, selfie verification, and coffee dating.</p>
            </div>

            <div class="space-y-3" id="homeFaqList">
                <!-- FAQ 1 -->
                <div class="rounded-2xl border border-[#f0d9df] bg-white p-5 cursor-pointer transition shadow-xs" onclick="toggleHomeFaq(this)">
                    <div class="flex items-center justify-between">
                        <h3 class="font-bold text-base text-[#1b1b21]">How is CupDate different from Tinder or Bumble?</h3>
                        <span class="material-symbols-outlined text-sm text-[#a8334e] transition-transform duration-200">expand_more</span>
                    </div>
                    <div class="faq-home-content hidden mt-3 pt-3 border-t border-stone-100 text-xs sm:text-sm text-[#584143] leading-relaxed">
                        Traditional apps encourage endless superficial swiping, ghosting, and expensive 2-hour dinners. CupDate is designed around intentional, low-pressure 45-minute coffee dates at verified public cafés. Every profile is 100% selfie-verified, and we do not use addictive casino algorithms.
                    </div>
                </div>

                <!-- FAQ 2 -->
                <div class="rounded-2xl border border-[#f0d9df] bg-white p-5 cursor-pointer transition shadow-xs" onclick="toggleHomeFaq(this)">
                    <div class="flex items-center justify-between">
                        <h3 class="font-bold text-base text-[#1b1b21]">Is CupDate free to join and chat?</h3>
                        <span class="material-symbols-outlined text-sm text-[#a8334e] transition-transform duration-200">expand_more</span>
                    </div>
                    <div class="faq-home-content hidden mt-3 pt-3 border-t border-stone-100 text-xs sm:text-sm text-[#584143] leading-relaxed">
                        Yes! Free registration, identity verification, discovering singles, and direct one-on-one chatting are available to all genuine singles. There are no paywalls preventing you from having a great conversation and meeting for coffee.
                    </div>
                </div>

                <!-- FAQ 3 -->
                <div class="rounded-2xl border border-[#f0d9df] bg-white p-5 cursor-pointer transition shadow-xs" onclick="toggleHomeFaq(this)">
                    <div class="flex items-center justify-between">
                        <h3 class="font-bold text-base text-[#1b1b21]">How does the 3-second live selfie check protect members?</h3>
                        <span class="material-symbols-outlined text-sm text-[#a8334e] transition-transform duration-200">expand_more</span>
                    </div>
                    <div class="faq-home-content hidden mt-3 pt-3 border-t border-stone-100 text-xs sm:text-sm text-[#584143] leading-relaxed">
                        When creating an account, members record a quick 3-second live selfie pose. Our biometric security compares the live pose with uploaded profile photos to confirm true ownership. This completely eliminates catfishes, stolen photos, and automated scam bots.
                    </div>
                </div>

                <!-- FAQ 4 -->
                <div class="rounded-2xl border border-[#f0d9df] bg-white p-5 cursor-pointer transition shadow-xs" onclick="toggleHomeFaq(this)">
                    <div class="flex items-center justify-between">
                        <h3 class="font-bold text-base text-[#1b1b21]">Can I use CupDate for serious matrimony and traditional rishta?</h3>
                        <span class="material-symbols-outlined text-sm text-[#a8334e] transition-transform duration-200">expand_more</span>
                    </div>
                    <div class="faq-home-content hidden mt-3 pt-3 border-t border-stone-100 text-xs sm:text-sm text-[#584143] leading-relaxed">
                        Yes. CupDate offers a dedicated Rishta &amp; Serious Matrimony portal for singles and families seeking long-term life partners without awkward arranged-marriage interrogations. A comfortable 45-minute coffee chat provides the perfect balance of modern respect and deep values alignment.
                    </div>
                </div>

                <!-- FAQ 5 -->
                <div class="rounded-2xl border border-[#f0d9df] bg-white p-5 cursor-pointer transition shadow-xs" onclick="toggleHomeFaq(this)">
                    <div class="flex items-center justify-between">
                        <h3 class="font-bold text-base text-[#1b1b21]">Which cities and hill stations in Himachal Pradesh are active?</h3>
                        <span class="material-symbols-outlined text-sm text-[#a8334e] transition-transform duration-200">expand_more</span>
                    </div>
                    <div class="faq-home-content hidden mt-3 pt-3 border-t border-stone-100 text-xs sm:text-sm text-[#584143] leading-relaxed">
                        CupDate is active across all 12 districts of Himachal Pradesh — including Shimla, Manali, Dharamshala, McLeodGanj, Kangra, Solan, Mandi, Kullu, Palampur, and Hamirpur — as well as Chandigarh Tri-City, Delhi NCR, Pune, and Mumbai.
                    </div>
                </div>
            </div>

            <div class="mt-8 text-center">
                <a href="{{ route('faq') }}" class="text-xs font-bold text-[#a8334e] hover:underline">
                    View full FAQ &amp; help center →
                </a>
            </div>
        </div>
    </section>

    <!-- FINAL CTA CALLOUT -->
    <section class="border-t border-[#f0d6dc] bg-gradient-to-br from-[#fff0f3] to-white py-16 text-center">
        <div class="mx-auto max-w-3xl px-5">
            <span class="text-3xl mb-2 inline-block">☕</span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-[#1b1b21]">Ready for a Better First Date?</h2>
            <p class="mt-3 text-sm sm:text-base text-[#584143] max-w-xl mx-auto">
                Join thousands of verified singles who value authentic conversation, great coffee, and genuine connections.
            </p>
            <div class="mt-8 flex flex-wrap justify-center gap-3">
                @guest
                    <button type="button" onclick="openQuickAuthModal('register')" 
                            class="px-8 py-4 rounded-full bg-gradient-to-r from-[#ff6584] via-[#fd748e] to-[#b0284b] hover:brightness-105 text-white font-extrabold text-sm shadow-lg shadow-[#ff6584]/30 transition hover:-translate-y-0.5 active:scale-95 cursor-pointer">
                        Create Your Free Profile ♥
                    </button>
                    <button type="button" onclick="openQuickAuthModal('signin')" 
                            class="px-8 py-4 rounded-full border border-[#dfbfc2] bg-white text-[#a8334e] font-extrabold text-sm hover:bg-[#fff0f3] transition active:scale-95 cursor-pointer">
                        Sign In
                    </button>
                @else
                    <a href="{{ route('swipes') }}" class="px-8 py-4 rounded-full bg-gradient-to-r from-[#ff6584] via-[#fd748e] to-[#b0284b] hover:brightness-105 text-white font-extrabold text-sm shadow-lg shadow-[#ff6584]/30 transition hover:-translate-y-0.5">
                        Discover Deck →
                    </a>
                @endguest
            </div>
        </div>
    </section>
</div>

<!-- RICH JSON-LD SCHEMAS (GOOGLE BEST SEO) -->
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@graph": [
    {
      "@type": "WebSite",
      "@id": "{{ url('/') }}#website",
      "url": "{{ url('/') }}",
      "name": "CupDate",
      "description": "Genuine intentional dating, online chat, and verified 45-minute coffee dates across Himachal Pradesh and India.",
      "potentialAction": {
        "@type": "SearchAction",
        "target": "{{ url('/cities') }}?q={search_term_string}",
        "query-input": "required name=search_term_string"
      }
    },
    {
      "@type": "Organization",
      "@id": "{{ url('/') }}#organization",
      "name": "CupDate",
      "url": "{{ url('/') }}",
      "logo": "{{ asset('assets/images/cupdate_logo.svg') }}",
      "description": "India's premier 100% selfie-verified intentional coffee dating and matchmaking platform.",
      "areaServed": [
        "Himachal Pradesh",
        "Chandigarh",
        "Punjab",
        "Delhi NCR",
        "Maharashtra",
        "India"
      ]
    },
    {
      "@type": "FAQPage",
      "@id": "{{ url('/') }}#faq",
      "mainEntity": [
        {
          "@type": "Question",
          "name": "How is CupDate different from Tinder or Bumble?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "CupDate is designed around intentional, low-pressure 45-minute coffee dates at verified public cafés. Every profile is 100% selfie-verified without addictive casino swipe algorithms."
          }
        },
        {
          "@type": "Question",
          "name": "Is CupDate free to join and chat?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Yes, free account registration, identity verification, discovering singles, and direct chatting are available to all genuine singles."
          }
        },
        {
          "@type": "Question",
          "name": "How does the 3-second live selfie check protect members?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Our biometric security compares the 3-second live selfie pose with uploaded photos to confirm account ownership, eliminating catfishes, stolen photos, and scam bots."
          }
        },
        {
          "@type": "Question",
          "name": "Can I use CupDate for serious matrimony and traditional rishta?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Yes. CupDate offers a dedicated Rishta & Serious Matrimony portal for singles seeking long-term intentional partnerships over a relaxed 45-minute coffee chat."
          }
        },
        {
          "@type": "Question",
          "name": "Which cities and hill stations in Himachal Pradesh are active?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "CupDate is active across all 12 districts of Himachal Pradesh — including Shimla, Manali, Dharamshala, McLeodGanj, Kangra, Solan, Mandi, Kullu, Palampur, and Hamirpur."
          }
        }
      ]
    }
  ]
}
</script>

<script>
function toggleHomeFaq(item) {
    const content = item.querySelector('.faq-home-content');
    const icon = item.querySelector('.material-symbols-outlined');
    if (content) {
        content.classList.toggle('hidden');
    }
    if (icon) {
        icon.classList.toggle('rotate-180');
    }
}
</script>
@endsection
