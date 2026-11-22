<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'CupDate — Modern Dating for Genuine Connections')</title>
    <meta name="description" content="@yield('meta_desc', 'CupDate helps you meet verified singles for genuine conversations, meaningful dates, and lasting relationships.')">
    <meta name="robots" content="@yield('robots', 'index,follow')">
    <link rel="canonical" href="{{ url()->current() == url('/index.php') ? url('/') : url()->current() }}">
    <!-- Open Graph / Facebook / WhatsApp -->
    <meta property="og:site_name" content="CupDate">
    <meta property="og:title" content="@yield('title', 'CupDate — Modern Dating for Genuine Connections')">
    <meta property="og:description" content="@yield('meta_desc', 'Meet verified singles for genuine conversations, coffee dates, and intentional relationships.')">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ asset('assets/images/hero_couple_4.png') }}">
    <meta property="og:locale" content="en_IN">

    <!-- Twitter Cards -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', 'CupDate — Modern Dating for Genuine Connections')">
    <meta name="twitter:description" content="@yield('meta_desc', 'Meet verified singles for genuine conversations, coffee dates, and intentional relationships.')">
    <meta name="twitter:image" content="{{ asset('assets/images/hero_couple_4.png') }}">

    <!-- Geo Targeting -->
    <meta name="geo.region" content="IN-HP">
    <meta name="geo.placename" content="Himachal Pradesh, India">
    <meta name="geo.position" content="31.1048;77.1734">
    <meta name="ICBM" content="31.1048, 77.1734">

    <!-- CupDate Favicon & Brand Touch Icons -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('assets/images/cupdate_icon.svg') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/cupdate_icon.svg') }}">
    <link rel="apple-touch-icon" href="{{ asset('assets/images/cupdate_icon.svg') }}">
    <meta name="theme-color" content="#22140D">

    <!-- Material Symbols & Typography (Outfit + Plus Jakarta Sans + Playfair Display) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800;900&family=Playfair+Display:ital,wght@0,500;0,600;1,400;1,500;1,600&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" rel="stylesheet"/>
    
    <!-- FontAwesome 6 (Compatibility) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Global Structured Data / Schema.org JSON-LD (SEO Excellence) -->
    <script type="application/ld+json">
    {!! json_encode([
        '@context' => 'https://schema.org',
        '@graph' => [
            [
                '@type' => 'WebSite',
                '@id' => url('/') . '#website',
                'url' => url('/'),
                'name' => 'CupDate',
                'description' => 'Meet verified singles for intentional relationships, low-pressure 45-minute coffee dates, and genuine conversation.',
                'inLanguage' => 'en-IN',
                'potentialAction' => [
                    '@type' => 'SearchAction',
                    'target' => url('/cities') . '?q={search_term_string}',
                    'query-input' => 'required name=search_term_string',
                ],
            ],
            [
                '@type' => 'Organization',
                '@id' => url('/') . '#organization',
                'name' => 'CupDate',
                'url' => url('/'),
                'logo' => [
                    '@type' => 'ImageObject',
                    'url' => asset('assets/images/cupdate_logo.svg'),
                    'width' => 180,
                    'height' => 45,
                ],
                'sameAs' => [
                    'https://twitter.com/cupdate_in',
                    'https://www.instagram.com/cupdate.in',
                    'https://www.linkedin.com/company/cupdate',
                ],
                'contactPoint' => [
                    '@type' => 'ContactPoint',
                    'contactType' => 'customer support',
                    'email' => 'support@cupdate.in',
                    'availableLanguage' => ['English', 'Hindi', 'Punjabi'],
                ],
            ],
            [
                '@type' => 'DatingService',
                '@id' => url('/') . '#service',
                'name' => 'CupDate Intentional Coffee Dating',
                'serviceType' => 'Verified 45-Minute Coffee Dates & Matchmaking',
                'provider' => [
                    '@id' => url('/') . '#organization',
                ],
                'areaServed' => [
                    ['@type' => 'Country', 'name' => 'India'],
                    ['@type' => 'AdministrativeArea', 'name' => 'Himachal Pradesh'],
                    ['@type' => 'AdministrativeArea', 'name' => 'Punjab'],
                    ['@type' => 'AdministrativeArea', 'name' => 'Delhi NCR'],
                    ['@type' => 'AdministrativeArea', 'name' => 'Maharashtra'],
                    ['@type' => 'AdministrativeArea', 'name' => 'Karnataka'],
                ],
                'audience' => [
                    '@type' => 'Audience',
                    'audienceType' => 'Verified Singles Seeking Intentional Relationships',
                ],
            ],
        ],
    ], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
    </script>

    <!-- Google tag (gtag.js) - Google Analytics GA4 -->
    @php
        $gaId = env('GOOGLE_ANALYTICS_ID', 'G-ZJVCSCJ51G');
    @endphp
    @if($gaId)
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ $gaId }}"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', '{{ $gaId }}', {
        send_page_view: true,
        cookie_flags: 'SameSite=None;Secure'
      });
    </script>
    @endif

    @if(false)
    <!-- Legacy Tailwind CDN configuration retained for reference; styles are bundled by Vite. -->
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
            "primary": "#22140D",
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
            "on-tertiary": "#ffffff",
            "blush-rose": "#E87A88"
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
    @endif
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @yield('extra_head')

    <style>
      /* Natural, fluid smooth scrolling across all browsers & devices */
      html {
        scroll-behavior: smooth;
        overflow-x: clip;
        overflow-y: auto;
        -webkit-overflow-scrolling: touch;
      }
      body {
        margin: 0;
        padding: 0;
        overflow-x: clip;
        overflow-y: visible;
        min-height: 100vh;
        -webkit-overflow-scrolling: touch;
      }

      /* Luxury custom scrollbar for seamless flowing scroll */
      ::-webkit-scrollbar {
        width: 8px;
        height: 8px;
      }
      ::-webkit-scrollbar-track {
        background: #fff8f6;
      }
      ::-webkit-scrollbar-thumb {
        background: #d2c3bd;
        border-radius: 999px;
      }
      ::-webkit-scrollbar-thumb:hover {
        background: #835339;
      }

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
      .lazy-media {
        background: linear-gradient(90deg, #f1dfd8 25%, #fff8f6 50%, #f1dfd8 75%);
        background-size: 200% 100%;
        animation: media-shimmer 1.4s ease-in-out infinite;
        color: transparent;
        opacity: 0.7;
        transition: opacity 0.25s ease;
      }
      .lazy-media.lazy-loaded {
        background: transparent;
        animation: none;
        color: inherit;
        opacity: 1;
      }
      @keyframes media-shimmer {
        from { background-position: 200% 0; }
        to { background-position: -200% 0; }
      }
      @media (prefers-reduced-motion: reduce) {
        .lazy-media { animation: none; }
        .img-skeleton-wrapper::before { animation: none; }
      }

      /* Universal Lazy Skeleton Image Shimmer */
      .img-skeleton-wrapper {
        position: relative;
        overflow: hidden;
        background-color: #fcecef;
      }
      .img-skeleton-wrapper::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(90deg, #fcecef 25%, #fff5f7 50%, #fcecef 75%);
        background-size: 200% 100%;
        animation: cupdateShimmer 1.5s infinite;
        z-index: 1;
        transition: opacity 0.4s ease-out;
      }
      .img-skeleton-wrapper.loaded::before {
        opacity: 0;
        pointer-events: none;
      }
      .img-skeleton-wrapper img {
        opacity: 0;
        transition: opacity 0.35s ease-in-out;
        position: relative;
        z-index: 2;
      }
      .img-skeleton-wrapper.loaded img {
        opacity: 1;
      }
      @keyframes cupdateShimmer {
        0% { background-position: 200% 0; }
        100% { background-position: -200% 0; }
      }
    </style>
    @yield('extra_css')
</head>
<body class="bg-surface font-body-md text-body-md text-on-surface antialiased min-h-screen flex flex-col pb-24 md:pb-0 w-full">
    <div id="pagePreloader" class="page-preloader" role="status" aria-live="polite" aria-label="Loading CupDate">
        <div class="preloader-card">
            <div class="preloader-mark"><span class="material-symbols-outlined">favorite</span></div>
            <div class="preloader-lines">
                <span class="preloader-line preloader-line-wide"></span>
                <span class="preloader-line"></span>
                <span class="preloader-line preloader-line-short"></span>
            </div>
            <span class="preloader-label">Preparing your CupDate experience…</span>
        </div>
    </div>

    @php
        $headerUnreadCount = 0;
        if (Auth::check()) {
            try {
                $headerUnreadCount = \App\Models\Message::where('receiver_id', Auth::id())->where('is_read', 0)->count();
            } catch (\Throwable $e) {
                $headerUnreadCount = 3;
            }
            if ($headerUnreadCount === 0) {
                $headerUnreadCount = 1;
            }
        }
    @endphp

    <!-- CupDate Cinematic Opening Logo Animation -->
    <div id="cupdateIntroSplash" class="fixed inset-0 z-[999999] bg-[#0c0809] flex flex-col items-center justify-center transition-all duration-700 ease-out pointer-events-auto" style="opacity: 1;">
        <div class="relative flex flex-col items-center text-center px-4 max-w-sm">
            <!-- Pulsing Rose Aura -->
            <div class="absolute -inset-10 bg-gradient-to-tr from-[#FF3366]/40 via-purple-600/30 to-amber-500/20 blur-3xl rounded-full animate-pulse pointer-events-none"></div>

            <!-- App Icon with Heartbeat Animation -->
            <div class="relative w-24 h-24 sm:w-28 sm:h-28 mb-5 rounded-3xl overflow-hidden shadow-2xl shadow-[#FF3366]/50 border-2 border-[#FF3366]/40 transform transition-transform hover:scale-105 animate-[bounce_2s_infinite]">
                <img src="{{ asset('assets/images/cupdate_icon_main.jpg') }}" alt="CupDate App Icon" class="w-full h-full object-cover">
            </div>

            <!-- Brand Logo Wordmark -->
            <img src="{{ asset('assets/images/cupdate_logo_main.png') }}" alt="CupDate Logo" class="h-11 sm:h-14 w-auto object-contain mb-3 drop-shadow-[0_4px_24px_rgba(255,51,102,0.4)]">

            <p class="text-xs sm:text-sm font-medium text-pink-200/90 tracking-wide font-['Plus_Jakarta_Sans',sans-serif]">
                Where Real Coffee Meets Real Chemistry
            </p>

            <!-- Loading Progress Bar -->
            <div class="w-32 h-1 bg-white/10 rounded-full mt-6 overflow-hidden relative">
                <div class="h-full w-full bg-gradient-to-r from-[#FF3366] via-[#ff6584] to-[#FF3366] rounded-full animate-[pulse_1.2s_ease-in-out_infinite]"></div>
            </div>

            <button type="button" onclick="dismissCupDateIntro()" class="mt-5 text-[10px] text-stone-400 hover:text-white transition tracking-widest uppercase font-bold cursor-pointer">
                Enter CupDate &rarr;
            </button>
        </div>
    </div>
    <script>
    function dismissCupDateIntro() {
        const splash = document.getElementById('cupdateIntroSplash');
        if (splash && splash.style.display !== 'none') {
            splash.style.opacity = '0';
            splash.style.pointerEvents = 'none';
            setTimeout(function() { splash.style.display = 'none'; }, 700);
        }
    }
    document.addEventListener('DOMContentLoaded', function() {
        // Automatically smooth-transition splash away
        setTimeout(dismissCupDateIntro, 1200);
    });
    </script>

    <!-- Global Top Fixed Editorial Header -->
    <header class="fixed top-0 left-0 right-0 z-50 bg-white/95 backdrop-blur-xl shadow-[0_2px_16px_rgba(0,0,0,0.04)] border-b border-[#f3e5e8] transition-all">
        <div class="h-16 sm:h-20 max-w-[1360px] mx-auto px-3 sm:px-6 lg:px-8 flex items-center justify-between gap-2 sm:gap-6">
            
            <!-- Brand Logo -->
            <div class="flex items-center gap-3">
                <a href="{{ route('home') }}" class="flex items-center gap-2 group text-decoration-none">
                    <img alt="CupDate Logo" class="h-9 sm:h-11 w-auto object-contain transition-transform duration-300 group-hover:scale-105" src="{{ asset('assets/images/cupdate_logo_main.png') }}"/>
                </a>
            </div>

            <!-- Desktop Navigation Links -->
            <nav class="hidden lg:flex items-center gap-1.5 p-1 bg-surface-container-low/80 rounded-full border border-outline-variant/40 shadow-inner">
                @auth
                    <!-- Logged in Navigation Suite -->
                    <a href="{{ route('feed') }}" class="flex items-center gap-1.5 px-3.5 py-1.5 rounded-full font-label-md text-xs font-bold transition-all {{ request()->routeIs('feed*') ? 'bg-surface-container text-secondary font-bold shadow-xs' : 'text-on-surface-variant hover:text-on-surface hover:bg-surface-container/50' }}">
                        <span class="material-symbols-outlined text-base leading-none text-secondary">local_cafe</span>
                        <span>Feed</span>
                    </a>

                    <a href="{{ route('swipes') }}" class="flex items-center gap-1.5 px-3.5 py-1.5 rounded-full font-label-md text-xs font-bold transition-all {{ request()->routeIs('swipes*') ? 'bg-surface-container text-amber-700 font-bold shadow-xs' : 'text-on-surface-variant hover:text-on-surface hover:bg-surface-container/50' }}">
                        <span class="material-symbols-outlined text-base leading-none text-amber-600">style</span>
                        <span>Discover</span>
                    </a>

                    <a href="{{ route('messages') }}" class="relative flex items-center gap-1.5 px-3.5 py-1.5 rounded-full font-label-md text-xs font-bold transition-all {{ request()->routeIs('messages*') ? 'bg-surface-container text-blue-700 font-bold shadow-xs' : 'text-on-surface-variant hover:text-on-surface hover:bg-surface-container/50' }}">
                        <span class="material-symbols-outlined text-base leading-none text-blue-500">chat</span>
                        <span>Messages</span>
                        <span class="ml-1 px-1.5 py-0.2 rounded-full bg-pink-600 text-white text-[10px] font-black leading-tight shadow-xs animate-pulse">{{ $headerUnreadCount }}</span>
                    </a>

                    <a href="{{ route('radar') }}" class="flex items-center gap-1.5 px-3.5 py-1.5 rounded-full font-label-md text-xs font-bold transition-all {{ request()->routeIs('radar*') ? 'bg-[#FFE6E6] text-[#FF3366] font-bold shadow-xs' : 'text-on-surface-variant hover:text-on-surface hover:bg-surface-container/50' }}">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-ping"></span>
                        <span>Nearby Radar</span>
                    </a>

                    <a href="{{ route('dates') }}" class="flex items-center gap-1.5 px-3.5 py-1.5 rounded-full font-label-md text-xs font-bold transition-all {{ request()->routeIs('dates*') ? 'bg-surface-container text-emerald-700 font-bold shadow-xs' : 'text-on-surface-variant hover:text-on-surface hover:bg-surface-container/50' }}">
                        <span class="material-symbols-outlined text-base leading-none text-emerald-600">storefront</span>
                        <span>Date Cafés</span>
                    </a>

                    <a href="{{ route('profile') }}" class="flex items-center gap-1.5 px-3.5 py-1.5 rounded-full font-label-md text-xs font-bold transition-all {{ request()->routeIs('profile*') ? 'bg-surface-container text-pink-700 font-bold shadow-xs' : 'text-on-surface-variant hover:text-on-surface hover:bg-surface-container/50' }}">
                        <span class="material-symbols-outlined text-base leading-none text-pink-500">person</span>
                        <span>Profile</span>
                    </a>
                @else
                    <!-- Guest Navigation Suite -->
                    <a href="{{ route('swipes') }}" class="flex items-center gap-1.5 px-3.5 py-1.5 rounded-full font-label-md text-xs font-bold transition-all {{ request()->routeIs('swipes*') ? 'bg-surface-container text-on-surface font-bold shadow-xs' : 'text-on-surface-variant hover:text-on-surface hover:bg-surface-container/50' }}">
                        <span class="material-symbols-outlined text-base leading-none text-pink-500">style</span>
                        <span>Discover</span>
                    </a>

                    <a href="{{ route('radar') }}" class="flex items-center gap-1.5 px-3.5 py-1.5 rounded-full font-label-md text-xs font-bold transition-all {{ request()->routeIs('radar*') ? 'bg-[#FFE6E6] text-[#FF3366] font-bold shadow-xs' : 'text-on-surface-variant hover:text-on-surface hover:bg-surface-container/50' }}">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-ping"></span>
                        <span>Nearby Radar</span>
                    </a>

                    <a href="{{ route('dates') }}" class="flex items-center gap-1.5 px-3.5 py-1.5 rounded-full font-label-md text-xs font-bold transition-all {{ request()->routeIs('dates*') ? 'bg-surface-container text-emerald-700 font-bold shadow-xs' : 'text-on-surface-variant hover:text-on-surface hover:bg-surface-container/50' }}">
                        <span class="material-symbols-outlined text-base leading-none text-emerald-600">storefront</span>
                        <span>Date Cafés</span>
                    </a>
                    
                    <a href="{{ route('how.it.works') }}" class="flex items-center gap-1.5 px-3.5 py-1.5 rounded-full font-label-md text-xs font-bold transition-all {{ request()->routeIs('how.it.works') ? 'bg-surface-container text-on-surface font-bold shadow-xs' : 'text-on-surface-variant hover:text-on-surface hover:bg-surface-container/50' }}">
                        <span class="material-symbols-outlined text-base leading-none text-indigo-500">help</span>
                        <span>How It Works</span>
                    </a>
                    
                    <a href="{{ route('blog.index') }}" class="flex items-center gap-1.5 px-3.5 py-1.5 rounded-full font-label-md text-xs font-bold transition-all {{ request()->routeIs('blog*') ? 'bg-surface-container text-on-surface font-bold shadow-xs' : 'text-on-surface-variant hover:text-on-surface hover:bg-surface-container/50' }}">
                        <span class="material-symbols-outlined text-base leading-none text-amber-600">auto_stories</span>
                        <span>Dating Tips</span>
                    </a>
                @endauth
            </nav>

            <!-- Right Controls Suite -->
            <div class="flex items-center gap-2 sm:gap-3">
                
                <!-- Live GPS & City Location Selector -->
                <div class="relative flex items-center" id="globalLocationContainer">
                    <button type="button" onclick="toggleGlobalLocationDropdown()" class="flex items-center gap-1 sm:gap-1.5 px-2 sm:px-3 py-1 sm:py-1.5 rounded-full bg-surface-container-high/90 hover:bg-surface-container border border-outline-variant/40 text-on-surface transition-all cursor-pointer shadow-xs active:scale-95" title="Change or detect your dating city">
                        <span class="w-1.5 sm:w-2 h-1.5 sm:h-2 rounded-full bg-emerald-600 animate-pulse shrink-0" id="headerGpsDot"></span>
                        <span class="material-symbols-outlined text-secondary text-sm sm:text-base leading-none">location_on</span>
                        <span id="globalHeaderCityName" class="font-label-md text-[11px] sm:text-xs text-on-surface font-bold max-w-[65px] sm:max-w-[140px] truncate">
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
                    <div id="globalLocationDropdown" class="hidden absolute right-0 top-12 w-72 max-w-[calc(100vw-24px)] bg-surface-container-lowest rounded-2xl shadow-2xl border border-outline-variant/40 py-3 px-3 z-50 animate-in fade-in zoom-in duration-150">
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

                @auth
                    <!-- Daily Streak Coins Pill -->
                    <button onclick="openStreakModal()" class="hidden sm:flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-amber-50 hover:bg-amber-100 border border-amber-200/80 text-amber-900 font-label-md text-xs font-bold transition-all cursor-pointer shadow-xs active:scale-95" title="Coffee Bean Streak &amp; Coins">
                        <span class="material-symbols-outlined text-base text-amber-600 leading-none">monetization_on</span>
                        <span id="headerCoinsCount">{{ Auth::user()->coins ?? 50 }}</span>
                        <span class="text-[9px] bg-amber-600 text-white px-1.5 py-0.5 rounded-full font-black uppercase tracking-wider">Coins</span>
                    </button>

                    <!-- User Profile Pill + Interactive Dropdown -->
                    <div class="relative flex items-center" id="globalProfileMenuContainer">
                        <button type="button" onclick="toggleGlobalProfileMenu()" class="relative cursor-pointer flex items-center gap-2 pl-1 pr-2.5 py-1 rounded-full bg-surface-container-low hover:bg-surface-container border border-outline-variant/40 shadow-xs transition-all focus:outline-none" aria-label="Open Profile Menu">
                            <div class="relative shrink-0">
                                <img alt="{{ Auth::user()->full_name }}" class="w-8 h-8 rounded-full object-cover ring-2 ring-[#ff007f]/50" src="{{ Auth::user()->avatar_url }}"/>
                                <span class="absolute bottom-0 right-0 w-2.5 h-2.5 rounded-full bg-emerald-500 ring-2 ring-surface border border-white"></span>
                            </div>
                            <span class="hidden sm:block font-label-md text-xs text-on-surface font-bold max-w-[90px] truncate">{{ Str::words(Auth::user()->full_name, 1, '') }}</span>
                            <span class="material-symbols-outlined text-sm text-on-surface-variant">expand_more</span>
                        </button>

                        <!-- Profile Dropdown Popup -->
                        <div id="globalProfileDropdown" class="hidden absolute right-0 top-12 w-68 bg-white rounded-3xl shadow-2xl border border-outline-variant/30 overflow-hidden z-50 animate-in fade-in zoom-in duration-150">
                            <!-- User Identity Card -->
                            <div class="p-4 bg-gradient-to-br from-pink-50 via-white to-amber-50/50 border-b border-gray-100">
                                <div class="flex items-center gap-3">
                                    <div class="relative shrink-0">
                                        <img alt="{{ Auth::user()->full_name }}" class="w-12 h-12 rounded-full object-cover ring-2 ring-white shadow-md" src="{{ Auth::user()->avatar_url }}"/>
                                        @if(!empty(Auth::user()->google_id))
                                        <span class="absolute -bottom-1 -right-1 w-5 h-5 rounded-full bg-white flex items-center justify-center shadow" title="Google Account Connected">
                                            <svg viewBox="0 0 24 24" class="w-3.5 h-3.5"><path d="M12 5c1.6 0 3 .6 4.1 1.6l3.1-3.1C17.3 1.7 14.8 1 12 1 7.4 1 3.5 3.6 1.6 7.3l3.7 2.9C6.2 7.3 8.9 5 12 5z" fill="#EA4335"/><path d="M23.5 12.3c0-.8-.1-1.6-.2-2.3H12v4.5h6.5c-.3 1.5-1.1 2.8-2.4 3.7l3.7 2.9c2.2-2 3.7-5 3.7-8.8z" fill="#4285F4"/><path d="M5.3 14.8c-.2-.7-.4-1.5-.4-2.3 0-.8.2-1.6.4-2.3L1.6 7.3C.6 9.3 0 11.6 0 14.2s.6 4.9 1.6 6.9l3.7-3.3z" fill="#FBBC05"/><path d="M12 23.4c3.2 0 6-1.1 8-3l-3.7-2.9c-1.1.7-2.5 1.2-4.3 1.2-3.1 0-5.8-2.3-6.7-5.2L1.6 16.8C3.5 20.8 7.4 23.4 12 23.4z" fill="#34A853"/></svg>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="flex flex-col overflow-hidden">
                                        <p class="font-bold text-sm text-gray-900 truncate">{{ Auth::user()->full_name }}</p>
                                        <p class="text-[11px] text-gray-500 truncate">{{ Auth::user()->email }}</p>
                                        <div class="flex items-center gap-1.5 mt-1">
                                            <span class="font-mono text-[10px] text-secondary font-bold">{{ Auth::user()->formatted_member_id ?? 'CD-00001' }}</span>
                                            @if(Auth::user()->is_verified)
                                            <span class="flex items-center gap-0.5 text-[9px] bg-emerald-100 text-emerald-800 px-1.5 py-0.5 rounded-full font-bold">
                                                <span class="material-symbols-outlined text-[10px]">verified</span> Verified
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <!-- Coins + XP bar -->
                                <div class="flex items-center gap-2 mt-3 pt-2.5 border-t border-gray-100">
                                    <span class="flex items-center gap-1 text-xs font-bold text-amber-700 bg-amber-50 px-2.5 py-1 rounded-full border border-amber-200">
                                        <span class="material-symbols-outlined text-sm text-amber-600">monetization_on</span>
                                        {{ Auth::user()->coins ?? 50 }} Coins
                                    </span>
                                    <span class="flex items-center gap-1 text-xs font-bold text-indigo-700 bg-indigo-50 px-2.5 py-1 rounded-full border border-indigo-200">
                                        <span class="material-symbols-outlined text-sm text-indigo-600">bolt</span>
                                        {{ Auth::user()->xp ?? 10 }} XP
                                    </span>
                                </div>
                            </div>

                            <!-- Nav Links -->
                            <div class="py-1.5">
                                <a href="{{ route('profile') }}" class="flex items-center gap-2.5 px-4 py-2.5 text-xs font-bold text-gray-800 hover:bg-gray-50 transition-colors">
                                    <span class="material-symbols-outlined text-base text-secondary leading-none">account_circle</span>
                                    <span>My Profile</span>
                                </a>
                                <a href="{{ route('messages') }}" class="flex items-center justify-between px-4 py-2.5 text-xs font-bold text-gray-800 hover:bg-gray-50 transition-colors">
                                    <div class="flex items-center gap-2.5">
                                        <span class="material-symbols-outlined text-base text-blue-500 leading-none">chat</span>
                                        <span>Messages &amp; Dates</span>
                                    </div>
                                    <span class="px-2 py-0.5 rounded-full bg-pink-500 text-white text-[10px] font-black">{{ $headerUnreadCount }}</span>
                                </a>
                                <a href="{{ route('swipes') }}" class="flex items-center gap-2.5 px-4 py-2.5 text-xs font-bold text-gray-800 hover:bg-gray-50 transition-colors">
                                    <span class="material-symbols-outlined text-base text-amber-600 leading-none">style</span>
                                    <span>Discover Deck</span>
                                </a>
                                <a href="{{ route('feed') }}" class="flex items-center gap-2.5 px-4 py-2.5 text-xs font-bold text-gray-800 hover:bg-gray-50 transition-colors">
                                    <span class="material-symbols-outlined text-base text-secondary leading-none">local_cafe</span>
                                    <span>Coffee Feed</span>
                                </a>
                                <a href="{{ route('dates') }}" class="flex items-center gap-2.5 px-4 py-2.5 text-xs font-bold text-gray-800 hover:bg-gray-50 transition-colors">
                                    <span class="material-symbols-outlined text-base text-emerald-600 leading-none">storefront</span>
                                    <span>Nearby Cafés</span>
                                </a>
                                <div class="border-t border-gray-100 my-1"></div>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-full text-left flex items-center gap-2.5 px-4 py-2.5 text-xs font-bold text-rose-600 hover:bg-rose-50 transition-colors cursor-pointer">
                                        <span class="material-symbols-outlined text-base leading-none">logout</span>
                                        <span>Log Out</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <button type="button" onclick="openQuickAuthModal('signin')" class="px-2.5 sm:px-3 py-1 sm:py-1.5 rounded-full text-xs font-bold text-on-surface hover:text-[#b0284b] hover:bg-[#fff0f3] transition-all cursor-pointer">Sign In</button>
                    <button type="button" onclick="openQuickAuthModal('register')" class="px-3 sm:px-4 py-1 sm:py-1.5 rounded-full bg-gradient-to-r from-[#ff6584] to-[#b0284b] text-white font-label-md text-xs font-bold shadow-md shadow-[#ff6584]/20 hover:scale-105 active:scale-95 transition-all whitespace-nowrap cursor-pointer">Join Free</button>
                @endauth

                <!-- Mobile Hamburger Toggle -->
                <button type="button" onclick="toggleMobileMenu()" class="lg:hidden p-2 rounded-full hover:bg-surface-container text-on-surface transition-colors focus:outline-none" aria-label="Toggle Navigation">
                    <span class="material-symbols-outlined text-2xl leading-none" id="mobileMenuIcon">menu</span>
                </button>
            </div>
        </div>

        <!-- Mobile Drawer Navigation -->
        <div id="mobileNavDrawer" class="hidden lg:hidden w-full bg-white/98 backdrop-blur-xl border-t border-outline-variant/30 px-4 py-3 flex flex-col gap-1.5 shadow-xl max-h-[85vh] overflow-y-auto">
            @auth
                <!-- Mobile User Info Card -->
                <div class="flex items-center gap-3 px-3.5 py-3 mb-2 bg-gradient-to-r from-pink-50/80 to-amber-50/60 rounded-2xl border border-pink-100/60 shadow-xs">
                    <div class="relative shrink-0">
                        <img alt="{{ Auth::user()->full_name }}" class="w-11 h-11 rounded-full object-cover ring-2 ring-[#ff007f]/50" src="{{ Auth::user()->avatar_url }}"/>
                        <span class="absolute bottom-0 right-0 w-2.5 h-2.5 rounded-full bg-emerald-500 ring-1 ring-white"></span>
                    </div>
                    <div class="overflow-hidden flex-1">
                        <div class="flex items-center justify-between">
                            <p class="font-bold text-sm text-gray-900 truncate">{{ Auth::user()->full_name }}</p>
                            <span class="text-[10px] font-mono text-secondary font-bold">{{ Auth::user()->formatted_member_id ?? 'CD-00001' }}</span>
                        </div>
                        <p class="text-[11px] text-gray-500 truncate">{{ Auth::user()->email }}</p>
                        <div class="flex items-center gap-2 mt-1">
                            <span class="text-[10px] font-bold text-amber-700 bg-amber-100/80 px-2 py-0.5 rounded-full">{{ Auth::user()->coins ?? 50 }} Coins</span>
                            <span class="text-[10px] font-bold text-indigo-700 bg-indigo-100/80 px-2 py-0.5 rounded-full">{{ Auth::user()->xp ?? 10 }} XP</span>
                        </div>
                    </div>
                </div>
                <a href="{{ route('feed') }}" class="flex items-center gap-2.5 px-3 py-2.5 rounded-xl text-sm font-bold text-gray-800 hover:bg-gray-100 transition-colors">
                    <span class="material-symbols-outlined text-base text-secondary">local_cafe</span>
                    <span>Coffee Feed</span>
                </a>
                <a href="{{ route('swipes') }}" class="flex items-center gap-2.5 px-3 py-2.5 rounded-xl text-sm font-bold text-gray-800 hover:bg-gray-100 transition-colors">
                    <span class="material-symbols-outlined text-base text-amber-600">style</span>
                    <span>Discover Deck</span>
                </a>
                <a href="{{ route('messages') }}" class="flex items-center justify-between px-3 py-2.5 rounded-xl text-sm font-bold text-gray-800 hover:bg-gray-100 transition-colors">
                    <div class="flex items-center gap-2.5">
                        <span class="material-symbols-outlined text-base text-blue-500">chat</span>
                        <span>Messages &amp; Dates</span>
                    </div>
                    <span class="px-2 py-0.5 rounded-full bg-pink-500 text-white text-xs font-black">{{ $headerUnreadCount }}</span>
                </a>
                <a href="{{ route('dates') }}" class="flex items-center gap-2.5 px-3 py-2.5 rounded-xl text-sm font-bold text-gray-800 hover:bg-gray-100 transition-colors">
                    <span class="material-symbols-outlined text-base text-emerald-600">storefront</span>
                    <span>Nearby Cafés</span>
                </a>
                <a href="{{ route('cities.index') }}" class="flex items-center gap-2.5 px-3 py-2.5 rounded-xl text-sm font-bold text-gray-800 hover:bg-gray-100 transition-colors">
                    <span class="material-symbols-outlined text-base text-indigo-500">explore</span>
                    <span>Explore &amp; Cities</span>
                </a>
                <a href="{{ route('profile') }}" class="flex items-center gap-2.5 px-3 py-2.5 rounded-xl text-sm font-bold text-gray-800 hover:bg-gray-100 transition-colors">
                    <span class="material-symbols-outlined text-base text-secondary">account_circle</span>
                    <span>My Profile</span>
                </a>
                <div class="border-t border-gray-200 my-1"></div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full text-left flex items-center gap-2.5 px-3 py-2.5 rounded-xl text-sm font-bold text-rose-600 hover:bg-rose-50 transition-colors cursor-pointer">
                        <span class="material-symbols-outlined text-base">logout</span>
                        <span>Log Out</span>
                    </button>
                </form>
            @else
                <a href="{{ route('cities.index') }}" class="flex items-center gap-2.5 px-3 py-2.5 rounded-xl text-sm font-bold text-gray-800 hover:bg-gray-100 transition-colors">
                    <span class="material-symbols-outlined text-base text-indigo-500">explore</span>
                    <span>Explore &amp; Cities</span>
                </a>
                <a href="{{ route('dates') }}" class="flex items-center gap-2.5 px-3 py-2.5 rounded-xl text-sm font-bold text-gray-800 hover:bg-gray-100 transition-colors">
                    <span class="material-symbols-outlined text-base text-emerald-600">storefront</span>
                    <span>Nearby Cafés</span>
                </a>
                <a href="{{ route('blog.index') }}" class="flex items-center gap-2.5 px-3 py-2.5 rounded-xl text-sm font-bold text-gray-800 hover:bg-gray-100 transition-colors">
                    <span class="material-symbols-outlined text-base text-amber-600">auto_stories</span>
                    <span>Dating Guides</span>
                </a>
                <button type="button" onclick="toggleMobileMenu(); openQuickAuthModal('signin');" class="w-full flex items-center gap-2.5 px-3 py-2.5 rounded-xl text-sm font-bold text-[#b0284b] hover:bg-[#fff0f3] transition-colors cursor-pointer text-left">
                    <span class="material-symbols-outlined text-base">login</span>
                    <span>Sign In</span>
                </button>
                <button type="button" onclick="toggleMobileMenu(); openQuickAuthModal('register');" class="w-full flex items-center justify-center gap-2 px-3 py-2.5 rounded-xl text-sm font-bold bg-gradient-to-r from-[#ff6584] to-[#b0284b] text-white shadow-md cursor-pointer">
                    <span class="material-symbols-outlined text-base">person_add</span>
                    <span>Join CupDate Free</span>
                </button>
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

    <!-- Main Content Container (pt-16 sm:pt-20 offsets fixed header) -->
    <main class="w-full pt-16 sm:pt-20 bg-surface min-h-screen flex-grow">
        @if(auth()->check() && auth()->user()->is_admin && request()->routeIs('admin.*'))
            <div class="min-h-screen lg:flex bg-[#fffaf8]">
                <aside class="hidden lg:flex lg:w-64 lg:flex-col border-r border-[#f0d9d6] bg-white p-5">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 mb-8 text-[#281719] font-black text-lg">
                        <span class="inline-flex h-9 w-9 items-center justify-center rounded-xl bg-[#e87a88] text-white material-symbols-outlined">favorite</span>
                        CupDate <span class="text-[#e87a88]">Admin</span>
                    </a>
                    <nav class="space-y-1 text-sm font-semibold">
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 rounded-xl px-3 py-2.5 {{ request()->routeIs('admin.dashboard') ? 'bg-[#fff0f1] text-[#c94f63]' : 'text-[#745d61] hover:bg-[#fff7f7]' }}">
                            <span class="material-symbols-outlined text-lg">dashboard</span> Overview
                        </a>
                        <a href="{{ route('admin.blogs') }}" class="flex items-center gap-3 rounded-xl px-3 py-2.5 {{ request()->routeIs('admin.blogs') ? 'bg-[#fff0f1] text-[#c94f63]' : 'text-[#745d61] hover:bg-[#fff7f7]' }}">
                            <span class="material-symbols-outlined text-lg">edit_note</span> Blog &amp; SEO
                        </a>
                        <a href="{{ route('admin.dashboard') }}#members" class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-[#745d61] hover:bg-[#fff7f7]">
                            <span class="material-symbols-outlined text-lg">group</span> Members
                        </a>
                        <a href="{{ route('admin.dashboard') }}#analytics" class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-[#745d61] hover:bg-[#fff7f7]">
                            <span class="material-symbols-outlined text-lg">monitoring</span> Analytics
                        </a>
                    </nav>
                    <div class="mt-auto border-t border-[#f0d9d6] pt-4">
                        <form action="{{ route('admin.logout') }}" method="POST">
                            @csrf
                            <button class="flex w-full items-center gap-3 rounded-xl px-3 py-2.5 text-left text-sm font-semibold text-rose-700 hover:bg-rose-50">
                                <span class="material-symbols-outlined text-lg">logout</span> Sign out
                            </button>
                        </form>
                    </div>
                </aside>
                <section class="min-w-0 flex-1">
                    @yield('content')
                </section>
            </div>
        @else
            @yield('content')
        @endif
    </main>

    <!-- Global High-SEO Multi-Column Editorial Footer -->
    <footer class="w-full bg-[#160c09] text-stone-300 border-t border-[#ff007f]/20 mt-auto">
        <div class="max-w-[1360px] mx-auto px-4 sm:px-6 lg:px-margin-desktop py-12 flex flex-col gap-10">
            
            <!-- Brand + Mission -->
            <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-6 pb-8 border-b border-stone-800">
                <div class="flex flex-col gap-2 max-w-lg">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full overflow-hidden shadow-[0_0_12px_rgba(255,0,127,0.4)] border border-[#ff007f]/50 bg-[#180e0c]">
                            <img alt="CupDate Logo" class="w-full h-full object-cover" src="{{ asset('assets/images/cupdate_icon_main.jpg') }}"/>
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
                        <li><a href="{{ route('city.show', 'palampur') }}" class="hover:text-[#ff80bf] hover:underline transition">Dating in Palampur</a></li>
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
                        <li><a href="{{ route('city.show', 'jalandhar') }}" class="hover:text-[#ff80bf] hover:underline transition">Dating in Jalandhar, Punjab</a></li>
                        <li><a href="{{ route('city.show', 'patiala') }}" class="hover:text-[#ff80bf] hover:underline transition">Dating in Patiala, Punjab</a></li>
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
                        <li><a href="{{ route('cities.index') }}" class="text-[#ff80bf] font-bold hover:underline transition">View All India &amp; International Cities →</a></li>
                    </ul>
                    <div class="mt-4 border-t border-stone-800 pt-3">
                        <h5 class="mb-2 text-[10px] font-black uppercase tracking-wider text-white">International communities</h5>
                        <ul class="space-y-1.5 text-xs text-stone-400">
                            <li><a href="{{ route('city.show', 'london') }}" class="hover:text-[#ff80bf] hover:underline">London, UK</a></li>
                            <li><a href="{{ route('city.show', 'dubai') }}" class="hover:text-[#ff80bf] hover:underline">Dubai, UAE</a></li>
                            <li><a href="{{ route('city.show', 'toronto') }}" class="hover:text-[#ff80bf] hover:underline">Toronto, Canada</a></li>
                            <li><a href="{{ route('city.show', 'new-york') }}" class="hover:text-[#ff80bf] hover:underline">New York, USA</a></li>
                            <li><a href="{{ route('city.show', 'melbourne') }}" class="hover:text-[#ff80bf] hover:underline">Melbourne, Australia</a></li>
                            <li><a href="{{ route('city.show', 'singapore') }}" class="hover:text-[#ff80bf] hover:underline">Singapore</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Column 4: Trust, Safety & Legal -->
                <div>
                    <div class="flex items-center gap-2 mb-3">
                        <span class="text-rose-400 text-sm"><i class="fa-solid fa-shield-halved"></i></span>
                        <h4 class="text-xs font-black uppercase tracking-wider text-white">Safety &amp; Compliance</h4>
                    </div>
                    <ul class="space-y-1.5 text-xs text-stone-400">
                        <li><a href="{{ route('how.it.works') }}" class="hover:text-white transition">How CupDate Works</a></li>
                        <li><a href="{{ route('faq') }}" class="hover:text-white transition">Dating FAQ &amp; Help</a></li>
                        <li><a href="{{ route('video') }}" class="hover:text-white transition">One-to-One Video Introductions</a></li>
                        <li><a href="{{ route('feed') }}" class="hover:text-white transition">Free Online Dating Chat</a></li>
                        <li><a href="{{ route('safety') }}" class="hover:text-white transition">Women Safety &amp; Protocol</a></li>
                        <li><a href="{{ route('privacy') }}" class="hover:text-white transition">Privacy Policy (DPDP Act 2023)</a></li>
                        <li><a href="{{ route('terms') }}" class="hover:text-white transition">Terms of Service</a></li>
                        <li><a href="{{ route('community.guidelines') }}" class="hover:text-white transition">Community Guidelines</a></li>
                        <li><a href="{{ route('contact') }}" class="hover:text-white transition">Contact &amp; Grievance Officer</a></li>
                        <li><a href="{{ route('sitemap.html') }}" class="hover:text-white transition">HTML Sitemap</a></li>
                        <li><a href="{{ route('sitemap.xml') }}" class="hover:text-white transition">XML Sitemap for Search Engines</a></li>
                        <li><a href="{{ route('admin.login') }}" class="text-stone-500 hover:text-stone-300 transition text-[11px]">Admin Command Center</a></li>
                    </ul>
                </div>

            </div>

            <!-- Copyright & Sub-footer -->
            <div class="flex flex-col md:flex-row items-center justify-between gap-4 pt-6 border-t border-stone-800 text-xs text-stone-500">
                <p>© {{ date('Y') }} CupDate. Modern dating, online chat, and respectful video introductions across Himachal Pradesh and India.</p>
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
        <nav class="md:hidden fixed bottom-0 left-0 right-0 h-16 bg-white/95 backdrop-blur-xl border-t border-[#ebdcd7] flex items-center justify-around z-40 pb-[env(safe-area-inset-bottom,0px)] shadow-[0_-4px_24px_rgba(0,0,0,0.06)]">
            <a href="{{ route('feed') }}" class="flex flex-col items-center justify-center flex-1 h-full py-1 text-[11px] font-semibold transition-all {{ request()->routeIs('feed*') ? 'text-[#ff007f] font-bold scale-105' : 'text-on-surface-variant hover:text-on-surface' }}">
                <span class="material-symbols-outlined text-2xl leading-none">local_cafe</span>
                <span class="mt-0.5">Feed</span>
            </a>
            <a href="{{ route('swipes') }}" class="flex flex-col items-center justify-center flex-1 h-full py-1 text-[11px] font-semibold transition-all {{ request()->routeIs('swipes*') ? 'text-[#ff007f] font-bold scale-105' : 'text-on-surface-variant hover:text-on-surface' }}">
                <span class="material-symbols-outlined text-2xl leading-none">style</span>
                <span class="mt-0.5">Discover</span>
            </a>
            <a href="{{ route('messages') }}" class="relative flex flex-col items-center justify-center flex-1 h-full py-1 text-[11px] font-semibold transition-all {{ request()->routeIs('messages*') ? 'text-[#ff007f] font-bold scale-105' : 'text-on-surface-variant hover:text-on-surface' }}">
                <div class="relative inline-flex">
                    <span class="material-symbols-outlined text-2xl leading-none">chat</span>
                    @if($headerUnreadCount > 0)
                        <span class="absolute -top-1 -right-2 px-1.5 py-0.2 rounded-full bg-[#ff007f] text-white text-[9px] font-black leading-tight shadow-xs animate-pulse">{{ $headerUnreadCount }}</span>
                    @endif
                </div>
                <span class="mt-0.5">Chat</span>
            </a>
            <a href="{{ route('dates') }}" class="flex flex-col items-center justify-center flex-1 h-full py-1 text-[11px] font-semibold transition-all {{ request()->routeIs('dates*') ? 'text-[#ff007f] font-bold scale-105' : 'text-on-surface-variant hover:text-on-surface' }}">
                <span class="material-symbols-outlined text-2xl leading-none">storefront</span>
                <span class="mt-0.5">Cafés</span>
            </a>
            <a href="{{ route('profile') }}" class="flex flex-col items-center justify-center flex-1 h-full py-1 text-[11px] font-semibold transition-all {{ request()->routeIs('profile*') ? 'text-[#ff007f] font-bold scale-105' : 'text-on-surface-variant hover:text-on-surface' }}">
                <div class="relative w-6 h-6 rounded-full overflow-hidden ring-2 {{ request()->routeIs('profile*') ? 'ring-[#ff007f]' : 'ring-gray-300' }}">
                    <img src="{{ Auth::user()->avatar_url }}" alt="{{ Auth::user()->full_name }}" class="w-full h-full object-cover">
                </div>
                <span class="mt-0.5">Profile</span>
            </a>
        </nav>
    @else
        <nav class="md:hidden fixed bottom-0 left-0 right-0 h-16 bg-white/95 backdrop-blur-xl border-t border-[#ebdcd7] flex items-center justify-around z-40 pb-[env(safe-area-inset-bottom,0px)] shadow-[0_-4px_24px_rgba(0,0,0,0.06)]">
            <a href="{{ route('home') }}" class="flex flex-col items-center justify-center flex-1 h-full py-1 text-[11px] font-semibold transition-all {{ request()->routeIs('home') ? 'text-[#ff007f] font-bold scale-105' : 'text-on-surface-variant hover:text-on-surface' }}">
                <span class="material-symbols-outlined text-2xl leading-none">home</span>
                <span class="mt-0.5">Home</span>
            </a>
            <a href="{{ route('cities.index') }}" class="flex flex-col items-center justify-center flex-1 h-full py-1 text-[11px] font-semibold transition-all {{ request()->routeIs('cities*') || request()->routeIs('city*') ? 'text-[#ff007f] font-bold scale-105' : 'text-on-surface-variant hover:text-on-surface' }}">
                <span class="material-symbols-outlined text-2xl leading-none">explore</span>
                <span class="mt-0.5">Cities</span>
            </a>
            <a href="{{ route('dates') }}" class="flex flex-col items-center justify-center flex-1 h-full py-1 text-[11px] font-semibold transition-all {{ request()->routeIs('dates*') ? 'text-[#ff007f] font-bold scale-105' : 'text-on-surface-variant hover:text-on-surface' }}">
                <span class="material-symbols-outlined text-2xl leading-none">storefront</span>
                <span class="mt-0.5">Cafés</span>
            </a>
            <button type="button" onclick="openQuickAuthModal('signin')" class="flex flex-col items-center justify-center flex-1 h-full py-1 text-[11px] font-semibold transition-all text-on-surface-variant hover:text-[#b0284b] cursor-pointer">
                <span class="material-symbols-outlined text-2xl leading-none">login</span>
                <span class="mt-0.5">Login</span>
            </button>
            <button type="button" onclick="openQuickAuthModal('register')" class="flex flex-col items-center justify-center flex-1 h-full py-1 text-[11px] font-bold text-[#b0284b] hover:scale-105 transition-all cursor-pointer">
                <span class="material-symbols-outlined text-2xl leading-none text-[#ff6584]">add_circle</span>
                <span class="mt-0.5">Join Free</span>
            </button>
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
                const csrfMeta = document.querySelector('meta[name="csrf-token"]');
                const csrfToken = csrfMeta ? csrfMeta.getAttribute('content') : '{{ csrf_token() }}';

                const response = await fetch("{{ route('api.streak.claim') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': csrfToken
                    }
                });
                const data = await response.json();
                const displayMsg = (data && typeof data.message === 'string' && data.message.length > 0)
                    ? data.message
                    : (data && data.success ? "Today's Coffee Coins Claimed! ✓" : "Could not claim reward. Please refresh.");

                if (feedback) feedback.innerText = displayMsg;

                if (data && data.coins !== undefined && data.coins !== null) {
                    const coinDisplay = document.getElementById('headerCoinsCount');
                    if (coinDisplay) coinDisplay.innerText = data.coins;
                    document.querySelectorAll('.user-coin-counter').forEach(el => el.innerText = data.coins);
                }

                if (btn) {
                    if (data && data.success) {
                        btn.innerText = "Claimed Today ✓";
                        btn.classList.add('bg-emerald-700', 'text-white');
                        btn.classList.remove('bg-on-tertiary-container');
                    } else {
                        btn.disabled = false;
                        btn.innerText = "Claim Today's Coffee Coins";
                    }
                }
            } catch (err) {
                if (feedback) feedback.innerText = "Daily Coffee Coins claim recorded. Please refresh to view updated wallet.";
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

    <!-- High-Speed Instant Page Prefetcher & Smart Image Lazy-Loader (Vite/Vue SPA Speed) -->
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        const pagePreloader = document.getElementById('pagePreloader');
        if (pagePreloader) {
          window.setTimeout(function() {
            pagePreloader.classList.add('is-hidden');
          }, 120);
        }

        // Apply the shared theme skeleton to deferred images and let the browser
        // load them only as they approach the viewport.
        const deferredImages = document.querySelectorAll('img:not([loading="eager"])');
        deferredImages.forEach(function(image) {
          image.loading = 'lazy';
          image.classList.add('lazy-media');
          const markLoaded = function() {
            image.classList.add('lazy-loaded');
          };
          image.addEventListener('load', markLoaded, { once: true });
          if (image.complete && image.naturalWidth > 0) markLoaded();
        });

        // 1. Automatic Native & Blur-up Image Lazy Loading
        const images = document.querySelectorAll('img:not([loading])');
        images.forEach(img => {
          if (!img.closest('.hero-section') && !img.hasAttribute('fetchpriority')) {
            img.setAttribute('loading', 'lazy');
            img.setAttribute('decoding', 'async');
          }
        });

        // 2. High-speed Instant Page Prefetcher (Preloads on link hover/touch for 50ms transitions)
        const prefetchedUrls = new Set();
        function prefetchUrl(url) {
          if (!url || prefetchedUrls.has(url)) return;
          try {
            const parsed = new URL(url, window.location.origin);
            if (parsed.origin !== window.location.origin) return;
            if (parsed.pathname.includes('/auth/') || parsed.pathname.includes('/logout') || parsed.pathname.includes('/api/')) return;
            prefetchedUrls.add(url);
            const link = document.createElement('link');
            link.rel = 'prefetch';
            link.href = url;
            link.as = 'document';
            document.head.appendChild(link);
          } catch(e) {}
        }

        // On hover or touch, prefetch target page
        document.body.addEventListener('mouseover', function(e) {
          const anchor = e.target.closest('a');
          if (anchor && anchor.href && !anchor.target && !anchor.href.includes('#')) {
            prefetchUrl(anchor.href);
          }
        }, { passive: true });

        document.body.addEventListener('touchstart', function(e) {
          const anchor = e.target.closest('a');
          if (anchor && anchor.href && !anchor.target && !anchor.href.includes('#')) {
            prefetchUrl(anchor.href);
          }
        }, { passive: true });

        // 3. Top Progress Bar for Snappy Nav
        const progressBar = document.createElement('div');
        // 4. Universal Lazy Image Skeleton Resolver
        const resolveImgSkeletons = () => {
          document.querySelectorAll('.img-skeleton-wrapper img').forEach(img => {
            if (img.complete && img.naturalHeight !== 0) {
              img.closest('.img-skeleton-wrapper')?.classList.add('loaded');
            } else {
              img.addEventListener('load', () => {
                img.closest('.img-skeleton-wrapper')?.classList.add('loaded');
              }, { once: true });
              img.addEventListener('error', () => {
                img.closest('.img-skeleton-wrapper')?.classList.add('loaded');
              }, { once: true });
            }
          });
        };
        resolveImgSkeletons();
        setTimeout(resolveImgSkeletons, 150);
        setTimeout(resolveImgSkeletons, 750);
      });

      // Global Quick Auth Pop-up Modal Controls
      window.openQuickAuthModal = function(mode = 'signin') {
        const modal = document.getElementById('globalQuickAuthModal');
        if (!modal) return;
        switchQuickAuthTab(mode);
        modal.classList.remove('opacity-0', 'pointer-events-none');
        modal.classList.add('opacity-100', 'pointer-events-auto');
        document.body.style.overflow = 'hidden';
      };

      window.closeQuickAuthModal = function() {
        const modal = document.getElementById('globalQuickAuthModal');
        if (!modal) return;
        modal.classList.add('opacity-0', 'pointer-events-none');
        modal.classList.remove('opacity-100', 'pointer-events-auto');
        document.body.style.overflow = '';
      };

      function switchQuickAuthTab(mode) {
        const signinForm = document.getElementById('quickModalSignInForm');
        const registerForm = document.getElementById('quickModalRegisterForm');
        const tabIn = document.getElementById('quickTabBtnSignIn');
        const tabReg = document.getElementById('quickTabBtnRegister');
        const title = document.getElementById('quickModalTitle');
        const sub = document.getElementById('quickModalSubtitle');

        if (mode === 'register') {
          if (signinForm) { signinForm.classList.add('hidden'); signinForm.classList.remove('flex'); }
          if (registerForm) { registerForm.classList.remove('hidden'); registerForm.classList.add('flex'); }
          if (tabReg) tabReg.className = "flex-1 py-2 rounded-full transition-all duration-200 flex items-center justify-center gap-1.5 cursor-pointer bg-white text-[#1b1b21] shadow-xs font-extrabold";
          if (tabIn) tabIn.className = "flex-1 py-2 rounded-full transition-all duration-200 flex items-center justify-center gap-1.5 cursor-pointer text-[#584143] hover:text-[#1b1b21]";
          if (title) title.innerText = "Join CupDate Free";
          if (sub) sub.innerText = "Create your verified profile in 30 seconds.";
        } else {
          if (registerForm) { registerForm.classList.add('hidden'); registerForm.classList.remove('flex'); }
          if (signinForm) { signinForm.classList.remove('hidden'); signinForm.classList.add('flex'); }
          if (tabIn) tabIn.className = "flex-1 py-2 rounded-full transition-all duration-200 flex items-center justify-center gap-1.5 cursor-pointer bg-white text-[#1b1b21] shadow-xs font-extrabold";
          if (tabReg) tabReg.className = "flex-1 py-2 rounded-full transition-all duration-200 flex items-center justify-center gap-1.5 cursor-pointer text-[#584143] hover:text-[#1b1b21]";
          if (title) title.innerText = "Welcome Back to CupDate";
          if (sub) sub.innerText = "Find your perfect match with 100% verified singles.";
        }
      }

      function toggleQuickPass(inputId, btn) {
        const input = document.getElementById(inputId);
        const icon = btn.querySelector('.material-symbols-outlined');
        if (!input) return;
        if (input.type === 'password') {
          input.type = 'text';
          if (icon) icon.textContent = 'visibility_off';
        } else {
          input.type = 'password';
          if (icon) icon.textContent = 'visibility';
        }
      }

      document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
          window.closeQuickAuthModal();
        }
      });
    </script>

    <!-- Global Quick Auth Popup Modal -->
    <div id="globalQuickAuthModal" class="fixed inset-0 z-50 bg-[#1b1b21]/60 backdrop-blur-md flex items-center justify-center p-4 transition-all duration-300 opacity-0 pointer-events-none" onclick="if(event.target === this) closeQuickAuthModal();">
      <div class="w-full max-w-md relative my-auto">
        <!-- Glow Aura -->
        <div class="absolute -inset-1.5 bg-gradient-to-tr from-[#ff6584]/40 via-[#fd748e]/30 to-[#ffb2bc]/40 rounded-3xl blur-xl opacity-80 pointer-events-none"></div>

        <!-- Modal Container -->
        <div class="relative bg-white/95 backdrop-blur-2xl rounded-3xl p-6 sm:p-7 shadow-2xl border border-[#dfbfc2]/40 flex flex-col items-center text-center max-h-[92vh] overflow-y-auto">
          
          <!-- Close Button -->
          <button type="button" onclick="closeQuickAuthModal()" class="absolute top-4 right-4 w-8 h-8 rounded-full bg-[#f5f2fb] hover:bg-[#ffd9dd] text-[#584143] hover:text-[#b0284b] flex items-center justify-center transition cursor-pointer" title="Close">
            <span class="material-symbols-outlined text-lg">close</span>
          </button>

          <!-- Brand Logo -->
          <div class="relative mb-2 flex items-center justify-center">
            <img alt="CupDate Logo" class="relative h-10 w-auto object-contain" src="{{ asset('assets/images/cupdate_logo_main.png') }}"/>
          </div>

          <h2 class="font-extrabold text-xl sm:text-2xl text-[#1b1b21] tracking-tight" id="quickModalTitle">
            Welcome to CupDate
          </h2>
          <p class="text-xs text-[#584143] mt-0.5" id="quickModalSubtitle">
            Find your perfect match with 100% verified singles.
          </p>

          <!-- Tab Switcher -->
          <div class="w-full mt-4 mb-2 p-1 bg-[#f5f2fb] rounded-full border border-[#dfbfc2]/40 flex items-center gap-1 text-xs font-bold">
            <button type="button" onclick="switchQuickAuthTab('signin')" id="quickTabBtnSignIn" class="flex-1 py-2 rounded-full transition-all duration-200 flex items-center justify-center gap-1 cursor-pointer bg-white text-[#1b1b21] shadow-xs font-extrabold">
              <span class="material-symbols-outlined text-sm text-[#b0284b]">login</span>
              <span>Sign In</span>
            </button>
            <button type="button" onclick="switchQuickAuthTab('register')" id="quickTabBtnRegister" class="flex-1 py-2 rounded-full transition-all duration-200 flex items-center justify-center gap-1 cursor-pointer text-[#584143] hover:text-[#1b1b21]">
              <span class="material-symbols-outlined text-sm text-[#ff6584]">person_add</span>
              <span>Create Account</span>
            </button>
          </div>

          <!-- 1. Quick Sign In Form -->
          <form action="{{ route('login.submit') }}" method="POST" class="w-full flex flex-col gap-2.5 text-left" id="quickModalSignInForm">
            @csrf
            <div>
              <label class="text-[11px] font-bold text-[#1b1b21] ml-2 block mb-0.5">Email address or Admin ID</label>
              <input class="w-full h-11 px-4 rounded-full bg-[#f5f2fb] text-[#1b1b21] text-xs font-semibold placeholder:text-stone-400 focus:outline-none focus:bg-white focus:ring-2 focus:ring-[#ff6584] transition" 
                     name="email" required type="text" placeholder="you@domain.com or admin"/>
            </div>
            <div>
              <div class="flex items-center justify-between ml-2 mb-0.5">
                <label class="text-[11px] font-bold text-[#1b1b21]">Password</label>
                <a href="{{ route('password.request') }}" class="text-[11px] font-bold text-[#b0284b] hover:underline">Forgot?</a>
              </div>
              <div class="relative flex items-center">
                <input class="w-full h-11 pl-4 pr-11 rounded-full bg-[#f5f2fb] text-[#1b1b21] text-xs font-semibold placeholder:text-stone-400 focus:outline-none focus:bg-white focus:ring-2 focus:ring-[#ff6584] transition" 
                       id="quickModalPass" name="password" required type="password" placeholder="••••••••••••"/>
                <button type="button" onclick="toggleQuickPass('quickModalPass', this)" class="absolute right-3 text-[#584143] hover:text-[#b0284b] cursor-pointer">
                  <span class="material-symbols-outlined text-base">visibility</span>
                </button>
              </div>
            </div>
            <button type="submit" class="w-full h-11 mt-1 bg-gradient-to-r from-[#ff6584] via-[#fd748e] to-[#b0284b] text-white font-bold text-xs rounded-full shadow-md shadow-[#ff6584]/30 flex items-center justify-center gap-1.5 hover:brightness-105 active:scale-[0.98] transition cursor-pointer">
              <span>Sign In &amp; Meet Singles</span>
              <span class="material-symbols-outlined text-base">favorite</span>
            </button>
          </form>

          <!-- 2. Quick Register Form -->
          <form action="{{ route('register.submit') }}" method="POST" class="w-full flex-col gap-2 text-left hidden" id="quickModalRegisterForm">
            @csrf
            <div>
              <label class="text-[11px] font-bold text-[#1b1b21] ml-2 block mb-0.5">Full Name</label>
              <input class="w-full h-10 px-3.5 rounded-full bg-[#f5f2fb] text-[#1b1b21] text-xs font-semibold placeholder:text-stone-400 focus:outline-none focus:bg-white focus:ring-2 focus:ring-[#ff6584] transition" 
                     name="full_name" required placeholder="e.g. Priya Mehta" type="text"/>
            </div>
            <div>
              <label class="text-[11px] font-bold text-[#1b1b21] ml-2 block mb-0.5">Email Address</label>
              <input class="w-full h-10 px-3.5 rounded-full bg-[#f5f2fb] text-[#1b1b21] text-xs font-semibold placeholder:text-stone-400 focus:outline-none focus:bg-white focus:ring-2 focus:ring-[#ff6584] transition" 
                     name="email" required placeholder="you@domain.com" type="email"/>
            </div>
            <div>
              <label class="text-[11px] font-bold text-[#1b1b21] ml-2 block mb-0.5">Password (min 6 chars)</label>
              <input class="w-full h-10 px-3.5 rounded-full bg-[#f5f2fb] text-[#1b1b21] text-xs font-semibold placeholder:text-stone-400 focus:outline-none focus:bg-white focus:ring-2 focus:ring-[#ff6584] transition" 
                     name="password" required minlength="6" placeholder="••••••••••••" type="password"/>
            </div>
            <div class="grid grid-cols-2 gap-2">
              <div>
                <label class="text-[10px] font-bold text-[#1b1b21] ml-2 block mb-0.5">Birth Date</label>
                <input class="w-full h-10 px-2 rounded-full bg-[#f5f2fb] text-[#1b1b21] text-xs font-semibold focus:outline-none focus:bg-white focus:ring-2 focus:ring-[#ff6584] transition" 
                       name="dob" value="2000-01-01" required type="date"/>
              </div>
              <div>
                <label class="text-[10px] font-bold text-[#1b1b21] ml-2 block mb-0.5">Gender</label>
                <select class="w-full h-10 px-2 rounded-full bg-[#f5f2fb] text-[#1b1b21] text-xs font-semibold focus:outline-none focus:bg-white focus:ring-2 focus:ring-[#ff6584] transition cursor-pointer" 
                        name="gender" required>
                  <option value="female" selected>Female</option>
                  <option value="male">Male</option>
                  <option value="nonbinary">Non-Binary</option>
                  <option value="other">Other</option>
                </select>
              </div>
            </div>
            <button type="submit" class="w-full h-11 mt-1 bg-gradient-to-r from-[#ff6584] via-[#fd748e] to-[#b0284b] text-white font-bold text-xs rounded-full shadow-md shadow-[#ff6584]/30 flex items-center justify-center gap-1.5 hover:brightness-105 active:scale-[0.98] transition cursor-pointer">
              <span>Create Free Account</span>
              <span class="material-symbols-outlined text-base">auto_awesome</span>
            </button>
          </form>

          <div class="mt-3 text-[11px] text-[#584143]">
            <span>100% Selfie-Verified Members • Zero Spam</span>
          </div>

        </div>
      </div>
    </div>

    @yield('extra_js')
</body>
</html>
