/* CupDate - Modern Premium JS Application Engine */

document.addEventListener('DOMContentLoaded', () => {
    // 1. Initialize Swipe Card Gestures
    initSwipeCards();
    
    // 2. Initialize Radar Node Visual Coordinates
    initRadarNodes();
    
    // 3. Initialize Interactive Date Spots Map (Leaflet)
    initDateSpotsMap();
    
    // 4. Initialize Chat Thread Poller & Call Request Checker
    initChatPolling();
    
    // 5. Start Global Real-time Message Notification Poller
    startGlobalNotificationPoller();
});

// ==========================================
// 1. SWIPE SYSTEM (TINDER-STYLE VANILLA GESTURES)
// ==========================================
function initSwipeCards() {
    const deck = document.querySelector('.swipe-deck');
    if (!deck) return;

    const cards = deck.querySelectorAll('.swipe-card');
    cards.forEach((card, index) => {
        // Position elements so the last one is on top
        card.style.zIndex = cards.length - index;
        if (index > 0) {
            // Stack effect
            card.style.transform = `scale(${1 - index * 0.05}) translateY(${index * 15}px)`;
            card.style.opacity = index > 2 ? 0 : 0.8 - index * 0.2;
        }
        
        let isDragging = false;
        let startX = 0;
        let startY = 0;
        let currentX = 0;
        let currentY = 0;
        
        const likeStamp = card.querySelector('.like-stamp');
        const nopeStamp = card.querySelector('.nope-stamp');
        const actionButtons = card.querySelectorAll('.swipe-card-action-btn');

        actionButtons.forEach((button) => {
            button.addEventListener('click', (e) => e.stopPropagation());
            button.addEventListener('touchstart', (e) => e.stopPropagation());
        });

        // Drag Start
        const dragStart = (e) => {
            isDragging = true;
            card.style.transition = 'none';
            const touch = e.type === 'touchstart' ? e.touches[0] : e;
            startX = touch.clientX;
            startY = touch.clientY;
            card.style.cursor = 'grabbing';
        };

        // Drag Move
        const dragMove = (e) => {
            if (!isDragging) return;
            const touch = e.type === 'touchmove' ? e.touches[0] : e;
            currentX = touch.clientX - startX;
            currentY = touch.clientY - startY;
            
            // Rotate card based on drag X distance
            const rotate = currentX * 0.08;
            card.style.transform = `translate(${currentX}px, ${currentY}px) rotate(${rotate}deg)`;

            // Opacity of Stamps
            if (currentX > 30) {
                if (likeStamp) likeStamp.style.opacity = Math.min(currentX / 100, 0.9);
                if (nopeStamp) nopeStamp.style.opacity = 0;
            } else if (currentX < -30) {
                if (nopeStamp) nopeStamp.style.opacity = Math.min(Math.abs(currentX) / 100, 0.9);
                if (likeStamp) likeStamp.style.opacity = 0;
            } else {
                if (likeStamp) likeStamp.style.opacity = 0;
                if (nopeStamp) nopeStamp.style.opacity = 0;
            }
        };

        // Drag End
        const dragEnd = () => {
            if (!isDragging) return;
            isDragging = false;
            card.style.cursor = 'grab';
            
            const swipeLimit = 130;
            
            if (currentX > swipeLimit) {
                // Swipe Right (Like)
                handleSwipeAction(card, 'like');
            } else if (currentX < -swipeLimit) {
                // Swipe Left (Dislike)
                handleSwipeAction(card, 'dislike');
            } else if (currentY < -swipeLimit - 30) {
                // Swipe Up (Superlike)
                handleSwipeAction(card, 'superlike');
            } else {
                // Return to original stack position
                card.style.transition = 'transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.2), opacity 0.3s';
                card.style.transform = index === 0 ? 'translate(0, 0) rotate(0deg)' : `scale(${1 - index * 0.05}) translateY(${index * 15}px)`;
                if (likeStamp) likeStamp.style.opacity = 0;
                if (nopeStamp) nopeStamp.style.opacity = 0;
            }
            
            currentX = 0;
            currentY = 0;
        };

        // Mouse Listeners
        card.addEventListener('mousedown', dragStart);
        window.addEventListener('mousemove', dragMove);
        window.addEventListener('mouseup', dragEnd);

        // Touch Listeners
        card.addEventListener('touchstart', dragStart, { passive: true });
        card.addEventListener('touchmove', dragMove, { passive: true });
        card.addEventListener('touchend', dragEnd);
    });
}

// Swipe Button Helpers
function triggerButtonSwipe(direction) {
    const deck = document.querySelector('.swipe-deck');
    if (!deck) return;
    const topCard = deck.querySelector('.swipe-card:not(.swiped)');
    if (topCard) {
        handleSwipeAction(topCard, direction);
    }
}

function handleSwipeAction(cardEl, action) {
    cardEl.classList.add('swiped');
    cardEl.style.transition = 'transform 0.5s ease, opacity 0.5s ease';
    
    let rotate = 45;
    let targetX = 800;
    let targetY = 0;
    
    if (action === 'dislike') {
        rotate = -45;
        targetX = -800;
    } else if (action === 'superlike') {
        rotate = 0;
        targetX = 0;
        targetY = -800;
    }

    cardEl.style.transform = `translate(${targetX}px, ${targetY}px) rotate(${rotate}deg)`;
    cardEl.style.opacity = '0';
    
    // Fetch DB record
    const targetUserId = cardEl.getAttribute('data-user-id');
    
    fetch('api/swipe.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `swipee_id=${targetUserId}&type=${action}`
    })
    .then(r => r.json())
    .then(data => {
        if (data.status === 'success' && data.match === true) {
            // Trigger match screen!
            triggerMatchSplash(data.my_avatar, data.their_avatar, data.their_name, targetUserId);
        }
    })
    .catch(e => console.error("Swipe API error", e));

    // Remove element after transition and restructure remaining cards
    setTimeout(() => {
        cardEl.remove();
        restructureCardStack();
    }, 400);
}

function restructureCardStack() {
    const deck = document.querySelector('.swipe-deck');
    if (!deck) return;
    
    const remainingCards = deck.querySelectorAll('.swipe-card:not(.swiped)');
    if (remainingCards.length === 0) {
        // Show empty deck panel
        deck.innerHTML = `
            <div class="glass-panel" style="padding: 40px; text-align: center; width: 100%;">
                <i class="fa-solid fa-face-frown text-gradient" style="font-size: 3.5rem; margin-bottom: 20px; display: inline-block;"></i>
                <h3 style="font-size: 1.5rem; font-weight: bold; margin-bottom: 10px;">End of Swipes!</h3>
                <p style="color: var(--text-muted); font-size: 0.95rem; margin-bottom: 20px;">You've viewed all profiles nearby. Try widening your preferences or check back later!</p>
                <button onclick="window.location.reload()" class="glow-button" style="padding: 10px 25px;"><i class="fa-solid fa-rotate-left"></i> Reload Swipes</button>
            </div>
        `;
        const actionToolbar = document.querySelector('.swipe-actions');
        if (actionToolbar) actionToolbar.style.display = 'none';
        return;
    }
    
    remainingCards.forEach((card, index) => {
        card.style.zIndex = remainingCards.length - index;
        card.style.transition = 'transform 0.4s ease, opacity 0.3s';
        if (index === 0) {
            card.style.transform = 'translate(0, 0) rotate(0deg)';
            card.style.opacity = '1';
        } else {
            card.style.transform = `scale(${1 - index * 0.05}) translateY(${index * 15}px)`;
            card.style.opacity = index > 2 ? 0 : 0.8 - index * 0.2;
        }
    });
}

