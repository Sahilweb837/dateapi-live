@extends('layouts.app')

@section('title', 'Best Coffee Date Ideas & First Date Etiquette Guide — CupDate')

@section('content')
<!-- Hero Section -->
<section class="relative bg-gradient-to-b from-[#f5ede6] to-[#fbf8f5] py-16 border-b border-[#e5d5ca]">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <nav aria-label="Breadcrumb" class="mb-4">
            <ol class="inline-flex items-center gap-2 text-xs font-semibold text-[#8b5a2b] uppercase tracking-wider">
                <li><a href="{{ route('home') }}" class="hover:underline">Home</a></li>
                <li class="text-[#c4a482]">/</li>
                <li class="text-[#4a383e]">Coffee Date Ideas</li>
            </ol>
        </nav>
        <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#f0e6dc] border border-[#d6c2b4] text-[#8b5a2b] text-xs font-bold uppercase tracking-wider mb-4 shadow-none">
            <i class="fa-solid fa-mug-saucer"></i> Curated Date Playbook
        </span>
        <h1 class="font-['Plus_Jakarta_Sans'] font-extrabold text-3xl sm:text-4xl lg:text-5xl text-[#24140d] tracking-tight mb-4">
            10 Unforgettable <span class="text-[#8b5a2b]">Coffee Date Ideas</span>
        </h1>
        <p class="font-['Inter'] text-sm sm:text-base text-[#6b554b] max-w-2xl mx-auto leading-relaxed">
            Forget awkward dinners and loud bars. Discover thoughtfully crafted coffee date experiences designed for organic connection, low pressure, and genuine spark.
        </p>
    </div>
</section>

