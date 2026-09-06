<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ $title ?? 'SIGMA — Dashboard Registrasi Material' }}</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.1/css/all.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<div class="min-h-screen">

    <!-- SIDEBAR -->
    <aside id="sidebar"
      class="sidebar fixed left-0 top-0 z-40 flex h-screen w-[186px] flex-col overflow-hidden bg-sigma-950 text-white">

      <!-- Brand -->
      <div class="brand-area flex h-[70px] items-center px-5">
        <div class="flex items-center gap-2">
          <div class="relative flex h-8 w-9 items-center justify-center">
            <div class="absolute h-4 w-8 -rotate-12 rounded-full border-[5px] border-orange-500"></div>
            <div class="absolute h-4 w-8 rotate-12 rounded-full border-[5px] border-cyan-400"></div>
          </div>
          <div class="brand-copy">
            <div class="text-[18px] font-extrabold tracking-[.18em] leading-none">SIGMA</div>
            <div class="mt-1 text-[5px] font-semibold tracking-[.17em] text-slate-300">SISTEM REGISTRASI MATERIAL</div>
          </div>
        </div>
      </div>

      <div class="sidebar-scroll flex-1 overflow-y-auto px-3 pb-4">
        <nav class="space-y-1">

          <a href="{{ route('dashboard') }}" class="sidebar-item active flex items-center gap-3 rounded-md px-3 py-2.5 text-[12px] font-semibold">
            <i class="sidebar-icon fa-icon fa-solid fa-house text-[13px]" aria-hidden="true"></i><span class="sidebar-label">Dashboard</span>
          </a>

          <div class="sidebar-section pt-5 pb-1 px-2 text-[9px] font-bold tracking-wide text-slate-400">REGISTRASI</div>

          <a href="#" class="sidebar-item flex items-center justify-between rounded-md px-3 py-2 text-[11px] text-slate-200">
            <span class="flex items-center gap-3"><i class="sidebar-icon fa-icon fa-solid fa-truck-arrow-right" aria-hidden="true"></i><span class="sidebar-label">KR Barang Masuk</span></span><i class="sidebar-arrow fa-solid fa-chevron-right text-[9px]" aria-hidden="true"></i>
          </a>
          <a href="#" class="sidebar-item flex items-center justify-between rounded-md px-3 py-2 text-[11px] text-slate-200">
            <span class="flex items-center gap-3"><i class="sidebar-icon fa-icon fa-solid fa-truck-arrow-right" aria-hidden="true"></i><span class="sidebar-label">KR Barang Keluar</span></span><i class="sidebar-arrow fa-solid fa-chevron-right text-[9px]" aria-hidden="true"></i>
          </a>

          <div class="sidebar-section pt-4 pb-1 px-2 text-[9px] font-bold tracking-wide text-slate-400">DATA KENDARAAN</div>

          <a href="#" class="sidebar-item flex items-center gap-3 rounded-md px-3 py-2 text-[11px] text-slate-200"><i class="sidebar-icon fa-icon fa-solid fa-car" aria-hidden="true"></i><span class="sidebar-label">All Vehicle</span></a>
          <a href="#" class="sidebar-item flex items-center gap-3 rounded-md px-3 py-2 text-[11px] text-slate-200"><i class="sidebar-icon fa-icon fa-solid fa-calendar-day" aria-hidden="true"></i><span class="sidebar-label">Sigma Today</span></a>
          <a href="#" class="sidebar-item flex items-center gap-3 rounded-md px-3 py-2 text-[11px] text-slate-200"><i class="sidebar-icon fa-icon fa-solid fa-route" aria-hidden="true"></i><span class="sidebar-label">Movement (Masih di Dalam)</span></a>

          <div class="sidebar-section pt-4 pb-1 px-2 text-[9px] font-bold tracking-wide text-slate-400">REPORT</div>

          <a href="#" class="sidebar-item flex items-center gap-3 rounded-md px-3 py-2 text-[11px] text-slate-200"><i class="sidebar-icon fa-icon fa-solid fa-file-lines" aria-hidden="true"></i><span class="sidebar-label">Laporan Harian</span></a>
          <a href="#" class="sidebar-item flex items-center gap-3 rounded-md px-3 py-2 text-[11px] text-slate-200"><i class="sidebar-icon fa-icon fa-solid fa-chart-column" aria-hidden="true"></i><span class="sidebar-label">Laporan Bulanan</span></a>

          <button class="sidebar-section mt-4 flex w-full items-center justify-between px-2 py-1 text-left text-[9px] font-bold tracking-wide text-slate-400">
            <span>MASTER DATA &amp; APPROVAL</span><span>⌄</span>
          </button>

          <a href="#" class="sidebar-item flex items-center gap-3 rounded-md px-3 py-2 text-[11px] text-slate-200"><i class="sidebar-icon fa-icon fa-solid fa-table-columns" aria-hidden="true"></i><span class="sidebar-label">Kolom Input Data</span></a>
          <a href="#" class="sidebar-item flex items-center gap-3 rounded-md px-3 py-2 text-[11px] text-slate-200"><i class="sidebar-icon fa-icon fa-solid fa-user-slash" aria-hidden="true"></i><span class="sidebar-label">Suspend Driver</span></a>
          <a href="#" class="sidebar-item flex items-center gap-3 rounded-md px-3 py-2 text-[11px] text-slate-200"><i class="sidebar-icon fa-icon fa-solid fa-user-shield" aria-hidden="true"></i><span class="sidebar-label">Blacklist Driver</span></a>
          <a href="#" class="sidebar-item flex items-center gap-3 rounded-md px-3 py-2 text-[11px] text-slate-200"><i class="sidebar-icon fa-icon fa-solid fa-users-gear" aria-hidden="true"></i><span class="sidebar-label">User Manajemen</span></a>
          <a href="#" class="sidebar-item flex items-center gap-3 rounded-md px-3 py-2 text-[11px] text-slate-200"><i class="sidebar-icon fa-icon fa-solid fa-shield-halved" aria-hidden="true"></i><span class="sidebar-label">Role/Access Manajemen</span></a>
        </nav>
      </div>

      <div class="border-t border-slate-800 px-4 py-4">
        <button id="collapseBtn" class="collapse-button flex w-full items-center gap-2 text-[11px] font-semibold text-slate-300 hover:text-white" title="Collapse sidebar">
          <span id="collapseIcon" class="flex h-5 w-5 shrink-0 items-center justify-center rounded-full border border-slate-500"><i class="fa-solid fa-chevron-left text-[8px]" aria-hidden="true"></i></span>
          <span class="collapse-text">Collapse</span>
        </button>
      </div>
    </aside>

    <!-- MAIN -->
    <main class="main ml-[186px] min-h-screen">

      <!-- TOPBAR -->
      <header class="flex h-[55px] items-center justify-between border-b border-slate-200 bg-white px-5">
        <div class="flex items-center gap-4">
          <button id="menuBtn" class="flex h-8 w-8 items-center justify-center rounded-md text-sm text-slate-500 hover:bg-slate-100 hover:text-sigma-700" aria-label="Toggle navigation sidebar" title="Toggle navigation sidebar"><i class="fa-solid fa-bars" aria-hidden="true"></i></button>
          <h1 class="text-[14px] font-bold text-slate-700">Dashboard</h1>
        </div>

        <div class="flex items-center gap-5">
          <button class="relative text-slate-600" aria-label="Notifikasi">
            <i class="fa-solid fa-bell" aria-hidden="true"></i>
            <span class="absolute -right-2 -top-2 flex h-4 w-4 items-center justify-center rounded-full bg-red-500 text-[8px] font-bold text-white">5</span>
          </button>
          <button class="flex h-6 w-6 items-center justify-center rounded-full border border-slate-300 text-[10px] font-bold text-slate-500 dark:border-slate-600 dark:text-slate-300" aria-label="Bantuan" title="Bantuan"><i class="fa-solid fa-question" aria-hidden="true"></i></button>

          <!-- Theme Toggle -->
          <button id="themeToggle" class="theme-toggle" type="button" aria-label="Ubah tema" title="Ubah tema">
            <span class="toggle-moon"><i class="fa-solid fa-moon"></i></span>
            <span class="toggle-sun"><i class="fa-solid fa-sun"></i></span>
            <span class="toggle-thumb"><i id="themeThumbIcon" class="fa-solid fa-sun"></i></span>
          </button>

          <!-- Profile Menu -->
          <div id="profileMenuWrap" class="profile-menu-wrap">
            <button id="profileTrigger" class="profile-trigger" type="button" aria-label="Buka menu akun" aria-haspopup="true" aria-expanded="false">
              <span class="profile-avatar"><i class="fa-solid fa-user" aria-hidden="true"></i></span>
              <i class="profile-chevron fa-solid fa-chevron-down" aria-hidden="true"></i>
            </button>

            <div id="profileDropdown" class="profile-dropdown" role="menu" aria-label="Menu akun">
              <div class="profile-menu-header">
                <div class="profile-menu-title">Menu Akun</div>
                <div class="profile-menu-subtitle">Kelola akun SIGMA</div>
              </div>

              <button class="profile-menu-item" type="button" role="menuitem" aria-label="Profile">
                <i class="fa-solid fa-user" aria-hidden="true"></i>
                <span>Profile</span>
              </button>

              <form
                method="POST"
                action="{{ route('logout') }}"
                class="profile-menu-form">
                  @csrf
                  <button
                    class="profile-menu-item logout"
                    type="submit"
                    role="menuitem"
                    aria-label="Logout">
                      <i class="fa-solid fa-right-from-bracket" aria-hidden="true"></i>
                      <span>Logout</span>
                  </button>
              </form>
            </div>
          </div>
        </div>
      </header>

      <div class="dashboard-content flex min-h-[calc(100vh-55px)] flex-col px-5 pb-5 pt-4">

        <!-- WELCOME -->
        <div class="mb-4">
          <h2 class="text-[16px] font-extrabold text-slate-800">Selamat datang,</h2>
          <div class="mt-0.5 text-[10px] text-slate-500 dark:text-slate-400">
            Selasa, 01 September 2026 <span class="mx-2">•</span> 08:45 WIB
          </div>
        </div>

        <!-- METRICS -->
        <section class="metric-grid mb-4 grid grid-cols-5 gap-3">

          <div class="metric-card glass-border rounded-lg bg-white p-3 shadow-card">
            <div class="flex items-center gap-3 min-w-0">
              <div class="metric-icon shrink-0 bg-blue-50 text-blue-600"><i class="fa-solid fa-chart-line" aria-hidden="true"></i></div>
              <div class="metric-copy flex min-w-0 items-center gap-2">
                <div class="metric-number shrink-0 text-[19px] font-extrabold leading-none text-slate-800">245</div>
                <div class="metric-description min-w-0 max-w-[92px] text-[8px] font-extrabold uppercase leading-3 text-slate-800">TOTAL TRANSAKSI<br>Hari ini</div>
              </div>
            </div>
            <div class="mt-4 flex items-center gap-1 text-[9px] font-semibold text-emerald-500"><i class="fa-solid fa-arrow-trend-up"></i> <span>12%</span><span class="font-normal text-slate-400">dari kemarin</span></div>
          </div>

          <div class="metric-card glass-border rounded-lg bg-white p-3 shadow-card">
            <div class="flex items-center gap-3 min-w-0">
              <div class="metric-icon shrink-0 bg-emerald-50 text-emerald-600"><i class="fa-solid fa-truck-arrow-right" aria-hidden="true"></i></div>
              <div class="metric-copy flex min-w-0 items-center gap-2">
                <div class="metric-number shrink-0 text-[19px] font-extrabold leading-none text-slate-800">128</div>
                <div class="metric-description min-w-0 max-w-[92px] text-[8px] font-extrabold uppercase leading-3 text-slate-800">BARANG MASUK<br>Hari ini</div>
              </div>
            </div>
            <div class="mt-4 flex items-center gap-1 text-[9px] font-semibold text-emerald-500"><i class="fa-solid fa-arrow-trend-up"></i> <span>8%</span><span class="font-normal text-slate-400">dari kemarin</span></div>
          </div>

          <div class="metric-card glass-border rounded-lg bg-white p-3 shadow-card">
            <div class="flex items-center gap-3 min-w-0">
              <div class="metric-icon shrink-0 bg-orange-50 text-orange-500"><i class="fa-solid fa-truck" aria-hidden="true"></i></div>
              <div class="metric-copy flex min-w-0 items-center gap-2">
                <div class="metric-number shrink-0 text-[19px] font-extrabold leading-none text-slate-800">103</div>
                <div class="metric-description min-w-0 max-w-[92px] text-[8px] font-extrabold uppercase leading-3 text-slate-800">BARANG KELUAR<br>Hari ini</div>
              </div>
            </div>
            <div class="mt-4 flex items-center gap-1 text-[9px] font-semibold text-orange-500"><i class="fa-solid fa-arrow-trend-up"></i> <span>15%</span><span class="font-normal text-slate-400">dari kemarin</span></div>
          </div>

          <div class="metric-card glass-border rounded-lg bg-white p-3 shadow-card">
            <div class="flex items-center gap-3 min-w-0">
              <div class="metric-icon shrink-0 bg-red-50 text-red-500"><i class="fa-solid fa-truck-ramp-box" aria-hidden="true"></i></div>
              <div class="metric-copy flex min-w-0 items-center gap-2">
                <div class="metric-number shrink-0 text-[19px] font-extrabold leading-none text-slate-800">14</div>
                <div class="metric-description min-w-0 max-w-[92px] text-[8px] font-extrabold uppercase leading-3 text-slate-800">MASIH DI DALAM<br>(MOVEMENT)</div>
              </div>
            </div>
            <div class="mt-4 flex items-center gap-1 text-[9px] font-semibold text-red-500"><i class="fa-solid fa-arrow-trend-up"></i> <span>7%</span><span class="font-normal text-slate-400">dari kemarin</span></div>
          </div>

          <div class="metric-card glass-border rounded-lg bg-white p-3 shadow-card">
            <div class="flex items-center gap-3 min-w-0">
              <div class="metric-icon shrink-0 bg-violet-50 text-violet-500"><i class="fa-solid fa-clock" aria-hidden="true"></i></div>
              <div class="metric-copy flex min-w-0 items-center gap-2">
                <div class="metric-number shrink-0 text-[19px] font-extrabold leading-none text-slate-800">5</div>
                <div class="metric-description min-w-0 max-w-[92px] text-[8px] font-extrabold uppercase leading-3 text-slate-800">REQUEST PENDING<br>Menunggu kirim</div>
              </div>
            </div>
            <div class="mt-4 text-[9px] font-bold text-violet-600">Lihat detail <i class="fa-solid fa-arrow-right ml-1"></i></div>
          </div>
        </section>

        <!-- TABLES -->
        <section class="content-grid grid grid-cols-[1.03fr_.97fr] gap-3">

          <!-- Aktivitas -->
          <div class="history-card glass-border overflow-hidden rounded-lg bg-white shadow-card">
            <div class="flex items-center justify-between border-b border-slate-100 px-4 py-3">
              <h3 class="text-[12px] font-extrabold text-slate-700">Aktivitas Terbaru</h3>
              <a href="{{ route('dashboard') }}" class="text-[9px] font-bold text-blue-500">Lihat semua <i class="fa-solid fa-arrow-right ml-1"></i></a>
            </div>

            <div class="history-table-wrap overflow-x-auto">
              <table class="w-full min-w-[570px] text-left">
                <thead class="bg-slate-50/70 text-[8px] font-bold text-slate-500">
                  <tr>
                    <th class="px-3 py-2">No.</th>
                    <th class="px-2 py-2">KR</th>
                    <th class="px-2 py-2">Kendaraan</th>
                    <th class="px-2 py-2">Aktivitas</th>
                    <th class="px-2 py-2">Waktu</th>
                    <th class="px-2 py-2">Gate</th>
                    <th class="px-2 py-2">Status</th>
                  </tr>
                </thead>
                <tbody id="activityBody" class="text-[9px] text-slate-600">
                  <tr class="table-row border-t border-slate-50">
                    <td class="px-3 py-2"><span class="mr-2 inline-block h-2 w-2 rounded-full bg-emerald-500"></span></td>
                    <td class="font-bold text-blue-600">KR-00125</td><td>B 1234 XX</td><td class="text-emerald-500"><i class="fa-solid fa-arrow-down mr-1"></i>Masuk</td><td>08:10</td><td>G2</td><td><span class="status status-completed">COMPLETED</span></td>
                  </tr>
                  <tr class="table-row border-t border-slate-50">
                    <td class="px-3 py-2"><span class="mr-2 inline-block h-2 w-2 rounded-full bg-orange-500"></span></td>
                    <td class="font-bold text-blue-600">KR-00124</td><td>A 8899 YY</td><td class="text-orange-500"><i class="fa-solid fa-arrow-up mr-1"></i>Keluar</td><td>08:22</td><td>G2</td><td><span class="status status-completed">COMPLETED</span></td>
                  </tr>
                  <tr class="table-row border-t border-slate-50">
                    <td class="px-3 py-2"><span class="mr-2 inline-block h-2 w-2 rounded-full bg-emerald-500"></span></td>
                    <td class="font-bold text-blue-600">KR-00123</td><td>B 7788 ZZ</td><td class="text-emerald-500"><i class="fa-solid fa-arrow-down mr-1"></i>Masuk</td><td>08:35</td><td>G2</td><td><span class="status status-completed">COMPLETED</span></td>
                  </tr>
                  <tr class="table-row border-t border-slate-50">
                    <td class="px-3 py-2"><span class="mr-2 inline-block h-2 w-2 rounded-full bg-orange-500"></span></td>
                    <td class="font-bold text-blue-600">KR-00122</td><td>B 5678 QQ</td><td class="text-orange-500"><i class="fa-solid fa-arrow-up mr-1"></i>Keluar</td><td>08:45</td><td>G2</td><td><span class="status status-completed">COMPLETED</span></td>
                  </tr>
                  <tr class="table-row border-t border-slate-50">
                    <td class="px-3 py-2"><span class="mr-2 inline-block h-2 w-2 rounded-full bg-blue-600"></span></td>
                    <td class="font-bold text-blue-600">KR-00121</td><td>L 9012 MM</td><td class="text-emerald-500"><i class="fa-solid fa-arrow-down mr-1"></i>Masuk</td><td>08:50</td><td>G1</td><td><span class="status status-pending">PENDING</span></td>
                  </tr>
                  <tr class="table-row border-t border-slate-50">
                    <td class="px-3 py-2"><span class="mr-2 inline-block h-2 w-2 rounded-full bg-blue-600"></span></td>
                    <td class="font-bold text-blue-600">KR-00120</td><td>B 3456 NN</td><td class="text-emerald-500"><i class="fa-solid fa-arrow-down mr-1"></i>Masuk</td><td>08:55</td><td>G1</td><td><span class="status status-pending">PENDING</span></td>
                  </tr>
                  <tr class="table-row border-t border-slate-50">
                    <td class="px-3 py-2"><span class="mr-2 inline-block h-2 w-2 rounded-full bg-orange-500"></span></td>
                    <td class="font-bold text-blue-600">KR-00119</td><td>A 2233 KK</td><td class="text-orange-500"><i class="fa-solid fa-arrow-up mr-1"></i>Keluar</td><td>09:02</td><td>G2</td><td><span class="status status-completed">COMPLETED</span></td>
                  </tr>
                  <tr class="table-row border-t border-slate-50">
                    <td class="px-3 py-2"><span class="mr-2 inline-block h-2 w-2 rounded-full bg-blue-600"></span></td>
                    <td class="font-bold text-blue-600">KR-00118</td><td>D 6677 LL</td><td class="text-emerald-500"><i class="fa-solid fa-arrow-down mr-1"></i>Masuk</td><td>09:10</td><td>G2</td><td><span class="status status-completed">COMPLETED</span></td>
                  </tr>
                  <tr class="table-row border-t border-slate-50">
                    <td class="px-3 py-2"><span class="mr-2 inline-block h-2 w-2 rounded-full bg-emerald-500"></span></td>
                    <td class="font-bold text-blue-600">KR-00117</td><td>B 8890 PP</td><td class="text-emerald-500"><i class="fa-solid fa-arrow-down mr-1"></i>Masuk</td><td>09:18</td><td>G1</td><td><span class="status status-completed">COMPLETED</span></td>
                  </tr>
                  <tr class="table-row border-t border-slate-50">
                    <td class="px-3 py-2"><span class="mr-2 inline-block h-2 w-2 rounded-full bg-orange-500"></span></td>
                    <td class="font-bold text-blue-600">KR-00116</td><td>L 5566 RR</td><td class="text-orange-500"><i class="fa-solid fa-arrow-up mr-1"></i>Keluar</td><td>09:25</td><td>G2</td><td><span class="status status-completed">COMPLETED</span></td>
                  </tr>
                  <tr class="table-row border-t border-slate-50">
                    <td class="px-3 py-2"><span class="mr-2 inline-block h-2 w-2 rounded-full bg-emerald-500"></span></td>
                    <td class="font-bold text-blue-600">KR-00115</td><td>B 9012 SS</td><td class="text-emerald-500"><i class="fa-solid fa-arrow-down mr-1"></i>Masuk</td><td>09:33</td><td>G2</td><td><span class="status status-completed">COMPLETED</span></td>
                  </tr>
                  <tr class="table-row border-t border-slate-50">
                    <td class="px-3 py-2"><span class="mr-2 inline-block h-2 w-2 rounded-full bg-orange-500"></span></td>
                    <td class="font-bold text-blue-600">KR-00114</td><td>D 3344 TT</td><td class="text-orange-500"><i class="fa-solid fa-arrow-up mr-1"></i>Keluar</td><td>09:40</td><td>G1</td><td><span class="status status-completed">COMPLETED</span></td>
                  </tr>
                  <tr class="table-row border-t border-slate-50">
                    <td class="px-3 py-2"><span class="mr-2 inline-block h-2 w-2 rounded-full bg-blue-600"></span></td>
                    <td class="font-bold text-blue-600">KR-00113</td><td>A 1122 UU</td><td class="text-emerald-500"><i class="fa-solid fa-arrow-down mr-1"></i>Masuk</td><td>09:42</td><td>G1</td><td><span class="status status-pending">PENDING</span></td>
                  </tr>
                  <tr class="table-row border-t border-slate-50">
                    <td class="px-3 py-2"><span class="mr-2 inline-block h-2 w-2 rounded-full bg-orange-500"></span></td>
                    <td class="font-bold text-blue-600">KR-00112</td><td>B 7781 VV</td><td class="text-orange-500"><i class="fa-solid fa-arrow-up mr-1"></i>Keluar</td><td>09:50</td><td>G2</td><td><span class="status status-completed">COMPLETED</span></td>
                  </tr>
                  <tr class="table-row border-t border-slate-50">
                    <td class="px-3 py-2"><span class="mr-2 inline-block h-2 w-2 rounded-full bg-emerald-500"></span></td>
                    <td class="font-bold text-blue-600">KR-00111</td><td>D 4455 WW</td><td class="text-emerald-500"><i class="fa-solid fa-arrow-down mr-1"></i>Masuk</td><td>09:58</td><td>G1</td><td><span class="status status-completed">COMPLETED</span></td>
                  </tr>
                </tbody>
              </table>
            </div>

            <div id="activityPagination" class="pagination-bar flex items-center justify-between gap-3 border-t border-slate-100 px-4 py-2.5">
              <div id="activityPageInfo" class="pagination-info text-[8px] font-semibold text-slate-400"></div>
              <div id="activityPageButtons" class="pagination-buttons flex items-center gap-1"></div>
            </div>
          </div>

          <!-- Movement -->
          <div class="history-card glass-border overflow-hidden rounded-lg bg-white shadow-card">
            <div class="flex items-center justify-between border-b border-slate-100 px-4 py-3">
              <h3 class="text-[12px] font-extrabold text-slate-700">Kendaraan Masih di Dalam (Movement)</h3>
              <a href="{{ route('dashboard') }}" class="text-[9px] font-bold text-blue-500">Lihat semua <i class="fa-solid fa-arrow-right ml-1"></i></a>
            </div>

            <div class="history-table-wrap overflow-x-auto">
              <table class="w-full min-w-[560px] text-left">
                <thead class="bg-slate-50/70 text-[8px] font-bold text-slate-500">
                  <tr>
                    <th class="px-4 py-2">No. KR</th><th class="px-2 py-2">Kendaraan</th><th class="px-2 py-2">Driver</th><th class="px-2 py-2">Lokasi Terakhir</th><th class="px-2 py-2">Sejak</th><th class="px-2 py-2">Status</th>
                  </tr>
                </thead>
                <tbody id="movementBody" class="text-[9px] text-slate-600">
                  <tr class="border-t border-slate-50"><td class="px-4 py-2 font-bold text-blue-600">KR-00117</td><td>B 7788 PP</td><td>Hendra</td><td>Area Jetty</td><td>07:45</td><td><span class="status status-jetty">AT JETTY</span></td></tr>
                  <tr class="border-t border-slate-50"><td class="px-4 py-2 font-bold text-blue-600">KR-00116</td><td>L 5566 RR</td><td>Fajar</td><td>Gate 4</td><td>08:10</td><td><span class="status status-inside">INSIDE</span></td></tr>
                  <tr class="border-t border-slate-50"><td class="px-4 py-2 font-bold text-blue-600">KR-00115</td><td>B 9012 SS</td><td>Agus</td><td>Area Jetty</td><td>08:20</td><td><span class="status status-jetty">AT JETTY</span></td></tr>
                  <tr class="border-t border-slate-50"><td class="px-4 py-2 font-bold text-blue-600">KR-00114</td><td>D 3344 TT</td><td>Rudi</td><td>Gate 4</td><td>08:35</td><td><span class="status status-inside">INSIDE</span></td></tr>
                  <tr class="border-t border-slate-50"><td class="px-4 py-2 font-bold text-blue-600">KR-00113</td><td>A 1122 UU</td><td>Ivan</td><td>Area Jetty</td><td>08:42</td><td><span class="status status-jetty">AT JETTY</span></td></tr>
                  <tr class="border-t border-slate-50"><td class="px-4 py-2 font-bold text-blue-600">KR-00112</td><td>B 7781 VV</td><td>Budi</td><td>Gate 3</td><td>08:50</td><td><span class="status status-inside">INSIDE</span></td></tr>
                  <tr class="border-t border-slate-50"><td class="px-4 py-2 font-bold text-blue-600">KR-00110</td><td>L 2233 GG</td><td>Doni</td><td>Area Jetty</td><td>09:05</td><td><span class="status status-jetty">AT JETTY</span></td></tr>
                  <tr class="border-t border-slate-50"><td class="px-4 py-2 font-bold text-blue-600">KR-00109</td><td>D 6676 HH</td><td>Yanto</td><td>Gate 2</td><td>09:12</td><td><span class="status status-inside">INSIDE</span></td></tr>
                  <tr class="border-t border-slate-50"><td class="px-4 py-2 font-bold text-blue-600">KR-00108</td><td>B 9900 JJ</td><td>Andre</td><td>Area Jetty</td><td>09:18</td><td><span class="status status-jetty">AT JETTY</span></td></tr>
                  <tr class="border-t border-slate-50"><td class="px-4 py-2 font-bold text-blue-600">KR-00107</td><td>L 2255 KK</td><td>Ridwan</td><td>Gate 4</td><td>09:20</td><td><span class="status status-inside">INSIDE</span></td></tr>
                </tbody>
              </table>
            </div>

            <div id="movementPagination" class="pagination-bar flex items-center justify-between gap-3 border-t border-slate-100 px-4 py-2.5">
              <div id="movementPageInfo" class="pagination-info text-[8px] font-semibold text-slate-400"></div>
              <div id="movementPageButtons" class="pagination-buttons flex items-center gap-1"></div>
            </div>

            <div class="flex items-center justify-between border-t border-slate-100 px-4 py-3">
              <div class="flex items-center gap-3">
                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-50 text-blue-600"><i class="fa-solid fa-chart-line" aria-hidden="true"></i></div>
                <div>
                  <div class="text-[9px] font-semibold text-slate-500">Total Kendaraan Masih di Dalam</div>
                  <div class="text-[14px] font-extrabold text-slate-700">14 Kendaraan</div>
                </div>
              </div>
              <button class="rounded-md bg-blue-700 px-4 py-2 text-[9px] font-bold text-white shadow-sm hover:bg-blue-800">Lihat Movement <i class="fa-solid fa-arrow-right ml-1"></i></button>
            </div>
          </div>
        </section>

        <!-- QUICK ACCESS -->
        <section class="mt-auto pt-4">
          <h3 class="mb-2 text-[12px] font-extrabold text-slate-700">Akses Cepat</h3>
          <div class="quick-grid grid grid-cols-7 gap-3">
            <a href="#" class="quick-card glass-border flex items-center gap-2 rounded-lg bg-white px-3 shadow-card hover:-translate-y-0.5 hover:shadow-soft transition">
              <span class="quick-icon bg-blue-50 text-blue-600"><i class="fa-solid fa-file-circle-plus" aria-hidden="true"></i></span>
              <span class="text-[9px] font-bold text-slate-600">Input<br>KR Masuk</span>
            </a>
            <a href="#" class="quick-card glass-border flex items-center gap-2 rounded-lg bg-white px-3 shadow-card hover:-translate-y-0.5 hover:shadow-soft transition">
              <span class="quick-icon bg-orange-50 text-orange-500"><i class="fa-solid fa-file-export" aria-hidden="true"></i></span>
              <span class="text-[9px] font-bold text-slate-600">Input<br>KR Keluar</span>
            </a>
            <a href="#" class="quick-card glass-border flex items-center gap-2 rounded-lg bg-white px-3 shadow-card hover:-translate-y-0.5 hover:shadow-soft transition">
              <span class="quick-icon bg-emerald-50 text-emerald-600"><i class="fa-solid fa-calendar-day" aria-hidden="true"></i></span>
              <span class="text-[9px] font-bold text-slate-600">Sigma Today</span>
            </a>
            <a href="#" class="quick-card glass-border flex items-center gap-2 rounded-lg bg-white px-3 shadow-card hover:-translate-y-0.5 hover:shadow-soft transition">
              <span class="quick-icon bg-blue-50 text-blue-600"><i class="fa-solid fa-car-side" aria-hidden="true"></i></span>
              <span class="text-[9px] font-bold text-slate-600">Movement<br>(Masih di Dalam)</span>
            </a>
            <a href="#" class="quick-card glass-border flex items-center gap-2 rounded-lg bg-white px-3 shadow-card hover:-translate-y-0.5 hover:shadow-soft transition">
              <span class="quick-icon bg-violet-50 text-violet-600"><i class="fa-solid fa-file-lines" aria-hidden="true"></i></span>
              <span class="text-[9px] font-bold text-slate-600">Laporan<br>Harian</span>
            </a>
            <a href="#" class="quick-card glass-border flex items-center gap-2 rounded-lg bg-white px-3 shadow-card hover:-translate-y-0.5 hover:shadow-soft transition">
              <span class="quick-icon bg-amber-50 text-amber-500"><i class="fa-solid fa-cloud-arrow-up" aria-hidden="true"></i></span>
              <span class="text-[9px] font-bold text-slate-600">Upload<br>Excel</span>
            </a>
            <a href="#" class="quick-card glass-border flex items-center gap-2 rounded-lg bg-white px-3 shadow-card hover:-translate-y-0.5 hover:shadow-soft transition">
              <span class="quick-icon bg-slate-100 text-slate-600"><i class="fa-solid fa-comments" aria-hidden="true"></i></span>
              <span class="text-[9px] font-bold text-slate-600">Chat<br>Operator</span>
            </a>
          </div>
        </section>

        <!-- FOOTER -->
        <footer class="mt-3 flex items-center justify-between border-t border-slate-200 pt-3 text-[8px] font-semibold text-slate-400">
          <span>© 2026 SIGMA – Sistem Registrasi Material. All rights reserved.</span>
          <span>v2.0.0</span>
        </footer>
      </div>
    </main>
  </div>

</body>
</html>
