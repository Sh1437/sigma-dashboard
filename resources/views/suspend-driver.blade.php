<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Suspend Driver - SIGMA</title>
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
        <a class="nav-item active" href="{{ route('suspend-driver.index') }}"><i data-lucide="user-x"></i><span>Suspend Driver</span></a>
        <a class="nav-item" href="{{ route('blacklist-driver.index') }}"><i data-lucide="ban"></i><span>Blacklist Driver</span></a>
        <a class="nav-item" href="{{ route('user-management.index') }}"><i data-lucide="users"></i><span>User Management</span></a>
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
      <div class="role-access-page min-h-[calc(100vh-64px)] bg-[#f4f7fb] px-[26px] pb-4 pt-[25px]">
        <div class="flex items-start justify-between gap-4">
          <div>
            <h1 class="role-page-title text-[23px] font-extrabold tracking-[-.03em] text-[#071d43]">Suspend Driver</h1>
            <p class="role-page-subtitle mt-1 text-[11px] font-medium text-[#7c90b1]">Kelola data user dan status pengguna SIGMA.</p>
          </div>
          <a href="{{ route('suspend-driver.create') }}" class="inline-flex h-[42px] items-center gap-2 rounded-[9px] bg-[#246edb] px-5 text-[11px] font-extrabold text-white shadow-sm transition hover:bg-[#1e62c6]">
            <i data-lucide="plus" class="h-[18px] w-[18px]"></i><span>Tambah</span>
          </a>
        </div>

        @if (session('success'))
          <div class="mt-4 rounded-[9px] border border-emerald-200 bg-emerald-50 px-4 py-3 text-[11px] font-bold text-emerald-700">{{ session('success') }}</div>
        @endif

        <section class="mt-[20px] overflow-hidden rounded-[12px] border border-[#dce5f0] bg-white shadow-[0_1px_2px_rgba(20,45,82,.03)] role-access-card">
          <form method="GET" action="{{ route('suspend-driver.index') }}" class="flex flex-wrap items-center gap-2 border-b border-[#dce5f0] p-[12px] role-filter-form">
            <div class="relative w-full sm:w-[230px]">
              <i data-lucide="search" class="pointer-events-none absolute left-3 top-1/2 h-[15px] w-[15px] -translate-y-1/2 text-[#8ca0be]"></i>
              <input id="roleSearch" name="search" value="{{ $filters['search'] }}" type="search" placeholder="Cari nama, identitas, role, gate..." class="form-control h-[36px] w-full rounded-[7px] border border-[#d7e0ec] bg-white pl-9 pr-3 text-[11px] text-[#071d43] outline-none" />
            </div>

            <select id="roleStatus" name="status" class="form-control h-[36px] w-full rounded-[7px] border border-[#d7e0ec] bg-white px-3 text-[11px] font-medium text-[#526987] outline-none sm:w-[150px]">
              <option value="">Semua Status</option>
              <option value="Available" @selected($filters['status'] === 'Available')>Available</option>
              <option value="Pending" @selected($filters['status'] === 'Pending')>Pending</option>
            </select>

            <select id="roleCategory" name="role" class="form-control h-[36px] w-full rounded-[7px] border border-[#d7e0ec] bg-white px-3 text-[11px] font-medium text-[#526987] outline-none sm:w-[170px]">
              <option value="">Semua Role / Kategori</option>
              @foreach ($roles as $roleOption)
                <option value="{{ $roleOption }}" @selected($filters['role'] === $roleOption)>{{ $roleOption }}</option>
              @endforeach
            </select>


            <button type="submit" class="h-[36px] rounded-[7px] border border-[#cfd9e7] bg-white px-4 text-[11px] font-extrabold text-[#0b2553] transition hover:bg-[#f4f7fb]">Filter</button>

            @if ($filters['search'] || $filters['status'] || $filters['role'])
              <a href="{{ route('user-management.index') }}" class="inline-flex h-[36px] items-center rounded-[7px] px-3 text-[10px] font-bold text-[#6f84a5] hover:bg-[#f4f7fb]">Reset</a>
            @endif
          </form>

          <div class="overflow-x-auto">
            <table class="w-full min-w-[900px] border-collapse text-left">
              <thead>
                <tr class="h-[32px] bg-[#f7f9fc] text-[9px] font-extrabold uppercase tracking-[.06em] text-[#637b9f]">
                  <th class="px-[12px]">Nama</th><th class="px-[12px]">Identitas</th><th class="px-[12px]">Role / Kategori</th><th class="px-[12px]">Gate</th><th class="px-[12px]">Status</th><th class="px-[12px]">Aksi</th>
                </tr>
              </thead>
              <tbody class="role-access-tbody text-[11px] text-[#30496e]">
                @forelse ($users as $user)
                  <tr class="h-[52px] border-t border-[#e6ecf4]">
                    <td class="px-[12px] font-semibold">{{ $user['name'] }}</td>
                    <td class="px-[12px]">{{ $user['identity'] }}</td>
                    <td class="px-[12px] font-semibold">{{ $user['role'] }}</td>
                    <td class="px-[12px]">{{ $user['gate'] }}</td>
                    <td class="px-[12px]">
                      <span class="badge {{ $user['status'] === 'Available' ? 'bg-[#dff3ff] text-[#0575a8]' : 'bg-[#fff0d9] text-[#e46a00]' }}">{{ strtoupper($user['status']) }}</span>
                    </td>
                    <td class="px-[12px]">
                      <button type="button" class="role-detail-btn rounded-[7px] border border-[#d5dfec] px-3 py-2 text-[10px] font-extrabold text-[#0b2553] hover:bg-[#f7f9fc]" data-user='@json($user)'>Detail</button>
                    </td>
                  </tr>
                @empty
                  <tr><td colspan="6" class="px-4 py-12 text-center text-[12px] font-semibold text-[#8295b3]">Data tidak ditemukan. Ubah kata pencarian atau filter.</td></tr>
                @endforelse
              </tbody>
            </table>
          </div>

          <div class="role-access-summary flex items-center justify-between border-t border-[#e6ecf4] px-4 py-3 text-[10px] text-[#7d90ae]">
            <span>Menampilkan {{ count($users) }} dari {{ $totalUsers }} data</span>
            <span>Filter aktif: {{ ($filters['search'] || $filters['status'] || $filters['role']) ? 'Ya' : 'Tidak' }}</span>
          </div>
        </section>

        <footer class="mt-[calc(100vh-470px)] flex justify-center pb-[10px]">
          <img src="{{ asset('images/krakatau-posco.png') }}" alt="Krakatau Posco" class="h-[28px] w-auto object-contain" />
        </footer>
      </div>

      <div id="roleModal" class="fixed inset-0 z-[80] hidden items-center justify-center bg-[#061225]/60 p-4 backdrop-blur-[2px]">
        <div class="w-full max-w-[480px] rounded-[14px] border border-[#dce5f0] bg-white p-5 shadow-2xl role-modal-card">
          <div class="flex items-center justify-between"><div><h2 id="roleModalTitle" class="text-[16px] font-extrabold text-[#071d43]">Tambah Access</h2><p class="mt-1 text-[10px] text-[#8194b2]">Informasi detail Suspend Driver SIGMA.</p></div><button id="closeRoleModal" type="button" class="rounded-lg p-2 text-[#7186a6] hover:bg-slate-100"><i data-lucide="x" class="h-5 w-5"></i></button></div>
          <div id="roleModalBody" class="mt-5"></div>
        </div>
      </div>
    </main>
  </div>
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const modal = document.getElementById('roleModal');
      const title = document.getElementById('roleModalTitle');
      const body = document.getElementById('roleModalBody');
      const open = () => { modal?.classList.remove('hidden'); modal?.classList.add('flex'); };
      const close = () => { modal?.classList.add('hidden'); modal?.classList.remove('flex'); };
      document.getElementById('closeRoleModal')?.addEventListener('click', close);
      modal?.addEventListener('click', e => { if (e.target === modal) close(); });
      document.addEventListener('keydown', e => { if (e.key === 'Escape') close(); });
      document.querySelectorAll('.role-detail-btn').forEach(btn => btn.addEventListener('click', () => {
        const u = JSON.parse(btn.dataset.user);
        title.textContent = 'Detail Suspend Driver';
        body.innerHTML = `<div class="grid grid-cols-2 gap-3 text-[11px]">
          <div class="rounded-lg bg-slate-50 p-3"><div class="text-[9px] font-bold text-slate-400">NAMA</div><div class="mt-1 font-extrabold text-[#071d43]">${u.name}</div></div>
          <div class="rounded-lg bg-slate-50 p-3"><div class="text-[9px] font-bold text-slate-400">IDENTITAS</div><div class="mt-1 font-extrabold text-[#071d43]">${u.identity}</div></div>
          <div class="rounded-lg bg-slate-50 p-3"><div class="text-[9px] font-bold text-slate-400">ACCESS</div><div class="mt-1 font-extrabold text-[#071d43]">${u.role}</div></div>
          <div class="rounded-lg bg-slate-50 p-3"><div class="text-[9px] font-bold text-slate-400">GATE</div><div class="mt-1 font-extrabold text-[#071d43]">${u.gate}</div></div>
          <div class="col-span-2 rounded-lg bg-slate-50 p-3"><div class="text-[9px] font-bold text-slate-400">STATUS</div><div class="mt-1 font-extrabold text-[#071d43]">${u.status}</div></div>
        </div><a href="{{ url('/suspend-driver') }}/${encodeURIComponent(u.identity)}/edit" class="mt-4 inline-flex h-[38px] w-full items-center justify-center gap-2 rounded-[8px] bg-[#246edb] px-4 text-[11px] font-extrabold text-white hover:bg-[#1e62c6]"><span>Ubah Data</span></a><form method="POST" action="{{ url('/suspend-driver') }}/${encodeURIComponent(u.identity)}" class="mt-2" onsubmit="return confirm('Yakin ingin menghapus data ' + u.name + ' (' + u.identity + ')? Data yang dihapus tidak dapat dikembalikan.');">{{ csrf_field() }}{{ method_field('DELETE') }}<button type="submit" class="inline-flex h-[38px] w-full items-center justify-center gap-2 rounded-[8px] border border-red-200 bg-red-50 px-4 text-[11px] font-extrabold text-red-600 hover:bg-red-100"><span>Hapus Data</span></button></form>`;
        open();
      }));
    });
  </script>
</body>
</html>
