<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/masyarakat/dashboard', function () {
    return view('masyarakat.dashboard');
});