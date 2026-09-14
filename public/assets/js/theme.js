/**
 * CupDate Theme Manager — theme.js
 * Handles Theme Toggling (Light / Dark), System Preference Detection, and Persistent UI States
 */

(function () {
    const THEME_STORAGE_KEY = 'cupdate_theme_mode';

    function getPreferredTheme() {
        const stored = localStorage.getItem(THEME_STORAGE_KEY);
        if (stored === 'dark' || stored === 'light') {
            return stored;
        }
        return 'light'; // Default to warm modern light theme
    }

    function applyTheme(theme) {
        const root = document.documentElement;
        const body = document.body;
        
        if (theme === 'dark') {
            root.setAttribute('data-theme', 'dark');
            if (body) body.classList.add('dark-theme');
        } else {
            root.removeAttribute('data-theme');
            if (body) body.classList.remove('dark-theme');
        }
        
        // Dispatch custom event for reactive UI components
        window.dispatchEvent(new CustomEvent('cupdate:themeChanged', { detail: { theme } }));
    }

    function toggleTheme() {
        const current = document.documentElement.getAttribute('data-theme') === 'dark' ? 'dark' : 'light';
        const next = current === 'dark' ? 'light' : 'dark';
        localStorage.setItem(THEME_STORAGE_KEY, next);
        applyTheme(next);
        return next;
    }

    // Apply on DOM load
    document.addEventListener('DOMContentLoaded', () => {
        applyTheme(getPreferredTheme());
    });

    // Expose global helper
    window.CupDateTheme = {
        get: getPreferredTheme,
        set: (theme) => {
            localStorage.setItem(THEME_STORAGE_KEY, theme);
            applyTheme(theme);
        },
        toggle: toggleTheme
    };
})();
