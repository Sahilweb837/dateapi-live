@extends('layouts.app')

@section('title', 'Dating in ' . $city['name'] . ' — Meet Verified Singles | CupDate')
@section('meta_desc', 'Connect with verified singles in ' . $city['name'] . ' for low-pressure 45-minute coffee dates at landmark cafes. 100% selfie-verified, DPDP Act safe, and respectful.')

@section('extra_css')
<style>
.city-hero-card {
    background: linear-gradient(135deg, rgba(30,16,12,0.95) 0%, rgba(45,24,18,0.92) 100%);
    border: 1px solid rgba(255,100,160,0.2);
    box-shadow: 0 20px 50px rgba(0,0,0,0.35), inset 0 1px 0 rgba(255,255,255,0.08);
}
.neon-pink-badge {
    background: rgba(255,45,117,0.12);
    border: 1px solid rgba(255,45,117,0.35);
    color: #ff5e97;
    box-shadow: 0 0 16px rgba(255,45,117,0.15);
}
.neon-pink-text {
    background: linear-gradient(135deg, #ff4081 0%, #ff007f 50%, #e91e63 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}
.neon-cta-btn {
    background: linear-gradient(135deg, #ff007f 0%, #ff4081 50%, #d81b60 100%);
    box-shadow: 0 4px 20px rgba(255,0,127,0.35);
    transition: all 0.25s ease;
}
.neon-cta-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 30px rgba(255,0,127,0.5);
}
.cafe-card {
    transition: transform 0.25s ease, border-color 0.25s ease;
}
.cafe-card:hover {
    transform: translateY(-3px);
    border-color: rgba(255,45,117,0.4);
}
</style>

<!-- JSON-LD SEO Structured Data for Google Ranking -->
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@graph": [
    {
      "@@type": "DatingService",
      "name": "CupDate - Dating in {{ $city['name'] }}",
      "description": "{{ $city['intro'] }}",
      "areaServed": {
        "@@type": "AdministrativeArea",
        "name": "{{ $city['name'] }}"
      },
      "url": "{{ url()->current() }}",
      "priceRange": "Free",
      "aggregateRating": {
        "@@type": "AggregateRating",
        "ratingValue": "4.9",
        "reviewCount": "128"
      }
    },
    {
      "@@type": "BreadcrumbList",
      "itemListElement": [
        {
          "@@type": "ListItem",
          "position": 1,
          "name": "Home",
          "item": "{{ route('home') }}"
        },
        {
          "@@type": "ListItem",
          "position": 2,
          "name": "Cities",
          "item": "{{ route('cities.index') }}"
        },
        {
          "@@type": "ListItem",
          "position": 3,
          "name": "{{ $city['name'] }}",
          "item": "{{ url()->current() }}"
        }
      ]
    },
    {
      "@@type": "FAQPage",
      "mainEntity": [
        {
          "@@type": "Question",
          "name": "How does coffee dating in {{ explode(',', $city['name'])[0] }} work on CupDate?",
          "acceptedAnswer": {
            "@@type": "Answer",
            "text": "CupDate connects verified singles in {{ explode(',', $city['name'])[0] }} for low-pressure 45-minute daytime coffee dates at curated local cafes with exclusive 15% discounts."
          }
        },
        {
          "@@type": "Question",
          "name": "Is dating in {{ explode(',', $city['name'])[0] }} safe on CupDate?",
          "acceptedAnswer": {
            "@@type": "Answer",
            "text": "Yes. CupDate enforces 100% selfie verification, privacy under the DPDP Act 2023, and in-app secure encrypted messaging to ensure singles meet safely in vetted public venues."
          }
        }
      ]
    }
  ]
}
</script>
@endsection

