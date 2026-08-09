<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posyandu extends Model
{
    use HasFactory;

    protected $table = 'posyandus';

    protected $fillable = [
        'name',
        'address',
    ];

    /**
     * Relasi ke model Child (Anak)
     */
    public function children()
    {
        return $this->hasMany(Child::class);
    }
}