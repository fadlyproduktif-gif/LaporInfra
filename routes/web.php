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