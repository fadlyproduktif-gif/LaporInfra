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
    public function index(){
        $user = Auth::User();
        $kategori = Kategori::latest()->get();
        $devisi = Devisi::all();
        foreach($kategori as $item){
            dump($item->nama_kategori);
        }

        return view('admin.pages.kategori.index', 
        compact(
            'user',
            'kategori',
            'devisi',
        )
        );
    }

    public function create(){

    }

    public function update(){

    }

    public function delete(){

    }
}
