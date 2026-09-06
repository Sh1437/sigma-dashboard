import './bootstrap';
import '../css/app.css';

    // =========================
    // LIGHT / DARK MODE
    // =========================
    if (!document.body.classList.contains('login-page')) {
    const themeToggle = document.getElementById('themeToggle');
    const themeThumbIcon = document.getElementById('themeThumbIcon');

    function applyTheme(theme) {
      const isDark = theme === 'dark';
      document.documentElement.classList.toggle('dark', isDark);
      document.documentElement.style.colorScheme = isDark ? 'dark' : 'light';
      themeThumbIcon.className = isDark
        ? 'fa-solid fa-moon'
        : 'fa-solid fa-sun';
      themeToggle.setAttribute(
        'aria-label',
        isDark ? 'Gunakan light mode' : 'Gunakan dark mode'
      );
      themeToggle.setAttribute(
        'title',
        isDark ? 'Gunakan light mode' : 'Gunakan dark mode'
      );
    }

    const savedTheme = localStorage.getItem('sigma-theme');
    const initialTheme = savedTheme || (
      window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light'
    );
    applyTheme(initialTheme);

    themeToggle.addEventListener('click', () => {
      const nextTheme = document.documentElement.classList.contains('dark')
        ? 'light'
        : 'dark';

      localStorage.setItem('sigma-theme', nextTheme);
      applyTheme(nextTheme);
    });

    // =========================
    // PROFILE DROPDOWN
    // =========================
    // =========================
    // PROFILE DROPDOWN
    // =========================
    const profileMenuWrap = document.getElementById('profileMenuWrap');
    const profileTrigger = document.getElementById('profileTrigger');
    const profileDropdown = document.getElementById('profileDropdown');

    function setProfileMenu(open) {
      if (!profileMenuWrap || !profileTrigger) return;

      profileMenuWrap.classList.toggle('open', open);
      profileTrigger.setAttribute('aria-expanded', open ? 'true' : 'false');

      if (profileDropdown) {
        profileDropdown.setAttribute('aria-hidden', open ? 'false' : 'true');
      }
    }

    if (profileTrigger && profileMenuWrap) {
      profileTrigger.addEventListener('click', (event) => {
        event.preventDefault();
        event.stopPropagation();

        const isOpen = profileMenuWrap.classList.contains('open');
        setProfileMenu(!isOpen);
      });

      // Jangan menutup dropdown ketika klik di dalam area menu.
      profileMenuWrap.addEventListener('click', (event) => {
        event.stopPropagation();
      });

      document.addEventListener('click', () => {
        setProfileMenu(false);
      });

      document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') {
          setProfileMenu(false);
        }
      });
    }

    const sidebar = document.getElementById('sidebar');
    const main = document.querySelector('.main');
    const menuBtn = document.getElementById('menuBtn');
    const collapseBtn = document.getElementById('collapseBtn');
    const collapseIcon = document.getElementById('collapseIcon');

    // Tombol garis 3 di header:
    // desktop = collapse/expand sidebar, mobile = buka/tutup sidebar.
    menuBtn.addEventListener('click', () => {
      if (window.innerWidth <= 760) {
        sidebar.classList.toggle('open');
      } else {
        sidebar.classList.toggle('collapsed');
        main.classList.toggle('sidebar-collapsed');

        const isCollapsed = sidebar.classList.contains('collapsed');
        collapseIcon.innerHTML = isCollapsed
          ? '<i class="fa-solid fa-chevron-right text-[8px]" aria-hidden="true"></i>'
          : '<i class="fa-solid fa-chevron-left text-[8px]" aria-hidden="true"></i>';
        collapseBtn.title = isCollapsed ? 'Expand sidebar' : 'Collapse sidebar';
      }
    });

    // Tombol Collapse di bagian bawah sidebar.
    collapseBtn.addEventListener('click', () => {
      if (window.innerWidth <= 760) {
        sidebar.classList.remove('open');
        return;
      }

      sidebar.classList.toggle('collapsed');
      main.classList.toggle('sidebar-collapsed');

      const isCollapsed = sidebar.classList.contains('collapsed');
      collapseIcon.innerHTML = isCollapsed
          ? '<i class="fa-solid fa-chevron-right text-[8px]" aria-hidden="true"></i>'
          : '<i class="fa-solid fa-chevron-left text-[8px]" aria-hidden="true"></i>';
      collapseBtn.title = isCollapsed ? 'Expand sidebar' : 'Collapse sidebar';
    });

    // Demo: sidebar navigation active state.
    document.querySelectorAll('.sidebar-item').forEach(item => {
      item.addEventListener('click', (e) => {
        e.preventDefault();
        document.querySelectorAll('.sidebar-item').forEach(x => x.classList.remove('active'));
        item.classList.add('active');
        if (window.innerWidth <= 760) sidebar.classList.remove('open');
      });
    });

    // Pastikan state mobile tidak terbawa saat kembali ke desktop.
    window.addEventListener('resize', () => {
      if (window.innerWidth > 760) {
        sidebar.classList.remove('open');
      } else {
        sidebar.classList.remove('collapsed');
        main.classList.remove('sidebar-collapsed');
        collapseIcon.innerHTML = '<i class="fa-solid fa-chevron-left text-[8px]" aria-hidden="true"></i>';
      }
    });

    // =========================
    // PAGINATION DATA HISTORIS
    // =========================
    function cloneAndExpandRows(tbodyId, targetCount, type) {
      const tbody = document.getElementById(tbodyId);
      if (!tbody) return [];
      const baseRows = Array.from(tbody.querySelectorAll('tr'));
      if (!baseRows.length) return [];

      const sourceRows = baseRows.map(row => row.cloneNode(true));
      while (tbody.querySelectorAll('tr').length < targetCount) {
        const index = tbody.querySelectorAll('tr').length;
        const source = sourceRows[index % sourceRows.length].cloneNode(true);
        const cells = source.querySelectorAll('td');

        if (type === 'activity') {
          const no = index + 1;
          const kr = String(125 - index).padStart(5, '0');
          const plates = ['B 1234 XX','A 8899 YY','B 7788 ZZ','B 5678 QQ','L 9012 MM','B 3456 NN','A 2233 KK','D 6677 LL','B 8890 PP','L 5566 RR','B 9012 SS','D 3344 TT','A 1122 UU','B 7781 VV','D 4455 WW','L 2233 GG'];
          const plate = plates[index % plates.length];
          const activityIn = index % 3 !== 1;
          const minutes = 8 * 60 + 10 + index * 7;
          const hh = String(Math.floor(minutes / 60)).padStart(2, '0');
          const mm = String(minutes % 60).padStart(2, '0');
          const gate = index % 4 === 0 ? 'G1' : 'G2';
          const pending = index % 7 === 4 || index % 11 === 6;
          cells[0].innerHTML = '<span class="mr-2 inline-block h-2 w-2 rounded-full ' + (pending ? 'bg-blue-600' : (activityIn ? 'bg-emerald-500' : 'bg-orange-500')) + '"></span>';
          cells[1].textContent = 'KR-' + kr;
          cells[2].textContent = plate;
          cells[3].className = activityIn ? 'text-emerald-500' : 'text-orange-500';
          cells[3].innerHTML = '<i class="fa-solid ' + (activityIn ? 'fa-arrow-down' : 'fa-arrow-up') + ' mr-1"></i>' + (activityIn ? 'Masuk' : 'Keluar');
          cells[4].textContent = hh + ':' + mm;
          cells[5].textContent = gate;
          cells[6].innerHTML = '<span class="status ' + (pending ? 'status-pending' : 'status-completed') + '">' + (pending ? 'PENDING' : 'COMPLETED') + '</span>';
        } else {
          const names = ['Hendra','Fajar','Agus','Rudi','Ivan','Budi','Doni','Yanto','Andre','Ridwan','Bayu','Rian','Dimas','Arif','Tono','Wahyu'];
          const plates = ['B 7788 PP','L 5566 RR','B 9012 SS','D 3344 TT','A 1122 UU','B 7781 VV','L 2233 GG','D 6676 HH','B 9980 JJ','L 2255 KK','B 4456 LM','D 7788 NP'];
          const locations = ['Area Jetty','Gate 4','Area Jetty','Gate 3','Gate 2'];
          const no = 117 - index;
          cells[0].textContent = 'KR-' + String(no).padStart(5, '0');
          cells[1].textContent = plates[index % plates.length];
          cells[2].textContent = names[index % names.length];
          cells[3].textContent = locations[index % locations.length];
          const minutes = 7 * 60 + 45 + index * 9;
          cells[4].textContent = String(Math.floor(minutes / 60)).padStart(2,'0') + ':' + String(minutes % 60).padStart(2,'0');
          const jetty = index % 2 === 0;
          cells[5].innerHTML = '<span class="status ' + (jetty ? 'status-jetty' : 'status-inside') + '">' + (jetty ? 'AT JETTY' : 'INSIDE') + '</span>';
        }
        tbody.appendChild(source);
      }
      return Array.from(tbody.querySelectorAll('tr'));
    }

    function setupPagination({ tbodyId, infoId, buttonsId, pageSize, totalRows }) {
      const rows = cloneAndExpandRows(tbodyId, totalRows, tbodyId === 'activityBody' ? 'activity' : 'movement');
      const info = document.getElementById(infoId);
      const buttons = document.getElementById(buttonsId);
      let page = 1;
      const totalPages = Math.max(1, Math.ceil(rows.length / pageSize));

      function render() {
        const start = (page - 1) * pageSize;
        const end = Math.min(start + pageSize, rows.length);
        rows.forEach((row, i) => row.style.display = i >= start && i < end ? '' : 'none');
        if (info) info.textContent = `Menampilkan ${start + 1}-${end} dari ${rows.length} data`;
        if (!buttons) return;

        buttons.innerHTML = '';
        const makeButton = (label, disabled, handler, active=false, icon=false) => {
          const btn = document.createElement('button');
          btn.type = 'button';
          btn.className = 'pagination-btn' + (active ? ' active' : '');
          btn.innerHTML = icon ? `<i class="fa-solid ${label}"></i>` : label;
          btn.disabled = disabled;
          btn.setAttribute('aria-label', icon ? (label.includes('left') ? 'Halaman sebelumnya' : 'Halaman berikutnya') : `Halaman ${label}`);
          btn.addEventListener('click', handler);
          buttons.appendChild(btn);
        };

        makeButton('fa-chevron-left', page === 1, () => { page--; render(); }, false, true);

        const pageSet = new Set([1, totalPages, page, page-1, page+1].filter(n => n >= 1 && n <= totalPages));
        const list = Array.from(pageSet).sort((a,b)=>a-b);
        let previous = 0;
        list.forEach(n => {
          if (previous && n - previous > 1) {
            const ellipsis = document.createElement('span');
            ellipsis.className = 'pagination-ellipsis';
            ellipsis.textContent = '…';
            buttons.appendChild(ellipsis);
          }
          makeButton(String(n), false, () => { page = n; render(); }, n === page);
          previous = n;
        });

        makeButton('fa-chevron-right', page === totalPages, () => { page++; render(); }, false, true);
      }

      render();
    }

    setupPagination({ tbodyId: 'activityBody', infoId: 'activityPageInfo', buttonsId: 'activityPageButtons', pageSize: 12, totalRows: 48 });
    setupPagination({ tbodyId: 'movementBody', infoId: 'movementPageInfo', buttonsId: 'movementPageButtons', pageSize: 8, totalRows: 32 });
  
}
