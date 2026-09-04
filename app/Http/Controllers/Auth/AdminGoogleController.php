<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminGoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        $googleUser = Socialite::driver('google')->user();

        $user = User::where('email', $googleUser->getEmail())
            ->where('role', 'admin')
            ->first();

        if (!$user) {
            return redirect()
                ->route('auth.admin.login')
                ->with('eror', 'Anda Bukanlah Atmin');
        }
        $user->google_id = $googleUser->getId();
        $user->save();

        Auth::login($user);

        return redirect()->route('admin.dashboard');
    }

     public function logoutAdmin(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('auth.admin.login');
    }
}
