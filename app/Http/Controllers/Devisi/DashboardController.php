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
        $laporanR = Laporan::whereHas('kategori', function ($query) use ($user) {
            $query->where('id_devisi', $user->id_devisi);
        })->latest()->take(3)->get();

        $laporan = Laporan::whereHas('kategori', function ($query) use ($user) {
            $query->where('id_devisi', $user->id_devisi);
        })->get();

        $laporanKategori =  Laporan::whereHas('kategori', function ($query) use ($user) {
            $query->where('id_devisi', $user->id_devisi);
        })
            ->whereMonth('created_at', now()->month)
            ->select('id_kategori')
            ->selectRaw('count(*) as total')
            ->groupBy('id_kategori')
            ->get();

        $awalminggu = now()->startOfWeek();
        $akhirminggu = now()->endOfWeek();

        $lpmingguini = Laporan::whereHas('kategori', function($query) use ($user){
            $query->where('id_devisi', $user->id_devisi);
        })->whereBetween('created_at', [$awalminggu, $akhirminggu])->
        select('id_kategori')->selectRaw('count(*) as total')->groupBy('id_kategori')->get();

        $dataGrafik = $lpmingguini->map(function($item){
            return [
                'kategori' => $item->kategori->nama_kategori,
                'total' => $item->total,
            ];
        });
        dump($dataGrafik);
        foreach($lpmingguini as $item){
            dump($item->kategori->nama_kategori, $item->total);

        }
        $bulan = Laporan::whereMonth('created_at', 8)->get();
        // dd($bulan);
        $totalLaporan = $laporan->count();
        $menunggu = $laporan->where('id_status', 1)->count();
        $dikerjakan = $laporan->where('id_status', 5)->count();
        $selesai = $laporan->where('id_status', 6)->count();
        $terima = $laporan->where('id_status', 4)->count();
        $tunda = $laporan->where('id_status', 2)->count();
        $tolak = $laporan->where('id_status', 3)->count();

        return view('devisi.pages.dashboard', compact(
            'laporanR',
            'laporan',
            'totalLaporan',
            'dikerjakan',
            'menunggu',
            'selesai',
            'terima',
            'tolak',
            'tunda',
            'laporanKategori',
            'lpmingguini',
            'dataGrafik',
        ));
    }
}
