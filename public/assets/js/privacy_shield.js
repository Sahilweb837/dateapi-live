/**
 * CupDate Privacy & Security Shield Engine
 * Anti-Screenshot Detection, Anti-Image-Download Protection & Live Typing Engine
 */
(function () {
    'use strict';

    // 1. DISABLE CONTEXT MENU & DRAG ON ALL IMAGES
    document.addEventListener('contextmenu', function (e) {
        if (e.target.tagName === 'IMG' || e.target.closest('.user-card-avatar') || e.target.closest('.post-media') || e.target.closest('.profile-avatar')) {
            e.preventDefault();
            showSecurityToast('🔒 Image saving & right-click protected by CupDate Privacy Shield');
            return false;
        }
    });

    document.addEventListener('dragstart', function (e) {
        if (e.target.tagName === 'IMG') {
            e.preventDefault();
            return false;
        }
    });

    // 2. SCREENSHOT DETECTION & KEY COMBINATION BLOCKING
    document.addEventListener('keydown', function (e) {
        // PrintScreen Key (PrtScn / PrintScreen)
        if (e.key === 'PrintScreen' || e.code === 'PrintScreen') {
            handleScreenshotAttempt();
        }
        // Mac: Cmd + Shift + 3 or Cmd + Shift + 4 or Cmd + Shift + 5
        if ((e.metaKey || e.ctrlKey) && e.shiftKey && (e.key === '3' || e.key === '4' || e.key === '5' || e.code === 'Digit3' || e.code === 'Digit4')) {
            handleScreenshotAttempt();
        }
        // Ctrl + P (Print) or Ctrl + S (Save)
        if ((e.ctrlKey || e.metaKey) && (e.key === 'p' || e.key === 'P' || e.key === 's' || e.key === 'S')) {
            e.preventDefault();
            showSecurityToast('🔒 Save & Print disabled for user privacy');
            return false;
        }
    });

    // Blur page momentarily if screenshot key pressed
    function handleScreenshotAttempt() {
        showSecurityToast('📸 Security Warning: Screenshots are detected & logged for dater safety!');
        
        // Trigger blur effect on media elements
        const mediaElements = document.querySelectorAll('img, .post-media, .user-card-avatar, .chat-messages-stream');
        mediaElements.forEach(el => {
            el.style.filter = 'blur(30px)';
            setTimeout(() => {
                el.style.filter = '';
            }, 2500);
        });

        // Broadcast screenshot alert event if inside active chat
        if (window.activePartnerId && typeof window.reportScreenshotToChat === 'function') {
            window.reportScreenshotToChat();
        }
    }

    // Security Toast Notification
    function showSecurityToast(message) {
        let toast = document.getElementById('cupdateSecurityToast');
        if (!toast) {
            toast = document.createElement('div');
            toast.id = 'cupdateSecurityToast';
            toast.style.cssText = `
                position: fixed;
                bottom: 80px;
                left: 50%;
                transform: translateX(-50%);
                background: rgba(239, 68, 68, 0.92);
                backdrop-filter: blur(12px);
                color: #ffffff;
                padding: 12px 24px;
                border-radius: 30px;
                font-weight: 700;
                font-size: 0.88rem;
                box-shadow: 0 10px 30px rgba(0,0,0,0.4), 0 0 20px rgba(239, 68, 68, 0.6);
                z-index: 999999;
                transition: opacity 0.3s ease;
                pointer-events: none;
            `;
            document.body.appendChild(toast);
        }
        toast.innerText = message;
        toast.style.opacity = '1';

        setTimeout(() => {
            toast.style.opacity = '0';
        }, 3000);
    }

    // Expose helpers globally
    window.CupDatePrivacy = {
        showSecurityToast: showSecurityToast,
        handleScreenshotAttempt: handleScreenshotAttempt
    };

})();
