@extends('layouts.app')

@section('title', 'Dating Cities in Himachal, Punjab, Delhi, Mumbai & Worldwide | CupDate')
@section('meta_desc', 'Explore CupDate city pages for Himachal Pradesh, Punjab, Delhi, Chandigarh, Amritsar, Mumbai, Pune, Bangalore, India, and international communities in the UK, Canada, UAE, USA, Australia, and Singapore.')

@section('content')
<div class="cupdate-cities-index min-h-screen bg-[#fbf8ff] text-[#1b1b21] font-['Plus_Jakarta_Sans',sans-serif] py-8 md:py-14">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Breadcrumbs -->
        <nav class="flex items-center gap-2 text-xs font-semibold text-[#6c595f] mb-6" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="hover:text-[#b0284b] transition-colors">Home</a>
            <span class="text-[#dfbfc2]">/</span>
            <span class="text-[#b0284b] font-bold">Dating Cities</span>
        </nav>

        <!-- Header Hero -->
        <div class="text-center mb-12 bg-gradient-to-br from-[#fff0f3] via-white to-[#ffd9dd]/40 border border-[#f0d6dc] rounded-[2.5rem] p-8 sm:p-12 md:p-16 relative overflow-hidden shadow-sm">
            <div class="pointer-events-none absolute -top-16 -right-16 w-64 h-64 rounded-full bg-[#ff6584]/15 blur-3xl"></div>
            <div class="pointer-events-none absolute -bottom-16 -left-16 w-64 h-64 rounded-full bg-[#fdc5d0]/30 blur-3xl"></div>

            <div class="relative z-10 max-w-2xl mx-auto">
                <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-xs font-extrabold uppercase tracking-wider bg-white/90 text-[#a8334e] border border-[#f1b7c1] shadow-sm mb-4">
                    <i class="fa-solid fa-map-location-dot text-[#fd748e]"></i> Regional Hubs & Coffee Spots
                </span>
                <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-[#1b1b21] tracking-tight leading-tight mb-4">
                    Dating Cities Across India &amp; Worldwide
                </h1>
                <p class="text-sm md:text-base text-[#584143] leading-relaxed">
                    From the serene mountain cafes of Himachal Pradesh to vibrant urban roasteries, connect with verified singles for low-pressure 45-minute coffee dates.
                </p>
            </div>
        </div>

        <!-- International Discovery Section -->
        <section class="mb-12 rounded-[2.5rem] border border-[#f0d6dc] bg-white p-6 sm:p-8 md:p-10 shadow-sm">
            <div class="flex flex-wrap items-center justify-between gap-4 mb-3">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-[#fff0f3] text-[#a8334e] border border-[#f1b7c1]">
                    <i class="fa-solid fa-earth-americas text-[#fd748e]"></i> Global Communities
                </span>
            </div>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-[#1b1b21] tracking-tight mb-2">Connect Across Borders, At Your Pace</h2>
            <p class="text-xs sm:text-sm leading-relaxed text-[#584143] max-w-3xl mb-6">
                CupDate city guides help intentional singles discover curated cafes, safe public venues, and thoughtful conversations. Availability reflects real verified registrations in each area.
            </p>
            <div class="grid grid-cols-2 gap-3 sm:grid-cols-4">
                @foreach($internationalCities as $slug => $name)
                    <a href="{{ route('city.show', $slug) }}" class="rounded-2xl border border-[#f0d6dc] bg-[#fff8fa] hover:bg-[#fff0f3] hover:border-[#b0284b]/60 px-4 py-3.5 text-xs font-bold text-[#a8334e] transition-all flex items-center justify-between group shadow-sm">
                        <span class="truncate">Dating in {{ $name }}</span>
                        <span class="text-[#fd748e] group-hover:translate-x-1 transition-transform">→</span>
                    </a>
                @endforeach
            </div>
        </section>

        <!-- Metro & Regional Hubs -->
        <section class="mb-12">
            <div class="mb-6">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-[#fff0f3] text-[#a8334e] border border-[#f1b7c1] mb-2">
                    <i class="fa-solid fa-compass text-[#fd748e]"></i> Major Hubs
                </span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-[#1b1b21] tracking-tight">Punjab, Chandigarh, Delhi &amp; Mumbai Hubs</h2>
                <p class="mt-1 text-xs sm:text-sm text-[#584143]">Explore local dating guides for North Indian communities and major metropolitans.</p>
            </div>
            <div class="grid grid-cols-2 gap-3 sm:grid-cols-3 lg:grid-cols-5">
                @foreach([
                    'amritsar' => 'Amritsar, Punjab',
                    'jalandhar' => 'Jalandhar, Punjab',
                    'patiala' => 'Patiala, Punjab',
                    'mohali' => 'Mohali, Punjab',
                    'chandigarh' => 'Chandigarh',
                    'delhi' => 'Delhi NCR',
                    'mumbai' => 'Mumbai, Maharashtra',
                    'pune' => 'Pune, Maharashtra',
                    'bangalore' => 'Bangalore, Karnataka',
                    'hyderabad' => 'Hyderabad, Telangana',
                ] as $slug => $name)
                    <a href="{{ route('city.show', $slug) }}" class="rounded-2xl border border-[#f0d6dc] bg-white hover:border-[#b0284b]/60 hover:bg-[#fff0f3] px-4 py-3 text-xs font-bold text-[#1b1b21] hover:text-[#b0284b] transition-all shadow-sm flex items-center justify-between group">
                        <span class="truncate">{{ $name }}</span>
                        <span class="text-[#dfbfc2] group-hover:text-[#b0284b] transition">→</span>
                    </a>
                @endforeach
            </div>
        </section>

        <!-- Cities Grid (Himachal & Core Featured Cities) -->
        <div class="mb-6">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-[#fff0f3] text-[#a8334e] border border-[#f1b7c1] mb-2">
                <i class="fa-solid fa-mug-hot text-[#fd748e]"></i> All Guides
            </span>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-[#1b1b21] tracking-tight">Featured Dating Cities &amp; Cafe Guides</h2>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mb-14">
            @foreach($cities as $slug => $c)
                <div class="bg-white border border-[#f0d6dc] rounded-3xl p-6 hover:border-[#b0284b]/60 hover:shadow-xl transition-all duration-200 flex flex-col justify-between shadow-sm group">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 rounded-2xl bg-[#fff0f3] border border-[#f1b7c1] text-[#b0284b] flex items-center justify-center text-xl shadow-sm group-hover:scale-105 transition-transform">
                                <i class="fa-solid fa-{{ $c['icon'] }}"></i>
                            </div>
                            <span class="text-[10px] font-extrabold text-emerald-800 bg-emerald-50 border border-emerald-200 px-2.5 py-0.5 rounded-full">
                                ★ {{ $c['safety_score'] }} Safety
                            </span>
                        </div>

                        <span class="text-[10px] uppercase font-extrabold text-[#a8334e] tracking-wider block">{{ $c['state'] }}</span>
                        <h3 class="font-extrabold text-lg text-[#1b1b21] mt-1 group-hover:text-[#b0284b] transition">{{ $c['name'] }}</h3>
                        <p class="text-xs text-[#584143] mt-2 leading-relaxed line-clamp-2">{{ $c['intro'] }}</p>

                        <div class="mt-4 pt-3 border-t border-[#f0d6dc]/60">
                            <span class="text-[11px] font-bold text-[#6c595f] block mb-1.5">Top Date Spots:</span>
                            <div class="flex flex-wrap gap-1.5">
                                @foreach(array_slice($c['popular_cafes'], 0, 2) as $spot)
                                    <span class="text-[10px] font-medium bg-[#fff8fa] text-[#1b1b21] border border-[#f1b7c1]/50 px-2.5 py-0.5 rounded-lg">
                                        ☕ {{ $spot }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 pt-3 border-t border-[#f0d6dc]/60">
                        <a href="{{ route('city.show', $slug) }}" class="w-full py-2.5 bg-gradient-to-r from-[#ff6584] to-[#b0284b] text-white rounded-xl text-center text-xs font-extrabold hover:brightness-105 transition block shadow-md shadow-[#ff6584]/20">
                            Explore {{ explode(',', $c['name'])[0] }} Singles →
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</div>
@endsection
