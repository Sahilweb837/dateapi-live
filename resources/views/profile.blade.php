@extends('layouts.app')

@section('title', $targetUser->full_name . ' — Atelier Dossier | CupDate')

@section('extra_css')
<style>
  /* Editorial Profile Monograph Theme */
  .profile-film-frame {
    box-shadow: 0 10px 30px rgba(39, 24, 17, 0.08);
  }
  .quote-mark {
    font-family: 'Playfair Display', serif;
  }
</style>
@endsection

@section('content')
<div class="flex flex-col w-full bg-surface min-h-screen">
  <div class="max-w-[1360px] w-full mx-auto px-4 sm:px-6 lg:px-margin-desktop py-6 sm:py-10 flex flex-col gap-space-xl">
    
    <!-- Editorial Navigation & Header Monogram Bar -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-space-md pb-4 border-b border-outline-variant/30">
      <a class="inline-flex items-center gap-space-xs font-label-lg text-label-lg text-secondary hover:text-on-surface transition-colors group" href="{{ route('swipes') }}">
        <span class="material-symbols-outlined text-body-lg group-hover:-translate-x-1 transition-transform">arrow_back</span>
        <span>Back to Discover Deck</span>
      </a>
      <div class="flex items-center gap-space-md flex-wrap">
        <span class="font-label-sm text-label-sm uppercase tracking-widest text-outline">
          CupDate Edition • Profile No. {{ $targetUser->formatted_member_id }}
        </span>
        <div class="inline-flex items-center gap-1.5 px-space-md py-space-xs rounded-full bg-surface-container-high text-on-surface-variant font-label-md text-label-md">
          <span class="material-symbols-outlined text-secondary text-sm">schedule</span>
          <span>Member since {{ $targetUser->created_at ? \Carbon\Carbon::parse($targetUser->created_at)->format('M Y') : 'Autumn 2024' }}</span>
        </div>
        @if($isOwnProfile)
          <button onclick="openEditModal()" class="inline-flex items-center gap-1.5 px-space-md py-space-xs rounded-full bg-primary text-on-primary font-label-md text-label-md shadow-sm hover:opacity-90 transition-all cursor-pointer">
            <span class="material-symbols-outlined text-sm">edit</span>
            <span>Edit Atelier Dossier</span>
          </button>
        @endif
      </div>
    </div>

    @if(session('success'))
      <div class="p-4 bg-emerald-50 border border-emerald-200 rounded-2xl text-xs font-bold text-emerald-900 flex items-center gap-2 shadow-xs">
        <span class="material-symbols-outlined text-emerald-700 text-base">check_circle</span>
        <span>{{ session('success') }}</span>
      </div>
    @endif

    <!-- Profile Completeness Meter (for own profile) -->
    @if($isOwnProfile)
      <div class="bg-surface-container-low p-space-md rounded-2xl border border-outline-variant/30 flex flex-col gap-2">
        <div class="flex items-center justify-between">
          <span class="font-label-md text-label-md font-bold text-on-surface flex items-center gap-1.5">
            <span class="material-symbols-outlined text-secondary text-base">pie_chart</span>
            <span>Dossier Completeness</span>
          </span>
          <strong class="font-label-md text-label-md text-secondary font-bold">{{ $completeness ?? 85 }}%</strong>
        </div>
        <div class="w-full bg-surface-container-high h-2.5 rounded-full overflow-hidden">
          <div class="bg-secondary h-full rounded-full transition-all duration-500" style="width: {{ $completeness ?? 85 }}%;"></div>
        </div>
        <p class="font-body-sm text-xs text-on-surface-variant">
          Complete your coffee persona, preferred cafés, and prompts to receive 3x more quality coffee date invitations!
        </p>
      </div>
    @endif

    <!-- Main Editorial Two-Column Spread -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-gutter-lg items-start">
      
      <!-- ============================================================= -->
      <!-- LEFT COLUMN (Visual Gallery, Coffee Persona & Trust) - 5 cols -->
      <!-- ============================================================= -->
      <div class="lg:col-span-5 flex flex-col gap-space-lg">
        
        <!-- Primary Photo Frame with Monograph Styling -->
        <div class="relative bg-surface-container-low p-space-md rounded-2xl shadow-sm group profile-film-frame border border-outline-variant/30">
          <div class="relative w-full aspect-[4/5] rounded-xl overflow-hidden bg-surface-container">
            <img class="w-full h-full object-cover group-hover:scale-[1.02] transition-transform duration-700 ease-out" 
                 id="mainProfileImg"
                 src="{{ $targetUser->avatar_url }}" 
                 alt="{{ $targetUser->full_name }}"/>
            <div class="absolute inset-0 bg-gradient-to-t from-primary-container/70 via-transparent to-transparent opacity-85 pointer-events-none"></div>
            
            <div class="absolute bottom-space-md left-space-md right-space-md flex items-end justify-between text-on-primary">
              <div class="flex flex-col">
                <span class="font-label-sm text-label-sm tracking-wider uppercase opacity-90 text-secondary-fixed">Cover Dispatch</span>
                <span class="font-headline-sm text-headline-sm font-semibold">{{ $targetUser->country ?? 'Himachal Pradesh, India' }}</span>
              </div>
              <span class="px-space-md py-space-xs rounded-full bg-surface/90 backdrop-blur-md text-on-surface font-label-sm text-label-sm shadow-sm flex items-center gap-1">
                <span class="material-symbols-outlined text-xs text-on-tertiary-container" style="font-variation-settings: 'FILL' 1;">favorite</span>
                <span>Curated Monograph</span>
              </span>
            </div>

            @if($isOwnProfile)
              <button type="button" onclick="document.getElementById('avatarFileInput').click()" class="absolute top-3 right-3 p-2 rounded-full bg-surface/90 backdrop-blur-md text-on-surface hover:bg-surface transition-all shadow-md" title="Change Cover Photo">
                <span class="material-symbols-outlined text-sm">photo_camera</span>
              </button>
            @endif
          </div>

          <!-- Secondary Thumbnail Grid -->
          <div class="grid grid-cols-3 gap-space-sm mt-space-md">
            @php
              $isMaleUser = ($targetUser->gender === 'male');
              $galleryPhotos = [
                $targetUser->avatar_url,
                $isMaleUser 
                  ? 'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?w=500&q=80&fit=crop'
                  : 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=500&q=80&fit=crop',
                $isMaleUser
                  ? 'https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?w=500&q=80&fit=crop'
                  : 'https://images.unsplash.com/photo-1524504388940-b1c1722653e1?w=500&q=80&fit=crop',
              ];
              $galleryCaptions = ['Primary Portrait', 'Atelier Brew', 'Mountain Vista'];
            @endphp
            @foreach($galleryPhotos as $gIdx => $gPhoto)
              <div class="relative aspect-square rounded-lg overflow-hidden bg-surface-container group/thumb cursor-pointer shadow-xs" 
                   onclick="document.getElementById('mainProfileImg').src = '{{ $gPhoto }}'"
                   title="Click to preview">
                <img class="w-full h-full object-cover group-hover/thumb:scale-105 transition-transform duration-500" 
                     loading="lazy"
                     src="{{ $gPhoto }}" 
                     alt="{{ $galleryCaptions[$gIdx] }}"/>
                <span class="absolute inset-x-0 bottom-0 bg-primary-container/80 text-on-primary font-label-sm text-[10px] py-0.5 text-center truncate px-1 font-medium">{{ $galleryCaptions[$gIdx] }}</span>
              </div>
            @endforeach
          </div>
        </div>

        <!-- Coffee Persona Card -->
        <div class="bg-surface-container-low p-space-lg rounded-2xl shadow-sm flex flex-col gap-space-md border border-outline-variant/30">
          <div class="flex items-center justify-between pb-space-xs border-b border-outline-variant/20">
            <div class="flex items-center gap-space-xs">
              <span class="material-symbols-outlined text-secondary text-headline-sm">coffee</span>
              <h3 class="font-headline-sm text-headline-sm text-on-surface font-semibold">The Coffee Persona</h3>
            </div>
            <span class="px-space-md py-space-xs rounded-full bg-secondary-container/60 text-on-secondary-container font-label-sm text-label-sm uppercase tracking-wider font-bold">
              Tasting Notes
            </span>
          </div>

          <div class="space-y-space-md">
            <!-- Signature Order -->
            <div class="bg-surface p-space-md rounded-xl shadow-xs flex items-start gap-space-md border border-outline-variant/20">
              <div class="w-10 h-10 rounded-full bg-surface-container-high flex items-center justify-center shrink-0 text-secondary">
                <span class="material-symbols-outlined">local_cafe</span>
              </div>
              <div class="flex flex-col">
                <span class="font-label-sm text-label-sm uppercase tracking-wider text-outline font-bold">Signature Order</span>
                <span class="font-body-md text-body-md font-semibold text-on-surface">{{ $targetUser->coffee_style ?? 'Oat Milk Cortado (extra hot)' }}</span>
                <p class="font-body-sm text-body-sm text-on-surface-variant mt-0.5">Rich ristretto shot with velvety micro-foam texture and delicate natural sweetness.</p>
              </div>
            </div>

            <!-- Go-to Cafe Vibe -->
            <div class="bg-surface p-space-md rounded-xl shadow-xs flex items-start gap-space-md border border-outline-variant/20">
              <div class="w-10 h-10 rounded-full bg-surface-container-high flex items-center justify-center shrink-0 text-secondary">
                <span class="material-symbols-outlined">nature_people</span>
              </div>
              <div class="flex flex-col">
                <span class="font-label-sm text-label-sm uppercase tracking-wider text-outline font-bold">Go-To Café Vibe</span>
                <span class="font-body-md text-body-md font-semibold text-on-surface">Sunlit verandas, vinyl records, quiet chatter</span>
                <p class="font-body-sm text-body-sm text-on-surface-variant mt-0.5">Places where conversation floats gently and cozy corner booths invite thoughtful dialog.</p>
              </div>
            </div>

            <!-- Caffeine Tolerance -->
            <div class="bg-surface p-space-md rounded-xl shadow-xs flex items-start gap-space-md border border-outline-variant/20">
              <div class="w-10 h-10 rounded-full bg-surface-container-high flex items-center justify-center shrink-0 text-secondary">
                <span class="material-symbols-outlined">battery_charging_full</span>
              </div>
              <div class="flex flex-col">
                <span class="font-label-sm text-label-sm uppercase tracking-wider text-outline font-bold">Caffeine Tolerance</span>
                <span class="font-body-md text-body-md font-semibold text-on-surface">Exactly 2 cups before noon</span>
                <div class="flex items-center gap-1.5 mt-space-xs">
                  <span class="w-6 h-2 rounded-full bg-secondary"></span>
                  <span class="w-6 h-2 rounded-full bg-secondary"></span>
                  <span class="w-6 h-2 rounded-full bg-surface-variant"></span>
                  <span class="font-label-sm text-label-sm text-on-surface-variant ml-space-xs font-medium">Strict sunset cutoff</span>
                </div>
              </div>
            </div>
          </div>

          <!-- Specialty Brew Chart Visual -->
          <div class="bg-surface-container p-space-md rounded-xl flex items-center justify-between mt-space-xs border border-outline-variant/20">
            <div class="flex flex-col">
              <span class="font-label-sm text-label-sm uppercase tracking-wider text-on-surface-variant font-bold">Flavor Profile Affinity</span>
              <span class="font-headline-sm text-body-lg font-serif italic text-on-surface">Stone fruit, bergamot &amp; dark cacao</span>
            </div>
            <svg class="w-16 h-16 text-secondary shrink-0" viewBox="0 0 36 36">
              <path class="text-surface-variant" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" fill="none" stroke="currentColor" stroke-width="3.5"></path>
              <path class="text-secondary" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" fill="none" stroke="currentColor" stroke-dasharray="88, 100" stroke-linecap="round" stroke-width="3.5"></path>
              <text class="font-label-sm fill-current text-center text-on-surface font-bold" text-anchor="middle" x="18" y="21">88%</text>
            </svg>
          </div>
        </div>

        <!-- Verification & Trust Badge -->
        <div class="bg-surface-container-high/80 p-space-md rounded-2xl flex items-center justify-between shadow-xs border border-outline-variant/30">
          <div class="flex items-center gap-space-md">
            <div class="w-9 h-9 rounded-full bg-on-tertiary-container text-on-tertiary flex items-center justify-center shrink-0 font-bold">
              <span class="material-symbols-outlined text-base">verified_user</span>
            </div>
            <div class="flex flex-col">
              <span class="font-label-md text-label-md font-bold text-on-surface">ID &amp; Live Selfie Verified</span>
              <span class="font-body-sm text-body-sm text-secondary">Verified Member of CupDate Society</span>
            </div>
          </div>
          <div class="flex items-center gap-1.5 px-space-md py-space-xs rounded-full bg-surface text-on-surface font-label-sm text-label-sm shadow-xs border border-outline-variant/20">
            <span class="w-2 h-2 rounded-full bg-emerald-600 animate-pulse"></span>
            <span class="font-semibold">Active today</span>
          </div>
        </div>

        @if($isOwnProfile)
        <!-- Private Account & Google Auth Security Card (Visible ONLY to Logged-in User) -->
        <div class="bg-surface-container-low p-space-md rounded-2xl shadow-sm border border-outline-variant/30 flex flex-col gap-2.5">
          <div class="flex items-center justify-between pb-2 border-b border-outline-variant/20">
            <div class="flex items-center gap-1.5">
              <span class="material-symbols-outlined text-secondary text-base">lock</span>
              <span class="text-xs font-bold text-on-surface">Private Security &amp; Auth</span>
            </div>
            <span class="text-[10px] bg-emerald-100 text-emerald-800 font-bold px-2 py-0.5 rounded-full flex items-center gap-1">
              <span class="w-1.5 h-1.5 rounded-full bg-emerald-600 animate-pulse"></span>
              Only Visible To You
            </span>
          </div>

          <div class="space-y-2 text-xs">
            <div class="flex items-center justify-between p-2 rounded-xl bg-surface border border-outline-variant/20">
              <div class="flex items-center gap-2 overflow-hidden">
                <svg class="w-4 h-4 shrink-0" viewBox="0 0 24 24">
                  <path d="M12 5c1.6 0 3 .6 4.1 1.6l3.1-3.1C17.3 1.7 14.8 1 12 1 7.4 1 3.5 3.6 1.6 7.3l3.7 2.9C6.2 7.3 8.9 5 12 5z" fill="#EA4335"/>
                  <path d="M23.5 12.3c0-.8-.1-1.6-.2-2.3H12v4.5h6.5c-.3 1.5-1.1 2.8-2.4 3.7l3.7 2.9c2.2-2 3.7-5 3.7-8.8z" fill="#4285F4"/>
                  <path d="M5.3 14.8c-.2-.7-.4-1.5-.4-2.3 0-.8.2-1.6.4-2.3L1.6 7.3C.6 9.3 0 11.6 0 14.2s.6 4.9 1.6 6.9l3.7-3.3z" fill="#FBBC05"/>
                  <path d="M12 23.4c3.2 0 6-1.1 8-3l-3.7-2.9c-1.1.7-2.5 1.2-4.3 1.2-3.1 0-5.8-2.3-6.7-5.2L1.6 16.8C3.5 20.8 7.4 23.4 12 23.4z" fill="#34A853"/>
                </svg>
                <div class="flex flex-col overflow-hidden">
                  <span class="text-[10px] text-gray-500 font-bold uppercase">Google Email Address</span>
                  <span class="font-bold text-gray-900 truncate">{{ $targetUser->email }}</span>
                </div>
              </div>
              <span class="text-[10px] text-gray-500 bg-gray-100 px-2 py-0.5 rounded font-mono">Confidential</span>
            </div>

            <div class="flex items-center justify-between p-2 rounded-xl bg-surface border border-outline-variant/20">
              <span class="text-gray-600 font-medium">Member ID</span>
              <span class="font-mono font-bold text-secondary">{{ $targetUser->formatted_member_id ?? 'CD-00001' }}</span>
            </div>

            <p class="text-[10px] text-on-surface-variant leading-normal pt-1">
              🛡️ <strong>Zero Data Leak Guarantee:</strong> Your email address and contact info are never displayed publicly on discovery deck or matches.
            </p>
          </div>
        </div>
        @endif

      </div>

      <!-- ========================================================================= -->
      <!-- RIGHT COLUMN (Deep Dives, Prompts, Neighborhoods, Intentions) - 7 cols -->
      <!-- ========================================================================= -->
      <div class="lg:col-span-7 flex flex-col gap-space-lg">
        
        <!-- Profile Masthead & Bio -->
        <div class="bg-surface-container-low p-space-xl rounded-2xl shadow-sm flex flex-col gap-space-md relative overflow-hidden border border-outline-variant/30">
          <div class="absolute -right-8 -top-8 w-40 h-40 rounded-full bg-secondary-container/20 blur-2xl pointer-events-none"></div>
          
          <div class="flex flex-wrap items-center justify-between gap-space-sm">
            <div class="flex items-baseline gap-space-sm">
              <h1 class="font-headline-xl text-headline-xl text-on-surface font-semibold tracking-tight">
                {{ $targetUser->full_name }}
              </h1>
              <span class="font-headline-md text-headline-md text-secondary italic font-normal">
                {{ $targetUser->age }}
              </span>
            </div>
            <div class="flex items-center gap-space-xs px-space-md py-1 rounded-full bg-surface text-on-surface font-label-md text-label-md shadow-xs border border-outline-variant/20">
              <span class="material-symbols-outlined text-sm text-on-tertiary-container">favorite</span>
              <span class="font-semibold">Mutual Coffee Vibe • 94% Match</span>
            </div>
          </div>

          <div class="flex flex-wrap items-center gap-space-xs text-secondary font-label-lg text-label-lg font-medium">
            <span class="material-symbols-outlined text-base">palette</span>
            <span>{{ $targetUser->gender ? ucfirst($targetUser->gender) : 'Intentional Member' }} · {{ $targetUser->mbti ? $targetUser->mbti . ' Personality' : 'Creative Visionary' }}</span>
            <span class="opacity-40">•</span>
            <span class="material-symbols-outlined text-base">location_on</span>
            <span>{{ $targetUser->country ?? 'Himachal Pradesh, India' }}</span>
          </div>

          <!-- Editorial Lead Quote / Statement -->
          <div class="bg-surface p-space-lg rounded-xl shadow-xs relative border border-outline-variant/20">
            <span class="font-headline-lg text-headline-xl leading-none text-secondary/20 absolute top-2 left-3 select-none quote-mark">“</span>
            <p class="font-headline-md text-body-lg text-on-surface italic font-serif leading-relaxed pl-space-md">
              {{ $targetUser->bio ?? 'Believer in slow mornings, analog film, natural wine, and deep conversations over well-roasted beans. Looking for someone intentional who appreciates cozy café corners.' }}
            </p>
          </div>

          <!-- Daily Ritual Micro-Tags -->
          <div class="flex flex-wrap items-center gap-space-xs pt-space-xs">
            <span class="font-label-sm text-label-sm uppercase tracking-wider text-outline mr-space-xs font-bold">Rituals:</span>
            @if($targetUser->mbti)
              <span class="px-space-md py-1 rounded-full bg-surface-container font-label-md text-label-md text-on-surface-variant font-semibold">{{ $targetUser->mbti }}</span>
            @endif
            @if($targetUser->astrology)
              <span class="px-space-md py-1 rounded-full bg-surface-container font-label-md text-label-md text-on-surface-variant font-semibold">{{ $targetUser->astrology }}</span>
            @endif
            <span class="px-space-md py-1 rounded-full bg-surface-container font-label-md text-label-md text-on-surface-variant">Early riser</span>
            <span class="px-space-md py-1 rounded-full bg-surface-container font-label-md text-label-md text-on-surface-variant">Analog film</span>
            <span class="px-space-md py-1 rounded-full bg-surface-container font-label-md text-label-md text-on-surface-variant">Weekend markets</span>
            <span class="px-space-md py-1 rounded-full bg-surface-container font-label-md text-label-md text-on-surface-variant">Acoustic indie playlists</span>
          </div>
        </div>

        <!-- Prompt 1: The Quickest Way to My Heart -->
        <div class="bg-surface-container-low p-space-xl rounded-2xl shadow-sm flex flex-col gap-space-md group border border-outline-variant/30">
          <div class="flex items-center justify-between">
            <span class="font-label-sm text-label-sm uppercase tracking-widest text-secondary font-bold">Editorial Prompt • Vol. I</span>
            <span class="material-symbols-outlined text-on-tertiary-container group-hover:scale-110 transition-transform">bakery_dining</span>
          </div>
          <h2 class="font-headline-md text-headline-md text-on-surface font-semibold">
            The quickest way to my heart...
          </h2>
          <div class="bg-surface p-space-lg rounded-xl shadow-xs border border-outline-variant/20">
            <p class="font-body-lg text-body-lg text-on-surface leading-relaxed">
              Surprise me with a still-warm cardamom bun or pain au chocolat from a quiet artisanal bakery, walk with me through scenic cobblestone alleys, and explore an indie bookstore where we pick out paperbacks for each other.
            </p>
          </div>
          <div class="flex items-center gap-space-xs font-label-sm text-label-sm text-on-surface-variant">
            <span class="material-symbols-outlined text-sm text-secondary">storefront</span>
            <span>Preferred rendez-vous spots: Roasteries, botanical garden benches, vinyl lounges</span>
          </div>
        </div>

        <!-- Prompt 2: Typical Saturday Routine -->
        <div class="bg-surface-container-low p-space-xl rounded-2xl shadow-sm flex flex-col gap-space-md group border border-outline-variant/30">
          <div class="flex items-center justify-between">
            <span class="font-label-sm text-label-sm uppercase tracking-widest text-secondary font-bold">Editorial Prompt • Vol. II</span>
            <span class="material-symbols-outlined text-secondary group-hover:scale-110 transition-transform">wb_sunny</span>
          </div>
          <h2 class="font-headline-md text-headline-md text-on-surface font-semibold">
            Typical weekend routine...
          </h2>
          <div class="bg-surface p-space-lg rounded-xl shadow-xs flex flex-col gap-space-md border border-outline-variant/20">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-space-md">
              <div class="flex flex-col gap-1 p-space-sm bg-surface-container-low rounded-lg">
                <span class="font-label-sm text-label-sm uppercase tracking-wider text-secondary font-bold">08:00 AM</span>
                <span class="font-body-md text-body-md font-semibold text-on-surface">Mountain Breeze Walk</span>
                <p class="font-body-sm text-body-sm text-on-surface-variant">Early fresh morning air through pine trees.</p>
              </div>
              <div class="flex flex-col gap-1 p-space-sm bg-surface-container-low rounded-lg">
                <span class="font-label-sm text-label-sm uppercase tracking-wider text-secondary font-bold">10:30 AM</span>
                <span class="font-body-md text-body-md font-semibold text-on-surface">Cold Brew &amp; Reading</span>
                <p class="font-body-sm text-body-sm text-on-surface-variant">Sitting by sunny window banquettes listening to jazz.</p>
              </div>
              <div class="flex flex-col gap-1 p-space-sm bg-surface-container-low rounded-lg">
                <span class="font-label-sm text-label-sm uppercase tracking-wider text-secondary font-bold">02:00 PM</span>
                <span class="font-body-md text-body-md font-semibold text-on-surface">Creative Pursuits</span>
                <p class="font-body-sm text-body-sm text-on-surface-variant">Photography &amp; journal musings until sunset.</p>
              </div>
            </div>
            <p class="font-body-md text-body-md text-on-surface italic font-serif pt-space-xs">
              Bonus points if the evening ends with quiet rooftop conversation under clear starry skies.
            </p>
          </div>
        </div>

        <!-- Mutual Connections, Passions & Sparks -->
        <div class="bg-surface-container-low p-space-xl rounded-2xl shadow-sm flex flex-col gap-space-md border border-outline-variant/30">
          <div class="flex items-center justify-between">
            <div class="flex flex-col">
              <span class="font-label-sm text-label-sm uppercase tracking-wider text-outline font-bold">Mutual Sparks</span>
              <h3 class="font-headline-sm text-headline-sm text-on-surface font-semibold">Interests &amp; Shared Passions</h3>
            </div>
            <span class="px-space-md py-space-xs rounded-full bg-secondary-container/40 text-on-secondary-container font-label-sm text-label-sm font-bold">
              Shared Affinity Tags
            </span>
          </div>
          
          <div class="flex flex-wrap gap-space-sm">
            @php
              $interestsList = !empty($targetUser->interests) ? explode(',', $targetUser->interests) : ['Specialty Coffee', 'Design & Typography', 'Mid-Century Modern', 'Vinyl Records', 'Matcha Tasting', '35mm Film', 'Acoustic Indie'];
            @endphp
            @foreach($interestsList as $interest)
              <div class="px-space-lg py-space-sm rounded-full bg-surface text-on-surface font-label-md text-label-md flex items-center gap-space-xs shadow-xs border border-outline-variant/20 font-medium">
                <span class="material-symbols-outlined text-secondary text-base">coffee_maker</span>
                <span>{{ trim($interest) }}</span>
              </div>
            @endforeach
          </div>
        </div>

        <!-- Neighborhood Map Preview Card -->
        <div class="bg-surface-container-low p-space-lg rounded-2xl shadow-sm flex flex-col gap-space-md border border-outline-variant/30">
          <div class="flex items-center justify-between">
            <div class="flex items-center gap-space-xs">
              <span class="material-symbols-outlined text-secondary">explore</span>
              <span class="font-headline-sm text-headline-sm text-on-surface font-semibold">Stomping Grounds</span>
            </div>
            <span class="font-label-md text-label-md text-secondary font-medium">{{ $targetUser->country ?? 'Himachal Pradesh' }}</span>
          </div>
          <div class="w-full h-48 bg-cover bg-center rounded-xl relative overflow-hidden shadow-xs border border-outline-variant/30" style="background-image: url('https://images.unsplash.com/photo-1501339847302-ac426a4a7cbb?w=800&q=80&fit=crop')">
            <div class="absolute inset-0 bg-primary-container/20"></div>
            <div class="absolute bottom-space-md left-space-md bg-surface/95 backdrop-blur-md px-space-md py-space-xs rounded-full font-label-md text-label-md text-on-surface shadow-md flex items-center gap-space-xs border border-outline-variant/20">
              <span class="w-2.5 h-2.5 rounded-full bg-on-tertiary-container"></span>
              <span>Partner Café: Himalayan Roastery, {{ $targetUser->country ?? 'Central Square' }}</span>
            </div>
          </div>
        </div>

      </div>

    </div>

    <!-- Floating / Sticky Action Dock for Connection & Dating -->
    <div class="sticky bottom-6 z-40 w-full max-w-4xl mx-auto mt-space-lg">
      <div class="bg-surface/90 backdrop-blur-xl p-space-md rounded-full shadow-2xl flex flex-col sm:flex-row items-center justify-between gap-space-md ring-1 ring-outline-variant/30 border border-outline-variant/20">
        
        <!-- Left: Quick Coffee Matchmaker Context -->
        <div class="flex items-center gap-space-md pl-space-sm">
          <img class="w-12 h-12 rounded-full object-cover shadow-sm ring-2 ring-surface" 
               src="{{ $targetUser->avatar_url }}" 
               alt="{{ $targetUser->full_name }}"/>
          <div class="hidden sm:flex flex-col">
            <div class="flex items-center gap-1.5">
              <span class="font-label-lg text-label-lg font-bold text-on-surface">{{ $targetUser->full_name }}, {{ $targetUser->age }}</span>
              <span class="material-symbols-outlined text-xs text-secondary" style="font-variation-settings: 'FILL' 1;">check_circle</span>
            </div>
            <span class="font-body-sm text-body-sm text-secondary font-medium">Ready for a slow coffee this weekend</span>
          </div>
        </div>

        <!-- Right: Action CTA Cluster -->
        <div class="flex items-center gap-space-sm w-full sm:w-auto justify-end">
          @if(!$isOwnProfile)
            <!-- Bookmark Button -->
            <button class="w-11 h-11 rounded-full bg-surface-container hover:bg-surface-container-high text-on-surface flex items-center justify-center transition-all shrink-0 hover:scale-105 active:scale-95 cursor-pointer shadow-xs" id="bookmark-btn" title="Save to Atelier Bookmarks">
              <span class="material-symbols-outlined text-lg" id="bookmark-icon">bookmark_border</span>
            </button>
            
            <!-- Send Note / Message Button -->
            <a href="{{ route('messages', ['user_id' => $targetUser->id]) }}" class="px-space-lg py-space-sm rounded-full bg-surface-container hover:bg-surface-container-high text-on-surface font-label-lg text-label-lg flex items-center gap-space-xs transition-all hover:scale-[1.02] active:scale-95 shadow-xs font-semibold">
              <span class="material-symbols-outlined text-base">chat_bubble_outline</span>
              <span class="hidden md:inline">Send a Note</span>
              <span class="md:hidden">Chat</span>
            </a>

            <!-- Primary Direct Coffee Invite with Calendar Shortcut -->
            <button class="px-space-xl py-space-sm rounded-full bg-on-tertiary-container hover:bg-tertiary-container text-on-tertiary font-label-lg text-label-lg flex items-center gap-space-xs transition-all shadow-md hover:shadow-lg hover:scale-[1.02] active:scale-95 font-bold cursor-pointer" id="brew-date-btn">
              <span class="material-symbols-outlined text-base">calendar_today</span>
              <span>Suggest Coffee Date</span>
            </button>
          @else
            <button onclick="openEditModal()" class="px-space-xl py-space-sm rounded-full bg-primary hover:bg-primary/90 text-on-primary font-label-lg text-label-lg flex items-center gap-space-xs transition-all shadow-md hover:scale-[1.02] font-bold cursor-pointer">
              <span class="material-symbols-outlined text-base">edit</span>
              <span>Edit Your Dossier</span>
            </button>
          @endif
        </div>

      </div>
    </div>

    <!-- Interactive Modal: Suggest Coffee Date Scheduler -->
    <div class="fixed inset-0 z-50 bg-primary-container/40 backdrop-blur-sm hidden items-center justify-center p-space-md" id="date-picker-modal">
      <div class="bg-surface max-w-lg w-full rounded-2xl p-space-xl shadow-2xl flex flex-col gap-space-lg relative animate-in fade-in zoom-in duration-200 border border-outline-variant/30">
        
        <div class="flex items-center justify-between pb-space-xs border-b border-outline-variant/20">
          <div class="flex items-center gap-space-sm">
            <div class="w-10 h-10 rounded-full bg-secondary-container/60 text-secondary flex items-center justify-center">
              <span class="material-symbols-outlined">local_cafe</span>
            </div>
            <div class="flex flex-col">
              <span class="font-headline-sm text-headline-sm font-semibold text-on-surface">Brew a Date with {{ explode(' ', $targetUser->full_name)[0] }}</span>
              <span class="font-body-sm text-body-sm text-secondary font-medium">Step 1: Pick an atelier café &amp; time</span>
            </div>
          </div>
          <button class="w-8 h-8 rounded-full bg-surface-container flex items-center justify-center text-on-surface hover:bg-surface-container-high transition-colors cursor-pointer" id="close-modal-btn">
            <span class="material-symbols-outlined text-base">close</span>
          </button>
        </div>

        <!-- Venue Selection -->
        <div class="flex flex-col gap-space-xs">
          <label class="font-label-sm text-label-sm uppercase tracking-wider text-outline font-bold">Selected Sanctuary</label>
          <div class="bg-surface-container-low p-space-md rounded-xl flex items-center justify-between border border-outline-variant/20">
            <div class="flex flex-col">
              <span class="font-body-md text-body-md font-semibold text-on-surface">The Himalayan Roastery &amp; Café</span>
              <span class="font-body-sm text-body-sm text-on-surface-variant">{{ $targetUser->country ?? 'Central District' }} • Match for “Vinyl &amp; Cortados”</span>
            </div>
            <span class="px-space-md py-space-xs rounded-full bg-surface text-secondary font-label-sm text-label-sm font-bold shadow-xs">
              {{ explode(' ', $targetUser->full_name)[0] }}’s Favorite
            </span>
          </div>
        </div>

        <!-- Day Selection Pills -->
        <div class="flex flex-col gap-space-xs">
          <label class="font-label-sm text-label-sm uppercase tracking-wider text-outline font-bold">Proposed Morning</label>
          <div class="grid grid-cols-3 gap-space-sm" id="day-pill-group">
            <button class="day-opt p-space-md rounded-xl bg-surface-container text-on-surface font-label-md text-label-md flex flex-col items-center gap-1 hover:bg-secondary-container/40 transition-colors cursor-pointer" type="button">
              <span class="font-bold">Sat, Nov 18</span>
              <span class="text-xs text-on-surface-variant">10:30 AM</span>
            </button>
            <button class="day-opt p-space-md rounded-xl bg-on-tertiary-container text-on-tertiary font-label-md text-label-md flex flex-col items-center gap-1 shadow-sm cursor-pointer" type="button">
              <span class="font-bold">Sun, Nov 19</span>
              <span class="text-xs text-on-tertiary/80">11:00 AM</span>
            </button>
            <button class="day-opt p-space-md rounded-xl bg-surface-container text-on-surface font-label-md text-label-md flex flex-col items-center gap-1 hover:bg-secondary-container/40 transition-colors cursor-pointer" type="button">
              <span class="font-bold">Tue, Nov 21</span>
              <span class="text-xs text-on-surface-variant">04:00 PM</span>
            </button>
          </div>
        </div>

        <!-- Personal Invite Note -->
        <div class="flex flex-col gap-space-xs">
          <label class="font-label-sm text-label-sm uppercase tracking-wider text-outline font-bold">Opening Dispatch</label>
          <textarea id="inviteCustomNote" class="w-full bg-surface-container-low p-space-md rounded-xl text-body-md font-body-md text-on-surface placeholder:text-outline focus:outline-none focus:bg-surface-container transition-colors resize-none border border-outline-variant/30" placeholder="I’ll pick up the warm cinnamon buns if you promise to tell me the story behind your favorite roast..." rows="3"></textarea>
        </div>

        <!-- Modal Submit Actions -->
        <div class="flex items-center justify-between pt-space-xs">
          <button class="px-space-md py-space-sm text-secondary font-label-md text-label-md hover:text-on-surface transition-colors cursor-pointer font-semibold" id="cancel-modal-btn">
            Cancel
          </button>
          <button class="px-space-xl py-space-sm rounded-full bg-on-tertiary-container text-on-tertiary font-label-lg text-label-lg hover:bg-tertiary-container transition-colors shadow-md flex items-center gap-space-xs font-bold cursor-pointer" id="confirm-invite-btn">
            <span class="material-symbols-outlined text-sm">send</span>
            <span>Send Coffee Invitation</span>
          </button>
        </div>

      </div>
    </div>

    <!-- Edit Profile Modal (for own profile) -->
    @if($isOwnProfile)
      <div id="editProfileModal" class="fixed inset-0 z-50 bg-primary-container/50 backdrop-blur-sm hidden items-center justify-center p-4">
        <div class="bg-surface max-w-xl w-full rounded-2xl p-6 sm:p-8 shadow-2xl flex flex-col gap-4 max-h-[90vh] overflow-y-auto border border-outline-variant/30">
          <div class="flex items-center justify-between pb-3 border-b border-outline-variant/20">
            <h3 class="font-headline-sm text-headline-sm font-semibold text-on-surface">Edit Atelier Dossier</h3>
            <button onclick="closeEditModal()" class="w-8 h-8 rounded-full bg-surface-container flex items-center justify-center text-on-surface hover:bg-surface-container-high transition-colors cursor-pointer">
              <span class="material-symbols-outlined text-base">close</span>
            </button>
          </div>

          <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-4">
            @csrf
            
            <input type="file" id="avatarFileInput" name="avatar_file" accept="image/*" class="hidden" onchange="previewAvatar(this)">

            <div class="flex flex-col gap-1">
              <label class="font-label-md text-label-md font-bold text-on-surface">Full Name</label>
              <input type="text" name="full_name" value="{{ $targetUser->full_name }}" required class="w-full px-4 py-2 bg-surface-container-high rounded-full font-body-md text-on-surface focus:outline-none focus:bg-surface-container">
            </div>

            <div class="flex flex-col gap-1">
              <label class="font-label-md text-label-md font-bold text-on-surface">Bio / Slow Dating Philosophy</label>
              <textarea name="bio" rows="3" class="w-full p-3 bg-surface-container-high rounded-xl font-body-md text-on-surface focus:outline-none focus:bg-surface-container resize-none">{{ $targetUser->bio }}</textarea>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
              <div class="flex flex-col gap-1">
                <label class="font-label-md text-label-md font-bold text-on-surface">Coffee Style</label>
                <select name="coffee_style" class="w-full px-4 py-2 bg-surface-container-high rounded-full font-body-md text-on-surface focus:outline-none">
                  @foreach(['Oat Milk Cortado', 'Single-Origin V60 Pour-Over', 'Espresso Macchiato', 'Cold Brew Nitro', 'Ceremonial Matcha Latte', 'Flat White (Velvet)'] as $style)
                    <option value="{{ $style }}" {{ ($targetUser->coffee_style === $style) ? 'selected' : '' }}>{{ $style }}</option>
                  @endforeach
                </select>
              </div>
              <div class="flex flex-col gap-1">
                <label class="font-label-md text-label-md font-bold text-on-surface">Home City / Roastery District</label>
                <input type="text" name="country" value="{{ $targetUser->country ?? 'Himachal Pradesh' }}" class="w-full px-4 py-2 bg-surface-container-high rounded-full font-body-md text-on-surface focus:outline-none">
              </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
              <div class="flex flex-col gap-1">
                <label class="font-label-md text-label-md font-bold text-on-surface">Gender</label>
                <select name="gender" class="w-full px-4 py-2 bg-surface-container-high rounded-full font-body-md text-on-surface focus:outline-none">
                  <option value="male" {{ $targetUser->gender === 'male' ? 'selected' : '' }}>Male</option>
                  <option value="female" {{ $targetUser->gender === 'female' ? 'selected' : '' }}>Female</option>
                  <option value="nonbinary" {{ $targetUser->gender === 'nonbinary' ? 'selected' : '' }}>Non-binary</option>
                  <option value="other" {{ $targetUser->gender === 'other' ? 'selected' : '' }}>Other</option>
                </select>
              </div>
              <div class="flex flex-col gap-1">
                <label class="font-label-md text-label-md font-bold text-on-surface">MBTI</label>
                <input type="text" name="mbti" value="{{ $targetUser->mbti ?? 'ENFP' }}" class="w-full px-4 py-2 bg-surface-container-high rounded-full font-body-md text-on-surface focus:outline-none">
              </div>
              <div class="flex flex-col gap-1">
                <label class="font-label-md text-label-md font-bold text-on-surface">Zodiac Sign</label>
                <input type="text" name="astrology" value="{{ $targetUser->astrology ?? 'Taurus' }}" class="w-full px-4 py-2 bg-surface-container-high rounded-full font-body-md text-on-surface focus:outline-none">
              </div>
            </div>

            <div class="flex flex-col gap-1">
              <label class="font-label-md text-label-md font-bold text-on-surface">Interests (Comma-separated)</label>
              <input type="text" name="interests" value="{{ $targetUser->interests ?? 'Specialty Coffee, Books, Indie Music, Photography, Traveling' }}" class="w-full px-4 py-2 bg-surface-container-high rounded-full font-body-md text-on-surface focus:outline-none">
            </div>

            <div class="pt-2 flex items-center justify-end gap-3">
              <button type="button" onclick="closeEditModal()" class="px-4 py-2 text-secondary font-label-md font-semibold hover:text-on-surface">Cancel</button>
              <button type="submit" class="px-6 py-2.5 rounded-full bg-primary text-on-primary font-label-md font-bold hover:opacity-90 shadow-sm">Save Changes ☕</button>
            </div>
          </form>
        </div>
      </div>
    @endif

    <!-- Notification Toast for Invite / Bookmark action -->
    <div class="fixed bottom-24 left-1/2 -translate-x-1/2 z-50 bg-primary-container text-inverse-on-surface px-space-xl py-space-md rounded-full shadow-2xl flex items-center gap-space-sm opacity-0 pointer-events-none transition-all duration-300 transform translate-y-4 border border-outline-variant/30" id="toast">
      <span class="material-symbols-outlined text-on-tertiary-container" id="toast-icon">check_circle</span>
      <span class="font-label-md text-label-md font-medium" id="toast-message">Invitation dispatched to {{ $targetUser->full_name }}</span>
    </div>

  </div>