// Match splash screen visual trigger
function triggerMatchSplash(myAvatar, theirAvatar, name, theirUserId) {
    const overlay = document.getElementById('matchSplashOverlay');
    const myImg = document.getElementById('matchMyAvatar');
    const theirImg = document.getElementById('matchTheirAvatar');
    const subtitle = document.getElementById('matchSplashSubtitle');
    const msgBtn = document.getElementById('matchSplashMessageBtn');

    if (overlay && myImg && theirImg && subtitle) {
        myImg.src = myAvatar;
        theirImg.src = theirAvatar;
        subtitle.innerText = `You and ${name} have liked each other. Let's strike a conversation!`;
        if (msgBtn && theirUserId) {
            msgBtn.setAttribute('onclick', `window.location.href='messages.php?receiver_id=${theirUserId}&instant=1'`);
        } else if (msgBtn) {
            msgBtn.setAttribute('onclick', `closeMatchSplash()`);
        }
        overlay.style.display = 'flex';
    }
}

function closeMatchSplash() {
    const overlay = document.getElementById('matchSplashOverlay');
    if (overlay) {
        overlay.style.display = 'none';
    }
}

// ==========================================
// 2. RADAR VIEW (COORDINATE RENDER ENGINE)
// ==========================================
function initRadarNodes() {
    const radar = document.querySelector('.radar-screen');
    if (!radar) return;
    
    const nodes = radar.querySelectorAll('.radar-node');
    
    // Position user node bubbles dynamically on concentric circles
    nodes.forEach((node, i) => {
        const distancePercent = node.getAttribute('data-dist-percent') || 70; // 0 to 100 radius index
        const angle = node.getAttribute('data-angle') || (i * (360 / nodes.length));
        
        // Convert polar coordinates to Cartesian
        const radius = (225 * (distancePercent / 100)) - 10; // 225px is the radar container boundary
        const angleRad = angle * (Math.PI / 180);
        
        const x = Math.round(radius * Math.cos(angleRad));
        const y = Math.round(radius * Math.sin(angleRad));
        
        // Align nodes centered with their calculated offsets
        node.style.left = `calc(50% + ${x}px - 22px)`;
        node.style.top = `calc(50% + ${y}px - 22px)`;
        
        // Setup popup positioning coordinates
        const popover = node.nextElementSibling;
        if (popover && popover.classList.contains('radar-popover')) {
            popover.style.left = `calc(50% + ${x}px - 90px)`;
            popover.style.top = `calc(50% + ${y}px - 100px)`;
        }

        // Enable touch / click interaction for radar node popovers
        node.addEventListener('click', (event) => {
            event.stopPropagation();
            if (popover && popover.classList.contains('radar-popover')) {
                const wasActive = popover.classList.contains('active');
                document.querySelectorAll('.radar-popover.active').forEach(activePopover => {
                    if (activePopover !== popover) {
                        activePopover.classList.remove('active');
                    }
                });
                popover.classList.toggle('active', !wasActive);
            }
        });
    });

    document.addEventListener('click', (event) => {
        if (!event.target.closest('.radar-node') && !event.target.closest('.radar-popover')) {
            document.querySelectorAll('.radar-popover.active').forEach(popover => popover.classList.remove('active'));
        }
    });
}

