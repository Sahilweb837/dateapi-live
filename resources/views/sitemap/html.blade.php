@extends('layouts.app')

@section('title', 'Website Sitemap — CupDate')

@section('content')
<!-- Hero Section -->
<section class="relative bg-gradient-to-b from-[#f5ede6] to-[#fbf8f5] py-14 border-b border-[#e5d5ca]">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#f0e6dc] border border-[#d6c2b4] text-[#8b5a2b] text-xs font-bold uppercase tracking-wider mb-4 shadow-none">
            <i class="fa-solid fa-sitemap"></i> Complete Site Directory
        </span>
        <h1 class="font-['Plus_Jakarta_Sans'] font-extrabold text-3xl sm:text-4xl text-[#24140d] tracking-tight mb-3">
            CupDate <span class="text-[#8b5a2b]">Website Sitemap</span>
        </h1>
        <p class="font-['Inter'] text-xs sm:text-sm text-[#6b554b] max-w-xl mx-auto">
            Comprehensive index of all public pages, dating hubs, city guides, Himachal Pradesh mountain dates, and trust policies.
        </p>
    </div>
</section>

<section class="py-14 bg-[#fbf8f5]">
    <div class="max-w-5xl mx-auto px-4">
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            
            <!-- Card 1: Core Dating & Community -->
            <div class="bg-white border border-[#e5d5ca] rounded-3xl p-7 shadow-none space-y-4">
                <h2 class="font-['Plus_Jakarta_Sans'] font-extrabold text-lg text-[#24140d] flex items-center gap-2.5 pb-3 border-b border-[#e5d5ca]">
                    <i class="fa-solid fa-mug-hot text-[#8b5a2b]"></i> Core Dating & Community
                </h2>
                <ul class="space-y-2.5 text-xs sm:text-sm font-['Inter'] text-[#4a383e]">
                    <li><a href="{{ route('home') }}" class="hover:text-[#8b5a2b] font-medium flex items-center justify-between"><span>Home Page</span> <span class="text-[10px] text-[#8b5a2b] font-mono font-semibold">/</span></a></li>
                    <li><a href="{{ route('feed') }}" class="hover:text-[#8b5a2b] font-medium flex items-center justify-between"><span>Community Coffee Feed</span> <span class="text-[10px] text-[#8b5a2b] font-mono font-semibold">/feed</span></a></li>
                    <li><a href="{{ route('swipes') }}" class="hover:text-[#8b5a2b] font-medium flex items-center justify-between"><span>Discover Singles (Swipes)</span> <span class="text-[10px] text-[#8b5a2b] font-mono font-semibold">/swipes</span></a></li>
                    <li><a href="{{ route('messages') }}" class="hover:text-[#8b5a2b] font-medium flex items-center justify-between"><span>Real-time Chat & Photos</span> <span class="text-[10px] text-[#8b5a2b] font-mono font-semibold">/messages</span></a></li>
                    <li><a href="{{ route('video') }}" class="hover:text-[#8b5a2b] font-medium flex items-center justify-between"><span>1-on-1 Stranger Video</span> <span class="text-[10px] text-[#8b5a2b] font-mono font-semibold">/video</span></a></li>
                    <li><a href="{{ route('dates') }}" class="hover:text-[#8b5a2b] font-medium flex items-center justify-between"><span>Curated Cafe Spots Directory</span> <span class="text-[10px] text-[#8b5a2b] font-mono font-semibold">/dates</span></a></li>
                    <li><a href="{{ route('rishta') }}" class="hover:text-[#8b5a2b] font-medium flex items-center justify-between"><span>Rishta & Matrimony Hub</span> <span class="text-[10px] text-[#8b5a2b] font-mono font-semibold">/rishta</span></a></li>
                    <li><a href="{{ route('ai.bio.generator') }}" class="hover:text-[#8b5a2b] font-medium flex items-center justify-between"><span>AI Dating Bio Generator</span> <span class="text-[10px] text-[#8b5a2b] font-mono font-semibold">/ai-bio-generator</span></a></li>
                    <li><a href="{{ route('coffee.date.ideas') }}" class="hover:text-[#8b5a2b] font-medium flex items-center justify-between"><span>10 Coffee Date Ideas & Etiquette</span> <span class="text-[10px] text-[#8b5a2b] font-mono font-semibold">/coffee-date-ideas</span></a></li>
                </ul>
            </div>

            <!-- Card 2: Himachal Pradesh & City Hubs -->
            <div class="bg-white border border-[#e5d5ca] rounded-3xl p-7 shadow-none space-y-4">
                <h2 class="font-['Plus_Jakarta_Sans'] font-extrabold text-lg text-[#24140d] flex items-center gap-2.5 pb-3 border-b border-[#e5d5ca]">
                    <i class="fa-solid fa-mountain text-[#8b5a2b]"></i> Himachal Pradesh & Metro Hubs
                </h2>
                <ul class="space-y-2.5 text-xs sm:text-sm font-['Inter'] text-[#4a383e]">
                    <li><a href="{{ route('cities.index') }}" class="hover:text-[#8b5a2b] font-medium flex items-center justify-between"><span>All Cities Directory</span> <span class="text-[10px] text-[#8b5a2b] font-mono font-semibold">/cities</span></a></li>
                    <li><a href="{{ route('city.show', 'shimla') }}" class="hover:text-[#8b5a2b] font-medium flex items-center justify-between"><span>Shimla Mountain Dates</span> <span class="text-[10px] text-[#8b5a2b] font-mono font-semibold">/city/shimla</span></a></li>
                    <li><a href="{{ route('city.show', 'manali') }}" class="hover:text-[#8b5a2b] font-medium flex items-center justify-between"><span>Manali Alpine Dates</span> <span class="text-[10px] text-[#8b5a2b] font-mono font-semibold">/city/manali</span></a></li>
                    <li><a href="{{ route('city.show', 'dharamshala') }}" class="hover:text-[#8b5a2b] font-medium flex items-center justify-between"><span>Dharamshala & McLeodGanj</span> <span class="text-[10px] text-[#8b5a2b] font-mono font-semibold">/city/dharamshala</span></a></li>
                    <li><a href="{{ route('city.show', 'kasauli') }}" class="hover:text-[#8b5a2b] font-medium flex items-center justify-between"><span>Kasauli & Solan Hills</span> <span class="text-[10px] text-[#8b5a2b] font-mono font-semibold">/city/kasauli</span></a></li>
                    <li><a href="{{ route('city.show', 'pune') }}" class="hover:text-[#8b5a2b] font-medium flex items-center justify-between"><span>Pune Specialty Roasteries</span> <span class="text-[10px] text-[#8b5a2b] font-mono font-semibold">/city/pune</span></a></li>
                    <li><a href="{{ route('city.show', 'mumbai') }}" class="hover:text-[#8b5a2b] font-medium flex items-center justify-between"><span>Mumbai Heritage Bakehouses</span> <span class="text-[10px] text-[#8b5a2b] font-mono font-semibold">/city/mumbai</span></a></li>
                    <li><a href="{{ route('city.show', 'bangalore') }}" class="hover:text-[#8b5a2b] font-medium flex items-center justify-between"><span>Bangalore Micro-Lot Cafes</span> <span class="text-[10px] text-[#8b5a2b] font-mono font-semibold">/city/bangalore</span></a></li>
                    <li><a href="{{ route('city.show', 'delhi') }}" class="hover:text-[#8b5a2b] font-medium flex items-center justify-between"><span>Delhi NCR Champa Gali</span> <span class="text-[10px] text-[#8b5a2b] font-mono font-semibold">/city/delhi</span></a></li>
                    <li><a href="{{ route('city.show', 'chandigarh') }}" class="hover:text-[#8b5a2b] font-medium flex items-center justify-between"><span>Chandigarh Garden Cafes</span> <span class="text-[10px] text-[#8b5a2b] font-mono font-semibold">/city/chandigarh</span></a></li>
                </ul>
            </div>

            <!-- Card 3: Editorial Guides & Articles -->
            <div class="bg-white border border-[#e5d5ca] rounded-3xl p-7 shadow-none space-y-4">
                <h2 class="font-['Plus_Jakarta_Sans'] font-extrabold text-lg text-[#24140d] flex items-center gap-2.5 pb-3 border-b border-[#e5d5ca]">
                    <i class="fa-solid fa-newspaper text-[#8b5a2b]"></i> Editorial Guides & Blogs
                </h2>
                <ul class="space-y-2.5 text-xs sm:text-sm font-['Inter'] text-[#4a383e]">
                    <li><a href="{{ route('blog.index') }}" class="hover:text-[#8b5a2b] font-medium flex items-center justify-between"><span>Blog & Advice Index</span> <span class="text-[10px] text-[#8b5a2b] font-mono font-semibold">/blog</span></a></li>
                    @forelse($blogs as $b)
                        <li><a href="{{ route('blog.show', $b->slug) }}" class="hover:text-[#8b5a2b] font-medium flex items-center justify-between"><span>{{ $b->title }}</span> <span class="text-[10px] text-[#8b5a2b] font-mono font-semibold">/blog/{{ $b->slug }}</span></a></li>
                    @empty
                        <li><a href="/blog/ultimate-coffee-dating-etiquette-india-2026" class="hover:text-[#8b5a2b] font-medium">Ultimate Coffee Dating Etiquette Guide (2026)</a></li>
                        <li><a href="/blog/women-dating-safety-guide-india" class="hover:text-[#8b5a2b] font-medium">Women's Dating Safety Guide for India</a></li>
                        <li><a href="/blog/romantic-coffee-date-guide-himachal-pradesh" class="hover:text-[#8b5a2b] font-medium">The Mountain Romance Guide: Coffee Dates in Shimla & Manali</a></li>
                    @endforelse
                </ul>
            </div>

            <!-- Card 4: Trust, Safety & Legal (Google AdSense Approved) -->
            <div class="bg-white border border-[#e5d5ca] rounded-3xl p-7 shadow-none space-y-4">
                <h2 class="font-['Plus_Jakarta_Sans'] font-extrabold text-lg text-[#24140d] flex items-center gap-2.5 pb-3 border-b border-[#e5d5ca]">
                    <i class="fa-solid fa-shield-halved text-[#8b5a2b]"></i> Trust, Safety & Legal
                </h2>
                <ul class="space-y-2.5 text-xs sm:text-sm font-['Inter'] text-[#4a383e]">
                    <li><a href="{{ route('about') }}" class="hover:text-[#8b5a2b] font-medium flex items-center justify-between"><span>About CupDate</span> <span class="text-[10px] text-[#8b5a2b] font-mono font-semibold">/about</span></a></li>
                    <li><a href="{{ route('contact') }}" class="hover:text-[#8b5a2b] font-medium flex items-center justify-between"><span>Contact & Grievance Officer</span> <span class="text-[10px] text-[#8b5a2b] font-mono font-semibold">/contact</span></a></li>
                    <li><a href="{{ route('privacy') }}" class="hover:text-[#8b5a2b] font-medium flex items-center justify-between"><span>Privacy Policy (DPDP Act 2023)</span> <span class="text-[10px] text-[#8b5a2b] font-mono font-semibold">/privacy</span></a></li>
                    <li><a href="{{ route('terms') }}" class="hover:text-[#8b5a2b] font-medium flex items-center justify-between"><span>Terms of Service</span> <span class="text-[10px] text-[#8b5a2b] font-mono font-semibold">/terms</span></a></li>
                    <li><a href="{{ route('safety') }}" class="hover:text-[#8b5a2b] font-medium flex items-center justify-between"><span>Safety & Verification Center</span> <span class="text-[10px] text-[#8b5a2b] font-mono font-semibold">/safety</span></a></li>
                    <li><a href="{{ route('community.guidelines') }}" class="hover:text-[#8b5a2b] font-medium flex items-center justify-between"><span>Community Guidelines</span> <span class="text-[10px] text-[#8b5a2b] font-mono font-semibold">/community-guidelines</span></a></li>
                    <li><a href="{{ route('cookie.policy') }}" class="hover:text-[#8b5a2b] font-medium flex items-center justify-between"><span>Cookie Policy</span> <span class="text-[10px] text-[#8b5a2b] font-mono font-semibold">/cookie-policy</span></a></li>
                    <li><a href="{{ route('faq') }}" class="hover:text-[#8b5a2b] font-medium flex items-center justify-between"><span>Frequently Asked Questions</span> <span class="text-[10px] text-[#8b5a2b] font-mono font-semibold">/faq</span></a></li>
                    <li><a href="{{ route('how.it.works') }}" class="hover:text-[#8b5a2b] font-medium flex items-center justify-between"><span>How CupDate Works</span> <span class="text-[10px] text-[#8b5a2b] font-mono font-semibold">/how-it-works</span></a></li>
                    <li><a href="{{ route('disclaimer') }}" class="hover:text-[#8b5a2b] font-medium flex items-center justify-between"><span>Website Disclaimer</span> <span class="text-[10px] text-[#8b5a2b] font-mono font-semibold">/disclaimer</span></a></li>
                    <li><a href="{{ route('sitemap.xml') }}" target="_blank" class="hover:text-[#8b5a2b] font-medium flex items-center justify-between"><span>Machine-Readable XML</span> <span class="text-[10px] text-[#8b5a2b] font-mono font-semibold">/sitemap.xml</span></a></li>
                </ul>
            </div>

        </div>

    </div>
</section>
@endsection
