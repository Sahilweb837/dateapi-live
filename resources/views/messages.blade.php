@extends('layouts.app')

@section('title', 'Messages & Chat — CupDate')

@section('content')
<!-- 4-Tab Top Navigation Bar -->
<div class="cupdate-top-tabs">
    <div class="cupdate-tabs-inner">
        <a href="{{ route('feed') }}" class="cupdate-tab-btn"><i class="fa-solid fa-mug-hot"></i> Feed</a>
        <a href="{{ route('swipes') }}" class="cupdate-tab-btn"><i class="fa-solid fa-fire"></i> Swipes</a>
        <a href="{{ route('messages') }}" class="cupdate-tab-btn active"><i class="fa-solid fa-comments"></i> Chat</a>
        <a href="{{ route('profile') }}" class="cupdate-tab-btn"><i class="fa-solid fa-user"></i> Profile</a>
    </div>
</div>

<div class="max-w-5xl mx-auto px-4 py-6">
    <div class="bg-white border border-[#e5d5ca] rounded-3xl overflow-hidden grid grid-cols-1 md:grid-cols-3 h-[75vh] shadow-none">
        <!-- Conversations List (Zero-Refresh Dynamic Switcher) -->
        <div class="border-r border-[#e5d5ca] flex flex-col h-full bg-[#fbf8f5]">
            <div class="p-4 border-b border-[#e5d5ca] flex items-center justify-between">
                <h3 class="font-['Plus_Jakarta_Sans'] font-extrabold text-lg text-[#24140d]">Coffee Chats</h3>
                <span class="text-[10px] font-bold bg-[#f5ede6] text-[#8b5a2b] border border-[#e5d5ca] px-2 py-0.5 rounded-full">Live</span>
            </div>
            <div class="flex-1 overflow-y-auto divide-y divide-[#e5d5ca]" id="conversationsList">
                @forelse($partners as $partner)
                    <div onclick="switchConversation({{ $partner->id }}, this)" 
                         id="partner-item-{{ $partner->id }}"
                         class="conversation-item cursor-pointer flex items-center gap-3 p-4 hover:bg-[#f5ede6] transition {{ $activePartner && $activePartner->id === $partner->id ? 'bg-[#f5ede6] border-l-4 border-[#8b5a2b]' : '' }}">
                        <div class="relative">
                            <img src="{{ $partner->avatar_url }}" class="w-12 h-12 rounded-full object-cover border border-[#e5d5ca]">
                            @if($partner->is_verified)
                                <i class="fa-solid fa-circle-check text-[#8b5a2b] text-xs absolute bottom-0 right-0 bg-white rounded-full"></i>
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center justify-between">
                                <strong class="text-sm font-bold text-[#24140d] truncate">{{ $partner->full_name }}</strong>
                            </div>
                            <p class="text-xs text-[#7a666c] truncate">{{ $partner->bio ?? 'Say hi!' }}</p>
                        </div>
                    </div>
                @empty
                    <div class="p-8 text-center text-xs text-[#7a666c]">
                        No active conversations yet. Match with someone in Swipes!
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Chat Area (Zero-Refresh AJAX Real-Time Chat with Image Upload) -->
        <div class="md:col-span-2 flex flex-col h-full bg-white" id="chatContainer">
            @if($activePartner)
                <!-- Chat Header -->
                <div class="p-4 border-b border-[#e5d5ca] flex items-center justify-between" id="chatHeader">
                    <div class="flex items-center gap-3">
                        <img id="partnerHeaderAvatar" src="{{ $activePartner->avatar_url }}" class="w-10 h-10 rounded-full object-cover border border-[#e5d5ca]">
                        <div>
                            <div class="flex items-center gap-2">
                                <strong id="partnerHeaderName" class="text-sm font-bold text-[#24140d] block">{{ $activePartner->full_name }}</strong>
                                <span id="partnerHeaderMemberId" class="text-[10px] font-mono font-bold bg-[#f5ede6] text-[#8b5a2b] border border-[#e5d5ca] px-2 py-0.5 rounded-full">
                                    #{{ $activePartner->formatted_member_id }}
                                </span>
                            </div>
                            <span class="text-xs text-[#10b981] flex items-center gap-1">
                                <span class="w-1.5 h-1.5 rounded-full bg-[#10b981] animate-pulse"></span> Active now
                            </span>
                        </div>
                    </div>
                    <a id="partnerHeaderProfileLink" href="{{ route('profile', $activePartner->id) }}" class="text-xs font-bold text-[#8b5a2b] bg-[#f5ede6] border border-[#e5d5ca] px-3.5 py-1.5 rounded-full hover:bg-[#ede2d8] transition shadow-none">
                        View Profile
                    </a>
                </div>

                <!-- Messages Thread -->
                <div id="messagesThread" class="flex-1 overflow-y-auto p-4 space-y-3">
                    @forelse($messages as $msg)
                        @php $isMe = ($msg->sender_id === Auth::id()); @endphp
                        <div class="flex {{ $isMe ? 'justify-end' : 'justify-start' }}" data-msg-id="{{ $msg->id }}">
                            <div class="max-w-[75%] rounded-2xl px-4 py-2.5 text-sm {{ $isMe ? 'bg-[#8b5a2b] text-white rounded-br-none' : 'bg-[#f5ede6] text-[#24140d] border border-[#e5d5ca] rounded-bl-none' }} shadow-none">
                                @if($msg->attachment)
                                    <div class="mb-2 rounded-xl overflow-hidden border border-black/10">
                                        <img src="{{ $msg->attachment_url }}" alt="Attachment" class="max-h-60 w-full object-cover cursor-pointer" onclick="window.open(this.src, '_blank')">
                                    </div>
                                @endif
                                @if($msg->message)
                                    <p class="leading-relaxed">{{ $msg->message }}</p>
                                @endif
                                <span class="text-[10px] {{ $isMe ? 'text-white/75' : 'text-[#7a666c]' }} block mt-1 text-right">
                                    {{ \Carbon\Carbon::parse($msg->created_at)->format('h:i A') }}
                                </span>
                            </div>
                        </div>
                    @empty
                        <div id="emptyThreadPrompt" class="text-center py-16 text-xs text-[#7a666c]">
                            <i class="fa-solid fa-mug-hot text-[#8b5a2b] text-3xl mb-2"></i>
                            <p>Break the ice! Send {{ $activePartner->full_name }} a warm coffee invitation.</p>
                        </div>
                    @endforelse
                </div>

                <!-- Image Attachment Preview Pill -->
                <div id="imagePreviewContainer" class="hidden px-4 py-2 bg-[#f5ede6] border-t border-[#e5d5ca] flex items-center justify-between">
                    <div class="flex items-center gap-2.5">
                        <img id="imagePreviewThumb" src="" class="w-10 h-10 rounded-xl object-cover border border-[#8b5a2b]">
                        <div>
                            <span id="imagePreviewName" class="text-xs text-[#24140d] font-bold block truncate max-w-[180px]">Photo Selected</span>
                            <span class="text-[10px] text-[#7d6558]">Ready to send</span>
                        </div>
                    </div>
                    <button type="button" onclick="cancelChatImage()" class="text-xs text-[#dc2626] font-bold hover:underline cursor-pointer">
                        <i class="fa-solid fa-xmark"></i> Remove
                    </button>
                </div>

                <!-- Message Input Bar -->
                <form id="chatForm" onsubmit="handleSendMessage(event)" class="p-4 border-t border-[#e5d5ca] flex items-center gap-3 bg-white">
                    <!-- Photo Upload Trigger -->
                    <label for="chatFileInput" class="w-10 h-10 rounded-full border border-[#e5d5ca] bg-[#fbf8f5] text-[#8b5a2b] hover:bg-[#f5ede6] flex items-center justify-center cursor-pointer transition shrink-0 shadow-none" title="Upload Photo">
                        <i class="fa-solid fa-camera text-sm"></i>
                    </label>
                    <input type="file" id="chatFileInput" name="image" accept="image/*" class="hidden" onchange="previewChatImage(this)">

                    <input type="text" id="chatInput" placeholder="Type a warm message..." class="flex-1 bg-[#fbf8f5] border border-[#e5d5ca] rounded-full px-5 py-2.5 text-sm text-[#24140d] focus:outline-none focus:border-[#8b5a2b] shadow-none">
                    
                    <button type="submit" id="sendBtn" class="w-10 h-10 rounded-full bg-[#8b5a2b] text-white flex items-center justify-center hover:bg-[#6d441e] transition cursor-pointer shrink-0 shadow-none">
                        <i class="fa-solid fa-paper-plane text-sm"></i>
                    </button>
                </form>
            @else
                <div class="flex-1 flex flex-col items-center justify-center p-8 text-center">
                    <i class="fa-solid fa-comments text-[#e5d5ca] text-6xl mb-3"></i>
                    <h3 class="font-bold text-[#24140d] text-base">Select a conversation</h3>
                    <p class="text-xs text-[#7a666c] mt-1">Pick a match from the left sidebar to start chatting.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('extra_js')
