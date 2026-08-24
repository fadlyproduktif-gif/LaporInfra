<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Masyarakat\DashboardController;

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
    Route::get('/masyarakat/dashboard', [DashboardController::class, 'index'])
    ->name('masyarakat.dashboard');

    Route::get('/masyarakat/form-laporan', function () {
        return view('masyarakat.form-laporan');
    })->name('masyarakat.form-laporan');

    Route::get('/masyarakat/detail-laporan', function () {
        return view('masyarakat.detail-laporan');
    })->name('masyarakat.detail-laporan');

    Route::get('/masyarakat/laporan-saya', function () {
        return view('masyarakat.laporan-saya');
    })->name('masyarakat.laporan-saya');

    Route::get('/masyarakat/profil-saya', function () {
        return view('masyarakat.profil');
    })->name('profil');
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
Route::middleware(['auth', 'role:devisi'])->group(function () {});


//[DEVISI END]


//[LOGIN-ADMIN]
Route::get('/auth/login-admin', function () {
    return view('auth.admin.login');
})->name('auth.admin.login');


//[ADMIN CONTENT]
Route::middleware(['auth', 'role:admin'])->group(function () {});

//[ADMIN END]