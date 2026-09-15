<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login SIGMA</title>
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
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <script src="https://unpkg.com/lucide@0.468.0/dist/umd/lucide.min.js"></script>
  <style>
    * { box-sizing: border-box; }
    html, body { min-height: 100%; }
    body { font-family: 'Inter', ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif; }

    .login-card {
      width: 456px;
      max-width: calc(100vw - 32px);
      border: 1px solid #dce5f0;
      border-radius: 12px;
      background: #fff;
      box-shadow: 0 2px 5px rgba(17, 42, 78, .03);
      padding: 42px 34px 34px;
    }

    .field-label {
      display: block;
      margin-bottom: 7px;
      color: #18345f;
      font-size: 14px;
      line-height: 1.2;
      font-weight: 800;
    }

    .form-control {
      width: 100%;
      height: 36px;
      border: 1px solid #cfdbea;
      border-radius: 7px;
      background: #fff;
      padding: 0 12px;
      color: #17365f;
      font-size: 12px;
      outline: none;
      transition: .16s ease;
    }

    .form-control::placeholder { color: #a4b1c6; }
    .form-control:focus {
      border-color: #246edb;
      box-shadow: 0 0 0 3px rgba(36,110,219,.10);
    }

    .login-btn {
      width: 100%;
      height: 40px;
      border: 0;
      border-radius: 7px;
      background: #246edb;
      color: #fff;
      font-size: 14px;
      font-weight: 800;
      cursor: pointer;
      transition: .16s ease;
    }
    .login-btn:hover { background: #1d62c7; }
    .login-btn:active { transform: translateY(1px); }

    @media (max-width: 640px) {
      .login-card { padding: 34px 24px 28px; }
    }
  </style>
</head>
<body class="min-h-screen bg-[#f3f7fd] text-sigma-navy antialiased">
  <main class="relative flex min-h-screen items-center justify-center px-4 py-10">
    <button id="themeToggle" type="button" class="theme-toggle fixed right-5 top-5 z-20 flex h-[42px] w-[42px] items-center justify-center rounded-[9px] border border-[#dce4ef] bg-white text-[#0b2553] shadow-sm" aria-label="Ubah tema" title="Ubah tema">
      <i id="themeIconMoon" data-lucide="moon" class="h-[19px] w-[19px]"></i>
      <i id="themeIconSun" data-lucide="sun" class="hidden h-[19px] w-[19px]"></i>
    </button>

    <section class="login-card">
      <div class="flex justify-center">
        <!-- Light dan dark logo memakai bounding box CSS yang sama -->
        <img
          src="{{ asset('images/sigma-logo.png') }}"
          alt="SIGMA"
          class="sigma-login-logo-light"
        />
        <img
          src="{{ asset('images/sigma-logo-dark.png') }}"
          alt="SIGMA"
          class="sigma-login-logo-dark"
        />
      </div>

      <div class="mt-[32px] text-center">
        <h1 class="text-[29px] font-extrabold leading-none tracking-[-.03em] text-[#071d43]">Masuk ke SIGMA</h1>
        <p class="mt-[10px] text-[14px] font-medium text-[#7387aa]">Sistem Registrasi Material Krakatau Posco</p>
      </div>

      <form id="loginForm" method="POST" action="{{ route('login.submit') }}" class="mt-[29px]">
        @csrf
        <div>
          <label for="operator" class="field-label">ID Operator</label>
          <input
            id="operator"
            name="operator"
            type="text"
            value="{{ old('operator') }}"
            class="form-control"
            placeholder="operator.gate"
            autocomplete="username"
            required
          />
        </div>

        <div class="mt-[16px]">
          <label for="role" class="field-label">Masuk sebagai role demo</label>
          <select id="role" name="role" class="form-control cursor-pointer" required>
            @foreach ($roles as $item)
              <option value="{{ $item }}" @selected(old('role', 'SUPER ADMIN') === $item)>{{ $item }}</option>
            @endforeach
          </select>
        </div>

        @if ($errors->any())
          <div class="mt-[14px] rounded-[7px] border border-red-200 bg-red-50 px-3 py-2 text-[11px] font-semibold text-red-600">
            {{ $errors->first() }}
          </div>
        @endif

        <button id="loginSubmitButton" type="submit" class="login-btn mt-[16px]">Masuk ke Dashboard</button>
        <div id="loginError" class="mt-[14px] hidden rounded-[7px] border border-red-200 bg-red-50 px-3 py-2 text-[11px] font-semibold text-red-600"></div>
      </form>
    </section>


    <!-- Overlay animasi hanya muncul setelah login berhasil -->
    <div id="loginSuccessOverlay" class="login-success-overlay" aria-hidden="true">
      <div class="login-loader-card">
        <div class="truck-stage" aria-hidden="true">
          <div class="speed-line speed-line-1"></div>
          <div class="speed-line speed-line-2"></div>
          <div class="speed-line speed-line-3"></div>

          <div class="sigma-truck">
            <div class="truck-box">
              <img src="{{ asset('images/sigma-logo.png') }}" alt="" class="truck-box-logo" />
            </div>
            <div class="truck-cab">
              <div class="truck-window"></div>
              <div class="truck-light"></div>
            </div>
            <div class="truck-bumper"></div>
            <div class="truck-wheel truck-wheel-left"><span></span></div>
            <div class="truck-wheel truck-wheel-right"><span></span></div>
          </div>

          <div class="road">
            <span></span><span></span><span></span><span></span><span></span>
          </div>
        </div>

        <div class="login-loader-copy">
          <h2>Login berhasil</h2>
          <p>Menyiapkan dashboard SIGMA...</p>
        </div>

        <div class="login-progress"><span></span></div>
      </div>
    </div>

    <footer class="pointer-events-none absolute bottom-[38px] left-0 right-0 flex justify-center">
      <img src="{{ asset('images/krakatau-posco.png') }}" alt="Krakatau Posco" class="h-[28px] w-auto object-contain" />
    </footer>
  </main>
  <script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>