<script>
let activePartnerId = {{ $activePartner ? $activePartner->id : 'null' }};
const currentUserId = {{ Auth::id() }};
const thread = document.getElementById('messagesThread');
if (thread) {
    thread.scrollTop = thread.scrollHeight;
}

// 1. Photo Attachment Preview
function previewChatImage(input) {
    if (input.files && input.files[0]) {
        const file = input.files[0];
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('imagePreviewThumb').src = e.target.result;
            document.getElementById('imagePreviewName').innerText = file.name;
            document.getElementById('imagePreviewContainer').classList.remove('hidden');
        };
        reader.readAsDataURL(file);
    }
}

function cancelChatImage() {
    const input = document.getElementById('chatFileInput');
    input.value = '';
    document.getElementById('imagePreviewThumb').src = '';
    document.getElementById('imagePreviewContainer').classList.add('hidden');
}

// 2. Play subtle pleasant coffee chime (Web Audio API - No external assets)
function playChime() {
    try {
        const ctx = new (window.AudioContext || window.webkitAudioContext)();
        const osc = ctx.createOscillator();
        const gain = ctx.createGain();
        osc.type = 'sine';
        osc.frequency.setValueAtTime(587.33, ctx.currentTime); // D5
        osc.frequency.exponentialRampToValueAtTime(880, ctx.currentTime + 0.15); // A5
        gain.gain.setValueAtTime(0.12, ctx.currentTime);
        gain.gain.exponentialRampToValueAtTime(0.001, ctx.currentTime + 0.3);
        osc.connect(gain);
        gain.connect(ctx.destination);
        osc.start();
        osc.stop(ctx.currentTime + 0.3);
    } catch(e) {}
}

