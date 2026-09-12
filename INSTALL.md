# SIGMA Laravel 10 — Tailwind CSS 3 via CDN

Versi ini dibuat untuk project Laravel 10 yang **tidak meng-install Tailwind ke local files**.
Tailwind dimuat dari Play CDN melalui:

```html
<script src="https://cdn.tailwindcss.com"></script>
```

Karena itu Anda tidak perlu menjalankan `npm install`, `npm run dev`, atau `npm run build` untuk Tailwind.

## Struktur file

```text
app/
└── Http/Controllers/
    ├── AuthController.php
    └── DashboardController.php

public/
├── css/app.css
├── js/app.js
└── images/
    ├── sigma-logo.png
    └── krakatau-posco.png

resources/views/
├── login.blade.php
└── dashboard.blade.php

routes/
└── web.php
```

## Pemasangan ke project Laravel 10 yang sudah ada

Copy file dari paket ini ke folder yang sama di project Laravel Anda.

Contoh:

```text
sigma-laravel/
├── app/Http/Controllers/
├── public/css/
├── public/js/
├── public/images/
├── resources/views/
└── routes/
```

Jika `web.php` project Anda sudah memiliki route lain, gabungkan route SIGMA secara manual agar route lama tidak hilang.

## Menjalankan

Tidak perlu Vite untuk halaman ini. Cukup:

```bash
php artisan optimize:clear
php artisan serve
```

Kemudian buka:

```text
http://127.0.0.1:8000
```

## Role demo

- SUPER ADMIN
- ADMIN GATE 1
- ADMIN GATE 2
- ADMIN GATE 3
- USER

Login demo memakai Laravel Session dan belum menggunakan database/password.

## Catatan

- Browser harus memiliki akses internet untuk memuat Tailwind CDN, Google Fonts, dan Lucide Icons.
- `public/css/app.css` hanya berisi CSS custom SIGMA, bukan file Tailwind.
- `public/js/app.js` hanya berisi JavaScript interaksi dashboard, bukan bundel Vite.
- Play CDN cocok untuk development/prototyping. Untuk deployment production jangka panjang, build Tailwind lokal lebih disarankan.
