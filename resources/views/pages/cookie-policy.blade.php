@extends('layouts.app')

@section('title', 'Cookie Policy & Web Storage — CupDate')
@section('meta_desc', 'Learn how CupDate uses cookies and browser storage technologies to maintain secure authentication and site preferences.')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-12 font-['Inter']">
    <div class="text-center mb-10 bg-white border border-[#e5d5ca] rounded-3xl p-8 md:p-12 shadow-none">
        <span class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-[#f5ede6] text-[#8b5a2b] border border-[#e5d5ca] mb-3">
            <i class="fa-solid fa-cookie-bite"></i> Browser Storage
        </span>
        <h1 class="font-['Plus_Jakarta_Sans'] font-extrabold text-3xl md:text-5xl text-[#24140d] mb-4">
            Cookie Policy
        </h1>
        <p class="text-xs text-[#7d6558]">
            Transparency regarding cookies, sessions, and web storage on CupDate.in.
        </p>
    </div>

    <div class="bg-white border border-[#e5d5ca] rounded-3xl p-8 md:p-12 space-y-8 text-[#3b2d28] text-sm leading-relaxed shadow-none">
        <section class="space-y-3">
            <h2 class="font-['Plus_Jakarta_Sans'] font-extrabold text-xl text-[#24140d]">1. What Are Cookies?</h2>
            <p>
                Cookies are small text files stored securely on your browser when you visit websites. They help verify that you are logged in, remember your preferences, and maintain seamless navigation without forcing you to re-authenticate on every page.
            </p>
        </section>

        <section class="space-y-3">
            <h2 class="font-['Plus_Jakarta_Sans'] font-extrabold text-xl text-[#24140d]">2. Types of Cookies We Use</h2>
            <ul class="list-disc pl-5 space-y-2 text-xs md:text-sm text-[#5d463b]">
                <li><strong>Strictly Necessary Cookies:</strong> Encrypted session tokens and CSRF protection cookies required for logging into your account, sending messages, and keeping your session safe.</li>
                <li><strong>Preference Cookies:</strong> Store your theme preferences, coffee persona filters, and city choices.</li>
                <li><strong>Security Cookies:</strong> Detect brute-force login attempts and prevent unauthorized access to your account.</li>
            </ul>
        </section>

        <section class="space-y-3">
            <h2 class="font-['Plus_Jakarta_Sans'] font-extrabold text-xl text-[#24140d]">3. Managing or Disabling Cookies</h2>
            <p>
                You can configure your browser (Google Chrome, Safari, Mozilla Firefox, or Microsoft Edge) to reject or delete cookies. However, please note that disabling essential cookies will prevent you from logging in and chatting on CupDate.
            </p>
        </section>
    </div>
</div>
@endsection
