<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportData extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang terhubung dengan model.
     */
    protected $table = 'support_data';

    protected $fillable = [
        'village_name',
        'paud_institution_count',
        'smp_mts_count',
        'sma_ma_count',
        'paud_teacher_count',
    ];

    protected $casts = [
        'paud_institution_count' => 'integer',
        'smp_mts_count'          => 'integer',
        'sma_ma_count'            => 'integer',
        'paud_teacher_count'     => 'integer',
    ];
}