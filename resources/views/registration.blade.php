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
        <a class="nav-item active" href="{{ route('registration.create') }}"><i data-lucide="file-plus-2"></i><span>KR Barang Masuk</span></a>
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
        <div class="mx-auto max-w-[1180px]">
          <div class="mb-5 flex items-start justify-between gap-4">
            <div><h1 class="role-page-title text-[24px] font-extrabold text-[#071d43]">Form Registrasi</h1><p class="role-page-subtitle mt-1 text-[12px] text-[#7c90b1]">Input KR Barang Masuk secara bertahap untuk mencegah kesalahan data.</p></div>
            <a href="#requestItems" class="inline-flex h-[42px] items-center gap-2 rounded-[8px] border border-[#d6e0ed] bg-white px-4 text-[11px] font-extrabold text-[#071d43]"><i data-lucide="clipboard-list" class="h-5 w-5"></i>Request / Pending @if($pendingCount)<span class="rounded-full bg-orange-100 px-2 py-0.5 text-orange-600">{{ $pendingCount }}</span>@endif</a>
          </div>
          @if(session('success'))<div class="mb-4 rounded-[9px] border border-emerald-200 bg-emerald-50 p-3 text-[11px] font-bold text-emerald-700">{{ session('success') }}</div>@endif
          @if($errors->any())<div class="mb-4 rounded-[9px] border border-red-200 bg-red-50 p-3 text-[11px] text-red-700">{{ $errors->first() }}</div>@endif
          <form method="POST" action="{{ route('registration.store') }}" class="role-access-card rounded-[14px] border border-[#dce5f0] bg-white p-5 shadow-sm" id="registrationForm">@csrf
            <div class="grid grid-cols-1 gap-x-4 gap-y-4 md:grid-cols-2">
              <label class="reg-label">Kategori <b>*</b><select name="category" class="form-control reg-control" required>@foreach($categories as $v)<option value="{{ $v }}" @selected(old('category','REGULER')===$v)>{{ $v }}</option>@endforeach</select></label>
              <label class="reg-label">Nama Perusahaan <b>*</b><div class="reg-with-add"><input id="company" name="company" value="{{ old('company') }}" placeholder="Cari perusahaan" class="form-control reg-control" required><button type="button" class="reg-add" data-target="company" data-label="Perusahaan">Add</button></div></label>
              <label class="reg-label">Kendaraan <b>*</b><div class="reg-with-add"><input id="vehicle" name="vehicle" value="{{ old('vehicle') }}" placeholder="Cari No. Polisi" class="form-control reg-control" required><button type="button" class="reg-add" data-target="vehicle" data-label="Kendaraan">Add</button></div></label>
              <label class="reg-label">Jenis Kendaraan <b>*</b><div class="reg-with-add"><select id="vehicle_type" name="vehicle_type" class="form-control reg-control" required><option value="">Pilih jenis kendaraan</option>@foreach($vehicleTypes as $v)<option>{{ $v }}</option>@endforeach</select><button type="button" class="reg-add" data-target="vehicle_type" data-label="Jenis Kendaraan">Add</button></div></label>
              <label class="reg-label">Driver <b>*</b><div class="reg-with-add"><input id="driver" name="driver" value="{{ old('driver') }}" placeholder="Cari driver" class="form-control reg-control" required><button type="button" class="reg-add" data-target="driver" data-label="Driver">Add</button></div></label>
              <label class="reg-label">Jenis Barang <b>*</b><div class="reg-with-add"><select id="goods_type" name="goods_type" class="form-control reg-control" required>@foreach($goodsTypes as $v)<option>{{ $v }}</option>@endforeach</select><button type="button" class="reg-add" data-target="goods_type" data-label="Jenis Barang">Add</button></div></label>
            </div>
            <div class="my-5 border-t border-[#e6ecf4]"></div>
            <div class="mb-3 flex items-end justify-between"><div><h2 class="text-[14px] font-extrabold text-[#071d43]">Daftar Item</h2><p class="mt-1 text-[11px] text-[#7c90b1]">Tambahkan material yang diajukan pada request ini.</p></div><button id="addItem" type="button" class="inline-flex h-[42px] items-center gap-2 rounded-[8px] bg-[#246edb] px-4 text-[11px] font-extrabold text-white"><i data-lucide="plus" class="h-5 w-5"></i>Tambah Item</button></div>
            <div id="itemRows" class="space-y-2"></div>
            <div class="my-5 border-t border-[#e6ecf4]"></div>
            <div id="requestItems"><h2 class="text-[14px] font-extrabold text-[#071d43]">Request Item <span class="rounded-full bg-orange-100 px-2 py-1 text-[10px] text-orange-600">{{ $pendingCount }}</span></h2><p class="mt-1 text-[11px] text-[#7c90b1]">Menunggu persetujuan Super Admin</p>
              <div class="mt-3 overflow-x-auto"><table class="w-full min-w-[860px] text-left text-[10px]"><thead class="bg-[#f6f8fb] text-[#536a8b]"><tr><th class="p-3">NO.</th><th>NAMA BARANG</th><th>JENIS BARANG</th><th>JUMLAH</th><th>SATUAN</th><th>SUMBER/NO. REQUEST</th><th>PENGAJU</th><th>TANGGAL</th><th>STATUS</th><th>AKSI</th></tr></thead><tbody id="requestItemBody"><tr id="emptyRequestItem" class="border-b border-[#edf1f6]"><td colspan="10" class="p-4 text-center text-[#647b9d]">Belum ada request item</td></tr></tbody></table></div>
            </div>
            <div class="my-5 border-t border-[#e6ecf4]"></div>
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
              <label class="reg-label">Asal <b>*</b><div class="reg-with-add"><input id="origin" name="origin" value="{{ old('origin','KP') }}" class="form-control reg-control" required><button type="button" class="reg-add" data-target="origin" data-label="Asal">Add</button></div></label>
              <label class="reg-label">Tujuan <b>*</b><div class="reg-with-add"><input id="destination" name="destination" value="{{ old('destination','KP') }}" class="form-control reg-control" required><button type="button" class="reg-add" data-target="destination" data-label="Tujuan">Add</button></div></label>
            </div>
            <div class="mt-4 flex items-center gap-3 rounded-[8px] border border-[#a9cffd] bg-[#eff7ff] p-4 text-[11px] text-[#3c6d9f]"><i data-lucide="shield-check" class="h-5 w-5 text-[#1f6fd1]"></i><span><strong class="text-[#0c56a6]">Ringkasan sebelum submit:</strong> Pastikan kendaraan, driver, barang, asal, tujuan, dan gate telah sesuai master data.</span></div>
            <div class="mt-5 flex justify-end gap-3"><button name="submit_action" value="draft" type="submit" class="h-[42px] rounded-[8px] border border-[#d5dfec] px-5 text-[11px] font-extrabold text-[#071d43]">Simpan Draft</button><button name="submit_action" value="submit" type="submit" class="inline-flex h-[42px] items-center gap-2 rounded-[8px] bg-[#246edb] px-5 text-[11px] font-extrabold text-white"><i data-lucide="send" class="h-5 w-5"></i>Ajukan Registrasi</button></div>
          </form>
        </div>
      </div>
    </main>
  </div>
  <div id="masterAddModal" class="fixed inset-0 z-[100] hidden items-center justify-center bg-[#071d43]/45 px-4 backdrop-blur-[1px]" aria-hidden="true">
    <div class="master-modal w-full max-w-[510px] overflow-hidden rounded-[14px] bg-white shadow-2xl dark:bg-[#0d213b]">
      <div class="flex items-start justify-between border-b border-[#e5ebf3] px-5 py-5 dark:border-[#29405f]">
        <div><h3 id="masterModalTitle" class="text-[16px] font-extrabold text-[#071d43] dark:text-white">Tambah Data</h3><p class="mt-1 text-[11px] text-[#7487a8]">Ajukan data baru untuk persetujuan Super Admin.</p></div>
        <button id="closeMasterModal" type="button" class="flex h-10 w-10 items-center justify-center rounded-[8px] border border-[#d8e1ed] text-[#456184] dark:border-[#29405f] dark:text-[#a9bdd8]"><i data-lucide="x" class="h-5 w-5"></i></button>
      </div>
      <form method="POST" action="{{ route('registration.master-request') }}" class="p-5" id="masterRequestForm">
        @csrf
        <input type="hidden" name="master_type" id="masterType">
        <label class="reg-label"><span id="masterFieldLabel">Data</span> <b>*</b><input name="master_value" id="masterValue" class="form-control reg-control" autocomplete="off" required></label>
        <div class="mt-5 flex justify-end gap-2 border-t border-[#e5ebf3] pt-4 dark:border-[#29405f]"><button id="cancelMasterModal" type="button" class="h-[38px] rounded-[8px] border border-[#d5dfec] px-4 text-[11px] font-extrabold text-[#071d43] dark:border-[#29405f] dark:text-white">Batal</button><button type="submit" class="h-[38px] rounded-[8px] bg-[#246edb] px-4 text-[11px] font-extrabold text-white">Ajukan</button></div>
      </form>
    </div>
  </div>
  <template id="itemTemplate"><div class="item-row grid grid-cols-12 gap-2"><select name="item_name[]" class="form-control reg-control col-span-12 md:col-span-3" required><option value="" selected disabled>Nama Barang</option><option value="Coil Steel">Coil Steel</option><option value="Bahan Baku">Bahan Baku</option><option value="Scrap Besi">Scrap Besi</option></select><select name="item_type[]" class="form-control reg-control col-span-6 md:col-span-2">@foreach($goodsTypes as $v)<option>{{ $v }}</option>@endforeach</select><input name="item_qty[]" type="number" min="0.01" step="0.01" value="1" class="form-control reg-control col-span-3 md:col-span-2" required><select name="item_unit[]" class="form-control reg-control col-span-3 md:col-span-1">@foreach($units as $v)<option>{{ $v }}</option>@endforeach</select><input name="item_note[]" placeholder="Keterangan" class="form-control reg-control col-span-10 md:col-span-3"><button type="button" class="remove-item col-span-2 md:col-span-1 flex h-[38px] items-center justify-center rounded-[7px] border border-red-200 bg-red-50 text-red-600"><i data-lucide="trash-2" class="h-5 w-5"></i></button></div></template>
  <style>.reg-label{font-size:10px;font-weight:800;color:#526987}.reg-label>b{color:#ef4444}.reg-control{margin-top:8px;height:38px;width:100%;border-radius:7px;border:1px solid #d7e0ec;background:#fff;padding:0 12px;font-size:11px}.reg-with-add{display:flex;gap:8px;align-items:end}.reg-with-add .reg-control{flex:1}.reg-add{height:38px;margin-top:8px;border:1px solid #d5dfec;border-radius:7px;padding:0 11px;font-size:10px;font-weight:800;color:#246edb;background:#fff}.dark .reg-label{color:#8ea5c5}.dark .reg-control,.dark .reg-add{background:#0d213b;border-color:#2a405e;color:#e8f0fb}</style>
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const rows = document.getElementById('itemRows');
      const tpl = document.getElementById('itemTemplate');
      const requestBody = document.getElementById('requestItemBody');
      const emptyRequest = document.getElementById('emptyRequestItem');
      const pendingBadge = document.querySelector('#requestItems h2 span');
      let requestSequence = 1;

      function createInputRow(){
        if (!rows.querySelector('.item-row')) rows.append(tpl.content.cloneNode(true));
        lucide.createIcons();
      }

      function resetInputRow(row){
        const name=row.querySelector('[name="item_name[]"]');
        const type=row.querySelector('[name="item_type[]"]');
        const qty=row.querySelector('[name="item_qty[]"]');
        const unit=row.querySelector('[name="item_unit[]"]');
        const note=row.querySelector('[name="item_note[]"]');
        name.selectedIndex=0; type.selectedIndex=0; qty.value=1; unit.selectedIndex=0; note.value='';
      }

      function todayLabel(){
        return new Intl.DateTimeFormat('id-ID',{day:'2-digit',month:'short',year:'numeric'}).format(new Date());
      }

      function escapeHtml(value){
        const div=document.createElement('div'); div.textContent=value ?? ''; return div.innerHTML;
      }

      function refreshNumbers(){
        [...requestBody.querySelectorAll('tr.request-item-row')].forEach((tr,i)=>{
          tr.querySelector('.request-number').textContent=i+1;
          tr.querySelectorAll('input[data-array]').forEach(input=>{
            input.name=`request_items[${i}][${input.dataset.array}]`;
          });
        });
        const count=requestBody.querySelectorAll('tr.request-item-row').length;
        pendingBadge.textContent=count;
        if(emptyRequest) emptyRequest.classList.toggle('hidden',count>0);
      }

      function addItemToRequest(){
        const row=rows.querySelector('.item-row');
        if(!row){ createInputRow(); return; }
        const name=row.querySelector('[name="item_name[]"]');
        const type=row.querySelector('[name="item_type[]"]');
        const qty=row.querySelector('[name="item_qty[]"]');
        const unit=row.querySelector('[name="item_unit[]"]');
        const note=row.querySelector('[name="item_note[]"]');
        if(!name.value){ name.reportValidity(); return; }
        if(!qty.value || Number(qty.value)<=0){ qty.reportValidity(); return; }

        const requestNo='REQ-ITEM-'+String(requestSequence++).padStart(3,'0');
        const requester=@json($role);
        const tr=document.createElement('tr');
        tr.className='request-item-row border-b border-[#edf1f6]';
        tr.innerHTML=`
          <td class="request-number p-3"></td>
          <td class="font-bold">${escapeHtml(name.value)}</td>
          <td>${escapeHtml(type.value)}</td>
          <td>${escapeHtml(qty.value)}</td>
          <td>${escapeHtml(unit.value)}</td>
          <td>${requestNo}</td>
          <td>${escapeHtml(requester)}</td>
          <td>${todayLabel()}</td>
          <td><span class="request-status-badge rounded-full bg-orange-100 px-2 py-1 font-extrabold text-orange-600">PENDING</span></td>
          <td>
            <div class="flex items-center gap-2">
              <button type="button" class="approve-request-item flex h-7 w-7 items-center justify-center rounded-[6px] bg-blue-600 text-white hover:bg-blue-700" title="Approve item"><i data-lucide="check" class="h-4 w-4"></i></button>
              <button type="button" class="remove-request-item flex h-7 w-7 items-center justify-center rounded-[6px] border border-red-200 bg-red-50 text-red-600" title="Hapus item"><i data-lucide="x" class="h-4 w-4"></i></button>
            </div>
          </td>
          <input type="hidden" data-array="name" value="${escapeHtml(name.value)}">
          <input type="hidden" data-array="type" value="${escapeHtml(type.value)}">
          <input type="hidden" data-array="qty" value="${escapeHtml(qty.value)}">
          <input type="hidden" data-array="unit" value="${escapeHtml(unit.value)}">
          <input type="hidden" data-array="note" value="${escapeHtml(note.value)}">
          <input type="hidden" data-array="request_no" value="${requestNo}">
          <input type="hidden" data-array="status" value="Pending">`;
        requestBody.appendChild(tr);
        resetInputRow(row);
        refreshNumbers();
        lucide.createIcons();
      }

      document.getElementById('addItem').addEventListener('click', addItemToRequest);
      requestBody.addEventListener('click',e=>{
        const approve=e.target.closest('.approve-request-item');
        if(approve){
          const row=approve.closest('.request-item-row');
          const badge=row.querySelector('.request-status-badge');
          const statusInput=row.querySelector('input[data-array="status"]');
          badge.textContent='APPROVED';
          badge.className='request-status-badge rounded-full bg-blue-100 px-2 py-1 font-extrabold text-blue-700';
          if(statusInput) statusInput.value='Approved';
          approve.remove();
          return;
        }
        const b=e.target.closest('.remove-request-item');
        if(b){ b.closest('.request-item-row').remove(); refreshNumbers(); }
      });
      rows.addEventListener('click', e => {
        const b=e.target.closest('.remove-item');
        if(b) resetInputRow(b.closest('.item-row'));
      });

      const modal=document.getElementById('masterAddModal'), title=document.getElementById('masterModalTitle'), fieldLabel=document.getElementById('masterFieldLabel'), type=document.getElementById('masterType'), value=document.getElementById('masterValue');
      const placeholders={company:'Masukkan nama perusahaan',vehicle:'Masukkan nomor polisi kendaraan',vehicle_type:'Masukkan jenis kendaraan',driver:'Masukkan nama driver',goods_type:'Masukkan jenis barang',origin:'Masukkan lokasi asal',destination:'Masukkan lokasi tujuan'};
      function openModal(button){ const key=button.dataset.target, label=button.dataset.label; type.value=key; title.textContent='Tambah '+label; fieldLabel.textContent=label; value.value=''; value.placeholder=placeholders[key] || 'Masukkan data baru'; modal.classList.remove('hidden'); modal.classList.add('flex'); modal.setAttribute('aria-hidden','false'); setTimeout(()=>value.focus(),50); }
      function closeModal(){ modal.classList.add('hidden'); modal.classList.remove('flex'); modal.setAttribute('aria-hidden','true'); }
      document.querySelectorAll('.reg-add').forEach(b=>b.addEventListener('click',()=>openModal(b)));
      document.getElementById('closeMasterModal').addEventListener('click',closeModal);
      document.getElementById('cancelMasterModal').addEventListener('click',closeModal);
      modal.addEventListener('click',e=>{if(e.target===modal)closeModal()});
      document.addEventListener('keydown',e=>{if(e.key==='Escape')closeModal()});
      createInputRow(); refreshNumbers(); lucide.createIcons();
    });
  </script>
</body></html>