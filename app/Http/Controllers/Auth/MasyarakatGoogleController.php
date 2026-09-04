<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class MasyarakatGoogleController extends Controller
{
    public function redirect()
    {
        config([
            'services.google.redirect' =>
            'http://127.0.0.1:8000/auth/google/masyarakat/callback',
        ]);

        return Socialite::driver('google')->redirect();
    }

    public function callback(Request $request)
    {
        if (!$request->has('code') || !$request->has('state')) {
            return redirect()
                ->route('auth.masyarakat.login')
                ->with(
                    'error',
                    'Silakan mulai login dengan Google terlebih dahulu.'
                );
        }

        config([
            'services.google.redirect' =>
            'http://127.0.0.1:8000/auth/google/masyarakat/callback',
        ]);

        $googleUser = Socialite::driver('google')->user();

        $user = User::where('email', $googleUser->getEmail())
            ->first();

        if (!$user) {

            $user = User::create([
                'nip' => null,
                'nama_user' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'password' => null,
                'google_id' => $googleUser->getId(),
                'role' => 'masyarakat',
                'id_devisi' => null,
            ]);
        } else {

            if ($user->role !== 'masyarakat') {
                return redirect()
                    ->route('auth.masyarakat.login')
                    ->with(
                        'error',
                        'Akun Google tersebut tidak terdaftar sebagai akun masyarakat.'
                    );
            }

            $user->google_id = $googleUser->getId();
            $user->save();
        }

        Auth::login($user);

        return redirect()
            ->route('masyarakat.dashboard');
    }
}
