<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HistoryLaporan extends Model
{
    protected $table = 'history_laporan';
    protected $primaryKey = 'id_history';

    protected $fillable = [
        'id_laporan',
        'id_user_pengubah',
        'id_status',
        'keterangan_proggress',
        'history_foto',
    ];

    public function laporan(): BelongsTo
    {
        return $this->belongsTo(
            Laporan::class,
            'id_laporan',
            'id_laporan',
        );
    }

    public function userPengubah(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'id_user_pengubah',
            'id_user',
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
}