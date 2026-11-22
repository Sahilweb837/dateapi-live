@extends('layouts.app')

@section('title', 'CupDate — Find Your Real Connections Over Coffee')
@section('meta_desc', 'CupDate connects verified singles for intentional conversations and low-pressure 45-minute coffee dates. Welcoming inclusive dating for all.')

@section('content')
<div class="min-h-screen bg-[#FFFDF9] text-[#1e1e24] font-['Plus_Jakarta_Sans',sans-serif]">

    <!-- ======================================================== -->
    <!-- 1. HERO SECTION (Inspired by Matchmaker Reference Image) -->
    <!-- ======================================================== -->
    <section class="relative pt-10 pb-16 sm:pt-14 sm:pb-20 overflow-hidden border-b border-[#f3e5e8]">
        <!-- Soft Warm Background Accents -->
        <div class="pointer-events-none absolute -top-24 -left-20 w-80 h-80 sm:w-96 sm:h-96 rounded-full bg-[#FFE6E6]/60 blur-3xl"></div>
        <div class="pointer-events-none absolute top-12 -right-20 w-80 h-80 sm:w-96 sm:h-96 rounded-full bg-[#FFF1F2]/70 blur-3xl"></div>

        <div class="relative mx-auto max-w-6xl px-4 sm:px-6 lg:px-8 text-center">

            @auth
                <!-- Logged-in Quick Bar -->
                <div class="mb-6 mx-auto max-w-xl p-3.5 rounded-2xl bg-white border border-[#f3d3dc] shadow-xs flex items-center justify-between gap-3 text-left">
                    <div class="flex items-center gap-3">
                        <img src="{{ Auth::user()->avatar_url }}" alt="{{ Auth::user()->full_name }}" class="w-10 h-10 rounded-full object-cover ring-2 ring-[#FF3366]">
                        <div>
                            <h3 class="font-bold text-xs sm:text-sm text-[#1e1e24]">Welcome back, {{ explode(' ', Auth::user()->full_name)[0] }}!</h3>
                            <p class="text-[11px] text-[#785b62]">Direct access to your inner dashboard.</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-1.5">
                        <a href="{{ route('feed') }}" class="px-3 py-1.5 rounded-full bg-[#FF3366] text-white text-xs font-bold hover:bg-[#e02857] transition shadow-xs">Feed</a>
                        <a href="{{ route('radar') }}" class="px-3 py-1.5 rounded-full bg-[#E8F4FD] text-[#0284c7] border border-[#BAE6FD] text-xs font-bold hover:bg-sky-100 transition">Radar</a>
                    </div>
                </div>
            @endauth

            <!-- Inclusivity Hero Banner (Simple & Proper as Requested) -->
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white border border-[#f0d4da] text-xs font-bold text-[#b0284b] mb-6 shadow-xs">
                <span class="flex h-2 w-5 rounded-full bg-gradient-to-r from-red-500 via-amber-400 via-emerald-400 via-blue-500 to-purple-500"></span>
                <span>Love in Every Dimension: Welcoming Lesbian, Gay, Bisexual, Transgender &amp; Queer singles</span>
                <a href="{{ route('community.lgbtq') }}" class="underline text-[#FF3366] hover:text-[#b0284b] text-[11px] ml-1">Learn More &rarr;</a>
            </div>

            <!-- Big Main Headline -->
            <h1 class="text-4xl sm:text-6xl font-black text-[#1e1e24] tracking-tight leading-[1.1] max-w-3xl mx-auto">
                Find Your <br/>
                <span class="text-[#FF3366] font-serif italic relative inline-block">
                    Real Connections
                    <svg class="absolute -bottom-2 left-0 w-full h-3 text-[#FF3366]/30" viewBox="0 0 100 20" preserveAspectRatio="none">
                        <path d="M0,10 Q50,0 100,10" fill="none" stroke="currentColor" stroke-width="4"/>
                    </svg>
                </span>
            </h1>

            <p class="mt-5 text-sm sm:text-base text-[#695458] max-w-xl mx-auto leading-relaxed">
                Meaningful conversations, authentic dates, and warm coffee moments designed for modern singles. Skip endless swiping and meet in vetted public cafes.
            </p>

            <!-- Hero Action Buttons -->
            <div class="mt-7 flex flex-wrap items-center justify-center gap-3">
                @guest
                    <button type="button" onclick="openQuickAuthModal('register')" 
                            class="px-8 py-3.5 rounded-full bg-[#FF3366] hover:bg-[#e02857] text-white text-sm font-bold shadow-lg shadow-[#FF3366]/25 transition active:scale-95 cursor-pointer">
                        Join CupDate Free
                    </button>
                    <button type="button" onclick="openQuickAuthModal('signin')" 
                            class="px-7 py-3.5 rounded-full bg-white border border-[#dfbfc2] hover:bg-stone-50 text-[#1e1e24] text-sm font-bold transition active:scale-95 cursor-pointer">
                        Sign In
                    </button>
                @else
                    <a href="{{ route('swipes') }}" class="px-8 py-3.5 rounded-full bg-[#FF3366] hover:bg-[#e02857] text-white text-sm font-bold shadow-lg shadow-[#FF3366]/25 transition active:scale-95">
                        Discover Matches
                    </a>
                    <a href="{{ route('radar') }}" class="px-7 py-3.5 rounded-full bg-white border border-[#dfbfc2] hover:bg-stone-50 text-[#1e1e24] text-sm font-bold transition">
                        Scan Nearby Radar
                    </a>
                @endguest
                <a href="{{ route('dates') }}" class="px-6 py-3.5 rounded-full bg-[#FFF2F4] border border-[#f0d4da] text-[#a8334e] text-xs font-bold hover:bg-[#ffe1e6] transition">
                    Explore Date Cafes
                </a>
            </div>

            <!-- Central Vector Artwork (Matching Reference Image 3 Couple Texting + Pink Heart) -->
            <div class="relative mt-12 mx-auto max-w-2xl flex items-center justify-center">
                <!-- Floating Soft Pink Heart Backdrop -->
                <div class="relative flex items-center justify-center">
                    <svg class="w-64 h-64 sm:w-80 sm:h-80 text-[#FFE6E6] drop-shadow-md" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                    </svg>

                    <!-- Center Envelope with Heart -->
                    <div class="absolute z-10 w-16 h-12 rounded-xl bg-white border border-[#f0d4da] shadow-md flex items-center justify-center animate-bounce" style="animation-duration: 2.5s;">
                        <svg class="w-6 h-6 text-[#FF3366]" fill="currentColor" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                    </div>

                    <!-- Left Guy Vector Illustration -->
                    <div class="absolute -left-6 sm:left-4 bottom-0 z-10 flex flex-col items-center">
                        <div class="w-28 sm:w-36 h-36 sm:h-44 rounded-2xl overflow-hidden bg-gradient-to-t from-emerald-500/10 to-transparent p-1">
                            <img src="{{ asset('assets/images/male_avatar_1.png') }}" alt="Single dater on CupDate" class="w-full h-full object-cover rounded-xl shadow-xs" onerror="this.src='https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?w=400&q=80&fit=crop'">
                        </div>
                        <span class="mt-1 text-[10px] font-bold bg-white px-2 py-0.5 rounded-full border border-stone-200 shadow-2xs">Arjun, 27 · Coffee Lover</span>
                    </div>

                    <!-- Right Girl Vector Illustration -->
                    <div class="absolute -right-6 sm:right-4 bottom-0 z-10 flex flex-col items-center">
                        <div class="w-28 sm:w-36 h-36 sm:h-44 rounded-2xl overflow-hidden bg-gradient-to-t from-pink-500/10 to-transparent p-1">
                            <img src="{{ asset('assets/images/female_avatar_1.png') }}" alt="Single dater on CupDate" class="w-full h-full object-cover rounded-xl shadow-xs" onerror="this.src='https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=400&q=80&fit=crop'">
                        </div>
                        <span class="mt-1 text-[10px] font-bold bg-white px-2 py-0.5 rounded-full border border-stone-200 shadow-2xs">Priya, 25 · Oat Latte</span>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- ======================================================== -->
    <!-- 2. THE 3 PASTEL FEATURE CARDS (Directly from Ref Image)   -->
    <!-- ======================================================== -->
    <section class="py-14 sm:py-18 bg-[#FAFAF8] border-b border-[#f3e5e8]">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <!-- Card 1: Sky Blue "Efficient" -->
                <div class="rounded-3xl p-8 bg-[#E8F4FD] border border-[#BAE6FD] shadow-xs flex flex-col justify-between transition hover:-translate-y-1">
                    <div>
                        <!-- Minimalist SVG Icon -->
                        <div class="w-12 h-12 rounded-2xl bg-white border border-[#BAE6FD] text-[#0284c7] flex items-center justify-center mb-6 shadow-xs">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                        </div>
                        <h3 class="text-2xl font-black text-[#1e1e24] mb-3">Efficient</h3>
                        <p class="text-xs sm:text-sm text-[#4b6375] leading-relaxed">
                            Smart compatibility based on coffee habits, communication styles, and dating goals instead of endless superficial swiping.
                        </p>
                    </div>
                    <div class="mt-6 pt-4 border-t border-[#BAE6FD]/60 text-[11px] font-bold text-[#0284c7]">
                        Verified Matches Only
                    </div>
                </div>

                <!-- Card 2: Buttercup Yellow "Balance" -->
                <div class="rounded-3xl p-8 bg-[#FEF9C3] border border-[#FDE047] shadow-xs flex flex-col justify-between transition hover:-translate-y-1">
                    <div>
                        <!-- Minimalist Scales SVG Icon -->
                        <div class="w-12 h-12 rounded-2xl bg-white border border-[#FDE047] text-[#ca8a04] flex items-center justify-center mb-6 shadow-xs">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"/></svg>
                        </div>
                        <h3 class="text-2xl font-black text-[#1e1e24] mb-3">Balance</h3>
                        <p class="text-xs sm:text-sm text-[#665a29] leading-relaxed">
                            Low-pressure 45-minute first dates designed to preserve emotional energy, respect your schedule, and let genuine attraction bloom.
                        </p>
                    </div>
                    <div class="mt-6 pt-4 border-t border-[#FDE047]/60 text-[11px] font-bold text-[#ca8a04]">
                        Zero Awkward Pressure
                    </div>
                </div>

                <!-- Card 3: Blush Pink "Smart Blocking" -->
                <div class="rounded-3xl p-8 bg-[#FEE2E2] border border-[#FECDD3] shadow-xs flex flex-col justify-between transition hover:-translate-y-1">
                    <div>
                        <!-- Minimalist Shield SVG Icon -->
                        <div class="w-12 h-12 rounded-2xl bg-white border border-[#FECDD3] text-[#e11d48] flex items-center justify-center mb-6 shadow-xs">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                        </div>
                        <h3 class="text-2xl font-black text-[#1e1e24] mb-3">Smart Blocking</h3>
                        <p class="text-xs sm:text-sm text-[#753b43] leading-relaxed">
                            Mandatory selfie verification, anti-harassment safeguards, and instantaneous one-click reporting reviewed by human trust officers.
                        </p>
                    </div>
                    <div class="mt-6 pt-4 border-t border-[#FECDD3]/60 text-[11px] font-bold text-[#e11d48]">
                        100% Human Monitored
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ======================================================== -->
    <!-- 3. "WHAT OUR USERS SAY" TESTIMONIAL SECTION              -->
    <!-- ======================================================== -->
    <section class="py-14 sm:py-20 bg-white border-b border-[#f3e5e8]">
        <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">
            <div class="flex items-center gap-2 mb-8">
                <h2 class="text-3xl font-black text-[#1e1e24] tracking-tight">
                    What Our <span class="text-[#FF3366]">Users Say</span>
                </h2>
                <span class="text-xl text-[#FF3366]">✦</span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-12 gap-8 items-center bg-[#FFF8F8] rounded-3xl p-8 sm:p-10 border border-[#f0d4da]">
                
                <!-- Quote Left -->
                <div class="md:col-span-8">
                    <!-- Big Pink Quote Mark -->
                    <span class="text-6xl font-serif text-[#FF3366] leading-none block mb-2 font-black">“</span>
                    <blockquote class="text-base sm:text-xl font-medium text-[#1e1e24] leading-relaxed">
                        CupDate's prompts really made the difference — I felt like I got a good sense of their vibe from their answers, and our first meet at the cafe was completely natural.
                    </blockquote>

                    <div class="mt-6 flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-pink-500/20 text-[#FF3366] font-bold flex items-center justify-center">
                            DK
                        </div>
                        <div>
                            <p class="text-sm font-bold text-[#1e1e24]">Devika &amp; Kabir</p>
                            <p class="text-xs text-[#695458]">Met at Wake &amp; Bake, Shimla · Together 8 Months</p>
                        </div>
                        <div class="ml-auto text-amber-500 text-sm">★★★★★</div>
                    </div>
                </div>

                <!-- Review Stamp Right -->
                <div class="md:col-span-4 flex flex-col items-center justify-center p-6 bg-white rounded-2xl border border-[#ecd5dc] text-center shadow-xs">
                    <div class="w-14 h-14 rounded-2xl bg-[#E8F4FD] text-[#0284c7] flex items-center justify-center mb-3">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"/></svg>
                    </div>
                    <span class="text-2xl font-black text-[#1e1e24]">94%</span>
                    <p class="text-xs font-bold text-[#695458] mt-1">First Date Success Rate</p>
                    <span class="text-[10px] text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-full font-mono font-bold mt-2">VERIFIED</span>
                </div>

            </div>
        </div>
    </section>

    <!-- ======================================================== -->
    <!-- 4. "HOW OUR APP WORK?" (4 Step Cards + Phone Mockup)     -->
    <!-- ======================================================== -->
    <section class="py-14 sm:py-20 bg-[#FEF9C3]/20 border-b border-[#f3e5e8]">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
            <div class="mb-10 text-center sm:text-left">
                <h2 class="text-3xl font-black text-[#1e1e24] tracking-tight">
                    How Our App <span class="text-[#FF3366]">Work?</span>
                </h2>
                <p class="text-xs sm:text-sm text-[#695458] mt-1">
                    Four simple steps to go from online conversation to coffee date.
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                
                <!-- Left: 4 Step Pastel Cards (lg:col-span-7) -->
                <div class="lg:col-span-7 grid grid-cols-1 sm:grid-cols-2 gap-4">
                    
                    <!-- Step 1: Cyan -->
                    <div class="p-5 rounded-2xl bg-[#E0F2FE] border border-[#BAE6FD] shadow-xs">
                        <span class="w-6 h-6 rounded-full bg-[#0284c7] text-white text-xs font-bold flex items-center justify-center mb-2">1</span>
                        <h3 class="font-bold text-sm text-[#1e1e24] mb-1">Download App / Join</h3>
                        <p class="text-xs text-[#4b6375] leading-relaxed">Sign up in 30 seconds with email or phone. No tedious setup fees.</p>
                    </div>

                    <!-- Step 2: Light Blue -->
                    <div class="p-5 rounded-2xl bg-[#DBEAFE] border border-[#93C5FD] shadow-xs">
                        <span class="w-6 h-6 rounded-full bg-[#2563eb] text-white text-xs font-bold flex items-center justify-center mb-2">2</span>
                        <h3 class="font-bold text-sm text-[#1e1e24] mb-1">Create Account</h3>
                        <p class="text-xs text-[#3b4c6e] leading-relaxed">Set your orientation, pronouns, and dating preferences freely.</p>
                    </div>

                    <!-- Step 3: Mint Green -->
                    <div class="p-5 rounded-2xl bg-[#DCFCE7] border border-[#86EFAC] shadow-xs">
                        <span class="w-6 h-6 rounded-full bg-[#16a34a] text-white text-xs font-bold flex items-center justify-center mb-2">3</span>
                        <h3 class="font-bold text-sm text-[#1e1e24] mb-1">Fill Profile</h3>
                        <p class="text-xs text-[#2b593a] leading-relaxed">Add your favorite coffee order, music, astrology, and photos.</p>
                    </div>

                    <!-- Step 4: Lavender -->
                    <div class="p-5 rounded-2xl bg-[#EDE9FE] border border-[#C4B5FD] shadow-xs">
                        <span class="w-6 h-6 rounded-full bg-[#7c3aed] text-white text-xs font-bold flex items-center justify-center mb-2">4</span>
                        <h3 class="font-bold text-sm text-[#1e1e24] mb-1">Start Swiping &amp; Meet</h3>
                        <p class="text-xs text-[#4c3870] leading-relaxed">Connect, chat, and pick a vetted cafe spot for a 45-minute date.</p>
                    </div>

                </div>

                <!-- Right: Realistic Smartphone Mockup (lg:col-span-5) -->
                <div class="lg:col-span-5 flex justify-center">
                    <div class="relative w-64 sm:w-72 rounded-[40px] border-4 border-stone-800 bg-stone-900 p-2 shadow-2xl">
                        <!-- Screen Bezel -->
                        <div class="rounded-[32px] bg-white overflow-hidden flex flex-col aspect-[9/18]">
                            <!-- App Top Header -->
                            <div class="p-3 bg-white border-b border-stone-100 flex items-center justify-between">
                                <img src="{{ asset('assets/images/cupdate_logo_main.png') }}" class="h-5 w-auto" alt="Logo">
                                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                            </div>

                            <!-- Match Profile Card Inside Phone -->
                            <div class="p-3 flex-1 flex flex-col justify-between bg-gradient-to-b from-[#FFF5F7] to-white">
                                <div class="rounded-2xl overflow-hidden aspect-[4/5] relative bg-stone-200">
                                    <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=400&q=80&fit=crop" class="w-full h-full object-cover" alt="Profile">
                                    <div class="absolute bottom-2 left-2 text-white drop-shadow-xs">
                                        <p class="font-bold text-sm">Simran, 24</p>
                                        <p class="text-[10px] text-pink-200">☕ Vanilla Oat Latte · Shimla</p>
                                    </div>
                                </div>

                                <!-- Action Buttons on Phone -->
                                <div class="flex items-center justify-around pt-3">
                                    <button class="w-9 h-9 rounded-full bg-stone-100 text-stone-500 flex items-center justify-center font-bold text-sm shadow-xs">✕</button>
                                    <button class="w-12 h-12 rounded-full bg-[#FF3366] text-white flex items-center justify-center font-bold text-lg shadow-md shadow-pink-500/40">♥</button>
                                    <button class="w-9 h-9 rounded-full bg-amber-100 text-amber-600 flex items-center justify-center font-bold text-sm shadow-xs">☕</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ======================================================== -->
    <!-- 5. "OUR ARTICLES & TIPS UPDATE" (Matching Ref Image)      -->
    <!-- ======================================================== -->
    <section class="py-14 sm:py-20 bg-white border-b border-[#f3e5e8]">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
            <div class="mb-10 text-center sm:text-left flex flex-wrap items-end justify-between gap-4">
                <div>
                    <h2 class="text-3xl font-black text-[#1e1e24] tracking-tight">
                        Our <span class="text-[#FF3366]">Articles &amp; Tips</span> Update
                    </h2>
                    <p class="text-xs sm:text-sm text-[#695458] mt-1">
                        Curated advice for thoughtful modern singles.
                    </p>
                </div>
                <a href="{{ route('blog.index') }}" class="text-xs font-bold text-[#FF3366] hover:underline">
                    View All Guides &rarr;
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <!-- Article 1 -->
                <div class="rounded-3xl bg-[#FFF9FA] border border-[#f0d4da] overflow-hidden shadow-xs hover:shadow-md transition flex flex-col justify-between">
                    <div class="p-6">
                        <div class="w-full aspect-[16/10] rounded-2xl bg-gradient-to-tr from-[#FFE6E6] to-[#FFF1F2] flex items-center justify-center mb-4 overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1522263842439-347f0722f2ff?w=500&q=80&fit=crop" class="w-full h-full object-cover" alt="Article 1">
                        </div>
                        <h3 class="font-bold text-base text-[#1e1e24] mb-2 leading-snug">
                            Getting Over the Fantasy of Dating Someone
                        </h3>
                        <p class="text-xs text-[#695458] leading-relaxed line-clamp-3">
                            How projection and romantic daydreaming keep us from seeing the authentic person sitting across from us at the cafe table.
                        </p>
                    </div>
                    <div class="px-6 pb-6">
                        <a href="{{ route('blog.index') }}" class="text-xs font-bold text-[#FF3366] hover:underline">
                            Read More &rarr;
                        </a>
                    </div>
                </div>

                <!-- Article 2 -->
                <div class="rounded-3xl bg-[#FFF9FA] border border-[#f0d4da] overflow-hidden shadow-xs hover:shadow-md transition flex flex-col justify-between">
                    <div class="p-6">
                        <div class="w-full aspect-[16/10] rounded-2xl bg-gradient-to-tr from-[#FEF9C3] to-[#FEF08A] flex items-center justify-center mb-4 overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1517841905240-472988babdf9?w=500&q=80&fit=crop" class="w-full h-full object-cover" alt="Article 2">
                        </div>
                        <h3 class="font-bold text-base text-[#1e1e24] mb-2 leading-snug">
                            4 Strategies to Increase Your Vulnerability While Dating
                        </h3>
                        <p class="text-xs text-[#695458] leading-relaxed line-clamp-3">
                            Practical communication scripts to share what you really want without putting up defensive emotional walls.
                        </p>
                    </div>
                    <div class="px-6 pb-6">
                        <a href="{{ route('blog.index') }}" class="text-xs font-bold text-[#FF3366] hover:underline">
                            Read More &rarr;
                        </a>
                    </div>
                </div>

                <!-- Article 3 -->
                <div class="rounded-3xl bg-[#FFF9FA] border border-[#f0d4da] overflow-hidden shadow-xs hover:shadow-md transition flex flex-col justify-between">
                    <div class="p-6">
                        <div class="w-full aspect-[16/10] rounded-2xl bg-gradient-to-tr from-[#E8F4FD] to-[#BAE6FD] flex items-center justify-center mb-4 overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1501339847302-ac426a4a7cbb?w=500&q=80&fit=crop" class="w-full h-full object-cover" alt="Article 3">
                        </div>
                        <h3 class="font-bold text-base text-[#1e1e24] mb-2 leading-snug">
                            Setting Realistic Intentions for First Coffee Dates
                        </h3>
                        <p class="text-xs text-[#695458] leading-relaxed line-clamp-3">
                            Why the 45-minute pour-over creates the perfect low-pressure container for mutual discovery and real chemistry.
                        </p>
                    </div>
                    <div class="px-6 pb-6">
                        <a href="{{ route('blog.index') }}" class="text-xs font-bold text-[#FF3366] hover:underline">
                            Read More &rarr;
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ======================================================== -->
    <!-- 6. "FIND YOUR LOVE" BOTTOM BANNER (Matching Ref Image)   -->
    <!-- ======================================================== -->
    <section class="py-14 sm:py-20 bg-[#FFF5F7]">
        <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">
            <div class="rounded-3xl bg-white border border-[#f0d4da] p-8 sm:p-12 shadow-md flex flex-col md:flex-row items-center justify-between gap-8 relative overflow-hidden">
                
                <!-- Left Sticky Note CTA -->
                <div class="max-w-md">
                    <span class="inline-block px-3 py-1 rounded-lg bg-[#FFE6E6] text-[#b0284b] text-xs font-bold uppercase tracking-wider mb-3">
                        Find Your Love
                    </span>
                    <h2 class="text-3xl sm:text-4xl font-black text-[#1e1e24] tracking-tight leading-tight">
                        Start Your First Coffee Date Today.
                    </h2>
                    <p class="text-xs sm:text-sm text-[#695458] mt-2 leading-relaxed">
                        Join thousands of verified singles who value authentic connection. 100% free to create your profile.
                    </p>
                    <div class="mt-6">
                        @guest
                            <button type="button" onclick="openQuickAuthModal('register')" class="px-8 py-3.5 rounded-full bg-[#FF3366] hover:bg-[#e02857] text-white text-sm font-bold shadow-md shadow-pink-500/25 transition cursor-pointer">
                                Download &amp; Join Free
                            </button>
                        @else
                            <a href="{{ route('feed') }}" class="px-8 py-3.5 rounded-full bg-[#FF3366] hover:bg-[#e02857] text-white text-sm font-bold shadow-md shadow-pink-500/25 transition">
                                Enter Coffee Feed
                            </a>
                        @endguest
                    </div>
                </div>

                <!-- Right Graphic: Illustrated Mobile with Fishing / Spark Connection -->
                <div class="flex items-center justify-center">
                    <div class="w-48 sm:w-56 h-60 sm:h-72 rounded-3xl bg-[#FFF9FA] border-2 border-[#ecd5dc] p-4 flex flex-col items-center justify-center text-center shadow-inner relative">
                        <div class="w-16 h-16 rounded-full bg-gradient-to-tr from-[#FF3366] to-[#b0284b] text-white flex items-center justify-center text-2xl shadow-lg shadow-pink-500/30 mb-3 animate-pulse">
                            ♥
                        </div>
                        <h4 class="font-black text-sm text-[#1e1e24]">CupDate Match</h4>
                        <p class="text-[11px] text-[#785b62] mt-1">Connecting hearts over fresh brews</p>
                        <span class="mt-4 px-3 py-1 rounded-full bg-[#E8F4FD] text-[#0284c7] text-[10px] font-bold">100% Verified</span>
                    </div>
                </div>

            </div>
        </div>
    </section>

</div>
@endsection
