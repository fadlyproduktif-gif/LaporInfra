<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Devisi;

class Kategori extends Model
{
    protected $table = "kategori";
    protected $primaryKey = "id_kategori";

    public function devisi(): BelongsTo
    {
     return $this->belongsTo(Devisi::class, 'id_devisi', 'id_devisi');
    }
}
