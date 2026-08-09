<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TargetData extends Model
{
    use HasFactory;

    protected $table = 'target_data';

    protected $fillable = [
        'village_name',
        'population_count',
        'family_count',
        'young_female_count',
        'children_count',
    ];

    protected $casts = [
        'population_count'   => 'integer',
        'family_count'       => 'integer',
        'young_female_count' => 'integer',
        'children_count'     => 'integer',
    ];
}