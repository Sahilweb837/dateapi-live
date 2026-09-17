@extends('layouts.app')

@section('title', 'Community Coffee Feed & Date Sparks — CupDate')
@section('meta_desc', 'Explore curated coffee date spots, community pitches, and daylight date inspiration across Delhi NCR, Mumbai, Bangalore, Shimla, and top dating hubs.')

@section('content')
<!-- 4-Tab Top Navigation Bar -->
<div class="cupdate-top-tabs">
    <div class="cupdate-tabs-inner">
        <a href="{{ route('feed') }}" class="cupdate-tab-btn active"><i class="fa-solid fa-mug-hot"></i> Feed</a>
        <a href="{{ route('swipes') }}" class="cupdate-tab-btn"><i class="fa-solid fa-fire"></i> Swipes</a>
        <a href="{{ route('messages') }}" class="cupdate-tab-btn"><i class="fa-solid fa-comments"></i> Chat</a>
        <a href="{{ route('profile') }}" class="cupdate-tab-btn"><i class="fa-solid fa-user"></i> Profile</a>
    </div>
</div>

<div class="max-w-3xl mx-auto px-4 py-6">
    <!-- Active Daters Carousel / Stories -->
    <div class="mb-6">
        <div class="flex items-center justify-between mb-3">
            <h2 class="text-xs font-extrabold uppercase tracking-wider text-[#7a666c] flex items-center gap-1.5">
                <span class="w-2 h-2 rounded-full bg-[#10b981] animate-pulse"></span> Singles Online Now
            </h2>
            <span class="text-[11px] text-[#8b5a2b] font-semibold">Active Daylight Daters</span>
        </div>
        <div class="flex gap-4 overflow-x-auto pb-2 scrollbar-none">
            @foreach($activeDaters as $dater)
                <a href="{{ route('profile', $dater->id) }}" class="flex flex-col items-center gap-1.5 shrink-0 group" title="View {{ $dater->full_name }}'s profile">
                    <div class="relative p-0.5 rounded-full border-2 border-[#8b5a2b] group-hover:scale-105 transition shadow-sm">
                        <img src="{{ $dater->avatar_url }}" alt="{{ $dater->full_name }}" class="w-14 h-14 rounded-full object-cover">
                        @if($dater->is_verified)
                            <i class="fa-solid fa-circle-check text-[#8b5a2b] text-xs absolute bottom-0 right-0 bg-white rounded-full"></i>
                        @endif
                    </div>
                    <span class="text-xs font-bold text-[#24140d] max-w-[70px] truncate">{{ explode(' ', $dater->full_name)[0] }}</span>
                </a>
            @endforeach
        </div>
    </div>

    <!-- Success & Feedback Toast (Zero-Refresh) -->
    <div id="feedToast" class="hidden mb-4 p-4 bg-[#ecfdf5] border border-[#a7f3d0] rounded-2xl text-xs font-bold text-[#065f46] flex items-center justify-between gap-2 transition-all shadow-sm">
        <div class="flex items-center gap-2">
            <i class="fa-solid fa-circle-check text-base text-[#10b981]" id="feedToastIcon"></i>
            <span id="feedToastText">Your coffee date idea was published to the community! ☕</span>
        </div>
        <button type="button" onclick="document.getElementById('feedToast').classList.add('hidden')" class="text-xs text-[#065f46] hover:opacity-75">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>

    <!-- City Filter Carousel -->
    <div class="mb-6">
        <div class="flex items-center justify-between mb-2.5">
            <span class="text-xs font-extrabold uppercase tracking-wider text-[#7a666c] flex items-center gap-1.5">
                <i class="fa-solid fa-city text-[#8b5a2b]"></i> Filter by City Hub
            </span>
            <span class="text-xs text-[#7a666c]" id="activeCityLabel">Showing: <strong>All Cities</strong></span>
        </div>
        <div class="flex gap-2 overflow-x-auto pb-2 scrollbar-none" id="cityPillsContainer">
            @foreach($cities as $cityItem)
                @php
                    $isAll = strtolower($cityItem) === 'all cities';
                    $cityVal = $isAll ? 'all' : $cityItem;
                @endphp
                <button type="button"
                        onclick="filterByCity('{{ $cityVal }}', this)"
                        class="city-filter-btn shrink-0 px-3.5 py-1.5 rounded-full text-xs font-bold transition cursor-pointer flex items-center gap-1.5 {{ $isAll ? 'bg-[#8b5a2b] text-white shadow-sm' : 'bg-white border border-[#e5d5ca] text-[#24140d] hover:bg-[#f5ede6]' }}"
                        data-city="{{ strtolower($cityVal) }}">
                    @if($isAll)
                        <i class="fa-solid fa-globe text-[11px]"></i>
                    @else
                        <i class="fa-solid fa-location-dot text-[10px] opacity-70"></i>
                    @endif
                    <span>{{ $cityItem }}</span>
                </button>
            @endforeach
        </div>
    </div>

    <!-- Share a Coffee Date Idea Composer (Zero-Refresh + Photo Upload) -->
    <div class="bg-white border border-[#e5d5ca] rounded-2xl p-5 mb-8 shadow-sm">
        <div class="flex items-center justify-between mb-3">
            <h3 class="font-['Plus_Jakarta_Sans'] font-extrabold text-base text-[#24140d] flex items-center gap-2">
                <i class="fa-solid fa-mug-hot text-[#8b5a2b]"></i> Pitch a Coffee Date Idea
            </h3>
            <span class="text-xs text-[#7a666c]">Inspire singles near you</span>
        </div>

        <form id="ideaForm" onsubmit="handlePostIdea(event)">
            <textarea id="ideaContent" rows="3" required class="w-full bg-[#fbf8f5] border border-[#e5d5ca] rounded-xl p-3 text-sm text-[#24140d] focus:outline-none focus:border-[#8b5a2b] resize-none mb-3 shadow-inner" placeholder="What's your dream coffee date vibe? (e.g. Cinnamon cappuccino at Cafe Simla Times or Lavender cold brew at Subko Bandra...)"></textarea>
            
            <!-- Optional Photo Preview -->
            <div id="ideaImagePreview" class="hidden mb-3 p-2.5 bg-[#f5ede6] border border-[#e5d5ca] rounded-xl flex items-center justify-between">
                <div class="flex items-center gap-2.5 min-w-0">
                    <img id="ideaImageThumb" src="" class="w-11 h-11 rounded-lg object-cover border border-[#8b5a2b]">
                    <div class="flex flex-col min-w-0">
                        <span id="ideaImageFileName" class="text-xs text-[#24140d] font-bold truncate max-w-[220px]">Photo Attached</span>
                        <span class="text-[10px] text-[#7a666c]">Ready to publish</span>
                    </div>
                </div>
                <button type="button" onclick="cancelIdeaPhoto()" class="text-xs text-[#dc2626] font-bold hover:underline px-2 py-1">Remove</button>
            </div>

            <!-- Composer Fields: Cafe & City -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5 mb-3">
                <input type="text" id="cafeName" placeholder="Cafe / Roastery Name (e.g. Cafe Simla Times)" class="bg-[#fbf8f5] border border-[#e5d5ca] rounded-lg px-3 py-2 text-xs text-[#24140d] focus:outline-none focus:border-[#8b5a2b]">
                
                <div class="relative">
                    <input type="text" id="cityName" list="popularCitiesList" placeholder="City (e.g. Delhi NCR, Shimla, Mumbai)" class="w-full bg-[#fbf8f5] border border-[#e5d5ca] rounded-lg px-3 py-2 text-xs text-[#24140d] focus:outline-none focus:border-[#8b5a2b]">
                    <datalist id="popularCitiesList">
                        @foreach($cities as $c)
                            @if(strtolower($c) !== 'all cities')
                                <option value="{{ $c }}"></option>
                            @endif
                        @endforeach
                    </datalist>
                </div>
            </div>

            <!-- Quick City Shortcut Tags -->
            <div class="flex items-center gap-1.5 flex-wrap mb-3 text-[11px]">
                <span class="text-[#7a666c] text-[10px] font-bold uppercase">Quick Pick:</span>
                @foreach(['Delhi NCR', 'Mumbai', 'Bangalore', 'Shimla', 'Pune', 'Chandigarh', 'Manali', 'Goa'] as $quickCity)
                    <button type="button" onclick="setCityInput('{{ $quickCity }}')" class="px-2 py-0.5 rounded-md bg-[#f5ede6] hover:bg-[#ede2d8] text-[#8b5a2b] font-semibold transition cursor-pointer">
                        + {{ $quickCity }}
                    </button>
                @endforeach
            </div>

            <!-- Vibe & Budget Selectors -->
            <div class="flex flex-wrap items-center justify-between gap-3 pt-2 border-t border-[#e5d5ca]/60">
                <div class="flex flex-wrap items-center gap-2">
                    <!-- Vibe Selection -->
                    <select id="ideaVibe" class="bg-[#fbf8f5] border border-[#e5d5ca] rounded-lg px-2.5 py-1.5 text-xs text-[#24140d] focus:outline-none focus:border-[#8b5a2b]">
                        <option value="Cozy & Quiet">☕ Cozy &amp; Quiet</option>
                        <option value="Artisan Roastery">🌿 Artisan Roastery</option>
                        <option value="Sunset Terrace">🌅 Sunset Terrace</option>
                        <option value="Books & Vinyl">🎵 Books &amp; Vinyl</option>
                        <option value="Outdoor Garden">🌳 Outdoor Garden</option>
                    </select>

                    <!-- Budget Selection -->
                    <select id="ideaBudget" class="bg-[#fbf8f5] border border-[#e5d5ca] rounded-lg px-2.5 py-1.5 text-xs text-[#24140d] focus:outline-none focus:border-[#8b5a2b]">
                        <option value="₹₹">₹₹ Moderate (₹500–1200)</option>
                        <option value="₹">₹ Casual (Under ₹500)</option>
                        <option value="₹₹₹">₹₹₹ Specialty / Fine Brew</option>
                    </select>

                    <!-- Attach Photo Button -->
                    <label for="ideaPhotoInput" class="px-3 py-1.5 bg-[#fbf8f5] border border-[#e5d5ca] text-[#8b5a2b] rounded-lg text-xs font-bold hover:bg-[#f5ede6] transition cursor-pointer flex items-center gap-1.5" title="Attach Cafe Photo">
                        <i class="fa-solid fa-camera"></i> Photo
                    </label>
                    <input type="file" id="ideaPhotoInput" accept="image/jpeg,image/png,image/webp,image/jpg" class="hidden" onchange="previewIdeaPhoto(this)">
                </div>

                <button type="submit" id="postIdeaBtn" class="bg-[#8b5a2b] text-white px-6 py-2 rounded-xl text-xs font-extrabold hover:bg-[#6d441e] transition cursor-pointer shadow-sm flex items-center gap-1.5">
                    <span>Post Idea</span>
                    <i class="fa-solid fa-paper-plane text-[10px]"></i>
                </button>
            </div>
        </form>
    </div>

    <!-- Ideas Feed (Dynamically Prepending & Client Filtering) -->
    <div class="space-y-4" id="ideasContainer">
        @forelse($ideas as $idea)
            @php
                $ideaContent = $idea->content ?? $idea->idea_text ?? '';
                $sparksCount = $idea->sparks_count ?? $idea->sparks ?? 0;
                $userAvatar = $idea->user->avatar_url ?? asset('assets/images/default_avatar.png');
                $userName = $idea->user->full_name ?? 'Coffee Lover';
                $cafeName = $idea->cafe_name ?? 'Cozy Coffee Spot';
                $city = $idea->city ?? 'India';
                $vibe = $idea->vibe ?? 'Cozy';
                $budget = $idea->budget ?? '₹₹';
            @endphp
            <div class="bg-white border border-[#e5d5ca] rounded-2xl p-5 transition hover:border-[#8b5a2b] shadow-sm idea-card"
                 id="idea-card-{{ $idea->id }}"
                 data-city="{{ strtolower($city) }}"
                 data-cafe="{{ strtolower($cafeName) }}">
                
                <div class="flex items-center justify-between mb-3">
                    <div class="flex items-center gap-3">
                        <a href="{{ route('profile', $idea->user_id) }}">
                            <img src="{{ $userAvatar }}" class="w-11 h-11 rounded-full object-cover border border-[#e5d5ca] hover:scale-105 transition">
                        </a>
                        <div>
                            <div class="flex items-center gap-1.5">
                                <a href="{{ route('profile', $idea->user_id) }}" class="text-sm font-bold text-[#24140d] hover:text-[#8b5a2b] transition">
                                    {{ $userName }}
                                </a>
                                @if(!empty($idea->user->is_verified))
                                    <i class="fa-solid fa-circle-check text-[#8b5a2b] text-xs" title="Verified Member"></i>
                                @endif
                            </div>
                            <div class="text-xs text-[#7a666c] flex items-center gap-1.5 flex-wrap mt-0.5">
                                <span class="font-semibold text-[#8b5a2b] flex items-center gap-1">
                                    <i class="fa-solid fa-location-dot text-[10px]"></i> {{ $cafeName }}
                                </span>
                                <span>•</span>
                                <button type="button" onclick="filterByCity('{{ strtolower($city) }}')" class="hover:underline font-medium cursor-pointer">
                                    {{ $city }}
                                </button>
                                <span class="px-2 py-0.5 rounded-full bg-[#f5ede6] text-[#8b5a2b] text-[10px] font-semibold">
                                    {{ $vibe }}
                                </span>
                                <span class="px-1.5 py-0.5 rounded bg-[#fbf8f5] border border-[#e5d5ca] text-[#7a666c] text-[10px] font-mono">
                                    {{ $budget }}
                                </span>
                            </div>
                        </div>
                    </div>
                    <span class="text-[11px] text-[#7a666c] shrink-0">{{ \Carbon\Carbon::parse($idea->created_at)->diffForHumans() }}</span>
                </div>
                
                <p class="text-sm text-[#4a383e] leading-relaxed mb-3 whitespace-pre-line">{{ $ideaContent }}</p>

                @if($idea->image_url)
                    <div class="mb-4 rounded-xl overflow-hidden max-h-80 border border-[#e5d5ca] bg-[#fbf8f5]">
                        <img src="{{ $idea->image_url }}" alt="{{ $cafeName }} date idea" class="w-full h-full object-cover hover:scale-[1.01] transition-transform duration-500">
                    </div>
                @endif

                <div class="flex items-center justify-between pt-3 border-t border-[#e5d5ca]">
                    <button onclick="sparkIdea({{ $idea->id }}, this)" class="flex items-center gap-1.5 text-xs font-bold text-[#8b5a2b] bg-[#f5ede6] border border-[#e5d5ca] px-3.5 py-1.5 rounded-full hover:bg-[#ede2d8] active:scale-95 transition cursor-pointer shadow-none" title="Send a spark to this idea">
                        <i class="fa-solid fa-heart text-[#d65b6c]"></i>
                        <span class="spark-count">{{ $sparksCount }}</span> Sparks
                    </button>
                    <div class="flex items-center gap-2">
                        <a href="{{ route('messages', ['user_id' => $idea->user_id]) }}" class="text-xs font-bold text-[#8b5a2b] bg-[#fbf8f5] border border-[#e5d5ca] px-4 py-1.5 rounded-full hover:bg-[#f5ede6] transition flex items-center gap-1.5 shadow-none" title="Chat with {{ $userName }}">
                            <i class="fa-solid fa-mug-hot"></i> Ask Out
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div id="noIdeasPrompt" class="text-center py-12 bg-[#fbf8f5] border border-[#e5d5ca] rounded-2xl shadow-none">
                <i class="fa-solid fa-mug-hot text-[#8b5a2b] text-4xl mb-2"></i>
                <p class="text-base font-bold text-[#24140d]">No coffee date ideas yet!</p>
                <p class="text-xs text-[#7a666c] mt-1 mb-4">Be the first to pitch your favorite local coffee nook above.</p>
                <button type="button" onclick="document.getElementById('ideaContent').focus()" class="px-4 py-2 rounded-xl bg-[#8b5a2b] text-white text-xs font-bold hover:bg-[#6d441e] transition">
                    Write First Date Idea ☕
                </button>
            </div>
        @endforelse
    </div>

    <!-- Empty City Filter Feedback (Hidden by default) -->
    <div id="emptyCityNotice" class="hidden text-center py-10 bg-[#fbf8f5] border border-[#e5d5ca] rounded-2xl p-6 mt-4">
        <i class="fa-solid fa-location-dot text-[#8b5a2b] text-3xl mb-2"></i>
        <h4 class="font-bold text-sm text-[#24140d]">No date pitches in <span id="emptyCityName">this city</span> yet!</h4>
        <p class="text-xs text-[#7a666c] mt-1 mb-3">Be the trendsetter! Pitch your favorite roastery or cafe in this city.</p>
        <button type="button" onclick="autofillCurrentCity()" class="px-4 py-2 rounded-xl bg-[#8b5a2b] text-white text-xs font-bold hover:bg-[#6d441e] transition cursor-pointer">
            Pitch an Idea for this City ☕
        </button>
    </div>
