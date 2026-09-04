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
    public function index(Request $request)
    {
        $user = Auth::User();
        /** @var User $user */
        $search = $request->search;
        $stst = $request->status;
        $laporan = Laporan::whereHas('kategori', function ($query) use ($user) {
            $query->where('id_devisi', $user->id_devisi);
        })->when($search, function ($query) use ($search) {
            $query->where('nama_laporan', 'LIKE', "%$search%");
        })->when($stst, function ($query) use ($stst) {
            $query->where('id_status', 'LIKE', "%$stst%");
        })->latest()->get();

        $status = StatusLaporan::all();


        return view('devisi.pages.laporan', compact('laporan','user', 'status'));
    }

    public function detail(Request $request, int $id_laporan)
    {
        $user = Auth::User();
        /** @var User $user */
        $laporan = Laporan::whereHas('kategori', function ($query) use ($user) {
            $query->where('id_devisi', $user->id_devisi);
        })->latest()->findOrFail($id_laporan);

        $status = StatusLaporan::all();

        return view('devisi.pages.detail-laporan', compact('laporan', 'status'));
    }

    public function update(Request $request)
    {
        $user = Auth::User();
        /** @var User $user */

        $id_laporan = $request->id_laporan;

        $update = Laporan::whereHas('kategori', function ($query) use ($user) {
            $query->where('id_devisi', $user->id_devisi);
        })->findOrFail($id_laporan);


        $validated = $request->validate([
            'keterangan_proggress' => 'required',
            'id_status' => 'required|exists:status_laporan,id_status',
        ]);
        

        $update->id_status = $validated['id_status'];
        $update->keterangan_proggress = $validated['keterangan_proggress'];
        $update->save();

        return redirect()->route('devisi.detail-laporan', $update->id_laporan);
    }
}
