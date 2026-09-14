@extends('layouts.app')

@section('title', $blog->title . ' — CupDate')
@section('meta_desc', $blog->excerpt)

@section('content')
<article class="max-w-3xl mx-auto px-4 py-10 font-['Inter']">
    <div class="mb-6">
        <span class="inline-block bg-[#f5ede6] text-[#8b5a2b] border border-[#e5d5ca] px-3.5 py-1 rounded-full text-xs font-bold uppercase tracking-wider mb-3 shadow-none">
            {{ $blog->category }}
        </span>
        <h1 class="font-['Plus_Jakarta_Sans'] font-extrabold text-3xl md:text-4xl text-[#24140d] leading-tight mb-3">
            {{ $blog->title }}
        </h1>
        <div class="flex items-center gap-4 text-xs text-[#7a666c] pb-6 border-b border-[#e5d5ca]">
            <span><i class="fa-regular fa-calendar mr-1"></i> {{ $blog->created_at->format('F d, Y') }}</span>
            <span><i class="fa-regular fa-clock mr-1"></i> 5 Min Read</span>
            <span><i class="fa-solid fa-shield-halved text-[#10b981] mr-1"></i> Verified Content</span>
        </div>
    </div>

    <!-- Article Content -->
    <div class="text-[#3b2d28] text-base leading-relaxed space-y-4 mb-10">
        {!! nl2br(e($blog->content)) !!}
    </div>

    <!-- Author & Trust Card -->
    <div class="bg-[#fbf8f5] border border-[#e5d5ca] rounded-3xl p-6 flex items-center gap-4 shadow-none">
        <img src="{{ asset('assets/images/default_avatar.png') }}" class="w-14 h-14 rounded-full object-cover border-2 border-[#8b5a2b]">
        <div>
            <strong class="font-['Plus_Jakarta_Sans'] font-bold text-sm text-[#24140d] block">CupDate Editorial Team</strong>
            <p class="text-xs text-[#7a666c] mt-0.5">Written by certified relationship coaches and coffee enthusiasts dedicated to healthy, verified dating over coffee.</p>
        </div>
    </div>
</article>
@endsection
