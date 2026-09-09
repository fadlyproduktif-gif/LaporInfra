<?php

namespace App\Http\Controllers\Masyarakat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Laporan;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        /** @var user $user */
        $laporan = $user->laporan()
            ->latest()
            ->get();
        return view('masyarakat.laporan-saya', compact('laporan'));
    }

    public function create()
    {
        $kategori = Kategori::all();

        return view('masyarakat.form-laporan', compact('kategori'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_laporan' => 'required|string|max:255',
            'id_kategori' => 'required|exists:kategori,id_kategori',
            'lokasi' => 'required|string|max:255',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'foto_lokasi' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'deskripsi' => 'required|string|max:1000',
        ]);
        $user = Auth::User();
        $foto = $request->file('foto_lokasi');
        $pathfoto = $foto->store('laporan', 'public');
        $laporan = Laporan::create([
            'id_user' => $user->id_user,
            'nama_laporan' => $validated['nama_laporan'],
            'id_kategori' => $validated['id_kategori'],
            'lokasi' => $validated['lokasi'],
            'latitude' => $validated['latitude'],
            'longitude' => $validated['longitude'],
            'foto_lokasi' => $pathfoto,
            'deskripsi' => $validated['deskripsi'],
            'id_status' => 1,
            'keterangan_proggress' => 'Laporan sedang menunggu pemeriksaan.',
        ]);

        return redirect()->route('masyarakat.laporan-saya');
    }

    public function detailLaporan(int $id_laporan)
    {
        $laporan = Laporan::with([
            'history.userPengubah.devisi',
            'history.statusLaporan',
        ])->findOrFail($id_laporan);

        return view('masyarakat.detail-laporan', compact('laporan'));
    }
}
