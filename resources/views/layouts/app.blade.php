<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'CupDate — Meet Verified Singles Over Coffee | Curated Coffee Dating')</title>
    <meta name="description" content="@yield('meta_desc', 'CupDate matches you with intentional singles nearby who share your taste in brew, neighborhood spots, and genuine conversation.')">

    <!-- Material Symbols & Typography -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,500;0,600;1,400;1,500;1,600&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" rel="stylesheet"/>
    
    <!-- FontAwesome 6 (Compatibility) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Tailwind Play CDN for Precision Layout System -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
    tailwind.config = {
      darkMode: "class",
      theme: {
        extend: {
          "colors": {
            "tertiary": "#000000",
            "primary-container": "#271811",
            "on-tertiary-container": "#d65b6c",
            "error": "#ba1a1a",
            "tertiary-container": "#40000f",
            "surface-tint": "#6f5a51",
            "on-primary": "#ffffff",
            "error-container": "#ffdad6",
            "secondary-container": "#febe9e",
            "on-background": "#231a15",
            "on-error-container": "#93000a",
            "primary-fixed-dim": "#dcc1b5",
            "secondary": "#835339",
            "surface-container-highest": "#f1dfd8",
            "primary-fixed": "#f9ddd1",
            "on-tertiary-fixed": "#40000f",
            "primary": "#000000",
            "inverse-on-surface": "#ffede6",
            "surface-container-high": "#f7e4dd",
            "surface-container": "#fdeae3",
            "on-primary-fixed-variant": "#55433a",
            "surface-variant": "#f1dfd8",
            "on-tertiary-fixed-variant": "#861e33",
            "on-secondary-fixed": "#331201",
            "on-secondary": "#ffffff",
            "secondary-fixed": "#ffdbcb",
            "surface-dim": "#e8d6cf",
            "on-primary-fixed": "#271811",
            "on-error": "#ffffff",
            "on-secondary-container": "#794b32",
            "surface-container-lowest": "#ffffff",
            "secondary-fixed-dim": "#f7b999",
            "tertiary-fixed-dim": "#ffb2b8",
            "outline": "#81756f",
            "surface-container-low": "#fff1eb",
            "on-secondary-fixed-variant": "#673c24",
            "outline-variant": "#d2c3bd",
            "on-surface-variant": "#4f4540",
            "on-primary-container": "#967f75",
            "tertiary-fixed": "#ffdadb",
            "inverse-surface": "#392e2a",
            "background": "#fff8f6",
            "surface-bright": "#fff8f6",
            "surface": "#fff8f6",
            "inverse-primary": "#dcc1b5",
            "on-surface": "#231a15",
            "on-tertiary": "#ffffff"
          },
          "borderRadius": {
            "DEFAULT": "1rem",
            "lg": "2rem",
            "xl": "3rem",
            "full": "9999px"
          },
          "spacing": {
            "space-sm": "0.5rem",
            "space-md": "1rem",
            "gutter-lg": "2rem",
            "margin": "2.5rem",
            "gutter": "1.5rem",
            "space-xs": "0.25rem",
            "margin-desktop": "4rem",
            "space-lg": "1.5rem",
            "space-xl": "2.5rem"
          },
          "fontFamily": {
            "body-md": [ "Plus Jakarta Sans", "Inter", "sans-serif" ],
            "headline-md": [ "Playfair Display", "serif" ],
            "label-lg": [ "Plus Jakarta Sans", "Inter", "sans-serif" ],
            "label-md": [ "Plus Jakarta Sans", "Inter", "sans-serif" ],
            "body-sm": [ "Plus Jakarta Sans", "Inter", "sans-serif" ],
            "body-lg": [ "Plus Jakarta Sans", "Inter", "sans-serif" ],
            "label-sm": [ "Plus Jakarta Sans", "Inter", "sans-serif" ],
            "headline-lg": [ "Playfair Display", "serif" ],
            "headline-xl": [ "Playfair Display", "serif" ],
            "headline-lg-mobile": [ "Playfair Display", "serif" ],
            "headline-sm": [ "Playfair Display", "serif" ]
          },
          "fontSize": {
            "body-md": [ "15px", { "lineHeight": "24px", "fontWeight": "400" } ],
            "headline-md": [ "28px", { "lineHeight": "36px", "fontWeight": "500" } ],
            "label-lg": [ "14px", { "lineHeight": "20px", "letterSpacing": "0.01em", "fontWeight": "600" } ],
            "label-md": [ "12px", { "lineHeight": "16px", "letterSpacing": "0.02em", "fontWeight": "600" } ],
            "body-sm": [ "13px", { "lineHeight": "20px", "fontWeight": "400" } ],
            "body-lg": [ "18px", { "lineHeight": "28px", "fontWeight": "400" } ],
            "label-sm": [ "11px", { "lineHeight": "14px", "letterSpacing": "0.04em", "fontWeight": "700" } ],
            "headline-lg": [ "40px", { "lineHeight": "48px", "letterSpacing": "-0.015em", "fontWeight": "600" } ],
            "headline-xl": [ "52px", { "lineHeight": "64px", "letterSpacing": "-0.02em", "fontWeight": "600" } ],
            "headline-lg-mobile": [ "32px", { "lineHeight": "40px", "fontWeight": "600" } ],
            "headline-sm": [ "22px", { "lineHeight": "30px", "fontWeight": "500" } ]
          }
        }
      }
    };
    </script>

    <!-- Vite Styles & Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
      @layer base {
        html, body { margin: 0; padding: 0; }
        body { overscroll-behavior: none; }
      }
      ::-webkit-scrollbar { display: none; }

      /* Smooth Scroll-Driven Reveal Styles */
      .scroll-reveal {
        opacity: 0;
        transform: translateY(28px);
        transition: opacity 0.8s cubic-bezier(0.16, 1, 0.3, 1), transform 0.8s cubic-bezier(0.16, 1, 0.3, 1);
        will-change: opacity, transform;
      }
      .scroll-reveal.active {
        opacity: 1;
        transform: translateY(0);
      }
      .delay-100 { transition-delay: 100ms; }
      .delay-200 { transition-delay: 200ms; }
      .delay-300 { transition-delay: 300ms; }

      /* Hero Floating Animation */
      @keyframes floatSlow {
        0%, 100% {
          transform: translateY(0px) rotate(0deg);
        }
        50% {
          transform: translateY(-8px) rotate(0.4deg);
        }
      }
      .animate-float {
        animation: floatSlow 4s ease-in-out infinite;
      }

      /* Ambient Coffee Steam / Aroma Ring Keyframes */
      @keyframes aromaPulse {
        0% {
          transform: scale(0.92) translate(0, 0);
          opacity: 0.25;
        }
        50% {
          transform: scale(1.08) translate(8px, -12px);
          opacity: 0.45;
        }
        100% {
          transform: scale(0.92) translate(0, 0);
          opacity: 0.25;
        }
      }
      .animate-aroma {
        animation: aromaPulse 9s ease-in-out infinite;
      }

      /* Live Pulse Breathing Badge */
      @keyframes liveGlow {
        0%, 100% {
          box-shadow: 0 0 0 0 rgba(5, 150, 105, 0.4);
        }
        50% {
          box-shadow: 0 0 0 7px rgba(5, 150, 105, 0);
        }
      }
      .pulse-glow-dot {
        animation: liveGlow 2.5s infinite;
      }

      /* Card Arrow Micro-interaction */
      .city-card:hover .city-arrow-icon {
        transform: translate(3px, -3px);
      }

      /* Accessibility: Prefers-reduced-motion */
      @media (prefers-reduced-motion: reduce) {
        .scroll-reveal {
          opacity: 1 !important;
          transform: none !important;
          transition: none !important;
        }
        .animate-float,
        .animate-aroma,
        .pulse-glow-dot {
          animation: none !important;
        }
        * {
          transition-duration: 0.001s !important;
        }
      }
      /* Smooth Scroll & Custom Neon Pink Scrollbar */
      html {
        scroll-behavior: smooth;
      }
      ::-webkit-scrollbar {
        width: 7px;
        height: 7px;
      }
      ::-webkit-scrollbar-track {
        background: #fbf8f5;
      }
      ::-webkit-scrollbar-thumb {
        background: #d2c3bd;
        border-radius: 99px;
      }
      ::-webkit-scrollbar-thumb:hover {
        background: #ff007f;
      }
      .neon-pink-text {
        background: linear-gradient(135deg, #ff4081 0%, #ff007f 50%, #e91e63 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
      }
      .neon-pink-glow {
        filter: drop-shadow(0 0 8px rgba(255, 0, 127, 0.45));
      }
    </style>
    @yield('extra_css')
</head>
<body class="bg-surface font-body-md text-body-md text-on-surface antialiased min-h-screen flex flex-col pb-16 md:pb-0">

    <!-- Global Top Fixed Editorial Header -->
    <header class="fixed top-0 left-0 right-0 z-50 bg-surface/85 backdrop-blur-xl shadow-[0_1px_8px_rgba(0,0,0,0.04)] border-b border-outline-variant/30 transition-all">
        <div class="h-20 max-w-[1360px] mx-auto px-4 sm:px-6 lg:px-margin-desktop flex items-center justify-between gap-space-md sm:gap-space-lg">
            
            <!-- Brand Logo & Atelier Moniker -->
            <div class="flex items-center gap-space-md">
                <a href="{{ route('home') }}" class="flex items-center gap-2.5 group text-decoration-none">
                    <div class="w-9 h-9 rounded-full overflow-hidden shadow-[0_0_14px_rgba(255,0,127,0.4)] border border-[#ff007f]/50 p-0.5 bg-[#180e0c] group-hover:scale-110 transition-transform shrink-0">
                        <img alt="CupDate Logo" class="w-full h-full object-contain" src="{{ asset('assets/images/cupdate_logo.svg') }}"/>
                    </div>
                    <span class="font-headline-sm text-headline-sm text-on-surface tracking-tight font-black">Cup<span class="neon-pink-text">Date</span></span>
                </a>
                <span class="hidden xl:inline-block text-[#ff007f] font-semibold text-xs tracking-wide px-2 py-0.5 rounded-full bg-[#ff007f]/10 border border-[#ff007f]/30">HP &amp; India Dating</span>
            </div>

            <!-- Desktop Nav Navigation Links -->
            <nav class="hidden lg:flex items-center gap-space-sm p-space-xs bg-surface-container-low/60 rounded-full border border-outline-variant/30">
                <a href="{{ route('cities.index') }}" class="px-space-md py-space-xs rounded-full font-label-md text-label-md transition-all {{ request()->routeIs('cities*') || request()->routeIs('city*') ? 'bg-surface-container text-on-surface font-semibold shadow-xs' : 'text-on-surface-variant hover:text-on-surface' }}">Explore &amp; Cities</a>
                
                <a href="{{ route('swipes') }}" class="px-space-md py-space-xs rounded-full font-label-md text-label-md transition-all {{ request()->routeIs('swipes*') ? 'bg-surface-container text-on-surface font-semibold shadow-xs' : 'text-on-surface-variant hover:text-on-surface' }}">Discover Deck</a>
                
                <a href="{{ route('dates') }}" class="px-space-md py-space-xs rounded-full font-label-md text-label-md transition-all {{ request()->routeIs('dates*') ? 'bg-surface-container text-on-surface font-semibold shadow-xs' : 'text-on-surface-variant hover:text-on-surface' }}">Nearby Cafés</a>
                
                <div class="relative flex items-center">
                    <a href="{{ route('messages') }}" class="px-space-md py-space-xs rounded-full font-label-md text-label-md transition-all {{ request()->routeIs('messages*') ? 'bg-surface-container text-on-surface font-semibold shadow-xs' : 'text-on-surface-variant hover:text-on-surface' }} pr-space-lg">Messages &amp; Dates</a>
                    @auth
                        <span class="absolute right-space-xs px-1.5 py-0.5 rounded-full bg-on-tertiary-container text-on-tertiary font-label-sm text-label-sm leading-none">3</span>
                    @endauth
                </div>

                @auth
                    <a href="{{ route('feed') }}" class="px-space-md py-space-xs rounded-full font-label-md text-label-md transition-all {{ request()->routeIs('feed*') ? 'bg-surface-container text-on-surface font-semibold shadow-xs' : 'text-on-surface-variant hover:text-on-surface' }}">Feed</a>
                @else
                    <a href="{{ route('blog.index') }}" class="px-space-md py-space-xs rounded-full font-label-md text-label-md transition-all {{ request()->routeIs('blog*') ? 'bg-surface-container text-on-surface font-semibold shadow-xs' : 'text-on-surface-variant hover:text-on-surface' }}">Dating Guides</a>
                @endauth
            </nav>

            <!-- Right Controls & User Profile Dropdown -->
            <div class="flex items-center gap-2 sm:gap-space-md">
                
                <!-- Live GPS & City Location Selector -->
                <div class="relative flex items-center" id="globalLocationContainer">
                    <button type="button" onclick="toggleGlobalLocationDropdown()" class="flex items-center gap-1.5 px-2.5 sm:px-3.5 py-1.5 rounded-full bg-surface-container-high/90 hover:bg-surface-container border border-outline-variant/40 text-on-surface transition-all cursor-pointer shadow-xs active:scale-95" title="Change or detect your dating city">
                        <span class="w-2 h-2 rounded-full bg-emerald-600 animate-pulse shrink-0" id="headerGpsDot"></span>
                        <span class="material-symbols-outlined text-secondary text-base leading-none">location_on</span>
                        <span id="globalHeaderCityName" class="font-label-md text-label-md text-on-surface font-semibold max-w-[100px] sm:max-w-[150px] truncate">
                            @if(isset($cityData['name']))
                                {{ $cityData['name'] }}
                            @elseif(Auth::check() && (Auth::user()->country || Auth::user()->city))
                                {{ Auth::user()->country ?? Auth::user()->city }}
                            @else
                                Kangra, HP
                            @endif
                        </span>
                        <span class="material-symbols-outlined text-xs text-on-surface-variant leading-none transition-transform" id="headerCityArrow">expand_more</span>
                    </button>

                    <!-- Location Dropdown Panel -->
                    <div id="globalLocationDropdown" class="hidden absolute right-0 top-11 w-72 bg-surface-container-lowest rounded-2xl shadow-2xl border border-outline-variant/40 py-3 px-3 z-50 animate-in fade-in zoom-in duration-150">
                        <div class="flex items-center justify-between pb-2 mb-2 border-b border-outline-variant/20">
                            <span class="font-label-sm text-label-sm uppercase tracking-wider text-secondary font-bold">Your Dating Location</span>
                            <span class="text-[10px] text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-full font-bold border border-emerald-200 flex items-center gap-1">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-600 animate-pulse"></span> Live GPS
                            </span>
                        </div>

                        <!-- Auto Detect Button -->
                        <button type="button" onclick="autoDetectHeaderLocation()" id="detectHeaderGpsBtn" class="w-full py-2 px-3 rounded-xl bg-on-tertiary-container text-on-tertiary text-xs font-bold flex items-center justify-center gap-2 shadow-xs hover:opacity-95 transition-all mb-2.5 cursor-pointer active:scale-98">
                            <span class="material-symbols-outlined text-sm">my_location</span>
                            <span id="detectHeaderGpsBtnText">Auto-Detect GPS Location</span>
                        </button>

                        <!-- Himachal Pradesh Cities Section -->
                        <p class="text-[10px] uppercase font-bold text-secondary tracking-wider mb-1 px-1">Himachal Pradesh Hubs</p>
                        <div class="grid grid-cols-2 gap-1 mb-2.5">
                            <a href="{{ route('city.show', 'kangra') }}" onclick="selectHeaderCity('Kangra, HP')" class="text-left px-2 py-1 rounded-lg text-xs font-medium text-on-surface hover:bg-surface-container transition-colors truncate">📍 Kangra</a>
                            <a href="{{ route('city.show', 'solan') }}" onclick="selectHeaderCity('Solan, HP')" class="text-left px-2 py-1 rounded-lg text-xs font-medium text-on-surface hover:bg-surface-container transition-colors truncate">📍 Solan</a>
                            <a href="{{ route('city.show', 'shimla') }}" onclick="selectHeaderCity('Shimla, HP')" class="text-left px-2 py-1 rounded-lg text-xs font-medium text-on-surface hover:bg-surface-container transition-colors truncate">📍 Shimla</a>
                            <a href="{{ route('city.show', 'dharamshala') }}" onclick="selectHeaderCity('Dharamshala, HP')" class="text-left px-2 py-1 rounded-lg text-xs font-medium text-on-surface hover:bg-surface-container transition-colors truncate">📍 Dharamshala</a>
                            <a href="{{ route('city.show', 'manali') }}" onclick="selectHeaderCity('Manali, HP')" class="text-left px-2 py-1 rounded-lg text-xs font-medium text-on-surface hover:bg-surface-container transition-colors truncate">📍 Manali</a>
                            <a href="{{ route('city.show', 'palampur') }}" onclick="selectHeaderCity('Palampur, HP')" class="text-left px-2 py-1 rounded-lg text-xs font-medium text-on-surface hover:bg-surface-container transition-colors truncate">📍 Palampur</a>
                        </div>

                        <!-- Top Indian Metros Section -->
                        <p class="text-[10px] uppercase font-bold text-secondary tracking-wider mb-1 px-1">Top Coffee Metros</p>
                        <div class="grid grid-cols-2 gap-1">
                            <a href="{{ route('city.show', 'chandigarh') }}" onclick="selectHeaderCity('Chandigarh')" class="text-left px-2 py-1 rounded-lg text-xs font-medium text-on-surface hover:bg-surface-container transition-colors truncate">☕ Chandigarh</a>
                            <a href="{{ route('city.show', 'delhi-ncr') }}" onclick="selectHeaderCity('Delhi NCR')" class="text-left px-2 py-1 rounded-lg text-xs font-medium text-on-surface hover:bg-surface-container transition-colors truncate">☕ Delhi NCR</a>
                            <a href="{{ route('city.show', 'pune') }}" onclick="selectHeaderCity('Pune')" class="text-left px-2 py-1 rounded-lg text-xs font-medium text-on-surface hover:bg-surface-container transition-colors truncate">☕ Pune</a>
                            <a href="{{ route('city.show', 'mumbai') }}" onclick="selectHeaderCity('Mumbai')" class="text-left px-2 py-1 rounded-lg text-xs font-medium text-on-surface hover:bg-surface-container transition-colors truncate">☕ Mumbai</a>
                            <a href="{{ route('city.show', 'bangalore') }}" onclick="selectHeaderCity('Bangalore')" class="text-left px-2 py-1 rounded-lg text-xs font-medium text-on-surface hover:bg-surface-container transition-colors truncate">☕ Bangalore</a>
                            <a href="{{ route('city.show', 'goa') }}" onclick="selectHeaderCity('Goa')" class="text-left px-2 py-1 rounded-lg text-xs font-medium text-on-surface hover:bg-surface-container transition-colors truncate">☕ Goa</a>
                        </div>
                    </div>
                </div>

                <!-- Brew a Date CTA -->
                <a href="{{ Auth::check() ? route('feed') : route('register') }}" class="hidden md:inline-flex items-center gap-space-xs px-space-md py-space-xs rounded-full bg-on-tertiary-container text-on-tertiary font-label-md text-label-md shadow-[0_2px_10px_rgba(214,91,108,0.25)] hover:shadow-lg hover:scale-[1.02] active:scale-[0.98] hover:opacity-95 transition-all">
                    <span class="material-symbols-outlined text-base leading-none">add</span>
                    <span>Brew a Date</span>
                </a>

                @auth
                    <!-- Daily Streak Coins Pill -->
                    <button onclick="openStreakModal()" class="hidden sm:flex items-center gap-1.5 px-3 py-1 rounded-full bg-surface-container-low border border-outline-variant/60 text-secondary hover:bg-surface-container font-label-md text-label-md transition-all cursor-pointer" title="Coffee Bean Streak &amp; Coins">
                        <span class="material-symbols-outlined text-base text-amber-600 leading-none">monetization_on</span>
                        <span id="headerCoinsCount">{{ Auth::user()->coins ?? 50 }}</span>
                        <span class="text-[10px] bg-secondary text-white px-1.5 py-0.2 rounded-full font-bold">Coins</span>
                    </button>

                    <!-- User Profile Avatar + Dropdown -->
                    <div class="relative flex items-center" id="globalProfileMenuContainer">
                        <button type="button" onclick="toggleGlobalProfileMenu()" class="relative cursor-pointer flex items-center gap-2 pl-1 pr-3 py-1 rounded-full bg-surface-container-low hover:bg-surface-container border border-outline-variant/40 transition-all focus:outline-none" aria-label="Open Profile Menu">
                            <div class="relative shrink-0">
                                <img alt="{{ Auth::user()->full_name }}" class="w-8 h-8 rounded-full object-cover ring-2 ring-outline-variant/60" src="{{ Auth::user()->avatar_url }}"/>
                                <span class="absolute bottom-0 right-0 w-2.5 h-2.5 rounded-full bg-emerald-500 ring-2 ring-surface border border-white"></span>
                            </div>
                            <span class="hidden sm:block font-label-md text-label-md text-on-surface font-semibold max-w-[90px] truncate">{{ Str::words(Auth::user()->full_name, 1, '') }}</span>
                            <span class="material-symbols-outlined text-sm text-on-surface-variant">expand_more</span>
                        </button>

                        <!-- Profile Dropdown Popup -->
                        <div id="globalProfileDropdown" class="hidden absolute right-0 top-12 w-64 bg-white rounded-2xl shadow-2xl border border-outline-variant/30 overflow-hidden z-50">
                            <!-- User Identity Card -->
                            <div class="p-4 bg-gradient-to-br from-surface-container-low to-surface-container">
                                <div class="flex items-center gap-3">
                                    <div class="relative shrink-0">
                                        <img alt="{{ Auth::user()->full_name }}" class="w-12 h-12 rounded-full object-cover ring-2 ring-white shadow-md" src="{{ Auth::user()->avatar_url }}"/>
                                        @if(!empty(Auth::user()->google_id))
                                        <span class="absolute -bottom-0.5 -right-0.5 w-5 h-5 rounded-full bg-white flex items-center justify-center shadow" title="Signed in with Google">
                                            <svg viewBox="0 0 24 24" class="w-3.5 h-3.5"><path d="M12 5c1.6 0 3 .6 4.1 1.6l3.1-3.1C17.3 1.7 14.8 1 12 1 7.4 1 3.5 3.6 1.6 7.3l3.7 2.9C6.2 7.3 8.9 5 12 5z" fill="#EA4335"/><path d="M23.5 12.3c0-.8-.1-1.6-.2-2.3H12v4.5h6.5c-.3 1.5-1.1 2.8-2.4 3.7l3.7 2.9c2.2-2 3.7-5 3.7-8.8z" fill="#4285F4"/><path d="M5.3 14.8c-.2-.7-.4-1.5-.4-2.3 0-.8.2-1.6.4-2.3L1.6 7.3C.6 9.3 0 11.6 0 14.2s.6 4.9 1.6 6.9l3.7-3.3z" fill="#FBBC05"/><path d="M12 23.4c3.2 0 6-1.1 8-3l-3.7-2.9c-1.1.7-2.5 1.2-4.3 1.2-3.1 0-5.8-2.3-6.7-5.2L1.6 16.8C3.5 20.8 7.4 23.4 12 23.4z" fill="#34A853"/></svg>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="flex flex-col overflow-hidden">
                                        <p class="font-label-md text-label-md font-bold text-on-surface truncate">{{ Auth::user()->full_name }}</p>
                                        <!-- Email is only shown to the logged-in user themselves -->
                                        <p class="text-[11px] text-on-surface-variant truncate">{{ Auth::user()->email }}</p>
                                        <div class="flex items-center gap-1.5 mt-0.5">
                                            <span class="font-label-sm text-[10px] text-secondary font-mono">{{ Auth::user()->formatted_member_id ?? 'CD-00001' }}</span>
                                            @if(Auth::user()->is_verified)
                                            <span class="flex items-center gap-0.5 text-[9px] bg-emerald-100 text-emerald-700 px-1.5 py-0.5 rounded-full font-bold">
                                                <span class="material-symbols-outlined text-[10px]">verified</span> Verified
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <!-- Coins + XP bar -->
                                <div class="flex items-center gap-2 mt-3 pt-2.5 border-t border-outline-variant/20">
                                    <span class="flex items-center gap-1 text-xs font-semibold text-amber-700 bg-amber-50 px-2 py-1 rounded-full border border-amber-200">
                                        <span class="material-symbols-outlined text-sm">monetization_on</span>
                                        {{ Auth::user()->coins ?? 50 }} Coins
                                    </span>
                                    <span class="flex items-center gap-1 text-xs font-semibold text-indigo-700 bg-indigo-50 px-2 py-1 rounded-full border border-indigo-200">
                                        <span class="material-symbols-outlined text-sm">bolt</span>
                                        {{ Auth::user()->xp ?? 10 }} XP
                                    </span>
                                </div>
                            </div>

                            <!-- Nav Links -->
                            <div class="py-1">
                                <a href="{{ route('profile') }}" class="flex items-center gap-2.5 px-4 py-2.5 text-xs font-semibold text-on-surface hover:bg-surface-container transition-colors">
                                    <span class="material-symbols-outlined text-base text-secondary leading-none">account_circle</span>
                                    <span>My Profile</span>
                                </a>
                                <a href="{{ route('swipes') }}" class="flex items-center gap-2.5 px-4 py-2.5 text-xs font-semibold text-on-surface hover:bg-surface-container transition-colors">
                                    <span class="material-symbols-outlined text-base text-amber-600 leading-none">style</span>
                                    <span>Discover Deck</span>
                                </a>
                                <a href="{{ route('messages') }}" class="flex items-center gap-2.5 px-4 py-2.5 text-xs font-semibold text-on-surface hover:bg-surface-container transition-colors">
                                    <span class="material-symbols-outlined text-base text-blue-500 leading-none">chat</span>
                                    <span>My Messages</span>
                                </a>
                                <a href="{{ route('feed') }}" class="flex items-center gap-2.5 px-4 py-2.5 text-xs font-semibold text-on-surface hover:bg-surface-container transition-colors">
                                    <span class="material-symbols-outlined text-base text-secondary leading-none">local_cafe</span>
                                    <span>Coffee Feed</span>
                                </a>
                                <div class="border-t border-surface-container-high/70 my-1"></div>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-full text-left flex items-center gap-2.5 px-4 py-2.5 text-xs font-semibold text-error hover:bg-red-50 transition-colors cursor-pointer">
                                        <span class="material-symbols-outlined text-base leading-none">logout</span>
                                        <span>Log Out</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="px-space-sm sm:px-space-md py-space-xs rounded-full font-label-md text-label-md text-on-surface hover:text-secondary transition-all">Login</a>
                    <a href="{{ route('register') }}" class="px-space-md py-space-xs rounded-full bg-on-tertiary-container text-on-tertiary font-label-md text-label-md shadow-[0_2px_10px_rgba(214,91,108,0.25)] hover:shadow-lg hover:scale-105 active:scale-95 transition-all">Join Free</a>
                @endauth

                <!-- Mobile Hamburger Toggle -->
                <button type="button" onclick="toggleMobileMenu()" class="lg:hidden p-2 rounded-full hover:bg-surface-container text-on-surface transition-colors focus:outline-none" aria-label="Toggle Navigation">
                    <span class="material-symbols-outlined text-2xl leading-none" id="mobileMenuIcon">menu</span>
                </button>
            </div>
        </div>

        <!-- Mobile Drawer Navigation -->
        <div id="mobileNavDrawer" class="hidden lg:hidden w-full bg-surface-container-lowest/98 border-t border-outline-variant/30 px-4 py-3 flex flex-col gap-1 shadow-lg max-h-[80vh] overflow-y-auto">
            @auth
                <!-- Mobile User Info Card -->
                <div class="flex items-center gap-3 px-3 py-3 mb-2 bg-surface-container rounded-2xl">
                    <div class="relative shrink-0">
                        <img alt="{{ Auth::user()->full_name }}" class="w-10 h-10 rounded-full object-cover ring-2 ring-outline-variant/40" src="{{ Auth::user()->avatar_url }}"/>
                        <span class="absolute bottom-0 right-0 w-2.5 h-2.5 rounded-full bg-emerald-500 ring-1 ring-white"></span>
                    </div>
                    <div class="overflow-hidden">
                        <p class="font-label-md text-label-md font-bold text-on-surface truncate">{{ Auth::user()->full_name }}</p>
                        <p class="text-[11px] text-on-surface-variant truncate">{{ Auth::user()->email }}</p>
                        @if(!empty(Auth::user()->google_id))
                        <p class="text-[10px] text-blue-600 font-semibold mt-0.5 flex items-center gap-1">
                            <svg viewBox="0 0 24 24" class="w-3 h-3 inline"><path d="M12 5c1.6 0 3 .6 4.1 1.6l3.1-3.1C17.3 1.7 14.8 1 12 1 7.4 1 3.5 3.6 1.6 7.3l3.7 2.9C6.2 7.3 8.9 5 12 5z" fill="#EA4335"/><path d="M23.5 12.3c0-.8-.1-1.6-.2-2.3H12v4.5h6.5c-.3 1.5-1.1 2.8-2.4 3.7l3.7 2.9c2.2-2 3.7-5 3.7-8.8z" fill="#4285F4"/><path d="M5.3 14.8c-.2-.7-.4-1.5-.4-2.3 0-.8.2-1.6.4-2.3L1.6 7.3C.6 9.3 0 11.6 0 14.2s.6 4.9 1.6 6.9l3.7-3.3z" fill="#FBBC05"/><path d="M12 23.4c3.2 0 6-1.1 8-3l-3.7-2.9c-1.1.7-2.5 1.2-4.3 1.2-3.1 0-5.8-2.3-6.7-5.2L1.6 16.8C3.5 20.8 7.4 23.4 12 23.4z" fill="#34A853"/></svg>
                            Google Account
                        </p>
                        @endif
                    </div>
                </div>
                <a href="{{ route('feed') }}" class="flex items-center gap-2.5 px-3 py-2.5 rounded-xl text-sm font-semibold text-on-surface hover:bg-surface-container">
                    <span class="material-symbols-outlined text-base text-secondary">local_cafe</span>
                    <span>Coffee Feed</span>
                </a>
                <a href="{{ route('swipes') }}" class="flex items-center gap-2.5 px-3 py-2.5 rounded-xl text-sm font-semibold text-on-surface hover:bg-surface-container">
                    <span class="material-symbols-outlined text-base text-amber-600">style</span>
                    <span>Discover Deck</span>
                </a>
                <a href="{{ route('messages') }}" class="flex items-center gap-2.5 px-3 py-2.5 rounded-xl text-sm font-semibold text-on-surface hover:bg-surface-container justify-between">
                    <div class="flex items-center gap-2.5">
                        <span class="material-symbols-outlined text-base text-blue-500">chat</span>
                        <span>Messages &amp; Dates</span>
                    </div>
                    <span class="px-2 py-0.5 rounded-full bg-on-tertiary-container text-on-tertiary text-xs font-bold">3</span>
                </a>
                <a href="{{ route('profile') }}" class="flex items-center gap-2.5 px-3 py-2.5 rounded-xl text-sm font-semibold text-on-surface hover:bg-surface-container">
                    <span class="material-symbols-outlined text-base text-secondary">account_circle</span>
                    <span>My Profile</span>
                </a>
                <div class="border-t border-outline-variant/20 my-1"></div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full text-left flex items-center gap-2.5 px-3 py-2.5 rounded-xl text-sm font-semibold text-error hover:bg-red-50 cursor-pointer">
                        <span class="material-symbols-outlined text-base">logout</span>
                        <span>Log Out</span>
                    </button>
                </form>
            @else
                <a href="{{ route('cities.index') }}" class="flex items-center gap-2.5 px-3 py-2.5 rounded-xl text-sm font-semibold text-on-surface hover:bg-surface-container">
                    <span class="material-symbols-outlined text-base text-secondary">explore</span>
                    <span>Explore &amp; Cities</span>
                </a>
                <a href="{{ route('dates') }}" class="flex items-center gap-2.5 px-3 py-2.5 rounded-xl text-sm font-semibold text-on-surface hover:bg-surface-container">
                    <span class="material-symbols-outlined text-base text-secondary">local_cafe</span>
                    <span>Nearby Cafés</span>
                </a>
                <a href="{{ route('blog.index') }}" class="flex items-center gap-2.5 px-3 py-2.5 rounded-xl text-sm font-semibold text-on-surface hover:bg-surface-container">
                    <span class="material-symbols-outlined text-base text-secondary">article</span>
                    <span>Dating Guides</span>
                </a>
                <div class="border-t border-outline-variant/20 my-1"></div>
                <a href="{{ route('login') }}" class="flex items-center gap-2.5 px-3 py-2.5 rounded-xl text-sm font-semibold text-secondary hover:bg-surface-container">
                    <span class="material-symbols-outlined text-base">login</span>
                    <span>Login</span>
                </a>
                <a href="{{ route('register') }}" class="flex items-center justify-center gap-2 px-3 py-2.5 rounded-xl text-sm font-semibold bg-on-tertiary-container text-on-tertiary">
                    <span class="material-symbols-outlined text-base">person_add</span>
                    <span>Join CupDate Free</span>
                </a>
            @endauth
        </div>
    </header>

    <!-- Global Toast Alert (if any) -->
    @if(session('success'))
        <div class="fixed top-24 left-1/2 -translate-x-1/2 z-40 bg-surface-container-highest/95 border border-outline-variant px-6 py-3 rounded-full shadow-lg text-xs font-bold text-secondary flex items-center gap-2 backdrop-blur-md">
            <span class="material-symbols-outlined text-emerald-600 text-base leading-none">check_circle</span>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <!-- Main Content Container (pt-20 offsets fixed 80px header) -->
    <main class="w-full pt-20 bg-surface min-h-screen flex-grow">
        @yield('content')
    </main>

    <!-- Global High-SEO Multi-Column Editorial Footer -->
    <footer class="w-full bg-[#160c09] text-stone-300 border-t border-[#ff007f]/20 mt-auto">
        <div class="max-w-[1360px] mx-auto px-4 sm:px-6 lg:px-margin-desktop py-12 flex flex-col gap-10">
            
            <!-- Brand + Mission -->
            <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-6 pb-8 border-b border-stone-800">
                <div class="flex flex-col gap-2 max-w-lg">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full overflow-hidden shadow-[0_0_12px_rgba(255,0,127,0.4)] border border-[#ff007f]/50 p-0.5 bg-[#180e0c]">
                            <img alt="CupDate Logo" class="w-full h-full object-contain" src="{{ asset('assets/images/cupdate_logo.svg') }}"/>
                        </div>
                        <span class="text-2xl font-black text-white tracking-tight font-['Plus_Jakarta_Sans']">Cup<span class="neon-pink-text">Date</span></span>
                        <span class="text-[10px] bg-[#ff007f]/20 text-[#ff80bf] border border-[#ff007f]/40 px-2 py-0.5 rounded-full font-bold">India &amp; Himachal Dating</span>
                    </div>
                    <p class="text-xs text-stone-400 leading-relaxed">
                        India's premier 100% selfie-verified intentional matchmaking app. Meet for respectful, low-pressure 45-minute coffee dates across Himachal Pradesh and major metropolitan cities.
                    </p>
                </div>
                
                <div class="flex flex-wrap items-center gap-3 text-xs">
                    <a href="{{ route('register') }}" class="px-5 py-2.5 rounded-full bg-[#ff007f] hover:bg-[#ff4081] text-white font-bold transition shadow-[0_0_20px_rgba(255,0,127,0.4)]">
                        <i class="fa-solid fa-mug-hot mr-1.5"></i> Join Free in Your City
                    </a>
                    <a href="{{ route('dates') }}" class="px-4 py-2.5 rounded-full bg-stone-800 hover:bg-stone-700 text-stone-200 font-semibold border border-stone-700 transition">
                        Partner Cafes
                    </a>
                </div>
            </div>

            <!-- SEO Cities Multi-Column Links Section -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 py-2">
                
                <!-- Column 1: Dating in Himachal Pradesh (High-Intent SEO) -->
                <div>
                    <div class="flex items-center gap-2 mb-3">
                        <span class="text-[#ff007f] text-sm"><i class="fa-solid fa-mountain"></i></span>
                        <h4 class="text-xs font-black uppercase tracking-wider text-white">Dating in Himachal Pradesh</h4>
                    </div>
                    <ul class="space-y-1.5 text-xs text-stone-400">
                        <li><a href="{{ route('city.show', 'kangra') }}" class="hover:text-[#ff80bf] hover:underline transition">Dating in Kangra, HP</a></li>
                        <li><a href="{{ route('city.show', 'solan') }}" class="hover:text-[#ff80bf] hover:underline transition">Dating in Solan, HP</a></li>
                        <li><a href="{{ route('city.show', 'shimla') }}" class="hover:text-[#ff80bf] hover:underline transition">Dating in Shimla</a></li>
                        <li><a href="{{ route('city.show', 'dharamshala') }}" class="hover:text-[#ff80bf] hover:underline transition">Dating in Dharamshala &amp; McLeodGanj</a></li>
                        <li><a href="{{ route('city.show', 'manali') }}" class="hover:text-[#ff80bf] hover:underline transition">Dating in Manali &amp; Old Manali</a></li>
                        <li><a href="{{ route('city.show', 'mandi') }}" class="hover:text-[#ff80bf] hover:underline transition">Dating in Mandi (Chhoti Kashi)</a></li>
                        <li><a href="{{ route('city.show', 'kullu') }}" class="hover:text-[#ff80bf] hover:underline transition">Dating in Kullu Valley</a></li>
                        <li><a href="{{ route('city.show', 'hamirpur') }}" class="hover:text-[#ff80bf] hover:underline transition">Dating in Hamirpur, HP</a></li>
                        <li><a href="{{ route('city.show', 'bilaspur') }}" class="hover:text-[#ff80bf] hover:underline transition">Dating in Bilaspur (Govind Sagar)</a></li>
                        <li><a href="{{ route('city.show', 'una') }}" class="hover:text-[#ff80bf] hover:underline transition">Dating in Una, HP</a></li>
                        <li><a href="{{ route('city.show', 'chamba') }}" class="hover:text-[#ff80bf] hover:underline transition">Dating in Chamba</a></li>
                        <li><a href="{{ route('city.show', 'palampur') }}" class="hover:text-[#ff80bf] hover:underline transition">Dating in Palampur Tea Valley</a></li>
                        <li><a href="{{ route('city.show', 'baddi') }}" class="hover:text-[#ff80bf] hover:underline transition">Dating in Baddi &amp; Solan</a></li>
                    </ul>
                </div>

                <!-- Column 2: Dating in North India & Tri-City -->
                <div>
                    <div class="flex items-center gap-2 mb-3">
                        <span class="text-emerald-400 text-sm"><i class="fa-solid fa-tree"></i></span>
                        <h4 class="text-xs font-black uppercase tracking-wider text-white">North India &amp; Tri-City</h4>
                    </div>
                    <ul class="space-y-1.5 text-xs text-stone-400">
                        <li><a href="{{ route('city.show', 'chandigarh') }}" class="hover:text-[#ff80bf] hover:underline transition">Dating in Chandigarh</a></li>
                        <li><a href="{{ route('city.show', 'mohali') }}" class="hover:text-[#ff80bf] hover:underline transition">Dating in Mohali (Phase 3B2)</a></li>
                        <li><a href="{{ route('city.show', 'panchkula') }}" class="hover:text-[#ff80bf] hover:underline transition">Dating in Panchkula</a></li>
                        <li><a href="{{ route('city.show', 'delhi') }}" class="hover:text-[#ff80bf] hover:underline transition">Dating in Delhi NCR (Saket &amp; HKV)</a></li>
                        <li><a href="{{ route('city.show', 'dehradun') }}" class="hover:text-[#ff80bf] hover:underline transition">Dating in Dehradun &amp; Mussoorie</a></li>
                        <li><a href="{{ route('city.show', 'amritsar') }}" class="hover:text-[#ff80bf] hover:underline transition">Dating in Amritsar</a></li>
                        <li><a href="{{ route('city.show', 'ludhiana') }}" class="hover:text-[#ff80bf] hover:underline transition">Dating in Ludhiana</a></li>
                        <li><a href="{{ route('rishta') }}" class="text-amber-400 font-bold hover:underline transition">Traditional Rishta &amp; Matrimony Hub</a></li>
                    </ul>
                </div>

                <!-- Column 3: Major Indian Metros -->
                <div>
                    <div class="flex items-center gap-2 mb-3">
                        <span class="text-amber-400 text-sm"><i class="fa-solid fa-city"></i></span>
                        <h4 class="text-xs font-black uppercase tracking-wider text-white">Metro Cities Across India</h4>
                    </div>
                    <ul class="space-y-1.5 text-xs text-stone-400">
                        <li><a href="{{ route('city.show', 'pune') }}" class="hover:text-[#ff80bf] hover:underline transition">Dating in Pune (Koregaon Park)</a></li>
                        <li><a href="{{ route('city.show', 'mumbai') }}" class="hover:text-[#ff80bf] hover:underline transition">Dating in Mumbai (Bandra West)</a></li>
                        <li><a href="{{ route('city.show', 'bangalore') }}" class="hover:text-[#ff80bf] hover:underline transition">Dating in Bangalore (Indiranagar)</a></li>
                        <li><a href="{{ route('city.show', 'jaipur') }}" class="hover:text-[#ff80bf] hover:underline transition">Dating in Jaipur (C-Scheme)</a></li>
                        <li><a href="{{ route('city.show', 'hyderabad') }}" class="hover:text-[#ff80bf] hover:underline transition">Dating in Hyderabad (Jubilee Hills)</a></li>
                        <li><a href="{{ route('city.show', 'kolkata') }}" class="hover:text-[#ff80bf] hover:underline transition">Dating in Kolkata (Park Street)</a></li>
                        <li><a href="{{ route('city.show', 'goa') }}" class="hover:text-[#ff80bf] hover:underline transition">Dating in Goa (Assagao &amp; Panjim)</a></li>
                        <li><a href="{{ route('cities.index') }}" class="text-[#ff80bf] font-bold hover:underline transition">View All 50+ Cities Index →</a></li>
                    </ul>
                </div>

                <!-- Column 4: Trust, Safety & Legal -->
                <div>
                    <div class="flex items-center gap-2 mb-3">
                        <span class="text-rose-400 text-sm"><i class="fa-solid fa-shield-halved"></i></span>
                        <h4 class="text-xs font-black uppercase tracking-wider text-white">Safety &amp; Compliance</h4>
                    </div>
                    <ul class="space-y-1.5 text-xs text-stone-400">
                        <li><a href="{{ route('how.it.works') }}" class="hover:text-white transition">Coffee Matchmaking Manifesto</a></li>
                        <li><a href="{{ route('safety') }}" class="hover:text-white transition">Women Safety &amp; Protocol</a></li>
                        <li><a href="{{ route('privacy') }}" class="hover:text-white transition">Privacy Policy (DPDP Act 2023)</a></li>
                        <li><a href="{{ route('terms') }}" class="hover:text-white transition">Terms of Service</a></li>
                        <li><a href="{{ route('community.guidelines') }}" class="hover:text-white transition">Community Guidelines</a></li>
                        <li><a href="{{ route('contact') }}" class="hover:text-white transition">Contact &amp; Grievance Officer</a></li>
                        <li><a href="{{ route('sitemap.html') }}" class="hover:text-white transition">HTML Sitemap</a></li>
                        <li><a href="{{ route('sitemap.xml') }}" class="hover:text-white transition">XML Sitemap for Search Engines</a></li>
                    </ul>
                </div>

            </div>

            <!-- Copyright & Sub-footer -->
            <div class="flex flex-col md:flex-row items-center justify-between gap-4 pt-6 border-t border-stone-800 text-xs text-stone-500">
                <p>© {{ date('Y') }} CupDate Atelier. Roasted with intention. Dedicated to mindful connections across Himachal Pradesh &amp; India.</p>
                <div class="flex items-center gap-4 text-stone-400">
                    <span class="flex items-center gap-1.5 text-emerald-400 font-semibold">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span> 100% Selfie-Verified
                    </span>
                    <span>•</span>
                    <span>SSL 256-Bit Encrypted</span>
                </div>
            </div>

        </div>
    </footer>

    <!-- Mobile Bottom Navigation for Quick Thumb Access -->
    @auth
        <nav class="md:hidden fixed bottom-0 left-0 right-0 h-16 bg-surface/95 backdrop-blur-md border-t border-outline-variant/30 flex items-center justify-around z-40">
            <a href="{{ route('feed') }}" class="flex flex-col items-center gap-0.5 text-xs font-semibold {{ request()->routeIs('feed*') ? 'text-secondary font-bold' : 'text-on-surface-variant' }}">
                <span class="material-symbols-outlined text-xl">local_cafe</span>
                <span>Feed</span>
            </a>
            <a href="{{ route('swipes') }}" class="flex flex-col items-center gap-0.5 text-xs font-semibold {{ request()->routeIs('swipes*') ? 'text-secondary font-bold' : 'text-on-surface-variant' }}">
                <span class="material-symbols-outlined text-xl">style</span>
                <span>Swipes</span>
            </a>
            <a href="{{ route('messages') }}" class="flex flex-col items-center gap-0.5 text-xs font-semibold {{ request()->routeIs('messages*') ? 'text-secondary font-bold' : 'text-on-surface-variant' }}">
                <span class="material-symbols-outlined text-xl">chat_bubble</span>
                <span>Chat</span>
            </a>
            <a href="{{ route('profile') }}" class="flex flex-col items-center gap-0.5 text-xs font-semibold {{ request()->routeIs('profile*') ? 'text-secondary font-bold' : 'text-on-surface-variant' }}">
                <span class="material-symbols-outlined text-xl">account_circle</span>
                <span>Profile</span>
            </a>
        </nav>
    @else
        <nav class="md:hidden fixed bottom-0 left-0 right-0 h-16 bg-surface/95 backdrop-blur-md border-t border-outline-variant/30 flex items-center justify-around z-40">
            <a href="{{ route('home') }}" class="flex flex-col items-center gap-0.5 text-xs font-semibold {{ request()->routeIs('home') ? 'text-secondary font-bold' : 'text-on-surface-variant' }}">
                <span class="material-symbols-outlined text-xl">home</span>
                <span>Home</span>
            </a>
            <a href="{{ route('cities.index') }}" class="flex flex-col items-center gap-0.5 text-xs font-semibold {{ request()->routeIs('cities*') || request()->routeIs('city*') ? 'text-secondary font-bold' : 'text-on-surface-variant' }}">
                <span class="material-symbols-outlined text-xl">explore</span>
                <span>Cities</span>
            </a>
            <a href="{{ route('dates') }}" class="flex flex-col items-center gap-0.5 text-xs font-semibold {{ request()->routeIs('dates*') ? 'text-secondary font-bold' : 'text-on-surface-variant' }}">
                <span class="material-symbols-outlined text-xl">local_cafe</span>
                <span>Cafés</span>
            </a>
            <a href="{{ route('login') }}" class="flex flex-col items-center gap-0.5 text-xs font-semibold {{ request()->routeIs('login*') ? 'text-secondary font-bold' : 'text-on-surface-variant' }}">
                <span class="material-symbols-outlined text-xl">login</span>
                <span>Login</span>
            </a>
            <a href="{{ route('register') }}" class="flex flex-col items-center gap-0.5 text-xs font-bold text-on-tertiary-container">
                <span class="material-symbols-outlined text-xl">add_circle</span>
                <span>Join</span>
            </a>
        </nav>
    @endauth

    <!-- 7-Day Streak & Coins Modal -->
    <div id="streakModal" class="hidden fixed inset-0 z-50 bg-black/60 backdrop-blur-sm flex items-center justify-center p-4">
        <div class="bg-surface-container-lowest border border-outline-variant/40 rounded-3xl p-6 sm:p-8 max-w-md w-full shadow-2xl relative">
            <button onclick="closeStreakModal()" class="absolute top-4 right-4 text-on-surface-variant hover:text-on-surface text-xl cursor-pointer">
                <span class="material-symbols-outlined">close</span>
            </button>
            <div class="text-center mb-5">
                <span class="inline-flex items-center gap-1.5 bg-surface-container text-secondary px-3.5 py-1 rounded-full text-xs font-bold uppercase tracking-wider mb-2">
                    <span class="material-symbols-outlined text-sm text-amber-600">local_fire_department</span> Daily Login Reward
                </span>
                <h3 class="font-headline-sm text-headline-sm text-on-surface font-semibold">7-Day Coffee Bean Streak</h3>
                <p class="text-xs text-on-surface-variant mt-1">Log in daily to claim bonus coins and boost your dating profile visibility!</p>
            </div>

            <!-- 7-Day Roadmap Grid -->
            <div class="grid grid-cols-7 gap-1.5 mb-6 text-center">
                @php $streakRewards = [1=>10, 2=>15, 3=>20, 4=>25, 5=>35, 6=>50, 7=>100]; @endphp
                @foreach($streakRewards as $day => $coins)
                    <div class="p-2 rounded-xl border border-outline-variant/40 bg-surface-container-low flex flex-col items-center">
                        <span class="text-[10px] font-bold text-on-surface-variant">D{{ $day }}</span>
                        <span class="material-symbols-outlined text-amber-600 text-sm my-0.5">monetization_on</span>
                        <span class="text-xs font-extrabold text-secondary">+{{ $coins }}</span>
                    </div>
                @endforeach
            </div>

            <!-- Claim Button -->
            <button id="claimStreakBtn" onclick="handleClaimStreak()" class="w-full py-3 bg-on-tertiary-container text-on-tertiary font-label-md text-label-md rounded-xl shadow-md hover:scale-[1.01] active:scale-[0.99] transition cursor-pointer mb-3">
                Claim Today's Coffee Coins
            </button>

            <!-- 24h Profile Boost Option -->
            <div class="pt-4 border-t border-outline-variant/30 flex items-center justify-between">
                <div>
                    <strong class="text-sm font-bold text-on-surface block">Boost Profile for 24h</strong>
                    <span class="text-xs text-on-surface-variant">Appear 10x more frequently in Swipes</span>
                </div>
                <button onclick="handleBoostProfile()" class="px-3.5 py-2 bg-surface-container border border-outline-variant/40 text-secondary rounded-xl font-bold text-xs hover:bg-surface-container-high transition cursor-pointer">
                    Boost (50 Coins)
                </button>
            </div>
            <div id="streakModalFeedback" class="mt-3 text-center text-xs font-bold text-secondary"></div>
        </div>
    </div>

    <!-- Header Dropdown & Streak JS -->
    <script>
        function toggleGlobalProfileMenu() {
            const dropdown = document.getElementById('globalProfileDropdown');
            if (dropdown) {
                dropdown.classList.toggle('hidden');
            }
        }

        function toggleMobileMenu() {
            const drawer = document.getElementById('mobileNavDrawer');
            const icon = document.getElementById('mobileMenuIcon');
            if (drawer) {
                drawer.classList.toggle('hidden');
                if (icon) {
                    icon.textContent = drawer.classList.contains('hidden') ? 'menu' : 'close';
                }
            }
        }

        // Location Dropdown & GPS Auto-Detection
        function toggleGlobalLocationDropdown() {
            const dropdown = document.getElementById('globalLocationDropdown');
            const arrow = document.getElementById('headerCityArrow');
            if (dropdown) {
                dropdown.classList.toggle('hidden');
                if (arrow) {
                    arrow.style.transform = dropdown.classList.contains('hidden') ? 'rotate(0deg)' : 'rotate(180deg)';
                }
            }
        }

        function selectHeaderCity(cityName) {
            localStorage.setItem('cupdate_active_city', cityName);
            const label = document.getElementById('globalHeaderCityName');
            if (label) label.innerText = cityName;
            const dropdown = document.getElementById('globalLocationDropdown');
            if (dropdown) dropdown.classList.add('hidden');
            const arrow = document.getElementById('headerCityArrow');
            if (arrow) arrow.style.transform = 'rotate(0deg)';
        }

        const HEADER_GPS_CITIES = [
            { name: 'Kangra, HP', lat: 32.0998, lng: 76.2691 },
            { name: 'Solan, HP', lat: 30.9084, lng: 77.0999 },
            { name: 'Shimla, HP', lat: 31.1048, lng: 77.1734 },
            { name: 'Dharamshala, HP', lat: 32.2190, lng: 76.3234 },
            { name: 'Manali, HP', lat: 32.2432, lng: 77.1892 },
            { name: 'Mandi, HP', lat: 31.7087, lng: 76.9320 },
            { name: 'Kullu, HP', lat: 31.9579, lng: 77.1095 },
            { name: 'Hamirpur, HP', lat: 31.6862, lng: 76.5213 },
            { name: 'Bilaspur, HP', lat: 31.3326, lng: 76.7570 },
            { name: 'Una, HP', lat: 31.4685, lng: 76.2708 },
            { name: 'Palampur, HP', lat: 32.1109, lng: 76.5363 },
            { name: 'Chandigarh', lat: 30.7333, lng: 76.7794 },
            { name: 'Delhi NCR', lat: 28.6139, lng: 77.2090 },
            { name: 'Pune', lat: 18.5204, lng: 73.8567 },
            { name: 'Mumbai', lat: 19.0760, lng: 72.8777 },
            { name: 'Bangalore', lat: 12.9716, lng: 77.5946 },
            { name: 'Goa', lat: 15.2993, lng: 74.1240 }
        ];

        function autoDetectHeaderLocation() {
            const btnText = document.getElementById('detectHeaderGpsBtnText');
            if (btnText) btnText.innerText = "Querying GPS Satellites...";

            if (!navigator.geolocation) {
                if (btnText) btnText.innerText = "GPS Not Supported";
                return;
            }

            navigator.geolocation.getCurrentPosition(
                (pos) => {
                    const uLat = pos.coords.latitude;
                    const uLng = pos.coords.longitude;
                    let closest = HEADER_GPS_CITIES[0];
                    let minDist = 999999;

                    HEADER_GPS_CITIES.forEach(c => {
                        const d = Math.hypot(uLat - c.lat, uLng - c.lng);
                        if (d < minDist) {
                            minDist = d;
                            closest = c;
                        }
                    });

                    selectHeaderCity(closest.name);
                    if (btnText) btnText.innerText = `Detected: ${closest.name} ✓`;
                    setTimeout(() => {
                        const dropdown = document.getElementById('globalLocationDropdown');
                        if (dropdown) dropdown.classList.add('hidden');
                        if (btnText) btnText.innerText = "Auto-Detect GPS Location";
                    }, 800);
                },
                (err) => {
                    if (btnText) btnText.innerText = "Permission Denied. Select Below";
                    setTimeout(() => {
                        if (btnText) btnText.innerText = "Auto-Detect GPS Location";
                    }, 2500);
                }
            );
        }

        // Initialize header location from stored preference or auto GPS
        document.addEventListener('DOMContentLoaded', () => {
            const savedCity = localStorage.getItem('cupdate_active_city');
            const label = document.getElementById('globalHeaderCityName');
            @if(!isset($cityData['name']))
                if (savedCity && label) {
                    label.innerText = savedCity;
                } else if (navigator.geolocation && !savedCity) {
                    navigator.geolocation.getCurrentPosition((pos) => {
                        const uLat = pos.coords.latitude;
                        const uLng = pos.coords.longitude;
                        let closest = HEADER_GPS_CITIES[0];
                        let minDist = 999999;
                        HEADER_GPS_CITIES.forEach(c => {
                            const d = Math.hypot(uLat - c.lat, uLng - c.lng);
                            if (d < minDist) {
                                minDist = d;
                                closest = c;
                            }
                        });
                        selectHeaderCity(closest.name);
                    }, () => {});
                }
            @endif
        });

        // Close dropdowns on external click
        document.addEventListener('click', (e) => {
            const profileContainer = document.getElementById('globalProfileMenuContainer');
            const profileDropdown = document.getElementById('globalProfileDropdown');
            if (profileContainer && profileDropdown && !profileContainer.contains(e.target)) {
                profileDropdown.classList.add('hidden');
            }

            const locContainer = document.getElementById('globalLocationContainer');
            const locDropdown = document.getElementById('globalLocationDropdown');
            const locArrow = document.getElementById('headerCityArrow');
            if (locContainer && locDropdown && !locContainer.contains(e.target)) {
                locDropdown.classList.add('hidden');
                if (locArrow) locArrow.style.transform = 'rotate(0deg)';
            }
        });

        function openStreakModal() {
            const modal = document.getElementById('streakModal');
            if (modal) modal.classList.remove('hidden');
        }

        function closeStreakModal() {
            const modal = document.getElementById('streakModal');
            if (modal) modal.classList.add('hidden');
        }

        async function handleClaimStreak() {
            const btn = document.getElementById('claimStreakBtn');
            const feedback = document.getElementById('streakModalFeedback');
            if (btn) {
                btn.disabled = true;
                btn.innerText = 'Claiming...';
            }

            try {
                const response = await fetch("{{ route('api.streak.claim') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                });
                const data = await response.json();
                if (feedback) feedback.innerText = data.message;
                if (data.coins !== undefined) {
                    const coinDisplay = document.getElementById('headerCoinsCount');
                    if (coinDisplay) coinDisplay.innerText = data.coins;
                }
                if (btn) btn.innerText = "Claimed Today ✓";
            } catch (err) {
                if (feedback) feedback.innerText = "Error claiming reward. Please try again.";
                if (btn) {
                    btn.disabled = false;
                    btn.innerText = "Claim Today's Coffee Coins";
                }
            }
        }

        async function handleBoostProfile() {
            const feedback = document.getElementById('streakModalFeedback');
            if (feedback) feedback.innerText = "Activating Profile Boost...";

            try {
                const response = await fetch("{{ route('api.profile.boost') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                });
                const data = await response.json();
                if (feedback) feedback.innerText = data.message;
                if (data.coins !== undefined) {
                    const coinDisplay = document.getElementById('headerCoinsCount');
                    if (coinDisplay) coinDisplay.innerText = data.coins;
                }
            } catch (err) {
                if (feedback) feedback.innerText = "Error activating boost.";
            }
        }
    </script>
    @yield('extra_js')
</body>
</html>
