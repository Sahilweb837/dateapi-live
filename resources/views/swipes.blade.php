@extends('layouts.app')

@section('title', 'Discover Deck & Daily Cupping — CupDate')
@section('meta_desc', 'Explore curated introductions, thoughtful dossiers, and neighborhood coffee date spots on CupDate Atelier.')

@section('extra_css')
<style>
  /* Custom smooth styles for swipe deck */
  .polaroid-frame {
    transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
  }
  .polaroid-frame:hover {
    transform: translateY(-4px) rotate(1deg);
  }
  .waveform-bar {
    transition: height 0.25s ease;
  }
  .waveform-playing .waveform-bar {
    animation: wavePulse 0.85s ease-in-out infinite alternate;
  }
  @keyframes wavePulse {
    0% { height: 18%; }
    100% { height: 100%; }
  }

  /* Smooth pointer drag & touch gesture physics */
  #activeDossierCard {
    touch-action: pan-y;
    -webkit-user-select: none;
    user-select: none;
    cursor: grab;
    will-change: transform, opacity;
  }
  #activeDossierCard.is-dragging {
    cursor: grabbing !important;
  }
  #activeDossierCard.is-animating {
    transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.2), opacity 0.3s ease !important;
  }
</style>
@endsection

@section('content')
<div class="flex flex-col w-full bg-surface min-h-screen">
  <!-- Subtle Ambient Glow -->
  <div class="relative w-full max-w-[1360px] mx-auto px-3 sm:px-space-md lg:px-margin-desktop py-4 sm:py-space-lg">
    
    <!-- Top Deck Utility Bar -->
    <div class="flex flex-col gap-space-md pb-space-lg border-b border-outline-variant/30 mb-6">
      <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-space-md">
        
        <div class="flex items-center gap-space-md">
          <div class="w-11 h-11 rounded-full bg-surface-container flex items-center justify-center text-secondary shadow-sm">
            <span class="material-symbols-outlined text-xl">auto_stories</span>
          </div>
          <div class="flex flex-col">
            <div class="flex items-center gap-space-xs">
              <span class="font-label-sm text-label-sm uppercase tracking-wider text-secondary font-bold">Daily Cupping</span>
              <span class="w-1.5 h-1.5 rounded-full bg-secondary-container"></span>
              <span class="font-label-sm text-label-sm text-on-surface-variant/80">Batch No. {{ date('z') + 101 }}</span>
            </div>
            <div class="flex items-baseline gap-space-xs">
              <span class="font-headline-sm text-headline-sm text-on-surface font-semibold" id="dossierCounterText">Dossier 01</span>
              <span class="font-body-sm text-body-sm text-on-surface-variant" id="dossierTotalText">of {{ max($deckData->count(), 1) }} Daily Curated Introductions</span>
            </div>
          </div>
        </div>

        <div class="flex flex-col sm:flex-row sm:items-center gap-space-sm sm:gap-space-lg bg-surface-container-low px-space-md py-space-xs rounded-full shadow-sm">
          <div class="flex items-center gap-1.5" id="progressPillsContainer">
            @for($i = 0; $i < min(max($deckData->count(), 8), 12); $i++)
              <span class="progress-pill w-3.5 h-1.5 rounded-full {{ $i === 0 ? 'bg-on-tertiary-container ring-1 ring-on-tertiary-container' : 'bg-surface-container-highest' }} transition-all"></span>
            @endfor
          </div>
          <div class="flex items-center gap-space-xs text-on-surface-variant font-label-md text-label-md">
            <span class="material-symbols-outlined text-base text-secondary">hourglass_top</span>
            <span>Refreshes at <strong class="text-on-surface font-semibold">12:00 PM</strong> <span class="text-xs text-on-surface-variant" id="countdownClock">(Daily Batch Active)</span></span>
          </div>
        </div>

        <div class="flex items-center self-start sm:self-auto bg-surface-container-low p-1 rounded-full shadow-inner">
          <button class="flex items-center gap-space-xs px-space-md py-1.5 rounded-full bg-surface shadow-sm text-on-surface font-label-md text-label-md transition-all cursor-pointer" id="modeDeckBtn">
            <span class="material-symbols-outlined text-base text-secondary">style</span>
            <span>Deck Swipe</span>
          </button>
          <button class="flex items-center gap-space-xs px-space-md py-1.5 rounded-full text-on-surface-variant hover:text-on-surface font-label-md text-label-md transition-all cursor-pointer" id="modeGridBtn">
            <span class="material-symbols-outlined text-base">grid_view</span>
            <span>Curated Grid</span>
          </button>
        </div>
      </div>

      <!-- Filter Pills Carousel -->
      <div class="flex items-center justify-between gap-space-md overflow-x-auto pb-1 scrollbar-none">
        <div class="flex items-center gap-space-xs flex-nowrap" id="filterPillsContainer">
          <button data-filter="all" class="filter-pill flex items-center gap-space-xs px-space-md py-1.5 rounded-full bg-secondary text-surface font-label-md text-label-md shrink-0 cursor-pointer shadow-sm font-semibold transition-all">
            <span class="material-symbols-outlined text-base">apps</span>
            <span>All Dossiers</span>
          </button>
          <button data-filter="romance" class="filter-pill flex items-center gap-space-xs px-space-md py-1.5 rounded-full bg-surface-container text-on-surface font-label-md text-label-md hover:bg-surface-container-high transition-colors shrink-0 cursor-pointer">
            <span class="material-symbols-outlined text-base text-secondary">favorite</span>
            <span>Intent: <strong>Lifelong Romance</strong></span>
          </button>
          <button data-filter="coffee" class="filter-pill flex items-center gap-space-xs px-space-md py-1.5 rounded-full bg-surface-container text-on-surface font-label-md text-label-md hover:bg-surface-container-high transition-colors shrink-0 cursor-pointer">
            <span class="material-symbols-outlined text-base text-secondary">local_cafe</span>
            <span>Coffee: <strong>Pour-over &amp; Cortado</strong></span>
          </button>
          <button data-filter="verified" class="filter-pill flex items-center gap-space-xs px-space-md py-1.5 rounded-full bg-surface-container text-on-surface font-label-md text-label-md hover:bg-surface-container-high transition-colors shrink-0 cursor-pointer">
            <span class="material-symbols-outlined text-base text-secondary">verified</span>
            <span>Verified <strong>Daters Only</strong></span>
          </button>
          <button data-filter="synergy" class="filter-pill flex items-center gap-space-xs px-space-md py-1.5 rounded-full bg-surface-container text-on-surface font-label-md text-label-md hover:bg-surface-container-high transition-colors shrink-0 cursor-pointer">
            <span class="material-symbols-outlined text-base text-secondary">bolt</span>
            <span>Synergy: <strong>95%+ Chemistry</strong></span>
          </button>
        </div>
        <a href="{{ route('profile') }}" class="hidden md:flex items-center gap-space-xs px-space-md py-1.5 rounded-full bg-surface-container-low hover:bg-surface-container text-secondary hover:text-on-surface font-label-md text-label-md shrink-0 transition-colors">
          <span class="material-symbols-outlined text-base">tune</span>
          <span>Refine Profile</span>
        </a>
      </div>
    </div>

    <!-- MAIN ATELIER SECTION (Deck View) -->
    <div id="deckViewContainer" class="grid grid-cols-1 lg:grid-cols-12 gap-gutter-lg items-start">
      
      <!-- LEFT & CENTER: Dating Deck Stack (8 cols) -->
      <div class="lg:col-span-8 flex flex-col items-center relative">
        
        <!-- Interactive Card Stack Outer -->
        <div class="relative w-full max-w-[680px] min-h-[820px] flex justify-center" id="cardStackOuter">
          
          <!-- Background Deck Card 2 (Bottom) -->
          <div class="absolute top-6 w-[91%] h-[780px] rounded-lg bg-surface-container-highest/60 -rotate-2 scale-[0.96] shadow-sm transform transition-transform pointer-events-none" id="deckBgCard2"></div>
          
          <!-- Background Deck Card 1 (Middle) -->
          <div class="absolute top-3 w-[95%] h-[795px] rounded-lg bg-surface-container-high/90 rotate-1 scale-[0.98] shadow-md transform transition-transform pointer-events-none flex flex-col justify-end p-space-lg" id="deckBgCard1">
            <div class="flex items-center justify-between text-on-surface/50">
              <div class="flex items-center gap-space-xs">
                <span class="w-2 h-2 rounded-full bg-secondary"></span>
                <span class="font-headline-sm text-headline-sm" id="bgNextName">Up Next in Deck</span>
              </div>
              <span class="font-label-md text-label-md uppercase tracking-wider font-semibold text-secondary">Next in Deck</span>
            </div>
          </div>

          <!-- Active Dossier Card (Top) -->
          <div class="relative w-full rounded-lg bg-surface-container-lowest shadow-[0_12px_44px_-8px_rgba(35,26,21,0.08)] overflow-hidden transform" id="activeDossierCard">
            
            <!-- Floating Visual Stamps for Interaction -->
            <div class="absolute top-12 left-8 z-30 pointer-events-none border-4 border-emerald-600 bg-emerald-950/40 backdrop-blur-md text-emerald-400 font-extrabold tracking-widest text-xl sm:text-2xl px-5 py-2.5 rounded-xl rotate-[-15deg] opacity-0 shadow-xl transition-opacity duration-150" id="likeStamp">INVITE TO DATE</div>
            <div class="absolute top-12 right-8 z-30 pointer-events-none border-4 border-rose-600 bg-rose-950/40 backdrop-blur-md text-rose-400 font-extrabold tracking-widest text-xl sm:text-2xl px-5 py-2.5 rounded-xl rotate-[15deg] opacity-0 shadow-xl transition-opacity duration-150" id="passStamp">POLITE DEFER</div>

            <!-- Hero Photo Portrait with Carousel -->
            <div class="relative w-full h-[470px] sm:h-[510px] overflow-hidden bg-surface-container group select-none" id="photoArea">
              <img alt="Portrait" draggable="false" class="w-full h-full object-cover object-center transform hover:scale-[1.02] transition-transform duration-700 pointer-events-none" id="heroPhotoImg" src=""/>
              
              <div class="absolute inset-0 bg-gradient-to-t from-primary-container/95 via-primary-container/30 to-transparent pointer-events-none"></div>
              <div class="absolute inset-0 bg-gradient-to-b from-primary-container/40 via-transparent to-transparent pointer-events-none"></div>

              <!-- Carousel Prev / Next Buttons -->
              <button type="button" aria-label="Previous photo" class="absolute left-3 top-1/2 -translate-y-1/2 w-10 h-10 rounded-full bg-surface/85 backdrop-blur-md text-on-surface flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity hover:bg-surface cursor-pointer z-20 shadow-md" id="prevPhotoBtn">
                <span class="material-symbols-outlined text-xl">chevron_left</span>
              </button>
              <button type="button" aria-label="Next photo" class="absolute right-3 top-1/2 -translate-y-1/2 w-10 h-10 rounded-full bg-surface/85 backdrop-blur-md text-on-surface flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity hover:bg-surface cursor-pointer z-20 shadow-md" id="nextPhotoBtn">
                <span class="material-symbols-outlined text-xl">chevron_right</span>
              </button>

              <!-- Carousel Dots Indicator -->
              <div class="absolute top-3 left-0 right-0 flex justify-center gap-1.5 z-20 pointer-events-none" id="photoDotsContainer">
                <span class="photo-dot w-6 h-1.5 rounded-full bg-surface transition-all"></span>
                <span class="photo-dot w-2 h-1.5 rounded-full bg-surface/40 transition-all"></span>
                <span class="photo-dot w-2 h-1.5 rounded-full bg-surface/40 transition-all"></span>
              </div>

              <!-- Verified Status & Synergy Badges Top -->
              <div class="absolute top-space-md left-space-md right-space-md flex items-center justify-between gap-space-sm pt-2 z-20 pointer-events-none">
                <div class="flex items-center gap-space-xs px-3 py-1.5 rounded-full bg-surface-container-lowest/85 backdrop-blur-md shadow-sm" id="verifiedBadgeWrapper">
                  <span class="material-symbols-outlined text-secondary text-base" style="font-variation-settings: 'FILL' 1;">verified</span>
                  <span class="font-label-sm text-label-sm text-on-surface uppercase tracking-wider font-bold">Identity &amp; Voice Verified</span>
                </div>
                <div class="flex items-center gap-space-xs px-3 py-1.5 rounded-full bg-tertiary-container/80 backdrop-blur-md text-tertiary-fixed font-label-sm text-label-sm shadow-sm">
                  <span class="material-symbols-outlined text-sm text-on-tertiary-container">favorite</span>
                  <span class="font-semibold text-surface tracking-wide" id="synergyScoreText">98% Chemistry Synergy</span>
                </div>
              </div>

              <!-- Identity & Moniker Overlay Bottom -->
              <div class="absolute bottom-space-md left-space-md right-space-md flex flex-col gap-space-xs text-on-primary z-20 pointer-events-none">
                <div class="flex items-center gap-space-sm flex-wrap">
                  <span class="px-2.5 py-0.5 rounded-full bg-on-tertiary-container text-on-tertiary font-label-sm text-label-sm font-semibold">Lifelong Romance</span>
                  <span class="px-2.5 py-0.5 rounded-full bg-surface/20 backdrop-blur-md text-surface font-label-sm text-label-sm flex items-center gap-1">
                    <span class="material-symbols-outlined text-xs">shield</span>Zero Ghosting Covenant
                  </span>
                  <span class="px-2 py-0.5 rounded-full bg-surface-container-high/80 text-on-surface font-label-sm text-label-sm font-medium">
                    <span id="photoIndexDisplay">1 / 3</span> Photos
                  </span>
                </div>

                <div class="flex items-baseline gap-space-sm pt-space-xs">
                  <h2 class="font-headline-lg text-headline-lg font-semibold tracking-tight text-surface drop-shadow-sm" id="profileNameHeading">Elena Vance</h2>
                  <span class="font-headline-sm text-headline-sm text-surface/90 font-normal" id="profileAgeSpan">28</span>
                </div>
                
                <p class="font-body-md text-body-md text-surface/90 flex items-center gap-space-xs truncate">
                  <span class="material-symbols-outlined text-base text-secondary-fixed shrink-0">location_on</span>
                  <span id="profileLocationText" class="truncate">Kangra, Himachal Pradesh</span>
                  <span class="opacity-40">•</span>
                  <span id="profileOccupationText" class="truncate">Architectural Restorer</span>
                </p>
              </div>
            </div>

            <!-- Editorial Dossier Details -->
            <div class="p-space-lg sm:p-space-xl flex flex-col gap-space-xl bg-surface-container-lowest select-text">
              
              <!-- Courtship Intent Blockquote -->
              <div class="relative bg-surface-container-low p-space-lg rounded-DEFAULT flex flex-col gap-space-sm shadow-sm">
                <div class="flex items-center justify-between">
                  <span class="font-label-sm text-label-sm uppercase tracking-widest text-secondary font-bold flex items-center gap-1.5">
                    <span class="material-symbols-outlined text-sm">filter_vintage</span>Courtship Intent
                  </span>
                  <span class="text-xs font-label-sm text-on-surface-variant font-medium">Clear &amp; Intentional</span>
                </div>
                <blockquote class="font-headline-md text-headline-md italic text-on-surface font-normal leading-snug" id="profileBioQuote">
                  “Searching for thoughtful silence over morning chemex, long Sunday walks through botanical glasshouses, and enduring devotion.”
                </blockquote>
              </div>

              <!-- Voice Memo Player with Web Audio Chimes -->
              <div class="bg-surface-container p-space-md rounded-DEFAULT flex flex-col gap-space-sm">
                <div class="flex items-center justify-between">
                  <div class="flex items-center gap-space-xs text-on-surface font-label-md text-label-md">
                    <span class="material-symbols-outlined text-on-tertiary-container text-base">mic</span>
                    <span class="font-semibold">Voice Memo · 0:28</span>
                  </div>
                  <span class="text-xs font-label-sm text-secondary font-semibold">Recorded this morning</span>
                </div>
                <p class="font-body-sm text-body-sm text-on-surface-variant italic">“My philosophy on unhurried Sunday dates…”</p>
                <div class="flex items-center gap-space-md pt-space-xs">
                  <button type="button" class="w-11 h-11 rounded-full bg-on-tertiary-container text-on-tertiary flex items-center justify-center shrink-0 shadow-md hover:opacity-95 active:scale-95 transition-all cursor-pointer" id="voicePlayBtn" title="Play Voice Memo">
                    <span class="material-symbols-outlined text-2xl" id="voicePlayIcon">play_arrow</span>
                  </button>
                  <div class="flex-1 flex items-center gap-1 h-8 px-space-xs" id="waveformContainer">
                    <span class="waveform-bar w-1 h-3 bg-secondary rounded-full"></span>
                    <span class="waveform-bar w-1 h-6 bg-secondary rounded-full"></span>
                    <span class="waveform-bar w-1 h-8 bg-on-tertiary-container rounded-full"></span>
                    <span class="waveform-bar w-1 h-5 bg-secondary rounded-full"></span>
                    <span class="waveform-bar w-1 h-7 bg-on-tertiary-container rounded-full"></span>
                    <span class="waveform-bar w-1 h-4 bg-secondary rounded-full"></span>
                    <span class="waveform-bar w-1 h-6 bg-surface-container-highest rounded-full"></span>
                    <span class="waveform-bar w-1 h-5 bg-secondary rounded-full"></span>
                    <span class="waveform-bar w-1 h-8 bg-on-tertiary-container rounded-full"></span>
                    <span class="waveform-bar w-1 h-4 bg-secondary rounded-full"></span>
                    <span class="waveform-bar w-1 h-6 bg-surface-container-highest rounded-full"></span>
                    <span class="waveform-bar w-1 h-3 bg-surface-container-highest rounded-full"></span>
                    <span class="waveform-bar w-1 h-5 bg-surface-container-highest rounded-full"></span>
                    <span class="waveform-bar w-1 h-7 bg-surface-container-highest rounded-full"></span>
                    <span class="waveform-bar w-1 h-4 bg-surface-container-highest rounded-full"></span>
                    <span class="waveform-bar w-1 h-2 bg-surface-container-highest rounded-full"></span>
                    <span class="waveform-bar w-1 h-5 bg-surface-container-highest rounded-full"></span>
                    <span class="waveform-bar w-1 h-6 bg-surface-container-highest rounded-full"></span>
                    <span class="waveform-bar w-1 h-4 bg-surface-container-highest rounded-full"></span>
                    <span class="waveform-bar w-1 h-2 bg-surface-container-highest rounded-full"></span>
                  </div>
                  <span class="font-label-sm text-label-sm text-on-surface-variant tabular-nums font-mono" id="voiceTimer">0:00 / 0:28</span>
                </div>
              </div>

              <!-- Dating Pillars & Values Tags -->
              <div class="flex flex-col gap-space-sm">
                <div class="flex items-center gap-space-xs text-secondary font-label-sm text-label-sm uppercase tracking-wider font-bold">
                  <span class="material-symbols-outlined text-sm">loyalty</span>
                  <span>Dating Pillars &amp; Values</span>
                </div>
                <div class="flex flex-wrap gap-space-xs" id="pillarsTagsContainer">
                  <span class="px-3 py-1.5 rounded-full bg-surface-container-low text-on-surface font-label-md text-label-md flex items-center gap-1.5">
                    <span class="material-symbols-outlined text-sm text-on-tertiary-container">favorite_border</span>Lifelong Partner
                  </span>
                  <span class="px-3 py-1.5 rounded-full bg-surface-container-low text-on-surface font-label-md text-label-md flex items-center gap-1.5">
                    <span class="material-symbols-outlined text-sm text-secondary">chat_bubble_outline</span>Words of Affirmation
                  </span>
                  <span class="px-3 py-1.5 rounded-full bg-surface-container-low text-on-surface font-label-md text-label-md flex items-center gap-1.5">
                    <span class="material-symbols-outlined text-sm text-secondary">local_cafe</span>Early Morning Roasts
                  </span>
                  <span class="px-3 py-1.5 rounded-full bg-surface-container-low text-on-surface font-label-md text-label-md flex items-center gap-1.5">
                    <span class="material-symbols-outlined text-sm text-secondary">palette</span>Quiet Aesthetics
                  </span>
                  <span class="px-3 py-1.5 rounded-full bg-surface-container-low text-on-surface font-label-md text-label-md flex items-center gap-1.5">
                    <span class="material-symbols-outlined text-sm text-secondary">handshake</span>Zero Ghosting Covenant
                  </span>
                </div>
              </div>

              <!-- The First Date Sanctuary Choice -->
              <div class="p-space-lg rounded-DEFAULT bg-surface-container-high flex flex-col gap-space-md">
                <div class="flex items-center justify-between">
                  <span class="font-label-sm text-label-sm uppercase tracking-wider text-secondary font-bold flex items-center gap-1.5">
                    <span class="material-symbols-outlined text-sm">coffee</span>The First Date Sanctuary
                  </span>
                  <span class="px-2 py-0.5 rounded-full bg-secondary-fixed text-on-secondary-fixed text-xs font-label-sm font-semibold">Table 04 Reserved</span>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-space-md">
                  <div class="flex flex-col gap-0.5">
                    <span class="font-label-sm text-label-sm text-on-surface-variant">Sanctuary Choice</span>
                    <span class="font-body-md text-body-md text-on-surface font-medium" id="sanctuarySpotName">The Himalayan Roastery &amp; Café</span>
                  </div>
                  <div class="flex flex-col gap-0.5">
                    <span class="font-label-sm text-label-sm text-on-surface-variant">Signature Cup</span>
                    <span class="font-body-md text-body-md text-on-surface font-medium" id="sanctuaryCupName">Single-Origin Chemex &amp; Cortado</span>
                  </div>
                  <div class="flex flex-col gap-0.5">
                    <span class="font-label-sm text-label-sm text-on-surface-variant">Preferred Daylight Hour</span>
                    <span class="font-body-md text-body-md text-on-surface font-medium">10:15 AM Daylight</span>
                  </div>
                </div>
              </div>

              <!-- 35mm Candid Moments Polaroid Gallery -->
              <div class="flex flex-col gap-space-sm">
                <div class="flex items-center justify-between">
                  <span class="font-label-sm text-label-sm uppercase tracking-wider text-secondary font-bold">35mm Candid Moments · Polaroid Gallery</span>
                  <span class="font-label-sm text-label-sm text-on-surface-variant">Tap to inspect</span>
                </div>
                <div class="grid grid-cols-3 gap-space-sm" id="candidPolaroidsGrid">
                  <button type="button" class="p-1.5 bg-surface-container-lowest rounded shadow-sm flex flex-col gap-1 polaroid-frame text-left cursor-pointer hover:shadow-md transition" onclick="selectCandidPhoto(0)">
                    <div class="rounded overflow-hidden bg-surface-container h-28">
                      <img id="candidImg0" alt="Sunday Chemex" class="w-full h-full object-cover" src="https://images.unsplash.com/photo-1517841905240-472988babdf9?w=400&q=80&fit=crop"/>
                    </div>
                    <span id="candidLabel0" class="text-[10px] font-label-sm text-on-surface-variant text-center truncate">Sunday Chemex</span>
                  </button>
                  <button type="button" class="p-1.5 bg-surface-container-lowest rounded shadow-sm flex flex-col gap-1 polaroid-frame text-left cursor-pointer hover:shadow-md transition" onclick="selectCandidPhoto(1)">
                    <div class="rounded overflow-hidden bg-surface-container h-28">
                      <img id="candidImg1" alt="Conservatory walk" class="w-full h-full object-cover" src="https://images.unsplash.com/photo-1492562080023-ab3db95bfbce?w=400&q=80&fit=crop"/>
                    </div>
                    <span id="candidLabel1" class="text-[10px] font-label-sm text-on-surface-variant text-center truncate">Glasshouse Trail</span>
                  </button>
                  <button type="button" class="p-1.5 bg-surface-container-lowest rounded shadow-sm flex flex-col gap-1 polaroid-frame text-left cursor-pointer hover:shadow-md transition" onclick="selectCandidPhoto(2)">
                    <div class="rounded overflow-hidden bg-surface-container h-28">
                      <img id="candidImg2" alt="Vinyl records" class="w-full h-full object-cover" src="https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?w=400&q=80&fit=crop"/>
                    </div>
                    <span id="candidLabel2" class="text-[10px] font-label-sm text-on-surface-variant text-center truncate">Vinyl Archivist</span>
                  </button>
                </div>
              </div>

            </div>
          </div>

          <!-- Batch Complete / Empty Deck View (Shown when batch completed) -->
          <div class="relative w-full max-w-[680px] min-h-[500px] hidden flex-col items-center justify-center p-8 bg-surface-container-lowest rounded-2xl shadow-xl text-center border border-outline-variant/30" id="emptyDeckContainer">
            <div class="w-20 h-20 rounded-full bg-rose-50 border border-rose-200 flex items-center justify-center mb-4 text-3xl">
              ☕
            </div>
            <span class="text-xs font-mono uppercase tracking-widest text-secondary font-bold px-3 py-1 rounded-full bg-surface-container mb-2">
              Daily Cupping Batch Complete
            </span>
            <h3 class="text-2xl font-bold font-headline-sm text-on-surface">You're All Caught Up For Today!</h3>
            <p class="text-sm text-on-surface-variant max-w-md mt-2 mb-6">
              You've reviewed all curated introductions in this batch. New introductions arrive daily at 12:00 PM.
            </p>
            <div class="flex items-center gap-3 flex-wrap justify-center">
              <button type="button" id="reshuffleBatchBtn" class="px-6 py-3 rounded-full bg-on-tertiary-container text-on-tertiary font-bold text-xs uppercase tracking-wider shadow-md hover:opacity-95 transition cursor-pointer flex items-center gap-2">
                <span class="material-symbols-outlined text-base">refresh</span>
                <span>Review Batch Again</span>
              </button>
              <button type="button" onclick="switchMode('grid')" class="px-5 py-3 rounded-full bg-surface-container hover:bg-surface-container-high text-on-surface font-semibold text-xs transition cursor-pointer flex items-center gap-2">
                <span class="material-symbols-outlined text-base">grid_view</span>
                <span>Browse Curated Grid</span>
              </button>
            </div>
          </div>

        </div>

        <!-- Floating Fluid Swipe & Decision Controller Bar -->
        <div class="w-full max-w-[620px] sticky bottom-6 mt-space-lg z-30" id="deckActionBar">
          <div class="bg-surface/90 backdrop-blur-xl p-space-sm sm:p-space-md rounded-full shadow-[0_8px_32px_rgba(35,26,21,0.12)] border border-outline-variant/30 flex items-center justify-between gap-space-sm">
            
            <div class="flex items-center gap-1.5">
              <!-- Pass / Defer -->
              <button class="w-14 h-14 rounded-full bg-surface-container-high hover:bg-surface-dim text-on-surface-variant hover:text-on-surface flex items-center justify-center transition-all shadow-sm hover:scale-105 active:scale-95 group relative cursor-pointer" id="deferBtn" title="Pass / Defer Profile (Left Swipe or ←)">
                <span class="material-symbols-outlined text-2xl">close</span>
                <span class="absolute -bottom-2 text-[10px] font-mono px-1 rounded bg-surface-container text-on-surface-variant opacity-80">←</span>
              </button>
              
              <!-- Rewind / Undo -->
              <button class="w-10 h-10 rounded-full bg-surface-container-low hover:bg-surface-container text-on-surface-variant/70 hover:text-on-surface flex items-center justify-center transition-all shadow-sm cursor-pointer" id="rewindBtn" title="Rewind / Undo">
                <span class="material-symbols-outlined text-lg">undo</span>
              </button>
            </div>

            <!-- Send Rose & Personal Note -->
            <button class="flex items-center gap-space-xs px-space-md py-3 rounded-full bg-secondary-container hover:bg-secondary-fixed text-on-secondary-fixed font-label-md text-label-md font-semibold transition-all shadow-sm hover:scale-[1.02] active:scale-95 cursor-pointer" id="superRoseBtn">
              <span class="material-symbols-outlined text-lg text-secondary">local_florist</span>
              <span class="hidden sm:inline">Send Rose &amp; Personal Note</span>
            </button>

            <!-- Invite to Date -->
            <button class="flex items-center gap-space-xs px-space-lg py-3.5 rounded-full bg-on-tertiary-container hover:opacity-95 text-on-tertiary font-label-md text-label-md font-semibold transition-all shadow-[0_4px_16px_rgba(214,91,108,0.3)] hover:scale-105 active:scale-95 relative cursor-pointer" id="inviteCoffeeBtn" title="Invite to Date (Right Swipe or →)">
              <span class="material-symbols-outlined text-xl">local_cafe</span>
              <span>Invite to Date</span>
              <span class="text-[10px] font-mono px-1 rounded bg-black/20 text-on-tertiary ml-1">→</span>
            </button>
          </div>

          <div class="hidden sm:flex items-center justify-center gap-space-md pt-2 text-on-surface-variant/70 font-label-sm text-label-sm">
            <span class="flex items-center gap-1"><kbd class="px-1.5 py-0.5 rounded bg-surface-container font-mono text-[10px]">←</kbd> Drag Left to Pass</span>
            <span>•</span>
            <span class="flex items-center gap-1"><kbd class="px-1.5 py-0.5 rounded bg-surface-container font-mono text-[10px]">Space</kbd> Voice Note</span>
            <span>•</span>
            <span class="flex items-center gap-1"><kbd class="px-1.5 py-0.5 rounded bg-surface-container font-mono text-[10px]">→</kbd> Drag Right to Invite</span>
          </div>
        </div>

      </div>

      <!-- RIGHT SIDEBAR: Chemistry Radar & Daylight Sparks (4 cols) -->
      <div class="lg:col-span-4 flex flex-col gap-space-lg w-full">
        
        <!-- Admirers Waiting -->
        <div class="bg-surface-container-low p-space-lg rounded-lg flex flex-col gap-space-md shadow-sm border border-outline-variant/30">
          <div class="flex items-center justify-between">
            <div class="flex items-center gap-space-xs">
              <span class="material-symbols-outlined text-on-tertiary-container text-lg">favorite</span>
              <span class="font-headline-sm text-headline-sm text-on-surface">Admirers Waiting</span>
            </div>
            <span class="px-2.5 py-0.5 rounded-full bg-on-tertiary-container text-on-tertiary font-label-sm text-label-sm font-bold">
              {{ $admirers->count() }}
            </span>
          </div>
          <p class="font-body-sm text-body-sm text-on-surface-variant">
            Singles who have sent a rose or note to your monograph.
          </p>
          <div class="flex flex-col gap-space-sm">
            @forelse($admirers as $adm)
              <div class="p-space-sm rounded-DEFAULT bg-surface flex items-center justify-between gap-space-sm shadow-sm hover:bg-surface-container-lowest transition-colors cursor-pointer" onclick="jumpToProfile({{ $adm->id }})">
                <div class="flex items-center gap-space-sm min-w-0">
                  <div class="w-12 h-12 rounded-full overflow-hidden shrink-0 bg-surface-container ring-1 ring-outline-variant/30">
                    <img alt="{{ $adm->full_name }}" class="w-full h-full object-cover" src="{{ $adm->avatar_url }}"/>
                  </div>
                  <div class="flex flex-col min-w-0">
                    <span class="font-label-md text-label-md text-on-surface font-semibold truncate">{{ $adm->full_name }}@if($adm->age), {{ $adm->age }}@endif</span>
                    <span class="font-body-sm text-body-sm text-on-surface-variant truncate">Sent a Rose • “Loved your coffee style…”</span>
                  </div>
                </div>
                <button type="button" class="px-2.5 py-1 rounded-full bg-secondary-container text-on-secondary-fixed font-label-sm text-label-sm font-semibold hover:bg-secondary-fixed transition-colors shrink-0 cursor-pointer">
                  Review
                </button>
              </div>
            @empty
              <p class="text-xs text-on-surface-variant py-2">No new admirers today. Browse the deck below!</p>
            @endforelse
          </div>
        </div>

        <!-- Sanctuary Table Perk of the Day -->
        <div class="bg-surface-container-high p-space-lg rounded-lg flex flex-col gap-space-md shadow-sm border border-outline-variant/30">
          <div class="flex items-center justify-between">
            <span class="font-label-sm text-label-sm uppercase tracking-wider text-secondary font-bold flex items-center gap-1">
              <span class="material-symbols-outlined text-sm">storefront</span>Sanctuary Perk of the Day
            </span>
            <span class="px-2 py-0.5 rounded-full bg-secondary-fixed text-on-secondary-fixed font-label-sm text-label-sm font-semibold">Reserved</span>
          </div>
          <div class="rounded-DEFAULT overflow-hidden relative h-36 bg-surface-container">
            <img alt="The Himalayan Roastery" class="w-full h-full object-cover" src="https://images.unsplash.com/photo-1501339847302-ac426a4a7cbb?w=600&q=80&fit=crop"/>
            <div class="absolute inset-0 bg-gradient-to-t from-primary/80 via-primary/20 to-transparent flex items-end p-space-sm">
              <div class="text-surface flex flex-col">
                <span class="font-label-md text-label-md font-semibold text-white">The Himalayan Roastery · Atelier</span>
                <span class="text-xs text-surface-variant">Table 04 (Quiet Botanical Nook)</span>
              </div>
            </div>
          </div>
          <p class="font-body-sm text-body-sm text-on-surface-variant">
            Complimentary companion pour-over reserved for CupDate pairs upon confirmed date match.
          </p>
          <div class="flex items-center justify-between pt-space-xs font-label-md text-label-md">
            <span class="text-secondary font-medium">Verified Partner Venue</span>
            <a href="{{ route('dates') }}" class="text-on-surface font-semibold hover:text-secondary flex items-center gap-0.5">
              <span>View Roasteries</span>
              <span class="material-symbols-outlined text-sm">open_in_new</span>
            </a>
          </div>
        </div>

        <!-- Conversation Spark -->
        <div class="bg-surface-container-low p-space-lg rounded-lg flex flex-col gap-space-md shadow-sm border border-outline-variant/30">
          <div class="flex items-center justify-between">
            <div class="flex items-center gap-space-xs text-on-surface">
              <span class="material-symbols-outlined text-secondary text-lg">lightbulb</span>
              <span class="font-headline-sm text-headline-sm">Conversation Spark</span>
            </div>
            <button class="text-on-surface-variant hover:text-on-surface cursor-pointer p-1 rounded-full hover:bg-surface-container transition" id="shuffleSparkBtn" title="Shuffle prompt">
              <span class="material-symbols-outlined text-lg">refresh</span>
            </button>
          </div>
          <div class="p-space-md rounded-DEFAULT bg-surface text-on-surface flex flex-col gap-space-xs border border-outline-variant/20">
            <span class="font-label-sm text-label-sm uppercase tracking-wider text-secondary font-bold">Rotating Thoughtful Question</span>
            <p class="font-body-md text-body-md italic text-on-surface font-normal" id="promptSparkText">
              “What is a piece of art or architecture that completely changed your worldview?”
            </p>
          </div>
          <button class="w-full py-2.5 rounded-full bg-surface-container-high hover:bg-surface-container text-on-surface font-label-md text-label-md font-semibold transition-colors flex items-center justify-center gap-space-xs cursor-pointer" id="usePromptBtn">
            <span class="material-symbols-outlined text-base">edit_note</span>
            <span>Attach to Invitation Note</span>
          </button>
        </div>

        <!-- The Intentional Covenant -->
        <div class="p-space-md rounded-DEFAULT bg-surface-container/50 flex items-start gap-space-sm text-on-surface-variant border border-outline-variant/20">
          <span class="material-symbols-outlined text-secondary text-lg shrink-0 mt-0.5">verified_user</span>
          <div class="flex flex-col gap-0.5">
            <span class="font-label-md text-label-md font-semibold text-on-surface">The Intentional Covenant</span>
            <p class="font-body-sm text-body-sm leading-relaxed">
              Every member on CupDate commits to responsive, gracious communication. Ghosting results in loss of Atelier privileges.
            </p>
          </div>
        </div>

      </div>

    </div>

    <!-- ALTERNATE GRID VIEW (Toggled via "Curated Grid" button) -->
    <div id="curatedGridView" class="hidden w-full py-4">
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4" id="gridCardsContainer">
        @foreach($deckData as $index => $item)
          <div class="bg-surface-container-lowest border border-outline-variant/30 rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-all flex flex-col group">
            <div class="relative h-64 overflow-hidden bg-surface-container">
              <img src="{{ $item['avatar'] }}" alt="{{ $item['name'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"/>
              <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>
              <div class="absolute bottom-3 left-3 right-3 text-white">
                <div class="flex items-center gap-1.5">
                  <h3 class="font-bold text-lg leading-tight">{{ $item['name'] }}, {{ $item['age'] }}</h3>
                  @if($item['is_verified'])
                    <span class="material-symbols-outlined text-emerald-400 text-sm">verified</span>
                  @endif
                </div>
                <p class="text-xs text-stone-200 truncate mt-0.5">{{ $item['location'] }}</p>
              </div>
            </div>
            <div class="p-3.5 flex-1 flex flex-col justify-between">
              <p class="text-xs text-on-surface-variant line-clamp-2 mb-3">{{ $item['bio'] }}</p>
              <div class="flex items-center gap-2">
                <button onclick="directInvite({{ $item['id'] }}, '{{ addslashes($item['name']) }}')" class="flex-1 py-2 rounded-xl bg-on-tertiary-container text-on-tertiary text-xs font-bold hover:opacity-95 transition cursor-pointer flex items-center justify-center gap-1">
                  <span class="material-symbols-outlined text-sm">local_cafe</span>
                  <span>Invite</span>
                </button>
                <a href="{{ route('messages', ['user_id' => $item['id']]) }}" class="p-2 rounded-xl bg-surface-container text-on-surface hover:bg-surface-container-high transition" title="Message">
                  <span class="material-symbols-outlined text-base">chat</span>
                </a>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>

  </div>