</div>
@endsection

@section('extra_js')
<script>
let activeFilteredCity = 'all';

function previewIdeaPhoto(input) {
    if (input.files && input.files[0]) {
        const file = input.files[0];
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('ideaImageThumb').src = e.target.result;
            document.getElementById('ideaImageFileName').innerText = file.name;
            document.getElementById('ideaImagePreview').classList.remove('hidden');
        };
        reader.readAsDataURL(file);
    }
}

function cancelIdeaPhoto() {
    const input = document.getElementById('ideaPhotoInput');
    input.value = '';
    document.getElementById('ideaImageThumb').src = '';
    document.getElementById('ideaImagePreview').classList.add('hidden');
}

function setCityInput(city) {
    const input = document.getElementById('cityName');
    input.value = city;
    input.focus();
}

function autofillCurrentCity() {
    if (activeFilteredCity && activeFilteredCity !== 'all') {
        const cityNameCapitalized = activeFilteredCity.split(' ').map(w => w.charAt(0).toUpperCase() + w.slice(1)).join(' ');
        setCityInput(cityNameCapitalized);
        document.getElementById('ideaContent').focus();
        window.scrollTo({ top: 220, behavior: 'smooth' });
    }
}

// Client-Side Instant City Filtering
function filterByCity(cityName, btnElement) {
    activeFilteredCity = (cityName || 'all').toLowerCase().trim();

    // Update Pills Styling
    const pills = document.querySelectorAll('.city-filter-btn');
    pills.forEach(btn => {
        const btnCity = btn.getAttribute('data-city');
        if (btnCity === activeFilteredCity) {
            btn.className = 'city-filter-btn shrink-0 px-3.5 py-1.5 rounded-full text-xs font-bold transition cursor-pointer flex items-center gap-1.5 bg-[#8b5a2b] text-white shadow-sm';
        } else {
            btn.className = 'city-filter-btn shrink-0 px-3.5 py-1.5 rounded-full text-xs font-bold transition cursor-pointer flex items-center gap-1.5 bg-white border border-[#e5d5ca] text-[#24140d] hover:bg-[#f5ede6]';
        }
    });

    const activeCityLabel = document.getElementById('activeCityLabel');
    if (activeCityLabel) {
        const displayLabel = activeFilteredCity === 'all' ? 'All Cities' : activeFilteredCity.toUpperCase();
        activeCityLabel.innerHTML = `Showing: <strong>${displayLabel}</strong>`;
    }

    // Filter Cards in DOM
    const cards = document.querySelectorAll('.idea-card');
    let visibleCount = 0;

    cards.forEach(card => {
        const cardCity = (card.getAttribute('data-city') || '').toLowerCase();
        const cardCafe = (card.getAttribute('data-cafe') || '').toLowerCase();

        if (activeFilteredCity === 'all' || cardCity.includes(activeFilteredCity) || cardCafe.includes(activeFilteredCity)) {
            card.style.display = 'block';
            visibleCount++;
        } else {
            card.style.display = 'none';
        }
    });

    const emptyCityNotice = document.getElementById('emptyCityNotice');
    const emptyCityName = document.getElementById('emptyCityName');
    if (visibleCount === 0) {
        if (emptyCityNotice) emptyCityNotice.classList.remove('hidden');
        if (emptyCityName) emptyCityName.innerText = activeFilteredCity.toUpperCase();
    } else {
        if (emptyCityNotice) emptyCityNotice.classList.add('hidden');
    }
}

