<?php

namespace App\Http\Controllers\Devisi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DashboardController extends Controller
{
    public function index(){
        $user = Auth::User();
         
            return view('devisi.dashboard');
    }
}
