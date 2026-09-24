@extends('layouts.app')

@section('title', 'Modern Dating & Relationship Guides — CupDate')
@section('meta_desc', 'Practical dating, safety, communication, and city guides for modern relationships across India.')

@section('content')
<div class="max-w-5xl mx-auto px-4 py-12 font-['Plus_Jakarta_Sans',sans-serif]">
    <!-- Header -->
    <div class="text-center max-w-2xl mx-auto mb-12">
        <span class="inline-flex items-center gap-1.5 bg-[#fff0f3] text-[#a8334e] border border-[#f1b7c1] px-3.5 py-1 rounded-full text-xs font-bold uppercase tracking-wider mb-3">
            <span class="material-symbols-outlined text-sm text-[#b0284b]">menu_book</span> CupDate Editorial
        </span>
        <h1 class="font-extrabold text-3xl md:text-5xl text-[#1b1b21] tracking-tight">
            Modern Dating &amp; Relationship Guides
        </h1>
        <p class="text-sm text-[#584143] mt-3 leading-relaxed">
            Thoughtful, practical guidance for safer first meets, better conversations, and intentional connections over coffee across India.
        </p>
    </div>

    <!-- Cornerstone Guides Showcase -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-12">
        <!-- Card 1 -->
        <div class="bg-white border border-[#f0d9df] hover:border-[#b0284b]/40 rounded-3xl p-7 flex flex-col justify-between shadow-xs hover:shadow-lg transition-all duration-300">
            <div>
                <span class="text-[11px] font-bold uppercase bg-[#ffd9dd] text-[#a8334e] px-3 py-1 rounded-full border border-[#f1b7c1] inline-block">
                    ★ Cornerstone Guide
                </span>
                <h2 class="font-extrabold text-xl text-[#1b1b21] mt-4 mb-2">
                    The Ultimate Coffee Dating Etiquette Guide in India (2026 Edition)
                </h2>
                <p class="text-xs sm:text-sm text-[#584143] leading-relaxed line-clamp-3">
                    Everything you need to know about navigating modern coffee dates in India: picking the right cafe ambiance, who pays &amp; splitting bills, conversation topics, and graceful exit strategies.
                </p>
            </div>
            <div class="mt-6 pt-4 border-t border-[#f0d9df] flex items-center justify-between text-xs text-[#584143]">
                <span>By Ananya Sharma • 8 min read</span>
                <a href="{{ route('blog.show', 'ultimate-coffee-dating-etiquette-india-2026') }}" class="font-extrabold text-[#b0284b] hover:underline flex items-center gap-1">
                    <span>Read Guide</span>
                    <span class="material-symbols-outlined text-sm">arrow_forward</span>
                </a>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="bg-white border border-[#f0d9df] hover:border-[#b0284b]/40 rounded-3xl p-7 flex flex-col justify-between shadow-xs hover:shadow-lg transition-all duration-300">
            <div>
                <span class="text-[11px] font-bold uppercase bg-emerald-100 text-emerald-800 px-3 py-1 rounded-full border border-emerald-200 inline-block">
                    🛡️ Safety &amp; Protection
                </span>
                <h2 class="font-extrabold text-xl text-[#1b1b21] mt-4 mb-2">
                    Women's Dating Safety Guide for India: Online Protection &amp; Safe First Meets
                </h2>
                <p class="text-xs sm:text-sm text-[#584143] leading-relaxed line-clamp-3">
                    A comprehensive manual on protecting your privacy, spotting red flags, emergency hotline protocols, and safe transit rules for meeting someone new.
                </p>
            </div>
            <div class="mt-6 pt-4 border-t border-[#f0d9df] flex items-center justify-between text-xs text-[#584143]">
                <span>By Pooja Deshmukh • 9 min read</span>
                <a href="{{ route('blog.show', 'women-dating-safety-guide-india') }}" class="font-extrabold text-emerald-700 hover:underline flex items-center gap-1">
                    <span>Read Guide</span>
                    <span class="material-symbols-outlined text-sm">arrow_forward</span>
                </a>
            </div>
        </div>
    </div>

    <!-- All Articles Grid -->
    <div class="flex items-center justify-between mb-6">
        <h3 class="font-extrabold text-2xl text-[#1b1b21]">Latest Articles</h3>
        <span class="text-xs text-[#584143] font-bold">{{ $blogs->count() }} guides published</span>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        @forelse($blogs as $blog)
            <div class="bg-white border border-[#f0d9df] hover:border-[#b0284b]/40 rounded-3xl p-6 flex flex-col justify-between shadow-xs hover:shadow-lg transition-all duration-300">
                <div>
                    <span class="text-[10px] font-bold text-[#a8334e] bg-[#fff0f3] border border-[#f1b7c1] px-2.5 py-0.5 rounded-full uppercase">
                        {{ $blog->category }}
                    </span>
                    <h4 class="font-extrabold text-base text-[#1b1b21] mt-3 mb-2 line-clamp-2">
                        <a href="{{ route('blog.show', $blog->slug) }}" class="hover:text-[#b0284b] transition">
                            {{ $blog->title }}
                        </a>
                    </h4>
                    <p class="text-xs text-[#584143] line-clamp-3 leading-relaxed">
                        {{ $blog->excerpt }}
                    </p>
                </div>
                <div class="mt-5 pt-3 border-t border-[#f0d9df] flex items-center justify-between text-xs text-[#584143]">
                    <span>{{ $blog->created_at->format('M d, Y') }}</span>
                    <a href="{{ route('blog.show', $blog->slug) }}" class="font-bold text-[#b0284b] hover:underline flex items-center gap-1">
                        <span>Read</span>
                        <span class="material-symbols-outlined text-xs">arrow_forward</span>
                    </a>
                </div>
            </div>
        @empty
            <div class="col-span-3 text-center py-12 bg-white border border-[#f0d9df] rounded-3xl">
                <span class="material-symbols-outlined text-3xl text-[#b0284b] mb-2">auto_stories</span>
                <p class="text-sm font-bold text-[#1b1b21]">More guides coming soon!</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
