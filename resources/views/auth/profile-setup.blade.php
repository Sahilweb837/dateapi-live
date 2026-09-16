@extends('layouts.app')

@section('title', 'Complete Your Profile — CupDate')

@section('extra_css')
<style>
.setup-bg {
    background: linear-gradient(135deg, #150906 0%, #25120a 35%, #180a06 70%, #0c0503 100%);
    min-height: 100vh;
    position: relative;
    overflow: hidden;
}
.setup-bg::before {
    content: '';
    position: absolute;
    inset: 0;
    background:
        radial-gradient(ellipse 65% 50% at 85% 15%, rgba(255,0,127,0.12) 0%, transparent 60%),
        radial-gradient(ellipse 55% 45% at 15% 85%, rgba(139,90,43,0.2) 0%, transparent 55%);
    pointer-events: none;
}
.setup-card {
    background: rgba(30,16,12,0.88);
    backdrop-filter: blur(32px);
    -webkit-backdrop-filter: blur(32px);
    border: 1px solid rgba(255,45,117,0.25);
    box-shadow: 0 32px 80px rgba(0,0,0,0.65), 0 0 30px rgba(255,0,127,0.1), inset 0 1px 0 rgba(255,255,255,0.08);
}
.setup-input {
    background: rgba(255,255,255,0.08);
    border: 1px solid rgba(255,200,160,0.22);
    color: #fff;
    transition: all 0.25s;
}
.setup-input:focus {
    outline: none;
    border-color: #ff007f;
    background: rgba(255,255,255,0.12);
    box-shadow: 0 0 0 3px rgba(255,0,127,0.18);
}
.setup-input option, .setup-input optgroup { background: #25120a; color: #fff; }
.setup-label {
    color: rgba(255,220,190,0.8);
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.07em;
}
.neon-pink-text {
    background: linear-gradient(135deg, #ff4081 0%, #ff007f 50%, #e91e63 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}
.step-dot {
    width: 36px;
    height: 6px;
    border-radius: 99px;
    background: rgba(255,200,160,0.2);
    transition: all 0.3s;
}
.step-dot.active {
    background: linear-gradient(90deg, #ff007f 0%, #ff5e97 100%);
    box-shadow: 0 0 12px rgba(255,0,127,0.6);
}
.interest-chip {
    padding: 7px 14px;
    border-radius: 99px;
    font-size: 12px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s;
    background: rgba(255,255,255,0.06);
    border: 1px solid rgba(255,200,160,0.2);
    color: rgba(255,220,190,0.75);
    user-select: none;
}
.interest-chip:hover {
    background: rgba(255,0,127,0.15);
    border-color: rgba(255,0,127,0.4);
    color: #fff;
    transform: translateY(-1px);
}
.interest-chip.selected {
    background: linear-gradient(135deg, #ff007f 0%, #ff4081 100%);
    border-color: #ff80bf;
    color: #fff;
    box-shadow: 0 4px 14px rgba(255,0,127,0.4);
}
.avatar-upload-zone {
    border: 2px dashed rgba(255,45,117,0.4);
    background: rgba(255,0,127,0.06);
    cursor: pointer;
    transition: all 0.25s;
}
.avatar-upload-zone:hover {
    border-color: #ff007f;
    background: rgba(255,0,127,0.12);
    box-shadow: 0 0 20px rgba(255,0,127,0.2);
}
.submit-btn {
    background: linear-gradient(135deg, #ff007f 0%, #ff4081 50%, #c2822a 100%);
    background-size: 200%;
    transition: all 0.3s;
    box-shadow: 0 6px 25px rgba(255,0,127,0.35);
}
.submit-btn:hover {
    background-position: right;
    box-shadow: 0 8px 30px rgba(255,0,127,0.5);
    transform: translateY(-1px);
}
.skip-link { color: rgba(255,220,190,0.4); font-size: 11px; transition: color 0.2s; }
.skip-link:hover { color: #ff80bf; }

/* Location banner */
.setup-loc-banner {
    background: linear-gradient(135deg, rgba(255,0,127,0.1) 0%, rgba(139,90,43,0.15) 100%);
    border: 1px solid rgba(255,45,117,0.25);
    border-radius: 14px;
    padding: 10px 14px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 14px;
}
</style>
@endsection

@section('content')
<div class="setup-bg pt-20 pb-16 px-4">
    <div class="max-w-xl mx-auto">

        {{-- Welcome banner --}}
        @if(session('success'))
        <div class="mb-6 p-4 rounded-2xl flex items-center gap-3" style="background:rgba(16,185,129,0.1);border:1px solid rgba(16,185,129,0.25);">
            <i class="fa-solid fa-circle-check text-emerald-400 text-lg shrink-0"></i>
            <span class="text-emerald-300 text-xs font-bold">{{ session('success') }}</span>
        </div>
        @endif

        {{-- Header with Darting Neon Pink Logo --}}
        <div class="text-center mb-6">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full mb-3" style="background:rgba(255,0,127,0.15);border:1px solid rgba(255,45,117,0.35);">
                <span class="text-[#ff80bf] text-xs">🪪</span>
                <span class="text-[#ff80bf] text-xs font-bold uppercase tracking-widest">Verified Member #{{ $user->formatted_member_id }}</span>
            </div>
            <h1 class="text-3xl font-extrabold text-white mb-2" style="font-family:'Plus Jakarta Sans',sans-serif;">
                Build Your Coffee Profile
            </h1>
            <p class="text-xs sm:text-sm text-stone-300">
                Let's make you shine for singles in your city ✨
            </p>
        </div>

        {{-- Progress Dots --}}
        <div class="flex items-center justify-center gap-2 mb-6">
            <div class="step-dot active" id="dot1"></div>
            <div class="step-dot" id="dot2"></div>
            <div class="step-dot" id="dot3"></div>
        </div>

        <div class="setup-card rounded-3xl p-6 sm:p-8">
            <form action="{{ route('profile.setup.save') }}" method="POST" enctype="multipart/form-data" id="setupForm">
                @csrf

                {{-- STEP 1: Photo & Bio --}}
                <div id="step1" class="step-panel">
                    <h2 class="text-white font-extrabold text-lg mb-4 flex items-center gap-2">
                        <span class="w-7 h-7 rounded-full flex items-center justify-center text-xs font-black text-white bg-[#ff007f]">1</span>
                        Your Profile Photo &amp; Bio
                    </h2>

                    {{-- Avatar Upload & Live Preview --}}
                    <div class="text-center mb-6">
                        <div class="relative inline-block">
                            <div class="w-32 h-32 rounded-full overflow-hidden mx-auto mb-3 ring-4 ring-[#ff007f]/40 shadow-[0_0_25px_rgba(255,0,127,0.3)] relative" id="avatarPreviewWrapper">
                                <img id="avatarPreview"
                                    src="{{ $user->avatar_url }}"
                                    class="w-full h-full object-cover"
                                    alt="Your photo">
                                <span class="absolute bottom-1 right-1 w-6 h-6 rounded-full bg-[#ff007f] text-white text-xs flex items-center justify-center ring-2 ring-[#1e100c]" title="Selfie Verified Badge">
                                    <i class="fa-solid fa-check"></i>
                                </span>
                            </div>

                            <label for="avatar_file" class="avatar-upload-zone rounded-2xl px-5 py-3 flex flex-col items-center gap-1 mt-2">
                                <i class="fa-solid fa-camera text-[#ff80bf] text-xl mb-1"></i>
                                <span class="text-[#ff80bf] text-xs font-bold">Upload Your Best Portrait Photo</span>
                                <span class="text-[11px]" style="color:rgba(255,220,190,0.45);">High quality JPG, PNG, or WebP</span>
                            </label>
                            <input type="file" id="avatar_file" name="avatar_file" accept="image/*" class="hidden" onchange="previewSetupAvatar(this)">
                        </div>
                    </div>

                    {{-- Bio with Prompts --}}
                    <div class="mb-5">
                        <div class="flex items-center justify-between mb-2">
                            <label class="setup-label">Your Dating Vibe / Bio</label>
                            <span class="text-[10px] text-[#ff80bf] cursor-pointer hover:underline" onclick="injectBioPrompt()">💡 Suggest a bio</span>
                        </div>
                        <textarea name="bio" id="bioInput" rows="3" class="setup-input w-full rounded-2xl px-4 py-3 text-sm resize-none"
                            placeholder="e.g. Exploring mountain cafes, photography, and good indie playlists. Up for a 45-minute coffee date? ☕📸"
                            maxlength="500" oninput="updateBioCount(this)">{{ old('bio', $user->bio) }}</textarea>
                        <div class="flex justify-end mt-1">
                            <span id="bioCount" class="text-xs" style="color:rgba(255,220,190,0.35);">0/500</span>
                        </div>
                    </div>

                    {{-- Dating Intent --}}
                    <div class="mb-6">
                        <label class="setup-label block mb-2">Dating Intent</label>
                        <select name="interested_in" class="setup-input w-full rounded-xl px-4 py-2.5 text-sm">
                            <option value="Coffee Dates & Chemistry" selected>☕ Coffee Dates &amp; Mutual Chemistry</option>
                            <option value="Serious Relationship & Rishta">💍 Long Term Relationship / Authentic Rishta</option>
                            <option value="Himalayan Adventure Partner">🏔️ Mountain Treks &amp; Travel Buddy</option>
                            <option value="Meaningful Conversations">✨ Soulful Conversations &amp; New Friends</option>
                        </select>
                    </div>

                    <button type="button" onclick="goStep(2)"
                        class="submit-btn w-full py-3.5 rounded-2xl text-sm font-extrabold text-white cursor-pointer flex items-center justify-center gap-2">
                        <span>Continue → City &amp; Interests</span>
                        <i class="fa-solid fa-arrow-right"></i>
                    </button>
                </div>

                {{-- STEP 2: City & Interests --}}
                <div id="step2" class="step-panel hidden">
                    <h2 class="text-white font-extrabold text-lg mb-4 flex items-center gap-2">
                        <span class="w-7 h-7 rounded-full flex items-center justify-center text-xs font-black text-white bg-[#ff007f]">2</span>
                        Your City &amp; Coffee Persona
                    </h2>

                    {{-- Auto Location Detector Bar --}}
                    <div class="setup-loc-banner">
                        <div class="flex items-center gap-2 text-xs text-stone-200 font-bold">
                            <i class="fa-solid fa-location-dot text-[#ff007f]"></i>
                            <span id="setupLocStatus">Auto-Detect Current Location:</span>
                        </div>
                        <button type="button" onclick="detectSetupLocation()" id="setupLocBtn" class="px-2.5 py-1 rounded-lg bg-[#ff007f]/20 border border-[#ff007f]/40 text-[#ff80bf] text-[11px] font-bold hover:bg-[#ff007f] hover:text-white transition">
                            <i class="fa-solid fa-crosshairs mr-1"></i> Detect GPS
                        </button>
                    </div>

                    {{-- City Dropdown with Complete Himachal Pradesh Cities --}}
                    <div class="mb-5">
                        <label class="setup-label block mb-2">City / Location <span class="text-[#ff80bf]">*</span></label>
                        <select name="country" id="setupCitySelect" class="setup-input w-full rounded-xl px-4 py-3 text-sm">
                            <optgroup label="🏔️ Himachal Pradesh (All Districts)">
                                <option value="Kangra, Himachal Pradesh" {{ $user->country == 'Kangra, Himachal Pradesh' ? 'selected' : '' }}>Kangra</option>
                                <option value="Solan, Himachal Pradesh" {{ $user->country == 'Solan, Himachal Pradesh' ? 'selected' : '' }}>Solan</option>
                                <option value="Shimla, Himachal Pradesh" {{ $user->country == 'Shimla, Himachal Pradesh' ? 'selected' : '' }}>Shimla</option>
                                <option value="Dharamshala, Himachal Pradesh" {{ $user->country == 'Dharamshala, Himachal Pradesh' ? 'selected' : '' }}>Dharamshala &amp; McLeodGanj</option>
                                <option value="Manali, Himachal Pradesh" {{ $user->country == 'Manali, Himachal Pradesh' ? 'selected' : '' }}>Manali &amp; Old Manali</option>
                                <option value="Mandi, Himachal Pradesh" {{ $user->country == 'Mandi, Himachal Pradesh' ? 'selected' : '' }}>Mandi</option>
                                <option value="Kullu, Himachal Pradesh" {{ $user->country == 'Kullu, Himachal Pradesh' ? 'selected' : '' }}>Kullu</option>
                                <option value="Hamirpur, Himachal Pradesh" {{ $user->country == 'Hamirpur, Himachal Pradesh' ? 'selected' : '' }}>Hamirpur</option>
                                <option value="Bilaspur, Himachal Pradesh" {{ $user->country == 'Bilaspur, Himachal Pradesh' ? 'selected' : '' }}>Bilaspur</option>
                                <option value="Una, Himachal Pradesh" {{ $user->country == 'Una, Himachal Pradesh' ? 'selected' : '' }}>Una</option>
                                <option value="Chamba, Himachal Pradesh" {{ $user->country == 'Chamba, Himachal Pradesh' ? 'selected' : '' }}>Chamba</option>
                                <option value="Palampur, Himachal Pradesh" {{ $user->country == 'Palampur, Himachal Pradesh' ? 'selected' : '' }}>Palampur</option>
                                <option value="Dalhousie, Himachal Pradesh" {{ $user->country == 'Dalhousie, Himachal Pradesh' ? 'selected' : '' }}>Dalhousie</option>
                                <option value="Baddi, Himachal Pradesh" {{ $user->country == 'Baddi, Himachal Pradesh' ? 'selected' : '' }}>Baddi</option>
                            </optgroup>
                            <optgroup label="🌿 North India &amp; Tri-City">
                                <option value="Chandigarh, India" {{ $user->country == 'Chandigarh, India' ? 'selected' : '' }}>Chandigarh</option>
                                <option value="Mohali, Punjab" {{ $user->country == 'Mohali, Punjab' ? 'selected' : '' }}>Mohali</option>
                                <option value="Panchkula, Haryana" {{ $user->country == 'Panchkula, Haryana' ? 'selected' : '' }}>Panchkula</option>
                                <option value="Delhi NCR, India" {{ $user->country == 'Delhi NCR, India' ? 'selected' : '' }}>Delhi NCR</option>
                                <option value="Dehradun, Uttarakhand" {{ $user->country == 'Dehradun, Uttarakhand' ? 'selected' : '' }}>Dehradun</option>
                                <option value="Amritsar, Punjab" {{ $user->country == 'Amritsar, Punjab' ? 'selected' : '' }}>Amritsar</option>
                                <option value="Ludhiana, Punjab" {{ $user->country == 'Ludhiana, Punjab' ? 'selected' : '' }}>Ludhiana</option>
                            </optgroup>
                            <optgroup label="☕ Major Indian Metros">
                                <option value="Pune, India" {{ $user->country == 'Pune, India' ? 'selected' : '' }}>Pune</option>
                                <option value="Mumbai, India" {{ $user->country == 'Mumbai, India' ? 'selected' : '' }}>Mumbai</option>
                                <option value="Bangalore, India" {{ $user->country == 'Bangalore, India' ? 'selected' : '' }}>Bangalore</option>
                                <option value="Jaipur, India" {{ $user->country == 'Jaipur, India' ? 'selected' : '' }}>Jaipur</option>
                                <option value="Hyderabad, India" {{ $user->country == 'Hyderabad, India' ? 'selected' : '' }}>Hyderabad</option>
                                <option value="Kolkata, India" {{ $user->country == 'Kolkata, India' ? 'selected' : '' }}>Kolkata</option>
                                <option value="Chennai, India" {{ $user->country == 'Chennai, India' ? 'selected' : '' }}>Chennai</option>
                                <option value="Ahmedabad, India" {{ $user->country == 'Ahmedabad, India' ? 'selected' : '' }}>Ahmedabad</option>
                                <option value="Goa, India" {{ $user->country == 'Goa, India' ? 'selected' : '' }}>Goa</option>
                            </optgroup>
                        </select>
                    </div>

                    {{-- Coffee Persona --}}
                    <div class="mb-5">
                        <label class="setup-label block mb-2">Coffee Persona ☕</label>
                        <select name="coffee_style" class="setup-input w-full rounded-xl px-4 py-3 text-sm">
                            @foreach(['Himalayan Pour-Over','Vanilla Oat Latte','Espresso Macchiato','Cold Brew Nitro','Cappuccino Cinnamon','Dark Roast Mocha','French Press Arabica','Chai Masala Vibe'] as $cs)
                                <option value="{{ $cs }}" {{ ($user->coffee_style === $cs) ? 'selected' : '' }}>{{ $cs }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Interest Chips --}}
                    <div class="mb-6">
                        <label class="setup-label block mb-3">Your Passions &amp; Vibes (tap to pick 3+)</label>
                        <div class="flex flex-wrap gap-2" id="interestChips">
                            @foreach(['Himalayan Treks','Coffee Roasters','Photography','Indie Music','Books & Poetry','Road Trips','Campfires','Art & Design','Fitness','Yoga','Cooking','Board Games','Tech & Startups','Pets & Dogs','Snowboarding','Heritage Walks'] as $chip)
                                <div class="interest-chip" data-val="{{ $chip }}" onclick="toggleInterest(this)">
                                    {{ $chip }}
                                </div>
                            @endforeach
                        </div>
                        <input type="hidden" name="interests" id="interestsInput" value="{{ old('interests', $user->interests) }}">
                    </div>

                    <div class="flex gap-3">
                        <button type="button" onclick="goStep(1)"
                            class="flex-1 py-3 rounded-2xl text-sm font-bold cursor-pointer transition"
                            style="background:rgba(255,255,255,0.06);border:1px solid rgba(255,200,160,0.15);color:rgba(255,220,190,0.6);">
                            ← Back
                        </button>
                        <button type="button" onclick="goStep(3)"
                            class="submit-btn flex-1 py-3 rounded-2xl text-sm font-extrabold text-white cursor-pointer">
                            Continue → Personality
                        </button>
                    </div>
                </div>

                {{-- STEP 3: Personality & Astrology --}}
                <div id="step3" class="step-panel hidden">
                    <h2 class="text-white font-extrabold text-lg mb-4 flex items-center gap-2">
                        <span class="w-7 h-7 rounded-full flex items-center justify-center text-xs font-black text-white bg-[#ff007f]">3</span>
                        Your Personality &amp; Vibe
                    </h2>

                    <div class="grid grid-cols-2 gap-4 mb-5">
                        <div>
                            <label class="setup-label block mb-2">MBTI Type</label>
                            <select name="mbti" class="setup-input w-full rounded-xl px-4 py-3 text-sm">
                                <option value="">Select MBTI...</option>
                                @foreach(['ENFP','INFJ','INTJ','INTP','ENTP','ENTJ','INFP','ENFJ','ISFP','ESFP','ISTP','ESTP','ISFJ','ESFJ','ISTJ','ESTJ'] as $mbti)
                                    <option value="{{ $mbti }}" {{ ($user->mbti === $mbti) ? 'selected' : '' }}>{{ $mbti }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="setup-label block mb-2">Zodiac Sign ✨</label>
                            <select name="astrology" class="setup-input w-full rounded-xl px-4 py-3 text-sm">
                                <option value="">Select Zodiac...</option>
                                @foreach(['Aries','Taurus','Gemini','Cancer','Leo','Virgo','Libra','Scorpio','Sagittarius','Capricorn','Aquarius','Pisces'] as $zodiac)
                                    <option value="{{ $zodiac }}" {{ ($user->astrology === $zodiac) ? 'selected' : '' }}>{{ $zodiac }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- Completion Boost Banner --}}
                    <div class="p-4 rounded-2xl mb-6" style="background:rgba(255,0,127,0.1);border:1px solid rgba(255,45,117,0.25);">
                        <div class="flex items-center gap-3">
                            <span class="text-2xl">☕</span>
                            <div>
                                <p class="text-[#ff80bf] text-xs font-extrabold">+50 Bonus Coins &amp; 24h Profile Boost</p>
                                <p class="text-[11px] text-stone-300">Completing your setup awards free coffee coins to boost your swipes visibility!</p>
                            </div>
                        </div>
                    </div>

                    <div class="flex gap-3 mb-4">
                        <button type="button" onclick="goStep(2)"
                            class="flex-1 py-3 rounded-2xl text-sm font-bold cursor-pointer transition"
                            style="background:rgba(255,255,255,0.06);border:1px solid rgba(255,200,160,0.15);color:rgba(255,220,190,0.6);">
                            ← Back
                        </button>
                        <button type="submit" id="setupSubmitBtn"
                            class="submit-btn flex-1 py-3.5 rounded-2xl text-sm font-extrabold text-white cursor-pointer flex items-center justify-center gap-2">
                            <i class="fa-solid fa-mug-hot"></i>
                            <span>Complete My Profile!</span>
                        </button>
                    </div>

                    <div class="text-center">
                        <a href="{{ route('feed') }}" class="skip-link">Skip for now → explore feed</a>
                    </div>
                </div>

            </form>
        </div>

    </div>
</div>

<script>
// Step Navigation
function goStep(step) {
    document.querySelectorAll('.step-panel').forEach(p => p.classList.add('hidden'));
    document.getElementById('step' + step).classList.remove('hidden');

    for (let i = 1; i <= 3; i++) {
        const dot = document.getElementById('dot' + i);
        if (i <= step) {
            dot.classList.add('active');
        } else {
            dot.classList.remove('active');
        }
    }
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

// Avatar Preview
function previewSetupAvatar(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('avatarPreview').src = e.target.result;
        };
        reader.readAsDataURL(input.files[0]);
    }
}

// Bio Character Counter
function updateBioCount(textarea) {
    document.getElementById('bioCount').innerText = textarea.value.length + '/500';
}

const SAMPLE_BIOS = [
    "Specialty coffee nerd, amateur film photographer, and weekend trekker. Looking for great cafe conversations ☕📸",
    "Born in the hills, lover of pine-scented trails, acoustic indie jams, and hot French press coffee 🏔️✨",
    "Architect & design enthusiast. Always up for a 45-minute coffee date at a quiet botanical cafe ☕🌿",
    "Exploring local roasteries, sharing travel stories, and seeking an authentic romantic connection 💫"
];
function injectBioPrompt() {
    const randomBio = SAMPLE_BIOS[Math.floor(Math.random() * SAMPLE_BIOS.length)];
    const bioInput = document.getElementById('bioInput');
    bioInput.value = randomBio;
    updateBioCount(bioInput);
}

// Interest Chips Selection
const selectedInterests = new Set();
const existingInterests = "{{ old('interests', $user->interests) }}".split(',').map(s => s.trim()).filter(Boolean);
existingInterests.forEach(item => selectedInterests.add(item));

document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.interest-chip').forEach(chip => {
        if (selectedInterests.has(chip.getAttribute('data-val'))) {
            chip.classList.add('selected');
        }
    });
    const bio = document.getElementById('bioInput');
    if (bio) updateBioCount(bio);
});

function toggleInterest(el) {
    const val = el.getAttribute('data-val');
    if (selectedInterests.has(val)) {
        selectedInterests.delete(val);
        el.classList.remove('selected');
    } else {
        selectedInterests.add(val);
        el.classList.add('selected');
    }
    document.getElementById('interestsInput').value = Array.from(selectedInterests).join(', ');
}

// GPS Location Detection for Setup
const SETUP_CITIES = [
    { name: 'Kangra, Himachal Pradesh', lat: 32.0998, lng: 76.2691 },
    { name: 'Dharamshala, Himachal Pradesh', lat: 32.2190, lng: 76.3234 },
    { name: 'Solan, Himachal Pradesh', lat: 30.9084, lng: 77.0999 },
    { name: 'Shimla, Himachal Pradesh', lat: 31.1048, lng: 77.1734 },
    { name: 'Manali, Himachal Pradesh', lat: 32.2432, lng: 77.1892 },
    { name: 'Mandi, Himachal Pradesh', lat: 31.7087, lng: 76.9320 },
    { name: 'Kullu, Himachal Pradesh', lat: 31.9579, lng: 77.1095 },
    { name: 'Hamirpur, Himachal Pradesh', lat: 31.6862, lng: 76.5213 },
    { name: 'Bilaspur, Himachal Pradesh', lat: 31.3326, lng: 76.7570 },
    { name: 'Una, Himachal Pradesh', lat: 31.4685, lng: 76.2708 },
    { name: 'Chamba, Himachal Pradesh', lat: 32.5534, lng: 76.1258 },
    { name: 'Palampur, Himachal Pradesh', lat: 32.1109, lng: 76.5363 },
    { name: 'Chandigarh, India', lat: 30.7333, lng: 76.7794 },
    { name: 'Pune, India', lat: 18.5204, lng: 73.8567 },
    { name: 'Delhi NCR, India', lat: 28.6139, lng: 77.2090 },
    { name: 'Mumbai, India', lat: 19.0760, lng: 72.8777 },
    { name: 'Bangalore, India', lat: 12.9716, lng: 77.5946 }
];

function detectSetupLocation() {
    const status = document.getElementById('setupLocStatus');
    const btn = document.getElementById('setupLocBtn');

    if (!navigator.geolocation) {
        status.innerText = "Geolocation not supported";
        return;
    }

    btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Locating...';
    btn.disabled = true;

    navigator.geolocation.getCurrentPosition(
        (pos) => {
            const lat = pos.coords.latitude;
            const lng = pos.coords.longitude;

            let closest = SETUP_CITIES[0];
            let minDist = 999999;

            SETUP_CITIES.forEach(c => {
                const d = Math.hypot(lat - c.lat, lng - c.lng);
                if (d < minDist) {
                    minDist = d;
                    closest = c;
                }
            });

            status.innerText = `📍 Auto-detected: ${closest.name.split(',')[0]}`;
            status.className = "text-xs text-emerald-400 font-extrabold";
            btn.innerHTML = '<i class="fa-solid fa-check"></i> Applied';
            btn.className = "px-2.5 py-1 rounded-lg bg-emerald-500/20 border border-emerald-400 text-emerald-300 text-[11px] font-bold";

            const select = document.getElementById('setupCitySelect');
            if (select) select.value = closest.name;
        },
        (err) => {
            status.innerText = "Location permission denied";
            btn.innerHTML = '<i class="fa-solid fa-crosshairs"></i> Retry';
            btn.disabled = false;
        }
    );
}
</script>
@endsection