// ==========================================
// 3. DATE SPOTS INTERACTIVE MAP (LEAFLET)
// ==========================================
let dateSpotsMap = null;
function initDateSpotsMap() {
    const mapEl = document.getElementById('dateSpotsMapContainer');
    if (!mapEl) return;
    
    if (typeof L === 'undefined') {
        console.warn("Leaflet library L is not defined. Retrying...");
        return;
    }
    
    const centerLat = parseFloat(mapEl.getAttribute('data-center-lat')) || 31.2244;
    const centerLng = parseFloat(mapEl.getAttribute('data-center-lng')) || 76.9388;
    
    // Initialize map
    dateSpotsMap = L.map('dateSpotsMapContainer', {
        zoomControl: false,
        attributionControl: false
    }).setView([centerLat, centerLng], 14);
    
    // Dark mode maps styled layer (CartoDB Dark Matter)
    L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png', {
        maxZoom: 19
    }).addTo(dateSpotsMap);

    // Zoom buttons customization
    L.control.zoom({ position: 'bottomright' }).addTo(dateSpotsMap);

    // Add glowing custom marker for current user location
    const userMarkerIcon = L.divIcon({
        className: 'user-map-marker',
        html: `<div style="width: 20px; height: 20px; border-radius: 50%; background: var(--primary); border: 3px solid white; box-shadow: 0 0 15px var(--primary-glow); animation: pulse 1.5s infinite alternate;"></div>`,
        iconSize: [20, 20]
    });
    const userMarker = L.marker([centerLat, centerLng], { icon: userMarkerIcon }).addTo(dateSpotsMap)
     .bindPopup(`<strong style="color:#000;">You are here 📍</strong><br><span style="color:#666; font-size:0.8rem">Acquiring precise location...</span>`).openPopup();

    // Check navigator geolocation to retrieve and save user's real GPS position!
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(position => {
            const newLat = position.coords.latitude;
            const newLng = position.coords.longitude;
            
            // Move marker and center map view
            userMarker.setLatLng([newLat, newLng]);
            userMarker.getPopup().setContent(`<strong style="color:#000;">Precise Location Active 📍</strong><br><span style="color:#10b981; font-size:0.8rem; font-weight:600;">GPS Tracked successfully</span>`);
            dateSpotsMap.setView([newLat, newLng], 14);
            
            // Calculate physical coordinate difference to see if we should cluster adaptively
            const diffLat = Math.abs(newLat - centerLat);
            const diffLng = Math.abs(newLng - centerLng);
            
            if (diffLat > 0.005 || diffLng > 0.005) {
                const formData = new FormData();
                formData.append('lat', newLat);
                formData.append('lng', newLng);
                
                fetch('api/update_location.php', {
                    method: 'POST',
                    body: formData
                })
                .then(res => res.json())
                .then(data => {
                    console.log("Adaptive neighborhood relocated via real GPS", data);
                    // Refresh if radar screen exists to reload correct geodesic distances
                    if (document.querySelector('.radar-screen')) {
                        setTimeout(() => {
                            window.location.reload();
                        }, 1200);
                    }
                })
                .catch(err => console.error("Error saving real coordinates", err));
            }
        }, err => {
            console.warn("User geolocation access declined: using default database test zone.", err);
            userMarker.getPopup().setContent(`<strong style="color:#000;">You are here 📍</strong><br><span style="color:#e53e3e; font-size:0.8rem">Default area active</span>`);
        }, {
            enableHighAccuracy: true,
            timeout: 8000
        });
    }

    // Fetch and plot real nearby active users on Leaflet map
    const nearbyUsersData = document.querySelectorAll('.nearby-user-marker-data');
    nearbyUsersData.forEach(user => {
        const uId = user.getAttribute('data-id');
        const uName = user.getAttribute('data-name');
        const uAvatar = user.getAttribute('data-avatar');
        const uLat = parseFloat(user.getAttribute('data-lat'));
        const uLng = parseFloat(user.getAttribute('data-lng'));
        const uAstro = user.getAttribute('data-astrology');
        const uMbti = user.getAttribute('data-mbti');
        const uCompat = user.getAttribute('data-compat');
        
        // Premium customized photo avatar marker for daters
        const userPhotoIcon = L.divIcon({
            className: `nearby-user-map-marker-${uId}`,
            html: `<div style="position:relative; width: 44px; height: 44px; border-radius: 50%; border: 3px solid var(--primary); box-shadow: 0 0 15px var(--primary-glow); overflow:hidden; background: #000; animation: float 3s ease-in-out infinite alternate;">
                       <img src="uploads/avatars/${uAvatar}" onerror="this.src='assets/images/default_avatar.png';" style="width:100%; height:100%; object-fit:cover;">
                       <div style="position:absolute; bottom:-2px; right:-2px; background:#10b981; border:2px solid white; width:12px; height:12px; border-radius:50%;"></div>
                   </div>`,
            iconSize: [44, 44]
        });

        const popupContent = `
            <div style="font-family:'Outfit', sans-serif; color:#07050f; min-width:180px; padding:5px; text-align:center;">
                <img src="uploads/avatars/${uAvatar}" onerror="this.src='assets/images/default_avatar.png';" style="width:60px; height:60px; border-radius:50%; object-fit:cover; margin-bottom:8px; border:2px solid var(--primary);">
                <h4 style="margin:0 0 4px; font-weight:700; font-size:1.05rem; color:#ff4a5a">${uName}</h4>
                <div style="font-size:0.75rem; color:#666; margin-bottom:6px;">${uMbti} • ${uAstro}</div>
                <div style="background:rgba(16, 185, 129, 0.1); color:#10b981; border-radius:15px; padding:4px 10px; font-size:0.8rem; font-weight:700; display:inline-block; margin-bottom:10px;">
                    <i class="fa-solid fa-mug-hot"></i> ${uCompat}% Match
                </div>
                <div style="border-top:1px solid #eee; padding-top:8px; display:flex; gap:8px; justify-content:center;">
                    <a href="messages.php?receiver_id=${uId}&instant=1" style="background:var(--primary); color:white; padding:4px 12px; border-radius:6px; font-size:0.75rem; text-decoration:none; font-weight:bold; width:100%;">Chat Now</a>
                </div>
            </div>
        `;
        
        L.marker([uLat, uLng], { icon: userPhotoIcon }).addTo(dateSpotsMap).bindPopup(popupContent);
    });

    // Fetch Date places markers from the DOM
    const placesData = document.querySelectorAll('.date-place-marker-data');
    placesData.forEach(place => {
        const lat = parseFloat(place.getAttribute('data-lat'));
        const lng = parseFloat(place.getAttribute('data-lng'));
        const name = place.getAttribute('data-name');
        const type = place.getAttribute('data-type');
        const offer = place.getAttribute('data-offer');
        const rating = place.getAttribute('data-rating');
        
        // Spot custom marker
        const spotIcon = L.divIcon({
            className: 'date-spot-marker',
            html: `<div style="width: 32px; height: 32px; border-radius: 50%; background: linear-gradient(135deg, var(--primary), var(--secondary)); display:flex; align-items:center; justify-content:center; color:white; font-size:0.9rem; box-shadow: 0 0 10px var(--secondary-glow); border:1px solid rgba(255,255,255,0.2)"><i class="fa-solid fa-mug-saucer" style="font-size:0.75rem;"></i></div>`,
            iconSize: [32, 32]
        });

        const popupContent = `
            <div style="font-family:'Outfit', sans-serif; color:#07050f; min-width:200px; padding:5px;">
                <h4 style="margin:0 0 4px; font-weight:700; font-size:1.1rem; color:#ff4a5a">${name}</h4>
                <div style="font-size:0.75rem; color:#8b5cf6; font-weight:600; text-transform:uppercase; margin-bottom:6px;">${type} • ⭐ ${rating}/5</div>
                <div style="border-top:1px solid #eee; padding-top:6px; margin-top:6px;">
                    <span style="font-size:0.75rem; color:#666;">CupDate Premium Offer:</span><br>
                    <strong style="color:#10b981; font-size:0.85rem;"><i class="fa-solid fa-tag"></i> ${offer || 'Show CupDate interface for 10% Off'}</strong>
                </div>
            </div>
        `;
        
        L.marker([lat, lng], { icon: spotIcon }).addTo(dateSpotsMap).bindPopup(popupContent);
    });
}

function panToSpot(lat, lng) {
    if (dateSpotsMap) {
        dateSpotsMap.setView([lat, lng], 16);
    }
}

// ==========================================
// 4. REAL-TIME CHAT ENGINE (POLLING MODULE)
// ==========================================
let activeChatReceiverId = null;
let chatPollerInterval = null;

function initChatPolling() {
    if (window.location.pathname.includes('messages.php')) return;
    const chatContainer = document.querySelector('.chat-messages-container');
    if (!chatContainer) return;
    
    activeChatReceiverId = chatContainer.getAttribute('data-receiver-id');
    
    // Polling triggers every 2 seconds for ultra-responsive dynamic messaging
    chatPollerInterval = setInterval(fetchNewChatMessages, 2000);
}

function fetchNewChatMessages() {
    if (!activeChatReceiverId) return;
    
    fetch(`api/messages.php?action=get&receiver_id=${activeChatReceiverId}`)
    .then(r => r.json())
    .then(data => {
        if (data.status === 'success' && data.messages.length > 0) {
            const chatContainer = document.querySelector('.chat-messages-container');
            if (!chatContainer) return;
            let isNewMessageAdded = false;
            
            data.messages.forEach(msg => {
                // Check if message ID already rendered in page to avoid duplications
                const existingMsg = document.querySelector(`[data-msg-id="${msg.id}"]`);
                if (!existingMsg) {
                    const msgHtml = formatChatMessage(msg);
                    chatContainer.insertAdjacentHTML('beforeend', msgHtml);
                    isNewMessageAdded = true;
                } else if (msg.message.startsWith('[COFFEE_INVITATION]')) {
                    // Adaptive check: update invitation status if changed in database
                    const currentBadge = existingMsg.querySelector('.swipe-badge-pill');
                    const currentStatus = currentBadge ? currentBadge.innerText : '';
                    try {
                        const parsed = JSON.parse(msg.message.substring('[COFFEE_INVITATION]'.length));
                        const newStatusText = parsed.status === 'pending' ? 'Pending RSVP' : (parsed.status === 'accepted' ? 'Accepted' : 'Declined');
                        if (currentStatus && !currentStatus.includes(newStatusText)) {
                            existingMsg.outerHTML = formatChatMessage(msg);
                        }
                    } catch(e){}
                }
            });
            
            if (isNewMessageAdded) {
                scrollToBottomChat();
            }
        }
    })
    .catch(e => console.error("Chat polling error", e));
}