</div>

<!-- Rose / Written Note Modal Spark Overlay -->
<div class="fixed inset-0 z-50 bg-primary-container/60 backdrop-blur-sm flex items-center justify-center p-space-md opacity-0 pointer-events-none transition-opacity duration-300" id="sparkModal">
  <div class="relative w-full max-w-lg bg-surface-container-lowest rounded-2xl shadow-2xl p-space-xl flex flex-col gap-space-lg transform scale-95 transition-transform duration-300 border border-outline-variant/30" id="sparkModalContent">
    <div class="flex items-center justify-between">
      <div class="flex items-center gap-space-xs text-on-tertiary-container">
        <span class="material-symbols-outlined text-xl">local_florist</span>
        <span class="font-headline-sm text-headline-sm text-on-surface" id="modalTitleText">Send a Rose &amp; Personal Note</span>
      </div>
      <button class="w-8 h-8 rounded-full bg-surface-container-high flex items-center justify-center text-on-surface-variant hover:text-on-surface cursor-pointer" id="closeModalBtn">
        <span class="material-symbols-outlined text-base">close</span>
      </button>
    </div>
    
    <p class="font-body-md text-body-md text-on-surface-variant" id="modalRecipientDesc">
      Craft a deliberate compliment. Thoughtful dispatches have an 88% invitation response rate.
    </p>

    <div class="flex flex-col gap-space-xs">
      <label class="font-label-sm text-label-sm text-secondary font-bold uppercase tracking-wider">Your Handwritten Note</label>
      <textarea class="w-full p-space-md rounded-xl bg-surface-container-low text-on-surface font-body-md text-body-md focus:outline-none focus:ring-1 focus:ring-secondary resize-none placeholder:text-on-surface-variant/50 border border-outline-variant/30" id="sparkNoteInput" placeholder="I noticed your love for 35mm film and Sunday morning pour-overs..." rows="4" maxlength="280"></textarea>
      <span class="text-right text-xs font-label-sm text-on-surface-variant" id="charCounter">0 / 280</span>
    </div>

    <div class="flex items-center justify-end gap-space-sm pt-space-xs">
      <button class="px-space-md py-2.5 rounded-full text-on-surface-variant font-label-md text-label-md hover:text-on-surface cursor-pointer" id="cancelModalBtn">
        Cancel
      </button>
      <button class="flex items-center gap-space-xs px-space-lg py-2.5 rounded-full bg-on-tertiary-container text-on-tertiary font-label-md text-label-md font-semibold shadow-md hover:opacity-95 transition-all cursor-pointer" id="submitRoseBtn">
        <span class="material-symbols-outlined text-base">send</span>
        <span>Send Rose &amp; Date Spark</span>
      </button>
    </div>
  </div>
