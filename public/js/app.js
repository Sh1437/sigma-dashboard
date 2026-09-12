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
            setTheme(getCurrentTheme() === 'dark' ? 'light' : 'dark');
        });
    }
}

function updateSidebarToggleIcon(isCollapsed) {
    const button = document.getElementById('sidebarToggle');
    if (!button) return;

    const icon = button.querySelector('[data-lucide]');
    if (!icon) return;

    icon.setAttribute('data-lucide', isCollapsed ? 'panel-left-open' : 'panel-left-close');
    initLucide();
}

function initSidebar() {
    const sidebar = document.getElementById('sidebar');
    const topbar = document.getElementById('topbar');
    const main = document.getElementById('main');
    const toggle = document.getElementById('sidebarToggle');

    if (!sidebar || !topbar || !main || !toggle) return;

    const applyDesktopState = (collapsed) => {
        sidebar.classList.toggle('sidebar-collapsed', collapsed);
        topbar.classList.toggle('sidebar-collapsed', collapsed);
        main.classList.toggle('sidebar-collapsed', collapsed);
        localStorage.setItem('sigma-sidebar-collapsed', collapsed ? '1' : '0');
        updateSidebarToggleIcon(collapsed);
    };

    const isDesktop = () => window.matchMedia('(min-width: 1024px)').matches;

    if (isDesktop()) {
        applyDesktopState(localStorage.getItem('sigma-sidebar-collapsed') === '1');
    }

    if (toggle.dataset.sidebarBound !== 'true') {
        toggle.dataset.sidebarBound = 'true';
        toggle.addEventListener('click', () => {
            if (isDesktop()) {
                applyDesktopState(!sidebar.classList.contains('sidebar-collapsed'));
            } else {
                sidebar.classList.toggle('sidebar-open');
            }
        });
    }

    window.addEventListener('resize', () => {
        if (isDesktop()) {
            sidebar.classList.remove('sidebar-open');
            applyDesktopState(localStorage.getItem('sigma-sidebar-collapsed') === '1');
        } else {
            sidebar.classList.remove('sidebar-collapsed');
            topbar.classList.remove('sidebar-collapsed');
            main.classList.remove('sidebar-collapsed');
            updateSidebarToggleIcon(false);
        }
    });
}

document.addEventListener('DOMContentLoaded', () => {
    initLucide();
    initThemeToggle();
    initSidebar();
    initLoginAnimation();

    const profileButton = document.getElementById('profileButton');
    const accountMenu = document.getElementById('accountMenu');

    if (profileButton && accountMenu && profileButton.dataset.menuBound !== 'true') {
        profileButton.dataset.menuBound = 'true';

        const closeMenu = () => {
            accountMenu.classList.add('hidden');
            profileButton.setAttribute('aria-expanded', 'false');
        };

        const openMenu = () => {
            accountMenu.classList.remove('hidden');
            profileButton.setAttribute('aria-expanded', 'true');
        };

        profileButton.addEventListener('click', (event) => {
            event.preventDefault();
            event.stopPropagation();

            if (accountMenu.classList.contains('hidden')) {
                openMenu();
            } else {
                closeMenu();
            }
        });

        accountMenu.addEventListener('click', (event) => {
            event.stopPropagation();
        });

        document.addEventListener('click', closeMenu);
        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape') closeMenu();
        });
    }
});


function initLoginAnimation() {
    const form = document.getElementById('loginForm');
    const submitButton = document.getElementById('loginSubmitButton');
    const overlay = document.getElementById('loginSuccessOverlay');
    const errorBox = document.getElementById('loginError');

    if (!form || !submitButton || !overlay || form.dataset.loginBound === 'true') return;
    form.dataset.loginBound = 'true';

    const showError = (message) => {
        if (!errorBox) return;
        errorBox.textContent = message || 'Login gagal. Silakan periksa data Anda.';
        errorBox.classList.remove('hidden');
    };

    const clearError = () => {
        if (!errorBox) return;
        errorBox.textContent = '';
        errorBox.classList.add('hidden');
    };

    form.addEventListener('submit', async (event) => {
        event.preventDefault();
        clearError();

        if (!form.reportValidity()) return;

        submitButton.disabled = true;
        submitButton.classList.add('is-loading');
        const originalLabel = submitButton.textContent;
        submitButton.textContent = 'Memverifikasi...';

        try {
            const response = await fetch(form.action, {
                method: 'POST',
                body: new FormData(form),
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                credentials: 'same-origin'
            });

            const data = await response.json().catch(() => ({}));

            if (!response.ok) {
                const firstError = data?.errors
                    ? Object.values(data.errors).flat()[0]
                    : (data.message || 'Login gagal. Silakan periksa data Anda.');
                showError(firstError);
                return;
            }

            overlay.classList.add('is-active');
            overlay.setAttribute('aria-hidden', 'false');
            document.body.style.overflow = 'hidden';

            const destination = data.redirect || '/dashboard';
            window.setTimeout(() => {
                window.location.href = destination;
            }, 3000);
        } catch (error) {
            showError('Tidak dapat menghubungi server. Silakan coba lagi.');
        } finally {
            if (!overlay.classList.contains('is-active')) {
                submitButton.disabled = false;
                submitButton.classList.remove('is-loading');
                submitButton.textContent = originalLabel;
            }
        }
    });
}