// 3. Send Message via AJAX Without Page Refresh
async function handleSendMessage(e) {
    e.preventDefault();
    if (!activePartnerId) return;

    const textInput = document.getElementById('chatInput');
    const fileInput = document.getElementById('chatFileInput');
    const msgText = textInput.value.trim();
    const hasFile = fileInput.files && fileInput.files[0];

    if (!msgText && !hasFile) return;

    // Optimistic image preview URL if file selected
    let tempImgSrc = null;
    if (hasFile) {
        tempImgSrc = document.getElementById('imagePreviewThumb').src;
    }

    // Build FormData
    const formData = new FormData();
    formData.append('receiver_id', activePartnerId);
    if (msgText) formData.append('message', msgText);
    if (hasFile) formData.append('image', fileInput.files[0]);

    // Optimistic render in thread
    appendMessage(msgText, tempImgSrc, 'Just now', true);

    // Reset inputs immediately
    textInput.value = '';
    cancelChatImage();

    try {
        const res = await fetch("{{ route('api.messages.send') }}", {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: formData
        });

        const data = await res.json();
        if (!data.success) {
            alert(data.message || 'Error sending message.');
        } else {
            playChime();
        }
    } catch (err) {
        console.error('Error sending message:', err);
    }
}

// 4. Render message bubble
function appendMessage(text, imgSrc, time, isMe) {
    const emptyPrompt = document.getElementById('emptyThreadPrompt');
    if (emptyPrompt) emptyPrompt.remove();

    const div = document.createElement('div');
    div.className = `flex ${isMe ? 'justify-end' : 'justify-start'}`;

    let imgHtml = '';
    if (imgSrc) {
        imgHtml = `
            <div class="mb-2 rounded-xl overflow-hidden border border-black/10">
                <img src="${imgSrc}" alt="Photo" class="max-h-60 w-full object-cover cursor-pointer" onclick="window.open(this.src, '_blank')">
            </div>
        `;
    }

    let textHtml = '';
    if (text) {
        textHtml = `<p class="leading-relaxed">${text}</p>`;
    }

    div.innerHTML = `
        <div class="max-w-[75%] rounded-2xl px-4 py-2.5 text-sm ${isMe ? 'bg-[#8b5a2b] text-white rounded-br-none' : 'bg-[#f5ede6] text-[#24140d] border border-[#e5d5ca] rounded-bl-none'} shadow-none">
            ${imgHtml}
            ${textHtml}
            <span class="text-[10px] ${isMe ? 'text-white/75' : 'text-[#7a666c]'} block mt-1 text-right">${time}</span>
        </div>
    `;
    thread.appendChild(div);
    thread.scrollTop = thread.scrollHeight;
}

