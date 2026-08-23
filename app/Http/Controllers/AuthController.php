<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

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
            'role' => 'devisi',
        ])) {
            $request->session()->regenerate();
            return redirect()->route('devisi.dashboard');
        }
        else
            {
                return back()->with('errorLogin', 'NIP atau password salah');
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
        else{
            return back()->with('loginError', 'email atau password salah');
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
           $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:8|confirmed'
           ]);

           User::create([
            'nama_user' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'masyarakat'
           ]);

           return redirect()->route('masyarakat.login');
    } 

}
