@extends('layouts.app')

@php 
  $initialTab = $initialTab ?? (request()->routeIs('register') || request()->query('tab') === 'register' ? 'register' : 'signin'); 
@endphp

@section('title', ($initialTab === 'register' ? 'Join CupDate Free — 100% Selfie Verified Coffee Dating' : 'Log In to CupDate — Private Access & Membership'))

@section('extra_css')
<style>
  /* Skeleton Loading Shimmer */
  .skeleton-shimmer {
    background: linear-gradient(90deg, rgba(241,223,216,0.6) 25%, rgba(255,248,246,0.9) 50%, rgba(241,223,216,0.6) 75%);
    background-size: 200% 100%;
    animation: shimmer 1.5s infinite;
  }
  @keyframes shimmer {
    0% { background-position: 200% 0; }
    100% { background-position: -200% 0; }
  }
  .active-tab-btn {
    background-color: #ffffff !important;
    color: #231a15 !important;
    font-weight: 700 !important;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1) !important;
  }
  .inactive-tab-btn {
    background-color: transparent !important;
    color: #4f4540 !important;
    font-weight: 500 !important;
  }
  .drink-chip.selected-drink {
    background-color: #d65b6c !important;
    color: #ffffff !important;
    font-weight: 600 !important;
    box-shadow: 0 2px 8px rgba(214,91,108,0.3) !important;
  }
  .vibe-card.selected-vibe {
    background-color: #fff1eb !important;
    box-shadow: 0 0 0 2px #d65b6c !important;
  }
  .vibe-card.selected-vibe .vibe-icon {
    color: #d65b6c !important;
  }
  .neon-pink-text {
    background: linear-gradient(135deg, #ff4081 0%, #ff007f 50%, #e91e63 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
  }
</style>
@endsection

@section('content')
<div class="flex flex-col w-full bg-surface min-h-[calc(100vh-80px)]">

  <!-- Skeleton Shimmer Placeholder (Dissolves automatically once loaded) -->
  <div id="authSkeleton" class="max-w-[1360px] mx-auto px-4 sm:px-6 lg:px-margin-desktop py-6 w-full hidden">
    <div class="h-20 skeleton-shimmer rounded-2xl mb-8"></div>
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
      <div class="lg:col-span-5 h-[600px] skeleton-shimmer rounded-3xl"></div>
      <div class="lg:col-span-7 h-[600px] skeleton-shimmer rounded-3xl"></div>
    </div>
  </div>

  <!-- Main Auth Suite Container -->
  <div id="authContent" class="max-w-[1360px] mx-auto px-4 sm:px-6 lg:px-margin-desktop py-6 md:py-10 w-full transition-opacity duration-300">
    
    <!-- Top Editorial Header Note -->
    <div class="flex flex-col md:flex-row items-start md:items-end justify-between gap-space-sm pb-space-lg mb-space-lg bg-surface-container-high/40 p-space-md md:p-space-lg rounded-2xl shadow-sm border border-outline-variant/20">
      <div class="flex flex-col gap-space-xs">
        <div class="flex items-center gap-space-sm">
          <span class="w-2.5 h-2.5 rounded-full bg-on-tertiary-container animate-pulse"></span>
          <span class="font-label-sm text-label-sm uppercase tracking-widest text-secondary font-bold">CupDate Dossier · Vol. IV</span>
        </div>
        <h1 class="font-headline-md text-headline-md text-on-surface font-semibold tracking-tight">
          Private Access &amp; Membership
        </h1>
      </div>
      <div class="flex items-center gap-space-md text-on-surface-variant font-label-md text-label-md">
        <span class="flex items-center gap-1.5 font-bold text-emerald-800 bg-emerald-50 px-3 py-1 rounded-full border border-emerald-200">
          <span class="material-symbols-outlined text-base text-emerald-600">verified_user</span> 100% Curated &amp; Identity-Checked
        </span>
        <span class="opacity-40 hidden sm:inline">•</span>
        <span class="hidden sm:inline-block font-semibold text-secondary">Autumn 2026 Himachal &amp; India Roster Open</span>
      </div>
    </div>

    <!-- Main Asymmetric Split Layout -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-gutter-lg items-stretch">
      
      <!-- Left Editorial Storytelling Visual Column (5 Columns on Desktop) -->
      <div class="lg:col-span-5 flex flex-col justify-between relative rounded-3xl overflow-hidden bg-surface-container-high shadow-xl min-h-[520px] lg:min-h-[720px]">
        <!-- Background Editorial Image -->
        <img class="absolute inset-0 w-full h-full object-cover brightness-[0.88] contrast-[1.03] transform scale-100 transition-transform duration-700 hover:scale-105" 
             loading="lazy"
             src="https://lh3.googleusercontent.com/aida-public/AB6AXuAqjMN9O3fPncOYIbgCVEY_Q4rRvy_JIuABUs3wX4By6lkExCkHykhSDpDy_lTsjdP4iAykS7FxnAYvR5tVlwf2RT5p9rXBFmVEiocHvuDXwiC6V-JvLsvs6_pAtCYw7X5cghBPSxEtnZ0n-OjdG0-ehUg4LssxAjddh6r41XoqgMtPlsyo8rgjCVaDiFQ-iIoGnScQYcqFV1L92YzSygIOEIpeoZhKZObkZhM5ZyFG2KfxQ8RRcV-8cw"
             alt="Warm intimate candid portrait of a woman smiling with ceramic coffee cup in an artisan cafe"/>
        
        <!-- Subtle Scrim Overlays -->
        <div class="absolute inset-0 bg-gradient-to-t from-primary-container/95 via-primary-container/40 to-transparent"></div>
        <div class="absolute inset-0 bg-gradient-to-b from-primary-container/60 via-transparent to-transparent"></div>
        
        <!-- Top Badge: Daily Spotlight -->
        <div class="relative z-10 p-space-lg flex justify-between items-start">
          <div class="backdrop-blur-md bg-surface-container-lowest/90 text-on-surface px-space-md py-space-xs rounded-full shadow-md flex items-center gap-space-xs border border-white/40">
            <span class="material-symbols-outlined text-on-tertiary-container text-sm">local_cafe</span>
            <span class="font-label-sm text-label-sm tracking-wide text-on-surface uppercase font-bold">Featured Mountain Roaster</span>
          </div>
          <span class="font-headline-sm italic text-surface font-normal text-headline-sm tracking-tighter opacity-90">Nº 084</span>
        </div>

        <!-- Middle Atmospheric Feature -->
        <div class="relative z-10 px-space-lg my-auto max-w-sm">
          <div class="backdrop-blur-md bg-primary-container/75 p-space-md rounded-2xl shadow-lg border border-white/10 text-white">
            <p class="font-label-sm text-label-sm text-amber-300 uppercase tracking-wider mb-1 font-bold">Wake &amp; Bake · Mall Road, Shimla</p>
            <p class="font-body-sm text-body-sm text-inverse-on-surface leading-snug">
              "Wild cascara cold brew, cedar-scented veranda seating, and slow conversations that linger until mountain dusk."
            </p>
          </div>
        </div>

        <!-- Bottom Testimonial & Metrics Dossier -->
        <div class="relative z-10 p-space-lg flex flex-col gap-space-md">
          <blockquote class="font-headline-sm text-headline-sm text-inverse-on-surface italic leading-snug tracking-tight">
            “Good coffee is meant to be shared. Meet intentional singles who appreciate the slow ritual of coffee and genuine, unhurried conversation.”
          </blockquote>
          
          <div class="pt-space-sm flex items-center justify-between">
            <div class="flex items-center gap-space-sm">
              <div class="flex -space-x-2 overflow-hidden">
                <div class="inline-block h-8 w-8 rounded-full bg-secondary-container flex items-center justify-center text-on-secondary-container font-label-sm font-bold shadow-sm">HP</div>
                <div class="inline-block h-8 w-8 rounded-full bg-surface-container flex items-center justify-center text-on-surface font-label-sm font-bold shadow-sm">CH</div>
                <div class="inline-block h-8 w-8 rounded-full bg-primary-fixed flex items-center justify-center text-on-primary-fixed font-label-sm font-bold shadow-sm">PN</div>
              </div>
              <div class="flex flex-col">
                <span class="font-label-md text-label-md text-inverse-on-surface font-semibold">12,400+ Vetted Singles</span>
                <span class="font-body-sm text-body-sm text-inverse-on-surface/80">Kangra • Solan • Shimla • Chandigarh • Pune</span>
              </div>
            </div>
            
            <div class="hidden sm:flex flex-col items-end">
              <span class="font-headline-sm text-headline-sm text-inverse-on-surface font-semibold">94%</span>
              <span class="font-label-sm text-label-sm text-secondary-fixed tracking-wide uppercase">Second Date Rate</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Right Column: Interactive Auth Suite (7 Columns on Desktop) -->
      <div class="lg:col-span-7 flex flex-col justify-center">
        <div class="bg-surface-container-lowest p-6 sm:p-space-lg md:p-space-xl rounded-3xl shadow-lg border border-outline-variant/30 flex flex-col gap-space-lg">
          
          <!-- Mode Switcher Tabs (Sign In vs Join CupDate) -->
          <div class="flex items-center justify-between flex-wrap gap-space-md pb-space-xs border-b border-outline-variant/30">
            <div class="inline-flex p-1 bg-surface-container-high rounded-full self-start shadow-inner">
              <button class="px-space-lg py-space-xs rounded-full font-label-md text-label-md transition-all duration-300 {{ $initialTab === 'signin' ? 'active-tab-btn' : 'inactive-tab-btn' }}" 
                      id="tab-signin" onclick="switchAuthTab('signin')">
                Sign In
              </button>
              <button class="px-space-lg py-space-xs rounded-full font-label-md text-label-md transition-all duration-300 {{ $initialTab === 'register' ? 'active-tab-btn' : 'inactive-tab-btn' }}" 
                      id="tab-register" onclick="switchAuthTab('register')">
                Join CupDate
              </button>
            </div>
            
            <div class="flex items-center gap-space-xs text-on-surface-variant font-label-sm text-label-sm">
              <span class="material-symbols-outlined text-secondary text-sm">lock</span>
              <span class="font-mono">256-Bit Encrypted Session</span>
            </div>
          </div>

          <!-- Alert / Errors -->
          @if(session('success'))
            <div class="p-3.5 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-bold flex items-center gap-2">
              <span class="material-symbols-outlined text-base leading-none text-emerald-600">check_circle</span>
              <span>{{ session('success') }}</span>
            </div>
          @endif

          @if($errors->any())
            <div class="p-3.5 rounded-2xl bg-rose-50 border border-rose-200 text-rose-800 text-xs font-bold flex items-center gap-2">
              <span class="material-symbols-outlined text-base leading-none text-rose-600">error</span>
              <span>{{ $errors->first() }}</span>
            </div>
          @endif

          <!-- ============================================== -->
          <!-- 1. SIGN IN FORM VIEW -->
          <!-- ============================================== -->
          <div class="{{ $initialTab === 'signin' ? 'flex' : 'hidden' }} flex-col gap-space-lg" id="view-signin">
            <div class="flex flex-col gap-1">
              <h2 class="font-headline-md text-headline-md text-on-surface font-semibold tracking-tight">
                Welcome Back to CupDate
              </h2>
              <p class="font-body-md text-body-md text-on-surface-variant">
                Enter your credentials to view your coffee dates, morning dispatches, and curated matches.
              </p>
            </div>

            <!-- Social Auth: Google Sign-in -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-space-md">
              <a href="{{ route('auth.google') }}" class="flex items-center justify-center gap-space-sm px-space-md py-space-sm bg-surface-container hover:bg-surface-container-high transition-all text-on-surface font-label-md text-label-md rounded-full shadow-sm border border-outline-variant/30 group">
                <svg class="w-4 h-4 shrink-0" viewBox="0 0 24 24">
                  <path d="M12 5c1.6 0 3 .6 4.1 1.6l3.1-3.1C17.3 1.7 14.8 1 12 1 7.4 1 3.5 3.6 1.6 7.3l3.7 2.9C6.2 7.3 8.9 5 12 5z" fill="#EA4335"></path>
                  <path d="M23.5 12.3c0-.8-.1-1.6-.2-2.3H12v4.5h6.5c-.3 1.5-1.1 2.8-2.4 3.7l3.7 2.9c2.2-2 3.7-5 3.7-8.8z" fill="#4285F4"></path>
                  <path d="M5.3 14.8c-.2-.7-.4-1.5-.4-2.3 0-.8.2-1.6.4-2.3L1.6 7.3C.6 9.3 0 11.6 0 14.2s.6 4.9 1.6 6.9l3.7-3.3z" fill="#FBBC05"></path>
                  <path d="M12 23.4c3.2 0 6-1.1 8-3l-3.7-2.9c-1.1.7-2.5 1.2-4.3 1.2-3.1 0-5.8-2.3-6.7-5.2L1.6 16.8C3.5 20.8 7.4 23.4 12 23.4z" fill="#34A853"></path>
                </svg>
                <span class="font-bold">Continue with Google</span>
                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse ml-auto"></span>
              </a>

              <button type="button" onclick="simulateToast('Connecting to Apple ID...')" class="flex items-center justify-center gap-space-sm px-space-md py-space-sm bg-surface-container hover:bg-surface-container-high transition-all text-on-surface font-label-md text-label-md rounded-full shadow-sm border border-outline-variant/30">
                <svg class="w-4 h-4 fill-current shrink-0" viewBox="0 0 170 170">
                  <path d="M150.37 130.25c-2.45 5.66-5.35 10.87-8.71 15.66-4.58 6.53-8.33 11.05-11.22 13.56-4.48 4.12-9.28 6.23-14.42 6.35-3.69 0-8.14-1.05-13.32-3.18-5.19-2.12-9.97-3.17-14.34-3.17-4.58 0-9.49 1.05-14.74 3.17-5.26 2.13-9.5 3.24-12.74 3.35-4.35.13-9.16-1.9-14.42-6.08-3.69-3.04-7.68-7.85-11.97-14.42-6.42-9.74-11.35-20.73-14.8-32.97-3.44-12.24-5.17-23.77-5.17-34.58 0-14.07 3.38-25.79 10.14-35.16 6.76-9.36 15.24-14.1 25.45-14.23 4.93 0 10.36 1.34 16.29 4.02 5.92 2.68 9.69 4.09 11.3 4.23 1.95-.27 5.98-1.74 12.09-4.41 6.1-2.68 11.45-3.89 16.03-3.64 12.74.88 22.84 5.65 30.29 14.32-11.05 6.72-16.45 16.06-16.19 28.02.26 9.69 4.02 17.65 11.3 23.88 7.28 6.23 15.7 9.8 25.26 10.72-2.12 6.53-4.64 12.87-7.55 19.04zm-33.15-118.8c0 7.39-2.73 14.38-8.2 20.97-5.46 6.59-12.19 10.82-20.19 12.69-.13-1.19-.2-2.26-.2-3.21 0-7.38 3.03-14.7 9.09-21.95 6.06-7.25 13.06-11.23 21-11.94.13 1.15.2 2.19.2 3.12l-.7 8.32z"></path>
                </svg>
                <span class="font-bold">Continue with Apple</span>
              </button>
            </div>

            <!-- Divider -->
            <div class="flex items-center gap-space-md">
              <div class="flex-grow h-px bg-outline-variant/50"></div>
              <span class="font-label-sm text-label-sm text-on-surface-variant/80 uppercase tracking-widest">or email credentials</span>
              <div class="flex-grow h-px bg-outline-variant/50"></div>
            </div>

            <!-- Laravel Sign In Form -->
            <form action="{{ route('login.submit') }}" method="POST" class="flex flex-col gap-space-md">
              @csrf

              <div class="flex flex-col gap-1.5">
                <label class="font-label-md text-label-md text-on-surface font-semibold" for="signin-email">Registered Email</label>
                <div class="relative flex items-center">
                  <span class="material-symbols-outlined absolute left-3.5 text-secondary text-lg">alternate_email</span>
                  <input class="w-full pl-11 pr-4 py-space-sm bg-surface-container-high rounded-full font-body-md text-body-md text-on-surface placeholder:text-on-surface-variant/50 focus:outline-none focus:bg-surface-container focus:ring-2 focus:ring-secondary/40 transition-all" 
                         id="signin-email" name="email" value="{{ old('email', 'aditi.rao@cupdate.in') }}" required type="email" placeholder="yourname@gmail.com"/>
                </div>
              </div>

              <div class="flex flex-col gap-1.5">
                <div class="flex justify-between items-center">
                  <label class="font-label-md text-label-md text-on-surface font-semibold" for="signin-password">Secret Password</label>
                  <a class="font-label-md text-label-md text-on-tertiary-container hover:underline" href="{{ route('password.request') }}">Forgot password?</a>
                </div>
                <div class="relative flex items-center">
                  <span class="material-symbols-outlined absolute left-3.5 text-secondary text-lg">key</span>
                  <input class="w-full pl-11 pr-12 py-space-sm bg-surface-container-high rounded-full font-body-md text-body-md text-on-surface placeholder:text-on-surface-variant/50 focus:outline-none focus:bg-surface-container focus:ring-2 focus:ring-secondary/40 transition-all" 
                         id="signin-password" name="password" required type="password" placeholder="••••••••••••"/>
                  <button class="absolute right-3.5 text-on-surface-variant hover:text-on-surface p-1 flex items-center cursor-pointer" 
                          onclick="togglePasswordVisibility('signin-password', this)" type="button">
                    <span class="material-symbols-outlined text-base">visibility</span>
                  </button>
                </div>
              </div>

              <!-- Remember Device -->
              <div class="flex items-center justify-between pt-space-xs">
                <label class="flex items-center gap-space-sm cursor-pointer select-none">
                  <input name="remember" class="w-4 h-4 accent-secondary rounded" type="checkbox" checked/>
                  <span class="font-body-sm text-body-sm text-on-surface-variant">Remember this private device</span>
                </label>
                <span class="font-label-sm text-label-sm text-secondary italic">Auto-sync coffee preferences</span>
              </div>

              <!-- Submit Button -->
              <button class="mt-space-sm w-full py-3.5 px-space-lg rounded-full bg-primary text-on-primary font-label-lg text-label-lg font-semibold flex items-center justify-center gap-space-sm shadow-md hover:bg-primary/90 active:scale-[0.99] transition-all cursor-pointer" type="submit">
                <span class="material-symbols-outlined text-lg">local_cafe</span>
                <span>Enter CupDate &amp; Meet Singles</span>
              </button>
            </form>

            <p class="font-body-sm text-body-sm text-center text-on-surface-variant pt-space-xs">
              Not yet a member of CupDate? 
              <button class="text-on-tertiary-container font-semibold hover:underline cursor-pointer" onclick="switchAuthTab('register')">
                Join CupDate free
              </button>
            </p>
          </div>

          <!-- ============================================== -->
          <!-- 2. REGISTER / JOIN CUPDATE FORM VIEW -->
          <!-- ============================================== -->
          <div class="{{ $initialTab === 'register' ? 'flex' : 'hidden' }} flex-col gap-space-lg" id="view-register">
            <div class="flex flex-col gap-1">
              <div class="inline-flex items-center gap-1 text-on-tertiary-container font-label-sm text-label-sm uppercase font-bold tracking-wider">
                <span class="material-symbols-outlined text-sm">edit_note</span> CupDate Membership Application
              </div>
              <h2 class="font-headline-md text-headline-md text-on-surface font-semibold tracking-tight">
                Curate Your Coffee Dating Profile
              </h2>
              <p class="font-body-md text-body-md text-on-surface-variant">
                CupDate pairs intentional singles in Himachal Pradesh and India through sensory preferences, slow rituals, and neighborhood roasteries.
              </p>
            </div>

            <!-- Google 1-Click Sign-up -->
            <a href="{{ route('auth.google') }}" class="flex items-center justify-center gap-space-sm px-space-md py-3 bg-surface-container hover:bg-surface-container-high transition-all text-on-surface font-label-md text-label-md rounded-full shadow-sm border border-outline-variant/30 group">
              <svg class="w-4 h-4 shrink-0" viewBox="0 0 24 24">
                <path d="M12 5c1.6 0 3 .6 4.1 1.6l3.1-3.1C17.3 1.7 14.8 1 12 1 7.4 1 3.5 3.6 1.6 7.3l3.7 2.9C6.2 7.3 8.9 5 12 5z" fill="#EA4335"></path>
                <path d="M23.5 12.3c0-.8-.1-1.6-.2-2.3H12v4.5h6.5c-.3 1.5-1.1 2.8-2.4 3.7l3.7 2.9c2.2-2 3.7-5 3.7-8.8z" fill="#4285F4"></path>
                <path d="M5.3 14.8c-.2-.7-.4-1.5-.4-2.3 0-.8.2-1.6.4-2.3L1.6 7.3C.6 9.3 0 11.6 0 14.2s.6 4.9 1.6 6.9l3.7-3.3z" fill="#FBBC05"></path>
                <path d="M12 23.4c3.2 0 6-1.1 8-3l-3.7-2.9c-1.1.7-2.5 1.2-4.3 1.2-3.1 0-5.8-2.3-6.7-5.2L1.6 16.8C3.5 20.8 7.4 23.4 12 23.4z" fill="#34A853"></path>
              </svg>
              <span class="font-bold">1-Click Sign Up with Google</span>
              <span class="text-xs bg-emerald-100 text-emerald-800 font-bold px-2 py-0.5 rounded-full ml-auto">Instant</span>
            </a>

            <!-- Divider -->
            <div class="flex items-center gap-space-md">
              <div class="flex-grow h-px bg-outline-variant/50"></div>
              <span class="font-label-sm text-label-sm text-on-surface-variant/80 uppercase tracking-widest">or complete application</span>
              <div class="flex-grow h-px bg-outline-variant/50"></div>
            </div>

            <!-- Laravel Registration Form -->
            <form action="{{ route('register.submit') }}" method="POST" class="flex flex-col gap-space-md" id="registrationForm">
              @csrf

              <!-- Top Auto-Detect Location Prompt -->
              <div class="flex items-center justify-between p-3 rounded-2xl bg-surface-container-high/60 border border-outline-variant/40">
                <div class="flex items-center gap-2 text-xs font-semibold text-on-surface">
                  <span class="material-symbols-outlined text-base text-[#d65b6c]">location_on</span>
                  <span id="detectedLocationLabel">Auto-detecting your nearest dating city...</span>
                </div>
                <button type="button" onclick="detectUserLocation()" id="detectBtn" class="text-xs font-bold text-secondary hover:underline cursor-pointer">
                  Detect GPS
                </button>
              </div>

              <!-- Name & City Row -->
              <div class="grid grid-cols-1 sm:grid-cols-2 gap-space-md">
                <div class="flex flex-col gap-1.5">
                  <label class="font-label-md text-label-md text-on-surface font-semibold" for="reg-name">Your Full Name</label>
                  <div class="relative flex items-center">
                    <span class="material-symbols-outlined absolute left-3.5 text-secondary text-lg">person</span>
                    <input class="w-full pl-11 pr-4 py-space-sm bg-surface-container-high rounded-full font-body-md text-body-md text-on-surface focus:outline-none focus:bg-surface-container focus:ring-2 focus:ring-secondary/40 transition-all" 
                           id="reg-name" name="full_name" value="{{ old('full_name') }}" required placeholder="e.g. Tanya Sharma" type="text"/>
                  </div>
                </div>

                <div class="flex flex-col gap-1.5">
                  <label class="font-label-md text-label-md text-on-surface font-semibold" for="reg-city">City / District</label>
                  <div class="relative flex items-center">
                    <span class="material-symbols-outlined absolute left-3.5 text-secondary text-lg">location_on</span>
                    <select class="w-full pl-11 pr-8 py-space-sm bg-surface-container-high rounded-full font-body-md text-body-md text-on-surface focus:outline-none focus:bg-surface-container focus:ring-2 focus:ring-secondary/40 transition-all appearance-none cursor-pointer" 
                            id="reg-city" name="city" required>
                      <optgroup label="🏔️ Himachal Pradesh (All Districts)">
                        <option value="Kangra, Himachal Pradesh">Kangra</option>
                        <option value="Solan, Himachal Pradesh">Solan</option>
                        <option value="Shimla, Himachal Pradesh" selected>Shimla</option>
                        <option value="Dharamshala, Himachal Pradesh">Dharamshala &amp; McLeodGanj</option>
                        <option value="Manali, Himachal Pradesh">Manali &amp; Old Manali</option>
                        <option value="Mandi, Himachal Pradesh">Mandi (Chhoti Kashi)</option>
                        <option value="Kullu, Himachal Pradesh">Kullu</option>
                        <option value="Hamirpur, Himachal Pradesh">Hamirpur</option>
                        <option value="Bilaspur, Himachal Pradesh">Bilaspur</option>
                        <option value="Una, Himachal Pradesh">Una</option>
                        <option value="Chamba, Himachal Pradesh">Chamba</option>
                        <option value="Palampur, Himachal Pradesh">Palampur</option>
                        <option value="Dalhousie, Himachal Pradesh">Dalhousie</option>
                        <option value="Baddi, Himachal Pradesh">Baddi</option>
                      </optgroup>
                      <optgroup label="🌿 North India &amp; Tri-City">
                        <option value="Chandigarh, India">Chandigarh</option>
                        <option value="Mohali, Punjab">Mohali</option>
                        <option value="Panchkula, Haryana">Panchkula</option>
                        <option value="Delhi NCR, India">Delhi NCR</option>
                        <option value="Dehradun, Uttarakhand">Dehradun</option>
                        <option value="Amritsar, Punjab">Amritsar</option>
                        <option value="Ludhiana, Punjab">Ludhiana</option>
                      </optgroup>
                      <optgroup label="☕ Major Indian Metros">
                        <option value="Pune, India">Pune</option>
                        <option value="Mumbai, India">Mumbai</option>
                        <option value="Bangalore, India">Bangalore</option>
                        <option value="Jaipur, India">Jaipur</option>
                        <option value="Hyderabad, India">Hyderabad</option>
                        <option value="Kolkata, India">Kolkata</option>
                        <option value="Chennai, India">Chennai</option>
                        <option value="Ahmedabad, India">Ahmedabad</option>
                        <option value="Goa, India">Goa</option>
                      </optgroup>
                    </select>
                    <span class="material-symbols-outlined absolute right-3 pointer-events-none text-on-surface-variant text-base">expand_more</span>
                  </div>
                </div>
              </div>

              <!-- Email & Password Row -->
              <div class="grid grid-cols-1 sm:grid-cols-2 gap-space-md">
                <div class="flex flex-col gap-1.5">
                  <label class="font-label-md text-label-md text-on-surface font-semibold" for="reg-email">Email for Dispatches</label>
                  <div class="relative flex items-center">
                    <span class="material-symbols-outlined absolute left-3.5 text-secondary text-lg">mail</span>
                    <input class="w-full pl-11 pr-4 py-space-sm bg-surface-container-high rounded-full font-body-md text-body-md text-on-surface focus:outline-none focus:bg-surface-container focus:ring-2 focus:ring-secondary/40 transition-all" 
                           id="reg-email" name="email" value="{{ old('email') }}" required placeholder="tanya@gmail.com" type="email"/>
                  </div>
                </div>

                <div class="flex flex-col gap-1.5">
                  <div class="flex items-center justify-between">
                    <label class="font-label-md text-label-md text-on-surface font-semibold" for="reg-password">Password</label>
                    <span class="font-label-sm text-label-sm text-secondary">Min 6 characters</span>
                  </div>
                  <div class="relative flex items-center">
                    <span class="material-symbols-outlined absolute left-3.5 text-secondary text-lg">lock</span>
                    <input class="w-full pl-11 pr-4 py-space-sm bg-surface-container-high rounded-full font-body-md text-body-md text-on-surface focus:outline-none focus:bg-surface-container focus:ring-2 focus:ring-secondary/40 transition-all" 
                           id="reg-password" name="password" required minlength="6" placeholder="Choose a safe password" type="password"/>
                  </div>
                </div>
              </div>

              <!-- Date of Birth & Gender Row -->
              <div class="grid grid-cols-1 sm:grid-cols-2 gap-space-md">
                <div class="flex flex-col gap-1.5">
                  <label class="font-label-md text-label-md text-on-surface font-semibold" for="reg-dob">Date of Birth</label>
                  <input class="w-full px-4 py-space-sm bg-surface-container-high rounded-full font-body-md text-body-md text-on-surface focus:outline-none focus:bg-surface-container transition-all" 
                         id="reg-dob" name="dob" value="{{ old('dob', '2001-05-15') }}" required type="date"/>
                </div>

                <div class="flex flex-col gap-1.5">
                  <label class="font-label-md text-label-md text-on-surface font-semibold" for="reg-gender">Gender</label>
                  <select class="w-full px-4 py-space-sm bg-surface-container-high rounded-full font-body-md text-body-md text-on-surface focus:outline-none focus:bg-surface-container transition-all" 
                          id="reg-gender" name="gender" required>
                    <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                    <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                    <option value="nonbinary" {{ old('gender') == 'nonbinary' ? 'selected' : '' }}>Non-binary</option>
                    <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
                  </select>
                </div>
              </div>

              <!-- Interactive Selector 1: Signature Coffee Order -->
              <div class="flex flex-col gap-space-xs pt-space-xs">
                <div class="flex items-center justify-between">
                  <label class="font-label-md text-label-md text-on-surface font-semibold flex items-center gap-1.5">
                    <span class="material-symbols-outlined text-secondary text-base">coffee</span>
                    Your Signature Cafe Order (Choose 1 or 2)
                  </label>
                  <span class="font-label-sm text-label-sm text-on-surface-variant font-mono">Taste Compatibility</span>
                </div>
                <div class="flex flex-wrap gap-2" id="drink-chips">
                  @foreach(['Oat Cortado','Double Espresso','Pour-over (V60)','Iced Flat White','Himalayan French Press','Vanilla Oat Latte','Matcha Latte','Masala Chai Vibe'] as $index => $drink)
                    <button type="button" class="drink-chip px-space-md py-1.5 rounded-full font-label-md text-label-md transition-all duration-200 cursor-pointer {{ $index === 0 || $index === 5 ? 'selected-drink' : 'bg-surface-container-high text-on-surface-variant hover:bg-surface-container' }}" 
                            data-drink="{{ $drink }}" onclick="toggleDrinkChip(this)">
                      {{ $drink }}
                    </button>
                  @endforeach
                </div>
                <input type="hidden" name="coffee_style" id="coffeeStyleInput" value="Vanilla Oat Latte">
              </div>

              <!-- Interactive Selector 2: Ideal First Date Setting -->
              <div class="flex flex-col gap-space-xs pt-space-xs">
                <div class="flex items-center justify-between">
                  <label class="font-label-md text-label-md text-on-surface font-semibold flex items-center gap-1.5">
                    <span class="material-symbols-outlined text-secondary text-base">nest_eco_leaf</span>
                    Your Ideal First Date Setting
                  </label>
                  <span class="font-label-sm text-label-sm text-on-surface-variant">Atmosphere Match</span>
                </div>
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-space-xs" id="vibe-chips">
                  <div class="vibe-card p-space-sm rounded-2xl bg-surface-container-high text-left transition-all selected-vibe flex flex-col gap-1 cursor-pointer" 
                       data-vibe="Quiet Mountain Veranda" onclick="selectVibeCard(this)">
                    <span class="material-symbols-outlined vibe-icon text-secondary text-lg">chair</span>
                    <span class="font-label-md text-label-md font-semibold text-on-surface leading-tight">Quiet Mountain Veranda</span>
                    <span class="font-body-sm text-[11px] leading-tight text-on-surface-variant">Intimate talks</span>
                  </div>
                  <div class="vibe-card p-space-sm rounded-2xl bg-surface-container-high text-left transition-all hover:bg-surface-container flex flex-col gap-1 cursor-pointer" 
                       data-vibe="Vibrant Roastery" onclick="selectVibeCard(this)">
                    <span class="material-symbols-outlined vibe-icon text-secondary text-lg">factory</span>
                    <span class="font-label-md text-label-md font-semibold text-on-surface leading-tight">Vibrant Roastery</span>
                    <span class="font-body-sm text-[11px] leading-tight text-on-surface-variant">Lively energy</span>
                  </div>
                  <div class="vibe-card p-space-sm rounded-2xl bg-surface-container-high text-left transition-all hover:bg-surface-container flex flex-col gap-1 cursor-pointer" 
                       data-vibe="Sunlit Riverside Bench" onclick="selectVibeCard(this)">
                    <span class="material-symbols-outlined vibe-icon text-secondary text-lg">wb_sunny</span>
                    <span class="font-label-md text-label-md font-semibold text-on-surface leading-tight">Riverside Bench</span>
                    <span class="font-body-sm text-[11px] leading-tight text-on-surface-variant">Nature stroll</span>
                  </div>
                  <div class="vibe-card p-space-sm rounded-2xl bg-surface-container-high text-left transition-all hover:bg-surface-container flex flex-col gap-1 cursor-pointer" 
                       data-vibe="Artisan Pastry Walk" onclick="selectVibeCard(this)">
                    <span class="material-symbols-outlined vibe-icon text-secondary text-lg">bakery_dining</span>
                    <span class="font-label-md text-label-md font-semibold text-on-surface leading-tight">Pastry Walk</span>
                    <span class="font-body-sm text-[11px] leading-tight text-on-surface-variant">Morning walk</span>
                  </div>
                </div>
                <input type="hidden" name="interested_in" id="vibeInput" value="Quiet Mountain Veranda">
              </div>

              <!-- Curated Vetting Box -->
              <div class="p-space-md rounded-2xl bg-surface-container-low flex items-start gap-space-sm shadow-sm border border-outline-variant/30">
                <span class="material-symbols-outlined text-secondary text-xl mt-0.5">shield_with_heart</span>
                <div class="flex flex-col gap-0.5">
                  <span class="font-label-md text-label-md font-semibold text-on-surface">The CupDate Curator Guarantee</span>
                  <p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
                    Every member profile is verified. We guarantee zero bots, no ghosting culture, and authentic coffee lovers in your city who genuinely desire in-person dates.
                  </p>
                </div>
              </div>

              <!-- Submit Button -->
              <button class="mt-space-xs w-full py-3.5 px-space-lg rounded-full bg-on-tertiary-container text-on-tertiary font-label-lg text-label-lg font-semibold flex items-center justify-center gap-space-sm shadow-md hover:opacity-95 active:scale-[0.99] transition-all cursor-pointer" type="submit">
                <span class="material-symbols-outlined text-lg">send</span>
                <span>Submit Membership Application →</span>
              </button>

              <p class="font-body-sm text-[11px] text-center text-on-surface-variant/80">
                By submitting, you agree to CupDate's 
                <a class="underline hover:text-on-surface" href="{{ route('how.it.works') }}">Slow Dating Manifesto</a>, 
                <a class="underline hover:text-on-surface" href="{{ route('community.guidelines') }}">Code of Courtesy</a>, and 
                <a class="underline hover:text-on-surface" href="{{ route('privacy') }}">Privacy Terms (DPDP Act)</a>.
              </p>
            </form>
          </div>

          <!-- Bottom Assurance Highlights -->
          <div class="pt-space-md bg-surface-container-low/50 p-space-md rounded-2xl grid grid-cols-1 md:grid-cols-3 gap-space-md text-center border border-outline-variant/20">
            <div class="flex flex-col items-center gap-1">
              <span class="material-symbols-outlined text-secondary text-lg">psychology</span>
              <span class="font-label-sm text-label-sm font-semibold text-on-surface">Curated Intent</span>
              <span class="font-body-sm text-[11px] text-on-surface-variant">No infinite swipe fatigue</span>
            </div>
            <div class="flex flex-col items-center gap-1">
              <span class="material-symbols-outlined text-secondary text-lg">storefront</span>
              <span class="font-label-sm text-label-sm font-semibold text-on-surface">Specialty Cafes</span>
              <span class="font-body-sm text-[11px] text-on-surface-variant">320+ partnered roasters in HP &amp; India</span>
            </div>
            <div class="flex flex-col items-center gap-1">
              <span class="material-symbols-outlined text-secondary text-lg">alarm_on</span>
              <span class="font-label-sm text-label-sm font-semibold text-on-surface">45-Minute Ritual</span>
              <span class="font-body-sm text-[11px] text-on-surface-variant">Low-pressure chemistry test</span>
            </div>
          </div>

        </div>
      </div>
    </div>

  </div>

  <!-- Toast Notification Overlay -->
  <div class="fixed bottom-6 right-6 z-50 transform translate-y-20 opacity-0 transition-all duration-300 pointer-events-none" id="auth-toast">
    <div class="bg-primary-container text-inverse-on-surface px-space-lg py-space-sm rounded-full shadow-xl flex items-center gap-space-sm">
      <span class="material-symbols-outlined text-on-tertiary-container">coffee_maker</span>
      <span class="font-label-md text-label-md font-medium" id="toast-message">Preparing your tasting dossier...</span>
    </div>
  </div>

</div>

<script>
  // Tab Switching between Sign In and Join CupDate
  function switchAuthTab(target) {
    const viewSignin = document.getElementById('view-signin');
    const viewRegister = document.getElementById('view-register');
    const btnSignin = document.getElementById('tab-signin');
    const btnRegister = document.getElementById('tab-register');

    if (target === 'signin') {
      viewSignin.classList.remove('hidden');
      viewSignin.classList.add('flex');
      viewRegister.classList.add('hidden');
      viewRegister.classList.remove('flex');

      btnSignin.className = "px-space-lg py-space-xs rounded-full font-label-md text-label-md transition-all duration-300 active-tab-btn";
      btnRegister.className = "px-space-lg py-space-xs rounded-full font-label-md text-label-md transition-all duration-300 inactive-tab-btn";
      window.history.replaceState(null, '', '{{ route("login") }}');
    } else {
      viewSignin.classList.add('hidden');
      viewSignin.classList.remove('flex');
      viewRegister.classList.remove('hidden');
      viewRegister.classList.add('flex');

      btnRegister.className = "px-space-lg py-space-xs rounded-full font-label-md text-label-md transition-all duration-300 active-tab-btn";
      btnSignin.className = "px-space-lg py-space-xs rounded-full font-label-md text-label-md transition-all duration-300 inactive-tab-btn";
      window.history.replaceState(null, '', '{{ route("register") }}');
    }
  }

  // Toggle multi-select coffee order pill chips
  const selectedDrinks = new Set(['Vanilla Oat Latte']);
  function toggleDrinkChip(button) {
    const drink = button.getAttribute('data-drink');
    if (selectedDrinks.has(drink)) {
      if (selectedDrinks.size > 1) {
        selectedDrinks.delete(drink);
        button.classList.remove('selected-drink');
        button.classList.add('bg-surface-container-high', 'text-on-surface-variant');
      }
    } else {
      selectedDrinks.add(drink);
      button.classList.add('selected-drink');
      button.classList.remove('bg-surface-container-high', 'text-on-surface-variant');
    }
    document.getElementById('coffeeStyleInput').value = Array.from(selectedDrinks).join(', ');
  }

  // Single select date vibe card
  function selectVibeCard(element) {
    document.querySelectorAll('.vibe-card').forEach(card => {
      card.classList.remove('selected-vibe');
      card.classList.add('bg-surface-container-high');
    });
    element.classList.add('selected-vibe');
    element.classList.remove('bg-surface-container-high');
    document.getElementById('vibeInput').value = element.getAttribute('data-vibe');
  }

  // Password visibility toggle
  function togglePasswordVisibility(inputId, triggerBtn) {
    const input = document.getElementById(inputId);
    const icon = triggerBtn.querySelector('.material-symbols-outlined');
    if (input.type === 'password') {
      input.type = 'text';
      icon.textContent = 'visibility_off';
    } else {
      input.type = 'password';
      icon.textContent = 'visibility';
    }
  }

  // Toast Notification Simulation
  let toastTimeout;
  function simulateToast(msg) {
    const toast = document.getElementById('auth-toast');
    const label = document.getElementById('toast-message');
    if (!toast || !label) return;

    label.textContent = msg;
    clearTimeout(toastTimeout);
    toast.classList.remove('translate-y-20', 'opacity-0');
    toast.classList.add('translate-y-0', 'opacity-100');

    toastTimeout = setTimeout(() => {
      toast.classList.remove('translate-y-0', 'opacity-100');
      toast.classList.add('translate-y-20', 'opacity-0');
    }, 3200);
  }

  // GPS Location Detection
  const GPS_CITIES = [
    { name: 'Kangra, Himachal Pradesh', lat: 32.0998, lng: 76.2691 },
    { name: 'Solan, Himachal Pradesh', lat: 30.9084, lng: 77.0999 },
    { name: 'Shimla, Himachal Pradesh', lat: 31.1048, lng: 77.1734 },
    { name: 'Dharamshala, Himachal Pradesh', lat: 32.2190, lng: 76.3234 },
    { name: 'Manali, Himachal Pradesh', lat: 32.2432, lng: 77.1892 },
    { name: 'Mandi, Himachal Pradesh', lat: 31.7087, lng: 76.9320 },
    { name: 'Kullu, Himachal Pradesh', lat: 31.9579, lng: 77.1095 },
    { name: 'Hamirpur, Himachal Pradesh', lat: 31.6862, lng: 76.5213 },
    { name: 'Bilaspur, Himachal Pradesh', lat: 31.3326, lng: 76.7570 },
    { name: 'Una, Himachal Pradesh', lat: 31.4685, lng: 76.2708 },
    { name: 'Palampur, Himachal Pradesh', lat: 32.1109, lng: 76.5363 },
    { name: 'Chandigarh, India', lat: 30.7333, lng: 76.7794 },
    { name: 'Mohali, Punjab', lat: 30.7046, lng: 76.7179 },
    { name: 'Delhi NCR, India', lat: 28.6139, lng: 77.2090 },
    { name: 'Pune, India', lat: 18.5204, lng: 73.8567 },
    { name: 'Mumbai, India', lat: 19.0760, lng: 72.8777 },
    { name: 'Bangalore, India', lat: 12.9716, lng: 77.5946 }
  ];

  function detectUserLocation() {
    const label = document.getElementById('detectedLocationLabel');
    const btn = document.getElementById('detectBtn');
    if (!navigator.geolocation) {
      if (label) label.innerText = "Location detection not supported by browser";
      return;
    }

    if (label) label.innerText = "Querying GPS satellites...";
    if (btn) btn.innerText = "Locating...";

    navigator.geolocation.getCurrentPosition(
      (pos) => {
        const uLat = pos.coords.latitude;
        const uLng = pos.coords.longitude;
        let closest = GPS_CITIES[0];
        let minDist = 999999;

        GPS_CITIES.forEach(c => {
          const d = Math.hypot(uLat - c.lat, uLng - c.lng);
          if (d < minDist) {
            minDist = d;
            closest = c;
          }
        });

        if (label) {
          label.innerHTML = `📍 Nearest Coffee Hub: <strong class="text-secondary font-bold">${closest.name.split(',')[0]}</strong>`;
        }
        if (btn) btn.innerText = "Auto-Matched ✓";

        const citySelect = document.getElementById('reg-city');
        if (citySelect) {
          citySelect.value = closest.name;
        }
      },
      (err) => {
        if (label) label.innerText = "Location permission optional. Select your city below.";
        if (btn) btn.innerText = "Retry";
      }
    );
  }

  document.addEventListener('DOMContentLoaded', () => {
    if (navigator.geolocation && "{{ $initialTab }}" === 'register') {
      detectUserLocation();
    }
  });
</script>
@endsection
