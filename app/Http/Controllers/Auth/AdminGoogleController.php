<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\InvalidStateException;

class AdminGoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback(Request $request)
    {
        if (!$request->has('code') || !$request->has('state')) {
            return redirect()
                ->route('auth.admin.login')
                ->with(
                    'error',
                    'Silakan mulai login dengan Google terlebih dahulu.'
                );
        }

        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (InvalidStateException $e) {
            return redirect()
                ->route('auth.admin.login')
                ->with(
                    'error',
                    'Sesi login Google sudah tidak valid. Silakan coba lagi.'
                );
        }

        $user = User::where('email', $googleUser->getEmail())
            ->where('role', 'admin')
            ->first();

        if (!$user) {
            return redirect()
                ->route('auth.admin.login')
                ->with(
                    'error',
                    'Akun Google tersebut tidak terdaftar sebagai akun admin.'
                );
        }

        $user->google_id = $googleUser->getId();
        $user->save();

        Auth::login($user);

        return redirect()
            ->route('admin.dashboard');
    }


     public function logoutAdmin(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('auth.admin.login');
    }
}
