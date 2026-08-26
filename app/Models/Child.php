<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Child extends Model
{
    use HasFactory;

    /**
     * Nama tabel database.
     */
    protected $table = 'children';

    /**
     * Kolom yang dapat diisi melalui mass assignment.
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
     * Casting tipe data.
     */
    protected $casts = [
        'birth_date' => 'date',
    ];

    /**
     * Relasi ke orang tua / wali.
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'parent_id'
        );
    }

    /**
     * Relasi ke Posyandu.
     */
    public function posyandu(): BelongsTo
    {
        return $this->belongsTo(
            Posyandu::class,
            'posyandu_id'
        );
    }

    /**
     * Relasi ke data pengukuran.
     *
     * Satu anak dapat memiliki banyak
     * riwayat pengukuran.
     */
    public function measurements(): HasMany
    {
        return $this->hasMany(
            Measurement::class,
            'child_id'
        )->latest('measurement_date');
    }
}