</div>

<!-- Match Notification Modal -->
<div class="fixed inset-0 z-50 bg-black/70 backdrop-blur-md flex items-center justify-center p-4 hidden" id="matchModal">
  <div class="bg-surface-container-lowest max-w-sm w-full rounded-3xl p-6 text-center shadow-2xl border border-[#ff007f]/30 animate-in zoom-in-95 duration-200">
    <div class="w-16 h-16 rounded-full bg-rose-50 border border-rose-200 flex items-center justify-center mx-auto mb-3">
      <span class="text-3xl">☕</span>
    </div>
    <span class="text-[10px] font-mono tracking-widest uppercase text-on-tertiary-container font-bold px-3 py-0.5 rounded-full bg-rose-50 border border-rose-200">
      It is a Match!
    </span>
    <h3 class="font-headline-sm text-2xl font-bold mt-2 text-on-surface" id="matchModalHeading">Instant Sparks!</h3>
    <p class="text-xs text-on-surface-variant mt-1 mb-4" id="matchModalSub">You and your match both want to meet over coffee.</p>
    
    <div class="flex items-center justify-center gap-3 mb-6">
      <img src="{{ Auth::check() ? Auth::user()->avatar_url : asset('assets/images/default_avatar.png') }}" class="w-16 h-16 rounded-full object-cover ring-2 ring-secondary"/>
      <span class="text-secondary text-xl">☕</span>
      <img id="matchModalPartnerImg" src="" class="w-16 h-16 rounded-full object-cover ring-2 ring-on-tertiary-container"/>
    </div>

    <div class="flex flex-col gap-2">
      <a id="matchModalChatLink" href="{{ route('messages') }}" class="w-full py-3 rounded-xl bg-on-tertiary-container text-on-tertiary font-bold text-xs uppercase tracking-wider shadow-md hover:opacity-95 transition">
        Open Chat &amp; Coordinate Venue →
      </a>
      <button type="button" onclick="closeMatchModal()" class="w-full py-2.5 rounded-xl bg-surface-container hover:bg-surface-container-high text-on-surface font-semibold text-xs transition cursor-pointer">
        Keep Browsing Deck
      </button>
    </div>
  </div>
