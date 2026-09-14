@extends('layouts.app')

@section('title', 'Curated Coffee Date Spots Across India & Himachal Pradesh — CupDate')
@section('meta_desc', 'Explore partner specialty coffee shops in Shimla, Manali, Pune, Mumbai, Bangalore, and Delhi NCR offering exclusive 15% CupDate member date discounts.')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-12">
    <!-- Header -->
    <div class="text-center mb-10 bg-white border border-[#e5d5ca] rounded-3xl p-8 md:p-12 shadow-none">
        <span class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-[#f5ede6] text-[#8b5a2b] border border-[#e5d5ca] mb-3">
            <i class="fa-solid fa-mug-hot"></i> Verified Date Venues
        </span>
        <h1 class="font-['Plus_Jakarta_Sans'] font-extrabold text-3xl md:text-5xl text-[#24140d] mb-4">
            Curated Landmark Cafes
        </h1>
        <p class="text-sm md:text-base text-[#7d6558] max-w-2xl mx-auto leading-relaxed">
            Every cafe is hand-selected for acoustic comfort, aesthetic seating, safe public visibility, and exclusive 15% CupDate member perks.
        </p>

        <!-- City Filter Pills -->
        <div class="flex flex-wrap items-center justify-center gap-2 mt-6">
            <a href="{{ route('dates') }}" class="px-3.5 py-1.5 rounded-full text-xs font-bold transition {{ !$city ? 'bg-[#8b5a2b] text-white' : 'bg-[#f5ede6] text-[#8b5a2b] hover:bg-[#ede2d8]' }} border border-[#e5d5ca]">
                All Cities
            </a>
            @foreach($cities as $c)
                <a href="{{ route('dates', ['city' => $c]) }}" class="px-3.5 py-1.5 rounded-full text-xs font-bold transition {{ $city === $c ? 'bg-[#8b5a2b] text-white' : 'bg-[#f5ede6] text-[#8b5a2b] hover:bg-[#ede2d8]' }} border border-[#e5d5ca]">
                    {{ $c }}
                </a>
            @endforeach
        </div>
    </div>

    <!-- Cafes Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
        @forelse($places as $place)
            <div class="bg-white border border-[#e5d5ca] rounded-3xl overflow-hidden hover:border-[#8b5a2b] transition flex flex-col justify-between shadow-none">
                <div>
                    <div class="h-48 bg-[#f5ede6] relative overflow-hidden">
                        <img src="{{ asset($place->image_url ?? 'assets/images/default_cafe.jpg') }}" 
                             alt="{{ $place->name }}" 
                             class="w-full h-full object-cover"
                             onerror="this.onerror=null;this.src='{{ asset('assets/images/default_cafe.jpg') }}';">
                        <div class="absolute top-3 left-3 bg-[#24140d]/80 backdrop-blur text-white text-[10px] font-bold px-2.5 py-1 rounded-full flex items-center gap-1">
                            <i class="fa-solid fa-location-dot text-[#c8894f]"></i> {{ $place->city }}
                        </div>
                        <div class="absolute top-3 right-3 bg-white/95 text-[#d97706] text-xs font-extrabold px-2 py-0.5 rounded-full flex items-center gap-1">
                            ★ {{ $place->rating }}
                        </div>
                    </div>

                    <div class="p-5">
                        <span class="text-[10px] uppercase font-extrabold text-[#8b5a2b] tracking-wider block">{{ $place->type }}</span>
                        <h2 class="font-['Plus_Jakarta_Sans'] font-extrabold text-lg text-[#24140d] mt-1">{{ $place->name }}</h2>
                        <p class="text-xs text-[#7d6558] mt-1.5 leading-relaxed line-clamp-2">{{ $place->description }}</p>
                        <p class="text-[11px] text-[#7d6558] mt-3 flex items-center gap-1.5">
                            <i class="fa-solid fa-map-pin text-[#8b5a2b]"></i> {{ $place->address }}
                        </p>
                    </div>
                </div>

                <div class="p-5 pt-0 border-t border-[#e5d5ca] mt-2 flex items-center justify-between">
                    <span class="text-xs font-bold text-[#065f46] bg-[#ecfdf5] border border-[#a7f3d0] px-2.5 py-1 rounded-full flex items-center gap-1">
                        <i class="fa-solid fa-tag"></i> {{ $place->cup_offer ?? '15% Off Total Bill' }}
                    </span>
                    <a href="{{ route('feed') }}" class="text-xs font-bold text-[#8b5a2b] hover:underline flex items-center gap-1">
                        Ask on Date →
                    </a>
                </div>
            </div>
        @empty
            <div class="col-span-3 text-center py-16 bg-white border border-[#e5d5ca] rounded-3xl text-xs text-[#7d6558] shadow-none">
                No cafes listed in this city yet. Check back soon!
            </div>
        @endforelse
    </div>
</div>
@endsection
