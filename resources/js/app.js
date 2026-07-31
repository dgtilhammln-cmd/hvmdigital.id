import Alpine from 'alpinejs';
window.Alpine = Alpine;

// Apply theme immediately before Alpine starts (avoid FOUC)
const applyTheme = () => {
    const stored = localStorage.getItem('hvm-theme');
    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
    if (stored === 'dark' || (!stored && prefersDark)) {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark');
    }
};

// Run immediately
applyTheme();

// Expose toggle globally — called via onclick="toggleTheme()"
window.toggleTheme = () => {
    const isDark = document.documentElement.classList.toggle('dark');
    localStorage.setItem('hvm-theme', isDark ? 'dark' : 'light');
};

Alpine.start();
