<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Devisi;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KategoriController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $kategori = Kategori::with('devisi')
            ->latest()
            ->get();

        $devisi = Devisi::all();

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
            'kategori' => 'required|string|max:255|unique:kategori,nama_kategori',
        ]);

        Kategori::create([
            'nama_kategori' => $validated['kategori'],
        ]);

        return redirect()
            ->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil disimpan.');
    }

    public function update(Request $request, int $id_kategori)
    {
        $validated = $request->validate([
            'kategori' => 'required|string|max:255',
        ]);

        $kategori = Kategori::findOrFail($id_kategori);

        $kategori->update([
            'nama_kategori' => $validated['kategori'],
        ]);

        return redirect()
            ->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    public function tambahDevisi(Request $request, int $id_kategori)
    {
        $validated = $request->validate([
            'devisi' => 'required|array|min:1',
            'devisi.*' => 'required|exists:devisi,id_devisi',
        ]);

        $kategori = Kategori::findOrFail($id_kategori);

        $kategori->devisi()->syncWithoutDetaching(
            $validated['devisi']
        );

        return redirect()
            ->route('admin.kategori.index')
            ->with('success', 'OPD berhasil ditambahkan ke kategori.');
    }

    public function delete(int $id_kategori)
    {
        $kategori = Kategori::findOrFail($id_kategori);

        if ($kategori->laporan()->exists()) {
            return redirect()
                ->route('admin.kategori.index')
                ->with(
                    'error',
                    'Kategori tidak dapat dihapus karena masih digunakan oleh laporan.'
                );
        }

        $kategori->delete();

        return redirect()
            ->route('admin.kategori.index')
            ->with(
                'success',
                'Kategori berhasil dihapus.'
            );
    }
}
