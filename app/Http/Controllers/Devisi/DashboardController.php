<?php

namespace App\Http\Controllers\Devisi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Laporan;
use App\Models\kategori;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::User();
        /** @var User $user  */
        $laporanR = Laporan::whereHas('kategori', function($query) use ($user) {
            $query->where('id_devisi', $user->id_devisi);
        })->latest()->take(3)->get();

        $laporan = Laporan::whereHas('kategori', function($query) use ($user) {
            $query->where('id_devisi', $user->id_devisi);
        })->get();

        $total = $laporan->count();
        $menunggu = $laporan->where('id_status', 1)->count();
        $dikerjakan = $laporan->where('id_status', 5)->count();
        $selesai = $laporan->where('id_status', 6)->count();
        $terima = $laporan->where('id_status', 4)->count();
        $tunda = $laporan->where('id_status', 2)->count();
        $tolak = $laporan->where('id_status', 3)->count();

        return view('devisi.pages.dashboard', compact('laporanR','laporan','total','dikerjakan','menunggu','selesai','terima','tolak','tunda'));
    }
}
