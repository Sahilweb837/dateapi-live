@extends('layouts.app')

@section('title', 'Discover & Swipe Singles — CupDate')

@section('content')
<!-- 4-Tab Top Navigation Bar -->
<div class="cupdate-top-tabs">
    <div class="cupdate-tabs-inner">
        <a href="{{ route('feed') }}" class="cupdate-tab-btn"><i class="fa-solid fa-mug-hot"></i> Feed</a>
        <a href="{{ route('swipes') }}" class="cupdate-tab-btn active"><i class="fa-solid fa-fire"></i> Swipes</a>
        <a href="{{ route('messages') }}" class="cupdate-tab-btn"><i class="fa-solid fa-comments"></i> Chat</a>
        <a href="{{ route('profile') }}" class="cupdate-tab-btn"><i class="fa-solid fa-user"></i> Profile</a>
    </div>
</div>

<div class="max-w-md mx-auto px-4 py-8 flex flex-col items-center">
    @if($profiles->isNotEmpty())
        <div id="deckContainer" class="w-full relative min-h-[500px]">
            @foreach($profiles as $index => $profile)
                <div class="swipe-card absolute inset-0 bg-white border border-[#e5d5ca] rounded-3xl overflow-hidden flex flex-col transition-all duration-300 shadow-none {{ $index === 0 ? 'z-20 scale-100 opacity-100' : 'z-10 scale-95 opacity-0 pointer-events-none' }}" data-id="{{ $profile->id }}" id="card-{{ $profile->id }}">
                    <!-- Photo Header -->
                    <div class="relative h-[340px] w-full bg-[#f5ede6]">
                        <img src="{{ $profile->avatar_url }}" alt="{{ $profile->full_name }}" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent"></div>
                        <div class="absolute bottom-4 left-4 right-4 text-white">
                            <div class="flex items-center gap-2">
                                <h3 class="font-['Plus_Jakarta_Sans'] font-extrabold text-2xl drop-shadow-sm">{{ $profile->full_name }}, {{ $profile->age }}</h3>
                                @if($profile->is_verified)
                                    <i class="fa-solid fa-circle-check text-[#8b5a2b] text-lg bg-white rounded-full"></i>
                                @endif
                                @if($profile->is_boosted)
                                    <span class="bg-[#8b5a2b] text-white text-[10px] font-extrabold px-2.5 py-0.5 rounded-full uppercase tracking-wider flex items-center gap-1 shadow-none">
                                        <i class="fa-solid fa-bolt"></i> Boosted
                                    </span>
                                @endif
                            </div>
                            <p class="text-xs text-white/90 mt-0.5 flex items-center gap-1">
                                <i class="fa-solid fa-location-dot text-[#8b5a2b]"></i> {{ $profile->country ?? 'India' }} • {{ $profile->astrology ?? 'Mystic' }} • {{ $profile->mbti ?? 'ENFP' }}
                            </p>
                        </div>
                    </div>

                    <!-- Profile Bio & Interests -->
                    <div class="p-5 flex-1 flex flex-col justify-between">
                        <p class="text-sm text-[#4a383e] line-clamp-3 mb-3">
                            {{ $profile->bio ?? 'Looking for a warm coffee and honest conversation! ☕✨' }}
                        </p>
                        
                        @if($profile->interests)
                            <div class="flex flex-wrap gap-1.5 mb-2">
                                @foreach(explode(',', $profile->interests) as $interest)
                                    @if(trim($interest))
                                        <span class="text-[11px] font-bold bg-[#f5ede6] text-[#8b5a2b] border border-[#e5d5ca] px-2.5 py-1 rounded-full shadow-none">
                                            #{{ trim($interest) }}
                                        </span>
                                    @endif
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Action Controls -->
        <div class="flex items-center justify-center gap-6 mt-6">
            <button onclick="triggerSwipe('dislike')" class="w-14 h-14 rounded-full border border-[#e5d5ca] bg-white text-[#7a666c] hover:text-[#ef4444] hover:bg-[#fef2f2] flex items-center justify-center text-xl transition cursor-pointer shadow-none">
                <i class="fa-solid fa-xmark"></i>
            </button>
            <button onclick="triggerSwipe('superlike')" class="w-12 h-12 rounded-full border border-[#e5d5ca] bg-white text-[#8b5a2b] hover:bg-[#f5ede6] flex items-center justify-center text-lg transition cursor-pointer shadow-none">
                <i class="fa-solid fa-star"></i>
            </button>
            <button onclick="triggerSwipe('like')" class="w-16 h-16 rounded-full border border-[#8b5a2b] bg-[#8b5a2b] text-white hover:bg-[#6d441e] flex items-center justify-center text-2xl transition cursor-pointer shadow-none">
                <i class="fa-solid fa-heart"></i>
            </button>
        </div>
    @else
        <div class="text-center py-20 bg-white border border-[#e5d5ca] rounded-3xl p-8 w-full shadow-none">
            <i class="fa-solid fa-compass text-[#8b5a2b] text-4xl mb-3"></i>
            <h3 class="font-['Plus_Jakarta_Sans'] font-extrabold text-xl text-[#24140d]">You've seen all singles!</h3>
            <p class="text-xs text-[#7a666c] mt-1 mb-6">Check back later as new coffee lovers join daily.</p>
            <a href="{{ route('feed') }}" class="inline-block px-6 py-2.5 bg-[#8b5a2b] text-white font-bold text-xs rounded-full hover:bg-[#6d441e] transition shadow-none">Explore Community Feed</a>
        </div>
    @endif
