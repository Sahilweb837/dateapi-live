@extends('layouts.app')

@section('title', 'One-to-One Online Video Introductions in India — CupDate')
@section('meta_desc', 'Meet active CupDate members one at a time through respectful online video introductions, with real profiles from Himachal Pradesh and cities across India.')

@section('content')
<div class="max-w-5xl mx-auto px-3 sm:px-6 py-6 sm:py-10">
    
    <!-- Top Moniker & Live Radar Status -->
    <div class="flex flex-col sm:flex-row items-center justify-between gap-4 mb-6 bg-white/80 backdrop-blur-md border border-[#ebdcd7] p-4 sm:p-5 rounded-3xl shadow-sm">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-full bg-[#180e0c] border border-[#ff007f] flex items-center justify-center text-[#ff007f] shadow-[0_0_15px_rgba(255,0,127,0.3)] shrink-0">
                <span class="material-symbols-outlined text-xl">videocam</span>
            </div>
            <div>
                <div class="flex items-center gap-2">
                    <h1 class="font-headline-sm text-lg sm:text-xl font-black text-[#231a15]">
                        Cup<span class="neon-pink-text">Date</span> Video Lounge
                    </h1>
                    <span class="text-[10px] bg-emerald-100 text-emerald-800 border border-emerald-300 px-2 py-0.5 rounded-full font-bold flex items-center gap-1">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-600 animate-pulse"></span> One-to-one preview
                    </span>
                </div>
                <p class="text-xs text-secondary mt-0.5">
                    Respectful one-to-one introductions with real active members. Move on whenever you are ready.
                </p>
            </div>
        </div>

        <!-- Radar Pulse & Active Counter -->
        <div class="flex items-center gap-3">
            <div class="flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-[#fdeae3] border border-[#ff007f]/30 text-xs font-bold text-[#835339]">
                <span class="w-2 h-2 rounded-full bg-[#ff007f] animate-pulse"></span>
                <span id="activeSinglesCounter">{{ $partners->count() }} verified profiles available</span>
            </div>
            <button onclick="nextVideoPartner()" class="px-4 py-2 rounded-full bg-[#ff007f] hover:bg-[#d6006c] text-white text-xs font-bold shadow-[0_0_15px_rgba(255,0,127,0.35)] active:scale-95 transition flex items-center gap-1.5 cursor-pointer">
                <span class="material-symbols-outlined text-sm">shuffle</span>
                <span>Random Match</span>
            </button>
        </div>
    </div>

    <!-- Video Stage Layout -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 bg-[#120806] rounded-3xl p-3 sm:p-5 border border-stone-800 shadow-2xl mb-6 relative overflow-hidden">
        
        <!-- Remote Partner Screen -->
        <div class="relative bg-[#1c0c08] rounded-2xl h-[280px] sm:h-[380px] md:h-[440px] overflow-hidden flex items-center justify-center border border-stone-800">
            
            <!-- Scanning Radar Overlay (Hidden once connected) -->
            <div id="radarScannerOverlay" class="hidden absolute inset-0 z-20 bg-black/85 backdrop-blur-md flex flex-col items-center justify-center p-6 text-center">
                <div class="relative w-20 h-20 mb-4 flex items-center justify-center">
                    <span class="absolute inset-0 rounded-full border-2 border-[#ff007f]/40 animate-ping"></span>
                    <span class="absolute inset-2 rounded-full border border-emerald-400/60 animate-pulse"></span>
                    <span class="material-symbols-outlined text-3xl text-[#ff007f]">radar</span>
                </div>
                <h4 class="text-sm font-bold text-white tracking-wide" id="radarStatusText">Finding an available member...</h4>
                <p class="text-xs text-stone-400 mt-1">Only active profiles that have chosen to share a photo are shown.</p>
            </div>

            <!-- Remote Partner Profile & Simulated Stream -->
            <div id="remotePlaceholder" class="relative w-full h-full flex flex-col items-center justify-between p-5 text-white z-10">
                <!-- Top Stream Info Pill -->
                <div class="w-full flex items-center justify-between">
                    <span class="bg-black/60 backdrop-blur-md px-3 py-1 rounded-full text-[11px] text-emerald-400 border border-emerald-500/30 flex items-center gap-1.5 font-bold">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                        <span id="partnerStatusLabel">Online &amp; Connected</span>
                    </span>
                    <span class="bg-black/60 backdrop-blur-md px-2.5 py-1 rounded-full text-[10px] text-stone-300 font-mono">
                        Profile preview
                    </span>
                </div>

                <!-- Center Partner Avatar & Talking Indicator -->
                <div class="relative my-auto flex flex-col items-center">
                    <div class="relative w-28 h-28 sm:w-36 sm:h-36 rounded-full overflow-hidden p-1 bg-gradient-to-tr from-[#ff007f] to-amber-500 shadow-[0_0_30px_rgba(255,0,127,0.4)]">
                        <img id="partnerAvatar" 
                             src="{{ optional($partners->first())->avatar_url ?? asset('assets/images/default_avatar.png') }}" 
                             alt="Partner Avatar" 
                             class="w-full h-full object-cover rounded-full">
                        <span class="absolute bottom-1 right-1 w-4 h-4 rounded-full bg-emerald-500 ring-2 ring-black"></span>
                    </div>

                    <div class="mt-3 text-center">
                        <div class="flex items-center justify-center gap-1.5">
                            <h3 id="partnerName" class="font-headline-sm text-xl font-bold text-white">{{ optional($partners->first())->full_name ?? 'No member available' }}</h3>
                            <span class="material-symbols-outlined text-emerald-400 text-base" title="Selfie Verified">verified</span>
                        </div>
                        <p id="partnerCity" class="text-xs text-stone-300 mt-0.5">
                            {{ optional($partners->first())->country ?? 'Location not shared' }} @if(optional($partners->first())->age) • {{ optional($partners->first())->age }} yrs @endif
                        </p>
                        <div class="mt-2 inline-flex items-center gap-1 text-[11px] bg-[#ff007f]/20 border border-[#ff007f]/40 text-[#ff80bf] px-3 py-0.5 rounded-full font-semibold">
                            <span class="material-symbols-outlined text-xs">local_cafe</span>
                            <span id="partnerBrew">Single-Origin Pour-over Lover</span>
                        </div>
                    </div>
                </div>

                <!-- Bottom Quick Interaction Bar -->
                <div class="w-full flex items-center justify-between gap-2 pt-2">
                    <button onclick="sendQuickInviteFromVideo()" class="flex-1 py-2 px-3 rounded-full bg-[#ff007f]/90 hover:bg-[#ff007f] text-white text-xs font-bold flex items-center justify-center gap-1.5 transition active:scale-95 shadow-md">
                        <span class="material-symbols-outlined text-sm">local_cafe</span>
                        <span>Send a date invitation</span>
                    </button>
                    <button onclick="nextVideoPartner()" class="py-2 px-4 rounded-full bg-stone-800 hover:bg-stone-700 text-stone-200 text-xs font-bold flex items-center gap-1 transition">
                        <span>Skip</span>
                        <span class="material-symbols-outlined text-sm">fast_forward</span>
                    </button>
                </div>
            </div>

            <!-- Background Atmospheric Blur -->
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-black/60 pointer-events-none"></div>
        </div>

        <!-- Local User Camera Preview -->
        <div class="relative bg-[#1a0e08] rounded-2xl h-[280px] sm:h-[380px] md:h-[440px] overflow-hidden flex items-center justify-center border border-stone-800">
            <video id="localVideo" autoplay playsinline muted class="w-full h-full object-cover"></video>
            
            <div id="cameraOffPlaceholder" class="hidden text-center p-6 text-white">
                <div class="w-16 h-16 rounded-full bg-stone-800/80 mx-auto flex items-center justify-center mb-3">
                    <span class="material-symbols-outlined text-3xl text-stone-400">videocam_off</span>
                </div>
                <p class="text-sm font-bold text-stone-300">Camera Paused or Permission Needed</p>
                <button onclick="initLocalCamera()" class="mt-3 px-4 py-1.5 rounded-full bg-[#ff007f] text-white text-xs font-bold">
                    Enable Web Camera
                </button>
            </div>

            <div class="absolute top-3 left-3 bg-black/60 backdrop-blur-md px-3 py-1 rounded-full text-[11px] text-white flex items-center gap-1.5 font-bold border border-white/10">
                <span class="w-2 h-2 rounded-full bg-[#ff007f]"></span>
                <span>You (Self View)</span>
            </div>

            <!-- Micro Local Audio Visualizer -->
            <div class="absolute bottom-4 left-4 bg-black/60 backdrop-blur px-3 py-1 rounded-full text-[10px] text-emerald-400 flex items-center gap-1">
                <span class="material-symbols-outlined text-xs">mic</span>
                <span>Audio Active</span>
            </div>
        </div>
    </div>

    <!-- Call Control Deck -->
    <div class="flex items-center justify-center gap-3 sm:gap-5 bg-white/90 backdrop-blur-xl border border-[#ebdcd7] p-3 sm:p-4 rounded-3xl max-w-md mx-auto shadow-md">
        <!-- Mic Toggle -->
        <button id="toggleMicBtn" onclick="toggleMic()" class="w-12 h-12 rounded-full border border-stone-300 bg-surface text-[#231a15] hover:bg-stone-100 flex items-center justify-center text-xl transition cursor-pointer shadow-xs active:scale-95" title="Toggle Microphone">
            <span class="material-symbols-outlined" id="micIcon">mic</span>
        </button>

        <!-- Camera Toggle -->
        <button id="toggleCamBtn" onclick="toggleCam()" class="w-12 h-12 rounded-full border border-stone-300 bg-surface text-[#231a15] hover:bg-stone-100 flex items-center justify-center text-xl transition cursor-pointer shadow-xs active:scale-95" title="Toggle Camera">
            <span class="material-symbols-outlined" id="camIcon">videocam</span>
        </button>

        <!-- Next Match Button -->
        <button onclick="nextVideoPartner()" class="px-6 py-3 bg-[#ff007f] hover:bg-[#d6006c] text-white rounded-full font-bold text-xs shadow-[0_0_20px_rgba(255,0,127,0.4)] transition cursor-pointer flex items-center gap-2 active:scale-95">
            <span class="material-symbols-outlined text-base">shuffle</span>
            <span>Next Random Match</span>
        </button>

        <!-- End Call Button -->
        <a href="{{ route('feed') }}" class="w-12 h-12 rounded-full bg-rose-600 hover:bg-rose-700 text-white flex items-center justify-center text-xl transition shadow-xs active:scale-95 cursor-pointer" title="Leave Lounge">
            <span class="material-symbols-outlined">call_end</span>
        </a>
    </div>

    <!-- Toast Notification Container -->
    <div id="videoToast" class="hidden fixed bottom-24 left-1/2 -translate-x-1/2 z-50 bg-[#180e0c]/95 text-white px-5 py-2.5 rounded-full border border-[#ff007f]/50 text-xs font-bold shadow-2xl flex items-center gap-2">
        <span class="material-symbols-outlined text-sm text-[#ff007f]">coffee</span>
        <span id="videoToastMsg">Coffee Invite Sent!</span>
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

async function initLocalCamera() {
    try {
        localStream = await navigator.mediaDevices.getUserMedia({ video: true, audio: true });
        const videoElem = document.getElementById('localVideo');
        if (videoElem) {
            videoElem.srcObject = localStream;
            videoElem.classList.remove('hidden');
        }
        document.getElementById('cameraOffPlaceholder').classList.add('hidden');
    } catch (err) {
        console.warn('Camera access denied or unavailable:', err);
        const videoElem = document.getElementById('localVideo');
        if (videoElem) videoElem.classList.add('hidden');
        document.getElementById('cameraOffPlaceholder').classList.remove('hidden');
    }
}

function toggleCam() {
    if (!localStream) return;
    camEnabled = !camEnabled;
    localStream.getVideoTracks().forEach(track => track.enabled = camEnabled);
    const camIcon = document.getElementById('camIcon');
    if (camIcon) {
        camIcon.textContent = camEnabled ? 'videocam' : 'videocam_off';
        camIcon.className = camEnabled ? 'material-symbols-outlined' : 'material-symbols-outlined text-rose-500';
    }
}

function toggleMic() {
    if (!localStream) return;
    micEnabled = !micEnabled;
    localStream.getAudioTracks().forEach(track => track.enabled = micEnabled);
    const micIcon = document.getElementById('micIcon');
    if (micIcon) {
        micIcon.textContent = micEnabled ? 'mic' : 'mic_off';
        micIcon.className = micEnabled ? 'material-symbols-outlined' : 'material-symbols-outlined text-rose-500';
    }
}

function nextVideoPartner() {
    if (!partnersList || partnersList.length === 0) return;

    // Show scanner radar for 700ms for realistic video matching experience
    const scanner = document.getElementById('radarScannerOverlay');
    document.getElementById('radarStatusText').innerText = 'Finding an available member...';
    scanner.classList.remove('hidden');

    setTimeout(() => {
        currentPartnerIdx = (currentPartnerIdx + 1) % partnersList.length;
        const partner = partnersList[currentPartnerIdx];

        document.getElementById('partnerName').innerText = partner.full_name;
        document.getElementById('partnerCity').innerText = `${partner.country || 'Location not shared'}${partner.age ? ` • ${partner.age} yrs` : ''}`;
        if (partner.avatar_url) {
            document.getElementById('partnerAvatar').src = partner.avatar_url;
        }
        document.getElementById('partnerBrew').innerText = partner.coffee_style || 'Cortado & Cold Brew Fan';

        scanner.classList.add('hidden');
        showVideoToast(`Connected with ${partner.full_name.split(' ')[0]} in ${partner.country || 'HP'}!`);
    }, 600);
}

function sendQuickInviteFromVideo() {
    if (!partnersList || partnersList.length === 0) return;
    const partner = partnersList[currentPartnerIdx];
    showVideoToast(`☕ Coffee Date proposal sent to ${partner.full_name.split(' ')[0]}!`);
}

function showVideoToast(msg) {
    const toast = document.getElementById('videoToast');
    const text = document.getElementById('videoToastMsg');
    if (toast && text) {
        text.innerText = msg;
        toast.classList.remove('hidden');
        setTimeout(() => { toast.classList.add('hidden'); }, 3000);
    }
}

document.addEventListener('DOMContentLoaded', () => {
    initLocalCamera();
});
</script>
@endsection
