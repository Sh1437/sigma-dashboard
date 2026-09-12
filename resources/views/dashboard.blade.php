<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>SIGMA Dashboard</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <!-- Tailwind CSS 3 - Play CDN (tanpa npm / tanpa file Tailwind lokal) -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      darkMode: 'class',
      theme: {
        extend: {
          colors: {
            sigma: {
              navy: '#0b2553',
              blue: '#246edb',
              bg: '#f4f7fb',
              line: '#dde5f1',
              ink: '#071d43',
              muted: '#7890b7'
            }
          },
          fontFamily: {
            sans: ['Inter', 'ui-sans-serif', 'system-ui', 'Segoe UI', 'Arial', 'sans-serif']
          }
        }
      }
    };
  </script>
  <script>
    (() => {
      const savedTheme = localStorage.getItem('sigma-theme');
      const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
      if (savedTheme === 'dark' || (!savedTheme && prefersDark)) {
        document.documentElement.classList.add('dark');
      }
    })();
  </script>
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <script src="https://unpkg.com/lucide@0.468.0/dist/umd/lucide.min.js"></script>
  <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body class="bg-sigma-bg text-sigma-ink antialiased">
  <div class="min-h-screen">
    <!-- Sidebar -->
    <aside id="sidebar" class="fixed inset-y-0 left-0 z-40 w-[258px] bg-[#0b2553] text-white transition-all duration-300">
      <div class="sigma-brand-area border-b border-white/10">
        <div class="sigma-brand-full">
          <img src="{{ asset('images/sigma-logo.png') }}" alt="SIGMA" class="sigma-brand-full-logo" />
        </div>

        <div class="sigma-brand-icon" aria-hidden="true">
          <img src="{{ asset('images/sigma-logo-icon.png') }}" alt="" class="sigma-brand-icon-logo" />
        </div>
      </div>

      <nav class="h-[calc(100vh-78px)] overflow-y-auto px-[10px] pb-6 pt-[10px] sidebar-scroll">
        <div class="section-label">UTAMA</div>
        <a class="nav-item active" href="#"><i data-lucide="layout-dashboard"></i><span>Dashboard</span></a>

        <div class="section-label mt-[14px]">REGISTRASI</div>
        <a class="nav-item" href="#"><i data-lucide="file-plus-2"></i><span>KR Barang Masuk</span></a>
        <a class="nav-item" href="#"><i data-lucide="log-out"></i><span>KR Barang Keluar</span></a>
        <a class="nav-item" href="#"><i data-lucide="clipboard-list"></i><span>Request / Pending</span></a>

        <div class="section-label mt-[14px]">DATA KENDARAAN</div>
        <a class="nav-item" href="#"><i data-lucide="truck"></i><span>All Vehicle</span></a>
        <a class="nav-item" href="#"><i data-lucide="calendar-check-2"></i><span>Sigma Today</span></a>
        <a class="nav-item" href="#"><i data-lucide="route"></i><span>Movement</span></a>

        <div class="section-label mt-[14px]">REPORT</div>
        <a class="nav-item" href="#"><i data-lucide="file-text"></i><span>Laporan Harian</span></a>
        <a class="nav-item" href="#"><i data-lucide="calendar-days"></i><span>Laporan Bulanan</span></a>

        <div class="section-label mt-[14px]">MASTER & APPROVAL</div>
        <a class="nav-item" href="#"><i data-lucide="database"></i><span>Kolom Input Data</span></a>
        <a class="nav-item" href="#"><i data-lucide="user-x"></i><span>Suspend Driver</span></a>
        <a class="nav-item" href="#"><i data-lucide="ban"></i><span>Blacklist Driver</span></a>
        <a class="nav-item" href="#"><i data-lucide="users"></i><span>User Management</span></a>
        <a class="nav-item" href="#"><i data-lucide="shield-check"></i><span>Role/Access Management</span></a>
      </nav>
    </aside>

    <!-- Topbar -->
    <header class="fixed left-[258px] right-0 top-0 z-30 h-[64px] border-b border-[#e0e7f1] bg-white transition-all duration-300" id="topbar">
      <div class="flex h-full items-center justify-between px-[26px]">
        <button id="sidebarToggle" class="flex h-[40px] w-[40px] items-center justify-center rounded-[8px] border border-[#dbe3ef] text-[#0b2553] hover:bg-slate-50" aria-label="Toggle Sidebar">
          <i data-lucide="panel-left-close" class="h-[21px] w-[21px]"></i>
        </button>

        <div class="flex items-center gap-[12px]">
          <div class="hidden xl:flex h-[36px] w-[208px] items-center rounded-[7px] border border-[#dce4ef] px-3 text-[12px] text-[#93a3bd]">
            <i data-lucide="search" class="mr-2 h-[15px] w-[15px]"></i>
            <span>Cari No. KR / kendaraan</span>
          </div>

          <button id="themeToggle" type="button" class="theme-toggle flex h-[40px] w-[40px] items-center justify-center rounded-[7px] border border-[#dce4ef] text-[#0b2553]" aria-label="Ubah tema" title="Ubah tema">
            <i id="themeIconMoon" data-lucide="moon" class="h-[18px] w-[18px]"></i>
            <i id="themeIconSun" data-lucide="sun" class="hidden h-[18px] w-[18px]"></i>
          </button>

          <button class="notification-button relative flex h-[40px] w-[40px] items-center justify-center rounded-[7px] border border-[#dce4ef] text-[#0b2553]">
            <i data-lucide="bell" class="h-[19px] w-[19px]"></i>
            <span class="absolute -right-[3px] -top-[3px] h-[8px] w-[8px] rounded-full bg-[#ff6b21] ring-2 ring-white"></span>
          </button>

          <div class="hidden lg:block">
            <button type="button" class="flex h-[34px] min-w-[146px] items-center justify-between rounded-[6px] border border-[#dce4ef] px-3 text-[11px] font-extrabold text-[#0b2553]" aria-label="Role aktif">
              <span id="roleLabel">{{ $role }}</span>
              <i data-lucide="chevron-down" class="h-[14px] w-[14px]"></i>
            </button>
          </div>

          <div class="relative hidden md:block">
            <button id="profileButton" type="button" class="profile-pill" aria-haspopup="true" aria-expanded="false">
              <span class="profile-pill-avatar">
                <i data-lucide="user-round" class="h-[15px] w-[15px]"></i>
              </span>
              <span class="min-w-0 text-right leading-tight">
                <span id="operatorLabel" class="block max-w-[118px] truncate text-[11px] font-extrabold text-[#081e43]">{{ $operator }}</span>
                <span id="roleSubLabel" class="mt-[2px] block text-[9px] text-[#7487a8]">{{ $roleSubLabel }}</span>
              </span>
              <i data-lucide="chevron-down" class="profile-pill-chevron h-[13px] w-[13px]"></i>
            </button>

            <div id="accountMenu" class="absolute right-0 top-[48px] z-50 hidden w-[220px] overflow-hidden rounded-[12px] border border-[#dce4ef] bg-white p-2 shadow-[0_14px_34px_rgba(15,35,70,.16)]">
              <div class="border-b border-[#edf1f6] px-2 pb-2 pt-1">
                <div class="text-[11px] font-extrabold text-[#081e43]">{{ $operator }}</div>
                <div class="mt-1 text-[9px] text-[#7487a8]">{{ $role }}</div>
              </div>

              <div class="mt-1 space-y-1">
                <button type="button" class="account-menu-item">
                  <i data-lucide="user-round" class="h-[15px] w-[15px]"></i>
                  <span>Profile</span>
                </button>

                <button type="button" class="account-menu-item">
                  <i data-lucide="settings" class="h-[15px] w-[15px]"></i>
                  <span>Setting</span>
                </button>
              </div>

              <div class="my-1 border-t border-[#edf1f6]"></div>

              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="account-menu-item account-menu-logout">
                  <i data-lucide="log-out" class="h-[15px] w-[15px]"></i>
                  <span>Logout</span>
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </header>

    <!-- Main -->
    <main id="main" class="ml-[258px] min-h-screen pt-[64px] transition-all duration-300">
      <div class="min-h-[calc(100vh-64px)] px-[26px] pb-[82px] pt-[24px]">
        <section>
          <h1 class="text-[24px] font-extrabold leading-none tracking-[-.025em] text-[#071d43]">Selamat datang, <span id="welcomeName">{{ $operator }}</span></h1>
          <p class="mt-[9px] text-[12px] font-medium text-[#7c90b1]">{{ $dateLabel }}</p>
        </section>

        <!-- Stats -->
        <section class="mt-[24px] grid grid-cols-1 gap-[13px] sm:grid-cols-2 xl:grid-cols-5">
          <article class="stat-card">
            <div><p class="stat-title">Total Transaksi</p><p class="stat-value">128</p></div>
            <div class="stat-icon bg-[#edf5ff] text-[#2371e8]"><i data-lucide="layers-3"></i></div>
          </article>
          <article class="stat-card">
            <div><p class="stat-title">Barang Masuk</p><p class="stat-value">72</p></div>
            <div class="stat-icon bg-[#eafbf4] text-[#13a46b]"><i data-lucide="arrow-down-to-line"></i></div>
          </article>
          <article class="stat-card">
            <div><p class="stat-title">Barang Keluar</p><p class="stat-value">41</p></div>
            <div class="stat-icon bg-[#fff1f1] text-[#ef4444]"><i data-lucide="arrow-up-to-line"></i></div>
          </article>
          <article class="stat-card">
            <div><p class="stat-title">Movement</p><p class="stat-value">09</p></div>
            <div class="stat-icon bg-[#e4f8fb] text-[#008ca1]"><i data-lucide="route"></i></div>
          </article>
          <article class="stat-card">
            <div><p class="stat-title">Request Pending</p><p class="stat-value">06</p></div>
            <div class="stat-icon bg-[#fff5e9] text-[#f16b16]"><i data-lucide="clock-3"></i></div>
          </article>
        </section>

        <section class="mt-[16px] grid grid-cols-1 gap-[16px] xl:grid-cols-[2.05fr_1fr]">
          <!-- Today table -->
          <article class="panel min-h-[284px]">
            <div class="flex items-start justify-between">
              <div>
                <h2 class="panel-title">SIGMA TODAY</h2>
                <p class="panel-subtitle">Transaksi kendaraan aktif hari ini</p>
              </div>
              <a href="#" class="mt-[3px] text-[11px] font-extrabold text-[#1f64d0]">Lihat semua</a>
            </div>

            <div class="mt-[13px] overflow-x-auto">
              <table class="w-full min-w-[700px] table-fixed text-left">
                <thead>
                  <tr class="h-[28px] bg-[#f5f7fb] text-[9px] font-extrabold tracking-[.04em] text-[#5f7397]">
                    <th class="w-[21%] px-[12px]">NO. KR</th>
                    <th class="w-[23%] px-[12px]">KENDARAAN</th>
                    <th class="w-[16%] px-[12px]">DRIVER</th>
                    <th class="w-[17%] px-[12px]">GATE IN</th>
                    <th class="px-[12px]">STATUS</th>
                  </tr>
                </thead>
                <tbody class="text-[10px] text-[#2b4268]">
                  <tr class="h-[38px] border-b border-[#e7ecf4]">
                    <td class="px-[12px] font-extrabold text-[#0c2a58]">KR-00125</td>
                    <td class="px-[12px]">B 1234 XX</td>
                    <td class="px-[12px]">Ahmad</td>
                    <td class="px-[12px]">Gate 2</td>
                    <td class="px-[12px]"><span class="badge bg-[#dcecff] text-[#1761c3]">INSIDE</span></td>
                  </tr>
                  <tr class="h-[38px] border-b border-[#e7ecf4]">
                    <td class="px-[12px] font-extrabold text-[#0c2a58]">KR-00126</td>
                    <td class="px-[12px]">B 9876 YY</td>
                    <td class="px-[12px]">Siti</td>
                    <td class="px-[12px]">Gate 1</td>
                    <td class="px-[12px]"><span class="badge bg-[#ffebd0] text-[#d45a00]">PENDING</span></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </article>

          <!-- Quick access -->
          <article class="panel min-h-[284px]">
            <h2 class="panel-title">Akses Cepat</h2>
            <p class="panel-subtitle">Operasi paling sering digunakan</p>
            <div class="mt-[14px] space-y-[8px]">
              <a href="#" class="quick-row">
                <span class="quick-icon bg-[#edf5ff] text-[#216fe1]"><i data-lucide="file-plus-2"></i></span>
                <span>Registrasi Baru</span>
                <i data-lucide="chevron-right" class="ml-auto h-[16px] w-[16px] text-[#90a1bc]"></i>
              </a>
              <a href="#" class="quick-row">
                <span class="quick-icon bg-[#fff4e9] text-[#f27720]"><i data-lucide="clipboard-list"></i></span>
                <span>Request Pending</span>
                <i data-lucide="chevron-right" class="ml-auto h-[16px] w-[16px] text-[#90a1bc]"></i>
              </a>
              <a href="#" class="quick-row">
                <span class="quick-icon bg-[#e7f9fb] text-[#009eb6]"><i data-lucide="qr-code"></i></span>
                <span>Scan QR Keluar</span>
                <i data-lucide="chevron-right" class="ml-auto h-[16px] w-[16px] text-[#90a1bc]"></i>
              </a>
            </div>
          </article>
        </section>

        <section class="mt-[16px] grid grid-cols-1 gap-[16px] xl:grid-cols-2">
          <article class="panel min-h-[138px]">
            <h2 class="panel-title">MOVEMENT / KR NGEPOK JETTY</h2>
            <div class="mt-[10px] divide-y divide-[#e8edf5] text-[10px] text-[#21395f]">
              <div class="flex h-[39px] items-center justify-between">
                <div><span class="font-extrabold text-[#082653]">KR-00120</span><span class="mx-1">·</span>B 7788 DD</div>
                <span class="badge bg-[#dcf6fa] text-[#008ca3]">→ JETTY</span>
              </div>
              <div class="flex h-[39px] items-center justify-between">
                <div><span class="font-extrabold text-[#082653]">KR-00111</span><span class="mx-1">·</span>B 4521 ZZ</div>
                <span class="badge bg-[#eee1ff] text-[#7a38cf]">AT JETTY</span>
              </div>
            </div>
          </article>

          <article class="panel min-h-[138px]">
            <h2 class="panel-title">AKTIVITAS TERBARU</h2>
            <div class="mt-[11px] space-y-[10px] text-[10px] text-[#536b91]">
              <p><span class="font-extrabold text-[#0a2856]">Gate 2</span> Clock In KR-00125 <span class="text-[#8da0bd]">· 08:12</span></p>
              <p><span class="font-extrabold text-[#0a2856]">Gate 1</span> Validasi request KR-00126 <span class="text-[#8da0bd]">· 07:55</span></p>
              <p><span class="font-extrabold text-[#0a2856]">Gate 4</span> Movement menuju Jetty <span class="text-[#8da0bd]">· 07:42</span></p>
            </div>
          </article>
        </section>

        <footer class="mt-[142px] flex justify-center pb-[10px]">
          <img src="{{ asset('images/krakatau-posco.png') }}" alt="Krakatau Posco" class="h-[28px] w-auto object-contain" />
        </footer>
      </div>
    </main>
  </div>
  <script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>
