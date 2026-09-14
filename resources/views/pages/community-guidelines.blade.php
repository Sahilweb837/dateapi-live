@extends('layouts.app')

@section('title', 'Community Guidelines & Conduct Standards — CupDate')
@section('meta_desc', 'Explore CupDate\'s community guidelines: respect, consent, anti-harassment policies, and verified dating etiquette.')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-12 font-['Inter']">
    <div class="text-center mb-10 bg-white border border-[#e5d5ca] rounded-3xl p-8 md:p-12 shadow-none">
        <span class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-[#f5ede6] text-[#8b5a2b] border border-[#e5d5ca] mb-3">
            <i class="fa-solid fa-heart"></i> Values & Mutual Respect
        </span>
        <h1 class="font-['Plus_Jakarta_Sans'] font-extrabold text-3xl md:text-5xl text-[#24140d] mb-4">
            Community Guidelines
        </h1>
        <p class="text-sm text-[#7d6558] max-w-xl mx-auto leading-relaxed">
            CupDate is built on genuine conversations, mutual respect, and safe coffee dates. We ask every member to uphold our golden rules.
        </p>
    </div>

    <div class="bg-white border border-[#e5d5ca] rounded-3xl p-8 md:p-12 space-y-8 text-[#3b2d28] text-sm leading-relaxed shadow-none">
        <section class="space-y-3">
            <h2 class="font-['Plus_Jakarta_Sans'] font-extrabold text-xl text-[#24140d]">1. Treat Everyone with Dignity</h2>
            <p>
                Behind every verified profile is a real person looking for kindness. Differences in opinion, interests, or background are natural. Communicate politely and never insult, shame, or demean another member.
            </p>
        </section>

        <section class="space-y-3">
            <h2 class="font-['Plus_Jakarta_Sans'] font-extrabold text-xl text-[#24140d]">2. Respect Consent & Boundaries</h2>
            <p>
                Consent must be enthusiastic and ongoing. If a match is not comfortable meeting in person yet, respects only daytime chats, or declines an invitation, honor their choice immediately. Never pressure or guilt someone into meeting or sharing personal contact numbers.
            </p>
        </section>

        <section class="space-y-3">
            <h2 class="font-['Plus_Jakarta_Sans'] font-extrabold text-xl text-[#24140d]">3. Accept Rejection Gracefully</h2>
            <p>
                Not every swipe turns into a match, and not every coffee conversation leads to a second date. If someone unmatches or lets you know they didn't feel chemistry, respond with grace and wish them well. Retaliatory insults or harassment will result in permanent expulsion from CupDate.
            </p>
        </section>

        <section class="space-y-3">
            <h2 class="font-['Plus_Jakarta_Sans'] font-extrabold text-xl text-[#24140d]">4. How to Report Violations</h2>
            <p>
                If you encounter any behavior violating these guidelines, click the <strong>Flag / Report Profile</strong> button directly in chat or on the user's profile card. Our safety moderation team reviews reports within 2 hours.
            </p>
        </div>
    </div>
</div>
@endsection
