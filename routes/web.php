<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/masyarakat/dashboard', function () {
    return view('masyarakat.dashboard');
});

Route::get('/masyarakat/form-laporan', function () {
    return view('masyarakat.form-laporan');
})->name('masyarakat.form-laporan');

Route::get('/masyarakat/detail-laporan', function () {
    return view('masyarakat.detail-laporan');
})->name('masyarakat.detail-laporan');

Route::get('/masyarakat/laporan-saya', function () {
    return view('masyarakat.laporan-saya');
})->name('masyarakat.laporan-saya');

Route::get('/auth/login-admin', function () {
    return view('auth.admin.login');
})->name('auth.admin.login');

Route::get('/auth/login-devisi', function () {
    return view('auth.devisi.login');
})->name('auth.devisi.login');

Route::get('/auth/login-masyarakat', function () {
    return view('auth.masyarakat.login');
})->name('auth.masyarakat.login');

Route::get('/auth/register-masyarakat', function () {
    return view('auth.masyarakat.register');
})->name('auth.masyarakat.register');