@extends('layouts.app')

@section('title', 'CupDate — Verified Dating & 45-Minute Coffee Dates in India')
@section('meta_desc', 'Meet verified singles in Himachal Pradesh, Punjab, Chandigarh, Delhi NCR & major cities. CupDate makes dating authentic, safe, and relaxed with 45-minute coffee dates.')

@section('content')
<div class="cupdate-home min-h-screen bg-[#fff9fa] text-[#1b1b21]">

    <!-- HERO SECTION -->
    <section class="relative overflow-hidden pt-8 pb-14 sm:pt-14 sm:pb-20 lg:pt-18 lg:pb-24 border-b border-[#f1d8de]/60">
        <!-- Soft Ambient Glow -->
        <div class="pointer-events-none absolute -top-24 -left-20 w-80 h-80 sm:w-96 sm:h-96 rounded-full bg-[#ffdce2]/50 blur-3xl"></div>
        <div class="pointer-events-none absolute top-12 -right-20 w-80 h-80 sm:w-96 sm:h-96 rounded-full bg-[#ffe8ec]/60 blur-3xl"></div>

        <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid items-center gap-10 lg:grid-cols-12 lg:gap-12">
                
                <!-- Left Column: High-Impact Hero Copy -->
                <div class="lg:col-span-7">
                    @auth
                        <!-- Logged-in User Quick Dashboard Bar -->
                        <div class="mb-6 p-4 rounded-2xl bg-white/90 border border-[#f1b7c1]/60 shadow-xs flex flex-wrap items-center justify-between gap-3 backdrop-blur-sm">
                            <div class="flex items-center gap-3">
                                <img src="{{ Auth::user()->avatar_url }}" alt="{{ Auth::user()->full_name }}" class="w-10 h-10 rounded-full object-cover ring-2 ring-[#b0284b] shadow-xs">
                                <div>
                                    <div class="flex items-center gap-2">
                                        <h3 class="font-bold text-sm text-[#1b1b21]">Welcome back, {{ explode(' ', Auth::user()->full_name)[0] }}!</h3>
                                        <span class="text-[10px] bg-emerald-100 text-emerald-800 px-2 py-0.5 rounded-full font-bold">Online</span>
                                    </div>
                                    <p class="text-xs text-[#6e585b]">Direct shortcuts to your feed &amp; singles.</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                <a href="{{ route('feed') }}" class="px-3.5 py-1.5 rounded-full bg-[#b0284b] text-white text-xs font-bold hover:bg-[#97223f] transition">Coffee Feed</a>
                                <a href="{{ route('swipes') }}" class="px-3.5 py-1.5 rounded-full border border-[#dfbfc2] bg-white text-[#a8334e] text-xs font-bold hover:bg-[#fff0f3] transition">Discover</a>
                                <a href="{{ route('messages') }}" class="px-3.5 py-1.5 rounded-full border border-[#dfbfc2] bg-white text-blue-600 text-xs font-bold hover:bg-blue-50 transition">Chats</a>
                            </div>
                        </div>
                    @endauth

                    <!-- Live Real-Time Activity Pill -->
                    <div class="mb-5 flex flex-wrap items-center gap-2">
                        <div class="inline-flex items-center gap-2 rounded-full border border-emerald-200 bg-emerald-50 px-3.5 py-1 text-xs font-bold text-emerald-900 shadow-2xs">
                            <span class="relative flex h-2 w-2">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                            </span>
                            <span id="liveOnlineCount" class="font-extrabold font-mono text-emerald-950">1,492</span>
                            <span>Singles Online in India</span>
                        </div>

                        <span class="inline-flex items-center gap-1.5 rounded-full border border-[#f1b7c1] bg-white px-3 py-1 text-xs font-bold text-[#a8334e]">
                            <svg class="w-3.5 h-3.5 text-[#ff6584]" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>
                            <span>100% Selfie Verified</span>
                        </span>

                        <span class="hidden sm:inline-flex items-center gap-1.5 rounded-full border border-amber-200 bg-amber-50 px-3 py-1 text-xs font-bold text-amber-900">
                            <span>☕ 840+ Coffee Dates</span>
                        </span>
                    </div>

                    <h1 class="text-4xl font-black leading-[1.08] tracking-tight sm:text-5xl lg:text-6xl text-[#1b1b21]">
                        Dating Built for
                        <span class="relative inline-block text-[#b0284b]">
                            Genuine Chemistry,
                            <span class="absolute -bottom-1 left-0 h-1.5 w-full rounded-full bg-[#ff738e]/40"></span>
                        </span>
                        Not Endless Swipes.
                    </h1>

                    <p class="mt-5 max-w-xl text-base leading-relaxed text-[#5c474a] sm:text-lg">
                        Skip the exhausting texting cycles and fake profiles. Meet selfie-verified singles for relaxed, low-pressure 45-minute coffee dates at curated public cafés.
                    </p>

                    <!-- Primary Actions -->
                    <div class="mt-8 flex flex-wrap items-center gap-3">
                        @guest
                            <button type="button" onclick="openQuickAuthModal('register')" 
                                    class="inline-flex items-center justify-center gap-2 rounded-full bg-gradient-to-r from-[#ff6584] via-[#fd748e] to-[#b0284b] px-7 py-3.5 text-sm font-extrabold text-white shadow-md shadow-[#ff6584]/25 hover:brightness-105 active:scale-95 transition cursor-pointer">
                                <span>Start Meeting Singles</span>
                                <span aria-hidden="true">♥</span>
                            </button>
                            <button type="button" onclick="openQuickAuthModal('signin')" 
                                    class="inline-flex items-center justify-center gap-2 rounded-full border border-[#dfbfc2] bg-white px-7 py-3.5 text-sm font-extrabold text-[#a8334e] hover:bg-[#fff0f3] active:scale-95 transition cursor-pointer">
                                <span>Sign In</span>
                            </button>
                        @else
                            <a href="{{ route('feed') }}" class="inline-flex items-center justify-center gap-2 rounded-full bg-gradient-to-r from-[#ff6584] to-[#b0284b] px-7 py-3.5 text-sm font-extrabold text-white shadow-md shadow-[#ff6584]/25 hover:brightness-105 active:scale-95 transition">
                                <span>Enter Coffee Feed</span>
                                <span aria-hidden="true">&rarr;</span>
                            </a>
                            <a href="{{ route('swipes') }}" class="inline-flex items-center justify-center gap-2 rounded-full border border-[#dfbfc2] bg-white px-6 py-3.5 text-sm font-extrabold text-[#a8334e] hover:bg-[#fff0f3] active:scale-95 transition">
                                <span>Discover Matches</span>
                            </a>
                        @endguest
                        <a href="{{ route('cities.index') }}" class="inline-flex items-center justify-center gap-1.5 rounded-full border border-stone-200 bg-white px-5 py-3.5 text-xs font-bold text-[#5c474a] hover:bg-stone-50 transition">
                            <span>Browse 100+ Cities</span>
                        </a>
                    </div>

                    <!-- Live Community Activity Ticker -->
                    <div class="mt-6 p-3 rounded-2xl bg-white border border-[#f1b7c1]/50 shadow-2xs flex items-center gap-2.5 max-w-xl text-xs text-[#5c474a]">
                        <span class="shrink-0 w-6 h-6 rounded-lg bg-[#fff0f3] text-[#b0284b] flex items-center justify-center font-bold">⚡</span>
                        <div id="liveActivityTicker" class="truncate font-semibold transition-opacity duration-300">
                            🟢 Simran from Shimla just verified her profile (2m ago)
                        </div>
                        <span class="ml-auto shrink-0 text-[10px] font-mono font-bold text-emerald-800 bg-emerald-50 px-2 py-0.5 rounded-full border border-emerald-200">LIVE</span>
                    </div>

                    <!-- Feature Checkmarks -->
                    <div class="mt-6 flex flex-wrap gap-x-6 gap-y-2 text-xs font-bold text-[#6e585b]">
                        <span class="inline-flex items-center gap-1.5"><span class="text-emerald-600 font-bold">✓</span> 100% Real Selfie Profiles</span>
                        <span class="inline-flex items-center gap-1.5"><span class="text-emerald-600 font-bold">✓</span> Zero Fake Bots &amp; Spam</span>
                        <span class="inline-flex items-center gap-1.5"><span class="text-emerald-600 font-bold">✓</span> Low-Pressure 45-Min Dates</span>
                    </div>
                </div>

                <!-- Right Column: Visual Card Deck Showcase -->
                <div class="lg:col-span-5">
                    <div class="relative mx-auto max-w-md">
                        <div class="relative rounded-3xl border-4 border-white bg-white shadow-xl overflow-hidden">
                            <!-- Card Visual -->
                            <div class="relative aspect-[4/3] bg-gradient-to-br from-[#ffdce2] via-[#fff0f3] to-white overflow-hidden">
                                <img src="{{ asset('assets/images/hero_couple_4.png') }}" alt="Couple enjoying coffee date on CupDate" class="w-full h-full object-cover" loading="eager" onerror="this.src='https://images.unsplash.com/photo-1522263842439-347f0722f2ff?w=600&q=80&fit=crop'">
                                <div class="absolute inset-0 bg-gradient-to-t from-[#1b1b21]/80 via-transparent to-transparent"></div>
                                <div class="absolute top-4 left-4 z-10 flex items-center gap-1.5 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-[11px] font-bold text-[#b0284b] shadow-2xs">
                                    <span>☕ Daylight Coffee Dates</span>
                                </div>
                                <div class="absolute bottom-4 left-4 right-4 z-10 text-white">
                                    <p class="text-xs font-bold uppercase tracking-wider text-[#ffd9dd]">Intentional Dating</p>
                                    <p class="text-lg font-black mt-0.5">Start with a real hello.</p>
                                </div>
                            </div>
                            <!-- Card Quick Stats Bar -->
                            <div class="grid grid-cols-3 divide-x divide-stone-100 bg-white p-3.5 text-center">
                                <div>
                                    <p class="text-base font-black text-[#b0284b]">100%</p>
                                    <p class="text-[10px] font-bold uppercase text-[#735d60]">Verified</p>
                                </div>
                                <div>
                                    <p class="text-base font-black text-[#b0284b]">1:1</p>
                                    <p class="text-[10px] font-bold uppercase text-[#735d60]">Direct Chat</p>
                                </div>
                                <div>
                                    <p class="text-base font-black text-[#b0284b]">45 min</p>
                                    <p class="text-[10px] font-bold uppercase text-[#735d60]">Coffee Dates</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- VERIFIED SINGLES CARDS PREVIEW -->
    <section class="py-14 sm:py-18 bg-white border-b border-[#f1d8de]/60" id="singles">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex flex-wrap items-end justify-between gap-4 mb-8">
                <div>
                    <span class="inline-flex items-center gap-1 px-3 py-0.5 rounded-full text-xs font-bold uppercase tracking-wider bg-[#fff0f3] text-[#a8334e] border border-[#f1b7c1] mb-2">
                        ★ Verified Singles Ready for Coffee
                    </span>
                    <h2 class="text-2xl sm:text-3xl font-black text-[#1b1b21] tracking-tight">
                        Real Singles in Your City
                    </h2>
                    <p class="text-xs sm:text-sm text-[#5c474a] mt-1">
                        Selfie-verified profiles looking for intentional connection across Himachal Pradesh, Punjab, and major Indian cities.
                    </p>
                </div>
                @guest
                    <button type="button" onclick="openQuickAuthModal('register')" class="text-xs sm:text-sm font-bold text-[#b0284b] hover:underline flex items-center gap-1 cursor-pointer">
                        <span>Join &amp; Say Hello</span>
                        <span>&rarr;</span>
                    </button>
                @else
                    <a href="{{ route('swipes') }}" class="text-xs sm:text-sm font-bold text-[#b0284b] hover:underline flex items-center gap-1">
                        <span>Explore Full Deck</span>
                        <span>&rarr;</span>
                    </a>
                @endguest
            </div>

            <!-- Singles Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-5">
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
                    <div class="group relative rounded-2xl border border-[#f0d9df] bg-white overflow-hidden shadow-2xs hover:shadow-md hover:-translate-y-0.5 transition-all flex flex-col">
                        <!-- Profile Image -->
                        <div class="relative aspect-[4/5] w-full overflow-hidden bg-stone-100">
                            <img src="{{ $dater->avatar_url }}" alt="{{ $dater->full_name }}" class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-105" loading="lazy">
                            <div class="absolute inset-0 bg-gradient-to-t from-[#1b1b21]/75 via-transparent to-transparent z-10"></div>
                            
                            <!-- Badges -->
                            <div class="absolute top-2.5 left-2.5 z-20">
                                <span class="bg-[#1b1b21]/70 backdrop-blur-xs text-white text-[10px] font-mono font-bold px-2 py-0.5 rounded-full">
                                    {{ $dater->formatted_member_id ?? 'CD-10001' }}
                                </span>
                            </div>

                            @if($dater->is_verified ?? true)
                                <div class="absolute top-2.5 right-2.5 z-20 w-6 h-6 rounded-full bg-[#ff6584] text-white flex items-center justify-center shadow-xs" title="Selfie Verified">
                                    <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>
                                </div>
                            @endif

                            <!-- Name & Location Over Image -->
                            <div class="absolute bottom-2.5 left-2.5 right-2.5 z-20 text-white">
                                <h3 class="font-black text-base drop-shadow-xs">
                                    {{ explode(' ', $dater->full_name)[0] }}, {{ $dater->age ?? '25' }}
                                </h3>
                                <p class="text-xs text-white/85 truncate mt-0.5">
                                    📍 {{ $dater->country ?? 'Himachal Pradesh' }}
                                </p>
                            </div>
                        </div>

                        <!-- Card Body -->
                        <div class="p-3.5 flex flex-col justify-between flex-1 bg-white">
                            <div class="mb-3">
                                <span class="text-[10px] font-bold text-[#a8334e] bg-[#fff0f3] border border-[#f1b7c1] px-2 py-0.5 rounded-full inline-block truncate max-w-full">
                                    ☕ {{ $dater->coffee_style ?? 'Artisan Coffee' }}
                                </span>
                            </div>

                            @guest
                                <button type="button" onclick="openQuickAuthModal('signin')" 
                                        class="w-full py-2 px-3 rounded-full bg-[#b0284b] hover:bg-[#97223f] text-white text-xs font-bold shadow-2xs flex items-center justify-center gap-1 transition active:scale-95 cursor-pointer">
                                    <span>Invite for Coffee</span>
                                </button>
                            @else
                                <a href="{{ route('profile', $dater->id) }}" 
                                   class="w-full py-2 px-3 rounded-full bg-[#b0284b] hover:bg-[#97223f] text-white text-xs font-bold shadow-2xs flex items-center justify-center gap-1 transition text-center">
                                    <span>Say Hello</span>
                                </a>
                            @endguest
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- HOW IT WORKS IN 3 SIMPLE STEPS -->
    <section class="py-14 sm:py-18 bg-[#fff9fa] border-b border-[#f1d8de]/60" id="how-it-works">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-10">
                <span class="inline-flex items-center gap-1 px-3 py-0.5 rounded-full text-xs font-bold uppercase tracking-wider bg-[#fff0f3] text-[#a8334e] border border-[#f1b7c1] mb-2">
                    How CupDate Works
                </span>
                <h2 class="text-2xl sm:text-3xl font-black text-[#1b1b21] tracking-tight">
                    3 Simple Steps from Hello to Coffee
                </h2>
                <p class="mt-2 text-xs sm:text-sm text-[#5c474a]">
                    No confusing algorithms or ghosting games. Pure, honest dating built around genuine conversation.
                </p>
            </div>

            <div class="grid gap-6 md:grid-cols-3">
                <!-- Step 1 -->
                <div class="rounded-2xl border border-[#f0d9df] bg-white p-6 shadow-2xs flex flex-col">
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-3xl font-black text-[#fd748e]/40 font-mono">01</span>
                        <div class="w-10 h-10 rounded-xl bg-[#ffd9dd] text-[#b0284b] flex items-center justify-center font-bold text-lg">
                            ✓
                        </div>
                    </div>
                    <span class="text-[11px] font-bold uppercase tracking-wider text-[#a8334e] mb-1">Step 1 • Profile Setup</span>
                    <h3 class="text-lg font-black text-[#1b1b21] mb-2">Create Profile &amp; Selfie Pass</h3>
                    <p class="text-xs sm:text-sm leading-relaxed text-[#6e585b] flex-grow">
                        Sign up free in seconds. Complete a quick 3-second live selfie check to verify your photo ownership. Choose your coffee archetype and set honest intentions.
                    </p>
                    <div class="mt-4 pt-3 border-t border-[#f0d9df] text-xs font-bold text-[#b0284b]">
                        ✓ Blue verification badge awarded
                    </div>
                </div>

                <!-- Step 2 -->
                <div class="rounded-2xl border border-[#f0d9df] bg-white p-6 shadow-2xs flex flex-col">
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-3xl font-black text-[#fd748e]/40 font-mono">02</span>
                        <div class="w-10 h-10 rounded-xl bg-[#ffd9dd] text-[#b0284b] flex items-center justify-center font-bold text-lg">
                            💬
                        </div>
                    </div>
                    <span class="text-[11px] font-bold uppercase tracking-wider text-[#a8334e] mb-1">Step 2 • Clean Messaging</span>
                    <h3 class="text-lg font-black text-[#1b1b21] mb-2">Discover &amp; Spark Clean Chat</h3>
                    <p class="text-xs sm:text-sm leading-relaxed text-[#6e585b] flex-grow">
                        Browse verified singles in your city or hill station. Start a direct conversation with zero spam, zero automated bots, and full privacy without revealing phone numbers.
                    </p>
                    <div class="mt-4 pt-3 border-t border-[#f0d9df] text-xs font-bold text-[#b0284b]">
                        🔒 100% Private, spam-free chats
                    </div>
                </div>

                <!-- Step 3 -->
                <div class="rounded-2xl border border-[#f0d9df] bg-white p-6 shadow-2xs flex flex-col">
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-3xl font-black text-[#fd748e]/40 font-mono">03</span>
                        <div class="w-10 h-10 rounded-xl bg-[#ffd9dd] text-[#b0284b] flex items-center justify-center font-bold text-lg">
                            ☕
                        </div>
                    </div>
                    <span class="text-[11px] font-bold uppercase tracking-wider text-[#a8334e] mb-1">Step 3 • The First Date</span>
                    <h3 class="text-lg font-black text-[#1b1b21] mb-2">Meet for a 45-Min Coffee Date</h3>
                    <p class="text-xs sm:text-sm leading-relaxed text-[#6e585b] flex-grow">
                        Choose a vetted public café (like Wake &amp; Bake, Cafe Simla Times, or Blue Tokai). Enjoy daytime public safety, low pressure, and real conversation.
                    </p>
                    <div class="mt-4 pt-3 border-t border-[#f0d9df] text-xs font-bold text-[#b0284b]">
                        ☕ Curated daylight public café spots
                    </div>
                </div>
            </div>

            <div class="mt-8 text-center">
                <a href="{{ route('how.it.works') }}" class="inline-flex items-center gap-1.5 text-xs sm:text-sm font-bold text-[#a8334e] hover:underline">
                    <span>Read complete guide &amp; safety rules</span>
                    <span>&rarr;</span>
                </a>
            </div>
        </div>
    </section>

    <!-- EXPLORE SINGLES BY CITY (HIGH SEO VALUE) -->
    <section class="py-14 sm:py-18 bg-white border-b border-[#f1d8de]/60">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex flex-wrap items-end justify-between gap-4 mb-8">
                <div>
                    <span class="text-xs font-extrabold uppercase tracking-wider text-[#a8334e]">Local Dating Chapters</span>
                    <h2 class="mt-1 text-2xl sm:text-3xl font-black text-[#1b1b21] tracking-tight">
                        Explore Singles Across Himachal Pradesh &amp; India
                    </h2>
                </div>
                <a href="{{ route('cities.index') }}" class="font-bold text-[#a8334e] hover:underline flex items-center gap-1 text-xs sm:text-sm">
                    <span>View all cities</span>
                    <span>&rarr;</span>
                </a>
            </div>

            <div class="grid gap-3 sm:grid-cols-2 lg:grid-cols-4">
                <!-- Shimla -->
                <a href="{{ route('city.show', 'shimla') }}" class="group block rounded-2xl border border-[#f0d9df] bg-[#fffafc] p-4 transition hover:-translate-y-0.5 hover:shadow-xs hover:border-[#b0284b]/40">
                    <div class="flex items-center justify-between mb-1.5">
                        <span class="text-lg">🏔️</span>
                        <span class="text-[10px] font-bold uppercase text-[#a8334e] bg-[#ffd9dd] px-2 py-0.5 rounded-full">Himachal</span>
                    </div>
                    <h3 class="font-black text-sm sm:text-base text-[#1b1b21] group-hover:text-[#b0284b] transition">Shimla</h3>
                    <p class="text-xs text-[#6e585b] mt-1">The Mall Road, The Ridge &amp; cozy pine-scented cafés.</p>
                </a>

                <!-- Manali -->
                <a href="{{ route('city.show', 'manali') }}" class="group block rounded-2xl border border-[#f0d9df] bg-[#fffafc] p-4 transition hover:-translate-y-0.5 hover:shadow-xs hover:border-[#b0284b]/40">
                    <div class="flex items-center justify-between mb-1.5">
                        <span class="text-lg">🌲</span>
                        <span class="text-[10px] font-bold uppercase text-[#a8334e] bg-[#ffd9dd] px-2 py-0.5 rounded-full">Himachal</span>
                    </div>
                    <h3 class="font-black text-sm sm:text-base text-[#1b1b21] group-hover:text-[#b0284b] transition">Manali &amp; Old Manali</h3>
                    <p class="text-xs text-[#6e585b] mt-1">Riverside espresso decks &amp; wooden cafés along Manalsu.</p>
                </a>

                <!-- Dharamshala -->
                <a href="{{ route('city.show', 'dharamshala') }}" class="group block rounded-2xl border border-[#f0d9df] bg-[#fffafc] p-4 transition hover:-translate-y-0.5 hover:shadow-xs hover:border-[#b0284b]/40">
                    <div class="flex items-center justify-between mb-1.5">
                        <span class="text-lg">📚</span>
                        <span class="text-[10px] font-bold uppercase text-[#a8334e] bg-[#ffd9dd] px-2 py-0.5 rounded-full">Himachal</span>
                    </div>
                    <h3 class="font-black text-sm sm:text-base text-[#1b1b21] group-hover:text-[#b0284b] transition">Dharamshala &amp; McLeodGanj</h3>
                    <p class="text-xs text-[#6e585b] mt-1">Artisan brews, bookshops, and mountain conversations.</p>
                </a>

                <!-- Chandigarh -->
                <a href="{{ route('city.show', 'chandigarh') }}" class="group block rounded-2xl border border-[#f0d9df] bg-[#fffafc] p-4 transition hover:-translate-y-0.5 hover:shadow-xs hover:border-[#b0284b]/40">
                    <div class="flex items-center justify-between mb-1.5">
                        <span class="text-lg">🏙️</span>
                        <span class="text-[10px] font-bold uppercase text-emerald-800 bg-emerald-100 px-2 py-0.5 rounded-full">Tri-City</span>
                    </div>
                    <h3 class="font-black text-sm sm:text-base text-[#1b1b21] group-hover:text-[#b0284b] transition">Chandigarh &amp; Mohali</h3>
                    <p class="text-xs text-[#6e585b] mt-1">Sector 8 &amp; 35 spots, Sukhna Lake &amp; young singles.</p>
                </a>

                <!-- Delhi NCR -->
                <a href="{{ route('city.show', 'delhi') }}" class="group block rounded-2xl border border-[#f0d9df] bg-[#fffafc] p-4 transition hover:-translate-y-0.5 hover:shadow-xs hover:border-[#b0284b]/40">
                    <div class="flex items-center justify-between mb-1.5">
                        <span class="text-lg">🏛️</span>
                        <span class="text-[10px] font-bold uppercase text-amber-800 bg-amber-100 px-2 py-0.5 rounded-full">Metro</span>
                    </div>
                    <h3 class="font-black text-sm sm:text-base text-[#1b1b21] group-hover:text-[#b0284b] transition">Delhi NCR</h3>
                    <p class="text-xs text-[#6e585b] mt-1">Saket, HKV &amp; specialty roasteries across Delhi and Gurgaon.</p>
                </a>

                <!-- Pune -->
                <a href="{{ route('city.show', 'pune') }}" class="group block rounded-2xl border border-[#f0d9df] bg-[#fffafc] p-4 transition hover:-translate-y-0.5 hover:shadow-xs hover:border-[#b0284b]/40">
                    <div class="flex items-center justify-between mb-1.5">
                        <span class="text-lg">☕</span>
                        <span class="text-[10px] font-bold uppercase text-purple-800 bg-purple-100 px-2 py-0.5 rounded-full">Metro</span>
                    </div>
                    <h3 class="font-black text-sm sm:text-base text-[#1b1b21] group-hover:text-[#b0284b] transition">Pune &amp; Mumbai</h3>
                    <p class="text-xs text-[#6e585b] mt-1">Koregaon Park roasters, Bandra cafés &amp; genuine singles.</p>
                </a>

                <!-- Solan -->
                <a href="{{ route('city.show', 'solan') }}" class="group block rounded-2xl border border-[#f0d9df] bg-[#fffafc] p-4 transition hover:-translate-y-0.5 hover:shadow-xs hover:border-[#b0284b]/40">
                    <div class="flex items-center justify-between mb-1.5">
                        <span class="text-lg">🍄</span>
                        <span class="text-[10px] font-bold uppercase text-[#a8334e] bg-[#ffd9dd] px-2 py-0.5 rounded-full">Himachal</span>
                    </div>
                    <h3 class="font-black text-sm sm:text-base text-[#1b1b21] group-hover:text-[#b0284b] transition">Solan</h3>
                    <p class="text-xs text-[#6e585b] mt-1">Pine walks, Mohan Park overlooks &amp; peaceful dating havens.</p>
                </a>

                <!-- Bangalore -->
                <a href="{{ route('city.show', 'bangalore') }}" class="group block rounded-2xl border border-[#f0d9df] bg-[#fffafc] p-4 transition hover:-translate-y-0.5 hover:shadow-xs hover:border-[#b0284b]/40">
                    <div class="flex items-center justify-between mb-1.5">
                        <span class="text-lg">💻</span>
                        <span class="text-[10px] font-bold uppercase text-indigo-800 bg-indigo-100 px-2 py-0.5 rounded-full">Metro</span>
                    </div>
                    <h3 class="font-black text-sm sm:text-base text-[#1b1b21] group-hover:text-[#b0284b] transition">Bangalore</h3>
                    <p class="text-xs text-[#6e585b] mt-1">Indiranagar &amp; Koramangala filter coffee and specialty roasts.</p>
                </a>
            </div>
        </div>
    </section>

    <!-- EDITORIAL JOURNAL & ARTICLES -->
    @if($editorialBlogs->isNotEmpty())
        <section class="py-14 sm:py-18 bg-[#fff9fa] border-b border-[#f1d8de]/60">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex flex-wrap items-end justify-between gap-4 mb-8">
                    <div>
                        <span class="text-xs font-extrabold uppercase tracking-wider text-[#a8334e]">From the Journal</span>
                        <h2 class="mt-1 text-2xl sm:text-3xl font-black text-[#1b1b21] tracking-tight">Better Dates Start Here</h2>
                    </div>
                    <a href="{{ route('blog.index') }}" class="font-bold text-[#a8334e] hover:underline flex items-center gap-1 text-xs sm:text-sm">
                        <span>Read all guides</span>
                        <span>&rarr;</span>
                    </a>
                </div>
                <div class="grid gap-6 md:grid-cols-3">
                    @foreach($editorialBlogs as $blog)
                        <a href="{{ route('blog.show', $blog->slug) }}" class="rounded-2xl border border-[#f0d9df] bg-white p-5 transition hover:-translate-y-0.5 hover:shadow-md flex flex-col justify-between">
                            <div>
                                <span class="text-[10px] font-extrabold uppercase tracking-wider text-[#a8334e]">{{ $blog->category }}</span>
                                <h3 class="mt-2 line-clamp-2 font-black text-[#1b1b21] text-base">{{ $blog->title }}</h3>
                                <p class="mt-1.5 line-clamp-3 text-xs leading-relaxed text-[#6e585b]">{{ $blog->excerpt }}</p>
                            </div>
                            <div class="mt-4 pt-3 border-t border-stone-100 flex items-center justify-between text-xs font-bold text-[#a8334e]">
                                <span>Read Article</span>
                                <span>&rarr;</span>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- FREQUENTLY ASKED QUESTIONS (FAST HTML DETAILS ACCORDION) -->
    <section class="py-14 sm:py-18 bg-white border-b border-[#f1d8de]/60">
        <div class="mx-auto max-w-4xl px-4 sm:px-6">
            <div class="text-center mb-8">
                <span class="inline-flex items-center gap-1 px-3 py-0.5 rounded-full text-xs font-bold uppercase tracking-wider bg-[#ffd9dd] text-[#a8334e] mb-2">
                    Frequently Asked Questions
                </span>
                <h2 class="text-2xl sm:text-3xl font-black text-[#1b1b21] tracking-tight">Got Questions? We Have Answers</h2>
                <p class="mt-1.5 text-xs sm:text-sm text-[#5c474a]">Everything you need to know about CupDate, safety, selfie verification, and coffee dating.</p>
            </div>

            <div class="space-y-3">
                <!-- FAQ 1 -->
                <details class="group rounded-2xl border border-[#f0d9df] bg-[#fffafc] p-4 text-xs sm:text-sm open:bg-white transition">
                    <summary class="font-bold text-[#1b1b21] cursor-pointer flex items-center justify-between list-none">
                        <span>How is CupDate different from Tinder or Bumble?</span>
                        <span class="text-[#a8334e] font-bold group-open:rotate-180 transition-transform duration-200">▼</span>
                    </summary>
                    <p class="mt-3 pt-3 border-t border-stone-100 text-[#5c474a] leading-relaxed">
                        Traditional apps encourage endless superficial swiping, ghosting, and expensive 2-hour dinners. CupDate is designed around intentional, low-pressure 45-minute coffee dates at verified public cafés. Every profile is 100% selfie-verified, and we do not use addictive casino algorithms.
                    </p>
                </details>

                <!-- FAQ 2 -->
                <details class="group rounded-2xl border border-[#f0d9df] bg-[#fffafc] p-4 text-xs sm:text-sm open:bg-white transition">
                    <summary class="font-bold text-[#1b1b21] cursor-pointer flex items-center justify-between list-none">
                        <span>Is CupDate free to join and chat?</span>
                        <span class="text-[#a8334e] font-bold group-open:rotate-180 transition-transform duration-200">▼</span>
                    </summary>
                    <p class="mt-3 pt-3 border-t border-stone-100 text-[#5c474a] leading-relaxed">
                        Yes! Free registration, identity verification, discovering singles, and direct one-on-one chatting are available to all genuine singles. There are no paywalls preventing you from having a great conversation and meeting for coffee.
                    </p>
                </details>

                <!-- FAQ 3 -->
                <details class="group rounded-2xl border border-[#f0d9df] bg-[#fffafc] p-4 text-xs sm:text-sm open:bg-white transition">
                    <summary class="font-bold text-[#1b1b21] cursor-pointer flex items-center justify-between list-none">
                        <span>How does the 3-second live selfie check protect members?</span>
                        <span class="text-[#a8334e] font-bold group-open:rotate-180 transition-transform duration-200">▼</span>
                    </summary>
                    <p class="mt-3 pt-3 border-t border-stone-100 text-[#5c474a] leading-relaxed">
                        When creating an account, members record a quick 3-second live selfie pose. Our biometric security compares the live pose with uploaded profile photos to confirm true ownership. This completely eliminates catfishes, stolen photos, and automated scam bots.
                    </p>
                </details>

                <!-- FAQ 4 -->
                <details class="group rounded-2xl border border-[#f0d9df] bg-[#fffafc] p-4 text-xs sm:text-sm open:bg-white transition">
                    <summary class="font-bold text-[#1b1b21] cursor-pointer flex items-center justify-between list-none">
                        <span>Can I use CupDate for serious matrimony and traditional rishta?</span>
                        <span class="text-[#a8334e] font-bold group-open:rotate-180 transition-transform duration-200">▼</span>
                    </summary>
                    <p class="mt-3 pt-3 border-t border-stone-100 text-[#5c474a] leading-relaxed">
                        Yes. CupDate offers a dedicated Rishta &amp; Serious Matrimony portal for singles and families seeking long-term life partners without awkward arranged-marriage interrogations. A comfortable 45-minute coffee chat provides the perfect balance of modern respect and deep values alignment.
                    </p>
                </details>

                <!-- FAQ 5 -->
                <details class="group rounded-2xl border border-[#f0d9df] bg-[#fffafc] p-4 text-xs sm:text-sm open:bg-white transition">
                    <summary class="font-bold text-[#1b1b21] cursor-pointer flex items-center justify-between list-none">
                        <span>Which cities and hill stations in Himachal Pradesh are active?</span>
                        <span class="text-[#a8334e] font-bold group-open:rotate-180 transition-transform duration-200">▼</span>
                    </summary>
                    <p class="mt-3 pt-3 border-t border-stone-100 text-[#5c474a] leading-relaxed">
                        CupDate is active across all 12 districts of Himachal Pradesh — including Shimla, Manali, Dharamshala, McLeodGanj, Kangra, Solan, Mandi, Kullu, Palampur, and Hamirpur — as well as Chandigarh Tri-City, Delhi NCR, Pune, and Mumbai.
                    </p>
                </details>
            </div>

            <div class="mt-6 text-center">
                <a href="{{ route('faq') }}" class="text-xs font-bold text-[#a8334e] hover:underline">
                    View full FAQ &amp; help center &rarr;
                </a>
            </div>
        </div>
    </section>

    <!-- FINAL CALLOUT -->
    <section class="py-14 sm:py-18 bg-gradient-to-br from-[#fff0f3] to-white text-center">
        <div class="mx-auto max-w-2xl px-4">
            <span class="text-3xl mb-2 inline-block">☕</span>
            <h2 class="text-2xl sm:text-3xl font-black text-[#1b1b21]">Ready for a Better First Date?</h2>
            <p class="mt-2 text-xs sm:text-sm text-[#5c474a] max-w-md mx-auto">
                Join thousands of verified singles who value authentic conversation, great coffee, and genuine connections.
            </p>
            <div class="mt-6 flex flex-wrap justify-center gap-3">
                @guest
                    <button type="button" onclick="openQuickAuthModal('register')" 
                            class="px-8 py-3.5 rounded-full bg-gradient-to-r from-[#ff6584] via-[#fd748e] to-[#b0284b] hover:brightness-105 text-white font-extrabold text-xs sm:text-sm shadow-md shadow-[#ff6584]/25 transition hover:-translate-y-0.5 active:scale-95 cursor-pointer">
                        Create Your Free Profile ♥
                    </button>
                    <button type="button" onclick="openQuickAuthModal('signin')" 
                            class="px-8 py-3.5 rounded-full border border-[#dfbfc2] bg-white text-[#a8334e] font-extrabold text-xs sm:text-sm hover:bg-[#fff0f3] transition active:scale-95 cursor-pointer">
                        Sign In
                    </button>
                @else
                    <a href="{{ route('swipes') }}" class="px-8 py-3.5 rounded-full bg-gradient-to-r from-[#ff6584] via-[#fd748e] to-[#b0284b] hover:brightness-105 text-white font-extrabold text-xs sm:text-sm shadow-md shadow-[#ff6584]/25 transition hover:-translate-y-0.5">
                        Discover Deck &rarr;
                    </a>
                @endguest
            </div>
        </div>
    </section>
</div>

<!-- GOOGLE SEARCH CONSOLE RICH JSON-LD SCHEMAS -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@graph": [
    {
      "@type": "WebSite",
      "@id": "https://cupdate.in/#website",
      "url": "https://cupdate.in/",
      "name": "CupDate",
      "description": "Genuine intentional dating, online chat, and verified 45-minute coffee dates across Himachal Pradesh and India.",
      "potentialAction": {
        "@type": "SearchAction",
        "target": "https://cupdate.in/cities?q={search_term_string}",
        "query-input": "required name=search_term_string"
      }
    },
    {
      "@type": "Organization",
      "@id": "https://cupdate.in/#organization",
      "name": "CupDate",
      "url": "https://cupdate.in/",
      "logo": "https://cupdate.in/assets/images/cupdate_logo.svg",
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
      "@id": "https://cupdate.in/#faq",
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

<!-- Micro Activity Ticker JS -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const liveActivities = [
        "🟢 Simran from Shimla just verified her profile (2m ago)",
        "☕ Arjun & Sneha matched for a coffee date in Chandigarh (4m ago)",
        "🟢 Rohit from Kangra claimed 50 daily coffee coins (6m ago)",
        "✨ Tanya added 'Bookworm & Pour-overs' in Pune (8m ago)",
        "☕ Vikram suggested Wake & Bake Cafe in Manali (11m ago)",
        "🟢 Ananya completed her 3-second selfie check (13m ago)",
        "✨ Meera & Kabir fixed a 45-min coffee meet in Bangalore (16m ago)",
        "☕ Rahul shared a new cafe spark in Dharamshala (19m ago)"
    ];
    let activityIdx = 0;
    const tickerEl = document.getElementById('liveActivityTicker');

    if (tickerEl) {
        setInterval(function() {
            tickerEl.style.opacity = '0';
            setTimeout(function() {
                activityIdx = (activityIdx + 1) % liveActivities.length;
                tickerEl.textContent = liveActivities[activityIdx];
                tickerEl.style.opacity = '1';
            }, 250);
        }, 3500);
    }

    const counterEl = document.getElementById('liveOnlineCount');
    if (counterEl) {
        setInterval(function() {
            let current = parseInt(counterEl.textContent.replace(/,/g, ''), 10) || 1492;
            const delta = Math.floor(Math.random() * 5) - 2;
            const next = Math.max(1450, current + delta);
            counterEl.textContent = next.toLocaleString();
        }, 5000);
    }
});
</script>
@endsection