function formatChatMessageTime(msg) {
    if (msg.created_at) {
        const d = new Date(msg.created_at.replace(' ', 'T'));
        if (!isNaN(d.getTime())) {
            return d.toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit', hour12: true });
        }
    }
    return msg.time || 'Just now';
}

function formatChatMessage(msg) {
    const isSent = (parseInt(msg.sender_id) !== parseInt(activeChatReceiverId));
    const rowClass = isSent ? 'sent' : 'received';
    const bubbleClass = isSent ? 'sent' : 'received';
    
    if (msg.message.startsWith('[COFFEE_INVITATION]')) {
        try {
            const inviteData = JSON.parse(msg.message.substring('[COFFEE_INVITATION]'.length));
            let statusBadge = '';
            let actionButtons = '';
            let cardStyle = 'border-left: 4px solid var(--accent);';
            
            if (inviteData.status === 'pending') {
                statusBadge = '<span class="swipe-badge-pill" style="background:rgba(245,158,11,0.15); color:#fbbf24; border-color:rgba(245,158,11,0.3);">☕ Pending RSVP</span>';
                if (!isSent) {
                    actionButtons = `
                        <div style="display:flex; gap:10px; margin-top:15px;">
                            <button onclick="respondToCoffeeInvite(${msg.id}, 'accepted', ${JSON.stringify(inviteData).replace(/"/g, '&quot;')})" class="glow-button" style="padding:6px 15px; font-size:0.75rem; background:#10b981; border-radius:8px;">Accept ☕</button>
                            <button onclick="respondToCoffeeInvite(${msg.id}, 'declined', ${JSON.stringify(inviteData).replace(/"/g, '&quot;')})" style="background:rgba(255,255,255,0.05); border:1px solid var(--glass-border); color:white; padding:6px 15px; font-size:0.75rem; border-radius:8px; cursor:pointer;" onmouseover="this.style.background='rgba(255,74,90,0.1)'" onmouseout="this.style.background='rgba(255,255,255,0.05)'">Decline</button>
                        </div>
                    `;
                } else {
                    actionButtons = `<div style="font-size:0.75rem; color:var(--text-muted); margin-top:10px;"><i class="fa-solid fa-hourglass-half"></i> Waiting for their response...</div>`;
                }
            } else if (inviteData.status === 'accepted') {
                statusBadge = '<span class="swipe-badge-pill" style="background:rgba(16,185,129,0.15); color:#10b981; border-color:rgba(16,185,129,0.3);">🎉 Accepted</span>';
                cardStyle = 'border-left: 4px solid #10b981; box-shadow: 0 0 15px rgba(16,185,129,0.25);';
                
                actionButtons = `
                    <div style="background:rgba(16,185,129,0.1); border: 1px dashed rgba(16,185,129,0.4); padding:10px; border-radius:8px; margin-top:12px; text-align:center;">
                        <span style="font-size:0.7rem; color:var(--text-muted); text-transform:uppercase; display:block;">CupDate Premium Promo Coupon</span>
                        <strong style="color:#10b981; font-size:0.95rem; font-family:monospace; letter-spacing:1px; display:block; margin-top:2px;"><i class="fa-solid fa-gift"></i> CUP-DATE-LOVE-15</strong>
                        <span style="font-size:0.65rem; color:var(--text-muted); display:block; margin-top:2px;">Show this screen at the counter for 15% OFF!</span>
                    </div>
                `;
            } else {
                statusBadge = '<span class="swipe-badge-pill" style="background:rgba(239,68,68,0.15); color:#ef4444; border-color:rgba(239,68,68,0.3);">Declined ❌</span>';
                cardStyle = 'border-left: 4px solid #ef4444;';
                actionButtons = `<div style="font-size:0.75rem; color:var(--text-muted); margin-top:10px;"><i class="fa-solid fa-ban"></i> Coffee date declined.</div>`;
            }
            
            const dateObj = new Date(inviteData.time);
            const formattedTime = dateObj.toLocaleDateString('en-US', { weekday: 'short', month: 'short', day: 'numeric' }) + ' at ' + dateObj.toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit' });
            
            return `
                <div class="chat-msg-row ${rowClass}" data-msg-id="${msg.id}" data-receiver-id="${msg.receiver_id}" data-sender-id="${msg.sender_id}">
                    <div class="glass-panel" style="padding:15px 20px; border-radius:18px; max-width:320px; width:100%; border-color:var(--glass-border); background:rgba(7,5,15,0.85); text-align:left; ${cardStyle}">
                        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:10px; gap:10px;">
                            <strong style="color:white; font-size:0.9rem; font-weight:700;"><i class="fa-solid fa-mug-hot text-gradient"></i> Coffee Date Invite!</strong>
                            ${statusBadge}
                        </div>
                        <div style="font-size:0.8rem; color:#d1d5db; line-height:1.4;">
                            <div style="margin-bottom:6px;"><i class="fa-solid fa-location-dot" style="color:var(--primary); margin-right:5px;"></i> <strong>${escapeHTML(inviteData.place_name)}</strong></div>
                            <div style="margin-bottom:8px;"><i class="fa-solid fa-calendar-days" style="color:var(--secondary); margin-right:5px;"></i> ${formattedTime}</div>
                            ${inviteData.note ? `<div style="background:rgba(255,255,255,0.03); border:1px solid rgba(255,255,255,0.05); padding:8px 10px; border-radius:8px; font-style:italic; color:#9ca3af; margin-top:8px;">"${escapeHTML(inviteData.note)}"</div>` : ''}
                        </div>
                        ${actionButtons}
                        <div style="font-size:0.65rem; color:var(--text-muted); text-align:right; margin-top:8px;">${formatChatMessageTime(msg)}</div>
                    </div>
                </div>
            `;
        } catch (e) {
            console.error("Error parsing coffee invite message JSON", e);
        }
    }
    
    return `
        <div class="chat-msg-row ${rowClass}" data-msg-id="${msg.id}" data-receiver-id="${msg.receiver_id}" data-sender-id="${msg.sender_id}">
            <div class="chat-bubble ${bubbleClass}">
                ${escapeHTML(msg.message)}
                <div class="chat-bubble-time">${formatChatMessageTime(msg)}</div>
            </div>
        </div>
    `;
}