</div>
@endsection

@section('extra_js')
<script>
  (function() {
    const modal = document.getElementById('date-picker-modal');
    const openBtn = document.getElementById('brew-date-btn');
    const closeBtn = document.getElementById('close-modal-btn');
    const cancelBtn = document.getElementById('cancel-modal-btn');
    const confirmBtn = document.getElementById('confirm-invite-btn');
    const bookmarkBtn = document.getElementById('bookmark-btn');
    const bookmarkIcon = document.getElementById('bookmark-icon');
    const toast = document.getElementById('toast');
    const toastMsg = document.getElementById('toast-message');
    let isBookmarked = false;

    function showToast(text, icon = 'check_circle') {
      if (!toast || !toastMsg) return;
      toastMsg.textContent = text;
      const tIcon = document.getElementById('toast-icon');
      if (tIcon) tIcon.textContent = icon;
      toast.classList.remove('opacity-0', 'pointer-events-none', 'translate-y-4');
      toast.classList.add('opacity-100', 'translate-y-0');
      setTimeout(() => {
        toast.classList.add('opacity-0', 'pointer-events-none', 'translate-y-4');
        toast.classList.remove('opacity-100', 'translate-y-0');
      }, 3500);
    }

    if (openBtn) {
      openBtn.addEventListener('click', () => {
        modal.classList.remove('hidden');
        modal.classList.add('flex');
      });
    }

    const hideModal = () => {
      if (modal) {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
      }
    };

    if (closeBtn) closeBtn.addEventListener('click', hideModal);
    if (cancelBtn) cancelBtn.addEventListener('click', hideModal);

    if (modal) {
      modal.addEventListener('click', (e) => {
        if (e.target === modal) hideModal();
      });
    }

    if (confirmBtn) {
      confirmBtn.addEventListener('click', async () => {
        hideModal();
        const customNote = document.getElementById('inviteCustomNote').value.trim() || '☕ Would love to invite you for a 45-min coffee date at our favorite roastery!';
        
        // Dispatch invitation as a message via AJAX
        try {
          const formData = new FormData();
          formData.append('_token', '{{ csrf_token() }}');
          formData.append('receiver_id', '{{ $targetUser->id }}');
          formData.append('message', customNote);

          await fetch("{{ route('api.messages.send') }}", {
            method: 'POST',
            headers: { 'X-Requested-With': 'XMLHttpRequest' },
            body: formData
          });
        } catch(e) {}

        showToast('☕ Coffee invitation sent to {{ $targetUser->full_name }}! Redirecting to chat...', 'coffee');
        setTimeout(() => {
          window.location.href = "{{ route('messages', ['user_id' => $targetUser->id]) }}";
        }, 1200);
      });
    }

    // Toggle Day Selection
    const dayPills = document.querySelectorAll('.day-opt');
    dayPills.forEach(pill => {
      pill.addEventListener('click', () => {
        dayPills.forEach(p => {
          p.classList.remove('bg-on-tertiary-container', 'text-on-tertiary', 'shadow-sm');
          p.classList.add('bg-surface-container', 'text-on-surface');
        });
        pill.classList.remove('bg-surface-container', 'text-on-surface');
        pill.classList.add('bg-on-tertiary-container', 'text-on-tertiary', 'shadow-sm');
      });
    });

    // Bookmark Toggle
    if (bookmarkBtn) {
      bookmarkBtn.addEventListener('click', () => {
        isBookmarked = !isBookmarked;
        if (isBookmarked) {
          bookmarkIcon.textContent = 'bookmark';
          bookmarkIcon.style.fontVariationSettings = "'FILL' 1";
          bookmarkBtn.classList.add('text-on-tertiary-container');
          showToast('{{ $targetUser->full_name }} saved to your Atelier Bookmarks', 'bookmark_added');
        } else {
          bookmarkIcon.textContent = 'bookmark_border';
          bookmarkIcon.style.fontVariationSettings = "'FILL' 0";
          bookmarkBtn.classList.remove('text-on-tertiary-container');
          showToast('Removed from Bookmarks', 'delete');
        }
      });
    }
  })();

  function openEditModal() {
    const modal = document.getElementById('editProfileModal');
    if (modal) {
      modal.classList.remove('hidden');
      modal.classList.add('flex');
    }
  }

  function closeEditModal() {
    const modal = document.getElementById('editProfileModal');
    if (modal) {
      modal.classList.add('hidden');
      modal.classList.remove('flex');
    }
  }

  function previewAvatar(input) {
    if (input.files && input.files[0]) {
      const reader = new FileReader();
      reader.onload = function(e) {
        const img = document.getElementById('mainProfileImg');
        if (img) img.src = e.target.result;
      };
      reader.readAsDataURL(input.files[0]);
    }
  }
</script>
@endsection
