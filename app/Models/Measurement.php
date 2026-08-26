<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Measurement extends Model
{
    use HasFactory;

    /**
     * Nama tabel database.
     */
    protected $table = 'measurements';

    /**
     * Kolom yang dapat diisi melalui mass assignment.
     */
    protected $fillable = [
        'child_id',
        'recorded_by',
        'measurement_date',
        'age_in_months',
        'height',
        'weight',
        'head_circumference',
        'z_score_tb_u',
        'stunting_status',
    ];

    /**
     * Casting tipe data.
     */
    protected $casts = [
        'measurement_date' => 'date',

        'age_in_months' => 'integer',

        'height' => 'float',

        'weight' => 'float',

        'head_circumference' => 'float',

        'z_score_tb_u' => 'float',
    ];

    /**
     * Relasi ke anak.
     *
     * Satu pengukuran dimiliki oleh satu anak.
     */
    public function child(): BelongsTo
    {
        return $this->belongsTo(
            Child::class,
            'child_id'
        );
    }

    /**
     * Relasi ke user yang mencatat pengukuran.
     */
    public function recorder(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'recorded_by'
        );
    }
}