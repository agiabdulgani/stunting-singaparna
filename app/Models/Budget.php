<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    use HasFactory;

    protected $table = 'budgets';

    protected $fillable = [
        'village_name',        // <-- Tambahkan ini
        'indicator_id',
        'indicator_name',
        'activity_description',
        'amount',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
    ];
}