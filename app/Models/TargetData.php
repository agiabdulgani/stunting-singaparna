<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TargetData extends Model
{
    use HasFactory;

    /**
     * Nama tabel database.
     */
    protected $table = 'target_data';

    /**
     * Kolom yang dapat diisi melalui mass assignment.
     */
    protected $fillable = [
        'village_name',
        'population_count',
        'family_count',
        'young_female_count',
        'children_count',
    ];

    /**
     * Casting tipe data.
     */
    protected $casts = [
        'population_count' => 'integer',
        'family_count' => 'integer',
        'young_female_count' => 'integer',
        'children_count' => 'integer',
    ];
}