@extends('layouts.app')

@section('title', $blog->title . ' — CupDate Editorial')
@section('meta_desc', $blog->excerpt)

@section('extra_head')
    <meta property="og:type" content="article">
    <meta property="article:published_time" content="{{ optional($blog->created_at)->toIso8601String() }}">
    <script type="application/ld+json">
    {
        "@@context": "https://schema.org",
        "@type": "Article",
        "headline": "{{ addslashes($blog->title) }}",
        "description": "{{ addslashes($blog->excerpt) }}",
        "datePublished": "{{ optional($blog->created_at)->toIso8601String() }}",
        "author": {
            "@type": "Organization",
            "name": "CupDate Editorial Team"
        },
        "publisher": {
            "@type": "Organization",
            "name": "CupDate",
            "logo": {
                "@type": "ImageObject",
                "url": "{{ asset('assets/images/cupdate_logo.svg') }}"
            }
        },
        "mainEntityOfPage": "{{ url()->current() }}"
    }
    </script>
@endsection

@section('content')
<article class="max-w-3xl mx-auto px-4 py-12 font-['Plus_Jakarta_Sans',sans-serif]">
    <!-- Breadcrumb -->
    <nav class="flex items-center gap-2 text-xs text-[#584143] mb-6">
        <a href="{{ route('home') }}" class="hover:text-[#b0284b]">Home</a>
        <span>/</span>
        <a href="{{ route('blog.index') }}" class="hover:text-[#b0284b]">Guides</a>
        <span>/</span>
        <span class="text-[#1b1b21] font-bold truncate max-w-xs">{{ $blog->title }}</span>
    </nav>

    <!-- Header -->
    <div class="mb-8">
        <span class="inline-block bg-[#fff0f3] text-[#a8334e] border border-[#f1b7c1] px-3.5 py-1 rounded-full text-xs font-extrabold uppercase tracking-wider mb-4">
            {{ $blog->category }}
        </span>
        <h1 class="font-extrabold text-3xl sm:text-4xl md:text-5xl text-[#1b1b21] leading-tight tracking-tight mb-4">
            {{ $blog->title }}
        </h1>
        <div class="flex flex-wrap items-center gap-4 text-xs text-[#584143] pb-6 border-b border-[#f0d9df]">
            <span class="flex items-center gap-1">
                <span class="material-symbols-outlined text-sm text-[#b0284b]">calendar_today</span>
                <span>{{ $blog->created_at->format('F d, Y') }}</span>
            </span>
            <span>•</span>
            <span class="flex items-center gap-1">
                <span class="material-symbols-outlined text-sm text-[#b0284b]">schedule</span>
                <span>5 Min Read</span>
            </span>
            <span>•</span>
            <span class="flex items-center gap-1 text-emerald-700 font-bold">
                <span class="material-symbols-outlined text-sm text-emerald-600">verified</span>
                <span>Verified Guide</span>
            </span>
        </div>
    </div>

    <!-- Article Content -->
    <div class="text-[#3b2d28] text-base leading-relaxed space-y-6 mb-12">
        {!! nl2br(e($blog->content)) !!}
    </div>

    <!-- Author & Trust Card with Lazy Skeleton -->
    <div class="bg-white border border-[#f0d9df] rounded-3xl p-6 flex items-center gap-4 shadow-sm">
        <div class="w-14 h-14 rounded-full overflow-hidden shrink-0 border-2 border-[#b0284b] img-skeleton-wrapper">
            <img src="{{ asset('assets/images/default_avatar.png') }}" alt="CupDate Editorial Team" class="w-full h-full object-cover" loading="lazy">
        </div>
        <div>
            <strong class="font-extrabold text-sm text-[#1b1b21] block">CupDate Editorial &amp; Safety Team</strong>
            <p class="text-xs text-[#584143] mt-1">Written by our safety researchers and matchmaking advocates to support safer, kinder, and more genuine modern dating.</p>
        </div>
    </div>

    <!-- Back Link -->
    <div class="mt-8 text-center">
        <a href="{{ route('blog.index') }}" class="inline-flex items-center gap-1 text-xs font-bold text-[#b0284b] hover:underline">
            <span class="material-symbols-outlined text-sm">arrow_back</span>
            <span>Back to All Dating Guides</span>
        </a>
    </div>
</article>
@endsection