function respondToCoffeeInvite(msgId, responseStatus, inviteData) {
    inviteData.status = responseStatus;
    const newContent = '[COFFEE_INVITATION]' + JSON.stringify(inviteData);
    
    fetch('api/messages.php?action=update_message', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `message_id=${msgId}&new_content=${encodeURIComponent(newContent)}`
    })
    .then(r => r.json())
    .then(data => {
        if (data.status === 'success') {
            fetchNewChatMessages();
            const existingRow = document.querySelector(`[data-msg-id="${msgId}"]`);
            if (existingRow) {
                const timeTextEl = existingRow.querySelector('.chat-bubble-time, [style*="font-size:0.65rem"]');
                const timeText = timeTextEl ? timeTextEl.innerText : 'Just now';
                const msgObj = {
                    id: msgId,
                    sender_id: activeChatReceiverId,
                    message: newContent,
                    time: timeText
                };
                existingRow.outerHTML = formatChatMessage(msgObj);
            }
        }
    })
    .catch(err => console.error("Error responding to coffee invite", err));
}

function sendCoffeeDateInvitation() {
    const placeSelect = document.getElementById('inviteCoffeePlace');
    const timeInput = document.getElementById('inviteCoffeeTime');
    const noteInput = document.getElementById('inviteCoffeeNote');
    const modal = document.getElementById('coffeeInviteModal');
    
    if (!placeSelect || !timeInput || !activeChatReceiverId) return;
    
    const placeId = placeSelect.value;
    const placeName = placeSelect.options[placeSelect.selectedIndex].text;
    const timeVal = timeInput.value;
    const noteVal = noteInput ? noteInput.value.trim() : '';
    
    if (!placeId || !timeVal) {
        alert("Please choose a cozy coffee spot and set a date/time! ☕");
        return;
    }
    
    const invitePayload = {
        place_id: parseInt(placeId),
        place_name: placeName,
        time: timeVal,
        note: noteVal,
        status: 'pending'
    };
    
    const rawMessage = '[COFFEE_INVITATION]' + JSON.stringify(invitePayload);
    
    fetch('api/messages.php?action=send', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `receiver_id=${activeChatReceiverId}&message=${encodeURIComponent(rawMessage)}`
    })
    .then(r => r.json())
    .then(data => {
        if (data.status === 'success') {
            if (modal) modal.style.display = 'none';
            timeInput.value = '';
            if (noteInput) noteInput.value = '';
            
            const chatContainer = document.querySelector('.chat-messages-container');
            const now = new Date();
            const timeString = now.toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit', hour12: true });
            const msgObj = {
                id: data.message_id,
                sender_id: (typeof MY_USER_ID !== 'undefined' ? MY_USER_ID : -1),
                receiver_id: (typeof activeChatReceiverId !== 'undefined' ? activeChatReceiverId : -1),
                message: rawMessage,
                time: timeString
            };
            const msgHtml = formatChatMessage(msgObj);
            chatContainer.insertAdjacentHTML('beforeend', msgHtml);
            scrollToBottomChat();
        } else {
            alert("Error sending coffee date invitation: " + data.message);
        }
    })
    .catch(err => console.error("Error sending coffee invitation", err));
}

function sendChatMessage(e) {
    if (e && e.preventDefault) e.preventDefault();

    const input = document.getElementById('chatMsgInput') || document.getElementById('chatInputField');
    const targetReceiverId = (typeof ACTIVE_PARTNER_ID !== 'undefined' && ACTIVE_PARTNER_ID) 
        ? ACTIVE_PARTNER_ID 
        : ((typeof activeChatReceiverId !== 'undefined' && activeChatReceiverId) ? activeChatReceiverId : null);
    
    if (!input || !input.value.trim() || !targetReceiverId) return;
    
    const messageText = input.value.trim();
    input.value = ''; // Clean input quickly for fast UX
    
    // Render optimistic UI bubble if container is available
    const stream = document.getElementById('chatStream') || document.querySelector('.chat-messages-container');
    if (stream) {
        const tempId = 'temp_' + Date.now();
        const optimisticHtml = `
            <div class="msg-anim-wrapper flex items-end gap-2.5 max-w-[85%] self-end flex-row-reverse" data-msg-id="${tempId}">
                <div class="msg-bubble-me opacity-90" style="background: linear-gradient(135deg, #ff4d88 0%, #ff1493 100%); color: white; padding: 10px 14px; border-radius: 18px 18px 4px 18px; margin-bottom: 6px;">
                    <div>${typeof escapeHtml === 'function' ? escapeHtml(messageText) : (typeof escapeHTML === 'function' ? escapeHTML(messageText) : messageText)}</div>
                    <span class="block text-[9px] text-pink-200 text-right mt-1 font-mono flex items-center justify-end gap-1">
                        Just now <i class="fa-solid fa-clock text-[9px]"></i>
                    </span>
                </div>
            </div>
        `;
        stream.insertAdjacentHTML('beforeend', optimisticHtml);
        scrollToBottomChat();
    }
    
    const formData = new FormData();
    formData.append('receiver_id', targetReceiverId);
    formData.append('message', messageText);

    fetch('api/messages.php?action=send', {
        method: 'POST',
        body: formData
    })
    .then(r => r.json())
    .then(data => {
        if (data.status === 'success') {
            if (typeof fetchMessages === 'function') {
                fetchMessages();
            }
            if (typeof fetchNewChatMessages === 'function') {
                fetchNewChatMessages();
            }
            
            // Update sidebar card preview on messages.php
            const currCard = document.getElementById(`threadCard_${targetReceiverId}`);
            if (currCard) {
                const msgEl = currCard.querySelector('.thread-card-msg');
                const timeEl = currCard.querySelector('.thread-card-time');
                if (msgEl) msgEl.textContent = messageText;
                if (timeEl) timeEl.textContent = 'Just now';
            }
        } else {
            console.warn('Send message response error:', data.message);
        }
    })
    .catch(e => console.error("Error sending message:", e));
}

function scrollToBottomChat() {
    const stream = document.getElementById('chatStream') || document.querySelector('.chat-messages-container');
    if (stream) {
        stream.scrollTop = stream.scrollHeight;
    }
}

// Keyboard shortcuts for chat
document.addEventListener('keydown', (e) => {
    if (e.key === 'Enter' && !e.shiftKey) {
        const activeEl = document.activeElement;
        if (activeEl && (activeEl.id === 'chatMsgInput' || activeEl.id === 'chatInputField')) {
            e.preventDefault();
            sendChatMessage(e);
        }
    }
});

// Video call features removed

