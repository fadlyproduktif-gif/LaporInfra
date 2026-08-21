<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Devisi;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'nama_kategori',
    'id_devisi',
])]

class Kategori extends Model
{
    protected $table = "kategori";
    protected $primaryKey = "id_kategori";

    public function devisi(): BelongsTo
    {
     return $this->belongsTo(Devisi::class, 'id_devisi', 'id_devisi');
    }

     public function laporan():HasMany
    {
        return $this->hasMany(Laporan::class, 'id_kategori', 'id_kategori');
    }

}

