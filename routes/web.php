<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('auth.masyarakat.login');
});

Route::middleware('auth')->group(function () {
    Route::get('/masyarakat/dashboard', function () {
        return view('masyarakat.dashboard');
    })->name('masyarakat.dashboard');

    Route::get('/masyarakat/form-laporan', function () {
        return view('masyarakat.form-laporan');
    })->name('masyarakat.form-laporan');

    Route::get('/masyarakat/detail-laporan', function () {
        return view('masyarakat.detail-laporan');
    })->name('masyarakat.detail-laporan');

    Route::get('/masyarakat/laporan-saya', function () {
        return view('masyarakat.laporan-saya');
    })->name('masyarakat.laporan-saya');
});


//[LOGIN-ADMIN]

Route::get('/auth/login-admin', function () {
    return view('auth.admin.login');
})->name('auth.admin.login');


//[DEVISI-LOGIN]

Route::get('/auth/login-devisi', function () {
    return view('auth.devisi.login');
})->name('auth.devisi.login');

//POST 
Route::post('/login-devisi', [AuthController::class, 'loginDevisi'])->name('login.devisi');

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

//[MASYARAKAT LOGOUT]
Route::Post('/logout-masyarakat', [AuthController::class, 'logoutMasyarakat'])->name('logout.masyarakat');
