<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Posyandu extends Model
{
    use HasFactory;

    /**
     * Nama tabel database.
     */
    protected $table = 'posyandus';

    /**
     * Kolom yang dapat diisi melalui mass assignment.
     */
    protected $fillable = [
        'name',
        'address',
    ];

    /**
     * Relasi ke data anak.
     *
     * Satu Posyandu dapat memiliki banyak anak.
     */
    public function children(): HasMany
    {
        return $this->hasMany(
            Child::class,
            'posyandu_id'
        );
    }
}