@extends('layouts.app')

@section('title', 'CupDate — Meet Verified Singles Over Coffee | India\'s Best Dating App')
@section('meta_desc', 'Join CupDate to meet selfie-verified singles for authentic coffee dates. Explore partner cafes with 15% member discounts across Pune, Mumbai, Delhi, Bangalore and Chandigarh.')

@section('content')
<!-- Hero Section -->
<section class="relative overflow-hidden pt-10 pb-16 md:pt-16 md:pb-24 bg-gradient-to-b from-[#f5ede6] via-[#fbf8f5] to-[#fbf8f5]">
    <!-- Ambient Coffee Tone Accents -->
    <div class="absolute -top-24 -left-24 w-96 h-96 bg-[#8b5a2b]/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute top-1/2 -right-24 w-96 h-96 bg-[#c8894f]/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-6xl mx-auto px-4">
        @auth
            <!-- Logged-in Personalized Quick-Launch Bar -->
            <div class="mb-10 bg-white border-2 border-[#8b5a2b] rounded-3xl p-6 md:p-8">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                    <div class="flex items-center gap-4">
                        <div class="relative">
                            <img src="{{ Auth::user()->avatar_url }}" alt="Avatar" class="w-16 h-16 rounded-full object-cover border-2 border-[#8b5a2b]">
                            @if(Auth::user()->is_verified)
                                <i class="fa-solid fa-circle-check text-[#3b82f6] text-sm absolute bottom-0 right-0 bg-white rounded-full"></i>
                            @endif
                        </div>
                        <div>
                            <div class="flex items-center gap-2">
                                <h2 class="font-['Plus_Jakarta_Sans'] font-extrabold text-xl text-[#24140d]">Welcome back, {{ Auth::user()->full_name }}! 👋</h2>
                                <span class="bg-[#f5ede6] text-[#8b5a2b] border border-[#e5d5ca] text-[10px] font-bold px-2 py-0.5 rounded-full font-mono">
                                    ID: #{{ Auth::user()->formatted_member_id }}
                                </span>
                            </div>
                            <p class="text-xs text-[#7d6558] mt-0.5">
                                Profile: <strong class="text-[#8b5a2b]">{{ $profileCompleteness }}%</strong> • Wallet: <strong class="text-[#d97706]">{{ Auth::user()->coins }} Coins</strong> • Coffee: <span class="text-[#24140d] font-semibold">{{ Auth::user()->coffee_style ?? 'Vanilla Oat Latte' }}</span>
                            </p>
                        </div>
                    </div>

                    <!-- Direct Quick Navigation Buttons -->
                    <div class="flex flex-wrap items-center gap-2.5">
                        <a href="{{ route('feed') }}" class="px-4 py-2.5 bg-[#f5ede6] border border-[#e5d5ca] text-[#8b5a2b] rounded-xl text-xs font-bold hover:bg-[#ebdcd0] transition flex items-center gap-1.5">
                            <i class="fa-solid fa-mug-hot"></i> Open Feed
                        </a>
                        <a href="{{ route('swipes') }}" class="px-4 py-2.5 bg-[#8b5a2b] text-white rounded-xl text-xs font-bold hover:bg-[#6d421d] transition flex items-center gap-1.5">
                            <i class="fa-solid fa-fire text-[#d97706]"></i> Start Swiping
                        </a>
                        <a href="{{ route('messages') }}" class="px-4 py-2.5 bg-[#f5ede6] border border-[#e5d5ca] text-[#7d6558] rounded-xl text-xs font-bold hover:text-[#8b5a2b] transition flex items-center gap-1.5">
                            <i class="fa-solid fa-comments"></i> Chat
                        </a>
                        <a href="{{ route('profile') }}" class="px-4 py-2.5 bg-white border border-[#e5d5ca] text-[#24140d] rounded-xl text-xs font-bold hover:bg-[#f5ede6] transition flex items-center gap-1.5">
                            <i class="fa-solid fa-user"></i> My Profile
                        </a>
                    </div>
                </div>
            </div>
        @endauth

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            <!-- Left Hero Text -->
            <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
                <div class="inline-flex items-center gap-2 bg-[#f5ede6] border border-[#e5d5ca] px-4 py-1.5 rounded-full text-xs font-bold text-[#8b5a2b]">
                    <span class="w-2 h-2 rounded-full bg-[#10b981] animate-ping"></span>
                    <span>India's #1 Coffee Dating Movement</span>
                </div>

                <h1 class="font-['Plus_Jakarta_Sans'] font-extrabold text-4xl sm:text-5xl lg:text-6xl text-[#24140d] leading-[1.14] tracking-tight">
                    Real Connections <br class="hidden sm:inline"> Over Coffee. <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#8b5a2b] via-[#b2733b] to-[#6d421d]">
                        100% Verified Singles.
                    </span>
                </h1>

                <p class="text-base sm:text-lg text-[#7d6558] max-w-xl mx-auto lg:mx-0 leading-relaxed">
                    Say goodbye to awkward 3-hour dinners, fake bots, and endless ghosting. CupDate connects verified singles for casual, low-pressure 45-minute coffee dates at landmark artisan cafes across India.
                </p>

                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-2">
                    @guest
                        <a href="{{ route('register') }}" class="w-full sm:w-auto px-8 py-4 bg-[#8b5a2b] text-white rounded-full font-extrabold text-sm hover:bg-[#6d421d] transition flex items-center justify-center gap-2 group">
                            <span>Find Your Coffee Date Free</span>
                            <i class="fa-solid fa-arrow-right text-xs group-hover:translate-x-1 transition"></i>
                        </a>
                        <a href="{{ route('auth.google') }}" class="w-full sm:w-auto px-6 py-3.5 bg-white border border-[#e5d5ca] text-[#24140d] rounded-full font-bold text-xs hover:bg-[#f5ede6] transition flex items-center justify-center gap-2.5 shadow-none">
                            <svg class="w-4 h-4 shrink-0" viewBox="0 0 24 24">
                                <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                                <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                                <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z"/>
                                <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z"/>
                            </svg>
                            <span>Sign in with Google</span>
                            <span class="text-[10px] bg-[#f5ede6] text-[#8b5a2b] font-extrabold px-2 py-0.5 rounded-full border border-[#e5d5ca]">Instant ID</span>
                        </a>
                    @else
                        <a href="{{ route('swipes') }}" class="w-full sm:w-auto px-8 py-4 bg-[#8b5a2b] text-white rounded-full font-extrabold text-sm hover:bg-[#6d421d] transition flex items-center justify-center gap-2">
                            <i class="fa-solid fa-fire text-[#d97706]"></i> Explore Singles (Swipes)
                        </a>
                        <a href="{{ route('feed') }}" class="w-full sm:w-auto px-6 py-4 bg-[#f5ede6] border border-[#e5d5ca] text-[#8b5a2b] rounded-full font-extrabold text-sm hover:bg-[#ebdcd0] transition flex items-center justify-center gap-2">
                            <i class="fa-solid fa-mug-hot"></i> Pitch a Date Idea
                        </a>
                    @endguest
                </div>

                <!-- Trust Micro-Badges -->
                <div class="pt-4 flex flex-wrap items-center justify-center lg:justify-start gap-6 text-xs text-[#7d6558]">
                    <span class="flex items-center gap-1.5"><i class="fa-solid fa-circle-check text-[#3b82f6]"></i> 100% Selfie Verified</span>
                    <span class="flex items-center gap-1.5"><i class="fa-solid fa-shield-halved text-[#10b981]"></i> Strict Women Safety</span>
                    <span class="flex items-center gap-1.5"><i class="fa-solid fa-mug-saucer text-[#8b5a2b]"></i> 15% Off Landmark Cafes</span>
                </div>
            </div>

            <!-- Right Hero Visual Showcase -->
            <div class="lg:col-span-5 relative flex justify-center">
                <div class="w-full max-w-sm relative">
                    <!-- Featured Single Card -->
                    @if(isset($featuredDaters) && $featuredDaters->isNotEmpty())
                        @php $leadDater = $featuredDaters->first(); @endphp
                        <div class="bg-white border-2 border-[#e5d5ca] rounded-3xl overflow-hidden animate-steam">
                            <div class="relative h-[320px] bg-[#f5ede6]">
                                <img src="{{ $leadDater->avatar_url }}" 
                                     alt="{{ $leadDater->full_name }}" 
                                     loading="lazy" 
                                     class="w-full h-full object-cover">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/75 via-transparent to-transparent"></div>
                                <div class="absolute bottom-4 left-4 right-4 text-white">
                                    <div class="flex items-center gap-2">
                                        <h3 class="font-['Plus_Jakarta_Sans'] font-extrabold text-2xl">{{ $leadDater->full_name }}, {{ $leadDater->age }}</h3>
                                        @if($leadDater->is_verified)
                                            <i class="fa-solid fa-circle-check text-[#3b82f6] text-lg bg-white rounded-full"></i>
                                        @endif
                                    </div>
                                    <p class="text-xs text-white/80 mt-0.5">
                                        {{ $leadDater->country ?? 'Pune, India' }} • {{ $leadDater->astrology ?? 'Libra' }} • {{ $leadDater->mbti ?? 'INFJ' }}
                                    </p>
                                    <span class="inline-block mt-2 bg-[#8b5a2b]/90 backdrop-blur text-white text-[10px] font-bold px-2.5 py-0.5 rounded-full">
                                        ☕ Orders: {{ $leadDater->coffee_style ?? 'Pour-Over Ethiopian Arabica' }}
                                    </span>
                                </div>
                            </div>
                            <div class="p-5 flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <span class="w-2.5 h-2.5 rounded-full bg-[#10b981] animate-ping"></span>
                                    <span class="text-xs font-bold text-[#24140d]">Available for coffee</span>
                                </div>
                                <a href="{{ route('messages', ['user_id' => $leadDater->id]) }}" class="px-4 py-2 bg-[#8b5a2b] text-white rounded-full text-xs font-bold hover:bg-[#6d421d] transition">
                                    Say Hi ☕
                                </a>
                            </div>
                        </div>
                    @endif

                    <!-- Floating Coffee Perk Badge -->
                    <div class="absolute -bottom-5 -left-5 bg-white border border-[#e5d5ca] rounded-2xl p-3 flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-[#f5ede6] border border-[#e5d5ca] flex items-center justify-center text-[#8b5a2b] text-lg">
                            <i class="fa-solid fa-mug-hot"></i>
                        </div>
                        <div>
                            <strong class="text-xs font-extrabold text-[#24140d] block">Verified Cafe Perks</strong>
                            <span class="text-[10px] text-[#7d6558]">15% discount on first dates</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Community Stats Counter Bar -->
<section class="border-y border-[#e5d5ca] bg-white py-8">
    <div class="max-w-6xl mx-auto px-4">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
            <div>
                <strong class="font-['Plus_Jakarta_Sans'] font-extrabold text-3xl md:text-4xl text-[#8b5a2b] block">100%</strong>
                <span class="text-xs text-[#7d6558] uppercase font-bold tracking-wider mt-1 block">Selfie Verified</span>
            </div>
            <div>
                <strong class="font-['Plus_Jakarta_Sans'] font-extrabold text-3xl md:text-4xl text-[#24140d] block">50K+</strong>
                <span class="text-xs text-[#7d6558] uppercase font-bold tracking-wider mt-1 block">Coffee Dates</span>
            </div>
            <div>
                <strong class="font-['Plus_Jakarta_Sans'] font-extrabold text-3xl md:text-4xl text-[#10b981] block">15+</strong>
                <span class="text-xs text-[#7d6558] uppercase font-bold tracking-wider mt-1 block">Metro Hubs</span>
            </div>
            <div>
                <strong class="font-['Plus_Jakarta_Sans'] font-extrabold text-3xl md:text-4xl text-[#c8894f] block">99.8%</strong>
                <span class="text-xs text-[#7d6558] uppercase font-bold tracking-wider mt-1 block">Safety Rating</span>
            </div>
        </div>
    </div>
</section>

<!-- NEW SECTION 1: Interactive Coffee Date Chemistry Matcher -->
<section id="matcher" class="py-16 md:py-20 bg-[#fbf8f5]">
    <div class="max-w-5xl mx-auto px-4">
        <div class="text-center max-w-2xl mx-auto mb-12">
            <span class="text-xs font-bold text-[#8b5a2b] uppercase tracking-wider bg-[#f5ede6] border border-[#e5d5ca] px-3.5 py-1 rounded-full">
                Interactive Chemistry Matcher
            </span>
            <h2 class="font-['Plus_Jakarta_Sans'] font-extrabold text-3xl md:text-4xl text-[#24140d] mt-3 mb-3">
                What's Your Coffee Dating Vibe?
            </h2>
            <p class="text-sm text-[#7d6558]">
                Select your go-to coffee drink to discover your psychological dating temperament and best match pairings.
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8" id="quizCards">
            <!-- Style 1 -->
            <div onclick="selectCoffeeStyle(this, 'Double Espresso', 'Ambitious & Direct', 'INTJ, ENTJ', 'You value efficiency, clear communication, and quick witty banter. You prefer a brisk 30-minute introductory coffee before deciding on a second date.')" class="bg-white border border-[#e5d5ca] rounded-2xl p-5 cursor-pointer hover:border-[#8b5a2b] transition flex flex-col justify-between">
                <div>
                    <div class="w-12 h-12 rounded-xl bg-[#f5ede6] text-[#8b5a2b] flex items-center justify-center text-xl mb-4">
                        <i class="fa-solid fa-bolt"></i>
                    </div>
                    <strong class="font-['Plus_Jakarta_Sans'] font-bold text-base text-[#24140d] block">Double Espresso</strong>
                    <span class="text-xs text-[#8b5a2b] font-semibold block mt-0.5">The Bold Achiever</span>
                    <p class="text-xs text-[#7d6558] mt-2 leading-relaxed">Direct, intellectually driven, thrives on stimulating debates.</p>
                </div>
                <div class="mt-4 pt-3 border-t border-[#e5d5ca] text-[11px] font-bold text-[#8b5a2b]">Select Vibe →</div>
            </div>

            <!-- Style 2 -->
            <div onclick="selectCoffeeStyle(this, 'Vanilla Oat Latte', 'Warm & Deep Conversationalist', 'ENFP, INFJ', 'You love cozy ambient cafe corners, discussing books, travel memories, and psychological theories over warm oat milk foam.')" class="bg-white border border-[#e5d5ca] rounded-2xl p-5 cursor-pointer hover:border-[#8b5a2b] transition flex flex-col justify-between border-[#8b5a2b] bg-[#f5ede6]/30">
                <div>
                    <div class="w-12 h-12 rounded-xl bg-[#f5ede6] text-[#8b5a2b] flex items-center justify-center text-xl mb-4">
                        <i class="fa-solid fa-heart"></i>
                    </div>
                    <strong class="font-['Plus_Jakarta_Sans'] font-bold text-base text-[#24140d] block">Vanilla Oat Latte</strong>
                    <span class="text-xs text-[#8b5a2b] font-semibold block mt-0.5">The Deep Romantic</span>
                    <p class="text-xs text-[#7d6558] mt-2 leading-relaxed">Empathetic, attentive listener, adores comfortable ambiance.</p>
                </div>
                <div class="mt-4 pt-3 border-t border-[#e5d5ca] text-[11px] font-bold text-[#8b5a2b]">Select Vibe →</div>
            </div>

            <!-- Style 3 -->
            <div onclick="selectCoffeeStyle(this, 'Single-Origin Pour-Over', 'Intellectual & Detail-Oriented', 'INTP, ISTP', 'You appreciate artisanal craft, music vinyls, and nuanced questions. You prefer tranquil garden roasteries with gentle indie soundtracks.')" class="bg-white border border-[#e5d5ca] rounded-2xl p-5 cursor-pointer hover:border-[#8b5a2b] transition flex flex-col justify-between">
                <div>
                    <div class="w-12 h-12 rounded-xl bg-[#f5ede6] text-[#8b5a2b] flex items-center justify-center text-xl mb-4">
                        <i class="fa-solid fa-filter"></i>
                    </div>
                    <strong class="font-['Plus_Jakarta_Sans'] font-bold text-base text-[#24140d] block">Artisan Pour-Over</strong>
                    <span class="text-xs text-[#8b5a2b] font-semibold block mt-0.5">The Connoisseur</span>
                    <p class="text-xs text-[#7d6558] mt-2 leading-relaxed">Authentic, loves detail, avoids superficial small talk.</p>
                </div>
                <div class="mt-4 pt-3 border-t border-[#e5d5ca] text-[11px] font-bold text-[#8b5a2b]">Select Vibe →</div>
            </div>

            <!-- Style 4 -->
            <div onclick="selectCoffeeStyle(this, 'Iced Tonic Cold Brew', 'Spontaneous & Creative', 'ENTP, ESFP', 'You love sunny outdoor patios, lively cafe verandas, and spontaneous conversations that seamlessly flow from coffee into evening walks.')" class="bg-white border border-[#e5d5ca] rounded-2xl p-5 cursor-pointer hover:border-[#8b5a2b] transition flex flex-col justify-between">
                <div>
                    <div class="w-12 h-12 rounded-xl bg-[#f5ede6] text-[#8b5a2b] flex items-center justify-center text-xl mb-4">
                        <i class="fa-solid fa-ice-cream"></i>
                    </div>
                    <strong class="font-['Plus_Jakarta_Sans'] font-bold text-base text-[#24140d] block">Cold Brew Tonic</strong>
                    <span class="text-xs text-[#8b5a2b] font-semibold block mt-0.5">The Free Spirit</span>
                    <p class="text-xs text-[#7d6558] mt-2 leading-relaxed">Playful, energetic, always ready for unplanned city strolls.</p>
                </div>
                <div class="mt-4 pt-3 border-t border-[#e5d5ca] text-[11px] font-bold text-[#8b5a2b]">Select Vibe →</div>
            </div>
        </div>

        <!-- Dynamic Chemistry Result Box -->
        <div id="quizResultBox" class="bg-white border-2 border-[#8b5a2b] rounded-3xl p-6 md:p-8 flex flex-col md:flex-row items-center justify-between gap-6">
            <div>
                <div class="flex items-center gap-2 mb-1">
                    <span class="text-xs uppercase font-extrabold tracking-wider text-[#8b5a2b]">Selected Dating Archetype</span>
                    <span id="quizDrinkName" class="text-xs font-bold text-[#24140d] bg-[#f5ede6] px-2.5 py-0.5 rounded-full">Vanilla Oat Latte</span>
                </div>
                <h3 id="quizVibeTitle" class="font-['Plus_Jakarta_Sans'] font-extrabold text-xl text-[#24140d]">The Deep Romantic</h3>
                <p id="quizDesc" class="text-xs text-[#7d6558] mt-1 max-w-xl leading-relaxed">
                    You love cozy ambient cafe corners, discussing books, travel memories, and psychological theories over warm oat milk foam.
                </p>
                <div class="mt-3 flex items-center gap-2 text-xs font-bold text-[#24140d]">
                    <span>Best Compatible MBTI Types:</span>
                    <span id="quizCompatible" class="text-[#8b5a2b] bg-[#f5ede6] border border-[#e5d5ca] px-2 py-0.5 rounded-md">ENFP, INFJ</span>
                </div>
            </div>
            <a href="{{ route('swipes') }}" class="shrink-0 px-6 py-3.5 bg-[#8b5a2b] text-white rounded-full font-bold text-xs hover:bg-[#6d421d] transition">
                Find Compatible Singles Now →
            </a>
        </div>
    </div>
</section>

<!-- NEW SECTION 2: Curated Landmark Coffee Date Spots & Cafe Partners -->
<section id="cafes" class="py-16 md:py-24 bg-white border-y border-[#e5d5ca]">
    <div class="max-w-6xl mx-auto px-4">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-12">
            <div>
                <span class="text-xs font-bold text-[#8b5a2b] uppercase tracking-wider bg-[#f5ede6] border border-[#e5d5ca] px-3.5 py-1 rounded-full">
                    <i class="fa-solid fa-mug-saucer mr-1"></i> Landmark Partner Cafes
                </span>
                <h2 class="font-['Plus_Jakarta_Sans'] font-extrabold text-3xl md:text-4xl text-[#24140d] mt-3">
                    Where Real CupDates Happen
                </h2>
                <p class="text-xs md:text-sm text-[#7d6558] mt-2">
                    Verified landmark specialty cafes offering ambient seating, acoustic comfort, and exclusive 15% CupDate member perks.
                </p>
            </div>
            <span class="mt-4 md:mt-0 inline-flex items-center gap-1.5 text-xs font-bold text-[#10b981] bg-[#ecfdf5] border border-[#a7f3d0] px-3 py-1.5 rounded-full">
                <i class="fa-solid fa-check"></i> Safe Public Meeting Spots
            </span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @forelse(($hotspots ?? $datePlaces ?? []) as $spot)
                <div class="bg-white border border-[#e5d5ca] rounded-3xl overflow-hidden hover:border-[#8b5a2b] transition flex flex-col justify-between">
                    <div>
                        <div class="h-44 bg-[#f5ede6] relative overflow-hidden">
                            <img src="{{ asset($spot->image_url ?? 'assets/images/default_cafe.jpg') }}" 
                                 alt="{{ $spot->name }}" 
                                 loading="lazy" 
                                 class="w-full h-full object-cover"
                                 onerror="this.onerror=null;this.src='{{ asset('assets/images/default_cafe.jpg') }}';">
                            <div class="absolute top-3 left-3 bg-[#24140d]/80 backdrop-blur text-white text-[10px] font-bold px-2.5 py-1 rounded-full flex items-center gap-1">
                                <i class="fa-solid fa-location-dot text-[#c8894f]"></i> {{ $spot->city }}
                            </div>
                            <div class="absolute top-3 right-3 bg-white/95 text-[#d97706] text-xs font-extrabold px-2 py-0.5 rounded-full flex items-center gap-1">
                                ★ {{ $spot->rating }}
                            </div>
                        </div>
                        <div class="p-5">
                            <span class="text-[10px] uppercase font-extrabold text-[#8b5a2b] tracking-wider block">{{ $spot->type }}</span>
                            <h3 class="font-['Plus_Jakarta_Sans'] font-extrabold text-lg text-[#24140d] mt-1">{{ $spot->name }}</h3>
                            <p class="text-xs text-[#7d6558] mt-1 line-clamp-2 leading-relaxed">{{ $spot->description }}</p>
                            <p class="text-[11px] text-[#7d6558] mt-3 flex items-center gap-1.5">
                                <i class="fa-solid fa-map-pin text-[#8b5a2b]"></i> {{ $spot->address }}
                            </p>
                        </div>
                    </div>
                    <div class="p-5 pt-0 border-t border-[#e5d5ca] mt-2 flex items-center justify-between">
                        <span class="text-xs font-bold text-[#10b981] bg-[#ecfdf5] border border-[#a7f3d0] px-2.5 py-1 rounded-full flex items-center gap-1">
                            <i class="fa-solid fa-tag"></i> {{ $spot->cup_offer }}
                        </span>
                        <a href="{{ route('feed') }}" class="text-xs font-bold text-[#8b5a2b] hover:underline">
                            Invite on Date →
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-12 bg-[#fbf8f5] border border-[#e5d5ca] rounded-2xl text-xs text-[#7d6558]">
                    Loading curated partner cafes...
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- NEW SECTION 3: Live Dating Activity Stream -->
<section class="py-8 bg-[#24140d] text-[#ffffff] border-y border-[#3d2314]">
    <div class="max-w-6xl mx-auto px-4 flex flex-col md:flex-row items-center justify-between gap-4">
        <div class="flex items-center gap-2 shrink-0">
            <span class="w-2.5 h-2.5 rounded-full bg-[#10b981] animate-ping"></span>
            <span class="text-xs uppercase font-extrabold tracking-wider text-[#c8894f]">Live Cafe Activity</span>
        </div>
        <div class="overflow-hidden w-full">
            <div class="flex items-center gap-8 text-xs text-[#d6c4b8] animate-pulse whitespace-nowrap">
                <span>☕ <strong>Priya & Rahul</strong> just matched over Pour-Over in Koregaon Park, Pune!</span>
                <span>•</span>
                <span>✨ <strong>Vikram</strong> boosted their profile in Indiranagar, Bangalore!</span>
                <span>•</span>
                <span>📍 <strong>Ananya & Kabir</strong> scheduled a 45-min date at Subko, Bandra!</span>
                <span>•</span>
                <span>🛡️ <strong>100%</strong> of today's new signups completed selfie verification!</span>
            </div>
        </div>
    </div>
</section>

<!-- How CupDate Works -->
<section id="how-it-works" class="py-16 md:py-24 bg-[#fbf8f5]">
    <div class="max-w-6xl mx-auto px-4">
        <div class="text-center max-w-2xl mx-auto mb-14">
            <span class="text-xs font-bold text-[#8b5a2b] uppercase tracking-wider bg-[#f5ede6] border border-[#e5d5ca] px-3.5 py-1 rounded-full">
                Simple & Natural
            </span>
            <h2 class="font-['Plus_Jakarta_Sans'] font-extrabold text-3xl md:text-4xl text-[#24140d] mt-3 mb-3">
                How CupDate Works
            </h2>
            <p class="text-sm text-[#7d6558]">
                Three straightforward steps designed to take you from mutual chemistry to an authentic cafe conversation.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white border border-[#e5d5ca] rounded-3xl p-8 text-center flex flex-col items-center hover:border-[#8b5a2b] transition">
                <div class="w-16 h-16 rounded-2xl bg-[#f5ede6] border border-[#e5d5ca] flex items-center justify-center text-2xl text-[#8b5a2b] mb-6">
                    <i class="fa-solid fa-fire text-[#d97706]"></i>
                </div>
                <h3 class="font-['Plus_Jakarta_Sans'] font-extrabold text-xl text-[#24140d] mb-2">1. Match & Swipe</h3>
                <p class="text-xs text-[#7d6558] leading-relaxed">
                    Explore selfie-verified singles based on mutual coffee tastes, MBTI chemistry, and landmark neighborhood cafes.
                </p>
            </div>

            <div class="bg-white border border-[#e5d5ca] rounded-3xl p-8 text-center flex flex-col items-center hover:border-[#8b5a2b] transition">
                <div class="w-16 h-16 rounded-2xl bg-[#f5ede6] border border-[#e5d5ca] flex items-center justify-center text-2xl text-[#8b5a2b] mb-6">
                    <i class="fa-solid fa-comments"></i>
                </div>
                <h3 class="font-['Plus_Jakarta_Sans'] font-extrabold text-xl text-[#24140d] mb-2">2. Sip & Chat</h3>
                <p class="text-xs text-[#7d6558] leading-relaxed">
                    Break the ice with coffee date ideas in our clutter-free chat. Strictly pure conversation with zero distracting ads.
                </p>
            </div>

            <div class="bg-white border border-[#e5d5ca] rounded-3xl p-8 text-center flex flex-col items-center hover:border-[#8b5a2b] transition">
                <div class="w-16 h-16 rounded-2xl bg-[#f5ede6] border border-[#e5d5ca] flex items-center justify-center text-2xl text-[#10b981] mb-6">
                    <i class="fa-solid fa-mug-hot"></i>
                </div>
                <h3 class="font-['Plus_Jakarta_Sans'] font-extrabold text-xl text-[#24140d] mb-2">3. Meet at Cozy Cafes</h3>
                <p class="text-xs text-[#7d6558] leading-relaxed">
                    Enjoy a low-pressure, 45-minute first date at safe, verified partner coffee shops with 15% member bill discounts.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Featured Singles Showcase -->
<section class="py-16 bg-white border-y border-[#e5d5ca]">
    <div class="max-w-6xl mx-auto px-4">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-10">
            <div>
                <span class="text-xs font-bold text-[#8b5a2b] uppercase tracking-wider bg-[#f5ede6] border border-[#e5d5ca] px-3.5 py-1 rounded-full">
                    Verified Members
                </span>
                <h2 class="font-['Plus_Jakarta_Sans'] font-extrabold text-3xl text-[#24140d] mt-3">
                    Singles Ready For Coffee This Week
                </h2>
            </div>
            <a href="{{ route('swipes') }}" class="mt-4 md:mt-0 font-extrabold text-xs text-[#8b5a2b] hover:underline flex items-center gap-1">
                View All Singles in Swipes →
            </a>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">
            @foreach($featuredDaters->take(4) as $single)
                <div class="bg-white border border-[#e5d5ca] rounded-2xl overflow-hidden hover:border-[#8b5a2b] transition flex flex-col">
                    <div class="relative h-48 sm:h-56 bg-[#f5ede6]">
                        <img src="{{ $single->avatar_url }}" 
                             alt="{{ $single->full_name }}" 
                             loading="lazy" 
                             class="w-full h-full object-cover">
                        @if($single->is_verified)
                            <div class="absolute top-2 right-2 bg-white/90 backdrop-blur px-2 py-0.5 rounded-full text-[10px] font-bold text-[#3b82f6] flex items-center gap-1">
                                <i class="fa-solid fa-circle-check"></i> Verified
                            </div>
                        @endif
                    </div>
                    <div class="p-4 flex-1 flex flex-col justify-between">
                        <div>
                            <strong class="font-['Plus_Jakarta_Sans'] font-extrabold text-sm text-[#24140d] block truncate">
                                {{ $single->full_name }}, {{ $single->age }}
                            </strong>
                            <p class="text-[11px] text-[#7d6558] mt-0.5">
                                {{ $single->country ?? 'India' }} • {{ $single->mbti ?? 'ENFP' }}
                            </p>
                        </div>
                        <a href="{{ route('messages', ['user_id' => $single->id]) }}" class="mt-3 w-full py-2 bg-[#f5ede6] border border-[#e5d5ca] text-[#8b5a2b] hover:bg-[#8b5a2b] hover:text-white rounded-xl text-center text-xs font-bold transition">
                            Say Hi ☕
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Women Safety & Digital Shielding -->
<section id="safety" class="py-16 md:py-24 bg-[#fbf8f5]">
    <div class="max-w-6xl mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            <div class="lg:col-span-6 space-y-6">
                <span class="text-xs font-bold text-[#10b981] uppercase tracking-wider bg-[#ecfdf5] border border-[#a7f3d0] px-3.5 py-1 rounded-full">
                    <i class="fa-solid fa-shield-halved mr-1"></i> Safety First Architecture
                </span>
                <h2 class="font-['Plus_Jakarta_Sans'] font-extrabold text-3xl md:text-4xl text-[#24140d]">
                    Built for Women's Peace of Mind. <br>
                    Zero Tolerance For Creeps.
                </h2>
                <p class="text-sm text-[#7d6558] leading-relaxed">
                    CupDate protects your privacy, mental calm, and physical safety through algorithmic selfie verification, ghost location fuzzing, and prompt automated moderation.
                </p>

                <div class="space-y-4 pt-2">
                    <div class="flex items-start gap-3.5">
                        <div class="w-8 h-8 rounded-full bg-[#f5ede6] border border-[#e5d5ca] text-[#8b5a2b] flex items-center justify-center shrink-0 mt-0.5 text-xs">
                            <i class="fa-solid fa-location-crosshairs"></i>
                        </div>
                        <div>
                            <strong class="text-sm font-bold text-[#24140d] block">Ghost Location Fuzzing (1.5–2km)</strong>
                            <p class="text-xs text-[#7d6558] mt-0.5">Your home or office street address is never pinpointed. Coordinates are intentionally blurred by 1.5–2 kilometers.</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3.5">
                        <div class="w-8 h-8 rounded-full bg-[#ecfdf5] border border-[#a7f3d0] text-[#10b981] flex items-center justify-center shrink-0 mt-0.5 text-xs">
                            <i class="fa-solid fa-camera"></i>
                        </div>
                        <div>
                            <strong class="text-sm font-bold text-[#24140d] block">Algorithmic Selfie Liveness Check</strong>
                            <p class="text-xs text-[#7d6558] mt-0.5">Stolen internet photos and duplicate accounts are rejected. Every verified profile reflects a real human dater.</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3.5">
                        <div class="w-8 h-8 rounded-full bg-[#f5ede6] border border-[#e5d5ca] text-[#8b5a2b] flex items-center justify-center shrink-0 mt-0.5 text-xs">
                            <i class="fa-solid fa-user-slash"></i>
                        </div>
                        <div>
                            <strong class="text-sm font-bold text-[#24140d] block">Stealth 1-Tap Block</strong>
                            <p class="text-xs text-[#7d6558] mt-0.5">When you block a user, you vanish from their feed, messages, and discovery forever without notifying them.</p>
                        </div>
                    </div>
                </div>

                <div class="pt-2">
                    <a href="/blog/women-dating-safety-guide-india.php" class="inline-flex items-center gap-2 text-xs font-extrabold text-[#10b981] hover:underline">
                        Read Our Full Women Safety Guide (1,500+ Words) →
                    </a>
                </div>
            </div>

            <div class="lg:col-span-6 bg-white border border-[#e5d5ca] rounded-3xl p-8">
                <div class="text-center mb-6">
                    <div class="w-14 h-14 rounded-full bg-[#f5ede6] border border-[#e5d5ca] text-[#8b5a2b] flex items-center justify-center text-2xl mx-auto mb-3">
                        <i class="fa-solid fa-phone-volume"></i>
                    </div>
                    <h3 class="font-['Plus_Jakarta_Sans'] font-extrabold text-xl text-[#24140d]">24/7 National Emergency Helplines</h3>
                    <p class="text-xs text-[#7d6558] mt-1">Instant contacts for real-world support across India.</p>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div class="bg-[#fbf8f5] border border-[#e5d5ca] p-4 rounded-2xl text-center">
                        <strong class="text-xl font-extrabold text-[#8b5a2b] block">1091</strong>
                        <span class="text-[11px] text-[#7d6558]">National Women Helpline</span>
                    </div>
                    <div class="bg-[#fbf8f5] border border-[#e5d5ca] p-4 rounded-2xl text-center">
                        <strong class="text-xl font-extrabold text-[#10b981] block">112</strong>
                        <span class="text-[11px] text-[#7d6558]">All-in-One Emergency</span>
                    </div>
                    <div class="bg-[#fbf8f5] border border-[#e5d5ca] p-4 rounded-2xl text-center">
                        <strong class="text-xl font-extrabold text-[#8b5a2b] block">1930</strong>
                        <span class="text-[11px] text-[#7d6558]">National Cyber Crime</span>
                    </div>
                    <div class="bg-[#fbf8f5] border border-[#e5d5ca] p-4 rounded-2xl text-center">
                        <strong class="text-xl font-extrabold text-[#10b981] block">181</strong>
                        <span class="text-[11px] text-[#7d6558]">Women in Distress</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- NEW SECTION 4: VIP Coffee Club Membership Comparison -->
<section class="py-16 md:py-24 bg-white border-b border-[#e5d5ca]">
    <div class="max-w-5xl mx-auto px-4">
        <div class="text-center max-w-2xl mx-auto mb-12">
            <span class="text-xs font-bold text-[#8b5a2b] uppercase tracking-wider bg-[#f5ede6] border border-[#e5d5ca] px-3.5 py-1 rounded-full">
                Transparent Membership
            </span>
            <h2 class="font-['Plus_Jakarta_Sans'] font-extrabold text-3xl md:text-4xl text-[#24140d] mt-3 mb-3">
                Choose Your Coffee Club Plan
            </h2>
            <p class="text-sm text-[#7d6558]">
                Start 100% free with verified matching. Upgrade anytime to supercharge your discovery radius.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Free Sip -->
            <div class="bg-[#fbf8f5] border border-[#e5d5ca] rounded-3xl p-6 flex flex-col justify-between">
                <div>
                    <h3 class="font-['Plus_Jakarta_Sans'] font-extrabold text-lg text-[#24140d]">Free Sip</h3>
                    <p class="text-xs text-[#7d6558] mt-0.5">Everything you need to find coffee dates.</p>
                    <div class="my-5">
                        <strong class="font-['Plus_Jakarta_Sans'] font-extrabold text-3xl text-[#24140d]">₹0</strong>
                        <span class="text-xs text-[#7d6558]">/ forever free</span>
                    </div>
                    <ul class="space-y-2.5 text-xs text-[#7d6558]">
                        <li class="flex items-center gap-2"><i class="fa-solid fa-check text-[#10b981]"></i> 100% Selfie Verification</li>
                        <li class="flex items-center gap-2"><i class="fa-solid fa-check text-[#10b981]"></i> Up to 50 Swipes Daily</li>
                        <li class="flex items-center gap-2"><i class="fa-solid fa-check text-[#10b981]"></i> Clutter-Free Direct Messaging</li>
                        <li class="flex items-center gap-2 text-gray-400"><i class="fa-solid fa-xmark"></i> 24h Profile Boosts</li>
                    </ul>
                </div>
                <a href="{{ route('register') }}" class="mt-6 w-full py-2.5 bg-white border border-[#e5d5ca] rounded-xl text-center text-xs font-bold text-[#24140d] hover:bg-[#f5ede6] transition">
                    Get Started Free
                </a>
            </div>

            <!-- Gold Roaster (Popular) -->
            <div class="bg-white border-2 border-[#8b5a2b] rounded-3xl p-6 flex flex-col justify-between relative">
                <span class="absolute -top-3 left-1/2 -translate-x-1/2 bg-[#8b5a2b] text-white text-[10px] font-extrabold px-3 py-0.5 rounded-full uppercase tracking-wider">
                    Most Popular
                </span>
                <div>
                    <h3 class="font-['Plus_Jakarta_Sans'] font-extrabold text-lg text-[#24140d]">Gold Roaster</h3>
                    <p class="text-xs text-[#7d6558] mt-0.5">For active daters seeking genuine chemistry.</p>
                    <div class="my-5">
                        <strong class="font-['Plus_Jakarta_Sans'] font-extrabold text-3xl text-[#8b5a2b]">₹299</strong>
                        <span class="text-xs text-[#7d6558]">/ month</span>
                    </div>
                    <ul class="space-y-2.5 text-xs text-[#24140d]">
                        <li class="flex items-center gap-2"><i class="fa-solid fa-check text-[#10b981]"></i> Unlimited Daily Swipes</li>
                        <li class="flex items-center gap-2"><i class="fa-solid fa-check text-[#10b981]"></i> 5 Free Superlikes Weekly</li>
                        <li class="flex items-center gap-2"><i class="fa-solid fa-check text-[#10b981]"></i> 1 Monthly 24h Profile Boost</li>
                        <li class="flex items-center gap-2"><i class="fa-solid fa-check text-[#10b981]"></i> 15% Partner Cafe Member Perks</li>
                    </ul>
                </div>
                <a href="{{ route('register') }}" class="mt-6 w-full py-2.5 bg-[#8b5a2b] text-white rounded-xl text-center text-xs font-bold hover:bg-[#6d421d] transition">
                    Upgrade to Gold ☕
                </a>
            </div>

            <!-- Diamond Barista -->
            <div class="bg-[#fbf8f5] border border-[#e5d5ca] rounded-3xl p-6 flex flex-col justify-between">
                <div>
                    <h3 class="font-['Plus_Jakarta_Sans'] font-extrabold text-lg text-[#24140d]">Diamond Barista</h3>
                    <p class="text-xs text-[#7d6558] mt-0.5">Top-tier visibility across multiple cities.</p>
                    <div class="my-5">
                        <strong class="font-['Plus_Jakarta_Sans'] font-extrabold text-3xl text-[#24140d]">₹599</strong>
                        <span class="text-xs text-[#7d6558]">/ month</span>
                    </div>
                    <ul class="space-y-2.5 text-xs text-[#7d6558]">
                        <li class="flex items-center gap-2"><i class="fa-solid fa-check text-[#10b981]"></i> Everything in Gold Roaster</li>
                        <li class="flex items-center gap-2"><i class="fa-solid fa-check text-[#10b981]"></i> Multi-City Travel Mode</li>
                        <li class="flex items-center gap-2"><i class="fa-solid fa-check text-[#10b981]"></i> Priority Verified Badge</li>
                        <li class="flex items-center gap-2"><i class="fa-solid fa-check text-[#10b981]"></i> Incognito Browsing Option</li>
                    </ul>
                </div>
                <a href="{{ route('register') }}" class="mt-6 w-full py-2.5 bg-white border border-[#e5d5ca] rounded-xl text-center text-xs font-bold text-[#24140d] hover:bg-[#f5ede6] transition">
                    Join VIP Club
                </a>
            </div>
        </div>
    </div>
</section>

<!-- NEW SECTION 5: Real Success Stories (Love Over Coffee) -->
<section class="py-16 md:py-24 bg-[#fbf8f5]">
    <div class="max-w-6xl mx-auto px-4">
        <div class="text-center max-w-2xl mx-auto mb-14">
            <span class="text-xs font-bold text-[#8b5a2b] uppercase tracking-wider bg-[#f5ede6] border border-[#e5d5ca] px-3.5 py-1 rounded-full">
                Real Romance
            </span>
            <h2 class="font-['Plus_Jakarta_Sans'] font-extrabold text-3xl md:text-4xl text-[#24140d] mt-3 mb-3">
                Stories Brewed on CupDate
            </h2>
            <p class="text-sm text-[#7d6558]">
                Real singles who met for a quick 45-minute coffee and ended up sharing a lifetime of mornings.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Story 1 -->
            <div class="bg-white border border-[#e5d5ca] rounded-3xl p-6 flex flex-col justify-between">
                <div>
                    <div class="flex items-center gap-1 text-[#d97706] text-xs mb-3">
                        ★★★★★
                    </div>
                    <p class="text-xs text-[#4a2c1d] leading-relaxed italic mb-4">
                        "We matched over our mutual love for Ethiopian pour-overs. Met at Blue Tokai in Koregaon Park for what was supposed to be a 45-minute chat, and we ended up talking until the cafe closed. Engaged last month!"
                    </p>
                </div>
                <div class="pt-4 border-t border-[#e5d5ca] flex items-center gap-3">
                    <img src="{{ asset('assets/images/default_avatar.png') }}" class="w-10 h-10 rounded-full object-cover border border-[#8b5a2b]">
                    <div>
                        <strong class="text-xs font-bold text-[#24140d] block">Pooja & Sameer</strong>
                        <span class="text-[10px] text-[#7d6558]">Met in Pune • Together 1.5 Years</span>
                    </div>
                </div>
            </div>

            <!-- Story 2 -->
            <div class="bg-white border border-[#e5d5ca] rounded-3xl p-6 flex flex-col justify-between">
                <div>
                    <div class="flex items-center gap-1 text-[#d97706] text-xs mb-3">
                        ★★★★★
                    </div>
                    <p class="text-xs text-[#4a2c1d] leading-relaxed italic mb-4">
                        "As a woman dating in Mumbai, CupDate's selfie verification and cafe-only format gave me immense comfort. Met Kabir at Subko in Bandra — safe, respectful, and zero creepiness. Truly the best app!"
                    </p>
                </div>
                <div class="pt-4 border-t border-[#e5d5ca] flex items-center gap-3">
                    <img src="{{ asset('assets/images/default_avatar.png') }}" class="w-10 h-10 rounded-full object-cover border border-[#8b5a2b]">
                    <div>
                        <strong class="text-xs font-bold text-[#24140d] block">Ananya & Kabir</strong>
                        <span class="text-[10px] text-[#7d6558]">Met in Mumbai • Together 2 Years</span>
                    </div>
                </div>
            </div>

            <!-- Story 3 -->
            <div class="bg-white border border-[#e5d5ca] rounded-3xl p-6 flex flex-col justify-between">
                <div>
                    <div class="flex items-center gap-1 text-[#d97706] text-xs mb-3">
                        ★★★★★
                    </div>
                    <p class="text-xs text-[#4a2c1d] leading-relaxed italic mb-4">
                        "I was exhausted by fake profiles on other apps. CupDate was refreshing because everyone is verified and genuinely wants to meet for coffee rather than wasting weeks on small talk. 10/10 recommended!"
                    </p>
                </div>
                <div class="pt-4 border-t border-[#e5d5ca] flex items-center gap-3">
                    <img src="{{ asset('assets/images/default_avatar.png') }}" class="w-10 h-10 rounded-full object-cover border border-[#8b5a2b]">
                    <div>
                        <strong class="text-xs font-bold text-[#24140d] block">Rhea & Rohan</strong>
                        <span class="text-[10px] text-[#7d6558]">Met in Bangalore • Together 8 Months</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- NEW SECTION 6: Interactive Collapsible FAQ Accordion -->
<section class="py-16 md:py-20 bg-white border-t border-[#e5d5ca]">
    <div class="max-w-4xl mx-auto px-4">
        <div class="text-center max-w-2xl mx-auto mb-12">
            <span class="text-xs font-bold text-[#8b5a2b] uppercase tracking-wider bg-[#f5ede6] border border-[#e5d5ca] px-3.5 py-1 rounded-full">
                Got Questions?
            </span>
            <h2 class="font-['Plus_Jakarta_Sans'] font-extrabold text-3xl md:text-4xl text-[#24140d] mt-3 mb-3">
                Frequently Asked Questions
            </h2>
            <p class="text-sm text-[#7d6558]">
                Everything you need to know about CupDate's verification, coffee dates, and safety policies.
            </p>
        </div>

        <div class="space-y-3" id="faqAccordion">
            <!-- Q1 -->
            <div class="bg-[#fbf8f5] border border-[#e5d5ca] rounded-2xl p-5 cursor-pointer" onclick="toggleFaq(this)">
                <div class="flex items-center justify-between">
                    <h3 class="font-['Plus_Jakarta_Sans'] font-bold text-sm text-[#24140d]">Why is a coffee date better than a traditional dinner date?</h3>
                    <i class="fa-solid fa-chevron-down text-xs text-[#8b5a2b] transition-transform duration-200"></i>
                </div>
                <div class="faq-content hidden mt-3 text-xs text-[#7d6558] leading-relaxed pt-2 border-t border-[#e5d5ca]">
                    Dinner dates place immense financial pressure on both parties and trap daters for 90 to 120 minutes even if there is zero chemistry. A 45-minute coffee date in a bright public cafe eliminates awkwardness, costs under ₹500, and lets you gracefully extend if chemistry is great!
                </div>
            </div>

            <!-- Q2 -->
            <div class="bg-[#fbf8f5] border border-[#e5d5ca] rounded-2xl p-5 cursor-pointer" onclick="toggleFaq(this)">
                <div class="flex items-center justify-between">
                    <h3 class="font-['Plus_Jakarta_Sans'] font-bold text-sm text-[#24140d]">How does CupDate verify that profiles are 100% real?</h3>
                    <i class="fa-solid fa-chevron-down text-xs text-[#8b5a2b] transition-transform duration-200"></i>
                </div>
                <div class="faq-content hidden mt-3 text-xs text-[#7d6558] leading-relaxed pt-2 border-t border-[#e5d5ca]">
                    CupDate requires members to take a real-time live selfie with micro-head movements. Our biometric model compares this to uploaded photos to verify identity, completely eliminating bots and catfishes.
                </div>
            </div>

            <!-- Q3 -->
            <div class="bg-[#fbf8f5] border border-[#e5d5ca] rounded-2xl p-5 cursor-pointer" onclick="toggleFaq(this)">
                <div class="flex items-center justify-between">
                    <h3 class="font-['Plus_Jakarta_Sans'] font-bold text-sm text-[#24140d]">Who pays on a first coffee date in India?</h3>
                    <i class="fa-solid fa-chevron-down text-xs text-[#8b5a2b] transition-transform duration-200"></i>
                </div>
                <div class="faq-content hidden mt-3 text-xs text-[#7d6558] leading-relaxed pt-2 border-t border-[#e5d5ca]">
                    Modern etiquette in India recommends that whoever initiates the coffee invitation offers to pay, while the receiving partner politely offers to split via UPI or pick up the pastry. Mutual respect is always in style.
                </div>
            </div>

            <!-- Q4 -->
            <div class="bg-[#fbf8f5] border border-[#e5d5ca] rounded-2xl p-5 cursor-pointer" onclick="toggleFaq(this)">
                <div class="flex items-center justify-between">
                    <h3 class="font-['Plus_Jakarta_Sans'] font-bold text-sm text-[#24140d]">How do CupDate's partner cafe discounts work?</h3>
                    <i class="fa-solid fa-chevron-down text-xs text-[#8b5a2b] transition-transform duration-200"></i>
                </div>
                <div class="faq-content hidden mt-3 text-xs text-[#7d6558] leading-relaxed pt-2 border-t border-[#e5d5ca]">
                    When you arrange a date at any of our listed landmark cafes (like Blue Tokai, Subko, or Araku), simply show your active CupDate Member ID badge in the app at billing to receive 15% off your total order!
                </div>
            </div>

            <!-- Q5 -->
            <div class="bg-[#fbf8f5] border border-[#e5d5ca] rounded-2xl p-5 cursor-pointer" onclick="toggleFaq(this)">
                <div class="flex items-center justify-between">
                    <h3 class="font-['Plus_Jakarta_Sans'] font-bold text-sm text-[#24140d]">Is my location safe from stalkers?</h3>
                    <i class="fa-solid fa-chevron-down text-xs text-[#8b5a2b] transition-transform duration-200"></i>
                </div>
                <div class="faq-content hidden mt-3 text-xs text-[#7d6558] leading-relaxed pt-2 border-t border-[#e5d5ca]">
                    Yes. CupDate employs algorithmic ghost location fuzzing. Your geographic coordinates are intentionally shifted by 1.5–2km, preventing anyone from pinpointing your exact residence or office.
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Final High-Conversion CTA Banner -->
<section class="py-16 md:py-20 bg-gradient-to-r from-[#24140d] via-[#3d2314] to-[#24140d] text-white border-t-2 border-[#8b5a2b]">
    <div class="max-w-4xl mx-auto px-4 text-center space-y-6">
        <div class="w-14 h-14 rounded-2xl bg-[#8b5a2b] text-white flex items-center justify-center text-2xl mx-auto">
            <i class="fa-solid fa-mug-hot"></i>
        </div>
        <h2 class="font-['Plus_Jakarta_Sans'] font-extrabold text-3xl md:text-5xl tracking-tight leading-tight">
            Ready to meet your favorite coffee partner?
        </h2>
        <p class="text-base md:text-lg text-[#d6c4b8] max-w-xl mx-auto">
            Join verified singles in Pune, Mumbai, Bangalore, Delhi NCR, and Chandigarh discovering authentic chemistry over coffee.
        </p>
        <div class="pt-2">
            @guest
                <a href="{{ route('register') }}" class="px-9 py-4 bg-[#8b5a2b] text-white font-extrabold text-sm rounded-full hover:bg-[#6d421d] transition inline-flex items-center gap-2 group">
                    <span>Create Your Free Profile</span>
                    <i class="fa-solid fa-arrow-right text-xs group-hover:translate-x-1 transition"></i>
                </a>
            @else
                <a href="{{ route('swipes') }}" class="px-9 py-4 bg-[#8b5a2b] text-white font-extrabold text-sm rounded-full hover:bg-[#6d421d] transition inline-flex items-center gap-2">
                    <i class="fa-solid fa-fire text-xs text-[#d97706]"></i> Start Swiping Singles
                </a>
            @endguest
        </div>
    </div>
</section>
@endsection

@section('extra_js')
<script>
function selectCoffeeStyle(card, drink, title, mbti, desc) {
    document.querySelectorAll('#quizCards > div').forEach(el => {
        el.classList.remove('border-[#8b5a2b]', 'bg-[#f5ede6]/30');
    });
    card.classList.add('border-[#8b5a2b]', 'bg-[#f5ede6]/30');

    document.getElementById('quizDrinkName').innerText = drink;
    document.getElementById('quizVibeTitle').innerText = title;
    document.getElementById('quizCompatible').innerText = mbti;
    document.getElementById('quizDesc').innerText = desc;
}

function toggleFaq(item) {
    const content = item.querySelector('.faq-content');
    const icon = item.querySelector('i');
    content.classList.toggle('hidden');
    icon.classList.toggle('rotate-180');
}
</script>
@endsection
