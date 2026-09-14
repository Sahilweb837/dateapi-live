@extends('layouts.app')

@section('title', 'Dating in ' . $city['name'] . ' — Meet Verified Singles | CupDate')
@section('meta_desc', 'Connect with verified singles in ' . $city['name'] . ' for low-pressure 45-minute coffee dates at landmark cafes. 100% selfie-verified, safe, and respectful.')

@section('content')
<div class="max-w-5xl mx-auto px-4 py-12 font-['Inter']">
    <!-- City Hero -->
    <div class="text-center mb-10 bg-white border border-[#e5d5ca] rounded-3xl p-8 md:p-12 shadow-none">
        <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-[#f5ede6] text-[#8b5a2b] border border-[#e5d5ca] mb-3">
            <i class="fa-solid fa-{{ $city['icon'] ?? 'mug-hot' }}"></i> {{ $city['state'] }}
        </div>
        <h1 class="font-['Plus_Jakarta_Sans'] font-extrabold text-3xl md:text-5xl text-[#24140d] mb-4">
            {{ $city['headline'] }}
        </h1>
        <p class="text-sm md:text-base text-[#7d6558] max-w-2xl mx-auto leading-relaxed">
            {{ $city['intro'] }}
        </p>

        <!-- Trust Badges -->
        <div class="mt-6 flex flex-wrap items-center justify-center gap-4 text-xs font-bold">
            <span class="inline-flex items-center gap-1.5 bg-[#ecfdf5] text-[#065f46] border border-[#a7f3d0] px-3 py-1 rounded-full">
                <i class="fa-solid fa-shield-check"></i> {{ $city['safety_score'] }} Women Safety Score
            </span>
            <span class="inline-flex items-center gap-1.5 bg-[#fbf8f5] text-[#8b5a2b] border border-[#e5d5ca] px-3 py-1 rounded-full">
                <i class="fa-solid fa-mug-saucer"></i> 15% Partner Cafe Discount
            </span>
            <span class="inline-flex items-center gap-1.5 bg-[#fbf8f5] text-[#24140d] border border-[#e5d5ca] px-3 py-1 rounded-full">
                <i class="fa-solid fa-user-check text-[#10b981]"></i> 100% Selfie Verified
            </span>
        </div>
    </div>

    <!-- Verified Singles in City Showcase -->
    <div class="mb-12">
        <div class="flex items-center justify-between mb-6">
            <h2 class="font-['Plus_Jakarta_Sans'] font-extrabold text-xl text-[#24140d]">
                Verified Singles in {{ explode(',', $city['name'])[0] }}
            </h2>
            <a href="{{ route('swipes') }}" class="text-xs font-bold text-[#8b5a2b] hover:underline">
                View All Singles →
            </a>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-6 gap-4">
            @forelse($singles as $single)
                <a href="{{ route('profile', $single->id) }}" class="bg-white border border-[#e5d5ca] rounded-2xl p-3 text-center group hover:border-[#8b5a2b] transition flex flex-col items-center shadow-none">
                    <div class="relative mb-2">
                        <img src="{{ $single->avatar_url }}" alt="{{ $single->full_name }}" class="w-16 h-16 rounded-full object-cover border-2 border-[#8b5a2b]">
                        @if($single->is_verified)
                            <i class="fa-solid fa-circle-check text-[#8b5a2b] text-xs absolute bottom-0 right-0 bg-white rounded-full"></i>
                        @endif
                    </div>
                    <strong class="text-xs font-bold text-[#24140d] truncate max-w-[90px] block">{{ explode(' ', $single->full_name)[0] }}</strong>
                    <span class="text-[10px] text-[#7d6558]">{{ $single->age }} yrs • {{ $single->coffee_style ?? 'Latte' }}</span>
                </a>
            @empty
                <div class="col-span-6 text-center py-8 text-xs text-[#7d6558]">
                    New singles are joining daily in this region!
                </div>
            @endforelse
        </div>
    </div>

    <!-- Curated Cafes in this City -->
    @if($cafes->isNotEmpty())
        <div class="mb-12">
            <h2 class="font-['Plus_Jakarta_Sans'] font-extrabold text-xl text-[#24140d] mb-4">
                Recommended First Date Cafes in {{ explode(',', $city['name'])[0] }}
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($cafes as $cafe)
                    <div class="bg-white border border-[#e5d5ca] rounded-3xl p-5 flex items-center justify-between shadow-none">
                        <div>
                            <span class="text-[10px] uppercase font-bold text-[#8b5a2b] block">{{ $cafe->type }}</span>
                            <h3 class="font-bold text-base text-[#24140d]">{{ $cafe->name }}</h3>
                            <p class="text-xs text-[#7d6558] mt-1">{{ $cafe->address }}</p>
                            <span class="mt-2 inline-flex items-center gap-1 text-[11px] font-bold text-[#065f46] bg-[#ecfdf5] border border-[#a7f3d0] px-2 py-0.5 rounded-full">
                                <i class="fa-solid fa-tag"></i> {{ $cafe->cup_offer ?? '15% Off with CupDate' }}
                            </span>
                        </div>
                        <a href="{{ route('feed') }}" class="px-4 py-2 bg-[#8b5a2b] text-white rounded-xl text-xs font-bold hover:bg-[#6d421d] transition shrink-0 shadow-none">
                            Ask Out
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Local Dating Etiquette & Safety Advice -->
    <div class="bg-white border border-[#e5d5ca] rounded-3xl p-8 space-y-4 text-sm text-[#3b2d28] leading-relaxed shadow-none">
        <h3 class="font-['Plus_Jakarta_Sans'] font-extrabold text-xl text-[#24140d]">
            Dating Etiquette in {{ $city['name'] }}
        </h3>
        <p>
            Whether you are sitting on an open veranda facing the snow-capped Himalayan peaks in Shimla and Manali or sharing cold brew in a trendy Koregaon Park roastery, mutual respect is key.
        </p>
        <p>
            CupDate recommends scheduling daytime coffee dates between 11:00 AM and 5:00 PM. Keep the initial meetup to 45 minutes to ease conversational tension. Splitting the bill or exchanging a polite treat is modern etiquette in India.
        </p>
    </div>
</div>
@endsection
