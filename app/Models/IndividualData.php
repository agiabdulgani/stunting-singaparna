<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndividualData extends Model
{
    use HasFactory;

    /**
     * Nama tabel database.
     */
    protected $table = 'individual_data';

    /**
     * Kolom yang boleh diisi melalui mass assignment.
     *
     * Tambahkan nama kolom sesuai migration individual_data.
     */
    protected $fillable = [
        // Contoh:
        // 'nama',
        // 'nik',
        // 'jenis_kelamin',
        // 'tanggal_lahir',
        // 'alamat',
    ];
}