@extends('layouts.app')

@section('title', 'Nearby Radar & Best Coffee Date Cafes — CupDate')
@section('meta_desc', 'Explore nearby verified singles on our live radar and discover the best romantic coffee date spots in ' . ($city ?? 'your city') . '.')

@section('content')
<!-- Leaflet Map CSS & JS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

<div class="min-h-screen bg-[#FFFDF9] text-[#1e1e24] font-['Plus_Jakarta_Sans',sans-serif] pb-16">

    <!-- Top City & Filter Bar -->
    <section class="border-b border-[#f3e5e8] bg-white sticky top-16 z-20 shadow-xs">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
                
                <div>
                    <div class="flex items-center gap-2">
                        <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-ping"></span>
                        <h1 class="text-xl sm:text-2xl font-black text-[#1e1e24] tracking-tight">
                            Nearby Radar &amp; Date Cafes
                        </h1>
                        <span class="text-xs font-mono font-bold px-2 py-0.5 rounded-full bg-[#FFE6E6] text-[#FF3366] border border-[#FECDD3]">
                            {{ $city }}
                        </span>
                    </div>
                    <p class="text-xs text-[#5a484c]">
                        Live radar scans verified singles &amp; top curated cafes within your city.
                    </p>
                </div>

                <!-- City Search & Switcher -->
                <form action="{{ route('radar') }}" method="GET" class="flex items-center gap-2 w-full md:w-auto">
                    <div class="relative flex-1 md:w-64">
                        <input type="text" name="city" value="{{ $city }}" placeholder="Search city (e.g. Shimla, Pune)..." 
                               class="w-full pl-9 pr-4 py-2 rounded-full border border-[#ecd5dc] text-xs font-medium focus:outline-none focus:ring-2 focus:ring-[#FF3366] bg-[#FFF9FA]">
                        <svg class="w-4 h-4 text-[#a8334e] absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </div>
                    <button type="submit" class="px-4 py-2 rounded-full bg-[#FF3366] text-white text-xs font-bold hover:bg-[#e02857] transition shadow-xs">
                        Scan City
                    </button>
                </form>

            </div>

            <!-- Quick City Pills -->
            <div class="flex items-center gap-1.5 overflow-x-auto pt-3 pb-1 text-xs">
                <span class="text-[11px] font-bold text-[#8d7176] uppercase tracking-wider shrink-0 mr-1">Popular:</span>
                @foreach($cities as $c)
                    <a href="{{ route('radar', ['city' => $c]) }}" 
                       class="px-3 py-1 rounded-full whitespace-nowrap transition font-bold {{ strtolower($city) === strtolower($c) ? 'bg-[#FF3366] text-white shadow-xs' : 'bg-[#FFF2F4] text-[#a8334e] border border-[#f0d4da] hover:bg-[#ffe1e6]' }}">
                        {{ $c }}
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-8 space-y-10">

        <!-- 1. LIVE RADAR + INTERACTIVE MAP 2-COLUMN VIEW -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            
            <!-- Left: Interactive Animated Radar Screen (lg:col-span-6) -->
            <div class="lg:col-span-6 rounded-3xl bg-[#0F172A] border border-[#1E293B] p-6 shadow-xl relative overflow-hidden text-white flex flex-col items-center">
                
                <div class="w-full flex items-center justify-between pb-4 border-b border-[#1E293B] mb-4">
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 rounded-full bg-emerald-400 animate-pulse"></span>
                        <h2 class="text-sm font-black uppercase tracking-wider text-emerald-400">CupDate Proximity Radar</h2>
                    </div>
                    <span class="text-xs font-mono text-[#94A3B8]" id="radarSweepStatus">Active Scanning (5km)</span>
                </div>

                <!-- Radar Dish Canvas Container -->
                <div class="relative w-72 h-72 sm:w-80 sm:h-80 my-4 flex items-center justify-center">
                    
                    <!-- Concentric Distance Rings -->
                    <div class="absolute inset-0 rounded-full border border-emerald-500/20"></div>
                    <div class="absolute inset-8 rounded-full border border-emerald-500/25"></div>
                    <div class="absolute inset-16 rounded-full border border-emerald-500/30"></div>
                    <div class="absolute inset-24 rounded-full border border-emerald-500/40"></div>

                    <!-- Crosshairs -->
                    <div class="absolute inset-x-0 top-1/2 h-[1px] bg-emerald-500/20"></div>
                    <div class="absolute inset-y-0 left-1/2 w-[1px] bg-emerald-500/20"></div>

                    <!-- Rotating Radar Scanner Beam -->
                    <div class="absolute inset-0 rounded-full origin-center animate-[spin_4s_linear_infinite] pointer-events-none"
                         style="background: conic-gradient(from 0deg, rgba(16, 185, 129, 0.4) 0deg, rgba(16, 185, 129, 0.05) 60deg, transparent 90deg);">
                    </div>

                    <!-- Center User Marker -->
                    <div class="relative z-10 w-8 h-8 rounded-full bg-emerald-500 border-2 border-white flex items-center justify-center text-white shadow-lg shadow-emerald-500/50">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
                    </div>

                    <!-- Dynamic Radar Blips -->
                    @php
                        $blipOffsets = [
                            ['top' => '22%', 'left' => '68%', 'dist' => '0.8 km'],
                            ['top' => '65%', 'left' => '28%', 'dist' => '1.4 km'],
                            ['top' => '30%', 'left' => '25%', 'dist' => '2.1 km'],
                            ['top' => '72%', 'left' => '70%', 'dist' => '3.0 km'],
                            ['top' => '18%', 'left' => '42%', 'dist' => '1.2 km'],
                        ];
                    @endphp

                    @foreach($singles->take(5) as $idx => $single)
                        @php $b = $blipOffsets[$idx % count($blipOffsets)]; @endphp
                        <div class="absolute group cursor-pointer" style="top: {{ $b['top'] }}; left: {{ $b['left'] }};" onclick="showRadarSingleCard({{ $idx }})">
                            <span class="animate-ping absolute -inset-1 rounded-full bg-pink-400 opacity-75"></span>
                            <div class="relative w-6 h-6 rounded-full overflow-hidden border-2 border-pink-400 shadow-md shadow-pink-500/50 transform group-hover:scale-125 transition">
                                <img src="{{ $single->avatar_url }}" alt="{{ $single->full_name }}" class="w-full h-full object-cover">
                            </div>
                            <!-- Mini distance pill -->
                            <span class="absolute -bottom-4 left-1/2 -translate-x-1/2 text-[9px] font-mono bg-black/80 px-1 rounded text-pink-300 whitespace-nowrap">
                                {{ $b['dist'] }}
                            </span>
                        </div>
                    @endforeach

                </div>

                <!-- Selected Single Detail Card Popup on Radar -->
                <div id="radarDetailCard" class="w-full mt-3 p-4 rounded-2xl bg-[#1E293B] border border-[#334155] flex items-center justify-between gap-3">
                    @php $firstSingle = $singles->first(); @endphp
                    @if($firstSingle)
                        <div class="flex items-center gap-3">
                            <img id="radarCardAvatar" src="{{ $firstSingle->avatar_url }}" alt="{{ $firstSingle->full_name }}" class="w-12 h-12 rounded-xl object-cover ring-2 ring-pink-500">
                            <div>
                                <h3 id="radarCardName" class="font-bold text-sm text-white flex items-center gap-1.5">
                                    <span>{{ $firstSingle->full_name }}, {{ $firstSingle->age ?? '25' }}</span>
                                    <span class="text-[10px] bg-pink-500/20 text-pink-300 px-1.5 py-0.2 rounded font-mono">0.8 km</span>
                                </h3>
                                <p id="radarCardCoffee" class="text-xs text-[#94A3B8]">☕ {{ $firstSingle->coffee_style ?? 'Specialty Pour-Over' }}</p>
                            </div>
                        </div>
                        <a href="{{ route('profile', $firstSingle->id) }}" id="radarCardBtn" class="px-4 py-2 rounded-xl bg-gradient-to-r from-[#FF3366] to-[#b0284b] text-white text-xs font-bold hover:brightness-110 transition shrink-0 shadow-xs">
                            Ask for Coffee
                        </a>
                    @else
                        <p class="text-xs text-stone-400">Scanning for nearby members in {{ $city }}...</p>
                    @endif
                </div>

            </div>

            <!-- Right: Interactive Google Maps / Leaflet Date Cafe Explorer (lg:col-span-6) -->
            <div class="lg:col-span-6 rounded-3xl bg-white border border-[#f3e5e8] p-6 shadow-sm flex flex-col">
                <div class="flex items-center justify-between pb-4 border-b border-[#f3e5e8] mb-4">
                    <div>
                        <h2 class="text-base font-black text-[#1e1e24] flex items-center gap-2">
                            <span>Vetted Romantic Cafes in {{ $city }}</span>
                            <span class="text-xs font-mono font-bold px-2 py-0.5 rounded-full bg-emerald-100 text-emerald-800">
                                {{ $places->count() }} Spots
                            </span>
                        </h2>
                        <p class="text-xs text-[#5a484c]">Pins verified for quiet atmosphere, quality roast, and member discounts.</p>
                    </div>
                </div>

                <!-- Leaflet Map Container -->
                <div id="cafeMap" class="w-full h-80 sm:h-96 rounded-2xl border border-[#ecd5dc] shadow-inner relative z-10 overflow-hidden"></div>

                <div class="mt-4 flex items-center justify-between text-xs text-[#5a484c]">
                    <span class="flex items-center gap-1">
                        <span class="w-2.5 h-2.5 rounded-full bg-[#FF3366]"></span>
                        <span>Click pins to view cafe perks &amp; discount</span>
                    </span>
                    <span class="font-mono text-[11px] text-[#b0284b]">GPS Verified</span>
                </div>
            </div>

        </div>

        <!-- 2. BEST CAFES LISTED ACCORDING TO CITY -->
        <section class="pt-6">
            <div class="flex items-end justify-between mb-6">
                <div>
                    <span class="text-xs font-bold uppercase tracking-wider text-[#b0284b] bg-[#FFE6E6] border border-[#FECDD3] px-3 py-0.5 rounded-full inline-block mb-1">
                        Curated Date Spots
                    </span>
                    <h2 class="text-2xl font-black text-[#1e1e24]">
                        Best Cafes in {{ $city }} for First Coffee Dates
                    </h2>
                    <p class="text-xs text-[#5a484c] mt-0.5">
                        Hand-selected for relaxed seating, artisanal coffee, and comfortable noise levels.
                    </p>
                </div>
            </div>

            <!-- Cafe Cards Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($places as $place)
                    <div class="group rounded-3xl bg-white border border-[#f0d4da] overflow-hidden shadow-xs hover:shadow-md hover:-translate-y-1 transition flex flex-col">
                        
                        <!-- Cafe Photo -->
                        <div class="relative aspect-[16/10] overflow-hidden bg-stone-100">
                            <img src="{{ $place->image_url ?? 'https://images.unsplash.com/photo-1554118811-1e0d58224f24?w=600&q=80&fit=crop' }}" 
                                 alt="{{ $place->name }}" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition duration-500"
                                 onerror="this.src='https://images.unsplash.com/photo-1501339847302-ac426a4a7cbb?w=600&q=80&fit=crop'">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent"></div>
                            
                            <!-- Rating Badge -->
                            <div class="absolute top-3 right-3 bg-white/95 backdrop-blur-xs px-2.5 py-1 rounded-full text-xs font-black text-amber-900 flex items-center gap-1 shadow-xs">
                                <span class="text-amber-500 font-bold">★</span>
                                <span>{{ number_format($place->rating ?? 4.8, 1) }}</span>
                            </div>

                            <!-- City & Type Tag -->
                            <div class="absolute bottom-3 left-3 right-3 text-white">
                                <span class="text-[10px] font-mono uppercase bg-[#FF3366] text-white px-2 py-0.5 rounded-full font-bold">
                                    {{ $place->type ?? 'Artisanal Cafe' }}
                                </span>
                                <h3 class="font-black text-lg text-white mt-1 leading-snug drop-shadow-xs">
                                    {{ $place->name }}
                                </h3>
                            </div>
                        </div>

                        <!-- Cafe Details -->
                        <div class="p-5 flex flex-col justify-between flex-1">
                            <div>
                                <p class="text-xs text-[#5a484c] line-clamp-2 leading-relaxed mb-3">
                                    {{ $place->description }}
                                </p>
                                <p class="text-[11px] text-[#8d7176] flex items-center gap-1 mb-4 truncate">
                                    <span>📍</span>
                                    <span>{{ $place->address }}</span>
                                </p>
                            </div>

                            <!-- Perk Offer Banner -->
                            <div class="pt-3 border-t border-[#f7e6e9] flex items-center justify-between gap-2">
                                <span class="text-[11px] font-bold text-[#b0284b] bg-[#FFE6E6] border border-[#FECDD3] px-2.5 py-1 rounded-full truncate">
                                    ☕ {{ $place->cup_offer ?? '15% Off with CupDate' }}
                                </span>

                                @auth
                                    <a href="{{ route('messages') }}?suggest_cafe={{ urlencode($place->name) }}" class="px-3.5 py-1.5 rounded-full bg-[#FF3366] text-white text-xs font-bold hover:bg-[#e02857] transition shadow-xs whitespace-nowrap">
                                        Suggest Date
                                    </a>
                                @else
                                    <button type="button" onclick="openQuickAuthModal('signin')" class="px-3.5 py-1.5 rounded-full bg-[#FF3366] text-white text-xs font-bold hover:bg-[#e02857] transition shadow-xs whitespace-nowrap">
                                        Pick Date Spot
                                    </button>
                                @endauth
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>
        </section>

        <!-- 3. NEARBY SINGLES PREVIEW IN THIS CITY -->
        <section class="pt-6">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <span class="text-xs font-bold uppercase tracking-wider text-[#b0284b] bg-[#FFE6E6] border border-[#FECDD3] px-3 py-0.5 rounded-full inline-block mb-1">
                        Active In {{ $city }}
                    </span>
                    <h2 class="text-2xl font-black text-[#1e1e24]">
                        Singles Ready for Coffee in {{ $city }}
                    </h2>
                </div>
                <a href="{{ route('swipes') }}" class="text-xs font-bold text-[#FF3366] hover:underline flex items-center gap-1">
                    <span>Swipe Deck</span>
                    <span>&rarr;</span>
                </a>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
                @foreach($singles as $single)
                    <div class="group rounded-2xl bg-white border border-[#f0d4da] overflow-hidden shadow-2xs hover:shadow-md transition">
                        <div class="relative aspect-[4/5] bg-stone-100 overflow-hidden">
                            <img src="{{ $single->avatar_url }}" alt="{{ $single->full_name }}" class="w-full h-full object-cover group-hover:scale-105 transition">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent"></div>
                            <div class="absolute bottom-2 left-2 right-2 text-white">
                                <h3 class="font-bold text-xs truncate">{{ explode(' ', $single->full_name)[0] }}, {{ $single->age ?? '24' }}</h3>
                                <p class="text-[10px] text-pink-200 truncate">☕ {{ $single->coffee_style ?? 'Latte' }}</p>
                            </div>
                        </div>
                        <div class="p-2.5 text-center">
                            <a href="{{ route('profile', $single->id) }}" class="block w-full py-1.5 rounded-xl bg-[#FFF2F4] text-[#a8334e] text-[11px] font-bold hover:bg-[#FF3366] hover:text-white transition">
                                Say Hi
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

    </div>

