SIGMA LOGIN DESIGN PATCH

Patch ini BUKAN project Laravel baru.
Gunakan pada project sigma-laravel yang sudah memiliki login dummy:
Employee ID: SIGMA001
Password: sigma123

File yang diganti:
1. resources/views/login.blade.php
2. resources/css/app.css
3. public/images/sigma-logo-main.png

File yang TIDAK perlu diubah:
- routes/web.php
- app/Http/Controllers/LoginController.php
- app/Http/Controllers/DashboardController.php
- resources/js/app.js

Setelah menyalin file:
1. npm run build
2. php artisan optimize:clear
3. php artisan serve

Login page menggunakan route login.authenticate yang sudah ada.
