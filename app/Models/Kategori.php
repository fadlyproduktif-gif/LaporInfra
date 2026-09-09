<?php

namespace App\Models;

use App\Models\Devisi;
use App\Models\Laporan;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'nama_kategori',
])]

class Kategori extends Model
{
    protected $table = 'kategori';
    protected $primaryKey = 'id_kategori';

    public function devisi(): BelongsToMany
    {
        return $this->belongsToMany(
            Devisi::class,
            'kategori_devisi',
            'id_kategori',
            'id_devisi',
            'id_kategori',
            'id_devisi',
        );
    }

    public function laporan(): HasMany
    {
        return $this->hasMany(
            Laporan::class,
            'id_kategori',
            'id_kategori',
        );
    }
}