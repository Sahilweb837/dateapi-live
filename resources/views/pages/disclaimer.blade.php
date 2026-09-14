@extends('layouts.app')

@section('title', 'Website Disclaimer & Safety Notice — CupDate')

@section('content')
<!-- Hero Section -->
<section class="relative bg-gradient-to-b from-[#f5ede6] to-[#fbf8f5] py-16 border-b border-[#e5d5ca]">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <nav aria-label="Breadcrumb" class="mb-4">
            <ol class="inline-flex items-center gap-2 text-xs font-semibold text-[#8b5a2b] uppercase tracking-wider">
                <li><a href="{{ route('home') }}" class="hover:underline">Home</a></li>
                <li class="text-[#c4a482]">/</li>
                <li class="text-[#4a383e]">Disclaimer</li>
            </ol>
        </nav>
        <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#f0e6dc] border border-[#d6c2b4] text-[#8b5a2b] text-xs font-bold uppercase tracking-wider mb-4 shadow-none">
            <i class="fa-solid fa-circle-exclamation"></i> Legal & Liability Notice
        </span>
        <h1 class="font-['Plus_Jakarta_Sans'] font-extrabold text-3xl sm:text-4xl lg:text-5xl text-[#24140d] tracking-tight mb-4">
            Website & Dating Disclaimer
        </h1>
        <p class="font-['Inter'] text-sm sm:text-base text-[#6b554b] max-w-2xl mx-auto leading-relaxed">
            Please read this disclaimer carefully before using CupDate (cupdate.in). Your safety, transparency, and trust are our top priorities.
        </p>
    </div>
</section>

<!-- Main Legal Content -->
<section class="py-16 bg-[#fbf8f5]">
    <div class="max-w-4xl mx-auto px-4">
        <div class="bg-white border border-[#e5d5ca] rounded-3xl p-8 sm:p-12 space-y-8 font-['Inter'] text-[#4a383e] leading-relaxed shadow-none">
            
            <div>
                <h2 class="font-['Plus_Jakarta_Sans'] font-bold text-xl text-[#24140d] mb-3 flex items-center gap-2">
                    <i class="fa-solid fa-scale-balanced text-[#8b5a2b]"></i> 1. General Information & Purpose
                </h2>
                <p class="text-sm sm:text-base text-[#6b554b]">
                    The services and content provided on <strong>CupDate (cupdate.in)</strong> are intended solely for personal social discovery, dating, coffee meetup recommendations, and matrimony-oriented connections. While we deploy AI verification, selfie checks, and community moderation, CupDate does not guarantee or represent that every member is genuine, single, or truthful about their background.
                </p>
            </div>

            <hr class="border-[#e5d5ca]">

            <div>
                <h2 class="font-['Plus_Jakarta_Sans'] font-bold text-xl text-[#24140d] mb-3 flex items-center gap-2">
                    <i class="fa-solid fa-shield-heart text-[#8b5a2b]"></i> 2. Personal Safety & In-Person Meetup Responsibility
                </h2>
                <p class="text-sm sm:text-base text-[#6b554b] mb-3">
                    Users are solely and independently responsible for their communications and interactions with other members, both online and in real-world coffee dates. 
                </p>
                <ul class="space-y-2 text-sm text-[#6b554b] list-disc list-inside">
                    <li>Always meet in vetted public cafes (such as CupDate partner spots in Shimla, Pune, Mumbai, Bangalore, or Delhi NCR).</li>
                    <li>Inform a trusted friend or family member about your plans, location, and companion.</li>
                    <li>Arrange your own transportation to and from any date venue.</li>
                    <li>Never send money, share bank details, UPI PINs, or sensitive personal documents with anyone you meet online.</li>
                </ul>
            </div>

            <hr class="border-[#e5d5ca]">

            <div>
                <h2 class="font-['Plus_Jakarta_Sans'] font-bold text-xl text-[#24140d] mb-3 flex items-center gap-2">
                    <i class="fa-solid fa-comments text-[#8b5a2b]"></i> 3. User-Generated Content & Zero-Tolerance Policy
                </h2>
                <p class="text-sm sm:text-base text-[#6b554b]">
                    Opinions, date ideas, biographies, and photos uploaded by users represent their individual views and not those of CupDate. We maintain a zero-tolerance policy against hate speech, harassment, impersonation, explicit unsolicited media, or fraud. Violators will face immediate profile termination and blacklisting.
                </p>
            </div>

            <hr class="border-[#e5d5ca]">

            <div>
                <h2 class="font-['Plus_Jakarta_Sans'] font-bold text-xl text-[#24140d] mb-3 flex items-center gap-2">
                    <i class="fa-solid fa-store text-[#8b5a2b]"></i> 4. Cafe Partnerships & Discounts
                </h2>
                <p class="text-sm sm:text-base text-[#6b554b]">
                    Cafe listings, coffee discount badges, and partner perks displayed across CupDate are subject to change at the discretion of individual cafe owners. CupDate is not liable for service variations, pricing changes, or food quality at third-party venues.
                </p>
            </div>

            <hr class="border-[#e5d5ca]">

            <div>
                <h2 class="font-['Plus_Jakarta_Sans'] font-bold text-xl text-[#24140d] mb-3 flex items-center gap-2">
                    <i class="fa-solid fa-envelope-open-text text-[#8b5a2b]"></i> 5. Grievance Officer & Contact
                </h2>
                <p class="text-sm sm:text-base text-[#6b554b] mb-4">
                    In compliance with the Information Technology (Intermediary Guidelines and Digital Media Ethics Code) Rules and the Digital Personal Data Protection (DPDP) Act 2023, queries or grievances can be addressed directly to our Grievance Officer:
                </p>
                <div class="bg-[#fcfaf7] border border-[#e5d5ca] p-4 rounded-2xl text-xs sm:text-sm text-[#4a383e] space-y-1">
                    <p><strong>Grievance Officer:</strong> Legal & Compliance Cell, CupDate Inc.</p>
                    <p><strong>Email:</strong> <a href="mailto:grievance@cupdate.in" class="text-[#8b5a2b] font-medium hover:underline">grievance@cupdate.in</a></p>
                    <p><strong>Support Desk:</strong> <a href="{{ route('contact') }}" class="text-[#8b5a2b] font-medium hover:underline">cupdate.in/contact</a></p>
                    <p><strong>Response Time:</strong> Acknowledged within 24 hours, resolved within 15 business days.</p>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection
