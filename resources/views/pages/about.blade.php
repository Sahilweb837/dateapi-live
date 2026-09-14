@extends('layouts.app')

@section('title', 'About CupDate — India\'s Leading Verified Coffee Dating Movement')
@section('meta_desc', 'Discover CupDate\'s origins, mission, biometric selfie verification technology, safety standards, and vision to build India and Himachal Pradesh\'s most trusted coffee dating community.')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-12">
    <!-- Hero Header -->
    <div class="text-center mb-12 bg-white border border-[#e5d5ca] rounded-3xl p-8 md:p-12 shadow-none">
        <span class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-[#f5ede6] text-[#8b5a2b] border border-[#e5d5ca] mb-3">
            <i class="fa-solid fa-mug-hot"></i> Our Mission & Heritage
        </span>
        <h1 class="font-['Plus_Jakarta_Sans'] font-extrabold text-3xl md:text-5xl text-[#24140d] mb-4">
            About CupDate
        </h1>
        <p class="text-sm md:text-base text-[#7d6558] max-w-2xl mx-auto leading-relaxed">
            Building India's most authentic, safe, and low-pressure dating platform where verified singles meet over genuine conversations and warm cups of coffee.
        </p>
    </div>

    <!-- Core Pillars Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
        <div class="bg-white border border-[#e5d5ca] rounded-3xl p-6 shadow-none">
            <div class="w-12 h-12 rounded-2xl bg-[#f5ede6] border border-[#e5d5ca] text-[#8b5a2b] flex items-center justify-center text-xl mb-4">
                <i class="fa-solid fa-shield-halved"></i>
            </div>
            <h2 class="font-['Plus_Jakarta_Sans'] font-extrabold text-lg text-[#24140d] mb-2">100% Selfie Verified</h2>
            <p class="text-xs text-[#7d6558] leading-relaxed">
                Zero bots. Zero stolen pictures. Every dater completes biometric liveness checks to ensure you only meet real humans.
            </p>
        </div>

        <div class="bg-white border border-[#e5d5ca] rounded-3xl p-6 shadow-none">
            <div class="w-12 h-12 rounded-2xl bg-[#f5ede6] border border-[#e5d5ca] text-[#8b5a2b] flex items-center justify-center text-xl mb-4">
                <i class="fa-solid fa-mug-saucer"></i>
            </div>
            <h2 class="font-['Plus_Jakarta_Sans'] font-extrabold text-lg text-[#24140d] mb-2">45-Minute Coffee First</h2>
            <p class="text-xs text-[#7d6558] leading-relaxed">
                No awkward 3-hour dinners or hefty bills. A quick, relaxed coffee in a bright public cafe lets chemistry flow naturally.
            </p>
        </div>

        <div class="bg-white border border-[#e5d5ca] rounded-3xl p-6 shadow-none">
            <div class="w-12 h-12 rounded-2xl bg-[#f5ede6] border border-[#e5d5ca] text-[#8b5a2b] flex items-center justify-center text-xl mb-4">
                <i class="fa-solid fa-mountain"></i>
            </div>
            <h2 class="font-['Plus_Jakarta_Sans'] font-extrabold text-lg text-[#24140d] mb-2">Himachal to Metros</h2>
            <p class="text-xs text-[#7d6558] leading-relaxed">
                From the scenic mountain cafes of Shimla, Manali, and Dharamshala to vibrant roasteries in Pune, Mumbai, and Bangalore.
            </p>
        </div>
    </div>

    <!-- Editorial Story Body -->
    <div class="bg-white border border-[#e5d5ca] rounded-3xl p-8 md:p-10 space-y-6 text-[#3b2d28] text-sm leading-relaxed mb-12 shadow-none">
        <h3 class="font-['Plus_Jakarta_Sans'] font-extrabold text-2xl text-[#24140d]">The CupDate Story</h3>
        <p>
            Founded in 2024 with operational presence in Shimla (Himachal Pradesh) and Pune (Maharashtra), CupDate was born out of frustration with toxic swiping culture. Modern dating apps had devolved into superficial photo games filled with ghosting, catfishing, and expensive high-pressure dinners.
        </p>
        <p>
            We asked a simple question: <em>"What if dating felt like catching up with a fascinating person over your favorite cappuccino?"</em>
        </p>
        <p>
            Coffee dates represent the ideal romantic first encounter. They are daytime, safe, public, affordable, and flexible. If you don't feel a spark, you finish your pour-over in 40 minutes and leave with mutual kindness. If you do, you order a second cup and watch the sunset together.
        </p>

        <h3 class="font-['Plus_Jakarta_Sans'] font-extrabold text-xl text-[#24140d] pt-4">Our Women Safety & Privacy Standard</h3>
        <p>
            CupDate pioneered algorithmic location fuzzing across India. When you browse singles nearby, geographic coordinates are shifted by 1.5–2km, ensuring no stranger can pinpoint your residence, hostel, or workplace. Combined with 1-tap stealth blocking and zero third-party data sales, CupDate is engineered as India's safest dating ecosystem.
        </p>
    </div>

    <!-- Corporate Headquarters & Grievance Contact -->
    <div class="bg-[#fbf8f5] border border-[#e5d5ca] rounded-3xl p-8 text-center shadow-none">
        <h3 class="font-['Plus_Jakarta_Sans'] font-extrabold text-lg text-[#24140d] mb-2">Corporate Headquarters & Trust Registry</h3>
        <p class="text-xs text-[#7d6558] max-w-xl mx-auto mb-4">
            CupDate Technologies Pvt. Ltd. • Registered Address: The Mall Road, Shimla, Himachal Pradesh 171001, India. Operational Center: Koregaon Park, Pune, Maharashtra 411001.
        </p>
        <div class="flex flex-wrap items-center justify-center gap-4 text-xs font-bold">
            <a href="{{ route('contact') }}" class="text-[#8b5a2b] hover:underline flex items-center gap-1">
                <i class="fa-solid fa-envelope"></i> Contact Grievance Officer
            </a>
            <span class="text-[#e5d5ca]">|</span>
            <a href="{{ route('privacy') }}" class="text-[#8b5a2b] hover:underline flex items-center gap-1">
                <i class="fa-solid fa-user-shield"></i> Privacy Policy
            </a>
            <span class="text-[#e5d5ca]">|</span>
            <a href="{{ route('terms') }}" class="text-[#8b5a2b] hover:underline flex items-center gap-1">
                <i class="fa-solid fa-scale-balanced"></i> Terms of Service
            </a>
        </div>
    </div>
</div>
@endsection
