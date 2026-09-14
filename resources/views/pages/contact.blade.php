@extends('layouts.app')

@section('title', 'Contact Us & Grievance Redressal — CupDate')
@section('meta_desc', 'Contact CupDate customer support, grievance redressal officer, partnership inquiries, or safety reports. Operating offices in Shimla and Pune.')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-12">
    <!-- Header -->
    <div class="text-center mb-10 bg-white border border-[#e5d5ca] rounded-3xl p-8 md:p-12 shadow-none">
        <span class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-[#f5ede6] text-[#8b5a2b] border border-[#e5d5ca] mb-3">
            <i class="fa-solid fa-headset"></i> 24/7 Support & Grievance
        </span>
        <h1 class="font-['Plus_Jakarta_Sans'] font-extrabold text-3xl md:text-5xl text-[#24140d] mb-4">
            We're Here to Help
        </h1>
        <p class="text-sm text-[#7d6558] max-w-xl mx-auto leading-relaxed">
            Have a question about verification, membership, safety, or cafe partnerships? Reach out directly to our dedicated support team.
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
        <!-- Contact Info Sidecard -->
        <div class="space-y-4">
            <div class="bg-white border border-[#e5d5ca] rounded-3xl p-6 shadow-none">
                <div class="w-10 h-10 rounded-2xl bg-[#f5ede6] border border-[#e5d5ca] text-[#8b5a2b] flex items-center justify-center text-lg mb-3">
                    <i class="fa-solid fa-envelope"></i>
                </div>
                <strong class="text-xs uppercase font-bold text-[#7d6558] block">Direct Email</strong>
                <a href="mailto:support@cupdate.in" class="text-sm font-bold text-[#8b5a2b] hover:underline">support@cupdate.in</a>
                <p class="text-[11px] text-[#7d6558] mt-1">Typical response within 12 hours.</p>
            </div>

            <div class="bg-white border border-[#e5d5ca] rounded-3xl p-6 shadow-none">
                <div class="w-10 h-10 rounded-2xl bg-[#f5ede6] border border-[#e5d5ca] text-[#8b5a2b] flex items-center justify-center text-lg mb-3">
                    <i class="fa-solid fa-scale-balanced"></i>
                </div>
                <strong class="text-xs uppercase font-bold text-[#7d6558] block">Grievance Officer</strong>
                <p class="text-xs font-bold text-[#24140d]">Pooja Deshmukh</p>
                <p class="text-[11px] text-[#7d6558] mt-1">Nodal Grievance Redressal Officer under Information Technology Rules 2021.</p>
                <p class="text-xs font-mono text-[#8b5a2b] mt-1">grievance@cupdate.in</p>
            </div>

            <div class="bg-white border border-[#e5d5ca] rounded-3xl p-6 shadow-none">
                <div class="w-10 h-10 rounded-2xl bg-[#f5ede6] border border-[#e5d5ca] text-[#8b5a2b] flex items-center justify-center text-lg mb-3">
                    <i class="fa-solid fa-location-dot"></i>
                </div>
                <strong class="text-xs uppercase font-bold text-[#7d6558] block">Operating Offices</strong>
                <p class="text-xs text-[#24140d] font-semibold mt-1">Shimla Regional Center:</p>
                <p class="text-[11px] text-[#7d6558]">The Mall Road, Shimla, HP 171001</p>
                <p class="text-xs text-[#24140d] font-semibold mt-2">Pune Tech Center:</p>
                <p class="text-[11px] text-[#7d6558]">Koregaon Park, Pune, MH 411001</p>
            </div>
        </div>

        <!-- Contact Submission Form (AJAX Zero-Refresh) -->
        <div class="md:col-span-2 bg-white border border-[#e5d5ca] rounded-3xl p-8 shadow-none">
            <h2 class="font-['Plus_Jakarta_Sans'] font-extrabold text-xl text-[#24140d] mb-2">Send Us a Message</h2>
            <p class="text-xs text-[#7d6558] mb-6">Fill out the form below. We will respond directly to your email address.</p>

            <div id="contactSuccessMsg" class="hidden mb-6 p-4 bg-[#ecfdf5] border border-[#a7f3d0] rounded-2xl text-xs font-bold text-[#065f46] flex items-center gap-2">
                <i class="fa-solid fa-circle-check text-base shrink-0"></i>
                <span id="contactSuccessText">Thank you! Your message has been sent successfully. ☕</span>
            </div>

            <form id="contactForm" onsubmit="handleContactSubmit(event)" class="space-y-4">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-[#7d6558] mb-1">Your Name</label>
                        <input type="text" name="name" id="contactName" required placeholder="e.g. Rahul Sharma" class="w-full bg-[#fbf8f5] border border-[#e5d5ca] rounded-xl px-4 py-2.5 text-xs text-[#24140d] focus:outline-none focus:border-[#8b5a2b]">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-[#7d6558] mb-1">Email Address</label>
                        <input type="email" name="email" id="contactEmail" required placeholder="rahul@example.com" class="w-full bg-[#fbf8f5] border border-[#e5d5ca] rounded-xl px-4 py-2.5 text-xs text-[#24140d] focus:outline-none focus:border-[#8b5a2b]">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-[#7d6558] mb-1">Inquiry Category</label>
                        <select name="category" id="contactCategory" class="w-full bg-[#fbf8f5] border border-[#e5d5ca] rounded-xl px-4 py-2.5 text-xs text-[#24140d] focus:outline-none focus:border-[#8b5a2b]">
                            <option value="general">General Inquiry</option>
                            <option value="verification">Selfie Verification Help</option>
                            <option value="safety">Report Safety Concern</option>
                            <option value="partnership">Partner Cafe Inquiry</option>
                            <option value="press">Press & Media</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-[#7d6558] mb-1">Subject</label>
                        <input type="text" name="subject" id="contactSubject" required placeholder="Brief subject..." class="w-full bg-[#fbf8f5] border border-[#e5d5ca] rounded-xl px-4 py-2.5 text-xs text-[#24140d] focus:outline-none focus:border-[#8b5a2b]">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-[#7d6558] mb-1">Message</label>
                    <textarea name="message" id="contactMessage" rows="5" required placeholder="Describe your enquiry or report in detail..." class="w-full bg-[#fbf8f5] border border-[#e5d5ca] rounded-xl px-4 py-3 text-xs text-[#24140d] focus:outline-none focus:border-[#8b5a2b] resize-none"></textarea>
                </div>

                <button type="submit" id="contactSubmitBtn" class="w-full py-3.5 bg-[#8b5a2b] text-white rounded-xl font-extrabold text-xs hover:bg-[#6d421d] transition cursor-pointer shadow-none">
                    Send Message ☕
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('extra_js')
<script>
async function handleContactSubmit(e) {
    e.preventDefault();
    const btn = document.getElementById('contactSubmitBtn');
    btn.disabled = true;
    btn.innerText = 'Sending...';

    const formData = new FormData(document.getElementById('contactForm'));

    try {
        const res = await fetch("{{ route('contact.submit') }}", {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: formData
        });

        const data = await res.json();
        if (data.success) {
            document.getElementById('contactSuccessMsg').classList.remove('hidden');
            document.getElementById('contactSuccessText').innerText = data.message;
            document.getElementById('contactForm').reset();
        } else {
            alert(data.message || 'Could not send message.');
        }
    } catch (err) {
        alert('An error occurred. Please try again.');
    } finally {
        btn.disabled = false;
        btn.innerText = 'Send Message ☕';
    }
}
</script>
@endsection