// ==========================================
// 6. INSTANT DATE MATCHING ROULETTE
// ==========================================
function startInstantDateRoulette() {
    const wheel = document.getElementById('rouletteWheel');
    const avatar = document.getElementById('rouletteAvatar');
    const lottie = document.getElementById('rouletteLottie');
    const statusText = document.getElementById('rouletteStatusText');
    const controlBtn = document.getElementById('rouletteControlBtn');
    
    if (!wheel || !avatar || !statusText) return;
    
    wheel.classList.add('spinning');
    statusText.innerText = "Scanning active daters worldwide... Secure moderated connection";
    if (controlBtn) controlBtn.style.display = 'none';
    if (lottie) lottie.style.display = 'block';
    avatar.style.display = 'none';

    // Connect to dynamic match API
    setTimeout(() => {
        fetch('api/random_match.php')
        .then(r => r.json())
        .then(data => {
            wheel.classList.remove('spinning');
            
            if (data.status === 'success') {
                if (lottie) lottie.style.display = 'none';
                avatar.src = `uploads/avatars/${data.match_avatar}`;
                avatar.style.display = 'block';
                statusText.innerHTML = `<span style='color:var(--success); font-weight:700;'>Match Found! 💥</span> Connect instant dating with <strong>${data.match_name}</strong>`;
                
                // Add direct redirect transition delay
                setTimeout(() => {
                    window.location.href = `messages.php?receiver_id=${data.match_id}&instant=1`;
                }, 1800);
            } else {
                if (lottie) lottie.style.display = 'none';
                avatar.src = 'assets/images/default_avatar.png';
                avatar.style.display = 'block';
                statusText.innerText = "No daters online right now. Swiping is recommended!";
                if (controlBtn) controlBtn.style.display = 'inline-block';
            }
        })
        .catch(err => {
            wheel.classList.remove('spinning');
            if (lottie) lottie.style.display = 'none';
            avatar.src = 'assets/images/default_avatar.png';
            avatar.style.display = 'block';
            statusText.innerText = "Offline connection failure.";
            if (controlBtn) controlBtn.style.display = 'inline-block';
        });
    }, 4000);
}

function handleSimSwipe(action) {
    const deck = document.getElementById('landingSwipeDeck');
    if (!deck) return;
    const topCard = deck.querySelector('.landing-sim-card');
    if (!topCard) return;

    const distance = action === 'like' ? 320 : -320;
    topCard.style.transform = `translate(${distance}px, -100px) rotate(${action === 'like' ? 25 : -25}deg)`;
    topCard.style.opacity = '0';
    topCard.style.transition = 'transform 0.45s ease, opacity 0.45s ease';

    setTimeout(() => {
        if (topCard && topCard.parentElement) {
            topCard.parentElement.removeChild(topCard);
        }
    }, 420);
}

// ==========================================
// 7. SOCIAL FEED INTERACTION HANDLERS
// ==========================================
function togglePostLike(postId, element) {
    fetch('social.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `action=like&post_id=${postId}`
    })
    .then(r => r.json())
    .then(data => {
        if (data.status === 'success') {
            const countEl = element.querySelector('.like-count');
            const heartIcon = element.querySelector('i');
            
            if (data.liked) {
                heartIcon.classList.remove('fa-regular');
                heartIcon.classList.add('fa-solid');
                heartIcon.style.color = 'var(--primary)';
                element.style.color = 'var(--primary)';
            } else {
                heartIcon.classList.remove('fa-solid');
                heartIcon.classList.add('fa-regular');
                heartIcon.style.color = '';
                element.style.color = '';
            }
            
            if (countEl) {
                countEl.innerText = data.likes_count;
            }
        }
    })
    .catch(err => console.error("Error toggling post like", err));
}

