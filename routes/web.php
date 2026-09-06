<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;

Route::get('/', [LoginController::class, 'show'])
    ->name('login');

Route::get('/login', [LoginController::class, 'show'])
    ->name('login.show');

Route::post('/login', [LoginController::class, 'authenticate'])
    ->name('login.authenticate');

Route::post('/logout', [LoginController::class, 'logout'])
    ->name('logout');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');