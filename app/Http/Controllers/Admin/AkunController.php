<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Devisi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AkunController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $akun = User::with('devisi')
            ->latest()
            ->get();

        $role = User::distinct()
            ->pluck('role');

        $devisi = Devisi::all();

        return view(
            'admin.pages.akun.index',
            compact(
                'user',
                'akun',
                'devisi',
                'role'
            )
        );
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_user' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'email',
                'unique:users,email',
            ],

            'role' => [
                'required',
                Rule::in([
                    'admin',
                    'opd',
                    'masyarakat',
                ]),
            ],

            'nip' => [
                'nullable',
                'required_if:role,opd',
                'string',
                'max:50',
                'unique:users,nip',
            ],

            'id_devisi' => [
                'nullable',
                'required_if:role,opd',
                'exists:devisi,id_devisi',
            ],

            'password' => [
                'nullable',
                'required_if:role,masyarakat,opd',
                'string',
                'min:8',
                'confirmed',
            ],
        ]);


        User::create([
            'nip' => $validated['nip'] ?? null,

            'nama_user' => $validated['nama_user'],

            'email' => $validated['email'],

            'password' => $validated['password'] ?? null,

            'google_id' => null,

            'role' => $validated['role'],

            'id_devisi' => $validated['role'] === 'opd'
                ? $validated['id_devisi']
                : null,
        ]);


        return redirect()
            ->route('admin.akun.index')
            ->with(
                'success',
                'Akun berhasil ditambahkan.'
            );
    }


    public function update(Request $request, int $id_user)
    {
        $akun = User::findOrFail($id_user);


        $validated = $request->validate([
            'nama_user' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')
                    ->ignore(
                        $akun->id_user,
                        'id_user'
                    ),
            ],

            'role' => [
                'required',
                Rule::in([
                    'admin',
                    'opd',
                    'masyarakat',
                ]),
            ],

            'nip' => [
                'nullable',
                'required_if:role,opd',
                'string',
                'max:50',
                Rule::unique('users', 'nip')
                    ->ignore(
                        $akun->id_user,
                        'id_user'
                    ),
            ],

            'id_devisi' => [
                'nullable',
                'required_if:role,opd',
                'exists:devisi,id_devisi',
            ],

            'password' => [
                'nullable',
                'string',
                'min:8',
                'confirmed',
            ],
        ]);


        $akun->nama_user = $validated['nama_user'];

        $akun->email = $validated['email'];

        $akun->role = $validated['role'];

        $akun->nip = $validated['nip'] ?? null;

        $akun->id_devisi = $validated['role'] === 'opd'
            ? $validated['id_devisi']
            : null;


        /*
        ---------------------------------------------------------
        ADMIN
        ---------------------------------------------------------

        Admin menggunakan Google Login.
        Password admin dikosongkan.
        */

        if ($validated['role'] === 'admin') {
            $akun->password = null;
        }


        /*
        ---------------------------------------------------------
        MASYARAKAT / OPD
        ---------------------------------------------------------

        Password hanya diubah apabila admin
        memasukkan password baru.
        */

        if (
            $validated['role'] !== 'admin'
            && !empty($validated['password'])
        ) {
            $akun->password = $validated['password'];
        }


        $akun->save();


        return redirect()
            ->route('admin.akun.index')
            ->with(
                'success',
                'Akun berhasil diperbarui.'
            );
    }


    public function delete(int $id_user)
    {
        $akun = User::findOrFail($id_user);


        /*
        ---------------------------------------------------------
        CEGAH ADMIN MENGHAPUS AKUN SENDIRI
        ---------------------------------------------------------
        */

        if ($akun->id_user === Auth::id()) {

            return redirect()
                ->route('admin.akun.index')
                ->with(
                    'error',
                    'Akun yang sedang digunakan tidak dapat dihapus.'
                );
        }


        /*
        ---------------------------------------------------------
        CEGAH PENGHAPUSAN USER YANG MEMILIKI LAPORAN
        ---------------------------------------------------------
        */

        if ($akun->laporan()->exists()) {

            return redirect()
                ->route('admin.akun.index')
                ->with(
                    'error',
                    'Akun tidak dapat dihapus karena masih memiliki laporan.'
                );
        }


        $akun->delete();


        return redirect()
            ->route('admin.akun.index')
            ->with(
                'success',
                'Akun berhasil dihapus.'
            );
    }
}