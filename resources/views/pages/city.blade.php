@extends('layouts.app')

@section('title', 'Dating in ' . $city['name'] . ' — Meet Verified Singles | CupDate')
@section('meta_desc', 'Connect with verified singles in ' . $city['name'] . ' for low-pressure 45-minute coffee dates at landmark cafes. 100% selfie-verified, DPDP Act safe, and respectful.')

@section('extra_css')
<style>
.city-hero-warm {
    background: linear-gradient(135deg, #fff0f3 0%, #fff8fa 50%, #ffd9dd 100%);
    border: 1px solid #f1b7c1;
    box-shadow: 0 20px 45px -15px rgba(176,40,75,0.12);
}
.cafe-card {
    transition: transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s ease;
}
.cafe-card:hover {
    transform: translateY(-3px);
    border-color: #f1b7c1;
    box-shadow: 0 12px 30px -10px rgba(176,40,75,0.15);
}
</style>

<!-- JSON-LD SEO Structured Data for Google Ranking -->
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@graph": [
    {
      "@type": "DatingService",
      "name": "CupDate - Dating in {{ $city['name'] }}",
      "description": "{{ $city['intro'] }}",
      "areaServed": {
        "@type": "AdministrativeArea",
        "name": "{{ $city['name'] }}"
      },
      "url": "{{ url()->current() }}",
      "priceRange": "Free",
      "aggregateRating": {
        "@type": "AggregateRating",
        "ratingValue": "4.9",
        "reviewCount": "128"
      }
    },
    {
      "@type": "BreadcrumbList",
      "itemListElement": [
        {
          "@type": "ListItem",
          "position": 1,
          "name": "Home",
          "item": "{{ route('home') }}"
        },
        {
          "@type": "ListItem",
          "position": 2,
          "name": "Cities",
          "item": "{{ route('cities.index') }}"
        },
        {
          "@type": "ListItem",
          "position": 3,
          "name": "{{ $city['name'] }}",
          "item": "{{ url()->current() }}"
        }
      ]
    },
    {
      "@type": "FAQPage",
      "mainEntity": [
        {
          "@type": "Question",
          "name": "How does coffee dating in {{ explode(',', $city['name'])[0] }} work on CupDate?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "CupDate connects verified singles in {{ explode(',', $city['name'])[0] }} for low-pressure 45-minute daytime coffee dates at curated local cafes with exclusive 15% discounts."
          }
        },
        {
          "@type": "Question",
          "name": "Is dating in {{ explode(',', $city['name'])[0] }} safe on CupDate?",
          "acceptedAnswer": {
            "@type": "Answer",
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
<div class="cupdate-city-page min-h-screen bg-[#fbf8ff] text-[#1b1b21] font-['Plus_Jakarta_Sans',sans-serif]">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-12">

        <!-- Breadcrumb Navigation -->
        <nav class="flex items-center gap-2 text-xs font-semibold text-[#6c595f] mb-6" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="hover:text-[#b0284b] transition-colors">Home</a>
            <span class="text-[#dfbfc2]">/</span>
            <a href="{{ route('cities.index') }}" class="hover:text-[#b0284b] transition-colors">Dating Cities</a>
            <span class="text-[#dfbfc2]">/</span>
            <span class="text-[#b0284b] font-bold">{{ explode(',', $city['name'])[0] }}</span>
        </nav>

        <!-- City Hero Banner with Warm Rose CupDate Aesthetic -->
        <div class="city-hero-warm rounded-[2.5rem] p-6 sm:p-10 md:p-14 relative overflow-hidden mb-12">
            <!-- Ambient Floating Glows -->
            <div class="pointer-events-none absolute -top-20 -right-20 w-72 h-72 rounded-full bg-[#ff6584]/20 blur-3xl"></div>
            <div class="pointer-events-none absolute -bottom-20 -left-20 w-72 h-72 rounded-full bg-[#fdc5d0]/35 blur-3xl"></div>

            <div class="relative z-10 max-w-3xl mx-auto text-center">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-xs font-extrabold uppercase tracking-wider bg-white/90 text-[#a8334e] border border-[#f1b7c1] shadow-sm mb-4">
                    <i class="fa-solid fa-{{ $city['icon'] ?? 'mug-hot' }} text-[#fd748e]"></i>
                    <span>{{ $city['state'] }} · Intentional Coffee Dating</span>
                </div>

                <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold tracking-tight text-[#1b1b21] leading-tight mb-4">
                    {{ $city['headline'] }}
                </h1>

                <p class="text-sm md:text-base text-[#584143] leading-relaxed max-w-2xl mx-auto mb-8">
                    {{ $city['intro'] }}
                </p>

                <!-- Trust Badges & Safety Score -->
                <div class="flex flex-wrap items-center justify-center gap-2.5 text-xs font-bold mb-8">
                    <span class="inline-flex items-center gap-2 bg-emerald-50 text-emerald-800 border border-emerald-200 px-3.5 py-1.5 rounded-full shadow-sm">
                        <i class="fa-solid fa-shield-check text-emerald-600"></i>
                        <span>{{ $city['safety_score'] }} Women Safety Rating</span>
                    </span>
                    <span class="inline-flex items-center gap-2 bg-[#fff0f3] text-[#a8334e] border border-[#f1b7c1] px-3.5 py-1.5 rounded-full shadow-sm">
                        <i class="fa-solid fa-tag text-[#fd748e]"></i>
                        <span>15% Partner Cafe Discount</span>
                    </span>
                    <span class="inline-flex items-center gap-2 bg-rose-50 text-rose-800 border border-rose-200 px-3.5 py-1.5 rounded-full shadow-sm">
                        <i class="fa-solid fa-circle-check text-rose-600"></i>
                        <span>100% Selfie-Verified Members</span>
                    </span>
                </div>

                <!-- Primary CTAs -->
                <div class="flex flex-col sm:flex-row items-center justify-center gap-3">
                    @guest
                        <button type="button" onclick="openQuickAuthModal('register')" 
                                class="w-full sm:w-auto px-8 py-3.5 rounded-full bg-gradient-to-r from-[#ff6584] via-[#fd748e] to-[#b0284b] text-white font-extrabold text-sm tracking-wide flex items-center justify-center gap-2 shadow-lg shadow-[#ff6584]/25 hover:-translate-y-0.5 transition cursor-pointer">
                            <i class="fa-solid fa-heart"></i>
                            <span>Meet Singles in {{ explode(',', $city['name'])[0] }} Free</span>
                        </button>
                        <button type="button" onclick="openQuickAuthModal('signin')" 
                                class="w-full sm:w-auto px-6 py-3.5 rounded-full bg-white/95 hover:bg-white border border-[#dfbfc2] text-[#a8334e] font-bold text-sm transition shadow-sm cursor-pointer">
                            <span>Sign In</span>
                        </button>
                    @else
                        <a href="{{ route('swipes') }}" class="w-full sm:w-auto px-8 py-3.5 rounded-full bg-gradient-to-r from-[#ff6584] via-[#fd748e] to-[#b0284b] text-white font-extrabold text-sm tracking-wide flex items-center justify-center gap-2 shadow-lg shadow-[#ff6584]/25 hover:-translate-y-0.5 transition">
                            <i class="fa-solid fa-fire"></i>
                            <span>Explore Discovery Deck</span>
                        </a>
                    @endguest
                    <a href="#recommendedCafes" class="w-full sm:w-auto px-6 py-3.5 rounded-full bg-white/80 hover:bg-white border border-[#dfbfc2] text-[#584143] font-semibold text-sm transition text-center shadow-sm">
                        <i class="fa-solid fa-mug-saucer mr-1.5 text-[#b0284b]"></i>
                        <span>Top Date Spots</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Verified Singles Showcase in this City -->
        <div class="mb-14">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-[#fff0f3] text-[#a8334e] border border-[#f1b7c1] mb-1">
                        <i class="fa-solid fa-circle-check text-[#fd748e]"></i> Local Profiles
                    </span>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-[#1b1b21] tracking-tight">
                        Verified Singles Around {{ explode(',', $city['name'])[0] }}
                    </h2>
                </div>
                @guest
                    <button type="button" onclick="openQuickAuthModal('signin')" class="text-xs font-extrabold text-[#b0284b] hover:text-[#fd748e] transition flex items-center gap-1 cursor-pointer">
                        <span>View All In Swipes</span>
                        <i class="fa-solid fa-arrow-right text-[10px]"></i>
                    </button>
                @else
                    <a href="{{ route('swipes') }}" class="text-xs font-extrabold text-[#b0284b] hover:text-[#fd748e] transition flex items-center gap-1">
                        <span>View All In Swipes</span>
                        <i class="fa-solid fa-arrow-right text-[10px]"></i>
                    </a>
                @endguest
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-6 gap-4">
                @forelse($singles as $single)
                    @guest
                        <div onclick="openQuickAuthModal('signin')" role="button" tabindex="0" class="bg-white border border-[#f0d6dc] rounded-2xl p-4 text-center group hover:border-[#b0284b]/50 hover:shadow-lg transition-all duration-200 flex flex-col items-center cursor-pointer">
                    @else
                        <a href="{{ route('profile', $single->id) }}" class="bg-white border border-[#f0d6dc] rounded-2xl p-4 text-center group hover:border-[#b0284b]/50 hover:shadow-lg transition-all duration-200 flex flex-col items-center">
                    @endguest
                        <!-- Avatar with Universal Lazy Skeleton Wrapper -->
                        <div class="relative mb-3">
                            <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-full overflow-hidden img-skeleton-wrapper ring-2 ring-[#f1b7c1]/60 group-hover:ring-[#b0284b] transition-all">
                                <img src="{{ $single->avatar_url ?? $single->avatar }}" alt="{{ $single->full_name }}" class="w-full h-full object-cover" loading="lazy">
                            </div>
                            @if($single->is_verified ?? true)
                                <span class="absolute bottom-0 right-0 w-5 h-5 rounded-full bg-gradient-to-r from-[#ff6584] to-[#b0284b] text-white flex items-center justify-center text-[10px] shadow ring-2 ring-white" title="Selfie Verified">
                                    <i class="fa-solid fa-check"></i>
                                </span>
                            @endif
                        </div>
                        <strong class="text-xs sm:text-sm font-extrabold text-[#1b1b21] truncate max-w-[120px] block group-hover:text-[#b0284b] transition">
                            {{ explode(' ', $single->full_name)[0] }}
                        </strong>
                        <span class="text-[11px] font-semibold text-[#6c595f] mt-0.5">{{ $single->age ?? '24' }} yrs</span>
                        <span class="text-[10px] font-bold text-[#a8334e] truncate max-w-[110px] mt-1.5 bg-[#fff0f3] border border-[#f1b7c1]/50 px-2.5 py-0.5 rounded-full">
                            ☕ {{ $single->coffee_style ?? 'Latte' }}
                        </span>
                    @guest
                        </div>
                    @else
                        </a>
                    @endguest
                @empty
                    <div class="col-span-full bg-white border border-[#f0d6dc] rounded-3xl p-8 text-center">
                        <i class="fa-solid fa-users text-3xl text-[#b0284b] mb-2"></i>
                        <p class="text-sm font-bold text-[#1b1b21]">Be the first verified member in {{ explode(',', $city['name'])[0] }}!</p>
                        <p class="text-xs text-[#584143] mt-1">Join today and get an automatic 24-hour profile boost to top discovery decks.</p>
                        @guest
                            <button type="button" onclick="openQuickAuthModal('register')" class="mt-4 px-6 py-2 rounded-full bg-gradient-to-r from-[#ff6584] to-[#b0284b] text-white text-xs font-bold shadow-md cursor-pointer">
                                Create Profile
                            </button>
                        @endguest
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Recommended Date Spots & Partner Cafes -->
        <div id="recommendedCafes" class="mb-14 scroll-mt-24">
            <div class="mb-6">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-[#fff0f3] text-[#a8334e] border border-[#f1b7c1] mb-1">
                    <i class="fa-solid fa-mug-saucer text-[#fd748e]"></i> Curated Spots
                </span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-[#1b1b21] tracking-tight">
                    Top 45-Minute Coffee Date Spots in {{ explode(',', $city['name'])[0] }}
                </h2>
                <p class="text-xs sm:text-sm text-[#584143] mt-1">All venues are public, safe, walk-in friendly, and offer a quiet atmosphere for effortless conversation.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                @foreach($cafes as $cafe)
                    <div class="cafe-card bg-white border border-[#f0d6dc] rounded-3xl p-5 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-5 shadow-sm">
                        <!-- Cafe Image with Lazy Skeleton Wrapper -->
                        @if(!empty($cafe->image))
                            <div class="w-full sm:w-28 sm:h-28 h-36 rounded-2xl overflow-hidden img-skeleton-wrapper shrink-0 border border-[#f1b7c1]/40">
                                <img src="{{ $cafe->image }}" alt="{{ $cafe->name }}" class="w-full h-full object-cover" loading="lazy">
                            </div>
                        @endif

                        <div class="flex-1 min-w-0">
                            <div class="flex items-center gap-2 mb-1.5">
                                <span class="text-[10px] uppercase font-bold tracking-wider text-[#a8334e] bg-[#fff0f3] border border-[#f1b7c1]/50 px-2.5 py-0.5 rounded-full">
                                    {{ $cafe->type ?? 'Artisan Coffee Roastery' }}
                                </span>
                                @if(isset($cafe->rating))
                                    <span class="text-[11px] font-bold text-amber-700 flex items-center gap-1 bg-amber-50 border border-amber-200 px-2 py-0.5 rounded-full">
                                        <i class="fa-solid fa-star text-[10px] text-amber-500"></i> {{ $cafe->rating }}
                                    </span>
                                @endif
                            </div>
                            <h3 class="font-extrabold text-base text-[#1b1b21] truncate">{{ $cafe->name }}</h3>
                            <p class="text-xs text-[#584143] mt-1 line-clamp-2">{{ $cafe->address ?? $cafe->description ?? $city['name'] }}</p>
                            
                            <div class="mt-2.5 inline-flex items-center gap-1.5 text-xs font-bold text-emerald-800 bg-emerald-50 border border-emerald-200 px-3 py-1 rounded-full">
                                <i class="fa-solid fa-tag text-[10px] text-emerald-600"></i>
                                <span>{{ $cafe->cup_offer ?? '15% Off Total Bill for CupDate Singles' }}</span>
                            </div>
                        </div>

                        <div class="w-full sm:w-auto shrink-0">
                            @guest
                                <button type="button" onclick="openQuickAuthModal('signin')" 
                                        class="w-full sm:w-auto px-4 py-2.5 bg-[#fff0f3] hover:bg-gradient-to-r hover:from-[#ff6584] hover:to-[#b0284b] hover:text-white text-[#a8334e] border border-[#f1b7c1] rounded-xl text-xs font-bold transition flex items-center justify-center gap-1.5 cursor-pointer">
                                    <i class="fa-solid fa-mug-hot"></i>
                                    <span>Plan Date Here</span>
                                </button>
                            @else
                                <a href="{{ route('feed') }}" class="w-full sm:w-auto px-4 py-2.5 bg-[#fff0f3] hover:bg-gradient-to-r hover:from-[#ff6584] hover:to-[#b0284b] hover:text-white text-[#a8334e] border border-[#f1b7c1] rounded-xl text-xs font-bold transition flex items-center justify-center gap-1.5">
                                    <i class="fa-solid fa-mug-hot"></i>
                                    <span>Plan Date Here</span>
                                </a>
                            @endguest
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Local Dating Etiquette & Romance Culture Guide -->
        <div class="bg-gradient-to-br from-white to-[#fff8fa] border border-[#f0d6dc] rounded-[2.5rem] p-6 sm:p-10 mb-14 shadow-sm">
            <div class="max-w-3xl">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-[#fff0f3] text-[#a8334e] border border-[#f1b7c1] mb-2">
                    <i class="fa-solid fa-shield-heart text-[#fd748e]"></i> Mindful Dating
                </span>
                <h3 class="text-2xl sm:text-3xl font-extrabold text-[#1b1b21] mb-3 tracking-tight">
                    How to Date Respectfully in {{ $city['name'] }}
                </h3>
                
                <p class="text-sm text-[#584143] leading-relaxed mb-6">
                    {{ $city['dating_tips'] ?? 'In mountain towns like Shimla, Manali, and Kangra, as well as modern metro boulevards, first dates are best kept casual, respectful, and focused on shared passions. An afternoon coffee allows both singles to connect authentically without the pressure of a prolonged dinner.' }}
                </p>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div class="bg-white p-5 rounded-2xl border border-[#f0d6dc] shadow-sm">
                        <div class="text-[#fd748e] text-xl mb-2"><i class="fa-solid fa-clock"></i></div>
                        <strong class="text-xs font-extrabold text-[#1b1b21] block mb-1">The 45-Minute Window</strong>
                        <p class="text-[11px] text-[#584143] leading-normal">Keeps expectations light and allows an easy exit or spontaneous extension if chemistry sparkles.</p>
                    </div>
                    <div class="bg-white p-5 rounded-2xl border border-[#f0d6dc] shadow-sm">
                        <div class="text-[#b0284b] text-xl mb-2"><i class="fa-solid fa-receipt"></i></div>
                        <strong class="text-xs font-extrabold text-[#1b1b21] block mb-1">Polite Bill Splitting</strong>
                        <p class="text-[11px] text-[#584143] leading-normal">Offering to split the coffee bill or take turns purchasing brews creates mutual respect and equality.</p>
                    </div>
                    <div class="bg-white p-5 rounded-2xl border border-[#f0d6dc] shadow-sm">
                        <div class="text-emerald-700 text-xl mb-2"><i class="fa-solid fa-shield-halved"></i></div>
                        <strong class="text-xs font-extrabold text-[#1b1b21] block mb-1">DPDP Safety Guard</strong>
                        <p class="text-[11px] text-[#584143] leading-normal">Keep chat inside CupDate until you meet in a verified public cafe. Protect your phone number and social handles.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Nearby Cities for Internal SEO Link Building -->
        @if(isset($relatedCities) && $relatedCities->isNotEmpty())
            <div class="mb-14">
                <h3 class="text-xl font-extrabold text-[#1b1b21] mb-4 tracking-tight">
                    Explore Dating in Nearby {{ $city['state'] }} Cities
                </h3>
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                    @foreach($relatedCities as $rSlug => $rCity)
                        <a href="{{ route('city.show', $rSlug) }}" class="p-4 bg-white border border-[#f0d6dc] hover:border-[#b0284b] rounded-2xl text-center group transition shadow-sm hover:shadow-md">
                            <strong class="text-xs font-extrabold text-[#1b1b21] group-hover:text-[#b0284b] transition block truncate">{{ explode(',', $rCity['name'])[0] }}</strong>
                            <span class="text-[10px] font-semibold text-[#6c595f] mt-1 block">{{ $rCity['safety_score'] }} Safety Score</span>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Bottom Registration Call to Action -->
        <div class="city-hero-warm rounded-[2.5rem] p-8 sm:p-12 text-center relative overflow-hidden">
            <h3 class="text-2xl sm:text-3xl font-extrabold text-[#1b1b21] mb-2 tracking-tight">
                Ready to Meet intentional Singles in {{ explode(',', $city['name'])[0] }}?
            </h3>
            <p class="text-xs sm:text-sm text-[#584143] max-w-xl mx-auto mb-6">
                Join thousands of singles across Himachal Pradesh, Punjab, and India meeting for mindful coffee conversations. 100% free to join.
            </p>
            @guest
                <button type="button" onclick="openQuickAuthModal('register')" 
                        class="inline-flex items-center gap-2 px-8 py-3.5 rounded-full bg-gradient-to-r from-[#ff6584] via-[#fd748e] to-[#b0284b] text-white font-extrabold text-sm tracking-wide shadow-xl shadow-[#ff6584]/25 hover:-translate-y-0.5 transition cursor-pointer">
                    <i class="fa-solid fa-mug-hot"></i>
                    <span>Create Your Free CupDate Profile Now</span>
                </button>
            @else
                <a href="{{ route('swipes') }}" class="inline-flex items-center gap-2 px-8 py-3.5 rounded-full bg-gradient-to-r from-[#ff6584] via-[#fd748e] to-[#b0284b] text-white font-extrabold text-sm tracking-wide shadow-xl shadow-[#ff6584]/25 hover:-translate-y-0.5 transition">
                    <i class="fa-solid fa-mug-hot"></i>
                    <span>Find Your Match in {{ explode(',', $city['name'])[0] }}</span>
                </a>
            @endguest
        </div>

    </div>
</div>
@endsection
