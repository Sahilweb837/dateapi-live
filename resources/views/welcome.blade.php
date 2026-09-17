@extends('layouts.app')

@section('title', 'CupDate — Meet Verified Singles Over Coffee | Intentional Dating')
@section('meta_desc', 'Meet over good coffee, not endless swiping. CupDate matches intentional singles nearby who share your taste in brew, neighborhood spots, and genuine conversation.')

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

    <!-- Hero Section -->
    <section class="relative w-full overflow-hidden pb-space-xl pt-space-md sm:pt-space-lg">
        <!-- Ambient Warm Blurs with subtle aroma motion -->
        <div class="absolute -top-24 right-10 w-96 h-96 rounded-full bg-secondary-container/25 blur-3xl pointer-events-none -z-10 animate-aroma"></div>
        <div class="absolute top-1/2 -left-20 w-80 h-80 rounded-full bg-tertiary-fixed/30 blur-3xl pointer-events-none -z-10"></div>
        
        <div class="max-w-[1360px] mx-auto px-4 sm:px-6 lg:px-margin-desktop pt-space-lg flex flex-col lg:flex-row items-center justify-between gap-gutter-lg">
            
            <!-- Left Column: Editorial Masthead -->
            <div class="flex-1 flex flex-col items-start max-w-2xl">
                <div class="inline-flex items-center gap-space-xs px-space-md py-1 rounded-full bg-surface-container text-secondary font-label-md text-label-md mb-space-md shadow-sm">
                    <span class="material-symbols-outlined text-sm leading-none" style="font-variation-settings: 'FILL' 1;">local_cafe</span>
                    <span>A Slower, Tastier Way to Meet</span>
                </div>
                
                <h1 class="font-headline-xl text-3xl sm:text-4xl md:text-5xl lg:text-headline-xl text-on-surface tracking-tight leading-tight">
                    Meet over good coffee, <span class="italic font-normal text-secondary">not endless swiping.</span>
                </h1>
                
                <p class="mt-space-md font-body-lg text-body-lg text-on-surface-variant max-w-xl leading-relaxed">
                    CupDate matches you with intentional singles nearby who share your taste in brew, neighborhood spots, and genuine conversation.
                </p>

                <!-- CTAs -->
                <div class="mt-space-lg flex flex-wrap items-center gap-space-md">
                    @guest
                        <a href="{{ route('register') }}" class="inline-flex items-center justify-center gap-space-xs px-space-lg py-space-sm rounded-full bg-on-tertiary-container text-on-tertiary font-label-lg text-label-lg shadow-md hover:shadow-lg hover:-translate-y-0.5 hover:scale-[1.02] active:scale-[0.98] transition-all duration-200">
                            <span>Find Your Coffee Match</span>
                            <span class="material-symbols-outlined text-base">arrow_forward</span>
                        </a>
                        <a href="{{ route('dates') }}" class="inline-flex items-center justify-center gap-space-xs px-space-lg py-space-sm rounded-full bg-surface-container-high text-on-surface font-label-lg text-label-lg hover:bg-surface-container-highest hover:-translate-y-0.5 transition-all duration-200">
                            <span class="material-symbols-outlined text-base">storefront</span>
                            <span>Explore Partner Cafés</span>
                        </a>
                    @else
                        <a href="{{ route('swipes') }}" class="inline-flex items-center justify-center gap-space-xs px-space-lg py-space-sm rounded-full bg-on-tertiary-container text-on-tertiary font-label-lg text-label-lg shadow-md hover:shadow-lg hover:-translate-y-0.5 hover:scale-[1.02] active:scale-[0.98] transition-all duration-200">
                            <span class="material-symbols-outlined text-base">style</span>
                            <span>Enter Discover Deck</span>
                        </a>
                        <a href="{{ route('dates') }}" class="inline-flex items-center justify-center gap-space-xs px-space-lg py-space-sm rounded-full bg-surface-container-high text-on-surface font-label-lg text-label-lg hover:bg-surface-container-highest hover:-translate-y-0.5 transition-all duration-200">
                            <span class="material-symbols-outlined text-base">storefront</span>
                            <span>Explore Partner Cafés</span>
                        </a>
                    @endguest
                </div>

                <!-- Stat Pill Strip -->
                <div class="mt-space-lg sm:mt-space-xl grid grid-cols-3 gap-2 sm:gap-space-md w-full pt-space-md">
                    <div class="flex flex-col p-2 sm:p-space-md rounded-xl sm:rounded-lg bg-surface-container-low shadow-sm hover:shadow transition-shadow">
                        <span class="font-headline-sm text-base sm:text-headline-sm text-on-surface font-bold sm:font-semibold">42,000+</span>
                        <span class="font-label-sm text-[10px] sm:text-label-sm text-on-surface-variant mt-0.5">Dates Brewed</span>
                    </div>
                    <div class="flex flex-col p-2 sm:p-space-md rounded-xl sm:rounded-lg bg-surface-container-low shadow-sm hover:shadow transition-shadow">
                        <span class="font-headline-sm text-base sm:text-headline-sm text-on-surface font-bold sm:font-semibold">850+</span>
                        <span class="font-label-sm text-[10px] sm:text-label-sm text-on-surface-variant mt-0.5">Partner Cafés</span>
                    </div>
                    <div class="flex flex-col p-2 sm:p-space-md rounded-xl sm:rounded-lg bg-surface-container-low shadow-sm hover:shadow transition-shadow">
                        <span class="font-headline-sm text-base sm:text-headline-sm text-on-tertiary-container font-bold sm:font-semibold">74%</span>
                        <span class="font-label-sm text-[10px] sm:text-label-sm text-on-surface-variant mt-0.5">Second Date Rate</span>
                    </div>
                </div>
            </div>

            <!-- Right Column: Editorial Visual Composition -->
            <div class="flex-1 relative w-full flex justify-center lg:justify-end mt-space-lg lg:mt-0">
                <div class="relative w-full max-w-[480px]">
                    <!-- Main Hero Image Frame -->
                    <div class="relative w-full aspect-[4/5] rounded-xl overflow-hidden shadow-xl bg-surface-container group">
                        <img class="w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-105" loading="lazy" alt="Two intentional singles sharing warm artisanal ceramic cups in a sunlit boutique cafe" src="https://lh3.googleusercontent.com/aida-public/AB6AXuB2_00iTh7n55h8sH7jDv7RGReRT1bjTLNn_MmB0-pLC2HGF9gy12dAghWEs9PZNFA1JjNVDS7697U3J9st2Os1kALsZXm2Iu-7L0r0Z5V-qKJ3PBqv7OtlfpU-B2ZD-M3ibp39D4k2LNoN7zB51U5aDpElAVWBJjSWYvducpRaJFOqohik9saK-Mnzcvf7zVqbZumvK2cySmTtgO5kpQyUw75j1ckyptEP-D-ZS0f4PiMZUa6Urp6hwQ"/>
                        <div class="absolute inset-0 bg-gradient-to-t from-primary-container/80 via-transparent to-transparent"></div>
                        <div class="absolute bottom-6 left-6 right-6 flex items-center justify-between text-on-primary">
                            <div class="flex flex-col">
                                <span class="font-label-sm text-label-sm uppercase tracking-widest text-primary-fixed">Morning Ritual</span>
                                <span class="font-headline-sm text-headline-sm italic">"Espresso &amp; First Editions"</span>
                            </div>
                            <div class="w-10 h-10 rounded-full bg-surface/20 backdrop-blur-md flex items-center justify-center transition-transform hover:scale-110">
                                <span class="material-symbols-outlined text-on-primary text-xl">favorite</span>
                            </div>
                        </div>
                    </div>

                    <!-- Overlapping Floating Card with Micro-Animation -->
                    <div class="absolute -bottom-6 -left-6 max-w-[240px] p-space-md rounded-lg bg-surface-container-lowest/95 backdrop-blur-md shadow-lg items-center gap-space-sm hidden sm:flex animate-float ring-1 ring-black/5 cursor-default">
                        <div class="w-11 h-11 rounded-full bg-secondary-container flex items-center justify-center text-on-secondary-container shrink-0">
                            <span class="material-symbols-outlined text-xl">check_circle</span>
                        </div>
                        <div class="flex flex-col min-w-0">
                            <span class="font-label-md text-label-md text-on-surface truncate">Coffee Invite Accepted</span>
                            <span class="font-body-sm text-body-sm text-on-surface-variant">Today at Devoción • 3pm</span>
                        </div>
                    </div>

                    <!-- Micro Badge Floating Right with breathing glow -->
                    <div class="absolute -top-3 -right-3 px-space-md py-1.5 rounded-full bg-surface-container-high shadow-md flex items-center gap-1.5 border border-surface-container-highest/60">
                        <span class="w-2.5 h-2.5 rounded-full bg-emerald-600 pulse-glow-dot"></span>
                        <span class="font-label-sm text-label-sm text-on-surface font-medium">1,280 sips right now</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Interactive City Selector & Trending Hubs -->
    <section class="w-full py-space-xl bg-surface-container-low/50">
        <div class="max-w-[1360px] mx-auto px-4 sm:px-6 lg:px-margin-desktop flex flex-col gap-space-lg">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-space-md">
                <div class="flex flex-col gap-space-xs max-w-xl">
                    <span class="font-label-sm text-label-sm uppercase tracking-wider text-secondary">Local Chapters</span>
                    <h2 class="font-headline-lg text-headline-lg text-on-surface tracking-tight">Curated City Coffee Scenes</h2>
                    <p class="font-body-md text-body-md text-on-surface-variant">Discover vetted corners where intentional conversations happen effortlessly over exceptional roast profiles.</p>
                </div>
                
                <!-- City Navigation Tabs -->
                <div class="flex items-center gap-1.5 p-1 rounded-full bg-surface-container-high overflow-x-auto max-w-full" id="cityTabList">
                    <button class="city-tab px-space-md py-1.5 rounded-full font-label-md text-label-md bg-on-surface text-surface shadow-xs transition-all whitespace-nowrap active:scale-95" data-city="nyc">New York</button>
                    <button class="city-tab px-space-md py-1.5 rounded-full font-label-md text-label-md text-on-surface-variant hover:text-on-surface transition-all whitespace-nowrap active:scale-95" data-city="london">London</button>
                    <button class="city-tab px-space-md py-1.5 rounded-full font-label-md text-label-md text-on-surface-variant hover:text-on-surface transition-all whitespace-nowrap active:scale-95" data-city="paris">Paris</button>
                    <button class="city-tab px-space-md py-1.5 rounded-full font-label-md text-label-md text-on-surface-variant hover:text-on-surface transition-all whitespace-nowrap" data-city="tokyo">Tokyo</button>
                    <button class="city-tab px-space-md py-1.5 rounded-full font-label-md text-label-md text-on-surface-variant hover:text-on-surface transition-all whitespace-nowrap" data-city="melbourne">Melbourne</button>
                    <button class="city-tab px-space-md py-1.5 rounded-full font-label-md text-label-md text-on-surface-variant hover:text-on-surface transition-all whitespace-nowrap" data-city="milan">Milan</button>
                </div>
            </div>

            <!-- 3 Curated City Cards Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-gutter-lg mt-space-sm" id="cityCardsContainer">
                
                <!-- Card 1 (New York Scene) -->
                <article class="scroll-reveal city-card flex flex-col rounded-lg bg-surface-container-lowest overflow-hidden shadow-sm hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 group cursor-pointer" onclick="window.location.href='{{ route('city.show', 'new-york') }}'">
                    <div class="relative w-full aspect-[16/10] overflow-hidden bg-surface-container">
                        <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out" loading="lazy" alt="Intimate sun-drenched cafe in Greenwich Village" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDx-eV2uFVmFf9BmUODB82Pqfq3a3E353awr12jdNKlwDtWTU4RTILN53iyMroFw3cyoyVXeUdsG1WabdqwaziDxTpQhKCxwDtk_54Ujy7qtYD54eha8QMiszX1Is7S-7mrJ9HNZWPQabMNLbm2oHk-mX7374uxQdlGXdv-JaZlvO4IrIBXtdyvfdxRJlyN9hDzwytDlOz9xR-grqHFIOu0EdEkds1gMafQ9MimuuT0LvUXs43u9Kb_fw"/>
                        <div class="absolute top-3 left-3 px-space-sm py-1 rounded-full bg-surface-container-lowest/90 backdrop-blur-md font-label-sm text-label-sm text-on-surface shadow-xs">
                            West Village • SoHo
                        </div>
                        <div class="absolute bottom-3 right-3 px-space-sm py-0.5 rounded-full bg-primary-container/85 text-on-primary font-label-sm text-label-sm backdrop-blur-sm">
                            34 partner cafés
                        </div>
                    </div>
                    <div class="p-space-lg flex flex-col justify-between flex-1">
                        <div class="flex flex-col gap-space-xs">
                            <div class="flex items-center justify-between">
                                <h3 class="font-headline-sm text-headline-sm text-on-surface font-semibold group-hover:text-secondary transition-colors">The Downtown Brew Club</h3>
                                <span class="material-symbols-outlined text-secondary text-lg city-arrow-icon transition-transform duration-200">arrow_outward</span>
                            </div>
                            <p class="font-body-sm text-body-sm text-on-surface-variant line-clamp-2">
                                Cozy leather armchairs, single-origin natural Ethiopians, and effortless post-gallery walking loops through cobblestone alleys.
                            </p>
                        </div>
                        <div class="pt-space-md mt-space-md flex items-center justify-between border-t border-surface-container-low">
                            <div class="flex items-center gap-space-xs">
                                <span class="w-2 h-2 rounded-full bg-on-tertiary-container"></span>
                                <span class="font-label-md text-label-md text-on-surface font-medium">3,420 members</span>
                                <span class="font-body-sm text-body-sm text-on-surface-variant">active today</span>
                            </div>
                            <span class="font-label-sm text-label-sm text-secondary uppercase tracking-wider font-semibold group-hover:underline">View Hub</span>
                        </div>
                    </div>
                </article>

                <!-- Card 2 (London Scene) -->
                <article class="scroll-reveal delay-100 city-card flex flex-col rounded-lg bg-surface-container-lowest overflow-hidden shadow-sm hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 group cursor-pointer" onclick="window.location.href='{{ route('city.show', 'london') }}'">
                    <div class="relative w-full aspect-[16/10] overflow-hidden bg-surface-container">
                        <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out" loading="lazy" alt="Chic modern industrial roastery in Shoreditch London" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBI00sDnJgZUnyHWg3FWOe3p6hMv7pLdMkVE5fjs4NyPlldF_QEb5DdKzZ4qC9-VDU5O0XSWIQU4drx_n4JG8Gh2uzPYrwBzr56gybOAEY4cAIghEj79ihvbgFsSaWH_6A6tTq4usq_XlNjjhx3P7d7GqtCIRKRMF3M8DI3DIkE3PN0mafcBClLVOLQjbpqvVUviXNcSmdoTbYOe5ANxsK-Ujoq-DZkWfqMPa_aCSS28zZVwZ43mO7bXw"/>
                        <div class="absolute top-3 left-3 px-space-sm py-1 rounded-full bg-surface-container-lowest/90 backdrop-blur-md font-label-sm text-label-sm text-on-surface shadow-xs">
                            Shoreditch • Hackney
                        </div>
                        <div class="absolute bottom-3 right-3 px-space-sm py-0.5 rounded-full bg-primary-container/85 text-on-primary font-label-sm text-label-sm backdrop-blur-sm">
                            28 partner cafés
                        </div>
                    </div>
                    <div class="p-space-lg flex flex-col justify-between flex-1">
                        <div class="flex flex-col gap-space-xs">
                            <div class="flex items-center justify-between">
                                <h3 class="font-headline-sm text-headline-sm text-on-surface font-semibold group-hover:text-secondary transition-colors">East London Writers &amp; Roasters</h3>
                                <span class="material-symbols-outlined text-secondary text-lg city-arrow-icon transition-transform duration-200">arrow_outward</span>
                            </div>
                            <p class="font-body-sm text-body-sm text-on-surface-variant line-clamp-2">
                                Aeropress rituals, cinnamon brioche buns, and creative dialogs designed for architects, designers, and late-morning thinkers.
                            </p>
                        </div>
                        <div class="pt-space-md mt-space-md flex items-center justify-between border-t border-surface-container-low">
                            <div class="flex items-center gap-space-xs">
                                <span class="w-2 h-2 rounded-full bg-on-tertiary-container"></span>
                                <span class="font-label-md text-label-md text-on-surface font-medium">2,890 members</span>
                                <span class="font-body-sm text-body-sm text-on-surface-variant">active today</span>
                            </div>
                            <span class="font-label-sm text-label-sm text-secondary uppercase tracking-wider font-semibold group-hover:underline">View Hub</span>
                        </div>
                    </div>
                </article>

                <!-- Card 3 (Paris Scene) -->
                <article class="scroll-reveal delay-200 city-card flex flex-col rounded-lg bg-surface-container-lowest overflow-hidden shadow-sm hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 group cursor-pointer" onclick="window.location.href='{{ route('city.show', 'paris') }}'">
                    <div class="relative w-full aspect-[16/10] overflow-hidden bg-surface-container">
                        <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out" loading="lazy" alt="Classic Parisian cafe terrace in Le Marais" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCsQFJJkHjGfBufuaZ6nur3gJ5jEifKzWbT4eYm9qHnrXqscr3KBWfy5AI8m1KGvK7o8RnqcwaxMXdSoWmlFc7KeXQsDae3GC-KpjVqYzkfhwqTjNcQQfuma5OJdzVzrIJyq4MkOVELnyp5hblwI3oXK8p7ufcYzX2X7dtmyXPVgQFfZZjK2nGF_W7AchMRgf5ZF9wTRCVCR40nU-cWyyz9gUmGgAbLC-C16VyUgc8SA2dSf6cQ8RjAZg"/>
                        <div class="absolute top-3 left-3 px-space-sm py-1 rounded-full bg-surface-container-lowest/90 backdrop-blur-md font-label-sm text-label-sm text-on-surface shadow-xs">
                            Le Marais • Saint-Germain
                        </div>
                        <div class="absolute bottom-3 right-3 px-space-sm py-0.5 rounded-full bg-primary-container/85 text-on-primary font-label-sm text-label-sm backdrop-blur-sm">
                            41 partner cafés
                        </div>
                    </div>
                    <div class="p-space-lg flex flex-col justify-between flex-1">
                        <div class="flex flex-col gap-space-xs">
                            <div class="flex items-center justify-between">
                                <h3 class="font-headline-sm text-headline-sm text-on-surface font-semibold group-hover:text-secondary transition-colors">The Rive Droite Chapter</h3>
                                <span class="material-symbols-outlined text-secondary text-lg city-arrow-icon transition-transform duration-200">arrow_outward</span>
                            </div>
                            <p class="font-body-sm text-body-sm text-on-surface-variant line-clamp-2">
                                Slow filter roasts on zinc bistro tops, quiet courtyard retreats, and effortless transitions from warm macchiatos to natural wine.
                            </p>
                        </div>
                        <div class="pt-space-md mt-space-md flex items-center justify-between border-t border-surface-container-low">
                            <div class="flex items-center gap-space-xs">
                                <span class="w-2 h-2 rounded-full bg-on-tertiary-container"></span>
                                <span class="font-label-md text-label-md text-on-surface font-medium">1,960 members</span>
                                <span class="font-body-sm text-body-sm text-on-surface-variant">active today</span>
                            </div>
                            <span class="font-label-sm text-label-sm text-secondary uppercase tracking-wider font-semibold group-hover:underline">View Hub</span>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <!-- How CupDate Works 3-step Editorial Section -->
    <section class="w-full py-space-xl" id="how-it-works">
        <div class="max-w-[1360px] mx-auto px-4 sm:px-6 lg:px-margin-desktop flex flex-col gap-space-xl">
            <div class="flex flex-col items-center text-center max-w-2xl mx-auto gap-space-xs scroll-reveal">
                <span class="font-label-sm text-label-sm uppercase tracking-widest text-secondary font-semibold">The Method</span>
                <h2 class="font-headline-lg text-headline-lg text-on-surface tracking-tight">How CupDate Works</h2>
                <p class="font-body-md text-body-md text-on-surface-variant">
                    We removed the game and kept the spark. From your signature roast to your first real-life table in three mindful movements.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-gutter-lg">
                <!-- Step 01 -->
                <div class="scroll-reveal flex flex-col p-space-lg rounded-lg bg-surface-container-low relative shadow-xs hover:shadow-md transition-all">
                    <div class="flex items-center justify-between mb-space-md">
                        <span class="font-headline-lg text-headline-lg text-secondary font-light">01</span>
                        <div class="w-10 h-10 rounded-full bg-surface flex items-center justify-center text-secondary shadow-sm">
                            <span class="material-symbols-outlined text-xl">coffee_maker</span>
                        </div>
                    </div>
                    <h3 class="font-headline-sm text-headline-sm text-on-surface font-semibold mb-space-xs">Share Your Brew &amp; Vibe</h3>
                    <p class="font-body-md text-body-md text-on-surface-variant mb-space-md leading-relaxed">
                        Pick your exact daily order: oat flat white, balanced cortado, or anaerobic natural pour-over. Define your preferred hours and neighborhood rhythm.
                    </p>
                    <!-- Interactive Micro Brew Picker -->
                    <div class="mt-auto pt-space-md flex flex-wrap gap-1.5" id="brew-pill-container">
                        <button class="brew-tag px-space-sm py-1 rounded-full bg-surface-container text-on-surface font-label-sm text-label-sm font-medium hover:bg-surface-container-high transition-all active:scale-95" type="button">Flat White</button>
                        <button class="brew-tag px-space-sm py-1 rounded-full bg-on-tertiary-container text-on-tertiary font-label-sm text-label-sm font-medium shadow-xs transition-all active:scale-95" data-active="true" type="button">Cortado • Selected</button>
                        <button class="brew-tag px-space-sm py-1 rounded-full bg-surface-container text-on-surface font-label-sm text-label-sm font-medium hover:bg-surface-container-high transition-all active:scale-95" type="button">Cold Brew</button>
                        <button class="brew-tag px-space-sm py-1 rounded-full bg-surface-container text-on-surface font-label-sm text-label-sm font-medium hover:bg-surface-container-high transition-all active:scale-95" type="button">V60 Pour-over</button>
                    </div>
                </div>

                <!-- Step 02 -->
                <div class="scroll-reveal delay-100 flex flex-col p-space-lg rounded-lg bg-surface-container-low relative shadow-xs hover:shadow-md transition-all">
                    <div class="flex items-center justify-between mb-space-md">
                        <span class="font-headline-lg text-headline-lg text-secondary font-light">02</span>
                        <div class="w-10 h-10 rounded-full bg-surface flex items-center justify-center text-secondary shadow-sm">
                            <span class="material-symbols-outlined text-xl">partner_exchange</span>
                        </div>
                    </div>
                    <h3 class="font-headline-sm text-headline-sm text-on-surface font-semibold mb-space-xs">Match Over Local Spots</h3>
                    <p class="font-body-md text-body-md text-on-surface-variant mb-space-md leading-relaxed">
                        Get paired with thoughtful singles who share your taste in neighborhood haunts, quiet conversation corners, and genuine aesthetic energy.
                    </p>
                    <div class="mt-auto pt-space-md flex items-center gap-space-xs p-space-xs rounded-full bg-surface-container-highest/60 text-on-surface-variant">
                        <span class="material-symbols-outlined text-base text-secondary ml-1">favorite</span>
                        <span class="font-label-md text-label-md text-on-surface truncate">Mutual spot: Sey Coffee, Brooklyn</span>
                    </div>
                </div>

                <!-- Step 03 -->
                <div class="scroll-reveal delay-200 flex flex-col p-space-lg rounded-lg bg-surface-container-low relative shadow-xs hover:shadow-md transition-all">
                    <div class="flex items-center justify-between mb-space-md">
                        <span class="font-headline-lg text-headline-lg text-secondary font-light">03</span>
                        <div class="w-10 h-10 rounded-full bg-surface flex items-center justify-center text-secondary shadow-sm">
                            <span class="material-symbols-outlined text-xl">event_available</span>
                        </div>
                    </div>
                    <h3 class="font-headline-sm text-headline-sm text-on-surface font-semibold mb-space-xs">Send a Coffee Invite</h3>
                    <p class="font-body-md text-body-md text-on-surface-variant mb-space-md leading-relaxed">
                        No weeks of texting paralysis. One-tap seamless date scheduling at verified partner cafés with reserved acoustic tables and exclusive perks.
                    </p>
                    <div class="mt-auto pt-space-md flex items-center justify-between p-space-xs pl-space-md rounded-full bg-surface shadow-xs">
                        <span class="font-label-sm text-label-sm text-on-surface font-medium">Saturday • 11:30 AM</span>
                        <span class="px-space-md py-1 rounded-full bg-on-tertiary-container text-on-tertiary font-label-sm text-label-sm font-semibold">Confirmed</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Member Testimonial Quote -->
    <section class="w-full py-space-lg">
        <div class="max-w-[1360px] mx-auto px-4 sm:px-6 lg:px-margin-desktop">
            <div class="scroll-reveal relative w-full rounded-xl bg-surface-container-high p-space-xl overflow-hidden shadow-sm hover:shadow-md transition-shadow">
                <div class="absolute -right-12 -bottom-12 w-64 h-64 rounded-full bg-secondary-fixed/40 blur-2xl pointer-events-none animate-aroma"></div>
                <div class="relative z-10 flex flex-col md:flex-row items-center gap-space-xl">
                    <!-- Portrait Frame -->
                    <div class="w-28 h-28 sm:w-36 sm:h-36 rounded-full overflow-hidden shrink-0 shadow-md ring-4 ring-surface transition-transform duration-500 hover:scale-105">
                        <img class="w-full h-full object-cover" loading="lazy" alt="Camille & Julian laughing warmly over coffee" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCHSu_C5FG4kvqmZapM6qPJ3FRBc0luPq-m6PL94gngmnxKwHunMcQ4WiaKMc3QaorUOpsgadxP02C1Z0ZbIvsgTeH8Jk6euvFTY97cTREgMJqMOnWK5RDrCg8yEOyV5ipEYjvkIY7f4BkXAnfpLuVjfHVDxwNT1IvQS09OaYacxio4NocTPFrziv992M-GIKvf76t11xqdjDotYql3IwJ4VN9om36wbeWGFnptjp9zHRWTiPAARZPnw"/>
                    </div>
                    <!-- Quote Block -->
                    <div class="flex flex-col gap-space-sm flex-1 text-center md:text-left">
                        <div class="flex items-center justify-center md:justify-start gap-1 text-on-tertiary-container">
                            <span class="material-symbols-outlined text-base" style="font-variation-settings: 'FILL' 1;">star</span>
                            <span class="material-symbols-outlined text-base" style="font-variation-settings: 'FILL' 1;">star</span>
                            <span class="material-symbols-outlined text-base" style="font-variation-settings: 'FILL' 1;">star</span>
                            <span class="material-symbols-outlined text-base" style="font-variation-settings: 'FILL' 1;">star</span>
                            <span class="material-symbols-outlined text-base" style="font-variation-settings: 'FILL' 1;">star</span>
                        </div>
                        <blockquote class="font-headline-md text-headline-md text-on-surface italic leading-snug">
                            "We both matched because of our mutual obsession with the single-origin Geisha at Abraço. We met on a rainy Tuesday morning for thirty minutes—and ended up staying until closing time."
                        </blockquote>
                        <div class="flex flex-col md:flex-row md:items-center gap-1 md:gap-space-sm text-on-surface-variant font-body-sm text-body-sm pt-space-xs">
                            <span class="font-semibold text-on-surface font-label-md text-label-md">Camille &amp; Julian</span>
                            <span class="hidden md:inline text-secondary">•</span>
                            <span>Matched over Cortados in East Village</span>
                            <span class="hidden md:inline text-secondary">•</span>
                            <span class="text-secondary font-medium">Together 14 months</span>
                        </div>
                    </div>
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
      "@context": "https://schema.org",
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
</script>
@endsection
