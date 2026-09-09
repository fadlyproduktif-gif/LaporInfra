<?php

namespace App\Http\Controllers\Masyarakat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class DashboardController extends Controller
{
    public function index()
    {
        /** @var user $user */

        $user = Auth::user();
        $laporan = $user->laporan()
        ->latest()
        ->take(3)
        ->get();
        // foreach($laporan as $l){
            
        //     dump($l->id_laporan);
        // }

        return view('masyarakat.dashboard', compact('laporan'));
    }
}
