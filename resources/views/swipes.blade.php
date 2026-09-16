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

@guest
{{-- Guest Sign-in Gate --}}
<div class="max-w-md mx-auto px-4 py-16 flex flex-col items-center text-center">
    <div class="bg-white border border-[#e5d5ca] rounded-3xl p-10 shadow-none w-full">
        <div class="w-20 h-20 rounded-full bg-[#f5ede6] flex items-center justify-center mx-auto mb-5" style="border:2px solid #e5d5ca;">
            <i class="fa-solid fa-heart text-[#8b5a2b] text-3xl"></i>
        </div>
        <h2 class="font-extrabold text-2xl text-[#24140d] mb-2" style="font-family:'Plus Jakarta Sans',sans-serif;">Discover Singles Near You</h2>
        <p class="text-sm text-[#7a666c] mb-6 leading-relaxed">Sign in to start swiping on verified coffee daters in your city. It only takes 10 seconds. ☕</p>
        <a href="{{ route('auth.google') }}" class="w-full mb-3 py-3.5 bg-white border border-[#e5d5ca] rounded-xl text-sm font-bold text-[#24140d] hover:bg-[#fbf8f5] transition flex items-center justify-center gap-3 shadow-none">
            <svg class="w-5 h-5 shrink-0" viewBox="0 0 24 24"><path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/><path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/><path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z"/><path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z"/></svg>
            Continue with Google — 1 Click
        </a>
        <a href="{{ route('login') }}" class="w-full py-3 bg-[#8b5a2b] text-white rounded-xl font-bold text-sm hover:bg-[#6d441e] transition flex items-center justify-center gap-2 shadow-none">
            <i class="fa-solid fa-envelope text-sm"></i> Log In with Email
        </a>
        <p class="text-xs text-[#7a666c] mt-5">
            New here? <a href="{{ route('register') }}" class="font-bold text-[#8b5a2b] hover:underline">Join Free →</a>
        </p>
    </div>
</div>
@endguest

@auth

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
@endauth

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