// Zero-Refresh AJAX Date Idea Posting with Resilient Error Handling
async function handlePostIdea(e) {
    e.preventDefault();
    const content = document.getElementById('ideaContent').value.trim();
    const cafeName = document.getElementById('cafeName').value.trim();
    const cityName = document.getElementById('cityName').value.trim();
    const vibe = document.getElementById('ideaVibe').value;
    const budget = document.getElementById('ideaBudget').value;
    const photoInput = document.getElementById('ideaPhotoInput');
    
    if (!content) {
        showToast('Please describe your coffee date idea!', false);
        document.getElementById('ideaContent').focus();
        return;
    }

    const btn = document.getElementById('postIdeaBtn');
    btn.disabled = true;
    btn.innerHTML = `<span>Publishing...</span> <i class="fa-solid fa-spinner fa-spin text-[10px]"></i>`;

    const formData = new FormData();
    formData.append('content', content);
    if (cafeName) formData.append('cafe_name', cafeName);
    if (cityName) formData.append('city', cityName);
    if (vibe) formData.append('vibe', vibe);
    if (budget) formData.append('budget', budget);
    if (photoInput.files && photoInput.files[0]) {
        formData.append('image', photoInput.files[0]);
    }

    try {
        const csrfTokenEl = document.querySelector('meta[name="csrf-token"]');
        const csrfToken = csrfTokenEl ? csrfTokenEl.getAttribute('content') : '';

        const res = await fetch("{{ route('feed.idea') }}", {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': csrfToken
            },
            body: formData
        });

        // Check if unauthorized
        if (res.status === 401) {
            showToast('Please sign in to publish your date idea.', false);
            setTimeout(() => {
                window.location.href = "{{ route('login') }}";
            }, 1500);
            return;
        }

        const data = await res.json();

        if (res.ok && data.success) {
            // Remove empty prompt if present
            const noIdeas = document.getElementById('noIdeasPrompt');
            if (noIdeas) noIdeas.remove();

            const emptyCityNotice = document.getElementById('emptyCityNotice');
            if (emptyCityNotice) emptyCityNotice.classList.add('hidden');

            // Prepend new card dynamically without refresh!
            const newIdea = data.idea;
            let imgHtml = '';
            if (newIdea.image_url) {
                imgHtml = `
                    <div class="mb-4 rounded-xl overflow-hidden max-h-80 border border-[#e5d5ca] bg-[#fbf8f5]">
                        <img src="${newIdea.image_url}" alt="Cafe Date Idea" class="w-full h-full object-cover">
                    </div>
                `;
            }

            const card = document.createElement('div');
            card.className = 'bg-white border-2 border-[#8b5a2b] rounded-2xl p-5 transition shadow-sm idea-card animate-pulse';
            card.id = `idea-card-${newIdea.id}`;
            card.setAttribute('data-city', (newIdea.city || '').toLowerCase());
            card.setAttribute('data-cafe', (newIdea.cafe_name || '').toLowerCase());

            card.innerHTML = `
                <div class="flex items-center justify-between mb-3">
                    <div class="flex items-center gap-3">
                        <a href="/profile/${newIdea.user_id}">
                            <img src="${newIdea.user_avatar}" class="w-11 h-11 rounded-full object-cover border border-[#e5d5ca]">
                        </a>
                        <div>
                            <div class="flex items-center gap-1.5">
                                <strong class="text-sm font-bold text-[#24140d] block">${newIdea.user_name}</strong>
                                <i class="fa-solid fa-circle-check text-[#8b5a2b] text-xs" title="Verified Member"></i>
                            </div>
                            <div class="text-xs text-[#7a666c] flex items-center gap-1.5 flex-wrap mt-0.5">
                                <span class="font-semibold text-[#8b5a2b] flex items-center gap-1">
                                    <i class="fa-solid fa-location-dot text-[10px]"></i> ${newIdea.cafe_name}
                                </span>
                                <span>•</span>
                                <button type="button" onclick="filterByCity('${(newIdea.city || '').toLowerCase()}')" class="hover:underline font-medium cursor-pointer">
                                    ${newIdea.city}
                                </button>
                                <span class="px-2 py-0.5 rounded-full bg-[#f5ede6] text-[#8b5a2b] text-[10px] font-semibold">
                                    ${newIdea.vibe || 'Cozy'}
                                </span>
                                <span class="px-1.5 py-0.5 rounded bg-[#fbf8f5] border border-[#e5d5ca] text-[#7a666c] text-[10px] font-mono">
                                    ${newIdea.budget || '₹₹'}
                                </span>
                            </div>
                        </div>
                    </div>
                    <span class="text-[11px] text-[#7a666c]">Just now</span>
                </div>
                <p class="text-sm text-[#4a383e] leading-relaxed mb-3 whitespace-pre-line">${newIdea.content || newIdea.idea_text || ''}</p>
                ${imgHtml}
                <div class="flex items-center justify-between pt-3 border-t border-[#e5d5ca]">
                    <button onclick="sparkIdea(${newIdea.id}, this)" class="flex items-center gap-1.5 text-xs font-bold text-[#8b5a2b] bg-[#f5ede6] border border-[#e5d5ca] px-3.5 py-1.5 rounded-full hover:bg-[#ede2d8] transition cursor-pointer shadow-none">
                        <i class="fa-solid fa-heart text-[#d65b6c]"></i>
                        <span class="spark-count">0</span> Sparks
                    </button>
                    <a href="/messages?user_id=${newIdea.user_id}" class="text-xs font-bold text-[#8b5a2b] bg-[#fbf8f5] border border-[#e5d5ca] px-4 py-1.5 rounded-full hover:bg-[#f5ede6] transition shadow-none">
                        <i class="fa-solid fa-mug-hot"></i> Ask Out
                    </a>
                </div>
            `;

            const container = document.getElementById('ideasContainer');
            container.insertBefore(card, container.firstChild);

            setTimeout(() => {
                card.classList.remove('animate-pulse', 'border-2');
                card.classList.add('border');
            }, 1600);

            // Reset Form & Show Toast
            document.getElementById('ideaForm').reset();
            cancelIdeaPhoto();
            showToast('Your coffee date idea was published to the community! ☕', true);
        } else {
            showToast(data.message || 'Error posting date idea. Please check your fields.', false);
        }
    } catch (err) {
        showToast('Network error while submitting idea. Please try again.', false);
    } finally {
        btn.disabled = false;
        btn.innerHTML = `<span>Post Idea</span> <i class="fa-solid fa-paper-plane text-[10px]"></i>`;
    }
}

