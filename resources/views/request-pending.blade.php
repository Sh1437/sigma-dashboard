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
        <a class="nav-item" href="{{ route('kr-barang-keluar.index') }}"><i data-lucide="log-out"></i><span>KR Barang Keluar</span></a>
        <a class="nav-item active" href="{{ route('request-pending.index') }}"><i data-lucide="clipboard-list"></i><span>Request / Pending</span></a>

        <div class="section-label mt-[14px]">DATA KENDARAAN</div>
        <a class="nav-item" href="{{ route('all-vehicle.index') }}"><i data-lucide="truck"></i><span>All Vehicle</span></a>
        <a class="nav-item" href="{{ route('sigma-today.index') }}"><i data-lucide="calendar-check-2"></i><span>Sigma Today</span></a>
        <a class="nav-item" href="{{ route('movement.index') }}"><i data-lucide="route"></i><span>Movement</span></a>

        <div class="section-label mt-[14px]">REPORT</div>
        <a class="nav-item" href="#"><i data-lucide="file-text"></i><span>Laporan Harian</span></a>
        <a class="nav-item" href="#"><i data-lucide="calendar-days"></i><span>Laporan Bulanan</span></a>

        <div class="section-label mt-[14px]">MASTER & APPROVAL</div>
        <a class="nav-item" href="#"><i data-lucide="database"></i><span>Kolom Input Data</span></a>
        <a class="nav-item" href="{{ route('suspend-driver.index') }}"><i data-lucide="user-x"></i><span>Suspend Driver</span></a>
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
      <div class="role-access-page min-h-[calc(100vh-64px)] bg-[#f4f7fb] px-[26px] pb-10 pt-[25px]">
        <div class="mx-auto max-w-[1500px]">
          <div class="mb-5 flex items-start justify-between gap-4">
            <div><h1 class="role-page-title text-[24px] font-extrabold text-[#071d43]">Request / Pending</h1><p class="role-page-subtitle mt-1 text-[12px] text-[#7c90b1]">Kelola input User dan Upload Excel sebelum dikirim ke Sigma Today.</p></div>
            <button type="button" id="uploadExcel" class="inline-flex h-[42px] items-center gap-2 rounded-[8px] border border-[#d7e0ec] bg-white px-4 text-[11px] font-extrabold text-[#071d43]"><i data-lucide="upload" class="h-5 w-5"></i>Upload Excel</button>
          </div>
          <section class="role-access-card overflow-hidden rounded-[12px] border border-[#dce4ef] bg-white shadow-[0_1px_3px_rgba(15,35,70,.04)]">
            <form method="GET" action="{{ route('request-pending.index') }}" class="flex flex-wrap items-center gap-2 p-3">
              <input type="date" name="date" value="{{ $filters['date'] }}" class="h-[36px] w-[128px] rounded-[7px] border border-[#d7e0ec] bg-white px-3 text-[10px] text-[#536a8b]">
              <select name="type" class="h-[36px] rounded-[7px] border border-[#d7e0ec] bg-white px-3 text-[10px] text-[#536a8b]"><option value="">Semua Jenis</option><option value="Import" @selected($filters['type']==='Import')>Import</option><option value="Export" @selected($filters['type']==='Export')>Export</option></select>
              <select name="source" class="h-[36px] rounded-[7px] border border-[#d7e0ec] bg-white px-3 text-[10px] text-[#536a8b]"><option value="">Semua Sumber</option><option value="Input User" @selected($filters['source']==='Input User')>Input User</option><option value="Upload Excel" @selected($filters['source']==='Upload Excel')>Upload Excel</option></select>
              <select name="status" class="h-[36px] rounded-[7px] border border-[#d7e0ec] bg-white px-3 text-[10px] text-[#536a8b]"><option value="">Semua Status</option><option value="PENDING" @selected($filters['status']==='PENDING')>Pending</option><option value="APPROVED" @selected($filters['status']==='APPROVED')>Approved</option><option value="REJECTED" @selected($filters['status']==='REJECTED')>Rejected</option></select>
              <input name="search" value="{{ $filters['search'] }}" placeholder="Cari request / kendaraan" class="h-[36px] min-w-[190px] flex-1 rounded-[7px] border border-[#d7e0ec] bg-white px-3 text-[10px]">
              <button class="inline-flex h-[36px] items-center gap-2 rounded-[7px] bg-[#1769d2] px-4 text-[10px] font-extrabold text-white"><i data-lucide="funnel" class="h-5 w-5"></i>Filter</button>
              @if($filters['type'] || $filters['source'] || $filters['status'] || $filters['search'] || $filters['date']!=='2026-09-12')<a href="{{ route('request-pending.index') }}" class="text-[10px] font-bold text-[#246edb]">Reset</a>@endif
            </form>
            <div class="overflow-x-auto"><table class="w-full min-w-[1280px] text-left text-[10px] text-[#294363]"><thead class="bg-[#f6f8fb] text-[9px] font-extrabold uppercase tracking-wide text-[#536a8b]"><tr><th class="px-3 py-3">NO.</th><th>NO. REQUEST</th><th>SUMBER</th><th>TANGGAL INPUT</th><th>JENIS</th><th>NO. KR</th><th>KENDARAAN</th><th>DRIVER</th><th>TOTAL ITEM</th><th>STATUS</th><th>DIKIRIM OLEH</th><th>AKSI</th></tr></thead>
            <tbody>@forelse($requests as $i=>$r)<tr class="border-t border-[#edf1f6] hover:bg-[#f9fbfd]"><td class="px-3 py-4">{{ $i+1 }}</td><td class="font-extrabold text-[#071d43]">{{ $r['request'] }}</td><td>{{ $r['source'] }}</td><td>{{ $r['date'] }}</td><td>{{ $r['type'] }}</td><td>{{ $r['kr'] }}</td><td>{{ $r['vehicle'] }}</td><td>{{ $r['driver'] }}</td><td>{{ $r['total'] }}</td><td><span class="rounded-full bg-orange-100 px-2.5 py-1 text-[9px] font-extrabold text-orange-600">{{ $r['status'] }}</span></td><td>{{ $r['sender'] }}</td><td><button type="button" class="requestAction h-[32px] rounded-[7px] {{ $r['action']==='Validasi'?'bg-[#1769d2] text-white':'border border-[#d7e0ec] bg-white text-[#071d43]' }} px-4 text-[10px] font-extrabold" data-request="{{ $r['request'] }}">{{ $r['action'] }}</button></td></tr>@empty<tr><td colspan="12" class="p-8 text-center text-[#7c90b1]">Data request tidak ditemukan.</td></tr>@endforelse</tbody></table></div>
          </section>
          <div class="mt-[480px] text-center text-[22px] font-extrabold tracking-tight"><span class="text-red-500">KRAKATAU</span> <span class="text-sky-600">POSCO</span></div>
        </div>
      </div>
    </main>
  </div>
  <div id="uploadModal" class="fixed inset-0 z-[100] hidden items-center justify-center bg-[#071d43]/50 px-4"><div class="w-full max-w-[480px] rounded-[14px] bg-white p-5 shadow-2xl dark:bg-[#0d213b]"><div class="flex justify-between"><div><h3 class="text-[16px] font-extrabold dark:text-white">Upload Excel</h3><p class="mt-1 text-[11px] text-[#7487a8]">Pilih file Excel untuk menambahkan request.</p></div><button id="closeUpload"><i data-lucide="x"></i></button></div><input type="file" accept=".xlsx,.xls" class="mt-5 w-full rounded-[8px] border border-[#d7e0ec] p-3 text-[11px]"><div class="mt-5 flex justify-end gap-2"><button id="cancelUpload" class="rounded-[8px] border px-4 py-2 text-[11px] font-bold">Batal</button><button class="rounded-[8px] bg-[#1769d2] px-4 py-2 text-[11px] font-bold text-white">Upload</button></div></div></div>
  <style>.dark .role-access-page{background:#07182d}.dark .role-access-card{background:#0d213b;border-color:#29405f}.dark .role-page-title{color:#fff}.dark .role-page-subtitle{color:#8ea5c5}.dark table tbody{color:#c8d7eb}.dark input,.dark select{background:#0d213b;border-color:#29405f;color:#e8f0fb}</style>
  <script>document.addEventListener('DOMContentLoaded',()=>{lucide.createIcons();const m=document.getElementById('uploadModal');document.getElementById('uploadExcel').onclick=()=>{m.classList.remove('hidden');m.classList.add('flex')};const c=()=>{m.classList.add('hidden');m.classList.remove('flex')};document.getElementById('closeUpload').onclick=c;document.getElementById('cancelUpload').onclick=c;document.querySelectorAll('.requestAction').forEach(b=>b.onclick=()=>alert(b.textContent.trim()+' request '+b.dataset.request+' (template/demo)'));});</script>
</body></html>
