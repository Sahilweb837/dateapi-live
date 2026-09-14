@extends('layouts.app')

@section('title', 'Dating & Relationship Guides — CupDate Editorial')

@section('content')
<div class="max-w-5xl mx-auto px-4 py-10">
    <div class="text-center max-w-2xl mx-auto mb-10">
        <span class="inline-flex items-center gap-1.5 bg-[#f5ede6] text-[#8b5a2b] border border-[#e5d5ca] px-3.5 py-1 rounded-full text-xs font-bold uppercase tracking-wider mb-2 shadow-none">
            <i class="fa-solid fa-book-open"></i> Expert Coffee Dating Editorial
        </span>
        <h1 class="font-['Plus_Jakarta_Sans'] font-extrabold text-3xl md:text-4xl text-[#24140d]">
            CupDate Relationship Guides
        </h1>
        <p class="text-xs md:text-sm text-[#7a666c] mt-2">
            Thoughtful essays, safe first-meet protocols, and cafe etiquette for dating across Indian cities.
        </p>
    </div>

    <!-- Cornerstone Guides Showcase -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-12">
        <div class="bg-white border-2 border-[#8b5a2b] rounded-3xl p-6 flex flex-col justify-between shadow-none">
            <div>
                <span class="text-[11px] font-bold uppercase bg-[#f5ede6] text-[#8b5a2b] px-2.5 py-0.5 rounded-full border border-[#e5d5ca]">Cornerstone Guide</span>
                <h2 class="font-['Plus_Jakarta_Sans'] font-extrabold text-xl text-[#24140d] mt-3 mb-2">
                    The Ultimate Coffee Dating Etiquette Guide in India (2026 Edition)
                </h2>
                <p class="text-xs text-[#7a666c] leading-relaxed line-clamp-3">
                    Everything you need to know about navigating modern coffee dates in India: picking the right cafe ambiance, who pays & splitting bills, conversation topics, and graceful exit strategies.
                </p>
            </div>
            <div class="mt-6 pt-4 border-t border-[#e5d5ca] flex items-center justify-between">
                <span class="text-xs text-[#7a666c]">By Ananya Sharma • 8 min read</span>
                <a href="/blog/ultimate-coffee-dating-etiquette-india-2026.php" class="text-xs font-extrabold text-[#8b5a2b] hover:underline flex items-center gap-1">
                    Read Guide →
                </a>
            </div>
        </div>

        <div class="bg-white border-2 border-[#8b5a2b] rounded-3xl p-6 flex flex-col justify-between shadow-none">
            <div>
                <span class="text-[11px] font-bold uppercase bg-[#ecfdf5] text-[#065f46] px-2.5 py-0.5 rounded-full border border-[#a7f3d0]">Safety & Protection</span>
                <h2 class="font-['Plus_Jakarta_Sans'] font-extrabold text-xl text-[#24140d] mt-3 mb-2">
                    Women's Dating Safety Guide for India: Online Protection & Safe First Meets
                </h2>
                <p class="text-xs text-[#7a666c] leading-relaxed line-clamp-3">
                    A comprehensive manual on protecting your privacy, spotting red flags, emergency hotline protocols, and safe transit rules for meeting someone new.
                </p>
            </div>
            <div class="mt-6 pt-4 border-t border-[#e5d5ca] flex items-center justify-between">
                <span class="text-xs text-[#7a666c]">By Pooja Deshmukh • 9 min read</span>
                <a href="/blog/women-dating-safety-guide-india.php" class="text-xs font-extrabold text-[#065f46] hover:underline flex items-center gap-1">
                    Read Guide →
                </a>
            </div>
        </div>
    </div>

    <!-- All Articles Grid -->
    <h3 class="font-['Plus_Jakarta_Sans'] font-extrabold text-xl text-[#24140d] mb-6">Latest Articles</h3>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        @forelse($blogs as $blog)
            <div class="bg-white border border-[#e5d5ca] rounded-2xl p-5 flex flex-col justify-between hover:border-[#8b5a2b] transition shadow-none">
                <div>
                    <span class="text-[10px] font-bold text-[#8b5a2b] bg-[#f5ede6] border border-[#e5d5ca] px-2.5 py-0.5 rounded-full uppercase">
                        {{ $blog->category }}
                    </span>
                    <h4 class="font-['Plus_Jakarta_Sans'] font-bold text-base text-[#24140d] mt-2.5 mb-2 line-clamp-2">
                        <a href="{{ route('blog.show', $blog->slug) }}" class="hover:text-[#8b5a2b] transition">
                            {{ $blog->title }}
                        </a>
                    </h4>
                    <p class="text-xs text-[#7a666c] line-clamp-3 leading-relaxed">
                        {{ $blog->excerpt }}
                    </p>
                </div>
                <div class="mt-4 pt-3 border-t border-[#e5d5ca] flex items-center justify-between text-[11px] text-[#7a666c]">
                    <span>{{ $blog->created_at->format('M d, Y') }}</span>
                    <a href="{{ route('blog.show', $blog->slug) }}" class="font-bold text-[#8b5a2b] hover:underline">Read →</a>
                </div>
            </div>
        @empty
            <div class="col-span-3 text-center py-12 bg-[#fbf8f5] border border-[#e5d5ca] rounded-2xl shadow-none">
                <p class="text-xs text-[#7a666c]">More articles coming soon!</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
