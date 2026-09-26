<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>User Management - SIGMA</title>
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
          {{-- Logo Light Mode --}}
          <img
            src="{{ asset('images/sigma-logo.png') }}"
            alt="SIGMA"
            class="sigma-brand-full-logo sigma-dashboard-logo-light"
          />

          {{-- Logo Dark Mode --}}
          <img
            src="{{ asset('images/sigma-logo-dark.png') }}"
            alt="SIGMA"
            class="sigma-brand-full-logo sigma-dashboard-logo-dark"
          />
        </div>

        <div class="sigma-brand-icon" aria-hidden="true">
          {{-- Compact icon untuk Light Mode --}}
          <img
            src="{{ asset('images/sigma-logo-icon.png') }}"
            alt=""
            class="sigma-brand-icon-logo sigma-sidebar-icon-light"
          />

          {{-- Compact icon khusus Dark Mode --}}
          <img
            src="{{ asset('images/dark-icon.png') }}"
            alt=""
            class="sigma-brand-icon-logo sigma-sidebar-icon-dark"
          />
        </div>
      </div>

      <nav class="h-[calc(100vh-78px)] overflow-y-auto px-[10px] pb-6 pt-[10px] sidebar-scroll">
        <div class="section-label">UTAMA</div>
        <a class="nav-item" href="{{ route('dashboard') }}"><i data-lucide="layout-dashboard"></i><span>Dashboard</span></a>

        <div class="section-label mt-[14px]">REGISTRASI</div>
        <a class="nav-item" href="{{ route('registration.create') }}"><i data-lucide="file-plus-2"></i><span>KR Barang Masuk</span></a>
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
        <a class="nav-item" href="{{ route('suspend-driver.index') }}"><i data-lucide="user-x"></i><span>Suspend Driver</span></a>
        <a class="nav-item" href="{{ route('blacklist-driver.index') }}"><i data-lucide="ban"></i><span>Blacklist Driver</span></a>
        <a class="nav-item active" href="{{ route('user-management.index') }}"><i data-lucide="users"></i><span>User Management</span></a>
        <a class="nav-item" href="{{ route('role-access.index') }}"><i data-lucide="shield-check"></i><span>Role/Access Management</span></a>
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
      <div class="role-access-page min-h-[calc(100vh-64px)] bg-[#f4f7fb] px-[26px] pb-8 pt-[25px]">
        <div class="mx-auto max-w-[920px]">
          <a href="{{ route('user-management.index') }}" class="mb-4 inline-flex items-center gap-2 text-[11px] font-bold text-[#647b9d]"><i data-lucide="arrow-left" class="h-4 w-4"></i>Kembali ke User Management</a>
          <div class="role-access-card rounded-[14px] border border-[#dce5f0] bg-white p-6 shadow-sm">
            <div class="border-b border-[#e6ecf4] pb-5">
              <h1 class="role-page-title text-[22px] font-extrabold text-[#071d43]">Ubah Data User</h1>
              <p class="role-page-subtitle mt-1 text-[11px] text-[#7c90b1]">Perbarui identitas, role, gate, atau status access.</p>
            </div>
            @if ($errors->any())
              <div class="mt-5 rounded-[9px] border border-red-200 bg-red-50 p-3 text-[11px] text-red-700">{{ $errors->first() }}</div>
            @endif
            <form method="POST" action="{{ route('user-management.update', $user['identity']) }}" class="mt-6 grid grid-cols-1 gap-5 md:grid-cols-2">
              @csrf
              @method('PUT')
              <label class="text-[10px] font-extrabold text-[#526987]">Nama
                <input name="name" value="{{ old('name', $user['name']) }}" class="form-control mt-2 h-[42px] w-full rounded-[8px] border border-[#d7e0ec] bg-white px-3 text-[11px]" required>
              </label>
              <label class="text-[10px] font-extrabold text-[#526987]">Identitas
                <input name="identity" value="{{ old('identity', $user['identity']) }}" class="form-control mt-2 h-[42px] w-full rounded-[8px] border border-[#d7e0ec] bg-white px-3 text-[11px]" required>
              </label>
              <label class="text-[10px] font-extrabold text-[#526987]">Role / Kategori
                <select id="accessRole" name="role" class="form-control mt-2 h-[42px] w-full rounded-[8px] border border-[#d7e0ec] bg-white px-3 text-[11px]" required>
                  @foreach($roles as $roleOption)<option value="{{ $roleOption }}" @selected(old('role', $user['role']) === $roleOption)>{{ $roleOption }}</option>@endforeach
                </select>
              </label>
              <label class="text-[10px] font-extrabold text-[#526987]">Gate
                <select id="accessGate" name="gate" class="form-control mt-2 h-[42px] w-full rounded-[8px] border border-[#d7e0ec] bg-white px-3 text-[11px]" required>
                  @foreach(['All Gate','Gate 1','Gate 2','Gate 3'] as $gate)<option value="{{ $gate }}" @selected(old('gate', $user['gate']) === $gate)>{{ $gate }}</option>@endforeach
                </select>
              </label>
              <label class="text-[10px] font-extrabold text-[#526987] md:col-span-2">Status
                <select name="status" class="form-control mt-2 h-[42px] w-full rounded-[8px] border border-[#d7e0ec] bg-white px-3 text-[11px]" required>
                  <option value="Active" @selected(old('status', $user['status']) === 'Active')>Active</option>
                  <option value="Pending" @selected(old('status', $user['status']) === 'Pending')>Pending</option>
                </select>
              </label>
              <div class="flex justify-end gap-3 border-t border-[#e6ecf4] pt-5 md:col-span-2">
                <a href="{{ route('user-management.index') }}" class="inline-flex h-[40px] items-center rounded-[8px] border border-[#d5dfec] px-5 text-[11px] font-extrabold text-[#526987]">Batal</a>
                <button type="submit" class="inline-flex h-[40px] items-center gap-2 rounded-[8px] bg-[#246edb] px-5 text-[11px] font-extrabold text-white hover:bg-[#1e62c6]"><i data-lucide="save" class="h-4 w-4"></i>Simpan Perubahan</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </main>
  </div>
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const role = document.getElementById('accessRole'), gate = document.getElementById('accessGate');
      const syncGate = () => { const map={'Super Admin':'All Gate','Admin Gate 1':'Gate 1','Admin Gate 2':'Gate 2','Admin Gate 3':'Gate 3'}; if(map[role.value]) gate.value=map[role.value]; };
      role?.addEventListener('change', syncGate);
    });
  </script>
</body>
</html>