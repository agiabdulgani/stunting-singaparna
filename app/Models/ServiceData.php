<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceData extends Model
{
    use HasFactory;

    /**
     * Nama tabel database.
     */
    protected $table = 'service_data';

    /**
     * Kolom yang dapat diisi melalui mass assignment.
     */
    protected $fillable = [
        'village_name',
        'birth_kia_count',
        'food_program_count',
    ];

    /**
     * Casting tipe data.
     */
    protected $casts = [
        'birth_kia_count' => 'integer',
        'food_program_count' => 'integer',
    ];
}