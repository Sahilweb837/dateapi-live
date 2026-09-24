@extends('layouts.app')

@section('title', 'Dating FAQ, Online Chat & Video Calls in India — CupDate')
@section('meta_desc', 'Learn how CupDate free online dating chat, one-to-one video introductions, profile safety, verification, and city discovery work in Himachal Pradesh and across India.')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-12 font-['Inter']">
    <div class="text-center mb-10 bg-white border border-[#e5d5ca] rounded-3xl p-8 md:p-12 shadow-none">
        <span class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-[#f5ede6] text-[#8b5a2b] border border-[#e5d5ca] mb-3">
            <i class="fa-solid fa-circle-question"></i> Help & Knowledge Base
        </span>
        <h1 class="font-['Plus_Jakarta_Sans'] font-extrabold text-3xl md:text-5xl text-[#24140d] mb-4">
            Frequently Asked Questions
        </h1>
        <p class="text-sm text-[#7d6558] max-w-xl mx-auto leading-relaxed">
            Clear answers about free online chat, one-to-one video introductions, profiles, privacy, safety, and meeting people in Himachal Pradesh and cities across India.
        </p>
    </div>

    <!-- FAQ Categories Accordion -->
    <div class="space-y-4 mb-12" id="faqAccordionPage">
        <!-- Q1 -->
        <div class="bg-white border border-[#e5d5ca] rounded-2xl p-5 cursor-pointer shadow-none" onclick="toggleFaqItem(this)">
            <div class="flex items-center justify-between">
                <h3 class="font-['Plus_Jakarta_Sans'] font-bold text-sm md:text-base text-[#24140d]">
                    How does CupDate's selfie verification work?
                </h3>
                <i class="fa-solid fa-chevron-down text-xs text-[#8b5a2b] transition-transform duration-200"></i>
            </div>
            <div class="faq-content hidden mt-3 text-xs text-[#7d6558] leading-relaxed pt-2 border-t border-[#e5d5ca]">
                When setting up your profile, CupDate prompts you to capture a 3-second live selfie with slight head movement. Our biometric model compares this to your uploaded gallery photos to confirm you are the true account owner. Verified users receive an official Blue Verified Badge.
            </div>
        </div>

        <!-- Q2 -->
        <div class="bg-white border border-[#e5d5ca] rounded-2xl p-5 cursor-pointer shadow-none" onclick="toggleFaqItem(this)">
            <div class="flex items-center justify-between">
                <h3 class="font-['Plus_Jakarta_Sans'] font-bold text-sm md:text-base text-[#24140d]">
                    Why are 45-minute coffee dates better than dinner dates?
                </h3>
                <i class="fa-solid fa-chevron-down text-xs text-[#8b5a2b] transition-transform duration-200"></i>
            </div>
            <div class="faq-content hidden mt-3 text-xs text-[#7d6558] leading-relaxed pt-2 border-t border-[#e5d5ca]">
                Traditional dinner dates cost thousands of rupees and force two people into a 2-hour commitment even if there is zero conversational chemistry. A daytime coffee date in a vibrant public cafe is casual, safe, affordable, and easily extended if you both feel an authentic spark.
            </div>
        </div>

        <!-- Q3 -->
        <div class="bg-white border border-[#e5d5ca] rounded-2xl p-5 cursor-pointer shadow-none" onclick="toggleFaqItem(this)">
            <div class="flex items-center justify-between">
                <h3 class="font-['Plus_Jakarta_Sans'] font-bold text-sm md:text-base text-[#24140d]">
                    How do I claim 15% discount at partner cafes?
                </h3>
                <i class="fa-solid fa-chevron-down text-xs text-[#8b5a2b] transition-transform duration-200"></i>
            </div>
            <div class="faq-content hidden mt-3 text-xs text-[#7d6558] leading-relaxed pt-2 border-t border-[#e5d5ca]">
                Simply browse our Partner Cafes list (under <a href="{{ route('dates') }}" class="text-[#8b5a2b] font-bold underline">Coffee Date Spots</a>) and arrange to meet there. During billing, present your active verified CupDate Member ID badge (#CD-XXXXX) to receive 15% off your table order!
            </div>
        </div>

        <!-- Q4 -->
        <div class="bg-white border border-[#e5d5ca] rounded-2xl p-5 cursor-pointer shadow-none" onclick="toggleFaqItem(this)">
            <div class="flex items-center justify-between">
                <h3 class="font-['Plus_Jakarta_Sans'] font-bold text-sm md:text-base text-[#24140d]">
                    Is CupDate free to use?
                </h3>
                <i class="fa-solid fa-chevron-down text-xs text-[#8b5a2b] transition-transform duration-200"></i>
            </div>
            <div class="faq-content hidden mt-3 text-xs text-[#7d6558] leading-relaxed pt-2 border-t border-[#e5d5ca]">
                Yes! 100% free matching, swiping, and clutter-free direct chat are available to all verified singles under the Free Sip tier. Optional VIP subscriptions (Gold Roaster & Diamond Barista) are available for power daters seeking unlimited superlikes and multi-city travel mode.
            </div>
        </div>

        <!-- Q5 -->
        <div class="bg-white border border-[#e5d5ca] rounded-2xl p-5 cursor-pointer shadow-none" onclick="toggleFaqItem(this)">
            <div class="flex items-center justify-between">
                <h3 class="font-['Plus_Jakarta_Sans'] font-bold text-sm md:text-base text-[#24140d]">
                    What is Ghost Location Fuzzing?
                </h3>
                <i class="fa-solid fa-chevron-down text-xs text-[#8b5a2b] transition-transform duration-200"></i>
            </div>
            <div class="faq-content hidden mt-3 text-xs text-[#7d6558] leading-relaxed pt-2 border-t border-[#e5d5ca]">
                To safeguard members against stalking, CupDate never shares exact GPS coordinates. Your location is fuzz-shifted algorithmically by 1.5 to 2 kilometers, showing that you are in the same general neighborhood (e.g. Koregaon Park, Pune or The Mall, Shimla) without ever pinpointing your precise home address.
            </div>
        </div>

        <!-- Q6 -->
        <div class="bg-white border border-[#e5d5ca] rounded-2xl p-5 cursor-pointer shadow-none" onclick="toggleFaqItem(this)">
            <div class="flex items-center justify-between">
                <h3 class="font-['Plus_Jakarta_Sans'] font-bold text-sm md:text-base text-[#24140d]">
                    Is CupDate active in Himachal Pradesh (Kangra, Shimla, Dharamshala, Solan)?
                </h3>
                <i class="fa-solid fa-chevron-down text-xs text-[#8b5a2b] transition-transform duration-200"></i>
            </div>
            <div class="faq-content hidden mt-3 text-xs text-[#7d6558] leading-relaxed pt-2 border-t border-[#e5d5ca]">
                Yes! Himachal Pradesh is one of CupDate's primary founding hubs. We have active local chapters in Kangra, Dharamshala, McLeodGanj, Shimla, Solan, Manali, Mandi, Kullu, Palampur, and Hamirpur. Singles across HP can discover local verified daters and meet at famous hillside cafes like Wake &amp; Bake, Cafe Simla Times, Illiterati Books &amp; Cafe, and Cafe 1947.
            </div>
        </div>

        <!-- Q7 -->
        <div class="bg-white border border-[#e5d5ca] rounded-2xl p-5 cursor-pointer shadow-none" onclick="toggleFaqItem(this)">
            <div class="flex items-center justify-between">
                <h3 class="font-['Plus_Jakarta_Sans'] font-bold text-sm md:text-base text-[#24140d]">
                    How does the live 1-on-1 random coffee video lounge work?
                </h3>
                <i class="fa-solid fa-chevron-down text-xs text-[#8b5a2b] transition-transform duration-200"></i>
            </div>
            <div class="faq-content hidden mt-3 text-xs text-[#7d6558] leading-relaxed pt-2 border-t border-[#e5d5ca]">
                The Video Lounge presents one active member at a time for a respectful introduction. You can enable your camera and microphone, review the member profile, move to the next person, or send a date invitation. A future real-time call connection should only be described as live when both people accept and the call service is connected.
            </div>

            <!-- Q10 -->
            <div class="bg-white border border-[#e5d5ca] rounded-2xl p-5 cursor-pointer shadow-none" onclick="toggleFaqItem(this)">
                <div class="flex items-center justify-between">
                    <h3 class="font-['Plus_Jakarta_Sans'] font-bold text-sm md:text-base text-[#24140d]">
                        Can I chat online with people for free?
                    </h3>
                    <i class="fa-solid fa-chevron-down text-xs text-[#8b5a2b] transition-transform duration-200"></i>
                </div>
                <div class="faq-content hidden mt-3 text-xs text-[#7d6558] leading-relaxed pt-2 border-t border-[#e5d5ca]">
                    Yes. CupDate supports free account registration, profile discovery, and direct online chat for adults who follow the community guidelines. You choose who to contact, can block or report anyone, and should never share private financial or location information.
                </div>
            </div>
        </div>

        <!-- Q8 -->
        <div class="bg-white border border-[#e5d5ca] rounded-2xl p-5 cursor-pointer shadow-none" onclick="toggleFaqItem(this)">
            <div class="flex items-center justify-between">
                <h3 class="font-['Plus_Jakarta_Sans'] font-bold text-sm md:text-base text-[#24140d]">
                    Can I use CupDate for serious matrimony and traditional rishta dating?
                </h3>
                <i class="fa-solid fa-chevron-down text-xs text-[#8b5a2b] transition-transform duration-200"></i>
            </div>
            <div class="faq-content hidden mt-3 text-xs text-[#7d6558] leading-relaxed pt-2 border-t border-[#e5d5ca]">
                Absolutely. CupDate features a dedicated Traditional Rishta &amp; Matrimony portal for singles seeking long-term intentional partnerships without awkward, high-pressure matrimonial meetings. A relaxed 45-minute coffee chat provides the perfect balance of modern respect and deep values alignment.
            </div>
        </div>

        <!-- Q9 -->
        <div class="bg-white border border-[#e5d5ca] rounded-2xl p-5 cursor-pointer shadow-none" onclick="toggleFaqItem(this)">
            <div class="flex items-center justify-between">
                <h3 class="font-['Plus_Jakarta_Sans'] font-bold text-sm md:text-base text-[#24140d]">
                    How do daily login streaks and coffee bean coins work?
                </h3>
                <i class="fa-solid fa-chevron-down text-xs text-[#8b5a2b] transition-transform duration-200"></i>
            </div>
            <div class="faq-content hidden mt-3 text-xs text-[#7d6558] leading-relaxed pt-2 border-t border-[#e5d5ca]">
                Every consecutive day you log into CupDate, you earn bonus coffee bean coins (Day 1: 10 coins, up to Day 7: 100 coins). You can redeem your coins to activate 24-hour Profile Boosts (making your card appear 10x more frequently in Discover deck) and unlock priority concierge recommendations.
            </div>
        </div>
    </div>

    <!-- Schema.org FAQPage JSON-LD -->
    <script type="application/ld+json">
    {
      "@@context": "https://schema.org",
      "@type": "FAQPage",
      "mainEntity": [
        {
          "@type": "Question",
          "name": "How does CupDate's selfie verification work?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "CupDate prompts you to capture a 3-second live selfie with head movement to confirm you are the true account owner. Verified users receive an official Blue Verified Badge."
          }
        },
        {
          "@type": "Question",
          "name": "Why are 45-minute coffee dates better than dinner dates?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "A daytime coffee date in a vibrant public cafe is casual, safe, affordable, and easily extended if you both feel an authentic spark."
          }
        },
        {
          "@type": "Question",
          "name": "Is CupDate active in Himachal Pradesh?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Yes, CupDate is active in Kangra, Dharamshala, McLeodGanj, Shimla, Solan, Manali, Mandi, Kullu, Palampur, and Hamirpur."
          }
        },
        {
          "@type": "Question",
          "name": "What is Ghost Location Fuzzing?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "CupDate never shares exact GPS coordinates; your location is fuzz-shifted by 1.5 to 2 kilometers to prevent stalking."
          }
        },
        {
          "@type": "Question",
          "name": "Can I chat online with people for free?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "CupDate supports free registration, profile discovery, and direct online chat for adults who follow the community guidelines."
          }
        }
      ]
    }
    </script>

    <!-- Still have questions? -->
    <div class="bg-[#fbf8f5] border border-[#e5d5ca] rounded-3xl p-8 text-center shadow-none">
        <h3 class="font-['Plus_Jakarta_Sans'] font-extrabold text-lg text-[#24140d] mb-2">Still have questions?</h3>
        <p class="text-xs text-[#7d6558] mb-4">Our support team is always eager to assist with account or safety queries.</p>
        <a href="{{ route('contact') }}" class="inline-flex items-center gap-1.5 px-6 py-2.5 bg-[#8b5a2b] text-white text-xs font-bold rounded-xl hover:bg-[#6d421d] transition shadow-none">
            <i class="fa-solid fa-envelope"></i> Contact Support Team
        </a>
    </div>
</div>
@endsection

@section('extra_js')
<script>
function toggleFaqItem(item) {
    const content = item.querySelector('.faq-content');
    const icon = item.querySelector('i');
    content.classList.toggle('hidden');
    icon.classList.toggle('rotate-180');
}
</script>
@endsection
