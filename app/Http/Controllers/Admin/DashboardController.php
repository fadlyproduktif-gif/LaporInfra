<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Laporan;
use App\Models\Devisi;
use App\Models\Kategori;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $totalAkun = User::count();
        $totalDevisi = Devisi::count();
        $totalKategori = Kategori::count();

        $laporan = Laporan::latest()
            ->take(3)
            ->get();

        return view(
            'admin.pages.dashboard',
            compact(
                'totalAkun',
                'totalDevisi',
                'totalKategori',
                'laporan',
                'user'
            )
        );
    }
}
