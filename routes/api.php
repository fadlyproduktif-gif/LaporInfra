<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Laporan;
use App\Models\User;

Route::get('/user', function (Request $request) {
    return Auth::User();
});

Route::get('/laporan', function (Request $request){
    return Laporan::all();
});