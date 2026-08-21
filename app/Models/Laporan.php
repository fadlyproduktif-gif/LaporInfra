<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'id_user',
    'nama_laporan',
    'deskripsi',
    'lokasi',
    'foto_lokasi',
    'status_laporan',
    'keterangan proggress',
    'id_kategori',
])]

class Laporan extends Model
{
    protected  $table = 'laporan';
    protected $primarykey = 'id_laporan';

    public function users():BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function kategori():BelongsTo
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }

}
