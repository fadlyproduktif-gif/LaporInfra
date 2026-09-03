<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Devisi;
use App\Models\Kategori;
use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KategoriController extends Controller
{
    public function index()
    {
        $user = Auth::User();
        $kategori = Kategori::latest()->get();
        $devisi = Devisi::all();
        foreach ($kategori as $item) {
            // dump($item->devisi->nama_devisi);
        }

        return view(
            'admin.pages.kategori.index',
            compact(
                'user',
                'kategori',
                'devisi',
            )
        );
    }

    public function store(Request $request)
    {


        $validated = $request->validate([
            'kategori' => 'required',
            'devisi' => 'required',
        ]);

        Kategori::Create([
            'nama_kategori' => $validated['kategori'],
            'id_devisi' => $validated['devisi'],
        ]);

        return redirect()->route('admin.kategori.index')
            ->with('success', 'kategori tersimpan');
    }

    public function update(Request $request, int $id_kategori)
    {
        $validated = $request->validate([
            'kategori' => 'required|string|max:255',
            'devisi' => 'required|exists:devisi,id_devisi',
        ]);

        $kategori = Kategori::findOrFail($id_kategori);

        $kategori->nama_kategori = $validated['kategori'];
        $kategori->id_devisi = $validated['devisi'];
        $kategori->save();

        return redirect()
            ->route('admin.kategori.index')
            ->with('success', 'kategori berhasil diperbarui');
    }

    public function delete(Request $request,int $id) {

    }
}
