<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Devisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DevisiController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $devisi = Devisi::latest()->get();
        $total = $devisi->count();


        return view(
            'admin.pages.devisi.index',
            compact(
                'user',
                'devisi',
                'total'
            )
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_devisi' => 'required|string|max:255',
        ]);
        Devisi::Create([
            'nama_devisi' => $validated['nama_devisi'],
        ]);

        return redirect()->route('admin.devisi.index')->with('succsess', 'devisi berhasil di tambahkan');
    }

    public function update(Request $request, int $id_devisi)
    {
        $validated = $request->validate([
            'nama_devisi' => 'required|string|max:255',
        ]);
        $devisi = Devisi::findOrFail($id_devisi);
        $devisi->nama_devisi = $validated['nama_devisi'];
        $devisi->save();

        return redirect()->route('admin.devisi.index')->with('succsess', 'devisi berhasil di update');
    }

    public function delete(int $id_devisi)
    {
        $devisi = Devisi::findOrFail($id_devisi);

        if ($devisi->kategori()->exists()) {
            return redirect()
                ->route('admin.devisi.index')
                ->with(
                    'error',
                    'Devisi tidak dapat dihapus karena masih memiliki kategori.'
                );
        }

        $devisi->delete();

        return redirect()
            ->route('admin.devisi.index')
            ->with(
                'success',
                'Devisi berhasil dihapus.'
            );
    }
}