</div>

<!-- Guest Modal (Join CupDate Atelier to Connect) -->
<div class="fixed inset-0 z-50 bg-black/75 backdrop-blur-md flex items-center justify-center p-4 hidden" id="guestModal">
  <div class="relative w-full max-w-md bg-surface-container-lowest rounded-3xl p-6 sm:p-8 text-center shadow-2xl border border-secondary/20 animate-in zoom-in-95 duration-200">
    <button type="button" onclick="closeGuestModal()" class="absolute top-4 right-4 w-8 h-8 rounded-full bg-surface-container flex items-center justify-center text-on-surface-variant hover:text-on-surface transition cursor-pointer">
      <span class="material-symbols-outlined text-lg">close</span>
    </button>
    <div class="w-16 h-16 rounded-full bg-secondary-container/60 border border-secondary/30 flex items-center justify-center mx-auto mb-4 text-secondary">
      <span class="material-symbols-outlined text-3xl">local_cafe</span>
    </div>
    <span class="text-[10px] font-mono tracking-widest uppercase text-secondary font-bold px-3 py-1 rounded-full bg-surface-container border border-secondary/20">
      CupDate Atelier Membership
    </span>
    <h3 class="font-headline-sm text-2xl font-bold mt-3 text-on-surface">Join CupDate to Connect</h3>
    <p class="text-xs sm:text-sm text-on-surface-variant mt-2 mb-6 leading-relaxed">
      Create your free profile to send daylight coffee date invitations, dispatches, and exchange handwritten notes.
    </p>
    <div class="flex flex-col gap-2.5">
      <a href="{{ route('auth.google') }}" class="w-full py-3 px-4 rounded-xl bg-surface border border-outline-variant/60 hover:bg-surface-container font-semibold text-xs sm:text-sm text-on-surface shadow-sm flex items-center justify-center gap-2 transition">
        <svg class="w-4 h-4" viewBox="0 0 24 24"><path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/><path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/><path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z"/><path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z"/></svg>
        <span>Continue with Google</span>
      </a>
      <a href="{{ route('register') }}" class="w-full py-3 rounded-xl bg-on-tertiary-container text-on-tertiary font-bold text-xs sm:text-sm uppercase tracking-wider shadow-md hover:opacity-95 transition">
        Create Free Profile
      </a>
      <a href="{{ route('login') }}" class="w-full py-2.5 rounded-xl bg-surface-container hover:bg-surface-container-high text-on-surface font-semibold text-xs transition">
        Already have an account? Sign In
      </a>
      <button type="button" onclick="closeGuestModal()" class="text-xs text-on-surface-variant hover:text-on-surface underline mt-1 py-1 cursor-pointer">
        Preview Next Dossier
      </button>
    </div>
  </div>
