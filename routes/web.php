<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProfileController;

// Route halaman utama
Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }

    return redirect()->route('login');
});

// Route untuk pengguna yang belum login
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])
        ->name('login');

    Route::post('/login', [LoginController::class, 'login'])
        ->name('login.process');
});

// Route untuk semua pengguna yang sudah login
Route::middleware('auth')->group(function () {

    // Dashboard bersama Admin dan Superadmin
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Logout
    Route::post('/logout', [LoginController::class, 'logout'])
        ->name('logout');

    // CRUD Pegawai untuk Admin dan Superadmin
    Route::resource('employees', EmployeeController::class);

    // Manajemen Profil Pengguna
    Route::get('/profile', [ProfileController::class, 'index'])
        ->name('profile.index');

    Route::put('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])
        ->name('profile.password');
});

// Route khusus Superadmin
Route::middleware(['auth', 'role:superadmin'])
    ->prefix('superadmin')
    ->name('superadmin.')
    ->group(function () {

        // CRUD akun Admin
        Route::resource('admins', AdminController::class)
            ->except(['show']);

        // Reset password Admin
        Route::put(
            '/admins/{admin}/reset-password',
            [AdminController::class, 'resetPassword']
        )->name('admins.reset-password');
    });
