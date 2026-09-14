@extends('layouts.app')

@section('title', 'Terms of Service & Community Agreement — CupDate')
@section('meta_desc', 'Read the official Terms of Service for CupDate.in. Outlines age requirements, account rules, acceptable conduct, and platform safety policies.')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-12 font-['Inter']">
    <div class="text-center mb-10 bg-white border border-[#e5d5ca] rounded-3xl p-8 md:p-12 shadow-none">
        <span class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-[#f5ede6] text-[#8b5a2b] border border-[#e5d5ca] mb-3">
            <i class="fa-solid fa-scale-balanced"></i> Legal Agreement
        </span>
        <h1 class="font-['Plus_Jakarta_Sans'] font-extrabold text-3xl md:text-5xl text-[#24140d] mb-3">
            Terms of Service
        </h1>
        <p class="text-xs text-[#7d6558]">
            Effective Date: September 2026 • Governed under the Information Technology Act 2000
        </p>
    </div>

    <div class="bg-white border border-[#e5d5ca] rounded-3xl p-8 md:p-12 space-y-8 text-[#3b2d28] text-sm leading-relaxed shadow-none">
        <section class="space-y-3">
            <h2 class="font-['Plus_Jakarta_Sans'] font-extrabold text-xl text-[#24140d]">1. Acceptance of Terms & Eligibility</h2>
            <p>
                By creating an account on <strong>CupDate.in</strong>, you confirm that you are at least <strong>18 years of age</strong> and legally capable of entering into a binding contract under Indian law. Minors are strictly barred from using this service.
            </p>
        </section>

        <section class="space-y-3">
            <h2 class="font-['Plus_Jakarta_Sans'] font-extrabold text-xl text-[#24140d]">2. Account Security & Verification</h2>
            <p>
                You agree to provide accurate, honest profile information. You may not impersonate any person or use photos of celebrities, acquaintances, or third parties. CupDate reserves the right to suspend or terminate any profile failing live selfie verification.
            </p>
        </section>

        <section class="space-y-3">
            <h2 class="font-['Plus_Jakarta_Sans'] font-extrabold text-xl text-[#24140d]">3. Strict Code of Conduct (Zero Tolerance)</h2>
            <p>CupDate is dedicated to safe, respectful dating. The following behaviors result in an immediate, permanent ban:</p>
            <ul class="list-disc pl-5 space-y-2 text-xs md:text-sm text-[#5d463b]">
                <li><strong>Harassment & Hate Speech:</strong> Sending abusive, vulgar, defamatory, or threatening messages in chat.</li>
                <li><strong>Unsolicited Explicit Media:</strong> Uploading or sending sexually explicit, obscene, or non-consensual images.</li>
                <li><strong>Commercial Solicitation:</strong> Using the platform for sex work, pyramid schemes, financial scams, or product selling.</li>
                <li><strong>Extortion & Blackmail:</strong> Any attempt to coerce or extract money from other members will be reported immediately to the National Cyber Crime Reporting Portal (1930).</li>
            </ul>
        </section>

        <section class="space-y-3">
            <h2 class="font-['Plus_Jakarta_Sans'] font-extrabold text-xl text-[#24140d]">4. Partner Cafe Member Perks</h2>
            <p>
                Partner cafe discounts (e.g. 15% off total bill) are provided courtesy of landmark partner establishments. Discounts are valid exclusively during in-person coffee dates and subject to presenting your active, verified CupDate Member ID badge (#CD-XXXXX) at billing.
            </p>
        </section>

        <section class="space-y-3">
            <h2 class="font-['Plus_Jakarta_Sans'] font-extrabold text-xl text-[#24140d]">5. Jurisdiction & Dispute Resolution</h2>
            <p class="text-xs text-[#7d6558]">
                These Terms are governed by and construed in accordance with the laws of the Republic of India. Any legal dispute or proceeding arising out of or in connection with CupDate shall be subject to the exclusive jurisdiction of the competent courts in Shimla, Himachal Pradesh.
            </p>
        </section>
    </div>
</div>
@endsection
