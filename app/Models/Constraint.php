<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Constraint
 *
 * @property int $id
 * @property string $village_name
 * @property string $scope
 * @property string $problem
 * @property string $cause
 * @property string $recommendation
 * @property string $assessment
 * @property float $budget_needed
 * @property string $location_plan
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
class Constraint extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang terhubung dengan model.
     *
     * @var string
     */
    protected $table = 'constraints';

    /**
     * Atribut yang dapat diisi secara masal (mass assignable).
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'village_name',
        'scope',
        'problem',
        'cause',
        'recommendation',
        'assessment',
        'budget_needed',
        'location_plan',
        'description',
    ];

    /**
     * Tipe data asal (type casting) untuk atribut model.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'budget_needed' => 'float',
    ];
}