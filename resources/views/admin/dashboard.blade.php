@extends('layouts.app')

@section('title', 'SaaS Admin Command Center & Analytics — CupDate')

@section('content')
<div class="min-h-screen bg-[#0b0f19] text-[#f1f5f9] font-['Plus_Jakarta_Sans',sans-serif] pb-16">

    <!-- TOP SAAS COMMAND BAR -->
    <header class="border-b border-[#1e293b] bg-[#0f172a]/90 backdrop-blur-md sticky top-16 z-30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
            
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-2xl bg-gradient-to-tr from-[#b0284b] to-[#ff6584] flex items-center justify-center text-white shadow-lg shadow-[#b0284b]/20">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                </div>
                <div>
                    <div class="flex items-center gap-2">
                        <h1 class="text-lg font-black tracking-tight text-white">CupDate SaaS Command Center</h1>
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[10px] font-mono font-bold bg-emerald-950/80 text-emerald-400 border border-emerald-800/60">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-ping"></span>
                            <span>SECURE LIVE</span>
                        </span>
                    </div>
                    <p class="text-xs text-[#94a3b8]">Live system telemetries, member clearance, and real-time security management.</p>
                </div>
            </div>

            <!-- Quick Action Suite -->
            <div class="flex items-center gap-2 flex-wrap">
                <a href="{{ route('admin.blogs') }}" class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl bg-[#1e293b] hover:bg-[#334155] text-white text-xs font-bold border border-[#334155] transition">
                    <svg class="w-4 h-4 text-[#ff6584]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    <span>Blog Publisher</span>
                </a>

                <a href="{{ route('home') }}" target="_blank" class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl bg-[#1e293b] hover:bg-[#334155] text-white text-xs font-bold border border-[#334155] transition">
                    <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    <span>View Live Site</span>
                </a>

                <form action="{{ route('admin.analytics.clear') }}" method="POST" onsubmit="return confirm('Reset all page view traffic records? This action cannot be undone.');" class="inline">
                    @csrf
                    <button type="submit" class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl bg-[#1e293b] hover:bg-amber-950/60 text-amber-300 text-xs font-bold border border-[#334155] hover:border-amber-700/60 transition cursor-pointer">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        <span>Reset Analytics</span>
                    </button>
                </form>

                <form action="{{ route('admin.logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl bg-rose-950/80 hover:bg-rose-900 text-rose-300 text-xs font-bold border border-rose-800/60 transition cursor-pointer">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        <span>Sign Out</span>
                    </button>
                </form>
            </div>
        </div>
    </header>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-8 space-y-6">

        <!-- System Alerts -->
        @if(session('success'))
            <div class="p-4 rounded-2xl bg-emerald-950/80 border border-emerald-600/40 text-emerald-200 text-xs font-bold flex items-center gap-3">
                <svg class="w-5 h-5 text-emerald-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span>{{ session('success') }}</span>
            </div>
        @elseif(session('error'))
            <div class="p-4 rounded-2xl bg-rose-950/80 border border-rose-600/40 text-rose-200 text-xs font-bold flex items-center gap-3">
                <svg class="w-5 h-5 text-rose-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        <!-- TOP KPI METRIC CARDS (4-Column Modern SaaS Deck) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            
            <!-- Card 1: Total Traffic -->
            <div class="p-5 rounded-2xl bg-[#111827] border border-[#1f2937] shadow-sm relative overflow-hidden group hover:border-[#374151] transition">
                <div class="flex items-center justify-between text-[#94a3b8] mb-2">
                    <span class="text-xs font-bold uppercase tracking-wider">Total Page Views</span>
                    <span class="w-8 h-8 rounded-lg bg-indigo-950 text-indigo-400 flex items-center justify-center font-bold text-xs">📊</span>
                </div>
                <div class="text-3xl font-black text-white font-mono">{{ number_format($totalViews) }}</div>
                <div class="mt-2 text-xs font-semibold text-emerald-400 flex items-center gap-1">
                    <span>↑ +{{ number_format($viewsToday) }} views today</span>
                </div>
            </div>

            <!-- Card 2: Unique IP Visitors -->
            <div class="p-5 rounded-2xl bg-[#111827] border border-[#1f2937] shadow-sm relative overflow-hidden group hover:border-[#374151] transition">
                <div class="flex items-center justify-between text-[#94a3b8] mb-2">
                    <span class="text-xs font-bold uppercase tracking-wider">Unique IPs</span>
                    <span class="w-8 h-8 rounded-lg bg-blue-950 text-blue-400 flex items-center justify-center font-bold text-xs">🌐</span>
                </div>
                <div class="text-3xl font-black text-white font-mono">{{ number_format($uniqueVisitors) }}</div>
                <div class="mt-2 text-xs font-semibold text-blue-400 flex items-center gap-1">
                    <span>{{ number_format($uniqueToday) }} distinct visitors today</span>
                </div>
            </div>

            <!-- Card 3: Active Now -->
            <div class="p-5 rounded-2xl bg-[#111827] border border-emerald-900/60 shadow-sm relative overflow-hidden group hover:border-emerald-700/60 transition">
                <div class="flex items-center justify-between text-emerald-400 mb-2">
                    <span class="text-xs font-bold uppercase tracking-wider">Active Right Now</span>
                    <span class="relative flex h-2.5 w-2.5">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-emerald-500"></span>
                    </span>
                </div>
                <div class="text-3xl font-black text-emerald-400 font-mono flex items-baseline gap-2">
                    <span>{{ max(1, $activeNow) }}</span>
                    <span class="text-xs font-bold text-emerald-500 uppercase">Live</span>
                </div>
                <div class="mt-2 text-xs font-semibold text-[#94a3b8]">
                    <span>Active in last 15 minutes</span>
                </div>
            </div>

            <!-- Card 4: Registered Members -->
            <div class="p-5 rounded-2xl bg-[#111827] border border-[#1f2937] shadow-sm relative overflow-hidden group hover:border-[#374151] transition">
                <div class="flex items-center justify-between text-[#94a3b8] mb-2">
                    <span class="text-xs font-bold uppercase tracking-wider">Total Members</span>
                    <span class="w-8 h-8 rounded-lg bg-pink-950 text-[#ff6584] flex items-center justify-center font-bold text-xs">👥</span>
                </div>
                <div class="text-3xl font-black text-white font-mono">{{ number_format($totalUsers) }}</div>
                <div class="mt-2 text-xs font-semibold text-[#ff6584] flex items-center gap-1">
                    <span>✓ {{ number_format($verifiedUsers) }} verified singles</span>
                </div>
            </div>
        </div>

        <!-- SAAS TABS NAVIGATION -->
        <div class="border-b border-[#1e293b] flex items-center gap-2 overflow-x-auto pb-1">
            <button type="button" onclick="switchAdminTab('overview')" id="tabBtnOverview" class="admin-tab-btn px-4 py-2.5 rounded-xl font-bold text-xs flex items-center gap-2 transition cursor-pointer bg-[#1e293b] text-white shadow-xs">
                <span>📊</span>
                <span>Overview &amp; Trends</span>
            </button>
            <button type="button" onclick="switchAdminTab('members')" id="tabBtnMembers" class="admin-tab-btn px-4 py-2.5 rounded-xl font-bold text-xs flex items-center gap-2 transition cursor-pointer text-[#94a3b8] hover:text-white hover:bg-[#1e293b]/50">
                <span>👥</span>
                <span>Member Management</span>
                <span class="text-[10px] bg-[#334155] px-2 py-0.5 rounded-full text-white">{{ $totalUsers }}</span>
            </button>
            <button type="button" onclick="switchAdminTab('visitors')" id="tabBtnVisitors" class="admin-tab-btn px-4 py-2.5 rounded-xl font-bold text-xs flex items-center gap-2 transition cursor-pointer text-[#94a3b8] hover:text-white hover:bg-[#1e293b]/50">
                <span>📡</span>
                <span>Live Visitor Stream</span>
                <span class="text-[10px] bg-emerald-950 text-emerald-400 border border-emerald-800 px-2 py-0.5 rounded-full">{{ $recentVisitors->count() }}</span>
            </button>
            <button type="button" onclick="switchAdminTab('content')" id="tabBtnContent" class="admin-tab-btn px-4 py-2.5 rounded-xl font-bold text-xs flex items-center gap-2 transition cursor-pointer text-[#94a3b8] hover:text-white hover:bg-[#1e293b]/50">
                <span>💬</span>
                <span>Chat &amp; Feed Oversight</span>
                <span class="text-[10px] bg-[#334155] px-2 py-0.5 rounded-full text-white">{{ $messages->count() }}</span>
            </button>
            <button type="button" onclick="switchAdminTab('security')" id="tabBtnSecurity" class="admin-tab-btn px-4 py-2.5 rounded-xl font-bold text-xs flex items-center gap-2 transition cursor-pointer text-[#94a3b8] hover:text-white hover:bg-[#1e293b]/50">
                <span>🛡️</span>
                <span>System &amp; Security</span>
            </button>
        </div>

        <!-- ============================================== -->
        <!-- TAB 1: OVERVIEW & TRENDS -->
        <!-- ============================================== -->
        <div id="tabContentOverview" class="space-y-6">
            
            <!-- 7-Day Trend Chart & Traffic Ratios -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- 7-Day Page Views Trend -->
                <div class="lg:col-span-2 p-6 rounded-2xl bg-[#111827] border border-[#1f2937]">
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <h3 class="text-sm font-bold text-white uppercase tracking-wider">7-Day Traffic Velocity</h3>
                            <p class="text-xs text-[#94a3b8]">Daily aggregated page impressions</p>
                        </div>
                        <span class="text-xs font-mono font-bold text-emerald-400 bg-emerald-950/60 border border-emerald-800/60 px-2.5 py-1 rounded-lg">Real-Time</span>
                    </div>

                    @php
                        $maxCount = $dailyTrends->max('count') ?: 1;
                    @endphp
                    <div class="flex items-end justify-between gap-3 h-44 pt-6">
                        @foreach($dailyTrends as $trend)
                            @php
                                $heightPct = max(12, round(($trend['count'] / $maxCount) * 100));
                            @endphp
                            <div class="flex-1 flex flex-col items-center gap-2 group relative">
                                <div class="w-full bg-[#1e293b] group-hover:bg-[#b0284b] transition-all rounded-t-lg relative" style="height: {{ $heightPct }}%">
                                    <div class="absolute -top-7 left-1/2 -translate-x-1/2 hidden group-hover:block bg-[#0f172a] text-white border border-[#334155] text-[10px] px-2 py-1 rounded shadow-lg z-20 whitespace-nowrap font-mono">
                                        {{ $trend['count'] }} hits
                                    </div>
                                </div>
                                <span class="text-[10px] text-[#94a3b8] font-mono">{{ $trend['label'] }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Device & Browser Distribution -->
                <div class="p-6 rounded-2xl bg-[#111827] border border-[#1f2937] space-y-4">
                    <div>
                        <h3 class="text-sm font-bold text-white uppercase tracking-wider">Device &amp; Client Telemetry</h3>
                        <p class="text-xs text-[#94a3b8]">Live client user-agent distribution</p>
                    </div>

                    @php
                        $totalDeviceHits = max(1, ($deviceBreakdown['mobile'] ?? 0) + ($deviceBreakdown['desktop'] ?? 0));
                        $mobilePct = round((($deviceBreakdown['mobile'] ?? 0) / $totalDeviceHits) * 100);
                        $desktopPct = 100 - $mobilePct;
                    @endphp

                    <!-- Progress Bar -->
                    <div class="space-y-1.5">
                        <div class="flex justify-between text-xs font-bold">
                            <span class="text-pink-400">📱 Mobile: {{ $mobilePct }}%</span>
                            <span class="text-blue-400">💻 Desktop: {{ $desktopPct }}%</span>
                        </div>
                        <div class="w-full h-3 rounded-full bg-[#1e293b] flex overflow-hidden">
                            <div class="bg-gradient-to-r from-pink-500 to-[#b0284b]" style="width: {{ $mobilePct }}%"></div>
                            <div class="bg-gradient-to-r from-blue-500 to-indigo-500" style="width: {{ $desktopPct }}%"></div>
                        </div>
                    </div>

                    <!-- Browser Badges -->
                    <div class="pt-3 border-t border-[#1f2937] space-y-2">
                        <span class="text-[11px] font-bold text-[#94a3b8] uppercase tracking-wider block">Top Web Browsers:</span>
                        <div class="grid grid-cols-2 gap-2 text-xs">
                            <div class="p-2 rounded-xl bg-[#1e293b] flex items-center justify-between">
                                <span class="text-[#cbd5e1]">Chrome</span>
                                <span class="font-mono font-bold text-amber-400">{{ $browserBreakdown['chrome'] ?? 0 }}</span>
                            </div>
                            <div class="p-2 rounded-xl bg-[#1e293b] flex items-center justify-between">
                                <span class="text-[#cbd5e1]">Safari</span>
                                <span class="font-mono font-bold text-blue-400">{{ $browserBreakdown['safari'] ?? 0 }}</span>
                            </div>
                            <div class="p-2 rounded-xl bg-[#1e293b] flex items-center justify-between">
                                <span class="text-[#cbd5e1]">Edge</span>
                                <span class="font-mono font-bold text-cyan-400">{{ $browserBreakdown['edge'] ?? 0 }}</span>
                            </div>
                            <div class="p-2 rounded-xl bg-[#1e293b] flex items-center justify-between">
                                <span class="text-[#cbd5e1]">Firefox</span>
                                <span class="font-mono font-bold text-orange-400">{{ $browserBreakdown['firefox'] ?? 0 }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Top Viewed URLs -->
            <div class="p-6 rounded-2xl bg-[#111827] border border-[#1f2937]">
                <div class="flex items-center justify-between pb-3 border-b border-[#1f2937] mb-4">
                    <div>
                        <h3 class="text-sm font-bold text-white uppercase tracking-wider">Top Visited Landing Pages</h3>
                        <p class="text-xs text-[#94a3b8]">Live distribution of page engagement across CupDate</p>
                    </div>
                    <span class="text-xs font-mono font-bold text-[#94a3b8]">Hits / Unique IPs</span>
                </div>

                @if($viewsPerPage->isEmpty())
                    <div class="py-8 text-center text-xs text-[#64748b]">
                        No traffic logged yet. Visit pages on the public site to record analytics.
                    </div>
                @else
                    <div class="space-y-3">
                        @foreach($viewsPerPage as $page)
                            @php
                                $percent = $totalViews > 0 ? round(($page->total / $totalViews) * 100, 1) : 0;
                            @endphp
                            <div>
                                <div class="flex items-center justify-between text-xs font-semibold mb-1">
                                    <a href="{{ $page->url }}" target="_blank" class="font-mono text-white hover:text-[#ff6584] truncate max-w-md">
                                        {{ $page->url }}
                                    </a>
                                    <div class="flex items-center gap-2 shrink-0">
                                        <span class="font-mono font-bold text-[#ff6584]">{{ number_format($page->total) }} views</span>
                                        <span class="text-[10px] text-[#64748b] font-mono">({{ number_format($page->uniques) }} IPs)</span>
                                    </div>
                                </div>
                                <div class="w-full bg-[#1e293b] h-1.5 rounded-full overflow-hidden">
                                    <div class="bg-gradient-to-r from-[#b0284b] to-[#ff6584] h-1.5 rounded-full" style="width: {{ max(4, $percent) }}%"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        <!-- ============================================== -->
        <!-- TAB 2: MEMBER DIRECTORY & MODERATION -->
        <!-- ============================================== -->
        <div id="tabContentMembers" class="hidden space-y-4">
            <div class="p-6 rounded-2xl bg-[#111827] border border-[#1f2937]">
                
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pb-4 border-b border-[#1f2937] mb-4">
                    <div>
                        <h2 class="text-base font-bold text-white">Registered Singles Directory</h2>
                        <p class="text-xs text-[#94a3b8]">Verify selfie authenticity, grant bonus coins, or restrict accounts.</p>
                    </div>

                    <!-- Member Search Filter -->
                    <input type="text" id="memberSearchInput" onkeyup="filterMembersTable()" placeholder="Search by name, email, or city..." class="px-3.5 py-1.5 rounded-xl bg-[#1e293b] border border-[#334155] text-xs text-white placeholder-[#64748b] focus:outline-none focus:border-[#ff6584] w-64"/>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs" id="membersTable">
                        <thead class="bg-[#1e293b] text-[#94a3b8] uppercase text-[10px] font-bold">
                            <tr>
                                <th class="py-3 px-3 rounded-l-xl">Member</th>
                                <th class="py-3 px-3">Email Address</th>
                                <th class="py-3 px-3">Location</th>
                                <th class="py-3 px-3">Coins</th>
                                <th class="py-3 px-3">Status</th>
                                <th class="py-3 px-3">Selfie Verification</th>
                                <th class="py-3 px-3 text-right rounded-r-xl">Clearance Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#1f2937]">
                            @forelse($users as $u)
                                <tr class="hover:bg-[#1e293b]/40 transition member-row">
                                    <td class="py-3 px-3 flex items-center gap-3">
                                        <img src="{{ $u->avatar_url }}" class="w-8 h-8 rounded-full object-cover ring-1 ring-[#334155]" alt="{{ $u->full_name }}"/>
                                        <div>
                                            <p class="font-bold text-white member-name">{{ $u->full_name }}</p>
                                            <p class="text-[10px] font-mono text-[#64748b]">{{ $u->member_code ?? 'CD-' . $u->id }}</p>
                                        </div>
                                    </td>
                                    <td class="py-3 px-3 font-mono text-[#cbd5e1] member-email">{{ $u->email }}</td>
                                    <td class="py-3 px-3 text-[#94a3b8] member-city">{{ $u->country ?? 'India' }}</td>
                                    <td class="py-3 px-3 font-mono font-bold text-amber-400">🪙 {{ number_format($u->coins ?? 0) }}</td>
                                    <td class="py-3 px-3">
                                        @if($u->status === 'blocked')
                                            <span class="inline-flex items-center gap-1 font-bold text-rose-400 bg-rose-950/80 px-2.5 py-0.5 rounded-full border border-rose-800 text-[10px]">
                                                🚫 Blocked
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1 font-bold text-emerald-400 bg-emerald-950/80 px-2.5 py-0.5 rounded-full border border-emerald-800 text-[10px]">
                                                ✓ Active
                                            </span>
                                        @endif
                                    </td>
                                    <td class="py-3 px-3">
                                        @if($u->is_verified)
                                            <span class="inline-flex items-center gap-1 font-bold text-emerald-400 bg-emerald-950/80 px-2.5 py-0.5 rounded-full border border-emerald-800 text-[10px]">
                                                ✓ Verified
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1 font-semibold text-[#94a3b8] bg-[#1e293b] px-2.5 py-0.5 rounded-full text-[10px]">
                                                Pending
                                            </span>
                                        @endif
                                    </td>
                                    <td class="py-3 px-3 text-right space-x-1.5 whitespace-nowrap">
                                        <!-- Verification Toggle -->
                                        <form action="{{ route('admin.user.verify', $u->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="px-2.5 py-1 rounded-full text-[11px] font-bold border transition cursor-pointer {{ $u->is_verified ? 'bg-[#1e293b] text-[#cbd5e1] border-[#334155] hover:bg-[#334155]' : 'bg-emerald-600 text-white border-emerald-500 hover:bg-emerald-500' }}">
                                                {{ $u->is_verified ? 'Unverify' : 'Verify' }}
                                            </button>
                                        </form>

                                        <!-- Block / Unblock Toggle -->
                                        <form action="{{ route('admin.user.block', $u->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to {{ $u->status === 'blocked' ? 'unblock' : 'block' }} this user?');">
                                            @csrf
                                            <button type="submit" class="px-2.5 py-1 rounded-full text-[11px] font-bold border transition cursor-pointer {{ $u->status === 'blocked' ? 'bg-emerald-950 text-emerald-400 border-emerald-800 hover:bg-emerald-900' : 'bg-rose-950 text-rose-300 border-rose-800 hover:bg-rose-900' }}">
                                                {{ $u->status === 'blocked' ? 'Unblock' : 'Block' }}
                                            </button>
                                        </form>

                                        <!-- Bonus Coins -->
                                        <form action="{{ route('admin.user.coins', $u->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="px-2.5 py-1 rounded-full text-[11px] font-bold bg-amber-950/80 hover:bg-amber-900 text-amber-300 border border-amber-800 transition cursor-pointer">
                                                +100 Coins
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="py-8 text-center text-[#64748b]">No members registered yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- ============================================== -->
        <!-- TAB 3: LIVE VISITOR STREAM & IP LOGS -->
        <!-- ============================================== -->
        <div id="tabContentVisitors" class="hidden space-y-4">
            <div class="p-6 rounded-2xl bg-[#111827] border border-[#1f2937]">
                
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pb-4 border-b border-[#1f2937] mb-4">
                    <div class="flex items-center gap-2">
                        <span class="w-2.5 h-2.5 rounded-full bg-emerald-400 animate-pulse"></span>
                        <h2 class="text-base font-bold text-white">Live Visitor Stream &amp; IP Telemetry</h2>
                    </div>

                    <!-- Filter by IP -->
                    <form action="{{ route('admin.dashboard') }}" method="GET" class="flex items-center gap-2">
                        <input type="text" name="ip" value="{{ $searchIp }}" placeholder="Filter by IP..." class="px-3 py-1.5 rounded-xl bg-[#1e293b] border border-[#334155] text-xs text-white placeholder-[#64748b] focus:outline-none focus:border-[#ff6584] w-40"/>
                        <button type="submit" class="px-3 py-1.5 rounded-xl bg-[#b0284b] hover:bg-[#97223f] text-white text-xs font-bold transition">Filter</button>
                        @if($searchIp)
                            <a href="{{ route('admin.dashboard') }}" class="text-xs text-[#94a3b8] hover:text-white underline">Clear</a>
                        @endif
                    </form>
                </div>

                @if($recentVisitors->isEmpty())
                    <div class="py-12 text-center text-xs text-[#64748b]">
                        No visitor telemetry logged yet.
                    </div>
                @else
                    <div class="overflow-x-auto max-h-[550px] overflow-y-auto">
                        <table class="w-full text-left text-xs">
                            <thead class="bg-[#1e293b] text-[#94a3b8] uppercase text-[10px] font-bold sticky top-0">
                                <tr>
                                    <th class="py-2.5 px-3 rounded-l-xl">Client IP</th>
                                    <th class="py-2.5 px-3">Visited URL</th>
                                    <th class="py-2.5 px-3">Identity</th>
                                    <th class="py-2.5 px-3">Client UA</th>
                                    <th class="py-2.5 px-3 rounded-r-xl">Timestamp</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-[#1f2937]">
                                @foreach($recentVisitors as $visit)
                                    <tr class="hover:bg-[#1e293b]/40 transition">
                                        <td class="py-3 px-3 font-mono font-bold text-[#ff6584]">
                                            <div class="flex items-center gap-1.5 flex-wrap">
                                                <a href="https://ipinfo.io/{{ $visit->ip_address }}" target="_blank" class="hover:underline" title="Lookup IP Geo">
                                                    {{ $visit->ip_address }}
                                                </a>
                                                <span class="text-[10px] font-bold px-1.5 py-0.5 rounded-full bg-amber-950 text-amber-300 border border-amber-800">
                                                    {{ $visit->total_hits ?? 1 }} hits
                                                </span>
                                            </div>
                                        </td>
                                        <td class="py-3 px-3 max-w-[180px] truncate font-mono text-[#cbd5e1]" title="{{ $visit->url }}">
                                            <span class="text-[10px] uppercase font-bold text-[#64748b] mr-1">{{ $visit->method }}</span>
                                            {{ $visit->url }}
                                        </td>
                                        <td class="py-3 px-3 whitespace-nowrap">
                                            @if($visit->user_name)
                                                <span class="font-bold text-emerald-300 bg-emerald-950/80 px-2 py-0.5 rounded-full border border-emerald-800">{{ $visit->user_name }}</span>
                                            @else
                                                <span class="text-[#64748b]">Guest</span>
                                            @endif
                                        </td>
                                        <td class="py-3 px-3 max-w-[160px] truncate text-[#94a3b8] text-[11px]" title="{{ $visit->user_agent }}">
                                            @if(str_contains(strtolower($visit->user_agent), 'mobile') || str_contains(strtolower($visit->user_agent), 'android') || str_contains(strtolower($visit->user_agent), 'iphone'))
                                                📱 Mobile
                                            @else
                                                💻 Desktop
                                            @endif
                                            · {{ Str::limit($visit->user_agent, 22) }}
                                        </td>
                                        <td class="py-3 px-3 whitespace-nowrap text-[#64748b] text-[11px]">
                                            {{ \Carbon\Carbon::parse($visit->created_at)->diffForHumans() }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>

        <!-- ============================================== -->
        <!-- TAB 4: CHAT & CONTENT OVERSIGHT -->
        <!-- ============================================== -->
        <div id="tabContentContent" class="hidden space-y-6">
            
            <!-- Chat Messages Table -->
            <div class="p-6 rounded-2xl bg-[#111827] border border-[#1f2937]">
                <div class="flex items-center justify-between pb-3 border-b border-[#1f2937] mb-4">
                    <div>
                        <h2 class="text-base font-bold text-white">Live Member Chat &amp; Messages Moderation</h2>
                        <p class="text-xs text-[#94a3b8]">Review conversations and remove spam or abusive language.</p>
                    </div>
                    <span class="text-xs text-[#64748b] font-mono">{{ $messages->count() }} recent messages</span>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs">
                        <thead class="bg-[#1e293b] text-[#94a3b8] uppercase text-[10px] font-bold">
                            <tr>
                                <th class="py-3 px-3 rounded-l-xl">Sender</th>
                                <th class="py-3 px-3">Receiver</th>
                                <th class="py-3 px-3">Message Body</th>
                                <th class="py-3 px-3">Time</th>
                                <th class="py-3 px-3 text-right rounded-r-xl">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#1f2937]">
                            @forelse($messages as $msg)
                                <tr class="hover:bg-[#1e293b]/40 transition">
                                    <td class="py-3 px-3 font-bold text-white">
                                        {{ $msg->sender->full_name ?? 'User #' . $msg->sender_id }}
                                    </td>
                                    <td class="py-3 px-3 font-bold text-[#94a3b8]">
                                        {{ $msg->receiver->full_name ?? 'User #' . $msg->receiver_id }}
                                    </td>
                                    <td class="py-3 px-3 max-w-md text-[#cbd5e1]">
                                        <p class="truncate">{{ $msg->body ?? $msg->message ?? '(Photo attachment)' }}</p>
                                    </td>
                                    <td class="py-3 px-3 text-[#64748b] whitespace-nowrap">
                                        {{ \Carbon\Carbon::parse($msg->created_at)->diffForHumans() }}
                                    </td>
                                    <td class="py-3 px-3 text-right whitespace-nowrap">
                                        <form action="{{ route('admin.message.delete', $msg->id) }}" method="POST" class="inline" onsubmit="return confirm('Delete this message permanently?');">
                                            @csrf
                                            <button type="submit" class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-rose-950 text-rose-300 border border-rose-800 hover:bg-rose-900 transition cursor-pointer">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-8 text-center text-[#64748b]">No active chat messages recorded yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Community Ideas Moderation -->
            <div class="p-6 rounded-2xl bg-[#111827] border border-[#1f2937]">
                <div class="flex items-center justify-between pb-3 border-b border-[#1f2937] mb-4">
                    <div>
                        <h2 class="text-base font-bold text-white">Coffee Sparks &amp; Feed Ideas</h2>
                        <p class="text-xs text-[#94a3b8]">Public date suggestions posted to the coffee feed.</p>
                    </div>
                    <span class="text-xs text-[#64748b] font-mono">{{ $ideas->count() }} active sparks</span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    @forelse($ideas as $idea)
                        <div class="p-3.5 rounded-xl bg-[#1e293b] border border-[#334155] flex items-start justify-between gap-3">
                            <div>
                                <p class="text-xs font-bold text-white">{{ $idea->content }}</p>
                                <p class="text-[10px] text-[#94a3b8] mt-1">
                                    Posted by <strong>{{ $idea->user->full_name ?? 'Anonymous' }}</strong> · {{ \Carbon\Carbon::parse($idea->created_at)->diffForHumans() }}
                                </p>
                            </div>
                            <form action="{{ route('admin.idea.delete', $idea->id) }}" method="POST" onsubmit="return confirm('Delete this feed spark?');">
                                @csrf
                                <button type="submit" class="px-2 py-1 rounded-lg text-[10px] font-bold bg-rose-950 text-rose-300 border border-rose-800 hover:bg-rose-900 transition cursor-pointer">
                                    Remove
                                </button>
                            </form>
                        </div>
                    @empty
                        <div class="col-span-2 py-6 text-center text-xs text-[#64748b]">No community ideas posted yet.</div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- ============================================== -->
        <!-- TAB 5: SYSTEM & SECURITY -->
        <!-- ============================================== -->
        <div id="tabContentSecurity" class="hidden space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <!-- System Health -->
                <div class="p-6 rounded-2xl bg-[#111827] border border-[#1f2937] space-y-4">
                    <h3 class="text-sm font-bold text-white uppercase tracking-wider">System Architecture &amp; Database Health</h3>
                    <div class="space-y-3 text-xs">
                        <div class="flex items-center justify-between p-3 rounded-xl bg-[#1e293b]">
                            <span class="text-[#94a3b8]">Database Engine:</span>
                            <span class="font-mono font-bold text-emerald-400">MySQL (cupdate_1_cupcup)</span>
                        </div>
                        <div class="flex items-center justify-between p-3 rounded-xl bg-[#1e293b]">
                            <span class="text-[#94a3b8]">Application Environment:</span>
                            <span class="font-mono font-bold text-blue-400">{{ config('app.env') }}</span>
                        </div>
                        <div class="flex items-center justify-between p-3 rounded-xl bg-[#1e293b]">
                            <span class="text-[#94a3b8]">PHP Engine Version:</span>
                            <span class="font-mono font-bold text-white">{{ phpversion() }}</span>
                        </div>
                        <div class="flex items-center justify-between p-3 rounded-xl bg-[#1e293b]">
                            <span class="text-[#94a3b8]">Encryption Key Cipher:</span>
                            <span class="font-mono font-bold text-emerald-400">{{ config('app.cipher', 'AES-256-CBC') }}</span>
                        </div>
                        <div class="flex items-center justify-between p-3 rounded-xl bg-[#1e293b]">
                            <span class="text-[#94a3b8]">App URL / Canonical:</span>
                            <span class="font-mono font-bold text-[#ff6584]">{{ config('app.url') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Security Checklist -->
                <div class="p-6 rounded-2xl bg-[#111827] border border-[#1f2937] space-y-4">
                    <h3 class="text-sm font-bold text-white uppercase tracking-wider">Security &amp; Protection Suite</h3>
                    <div class="space-y-2.5 text-xs">
                        <div class="flex items-center gap-2 text-emerald-400">
                            <span>✓</span>
                            <span class="text-white font-semibold">Admin Login Rate-Limiter: <strong>5 attempts / minute</strong></span>
                        </div>
                        <div class="flex items-center gap-2 text-emerald-400">
                            <span>✓</span>
                            <span class="text-white font-semibold">Canonical 301 Redirection: <strong>Active for /index.php</strong></span>
                        </div>
                        <div class="flex items-center gap-2 text-emerald-400">
                            <span>✓</span>
                            <span class="text-white font-semibold">Strict CSRF Protection on all POST mutations</span>
                        </div>
                        <div class="flex items-center gap-2 text-emerald-400">
                            <span>✓</span>
                            <span class="text-white font-semibold">Zero-Crash APP_KEY fallback configured</span>
                        </div>
                        <div class="flex items-center gap-2 text-emerald-400">
                            <span>✓</span>
                            <span class="text-white font-semibold">Selfie Biometric Integrity Verification check enabled</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

<!-- Tab Switcher & Member Filter Script -->
<script>
function switchAdminTab(tabKey) {
    const tabKeys = ['overview', 'members', 'visitors', 'content', 'security'];
    tabKeys.forEach(k => {
        const content = document.getElementById('tabContent' + capitalize(k));
        const btn = document.getElementById('tabBtn' + capitalize(k));
        if (content && btn) {
            if (k === tabKey) {
                content.classList.remove('hidden');
                btn.className = 'admin-tab-btn px-4 py-2.5 rounded-xl font-bold text-xs flex items-center gap-2 transition cursor-pointer bg-[#1e293b] text-white shadow-xs';
            } else {
                content.classList.add('hidden');
                btn.className = 'admin-tab-btn px-4 py-2.5 rounded-xl font-bold text-xs flex items-center gap-2 transition cursor-pointer text-[#94a3b8] hover:text-white hover:bg-[#1e293b]/50';
            }
        }
    });
}

function capitalize(s) {
    return s.charAt(0).toUpperCase() + s.slice(1);
}

function filterMembersTable() {
    const filter = (document.getElementById('memberSearchInput').value || '').toLowerCase();
    const rows = document.querySelectorAll('.member-row');
    rows.forEach(row => {
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(filter) ? '' : 'none';
    });
}
</script>
@endsection
