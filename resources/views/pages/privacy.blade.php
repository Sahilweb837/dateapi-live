@extends('layouts.app')

@section('title', 'Privacy Policy & DPDP Act Compliance — CupDate')
@section('meta_desc', 'Read CupDate\'s full Privacy Policy. Learn how we collect, safeguard, and encrypt your personal data under the Digital Personal Data Protection Act 2023.')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-12 font-['Inter']">
    <div class="text-center mb-10 bg-white border border-[#e5d5ca] rounded-3xl p-8 md:p-12 shadow-none">
        <span class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-[#f5ede6] text-[#8b5a2b] border border-[#e5d5ca] mb-3">
            <i class="fa-solid fa-user-shield"></i> Data Protection & Privacy
        </span>
        <h1 class="font-['Plus_Jakarta_Sans'] font-extrabold text-3xl md:text-5xl text-[#24140d] mb-3">
            Privacy Policy
        </h1>
        <p class="text-xs text-[#7d6558]">
            Last Updated: September 2026 • Compliant with Indian DPDP Act 2023 & Global GDPR Standards
        </p>
    </div>

    <div class="bg-white border border-[#e5d5ca] rounded-3xl p-8 md:p-12 space-y-8 text-[#3b2d28] text-sm leading-relaxed shadow-none">
        <section class="space-y-3">
            <h2 class="font-['Plus_Jakarta_Sans'] font-extrabold text-xl text-[#24140d]">1. Introduction & Trust Commitment</h2>
            <p>
                CupDate Technologies Pvt. Ltd. ("CupDate", "we", "our", or "us") operates the website <strong>https://cupdate.in</strong>. We respect the personal privacy of all members seeking genuine connections. This Privacy Policy details how we collect, process, store, and safeguard your personal information when you use our dating service.
            </p>
        </section>

        <section class="space-y-3">
            <h2 class="font-['Plus_Jakarta_Sans'] font-extrabold text-xl text-[#24140d]">2. Information We Collect</h2>
            <ul class="list-disc pl-5 space-y-2 text-xs md:text-sm text-[#5d463b]">
                <li><strong>Account Credentials:</strong> Full name, verified email address, hashed passwords, date of birth (18+ verification), gender, and dating preference.</li>
                <li><strong>Profile & Coffee Traits:</strong> Bio, MBTI personality type, Zodiac sign, favorite coffee style, and optional social handles (Instagram/Snapchat).</li>
                <li><strong>Selfie Verification Data:</strong> Real-time facial liveness scans processed solely to detect fraudulent accounts, bots, and catfishes. Raw biometric scans are deleted following verification; only a cryptographically hashed confirmation token is retained.</li>
                <li><strong>Location Information:</strong> Geographic location provided with your explicit consent. We strictly apply <em>location fuzzing</em> (shifting coordinates by 1.5–2km) to protect your residence and workplace privacy.</li>
            </ul>
        </section>

        <section class="space-y-3">
            <h2 class="font-['Plus_Jakarta_Sans'] font-extrabold text-xl text-[#24140d]">3. How We Use Your Data</h2>
            <p>
                We process user data solely to provide, personalize, and secure your coffee dating experience:
            </p>
            <ul class="list-disc pl-5 space-y-1.5 text-xs md:text-sm text-[#5d463b]">
                <li>Connecting you with compatible, verified singles in your chosen city or state.</li>
                <li>Facilitating direct, clutter-free messaging and safe cafe date planning.</li>
                <li>Enforcing community safety guidelines and detecting abusive behavior.</li>
                <li>Processing optional membership subscriptions and streak rewards.</li>
            </ul>
        </section>

        <section class="space-y-3">
            <h2 class="font-['Plus_Jakarta_Sans'] font-extrabold text-xl text-[#24140d]">4. Zero Third-Party Data Selling</h2>
            <div class="p-4 bg-[#f5ede6] border border-[#e5d5ca] rounded-2xl text-xs text-[#8b5a2b] font-bold">
                <i class="fa-solid fa-lock mr-1.5"></i> We have NEVER sold, rented, or monetized personal user information or private chat messages to data brokers, ad networks, or external commercial third parties. Your personal conversations are completely private.
            </div>
        </section>

        <section class="space-y-3">
            <h2 class="font-['Plus_Jakarta_Sans'] font-extrabold text-xl text-[#24140d]">5. Digital Personal Data Protection (DPDP) Act Rights</h2>
            <p>Under the Digital Personal Data Protection Act 2023, you have guaranteed statutory rights:</p>
            <ul class="list-disc pl-5 space-y-1.5 text-xs md:text-sm text-[#5d463b]">
                <li><strong>Right to Access:</strong> Request a full digital copy of all personal data held about you.</li>
                <li><strong>Right to Correction & Erasure:</strong> Modify incomplete profile data or request immediate, permanent deletion of your account and messages.</li>
                <li><strong>Right of Grievance Redressal:</strong> Direct escalation to our designated Grievance Officer (<a href="mailto:grievance@cupdate.in" class="text-[#8b5a2b] underline">grievance@cupdate.in</a>) with mandatory resolution within 30 days.</li>
            </ul>
        </section>

        <section class="space-y-3">
            <h2 class="font-['Plus_Jakarta_Sans'] font-extrabold text-xl text-[#24140d]">6. Contact Our Data Protection Officer</h2>
            <p class="text-xs text-[#7d6558]">
                For any questions regarding this Privacy Policy or your personal data rights, write to our Data Protection Officer at <a href="mailto:privacy@cupdate.in" class="font-bold text-[#8b5a2b] underline">privacy@cupdate.in</a> or visit our corporate office at The Mall Road, Shimla, Himachal Pradesh 171001, India.
            </p>
        </section>
    </div>
</div>
@endsection