</div>

<!-- Leaflet Map Initialization Script -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const cafeData = @json($places);
    
    // Default coordinates based on first cafe or center of India
    let centerLat = 31.1048;
    let centerLng = 77.1734;

    if (cafeData.length > 0 && cafeData[0].lat && cafeData[0].lng) {
        centerLat = parseFloat(cafeData[0].lat);
        centerLng = parseFloat(cafeData[0].lng);
    }

    const map = L.map('cafeMap', {
        scrollWheelZoom: false
    }).setView([centerLat, centerLng], 13);

    // Beautiful clean CartoDB Voyager tiles
    L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png', {
        attribution: '&copy; OpenStreetMap contributors &copy; CARTO',
        maxZoom: 19
    }).addTo(map);

    // Custom Pink Heart Icon for Cafes
    const cafeIcon = L.divIcon({
        className: 'custom-cafe-pin',
        html: `<div style="background-color:#FF3366; width:32px; height:32px; border-radius:50%; display:flex; align-items:center; justify-content:center; color:white; font-size:16px; border:2px solid white; box-shadow:0 4px 12px rgba(255,51,102,0.4);">☕</div>`,
        iconSize: [32, 32],
        iconAnchor: [16, 32],
        popupAnchor: [0, -32]
    });

    const markers = [];

    cafeData.forEach(function (cafe) {
        if (cafe.lat && cafe.lng) {
            const marker = L.marker([parseFloat(cafe.lat), parseFloat(cafe.lng)], { icon: cafeIcon }).addTo(map);
            
            const popupContent = `
                <div style="font-family:'Plus Jakarta Sans',sans-serif; max-width:220px;">
                    <h4 style="margin:0 0 4px 0; font-size:14px; font-weight:800; color:#1e1e24;">${cafe.name}</h4>
                    <p style="margin:0 0 6px 0; font-size:11px; color:#5a484c;">${cafe.address}</p>
                    <span style="display:inline-block; font-size:10px; font-weight:700; color:#b0284b; background:#FFE6E6; border:1px solid #FECDD3; padding:2px 8px; border-radius:12px;">
                        ★ ${cafe.rating} · ${cafe.cup_offer || '15% Off'}
                    </span>
                </div>
            `;
            marker.bindPopup(popupContent);
            markers.push(marker);
        }
    });

    if (markers.length > 1) {
        const group = new L.featureGroup(markers);
        map.fitBounds(group.getBounds().pad(0.15));
    }
});

// Single card details switcher for radar
const singlesArray = @json($singles->values());
function showRadarSingleCard(idx) {
    if (singlesArray && singlesArray[idx]) {
        const s = singlesArray[idx];
        document.getElementById('radarCardAvatar').src = s.avatar_url;
        document.getElementById('radarCardName').innerHTML = `<span>${s.full_name}, ${s.age || '25'}</span> <span class="text-[10px] bg-pink-500/20 text-pink-300 px-1.5 py-0.2 rounded font-mono">Nearby</span>`;
        document.getElementById('radarCardCoffee').textContent = `☕ ${s.coffee_style || 'Specialty Coffee'}`;
        document.getElementById('radarCardBtn').href = `/profile/${s.id}`;
    }
}
</script>
@endsection
