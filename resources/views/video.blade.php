@extends('layouts.app')

@section('title', 'Live 1-on-1 Random Video Call — CupDate')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-8">
    <div class="text-center mb-6">
        <span class="inline-flex items-center gap-1.5 bg-[#f5ede6] text-[#8b5a2b] border border-[#e5d5ca] px-3.5 py-1 rounded-full text-xs font-bold uppercase tracking-wider mb-2 shadow-none">
            <span class="w-2 h-2 rounded-full bg-[#10b981] animate-ping"></span> Live Coffee Video Portal
        </span>
        <h1 class="font-['Plus_Jakarta_Sans'] font-extrabold text-2xl md:text-3xl text-[#24140d]">
            Random Coffee Date Video Matching
        </h1>
        <p class="text-xs text-[#7a666c] mt-1">Connect with verified singles over quick 1-on-1 video chats.</p>
    </div>

    <!-- Video Stage -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 bg-white border border-[#e5d5ca] rounded-3xl p-4 md:p-6 mb-6 shadow-none">
        <!-- Remote Partner Screen -->
        <div class="relative bg-[#24140d] rounded-2xl h-[320px] md:h-[400px] overflow-hidden flex items-center justify-center shadow-none">
            <div id="remotePlaceholder" class="text-center p-6 text-white">
                <img id="partnerAvatar" src="{{ $partners->first()->avatar_url ?? asset('assets/images/default_avatar.png') }}" class="w-24 h-24 rounded-full object-cover border-2 border-[#8b5a2b] mx-auto mb-3">
                <h3 id="partnerName" class="font-bold text-lg text-white">{{ $partners->first()->full_name ?? 'Searching...' }}</h3>
                <p id="partnerCity" class="text-xs text-white/70">{{ $partners->first()->country ?? 'India' }} • {{ $partners->first()->age ?? 22 }} yrs</p>
                <div class="mt-3 inline-flex items-center gap-1.5 bg-black/40 backdrop-blur px-3 py-1 rounded-full text-[11px] text-[#10b981]">
                    <i class="fa-solid fa-signal"></i> Connected HD
                </div>
            </div>
            <div class="absolute top-3 left-3 bg-black/60 backdrop-blur px-2.5 py-1 rounded-full text-[11px] text-white flex items-center gap-1">
                <span class="w-2 h-2 rounded-full bg-[#10b981]"></span> Remote Match
            </div>
        </div>

        <!-- Local User Camera Preview -->
        <div class="relative bg-[#1a0e08] rounded-2xl h-[320px] md:h-[400px] overflow-hidden flex items-center justify-center shadow-none">
            <video id="localVideo" autoplay playsinline muted class="w-full h-full object-cover"></video>
            <div id="cameraOffPlaceholder" class="hidden text-center p-6 text-white">
                <i class="fa-solid fa-video-slash text-3xl text-gray-400 mb-2"></i>
                <p class="text-xs text-gray-400">Camera is turned off</p>
            </div>
            <div class="absolute top-3 left-3 bg-black/60 backdrop-blur px-2.5 py-1 rounded-full text-[11px] text-white flex items-center gap-1">
                <span class="w-2 h-2 rounded-full bg-[#8b5a2b]"></span> You (Local Camera)
            </div>
        </div>
    </div>

    <!-- Video Call Controls -->
    <div class="flex items-center justify-center gap-4">
        <button id="toggleMicBtn" onclick="toggleMic()" class="w-12 h-12 rounded-full border border-[#e5d5ca] bg-white text-[#24140d] hover:bg-[#f5ede6] flex items-center justify-center text-lg transition cursor-pointer shadow-none" title="Toggle Mic">
            <i class="fa-solid fa-microphone"></i>
        </button>
        <button id="toggleCamBtn" onclick="toggleCam()" class="w-12 h-12 rounded-full border border-[#e5d5ca] bg-white text-[#24140d] hover:bg-[#f5ede6] flex items-center justify-center text-lg transition cursor-pointer shadow-none" title="Toggle Camera">
            <i class="fa-solid fa-video"></i>
        </button>
        <button onclick="nextVideoPartner()" class="px-6 py-3 bg-[#8b5a2b] text-white rounded-full font-bold text-xs hover:bg-[#6d441e] transition cursor-pointer flex items-center gap-2 shadow-none">
            <i class="fa-solid fa-forward-step"></i> Next Match
        </button>
        <a href="{{ route('feed') }}" class="w-12 h-12 rounded-full bg-[#ef4444] text-white hover:bg-[#dc2626] flex items-center justify-center text-lg transition shadow-none" title="Leave Call">
            <i class="fa-solid fa-phone-slash"></i>
        </a>
    </div>
</div>
@endsection

@section('extra_js')
<script>
let localStream = null;
let camEnabled = true;
let micEnabled = true;

const partnersList = @json($partners);
let currentPartnerIdx = 0;

// Initialize camera stream
async function initLocalCamera() {
    try {
        localStream = await navigator.mediaDevices.getUserMedia({ video: true, audio: true });
        const videoElem = document.getElementById('localVideo');
        videoElem.srcObject = localStream;
    } catch (err) {
        console.warn('Camera access denied or unavailable:', err);
        document.getElementById('localVideo').classList.add('hidden');
        document.getElementById('cameraOffPlaceholder').classList.remove('hidden');
    }
}

function toggleCam() {
    if (!localStream) return;
    camEnabled = !camEnabled;
    localStream.getVideoTracks().forEach(track => track.enabled = camEnabled);
    document.getElementById('toggleCamBtn').innerHTML = camEnabled ? '<i class="fa-solid fa-video"></i>' : '<i class="fa-solid fa-video-slash text-red-500"></i>';
}

function toggleMic() {
    if (!localStream) return;
    micEnabled = !micEnabled;
    localStream.getAudioTracks().forEach(track => track.enabled = micEnabled);
    document.getElementById('toggleMicBtn').innerHTML = micEnabled ? '<i class="fa-solid fa-microphone"></i>' : '<i class="fa-solid fa-microphone-slash text-red-500"></i>';
}

function nextVideoPartner() {
    if (partnersList.length === 0) return;
    currentPartnerIdx = (currentPartnerIdx + 1) % partnersList.length;
    const partner = partnersList[currentPartnerIdx];

    document.getElementById('partnerName').innerText = partner.full_name;
    document.getElementById('partnerCity').innerText = `${partner.country || 'India'} • ${partner.age || 22} yrs`;
    if (partner.avatar_url) {
        document.getElementById('partnerAvatar').src = partner.avatar_url;
    }
}

document.addEventListener('DOMContentLoaded', initLocalCamera);
</script>
@endsection