</div>

<!-- Match Modal -->
<div id="matchModal" class="custom-modal-backdrop">
    <div class="custom-modal-card text-center border border-[#e5d5ca] shadow-none">
        <div class="w-16 h-16 rounded-full bg-[#f5ede6] border border-[#e5d5ca] text-[#8b5a2b] flex items-center justify-center mx-auto text-3xl mb-4 shadow-none">
            <i class="fa-solid fa-heart"></i>
        </div>
        <h3 class="font-['Plus_Jakarta_Sans'] font-extrabold text-2xl text-[#24140d] mb-1">It's a Match! 🎉</h3>
        <p class="text-xs text-[#7a666c] mb-6">You and <span id="matchedName" class="font-bold text-[#8b5a2b]"></span> both liked each other!</p>
        <div class="flex gap-3">
            <a id="matchedChatLink" href="#" class="flex-1 py-3 bg-[#8b5a2b] text-white font-bold text-xs rounded-xl hover:bg-[#6d441e] transition flex items-center justify-center gap-1.5 shadow-none">
                <i class="fa-solid fa-comments"></i> Say Hello
            </a>
            <button onclick="closeMatchModal()" class="flex-1 py-3 bg-[#fbf8f5] border border-[#e5d5ca] text-[#7a666c] font-bold text-xs rounded-xl hover:bg-[#f5ede6] transition cursor-pointer shadow-none">
                Keep Swiping
            </button>
        </div>
    </div>
</div>
@endsection

@section('extra_js')
<script>
let currentCardIndex = 0;
const cards = Array.from(document.querySelectorAll('.swipe-card'));

async function triggerSwipe(action) {
    if (currentCardIndex >= cards.length) return;
    const currentCard = cards[currentCardIndex];
    const targetId = currentCard.getAttribute('data-id');

    // Visual animation
    if (action === 'like') {
        currentCard.style.transform = 'translateX(120%) rotate(20deg)';
    } else if (action === 'dislike') {
        currentCard.style.transform = 'translateX(-120%) rotate(-20deg)';
    } else {
        currentCard.style.transform = 'translateY(-120%)';
    }
    currentCard.style.opacity = '0';

    currentCardIndex++;
    if (currentCardIndex < cards.length) {
        const nextCard = cards[currentCardIndex];
        nextCard.classList.remove('scale-95', 'opacity-0', 'pointer-events-none');
        nextCard.classList.add('scale-100', 'opacity-100', 'z-20');
    }

    try {
        const res = await fetch("{{ route('api.swipe') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ target_id: targetId, action: action })
        });
        const data = await res.json();
        if (data.is_match) {
            document.getElementById('matchedName').innerText = data.matched_user.name;
            document.getElementById('matchedChatLink').href = `/messages?user_id=${data.matched_user.id}`;
            document.getElementById('matchModal').classList.add('active');
        }
    } catch (err) {}
}

function closeMatchModal() {
    document.getElementById('matchModal').classList.remove('active');
}
</script>
@endsection
