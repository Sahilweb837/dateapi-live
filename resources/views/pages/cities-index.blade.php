@extends('layouts.app')

@section('title', 'Cities Directory — Coffee Dating Across India & Himachal Pradesh | CupDate')
@section('meta_desc', 'Discover verified singles and partner specialty cafes across Shimla, Manali, Dharamshala, Pune, Mumbai, Bangalore, Delhi NCR, and Chandigarh.')

@section('content')
<div class="max-w-5xl mx-auto px-4 py-12 font-['Inter']">
    <!-- Header -->
    <div class="text-center mb-10 bg-white border border-[#e5d5ca] rounded-3xl p-8 md:p-12 shadow-none">
        <span class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-[#f5ede6] text-[#8b5a2b] border border-[#e5d5ca] mb-3">
            <i class="fa-solid fa-map-location-dot"></i> Regional Hubs
        </span>
        <h1 class="font-['Plus_Jakarta_Sans'] font-extrabold text-3xl md:text-5xl text-[#24140d] mb-4">
            Dating Cities Across India
        </h1>
        <p class="text-sm md:text-base text-[#7d6558] max-w-xl mx-auto leading-relaxed">
            From the tranquil mountain trails of Himachal Pradesh to India's bustling tech and cultural metros, discover verified singles and curated landmark cafes.
        </p>
    </div>

    <!-- Cities Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mb-12">
        @foreach($cities as $slug => $c)
            <div class="bg-white border border-[#e5d5ca] rounded-3xl p-6 hover:border-[#8b5a2b] transition flex flex-col justify-between shadow-none">
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 rounded-2xl bg-[#f5ede6] border border-[#e5d5ca] text-[#8b5a2b] flex items-center justify-center text-xl">
                            <i class="fa-solid fa-{{ $c['icon'] }}"></i>
                        </div>
                        <span class="text-[10px] font-bold text-[#065f46] bg-[#ecfdf5] border border-[#a7f3d0] px-2.5 py-0.5 rounded-full">
                            ★ {{ $c['safety_score'] }} Safety
                        </span>
                    </div>

                    <span class="text-[10px] uppercase font-bold text-[#8b5a2b] tracking-wider block">{{ $c['state'] }}</span>
                    <h2 class="font-['Plus_Jakarta_Sans'] font-extrabold text-lg text-[#24140d] mt-1">{{ $c['name'] }}</h2>
                    <p class="text-xs text-[#7d6558] mt-2 leading-relaxed line-clamp-2">{{ $c['intro'] }}</p>

                    <div class="mt-4 pt-3 border-t border-[#e5d5ca]">
                        <span class="text-[11px] font-bold text-[#7d6558] block mb-1.5">Top Date Spots:</span>
                        <div class="flex flex-wrap gap-1.5">
                            @foreach(array_slice($c['popular_cafes'], 0, 2) as $spot)
                                <span class="text-[10px] bg-[#fbf8f5] text-[#24140d] border border-[#e5d5ca] px-2 py-0.5 rounded-lg">
                                    {{ $spot }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="mt-6 pt-3 border-t border-[#e5d5ca]">
                    <a href="{{ route('city.show', $slug) }}" class="w-full py-2 bg-[#8b5a2b] text-white rounded-xl text-center text-xs font-bold hover:bg-[#6d421d] transition block shadow-none">
                        Explore {{ explode(',', $c['name'])[0] }} Singles →
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