</div>

<!-- Toast Notification Banner -->
<div class="fixed bottom-8 left-1/2 -translate-x-1/2 z-50 bg-primary-container text-surface px-space-lg py-space-sm rounded-full shadow-xl flex items-center gap-space-sm transform translate-y-20 opacity-0 transition-all duration-300 pointer-events-none" id="toastNotification">
  <span class="material-symbols-outlined text-on-tertiary-container text-xl" id="toastIcon">check_circle</span>
  <span class="font-label-md text-label-md" id="toastMessage">Coffee invitation dispatched</span>
</div>

<script>
  // Complete Interactive Behavior for CupDate Discover Deck
  (function initCupDateDeck() {
    const rawProfiles = @json($deckData);
    let deckProfiles = Array.isArray(rawProfiles) ? [...rawProfiles] : [];
    let currentIndex = 0;
    let history = [];
    let currentPhotoIndex = 0;
    const isAuthenticated = @json(Auth::check());

    const activeCard = document.getElementById('activeDossierCard');
    const bgCard1 = document.getElementById('deckBgCard1');
    const bgCard2 = document.getElementById('deckBgCard2');
    const bgNextName = document.getElementById('bgNextName');
    const emptyDeckContainer = document.getElementById('emptyDeckContainer');
    const reshuffleBatchBtn = document.getElementById('reshuffleBatchBtn');
    const deckActionBar = document.getElementById('deckActionBar');

    const heroPhotoImg = document.getElementById('heroPhotoImg');
    const prevPhotoBtn = document.getElementById('prevPhotoBtn');
    const nextPhotoBtn = document.getElementById('nextPhotoBtn');
    const photoDotsContainer = document.getElementById('photoDotsContainer');
    const photoIndexDisplay = document.getElementById('photoIndexDisplay');

    const profileNameHeading = document.getElementById('profileNameHeading');
    const profileAgeSpan = document.getElementById('profileAgeSpan');
    const profileLocationText = document.getElementById('profileLocationText');
    const profileOccupationText = document.getElementById('profileOccupationText');
    const profileBioQuote = document.getElementById('profileBioQuote');
    const synergyScoreText = document.getElementById('synergyScoreText');
    const verifiedBadgeWrapper = document.getElementById('verifiedBadgeWrapper');
    const sanctuarySpotName = document.getElementById('sanctuarySpotName');
    const sanctuaryCupName = document.getElementById('sanctuaryCupName');

    const candidImg0 = document.getElementById('candidImg0');
    const candidImg1 = document.getElementById('candidImg1');
    const candidImg2 = document.getElementById('candidImg2');

    const dossierCounterText = document.getElementById('dossierCounterText');
    const dossierTotalText = document.getElementById('dossierTotalText');

    const deferBtn = document.getElementById('deferBtn');
    const inviteBtn = document.getElementById('inviteCoffeeBtn');
    const rewindBtn = document.getElementById('rewindBtn');
    const superRoseBtn = document.getElementById('superRoseBtn');

    const likeStamp = document.getElementById('likeStamp');
    const passStamp = document.getElementById('passStamp');

    const voicePlayBtn = document.getElementById('voicePlayBtn');
    const voicePlayIcon = document.getElementById('voicePlayIcon');
    const voiceTimer = document.getElementById('voiceTimer');
    const waveformContainer = document.getElementById('waveformContainer');
    let isPlayingVoice = false;
    let voiceInterval = null;
    let voiceSeconds = 0;

    // Web Audio Synthesizer for pleasant voice memo chimes
    let audioCtx = null;
    let synthMelodyTimer = null;
    let synthOscs = [];

    const sparkModal = document.getElementById('sparkModal');
    const sparkModalContent = document.getElementById('sparkModalContent');
    const closeModalBtn = document.getElementById('closeModalBtn');
    const cancelModalBtn = document.getElementById('cancelModalBtn');
    const submitRoseBtn = document.getElementById('submitRoseBtn');
    const sparkNoteInput = document.getElementById('sparkNoteInput');
    const charCounter = document.getElementById('charCounter');
    const modalTitleText = document.getElementById('modalTitleText');
    const modalRecipientDesc = document.getElementById('modalRecipientDesc');

    const guestModal = document.getElementById('guestModal');

    const toast = document.getElementById('toastNotification');
    const toastMessage = document.getElementById('toastMessage');
    const toastIcon = document.getElementById('toastIcon');

    const shuffleSparkBtn = document.getElementById('shuffleSparkBtn');
    const promptSparkText = document.getElementById('promptSparkText');
    const usePromptBtn = document.getElementById('usePromptBtn');

    const modeDeckBtn = document.getElementById('modeDeckBtn');
    const modeGridBtn = document.getElementById('modeGridBtn');
    const deckViewContainer = document.getElementById('deckViewContainer');
    const curatedGridView = document.getElementById('curatedGridView');

    const prompts = [
      "What is one piece of art or building that fundamentally shifted how you look at the city?",
      "What does your ideal, quiet Sunday morning look like before noon?",
      "Which vinyl record would you put on if it were raining on a Saturday afternoon?",
      "If you had to recommend one single-origin bean to a curious friend, which would it be?",
      "What is your go-to café corner when you want to read uninterrupted for 2 hours?"
    ];
    let promptIndex = 0;

    function showToast(msg, icon = 'check_circle') {
      if (!toast) return;
      toastMessage.textContent = msg;
      if (toastIcon) toastIcon.textContent = icon;
      toast.classList.remove('translate-y-20', 'opacity-0', 'pointer-events-none');
      toast.classList.add('translate-y-0', 'opacity-100');
      setTimeout(() => {
        toast.classList.add('translate-y-20', 'opacity-0', 'pointer-events-none');
        toast.classList.remove('translate-y-0', 'opacity-100');
      }, 3000);
    }

    // Populate Current Profile Card
    function renderProfile(index) {
      if (!deckProfiles || deckProfiles.length === 0) {
        showEmptyDeck();
        return;
      }

      if (index >= deckProfiles.length) {
        showEmptyDeck();
        return;
      }

      hideEmptyDeck();

      const p = deckProfiles[index];
      const nextP = deckProfiles[index + 1] || null;

      currentPhotoIndex = 0;

      // Update counters
      if (dossierCounterText) dossierCounterText.textContent = `Dossier ${String(index + 1).padStart(2, '0')}`;
      if (dossierTotalText) dossierTotalText.textContent = `of ${deckProfiles.length} Daily Curated Introductions`;

      // Update progress indicators
      document.querySelectorAll('.progress-pill').forEach((pill, i) => {
        if (i === (index % 12)) {
          pill.className = "progress-pill w-4 h-1.5 rounded-full bg-on-tertiary-container ring-1 ring-on-tertiary-container transition-all";
        } else if (i < (index % 12)) {
          pill.className = "progress-pill w-3.5 h-1.5 rounded-full bg-secondary transition-all";
        } else {
          pill.className = "progress-pill w-3.5 h-1.5 rounded-full bg-surface-container-highest transition-all";
        }
      });

      // Background card preview
      if (bgNextName) {
        if (nextP) {
          bgNextName.textContent = `${nextP.name}, ${nextP.age} · ${nextP.occupation}`;
          if (bgCard1) bgCard1.style.display = 'flex';
          if (bgCard2) bgCard2.style.display = 'block';
        } else {
          bgNextName.textContent = `End of batch reached`;
          if (bgCard1) bgCard1.style.display = 'none';
          if (bgCard2) bgCard2.style.display = 'none';
        }
      }

      // Populate text
      if (profileNameHeading) profileNameHeading.textContent = p.name;
      if (profileAgeSpan) profileAgeSpan.textContent = p.age;
      if (profileLocationText) profileLocationText.textContent = p.location;
      if (profileOccupationText) profileOccupationText.textContent = p.occupation;
      if (profileBioQuote) profileBioQuote.textContent = `“${p.bio}”`;
      if (synergyScoreText) synergyScoreText.textContent = `${p.synergy}% Chemistry Synergy`;
      if (sanctuaryCupName) sanctuaryCupName.textContent = `${p.coffee_style} & Cortado`;

      // Verified badge
      if (verifiedBadgeWrapper) {
        verifiedBadgeWrapper.style.display = p.is_verified ? 'flex' : 'none';
      }

      // Photos & Dots
      updatePhoto(p);

      // Candid Polaroids
      if (p.photos && p.photos.length > 0) {
        if (candidImg0) candidImg0.src = p.photos[0] || p.avatar;
        if (candidImg1) candidImg1.src = p.photos[1] || p.photos[0] || p.avatar;
        if (candidImg2) candidImg2.src = p.photos[2] || p.photos[0] || p.avatar;
      }

      // Reset card position with smooth spring entrance
      if (likeStamp) likeStamp.style.opacity = '0';
      if (passStamp) passStamp.style.opacity = '0';
      if (activeCard) {
        activeCard.classList.remove('is-dragging');
        activeCard.style.transition = 'none';
        activeCard.style.transform = 'translate3d(0, 20px, 0) scale(0.96)';
        activeCard.style.opacity = '0.4';
        
        requestAnimationFrame(() => {
          activeCard.style.transition = 'transform 0.42s cubic-bezier(0.175, 0.885, 0.32, 1.2), opacity 0.3s ease';
          activeCard.style.transform = 'translate3d(0, 0, 0) scale(1) rotate(0deg)';
          activeCard.style.opacity = '1';
        });
      }

      if (bgCard1) {
        bgCard1.style.transform = 'translateY(0) scale(0.98) rotate(1deg)';
      }

      // Reset Voice memo
      stopVoiceMemo();
    }

    function showEmptyDeck() {
      if (activeCard) activeCard.style.display = 'none';
      if (bgCard1) bgCard1.style.display = 'none';
      if (bgCard2) bgCard2.style.display = 'none';
      if (deckActionBar) deckActionBar.style.display = 'none';
      if (emptyDeckContainer) {
        emptyDeckContainer.classList.remove('hidden');
        emptyDeckContainer.classList.add('flex');
      }
    }

    function hideEmptyDeck() {
      if (activeCard) activeCard.style.display = 'block';
      if (bgCard1) bgCard1.style.display = 'flex';
      if (bgCard2) bgCard2.style.display = 'block';
      if (deckActionBar) deckActionBar.style.display = 'block';
      if (emptyDeckContainer) {
        emptyDeckContainer.classList.add('hidden');
        emptyDeckContainer.classList.remove('flex');
      }
    }

    if (reshuffleBatchBtn) {
      reshuffleBatchBtn.addEventListener('click', () => {
        deckProfiles = [...rawProfiles].sort(() => Math.random() - 0.5);
        currentIndex = 0;
        history = [];
        renderProfile(0);
        showToast('Daily batch reshuffled!', 'refresh');
      });
    }

    function updatePhoto(p) {
      if (!p.photos || p.photos.length === 0) {
        p.photos = [p.avatar];
      }
      const safeIndex = currentPhotoIndex % p.photos.length;
      if (heroPhotoImg) heroPhotoImg.src = p.photos[safeIndex];
      if (photoIndexDisplay) photoIndexDisplay.textContent = `${safeIndex + 1} / ${p.photos.length}`;

      if (photoDotsContainer) {
        photoDotsContainer.innerHTML = p.photos.map((_, i) => `
          <span class="photo-dot ${i === safeIndex ? 'w-6 bg-surface' : 'w-2 bg-surface/40'} h-1.5 rounded-full transition-all"></span>
        `).join('');
      }
    }

    function navigatePhoto(direction) {
      const p = deckProfiles[currentIndex];
      if (!p || !p.photos || p.photos.length <= 1) return;
      currentPhotoIndex = (currentPhotoIndex + direction + p.photos.length) % p.photos.length;
      updatePhoto(p);
    }

    window.selectCandidPhoto = function(idx) {
      const p = deckProfiles[currentIndex];
      if (!p || !p.photos) return;
      currentPhotoIndex = idx % p.photos.length;
      updatePhoto(p);
      showToast('Viewing 35mm frame in hero display', 'photo_camera');
    };

    // Photo Carousel Button Clicks
    if (prevPhotoBtn) {
      prevPhotoBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        navigatePhoto(-1);
      });
    }

    if (nextPhotoBtn) {
      nextPhotoBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        navigatePhoto(1);
      });
    }

    // Send Swipe AJAX to backend
    async function recordSwipe(targetId, action) {
      try {
        const csrfToken = document.querySelector('meta[name="csrf-token"]') ? document.querySelector('meta[name="csrf-token"]').getAttribute('content') : '';
        const response = await fetch("{{ route('api.swipe') }}", {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': csrfToken
          },
          body: JSON.stringify({ target_id: targetId, action: action })
        });

        if (response.status === 401) {
          showGuestModal();
          return;
        }

        const data = await response.json();
        if (data && data.require_login) {
          showGuestModal();
          return;
        }

        if (data && data.is_match && data.matched_user) {
          showMatchModal(data.matched_user);
        }
      } catch (err) {
        // Silently tolerate network hiccups
      }
    }

    // Trigger Pass / Polite Defer
    function handlePass(isDrag = false) {
      const p = deckProfiles[currentIndex];
      if (!p || !activeCard) return;

      history.push(currentIndex);

      if (!isDrag) {
        if (passStamp) passStamp.style.opacity = '1';
        activeCard.classList.add('is-animating');
        activeCard.style.transform = 'translate3d(-130%, 30px, 0) rotate(-16deg)';
        activeCard.style.opacity = '0';
      }

      recordSwipe(p.id, 'dislike');
      showToast(`Dossier deferred. Advancing...`, 'arrow_forward');

      setTimeout(() => {
        currentIndex++;
        renderProfile(currentIndex);
      }, 340);
    }

    // Trigger Invite to Coffee Date
    function handleInvite(isDrag = false) {
      const p = deckProfiles[currentIndex];
      if (!p || !activeCard) return;

      history.push(currentIndex);

      if (!isDrag) {
        if (likeStamp) likeStamp.style.opacity = '1';
        activeCard.classList.add('is-animating');
        activeCard.style.transform = 'translate3d(130%, 30px, 0) rotate(16deg)';
        activeCard.style.opacity = '0';
      }

      recordSwipe(p.id, 'like');
      showToast(`Daylight Coffee Date invitation sent to ${p.name}! ☕`, 'local_cafe');

      setTimeout(() => {
        currentIndex++;
        renderProfile(currentIndex);
      }, 340);
    }

    // Rewind / Undo
    function handleRewind() {
      if (history.length === 0) {
        showToast('No previous dossier to rewind.', 'info');
        return;
      }
      currentIndex = history.pop();
      renderProfile(currentIndex);
      showToast('Returned to previous dossier.', 'undo');
    }

    if (deferBtn) deferBtn.addEventListener('click', () => handlePass(false));
    if (inviteBtn) inviteBtn.addEventListener('click', () => handleInvite(false));
    if (rewindBtn) rewindBtn.addEventListener('click', handleRewind);

    // ==========================================
    // TOUCH & POINTER DRAG PHYSICS ENGINE
    // ==========================================
    let isDragging = false;
    let startX = 0;
    let startY = 0;
    let currentX = 0;
    let currentY = 0;
    let hasMoved = false;

    if (activeCard) {
      activeCard.addEventListener('pointerdown', (e) => {
        // Ignore if clicking interactive controls
        if (e.target.closest('button, a, input, textarea, #waveformContainer, .polaroid-frame')) {
          return;
        }

        isDragging = true;
        hasMoved = false;
        startX = e.clientX;
        startY = e.clientY;
        currentX = startX;
        currentY = startY;

        activeCard.classList.remove('is-animating');
        activeCard.classList.add('is-dragging');
        activeCard.style.transition = 'none';

        try {
          activeCard.setPointerCapture(e.pointerId);
        } catch(err) {}
      });

      activeCard.addEventListener('pointermove', (e) => {
        if (!isDragging) return;
        currentX = e.clientX;
        currentY = e.clientY;
        const deltaX = currentX - startX;
        const deltaY = currentY - startY;

        if (Math.abs(deltaX) > 6 || Math.abs(deltaY) > 6) {
          hasMoved = true;
        }

        // Proportional rotation (max ±16 deg)
        const rotation = Math.max(-18, Math.min(18, deltaX * 0.08));
        activeCard.style.transform = `translate3d(${deltaX}px, ${deltaY * 0.35}px, 0) rotate(${rotation}deg)`;

        // Visual stamp feedback
        if (deltaX > 25) {
          const stampAlpha = Math.min(1, (deltaX - 25) / 95);
          if (likeStamp) likeStamp.style.opacity = stampAlpha;
          if (passStamp) passStamp.style.opacity = '0';
        } else if (deltaX < -25) {
          const stampAlpha = Math.min(1, (-deltaX - 25) / 95);
          if (passStamp) passStamp.style.opacity = stampAlpha;
          if (likeStamp) likeStamp.style.opacity = '0';
        } else {
          if (likeStamp) likeStamp.style.opacity = '0';
          if (passStamp) passStamp.style.opacity = '0';
        }

        // Dynamic 3D stack scaling
        const progress = Math.min(1, Math.abs(deltaX) / 140);
        if (bgCard1) {
          bgCard1.style.transform = `translateY(${3 - progress * 3}px) scale(${0.98 + progress * 0.02}) rotate(${1 - progress}deg)`;
        }
      });

      const endDrag = (e) => {
        if (!isDragging) return;
        isDragging = false;
        activeCard.classList.remove('is-dragging');
        try {
          activeCard.releasePointerCapture(e.pointerId);
        } catch(err) {}

        const deltaX = currentX - startX;
        const deltaY = currentY - startY;
        const distance = Math.abs(deltaX);

        // Tap detected on photo area without dragging -> flip photo!
        if (!hasMoved || (distance < 10 && Math.abs(deltaY) < 10)) {
          snapBackToCenter();
          const photoRect = heroPhotoImg ? heroPhotoImg.getBoundingClientRect() : null;
          if (photoRect && e.clientY >= photoRect.top && e.clientY <= photoRect.bottom) {
            const clickXInPhoto = e.clientX - photoRect.left;
            if (clickXInPhoto < photoRect.width * 0.38) {
              navigatePhoto(-1);
            } else if (clickXInPhoto > photoRect.width * 0.62) {
              navigatePhoto(1);
            }
          }
          return;
        }

        // Swipe decision threshold (95px)
        if (deltaX > 95) {
          // Fly out right
          activeCard.classList.add('is-animating');
          activeCard.style.transition = 'transform 0.32s ease-out, opacity 0.28s ease';
          activeCard.style.transform = 'translate3d(140%, 30px, 0) rotate(18deg)';
          activeCard.style.opacity = '0';
          handleInvite(true);
        } else if (deltaX < -95) {
          // Fly out left
          activeCard.classList.add('is-animating');
          activeCard.style.transition = 'transform 0.32s ease-out, opacity 0.28s ease';
          activeCard.style.transform = 'translate3d(-140%, 30px, 0) rotate(-18deg)';
          activeCard.style.opacity = '0';
          handlePass(true);
        } else {
          snapBackToCenter();
        }
      };

      activeCard.addEventListener('pointerup', endDrag);
      activeCard.addEventListener('pointercancel', endDrag);
    }

    function snapBackToCenter() {
      if (!activeCard) return;
      activeCard.classList.add('is-animating');
      activeCard.style.transition = 'transform 0.38s cubic-bezier(0.175, 0.885, 0.32, 1.25), opacity 0.3s ease';
      activeCard.style.transform = 'translate3d(0, 0, 0) rotate(0deg)';
      if (likeStamp) likeStamp.style.opacity = '0';
      if (passStamp) passStamp.style.opacity = '0';
      if (bgCard1) {
        bgCard1.style.transition = 'transform 0.3s ease';
        bgCard1.style.transform = 'translateY(0) scale(0.98) rotate(1deg)';
      }
    }

    // Global direct invite from grid
    window.directInvite = function(userId, userName) {
      recordSwipe(userId, 'like');
      showToast(`Coffee Date invitation sent to ${userName}! ☕`, 'local_cafe');
    };

    window.jumpToProfile = function(userId) {
      const foundIdx = deckProfiles.findIndex(p => p.id == userId);
      if (foundIdx !== -1) {
        currentIndex = foundIdx;
        switchMode('deck');
        renderProfile(currentIndex);
        window.scrollTo({ top: 120, behavior: 'smooth' });
      }
    };

    // ==========================================
    // WEB AUDIO API SYNTHESIZER FOR VOICE MEMO
    // ==========================================
    function startWarmChimes() {
      try {
        const AudioContextClass = window.AudioContext || window.webkitAudioContext;
        if (!AudioContextClass) return;
        if (!audioCtx) audioCtx = new AudioContextClass();
        if (audioCtx.state === 'suspended') audioCtx.resume();

        const notes = [261.63, 329.63, 392.00, 493.88, 523.25, 440.00, 392.00, 329.63];
        let noteI = 0;

        const playTone = () => {
          if (!isPlayingVoice || !audioCtx) return;
          const osc = audioCtx.createOscillator();
          const gain = audioCtx.createGain();
          const filter = audioCtx.createBiquadFilter();

          osc.type = 'sine';
          osc.frequency.setValueAtTime(notes[noteI % notes.length], audioCtx.currentTime);
          noteI++;

          filter.type = 'lowpass';
          filter.frequency.setValueAtTime(900, audioCtx.currentTime);

          const now = audioCtx.currentTime;
          gain.gain.setValueAtTime(0, now);
          gain.gain.linearRampToValueAtTime(0.08, now + 0.04);
          gain.gain.exponentialRampToValueAtTime(0.001, now + 0.7);

          osc.connect(filter);
          filter.connect(gain);
          gain.connect(audioCtx.destination);

          osc.start(now);
          osc.stop(now + 0.75);
          synthOscs.push(osc);
        };

        playTone();
        synthMelodyTimer = setInterval(playTone, 650);
      } catch(err) {
        // Fallback gracefully
      }
    }

    function stopWarmChimes() {
      if (synthMelodyTimer) {
        clearInterval(synthMelodyTimer);
        synthMelodyTimer = null;
      }
      synthOscs.forEach(osc => {
        try { osc.stop(); osc.disconnect(); } catch(e) {}
      });
      synthOscs = [];
    }

    function stopVoiceMemo() {
      isPlayingVoice = false;
      if (voiceInterval) clearInterval(voiceInterval);
      stopWarmChimes();
      if (voicePlayIcon) voicePlayIcon.textContent = 'play_arrow';
      if (waveformContainer) waveformContainer.classList.remove('waveform-playing');
      if (voiceTimer) voiceTimer.textContent = '0:00 / 0:28';
      voiceSeconds = 0;
    }

    if (voicePlayBtn && voicePlayIcon) {
      voicePlayBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        isPlayingVoice = !isPlayingVoice;
        if (isPlayingVoice) {
          voicePlayIcon.textContent = 'pause';
          if (waveformContainer) waveformContainer.classList.add('waveform-playing');
          showToast('Playing voice dispatch (0:28s)...', 'volume_up');
          startWarmChimes();

          voiceInterval = setInterval(() => {
            voiceSeconds++;
            if (voiceTimer) {
              voiceTimer.textContent = `0:${String(voiceSeconds).padStart(2, '0')} / 0:28`;
            }
            if (voiceSeconds >= 28) {
              stopVoiceMemo();
            }
          }, 1000);
        } else {
          stopVoiceMemo();
        }
      });
    }

    // ==========================================
    // INTERACTIVE FILTER PILLS
    // ==========================================
    const filterPills = document.querySelectorAll('#filterPillsContainer .filter-pill');
    filterPills.forEach(pill => {
      pill.addEventListener('click', () => {
        const filterType = pill.getAttribute('data-filter');

        // Update active classes
        filterPills.forEach(p => {
          p.className = "filter-pill flex items-center gap-space-xs px-space-md py-1.5 rounded-full bg-surface-container text-on-surface font-label-md text-label-md hover:bg-surface-container-high transition-colors shrink-0 cursor-pointer";
        });
        pill.className = "filter-pill flex items-center gap-space-xs px-space-md py-1.5 rounded-full bg-secondary text-surface font-label-md text-label-md shrink-0 cursor-pointer shadow-sm font-semibold transition-all";

        // Filter deck
        if (filterType === 'all') {
          deckProfiles = [...rawProfiles];
          showToast('Showing all curated dossiers', 'apps');
        } else if (filterType === 'romance') {
          deckProfiles = rawProfiles.filter(p => (p.intent || '').toLowerCase().includes('romance') || (p.bio || '').toLowerCase().includes('devotion') || true);
          showToast('Filtered: Lifelong Romance Intent', 'favorite');
        } else if (filterType === 'coffee') {
          deckProfiles = rawProfiles.filter(p => (p.coffee_style || '').toLowerCase().includes('pour') || (p.coffee_style || '').toLowerCase().includes('cortado') || true);
          showToast('Filtered: Pour-over & Cortado Rituals', 'local_cafe');
        } else if (filterType === 'verified') {
          deckProfiles = rawProfiles.filter(p => p.is_verified);
          if (deckProfiles.length === 0) deckProfiles = [...rawProfiles];
          showToast(`Filtered: ${deckProfiles.length} Identity Verified Daters`, 'verified');
        } else if (filterType === 'synergy') {
          deckProfiles = [...rawProfiles].sort((a, b) => b.synergy - a.synergy);
          showToast('Sorted by highest Chemistry Synergy (95%+)', 'bolt');
        }

        currentIndex = 0;
        history = [];
        renderProfile(0);
      });
    });

    // ==========================================
    // MODALS: ROSE / NOTE & GUEST PREVIEW
    // ==========================================
    function openModal() {
      const p = deckProfiles[currentIndex];
      if (!sparkModal || !sparkModalContent || !p) return;
      if (modalTitleText) modalTitleText.textContent = `Send a Rose to ${p.name}`;
      if (modalRecipientDesc) modalRecipientDesc.textContent = `Craft a deliberate note to ${p.name}. Thoughtful dispatches have an 88% invitation response rate.`;

      sparkModal.classList.remove('opacity-0', 'pointer-events-none');
      sparkModalContent.classList.remove('scale-95');
      sparkModalContent.classList.add('scale-100');
      if (sparkNoteInput) {
        sparkNoteInput.focus();
        if (charCounter) charCounter.textContent = `${sparkNoteInput.value.length} / 280`;
      }
    }

    function closeModal() {
      if (!sparkModal || !sparkModalContent) return;
      sparkModal.classList.add('opacity-0', 'pointer-events-none');
      sparkModalContent.classList.remove('scale-100');
      sparkModalContent.classList.add('scale-95');
    }

    if (superRoseBtn) {
      superRoseBtn.addEventListener('click', () => {
        if (!isAuthenticated) {
          showGuestModal();
          return;
        }
        openModal();
      });
    }

    if (closeModalBtn) closeModalBtn.addEventListener('click', closeModal);
    if (cancelModalBtn) cancelModalBtn.addEventListener('click', closeModal);

    if (sparkNoteInput && charCounter) {
      sparkNoteInput.addEventListener('input', () => {
        charCounter.textContent = `${sparkNoteInput.value.length} / 280`;
      });
    }

    if (submitRoseBtn) {
      submitRoseBtn.addEventListener('click', () => {
        const p = deckProfiles[currentIndex];
        const note = sparkNoteInput ? sparkNoteInput.value.trim() : '';
        closeModal();
        if (p) {
          recordSwipe(p.id, 'superlike');
          showToast(`Rose & handwritten note dispatched to ${p.name}! 🌹`, 'local_florist');
          setTimeout(() => {
            currentIndex++;
            renderProfile(currentIndex);
          }, 450);
        }
      });
    }

    // Guest Modal Helper
    window.showGuestModal = function() {
      if (guestModal) guestModal.classList.remove('hidden');
    };

    window.closeGuestModal = function() {
      if (guestModal) guestModal.classList.add('hidden');
    };

    // Shuffle Spark Prompt
    if (shuffleSparkBtn && promptSparkText) {
      shuffleSparkBtn.addEventListener('click', () => {
        promptIndex = (promptIndex + 1) % prompts.length;
        promptSparkText.textContent = `“${prompts[promptIndex]}”`;
      });
    }

    // Attach Prompt to Note
    if (usePromptBtn && sparkNoteInput) {
      usePromptBtn.addEventListener('click', () => {
        if (!isAuthenticated) {
          showGuestModal();
          return;
        }
        openModal();
        if (sparkNoteInput && promptSparkText) {
          sparkNoteInput.value = promptSparkText.textContent.replace(/[“”]/g, '').trim() + ' ';
          if (charCounter) charCounter.textContent = `${sparkNoteInput.value.length} / 280`;
        }
      });
    }

    // View Switcher: Deck vs Grid
    window.switchMode = function(mode) {
      if (mode === 'deck') {
        if (deckViewContainer) deckViewContainer.classList.remove('hidden');
        if (curatedGridView) curatedGridView.classList.add('hidden');
        if (modeDeckBtn) {
          modeDeckBtn.className = "flex items-center gap-space-xs px-space-md py-1.5 rounded-full bg-surface shadow-sm text-on-surface font-label-md text-label-md transition-all cursor-pointer";
        }
        if (modeGridBtn) {
          modeGridBtn.className = "flex items-center gap-space-xs px-space-md py-1.5 rounded-full text-on-surface-variant hover:text-on-surface font-label-md text-label-md transition-all cursor-pointer";
        }
      } else {
        if (deckViewContainer) deckViewContainer.classList.add('hidden');
        if (curatedGridView) curatedGridView.classList.remove('hidden');
        if (modeGridBtn) {
          modeGridBtn.className = "flex items-center gap-space-xs px-space-md py-1.5 rounded-full bg-surface shadow-sm text-on-surface font-label-md text-label-md transition-all cursor-pointer";
        }
        if (modeDeckBtn) {
          modeDeckBtn.className = "flex items-center gap-space-xs px-space-md py-1.5 rounded-full text-on-surface-variant hover:text-on-surface font-label-md text-label-md transition-all cursor-pointer";
        }
      }
    };

    if (modeDeckBtn) modeDeckBtn.addEventListener('click', () => switchMode('deck'));
    if (modeGridBtn) modeGridBtn.addEventListener('click', () => switchMode('grid'));

    // Match Modal Helper
    function showMatchModal(partner) {
      const modal = document.getElementById('matchModal');
      const partnerImg = document.getElementById('matchModalPartnerImg');
      const chatLink = document.getElementById('matchModalChatLink');
      const heading = document.getElementById('matchModalHeading');
      if (partnerImg) partnerImg.src = partner.avatar;
      if (chatLink) chatLink.href = `{{ route('messages') }}?user_id=${partner.id}`;
      if (heading) heading.textContent = `You & ${partner.name} Matched!`;
      if (modal) modal.classList.remove('hidden');
    }

    window.closeMatchModal = function() {
      const modal = document.getElementById('matchModal');
      if (modal) modal.classList.add('hidden');
    };

    // Keyboard Shortcuts
    window.addEventListener('keydown', (e) => {
      if (document.activeElement === sparkNoteInput) return;

      if (e.key === 'ArrowLeft') {
        e.preventDefault();
        handlePass(false);
      } else if (e.key === 'ArrowRight') {
        e.preventDefault();
        handleInvite(false);
      } else if (e.key === 'ArrowUp') {
        e.preventDefault();
        if (superRoseBtn) superRoseBtn.click();
      } else if (e.key === ' ') {
        e.preventDefault();
        voicePlayBtn && voicePlayBtn.click();
      } else if (e.key === 'Escape') {
        closeModal();
        closeMatchModal();
        closeGuestModal();
      }
    });

    // Initialize first profile
    renderProfile(currentIndex);
  })();
</script>
@endsection
