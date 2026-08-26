<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Kolom yang dapat diisi melalui mass assignment.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'wilayah',
    ];

    /**
     * Kolom yang disembunyikan ketika model
     * diubah menjadi JSON.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Casting tipe data.
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Relasi ke data anak.
     *
     * Satu user dapat menjadi orang tua/wali
     * dari banyak anak.
     */
    public function children(): HasMany
    {
        return $this->hasMany(
            Child::class,
            'parent_id'
        );
    }

    /**
     * Relasi ke data pengukuran yang dicatat user.
     *
     * Satu user dapat mencatat banyak pengukuran.
     */
    public function measurements(): HasMany
    {
        return $this->hasMany(
            Measurement::class,
            'recorded_by'
        );
    }
}