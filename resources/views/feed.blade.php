@extends('layouts.app')

@section('title', 'Community Coffee Feed — CupDate')

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
    <div class="mb-8">
        <h2 class="text-xs font-extrabold uppercase tracking-wider text-[#7a666c] mb-3 flex items-center gap-1.5">
            <span class="w-2 h-2 rounded-full bg-[#10b981] animate-pulse"></span> Singles Online Now
        </h2>
        <div class="flex gap-4 overflow-x-auto pb-2 scrollbar-none">
            @foreach($activeDaters as $dater)
                <a href="{{ route('profile', $dater->id) }}" class="flex flex-col items-center gap-1.5 shrink-0 group">
                    <div class="relative p-0.5 rounded-full border-2 border-[#8b5a2b] group-hover:scale-105 transition shadow-none">
                        <img src="{{ $dater->avatar_url }}" alt="{{ $dater->full_name }}" class="w-14 h-14 rounded-full object-cover">
                        @if($dater->is_verified)
                            <i class="fa-solid fa-circle-check text-[#8b5a2b] text-xs absolute bottom-0 right-0 bg-white rounded-full"></i>
                        @endif
                    </div>
                    <span class="text-xs font-bold text-[#24140d] max-w-[65px] truncate">{{ explode(' ', $dater->full_name)[0] }}</span>
                </a>
            @endforeach
        </div>
    </div>

    <!-- Success Toast (Zero-Refresh) -->
    <div id="feedToast" class="hidden mb-4 p-4 bg-[#ecfdf5] border border-[#a7f3d0] rounded-2xl text-xs font-bold text-[#065f46] flex items-center gap-2 transition-all">
        <i class="fa-solid fa-circle-check text-base"></i>
        <span id="feedToastText">Your coffee date idea was published to the community! ☕</span>
    </div>

    <!-- Share a Coffee Date Idea Composer (Zero-Refresh + Photo Upload) -->
    <div class="bg-white border border-[#e5d5ca] rounded-2xl p-5 mb-8 shadow-none">
        <h3 class="font-['Plus_Jakarta_Sans'] font-extrabold text-base text-[#24140d] mb-3 flex items-center gap-2">
            <i class="fa-solid fa-mug-hot text-[#8b5a2b]"></i> Pitch a Coffee Date Idea
        </h3>
        <form id="ideaForm" onsubmit="handlePostIdea(event)">
            <textarea id="ideaContent" rows="2" class="w-full bg-[#fbf8f5] border border-[#e5d5ca] rounded-xl p-3 text-sm text-[#24140d] focus:outline-none focus:border-[#8b5a2b] resize-none mb-3 shadow-none" placeholder="What's your dream coffee date vibe? (e.g. Cinnamon cappuccino at Cafe Simla Times or Lavender cold brew at Subko Bandra...)"></textarea>
            
            <!-- Optional Photo Preview -->
            <div id="ideaImagePreview" class="hidden mb-3 p-2 bg-[#f5ede6] border border-[#e5d5ca] rounded-xl flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <img id="ideaImageThumb" src="" class="w-10 h-10 rounded-lg object-cover border border-[#8b5a2b]">
                    <span id="ideaImageFileName" class="text-xs text-[#24140d] font-semibold truncate max-w-[200px]">Photo Attached</span>
                </div>
                <button type="button" onclick="cancelIdeaPhoto()" class="text-xs text-[#dc2626] font-bold hover:underline">Remove</button>
            </div>

            <div class="flex flex-wrap items-center justify-between gap-3">
                <div class="flex flex-wrap items-center gap-2">
                    <input type="text" id="cafeName" placeholder="Cafe Name (Optional)" class="bg-[#fbf8f5] border border-[#e5d5ca] rounded-lg px-3 py-1.5 text-xs text-[#24140d] focus:outline-none focus:border-[#8b5a2b]">
                    <input type="text" id="cityName" placeholder="City (e.g. Shimla, Pune)" class="bg-[#fbf8f5] border border-[#e5d5ca] rounded-lg px-3 py-1.5 text-xs text-[#24140d] focus:outline-none focus:border-[#8b5a2b]">
                    
                    <!-- Attach Photo Button -->
                    <label for="ideaPhotoInput" class="px-3 py-1.5 bg-[#fbf8f5] border border-[#e5d5ca] text-[#8b5a2b] rounded-lg text-xs font-bold hover:bg-[#f5ede6] transition cursor-pointer flex items-center gap-1.5 shadow-none" title="Attach Cafe Photo">
                        <i class="fa-solid fa-camera"></i> Photo
                    </label>
                    <input type="file" id="ideaPhotoInput" accept="image/*" class="hidden" onchange="previewIdeaPhoto(this)">
                </div>
                <button type="submit" id="postIdeaBtn" class="bg-[#8b5a2b] text-white px-5 py-2 rounded-xl text-xs font-extrabold hover:bg-[#6d441e] transition cursor-pointer shadow-none">
                    Post Idea ☕
                </button>
            </div>
        </form>
    </div>

    <!-- Ideas Feed (Dynamically Prepending) -->
    <div class="space-y-4" id="ideasContainer">
        @forelse($ideas as $idea)
            <div class="bg-white border border-[#e5d5ca] rounded-2xl p-5 transition hover:border-[#8b5a2b] shadow-none idea-card" id="idea-card-{{ $idea->id }}">
                <div class="flex items-center justify-between mb-3">
                    <div class="flex items-center gap-3">
                        <img src="{{ $idea->user->avatar_url ?? asset('assets/images/default_avatar.png') }}" class="w-10 h-10 rounded-full object-cover border border-[#e5d5ca]">
                        <div>
                            <strong class="text-sm font-bold text-[#24140d] block">{{ $idea->user->full_name ?? 'Coffee Lover' }}</strong>
                            <span class="text-xs text-[#7a666c] flex items-center gap-1">
                                <i class="fa-solid fa-location-dot text-[#8b5a2b] text-[10px]"></i> {{ $idea->cafe_name }} • {{ $idea->city }}
                            </span>
                        </div>
                    </div>
                    <span class="text-[11px] text-[#7a666c]">{{ \Carbon\Carbon::parse($idea->created_at)->diffForHumans() }}</span>
                </div>
                
                <p class="text-sm text-[#4a383e] leading-relaxed mb-3">{{ $idea->content }}</p>

                @if($idea->image)
                    <div class="mb-4 rounded-xl overflow-hidden max-h-72 border border-[#e5d5ca]">
                        <img src="{{ $idea->image_url }}" alt="Cafe Date Idea" class="w-full h-full object-cover">
                    </div>
                @endif

                <div class="flex items-center justify-between pt-3 border-t border-[#e5d5ca]">
                    <button onclick="sparkIdea({{ $idea->id }}, this)" class="flex items-center gap-1.5 text-xs font-bold text-[#8b5a2b] bg-[#f5ede6] border border-[#e5d5ca] px-3.5 py-1.5 rounded-full hover:bg-[#ede2d8] transition cursor-pointer shadow-none">
                        <i class="fa-solid fa-heart"></i>
                        <span class="spark-count">{{ $idea->sparks_count }}</span> Sparks
                    </button>
                    <a href="{{ route('messages', ['user_id' => $idea->user_id]) }}" class="text-xs font-bold text-[#8b5a2b] bg-[#fbf8f5] border border-[#e5d5ca] px-3.5 py-1.5 rounded-full hover:bg-[#f5ede6] transition shadow-none">
                        <i class="fa-solid fa-mug-hot"></i> Ask Out
                    </a>
                </div>
            </div>
        @empty
            <div id="noIdeasPrompt" class="text-center py-12 bg-[#fbf8f5] border border-[#e5d5ca] rounded-2xl shadow-none">
                <i class="fa-solid fa-mug-hot text-[#8b5a2b] text-3xl mb-2"></i>
                <p class="text-sm font-bold text-[#24140d]">No coffee date ideas yet!</p>
                <p class="text-xs text-[#7a666c]">Be the first to pitch a coffee spot above.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection

@section('extra_js')
<script>
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

// Zero-Refresh AJAX Date Idea Posting
async function handlePostIdea(e) {
    e.preventDefault();
    const content = document.getElementById('ideaContent').value.trim();
    const cafeName = document.getElementById('cafeName').value.trim();
    const cityName = document.getElementById('cityName').value.trim();
    const photoInput = document.getElementById('ideaPhotoInput');
    
    if (!content) return;

    const btn = document.getElementById('postIdeaBtn');
    btn.disabled = true;
    btn.innerText = 'Publishing...';

    const formData = new FormData();
    formData.append('content', content);
    if (cafeName) formData.append('cafe_name', cafeName);
    if (cityName) formData.append('city', cityName);
    if (photoInput.files && photoInput.files[0]) {
        formData.append('image', photoInput.files[0]);
    }

    try {
        const res = await fetch("{{ route('feed.idea') }}", {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: formData
        });
        const data = await res.json();
        if (data.success) {
            // Remove empty prompt if present
            const noIdeas = document.getElementById('noIdeasPrompt');
            if (noIdeas) noIdeas.remove();

            // Prepend new card dynamically without refresh!
            const newIdea = data.idea;
            let imgHtml = '';
            if (newIdea.image_url) {
                imgHtml = `
                    <div class="mb-4 rounded-xl overflow-hidden max-h-72 border border-[#e5d5ca]">
                        <img src="${newIdea.image_url}" alt="Cafe Date Idea" class="w-full h-full object-cover">
                    </div>
                `;
            }

            const card = document.createElement('div');
            card.className = 'bg-white border-2 border-[#8b5a2b] rounded-2xl p-5 transition shadow-none idea-card animate-pulse';
            card.id = `idea-card-${newIdea.id}`;
            card.innerHTML = `
                <div class="flex items-center justify-between mb-3">
                    <div class="flex items-center gap-3">
                        <img src="${newIdea.user_avatar}" class="w-10 h-10 rounded-full object-cover border border-[#e5d5ca]">
                        <div>
                            <strong class="text-sm font-bold text-[#24140d] block">${newIdea.user_name}</strong>
                            <span class="text-xs text-[#7a666c] flex items-center gap-1">
                                <i class="fa-solid fa-location-dot text-[#8b5a2b] text-[10px]"></i> ${newIdea.cafe_name} • ${newIdea.city}
                            </span>
                        </div>
                    </div>
                    <span class="text-[11px] text-[#7a666c]">Just now</span>
                </div>
                <p class="text-sm text-[#4a383e] leading-relaxed mb-3">${newIdea.content}</p>
                ${imgHtml}
                <div class="flex items-center justify-between pt-3 border-t border-[#e5d5ca]">
                    <button onclick="sparkIdea(${newIdea.id}, this)" class="flex items-center gap-1.5 text-xs font-bold text-[#8b5a2b] bg-[#f5ede6] border border-[#e5d5ca] px-3.5 py-1.5 rounded-full hover:bg-[#ede2d8] transition cursor-pointer shadow-none">
                        <i class="fa-solid fa-heart"></i>
                        <span class="spark-count">0</span> Sparks
                    </button>
                    <a href="/messages?user_id=${newIdea.user_id}" class="text-xs font-bold text-[#8b5a2b] bg-[#fbf8f5] border border-[#e5d5ca] px-3.5 py-1.5 rounded-full hover:bg-[#f5ede6] transition shadow-none">
                        <i class="fa-solid fa-mug-hot"></i> Ask Out
                    </a>
                </div>
            `;
            const container = document.getElementById('ideasContainer');
            container.insertBefore(card, container.firstChild);

            setTimeout(() => {
                card.classList.remove('animate-pulse', 'border-2');
                card.classList.add('border');
            }, 1500);

            // Reset Form & Show Toast
            document.getElementById('ideaForm').reset();
            cancelIdeaPhoto();
            const toast = document.getElementById('feedToast');
            toast.classList.remove('hidden');
            setTimeout(() => toast.classList.add('hidden'), 4000);
        } else {
            alert(data.message || 'Error posting idea.');
        }
    } catch (err) {
        alert('Could not submit idea. Please try again.');
    } finally {
        btn.disabled = false;
        btn.innerText = 'Post Idea ☕';
    }
}

async function sparkIdea(id, btn) {
    try {
        const res = await fetch(`/feed/spark/${id}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
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
