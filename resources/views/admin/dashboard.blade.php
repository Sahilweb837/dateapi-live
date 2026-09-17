@extends('layouts.app')

@section('title', 'Admin Dashboard & Visitor Analytics — CupDate')

@section('extra_css')
<style>
    .kpi-card {
        background: linear-gradient(135deg, #ffffff 0%, #fdfbf9 100%);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .kpi-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px -5px rgba(139, 90, 43, 0.1), 0 8px 10px -6px rgba(139, 90, 43, 0.05);
    }
    .live-pulse {
        animation: pulse-ring 1.8s cubic-bezier(0.215, 0.61, 0.355, 1) infinite;
    }
    @keyframes pulse-ring {
        0% { transform: scale(0.95); opacity: 0.8; }
        50% { transform: scale(1.15); opacity: 0.4; }
        100% { transform: scale(0.95); opacity: 0.8; }
    }
</style>
@endsection

@section('content')
<div class="min-h-screen bg-[#fcf9f6] py-8 md:py-12 border-b border-[#ebdcd1]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

        <!-- Top Admin Bar -->
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4 bg-white p-6 rounded-3xl border border-[#e8d8cc] shadow-xs">
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#fdf2ea] border border-[#e5cbbe] text-[#8b5a2b] text-xs font-bold uppercase tracking-wider mb-2">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 live-pulse"></span>
                    <span>Live Command Center</span>
                </div>
                <h1 class="text-2xl sm:text-3xl font-extrabold text-[#231713] tracking-tight font-['Plus_Jakarta_Sans']">
                    CupDate Admin &amp; <span class="text-[#8b5a2b]">Visitor Analytics</span>
                </h1>
                <p class="text-xs sm:text-sm text-gray-500 mt-1">
                    Real-time IP capture, page traffic analytics, user moderation, and editorial management.
                </p>
            </div>

            <div class="flex items-center gap-3 flex-wrap">
                <a href="{{ route('admin.blogs') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-full bg-[#8b5a2b] hover:bg-[#724820] text-white text-xs font-bold transition-all shadow-sm">
                    <span class="material-symbols-outlined text-base">post_add</span>
                    <span>Publish Blog Post</span>
                </a>
                <a href="{{ route('home') }}" target="_blank" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-full bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-bold transition-all">
                    <span class="material-symbols-outlined text-base">open_in_new</span>
                    <span>View Live Site</span>
                </a>
            </div>
        </div>

        <!-- Alert Notifications -->
        @if(session('success'))
            <div class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-900 text-xs font-bold flex items-center gap-3">
                <span class="material-symbols-outlined text-emerald-600">check_circle</span>
                <span>{{ session('success') }}</span>
            </div>
        @elseif(session('error'))
            <div class="p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-900 text-xs font-bold flex items-center gap-3">
                <span class="material-symbols-outlined text-rose-600">error</span>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        <!-- KPI Metric Cards Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
            <!-- Metric 1: Total Hits -->
            <div class="kpi-card p-5 rounded-3xl border border-[#ebdcd1] shadow-xs">
                <div class="flex items-center justify-between mb-3">
                    <span class="text-xs font-bold text-gray-500 uppercase tracking-wider">Total Page Views</span>
                    <div class="w-10 h-10 rounded-2xl bg-[#f7ede6] text-[#8b5a2b] flex items-center justify-center">
                        <span class="material-symbols-outlined text-xl">visibility</span>
                    </div>
                </div>
                <div class="text-3xl font-black text-[#24150e] font-['Plus_Jakarta_Sans']">{{ number_format($totalViews) }}</div>
                <div class="text-[11px] text-emerald-700 font-semibold mt-2 flex items-center gap-1">
                    <span class="material-symbols-outlined text-sm">trending_up</span>
                    <span>+{{ number_format($viewsToday) }} views logged today</span>
                </div>
            </div>

            <!-- Metric 2: Unique IP Visitors -->
            <div class="kpi-card p-5 rounded-3xl border border-[#ebdcd1] shadow-xs">
                <div class="flex items-center justify-between mb-3">
                    <span class="text-xs font-bold text-gray-500 uppercase tracking-wider">Unique Visitors (IPs)</span>
                    <div class="w-10 h-10 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center">
                        <span class="material-symbols-outlined text-xl">fingerprint</span>
                    </div>
                </div>
                <div class="text-3xl font-black text-blue-900 font-['Plus_Jakarta_Sans']">{{ number_format($uniqueVisitors) }}</div>
                <div class="text-[11px] text-blue-700 font-semibold mt-2 flex items-center gap-1">
                    <span class="material-symbols-outlined text-sm">public</span>
                    <span>{{ number_format($uniqueToday) }} unique IPs today</span>
                </div>
            </div>

            <!-- Metric 3: Registered Singles -->
            <div class="kpi-card p-5 rounded-3xl border border-[#ebdcd1] shadow-xs">
                <div class="flex items-center justify-between mb-3">
                    <span class="text-xs font-bold text-gray-500 uppercase tracking-wider">Registered Daters</span>
                    <div class="w-10 h-10 rounded-2xl bg-rose-50 text-rose-600 flex items-center justify-center">
                        <span class="material-symbols-outlined text-xl">group</span>
                    </div>
                </div>
                <div class="text-3xl font-black text-rose-900 font-['Plus_Jakarta_Sans']">{{ number_format($totalUsers) }}</div>
                <div class="text-[11px] text-rose-700 font-semibold mt-2 flex items-center gap-1">
                    <span class="material-symbols-outlined text-sm">verified</span>
                    <span>{{ number_format($verifiedUsers) }} verified profiles</span>
                </div>
            </div>

            <!-- Metric 4: Curated Cafes & Editorial Guides -->
            <div class="kpi-card p-5 rounded-3xl border border-[#ebdcd1] shadow-xs">
                <div class="flex items-center justify-between mb-3">
                    <span class="text-xs font-bold text-gray-500 uppercase tracking-wider">Content &amp; Spots</span>
                    <div class="w-10 h-10 rounded-2xl bg-amber-50 text-amber-700 flex items-center justify-center">
                        <span class="material-symbols-outlined text-xl">coffee</span>
                    </div>
                </div>
                <div class="text-3xl font-black text-amber-900 font-['Plus_Jakarta_Sans']">{{ number_format($totalPlaces) }} Spots</div>
                <div class="text-[11px] text-amber-800 font-semibold mt-2 flex items-center gap-1">
                    <span class="material-symbols-outlined text-sm">article</span>
                    <span>{{ number_format($totalBlogs) }} editorial guides active</span>
                </div>
            </div>
        </div>

        <!-- 2-Column Section: Top Pages & Live Activity Stream -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            
            <!-- Left: Top Viewed Pages (5 Cols) -->
            <div class="lg:col-span-5 bg-white rounded-3xl p-6 border border-[#e8d8cc] shadow-xs space-y-4">
                <div class="flex items-center justify-between pb-3 border-b border-[#f0e3d9]">
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-[#8b5a2b]">bar_chart</span>
                        <h2 class="text-base font-bold text-[#231713]">Top Viewed Pages</h2>
                    </div>
                    <span class="text-[11px] font-bold text-gray-400 uppercase">Hits / Distinct IPs</span>
                </div>

                @if($viewsPerPage->isEmpty())
                    <div class="py-12 text-center text-gray-400 text-xs">
                        No page views recorded yet. Browse the site to see real-time statistics appear here!
                    </div>
                @else
                    <div class="space-y-3.5">
                        @foreach($viewsPerPage as $page)
                            @php
                                $percent = $totalViews > 0 ? round(($page->total / $totalViews) * 100, 1) : 0;
                            @endphp
                            <div class="space-y-1.5">
                                <div class="flex items-center justify-between text-xs font-semibold text-gray-800">
                                    <a href="{{ $page->url }}" target="_blank" class="hover:text-[#8b5a2b] font-mono truncate max-w-[200px]" title="{{ $page->url }}">
                                        {{ $page->url }}
                                    </a>
                                    <div class="flex items-center gap-2 shrink-0">
                                        <span class="font-bold text-[#8b5a2b]">{{ number_format($page->total) }} views</span>
                                        <span class="text-[10px] text-gray-400 font-normal">({{ number_format($page->uniques) }} IPs)</span>
                                    </div>
                                </div>
                                <div class="w-full bg-gray-100 h-2 rounded-full overflow-hidden">
                                    <div class="bg-gradient-to-r from-[#c08858] to-[#8b5a2b] h-2 rounded-full" style="width: {{ max(4, $percent) }}%"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Right: Real-time Visitor Stream & IP Capture (7 Cols) -->
            <div class="lg:col-span-7 bg-white rounded-3xl p-6 border border-[#e8d8cc] shadow-xs space-y-4">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pb-3 border-b border-[#f0e3d9]">
                    <div class="flex items-center gap-2">
                        <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 live-pulse"></span>
                        <h2 class="text-base font-bold text-[#231713]">Live Visitor Feed &amp; IP Log</h2>
                    </div>

                    <!-- Filter by IP Form -->
                    <form action="{{ route('admin.dashboard') }}" method="GET" class="flex items-center gap-2">
                        <input type="text" name="ip" value="{{ $searchIp }}" placeholder="Filter by IP..." class="px-3 py-1.5 rounded-xl border border-gray-300 text-xs focus:outline-none focus:ring-1 focus:ring-[#8b5a2b] w-36 bg-gray-50"/>
                        <button type="submit" class="px-3 py-1.5 rounded-xl bg-[#8b5a2b] hover:bg-[#724820] text-white text-xs font-bold transition-all">Search</button>
                        @if($searchIp)
                            <a href="{{ route('admin.dashboard') }}" class="text-xs text-gray-500 hover:text-gray-800 underline">Clear</a>
                        @endif
                    </form>
                </div>

                @if($recentVisitors->isEmpty())
                    <div class="py-12 text-center text-gray-400 text-xs">
                        No visitor activity logged yet.
                    </div>
                @else
                    <div class="overflow-x-auto max-h-[500px] overflow-y-auto">
                        <table class="w-full text-left text-xs">
                            <thead class="bg-[#faf5f0] text-gray-500 uppercase text-[10px] font-bold sticky top-0">
                                <tr>
                                    <th class="py-2.5 px-3 rounded-l-xl">IP Address</th>
                                    <th class="py-2.5 px-3">Visited URL</th>
                                    <th class="py-2.5 px-3">User / Status</th>
                                    <th class="py-2.5 px-3">Device / UA</th>
                                    <th class="py-2.5 px-3 rounded-r-xl">Time</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach($recentVisitors as $visit)
                                    <tr class="hover:bg-[#fdfaf7] transition-colors">
                                        <td class="py-3 px-3 font-mono font-bold text-[#8b5a2b]">
                                            <a href="https://ipinfo.io/{{ $visit->ip_address }}" target="_blank" class="hover:underline flex items-center gap-1" title="Lookup IP details">
                                                <span>{{ $visit->ip_address }}</span>
                                                <span class="material-symbols-outlined text-[10px] text-gray-400">open_in_new</span>
                                            </a>
                                        </td>
                                        <td class="py-3 px-3 max-w-[160px] truncate font-mono text-gray-700" title="{{ $visit->url }}">
                                            <span class="text-[10px] uppercase font-bold text-gray-400 mr-1">{{ $visit->method }}</span>
                                            {{ $visit->url }}
                                        </td>
                                        <td class="py-3 px-3 whitespace-nowrap">
                                            @if($visit->user_name)
                                                <span class="font-bold text-emerald-800 bg-emerald-50 px-2 py-0.5 rounded-full border border-emerald-200">{{ $visit->user_name }}</span>
                                            @else
                                                <span class="text-gray-400">Guest Visitor</span>
                                            @endif
                                        </td>
                                        <td class="py-3 px-3 max-w-[150px] truncate text-gray-500 text-[11px]" title="{{ $visit->user_agent }}">
                                            @if(str_contains(strtolower($visit->user_agent), 'mobile') || str_contains(strtolower($visit->user_agent), 'android') || str_contains(strtolower($visit->user_agent), 'iphone'))
                                                📱 Mobile
                                            @else
                                                💻 Desktop
                                            @endif
                                            · {{ Str::limit($visit->user_agent, 20) }}
                                        </td>
                                        <td class="py-3 px-3 whitespace-nowrap text-gray-400 text-[11px]">
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

        <!-- Registered Users Directory & Quick Moderation -->
        <div class="bg-white rounded-3xl p-6 border border-[#e8d8cc] shadow-xs space-y-4">
            <div class="flex items-center justify-between pb-3 border-b border-[#f0e3d9]">
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-[#8b5a2b]">manage_accounts</span>
                    <h2 class="text-base font-bold text-[#231713]">Member Management &amp; Access Control</h2>
                </div>
                <span class="text-xs text-gray-400 font-semibold">{{ $totalUsers }} total members</span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead class="bg-[#faf5f0] text-gray-500 uppercase text-[10px] font-bold">
                        <tr>
                            <th class="py-3 px-3 rounded-l-xl">User</th>
                            <th class="py-3 px-3">Email</th>
                            <th class="py-3 px-3">Location</th>
                            <th class="py-3 px-3">Status</th>
                            <th class="py-3 px-3">Verification</th>
                            <th class="py-3 px-3 text-right rounded-r-xl">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($users as $u)
                            <tr class="hover:bg-[#fdfaf7] transition-colors">
                                <td class="py-3 px-3 flex items-center gap-3">
                                    <img src="{{ $u->avatar_url }}" class="w-9 h-9 rounded-full object-cover ring-1 ring-gray-200" alt="{{ $u->full_name }}"/>
                                    <div>
                                        <p class="font-bold text-gray-900">{{ $u->full_name }}</p>
                                        <p class="text-[10px] font-mono text-gray-400">{{ $u->member_code ?? 'CD-' . $u->id }}</p>
                                    </div>
                                </td>
                                <td class="py-3 px-3 font-mono text-gray-700">{{ $u->email }}</td>
                                <td class="py-3 px-3 text-gray-600">{{ $u->country ?? 'India' }}</td>
                                <td class="py-3 px-3">
                                    @if($u->status === 'blocked')
                                        <span class="inline-flex items-center gap-1 font-bold text-rose-800 bg-rose-50 px-2.5 py-0.5 rounded-full border border-rose-200 text-[10px]">
                                            <span class="material-symbols-outlined text-xs">block</span> Blocked
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 font-bold text-emerald-800 bg-emerald-50 px-2.5 py-0.5 rounded-full border border-emerald-200 text-[10px]">
                                            <span class="material-symbols-outlined text-xs">check_circle</span> Active
                                        </span>
                                    @endif
                                </td>
                                <td class="py-3 px-3">
                                    @if($u->is_verified)
                                        <span class="inline-flex items-center gap-1 font-bold text-emerald-800 bg-emerald-50 px-2.5 py-0.5 rounded-full border border-emerald-200 text-[11px]">
                                            <span class="material-symbols-outlined text-xs">verified</span> Verified
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 font-semibold text-gray-500 bg-gray-100 px-2.5 py-0.5 rounded-full text-[11px]">
                                            Unverified
                                        </span>
                                    @endif
                                </td>
                                <td class="py-3 px-3 text-right space-x-1.5 whitespace-nowrap">
                                    <!-- Toggle Verification -->
                                    <form action="{{ route('admin.user.verify', $u->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="px-2.5 py-1 rounded-full text-[11px] font-bold border transition-colors cursor-pointer {{ $u->is_verified ? 'bg-gray-100 text-gray-700 border-gray-300 hover:bg-gray-200' : 'bg-emerald-600 text-white border-emerald-700 hover:bg-emerald-700' }}">
                                            {{ $u->is_verified ? 'Unverify' : 'Verify' }}
                                        </button>
                                    </form>

                                    <!-- Toggle Block / Unblock User -->
                                    <form action="{{ route('admin.user.block', $u->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to {{ $u->status === 'blocked' ? 'unblock' : 'block' }} this user?');">
                                        @csrf
                                        <button type="submit" class="px-2.5 py-1 rounded-full text-[11px] font-bold border transition-colors cursor-pointer {{ $u->status === 'blocked' ? 'bg-emerald-100 text-emerald-800 border-emerald-300 hover:bg-emerald-200' : 'bg-rose-50 text-rose-700 border-rose-200 hover:bg-rose-100' }}">
                                            {{ $u->status === 'blocked' ? 'Unblock' : 'Block' }}
                                        </button>
                                    </form>

                                    <!-- Add Bonus Coins -->
                                    <form action="{{ route('admin.user.coins', $u->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="px-2.5 py-1 rounded-full text-[11px] font-bold bg-amber-50 hover:bg-amber-100 text-amber-800 border border-amber-200 transition-colors cursor-pointer" title="Add 100 bonus coins">
                                            +100 Coins
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-8 text-center text-gray-400">No members registered yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Live Member Chat & Messages Oversight -->
        <div class="bg-white rounded-3xl p-6 border border-[#e8d8cc] shadow-xs space-y-4">
            <div class="flex items-center justify-between pb-3 border-b border-[#f0e3d9]">
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-[#ff007f]">forum</span>
                    <h2 class="text-base font-bold text-[#231713]">Live Dating Chat &amp; Message Oversight</h2>
                </div>
                <span class="text-xs text-gray-400 font-semibold">{{ $messages->count() }} recent dispatches</span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead class="bg-[#faf5f0] text-gray-500 uppercase text-[10px] font-bold">
                        <tr>
                            <th class="py-3 px-3 rounded-l-xl">From (Sender)</th>
                            <th class="py-3 px-3">To (Receiver)</th>
                            <th class="py-3 px-3">Message Content</th>
                            <th class="py-3 px-3">Timestamp</th>
                            <th class="py-3 px-3 text-right rounded-r-xl">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($messages as $msg)
                            <tr class="hover:bg-[#fdfaf7] transition-colors">
                                <td class="py-3 px-3">
                                    <div class="flex items-center gap-2">
                                        <img src="{{ $msg->sender->avatar_url ?? asset('assets/images/default_avatar.png') }}" class="w-7 h-7 rounded-full object-cover border border-gray-200"/>
                                        <span class="font-bold text-gray-900">{{ $msg->sender->full_name ?? 'User #' . $msg->sender_id }}</span>
                                    </div>
                                </td>
                                <td class="py-3 px-3">
                                    <div class="flex items-center gap-2">
                                        <img src="{{ $msg->receiver->avatar_url ?? asset('assets/images/default_avatar.png') }}" class="w-7 h-7 rounded-full object-cover border border-gray-200"/>
                                        <span class="font-bold text-gray-900">{{ $msg->receiver->full_name ?? 'User #' . $msg->receiver_id }}</span>
                                    </div>
                                </td>
                                <td class="py-3 px-3 max-w-sm text-gray-700">
                                    <p class="truncate">{{ $msg->body ?? $msg->message ?? '(Photo / Attachment)' }}</p>
                                    @if($msg->image_path)
                                        <a href="{{ asset($msg->image_path) }}" target="_blank" class="text-[10px] text-secondary font-bold hover:underline flex items-center gap-0.5 mt-0.5">
                                            <span class="material-symbols-outlined text-xs">image</span> View Photo
                                        </a>
                                    @endif
                                </td>
                                <td class="py-3 px-3 text-gray-400 whitespace-nowrap">
                                    {{ \Carbon\Carbon::parse($msg->created_at)->diffForHumans() }}
                                </td>
                                <td class="py-3 px-3 text-right whitespace-nowrap">
                                    <form action="{{ route('admin.message.delete', $msg->id) }}" method="POST" class="inline" onsubmit="return confirm('Delete this message?');">
                                        @csrf
                                        <button type="submit" class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-rose-50 hover:bg-rose-100 text-rose-700 border border-rose-200 transition cursor-pointer">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-8 text-center text-gray-400">No chat messages recorded yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Community Date Ideas Moderation -->
        <div class="bg-white rounded-3xl p-6 border border-[#e8d8cc] shadow-xs space-y-4">
            <div class="flex items-center justify-between pb-3 border-b border-[#f0e3d9]">
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-[#8b5a2b]">local_cafe</span>
                    <h2 class="text-base font-bold text-[#231713]">Community Date Ideas Moderation</h2>
                </div>
                <span class="text-xs text-gray-400 font-semibold">{{ $ideas->count() }} active ideas</span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead class="bg-[#faf5f0] text-gray-500 uppercase text-[10px] font-bold">
                        <tr>
                            <th class="py-3 px-3 rounded-l-xl">Member</th>
                            <th class="py-3 px-3">Cafe &amp; City</th>
                            <th class="py-3 px-3">Idea Content</th>
                            <th class="py-3 px-3">Sparks</th>
                            <th class="py-3 px-3 text-right rounded-r-xl">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($ideas as $idea)
                            <tr class="hover:bg-[#fdfaf7] transition-colors">
                                <td class="py-3 px-3">
                                    <span class="font-bold text-gray-900">{{ $idea->user->full_name ?? 'Member' }}</span>
                                </td>
                                <td class="py-3 px-3 font-semibold text-[#8b5a2b]">
                                    {{ $idea->cafe_name }} • {{ $idea->city }}
                                </td>
                                <td class="py-3 px-3 max-w-md text-gray-700 truncate">
                                    {{ $idea->content ?? $idea->idea_text }}
                                </td>
                                <td class="py-3 px-3">
                                    <span class="font-bold text-rose-700 bg-rose-50 px-2 py-0.5 rounded-full border border-rose-200">
                                        ❤️ {{ $idea->sparks_count ?? $idea->sparks ?? 0 }}
                                    </span>
                                </td>
                                <td class="py-3 px-3 text-right whitespace-nowrap">
                                    <form action="{{ route('admin.idea.delete', $idea->id) }}" method="POST" class="inline" onsubmit="return confirm('Delete this date idea?');">
                                        @csrf
                                        <button type="submit" class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-rose-50 hover:bg-rose-100 text-rose-700 border border-rose-200 transition cursor-pointer">
                                            Remove Idea
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-8 text-center text-gray-400">No community date ideas posted yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
@endsection
