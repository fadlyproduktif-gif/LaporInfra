<?php

namespace App\Http\Controllers\Masyarakat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
Use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ProfilController extends Controller
{
    public function index(){
        $user = Auth::user();
        return view('masyarakat.profil', compact('user'));
    }

    public function updateEmail(Request $request){
        $user = Auth::User();
        $validated = $request-> validate([
            'nama_user' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($user->id_user, 'id_user'),
            ],
        ]);

        $user->nama_user = $validated['nama_user'];
        $user->email = $validated['email'];

        /** @var User $user */
        $user->save();

        return redirect( route('profil'));
    }

    public function updatePassword(Request $request){
        $user = Auth::user();
        /** @var User $user */
        $validated = $request->validate([
            'password' => 'required|string|max:255',
            'new_password' => 'required|min:8|confirmed'
        ]);

        if(Hash::check(
            $validated['password'],
            $user->password
        )){
            $user->password =  Hash::make($validated['new_password']);
            $user->save();
            return redirect(route('profil'));
        }else{
             return back()->with('errorPassword', 'password salah');
        };
        
    }
}

 