<?php

namespace App\Http\Controllers\Devisi;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Laporan;
use App\Models\StatusLaporan;
use Illuminate\Http\Request;
use App\Models\HistoryLaporan;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::User();
        /** @var User $user */
        $search = $request->search;
        $stst = $request->status;
        $laporan = Laporan::whereHas('kategori.devisi', function ($query) use ($user) {
            $query->where('devisi.id_devisi', $user->id_devisi);
        })->when($search, function ($query) use ($search) {
            $query->where('nama_laporan', 'LIKE', "%$search%");
        })->when($stst, function ($query) use ($stst) {
            $query->where('id_status', 'LIKE', "%$stst%");
        })->latest()->get();

        $status = StatusLaporan::all();


        return view('devisi.pages.laporan', compact('laporan', 'user', 'status'));
    }

    public function detail(Request $request, int $id_laporan)
    {
        $user = Auth::User();
        /** @var User $user */
        $laporan = Laporan::with([
            'history.userPengubah.devisi',
            'history.statusLaporan',
        ])
            ->whereHas('kategori.devisi', function ($query) use ($user) {
                $query->where('devisi.id_devisi', $user->id_devisi);
            })
            ->latest()
            ->findOrFail($id_laporan);
        $status = StatusLaporan::all();

        return view('devisi.pages.detail-laporan', compact('laporan', 'status'));
    }

    public function update(Request $request)
    {
        $user = Auth::User();
        /** @var User $user */

        $id_laporan = $request->id_laporan;

        $laporan = Laporan::whereHas('kategori.devisi', function ($query) use ($user) {
            $query->where('devisi.id_devisi', $user->id_devisi);
        })->findOrFail($id_laporan);

        $validated = $request->validate([
            'keterangan_proggress' => 'required',
            'id_status' => 'required|exists:status_laporan,id_status',
            'foto_progress' => 'nullable|image|max:2048',
        ]);

        // Simpan kondisi lama ke history
        HistoryLaporan::create([
            'id_laporan' => $laporan->id_laporan,
            'id_user_pengubah' => $user->id_user,
            'id_status' => $laporan->id_status,
            'keterangan_proggress' => $laporan->keterangan_proggress,
            'history_foto' => $laporan->foto_progress,
        ]);

        // Update foto progress kalau ada foto baru
        if ($request->hasFile('foto_progress')) {
            $laporan->foto_progress = $request
                ->file('foto_progress')
                ->store('laporan/progress', 'public');
        }

        $laporan->id_status = $validated['id_status'];
        $laporan->keterangan_proggress = $validated['keterangan_proggress'];
        $laporan->save();

        return redirect()->route(
            'devisi.detail-laporan',
            $laporan->id_laporan
        );
    }
}
