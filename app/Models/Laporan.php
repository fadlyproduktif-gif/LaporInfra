<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\StatusLaporan;
use App\Models\HistoryLaporan;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'id_user',
    'nama_laporan',
    'deskripsi',
    'lokasi',
    'latitude',
    'longitude',
    'foto_lokasi',
    'id_status',
    'keterangan_proggress',
    'foto_progress',
    'id_kategori',
])]

class Laporan extends Model
{
    protected  $table = 'laporan';
    protected $primaryKey = 'id_laporan';

    public function user(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'id_user',
            'id_user',
        );
    }

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(
            Kategori::class,
            'id_kategori',
            'id_kategori',
        );
    }

    public function statusLaporan(): BelongsTo
    {
        return $this->belongsTo(
            StatusLaporan::class,
            'id_status',
            'id_status',
        );
    }

    public function history(): HasMany
    {
        return $this->hasMany(
            HistoryLaporan::class,
            'id_laporan',
            'id_laporan',
        );
    }
}
