@extends('layouts.app')

@section('title', '100+ Verified Dating Destination Hubs Across India & Worldwide | CupDate')
@section('meta_desc', 'Explore CupDate dating guides across 100+ cities in Himachal Pradesh, Punjab, Delhi NCR, Mumbai, Bangalore, Pune, and international diaspora communities. Verified singles, curated cafes, and 45-minute coffee dates.')

@section('content')
<div class="cupdate-cities-index min-h-screen bg-[#fbf8ff] text-[#1b1b21] font-['Plus_Jakarta_Sans',sans-serif] py-8 md:py-14">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Breadcrumbs -->
        <nav class="flex items-center gap-2 text-xs font-semibold text-[#6c595f] mb-6" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="hover:text-[#b0284b] transition-colors">Home</a>
            <span class="text-[#dfbfc2]">/</span>
            <span class="text-[#b0284b] font-bold">100+ Dating Destination Hubs</span>
        </nav>

        <!-- Header Hero -->
        <div class="text-center mb-10 bg-gradient-to-br from-[#fff0f3] via-white to-[#ffd9dd]/40 border border-[#f0d6dc] rounded-[2.5rem] p-8 sm:p-12 md:p-16 relative overflow-hidden shadow-sm">
            <div class="pointer-events-none absolute -top-16 -right-16 w-64 h-64 rounded-full bg-[#ff6584]/15 blur-3xl"></div>
            <div class="pointer-events-none absolute -bottom-16 -left-16 w-64 h-64 rounded-full bg-[#fdc5d0]/30 blur-3xl"></div>

            <div class="relative z-10 max-w-3xl mx-auto">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-xs font-extrabold uppercase tracking-wider bg-white/90 text-[#a8334e] border border-[#f1b7c1] shadow-sm mb-4">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span>100+ Verified Dating Hubs &amp; Curated Roasteries</span>
                </div>
                <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-[#1b1b21] tracking-tight leading-tight mb-4">
                    Discover Your Person in <span class="text-[#b0284b]">100+ Cities</span>
                </h1>
                <p class="text-sm md:text-base text-[#584143] leading-relaxed max-w-2xl mx-auto">
                    From pine-scented tea gardens in Himachal Pradesh and vibrant boulevard roasteries in Chandigarh, to coastal Goa verandas and global diaspora hubs.
                </p>

                <!-- Search & Filter Bar -->
                <div class="mt-8 max-w-xl mx-auto relative">
                    <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-[#b0284b] text-xl">search</span>
                    <input type="text" id="citySearchInput" onkeyup="filterCities()" placeholder="Search any city or state (e.g. Manali, Chandigarh, Bangalore, London)..."
                           class="w-full pl-12 pr-4 py-3.5 rounded-2xl bg-white border border-[#f0d6dc] focus:border-[#b0284b] focus:ring-2 focus:ring-[#ff6584]/20 outline-none text-xs sm:text-sm font-semibold shadow-sm transition">
                </div>
            </div>
        </div>

        <!-- Regional Filter Tabs -->
        <div class="mb-8 flex items-center gap-2 overflow-x-auto pb-2 scrollbar-none">
            <button onclick="setRegionFilter('all')" class="region-pill active shrink-0 px-4 py-2 rounded-full text-xs font-bold transition-all cursor-pointer bg-[#b0284b] text-white shadow-xs" data-region="all">
                All Hubs ({{ count($cities) }})
            </button>
            <button onclick="setRegionFilter('himachal')" class="region-pill shrink-0 px-4 py-2 rounded-full text-xs font-bold transition-all cursor-pointer bg-white text-[#6c595f] border border-[#f0d6dc] hover:bg-[#fff0f3] hover:text-[#b0284b]" data-region="himachal">
                🏔️ Himachal Pradesh (22)
            </button>
            <button onclick="setRegionFilter('north')" class="region-pill shrink-0 px-4 py-2 rounded-full text-xs font-bold transition-all cursor-pointer bg-white text-[#6c595f] border border-[#f0d6dc] hover:bg-[#fff0f3] hover:text-[#b0284b]" data-region="north">
                🌾 Punjab &amp; Delhi NCR (24)
            </button>
            <button onclick="setRegionFilter('west')" class="region-pill shrink-0 px-4 py-2 rounded-full text-xs font-bold transition-all cursor-pointer bg-white text-[#6c595f] border border-[#f0d6dc] hover:bg-[#fff0f3] hover:text-[#b0284b]" data-region="west">
                🌊 Mumbai, Pune &amp; Goa (14)
            </button>
            <button onclick="setRegionFilter('south')" class="region-pill shrink-0 px-4 py-2 rounded-full text-xs font-bold transition-all cursor-pointer bg-white text-[#6c595f] border border-[#f0d6dc] hover:bg-[#fff0f3] hover:text-[#b0284b]" data-region="south">
                ☕ Bangalore &amp; South India (14)
            </button>
            <button onclick="setRegionFilter('central')" class="region-pill shrink-0 px-4 py-2 rounded-full text-xs font-bold transition-all cursor-pointer bg-white text-[#6c595f] border border-[#f0d6dc] hover:bg-[#fff0f3] hover:text-[#b0284b]" data-region="central">
                🏰 Rajasthan &amp; Central (10)
            </button>
            <button onclick="setRegionFilter('east')" class="region-pill shrink-0 px-4 py-2 rounded-full text-xs font-bold transition-all cursor-pointer bg-white text-[#6c595f] border border-[#f0d6dc] hover:bg-[#fff0f3] hover:text-[#b0284b]" data-region="east">
                🪷 East &amp; North-East (6)
            </button>
            <button onclick="setRegionFilter('international')" class="region-pill shrink-0 px-4 py-2 rounded-full text-xs font-bold transition-all cursor-pointer bg-white text-[#6c595f] border border-[#f0d6dc] hover:bg-[#fff0f3] hover:text-[#b0284b]" data-region="international">
                🌐 Global Diaspora (10)
            </button>
        </div>

        <!-- Cities Grid (100+ Hubs) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5 mb-16" id="citiesGrid">
            @foreach($cities as $slug => $c)
                @php
                    $reg = strtolower($c['region'] ?? '');
                    $state = strtolower($c['state'] ?? '');
                    $dataCategory = 'other';
                    if (str_contains($state, 'himachal')) $dataCategory = 'himachal';
                    elseif (str_contains($reg, 'international')) $dataCategory = 'international';
                    elseif (str_contains($state, 'punjab') || str_contains($state, 'haryana') || str_contains($state, 'delhi') || str_contains($state, 'uttarakhand')) $dataCategory = 'north';
                    elseif (str_contains($state, 'maharashtra') || str_contains($state, 'goa') || str_contains($state, 'gujarat')) $dataCategory = 'west';
                    elseif (str_contains($state, 'karnataka') || str_contains($state, 'telangana') || str_contains($state, 'tamil') || str_contains($state, 'kerala') || str_contains($state, 'andhra')) $dataCategory = 'south';
                    elseif (str_contains($state, 'rajasthan') || str_contains($state, 'madhya') || str_contains($state, 'uttar pradesh')) $dataCategory = 'central';
                    elseif (str_contains($state, 'bengal') || str_contains($state, 'assam') || str_contains($state, 'odisha') || str_contains($state, 'bihar') || str_contains($state, 'jharkhand')) $dataCategory = 'east';
                @endphp

                <div class="city-card bg-white border border-[#f0d6dc] rounded-3xl p-5 hover:border-[#b0284b]/60 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between shadow-xs group"
                     data-name="{{ strtolower($c['name']) }}"
                     data-state="{{ strtolower($c['state']) }}"
                     data-region="{{ $dataCategory }}">
                    <div>
                        <div class="flex items-center justify-between mb-3">
                            <div class="w-10 h-10 rounded-2xl bg-[#fff0f3] border border-[#f1b7c1] text-[#b0284b] flex items-center justify-center text-lg shadow-xs group-hover:scale-110 transition-transform">
                                <span class="material-symbols-outlined text-xl">
                                    @if(str_contains($c['icon'], 'mountain')) terrain
                                    @elseif(str_contains($c['icon'], 'coffee') || str_contains($c['icon'], 'mug')) local_cafe
                                    @elseif(str_contains($c['icon'], 'water') || str_contains($c['icon'], 'beach')) water
                                    @elseif(str_contains($c['icon'], 'tree') || str_contains($c['icon'], 'seedling') || str_contains($c['icon'], 'leaf')) forest
                                    @elseif(str_contains($c['icon'], 'building') || str_contains($c['icon'], 'city')) apartment
                                    @elseif(str_contains($c['icon'], 'heart')) favorite
                                    @elseif(str_contains($c['icon'], 'gem') || str_contains($c['icon'], 'crown') || str_contains($c['icon'], 'sparkles')) diamond
                                    @elseif(str_contains($c['icon'], 'book')) auto_stories
                                    @else explore
                                    @endif
                                </span>
                            </div>
                            <span class="text-[10px] font-extrabold text-emerald-800 bg-emerald-50 border border-emerald-200 px-2 py-0.5 rounded-full flex items-center gap-1">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                {{ $c['safety_score'] }} Safe
                            </span>
                        </div>

                        <span class="text-[10px] uppercase font-extrabold text-[#a8334e] tracking-wider block">{{ $c['state'] }}</span>
                        <h3 class="font-extrabold text-base text-[#1b1b21] mt-0.5 group-hover:text-[#b0284b] transition leading-snug">
                            {{ $c['name'] }}
                        </h3>
                        <p class="text-xs text-[#584143] mt-2 leading-relaxed line-clamp-2">{{ $c['intro'] }}</p>

                        <div class="mt-3 pt-2.5 border-t border-[#f0d6dc]/60">
                            <span class="text-[10px] font-bold text-[#6c595f] block mb-1">Curated Meet Spot:</span>
                            <span class="text-[11px] font-semibold text-[#a8334e] bg-[#fff8fa] border border-[#f1b7c1]/50 px-2 py-0.5 rounded-lg inline-block truncate max-w-full">
                                ☕ {{ $c['popular_cafes'][0] ?? 'Specialty Roastery' }}
                            </span>
                        </div>
                    </div>

                    <div class="mt-4 pt-3 border-t border-[#f0d6dc]/60">
                        <a href="{{ route('city.show', $slug) }}" class="w-full py-2 bg-gradient-to-r from-[#ff6584] to-[#b0284b] text-white rounded-xl text-center text-xs font-extrabold hover:brightness-105 transition flex items-center justify-center gap-1.5 shadow-sm shadow-[#ff6584]/20 active:scale-95">
                            <span>Meet {{ explode(',', $c['name'])[0] }} Singles</span>
                            <span class="material-symbols-outlined text-sm">arrow_forward</span>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <div id="noCityMatch" class="hidden text-center py-16 bg-white rounded-3xl border border-[#f0d6dc] shadow-sm">
            <span class="material-symbols-outlined text-4xl text-[#b0284b] mb-2">search_off</span>
            <h3 class="text-lg font-bold text-[#1b1b21]">No cities matched your search</h3>
            <p class="text-xs text-[#584143] mt-1">Try searching for a different city, state, or click "All Hubs" above.</p>
        </div>

    </div>
</div>

<script>
let currentRegion = 'all';

function setRegionFilter(region) {
    currentRegion = region;
    document.querySelectorAll('.region-pill').forEach(btn => {
        if (btn.getAttribute('data-region') === region) {
            btn.className = 'region-pill active shrink-0 px-4 py-2 rounded-full text-xs font-bold transition-all cursor-pointer bg-[#b0284b] text-white shadow-xs';
        } else {
            btn.className = 'region-pill shrink-0 px-4 py-2 rounded-full text-xs font-bold transition-all cursor-pointer bg-white text-[#6c595f] border border-[#f0d6dc] hover:bg-[#fff0f3] hover:text-[#b0284b]';
        }
    });
    filterCities();
}

function filterCities() {
    const query = document.getElementById('citySearchInput').value.toLowerCase().trim();
    const cards = document.querySelectorAll('.city-card');
    let visibleCount = 0;

    cards.forEach(card => {
        const name = card.getAttribute('data-name');
        const state = card.getAttribute('data-state');
        const region = card.getAttribute('data-region');

        const matchesQuery = !query || name.includes(query) || state.includes(query);
        const matchesRegion = (currentRegion === 'all') || (region === currentRegion);

        if (matchesQuery && matchesRegion) {
            card.style.display = 'flex';
            visibleCount++;
        } else {
            card.style.display = 'none';
        }
    });

    const noMatch = document.getElementById('noCityMatch');
    if (noMatch) {
        noMatch.style.display = visibleCount === 0 ? 'block' : 'none';
    }
}
</script>
@endsection
