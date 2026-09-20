@extends('layouts.app')

@section('title', 'CupDate — Modern Dating for Genuine Connections')
@section('meta_desc', 'Meet verified singles near you, start with a real conversation, and plan a date that feels natural. CupDate is modern dating with more intention.')

@section('content')
<div class="min-h-screen bg-[#fffaf8] text-[#281719]">
    <section class="relative overflow-hidden">
        <div class="absolute -right-24 -top-24 h-72 w-72 rounded-full bg-[#ffdfe3] blur-3xl"></div>
        <div class="mx-auto grid max-w-7xl items-center gap-10 px-5 pb-16 pt-12 sm:px-8 lg:grid-cols-[1.05fr_.95fr] lg:px-12 lg:pb-24 lg:pt-20">
            <div class="relative z-10">
                <span class="mb-5 inline-flex items-center gap-2 rounded-full border border-[#f5c7cd] bg-white px-3 py-1.5 text-xs font-bold uppercase tracking-[.14em] text-[#c94f63]">
                    <span class="h-2 w-2 rounded-full bg-[#e87a88]"></span> Dating, with intention
                </span>
                <h1 class="max-w-xl font-['Playfair_Display'] text-5xl font-semibold leading-[1.05] tracking-tight sm:text-6xl">
                    Meet someone who feels like <span class="text-[#e06b7b]">home.</span>
                </h1>
                <p class="mt-6 max-w-lg text-base leading-7 text-[#745d61] sm:text-lg">
                    A calmer way to date: verified people, honest profiles, and conversations that go beyond a swipe.
                    Find your kind of connection in your city.
                </p>
                <div class="mt-8 flex flex-wrap gap-3">
                    @guest
                        <a href="{{ route('register') }}" class="rounded-full bg-[#e87a88] px-6 py-3.5 text-sm font-extrabold text-white shadow-lg shadow-[#e87a88]/20 transition hover:bg-[#d96173]">Join CupDate</a>
                        <a href="{{ route('login') }}" class="rounded-full border border-[#edc7ca] bg-white px-6 py-3.5 text-sm font-extrabold text-[#9c4b59] transition hover:bg-[#fff0f1]">I have an account</a>
                    @else
                        <a href="{{ route('swipes') }}" class="rounded-full bg-[#e87a88] px-6 py-3.5 text-sm font-extrabold text-white shadow-lg shadow-[#e87a88]/20 transition hover:bg-[#d96173]">Explore your matches</a>
                    @endguest
                </div>
                <div class="mt-8 flex flex-wrap gap-5 text-xs font-semibold text-[#856f73]">
                    <span class="inline-flex items-center gap-1.5"><span class="material-symbols-outlined text-base text-[#e87a88]">verified_user</span> Profiles you can trust</span>
                    <span class="inline-flex items-center gap-1.5"><span class="material-symbols-outlined text-base text-[#e87a88]">favorite</span> No pressure, no games</span>
                </div>
            </div>
            <div class="relative mx-auto w-full max-w-md">
                <div class="absolute -left-5 top-12 h-28 w-28 rounded-[2rem] bg-[#ffd5da]"></div>
                <div class="absolute -right-5 bottom-6 h-32 w-32 rounded-full bg-[#ffe9c8]"></div>
                <div class="relative rounded-[2.5rem] border-8 border-white bg-gradient-to-br from-[#f7a8b2] via-[#f3c4b9] to-[#f9dfc4] p-5 shadow-2xl">
                    <div class="flex items-center justify-between rounded-2xl bg-white/80 px-4 py-3 backdrop-blur">
                        <div><p class="text-[10px] font-bold uppercase tracking-widest text-[#9c7d81]">Your people</p><p class="font-extrabold">Around you</p></div>
                        <span class="material-symbols-outlined text-[#e06b7b]">favorite</span>
                    </div>
                    <div class="mt-4 grid grid-cols-2 gap-3">
                        @forelse($featuredDaters->take(4) as $dater)
                            <div class="overflow-hidden rounded-3xl bg-white shadow-sm">
                                <img src="{{ $dater->avatar ? asset($dater->avatar) : asset('assets/images/default_avatar.png') }}" alt="{{ $dater->name }}" loading="lazy" class="aspect-[.85] w-full object-cover">
                                <div class="p-3"><p class="truncate text-sm font-extrabold">{{ $dater->name }}</p><p class="text-[11px] text-[#92777b]">{{ $dater->city ?? 'Near you' }}</p></div>
                            </div>
                        @empty
                            <div class="col-span-2 rounded-3xl bg-white/80 p-8 text-center text-sm text-[#856f73]">New connections are joining every day.</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="border-y border-[#f2dfe0] bg-white">
        <div class="mx-auto grid max-w-7xl gap-6 px-5 py-10 sm:grid-cols-3 sm:px-8 lg:px-12">
            <div><span class="material-symbols-outlined text-[#e87a88]">person_search</span><h2 class="mt-2 font-extrabold">Start with compatibility</h2><p class="mt-1 text-sm leading-6 text-[#856f73]">Share what matters to you and discover people with aligned energy.</p></div>
            <div><span class="material-symbols-outlined text-[#e87a88]">forum</span><h2 class="mt-2 font-extrabold">Have a real conversation</h2><p class="mt-1 text-sm leading-6 text-[#856f73]">Take your time. Good connections do not need a performance.</p></div>
            <div><span class="material-symbols-outlined text-[#e87a88]">local_activity</span><h2 class="mt-2 font-extrabold">Make it a good date</h2><p class="mt-1 text-sm leading-6 text-[#856f73]">Find thoughtful date ideas and places in your city.</p></div>
        </div>
    </section>

    @if($editorialBlogs->isNotEmpty())
        <section class="mx-auto max-w-7xl px-5 py-14 sm:px-8 lg:px-12">
            <div class="flex items-end justify-between gap-4"><div><p class="text-xs font-bold uppercase tracking-widest text-[#c94f63]">From the journal</p><h2 class="mt-2 font-['Playfair_Display'] text-3xl font-semibold">Better dates start here.</h2></div><a href="{{ route('blog.index') }}" class="text-sm font-bold text-[#c94f63]">Read all guides <span aria-hidden="true">→</span></a></div>
            <div class="mt-7 grid gap-5 md:grid-cols-3">
                @foreach($editorialBlogs as $blog)
                    <a href="{{ route('blog.show', $blog->slug) }}" class="rounded-3xl border border-[#f0d9d6] bg-white p-5 transition hover:-translate-y-1 hover:shadow-lg">
                        <span class="text-[10px] font-bold uppercase tracking-widest text-[#c94f63]">{{ $blog->category }}</span>
                        <h3 class="mt-3 line-clamp-2 font-extrabold">{{ $blog->title }}</h3>
                        <p class="mt-2 line-clamp-3 text-sm leading-6 text-[#856f73]">{{ $blog->excerpt }}</p>
                    </a>
                @endforeach
            </div>
        </section>
    @endif
</div>
@endsection
