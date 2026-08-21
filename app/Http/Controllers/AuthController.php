<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginDevisi(Request $request)
    {
        $request->validate([
            'nip' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt([
            'nip' => $request->nip,
            'password' => $request->password,
        ])) {
            $request->session()->regenerate();
            return redirect()->route('devisi.dashboard');
        }
    }

    public function loginMasyarakat(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
        ])) {
            $request->session()->regenerate();
            return redirect()->route('masyarakat.dashboard');
        }
    }

    public function logoutMasyarakat(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('masyarakat.login');
    }

    public function registerMasyarakat (Request $request){
           
    }

}
