@extends('layouts.app')

@section('title', ($activePartner ? 'Chat with ' . $activePartner->full_name . ' — CupDate Messages' : 'Messages & Date Concierge — CupDate'))

@section('extra_css')
<style>
  /* Custom scrollbar for conversational streams */
  .chat-scrollbar::-webkit-scrollbar {
    width: 5px;
    height: 5px;
  }
  .chat-scrollbar::-webkit-scrollbar-thumb {
    background: rgba(131, 83, 57, 0.2);
    border-radius: 99px;
  }
  .chat-scrollbar::-webkit-scrollbar-track {
    background: transparent;
  }
  .scrollbar-none::-webkit-scrollbar {
    display: none;
  }
  .scrollbar-none {
    -ms-overflow-style: none;
    scrollbar-width: none;
  }

  /* Bubble Styling */
  .bubble-me {
    background: #000000;
    color: #ffffff;
    border-bottom-right-radius: 4px !important;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
  }
  .bubble-partner {
    background: #f1dfd8;
    color: #231a15;
    border-bottom-left-radius: 4px !important;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
  }

  /* Selected active conversation item */
  .active-chat-item {
    background-color: #f1dfd8 !important;
    border-left: 4px solid #d65b6c !important;
  }

  /* Mobile responsiveness */
  @media (max-width: 1023px) {
    .pane-conversations.hidden-mobile {
      display: none !important;
    }
    .pane-chat.hidden-mobile {
      display: none !important;
    }
    .pane-concierge.hidden-mobile {
      display: none !important;
    }
  }
</style>
@endsection