<!-- Content Section -->
<section class="py-16 bg-[#fbf8f5]">
    <div class="max-w-4xl mx-auto px-4 space-y-12">
        
        <!-- 6 Featured Date Itineraries -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            
            <!-- Idea 1 -->
            <div class="bg-white border border-[#e5d5ca] rounded-3xl p-6 sm:p-8 shadow-none">
                <div class="w-12 h-12 rounded-2xl bg-[#f5ede6] border border-[#d6c2b4] flex items-center justify-center text-[#8b5a2b] text-xl mb-5">
                    <i class="fa-solid fa-clock"></i>
                </div>
                <h2 class="font-['Plus_Jakarta_Sans'] font-bold text-lg text-[#24140d] mb-2">
                    1. The Classic 45-Minute Window
                </h2>
                <p class="font-['Inter'] text-xs sm:text-sm text-[#6b554b] leading-relaxed mb-4">
                    The golden rule of modern dating. Meet for a single artisanal cup at a quiet roastery. If chemistry isn’t there, you part with smiles after 45 minutes. If sparks fly, ordering a pastry or taking a walk extends the date seamlessly.
                </p>
                <div class="text-xs font-semibold text-[#8b5a2b] flex items-center gap-1">
                    <i class="fa-solid fa-check"></i> Best for: First meetings & verified strangers
                </div>
            </div>

            <!-- Idea 2 -->
            <div class="bg-white border border-[#e5d5ca] rounded-3xl p-6 sm:p-8 shadow-none">
                <div class="w-12 h-12 rounded-2xl bg-[#f5ede6] border border-[#d6c2b4] flex items-center justify-center text-[#8b5a2b] text-xl mb-5">
                    <i class="fa-solid fa-book"></i>
                </div>
                <h2 class="font-['Plus_Jakarta_Sans'] font-bold text-lg text-[#24140d] mb-2">
                    2. The Bookstore & Espresso Safari
                </h2>
                <p class="font-['Inter'] text-xs sm:text-sm text-[#6b554b] leading-relaxed mb-4">
                    Pick an indie cafe attached to a bookshop (like Illiterati in Dharamshala or Title Waves in Mumbai). Browse books together for 15 minutes, pick a book for each other, and discuss over freshly brewed cappuccinos.
                </p>
                <div class="text-xs font-semibold text-[#8b5a2b] flex items-center gap-1">
                    <i class="fa-solid fa-check"></i> Best for: Introverts & book lovers
                </div>
            </div>

            <!-- Idea 3 -->
            <div class="bg-white border border-[#e5d5ca] rounded-3xl p-6 sm:p-8 shadow-none">
                <div class="w-12 h-12 rounded-2xl bg-[#f5ede6] border border-[#d6c2b4] flex items-center justify-center text-[#8b5a2b] text-xl mb-5">
                    <i class="fa-solid fa-mountain-sun"></i>
                </div>
                <h2 class="font-['Plus_Jakarta_Sans'] font-bold text-lg text-[#24140d] mb-2">
                    3. Mountain Terrace Sunset (Himachal)
                </h2>
                <p class="font-['Inter'] text-xs sm:text-sm text-[#6b554b] leading-relaxed mb-4">
                    Meet at Wake & Bake or Cafe Simla Times overlooking the snow peaks of Shimla. Wrap up in cozy sweaters, share cinnamon apple tarts, and watch the evening fog roll over the cedar valleys.
                </p>
                <div class="text-xs font-semibold text-[#8b5a2b] flex items-center gap-1">
                    <i class="fa-solid fa-check"></i> Best for: Romantic, atmospheric connections
                </div>
            </div>

            <!-- Idea 4 -->
            <div class="bg-white border border-[#e5d5ca] rounded-3xl p-6 sm:p-8 shadow-none">
                <div class="w-12 h-12 rounded-2xl bg-[#f5ede6] border border-[#d6c2b4] flex items-center justify-center text-[#8b5a2b] text-xl mb-5">
                    <i class="fa-solid fa-leaf"></i>
                </div>
                <h2 class="font-['Plus_Jakarta_Sans'] font-bold text-lg text-[#24140d] mb-2">
                    4. Botanical Courtyard Cold Brews
                </h2>
                <p class="font-['Inter'] text-xs sm:text-sm text-[#6b554b] leading-relaxed mb-4">
                    Select a lush, shaded garden cafe in Koregaon Park (Pune) or Indiranagar (Bangalore). The natural foliage and breeze lower anxiety and spark relaxed, authentic conversations about travels and dreams.
                </p>
                <div class="text-xs font-semibold text-[#8b5a2b] flex items-center gap-1">
                    <i class="fa-solid fa-check"></i> Best for: Sunny weekend afternoons
                </div>
            </div>

            <!-- Idea 5 -->
            <div class="bg-white border border-[#e5d5ca] rounded-3xl p-6 sm:p-8 shadow-none">
                <div class="w-12 h-12 rounded-2xl bg-[#f5ede6] border border-[#d6c2b4] flex items-center justify-center text-[#8b5a2b] text-xl mb-5">
                    <i class="fa-solid fa-water"></i>
                </div>
                <h2 class="font-['Plus_Jakarta_Sans'] font-bold text-lg text-[#24140d] mb-2">
                    5. Riverside Log Cabin Coffee (Manali)
                </h2>
                <p class="font-['Inter'] text-xs sm:text-sm text-[#6b554b] leading-relaxed mb-4">
                    Head to Old Manali along the Manalsu river at Cafe 1947 or Lazy Dog. Enjoy the roar of mountain waters, artisanal French press, and wood-fired focaccia under pine trees.
                </p>
                <div class="text-xs font-semibold text-[#8b5a2b] flex items-center gap-1">
                    <i class="fa-solid fa-check"></i> Best for: Adventure seekers & soulful singles
                </div>
            </div>

            <!-- Idea 6 -->
            <div class="bg-white border border-[#e5d5ca] rounded-3xl p-6 sm:p-8 shadow-none">
                <div class="w-12 h-12 rounded-2xl bg-[#f5ede6] border border-[#d6c2b4] flex items-center justify-center text-[#8b5a2b] text-xl mb-5">
                    <i class="fa-solid fa-palette"></i>
                </div>
                <h2 class="font-['Plus_Jakarta_Sans'] font-bold text-lg text-[#24140d] mb-2">
                    6. The Micro-Lot Pour-Over Tasting
                </h2>
                <p class="font-['Inter'] text-xs sm:text-sm text-[#6b554b] leading-relaxed mb-4">
                    Order a tasting flight of two different Indian estate coffees (e.g. Araku Valley vs. Chikmagalur). Compare floral versus chocolate tasting notes as an easy, fun conversational icebreaker.
                </p>
                <div class="text-xs font-semibold text-[#8b5a2b] flex items-center gap-1">
                    <i class="fa-solid fa-check"></i> Best for: High-chemistry interactive dating
                </div>
            </div>

        </div>

        <!-- First Date Etiquette Rules -->
        <div class="bg-white border border-[#e5d5ca] rounded-3xl p-8 sm:p-10 shadow-none">
            <h2 class="font-['Plus_Jakarta_Sans'] font-extrabold text-2xl text-[#24140d] mb-6 flex items-center gap-3">
                <i class="fa-solid fa-certificate text-[#8b5a2b]"></i> The First Coffee Date Etiquette Rulebook
            </h2>

            <div class="space-y-6 font-['Inter'] text-[#4a383e] text-sm leading-relaxed">
                <div class="flex items-start gap-4">
                    <div class="w-8 h-8 rounded-full bg-[#f5ede6] text-[#8b5a2b] font-bold text-xs flex items-center justify-center shrink-0 mt-0.5">1</div>
                    <div>
                        <h3 class="font-bold text-base text-[#24140d] mb-1">Who Pays the Bill?</h3>
                        <p class="text-[#6b554b]">Because coffee is affordable, the modern standard is simple: whoever initiated the date offers to buy the first round. However, offering to split or getting the pastries is always appreciated and respected.</p>
                    </div>
                </div>

                <div class="flex items-start gap-4">
                    <div class="w-8 h-8 rounded-full bg-[#f5ede6] text-[#8b5a2b] font-bold text-xs flex items-center justify-center shrink-0 mt-0.5">2</div>
                    <div>
                        <h3 class="font-bold text-base text-[#24140d] mb-1">Put the Smartphone Face Down</h3>
                        <p class="text-[#6b554b]">Give 100% presence. Leaving your phone screen up or glancing at WhatsApp notifications signals distraction. Genuine eye contact is 80% of romantic chemistry.</p>
                    </div>
                </div>

                <div class="flex items-start gap-4">
                    <div class="w-8 h-8 rounded-full bg-[#f5ede6] text-[#8b5a2b] font-bold text-xs flex items-center justify-center shrink-0 mt-0.5">3</div>
                    <div>
                        <h3 class="font-bold text-base text-[#24140d] mb-1">Ask "Why" Rather Than "What"</h3>
                        <p class="text-[#6b554b]">Instead of treating the date like a job interview ("What do you do for work?"), ask about passions: "What made you choose that path?" or "What is something that made you genuinely happy this week?"</p>
                    </div>
                </div>

                <div class="flex items-start gap-4">
                    <div class="w-8 h-8 rounded-full bg-[#f5ede6] text-[#8b5a2b] font-bold text-xs flex items-center justify-center shrink-0 mt-0.5">4</div>
                    <div>
                        <h3 class="font-bold text-base text-[#24140d] mb-1">The Post-Date Follow-up</h3>
                        <p class="text-[#6b554b]">If you had a wonderful time, send a polite text within 2 hours: "Had such a great time talking about coffee and Shimla with you today! Hope you reached home safely." No childish 3-day waiting games.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Callout -->
        <div class="p-8 rounded-3xl bg-gradient-to-r from-[#8b5a2b] to-[#704822] text-white flex flex-col sm:flex-row items-center justify-between gap-6 shadow-none">
            <div>
                <h3 class="font-['Plus_Jakarta_Sans'] font-extrabold text-xl mb-1">Ready to find your coffee date?</h3>
                <p class="text-xs sm:text-sm text-[#f5ede6]">Explore hundreds of verified singles in your city looking for authentic coffee meetups.</p>
            </div>
            <a href="{{ route('swipes') }}" class="px-6 py-3 bg-white text-[#8b5a2b] font-bold text-xs uppercase tracking-wider rounded-xl hover:bg-[#fbf8f5] transition-colors shrink-0 shadow-none">
                Start Discovering <i class="fa-solid fa-arrow-right ml-1"></i>
            </a>
        </div>

    </div>
</section>
@endsection
