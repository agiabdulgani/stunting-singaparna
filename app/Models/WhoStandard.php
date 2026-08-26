<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhoStandard extends Model
{
    use HasFactory;

    /**
     * Nama tabel database.
     */
    protected $table = 'who_standards';

    /**
     * Kolom yang dapat diisi melalui mass assignment.
     *
     * Sesuaikan dengan struktur tabel WHO kamu.
     */
    protected $fillable = [
        'gender',
        'age_in_months',
        'l',
        'm',
        's',
    ];

    /**
     * Casting tipe data.
     */
    protected $casts = [
        'age_in_months' => 'integer',
        'l' => 'float',
        'm' => 'float',
        's' => 'float',
    ];
}