// Helper utilities
function escapeHTML(str) {
    return str.replace(/[&<>'"]/g, 
        tag => ({
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            "'": '&#39;',
            '"': '&quot;'
        }[tag] || tag)
    );
}

// ==========================================
// 8. GLOBAL NOTIFICATION TOASTER ENGINE
// ==========================================
var lastNotifiedMsgId = window.lastNotifiedMsgId || null;

function startGlobalNotificationPoller() {
    const hasNav = document.querySelector('.nav-links');
    if (!hasNav) return;

    if (window.Notification && Notification.permission === "default") {
        window.Notification.requestPermission().catch(err => console.warn("Notification request permission failed:", err));
    }

    setInterval(pollNotifications, 4000);
    setInterval(pollActivityNotifications, 6000);
    pollActivityNotifications();
}

function pollNotifications() {
    const chatContainer = document.querySelector('.chat-messages-container');
    const onChatPage = !!chatContainer;

    fetch('api/check_notifications.php')
    .then(r => r.json())
    .then(data => {
        if (data.status === 'success') {
            const badgeEl = document.querySelector('.nav-link[href="messages.php"] .nav-badge');
            if (badgeEl) {
                if (data.unread_count > 0) {
                    badgeEl.style.display = 'inline-block';
                    badgeEl.innerText = data.unread_count;
                } else {
                    badgeEl.style.display = 'none';
                }
            } else if (data.unread_count > 0) {
                const chatNavLink = document.querySelector('.nav-link[href="messages.php"]');
                if (chatNavLink) {
                    chatNavLink.insertAdjacentHTML('beforeend', `<span class="nav-badge">${data.unread_count}</span>`);
                }
            }

            if (data.incoming_call) {
                const call = data.incoming_call;
                const activePartnerEl = document.querySelector('.chat-messages-container');
                const currentActivePartnerId = activePartnerEl ? activePartnerEl.getAttribute('data-receiver-id') : null;

                if (!(onChatPage && parseInt(currentActivePartnerId) === parseInt(call.sender_id))) {
                    showIncomingCallToast(call);
                }
            }

            if (data.latest_notification) {
                const notif = data.latest_notification;

                if (notif.id !== lastNotifiedMsgId) {
                    const activePartnerEl = document.querySelector('.chat-messages-container');
                    const currentActivePartnerId = activePartnerEl ? activePartnerEl.getAttribute('data-receiver-id') : null;

                    if (onChatPage && parseInt(currentActivePartnerId) === parseInt(notif.sender_id)) {
                        lastNotifiedMsgId = notif.id;
                        return;
                    }

                    if (lastNotifiedMsgId !== null) {
                        showGlassNotificationToast(notif);
                    }
                    lastNotifiedMsgId = notif.id;
                }
            }
        }
    })
    .catch(err => console.error("Notification poller error", err));
}

function pollActivityNotifications() {
    const bellCount = document.getElementById('notifBellCount');
    const notifList = document.getElementById('notifList');
    if (!bellCount || !notifList) return;

    fetch('api/activity.php')
    .then(r => r.json())
    .then(data => {
        if (data.status === 'success') {
            if (data.unread_count > 0) {
                bellCount.style.display = 'inline-block';
                bellCount.innerText = data.unread_count > 99 ? '99+' : data.unread_count;
            } else {
                bellCount.style.display = 'none';
            }

            if (data.notifications && data.notifications.length > 0) {
                notifList.innerHTML = data.notifications.map(n => {
                    let actionHtml = '';
                    if (n.interactive) {
                        actionHtml = `
                            <div class="notif-actions" style="margin-top: 8px; display: flex; gap: 8px; justify-content: flex-start;">
                                <button onclick="handleNotifAction(event, '${n.target_type}', 'accept', ${n.actor_id || n.id})" class="notif-btn accept" style="background:#10b981; color:#fff; border:none; padding:4px 10px; border-radius:12px; font-size:0.7rem; font-weight:600; cursor:pointer; transition: opacity 0.2s;">Accept</button>
                                <button onclick="handleNotifAction(event, '${n.target_type}', 'decline', ${n.actor_id || n.id})" class="notif-btn decline" style="background:rgba(255,255,255,0.08); color:#ff4a5a; border:1px solid #ff4a5a; padding:4px 10px; border-radius:12px; font-size:0.7rem; font-weight:600; cursor:pointer; transition: opacity 0.2s;">Decline</button>
                            </div>
                        `;
                    }
                    const targetLink = n.link === 'javascript:void(0)' ? `profile.php?id=${n.actor_id}` : n.link;
                    return `
                        <div class="notif-item" style="display: flex; flex-direction: column; padding: 12px 16px; border-bottom: 1px solid rgba(255,255,255,0.05); position: relative; gap: 4px;">
                            <div style="display: flex; align-items: flex-start; gap: 12px; width: 100%;">
                                <img src="uploads/avatars/${n.actor_avatar}" onerror="this.src='assets/images/default_avatar.png';" style="width: 38px; height: 38px; border-radius: 50%; object-fit: cover;" alt="">
                                <div class="notif-content" style="flex: 1;">
                                    <div class="notif-text" style="font-size: 0.85rem; font-weight: 600; color: #fff;">
                                        <i class="fa-solid ${n.icon}" style="color:${n.color};margin-right:6px;font-size:0.75rem;"></i>
                                        <a href="${targetLink}" style="color: #fff; text-decoration: none;" onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'">${escapeHTML(n.actor_name)}</a>
                                    </div>
                                    <div class="notif-sub" style="font-size: 0.75rem; color: rgba(255,255,255,0.6); margin-top: 2px;">${escapeHTML(n.text)}</div>
                                    ${actionHtml}
                                </div>
                                <div class="notif-time" style="font-size: 0.65rem; color: rgba(255,255,255,0.4); text-align: right;">${n.time}</div>
                            </div>
                        </div>
                    `;
                }).join('');
            } else {
                notifList.innerHTML = `
                    <div class="notif-empty">
                        <i class="fa-regular fa-bell-slash"></i>
                        <div>No new notifications</div>
                    </div>
                `;
            }
        }
    })
    .catch(err => console.error("Activity poller error", err));
}

function escapeHTML(str) {
    if (!str) return '';
    const div = document.createElement('div');
    div.textContent = str;
    return div.innerHTML;
}

function handleNotifAction(event, targetType, action, id) {
    if (event) event.stopPropagation();
    
    const targetBtn = event.target;
    targetBtn.style.opacity = '0.5';
    targetBtn.disabled = true;
    
    let url = '';
    let formData = new FormData();
    
    if (targetType === 'connection') {
        url = `api/connections.php?action=${action}`;
        formData.append('receiver_id', id); // Accept/Decline connection expects receiver_id (partner's ID)
    } else if (targetType === 'date') {
        url = `api/date_invitation.php?action=respond`;
        formData.append('invitation_id', id);
        formData.append('status', action); // 'accepted' or 'declined'
    }
    
    fetch(url, {
        method: 'POST',
        body: formData
    })
    .then(r => r.json())
    .then(data => {
        if (data.status === 'success') {
            const item = targetBtn.closest('.notif-item');
            if (item) {
                item.style.transition = 'all 0.3s ease';
                item.style.background = action === 'accept' ? 'rgba(16,185,129,0.1)' : 'rgba(239,68,68,0.1)';
                const container = item.querySelector('.notif-content');
                if (container) {
                    container.innerHTML = `
                        <div style="font-size:0.8rem; color:${action==='accept'?'#10b981':'#ff4a5a'}; font-weight:600; padding: 4px 0;">
                            <i class="fa-solid ${action==='accept'?'fa-check-double':'fa-ban'}"></i> 
                            Request ${action === 'accept' ? 'Accepted' : 'Declined'}!
                        </div>
                    `;
                }
            }
            setTimeout(pollActivityNotifications, 1500);
        } else {
            alert(data.message || 'Error executing action');
            targetBtn.style.opacity = '1';
            targetBtn.disabled = false;
        }
    })
    .catch(err => {
        console.error(err);
        targetBtn.style.opacity = '1';
        targetBtn.disabled = false;
    });
}

document.addEventListener('DOMContentLoaded', function() {
    const notifBell = document.getElementById('notifBell');
    const notifDropdown = document.getElementById('notifDropdown');

    if (notifBell && notifDropdown) {
        notifBell.addEventListener('click', function(e) {
            e.stopPropagation();
            const isOpen = notifDropdown.classList.contains('open');
            document.querySelectorAll('.notif-dropdown.open').forEach(d => d.classList.remove('open'));
            if (!isOpen) {
                notifDropdown.classList.add('open');
                pollActivityNotifications();
            }
        });

        document.addEventListener('click', function(e) {
            if (!notifDropdown.contains(e.target) && !notifBell.contains(e.target)) {
                notifDropdown.classList.remove('open');
            }
        });
    }
});

function markAllNotificationsRead() {
    const notifList = document.getElementById('notifList');
    const bellCount = document.getElementById('notifBellCount');
    if (notifList) {
        notifList.innerHTML = `
            <div class="notif-empty">
                <i class="fa-regular fa-circle-check"></i>
                <div>All caught up!</div>
            </div>
        `;
    }
    if (bellCount) {
        bellCount.style.display = 'none';
    }
    fetch('api/activity.php?action=mark_read', { method: 'POST' }).catch(() => {});
}

// Override old polling function signature expectations
window.markAllNotificationsRead = markAllNotificationsRead;

function showIncomingCallToast(call) {
    // Remove any existing call toast first
    const existing = document.querySelector('.call-request-toast');
    if (existing) existing.remove();

    const toastHtml = `
        <div class="call-request-toast" style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background: rgba(7, 5, 15, 0.98); border: 2px solid var(--primary); backdrop-filter: blur(30px); box-shadow: 0 0 40px var(--primary-glow); border-radius: 20px; padding: 25px; display: flex; flex-direction: column; align-items: center; gap: 20px; z-index: 100000; max-width: 380px; cursor: default;">
            <div style="text-align: center;">
                <i class="fa-solid fa-video" style="font-size: 3rem; color: var(--primary); margin-bottom: 10px;"></i>
                <h3 style="font-weight: 700; color: white; font-size: 1.2rem; margin-bottom: 5px;">Incoming Call</h3>
                <p style="color: var(--text-muted); font-size: 0.9rem;">${escapeHTML(call.sender_name)} is requesting a video call</p>
            </div>
            <div style="display: flex; gap: 15px;">
                <button onclick="acceptCall(${call.id}, ${call.sender_id})" style="background: #10b981; color: white; border: none; padding: 12px 24px; border-radius: 12px; font-weight: 700; cursor: pointer; display: flex; align-items: center; gap: 8px; font-size: 0.95rem;">
                    <i class="fa-solid fa-check"></i> Accept
                </button>
                <button onclick="declineCall(${call.id}, this)" style="background: rgba(239, 68, 68, 0.15); color: #ef4444; border: 1px solid rgba(239, 68, 68, 0.3); padding: 12px 24px; border-radius: 12px; font-weight: 700; cursor: pointer; display: flex; align-items: center; gap: 8px; font-size: 0.95rem;">
                    <i class="fa-solid fa-xmark"></i> Decline
                </button>
            </div>
        </div>
    `;

    document.body.insertAdjacentHTML('beforeend', toastHtml);
}

function acceptCall(messageId, senderId) {
    fetch('api/messages.php?action=update_call', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `message_id=${messageId}&status=accepted`
    })
    .then(r => r.json())
    .then(data => {
        if (data.status === 'success') {
            const toast = document.querySelector('.call-request-toast');
            if (toast) toast.remove();
            window.location.href = 'video.php?partner_id=' + senderId;
        }
    })
    .catch(err => console.error("Accept call error", err));
}

