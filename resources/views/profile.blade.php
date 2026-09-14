@extends('layouts.app')

@section('title', $targetUser->full_name . ' — Profile | CupDate')

@section('content')
<!-- 4-Tab Top Navigation Bar -->
<div class="cupdate-top-tabs">
    <div class="cupdate-tabs-inner">
        <a href="{{ route('feed') }}" class="cupdate-tab-btn"><i class="fa-solid fa-mug-hot"></i> Feed</a>
        <a href="{{ route('swipes') }}" class="cupdate-tab-btn"><i class="fa-solid fa-fire"></i> Swipes</a>
        <a href="{{ route('messages') }}" class="cupdate-tab-btn"><i class="fa-solid fa-comments"></i> Chat</a>
        <a href="{{ route('profile') }}" class="cupdate-tab-btn active"><i class="fa-solid fa-user"></i> Profile</a>
    </div>
</div>

<div class="max-w-4xl mx-auto px-4 py-8">
    @if(session('success'))
        <div class="mb-6 p-4 bg-[#ecfdf5] border border-[#a7f3d0] rounded-2xl text-xs font-bold text-[#065f46] flex items-center gap-2 shadow-none">
            <i class="fa-solid fa-circle-check text-base"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <!-- Profile Completeness Meter (for own profile) -->
    @if($isOwnProfile)
        <div class="mb-6 bg-white border border-[#e5d5ca] rounded-3xl p-5 shadow-none">
            <div class="flex items-center justify-between mb-2">
                <span class="text-xs font-extrabold text-[#24140d] flex items-center gap-1.5">
                    <i class="fa-solid fa-chart-pie text-[#8b5a2b]"></i> Profile Completeness
                </span>
                <strong class="text-xs font-extrabold text-[#8b5a2b]">{{ $completeness ?? 80 }}%</strong>
            </div>
            <div class="w-full bg-[#f5ede6] border border-[#e5d5ca] h-2.5 rounded-full overflow-hidden shadow-none">
                <div class="bg-[#8b5a2b] h-full rounded-full transition-all duration-500" style="width: {{ $completeness ?? 80 }}%;"></div>
            </div>
            <p class="text-[11px] text-[#7a666c] mt-2">
                Add your coffee persona, MBTI type, favorite cafe, and photo to receive up to 3x more coffee date invitations!
            </p>
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Left: Profile Identity Card -->
        <div class="bg-white border border-[#e5d5ca] rounded-3xl p-6 text-center flex flex-col items-center shadow-none">
            <div class="relative mb-3">
                <img id="avatarDisplay" src="{{ $targetUser->avatar_url }}" alt="{{ $targetUser->full_name }}" class="w-32 h-32 rounded-full object-cover border-4 border-[#8b5a2b] shadow-none">
                @if($targetUser->is_verified)
                    <i class="fa-solid fa-circle-check text-[#8b5a2b] text-2xl absolute bottom-1 right-1 bg-white rounded-full"></i>
                @endif
                @if($isOwnProfile)
                    <button type="button" onclick="document.getElementById('avatarFileInput').click()" class="absolute bottom-1 left-1 w-8 h-8 rounded-full bg-[#8b5a2b] text-white flex items-center justify-center text-xs hover:bg-[#6d441e] transition cursor-pointer shadow-none" title="Change Photo">
                        <i class="fa-solid fa-camera"></i>
                    </button>
                @endif
            </div>

            <!-- Member ID Badge -->
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-black uppercase tracking-wider bg-[#f5ede6] text-[#8b5a2b] border border-[#e5d5ca] mb-2 shadow-none">
                <i class="fa-solid fa-id-badge text-[#8b5a2b]"></i> ID #{{ $targetUser->formatted_member_id }}
            </span>

            <h2 class="font-['Plus_Jakarta_Sans'] font-extrabold text-xl text-[#24140d] flex items-center gap-1.5">
                {{ $targetUser->full_name }}
            </h2>
            <p class="text-xs text-[#7a666c] mt-0.5">
                {{ $targetUser->age }} Years Old • {{ ucfirst($targetUser->gender ?? 'Not specified') }}
            </p>

            <!-- Photo Download Link -->
            <a href="{{ $targetUser->avatar_url }}" download="{{ \Illuminate\Support\Str::slug($targetUser->full_name) }}-cupid-photo.jpg" class="mt-3 inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-xl bg-[#fbf8f5] border border-[#e5d5ca] text-[11px] font-bold text-[#8b5a2b] hover:bg-[#f5ede6] transition shadow-none cursor-pointer">
                <i class="fa-solid fa-download text-[10px]"></i> Download HD Photo
            </a>

            @if($targetUser->is_boosted)
                <div class="mt-3 inline-flex items-center gap-1.5 bg-[#8b5a2b] text-white text-[11px] font-extrabold px-3 py-1 rounded-full uppercase tracking-wider shadow-none">
                    <i class="fa-solid fa-bolt"></i> Boosted Profile
                </div>
            @endif

            @if($isOwnProfile)
                <!-- Streak & Coins Quick Card -->
                <div class="w-full mt-6 pt-5 border-t border-[#e5d5ca] space-y-3">
                    <div class="flex items-center justify-between bg-[#fbf8f5] border border-[#e5d5ca] p-3 rounded-2xl shadow-none">
                        <div class="text-left">
                            <span class="text-[11px] font-bold text-[#7a666c] uppercase block">Wallet Balance</span>
                            <strong class="text-base font-extrabold text-[#8b5a2b] flex items-center gap-1">
                                <i class="fa-solid fa-coins text-[#f59e0b]"></i> {{ $targetUser->coins ?? 50 }} Beans
                            </strong>
                        </div>
                        <button onclick="openStreakModal()" class="px-3 py-1.5 bg-[#8b5a2b] text-white rounded-xl text-xs font-bold hover:bg-[#6d441e] transition cursor-pointer shadow-none">
                            Claim Streak
                        </button>
                    </div>

                    <button onclick="document.getElementById('editProfileModal').classList.add('active')" class="w-full py-2.5 bg-white border border-[#e5d5ca] rounded-xl text-xs font-bold text-[#24140d] hover:bg-[#fbf8f5] transition cursor-pointer flex items-center justify-center gap-1.5 shadow-none">
                        <i class="fa-solid fa-pen text-xs"></i> Edit Profile & Coffee Persona
                    </button>

                    <button onclick="openStreakModal()" class="w-full py-2.5 bg-[#f5ede6] border border-[#e5d5ca] text-[#8b5a2b] rounded-xl text-xs font-bold hover:bg-[#ede2d8] transition cursor-pointer flex items-center justify-center gap-1.5 shadow-none">
                        <i class="fa-solid fa-bolt"></i> Boost Profile for 24h
                    </button>
                </div>
            @else
                <div class="w-full mt-6 pt-5 border-t border-[#e5d5ca] flex gap-2">
                    <a href="{{ route('messages', ['user_id' => $targetUser->id]) }}" class="flex-1 py-3 bg-[#8b5a2b] text-white rounded-xl text-xs font-bold hover:bg-[#6d441e] transition flex items-center justify-center gap-1.5 shadow-none">
                        <i class="fa-solid fa-comments"></i> Send Message
                    </a>
                </div>
            @endif
        </div>

        <!-- Right: Bio, Traits, Details -->
        <div class="md:col-span-2 space-y-6">
            <!-- Bio Card -->
            <div class="bg-white border border-[#e5d5ca] rounded-3xl p-6 shadow-none">
                <h3 class="font-['Plus_Jakarta_Sans'] font-extrabold text-base text-[#24140d] mb-3 flex items-center gap-2">
                    <i class="fa-solid fa-quote-left text-[#8b5a2b]"></i> About Me
                </h3>
                <p class="text-sm text-[#4a383e] leading-relaxed">
                    {{ $targetUser->bio ?? 'No bio written yet. Ready to meet over a warm cup of coffee!' }}
                </p>
            </div>

            <!-- Coffee Persona & Vibe -->
            <div class="bg-white border border-[#e5d5ca] rounded-3xl p-6 shadow-none">
                <h3 class="font-['Plus_Jakarta_Sans'] font-extrabold text-base text-[#24140d] mb-3 flex items-center gap-2">
                    <i class="fa-solid fa-mug-hot text-[#8b5a2b]"></i> Coffee Persona & Traits
                </h3>
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                    <div class="p-3 bg-[#fbf8f5] border border-[#e5d5ca] rounded-2xl shadow-none">
                        <span class="text-[10px] text-[#7a666c] uppercase font-bold block">Coffee Style</span>
                        <strong class="text-sm text-[#8b5a2b] font-extrabold flex items-center gap-1">
                            ☕ {{ $targetUser->coffee_style ?: 'Vanilla Oat Latte' }}
                        </strong>
                    </div>
                    <div class="p-3 bg-[#fbf8f5] border border-[#e5d5ca] rounded-2xl shadow-none">
                        <span class="text-[10px] text-[#7a666c] uppercase font-bold block">MBTI Type</span>
                        <strong class="text-sm text-[#8b5a2b] font-extrabold">{{ $targetUser->mbti ?: 'ENFP' }}</strong>
                    </div>
                    <div class="p-3 bg-[#fbf8f5] border border-[#e5d5ca] rounded-2xl shadow-none">
                        <span class="text-[10px] text-[#7a666c] uppercase font-bold block">Zodiac Sign</span>
                        <strong class="text-sm text-[#8b5a2b] font-extrabold">{{ $targetUser->astrology ?: 'Leo' }}</strong>
                    </div>
                    <div class="p-3 bg-[#fbf8f5] border border-[#e5d5ca] rounded-2xl shadow-none">
                        <span class="text-[10px] text-[#7a666c] uppercase font-bold block">City</span>
                        <strong class="text-sm text-[#8b5a2b] font-extrabold">{{ $targetUser->country ?: 'Pune, India' }}</strong>
                    </div>
                    <div class="p-3 bg-[#fbf8f5] border border-[#e5d5ca] rounded-2xl shadow-none">
                        <span class="text-[10px] text-[#7a666c] uppercase font-bold block">Member ID</span>
                        <strong class="text-sm text-[#8b5a2b] font-extrabold">#{{ $targetUser->formatted_member_id }}</strong>
                    </div>
                    <div class="p-3 bg-[#fbf8f5] border border-[#e5d5ca] rounded-2xl shadow-none">
                        <span class="text-[10px] text-[#7a666c] uppercase font-bold block">Verification</span>
                        <strong class="text-sm text-[#065f46] font-extrabold flex items-center gap-1">
                            <i class="fa-solid fa-circle-check text-[#065f46]"></i> Selfie Pass
                        </strong>
                    </div>
                </div>
            </div>

            <!-- Social Connect Handles -->
            @if($targetUser->instagram || $targetUser->snapchat)
                <div class="bg-white border border-[#e5d5ca] rounded-3xl p-6 shadow-none">
                    <h3 class="font-['Plus_Jakarta_Sans'] font-extrabold text-base text-[#24140d] mb-3 flex items-center gap-2">
                        <i class="fa-solid fa-share-nodes text-[#8b5a2b]"></i> Social Handles
                    </h3>
                    <div class="flex flex-wrap gap-3">
                        @if($targetUser->instagram)
                            <span class="inline-flex items-center gap-2 bg-[#fbf8f5] border border-[#e5d5ca] px-3.5 py-1.5 rounded-xl text-xs font-bold text-[#24140d]">
                                <i class="fa-brands fa-instagram text-[#8b5a2b] text-sm"></i> {{ $targetUser->instagram }}
                            </span>
                        @endif
                        @if($targetUser->snapchat)
                            <span class="inline-flex items-center gap-2 bg-[#fbf8f5] border border-[#e5d5ca] px-3.5 py-1.5 rounded-xl text-xs font-bold text-[#24140d]">
                                <i class="fa-brands fa-snapchat text-[#f59e0b] text-sm"></i> {{ $targetUser->snapchat }}
                            </span>
                        @endif
                    </div>
                </div>
            @endif

            <!-- Interests & Hobbies -->
            @if($targetUser->interests)
                <div class="bg-white border border-[#e5d5ca] rounded-3xl p-6 shadow-none">
                    <h3 class="font-['Plus_Jakarta_Sans'] font-extrabold text-base text-[#24140d] mb-3">Interests & Favorites</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach(explode(',', $targetUser->interests) as $item)
                            @if(trim($item))
                                <span class="bg-[#f5ede6] text-[#8b5a2b] border border-[#e5d5ca] px-3.5 py-1 rounded-full text-xs font-bold shadow-none">
                                    #{{ trim($item) }}
                                </span>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Edit Profile Modal with Rich Trait Selectors -->
@if($isOwnProfile)
<div id="editProfileModal" class="custom-modal-backdrop">
    <div class="custom-modal-card max-h-[90vh] overflow-y-auto border border-[#e5d5ca] shadow-none">
        <button onclick="document.getElementById('editProfileModal').classList.remove('active')" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 text-lg cursor-pointer">
            <i class="fa-solid fa-xmark"></i>
        </button>
        <h3 class="font-['Plus_Jakarta_Sans'] font-extrabold text-lg text-[#24140d] mb-4">Edit Profile & Coffee Persona</h3>
        
        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            
            <!-- Hidden Avatar File Input -->
            <input type="file" id="avatarFileInput" name="avatar_file" accept="image/*" class="hidden" onchange="previewAvatar(this)">

            <div>
                <label class="block text-xs font-bold text-[#7a666c] mb-1">Full Name</label>
                <input type="text" name="full_name" value="{{ $targetUser->full_name }}" required class="w-full bg-[#fbf8f5] border border-[#e5d5ca] rounded-xl px-3 py-2 text-xs text-[#24140d] focus:outline-none focus:border-[#8b5a2b]">
            </div>

            <div>
                <label class="block text-xs font-bold text-[#7a666c] mb-1">Bio / Dating Vibe</label>
                <textarea name="bio" rows="3" class="w-full bg-[#fbf8f5] border border-[#e5d5ca] rounded-xl px-3 py-2 text-xs text-[#24140d] focus:outline-none focus:border-[#8b5a2b] resize-none">{{ $targetUser->bio }}</textarea>
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-bold text-[#7a666c] mb-1">Coffee Style</label>
                    <select name="coffee_style" class="w-full bg-[#fbf8f5] border border-[#e5d5ca] rounded-xl px-3 py-2 text-xs text-[#24140d] focus:outline-none focus:border-[#8b5a2b]">
                        @foreach(['Vanilla Oat Latte', 'Espresso Macchiato', 'Cold Brew Nitro', 'Cappuccino Cinnamon', 'Dark Roast Mocha', 'Pour-Over Arabica'] as $cStyle)
                            <option value="{{ $cStyle }}" {{ ($targetUser->coffee_style === $cStyle) ? 'selected' : '' }}>{{ $cStyle }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold text-[#7a666c] mb-1">City / Region</label>
                    <input type="text" name="country" value="{{ $targetUser->country ?? 'Pune, India' }}" placeholder="e.g. Pune, India" class="w-full bg-[#fbf8f5] border border-[#e5d5ca] rounded-xl px-3 py-2 text-xs text-[#24140d] focus:outline-none focus:border-[#8b5a2b]">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-bold text-[#7a666c] mb-1">MBTI Type</label>
                    <select name="mbti" class="w-full bg-[#fbf8f5] border border-[#e5d5ca] rounded-xl px-3 py-2 text-xs text-[#24140d] focus:outline-none focus:border-[#8b5a2b]">
                        @foreach(['ENFP','INFJ','INTJ','INTP','ENTP','ENTJ','INFP','ENFJ','ISFP','ESFP','ISTP','ESTP','ISFJ','ESFJ','ISTJ','ESTJ'] as $mbti)
                            <option value="{{ $mbti }}" {{ ($targetUser->mbti === $mbti) ? 'selected' : '' }}>{{ $mbti }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold text-[#7a666c] mb-1">Zodiac Sign</label>
                    <select name="astrology" class="w-full bg-[#fbf8f5] border border-[#e5d5ca] rounded-xl px-3 py-2 text-xs text-[#24140d] focus:outline-none focus:border-[#8b5a2b]">
                        @foreach(['Aries','Taurus','Gemini','Cancer','Leo','Virgo','Libra','Scorpio','Sagittarius','Capricorn','Aquarius','Pisces'] as $zodiac)
                            <option value="{{ $zodiac }}" {{ ($targetUser->astrology === $zodiac) ? 'selected' : '' }}>{{ $zodiac }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-bold text-[#7a666c] mb-1">Instagram (@handle)</label>
                    <input type="text" name="instagram" value="{{ $targetUser->instagram }}" placeholder="@username" class="w-full bg-[#fbf8f5] border border-[#e5d5ca] rounded-xl px-3 py-2 text-xs text-[#24140d] focus:outline-none focus:border-[#8b5a2b]">
                </div>
                <div>
                    <label class="block text-xs font-bold text-[#7a666c] mb-1">Snapchat (@handle)</label>
                    <input type="text" name="snapchat" value="{{ $targetUser->snapchat }}" placeholder="@username" class="w-full bg-[#fbf8f5] border border-[#e5d5ca] rounded-xl px-3 py-2 text-xs text-[#24140d] focus:outline-none focus:border-[#8b5a2b]">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-[#7a666c] mb-1">Interests (Comma-separated)</label>
                <input type="text" name="interests" value="{{ $targetUser->interests }}" placeholder="Coffee, Books, Indie Music, Photography, Traveling" class="w-full bg-[#fbf8f5] border border-[#e5d5ca] rounded-xl px-3 py-2 text-xs text-[#24140d] focus:outline-none focus:border-[#8b5a2b]">
            </div>

            <button type="submit" class="w-full py-3 bg-[#8b5a2b] text-white rounded-xl text-xs font-extrabold hover:bg-[#6d441e] transition cursor-pointer mt-2 shadow-none">
                Save Profile Changes ☕
            </button>
        </form>
    </div>
</div>

<script>
function previewAvatar(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('avatarDisplay').src = e.target.result;
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endif
@endsection
