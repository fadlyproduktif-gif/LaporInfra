<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'nim' => 'required',
            'password' => 'required',
        ]);

        if(Auth::attempt([
            'nim' => $request->nim,
            'password' => $request->password,
        ])){
            $request->session()->regenerate();
            dd($request->user()->role);
        }
    }
}
