<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Masyarakat\DashboardController as MasyarakatDashboardController;
use App\Http\Controllers\Masyarakat\LaporanController as MasyarakatLaporanController;
use App\Http\Controllers\Masyarakat\ProfilController;
use App\Http\Controllers\Devisi\DashboardController as DevisiDashboardController;
use App\Http\Controllers\Devisi\LaporanController as DevisiLaporanController;
use App\Http\Controllers\Auth\AdminGoogleController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\LaporanController as AdminLaporanController;
use App\Http\Controllers\Admin\KategoriController as AdminKategoriController;

Route::get('/', function () {
    return view('auth.masyarakat.login');
});

//[MASYARAKAT-LOGIN]
Route::get('/auth/login-masyarakat', function () {
    return view('auth.masyarakat.login');
})->name('masyarakat.login');

Route::Post('/login-masyarakat', [AuthController::class, 'loginMasyarakat'])->name('login.masyarakat');

//[MASYARAKAT REGISTER]
Route::get('/auth/register-masyarakat', function () {
    return view('auth.masyarakat.register');
})->name('masyarakat.register');

Route::Post('/register-masyarakat', [AuthController::class, 'registerMasyarakat'])->name('register.masyarakat');

//[MASYARAKAT CONTENT]
Route::middleware(['auth', 'role:masyarakat'])->group(function () {
    Route::get('/masyarakat/dashboard', [MasyarakatDashboardController::class, 'index'])
        ->name('masyarakat.dashboard');

    Route::get('/masyarakat/form-laporan', [MasyarakatLaporanController::class, 'create'])
        ->name('masyarakat.form-laporan');

    Route::Post('/masyarakat/form-laporan', [MasyarakatLaporanController::class, 'store'])
        ->name('masyarakat.form-laporan.store');

    Route::get('/masyarakat/detail-laporan/{id_laporan}', [MasyarakatLaporanController::class, 'detailLaporan'])->name('masyarakat.detail-laporan');

    Route::get('/masyarakat/laporan-saya', [MasyarakatLaporanController::class, 'index'])->name('masyarakat.laporan-saya');

    Route::get('/masyarakat/profil-saya', [ProfilController::class, 'index'])->name('profil');

    Route::Put('/masyarakat/profil-saya/update-email', [ProfilController::class, 'updateEmail'])
        ->name('masyarakat.profil.update.email');
    Route::Put('/masyarakat/profil-saya/update-password', [ProfilController::class, 'updatePassword'])
        ->name('masyarakat.profil.update.password');
});

//[MASYARAKAT LOGOUT]
Route::Post('/logout-masyarakat', [AuthController::class, 'logoutMasyarakat'])->name('logout.masyarakat');
//[MASYARAKAT END]


//[DEVISI-LOGIN]
Route::get('/auth/login-devisi', function () {
    return view('auth.devisi.login');
})->name('auth.devisi.login');
Route::post('/login-devisi', [AuthController::class, 'loginDevisi'])->name('login.devisi');


//[DEVISI CONTENT]
Route::middleware(['auth', 'role:devisi'])->group(function () {
    Route::get(
        '/devisi/dashboard',
        [DevisiDashboardController::class, 'index']
    )->name('devisi.dashboard');

    Route::get('/devisi/laporan', [DevisiLaporanController::class, 'index'])->name('devisi.laporan');

    Route::put('/devisi/laporan/update', [DevisiLaporanController::class, 'update'])->name('devisi.laporan.update');

    Route::get('/devisi/detail-laporan/{id_laporan}', [DevisiLaporanController::class, 'detail'])->name('devisi.detail-laporan');
});

//[DEVISI LOGOUT]
Route::Post('/logout-devisi', [AuthController::class, 'logoutDevisi'])->name('logout.devisi');
//[DEVISI END]

//[DEVISI END]


//[LOGIN-ADMIN]
Route::get('/auth/login-admin', function () {
    return view('auth.admin.login');
})->name('auth.admin.login');

Route::get('/auth/google', [AdminGoogleController::class, 'redirect'])
    ->name('admin.google.redirect');

Route::get('/auth/google/callback', [AdminGoogleController::class, 'callback'])
    ->name('admin.google.callback');


//[ADMIN CONTENT]
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])
    ->name('admin.dashboard');

    Route::get('/admin/laporan', [AdminLaporanController::class, 'index'])
    ->name('admin.laporan.index');

    Route::get('/admin/laporan/{id_laporan}',[AdminLaporanController::class, 'show'])
    ->name('admin.laporan.show');

    Route::get('/admin/kategori', [AdminKategoriController::class, 'index'])
    ->name('admin.kategori.index');

    Route::get('/admin/devisi', function () {
        return view('admin.pages.devisi.index');
    })->name('admin.devisi.index');


    Route::get('/admin/akun', function () {
        return view('admin.pages.akun.index');
    })->name('admin.akun.index');
});

//[ADMIN END]

