<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'nama_status',
])]

class StatusLaporan extends Model
{
    protected $table = "status_laporan";
    protected $primaryKey = 'id_status';

    public function laporan(): HasMany
    {
        return $this->hasMany(
            Laporan::class,
            'id_status',
            'id_status',
        );
    }
}
