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
    public function index(Request $request)
    {
        $user = Auth::User();
        /** @var User $user  */
        $periode = $request->input(
            'periode',
            session('dashboard', 'minggu')
        );

        session([
            'dashboard' => $periode
        ]);

        $rentang = match ($periode) {
            'minggu' => [
                now()->startOfWeek(),
                now()->endOfWeek(),
            ],
            'bulan' => [
                now()->startOfMonth(),
                now()->endOfMonth(),
            ],
            'tahun' => [
                now()->startOfYear(),
                now()->endOfYear(),
            ],
            default => [
                now()->startOfWeek(),
                now()->endOfWeek(),
            ]
        };

        $laporanR = Laporan::whereHas('kategori.devisi', function ($query) use ($user) {
            $query->where('devisi.id_devisi', $user->id_devisi);
        })->latest()->take(3)->get();

        $laporan = Laporan::whereHas('kategori.devisi', function ($query) use ($user) {
            $query->where('devisi.id_devisi', $user->id_devisi);
        })->get();

        $totalLaporanPeriode =  Laporan::whereHas('kategori.devisi', function ($query) use ($user) {
            $query->where('devisi.id_devisi', $user->id_devisi);
        })
            ->whereBetween('created_at', $rentang)
            ->count();

        //////////////////////////
        //DATA GRAFIK DASHBOARD///
        //////////////////////////

        $dataPeriode = Laporan::whereHas('kategori.devisi', function ($query) use ($user) {
            $query->where('devisi.id_devisi', $user->id_devisi);
        })
            ->whereBetween('created_at',  $rentang)
            ->select('id_kategori')
            ->selectRaw('count(*) as total')
            ->groupBy('id_kategori')
            ->get();

        $dataGrafik = $dataPeriode->map(function ($item) {
            return [
                'kategori' => $item->kategori->nama_kategori,
                'total' => $item->total,
            ];
        });

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
            'totalLaporanPeriode',
            'dataPeriode',
            'dataGrafik',
            'periode',
            'user'
        ));
    }
}
