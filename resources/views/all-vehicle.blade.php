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
        <a class="nav-item" href="{{ route('request-pending.index') }}"><i data-lucide="clipboard-list"></i><span>Request / Pending</span></a>

        <div class="section-label mt-[14px]">DATA KENDARAAN</div>
        <a class="nav-item active" href="{{ route('all-vehicle.index') }}"><i data-lucide="truck"></i><span>All Vehicle</span></a>
        <a class="nav-item" href="{{ route('sigma-today.index') }}"><i data-lucide="calendar-check-2"></i><span>Sigma Today</span></a>
        <a class="nav-item" href="{{ route('movement.index') }}"><i data-lucide="route"></i><span>Movement</span></a>

        <div class="section-label mt-[14px]">REPORT</div>
        <a class="nav-item" href="{{ route('daily-report.index') }}"><i data-lucide="file-text"></i><span>Laporan Harian</span></a>
        <a class="nav-item" href="{{ route('monthly-report.index') }}"><i data-lucide="calendar-days"></i><span>Laporan Bulanan</span></a>

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
          <div class="mb-5">
            <h1 class="role-page-title text-[24px] font-extrabold text-[#071d43]">All Vehicle</h1>
            <p class="role-page-subtitle mt-1 text-[12px] text-[#7c90b1]">Data KR Barang terdaftar dalam sistem SIGMA.</p>
          </div>

          <section class="role-access-card overflow-hidden rounded-[14px] border border-[#dce5f0] bg-white shadow-sm">
            <form method="GET" action="{{ route('all-vehicle.index') }}" class="flex flex-wrap items-center gap-2 border-b border-[#e1e8f2] p-3">
              <div class="relative"><i data-lucide="search" class="absolute left-3 top-[11px] h-4 w-4 text-[#9aabc2]"></i><input name="search" value="{{ $filters['search'] }}" placeholder="Cari No. KR / kendaraan" class="h-[36px] w-[205px] rounded-[7px] border border-[#d7e0ec] bg-white pl-9 pr-3 text-[10px] outline-none focus:border-[#246edb]"></div>
              <select name="gate" class="h-[36px] rounded-[7px] border border-[#d7e0ec] bg-white px-3 text-[10px] font-semibold text-[#536a8b]"><option value="">Semua Gate</option>@foreach(['Gate 1','Gate 2','Gate 3'] as $g)<option value="{{ $g }}" @selected($filters['gate']===$g)>{{ $g }}</option>@endforeach</select>
              <select name="status" class="h-[36px] rounded-[7px] border border-[#d7e0ec] bg-white px-3 text-[10px] font-semibold text-[#536a8b]"><option value="">Semua Status</option>@foreach(['INSIDE','PENDING','COMPLETED'] as $st)<option value="{{ $st }}" @selected($filters['status']===$st)>{{ $st }}</option>@endforeach</select>
              <button class="inline-flex h-[36px] items-center gap-2 rounded-[7px] border border-[#d7e0ec] bg-white px-4 text-[10px] font-extrabold text-[#071d43]"><i data-lucide="funnel" class="h-5 w-5"></i>Filter</button>
              @if($filters['search'] || $filters['gate'] || $filters['status'])<a href="{{ route('all-vehicle.index') }}" class="text-[10px] font-bold text-[#246edb]">Reset</a>@endif
            </form>
            <div class="overflow-x-auto"><table class="w-full min-w-[1320px] text-left text-[10px] text-[#294363]"><thead class="bg-[#f6f8fb] text-[9px] font-extrabold uppercase tracking-wide text-[#536a8b]"><tr><th class="px-3 py-3">NO.</th><th>NO. KR</th><th>TANGGAL</th><th>KENDARAAN</th><th>DRIVER</th><th>JENIS BARANG</th><th>ARAH</th><th>GATE IN</th><th>JAM IN</th><th>GATE OUT</th><th>JAM OUT</th><th>STATUS</th><th>AKSI</th></tr></thead>
              <tbody>@forelse($vehicles as $i=>$t)<tr class="border-t border-[#edf1f6] hover:bg-[#f9fbfd]"><td class="px-3 py-4">{{ (($page-1)*$perPage)+$i+1 }}</td><td class="font-extrabold text-[#071d43]">{{ $t['kr'] }}</td><td>{{ $t['date'] }}</td><td class="font-semibold">{{ $t['vehicle'] }}</td><td>{{ $t['driver'] }}</td><td>{{ $t['goods'] }}</td><td>{{ $t['direction'] }}</td><td>{{ $t['gate_in'] }}</td><td>{{ $t['time_in'] }}</td><td>{{ $t['gate_out'] }}</td><td>{{ $t['time_out'] }}</td><td>@php($cls=$t['status']==='INSIDE'?'bg-blue-100 text-blue-700':($t['status']==='PENDING'?'bg-orange-100 text-orange-600':'bg-emerald-100 text-emerald-700'))<span class="rounded-full px-2.5 py-1 text-[9px] font-extrabold {{ $cls }}">{{ $t['status'] }}</span></td><td><button type="button" class="allVehicleAction flex h-9 w-9 items-center justify-center rounded-[8px] border border-[#d7e0ec] bg-white" data-kr="{{ $t['kr'] }}"><i data-lucide="ellipsis" class="h-5 w-5"></i></button></td></tr>@empty<tr><td colspan="13" class="p-8 text-center text-[#7c90b1]">Data tidak ditemukan.</td></tr>@endforelse</tbody></table></div>
            <div class="flex items-center justify-between border-t border-[#edf1f6] px-3 py-3 text-[10px] text-[#7c90b1]"><span>Menampilkan {{ $total ? (($page-1)*$perPage)+1 : 0 }}–{{ min($page*$perPage,$total) }} dari {{ $total }} transaksi</span><div class="flex items-center gap-1">@php($qs=request()->except('page'))<a href="{{ $page>1 ? request()->fullUrlWithQuery(array_merge($qs,['page'=>$page-1])) : '#' }}" class="flex h-8 w-7 items-center justify-center rounded-[7px] border border-[#d7e0ec] {{ $page<=1?'opacity-40':'' }}">‹</a>@for($p=1;$p<=$pages;$p++)<a href="{{ request()->fullUrlWithQuery(array_merge($qs,['page'=>$p])) }}" class="flex h-8 w-7 items-center justify-center rounded-[7px] border {{ $p===$page?'border-[#1769d2] bg-[#1769d2] text-white':'border-[#d7e0ec] bg-white text-[#071d43]' }} font-extrabold">{{ $p }}</a>@endfor<a href="{{ $page<$pages ? request()->fullUrlWithQuery(array_merge($qs,['page'=>$page+1])) : '#' }}" class="flex h-8 w-7 items-center justify-center rounded-[7px] border border-[#d7e0ec] {{ $page>=$pages?'opacity-40':'' }}">›</a></div></div>
          </section>
          <div class="mt-[230px] text-center text-[22px] font-extrabold tracking-tight"><span class="text-red-500">KRAKATAU</span> <span class="text-sky-600">POSCO</span></div>
        </div>
      </div>
    </main>
  </div>
  <style>
    .dark .role-access-page{background:#07182d}
    .dark .role-access-card{background:#0d213b;border-color:#29405f}
    .dark .role-page-title{color:#fff}
    .dark .role-page-subtitle{color:#8ea5c5}
    .dark table tbody{color:#c8d7eb}
    .dark input,.dark select{background:#0d213b;border-color:#29405f;color:#e8f0fb}
  </style>
  <script>document.addEventListener('DOMContentLoaded',()=>{ if(window.lucide) lucide.createIcons(); });</script>
</body>
</html>
