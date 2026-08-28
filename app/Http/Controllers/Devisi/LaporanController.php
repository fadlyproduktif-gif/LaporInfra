<?php

namespace App\Http\Controllers\Devisi;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Laporan;
use App\Models\StatusLaporan;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(){
        $user = Auth::User();
        /** @var User $user */
        $laporan = Laporan::whereHas('kategori', function($query) use ($user)
        {
            $query->where('id_devisi', $user->id_devisi);
        })->latest()->get();

        $status = StatusLaporan::all();

        return view('devisi.pages.laporan', compact('laporan', 'status'));
    }
}
