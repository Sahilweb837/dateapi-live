@extends('layouts.app')

@section('title', 'Dating Safety & Women Protection Manual — CupDate')
@section('meta_desc', 'Comprehensive dating safety manual for India: safe public meetup protocols, spotting red flags, emergency hotlines, and digital privacy advice.')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-12 font-['Inter']">
    <!-- Header Banner -->
    <div class="text-center mb-10 bg-white border border-[#e5d5ca] rounded-3xl p-8 md:p-12 shadow-none">
        <span class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-[#ecfdf5] text-[#065f46] border border-[#a7f3d0] mb-3">
            <i class="fa-solid fa-shield-halved text-[#10b981]"></i> Official Safety Guide
        </span>
        <h1 class="font-['Plus_Jakarta_Sans'] font-extrabold text-3xl md:text-5xl text-[#24140d] mb-4">
            Safe Dating in India
        </h1>
        <p class="text-sm md:text-base text-[#7d6558] max-w-2xl mx-auto leading-relaxed">
            Your personal safety and psychological well-being are our highest priorities. Review our essential protocols before meeting someone new.
        </p>
    </div>

    <!-- 4 Key Safety Rules Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-12">
        <div class="bg-white border border-[#e5d5ca] rounded-3xl p-6 shadow-none">
            <div class="w-12 h-12 rounded-2xl bg-[#f5ede6] border border-[#e5d5ca] text-[#8b5a2b] flex items-center justify-center text-xl mb-4">
                <i class="fa-solid fa-mug-hot"></i>
            </div>
            <h2 class="font-['Plus_Jakarta_Sans'] font-extrabold text-lg text-[#24140d] mb-2">1. Always Meet in Public Cafes</h2>
            <p class="text-xs text-[#7d6558] leading-relaxed">
                Never agree to meet at private apartments, hotel rooms, or secluded areas for a first meet. Choose well-lit, reputable coffee shops with staff and other patrons present.
            </p>
        </div>

        <div class="bg-white border border-[#e5d5ca] rounded-3xl p-6 shadow-none">
            <div class="w-12 h-12 rounded-2xl bg-[#f5ede6] border border-[#e5d5ca] text-[#8b5a2b] flex items-center justify-center text-xl mb-4">
                <i class="fa-solid fa-car-side"></i>
            </div>
            <h2 class="font-['Plus_Jakarta_Sans'] font-extrabold text-lg text-[#24140d] mb-2">2. Control Your Own Transit</h2>
            <p class="text-xs text-[#7d6558] leading-relaxed">
                Do not allow your date to pick you up from your residence or drop you off on the first meet. Drive yourself, take the metro, or book a cab so you can leave whenever you wish.
            </p>
        </div>

        <div class="bg-white border border-[#e5d5ca] rounded-3xl p-6 shadow-none">
            <div class="w-12 h-12 rounded-2xl bg-[#f5ede6] border border-[#e5d5ca] text-[#8b5a2b] flex items-center justify-center text-xl mb-4">
                <i class="fa-solid fa-share-nodes"></i>
            </div>
            <h2 class="font-['Plus_Jakarta_Sans'] font-extrabold text-lg text-[#24140d] mb-2">3. Tell a Trusted Friend</h2>
            <p class="text-xs text-[#7d6558] leading-relaxed">
                Before leaving, share your live location and the cafe name with a close friend or sibling. Agree on a "check-in text" 30 minutes into the date.
            </p>
        </div>

        <div class="bg-white border border-[#e5d5ca] rounded-3xl p-6 shadow-none">
            <div class="w-12 h-12 rounded-2xl bg-[#f5ede6] border border-[#e5d5ca] text-[#8b5a2b] flex items-center justify-center text-xl mb-4">
                <i class="fa-solid fa-hand-holding-dollar"></i>
            </div>
            <h2 class="font-['Plus_Jakarta_Sans'] font-extrabold text-lg text-[#24140d] mb-2">4. Never Send Money</h2>
            <p class="text-xs text-[#7d6558] leading-relaxed">
                No genuine dater will ever ask you for money, crypto, emergency loans, or gift cards. Anyone asking for financial assistance is an instant scammer — report them immediately.
            </p>
        </div>
    </div>

    <!-- National Helpline Hotline Directory -->
    <div class="bg-[#24140d] text-white rounded-3xl p-8 md:p-12 mb-12 shadow-none">
        <div class="text-center max-w-xl mx-auto mb-8">
            <span class="w-2.5 h-2.5 rounded-full bg-[#10b981] inline-block animate-ping mr-2"></span>
            <span class="text-xs font-bold uppercase tracking-wider text-[#c8894f]">Emergency Hotline Directory</span>
            <h2 class="font-['Plus_Jakarta_Sans'] font-extrabold text-2xl md:text-3xl mt-2">
                24/7 National Support Numbers
            </h2>
            <p class="text-xs text-[#d6c4b8] mt-1">Free, confidential government helplines operational 24 hours across India.</p>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 text-center">
            <div class="bg-[#3d2314] border border-[#5a331c] p-5 rounded-2xl">
                <strong class="text-2xl font-black text-[#c8894f] block">1091</strong>
                <span class="text-xs font-bold text-white block mt-1">Women Helpline</span>
                <span class="text-[10px] text-[#d6c4b8]">Toll-Free Nationwide</span>
            </div>
            <div class="bg-[#3d2314] border border-[#5a331c] p-5 rounded-2xl">
                <strong class="text-2xl font-black text-[#10b981] block">112</strong>
                <span class="text-xs font-bold text-white block mt-1">All Emergencies</span>
                <span class="text-[10px] text-[#d6c4b8]">Police & Ambulance</span>
            </div>
            <div class="bg-[#3d2314] border border-[#5a331c] p-5 rounded-2xl">
                <strong class="text-2xl font-black text-[#c8894f] block">1930</strong>
                <span class="text-xs font-bold text-white block mt-1">Cyber Crime</span>
                <span class="text-[10px] text-[#d6c4b8]">Financial & Online Fraud</span>
            </div>
            <div class="bg-[#3d2314] border border-[#5a331c] p-5 rounded-2xl">
                <strong class="text-2xl font-black text-[#10b981] block">181</strong>
                <span class="text-xs font-bold text-white block mt-1">Women in Distress</span>
                <span class="text-[10px] text-[#d6c4b8]">Crisis Intervention</span>
            </div>
        </div>
    </div>
</div>
@endsection