function showToast(message, isSuccess = true) {
    const toast = document.getElementById('feedToast');
    const toastText = document.getElementById('feedToastText');
    const toastIcon = document.getElementById('feedToastIcon');
    if (!toast) return;

    toastText.innerText = message;
    if (isSuccess) {
        toast.className = 'mb-4 p-4 bg-[#ecfdf5] border border-[#a7f3d0] rounded-2xl text-xs font-bold text-[#065f46] flex items-center justify-between gap-2 transition-all shadow-sm';
        if (toastIcon) toastIcon.className = 'fa-solid fa-circle-check text-base text-[#10b981]';
    } else {
        toast.className = 'mb-4 p-4 bg-[#fff1f2] border border-[#fecdd3] rounded-2xl text-xs font-bold text-[#9f1239] flex items-center justify-between gap-2 transition-all shadow-sm';
        if (toastIcon) toastIcon.className = 'fa-solid fa-triangle-exclamation text-base text-[#e11d48]';
    }

    toast.classList.remove('hidden');
    setTimeout(() => toast.classList.add('hidden'), 4500);
}

// Spark Reaction Toggle
async function sparkIdea(id, btn) {
    try {
        const csrfTokenEl = document.querySelector('meta[name="csrf-token"]');
        const csrfToken = csrfTokenEl ? csrfTokenEl.getAttribute('content') : '';

        const res = await fetch(`/feed/spark/${id}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': csrfToken
            }
        });
        const data = await res.json();
        if (data.success) {
            btn.querySelector('.spark-count').innerText = data.sparks;
            btn.classList.add('scale-110');
            setTimeout(() => btn.classList.remove('scale-110'), 200);
        }
    } catch (err) {}
}
</script>
@endsection
