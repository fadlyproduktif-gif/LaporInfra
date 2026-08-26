<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable([
    'nip',
    'nama_user',
    'email',
    'password',
    'google_id',
    'role',
    'id_devisi'
])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;
    protected $table = 'users';
    protected $primaryKey = 'id_user';

    public function devisi(): BelongsTo
    {
        return $this->belongsTo(
            Devisi::class, 
            'id_devisi', 
            'id_devisi',
            );
    }

    public function laporan(): HasMany
    {
        return $this->hasMany(
            Laporan::class, 
            'id_user', 
            'id_user',
            );
    }

    


    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
