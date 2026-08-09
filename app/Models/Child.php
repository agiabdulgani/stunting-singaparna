<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Child extends Model
{
    use HasFactory;

    /**
     * Nama tabel di database
     *
     * @var string
     */
    protected $table = 'children';

    /**
     * Kolom yang dapat diisi secara mass-assignment
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'parent_id',
        'posyandu_id',
        'nik',
        'name',
        'gender',
        'birth_date',
    ];

    /**
     * Casting tipe data otomatis
     *
     * @var array<string, string>
     */
    protected $casts = [
        'birth_date' => 'date',
    ];

    /**
     * Relasi ke Orang Tua (User)
     */
    public function parent()
    {
        return $this->belongsTo(User::class, 'parent_id');
    }

    /**
     * Relasi ke Posyandu
     */
    public function posyandu()
    {
        return $this->belongsTo(Posyandu::class, 'posyandu_id');
    }
}