function initLucide() {
    if (window.lucide) {
        window.lucide.createIcons({ strokeWidth: 1.8 });
    }
}

function getCurrentTheme() {
    return document.documentElement.classList.contains('dark') ? 'dark' : 'light';
}

function updateThemeIcons() {
    const dark = getCurrentTheme() === 'dark';
    const moon = document.getElementById('themeIconMoon');
    const sun = document.getElementById('themeIconSun');

    if (moon) moon.classList.toggle('hidden', dark);
    if (sun) sun.classList.toggle('hidden', !dark);
}

function setTheme(theme) {
    const dark = theme === 'dark';
    document.documentElement.classList.toggle('dark', dark);
    localStorage.setItem('sigma-theme', theme);
    updateThemeIcons();
    initLucide();
}

function initThemeToggle() {
    const toggle = document.getElementById('themeToggle');

    updateThemeIcons();

    if (toggle && toggle.dataset.themeBound !== 'true') {
        toggle.dataset.themeBound = 'true';

        toggle.addEventListener('click', () => {
            setTheme(
                getCurrentTheme() === 'dark'
                    ? 'light'
                    : 'dark'
            );
        });
    }
}

document.addEventListener('DOMContentLoaded', () => {
    initLucide();
    initThemeToggle();

    const sidebar = document.getElementById('sidebar');
    const topbar = document.getElementById('topbar');
    const main = document.getElementById('main');
    const toggle = document.getElementById('sidebarToggle');

    if (toggle && sidebar && topbar && main) {
        toggle.addEventListener('click', () => {
            const hidden = sidebar.classList.toggle('sidebar-hidden');
            topbar.classList.toggle('sidebar-collapsed', hidden);
            main.classList.toggle('sidebar-collapsed', hidden);
        });
    }

    const accountButton = document.getElementById('accountButton');
    const accountMenu = document.getElementById('accountMenu');

    if (accountButton && accountMenu) {
        accountButton.addEventListener('click', (event) => {
            event.stopPropagation();
            accountMenu.classList.toggle('hidden');
        });

        document.addEventListener('click', (event) => {
            if (!accountMenu.contains(event.target) && !accountButton.contains(event.target)) {
                accountMenu.classList.add('hidden');
            }
        });
    }
});