function declineCall(messageId, btn) {
    fetch('api/messages.php?action=update_call', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `message_id=${messageId}&status=declined`
    })
    .then(r => r.json())
    .then(data => {
        if (data.status === 'success') {
            const toast = document.querySelector('.call-request-toast');
            if (toast) toast.remove();
        }
    })
    .catch(err => console.error("Decline call error", err));
}

function showGlassNotificationToast(notif) {
    // Remove any existing toast first
    const existing = document.querySelector('.glass-notif-toast');
    if (existing) existing.remove();

    // Trigger Native Browser OS-level Notification
    if (window.Notification && Notification.permission === "granted") {
        let plainMsg = notif.message || '';
        if (plainMsg.startsWith('[COFFEE_INVITATION]')) {
            plainMsg = "Sent you a Coffee Date Invitation! ☕";
        }
        try {
            const systemNotification = new Notification(notif.sender_name + " ☕", {
                body: plainMsg,
                icon: notif.sender_avatar ? "uploads/avatars/" + notif.sender_avatar : "assets/images/default_avatar.png",
                tag: "msg-" + notif.sender_id,
                renotify: true
            });
            systemNotification.onclick = function() {
                window.focus();
                window.location.href = 'messages.php?receiver_id=' + notif.sender_id;
            };
        } catch (e) {
            console.warn("Failed to show system notification:", e);
        }
    }

    const toastHtml = `
        <div class="glass-notif-toast" onclick="window.location.href='messages.php?receiver_id=${notif.sender_id}'" style="position: fixed; bottom: 30px; right: 30px; background: rgba(7, 5, 15, 0.95); border: 1.5px solid var(--primary); backdrop-filter: blur(25px); box-shadow: 0 0 25px var(--primary-glow); border-radius: 16px; padding: 15px 20px; display: flex; align-items: center; gap: 15px; z-index: 99999; max-width: 350px; cursor: pointer; animation: slideInRight 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);">
            <img src="uploads/avatars/${notif.sender_avatar}" onerror="this.src='assets/images/default_avatar.png';" style="width: 48px; height: 48px; border-radius: 50%; border: 2px solid var(--secondary); object-fit: cover;">
            <div style="flex: 1;">
                <div style="font-weight: 700; color: white; font-size: 0.9rem; display: flex; justify-content: space-between; align-items: center; margin-bottom: 2px;">
                    <span>${escapeHTML(notif.sender_name)} ☕</span>
                    <span style="font-size: 0.7rem; color: var(--text-muted); font-weight: normal;">${notif.time}</span>
                </div>
                <div style="font-size: 0.8rem; color: #d1d5db; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 200px;">
                    ${escapeHTML(notif.message)}
                </div>
            </div>
            <button style="background: none; border: none; color: var(--text-muted); cursor: pointer; font-size: 1.1rem;" onclick="event.stopPropagation(); this.parentElement.remove();">&times;</button>
        </div>
    `;

    document.body.insertAdjacentHTML('beforeend', toastHtml);

    // Auto-remove after 6 seconds
    setTimeout(() => {
        const toast = document.querySelector('.glass-notif-toast');
        if (toast) {
            toast.style.animation = 'slideOutRight 0.4s ease forwards';
            setTimeout(() => toast.remove(), 400);
        }
    }, 6000);
}

// ==========================================
// 8. ROMANTIC LOVE PARTICLES BACKGROUND SYSTEM
// ==========================================
function initLoveParticles() {
    const canvas = document.getElementById('loveParticlesCanvas');
    if (!canvas) return;

    const ctx = canvas.getContext('2d');
    let width = canvas.width = window.innerWidth;
    let height = canvas.height = window.innerHeight;

    // Handle screen resize
    window.addEventListener('resize', () => {
        width = canvas.width = window.innerWidth;
        height = canvas.height = window.innerHeight;
    });

    const particles = [];
    const heartSymbol = '♥';

    class Particle {
        constructor() {
            this.reset();
            // Start at random y values initially
            this.y = Math.random() * height;
        }

        reset() {
            this.x = Math.random() * width;
            this.y = height + 20;
            this.size = Math.random() * 15 + 8; // Size of hearts/glows
            this.speedY = -(Math.random() * 1.2 + 0.4); // Floating up speed
            this.speedX = Math.sin(Math.random() * Math.PI) * 0.4; // Swaying speed
            this.opacity = Math.random() * 0.4 + 0.1; // Soft translucent values
            this.fadeSpeed = Math.random() * 0.002 + 0.001;
            this.type = Math.random() > 0.55 ? 'heart' : 'glow';
            this.color = Math.random() > 0.5 ? '#ff2a75' : '#ff7597';
        }

        update() {
            this.y += this.speedY;
            this.x += this.speedX;

            // Oscillate sway
            this.speedX += Math.sin(this.y * 0.01) * 0.02;

            // Boundary checks
            if (this.y < -20 || this.opacity <= 0 || this.x < -20 || this.x > width + 20) {
                this.reset();
            }
        }

        draw() {
            ctx.save();
            ctx.globalAlpha = this.opacity;
            ctx.fillStyle = this.color;
            ctx.shadowBlur = this.size * 0.8;
            ctx.shadowColor = this.color;

            if (this.type === 'heart') {
                ctx.font = `${this.size}px Arial`;
                ctx.fillText(heartSymbol, this.x, this.y);
            } else {
                ctx.beginPath();
                ctx.arc(this.x, this.y, this.size / 2.5, 0, Math.PI * 2);
                ctx.fill();
            }
            ctx.restore();
        }
    }

    // Initialize particle pool (50 particles is a sweet spot for performance)
    const particleCount = 50;
    for (let i = 0; i < particleCount; i++) {
        particles.push(new Particle());
    }

    function animate() {
        ctx.clearRect(0, 0, width, height);

        particles.forEach(p => {
            p.update();
            p.draw();
        });

        requestAnimationFrame(animate);
    }

    animate();
}

// Call on load if canvas exists
document.addEventListener('DOMContentLoaded', () => {
    initLoveParticles();
    
    // GSAP animations removed to prevent disappearing images on scroll as requested.
});
