@extends('layouts.app')

@section('title', 'Meaningful Rishta & Matrimony Coffee Dating — CupDate')
@section('meta_desc', 'Connect with verified singles seeking meaningful relationships, courtship, and marriage across India and Himachal Pradesh over relaxed cafe conversations.')

@section('content')
<div class="max-w-5xl mx-auto px-4 py-12">
    <!-- Header Banner -->
    <div class="text-center mb-10 bg-white border border-[#e5d5ca] rounded-3xl p-8 md:p-12 shadow-none">
        <span class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-[#f5ede6] text-[#8b5a2b] border border-[#e5d5ca] mb-3">
            <i class="fa-solid fa-ring"></i> Long-Term Commitment
        </span>
        <h1 class="font-['Plus_Jakarta_Sans'] font-extrabold text-3xl md:text-5xl text-[#24140d] mb-4">
            CupDate Rishta & Matrimony
        </h1>
        <p class="text-sm md:text-base text-[#7d6558] max-w-2xl mx-auto leading-relaxed">
            Where modern dating meets authentic commitment. Meet verified singles and professionals looking for marriage and genuine life partners over low-pressure coffee dates.
        </p>
    </div>

    <!-- Verified Matrimony Singles Showcase -->
    <div class="mb-12">
        <div class="flex items-center justify-between mb-6">
            <h2 class="font-['Plus_Jakarta_Sans'] font-extrabold text-xl text-[#24140d]">
                Singles Looking for Meaningful Relationships
            </h2>
            <span class="text-xs font-bold text-[#065f46] bg-[#ecfdf5] border border-[#a7f3d0] px-3 py-1 rounded-full">
                100% Background & Selfie Verified
            </span>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
            @forelse($featuredSingles as $single)
                <div class="bg-white border border-[#e5d5ca] rounded-3xl overflow-hidden hover:border-[#8b5a2b] transition flex flex-col justify-between shadow-none">
                    <div>
                        <div class="h-52 bg-[#f5ede6] relative overflow-hidden">
                            <img src="{{ $single->avatar_url }}" alt="{{ $single->full_name }}" class="w-full h-full object-cover">
                            <div class="absolute bottom-3 left-3 right-3 text-white">
                                <strong class="text-base font-bold drop-shadow-sm block">{{ $single->full_name }}, {{ $single->age }}</strong>
                                <span class="text-[11px] text-white/90 drop-shadow-sm">{{ $single->country ?? 'India' }}</span>
                            </div>
                        </div>
                        <div class="p-4">
                            <span class="text-[10px] text-[#8b5a2b] uppercase font-bold block mb-1">Looking for Marriage</span>
                            <p class="text-xs text-[#7d6558] line-clamp-2">{{ $single->bio ?? 'Ready for genuine conversations and life partnership.' }}</p>
                        </div>
                    </div>
                    <div class="p-4 pt-0">
                        <a href="{{ route('profile', $single->id) }}" class="w-full py-2 bg-[#f5ede6] border border-[#e5d5ca] text-[#8b5a2b] rounded-xl text-center text-xs font-bold hover:bg-[#ede2d8] transition block shadow-none">
                            View Rishta Profile
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-4 text-center py-12 bg-white border border-[#e5d5ca] rounded-3xl text-xs text-[#7d6558] shadow-none">
                    Browse all verified singles in the Swipes deck!
                </div>
            @endforelse
        </div>
    </div>

    <!-- The Coffee Rishta Advantage -->
    <div class="bg-white border border-[#e5d5ca] rounded-3xl p-8 md:p-10 space-y-4 text-sm text-[#3b2d28] leading-relaxed shadow-none">
        <h3 class="font-['Plus_Jakarta_Sans'] font-extrabold text-2xl text-[#24140d]">Why Modern Indians Choose Coffee Courtship</h3>
        <p>
            Traditional arranged marriage meetings with large family panels can be intimidating, rigid, and transactional. CupDate Rishta allows prospective partners to meet one-on-one in relaxed, daytime cafes to talk honestly about core values, life goals, career aspirations, and emotional compatibility.
        </p>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 pt-4 text-xs">
            <div class="p-4 bg-[#fbf8f5] border border-[#e5d5ca] rounded-2xl">
                <strong class="text-[#8b5a2b] block mb-1 font-bold">1. Mutual Decision First</strong>
                <span>Both partners meet independently first to ensure authentic mutual attraction.</span>
            </div>
            <div class="p-4 bg-[#fbf8f5] border border-[#e5d5ca] rounded-2xl">
                <strong class="text-[#8b5a2b] block mb-1 font-bold">2. Zero Pressure</strong>
                <span>No awkward hotel buffets. A respectful 45-minute coffee lets you discover true shared values.</span>
            </div>
            <div class="p-4 bg-[#fbf8f5] border border-[#e5d5ca] rounded-2xl">
                <strong class="text-[#8b5a2b] block mb-1 font-bold">3. Safe & Transparent</strong>
                <span>Verified age, real photos, and strict anti-fraud background screening.</span>
            </div>
        </div>
    </div>
</div>
@endsection
