<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MbgData extends Model
{
    use HasFactory;

    protected $table = 'mbg_data';

    protected $fillable = [
        'nama_desa',
        'penerima_balita',
        'penerima_bumil',
        'penerima_paud',
        'porsi_terdistribusi_harian',
        'status_layanan',
        'catatan_dapur',
    ];
}