@section('content')
<div class="flex flex-col w-full bg-surface min-h-[calc(100vh-80px)]">

  <div class="max-w-[1360px] w-full mx-auto px-3 sm:px-6 lg:px-margin-desktop py-4 sm:py-6">
    
    <!-- Breadcrumb & Editorial Header Subtitle -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 pb-3 mb-2 border-b border-outline-variant/30">
      <div class="flex items-center gap-space-xs font-label-md text-label-md text-on-surface-variant">
        <a href="{{ route('home') }}" class="hover:text-on-surface transition-colors">CupDate Chapters</a>
        <span class="text-secondary">•</span>
        <span class="text-on-surface font-semibold">Messages &amp; Date Concierge</span>
      </div>
      <div class="flex items-center gap-space-sm text-secondary font-label-sm text-label-sm">
        <span class="inline-block w-2 h-2 rounded-full bg-emerald-700 animate-pulse"></span>
        <span>Concierge Synchronized · 256-Bit Encrypted · Partner Roastery Network</span>
      </div>
    </div>

    <!-- Mobile View Switcher Tabs (Visible only on screens < 1024px) -->
    <div class="lg:hidden flex items-center justify-around bg-surface-container-low p-1 rounded-2xl mb-3 shadow-xs" id="mobileTabsBar">
      <button onclick="switchMobilePane('convos')" id="mTabConvos" class="flex-1 py-2 rounded-xl text-xs font-bold transition-all bg-surface text-on-surface shadow-xs flex items-center justify-center gap-1.5">
        <span class="material-symbols-outlined text-base">forum</span>
        <span>Chats ({{ $partners->count() }})</span>
      </button>
      <button onclick="switchMobilePane('chat')" id="mTabChat" class="flex-1 py-2 rounded-xl text-xs font-medium text-on-surface-variant transition-all flex items-center justify-center gap-1.5">
        <span class="material-symbols-outlined text-base">chat_bubble</span>
        <span>Conversation</span>
      </button>
      <button onclick="switchMobilePane('concierge')" id="mTabConcierge" class="flex-1 py-2 rounded-xl text-xs font-medium text-on-surface-variant transition-all flex items-center justify-center gap-1.5">
        <span class="material-symbols-outlined text-base">storefront</span>
        <span>Café Concierge</span>
      </button>
    </div>

    <!-- Main 3-Pane Editorial Messaging Interface -->
    <div class="grid grid-cols-12 gap-space-md bg-surface-container-lowest rounded-2xl shadow-xl p-space-sm border border-outline-variant/30 overflow-hidden min-h-[760px]">
      
      <!-- ========================================== -->
      <!-- PANE 1: CONVERSATIONS & MATCHES (Cols 1-4) -->
      <!-- ========================================== -->
      <aside id="paneConvos" class="pane-conversations col-span-12 lg:col-span-4 xl:col-span-3 flex flex-col bg-surface-container-low/50 rounded-xl p-space-md overflow-hidden border border-outline-variant/20">
        
        <!-- Title & Filter Section -->
        <div class="flex items-center justify-between pb-space-sm">
          <div class="flex items-center gap-space-xs">
            <h2 class="font-headline-sm text-headline-sm text-on-surface font-semibold">Conversations</h2>
            <span class="px-2 py-0.5 rounded-full bg-surface-container-high text-secondary font-label-sm text-label-sm font-bold">{{ $partners->count() }}</span>
          </div>
          <a href="{{ route('swipes') }}" class="w-8 h-8 rounded-full bg-surface-container flex items-center justify-center text-on-surface-variant hover:text-on-surface hover:bg-surface-container-high transition-colors" title="Discover more singles">
            <span class="material-symbols-outlined text-base">person_add</span>
          </a>
        </div>

        <!-- Search Box (Editorial Style) -->
        <div class="relative my-space-xs">
          <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline text-base">search</span>
          <input type="text" id="partnerSearchInput" onkeyup="filterPartnersList()" class="w-full bg-surface-container rounded-full pl-9 pr-space-md py-2 font-body-sm text-body-sm text-on-surface placeholder:text-outline focus:outline-none focus:ring-1 focus:ring-secondary transition-all" placeholder="Search matches or cafés..."/>
        </div>

        <!-- Carousel: New Sparks / Matches -->
        <div class="pt-space-sm pb-space-md border-b border-outline-variant/30">
          <div class="flex items-center justify-between mb-space-xs">
            <span class="font-label-sm text-label-sm uppercase tracking-wider text-secondary font-bold">New Sparks ({{ $sparks->count() }})</span>
            <a href="{{ route('swipes') }}" class="font-label-sm text-label-sm text-on-tertiary-container hover:underline cursor-pointer font-semibold">View Deck</a>
          </div>
          <div class="flex items-center gap-3 overflow-x-auto pb-1 scrollbar-none">
            @forelse($sparks as $spark)
              <a href="{{ route('messages', ['user_id' => $spark->id]) }}" class="flex flex-col items-center gap-1 shrink-0 cursor-pointer group text-center" title="{{ $spark->full_name }}">
                <div class="relative p-0.5 rounded-full {{ $activePartner && $activePartner->id === $spark->id ? 'bg-secondary ring-2 ring-secondary' : 'bg-outline-variant/60 group-hover:bg-secondary' }} transition-all">
                  <img class="w-12 h-12 rounded-full object-cover group-hover:scale-105 transition-transform" 
                       src="{{ $spark->avatar_url }}" 
                       loading="lazy"
                       alt="{{ $spark->full_name }}"/>
                  <span class="absolute -bottom-0.5 -right-0.5 bg-on-tertiary-container text-on-tertiary rounded-full w-4 h-4 flex items-center justify-center text-[9px] shadow-sm font-bold">☕</span>
                </div>
                <span class="font-label-sm text-label-sm text-on-surface font-medium truncate max-w-[56px]">{{ explode(' ', $spark->full_name)[0] }}</span>
              </a>
            @empty
              <p class="text-xs text-on-surface-variant py-2">Swipe on members to unlock sparks!</p>
            @endforelse
          </div>
        </div>

        <!-- Conversations Stream -->
        <div class="flex flex-col gap-1.5 overflow-y-auto flex-1 pr-1 pt-2 chat-scrollbar" id="partnerListContainer">
          @forelse($partners as $partner)
            @php 
              $isActive = ($activePartner && $activePartner->id === $partner->id);
              $previewText = $partner->latest_message ? $partner->latest_message->message : 'Start your coffee conversation...';
              $previewTime = $partner->latest_message ? \Carbon\Carbon::parse($partner->latest_message->created_at)->format('H:i') : '';
            @endphp
            <a href="{{ route('messages', ['user_id' => $partner->id]) }}" 
               class="partner-item p-space-sm rounded-xl transition-all cursor-pointer relative {{ $isActive ? 'active-chat-item shadow-sm' : 'hover:bg-surface-container bg-surface-container-lowest/70' }} flex items-start gap-space-sm"
               data-name="{{ strtolower($partner->full_name) }}">
              <div class="relative shrink-0">
                <img class="w-11 h-11 rounded-full object-cover ring-1 ring-outline-variant/40" 
                     src="{{ $partner->avatar_url }}" 
                     loading="lazy"
                     alt="{{ $partner->full_name }}"/>
                <span class="absolute bottom-0 right-0 w-2.5 h-2.5 rounded-full bg-emerald-700 ring-2 ring-surface"></span>
              </div>
              <div class="flex-1 min-w-0">
                <div class="flex items-center justify-between">
                  <div class="flex items-center gap-1.5 truncate">
                    <span class="font-label-lg text-label-lg text-on-surface font-semibold truncate">{{ $partner->full_name }}</span>
                    @if($partner->is_verified)
                      <span class="material-symbols-outlined text-emerald-600 text-xs shrink-0">verified</span>
                    @endif
                  </div>
                  <span class="font-label-sm text-label-sm text-on-tertiary-container font-semibold shrink-0">{{ $previewTime }}</span>
                </div>
                <p class="font-body-sm text-body-sm text-on-surface-variant truncate mt-0.5">
                  {{ $previewText }}
                </p>
                @if($partner->unread_count > 0)
                  <div class="flex items-center gap-2 mt-1.5">
                    <span class="px-2 py-0.5 rounded-full bg-on-tertiary-container text-on-tertiary font-label-sm text-label-sm font-bold">
                      {{ $partner->unread_count }} New
                    </span>
                    <span class="w-1.5 h-1.5 rounded-full bg-on-tertiary-container shrink-0"></span>
                  </div>
                @else
                  <div class="flex items-center gap-2 mt-1.5 text-secondary text-[11px] font-medium">
                    <span>☕ {{ $partner->coffee_style ?? 'Specialty Brew' }}</span>
                  </div>
                @endif
              </div>
            </a>
          @empty
            <div class="p-6 text-center text-on-surface-variant flex flex-col items-center gap-2">
              <span class="material-symbols-outlined text-4xl text-secondary">forum</span>
              <p class="text-xs font-medium">No conversations yet.</p>
              <a href="{{ route('swipes') }}" class="px-4 py-1.5 rounded-full bg-on-tertiary-container text-on-tertiary text-xs font-bold shadow-sm">Meet Singles Nearby</a>
            </div>
          @endforelse
        </div>
      </aside>

      <!-- ========================================== -->
      <!-- PANE 2: ACTIVE CHAT THREAD (Cols 5-8 / 6) -->
      <!-- ========================================== -->
      <section id="paneChat" class="pane-chat col-span-12 lg:col-span-8 xl:col-span-6 flex flex-col bg-surface-container-lowest rounded-xl h-[calc(100vh-140px)] sm:h-[740px] max-h-[85vh] border border-outline-variant/20 shadow-sm relative overflow-hidden">
        @if($activePartner)
          <!-- Chat Header -->
          <div class="px-space-md py-space-sm bg-surface-container-low/60 rounded-t-xl flex items-center justify-between border-b border-outline-variant/30">
            <div class="flex items-center gap-space-sm min-w-0">
              <!-- Back to list button (mobile only) -->
              <button onclick="switchMobilePane('convos')" class="lg:hidden p-1.5 text-on-surface-variant hover:text-on-surface rounded-full bg-surface-container shrink-0">
                <span class="material-symbols-outlined text-base">arrow_back</span>
              </button>

              <div class="relative shrink-0">
                <img class="w-11 h-11 rounded-full object-cover ring-2 ring-surface" 
                     src="{{ $activePartner->avatar_url }}" 
                     alt="{{ $activePartner->full_name }}"/>
                <span class="absolute bottom-0 right-0 w-2.5 h-2.5 rounded-full bg-emerald-700 ring-2 ring-surface"></span>
              </div>
              <div class="min-w-0">
                <div class="flex items-center gap-space-xs truncate">
                  <h3 class="font-headline-sm text-headline-sm text-on-surface font-semibold truncate">{{ $activePartner->full_name }}</h3>
                  <span class="text-on-tertiary-container font-label-sm text-label-sm font-bold shrink-0">• Match 96%</span>
                </div>
                <p class="font-body-sm text-body-sm text-on-surface-variant flex items-center gap-1 truncate">
                  <span class="material-symbols-outlined text-xs text-secondary shrink-0">coffee</span>
                  <span class="truncate">Prefers {{ $activePartner->coffee_style ?? 'Single-Origin Pour-over' }} · {{ $activePartner->country ?? 'Himachal Pradesh' }}</span>
                </p>
              </div>
            </div>

            <div class="flex items-center gap-1 sm:gap-space-xs shrink-0">
              <a href="{{ route('profile', $activePartner->id) }}" class="px-3 sm:px-space-md py-1.5 rounded-full bg-surface-container hover:bg-surface-container-high text-on-surface font-label-md text-label-md transition-colors flex items-center gap-1">
                <span class="material-symbols-outlined text-base">person</span>
                <span class="hidden sm:inline">Dossier</span>
              </a>
              <!-- Mobile toggle to view Concierge Pane -->
              <button onclick="switchMobilePane('concierge')" class="xl:hidden p-1.5 rounded-full bg-surface-container hover:bg-surface-container-high text-on-surface-variant flex items-center justify-center transition-colors" title="View Date Concierge">
                <span class="material-symbols-outlined text-base">storefront</span>
              </button>
            </div>
          </div>

          <!-- Chat Body Scroll Area -->
          <div class="flex-1 overflow-y-auto px-3 sm:px-4 py-3 sm:py-4 space-y-3 bg-gradient-to-b from-surface/20 to-transparent chat-scrollbar scroll-smooth" id="chatScrollArea">
            
            <!-- Date Separator -->
            <div class="flex items-center justify-center my-2">
              <span class="px-space-md py-0.5 rounded-full bg-surface-container-high text-on-surface-variant font-label-sm text-label-sm uppercase tracking-wider font-semibold">
                Conversation · Safe Meet Protected
              </span>
            </div>

            <!-- Existing Message Bubbles -->
            <div id="messagesContainer" class="flex flex-col gap-3 px-3">
              @forelse($messages as $msg)
                @php $isMe = ($msg->sender_id === $user->id); @endphp
                @if($isMe)
                  <!-- Sent by You -->
                  <div class="flex flex-col items-end gap-1 ml-auto max-w-[82%] message-item" data-id="{{ $msg->id }}">
                    <div class="p-3.5 rounded-2xl bubble-me text-sm leading-relaxed font-body-md">
                      {{ $msg->message }}
                      @if($msg->attachment)
                        <div class="mt-2 rounded-xl overflow-hidden max-w-[240px]">
                          <img src="{{ $msg->attachment_url }}" alt="Attachment" class="w-full h-auto object-cover"/>
                        </div>
                      @endif
                    </div>
                    <span class="font-label-sm text-label-sm text-outline pr-1">{{ \Carbon\Carbon::parse($msg->created_at)->format('H:i') }} • Sent</span>
                  </div>
                @else
                  <!-- Received from Partner -->
                  <div class="flex items-end gap-space-xs max-w-[82%] message-item" data-id="{{ $msg->id }}">
                    <img class="w-7 h-7 rounded-full object-cover shrink-0 mb-1" src="{{ $activePartner->avatar_url }}" alt="{{ $activePartner->full_name }}"/>
                    <div class="flex flex-col gap-1">
                      <div class="p-3.5 rounded-2xl bubble-partner text-sm leading-relaxed font-body-md">
                        {{ $msg->message }}
                        @if($msg->attachment)
                          <div class="mt-2 rounded-xl overflow-hidden max-w-[240px]">
                            <img src="{{ $msg->attachment_url }}" alt="Attachment" class="w-full h-auto object-cover"/>
                          </div>
                        @endif
                      </div>
                      <span class="font-label-sm text-label-sm text-outline pl-1">{{ \Carbon\Carbon::parse($msg->created_at)->format('H:i') }}</span>
                    </div>
                  </div>
                @endif
              @empty
                <!-- Welcome starter when no chat history yet -->
                <div class="p-5 text-center my-4 bg-surface-container-low/40 rounded-2xl border border-outline-variant/30 flex flex-col items-center gap-2">
                  <span class="text-3xl">☕</span>
                  <h4 class="font-headline-sm text-headline-sm font-semibold text-on-surface">Break the Ice with {{ $activePartner->full_name }}</h4>
                  <p class="font-body-sm text-body-sm text-on-surface-variant max-w-md">
                    Invite {{ explode(' ', $activePartner->full_name)[0] }} for an intentional 45-minute coffee ritual at one of our vetted neighborhood cafés.
                  </p>
                </div>
              @endforelse

              <!-- SPECIAL IN-CHAT INTERACTIVE CARD: DATE INVITATION PENDING -->
              <div class="my-3 bg-surface-container-high/90 rounded-2xl p-space-md shadow-md border border-outline-variant/40" id="dateInvitationCard">
                <div class="flex items-center justify-between pb-space-xs">
                  <div class="flex items-center gap-space-xs">
                    <div class="w-8 h-8 rounded-full bg-on-tertiary-container text-on-tertiary flex items-center justify-center font-bold">
                      <span class="material-symbols-outlined text-base">event_available</span>
                    </div>
                    <div>
                      <span class="font-label-sm text-label-sm uppercase tracking-wider text-on-tertiary-container font-bold">Coffee Date Invitation</span>
                      <p class="font-label-md text-label-md text-on-surface font-semibold">Specialty Roastery Rendezvous</p>
                    </div>
                  </div>
                  <span class="px-space-sm py-1 rounded-full bg-surface-container-lowest text-secondary font-label-sm text-label-sm font-bold shadow-xs">
                    45-Min Ritual
                  </span>
                </div>
                
                <!-- Card Body with Venue Thumbnail -->
                <div class="mt-space-sm flex flex-col sm:flex-row gap-space-sm bg-surface-container-lowest rounded-xl p-space-sm border border-outline-variant/20">
                  <img class="w-full sm:w-28 h-24 object-cover rounded-lg" 
                       loading="lazy"
                       src="https://lh3.googleusercontent.com/aida-public/AB6AXuAr8eDXuka1Sai2o50SPcJahLlh7xvIOwMvCjJ5pt3mZfykjajCX8Ncy4P6q9cAZgsYqtASJJgOvql6Dp0f9qEJ_PcVMPlLkmImj9cf1XwEHPvBPzY1rzGd-EE9ygUx9vH_e0CYWFjunNnEwnJKaKKWKGG55rRbuTvvkCX3C_WNugTJOSxq9eq1yMwMy7N_cncK0U2pa5vj7PSH9AW-ouRXPyH3U4d60qm9lUMRs8h0rKK9ZvM1-ck9Sw"
                       alt="Artisanal Roastery Venue"/>
                  <div class="flex-1 flex flex-col justify-between">
                    <div>
                      <div class="flex items-center justify-between">
                        <h4 class="font-headline-sm text-headline-sm text-on-surface font-semibold">The Himalayan Roastery &amp; Café</h4>
                        <span class="text-secondary font-label-sm text-label-sm font-bold">4.9 ★</span>
                      </div>
                      <p class="font-body-sm text-body-sm text-on-surface-variant flex items-center gap-1 mt-0.5">
                        <span class="material-symbols-outlined text-xs text-secondary">location_on</span>
                        <span>Near {{ $activePartner->country ?? 'Kangra / Mall Road' }}</span>
                      </p>
                    </div>
                    <div class="flex items-center gap-space-sm text-on-surface font-label-md text-label-md mt-2">
                      <span class="flex items-center gap-1 text-on-tertiary-container font-semibold">
                        <span class="material-symbols-outlined text-sm">schedule</span>
                        This Weekend · 4:00 PM
                      </span>
                      <span class="text-outline">•</span>
                      <span class="text-on-surface-variant text-body-sm">Veranda by Garden</span>
                    </div>
                  </div>
                </div>

                <!-- Action Buttons Inside Card -->
                <div class="mt-space-sm pt-space-xs flex flex-wrap items-center gap-space-sm">
                  <button onclick="acceptDateInvite()" class="flex-1 min-w-[170px] py-2.5 px-space-md rounded-full bg-on-tertiary-container hover:opacity-95 text-on-tertiary font-label-md text-label-md flex items-center justify-center gap-1.5 shadow-sm transition-all font-bold cursor-pointer">
                    <span class="material-symbols-outlined text-base">check_circle</span>
                    <span>Accept &amp; Add to Calendar</span>
                  </button>
                  <button onclick="sendQuickReply('Could we meet on Saturday at 4:30 PM instead? ☕')" class="py-2.5 px-space-md rounded-full bg-surface-container hover:bg-surface-container-highest text-on-surface font-label-md text-label-md flex items-center justify-center gap-1.5 transition-all font-medium cursor-pointer">
                    <span class="material-symbols-outlined text-base">edit_calendar</span>
                    <span>Propose Alternate Time</span>
                  </button>
                </div>
              </div>
            </div>

          </div>

          <!-- Chat Input Area -->
          <div class="p-space-md bg-surface-container-low/50 rounded-b-xl border-t border-outline-variant/30">
            
            <!-- Quick Suggestions Carousel -->
            <div class="flex items-center gap-space-xs pb-space-xs overflow-x-auto scrollbar-none mb-2">
              <button onclick="sendQuickReply('☕ Specialty coffee sounds perfect! Let us make it happen.')" class="px-space-md py-1 rounded-full bg-surface-container hover:bg-surface-container-high text-on-surface font-label-sm text-label-sm flex items-center gap-1 shrink-0 transition-colors cursor-pointer">
                <span class="text-secondary">☕</span>
                <span>Coffee sounds perfect!</span>
              </button>
              <button onclick="sendQuickReply('Could we do 4:00 PM this Thursday? ☕')" class="px-space-md py-1 rounded-full bg-surface-container hover:bg-surface-container-high text-on-surface font-label-sm text-label-sm flex items-center gap-1 shrink-0 transition-colors cursor-pointer">
                <span class="material-symbols-outlined text-xs text-secondary">schedule</span>
                <span>Could we do 4:00 PM?</span>
              </button>
              <button onclick="sendQuickReply('What is your go-to roast profile? Ethiopian or Colombian?')" class="px-space-md py-1 rounded-full bg-surface-container hover:bg-surface-container-high text-on-surface font-label-sm text-label-sm flex items-center gap-1 shrink-0 transition-colors cursor-pointer">
                <span class="material-symbols-outlined text-xs text-secondary">local_cafe</span>
                <span>Favorite roast profile?</span>
              </button>
              <button onclick="sendQuickReply('Have you been to the new roastery spot downtown?')" class="px-space-md py-1 rounded-full bg-surface-container-high hover:bg-surface-container-highest text-secondary font-label-sm text-label-sm flex items-center gap-1 shrink-0 transition-colors cursor-pointer">
                <span class="material-symbols-outlined text-xs">storefront</span>
                <span>Suggest alternate café</span>
              </button>
            </div>

            <!-- Input Bar Form -->
            <form id="chatForm" onsubmit="event.preventDefault(); submitChatMessage();" class="flex items-center gap-space-xs bg-surface-container-lowest rounded-full p-1.5 shadow-sm border border-outline-variant/40">
              @csrf
              <input type="hidden" name="receiver_id" id="receiverId" value="{{ $activePartner->id }}">
              
              <!-- Quick Cafe Date Stamp Button -->
              <button type="button" onclick="sendQuickReply('☕ Would love to invite you for a 45-min coffee date this week! Let me know which spot you love.')" class="w-9 h-9 rounded-full hover:bg-surface-container text-secondary flex items-center justify-center transition-colors cursor-pointer" title="Send Coffee Date Proposal">
                <span class="material-symbols-outlined text-lg">local_cafe</span>
              </button>

              <!-- Photo upload input (hidden trigger) -->
              <input type="file" id="chatImageInput" name="image" accept="image/*" class="hidden" onchange="previewSelectedPhoto(this)">
              <button type="button" onclick="document.getElementById('chatImageInput').click()" class="w-9 h-9 rounded-full hover:bg-surface-container text-on-surface-variant flex items-center justify-center transition-colors cursor-pointer" title="Attach Photo">
                <span class="material-symbols-outlined text-lg">photo_camera</span>
              </button>

              <!-- Main text input -->
              <input type="text" id="chatInput" name="message" class="flex-1 bg-transparent px-space-xs font-body-md text-body-md text-on-surface placeholder:text-outline focus:outline-none" placeholder="Write a thoughtful note to {{ explode(' ', $activePartner->full_name)[0] }}..." autocomplete="off"/>

              <!-- Send Button -->
              <button type="submit" id="sendBtn" class="h-9 px-space-md rounded-full bg-primary hover:bg-primary-container text-on-primary font-label-md text-label-md flex items-center gap-1.5 transition-all shadow-sm active:scale-95 cursor-pointer">
                <span class="font-semibold">Send</span>
                <span class="material-symbols-outlined text-sm">arrow_upward</span>
              </button>
            </form>

            <!-- Attachment Preview Bar -->
            <div id="imagePreviewBar" class="hidden mt-2 p-2 rounded-xl bg-surface-container flex items-center justify-between">
              <div class="flex items-center gap-2">
                <span class="material-symbols-outlined text-sm text-secondary">image</span>
                <span id="imagePreviewName" class="text-xs text-on-surface truncate max-w-[200px]">photo.jpg</span>
              </div>
              <button type="button" onclick="clearSelectedPhoto()" class="text-error text-xs font-bold hover:underline">Remove</button>
            </div>

          </div>
        @else
          <!-- No active partner selected -->
          <div class="flex-1 flex flex-col items-center justify-center p-8 text-center gap-3">
            <span class="material-symbols-outlined text-5xl text-secondary">coffee</span>
            <h3 class="font-headline-md text-headline-md text-on-surface">Select a Match to Begin</h3>
            <p class="font-body-md text-body-md text-on-surface-variant max-w-sm">
              Choose an intentional single from the left column or explore today's newly brewed sparks.
            </p>
          </div>
        @endif
      </section>

      <!-- ========================================== -->
      <!-- PANE 3: DATE CONCIERGE & VENUE (Cols 9-12) -->
      <!-- ========================================== -->
      <aside id="paneConcierge" class="pane-concierge col-span-12 xl:col-span-3 flex flex-col bg-surface-container-low/50 rounded-xl p-space-md gap-space-md border border-outline-variant/20">
        
        <!-- Header: Concierge Spotlight -->
        <div class="flex items-center justify-between pb-1 border-b border-outline-variant/20">
          <div class="flex items-center gap-space-xs">
            <span class="material-symbols-outlined text-secondary">bookmark_heart</span>
            <h3 class="font-headline-sm text-headline-sm text-on-surface font-semibold">Date Concierge</h3>
          </div>
          <span class="font-label-sm text-label-sm text-on-tertiary-container uppercase tracking-wider font-bold">Selected Spot</span>
        </div>

        <!-- Venue Spotlight Card -->
        <div class="bg-surface-container-lowest rounded-2xl overflow-hidden shadow-sm flex flex-col border border-outline-variant/30">
          <div class="relative">
            <img class="w-full h-36 object-cover" 
                 loading="lazy"
                 src="https://lh3.googleusercontent.com/aida-public/AB6AXuB8WBzvjcc0ZEjnNWQUEhEthFzKg-9hwJU0isfnFH4fo1D8-I4Nzlv6f_Pia2QPLcYdxWyCeUL2oNXJQKBtlDQTiFzRRqGgi4Q_DoRWu_nxLU1SzRwPpW2qq2QYIhn540gXlnstrb39_DLkvafUoZdUuC0pP2QWcM3oxO_viOZ4xEnD6sT3mpXe-jmoPtify_6jpttcXz9tqcAqUymNZFb4Dyf-H4yPdDpG8s50kUJSYj84ty0reIttDg"
                 alt="Sey Coffee Interior"/>
            <div class="absolute top-2 right-2 px-space-sm py-0.5 rounded-full bg-surface-container-lowest/90 backdrop-blur-md text-secondary font-label-sm text-label-sm flex items-center gap-1 shadow-sm">
              <span class="material-symbols-outlined text-xs fill-1">star</span>
              <span class="font-bold">4.9</span>
              <span class="text-outline text-[10px]">(412 reviews)</span>
            </div>
            <span class="absolute bottom-2 left-2 px-2 py-0.5 rounded-full bg-primary/85 text-on-primary font-label-sm text-label-sm font-semibold backdrop-blur-xs">
              CupDate Partner Roaster
            </span>
          </div>
          
          <div class="p-space-sm flex flex-col gap-space-xs">
            <div>
              <h4 class="font-headline-sm text-headline-sm text-on-surface font-semibold">The Himalayan &amp; Artisan Brew Club</h4>
              <p class="font-body-sm text-body-sm text-on-surface-variant">
                {{ $activePartner ? ($activePartner->country ?? 'Scenic Roastery District') : 'Neighborhood Partner Roaster' }}
              </p>
            </div>

            <!-- Atmosphere Tags -->
            <div class="pt-space-xs">
              <span class="font-label-sm text-label-sm uppercase tracking-wider text-outline mb-1 block font-bold">Atmosphere &amp; Roasts</span>
              <div class="flex flex-wrap gap-1">
                <span class="px-2 py-0.5 rounded-full bg-surface-container text-on-surface-variant font-label-sm text-label-sm">Sunlit Veranda</span>
                <span class="px-2 py-0.5 rounded-full bg-surface-container text-on-surface-variant font-label-sm text-label-sm">Single-Origin V60</span>
                <span class="px-2 py-0.5 rounded-full bg-surface-container text-on-surface-variant font-label-sm text-label-sm">Quiet Seating</span>
                <span class="px-2 py-0.5 rounded-full bg-surface-container text-on-surface-variant font-label-sm text-label-sm">Almond Croissants</span>
              </div>
            </div>

            <!-- Map Walk Snippet -->
            <div class="mt-space-xs">
              <div class="w-full h-24 bg-cover bg-center rounded-xl relative overflow-hidden shadow-inner flex items-end p-2" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuApp_ZFRa1LnNiH_1xynyYBAtmmtDxi0OYiGxqaNZVYt6oFGTzQ7vVoC4G_5GuzoSjQYJOmyYJf4wyyRBLRFEywzpxVZPOjR2ctZsp8ukpN9RMr-pE9VKcXaUqfK2K3FiA4pO5Ugf23IQJEAaPgwF3MNreCsVEy9ycCUzC2P1mYsLCvkXxYXYqKjHna7Citc4rZ83144MmDfCJQyBOaepEGTuTCOEMBs0_b_c2x5M3c-nkLaFuFB0vrbg')">
                <div class="bg-surface/90 backdrop-blur-sm px-2.5 py-1 rounded-full text-on-surface font-label-sm text-label-sm flex items-center gap-1 shadow">
                  <span class="material-symbols-outlined text-xs text-secondary">directions_walk</span>
                  <span>10 min walk · Central Meetup Point</span>
                </div>
              </div>
            </div>

          </div>
        </div>

        <!-- Weather Forecast Widget for Planned Date -->
        <div class="bg-surface-container-lowest rounded-2xl p-space-sm shadow-sm flex items-center justify-between border border-outline-variant/30">
          <div class="flex items-center gap-space-sm">
            <div class="w-10 h-10 rounded-full bg-secondary-fixed text-on-secondary-fixed flex items-center justify-center">
              <span class="material-symbols-outlined text-xl">wb_sunny</span>
            </div>
            <div>
              <span class="font-label-sm text-label-sm text-secondary uppercase font-bold">Forecast for Meetup</span>
              <p class="font-label-lg text-label-lg text-on-surface font-semibold">Thu 4:00 PM · 22°C, Crisp &amp; Clear</p>
              <span class="font-body-sm text-body-sm text-outline">Ideal for slow sips &amp; outdoor walks</span>
            </div>
          </div>
        </div>

        <!-- Sync Calendar & Reservation Buttons -->
        <div class="flex flex-col gap-2">
          <a href="https://calendar.google.com/calendar/render?action=TEMPLATE&text={{ urlencode('Coffee Date with ' . ($activePartner ? $activePartner->full_name : 'CupDate Match')) }}&details={{ urlencode('Intentional 45-minute coffee date arranged via CupDate. Enjoy slow sips and real chemistry!') }}&location={{ urlencode($activePartner ? $activePartner->country : 'Partner Roastery') }}" 
             target="_blank" 
             class="w-full py-2.5 px-space-md rounded-full bg-primary hover:bg-primary/90 text-on-primary font-label-md text-label-md flex items-center justify-center gap-2 shadow-sm transition-all font-bold">
            <span class="material-symbols-outlined text-base">calendar_month</span>
            <span>Sync to Google / Apple Calendar</span>
          </a>
          <a href="https://maps.google.com/?q={{ urlencode(($activePartner ? $activePartner->country : 'Coffee Roastery')) }}" 
             target="_blank" 
             class="w-full py-2 px-space-md rounded-full bg-surface-container hover:bg-surface-container-high text-on-surface font-label-md text-label-md flex items-center justify-center gap-1.5 transition-colors font-medium">
            <span class="material-symbols-outlined text-base">directions</span>
            <span>Get Transit Directions</span>
          </a>
        </div>

        <!-- Safe Meet Guarantee Box -->
        <div class="mt-auto bg-surface-container rounded-2xl p-space-sm border border-outline-variant/20">
          <div class="flex items-start gap-space-xs">
            <span class="material-symbols-outlined text-on-tertiary-container text-base mt-0.5">verified_user</span>
            <div>
              <span class="font-label-sm text-label-sm font-semibold text-on-surface">CupDate Safe Meet Guarantee</span>
              <p class="font-body-sm text-body-sm text-on-surface-variant mt-0.5 leading-relaxed">
                Every suggested venue is identity-verified for high daytime foot traffic and staff friendliness. Zero catfishing guaranteed.
              </p>
              <a href="{{ route('safety') }}" class="text-on-tertiary-container font-label-sm text-label-sm underline font-semibold mt-1.5 inline-block hover:opacity-80">
                Review safety guidelines →
              </a>
            </div>
          </div>
        </div>

      </aside>

    </div>

  </div>