// 5. Zero-Refresh Dynamic Conversation Switcher
async function switchConversation(partnerId, element) {
    if (partnerId === activePartnerId) return;

    // Highlight selected item
    document.querySelectorAll('.conversation-item').forEach(el => {
        el.classList.remove('bg-[#f5ede6]', 'border-l-4', 'border-[#8b5a2b]');
    });
    element.classList.add('bg-[#f5ede6]', 'border-l-4', 'border-[#8b5a2b]');

    try {
        const res = await fetch(`/api/messages/conversation?user_id=${partnerId}`, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        });
        const data = await res.json();
        if (data.success) {
            activePartnerId = data.partner.id;

            // Update Header
            document.getElementById('partnerHeaderAvatar').src = data.partner.avatar;
            document.getElementById('partnerHeaderName').innerText = data.partner.name;
            document.getElementById('partnerHeaderMemberId').innerText = `#${data.partner.member_id}`;
            document.getElementById('partnerHeaderProfileLink').href = `/profile/${data.partner.id}`;

            // Update URL without refresh
            window.history.pushState(null, '', `/messages?user_id=${data.partner.id}`);

            // Render Thread Messages
            thread.innerHTML = '';
            if (data.messages.length === 0) {
                thread.innerHTML = `
                    <div id="emptyThreadPrompt" class="text-center py-16 text-xs text-[#7a666c]">
                        <i class="fa-solid fa-mug-hot text-[#8b5a2b] text-3xl mb-2"></i>
                        <p>Break the ice! Send ${data.partner.name} a warm coffee invitation.</p>
                    </div>
                `;
            } else {
                data.messages.forEach(m => {
                    appendMessage(m.message, m.attachment, m.time, m.is_me);
                });
            }
            thread.scrollTop = thread.scrollHeight;
        }
    } catch(e) {
        console.error('Error switching conversation:', e);
    }
}

// 6. Fast Real-Time Polling (every 2.5 seconds)
let lastMsgId = 0;
function updateLastMsgId() {
    const existing = thread.querySelectorAll('[data-msg-id]');
    if (existing.length > 0) {
        lastMsgId = existing[existing.length - 1].getAttribute('data-msg-id') || 0;
    }
}
if (thread) updateLastMsgId();

setInterval(async () => {
    if (!activePartnerId) return;
    try {
        const res = await fetch(`/api/messages/fetch?partner_id=${activePartnerId}&after_id=${lastMsgId}`, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        });
        const data = await res.json();
        if (data.success && data.messages && data.messages.length > 0) {
            data.messages.forEach(m => {
                lastMsgId = m.id;
                appendMessage(m.message, m.attachment, m.time, false);
            });
            playChime();
        }
    } catch (e) {}
}, 2500);
</script>
@endsection
