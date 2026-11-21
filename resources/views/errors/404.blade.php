@extends('layouts.app')

@section('title', '404 Page Not Found — CupDate')
@section('meta_desc', 'Looking for love in the wrong place? This page cannot be found, but thousands of verified singles in Himachal Pradesh and India are waiting.')
@section('robots', 'noindex, follow')

@section('content')
<div class="min-h-[75vh] flex items-center justify-center px-4 py-16 bg-[#fffafc]">
    <div class="max-w-xl w-full text-center">
        <!-- Badge -->
        <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider bg-[#ffd9dd] text-[#a8334e] mb-4">
            <span class="text-base">☕</span> 404 • Page Not Found
        </span>

        <h1 class="text-4xl sm:text-5xl font-black text-[#1b1b21] tracking-tight">
            Looking for Love in the Wrong Corner?
        </h1>

        <p class="mt-4 text-sm sm:text-base text-[#584143] leading-relaxed max-w-md mx-auto">
            The link you followed may be old or mistyped. Don't worry — genuine conversation and verified 45-minute coffee dates are just a click away.
        </p>

        <!-- Search Bar / Action Buttons -->
        <div class="mt-8 flex flex-wrap items-center justify-center gap-3">
            <a href="{{ route('home') }}" class="px-6 py-3 rounded-full bg-gradient-to-r from-[#ff6584] to-[#b0284b] text-white font-extrabold text-sm shadow-md hover:brightness-105 active:scale-95 transition">
                Return to Homepage ♥
            </a>
            <a href="{{ route('cities.index') }}" class="px-6 py-3 rounded-full border border-[#dfbfc2] bg-white text-[#a8334e] font-extrabold text-sm hover:bg-[#fff0f3] active:scale-95 transition">
                Browse Singles by City
            </a>
            <a href="{{ route('dates') }}" class="px-6 py-3 rounded-full border border-[#dfbfc2] bg-white text-[#584143] font-extrabold text-sm hover:bg-[#fff0f3] active:scale-95 transition">
                Curated Coffee Spots
            </a>
        </div>

        <!-- Quick City Links (SEO recovery) -->
        <div class="mt-12 pt-8 border-t border-[#f0d9df] text-xs text-[#584143]">
            <p class="font-bold uppercase tracking-wider text-[#a8334e] mb-3">Popular Dating Hubs:</p>
            <div class="flex flex-wrap justify-center gap-2">
                <a href="{{ route('city.show', 'shimla') }}" class="px-3 py-1 rounded-full bg-white border border-[#f0d9df] hover:border-[#b0284b] hover:text-[#b0284b] transition">Shimla</a>
                <a href="{{ route('city.show', 'manali') }}" class="px-3 py-1 rounded-full bg-white border border-[#f0d9df] hover:border-[#b0284b] hover:text-[#b0284b] transition">Manali</a>
                <a href="{{ route('city.show', 'dharamshala') }}" class="px-3 py-1 rounded-full bg-white border border-[#f0d9df] hover:border-[#b0284b] hover:text-[#b0284b] transition">Dharamshala</a>
                <a href="{{ route('city.show', 'chandigarh') }}" class="px-3 py-1 rounded-full bg-white border border-[#f0d9df] hover:border-[#b0284b] hover:text-[#b0284b] transition">Chandigarh</a>
                <a href="{{ route('city.show', 'delhi') }}" class="px-3 py-1 rounded-full bg-white border border-[#f0d9df] hover:border-[#b0284b] hover:text-[#b0284b] transition">Delhi NCR</a>
                <a href="{{ route('city.show', 'pune') }}" class="px-3 py-1 rounded-full bg-white border border-[#f0d9df] hover:border-[#b0284b] hover:text-[#b0284b] transition">Pune</a>
                <a href="{{ route('city.show', 'mumbai') }}" class="px-3 py-1 rounded-full bg-white border border-[#f0d9df] hover:border-[#b0284b] hover:text-[#b0284b] transition">Mumbai</a>
                <a href="{{ route('city.show', 'bangalore') }}" class="px-3 py-1 rounded-full bg-white border border-[#f0d9df] hover:border-[#b0284b] hover:text-[#b0284b] transition">Bangalore</a>
            </div>
        </div>
    </div>
</div>
@endsection
