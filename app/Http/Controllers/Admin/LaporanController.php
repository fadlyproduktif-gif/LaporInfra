<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Laporan;
use App\Models\StatusLaporan;
use App\Models\Kategori;

class LaporanController extends Controller
{
    

    public function index(Request $request)
    {
        $user = Auth::user();

        // $laporan = Laporan::latest()->get();
        $status = StatusLaporan::all();
        $kategori = Kategori::all();

        $search = $request->search;
        $fstatus = $request->status;
        $fkategori = $request->kategori;
        // dump($search, $fstatus, $fkategori);
        $laporan = Laporan::when($search, function ($query) use ($search) {
            $query->where('nama_laporan', 'LIKE', "%$search%")
                ->orWhere('lokasi', 'LIKE', "%$search%");
        })
            ->when($fstatus, function ($query) use ($fstatus) {
                $query->where('id_status', $fstatus);
            })
            ->when($fkategori, function ($query) use ($fkategori) {
                $query->where('id_kategori', $fkategori);
            })
            ->latest()
            ->get();

        $totalLaporan = Laporan::all()->count();


        return view(
            'admin.pages.laporan.index',
            compact(
                'user',
                'laporan',
                'status',
                'kategori',
                'fkategori',
                'fstatus',
                'search',
                'totalLaporan'
            )
        );
    }

    public function show(int $id_laporan)
    {   
        $user = Auth::User();

        $laporan = Laporan::findOrFail($id_laporan);
        // dd($laporan->keterangan_proggress);
        
        return view('admin.pages.laporan.show', 
        compact(
            'user',
            'laporan',
            ));
    }
}
