<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\InvalidStateException;

class OpdGoogleController extends Controller
{
    public function redirect()
    {
        config([
            'services.google.redirect' =>
                'http://127.0.0.1:8000/auth/google/opd/callback',
        ]);

        return Socialite::driver('google')->redirect();
    }

    public function callback(Request $request)
    {
        if (!$request->has('code') || !$request->has('state')) {
            return redirect()
                ->route('auth.devisi.login')
                ->with(
                    'error',
                    'Silakan mulai login dengan Google terlebih dahulu.'
                );
        }

        config([
            'services.google.redirect' =>
                'http://127.0.0.1:8000/auth/google/opd/callback',
        ]);

        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (InvalidStateException $e) {
            return redirect()
                ->route('auth.devisi.login')
                ->with(
                    'error',
                    'Sesi login Google sudah tidak valid. Silakan coba lagi.'
                );
        }

        $user = User::where('email', $googleUser->getEmail())
            ->first();

        if (!$user) {
            return redirect()
                ->route('auth.devisi.login')
                ->with(
                    'error',
                    'Akun Google tersebut belum terdaftar sebagai akun OPD.'
                );
        }

        if ($user->role !== 'opd') {
            return redirect()
                ->route('auth.devisi.login')
                ->with(
                    'error',
                    'Akun Google tersebut tidak terdaftar sebagai akun OPD.'
                );
        }

        $user->google_id = $googleUser->getId();
        $user->save();

        Auth::login($user);

        return redirect()
            ->route('devisi.dashboard');
    }
}