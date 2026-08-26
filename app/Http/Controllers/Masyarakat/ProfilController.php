<?php

namespace App\Http\Controllers\Masyarakat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfilController extends Controller
{
    public function index(Request $request){
        $user = Auth::user();
        return view('masyarakat.profil', compact('user'));
    }
}
