<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'CupDate — Meet Verified Singles Over Coffee | India\'s Safest Dating App')</title>
    <meta name="description" content="@yield('meta_desc', 'CupDate is India\'s safest coffee dating app. 100% selfie verified singles, zero fake profiles, warm artisanal coffee aesthetic, and safe cafe date meetups.')">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@500;600;700;800&family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- FontAwesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Compiled Vite Assets (Tailwind CSS + JS) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Zero shadow enforcement & Coffee styling */
        .hairline-border { border: 1.5px solid #e5d5ca !important; }
        .coffee-border { border: 1.5px solid #8b5a2b !important; }
        
        @keyframes steamFloat {
            0%, 100% { transform: translateY(0px) scale(1); opacity: 0.9; }
            50% { transform: translateY(-7px) scale(1.03); opacity: 1; }
        }
        .animate-steam {
            animation: steamFloat 3.5s ease-in-out infinite;
        }
    </style>
    @yield('extra_css')
</head>
<body class="bg-[#fbf8f5] text-[#24140d] min-h-screen flex flex-col pb-20 md:pb-0 font-['Inter']">

    <!-- Global Top Header -->
    <header class="sticky top-0 z-50 bg-[#ffffff]/95 backdrop-blur border-b border-[#e5d5ca] px-4 md:px-8 py-3 flex items-center justify-between">
        <div class="flex items-center gap-3">
            <a href="{{ route('home') }}" class="flex items-center gap-2.5 text-decoration-none group">
                <div class="w-10 h-10 rounded-2xl bg-[#f5ede6] border border-[#e5d5ca] flex items-center justify-center text-xl text-[#8b5a2b] animate-steam">
                    <i class="fa-solid fa-mug-hot"></i>
                </div>
                <span class="font-['Plus_Jakarta_Sans'] font-extrabold text-2xl tracking-tight text-[#8b5a2b]">
                    Cup<span class="text-[#24140d]">Date</span>
                </span>
            </a>
        </div>

        <!-- Desktop Navigation & Shortcuts -->
        <nav class="hidden md:flex items-center gap-6">
            @auth
                <a href="{{ route('feed') }}" class="font-bold text-sm text-[#7d6558] hover:text-[#8b5a2b] transition flex items-center gap-1.5 {{ request()->routeIs('feed') ? 'text-[#8b5a2b]' : '' }}">
                    <i class="fa-solid fa-mug-hot"></i> Feed
                </a>
                <a href="{{ route('swipes') }}" class="font-bold text-sm text-[#7d6558] hover:text-[#8b5a2b] transition flex items-center gap-1.5 {{ request()->routeIs('swipes') ? 'text-[#8b5a2b]' : '' }}">
                    <i class="fa-solid fa-fire text-[#d97706]"></i> Swipes
                </a>
                <a href="{{ route('messages') }}" class="font-bold text-sm text-[#7d6558] hover:text-[#8b5a2b] transition flex items-center gap-1.5 {{ request()->routeIs('messages') ? 'text-[#8b5a2b]' : '' }}">
                    <i class="fa-solid fa-comments"></i> Chat
                </a>
                <a href="{{ route('video') }}" class="font-bold text-sm text-[#7d6558] hover:text-[#8b5a2b] transition flex items-center gap-1.5 {{ request()->routeIs('video') ? 'text-[#8b5a2b]' : '' }}">
                    <i class="fa-solid fa-video text-[#10b981]"></i> Live Video
                </a>
            @else
                <a href="{{ route('home') }}#matcher" class="font-bold text-sm text-[#7d6558] hover:text-[#8b5a2b] transition">
                    Coffee Matcher
                </a>
                <a href="{{ route('home') }}#cafes" class="font-bold text-sm text-[#7d6558] hover:text-[#8b5a2b] transition">
                    Partner Cafes
                </a>
                <a href="{{ route('home') }}#how-it-works" class="font-bold text-sm text-[#7d6558] hover:text-[#8b5a2b] transition">
                    How It Works
                </a>
                <a href="{{ route('home') }}#safety" class="font-bold text-sm text-[#7d6558] hover:text-[#8b5a2b] transition flex items-center gap-1">
                    <i class="fa-solid fa-shield-halved text-[#10b981]"></i> Safety
                </a>
            @endauth
            <a href="{{ route('ai.bio.generator') }}" class="font-bold text-sm text-[#7d6558] hover:text-[#8b5a2b] transition flex items-center gap-1.5 {{ request()->routeIs('ai.bio*') ? 'text-[#8b5a2b]' : '' }}">
                <i class="fa-solid fa-wand-magic-sparkles text-[#8b5a2b]"></i> AI Bio
            </a>
            <a href="{{ route('blog.index') }}" class="font-bold text-sm text-[#7d6558] hover:text-[#8b5a2b] transition flex items-center gap-1.5 {{ request()->routeIs('blog*') ? 'text-[#8b5a2b]' : '' }}">
                <i class="fa-solid fa-book-open"></i> Dating Guides
            </a>
        </nav>

        <!-- User Controls -->
        <div class="flex items-center gap-3">
            @auth
                <button onclick="openStreakModal()" class="flex items-center gap-2 bg-[#f5ede6] border border-[#e5d5ca] text-[#8b5a2b] px-3.5 py-1.5 rounded-full font-bold text-xs hover:bg-[#ebdcd0] transition cursor-pointer">
                    <i class="fa-solid fa-coins text-[#d97706]"></i>
                    <span id="headerCoinsCount">{{ Auth::user()->coins ?? 50 }}</span> Coins
                    <span class="bg-[#8b5a2b] text-white px-1.5 py-0.5 rounded-full text-[10px] ml-0.5">Streak</span>
                </button>

                <a href="{{ route('profile') }}" class="flex items-center gap-2 p-1 border border-[#e5d5ca] rounded-full hover:border-[#8b5a2b] transition" title="My Profile">
                    <img src="{{ Auth::user()->avatar_url }}" alt="Profile" class="w-8 h-8 rounded-full object-cover">
                </a>

                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="text-xs font-bold text-[#7d6558] hover:text-[#ef4444] px-2 py-1.5 transition cursor-pointer" title="Log Out">
                        <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="text-xs md:text-sm font-bold text-[#7d6558] hover:text-[#8b5a2b] px-3 py-1.5 transition">Login</a>
                <a href="{{ route('register') }}" class="text-xs md:text-sm font-bold bg-[#8b5a2b] text-white px-4 py-2 rounded-full hover:bg-[#6d421d] transition flex items-center gap-1.5">
                    <span>Join Free</span> ☕
                </a>
            @endauth
        </div>
    </header>

    <!-- Global Toast Alerts -->
    @if(session('success'))
        <div class="bg-[#f5ede6] border-b border-[#e5d5ca] px-4 py-2.5 text-center text-xs font-bold text-[#8b5a2b] flex items-center justify-center gap-2">
            <i class="fa-solid fa-circle-check text-[#10b981]"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <!-- Main Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Rich Dark Espresso & Coffee Footer -->
    <footer class="bg-[#24140d] text-[#d6c4b8] pt-16 pb-12 mt-16 font-['Inter'] border-t-2 border-[#8b5a2b]">
        <div class="max-w-6xl mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-12">
                <!-- Brand & Mission -->
                <div class="md:col-span-1 space-y-3">
                    <div class="flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-xl bg-[#8b5a2b] text-white flex items-center justify-center text-sm">
                            <i class="fa-solid fa-mug-hot"></i>
                        </div>
                        <span class="font-['Plus_Jakarta_Sans'] font-extrabold text-2xl text-[#ffffff]">Cup<span class="text-[#c8894f]">Date</span></span>
                    </div>
                    <p class="text-xs leading-relaxed text-[#b59f91]">
                        India's premier coffee dating sanctuary. Fostering unhurried, low-pressure, verified cafe meetings and safe digital boundaries.
                    </p>
                    <div class="flex items-center gap-3 pt-2 text-[#c8894f]">
                        <span class="w-8 h-8 rounded-full bg-[#341d13] border border-[#4d2c1e] flex items-center justify-center text-xs hover:text-white transition"><i class="fa-brands fa-instagram"></i></span>
                        <span class="w-8 h-8 rounded-full bg-[#341d13] border border-[#4d2c1e] flex items-center justify-center text-xs hover:text-white transition"><i class="fa-brands fa-x-twitter"></i></span>
                        <span class="w-8 h-8 rounded-full bg-[#341d13] border border-[#4d2c1e] flex items-center justify-center text-xs hover:text-white transition"><i class="fa-brands fa-linkedin"></i></span>
                    </div>
                </div>

                <!-- Core Sections -->
                <div>
                    <h4 class="font-['Plus_Jakarta_Sans'] font-extrabold text-sm text-[#ffffff] mb-3">Explore CupDate</h4>
                    <ul class="space-y-2 text-xs">
                        <li><a href="{{ route('feed') }}" class="hover:text-[#c8894f] transition">Community Coffee Feed</a></li>
                        <li><a href="{{ route('swipes') }}" class="hover:text-[#c8894f] transition">Discover Singles (Swipes)</a></li>
                        <li><a href="{{ route('messages') }}" class="hover:text-[#c8894f] transition">Messages & Coffee Invites</a></li>
                        <li><a href="{{ route('dates') }}" class="hover:text-[#c8894f] transition">Landmark Coffee Spots</a></li>
                        <li><a href="{{ route('rishta') }}" class="hover:text-[#c8894f] transition">Rishta & Matrimony</a></li>
                        <li><a href="{{ route('cities.index') }}" class="hover:text-[#c8894f] transition">Cities & Himachal Hubs</a></li>
                        <li><a href="{{ route('video') }}" class="hover:text-[#c8894f] transition">Live 1-on-1 Video Portal</a></li>
                    </ul>
                </div>

                <!-- Safety & Editorial -->
                <div>
                    <h4 class="font-['Plus_Jakarta_Sans'] font-extrabold text-sm text-[#ffffff] mb-3">Safety & Guides</h4>
                    <ul class="space-y-2 text-xs">
                        <li><a href="{{ route('safety') }}" class="hover:text-[#c8894f] text-[#34d399] font-bold transition">Women's Safety Guide 🛡️</a></li>
                        <li><a href="{{ route('ai.bio.generator') }}" class="hover:text-[#c8894f] text-[#fbbf24] font-bold transition">AI Dating Bio Generator ✨</a></li>
                        <li><a href="{{ route('coffee.date.ideas') }}" class="hover:text-[#c8894f] transition">10 Coffee Date Ideas</a></li>
                        <li><a href="{{ route('how.it.works') }}" class="hover:text-[#c8894f] transition">How It Works</a></li>
                        <li><a href="{{ route('blog.index') }}" class="hover:text-[#c8894f] transition">All Relationship Guides</a></li>
                        <li><a href="{{ route('community.guidelines') }}" class="hover:text-[#c8894f] transition">Community Guidelines</a></li>
                        <li><a href="{{ route('faq') }}" class="hover:text-[#c8894f] transition">Frequently Asked Questions</a></li>
                    </ul>
                </div>

                <!-- Legal & Trust -->
                <div>
                    <h4 class="font-['Plus_Jakarta_Sans'] font-extrabold text-sm text-[#ffffff] mb-3">Trust & Sitemaps</h4>
                    <ul class="space-y-2 text-xs">
                        <li><a href="{{ route('about') }}" class="hover:text-[#c8894f] transition">About CupDate</a></li>
                        <li><a href="{{ route('privacy') }}" class="hover:text-[#c8894f] transition">Privacy Policy (DPDP Act)</a></li>
                        <li><a href="{{ route('terms') }}" class="hover:text-[#c8894f] transition">Terms of Service</a></li>
                        <li><a href="{{ route('disclaimer') }}" class="hover:text-[#c8894f] transition">Website Disclaimer</a></li>
                        <li><a href="{{ route('cookie.policy') }}" class="hover:text-[#c8894f] transition">Cookie Policy</a></li>
                        <li><a href="{{ route('contact') }}" class="hover:text-[#c8894f] transition">Contact & Grievance Officer</a></li>
                        <li><a href="{{ route('sitemap.xml') }}" target="_blank" class="hover:text-[#c8894f] transition flex items-center gap-1"><i class="fa-solid fa-code text-[10px]"></i> XML Sitemap</a></li>
                        <li><a href="{{ route('sitemap.html') }}" class="hover:text-[#c8894f] transition flex items-center gap-1"><i class="fa-solid fa-sitemap text-[10px]"></i> HTML Sitemap</a></li>
                    </ul>
                </div>
            </div>

            <div class="pt-8 border-t border-[#3e2216] flex flex-col sm:flex-row items-center justify-between text-xs text-[#9d897c] gap-4">
                <p>© 2026 CupDate.in. All rights reserved. Handcrafted with authentic coffee passion for meaningful Indian dating.</p>
                <div class="flex items-center gap-4 text-[11px]">
                    <span class="inline-flex items-center gap-1 text-[#34d399] font-bold">
                        <i class="fa-solid fa-circle-check"></i> 100% Selfie Verified
                    </span>
                    <span>•</span>
                    <span class="inline-flex items-center gap-1 text-[#c8894f] font-bold">
                        <i class="fa-solid fa-shield-halved"></i> 256-Bit SSL Encrypted
                    </span>
                </div>
            </div>
        </div>
    </footer>

    <!-- Mobile Bottom Navigation (Exact 4 Core Tabs) -->
    <nav class="md:hidden cupdate-bottom-nav">
        <a href="{{ route('feed') }}" class="bottom-tab-item {{ request()->routeIs('feed') ? 'active' : '' }}">
            <i class="fa-solid fa-mug-hot"></i>
            <span>Feed</span>
        </a>
        <a href="{{ route('swipes') }}" class="bottom-tab-item {{ request()->routeIs('swipes') ? 'active' : '' }}">
            <i class="fa-solid fa-fire"></i>
            <span>Swipes</span>
        </a>
        <a href="{{ route('messages') }}" class="bottom-tab-item {{ request()->routeIs('messages') ? 'active' : '' }}">
            <i class="fa-solid fa-comments"></i>
            <span>Chat</span>
        </a>
        <a href="{{ route('profile') }}" class="bottom-tab-item {{ request()->routeIs('profile*') ? 'active' : '' }}">
            <i class="fa-solid fa-user"></i>
            <span>Profile</span>
        </a>
    </nav>

    <!-- 7-Day Streak & Profile Boost Modal -->
    <div id="streakModal" class="custom-modal-backdrop">
        <div class="custom-modal-card">
            <button onclick="closeStreakModal()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 text-lg cursor-pointer">
                <i class="fa-solid fa-xmark"></i>
            </button>
            <div class="text-center mb-5">
                <span class="inline-flex items-center gap-1.5 bg-[#f5ede6] text-[#8b5a2b] border border-[#e5d5ca] px-3.5 py-1 rounded-full text-xs font-bold uppercase tracking-wider mb-2">
                    <i class="fa-solid fa-fire text-[#d97706]"></i> Daily Login Reward
                </span>
                <h3 class="font-['Plus_Jakarta_Sans'] font-extrabold text-xl text-[#24140d]">7-Day Coffee Bean Streak</h3>
                <p class="text-xs text-[#7d6558] mt-1">Log in daily to claim bonus coins and supercharge your dating profile visibility!</p>
            </div>

            <!-- 7-Day Roadmap Grid -->
            <div class="grid grid-cols-7 gap-1.5 mb-6 text-center">
                @php $streakRewards = [1=>10, 2=>15, 3=>20, 4=>25, 5=>35, 6=>50, 7=>100]; @endphp
                @foreach($streakRewards as $day => $coins)
                    <div class="p-2 rounded-xl border border-[#e5d5ca] bg-[#fbf8f5] flex flex-col items-center">
                        <span class="text-[10px] font-bold text-[#7d6558]">D{{ $day }}</span>
                        <i class="fa-solid fa-coins text-[#d97706] my-1 text-sm"></i>
                        <span class="text-xs font-extrabold text-[#8b5a2b]">+{{ $coins }}</span>
                    </div>
                @endforeach
            </div>

            <!-- Claim Button -->
            <button id="claimStreakBtn" onclick="handleClaimStreak()" class="w-full py-3 bg-[#8b5a2b] text-white font-extrabold rounded-xl hover:bg-[#6d421d] transition cursor-pointer mb-3">
                <i class="fa-solid fa-gift mr-1"></i> Claim Today's Coffee Coins
            </button>

            <!-- 24h Profile Boost Option -->
            <div class="pt-4 border-t border-[#e5d5ca] flex items-center justify-between">
                <div>
                    <strong class="text-sm font-bold text-[#24140d] block">Boost Profile for 24h</strong>
                    <span class="text-xs text-[#7d6558]">Appear 10x more frequently in Swipes</span>
                </div>
                <button onclick="handleBoostProfile()" class="px-3.5 py-2 bg-[#f5ede6] border border-[#e5d5ca] text-[#8b5a2b] rounded-xl font-bold text-xs hover:bg-[#ebdcd0] transition cursor-pointer">
                    <i class="fa-solid fa-bolt mr-1 text-[#d97706]"></i> Boost (50 Coins)
                </button>
            </div>
            <div id="streakModalFeedback" class="mt-3 text-center text-xs font-bold text-[#8b5a2b]"></div>
        </div>
    </div>

    <!-- Global JavaScript for Streak and Boost AJAX -->
    <script>
        function openStreakModal() {
            document.getElementById('streakModal').classList.add('active');
        }
        function closeStreakModal() {
            document.getElementById('streakModal').classList.remove('active');
        }

        async function handleClaimStreak() {
            const btn = document.getElementById('claimStreakBtn');
            const feedback = document.getElementById('streakModalFeedback');
            btn.disabled = true;
            btn.innerText = 'Claiming...';

            try {
                const response = await fetch("{{ route('api.streak.claim') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                });
                const data = await response.json();
                feedback.innerText = data.message;
                if (data.coins !== undefined) {
                    const coinDisplay = document.getElementById('headerCoinsCount');
                    if (coinDisplay) coinDisplay.innerText = data.coins;
                }
                btn.innerText = "Claimed Today ✓";
            } catch (err) {
                feedback.innerText = "Error claiming reward. Please try again.";
                btn.disabled = false;
                btn.innerText = "Claim Today's Coffee Coins";
            }
        }

        async function handleBoostProfile() {
            const feedback = document.getElementById('streakModalFeedback');
            feedback.innerText = "Activating Profile Boost...";

            try {
                const response = await fetch("{{ route('api.profile.boost') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                });
                const data = await response.json();
                feedback.innerText = data.message;
                if (data.coins !== undefined) {
                    const coinDisplay = document.getElementById('headerCoinsCount');
                    if (coinDisplay) coinDisplay.innerText = data.coins;
                }
            } catch (err) {
                feedback.innerText = "Error activating boost.";
            }
        }
    </script>
    @yield('extra_js')
</body>
</html>
