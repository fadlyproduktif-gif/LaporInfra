<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Masyarakat\DashboardController as MasyarakatDashboardController;
use App\Http\Controllers\Masyarakat\LaporanController;
use App\Http\Controllers\Masyarakat\ProfilController;
use App\Http\Controllers\Devisi\DashboardController as DevisiDashboardController;

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

    Route::get('/masyarakat/form-laporan', [LaporanController::class, 'create'])
    ->name('masyarakat.form-laporan');

    Route::Post('/masyarakat/form-laporan', [LaporanController::class, 'store'])
    ->name('masyarakat.form-laporan.store');

    Route::get('/masyarakat/detail-laporan/{id_laporan}', [LaporanController::class, 'detailLaporan'])->name('masyarakat.detail-laporan');

    Route::get('/masyarakat/laporan-saya', [LaporanController::class, 'index'])->name('masyarakat.laporan-saya');

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
    Route::get('/devisi/dashboard', 
    [DevisiDashboardController::class, 'index'])->name('devisi.dashboard');
});

Route::get('/devisi/dashboard', function () {
    return view('devisi.pages.dashboard');
})->name('devisi.dashboard');

Route::get('/devisi/form-laporan', function () {
    return view('devisi.form-laporan');
})->name('devisi.form-laporan');

Route::get('/devisi/laporan', function () {
    return view('devisi.pages.laporan');
})->name('devisi.laporan');

Route::get('/devisi/detail-laporan', function () {
    return view('devisi.pages.detail-laporan');
})->name('devisi.detail-laporan');


//[DEVISI END]


//[LOGIN-ADMIN]
Route::get('/auth/login-admin', function () {
    return view('auth.admin.login');
})->name('auth.admin.login');


//[ADMIN CONTENT]
Route::middleware(['auth', 'role:admin'])->group(function () {});

//[ADMIN END]