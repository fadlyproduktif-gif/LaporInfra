<?php

namespace App\Models;

use App\Models\Kategori;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'nama_devisi',
])]

class Devisi extends Model
{
    protected $table = 'devisi';
    protected $primaryKey = 'id_devisi';

    public function kategori(): BelongsToMany
    {
        return $this->belongsToMany(
            Kategori::class,
            'kategori_devisi',
            'id_devisi',
            'id_kategori',
            'id_devisi',
            'id_kategori',
        );
    }

    public function user(): HasMany
    {
        return $this->hasMany(
            User::class,
            'id_devisi',
            'id_devisi'
        );
    }
}