@section('content')
<div class="max-w-6xl mx-auto px-4 py-8 md:py-12">

    <!-- Breadcrumb Navigation -->
    <nav class="flex items-center gap-2 text-xs font-semibold text-on-surface-variant mb-6" aria-label="Breadcrumb">
        <a href="{{ route('home') }}" class="hover:text-secondary transition-colors">Home</a>
        <span>/</span>
        <a href="{{ route('cities.index') }}" class="hover:text-secondary transition-colors">Dating Cities</a>
        <span>/</span>
        <span class="text-on-surface font-bold">{{ explode(',', $city['name'])[0] }}</span>
    </nav>

    <!-- City Hero Banner with Neon Pink Accent -->
    <div class="city-hero-card rounded-3xl p-6 sm:p-10 md:p-14 text-white text-center relative overflow-hidden mb-12">
        <!-- Ambient Neon Glow -->
        <div class="absolute -top-24 -right-24 w-72 h-72 rounded-full bg-[#ff007f]/15 blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-24 -left-24 w-72 h-72 rounded-full bg-[#8b5a2b]/20 blur-3xl pointer-events-none"></div>

        <div class="relative z-10 max-w-3xl mx-auto">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider neon-pink-badge mb-4">
                <i class="fa-solid fa-{{ $city['icon'] ?? 'mug-hot' }}"></i>
                <span>{{ $city['state'] }} · Intentional Coffee Dating</span>
            </div>

            <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold tracking-tight mb-5" style="font-family:'Playfair Display',serif;">
                {{ $city['headline'] }}
            </h1>

            <p class="text-sm md:text-base text-stone-300 leading-relaxed mb-8">
                {{ $city['intro'] }}
            </p>

            <!-- Trust Badges & Safety Score -->
            <div class="flex flex-wrap items-center justify-center gap-3 text-xs font-bold mb-8">
                <span class="inline-flex items-center gap-2 bg-emerald-950/80 text-emerald-300 border border-emerald-500/40 px-3.5 py-1.5 rounded-full shadow-sm">
                    <i class="fa-solid fa-shield-check text-emerald-400"></i>
                    <span>{{ $city['safety_score'] }} Women Safety Rating</span>
                </span>
                <span class="inline-flex items-center gap-2 bg-[#2d1a10] text-amber-300 border border-amber-500/30 px-3.5 py-1.5 rounded-full shadow-sm">
                    <i class="fa-solid fa-tag text-amber-400"></i>
                    <span>15% Partner Cafe Discount</span>
                </span>
                <span class="inline-flex items-center gap-2 bg-rose-950/70 text-rose-300 border border-rose-500/30 px-3.5 py-1.5 rounded-full shadow-sm">
                    <i class="fa-solid fa-circle-check text-rose-400"></i>
                    <span>100% Selfie-Verified Members</span>
                </span>
            </div>

            <!-- Primary CTAs -->
            <div class="flex flex-col sm:flex-row items-center justify-center gap-3">
                <a href="{{ Auth::check() ? route('swipes') : route('register') }}" class="neon-cta-btn w-full sm:w-auto px-8 py-3.5 rounded-full text-white font-bold text-sm tracking-wide flex items-center justify-center gap-2 shadow-lg cursor-pointer">
                    <i class="fa-solid fa-fire"></i>
                    <span>Meet Singles in {{ explode(',', $city['name'])[0] }} Free</span>
                </a>
                <a href="#recommendedCafes" class="w-full sm:w-auto px-6 py-3.5 rounded-full bg-white/10 hover:bg-white/15 border border-white/20 text-white font-semibold text-sm transition text-center">
                    <i class="fa-solid fa-mug-saucer mr-1.5"></i>
                    <span>Top Date Spots</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Verified Singles Showcase in this City -->
    <div class="mb-14">
        <div class="flex items-center justify-between mb-6">
            <div>
                <span class="text-xs font-extrabold uppercase tracking-widest text-[#ff007f] block mb-1">Local Profiles</span>
                <h2 class="text-2xl font-bold text-[#231a15]" style="font-family:'Playfair Display',serif;">
                    Verified Singles Around {{ explode(',', $city['name'])[0] }}
                </h2>
            </div>
            <a href="{{ route('swipes') }}" class="text-xs font-bold text-secondary hover:text-[#ff007f] transition flex items-center gap-1">
                <span>View All In Swipes</span>
                <i class="fa-solid fa-arrow-right text-[10px]"></i>
            </a>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-6 gap-4">
            @forelse($singles as $single)
                <a href="{{ Auth::check() ? route('profile', $single->id) : route('register') }}" class="bg-surface-container-lowest border border-outline-variant/30 rounded-2xl p-4 text-center group hover:border-[#ff007f]/50 hover:shadow-lg transition flex flex-col items-center">
                    <div class="relative mb-3">
                        <img src="{{ $single->avatar_url }}" alt="{{ $single->full_name }}" class="w-16 h-16 sm:w-20 sm:h-20 rounded-full object-cover ring-2 ring-outline-variant/50 group-hover:ring-[#ff007f] transition-all">
                        @if($single->is_verified)
                            <span class="absolute bottom-0 right-0 w-5 h-5 rounded-full bg-[#ff007f] text-white flex items-center justify-center text-[10px] shadow" title="Selfie Verified">
                                <i class="fa-solid fa-check"></i>
                            </span>
                        @endif
                    </div>
                    <strong class="text-xs sm:text-sm font-bold text-on-surface truncate max-w-[120px] block">{{ explode(' ', $single->full_name)[0] }}</strong>
                    <span class="text-[11px] text-on-surface-variant mt-0.5">{{ $single->age ?? '24' }} yrs</span>
                    <span class="text-[10px] font-semibold text-secondary truncate max-w-[110px] mt-1 bg-surface-container px-2 py-0.5 rounded-full">
                        ☕ {{ $single->coffee_style ?? 'Latte' }}
                    </span>
                </a>
            @empty
                <div class="col-span-6 bg-surface-container-low border border-outline-variant/30 rounded-2xl p-8 text-center">
                    <i class="fa-solid fa-users text-3xl text-secondary mb-2"></i>
                    <p class="text-sm font-bold text-on-surface">Be the first verified member in {{ explode(',', $city['name'])[0] }}!</p>
                    <p class="text-xs text-on-surface-variant mt-1">Join today and get an automatic 24-hour profile boost to top discovery decks.</p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Recommended Date Spots & Partner Cafes -->
    <div id="recommendedCafes" class="mb-14 scroll-mt-24">
        <div class="mb-6">
            <span class="text-xs font-extrabold uppercase tracking-widest text-[#ff007f] block mb-1">Low-Pressure Venues</span>
            <h2 class="text-2xl font-bold text-[#231a15]" style="font-family:'Playfair Display',serif;">
                Top 45-Minute Coffee Date Spots in {{ explode(',', $city['name'])[0] }}
            </h2>
            <p class="text-xs sm:text-sm text-on-surface-variant mt-1">All venues are public, safe, walk-in friendly, and offer a quiet atmosphere for effortless conversation.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            @foreach($cafes as $cafe)
                <div class="cafe-card bg-surface-container-lowest border border-outline-variant/40 rounded-2xl p-5 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 shadow-sm">
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-2 mb-1">
                            <span class="text-[10px] uppercase font-bold tracking-wider text-secondary bg-surface-container px-2.5 py-0.5 rounded-full">
                                {{ $cafe->type ?? 'Artisan Coffee Roastery' }}
                            </span>
                            @if(isset($cafe->rating))
                                <span class="text-[11px] font-bold text-amber-700 flex items-center gap-1">
                                    <i class="fa-solid fa-star text-[10px] text-amber-500"></i> {{ $cafe->rating }}
                                </span>
                            @endif
                        </div>
                        <h3 class="font-bold text-base text-on-surface truncate">{{ $cafe->name }}</h3>
                        <p class="text-xs text-on-surface-variant mt-1 line-clamp-2">{{ $cafe->address ?? $cafe->description ?? $city['name'] }}</p>
                        
                        <div class="mt-2.5 inline-flex items-center gap-1.5 text-xs font-bold text-emerald-800 bg-emerald-50 border border-emerald-200 px-3 py-1 rounded-full">
                            <i class="fa-solid fa-tag text-[10px]"></i>
                            <span>{{ $cafe->cup_offer ?? '15% Off Total Bill for CupDate Singles' }}</span>
                        </div>
                    </div>

                    <a href="{{ Auth::check() ? route('feed') : route('register') }}" class="w-full sm:w-auto px-4 py-2.5 bg-surface-container hover:bg-[#ff007f] hover:text-white text-secondary border border-outline-variant/60 rounded-xl text-xs font-bold transition flex items-center justify-center gap-1.5 shrink-0">
                        <i class="fa-solid fa-mug-hot"></i>
                        <span>Ask Out Here</span>
                    </a>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Local Dating Etiquette & Romance Culture Guide -->
    <div class="bg-surface-container-low border border-outline-variant/40 rounded-3xl p-6 sm:p-10 mb-14">
        <div class="max-w-3xl">
            <span class="text-xs font-extrabold uppercase tracking-widest text-[#ff007f] block mb-1">Cultural Etiquette</span>
            <h3 class="text-2xl font-bold text-[#231a15] mb-4" style="font-family:'Playfair Display',serif;">
                How to Date Respectfully in {{ $city['name'] }}
            </h3>
            
            <p class="text-sm text-on-surface-variant leading-relaxed mb-4">
                {{ $city['dating_tips'] ?? 'In mountain towns like Shimla, Manali, and Kangra, as well as modern metro boulevards, first dates are best kept casual, respectful, and focused on shared passions. An afternoon coffee allows both singles to connect authentically without the pressure of a prolonged dinner.' }}
            </p>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mt-6">
                <div class="bg-surface-container-lowest p-4 rounded-2xl border border-outline-variant/30">
                    <div class="text-[#ff007f] text-lg mb-2"><i class="fa-solid fa-clock"></i></div>
                    <strong class="text-xs font-bold text-on-surface block mb-1">The 45-Minute Window</strong>
                    <p class="text-[11px] text-on-surface-variant leading-normal">Keeps expectations light and allows an easy exit or spontaneous extension if chemistry sparkles.</p>
                </div>
                <div class="bg-surface-container-lowest p-4 rounded-2xl border border-outline-variant/30">
                    <div class="text-secondary text-lg mb-2"><i class="fa-solid fa-receipt"></i></div>
                    <strong class="text-xs font-bold text-on-surface block mb-1">Polite Bill Splitting</strong>
                    <p class="text-[11px] text-on-surface-variant leading-normal">Offering to split the coffee bill or take turns purchasing brews creates mutual respect and equality.</p>
                </div>
                <div class="bg-surface-container-lowest p-4 rounded-2xl border border-outline-variant/30">
                    <div class="text-emerald-700 text-lg mb-2"><i class="fa-solid fa-shield-halved"></i></div>
                    <strong class="text-xs font-bold text-on-surface block mb-1">DPDP Safety Guard</strong>
                    <p class="text-[11px] text-on-surface-variant leading-normal">Keep chat inside CupDate until you meet in a verified public cafe. Protect your phone number and social handles.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Related Nearby Cities for Internal SEO Link Building -->
    @if(isset($relatedCities) && $relatedCities->isNotEmpty())
        <div class="mb-14">
            <h3 class="text-lg font-bold text-[#231a15] mb-4" style="font-family:'Playfair Display',serif;">
                Explore Dating in Nearby {{ $city['state'] }} Cities
            </h3>
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                @foreach($relatedCities as $rSlug => $rCity)
                    <a href="{{ route('city.show', $rSlug) }}" class="p-3.5 bg-surface-container-lowest border border-outline-variant/30 hover:border-[#ff007f] rounded-2xl text-center group transition">
                        <strong class="text-xs font-bold text-on-surface group-hover:text-[#ff007f] transition block truncate">{{ explode(',', $rCity['name'])[0] }}</strong>
                        <span class="text-[10px] text-on-surface-variant mt-0.5 block">{{ $rCity['safety_score'] }} Safety Score</span>
                    </a>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Bottom Registration Call to Action -->
    <div class="city-hero-card rounded-3xl p-8 sm:p-12 text-center text-white relative overflow-hidden">
        <h3 class="text-2xl sm:text-3xl font-bold mb-2" style="font-family:'Playfair Display',serif;">
            Ready to Meet intentional Singles in {{ explode(',', $city['name'])[0] }}?
        </h3>
        <p class="text-xs sm:text-sm text-stone-300 max-w-xl mx-auto mb-6">
            Join thousands of singles across Himachal Pradesh, Punjab, and India meeting for mindful coffee conversations. 100% free to join.
        </p>
        <a href="{{ route('register') }}" class="neon-cta-btn inline-flex items-center gap-2 px-8 py-3.5 rounded-full text-white font-extrabold text-sm tracking-wide shadow-xl">
            <i class="fa-solid fa-mug-hot"></i>
            <span>Create Your Free CupDate Profile Now</span>
        </a>
    </div>

</div>
@endsection
