/**
 * CupDate Performance Engine - Mobile Optimization & UX Accelerator
 * Features:
 * - Service Worker Registration (PWA caching)
 * - IntersectionObserver image lazy loading & progressive decode
 * - Touch & Scroll passive listeners for 60fps rendering
 * - Intelligent Hover / Touch Pre-fetching for fast navigation
 * - Tap highlight cleanup
 */

(function () {
    'use strict';

    // 1. Service Worker Registration
    if ('serviceWorker' in navigator && (window.location.protocol === 'https:' || window.location.hostname === 'localhost' || window.location.hostname === '127.0.0.1')) {
        window.addEventListener('load', function () {
            navigator.serviceWorker.register('/sw.js', { scope: '/' })
                .then(function (reg) {
                    // Update check periodically
                    reg.onupdatefound = function () {
                        var installingWorker = reg.installing;
                        if (installingWorker) {
                            installingWorker.onstatechange = function () {
                                if (installingWorker.state === 'installed' && navigator.serviceWorker.controller) {
                                    console.log('[CupDate SW] New content available.');
                                }
                            };
                        }
                    };
                })
                .catch(function (err) {
                    console.warn('[CupDate SW] Registration failed:', err);
                });
        });
    }

    // 2. Intelligent Link Prefetching on Hover / Touch
    var prefetchedUrls = new Set();
    function prefetchUrl(url) {
        if (!url || prefetchedUrls.has(url)) return;
        try {
            var parsed = new URL(url, window.location.origin);
            if (parsed.origin !== window.location.origin) return;
            if (parsed.pathname.match(/\.(pdf|zip|sql|png|jpg|jpeg|webp)$/i)) return;
            if (parsed.pathname.indexOf('/logout') !== -1) return;

            prefetchedUrls.add(url);
            var link = document.createElement('link');
            link.rel = 'prefetch';
            link.href = url;
            link.as = 'document';
            document.head.appendChild(link);
        } catch (e) {}
    }

    // Attach prefetch to internal links on mouseover or touchstart
    document.addEventListener('mouseover', function (e) {
        var anchor = e.target.closest('a');
        if (anchor && anchor.href && !anchor.target) {
            prefetchUrl(anchor.href);
        }
    }, { passive: true });

    document.addEventListener('touchstart', function (e) {
        var anchor = e.target.closest('a');
        if (anchor && anchor.href && !anchor.target) {
            prefetchUrl(anchor.href);
        }
    }, { passive: true });

    // 3. Fallback IntersectionObserver for Lazy Images
    if ('IntersectionObserver' in window) {
        var imageObserver = new IntersectionObserver(function (entries, observer) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    var img = entry.target;
                    if (img.dataset.src) {
                        img.src = img.dataset.src;
                        img.removeAttribute('data-src');
                    }
                    if (img.dataset.srcset) {
                        img.srcset = img.dataset.srcset;
                        img.removeAttribute('data-srcset');
                    }
                    if ('decode' in img) {
                        img.decode().catch(function () {});
                    }
                    observer.unobserve(img);
                }
            });
        }, {
            rootMargin: '200px 0px',
            threshold: 0.01
        });

        document.addEventListener('DOMContentLoaded', function () {
            var lazyImages = document.querySelectorAll('img[data-src], img[loading="lazy"]');
            lazyImages.forEach(function (img) {
                imageObserver.observe(img);
            });
        });
    }

    // 4. Decode Above-The-Fold Images Fast
    document.addEventListener('DOMContentLoaded', function () {
        var highPriorityImgs = document.querySelectorAll('img[fetchpriority="high"], .header-logo, .hero-img');
        highPriorityImgs.forEach(function (img) {
            if (img.complete && 'decode' in img) {
                img.decode().catch(function () {});
            }
        });
    });

    // 5. Back/Forward Cache (bfcache) restore handling
    window.addEventListener('pageshow', function (event) {
        if (event.persisted) {
            // Re-check unread badges or active session if needed
            document.body.classList.remove('loading-state');
        }
    });

})();
