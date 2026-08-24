<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'nama_devisi',
])]

class Devisi extends Model
{
    protected $table = "devisi";
    protected $primaryKey = "id_devisi";

    public function kategori(): HasMany
    {
        return $this->hasMany(
            Kategori::class,
            'id_devisi',
            'id_devisi'
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
