<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Budget
 *
 * @property int $id
 * @property string $indicator_id
 * @property string $indicator_name
 * @property string $activity_description
 * @property float $amount
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
class Budget extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang terhubung dengan model.
     *
     * @var string
     */
    protected $table = 'budgets';

    /**
     * Atribut yang dapat diisi secara masal (mass assignable).
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'indicator_id',
        'indicator_name',
        'activity_description',
        'amount',
    ];

    /**
     * Tipe data asal (type casting) untuk atribut model.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'amount' => 'float',
    ];
}