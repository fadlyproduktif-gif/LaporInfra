<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriDevisi extends Model
{
    protected $table = 'kategori_devisi';
    protected $primaryKey = 'id_kategori_devisi';

    protected $fillable = [
        'id_kategori',
        'id_devisi',
    ];
}