</div>

<!-- Toast Feedback Overlay -->
<div id="chatToast" class="fixed bottom-6 right-6 z-50 transform translate-y-20 opacity-0 transition-all duration-300 pointer-events-none">
  <div class="bg-primary-container text-inverse-on-surface px-5 py-3 rounded-full shadow-2xl flex items-center gap-3 border border-outline-variant/30">
    <span class="material-symbols-outlined text-on-tertiary-container">coffee</span>
    <span class="font-label-md text-label-md font-medium" id="chatToastMessage">Message sent</span>
  </div>
</div>
@endsection

@section('extra_js')
<script>
  // Soft Pleasant Audio Chime using Web Audio API (Zero external file dependencies)
  function playPleasantChime(isIncoming = false) {
    try {
      const AudioContext = window.AudioContext || window.webkitAudioContext;
      if (!AudioContext) return;
      const ctx = new AudioContext();
      const osc = ctx.createOscillator();
      const gain = ctx.createGain();

      osc.connect(gain);
      gain.connect(ctx.destination);

      const now = ctx.currentTime;
      if (isIncoming) {
        osc.frequency.setValueAtTime(587.33, now); // D5
        osc.frequency.exponentialRampToValueAtTime(880, now + 0.15); // A5
      } else {
        osc.frequency.setValueAtTime(440, now); // A4
        osc.frequency.exponentialRampToValueAtTime(659.25, now + 0.12); // E5
      }

      gain.gain.setValueAtTime(0.08, now);
      gain.gain.exponentialRampToValueAtTime(0.001, now + 0.3);

      osc.start(now);
      osc.stop(now + 0.32);
    } catch(e) {}
  }

  // Toast Helper
  let toastTimer;
  function showToast(msg) {
    const toast = document.getElementById('chatToast');
    const label = document.getElementById('chatToastMessage');
    if (!toast || !label) return;

    label.textContent = msg;
    clearTimeout(toastTimer);
    toast.classList.remove('translate-y-20', 'opacity-0');
    toast.classList.add('translate-y-0', 'opacity-100');

    toastTimer = setTimeout(() => {
      toast.classList.remove('translate-y-0', 'opacity-100');
      toast.classList.add('translate-y-20', 'opacity-0');
    }, 3200);
  }

  // Scroll to bottom of message container
  function scrollToBottom() {
    const scroller = document.getElementById('chatScrollArea');
    if (scroller) {
      scroller.scrollTop = scroller.scrollHeight;
    }
  }

  // Quick Reply Injection
  function sendQuickReply(text) {
    const input = document.getElementById('chatInput');
    if (input) {
      input.value = text;
      input.focus();
    }
  }

  // Accept Date Invitation Handler
  function acceptDateInvite() {
    playPleasantChime(false);
    showToast('☕ Coffee date confirmed! Opening Google Calendar to add itinerary...');
    const card = document.getElementById('dateInvitationCard');
    if (card) {
      card.classList.add('ring-2', 'ring-emerald-600', 'bg-emerald-50/50');
    }
    setTimeout(() => {
      window.open("https://calendar.google.com/calendar/render?action=TEMPLATE&text={{ urlencode('Coffee Date with ' . ($activePartner ? $activePartner->full_name : 'CupDate Match')) }}&details={{ urlencode('45-minute intentional coffee date. Slow sips and good conversation!') }}&location={{ urlencode($activePartner ? $activePartner->country : 'The Himalayan Roastery') }}", '_blank');
    }, 900);
  }

  // Photo Attachment Handling
  function previewSelectedPhoto(input) {
    if (input.files && input.files[0]) {
      const file = input.files[0];
      const previewBar = document.getElementById('imagePreviewBar');
      const nameSpan = document.getElementById('imagePreviewName');
      if (nameSpan) nameSpan.textContent = file.name;
      if (previewBar) previewBar.classList.remove('hidden');
    }
  }

  function clearSelectedPhoto() {
    const input = document.getElementById('chatImageInput');
    if (input) input.value = '';
    const previewBar = document.getElementById('imagePreviewBar');
    if (previewBar) previewBar.classList.add('hidden');
  }

  // Filter conversations list on search input
  function filterPartnersList() {
    const query = document.getElementById('partnerSearchInput').value.toLowerCase().trim();
    const items = document.querySelectorAll('.partner-item');
    items.forEach(item => {
      const name = item.getAttribute('data-name') || '';
      if (name.includes(query)) {
        item.style.display = 'flex';
      } else {
        item.style.display = 'none';
      }
    });
  }

  // Send message via AJAX
  async function submitChatMessage() {
    const input = document.getElementById('chatInput');
    const receiverInput = document.getElementById('receiverId');
    const imageInput = document.getElementById('chatImageInput');
    const sendBtn = document.getElementById('sendBtn');

    if (!input || !receiverInput) return;
    const msgText = input.value.trim();
    const hasImage = imageInput && imageInput.files && imageInput.files.length > 0;

    if (!msgText && !hasImage) return;

    // Disable button during transit
    if (sendBtn) sendBtn.disabled = true;

    const formData = new FormData();
    formData.append('_token', '{{ csrf_token() }}');
    formData.append('receiver_id', receiverInput.value);
    formData.append('message', msgText);
    if (hasImage) {
      formData.append('image', imageInput.files[0]);
    }

    try {
      const response = await fetch("{{ route('api.messages.send') }}", {
        method: 'POST',
        headers: {
          'X-Requested-With': 'XMLHttpRequest'
        },
        body: formData
      });

      const data = await response.json();
      if (data.success && data.message) {
        // Append bubble to chat
        appendMyBubble(data.message.message, data.message.attachment, data.message.time, data.message.id);
        input.value = '';
        clearSelectedPhoto();
        playPleasantChime(false);
        scrollToBottom(true);
        if (data.message.id && data.message.id > lastMessageId) {
          lastMessageId = data.message.id;
        }
      } else {
        showToast(data.message || 'Could not dispatch note. Try again.');
      }
    } catch(err) {
      showToast('Delivery note delay. Message processed.');
    } finally {
      if (sendBtn) sendBtn.disabled = false;
      input.focus();
    }
  }

  function appendMyBubble(text, attachmentUrl, time, id) {
    const container = document.getElementById('messagesContainer');
    if (!container) return;

    let attachmentHtml = '';
    if (attachmentUrl) {
      attachmentHtml = `<div class="mt-2 rounded-xl overflow-hidden max-w-[240px]">
        <img src="${attachmentUrl}" alt="Attachment" onload="scrollToBottom()" class="w-full h-auto object-cover"/>
      </div>`;
    }

    const bubble = document.createElement('div');
    bubble.className = "flex flex-col items-end gap-1 ml-auto max-w-[82%] message-item";
    bubble.setAttribute('data-id', id || Date.now());
    bubble.innerHTML = `
      <div class="p-3.5 rounded-2xl bubble-me text-sm leading-relaxed font-body-md">
        ${escapeHtml(text)}
        ${attachmentHtml}
      </div>
      <span class="font-label-sm text-label-sm text-outline pr-1">${time || 'Just now'} • Sent</span>
    `;

    container.appendChild(bubble);
    scrollToBottom(true);
  }

  function appendPartnerBubble(text, attachmentUrl, time, id) {
    const container = document.getElementById('messagesContainer');
    if (!container) return;

    let attachmentHtml = '';
    if (attachmentUrl) {
      attachmentHtml = `<div class="mt-2 rounded-xl overflow-hidden max-w-[240px]">
        <img src="${attachmentUrl}" alt="Attachment" onload="scrollToBottom()" class="w-full h-auto object-cover"/>
      </div>`;
    }

    const partnerAvatar = "{{ $activePartner ? $activePartner->avatar_url : '' }}";
    const bubble = document.createElement('div');
    bubble.className = "flex items-end gap-space-xs max-w-[82%] message-item";
    bubble.setAttribute('data-id', id || Date.now());
    bubble.innerHTML = `
      <img class="w-7 h-7 rounded-full object-cover shrink-0 mb-1" src="${partnerAvatar}" alt="Partner"/>
      <div class="flex flex-col gap-1">
        <div class="p-3.5 rounded-2xl bubble-partner text-sm leading-relaxed font-body-md">
          ${escapeHtml(text)}
          ${attachmentHtml}
        </div>
        <span class="font-label-sm text-label-sm text-outline pl-1">${time || 'Just now'}</span>
      </div>
    `;

    container.appendChild(bubble);
    scrollToBottom(true);
  }

  // Smooth Auto-Scroll Handler for Messages (Immediate + Staged for Reflows)
  function scrollToBottom(smooth = false) {
    const scrollArea = document.getElementById('chatScrollArea');
    if (!scrollArea) return;

    // Immediate hard scroll to bottom
    scrollArea.scrollTop = scrollArea.scrollHeight;

    // RAF alignment
    requestAnimationFrame(() => {
      scrollArea.scrollTop = scrollArea.scrollHeight;
    });

    // Staged timeouts to catch image loading, font loading and virtual keyboards
    setTimeout(() => {
      if (smooth) {
        scrollArea.scrollTo({ top: scrollArea.scrollHeight, behavior: 'smooth' });
      } else {
        scrollArea.scrollTop = scrollArea.scrollHeight;
      }
    }, 60);

    setTimeout(() => {
      scrollArea.scrollTop = scrollArea.scrollHeight;
    }, 250);
  }

  function escapeHtml(text) {
    if (!text) return '';
    const div = document.createElement('div');
    div.innerText = text;
    return div.innerHTML;
  }

  // Real-Time Polling for New Messages Every 3.5 Seconds
  let lastMessageId = 0;
  function updateLastMessageId() {
    const allMsgs = document.querySelectorAll('.message-item');
    if (allMsgs.length > 0) {
      const last = allMsgs[allMsgs.length - 1];
      const id = parseInt(last.getAttribute('data-id'), 10);
      if (id && id > lastMessageId) lastMessageId = id;
    }
  }

  async function pollNewMessages() {
    @if($activePartner)
      try {
        updateLastMessageId();
        const res = await fetch(`{{ route('api.messages.fetch') }}?partner_id={{ $activePartner->id }}&after_id=${lastMessageId}`, {
          headers: {
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
          }
        });
        if (!res.ok) return;
        const data = await res.json();
        if (data.success && data.messages && data.messages.length > 0) {
          let hasNew = false;
          data.messages.forEach(m => {
            if (!document.querySelector(`.message-item[data-id="${m.id}"]`)) {
              appendPartnerBubble(m.message, m.attachment, m.time, m.id);
              hasNew = true;
            }
            if (m.id > lastMessageId) lastMessageId = m.id;
          });
          if (hasNew) {
            playPleasantChime(true);
            scrollToBottom(true);
          }
        }
      } catch(e) {}
    @endif
  }

  // Mobile Pane Switcher
  function switchMobilePane(pane) {
    const pConvos = document.getElementById('paneConvos');
    const pChat = document.getElementById('paneChat');
    const pConcierge = document.getElementById('paneConcierge');

    const mTabConvos = document.getElementById('mTabConvos');
    const mTabChat = document.getElementById('mTabChat');
    const mTabConcierge = document.getElementById('mTabConcierge');

    // Reset tabs
    [mTabConvos, mTabChat, mTabConcierge].forEach(t => {
      if (t) {
        t.className = "flex-1 py-2 rounded-xl text-xs font-medium text-on-surface-variant transition-all flex items-center justify-center gap-1.5";
      }
    });

    if (pane === 'convos') {
      pConvos.classList.remove('hidden-mobile');
      pChat.classList.add('hidden-mobile');
      pConcierge.classList.add('hidden-mobile');
      if (mTabConvos) mTabConvos.className = "flex-1 py-2 rounded-xl text-xs font-bold transition-all bg-surface text-on-surface shadow-xs flex items-center justify-center gap-1.5";
    } else if (pane === 'chat') {
      pConvos.classList.add('hidden-mobile');
      pChat.classList.remove('hidden-mobile');
      pConcierge.classList.add('hidden-mobile');
      if (mTabChat) mTabChat.className = "flex-1 py-2 rounded-xl text-xs font-bold transition-all bg-surface text-on-surface shadow-xs flex items-center justify-center gap-1.5";
      scrollToBottom();
    } else if (pane === 'concierge') {
      pConvos.classList.add('hidden-mobile');
      pChat.classList.add('hidden-mobile');
      pConcierge.classList.remove('hidden-mobile');
      if (mTabConcierge) mTabConcierge.className = "flex-1 py-2 rounded-xl text-xs font-bold transition-all bg-surface text-on-surface shadow-xs flex items-center justify-center gap-1.5";
    }
  }

  document.addEventListener('DOMContentLoaded', () => {
    scrollToBottom();
    updateLastMessageId();
    setInterval(pollNewMessages, 3500);

    // Attach listeners for mobile keyboard and resize
    const chatInput = document.getElementById('chatInput');
    if (chatInput) {
      chatInput.addEventListener('focus', () => {
        setTimeout(() => scrollToBottom(true), 120);
        setTimeout(() => scrollToBottom(true), 350);
      });
    }

    if (window.visualViewport) {
      window.visualViewport.addEventListener('resize', () => {
        scrollToBottom();
      });
    } else {
      window.addEventListener('resize', () => {
        scrollToBottom();
      });
    }

    // Scroll after any chat image finishes loading
    document.querySelectorAll('#messagesContainer img').forEach(img => {
      if (!img.complete) {
        img.addEventListener('load', () => scrollToBottom());
      }
    });

    // Initial mobile pane: on small screens, default to chat if partner is active, else convos
    if (window.innerWidth < 1024) {
      @if($activePartner)
        switchMobilePane('chat');
      @else
        switchMobilePane('convos');
      @endif
    }
  });

  window.addEventListener('load', () => {
    scrollToBottom();
  });
</script>
@endsection
