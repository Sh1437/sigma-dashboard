<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\BlacklistDriverController;
use App\Http\Controllers\SuspendDriverController;
use App\Http\Controllers\RoleAccessController;
use App\Http\Controllers\UserManagementController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => session()->has('sigma_auth') ? redirect()->route('dashboard') : redirect()->route('login'));
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/registration', [RegistrationController::class, 'create'])->name('registration.create');
Route::post('/registration', [RegistrationController::class, 'store'])->name('registration.store');
Route::post('/registration/master-request', [RegistrationController::class, 'storeMasterRequest'])->name('registration.master-request');

Route::get('/role-access-management', [RoleAccessController::class, 'index'])->name('role-access.index');
Route::get('/role-access-management/create', [RoleAccessController::class, 'create'])->name('role-access.create');
Route::post('/role-access-management', [RoleAccessController::class, 'store'])->name('role-access.store');
Route::get('/role-access-management/{identity}/edit', [RoleAccessController::class, 'edit'])->name('role-access.edit');
Route::put('/role-access-management/{identity}', [RoleAccessController::class, 'update'])->name('role-access.update');
Route::patch('/role-access-management/{identity}/status', [RoleAccessController::class, 'updateStatus'])->name('role-access.status');
Route::delete('/role-access-management/{identity}', [RoleAccessController::class, 'destroy'])->name('role-access.destroy');


Route::get('/user-management', [UserManagementController::class, 'index'])->name('user-management.index');
Route::get('/user-management/create', [UserManagementController::class, 'create'])->name('user-management.create');
Route::post('/user-management', [UserManagementController::class, 'store'])->name('user-management.store');
Route::get('/user-management/{identity}/edit', [UserManagementController::class, 'edit'])->name('user-management.edit');
Route::put('/user-management/{identity}', [UserManagementController::class, 'update'])->name('user-management.update');
Route::delete('/user-management/{identity}', [UserManagementController::class, 'destroy'])->name('user-management.destroy');


Route::get('/blacklist-driver', [BlacklistDriverController::class, 'index'])->name('blacklist-driver.index');
Route::get('/blacklist-driver/create', [BlacklistDriverController::class, 'create'])->name('blacklist-driver.create');
Route::post('/blacklist-driver', [BlacklistDriverController::class, 'store'])->name('blacklist-driver.store');
Route::get('/blacklist-driver/{identity}/edit', [BlacklistDriverController::class, 'edit'])->name('blacklist-driver.edit');
Route::put('/blacklist-driver/{identity}', [BlacklistDriverController::class, 'update'])->name('blacklist-driver.update');
Route::delete('/blacklist-driver/{identity}', [BlacklistDriverController::class, 'destroy'])->name('blacklist-driver.destroy');


Route::get('/suspend-driver', [SuspendDriverController::class, 'index'])->name('suspend-driver.index');
Route::get('/suspend-driver/create', [SuspendDriverController::class, 'create'])->name('suspend-driver.create');
Route::post('/suspend-driver', [SuspendDriverController::class, 'store'])->name('suspend-driver.store');
Route::get('/suspend-driver/{identity}/edit', [SuspendDriverController::class, 'edit'])->name('suspend-driver.edit');
Route::put('/suspend-driver/{identity}', [SuspendDriverController::class, 'update'])->name('suspend-driver.update');
Route::delete('/suspend-driver/{identity}', [SuspendDriverController::class, 'destroy'])->name('suspend-driver.destroy');
