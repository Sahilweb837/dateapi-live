@extends('layouts.app')

@section('title', 'Dating Cities in Himachal, Punjab, Delhi, Mumbai & Worldwide | CupDate')
@section('meta_desc', 'Explore CupDate city pages for Himachal Pradesh, Punjab, Delhi, Chandigarh, Amritsar, Mumbai, Pune, Bangalore, India, and international communities in the UK, Canada, UAE, USA, Australia, and Singapore.')

@section('content')
<div class="max-w-5xl mx-auto px-4 py-12 font-['Inter']">
    <!-- Header -->
    <div class="text-center mb-10 bg-white border border-[#e5d5ca] rounded-3xl p-8 md:p-12 shadow-none">
        <span class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-[#f5ede6] text-[#8b5a2b] border border-[#e5d5ca] mb-3">
            <i class="fa-solid fa-map-location-dot"></i> Regional Hubs
        </span>
        <h1 class="font-['Plus_Jakarta_Sans'] font-extrabold text-3xl md:text-5xl text-[#24140d] mb-4">
            Dating Cities Across India &amp; the World
        </h1>
        <p class="text-sm md:text-base text-[#7d6558] max-w-xl mx-auto leading-relaxed">
            From the tranquil mountain trails of Himachal Pradesh to India's bustling tech and cultural metros, discover verified singles and curated landmark cafes.
        </p>
    </div>

    <section class="mb-10 rounded-3xl border border-[#e5d5ca] bg-[#fffaf8] p-6 md:p-8">
        <p class="text-xs font-bold uppercase tracking-widest text-[#8b5a2b]">International CupDate discovery</p>
        <h2 class="mt-2 font-['Plus_Jakarta_Sans'] text-2xl font-extrabold text-[#24140d]">Connect across borders, at your pace</h2>
        <p class="mt-2 max-w-3xl text-sm leading-6 text-[#7d6558]">
            CupDate city guides help adults find local dating information, public date ideas, and online conversation opportunities.
            Availability depends on real registered members in each location; we never invent profiles or promise a specific match count.
        </p>
        <div class="mt-5 grid grid-cols-2 gap-3 sm:grid-cols-4">
            @foreach($internationalCities as $slug => $name)
                <a href="{{ route('city.show', $slug) }}" class="rounded-2xl border border-[#edc7ca] bg-white px-3 py-3 text-xs font-bold text-[#9c4b59] hover:bg-[#fff0f1]">
                    Dating in {{ $name }} →
                </a>
            @endforeach
        </div>
    </section>

    <section class="mb-10">
        <h2 class="font-['Plus_Jakarta_Sans'] text-2xl font-extrabold text-[#24140d]">Punjab, Chandigarh, Delhi &amp; Mumbai dating hubs</h2>
        <p class="mt-2 max-w-3xl text-sm leading-6 text-[#7d6558]">Explore local dating guides for North Indian communities and major cities. Each page is informational and member availability is based on real registrations.</p>
        <div class="mt-5 grid grid-cols-2 gap-3 sm:grid-cols-3 lg:grid-cols-5">
            @foreach([
                'amritsar' => 'Amritsar, Punjab',
                'jalandhar' => 'Jalandhar, Punjab',
                'patiala' => 'Patiala, Punjab',
                'mohali' => 'Mohali, Punjab',
                'chandigarh' => 'Chandigarh',
                'delhi' => 'Delhi NCR',
                'mumbai' => 'Mumbai, Maharashtra',
                'pune' => 'Pune, Maharashtra',
                'bangalore' => 'Bangalore, Karnataka',
                'hyderabad' => 'Hyderabad, Telangana',
            ] as $slug => $name)
                <a href="{{ route('city.show', $slug) }}" class="rounded-2xl border border-[#e5d5ca] bg-white px-3 py-3 text-xs font-bold text-[#8b5a2b] hover:border-[#e87a88] hover:text-[#c94f63]">
                    {{ $name }} →
                </a>
            @endforeach
        </div>
    </section>

    <!-- Cities Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mb-12">
        @foreach($cities as $slug => $c)
            <div class="bg-white border border-[#e5d5ca] rounded-3xl p-6 hover:border-[#8b5a2b] transition flex flex-col justify-between shadow-none">
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 rounded-2xl bg-[#f5ede6] border border-[#e5d5ca] text-[#8b5a2b] flex items-center justify-center text-xl">
                            <i class="fa-solid fa-{{ $c['icon'] }}"></i>
                        </div>
                        <span class="text-[10px] font-bold text-[#065f46] bg-[#ecfdf5] border border-[#a7f3d0] px-2.5 py-0.5 rounded-full">
                            ★ {{ $c['safety_score'] }} Safety
                        </span>
                    </div>

                    <span class="text-[10px] uppercase font-bold text-[#8b5a2b] tracking-wider block">{{ $c['state'] }}</span>
                    <h2 class="font-['Plus_Jakarta_Sans'] font-extrabold text-lg text-[#24140d] mt-1">{{ $c['name'] }}</h2>
                    <p class="text-xs text-[#7d6558] mt-2 leading-relaxed line-clamp-2">{{ $c['intro'] }}</p>

                    <div class="mt-4 pt-3 border-t border-[#e5d5ca]">
                        <span class="text-[11px] font-bold text-[#7d6558] block mb-1.5">Top Date Spots:</span>
                        <div class="flex flex-wrap gap-1.5">
                            @foreach(array_slice($c['popular_cafes'], 0, 2) as $spot)
                                <span class="text-[10px] bg-[#fbf8f5] text-[#24140d] border border-[#e5d5ca] px-2 py-0.5 rounded-lg">
                                    {{ $spot }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="mt-6 pt-3 border-t border-[#e5d5ca]">
                    <a href="{{ route('city.show', $slug) }}" class="w-full py-2 bg-[#8b5a2b] text-white rounded-xl text-center text-xs font-bold hover:bg-[#6d421d] transition block shadow-none">
                        Explore {{ explode(',', $c['name'])[0] }} Singles →
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
