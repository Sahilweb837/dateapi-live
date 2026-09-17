@extends('layouts.app')

@section('title', 'Best Dating Website in Himachal Pradesh (Kangra, Kullu, Mandi, Shimla) & India — CupDate')
@section('meta_desc', 'CupDate is the #1 best dating website in Himachal Pradesh (Kangra, Kullu, Mandi, Dharamshala, Shimla, Manali), India & worldwide. Connect with 100% selfie-verified singles for meaningful coffee dates, serious relationships & lifelong romance.')

@section('content')
<div class="flex flex-col w-full">

    @auth
        <!-- Authenticated Editorial Quick-Launch Bar -->
        <section class="w-full bg-surface-container-low border-b border-outline-variant/30 py-4">
            <div class="max-w-[1360px] mx-auto px-4 sm:px-6 lg:px-margin-desktop">
                <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                    <div class="flex items-center gap-3.5">
                        <div class="relative shrink-0">
                            <img src="{{ Auth::user()->avatar_url }}" alt="Avatar" class="w-12 h-12 rounded-full object-cover ring-2 ring-secondary">
                            @if(Auth::user()->is_verified)
                                <span class="material-symbols-outlined text-emerald-600 text-sm absolute -bottom-1 -right-1 bg-surface rounded-full">check_circle</span>
                            @endif
                        </div>
                        <div>
                            <div class="flex items-center gap-2">
                                <h2 class="font-headline-sm text-headline-sm text-on-surface font-semibold text-lg sm:text-xl">
                                    Welcome back, {{ Auth::user()->full_name }}
                                </h2>
                                <span class="px-2 py-0.5 rounded-full bg-surface-container-highest text-secondary text-[10px] font-mono font-bold">
                                    #{{ Auth::user()->formatted_member_id ?? 'CD-10001' }}
                                </span>
                            </div>
                            <p class="text-xs text-on-surface-variant mt-0.5">
                                Profile: <strong class="text-secondary">{{ $profileCompleteness }}%</strong> • 
                                Wallet: <strong class="text-amber-600">{{ Auth::user()->coins }} Coins</strong> • 
                                Style: <span class="text-on-surface font-medium">{{ Auth::user()->coffee_style ?? 'Single Origin Pour-over' }}</span>
                            </p>
                        </div>
                    </div>

                    <!-- Action Shortcuts -->
                    <div class="flex flex-wrap items-center gap-2">
                        <a href="{{ route('swipes') }}" class="px-4 py-2 rounded-full bg-on-tertiary-container text-on-tertiary font-label-md text-label-md shadow-sm hover:scale-[1.02] transition flex items-center gap-1.5">
                            <span class="material-symbols-outlined text-sm leading-none">style</span>
                            <span>Discover Deck</span>
                        </a>
                        <a href="{{ route('feed') }}" class="px-4 py-2 rounded-full bg-surface-container text-on-surface font-label-md text-label-md hover:bg-surface-container-high transition flex items-center gap-1.5">
                            <span class="material-symbols-outlined text-sm text-secondary leading-none">coffee</span>
                            <span>Date Feed</span>
                        </a>
                        <a href="{{ route('messages') }}" class="px-4 py-2 rounded-full bg-surface-container text-on-surface font-label-md text-label-md hover:bg-surface-container-high transition flex items-center gap-1.5">
                            <span class="material-symbols-outlined text-sm leading-none">chat_bubble</span>
                            <span>Chat</span>
                        </a>
                        <a href="{{ route('profile') }}" class="px-4 py-2 rounded-full bg-surface-container-lowest border border-outline-variant/50 text-on-surface font-label-md text-label-md hover:bg-surface-container transition flex items-center gap-1.5">
                            <span class="material-symbols-outlined text-sm leading-none">account_circle</span>
                            <span>My Profile</span>
                        </a>
                    </div>
                </div>
            </div>
        </section>
    @endauth

    <!-- Top Marquee Dispatch -->
    <div class="w-full bg-surface-container-high py-2.5 overflow-hidden select-none border-b border-outline-variant/20">
        <div class="flex items-center gap-space-lg whitespace-nowrap animate-marquee">
            <span class="font-label-sm text-label-sm text-secondary tracking-widest uppercase font-semibold">Intentional Matchmaking For Genuine Romance</span>
            <span class="font-body-sm text-body-sm text-on-surface-variant">•</span>
            <span class="font-body-sm text-body-sm text-on-surface">Curated pairing across intimate romantic sanctuaries in NYC, London, Paris &amp; India</span>
            <span class="font-body-sm text-body-sm text-on-surface-variant">•</span>
            <span class="inline-flex items-center gap-1.5 font-label-md text-label-md text-[#835339] font-semibold">
                <span class="w-2 h-2 rounded-full bg-emerald-600 animate-pulse"></span>
                1,420 singles meeting across tables today
            </span>
            <span class="font-body-sm text-body-sm text-on-surface-variant">•</span>
            <span class="font-body-sm text-body-sm text-on-surface-variant italic">Zero superficial swiping. Pure daylight courtship.</span>
            <span class="font-body-sm text-body-sm text-on-surface-variant">•</span>
            <span class="font-label-sm text-label-sm text-secondary tracking-widest uppercase font-semibold">Intentional Matchmaking For Genuine Romance</span>
            <span class="font-body-sm text-body-sm text-on-surface-variant">•</span>
            <span class="font-body-sm text-body-sm text-on-surface">Curated pairing across intimate romantic sanctuaries in NYC, London, Paris &amp; India</span>
            <span class="font-body-sm text-body-sm text-on-surface-variant">•</span>
            <span class="inline-flex items-center gap-1.5 font-label-md text-label-md text-[#835339] font-semibold">
                <span class="w-2 h-2 rounded-full bg-emerald-600 animate-pulse"></span>
                1,420 singles meeting across tables today
            </span>
        </div>
    </div>

    <!-- Bespoke Centered Editorial Romantic Hero Section -->
    <section class="relative w-full max-w-[1360px] mx-auto px-4 sm:px-8 lg:px-margin-desktop pt-12 sm:pt-16 pb-16 lg:pb-24 overflow-hidden">
        <!-- Soft Romantic Radiant Warmth -->
        <div class="pointer-events-none absolute top-0 left-1/2 -translate-x-1/2 w-full max-w-4xl h-[600px] hero-glow blur-3xl -z-10 rounded-full"></div>
        
        <!-- Centered Editorial Dating Masthead -->
        <div class="max-w-4xl mx-auto flex flex-col items-center text-center gap-6">
            <!-- Live Courtship Status -->
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-surface-container-lowest border border-outline-variant/40 shadow-sm">
                <span class="w-2 h-2 rounded-full bg-[#E87A88] animate-ping"></span>
                <span class="w-2 h-2 -ml-3.5 rounded-full bg-[#E87A88]"></span>
                <span class="font-label-sm text-label-sm text-primary font-medium tracking-wide">1,420 Intentional Singles Meeting for Real Dates Today</span>
                <span class="text-outline-variant">|</span>
                <span class="font-label-sm text-label-sm text-secondary uppercase tracking-widest font-semibold">Pure Slow Courtship</span>
            </div>

            <!-- Grand Romantic Headline -->
            <h1 class="font-headline-xl text-[40px] sm:text-[54px] lg:text-[64px] text-primary tracking-tight font-semibold leading-[1.08] text-balance">
                Where Real Romance Begins Across the Table.
            </h1>

            <!-- Focused Dating Subtitle -->
            <p class="font-body-lg text-[17px] sm:text-[20px] text-on-surface-variant max-w-2xl leading-relaxed text-balance">
                Leave superficial swipe fatigue behind. CupDate pairs thoughtful singles seeking lifelong devotion and genuine daylight chemistry over unhurried, intimate first dates.
            </p>

            <!-- Centered Action CTAs -->
            <div class="flex flex-wrap items-center justify-center gap-4 pt-2">
                @guest
                    <a href="{{ route('register') }}" class="group inline-flex items-center gap-2.5 px-8 sm:px-9 py-4 rounded-full bg-[#E87A88] text-white font-label-lg text-label-lg shadow-[0_8px_24px_rgba(232,122,136,0.36)] hover:shadow-[0_12px_28px_rgba(232,122,136,0.48)] hover:brightness-105 active:scale-95 transition-all">
                        <span>Start Your Romance</span>
                        <span class="material-symbols-outlined text-base group-hover:translate-x-1 transition-transform">favorite</span>
                    </a>
                    <a href="#intentional-singles" class="inline-flex items-center gap-2 px-7 sm:px-8 py-4 rounded-full bg-surface-container-lowest border border-[#835339]/30 hover:border-[#835339] text-[#22140D] font-label-lg text-label-lg transition-all hover:bg-surface-container-low shadow-sm">
                        <span class="material-symbols-outlined text-secondary text-base">explore</span>
                        <span>Explore Intentional Singles</span>
                    </a>
                @else
                    <a href="{{ route('swipes') }}" class="group inline-flex items-center gap-2.5 px-8 sm:px-9 py-4 rounded-full bg-[#E87A88] text-white font-label-lg text-label-lg shadow-[0_8px_24px_rgba(232,122,136,0.36)] hover:shadow-[0_12px_28px_rgba(232,122,136,0.48)] hover:brightness-105 active:scale-95 transition-all">
                        <span>Enter Discover Deck</span>
                        <span class="material-symbols-outlined text-base group-hover:translate-x-1 transition-transform">style</span>
                    </a>
                    <a href="{{ route('feed') }}" class="inline-flex items-center gap-2 px-7 sm:px-8 py-4 rounded-full bg-surface-container-lowest border border-[#835339]/30 hover:border-[#835339] text-[#22140D] font-label-lg text-label-lg transition-all hover:bg-surface-container-low shadow-sm">
                        <span class="material-symbols-outlined text-secondary text-base">local_cafe</span>
                        <span>Browse Date Feed</span>
                    </a>
                @endguest
            </div>

            <!-- Micro trust badges -->
            <div class="flex items-center justify-center gap-6 pt-1 text-on-surface-variant font-label-sm text-label-sm flex-wrap">
                <span class="inline-flex items-center gap-1.5"><span class="material-symbols-outlined text-[#E87A88] text-sm">check_circle</span> 100% Identity Vetted</span>
                <span class="inline-flex items-center gap-1.5"><span class="material-symbols-outlined text-[#E87A88] text-sm">schedule</span> Unhurried 45-Min Ritual</span>
                <span class="inline-flex items-center gap-1.5"><span class="material-symbols-outlined text-[#E87A88] text-sm">favorite</span> Real Long-Term Intentions</span>
            </div>
        </div>

        <!-- Centered Dating Showcase & Match Experience -->
        <div class="mt-12 lg:mt-16 w-full max-w-5xl mx-auto">
            <!-- Fast Snappy Switcher Tab Bar -->
            <div class="flex items-center justify-center mb-6">
                <div class="inline-flex p-1.5 bg-surface-container-low border border-outline-variant/30 rounded-full shadow-sm" id="hero-dating-tab-group">
                    <button type="button" data-tab="curated" class="hero-toggle-btn active px-6 py-2 rounded-full font-label-md text-label-md font-semibold bg-primary text-on-primary shadow-xs transition-all">
                        <span class="inline-flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-[#E87A88]"></span>
                            Curated Matches
                        </span>
                    </button>
                    <button type="button" data-tab="today" class="hero-toggle-btn px-6 py-2 rounded-full font-label-md text-label-md font-semibold text-on-surface-variant hover:text-on-surface transition-all">
                        <span class="inline-flex items-center gap-2">
                            <span class="material-symbols-outlined text-xs">local_cafe</span>
                            Today's Date Dossiers
                        </span>
                    </button>
                    <button type="button" data-tab="verified" class="hero-toggle-btn px-6 py-2 rounded-full font-label-md text-label-md font-semibold text-on-surface-variant hover:text-on-surface transition-all">
                        <span class="inline-flex items-center gap-2">
                            <span class="material-symbols-outlined text-xs">verified</span>
                            Verified Singles Near You
                        </span>
                    </button>
                </div>
            </div>

            <!-- Showcase Card Deck (Curated Matches View) -->
            <div class="relative bg-surface-container-lowest border border-outline-variant/40 rounded-[2.5rem] p-6 sm:p-8 shadow-[0_20px_50px_rgba(34,20,13,0.06)] overflow-hidden transition-all duration-300" id="hero-dating-display">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                    
                    <!-- Dater Portrait with Romantic Overlays -->
                    <div class="lg:col-span-6 relative">
                        <div class="relative rounded-[2rem] overflow-hidden aspect-[4/4.5] shadow-xl border border-outline-variant/20 bg-surface-container">
                            <img id="hero-dater-img" alt="Elena - Romantic portrait in sunlit café" class="w-full h-full object-cover transition-all duration-500 hover:scale-105" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDftoqQPlGJ6nQft-w9OKRyLRqE5d-gXtON0maE6JdAfBUkZdJgdtwKGtGMEgzUqyLCPVqbXE-SoLNH0Dki87vnj3mvU2m9m9T5qclbaoB4iXhrCd-RWJKYmiLfnbA7Du9tDskAm_VUoZ3bpSO6Wkb-vYB5VZ0v9Iq13ilRqJ6ZVXkLAP2DqiSsZkHYAA6YoVQOV4jQO4yFECplYeG4_UZhz08agWIs52Ubru4H-eIoAq0ms3zlqw_2Xg"/>
                            <div class="absolute inset-0 bg-gradient-to-t from-black/75 via-transparent to-transparent"></div>
                            
                            <!-- Top Floating Match Badge -->
                            <div class="absolute top-4 left-4 inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full bg-surface-container-lowest/90 backdrop-blur-md shadow-md">
                                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                                <span id="hero-dater-spark" class="font-label-sm text-[12px] text-primary font-bold">98% Romantic Synergy</span>
                            </div>

                            <!-- Verified Dater Badge -->
                            <div class="absolute top-4 right-4 inline-flex items-center gap-1 px-3 py-1.5 rounded-full bg-primary/80 backdrop-blur-md text-white font-label-sm text-label-sm">
                                <span class="material-symbols-outlined text-sm text-[#E87A88]">verified</span>
                                <span>Vetted Single</span>
                            </div>

                            <!-- Bottom Romantic Summary Inset -->
                            <div class="absolute bottom-4 left-4 right-4 p-4 rounded-2xl bg-surface-container-lowest/95 backdrop-blur-md border border-white/60 shadow-lg flex items-center justify-between">
                                <div>
                                    <div class="flex items-center gap-2">
                                        <h3 id="hero-dater-name" class="font-headline-sm text-base text-primary font-bold">Elena Vance, 28</h3>
                                        <span class="text-xs text-on-surface-variant font-medium">• SoHo, NYC</span>
                                    </div>
                                    <p id="hero-dater-vibe" class="font-body-sm text-[12px] text-secondary font-medium pt-0.5">Looking for: Lifelong romance, shared architecture walks &amp; quiet mornings</p>
                                </div>
                                <div class="w-10 h-10 rounded-full bg-rose-50 flex items-center justify-center text-[#E87A88] flex-shrink-0 shadow-xs">
                                    <span class="material-symbols-outlined text-lg">favorite</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Match Dossier & Deep Romantic Prompts (Right Column) -->
                    <div class="lg:col-span-6 flex flex-col justify-between h-full py-2">
                        <div class="flex flex-col gap-5">
                            <!-- Courtship Values -->
                            <div class="flex items-center justify-between pb-3 border-b border-outline-variant/30">
                                <div class="flex items-center gap-2">
                                    <span class="material-symbols-outlined text-[#E87A88]">auto_awesome</span>
                                    <span class="font-label-md text-label-md text-primary font-bold uppercase tracking-wider">Courtship Dossier</span>
                                </div>
                                <span class="font-label-sm text-label-sm text-secondary font-medium">Profile 01 of 12</span>
                            </div>

                            <!-- Prompt 1: Ideal Date -->
                            <div class="p-4 rounded-2xl bg-surface-container-low/70 border border-outline-variant/30">
                                <span class="font-label-sm text-[11px] text-secondary uppercase font-semibold tracking-wider">The First Rendezvous She Imagines</span>
                                <p id="hero-prompt-quote" class="font-headline-sm text-[17px] text-primary italic pt-1 leading-snug">
                                    “A slow pour-over at Devoción on an unhurried Saturday morning, talking about the books that changed our worldview before wandering through the galleries.”
                                </p>
                            </div>

                            <!-- Audio Voice Note Snippet -->
                            <div class="p-4 rounded-2xl bg-surface-container-low/70 border border-outline-variant/30 flex items-center justify-between gap-4">
                                <div class="flex items-center gap-3">
                                    <button id="audio-play-demo" type="button" class="w-10 h-10 rounded-full bg-primary text-on-primary flex items-center justify-center shadow-sm hover:scale-105 transition-transform cursor-pointer">
                                        <span class="material-symbols-outlined text-lg">play_arrow</span>
                                    </button>
                                    <div>
                                        <span class="font-label-md text-label-md text-primary font-semibold block">Voice Prompt • 0:28</span>
                                        <span class="font-body-sm text-[12px] text-on-surface-variant">“What romance means to me in a hyper-digital world...”</span>
                                    </div>
                                </div>
                                <!-- Animated Soundwave Preview -->
                                <div class="flex items-center gap-1 h-6 pr-2">
                                    <span class="w-1 bg-[#E87A88] h-3 rounded-full animate-pulse"></span>
                                    <span class="w-1 bg-[#E87A88] h-5 rounded-full animate-pulse delay-75"></span>
                                    <span class="w-1 bg-[#E87A88] h-2 rounded-full animate-pulse delay-150"></span>
                                    <span class="w-1 bg-[#E87A88] h-6 rounded-full animate-pulse delay-100"></span>
                                    <span class="w-1 bg-[#E87A88] h-3 rounded-full animate-pulse"></span>
                                </div>
                            </div>

                            <!-- Romantic Intentions & Values Tags -->
                            <div id="hero-tag-list" class="flex flex-wrap gap-2 pt-1">
                                <span class="px-3 py-1 rounded-full bg-surface-container font-label-sm text-label-sm text-primary font-medium">💍 Marriage &amp; Partnership</span>
                                <span class="px-3 py-1 rounded-full bg-surface-container font-label-sm text-label-sm text-primary font-medium">☕ Slow Morning Rituals</span>
                                <span class="px-3 py-1 rounded-full bg-surface-container font-label-sm text-label-sm text-primary font-medium">🌿 Deep Listeners</span>
                            </div>
                        </div>

                        <!-- Fast Dating Micro-Action Bar -->
                        <div class="pt-6 mt-4 border-t border-outline-variant/30 flex items-center justify-between gap-4 flex-wrap">
                            <div class="flex items-center gap-2 sm:gap-3">
                                <button type="button" data-profile="0" class="quick-profile-btn px-4 py-2 rounded-full bg-surface-container hover:bg-surface-container-high text-on-surface font-label-md text-label-md font-semibold transition-all cursor-pointer">
                                    Elena, 28
                                </button>
                                <button type="button" data-profile="1" class="quick-profile-btn px-4 py-2 rounded-full bg-surface-container-low hover:bg-surface-container text-on-surface-variant font-label-md text-label-md font-semibold transition-all cursor-pointer">
                                    Julian, 31
                                </button>
                                <button type="button" data-profile="2" class="quick-profile-btn px-4 py-2 rounded-full bg-surface-container-low hover:bg-surface-container text-on-surface-variant font-label-md text-label-md font-semibold transition-all cursor-pointer">
                                    Siobhan, 29
                                </button>
                            </div>
                            <a href="{{ Auth::check() ? route('swipes') : route('register') }}" class="inline-flex items-center gap-1.5 px-5 py-2.5 rounded-full bg-[#E87A88] text-white font-label-md text-label-md shadow-sm hover:brightness-105 transition-all">
                                <span class="material-symbols-outlined text-sm">favorite</span>
                                <span>Arrange Date</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Metric Strip / Courtship Social Proof -->
    <section class="w-full bg-surface-container-low py-10">
        <div class="max-w-[1360px] mx-auto px-4 sm:px-8 lg:px-margin-desktop grid grid-cols-2 md:grid-cols-4 gap-gutter text-center">
            <div class="flex flex-col items-center">
                <span class="font-headline-lg text-headline-lg text-primary font-semibold">45m</span>
                <span class="font-label-md text-label-md text-on-surface-variant">Unhurried First Date Protocol</span>
            </div>
            <div class="flex flex-col items-center">
                <span class="font-headline-lg text-headline-lg text-primary font-semibold">88%</span>
                <span class="font-label-md text-label-md text-on-surface-variant">Second Date Spark Conversion</span>
            </div>
            <div class="flex flex-col items-center">
                <span class="font-headline-lg text-headline-lg text-primary font-semibold">100%</span>
                <span class="font-label-md text-label-md text-on-surface-variant">Vetted Long-Term Singles</span>
            </div>
            <div class="flex flex-col items-center">
                <span class="font-headline-lg text-headline-lg text-primary font-semibold">Zero</span>
                <span class="font-label-md text-label-md text-on-surface-variant">Noisy Bars &amp; Superficial Ghosting</span>
            </div>
        </div>
    </section>

    <!-- Section 2: "The 45-Minute Courtship Ritual" -->
    <section class="max-w-[1360px] mx-auto w-full px-4 sm:px-8 lg:px-margin-desktop py-20 lg:py-28" id="intentional-singles">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-space-md">
            <div>
                <span class="font-label-sm text-label-sm text-secondary uppercase tracking-widest">A Civilized Architecture for Love</span>
                <h2 class="font-headline-lg text-headline-lg text-primary tracking-tight mt-1">
                    The 45-Minute Courtship Ritual
                </h2>
            </div>
            <p class="font-body-md text-body-md text-on-surface-variant max-w-md">
                Thoughtfully designed for genuine chemistry. No alcohol-fueled noise, no hollow high-stakes dinners—just two people, daylight warmth, and intentional conversation.
            </p>
        </div>

        <!-- 4-Step Editorial Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-gutter">
            <!-- Step 01 -->
            <div class="ritual-step group relative p-space-lg rounded-3xl bg-surface-container-low hover:bg-surface-container transition-all duration-300 shadow-sm flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between pb-space-md">
                        <span class="font-headline-md text-headline-md text-secondary/40 group-hover:text-secondary transition-colors">01</span>
                        <span class="material-symbols-outlined text-secondary">tune</span>
                    </div>
                    <h3 class="font-headline-sm text-headline-sm text-primary font-semibold pb-space-xs">
                        Romantic Values Calibration
                    </h3>
                    <p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
                        Specify your relationship timeline, life aspirations, mutual intellect, and your favorite intimate neighborhood strolls.
                    </p>
                </div>
                <div class="pt-space-lg mt-space-md">
                    <div class="h-1 w-full bg-surface-container-high rounded-full overflow-hidden">
                        <div class="h-full bg-secondary w-1/4 group-hover:w-full transition-all duration-500"></div>
                    </div>
                </div>
            </div>

            <!-- Step 02 -->
            <div class="ritual-step group relative p-space-lg rounded-3xl bg-surface-container-low hover:bg-surface-container transition-all duration-300 shadow-sm flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between pb-space-md">
                        <span class="font-headline-md text-headline-md text-secondary/40 group-hover:text-secondary transition-colors">02</span>
                        <span class="material-symbols-outlined text-secondary">wb_sunny</span>
                    </div>
                    <h3 class="font-headline-sm text-headline-sm text-primary font-semibold pb-space-xs">
                        The Daily Rendezvous (12 PM)
                    </h3>
                    <p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
                        Every noon, receive 3 tailored dossiers chosen for emotional maturity and romantic synchronicity. No algorithmic black holes.
                    </p>
                </div>
                <div class="pt-space-lg mt-space-md">
                    <div class="h-1 w-full bg-surface-container-high rounded-full overflow-hidden">
                        <div class="h-full bg-secondary w-2/4 group-hover:w-full transition-all duration-500"></div>
                    </div>
                </div>
            </div>

            <!-- Step 03 -->
            <div class="ritual-step group relative p-space-lg rounded-3xl bg-surface-container-low hover:bg-surface-container transition-all duration-300 shadow-sm flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between pb-space-md">
                        <span class="font-headline-md text-headline-md text-secondary/40 group-hover:text-secondary transition-colors">03</span>
                        <span class="material-symbols-outlined text-secondary">table_restaurant</span>
                    </div>
                    <h3 class="font-headline-sm text-headline-sm text-primary font-semibold pb-space-xs">
                        One-Tap Reserved Table
                    </h3>
                    <p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
                        Choose a romantic date sanctuary. CupDate pre-reserves quiet alcove seating for effortless, stress-free arrival.
                    </p>
                </div>
                <div class="pt-space-lg mt-space-md">
                    <div class="h-1 w-full bg-surface-container-high rounded-full overflow-hidden">
                        <div class="h-full bg-secondary w-3/4 group-hover:w-full transition-all duration-500"></div>
                    </div>
                </div>
            </div>

            <!-- Step 04 -->
            <div class="ritual-step group relative p-space-lg rounded-3xl bg-surface-container-low hover:bg-surface-container transition-all duration-300 shadow-sm flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between pb-space-md">
                        <span class="font-headline-md text-headline-md text-secondary/40 group-hover:text-secondary transition-colors">04</span>
                        <span class="material-symbols-outlined text-secondary">hourglass_top</span>
                    </div>
                    <h3 class="font-headline-sm text-headline-sm text-primary font-semibold pb-space-xs">
                        45-Minute Daylight Spark
                    </h3>
                    <p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
                        A built-in time boundary protects your heart and schedule. If sparks fly, wander off to an afternoon gallery stroll together.
                    </p>
                </div>
                <div class="pt-space-lg mt-space-md">
                    <div class="h-1 w-full bg-surface-container-high rounded-full overflow-hidden">
                        <div class="h-full bg-secondary w-full transition-all duration-500"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 3: Interactive Date Sanctuaries & Romance Spots -->
    <section class="w-full bg-surface-container-lowest py-20 lg:py-28" id="partner-cafes">
        <div class="max-w-[1360px] mx-auto px-4 sm:px-8 lg:px-margin-desktop">
            <div class="flex flex-col lg:flex-row lg:items-end justify-between mb-10 gap-space-md">
                <div>
                    <span class="font-label-sm text-label-sm text-secondary uppercase tracking-widest">Handpicked Date Sanctuaries</span>
                    <h2 class="font-headline-lg text-headline-lg text-primary tracking-tight mt-1">
                        Spaces Designed for Romantic Chemistry
                    </h2>
                </div>
                <!-- City Filter Tabs -->
                <div class="flex flex-wrap items-center gap-1.5 p-1.5 bg-surface-container rounded-full" id="city-tabs">
                    <button type="button" data-city="all" class="city-btn active px-4 py-1.5 rounded-full font-label-md text-label-md bg-primary text-on-primary shadow-sm transition-all cursor-pointer">All Chapters</button>
                    <button type="button" data-city="nyc" class="city-btn px-4 py-1.5 rounded-full font-label-md text-label-md text-on-surface-variant hover:text-on-surface transition-all cursor-pointer">New York</button>
                    <button type="button" data-city="london" class="city-btn px-4 py-1.5 rounded-full font-label-md text-label-md text-on-surface-variant hover:text-on-surface transition-all cursor-pointer">London</button>
                    <button type="button" data-city="paris" class="city-btn px-4 py-1.5 rounded-full font-label-md text-label-md text-on-surface-variant hover:text-on-surface transition-all cursor-pointer">Paris</button>
                    <button type="button" data-city="tokyo" class="city-btn px-4 py-1.5 rounded-full font-label-md text-label-md text-on-surface-variant hover:text-on-surface transition-all cursor-pointer">Tokyo</button>
                </div>
            </div>

            <!-- Date Haven Showcase Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-gutter" id="cafe-cards-grid">
                <!-- Sanctuary 1 -->
                <div class="cafe-card group flex flex-col rounded-3xl overflow-hidden bg-surface-container-low shadow-sm hover:shadow-md transition-all duration-300" data-city-tag="nyc">
                    <div class="relative aspect-[4/3] overflow-hidden">
                        <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="Modern botanical date sanctuary in Brooklyn" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAobAPipxuEe3wjCHQ6DAAjbsGuXG-QpQdNnwG2azPiJVx2FYHojtUtrFbLBqLuTj_EHPRP3eBfgBbRHbxdh_48UFCT3mZevReRZEO44m1MS3feYU1_eKfdJvOW_TfHLMMLCriVipm2owKnDVInZRNZ3CqjbrFKjks08a-9uj7DWS5l8wUpvBxTdgZknemFNVf4CAbW0wVPQNeDBISShk0VSI9CprHyFsxq-ytNRYbmN5MKsa3jiw5o7A"/>
                        <span class="absolute top-3 left-3 px-2.5 py-0.5 rounded-full bg-surface-container-lowest/90 backdrop-blur-sm font-label-sm text-label-sm text-secondary font-medium">SoHo, NYC</span>
                        <span class="absolute top-3 right-3 px-2.5 py-0.5 rounded-full bg-primary/80 backdrop-blur-sm font-label-sm text-label-sm text-on-primary flex items-center gap-1">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#E87A88]"></span> 24 First Dates This Week
                        </span>
                    </div>
                    <div class="p-5 flex flex-col flex-1 justify-between">
                        <div>
                            <div class="flex items-center justify-between pb-1">
                                <h3 class="font-headline-sm text-headline-sm text-primary font-semibold">Devoción</h3>
                                <span class="font-label-sm text-label-sm text-secondary">Acoustic: Whispered</span>
                            </div>
                            <p class="font-body-sm text-body-sm text-on-surface-variant pt-1 leading-relaxed">
                                Sun-drenched skylight atrium, living plant tapestry, quiet corner banquettes for two.
                            </p>
                        </div>
                        <div class="pt-4 flex flex-wrap gap-1.5">
                            <span class="px-2 py-0.5 rounded-full bg-surface-container font-label-sm text-label-sm text-on-surface-variant">Cortado Flight</span>
                            <span class="px-2 py-0.5 rounded-full bg-surface-container font-label-sm text-label-sm text-on-surface-variant">Corner Alcoves</span>
                        </div>
                    </div>
                </div>

                <!-- Sanctuary 2 -->
                <div class="cafe-card group flex flex-col rounded-3xl overflow-hidden bg-surface-container-low shadow-sm hover:shadow-md transition-all duration-300" data-city-tag="nyc">
                    <div class="relative aspect-[4/3] overflow-hidden">
                        <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="Minimalist airy Scandinavian-style interior" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCArtSY7xH11PHO1Ur_nPQ0lFlvyD4VfPuRWnsVOqq7w80B0G9B4R1ZNRIuVjfbEZXaF9b2LAt6b6-q-Zp7XJJupTddrBySJrQkxW-JZlChYwXXqgRU95hWZezmn7Trgn8p4wXDmLqEgF4w0eaFxaQLnkGqmKB8JMNGyxARYhJI-Goq4pxqQTJO8ppmYZ1l54cgAKAgFUf5BX3zh-jN9nF1FvrFcUv4iOvf59hAF37m-F88O5RZZLvksg"/>
                        <span class="absolute top-3 left-3 px-2.5 py-0.5 rounded-full bg-surface-container-lowest/90 backdrop-blur-sm font-label-sm text-label-sm text-secondary font-medium">Bushwick, NYC</span>
                        <span class="absolute top-3 right-3 px-2.5 py-0.5 rounded-full bg-primary/80 backdrop-blur-sm font-label-sm text-label-sm text-on-primary flex items-center gap-1">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#E87A88]"></span> 18 First Dates This Week
                        </span>
                    </div>
                    <div class="p-5 flex flex-col flex-1 justify-between">
                        <div>
                            <div class="flex items-center justify-between pb-1">
                                <h3 class="font-headline-sm text-headline-sm text-primary font-semibold">Sey</h3>
                                <span class="font-label-sm text-label-sm text-secondary">Acoustic: Gentle</span>
                            </div>
                            <p class="font-body-sm text-body-sm text-on-surface-variant pt-1 leading-relaxed">
                                Nordic warmth, soft natural sunlight, vinyl records spinning quietly in the background.
                            </p>
                        </div>
                        <div class="pt-4 flex flex-wrap gap-1.5">
                            <span class="px-2 py-0.5 rounded-full bg-surface-container font-label-sm text-label-sm text-on-surface-variant">Filter for Two</span>
                            <span class="px-2 py-0.5 rounded-full bg-surface-container font-label-sm text-label-sm text-on-surface-variant">Vinyl Acoustics</span>
                        </div>
                    </div>
                </div>

                <!-- Sanctuary 3 -->
                <div class="cafe-card group flex flex-col rounded-3xl overflow-hidden bg-surface-container-low shadow-sm hover:shadow-md transition-all duration-300" data-city-tag="paris">
                    <div class="relative aspect-[4/3] overflow-hidden">
                        <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="Parisian romantic rendezvous cafe" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCFV5KenDmeR6xdLIjnn6BkCB1fJS9sOZvstxMziAjFDt4w-BLMNjkMd0gicgRWBuYiTU2kEszT6OvxH-cnwA0T_mZ8GJ1i8Jph4yMvZnOdMndtuTS3scIcNwtRTlJxn6yptWTsx6KvcBpR3-avC1H-tJQ8c7vLgFOA832LE9nbQdVaYHoSGwGm2ieKm8CoGzFzJxmKexmCd5ZyTA0tynzTzWNIXiR_wqYnP_exJlr2TMh0fqff9C9KRQ"/>
                        <span class="absolute top-3 left-3 px-2.5 py-0.5 rounded-full bg-surface-container-lowest/90 backdrop-blur-sm font-label-sm text-label-sm text-secondary font-medium">Palais-Royal, Paris</span>
                        <span class="absolute top-3 right-3 px-2.5 py-0.5 rounded-full bg-primary/80 backdrop-blur-sm font-label-sm text-label-sm text-on-primary flex items-center gap-1">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#E87A88]"></span> 32 First Dates This Week
                        </span>
                    </div>
                    <div class="p-5 flex flex-col flex-1 justify-between">
                        <div>
                            <div class="flex items-center justify-between pb-1">
                                <h3 class="font-headline-sm text-headline-sm text-primary font-semibold">Café Kitsuné</h3>
                                <span class="font-label-sm text-label-sm text-secondary">Acoustic: Romantic</span>
                            </div>
                            <p class="font-body-sm text-body-sm text-on-surface-variant pt-1 leading-relaxed">
                                Historic arcade colonnades, garden walks, and intimate rendezvous under old limestone arches.
                            </p>
                        </div>
                        <div class="pt-4 flex flex-wrap gap-1.5">
                            <span class="px-2 py-0.5 rounded-full bg-surface-container font-label-sm text-label-sm text-on-surface-variant">Matcha &amp; Pastry</span>
                            <span class="px-2 py-0.5 rounded-full bg-surface-container font-label-sm text-label-sm text-on-surface-variant">Garden Promenade</span>
                        </div>
                    </div>
                </div>

                <!-- Sanctuary 4 -->
                <div class="cafe-card group flex flex-col rounded-3xl overflow-hidden bg-surface-container-low shadow-sm hover:shadow-md transition-all duration-300" data-city-tag="london">
                    <div class="relative aspect-[4/3] overflow-hidden">
                        <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="Moody specialty coffee rendezvous spot in London" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBm88rQGGuvZ9kudaMFVAMfS0BVHrYnH2yTxPiZ7ekKk3qk4xxWoOk3LK0EOnvtxgDIHk-RLKUTWoyThiNP_XD0t9pCne7DltkvLYd9xYcUcA8fHuVO5Fh2XODyNE5wqIQCjNnOL-R__jWFp8DuIRNi2o0-lh4HkvoARZXuW-fuRATMnJF0SlfZyJhttS0lvBOqkkHLWJJxpmlla9wkfitCZm7JzlCoGTrzbssYfPqKkfv-fT10s_bG4Q"/>
                        <span class="absolute top-3 left-3 px-2.5 py-0.5 rounded-full bg-surface-container-lowest/90 backdrop-blur-sm font-label-sm text-label-sm text-secondary font-medium">Shoreditch, London</span>
                        <span class="absolute top-3 right-3 px-2.5 py-0.5 rounded-full bg-primary/80 backdrop-blur-sm font-label-sm text-label-sm text-on-primary flex items-center gap-1">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#E87A88]"></span> 21 First Dates This Week
                        </span>
                    </div>
                    <div class="p-5 flex flex-col flex-1 justify-between">
                        <div>
                            <div class="flex items-center justify-between pb-1">
                                <h3 class="font-headline-sm text-headline-sm text-primary font-semibold">Monmouth</h3>
                                <span class="font-label-sm text-label-sm text-secondary">Acoustic: Intimate</span>
                            </div>
                            <p class="font-body-sm text-body-sm text-on-surface-variant pt-1 leading-relaxed">
                                Warm glowing lighting, intimate corner two-tops, and fresh warm pain au chocolat.
                            </p>
                        </div>
                        <div class="pt-4 flex flex-wrap gap-1.5">
                            <span class="px-2 py-0.5 rounded-full bg-surface-container font-label-sm text-label-sm text-on-surface-variant">Batch Brew</span>
                            <span class="px-2 py-0.5 rounded-full bg-surface-container font-label-sm text-label-sm text-on-surface-variant">Artisan Bakery</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 4: "Love on the First Sip" — Editorial Love Stories -->
    <section class="max-w-[1360px] mx-auto w-full px-4 sm:px-8 lg:px-margin-desktop py-20 lg:py-28">
        <div class="text-center max-w-2xl mx-auto mb-16">
            <span class="font-label-sm text-label-sm text-secondary uppercase tracking-widest">Real Romance Stories</span>
            <h2 class="font-headline-lg text-headline-lg text-primary tracking-tight mt-1">
                Love on the First Sip
            </h2>
            <p class="font-body-md text-body-md text-on-surface-variant mt-2">
                Real members who traded chaotic swipe games for an unhurried table and found the love of their life.
            </p>
        </div>

        <!-- Magazine Spread Layout -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-gutter-lg items-stretch">
            <!-- Primary Editorial Feature -->
            <div class="lg:col-span-8 p-8 sm:p-12 rounded-3xl bg-surface-container-low shadow-sm flex flex-col justify-between">
                <div class="flex flex-col gap-6">
                    <div class="flex flex-wrap items-center justify-between gap-4">
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-[#E87A88] text-xl">favorite</span>
                            <span class="font-label-md text-label-md text-on-surface font-semibold">Matched at Abraço, East Village</span>
                        </div>
                        <span class="px-3 py-1 rounded-full bg-surface-container font-label-sm text-label-sm text-secondary">
                            Now Engaged • Fall 2026
                        </span>
                    </div>
                    <blockquote class="font-headline-md text-headline-md text-primary italic leading-snug">
                        “Neither of us wanted another hollow bar date with shouting over bad music. We met at 10 AM on a Tuesday, ordered two Cortados with oat milk and the legendary olive oil cake. Forty-five minutes effortlessly turned into four hours—and now a wedding next spring.”
                    </blockquote>
                    <div class="flex items-center gap-4 pt-2">
                        <div class="flex -space-x-3">
                            <div class="w-12 h-12 rounded-full overflow-hidden shadow-md">
                                <img class="w-full h-full object-cover" alt="Siobhan" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAYW8QfGUtNDKiJMOsp-E6tixTmwp9d3Sf_ZjWAENethisLxVeFIPSSjgysGBjRTmIrTqo96DGk4_HQ5qNzkII6Aar07Uqm8KDYfAoJvffYhp04QvQBS2AYjVIuPX3OPAU5bs-67Y100YKq6RP78YqBl1TvhOI1Wdu-kOPW9wIqOvIrTDpUsd6j2FXFX5IkG4I1uHRbZElBzfmeOTvALHT_IgZrjtctGlix_zglWQjK5KawyKkRjTEgnQ"/>
                            </div>
                            <div class="w-12 h-12 rounded-full overflow-hidden shadow-md">
                                <img class="w-full h-full object-cover" alt="Julian" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCJlQ7L_OwIsb-Qt99pYUGj61g_UWKt_ZllS0CEsU0_P_mt74pFu2I5usX2N8sZcymWmKYjzTOVKjxXy5dIE0Bga3vd1jQo2kZea22IZ_MRmPgIuUE7mjY3WZWHVsXEC1QxPl-8zawByw6O5_0OAcSwLUcORhF9sf8o7wnPwgfmJSwvetn67MtGRF13BWMadiqKnMQpQfY8f6MThopdowPO3uneLqkSFj2f3WmJISknS6Ey9CWQwcboww"/>
                            </div>
                        </div>
                        <div>
                            <p class="font-label-lg text-label-lg text-primary font-semibold">Julian &amp; Siobhan</p>
                            <p class="font-body-sm text-body-sm text-on-surface-variant">Shared Passion: <em>Modern Architecture &amp; 35mm Film</em></p>
                        </div>
                    </div>
                </div>
                <div class="mt-8 pt-6 border-t border-outline-variant/30 flex flex-wrap items-center justify-between gap-4 text-on-surface-variant font-body-sm text-body-sm">
                    <span>First Date Topic: Life aspirations, Sunday traditions &amp; family dreams</span>
                    <span class="text-secondary font-label-sm text-label-sm font-semibold uppercase tracking-wider">Couples Dispatch</span>
                </div>
            </div>

            <!-- Secondary Monograph Card -->
            <div class="lg:col-span-4 p-8 rounded-3xl bg-surface-container flex flex-col justify-between shadow-sm">
                <div class="flex flex-col gap-4">
                    <span class="font-label-sm text-label-sm text-secondary uppercase tracking-wider">Love Story Spotlight</span>
                    <h3 class="font-headline-sm text-headline-sm text-primary font-semibold">
                        “No performance. Just genuine presence, mutual respect, and pure daylight chemistry.”
                    </h3>
                    <p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
                        “CupDate feels like an exclusive matchmaking club rather than an endless swiping game. We both came in with open hearts and honest relationship intentions.”
                    </p>
                </div>
                <div class="pt-8 flex items-center justify-between">
                    <div>
                        <p class="font-label-md text-label-md text-primary font-semibold">Kaito &amp; Mathilde</p>
                        <p class="font-body-sm text-body-sm text-on-surface-variant">Together 18 Months • Paris Chapter</p>
                    </div>
                    <div class="w-10 h-10 rounded-full bg-[#E87A88]/20 flex items-center justify-center text-[#E87A88]">
                        <span class="material-symbols-outlined text-sm">favorite</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 5: The Manifesto / Contrast Table (Pure Romance & Dating Focus) -->
    <section class="w-full bg-surface-container-low py-20 lg:py-24">
        <div class="max-w-[1360px] mx-auto px-4 sm:px-8 lg:px-margin-desktop">
            <div class="max-w-3xl mx-auto text-center mb-16">
                <span class="font-label-sm text-label-sm text-secondary uppercase tracking-widest">The Philosophy of Intentional Love</span>
                <h2 class="font-headline-lg text-headline-lg text-primary tracking-tight mt-1">
                    Why Modern Dating Needs a Slower Roast
                </h2>
            </div>

            <!-- Split Contrast Table -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-gutter-lg max-w-4xl mx-auto">
                <!-- The Swiping Era -->
                <div class="p-8 rounded-3xl bg-surface-container shadow-sm flex flex-col gap-6 opacity-80">
                    <div class="flex items-center justify-between">
                        <h3 class="font-headline-sm text-headline-sm text-primary font-semibold">The Swipe Fatigue Era</h3>
                        <span class="material-symbols-outlined text-outline">close</span>
                    </div>
                    <ul class="flex flex-col gap-4 font-body-sm text-body-sm text-on-surface-variant">
                        <li class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-outline text-base mt-0.5">remove</span>
                            <span>Weeks of superficial small talk that never materializes into dates</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-outline text-base mt-0.5">remove</span>
                            <span>Loud cocktail bars with $25 drinks and endless yelling over noise</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-outline text-base mt-0.5">remove</span>
                            <span>Dopamine gamification, ghosting culture, and transactional swiping</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-outline text-base mt-0.5">remove</span>
                            <span>Exhausting multi-hour dinner dates with zero emotional synergy</span>
                        </li>
                    </ul>
                </div>

                <!-- The CupDate Atelier -->
                <div class="p-8 rounded-3xl bg-surface-container-lowest shadow-md flex flex-col gap-6 border-l-4 border-[#E87A88]">
                    <div class="flex items-center justify-between">
                        <h3 class="font-headline-sm text-headline-sm text-primary font-semibold">The CupDate Singles Atelier</h3>
                        <span class="material-symbols-outlined text-[#E87A88]">check_circle</span>
                    </div>
                    <ul class="flex flex-col gap-4 font-body-sm text-body-sm text-on-surface">
                        <li class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-secondary text-base mt-0.5">check</span>
                            <span>Curated 45-minute daylight dates arranged with 1 tap</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-secondary text-base mt-0.5">check</span>
                            <span>Real face-to-face conversation in peaceful, romantic atmospheres</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-secondary text-base mt-0.5">check</span>
                            <span>Limited to 3 intentional dossiers per day to foster genuine presence</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-secondary text-base mt-0.5">check</span>
                            <span>Zero pressure, pre-reserved quiet tables, and verified singles</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 6: Interactive Chemistry & Courtship Calculator -->
    <section class="max-w-[1360px] mx-auto w-full px-4 sm:px-8 lg:px-margin-desktop py-20 lg:py-28">
        <div class="p-8 sm:p-12 lg:p-16 rounded-3xl bg-surface-container-low shadow-sm">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-gutter-lg items-center">
                <div class="lg:col-span-5 flex flex-col gap-4">
                    <span class="font-label-sm text-label-sm text-secondary uppercase tracking-widest">Interactive Chemistry Meter</span>
                    <h2 class="font-headline-lg text-headline-lg text-primary tracking-tight">
                        Calculate your courtship circle.
                    </h2>
                    <p class="font-body-md text-body-md text-on-surface-variant">
                        Select your preferred dating atmosphere and relationship horizon to see active verified singles seeking romance right now.
                    </p>
                    <div class="mt-4 p-6 rounded-2xl bg-surface-container-lowest shadow-sm flex items-center justify-between">
                        <div>
                            <span class="font-body-sm text-body-sm text-on-surface-variant">Compatible Singles Nearby</span>
                            <div class="font-headline-lg text-headline-lg text-primary font-bold" id="match-calc-counter">142</div>
                        </div>
                        <div class="w-12 h-12 rounded-full bg-rose-100 flex items-center justify-center text-[#E87A88]">
                            <span class="material-symbols-outlined">favorite</span>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-7 flex flex-col gap-6">
                    <!-- Parameter 1: Preferred Date Style -->
                    <div>
                        <label class="font-label-md text-label-md text-primary font-semibold block mb-2">Ideal Date Window</label>
                        <div class="grid grid-cols-3 gap-2" id="time-window-selector">
                            <button type="button" data-val="morning" class="calc-btn active p-3 rounded-2xl bg-primary text-on-primary font-label-md text-label-md text-center transition-all cursor-pointer">
                                Morning Cortado<br/><span class="text-xs opacity-70 font-normal">9:00 – 10:30 AM</span>
                            </button>
                            <button type="button" data-val="midday" class="calc-btn p-3 rounded-2xl bg-surface-container text-on-surface font-label-md text-label-md text-center transition-all cursor-pointer">
                                Noon Rendezvous<br/><span class="text-xs opacity-70 font-normal">12:30 – 2:00 PM</span>
                            </button>
                            <button type="button" data-val="late" class="calc-btn p-3 rounded-2xl bg-surface-container text-on-surface font-label-md text-label-md text-center transition-all cursor-pointer">
                                Golden Hour Affogato<br/><span class="text-xs opacity-70 font-normal">4:30 – 6:00 PM</span>
                            </button>
                        </div>
                    </div>

                    <!-- Parameter 2: Relationship Intention -->
                    <div>
                        <label class="font-label-md text-label-md text-primary font-semibold block mb-2">Relationship Intention</label>
                        <div class="grid grid-cols-3 gap-2" id="music-vibe-selector">
                            <button type="button" data-val="ambient" class="calc-btn p-3 rounded-2xl bg-surface-container text-on-surface font-label-md text-label-md text-center transition-all cursor-pointer">
                                Slow Dating<br/><span class="text-xs opacity-70 font-normal">Intentional exploration</span>
                            </button>
                            <button type="button" data-val="bossa" class="calc-btn active p-3 rounded-2xl bg-primary text-on-primary font-label-md text-label-md text-center transition-all cursor-pointer">
                                Lifelong Courtship<br/><span class="text-xs opacity-70 font-normal">Devoted partnership</span>
                            </button>
                            <button type="button" data-val="indie" class="calc-btn p-3 rounded-2xl bg-surface-container text-on-surface font-label-md text-label-md text-center transition-all cursor-pointer">
                                Soul Connection<br/><span class="text-xs opacity-70 font-normal">Deep emotional bond</span>
                            </button>
                        </div>
                    </div>

                    <!-- Interactive Resonance Feedback Bar -->
                    <div class="pt-2">
                        <div class="flex items-center justify-between text-on-surface-variant font-label-sm text-label-sm mb-1.5">
                            <span>Vetting Authenticity: Strict Singles Quality</span>
                            <span id="resonance-percent-label">92% Match Probability</span>
                        </div>
                        <div class="h-2 w-full bg-surface-container rounded-full overflow-hidden">
                            <div class="h-full bg-[#E87A88] transition-all duration-500" id="resonance-progress-bar" style="width: 92%;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 7: Join Singles Atelier / Membership Application -->
    <section class="w-full bg-primary text-on-primary py-20 lg:py-28" id="join-house">
        <div class="max-w-[1360px] mx-auto px-4 sm:px-8 lg:px-margin-desktop">
            <div class="max-w-3xl mx-auto text-center flex flex-col items-center gap-6">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-surface-container-high/20 text-tertiary-fixed font-label-sm text-label-sm">
                    <span class="w-2 h-2 rounded-full bg-[#E87A88] animate-pulse"></span>
                    Accepting Applications for Cohort #12
                </div>
                <h2 class="font-headline-xl text-headline-xl text-on-primary tracking-tight text-balance">
                    Begin your slow courtship today.
                </h2>
                <p class="font-body-lg text-body-lg text-on-primary/80 max-w-xl leading-relaxed">
                    Membership is application-only to cultivate authentic intention, emotional presence, and zero ghosting. New invitations released each Friday.
                </p>

                <!-- Subscription Form -->
                <form class="w-full max-w-md flex flex-col sm:flex-row gap-3 pt-4" onsubmit="event.preventDefault(); document.getElementById('apply-success').classList.remove('hidden');">
                    <input class="flex-1 px-5 py-3.5 rounded-full bg-surface-container-high/20 border-0 focus:ring-2 focus:ring-[#E87A88] text-on-primary placeholder:text-on-primary/50 text-body-md font-body-md outline-none" placeholder="Enter your personal email" required="" type="email"/>
                    <button class="px-8 py-3.5 rounded-full bg-[#E87A88] text-white font-label-lg text-label-lg shadow-lg hover:brightness-110 active:scale-95 transition-all whitespace-nowrap cursor-pointer" type="submit">
                        Join Singles Atelier
                    </button>
                </form>
                <div class="hidden font-body-sm text-body-sm text-secondary-fixed pt-2 animate-fade-in" id="apply-success">
                    ✓ Application dispatched. Our match curators review submissions within 48 hours.
                </div>

                <!-- Trust Badges -->
                <div class="flex flex-wrap items-center justify-center gap-6 pt-6 text-on-primary/60 font-body-sm text-body-sm">
                    <span class="flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-sm">verified_user</span> Human Vetted Profiles
                    </span>
                    <span class="flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-sm">schedule</span> Unhurried 45-Min Dates
                    </span>
                    <span class="flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-sm">favorite</span> Zero Casual Ghosting
                    </span>
                </div>
            </div>
        </div>
    </section>

    <!-- Verified Singles Showcase (Live Database Daters) -->
    @if(isset($featuredDaters) && $featuredDaters->count() > 0)
        <section class="w-full py-space-xl bg-surface-container-low/40">
            <div class="max-w-[1360px] mx-auto px-4 sm:px-6 lg:px-margin-desktop flex flex-col gap-space-lg">
                <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-space-sm">
                    <div>
                        <span class="font-label-sm text-label-sm uppercase tracking-wider text-secondary">Community</span>
                        <h2 class="font-headline-lg text-headline-lg text-on-surface tracking-tight">Verified Singles on CupDate</h2>
                    </div>
                    <a href="{{ Auth::check() ? route('swipes') : route('register') }}" class="font-label-md text-label-md text-secondary hover:underline flex items-center gap-1">
                        <span>Meet All Verified Members</span>
                        <span class="material-symbols-outlined text-sm">arrow_forward</span>
                    </a>
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-8 gap-space-md">
                    @foreach($featuredDaters as $dater)
                        <a href="{{ Auth::check() ? route('profile', $dater->id) : route('register') }}" class="scroll-reveal group flex flex-col items-center text-center p-3 rounded-2xl bg-surface-container-lowest shadow-xs hover:shadow-md hover:-translate-y-1 transition-all">
                            <div class="relative w-16 h-16 sm:w-20 sm:h-20 rounded-full overflow-hidden mb-2 ring-2 ring-outline-variant/50 group-hover:ring-secondary transition-all">
                                <img src="{{ $dater->avatar_url }}" alt="{{ $dater->full_name }}" loading="lazy" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                @if($dater->is_verified)
                                    <span class="material-symbols-outlined text-emerald-600 text-xs absolute bottom-0 right-0 bg-surface rounded-full p-0.5">verified</span>
                                @endif
                            </div>
                            <span class="font-label-md text-label-md text-on-surface font-semibold truncate w-full">{{ explode(' ', $dater->full_name)[0] }}</span>
                            <span class="text-[11px] text-on-surface-variant truncate w-full">{{ $dater->city ?? 'New York' }}</span>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- ========================================================================= -->
    <!-- #1 BEST DATING WEBSITE IN HIMACHAL PRADESH, INDIA & WORLDWIDE (SEO SUITE) -->
    <!-- ========================================================================= -->
    <section class="w-full py-20 bg-gradient-to-b from-surface via-surface-container-low/40 to-surface-container-high/30 border-t border-[#ebdcd7]" id="himachal-dating-hub">
        <div class="max-w-[1360px] mx-auto px-4 sm:px-6 lg:px-margin-desktop">
            
            <!-- Section Header -->
            <div class="text-center max-w-3xl mx-auto mb-14">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white border border-[#E87A88]/40 shadow-xs mb-4">
                    <span class="material-symbols-outlined text-sm text-[#E87A88]">mountain_flag</span>
                    <span class="text-xs font-bold uppercase tracking-widest text-[#8b5a2b]">The #1 Dating Destination in the Hills</span>
                </div>
                <h2 class="font-headline-xl text-3xl sm:text-4xl md:text-5xl font-black text-primary tracking-tight text-balance leading-tight">
                    The Best Dating Website in Himachal Pradesh, India &amp; Worldwide
                </h2>
                <p class="font-body-lg text-base sm:text-lg text-on-surface-variant mt-4 leading-relaxed text-balance">
                    From the lush tea estates of <strong>Kangra</strong> and riverine apple orchards of <strong>Kullu</strong> to the temple riverbanks of <strong>Mandi</strong>, pine ridges of <strong>Shimla</strong>, and vibrant metros across India and abroad — CupDate pairs verified, intentional singles over unhurried coffee dates.
                </p>
            </div>

            <!-- Himachal Pradesh Major Dating Chapters (Kangra, Kullu, Mandi & Hills) -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                
                <!-- Kangra Chapter Card -->
                <div class="bg-white rounded-3xl p-6 sm:p-7 border border-[#e8d8cc] shadow-sm hover:shadow-md transition-all flex flex-col justify-between group hover:-translate-y-1">
                    <div>
                        <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-700 flex items-center justify-center mb-4 shadow-xs group-hover:scale-105 transition-transform">
                            <span class="material-symbols-outlined text-2xl">eco</span>
                        </div>
                        <span class="text-xs font-bold uppercase tracking-wider text-emerald-700">Dhauladhar Valleys &amp; Tea Trails</span>
                        <h3 class="text-xl sm:text-2xl font-bold text-primary mt-1 mb-3">Dating in Kangra</h3>
                        <p class="text-xs sm:text-sm text-on-surface-variant leading-relaxed mb-4">
                            Surrounded by the majestic snowcapped Dhauladhar range, Kangra offers scenic terraced tea estates, historic fort pathways, and peaceful streamside cafes. Whether you live in Kangra town, Dharamshala, or Palampur, connect with authentic local singles who appreciate mountain life, meaningful conversation, and slow sips.
                        </p>
                    </div>
                    <div class="pt-4 border-t border-gray-100 flex items-center justify-between">
                        <span class="text-xs font-semibold text-secondary">Verified Local Singles</span>
                        <a href="{{ route('city.show', 'kangra') }}" class="inline-flex items-center gap-1 text-xs font-bold text-[#E87A88] group-hover:translate-x-1 transition-transform">
                            <span>Explore Kangra</span>
                            <span class="material-symbols-outlined text-sm">arrow_forward</span>
                        </a>
                    </div>
                </div>

                <!-- Kullu & Manali Chapter Card -->
                <div class="bg-white rounded-3xl p-6 sm:p-7 border border-[#e8d8cc] shadow-sm hover:shadow-md transition-all flex flex-col justify-between group hover:-translate-y-1">
                    <div>
                        <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-700 flex items-center justify-center mb-4 shadow-xs group-hover:scale-105 transition-transform">
                            <span class="material-symbols-outlined text-2xl">nature_people</span>
                        </div>
                        <span class="text-xs font-bold uppercase tracking-wider text-amber-700">Valley of Gods &amp; River Beas</span>
                        <h3 class="text-xl sm:text-2xl font-bold text-primary mt-1 mb-3">Dating in Kullu &amp; Manali</h3>
                        <p class="text-xs sm:text-sm text-on-surface-variant leading-relaxed mb-4">
                            From riverside open-air log cabins in Old Manali to pine-fringed cafes around Dhalpur in Kullu, this alpine haven brings adventurous, nature-loving singles together. Share fresh apple pies, artisan French roast coffees, and conversations that easily flow into weekend treks and starry terrace strolls.
                        </p>
                    </div>
                    <div class="pt-4 border-t border-gray-100 flex items-center justify-between">
                        <span class="text-xs font-semibold text-secondary">Alpine Coffee Romance</span>
                        <a href="{{ route('city.show', 'kullu') }}" class="inline-flex items-center gap-1 text-xs font-bold text-[#E87A88] group-hover:translate-x-1 transition-transform">
                            <span>Explore Kullu</span>
                            <span class="material-symbols-outlined text-sm">arrow_forward</span>
                        </a>
                    </div>
                </div>

                <!-- Mandi Chapter Card -->
                <div class="bg-white rounded-3xl p-6 sm:p-7 border border-[#e8d8cc] shadow-sm hover:shadow-md transition-all flex flex-col justify-between group hover:-translate-y-1">
                    <div>
                        <div class="w-12 h-12 rounded-2xl bg-rose-50 text-rose-700 flex items-center justify-center mb-4 shadow-xs group-hover:scale-105 transition-transform">
                            <span class="material-symbols-outlined text-2xl">temple_hindu</span>
                        </div>
                        <span class="text-xs font-bold uppercase tracking-wider text-rose-700">Chhoti Kashi &amp; Beas Promenades</span>
                        <h3 class="text-xl sm:text-2xl font-bold text-primary mt-1 mb-3">Dating in Mandi</h3>
                        <p class="text-xs sm:text-sm text-on-surface-variant leading-relaxed mb-4">
                            Known as the Varanasi of the Hills, Mandi pairs 81 historic stone temples with serene riverbanks along the Beas and vibrant cafes around the Sunken Garden. An ideal setting for educated professionals and thoughtful singles seeking genuine, values-aligned courtship with zero ghosting.
                        </p>
                    </div>
                    <div class="pt-4 border-t border-gray-100 flex items-center justify-between">
                        <span class="text-xs font-semibold text-secondary">Heritage &amp; Romance</span>
                        <a href="{{ route('city.show', 'mandi') }}" class="inline-flex items-center gap-1 text-xs font-bold text-[#E87A88] group-hover:translate-x-1 transition-transform">
                            <span>Explore Mandi</span>
                            <span class="material-symbols-outlined text-sm">arrow_forward</span>
                        </a>
                    </div>
                </div>

            </div>

            <!-- Deep Editorial Prose: Why CupDate is #1 in Himachal, India & Globally -->
            <div class="bg-white/90 backdrop-blur-md rounded-3xl p-8 sm:p-10 border border-[#e8d8cc] shadow-sm mb-12">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
                    <div class="space-y-4">
                        <span class="text-xs font-bold uppercase tracking-widest text-[#8b5a2b]">The Mountain Courtship Manifesto</span>
                        <h3 class="text-2xl sm:text-3xl font-bold text-primary leading-snug">
                            Why Himachal Singles Choose CupDate Over Superficial Dating Apps
                        </h3>
                        <p class="text-sm text-on-surface-variant leading-relaxed">
                            Traditional dating apps are saturated with fake accounts, ghosting, and superficial swipe fatigue. CupDate was built on a different premise: <strong>meaningful connection takes daylight, intentionality, and a shared cup of coffee.</strong>
                        </p>
                        <p class="text-sm text-on-surface-variant leading-relaxed">
                            Every member undergoes <strong>100% selfie verification</strong> to ensure authentic identities. Whether you are living in Himachal Pradesh, working remotely from the hills, or seeking a genuine connection across Chandigarh Tri-City, Delhi NCR, or overseas, CupDate provides a private, respectful haven.
                        </p>
                        <div class="grid grid-cols-2 gap-4 pt-2">
                            <div class="p-3 rounded-2xl bg-[#faf5f0] border border-[#ebdcd7]">
                                <span class="font-bold text-base text-[#8b5a2b]">100%</span>
                                <p class="text-[11px] text-gray-600">Selfie Verified Singles</p>
                            </div>
                            <div class="p-3 rounded-2xl bg-[#faf5f0] border border-[#ebdcd7]">
                                <span class="font-bold text-base text-[#8b5a2b]">45 Mins</span>
                                <p class="text-[11px] text-gray-600">Low-Pressure Daylight Dates</p>
                            </div>
                        </div>
                    </div>

                    <!-- City & Global Quick Directory Pills -->
                    <div class="flex flex-col gap-4">
                        <span class="text-xs font-bold uppercase tracking-wider text-secondary">Active Dating Hubs &amp; City Guides:</span>
                        
                        <!-- Himachal Pradesh Chapters -->
                        <div>
                            <span class="text-xs font-semibold text-gray-500 mb-2 block">🏔️ Himachal Pradesh Chapters:</span>
                            <div class="flex flex-wrap gap-2">
                                <a href="{{ route('city.show', 'kangra') }}" class="px-3 py-1.5 rounded-full bg-surface-container hover:bg-[#8b5a2b] hover:text-white transition-all text-xs font-semibold shadow-xs">Kangra</a>
                                <a href="{{ route('city.show', 'kullu') }}" class="px-3 py-1.5 rounded-full bg-surface-container hover:bg-[#8b5a2b] hover:text-white transition-all text-xs font-semibold shadow-xs">Kullu</a>
                                <a href="{{ route('city.show', 'mandi') }}" class="px-3 py-1.5 rounded-full bg-surface-container hover:bg-[#8b5a2b] hover:text-white transition-all text-xs font-semibold shadow-xs">Mandi</a>
                                <a href="{{ route('city.show', 'shimla') }}" class="px-3 py-1.5 rounded-full bg-surface-container hover:bg-[#8b5a2b] hover:text-white transition-all text-xs font-semibold shadow-xs">Shimla</a>
                                <a href="{{ route('city.show', 'manali') }}" class="px-3 py-1.5 rounded-full bg-surface-container hover:bg-[#8b5a2b] hover:text-white transition-all text-xs font-semibold shadow-xs">Manali</a>
                                <a href="{{ route('city.show', 'dharamshala') }}" class="px-3 py-1.5 rounded-full bg-surface-container hover:bg-[#8b5a2b] hover:text-white transition-all text-xs font-semibold shadow-xs">Dharamshala &amp; McLeodGanj</a>
                                <a href="{{ route('city.show', 'solan') }}" class="px-3 py-1.5 rounded-full bg-surface-container hover:bg-[#8b5a2b] hover:text-white transition-all text-xs font-semibold shadow-xs">Solan</a>
                                <a href="{{ route('city.show', 'hamirpur') }}" class="px-3 py-1.5 rounded-full bg-surface-container hover:bg-[#8b5a2b] hover:text-white transition-all text-xs font-semibold shadow-xs">Hamirpur</a>
                                <a href="{{ route('city.show', 'bilaspur') }}" class="px-3 py-1.5 rounded-full bg-surface-container hover:bg-[#8b5a2b] hover:text-white transition-all text-xs font-semibold shadow-xs">Bilaspur</a>
                                <a href="{{ route('city.show', 'una') }}" class="px-3 py-1.5 rounded-full bg-surface-container hover:bg-[#8b5a2b] hover:text-white transition-all text-xs font-semibold shadow-xs">Una</a>
                                <a href="{{ route('city.show', 'palampur') }}" class="px-3 py-1.5 rounded-full bg-surface-container hover:bg-[#8b5a2b] hover:text-white transition-all text-xs font-semibold shadow-xs">Palampur</a>
                                <a href="{{ route('city.show', 'kasauli') }}" class="px-3 py-1.5 rounded-full bg-surface-container hover:bg-[#8b5a2b] hover:text-white transition-all text-xs font-semibold shadow-xs">Kasauli</a>
                            </div>
                        </div>

                        <!-- Pan-India & Global NRI Chapters -->
                        <div class="pt-2">
                            <span class="text-xs font-semibold text-gray-500 mb-2 block">🇮🇳 India &amp; 🌍 Worldwide Chapters:</span>
                            <div class="flex flex-wrap gap-2">
                                <a href="{{ route('city.show', 'chandigarh') }}" class="px-3 py-1.5 rounded-full bg-surface-container hover:bg-[#8b5a2b] hover:text-white transition-all text-xs font-semibold shadow-xs">Chandigarh Tri-City</a>
                                <a href="{{ route('city.show', 'delhi') }}" class="px-3 py-1.5 rounded-full bg-surface-container hover:bg-[#8b5a2b] hover:text-white transition-all text-xs font-semibold shadow-xs">Delhi NCR</a>
                                <a href="{{ route('city.show', 'pune') }}" class="px-3 py-1.5 rounded-full bg-surface-container hover:bg-[#8b5a2b] hover:text-white transition-all text-xs font-semibold shadow-xs">Pune</a>
                                <a href="{{ route('city.show', 'mumbai') }}" class="px-3 py-1.5 rounded-full bg-surface-container hover:bg-[#8b5a2b] hover:text-white transition-all text-xs font-semibold shadow-xs">Mumbai</a>
                                <a href="{{ route('city.show', 'bangalore') }}" class="px-3 py-1.5 rounded-full bg-surface-container hover:bg-[#8b5a2b] hover:text-white transition-all text-xs font-semibold shadow-xs">Bangalore</a>
                                <a href="{{ route('city.show', 'jaipur') }}" class="px-3 py-1.5 rounded-full bg-surface-container hover:bg-[#8b5a2b] hover:text-white transition-all text-xs font-semibold shadow-xs">Jaipur</a>
                                <a href="{{ route('city.show', 'goa') }}" class="px-3 py-1.5 rounded-full bg-surface-container hover:bg-[#8b5a2b] hover:text-white transition-all text-xs font-semibold shadow-xs">Goa</a>
                                <a href="{{ route('cities.index') }}" class="px-3 py-1.5 rounded-full bg-[#E87A88] text-white hover:brightness-105 transition-all text-xs font-bold shadow-xs">All 25+ City Guides →</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- High-SEO Viral Content Rich FAQ Section -->
    <section class="w-full py-space-xl bg-surface-container-low/60 border-t border-b border-[#ebdcd7]" id="homeFaqSection">
        <div class="max-w-[1100px] mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-10">
                <span class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-white border border-[#ff007f]/30 text-[#ff007f] mb-3 shadow-2xs">
                    <span class="material-symbols-outlined text-sm">help</span>
                    <span>Frequently Asked Questions &amp; Knowledge Base</span>
                </span>
                <h2 class="font-headline-lg text-2xl sm:text-3xl md:text-4xl text-on-surface font-black tracking-tight">
                    Everything You Need to Know About <span class="neon-pink-text">CupDate.in</span>
                </h2>
                <p class="font-body-md text-sm text-on-surface-variant mt-2 leading-relaxed">
                    India's leading intentional coffee matchmaking platform. Learn how verified selfie profiles, landmark partner cafés, and respectful dates work across Himachal Pradesh and major metro hubs.
                </p>
            </div>

            <!-- FAQ Accordion List -->
            <div class="space-y-3.5" id="homeFaqAccordion">
                
                <!-- Q1 -->
                <div class="bg-white rounded-2xl border border-outline-variant/40 p-4 sm:p-5 shadow-xs transition-all duration-200">
                    <button type="button" onclick="toggleHomeFaq(this)" class="w-full flex items-center justify-between text-left gap-4 cursor-pointer focus:outline-none">
                        <span class="font-headline-sm text-sm sm:text-base font-bold text-on-surface">
                            What makes CupDate.in different from Tinder, Bumble, or matrimonial sites?
                        </span>
                        <span class="material-symbols-outlined text-secondary text-xl transition-transform duration-200 shrink-0 faq-arrow">expand_more</span>
                    </button>
                    <div class="faq-ans hidden mt-3 pt-3 border-t border-gray-100 text-xs sm:text-sm text-on-surface-variant leading-relaxed">
                        CupDate replaces endless, superficial swiping fatigue with intentional 45-minute coffee dates. Every single profile is 100% selfie-verified, eliminating bots, catfish, and ghosting. Instead of awkward dinner dates or endless pen-palling, CupDate partners with hand-picked specialty roasteries where you can meet safely in a relaxed, public environment.
                    </div>
                </div>

                <!-- Q2 -->
                <div class="bg-white rounded-2xl border border-outline-variant/40 p-4 sm:p-5 shadow-xs transition-all duration-200">
                    <button type="button" onclick="toggleHomeFaq(this)" class="w-full flex items-center justify-between text-left gap-4 cursor-pointer focus:outline-none">
                        <span class="font-headline-sm text-sm sm:text-base font-bold text-on-surface">
                            Which cities in Himachal Pradesh and India are live on CupDate?
                        </span>
                        <span class="material-symbols-outlined text-secondary text-xl transition-transform duration-200 shrink-0 faq-arrow">expand_more</span>
                    </button>
                    <div class="faq-ans hidden mt-3 pt-3 border-t border-gray-100 text-xs sm:text-sm text-on-surface-variant leading-relaxed">
                        CupDate is hyper-localized across Himachal Pradesh including <strong>Kangra, Dharamshala, McLeodGanj, Shimla, Solan, Manali, Mandi, Kullu, Palampur, and Hamirpur</strong>. We also support active metro chapters in <strong>Chandigarh Tri-City, Delhi NCR, Pune, Mumbai, Bangalore, Jaipur, and Goa</strong> with over 850+ partner cafés.
                    </div>
                </div>

                <!-- Q3 -->
                <div class="bg-white rounded-2xl border border-outline-variant/40 p-4 sm:p-5 shadow-xs transition-all duration-200">
                    <button type="button" onclick="toggleHomeFaq(this)" class="w-full flex items-center justify-between text-left gap-4 cursor-pointer focus:outline-none">
                        <span class="font-headline-sm text-sm sm:text-base font-bold text-on-surface">
                            How does 100% selfie verification protect against catfishing and fake accounts?
                        </span>
                        <span class="material-symbols-outlined text-secondary text-xl transition-transform duration-200 shrink-0 faq-arrow">expand_more</span>
                    </button>
                    <div class="faq-ans hidden mt-3 pt-3 border-t border-gray-100 text-xs sm:text-sm text-on-surface-variant leading-relaxed">
                        During signup, members submit a live 3D selfie test that checks for liveness and facial landmarks. Our verification engine ensures the photos in the user's gallery match the person holding the device. Only verified accounts receive the official CupDate Blue Checkmark and can initiate chats or send date invites.
                    </div>
                </div>

                <!-- Q4 -->
                <div class="bg-white rounded-2xl border border-outline-variant/40 p-4 sm:p-5 shadow-xs transition-all duration-200">
                    <button type="button" onclick="toggleHomeFaq(this)" class="w-full flex items-center justify-between text-left gap-4 cursor-pointer focus:outline-none">
                        <span class="font-headline-sm text-sm sm:text-base font-bold text-on-surface">
                            Why are 45-minute coffee dates better than traditional dinner dates?
                        </span>
                        <span class="material-symbols-outlined text-secondary text-xl transition-transform duration-200 shrink-0 faq-arrow">expand_more</span>
                    </button>
                    <div class="faq-ans hidden mt-3 pt-3 border-t border-gray-100 text-xs sm:text-sm text-on-surface-variant leading-relaxed">
                        Traditional dinner dates cost thousands of rupees and lock you into a 2-hour formal meal even if there is zero chemistry. A 45-minute coffee date is casual, daytime-safe, highly affordable, and allows a graceful exit if you don't click — or can easily be extended to an afternoon walk if sparks fly.
                    </div>
                </div>

                <!-- Q5 -->
                <div class="bg-white rounded-2xl border border-outline-variant/40 p-4 sm:p-5 shadow-xs transition-all duration-200">
                    <button type="button" onclick="toggleHomeFaq(this)" class="w-full flex items-center justify-between text-left gap-4 cursor-pointer focus:outline-none">
                        <span class="font-headline-sm text-sm sm:text-base font-bold text-on-surface">
                            How is women's safety and location privacy handled on CupDate?
                        </span>
                        <span class="material-symbols-outlined text-secondary text-xl transition-transform duration-200 shrink-0 faq-arrow">expand_more</span>
                    </button>
                    <div class="faq-ans hidden mt-3 pt-3 border-t border-gray-100 text-xs sm:text-sm text-on-surface-variant leading-relaxed">
                        We comply strictly with India's Digital Personal Data Protection (DPDP) Act 2023. We utilize <strong>Ghost Location Fuzzing</strong>, which shifts GPS coordinates by 1.5 to 2.5 kilometers so your precise home address or workplace is never exposed. Furthermore, our built-in chat allows full communication and image exchange without ever sharing your phone number or WhatsApp.
                    </div>
                </div>

                <!-- Q6 -->
                <div class="bg-white rounded-2xl border border-outline-variant/40 p-4 sm:p-5 shadow-xs transition-all duration-200">
                    <button type="button" onclick="toggleHomeFaq(this)" class="w-full flex items-center justify-between text-left gap-4 cursor-pointer focus:outline-none">
                        <span class="font-headline-sm text-sm sm:text-base font-bold text-on-surface">
                            How do I get 15% to 20% off at partner cafés during my date?
                        </span>
                        <span class="material-symbols-outlined text-secondary text-xl transition-transform duration-200 shrink-0 faq-arrow">expand_more</span>
                    </button>
                    <div class="faq-ans hidden mt-3 pt-3 border-t border-gray-100 text-xs sm:text-sm text-on-surface-variant leading-relaxed">
                        Simply explore our <a href="{{ route('dates') }}" class="text-[#ff007f] font-bold underline">Partner Cafés</a> directory, select a venue in your city, and invite your match. When requesting the bill, flash your verified CupDate digital Member Badge (#CD-XXXXX) from your mobile app to enjoy exclusive discounts, free drink upgrades, or priority quiet table reservations.
                    </div>
                </div>

                <!-- Q7 -->
                <div class="bg-white rounded-2xl border border-outline-variant/40 p-4 sm:p-5 shadow-xs transition-all duration-200">
                    <button type="button" onclick="toggleHomeFaq(this)" class="w-full flex items-center justify-between text-left gap-4 cursor-pointer focus:outline-none">
                        <span class="font-headline-sm text-sm sm:text-base font-bold text-on-surface">
                            Can I use CupDate for serious matrimony, rishta, and long-term relationships?
                        </span>
                        <span class="material-symbols-outlined text-secondary text-xl transition-transform duration-200 shrink-0 faq-arrow">expand_more</span>
                    </button>
                    <div class="faq-ans hidden mt-3 pt-3 border-t border-gray-100 text-xs sm:text-sm text-on-surface-variant leading-relaxed">
                        Yes! CupDate hosts a dedicated <a href="{{ route('rishta') }}" class="text-[#ff007f] font-bold underline">Traditional Rishta &amp; Matrimony Hub</a> specifically for singles and families who value values-aligned, intentional conversations over endless biodata exchanges. Over 74% of our coffee daters progress to a second date!
                    </div>
                </div>

                <!-- Q8 -->
                <div class="bg-white rounded-2xl border border-outline-variant/40 p-4 sm:p-5 shadow-xs transition-all duration-200">
                    <button type="button" onclick="toggleHomeFaq(this)" class="w-full flex items-center justify-between text-left gap-4 cursor-pointer focus:outline-none">
                        <span class="font-headline-sm text-sm sm:text-base font-bold text-on-surface">
                            Is CupDate free to join and start dating?
                        </span>
                        <span class="material-symbols-outlined text-secondary text-xl transition-transform duration-200 shrink-0 faq-arrow">expand_more</span>
                    </button>
                    <div class="faq-ans hidden mt-3 pt-3 border-t border-gray-100 text-xs sm:text-sm text-on-surface-variant leading-relaxed">
                        Yes! CupDate is 100% free to join, verify, browse verified singles in your city, and exchange messages. Optional VIP perks and profile boosts can be redeemed with daily coffee bean streak coins earned by logging in daily.
                    </div>
                </div>

            </div>

            <div class="mt-8 text-center">
                <a href="{{ route('faq') }}" class="inline-flex items-center gap-1 text-xs font-bold text-secondary hover:text-[#ff007f] transition">
                    <span>View all 25+ Dating &amp; Safety Questions in Knowledge Base</span>
                    <span class="material-symbols-outlined text-sm">arrow_forward</span>
                </a>
            </div>
        </div>
    </section>

    <!-- Schema.org FAQPage & DatingApp JSON-LD for Google Rich Snippets -->
    <script type="application/ld+json">
    {
      "@@context": "https://schema.org",
      "@graph": [
        {
          "@type": "WebSite",
          "@id": "https://cupdate.in/#website",
          "url": "https://cupdate.in",
          "name": "CupDate",
          "description": "India's 100% Selfie-Verified Coffee Dating and Intentional Matchmaking Platform",
          "inLanguage": "en-IN"
        },
        {
          "@type": "FAQPage",
          "@id": "https://cupdate.in/#faq",
          "mainEntity": [
            {
              "@type": "Question",
              "name": "What makes CupDate.in different from other dating apps?",
              "acceptedAnswer": {
                "@type": "Answer",
                "text": "CupDate replaces endless swiping with intentional 45-minute coffee dates. All profiles are 100% selfie-verified, and members meet at vetted partner cafes across Himachal Pradesh and India."
              }
            },
            {
              "@type": "Question",
              "name": "Which cities in Himachal Pradesh are live on CupDate?",
              "acceptedAnswer": {
                "@type": "Answer",
                "text": "Kangra, Dharamshala, McLeodGanj, Shimla, Solan, Manali, Mandi, Kullu, Palampur, and Hamirpur, plus Chandigarh, Delhi, Pune, and Mumbai."
              }
            },
            {
              "@type": "Question",
              "name": "How does CupDate protect women's privacy and safety?",
              "acceptedAnswer": {
                "@type": "Answer",
                "text": "CupDate complies with India's DPDP Act 2023, employs Ghost Location Fuzzing (1.5-2km location shift), and enables in-app messaging without sharing personal phone numbers."
              }
            },
            {
              "@type": "Question",
              "name": "Which is the best dating website in Himachal Pradesh (Kangra, Kullu, Mandi, Shimla)?",
              "acceptedAnswer": {
                "@type": "Answer",
                "text": "CupDate.in is rated the #1 best dating website in Himachal Pradesh, connecting intentional singles across Kangra, Kullu, Mandi, Shimla, Manali, Dharamshala, and Solan. It features 100% selfie-verified profiles, safe public partner cafes, and unhurried 45-minute coffee dates."
              }
            },
            {
              "@type": "Question",
              "name": "Is CupDate free to join?",
              "acceptedAnswer": {
                "@type": "Answer",
                "text": "Yes, CupDate is 100% free to join, selfie-verify, browse verified singles, and chat."
              }
            }
          ]
        }
      ]
    }
    </script>

    <!-- Bottom CTA Conversion Banner -->
    <section class="w-full py-space-xl mb-space-lg">
        <div class="max-w-[1360px] mx-auto px-4 sm:px-6 lg:px-margin-desktop">
            <div class="scroll-reveal w-full rounded-xl bg-primary-container text-on-primary p-space-xl shadow-lg relative overflow-hidden">
                <!-- Subtle Decorative Background Circles -->
                <div class="absolute -top-20 -left-20 w-80 h-80 rounded-full bg-secondary/20 blur-3xl pointer-events-none"></div>
                <div class="absolute bottom-0 right-10 w-64 h-64 rounded-full bg-on-tertiary-container/15 blur-2xl pointer-events-none animate-aroma"></div>
                
                <div class="relative z-10 max-w-2xl mx-auto text-center flex flex-col items-center gap-space-md">
                    <div class="w-12 h-12 rounded-full bg-surface/10 backdrop-blur-md flex items-center justify-center text-primary-fixed">
                        <span class="material-symbols-outlined text-2xl">local_cafe</span>
                    </div>
                    <h2 class="font-headline-lg text-headline-lg tracking-tight text-surface-container-lowest">
                        Ready for your next favorite conversation?
                    </h2>
                    <p class="font-body-md text-body-md text-primary-fixed-dim max-w-lg leading-relaxed">
                        Join CupDate today. Slow down, skip the superficial small talk, and meet someone special at your corner café this week.
                    </p>

                    <!-- Input Group -->
                    <form class="w-full max-w-md mt-space-sm flex flex-col sm:flex-row items-center gap-space-xs p-1.5 rounded-2xl sm:rounded-full bg-surface-container-lowest/10 backdrop-blur-md shadow-inner transition-all focus-within:ring-2 focus-within:ring-on-tertiary-container/60" onsubmit="handleInviteForm(event)">
                        <input id="inviteContactInput" class="w-full px-space-md py-space-sm rounded-full bg-transparent text-surface placeholder:text-primary-fixed-dim/60 font-body-sm text-body-sm focus:outline-none" placeholder="Enter your phone or email..." required="" type="text"/>
                        <button class="w-full sm:w-auto shrink-0 px-space-lg py-space-sm rounded-full bg-on-tertiary-container text-on-tertiary font-label-md text-label-md shadow-md hover:opacity-95 hover:scale-[1.02] active:scale-[0.98] transition-all cursor-pointer" type="submit">
                            Get Invitation
                        </button>
                    </form>

                    <div class="flex flex-wrap items-center justify-center gap-space-md text-primary-fixed-dim/70 font-label-sm text-label-sm pt-space-xs">
                        <span class="flex items-center gap-1">
                            <span class="material-symbols-outlined text-sm">verified_user</span> Private &amp; Vetted
                        </span>
                        <span>•</span>
                        <span>Zero Swiping Algorithms</span>
                        <span>•</span>
                        <span>Free to Begin</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
@endsection

@section('extra_js')
<script>
    // 1. Scroll-driven staggered interactive reveals
    document.addEventListener('DOMContentLoaded', () => {
        const reveals = document.querySelectorAll('.scroll-reveal');
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('active');
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.12,
            rootMargin: '0px 0px -40px 0px'
        });

        reveals.forEach((el) => observer.observe(el));
    });

    // 2. Interactive City Selector Pills with City Data
    const cityData = {
        nyc: [
            {
                tag: 'West Village • SoHo',
                cafes: '34 partner cafés',
                title: 'The Downtown Brew Club',
                desc: 'Cozy leather armchairs, single-origin natural Ethiopians, and effortless post-gallery walking loops through cobblestone alleys.',
                members: '3,420 members',
                img: 'https://lh3.googleusercontent.com/aida-public/AB6AXuDx-eV2uFVmFf9BmUODB82Pqfq3a3E353awr12jdNKlwDtWTU4RTILN53iyMroFw3cyoyVXeUdsG1WabdqwaziDxTpQhKCxwDtk_54Ujy7qtYD54eha8QMiszX1Is7S-7mrJ9HNZWPQabMNLbm2oHk-mX7374uxQdlGXdv-JaZlvO4IrIBXtdyvfdxRJlyN9hDzwytDlOz9xR-grqHFIOu0EdEkds1gMafQ9MimuuT0LvUXs43u9Kb_fw',
                link: "{{ route('city.show', 'new-york') }}"
            },
            {
                tag: 'Williamsburg • Greenpoint',
                cafes: '26 partner cafés',
                title: 'Brooklyn Roaster Guild',
                desc: 'Sunlit industrial lofts, oat flat whites on rustic pine benches, and intimate weekend chats before McCarren Park strolls.',
                members: '2,910 members',
                img: 'https://lh3.googleusercontent.com/aida-public/AB6AXuBI00sDnJgZUnyHWg3FWOe3p6hMv7pLdMkVE5fjs4NyPlldF_QEb5DdKzZ4qC9-VDU5O0XSWIQU4drx_n4JG8Gh2uzPYrwBzr56gybOAEY4cAIghEj79ihvbgFsSaWH_6A6tTq4usq_XlNjjhx3P7d7GqtCIRKRMF3M8DI3DIkE3PN0mafcBClLVOLQjbpqvVUviXNcSmdoTbYOe5ANxsK-Ujoq-DZkWfqMPa_aCSS28zZVwZ43mO7bXw',
                link: "{{ route('city.show', 'new-york') }}"
            },
            {
                tag: 'Nolita • Lower East Side',
                cafes: '31 partner cafés',
                title: 'The Lower Manhattan Chapter',
                desc: 'Artisan cortados, curated vintage paperbacks, and charming corner banquettes made for sparking low-pressure chemistry.',
                members: '2,450 members',
                img: 'https://lh3.googleusercontent.com/aida-public/AB6AXuCsQFJJkHjGfBufuaZ6nur3gJ5jEifKzWbT4eYm9qHnrXqscr3KBWfy5AI8m1KGvK7o8RnqcwaxMXdSoWmlFc7KeXQsDae3GC-KpjVqYzkfhwqTjNcQQfuma5OJdzVzrIJyq4MkOVELnyp5hblwI3oXK8p7ufcYzX2X7dtmyXPVgQFfZZjK2nGF_W7AchMRgf5ZF9wTRCVCR40nU-cWyyz9gUmGgAbLC-C16VyUgc8SA2dSf6cQ8RjAZg',
                link: "{{ route('city.show', 'new-york') }}"
            }
        ],
        london: [
            {
                tag: 'Shoreditch • Hackney',
                cafes: '28 partner cafés',
                title: 'East London Writers & Roasters',
                desc: 'Aeropress rituals, cinnamon brioche buns, and creative dialogs designed for architects, designers, and late-morning thinkers.',
                members: '2,890 members',
                img: 'https://lh3.googleusercontent.com/aida-public/AB6AXuBI00sDnJgZUnyHWg3FWOe3p6hMv7pLdMkVE5fjs4NyPlldF_QEb5DdKzZ4qC9-VDU5O0XSWIQU4drx_n4JG8Gh2uzPYrwBzr56gybOAEY4cAIghEj79ihvbgFsSaWH_6A6tTq4usq_XlNjjhx3P7d7GqtCIRKRMF3M8DI3DIkE3PN0mafcBClLVOLQjbpqvVUviXNcSmdoTbYOe5ANxsK-Ujoq-DZkWfqMPa_aCSS28zZVwZ43mO7bXw',
                link: "{{ route('city.show', 'london') }}"
            },
            {
                tag: 'Soho • Fitzrovia',
                cafes: '33 partner cafés',
                title: 'The Central London Atelier',
                desc: 'Historic townhouses turned espresso bars, artisanal filter coffee, and intimate chats tucked behind theater row.',
                members: '3,110 members',
                img: 'https://lh3.googleusercontent.com/aida-public/AB6AXuDx-eV2uFVmFf9BmUODB82Pqfq3a3E353awr12jdNKlwDtWTU4RTILN53iyMroFw3cyoyVXeUdsG1WabdqwaziDxTpQhKCxwDtk_54Ujy7qtYD54eha8QMiszX1Is7S-7mrJ9HNZWPQabMNLbm2oHk-mX7374uxQdlGXdv-JaZlvO4IrIBXtdyvfdxRJlyN9hDzwytDlOz9xR-grqHFIOu0EdEkds1gMafQ9MimuuT0LvUXs43u9Kb_fw',
                link: "{{ route('city.show', 'london') }}"
            },
            {
                tag: 'Notting Hill • Kensington',
                cafes: '22 partner cafés',
                title: 'West London Morning Collective',
                desc: 'Pastel mews, pastel ceramic flat whites, and relaxed weekend morning dates surrounded by antique bookshops.',
                members: '1,890 members',
                img: 'https://lh3.googleusercontent.com/aida-public/AB6AXuCsQFJJkHjGfBufuaZ6nur3gJ5jEifKzWbT4eYm9qHnrXqscr3KBWfy5AI8m1KGvK7o8RnqcwaxMXdSoWmlFc7KeXQsDae3GC-KpjVqYzkfhwqTjNcQQfuma5OJdzVzrIJyq4MkOVELnyp5hblwI3oXK8p7ufcYzX2X7dtmyXPVgQFfZZjK2nGF_W7AchMRgf5ZF9wTRCVCR40nU-cWyyz9gUmGgAbLC-C16VyUgc8SA2dSf6cQ8RjAZg',
                link: "{{ route('city.show', 'london') }}"
            }
        ],
        paris: [
            {
                tag: 'Le Marais • Saint-Germain',
                cafes: '41 partner cafés',
                title: 'The Rive Droite Chapter',
                desc: 'Slow filter roasts on zinc bistro tops, quiet courtyard retreats, and effortless transitions from warm macchiatos to natural wine.',
                members: '1,960 members',
                img: 'https://lh3.googleusercontent.com/aida-public/AB6AXuCsQFJJkHjGfBufuaZ6nur3gJ5jEifKzWbT4eYm9qHnrXqscr3KBWfy5AI8m1KGvK7o8RnqcwaxMXdSoWmlFc7KeXQsDae3GC-KpjVqYzkfhwqTjNcQQfuma5OJdzVzrIJyq4MkOVELnyp5hblwI3oXK8p7ufcYzX2X7dtmyXPVgQFfZZjK2nGF_W7AchMRgf5ZF9wTRCVCR40nU-cWyyz9gUmGgAbLC-C16VyUgc8SA2dSf6cQ8RjAZg',
                link: "{{ route('city.show', 'paris') }}"
            },
            {
                tag: 'Canal Saint-Martin • Belleville',
                cafes: '25 partner cafés',
                title: 'Canal Coffee Walkers',
                desc: 'Nordic-style light roasts, buttery cardamome rolls, and scenic waterside walks for genuine literary romantics.',
                members: '2,140 members',
                img: 'https://lh3.googleusercontent.com/aida-public/AB6AXuDx-eV2uFVmFf9BmUODB82Pqfq3a3E353awr12jdNKlwDtWTU4RTILN53iyMroFw3cyoyVXeUdsG1WabdqwaziDxTpQhKCxwDtk_54Ujy7qtYD54eha8QMiszX1Is7S-7mrJ9HNZWPQabMNLbm2oHk-mX7374uxQdlGXdv-JaZlvO4IrIBXtdyvfdxRJlyN9hDzwytDlOz9xR-grqHFIOu0EdEkds1gMafQ9MimuuT0LvUXs43u9Kb_fw',
                link: "{{ route('city.show', 'paris') }}"
            },
            {
                tag: 'Montmartre • Abbesses',
                cafes: '19 partner cafés',
                title: 'Hillside Poets & Pour-Overs',
                desc: 'Cobblestone stairs, warm cinnamon cappuccinos, and breathtaking city skyline views after meeting your coffee match.',
                members: '1,530 members',
                img: 'https://lh3.googleusercontent.com/aida-public/AB6AXuBI00sDnJgZUnyHWg3FWOe3p6hMv7pLdMkVE5fjs4NyPlldF_QEb5DdKzZ4qC9-VDU5O0XSWIQU4drx_n4JG8Gh2uzPYrwBzr56gybOAEY4cAIghEj79ihvbgFsSaWH_6A6tTq4usq_XlNjjhx3P7d7GqtCIRKRMF3M8DI3DIkE3PN0mafcBClLVOLQjbpqvVUviXNcSmdoTbYOe5ANxsK-Ujoq-DZkWfqMPa_aCSS28zZVwZ43mO7bXw',
                link: "{{ route('city.show', 'paris') }}"
            }
        ],
        tokyo: [
            {
                tag: 'Shibuya • Daikanyama',
                cafes: '38 partner cafés',
                title: 'Tokyo Kissaten & Modern Sips',
                desc: 'Minimalist wood counters, flawless Nel-drip extractions, and mindful conversation in Tokyo’s most tasteful design districts.',
                members: '3,880 members',
                img: 'https://lh3.googleusercontent.com/aida-public/AB6AXuDx-eV2uFVmFf9BmUODB82Pqfq3a3E353awr12jdNKlwDtWTU4RTILN53iyMroFw3cyoyVXeUdsG1WabdqwaziDxTpQhKCxwDtk_54Ujy7qtYD54eha8QMiszX1Is7S-7mrJ9HNZWPQabMNLbm2oHk-mX7374uxQdlGXdv-JaZlvO4IrIBXtdyvfdxRJlyN9hDzwytDlOz9xR-grqHFIOu0EdEkds1gMafQ9MimuuT0LvUXs43u9Kb_fw',
                link: "{{ route('city.show', 'tokyo') }}"
            },
            {
                tag: 'Kiyosumi-Shirakawa • Yanaka',
                cafes: '29 partner cafés',
                title: 'The Slow Roast District',
                desc: 'Warehouses transformed into roaster sanctuaries, single origins, and quiet canal strolls with zero algorithmic noise.',
                members: '2,640 members',
                img: 'https://lh3.googleusercontent.com/aida-public/AB6AXuBI00sDnJgZUnyHWg3FWOe3p6hMv7pLdMkVE5fjs4NyPlldF_QEb5DdKzZ4qC9-VDU5O0XSWIQU4drx_n4JG8Gh2uzPYrwBzr56gybOAEY4cAIghEj79ihvbgFsSaWH_6A6tTq4usq_XlNjjhx3P7d7GqtCIRKRMF3M8DI3DIkE3PN0mafcBClLVOLQjbpqvVUviXNcSmdoTbYOe5ANxsK-Ujoq-DZkWfqMPa_aCSS28zZVwZ43mO7bXw',
                link: "{{ route('city.show', 'tokyo') }}"
            },
            {
                tag: 'Shimokitazawa • Kichijoji',
                cafes: '34 partner cafés',
                title: 'Vinyl & Vintage Brews',
                desc: 'Cozy basement jazz cafes, record stores, and relaxed encounters over dark roast siphon brews.',
                members: '2,920 members',
                img: 'https://lh3.googleusercontent.com/aida-public/AB6AXuCsQFJJkHjGfBufuaZ6nur3gJ5jEifKzWbT4eYm9qHnrXqscr3KBWfy5AI8m1KGvK7o8RnqcwaxMXdSoWmlFc7KeXQsDae3GC-KpjVqYzkfhwqTjNcQQfuma5OJdzVzrIJyq4MkOVELnyp5hblwI3oXK8p7ufcYzX2X7dtmyXPVgQFfZZjK2nGF_W7AchMRgf5ZF9wTRCVCR40nU-cWyyz9gUmGgAbLC-C16VyUgc8SA2dSf6cQ8RjAZg',
                link: "{{ route('city.show', 'tokyo') }}"
            }
        ],
        melbourne: [
            {
                tag: 'Fitzroy • Collingwood',
                cafes: '45 partner cafés',
                title: 'The Melbourne Specialty Guild',
                desc: 'World-renowned flat whites, laneway street art, and effortlessly stylish dates with coffee purists and creatives.',
                members: '4,150 members',
                img: 'https://lh3.googleusercontent.com/aida-public/AB6AXuDx-eV2uFVmFf9BmUODB82Pqfq3a3E353awr12jdNKlwDtWTU4RTILN53iyMroFw3cyoyVXeUdsG1WabdqwaziDxTpQhKCxwDtk_54Ujy7qtYD54eha8QMiszX1Is7S-7mrJ9HNZWPQabMNLbm2oHk-mX7374uxQdlGXdv-JaZlvO4IrIBXtdyvfdxRJlyN9hDzwytDlOz9xR-grqHFIOu0EdEkds1gMafQ9MimuuT0LvUXs43u9Kb_fw',
                link: "{{ route('city.show', 'melbourne') }}"
            },
            {
                tag: 'Carlton • CBD Laneways',
                cafes: '37 partner cafés',
                title: 'Degraves & Carlton Coffee Haven',
                desc: 'Espresso heritage dating back decades, tucked away arcades, and relaxed weekend morning rendezvous.',
                members: '3,270 members',
                img: 'https://lh3.googleusercontent.com/aida-public/AB6AXuBI00sDnJgZUnyHWg3FWOe3p6hMv7pLdMkVE5fjs4NyPlldF_QEb5DdKzZ4qC9-VDU5O0XSWIQU4drx_n4JG8Gh2uzPYrwBzr56gybOAEY4cAIghEj79ihvbgFsSaWH_6A6tTq4usq_XlNjjhx3P7d7GqtCIRKRMF3M8DI3DIkE3PN0mafcBClLVOLQjbpqvVUviXNcSmdoTbYOe5ANxsK-Ujoq-DZkWfqMPa_aCSS28zZVwZ43mO7bXw',
                link: "{{ route('city.show', 'melbourne') }}"
            },
            {
                tag: 'South Yarra • Prahran',
                cafes: '27 partner cafés',
                title: 'The Botanical Brew Circle',
                desc: 'Sun-drenched conservatory cafes, cold-drip brews, and tranquil conversations near botanical gardens.',
                members: '2,510 members',
                img: 'https://lh3.googleusercontent.com/aida-public/AB6AXuCsQFJJkHjGfBufuaZ6nur3gJ5jEifKzWbT4eYm9qHnrXqscr3KBWfy5AI8m1KGvK7o8RnqcwaxMXdSoWmlFc7KeXQsDae3GC-KpjVqYzkfhwqTjNcQQfuma5OJdzVzrIJyq4MkOVELnyp5hblwI3oXK8p7ufcYzX2X7dtmyXPVgQFfZZjK2nGF_W7AchMRgf5ZF9wTRCVCR40nU-cWyyz9gUmGgAbLC-C16VyUgc8SA2dSf6cQ8RjAZg',
                link: "{{ route('city.show', 'melbourne') }}"
            }
        ],
        milan: [
            {
                tag: 'Brera • Navigli',
                cafes: '30 partner cafés',
                title: 'The Espresso & Aperitivo Club',
                desc: 'Standing espresso bar elegance, quiet courtyard conversations, and seamless transitions into sunset spritzers.',
                members: '2,240 members',
                img: 'https://lh3.googleusercontent.com/aida-public/AB6AXuDx-eV2uFVmFf9BmUODB82Pqfq3a3E353awr12jdNKlwDtWTU4RTILN53iyMroFw3cyoyVXeUdsG1WabdqwaziDxTpQhKCxwDtk_54Ujy7qtYD54eha8QMiszX1Is7S-7mrJ9HNZWPQabMNLbm2oHk-mX7374uxQdlGXdv-JaZlvO4IrIBXtdyvfdxRJlyN9hDzwytDlOz9xR-grqHFIOu0EdEkds1gMafQ9MimuuT0LvUXs43u9Kb_fw',
                link: "{{ route('city.show', 'milan') }}"
            },
            {
                tag: 'Porta Venezia • Isola',
                cafes: '24 partner cafés',
                title: 'Modern Milanese Sips',
                desc: 'Contemporary specialty roasters, architectural interiors, and bright flat whites for style-conscious romantics.',
                members: '2,010 members',
                img: 'https://lh3.googleusercontent.com/aida-public/AB6AXuBI00sDnJgZUnyHWg3FWOe3p6hMv7pLdMkVE5fjs4NyPlldF_QEb5DdKzZ4qC9-VDU5O0XSWIQU4drx_n4JG8Gh2uzPYrwBzr56gybOAEY4cAIghEj79ihvbgFsSaWH_6A6tTq4usq_XlNjjhx3P7d7GqtCIRKRMF3M8DI3DIkE3PN0mafcBClLVOLQjbpqvVUviXNcSmdoTbYOe5ANxsK-Ujoq-DZkWfqMPa_aCSS28zZVwZ43mO7bXw',
                link: "{{ route('city.show', 'milan') }}"
            },
            {
                tag: 'Sant\'Ambrogio • Magenta',
                cafes: '21 partner cafés',
                title: 'Pasticceria & Morning Talks',
                desc: 'Warm brioche pastries, rich bicerins, and intimate conversation in historic cobblestone quarters.',
                members: '1,780 members',
                img: 'https://lh3.googleusercontent.com/aida-public/AB6AXuCsQFJJkHjGfBufuaZ6nur3gJ5jEifKzWbT4eYm9qHnrXqscr3KBWfy5AI8m1KGvK7o8RnqcwaxMXdSoWmlFc7KeXQsDae3GC-KpjVqYzkfhwqTjNcQQfuma5OJdzVzrIJyq4MkOVELnyp5hblwI3oXK8p7ufcYzX2X7dtmyXPVgQFfZZjK2nGF_W7AchMRgf5ZF9wTRCVCR40nU-cWyyz9gUmGgAbLC-C16VyUgc8SA2dSf6cQ8RjAZg',
                link: "{{ route('city.show', 'milan') }}"
            }
        ]
    };

    function renderCityCards(cityKey) {
        const container = document.getElementById('cityCardsContainer');
        const cards = cityData[cityKey] || cityData.nyc;
        if (!container) return;

        container.innerHTML = cards.map((card, i) => `
            <article class="scroll-reveal active city-card flex flex-col rounded-lg bg-surface-container-lowest overflow-hidden shadow-sm hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 group cursor-pointer" onclick="window.location.href='${card.link}'">
                <div class="relative w-full aspect-[16/10] overflow-hidden bg-surface-container">
                    <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out" alt="${card.title}" src="${card.img}"/>
                    <div class="absolute top-3 left-3 px-space-sm py-1 rounded-full bg-surface-container-lowest/90 backdrop-blur-md font-label-sm text-label-sm text-on-surface shadow-xs">
                        ${card.tag}
                    </div>
                    <div class="absolute bottom-3 right-3 px-space-sm py-0.5 rounded-full bg-primary-container/85 text-on-primary font-label-sm text-label-sm backdrop-blur-sm">
                        ${card.cafes}
                    </div>
                </div>
                <div class="p-space-lg flex flex-col justify-between flex-1">
                    <div class="flex flex-col gap-space-xs">
                        <div class="flex items-center justify-between">
                            <h3 class="font-headline-sm text-headline-sm text-on-surface font-semibold group-hover:text-secondary transition-colors">${card.title}</h3>
                            <span class="material-symbols-outlined text-secondary text-lg city-arrow-icon transition-transform duration-200">arrow_outward</span>
                        </div>
                        <p class="font-body-sm text-body-sm text-on-surface-variant line-clamp-2">
                            ${card.desc}
                        </p>
                    </div>
                    <div class="pt-space-md mt-space-md flex items-center justify-between border-t border-surface-container-low">
                        <div class="flex items-center gap-space-xs">
                            <span class="w-2 h-2 rounded-full bg-on-tertiary-container"></span>
                            <span class="font-label-md text-label-md text-on-surface font-medium">${card.members}</span>
                            <span class="font-body-sm text-body-sm text-on-surface-variant">active today</span>
                        </div>
                        <span class="font-label-sm text-label-sm text-secondary uppercase tracking-wider font-semibold group-hover:underline">View Hub</span>
                    </div>
                </div>
            </article>
        `).join('');
    }

    document.querySelectorAll('.city-tab').forEach(button => {
        button.addEventListener('click', () => {
            document.querySelectorAll('.city-tab').forEach(btn => {
                btn.classList.remove('bg-on-surface', 'text-surface', 'shadow-xs');
                btn.classList.add('text-on-surface-variant');
            });
            button.classList.add('bg-on-surface', 'text-surface', 'shadow-xs');
            button.classList.remove('text-on-surface-variant');

            const city = button.getAttribute('data-city');
            renderCityCards(city);
        });
    });

    // 3. Interactive Brew Selector Pills in Step 01
    const brewButtons = document.querySelectorAll('.brew-tag');
    brewButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            brewButtons.forEach(b => {
                b.classList.remove('bg-on-tertiary-container', 'text-on-tertiary', 'shadow-xs');
                b.classList.add('bg-surface-container', 'text-on-surface');
                b.textContent = b.textContent.replace(' • Selected', '');
            });
            btn.classList.add('bg-on-tertiary-container', 'text-on-tertiary', 'shadow-xs');
            btn.classList.remove('bg-surface-container', 'text-on-surface');
            if (!btn.textContent.includes('• Selected')) {
                btn.textContent = btn.textContent + ' • Selected';
            }
        });
    });

    // 4. Invite Form Handler
    function handleInviteForm(e) {
        e.preventDefault();
        const contact = document.getElementById('inviteContactInput').value.trim();
        if (contact) {
            // If contact is email, prefill register URL
            if (contact.includes('@')) {
                window.location.href = "{{ route('register') }}?email=" + encodeURIComponent(contact);
            } else {
                alert("Welcome to CupDate. Your invitation is brewing! We will reach out shortly.");
                document.getElementById('inviteContactInput').value = '';
            }
        }
    }

    // 5. Home FAQ Accordion Toggle
    function toggleHomeFaq(btn) {
        const card = btn.closest('div');
        const ans = card.querySelector('.faq-ans');
        const arrow = btn.querySelector('.faq-arrow');
        
        const isHidden = ans.classList.contains('hidden');
        
        // Close all others for single-open accordion feel
        document.querySelectorAll('#homeFaqAccordion .faq-ans').forEach(a => a.classList.add('hidden'));
        document.querySelectorAll('#homeFaqAccordion .faq-arrow').forEach(arr => arr.classList.remove('rotate-180'));
        
        if (isHidden) {
            ans.classList.remove('hidden');
            arrow.classList.add('rotate-180');
        }
    }

    // 6. Fast Zero-Reload Hero Switcher & Audio Micro-Interactions
    (function() {
        const tabBtns = document.querySelectorAll('#hero-dating-tab-group .hero-toggle-btn');
        const daterImg = document.getElementById('hero-dater-img');
        const daterSpark = document.getElementById('hero-dater-spark');
        const daterName = document.getElementById('hero-dater-name');
        const daterVibe = document.getElementById('hero-dater-vibe');
        const promptQuote = document.getElementById('hero-prompt-quote');
        const tagList = document.getElementById('hero-tag-list');

        const datingProfiles = [
            {
                name: "Elena Vance, 28",
                spark: "98% Romantic Synergy",
                vibe: "Looking for: Lifelong romance, shared architecture walks & quiet mornings",
                quote: "“A slow pour-over at Devoción on an unhurried Saturday morning, talking about the books that shaped us before wandering through the galleries.”",
                img: "https://lh3.googleusercontent.com/aida-public/AB6AXuDftoqQPlGJ6nQft-w9OKRyLRqE5d-gXtON0maE6JdAfBUkZdJgdtwKGtGMEgzUqyLCPVqbXE-SoLNH0Dki87vnj3mvU2m9m9T5qclbaoB4iXhrCd-RWJKYmiLfnbA7Du9tDskAm_VUoZ3bpSO6Wkb-vYB5VZ0v9Iq13ilRqJ6ZVXkLAP2DqiSsZkHYAA6YoVQOV4jQO4yFECplYeG4_UZhz08agWIs52Ubru4H-eIoAq0ms3zlqw_2Xg",
                tags: ["💍 Marriage & Partnership", "☕ Slow Morning Rituals", "🌿 Deep Listeners"]
            },
            {
                name: "Julian Mercier, 31",
                spark: "95% Romantic Synergy",
                vibe: "Looking for: Warmhearted devotion, culinary experiments & weekend escapes",
                quote: "“Finding someone who values presence above status. Let us share an espresso tonic, listen to vinyl, and see if our conversation flows effortlessly.”",
                img: "https://lh3.googleusercontent.com/aida-public/AB6AXuCJlQ7L_OwIsb-Qt99pYUGj61g_UWKt_ZllS0CEsU0_P_mt74pFu2I5usX2N8sZcymWmKYjzTOVKjxXy5dIE0Bga3vd1jQo2kZea22IZ_MRmPgIuUE7mjY3WZWHVsXEC1QxPl-8zawByw6O5_0OAcSwLUcORhF9sf8o7wnPwgfmJSwvetn67MtGRF13BWMadiqKnMQpQfY8f6MThopdowPO3uneLqkSFj2f3WmJISknS6Ey9CWQwcboww",
                tags: ["✨ Intentional Courtship", "🎨 Gallery Strolls", "🕯️ Daylight Dates"]
            },
            {
                name: "Siobhan Kelly, 29",
                spark: "96% Romantic Synergy",
                vibe: "Looking for: A tender life partner, quiet Sunday jazz & mutual humor",
                quote: "“I believe the most profound connections happen over warm cups without screens. If we click in 45 minutes, the rest of life unfolds naturally.”",
                img: "https://lh3.googleusercontent.com/aida-public/AB6AXuAYW8QfGUtNDKiJMOsp-E6tixTmwp9d3Sf_ZjWAENethisLxVeFIPSSjgysGBjRTmIrTqo96DGk4_HQ5qNzkII6Aar07Uqm8KDYfAoJvffYhp04QvQBS2AYjVIuPX3OPAU5bs-67Y100YKq6RP78YqBl1TvhOI1Wdu-kOPW9wIqOvIrTDpUsd6j2FXFX5IkG4I1uHRbZElBzfmeOTvALHT_IgZrjtctGlix_zglWQjK5KawyKkRjTEgnQ",
                tags: ["📖 Avid Readers", "🎻 Jazz Lovers", "🏡 Building a Home"]
            }
        ];

        function applyProfile(idx) {
            if (!datingProfiles[idx]) return;
            const p = datingProfiles[idx];
            if (daterName) daterName.textContent = p.name;
            if (daterSpark) daterSpark.textContent = p.spark;
            if (daterVibe) daterVibe.textContent = p.vibe;
            if (promptQuote) promptQuote.textContent = p.quote;
            if (daterImg) daterImg.src = p.img;
            
            if (tagList) {
                tagList.innerHTML = p.tags.map(t => `<span class="px-3 py-1 rounded-full bg-surface-container font-label-sm text-label-sm text-primary font-medium">${t}</span>`).join('');
            }
        }

        // Profile buttons in hero
        const quickBtns = document.querySelectorAll('.quick-profile-btn');
        quickBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                quickBtns.forEach(b => {
                    b.classList.remove('bg-surface-container', 'text-on-surface');
                    b.classList.add('bg-surface-container-low', 'text-on-surface-variant');
                });
                btn.classList.remove('bg-surface-container-low', 'text-on-surface-variant');
                btn.classList.add('bg-surface-container', 'text-on-surface');
                const idx = parseInt(btn.getAttribute('data-profile') || '0', 10);
                applyProfile(idx);
            });
        });

        // Tab switcher micro-interaction
        tabBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                tabBtns.forEach(b => {
                    b.classList.remove('active', 'bg-primary', 'text-on-primary');
                    b.classList.add('text-on-surface-variant');
                });
                btn.classList.add('active', 'bg-primary', 'text-on-primary');
                btn.classList.remove('text-on-surface-variant');

                const tab = btn.getAttribute('data-tab');
                if (tab === 'curated') applyProfile(0);
                if (tab === 'today') applyProfile(1);
                if (tab === 'verified') applyProfile(2);
            });
        });

        // Audio prompt snippet micro-interaction
        const audioBtn = document.getElementById('audio-play-demo');
        let isPlaying = false;
        if (audioBtn) {
            audioBtn.addEventListener('click', () => {
                isPlaying = !isPlaying;
                const icon = audioBtn.querySelector('span');
                if (icon) icon.textContent = isPlaying ? 'pause' : 'play_arrow';
            });
        }

        // City filter for date sanctuaries
        const cityButtons = document.querySelectorAll('#city-tabs .city-btn');
        const cafeCards = document.querySelectorAll('#cafe-cards-grid .cafe-card');

        cityButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                cityButtons.forEach(b => {
                    b.classList.remove('active', 'bg-primary', 'text-on-primary');
                    b.classList.add('text-on-surface-variant');
                });
                btn.classList.add('active', 'bg-primary', 'text-on-primary');
                btn.classList.remove('text-on-surface-variant');

                const selectedCity = btn.getAttribute('data-city');
                cafeCards.forEach(card => {
                    const cardCity = card.getAttribute('data-city-tag');
                    if (selectedCity === 'all' || cardCity === selectedCity) {
                        card.style.display = 'flex';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });

        // Compatibility Calculator
        const timeBtns = document.querySelectorAll('#time-window-selector .calc-btn');
        const musicBtns = document.querySelectorAll('#music-vibe-selector .calc-btn');
        const counterEl = document.getElementById('match-calc-counter');
        const progressLabel = document.getElementById('resonance-percent-label');
        const progressBar = document.getElementById('resonance-progress-bar');

        function recalculate() {
            let baseCount = 120;
            let baseProb = 86;

            const activeTime = document.querySelector('#time-window-selector .calc-btn.active');
            const activeMusic = document.querySelector('#music-vibe-selector .calc-btn.active');

            if (activeTime) {
                const t = activeTime.getAttribute('data-val');
                if (t === 'morning') { baseCount += 38; baseProb += 6; }
                if (t === 'midday') { baseCount += 46; baseProb += 5; }
                if (t === 'late') { baseCount += 22; baseProb += 3; }
            }

            if (activeMusic) {
                const m = activeMusic.getAttribute('data-val');
                if (m === 'bossa') { baseCount += 30; baseProb += 5; }
                if (m === 'ambient') { baseCount += 18; baseProb += 3; }
                if (m === 'indie') { baseCount += 25; baseProb += 4; }
            }

            if (baseProb > 99) baseProb = 99;

            if (counterEl) counterEl.textContent = baseCount;
            if (progressLabel) progressLabel.textContent = baseProb + '% Match Probability';
            if (progressBar) progressBar.style.width = baseProb + '%';
        }

        function setupToggleGroup(btns) {
            btns.forEach(btn => {
                btn.addEventListener('click', () => {
                    btns.forEach(b => {
                        b.classList.remove('active', 'bg-primary', 'text-on-primary');
                        b.classList.add('bg-surface-container', 'text-on-surface');
                    });
                    btn.classList.add('active', 'bg-primary', 'text-on-primary');
                    btn.classList.remove('bg-surface-container', 'text-on-surface');
                    recalculate();
                });
            });
        }

        setupToggleGroup(timeBtns);
        setupToggleGroup(musicBtns);
    })();
</script>
@endsection
