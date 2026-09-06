<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'SIGMA — Sign In' }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.1/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="login-page">
    <main class="login-shell">
        <!-- LEFT: LOGIN FORM -->
        <section class="login-panel" aria-label="Login SIGMA">
            <div class="login-form-wrap">
                <div class="login-brand">
                    <img
                        src="{{ asset('images/sigma-logo-main.png') }}"
                        alt="SIGMA"
                        class="login-logo"
                    >
                </div>

                <div class="login-heading">
                    <h1>Selamat Datang <span>Kembali!</span></h1>
                    <p>Silakan masuk untuk melanjutkan ke sistem SIGMA.</p>
                </div>

                @if ($errors->any())
                    <div class="login-error" role="alert">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form class="login-form" action="{{ route('login.authenticate') }}" method="POST">
                    @csrf

                    <div class="login-field">
                        <label for="employee-id">Employee ID</label>
                        <div class="login-input-wrap">
                            <i class="fa-regular fa-user login-input-icon" aria-hidden="true"></i>
                            <input
                                id="employee-id"
                                name="employee_id"
                                type="text"
                                autocomplete="username"
                                spellcheck="false"
                                placeholder="Masukkan Employee ID"
                                value="{{ old('employee_id') }}"
                                required
                            />
                        </div>
                    </div>

                    <div class="login-field">
                        <label for="password">Password</label>
                        <div class="password-wrap login-input-wrap">
                            <i class="fa-solid fa-lock login-input-icon" aria-hidden="true"></i>
                            <input
                                id="password"
                                name="password"
                                type="password"
                                autocomplete="current-password"
                                placeholder="Masukkan Password"
                                required
                            />
                            <button
                                id="passwordToggle"
                                class="password-toggle"
                                type="button"
                                aria-label="Tampilkan password"
                                title="Tampilkan password"
                            >
                                <i class="fa-solid fa-eye" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>

                    <div class="login-options">
                        <label class="remember-option">
                            <input type="checkbox" name="remember" value="1">
                            <span class="custom-checkbox" aria-hidden="true"></span>
                            <span>Ingat saya</span>
                        </label>

                        <button type="button" class="forgot-password">
                            Lupa password?
                        </button>
                    </div>

                    <button class="login-submit" type="submit">
                        Login
                    </button>
                </form>

                <div class="login-footer">
                    © {{ date('Y') }} SIGMA System. All rights reserved.
                </div>
            </div>
        </section>

        <!-- RIGHT: FLAT TRUCK ILLUSTRATION -->
        <section class="login-visual" aria-label="Ilustrasi truk SIGMA">
            <div class="login-visual-bg" aria-hidden="true">
                <span class="visual-circle visual-circle-1"></span>
                <span class="visual-circle visual-circle-2"></span>
                <span class="visual-dot-grid visual-dot-grid-1"></span>
                <span class="visual-dot-grid visual-dot-grid-2"></span>
                <span class="visual-plus visual-plus-1">+</span>
                <span class="visual-plus visual-plus-2">+</span>
                <span class="visual-ring visual-ring-1"></span>
                <span class="visual-ring visual-ring-2"></span>
            </div>

            <div class="truck-scene">
                <div class="truck-copy">
                    <span class="truck-copy-line"></span>
                    <span>SIGMA</span>
                    <span class="truck-copy-line"></span>
                </div>

                <div class="truck-stage">
                    <div class="truck-motion motion-1"></div>
                    <div class="truck-motion motion-2"></div>
                    <div class="truck-motion motion-3"></div>

                    <svg class="truck-illustration" viewBox="0 0 900 430" role="img" aria-label="Ilustrasi truk barang SIGMA">
                        <!-- soft ground -->
                        <ellipse cx="470" cy="370" rx="320" ry="26" fill="#dce8d0" opacity="0.7"/>
                        <path d="M145 368H790" stroke="#102b4f" stroke-width="7" stroke-linecap="round"/>
                        <path d="M200 390H330M380 390H510M560 390H690" stroke="#9ed12f" stroke-width="5" stroke-linecap="round"/>

                        <!-- cargo box -->
                        <path d="M170 145Q170 126 191 122L625 88Q648 86 648 109V303H170V145Z" fill="#ffffff" stroke="#102b4f" stroke-width="8" stroke-linejoin="round"/>
                        <path d="M198 151L600 118" stroke="#e4eadf" stroke-width="4"/>
                        <path d="M205 172V282M245 168V282M285 165V282M325 161V282M365 158V282M405 155V282M445 151V282M485 148V282M525 145V282M565 141V282" stroke="#edf1ec" stroke-width="4"/>

                        <!-- SIGMA logo image on the cargo box -->
                        <rect x="268" y="190" width="284" height="90" rx="16" fill="#f7faf5" stroke="#dce8d0" stroke-width="3"/>
                        <image
                            href="{{ asset('images/sigma-logo-main.png') }}"
                            x="284"
                            y="207"
                            width="252"
                            height="56"
                            preserveAspectRatio="xMidYMid meet"
                            aria-label="Logo SIGMA pada truk"
                        />

                        <!-- cab -->
                        <path d="M625 187H710C730 187 750 201 760 220L790 303H625V187Z" fill="#9ed12f" stroke="#102b4f" stroke-width="8" stroke-linejoin="round"/>
                        <path d="M650 202H704C718 202 729 210 736 222L746 246H650V202Z" fill="#dff2f7" stroke="#102b4f" stroke-width="6" stroke-linejoin="round"/>
                        <path d="M674 202V246" stroke="#102b4f" stroke-width="5"/>
                        <path d="M625 187V303" stroke="#102b4f" stroke-width="8"/>
                        <path d="M760 268H788V303H772" fill="#0b2343"/>

                        <!-- front bumper / grille -->
                        <path d="M650 303H790L800 333H636L650 303Z" fill="#0b2343" stroke="#102b4f" stroke-width="6"/>
                        <path d="M680 314H758" stroke="#9ed12f" stroke-width="6" stroke-linecap="round"/>
                        <rect x="768" y="323" width="23" height="9" rx="4" fill="#ffffff"/>

                        <!-- wheels -->
                        <g>
                            <circle cx="282" cy="325" r="48" fill="#0b2343" stroke="#102b4f" stroke-width="6"/>
                            <circle cx="282" cy="325" r="22" fill="#dce3e8"/>
                            <circle cx="282" cy="325" r="9" fill="#102b4f"/>
                        </g>
                        <g>
                            <circle cx="570" cy="325" r="48" fill="#0b2343" stroke="#102b4f" stroke-width="6"/>
                            <circle cx="570" cy="325" r="22" fill="#dce3e8"/>
                            <circle cx="570" cy="325" r="9" fill="#102b4f"/>
                        </g>
                        <g>
                            <circle cx="720" cy="325" r="48" fill="#0b2343" stroke="#102b4f" stroke-width="6"/>
                            <circle cx="720" cy="325" r="22" fill="#dce3e8"/>
                            <circle cx="720" cy="325" r="9" fill="#102b4f"/>
                        </g>

                        <!-- wheel chassis -->
                        <path d="M170 303H648" stroke="#102b4f" stroke-width="16" stroke-linecap="round"/>
                        <path d="M350 302H520" stroke="#9ed12f" stroke-width="7" stroke-linecap="round"/>

                        <!-- headlight -->
                        <rect x="778" y="286" width="18" height="22" rx="6" fill="#f4f9d9" stroke="#102b4f" stroke-width="4"/>

                        <!-- small material boxes -->
                        <g transform="translate(118 103)">
                            <path d="M0 28L29 12L58 28L29 45L0 28Z" fill="#9ed12f" stroke="#102b4f" stroke-width="4"/>
                            <path d="M0 28V61L29 78V45L0 28Z" fill="#b8dd62" stroke="#102b4f" stroke-width="4"/>
                            <path d="M58 28V61L29 78V45L58 28Z" fill="#82bb25" stroke="#102b4f" stroke-width="4"/>
                        </g>
                    </svg>
                </div>

                <div class="truck-caption">
                    <div class="caption-pill"><span></span> SISTEM REGISTRASI MATERIAL</div>
                    <!--<p>Registrasi kendaraan dan pergerakan<br>barang lebih terintegrasi.</p>-->
                </div>
            </div>
        </section>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const password = document.getElementById('password');
            const toggle = document.getElementById('passwordToggle');

            if (!password || !toggle) return;

            toggle.addEventListener('click', function () {
                const visible = password.type === 'text';
                password.type = visible ? 'password' : 'text';
                toggle.setAttribute('aria-label', visible ? 'Tampilkan password' : 'Sembunyikan password');
                toggle.setAttribute('title', visible ? 'Tampilkan password' : 'Sembunyikan password');
                toggle.innerHTML = visible
                    ? '<i class="fa-solid fa-eye" aria-hidden="true"></i>'
                    : '<i class="fa-solid fa-eye-slash" aria-hidden="true"></i>';
            });
        });
    </script>
</body>
</html>
