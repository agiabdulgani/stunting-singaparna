<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Password default yang digunakan factory.
     */
    protected static ?string $password = null;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),

            'email' => fake()->unique()->safeEmail(),

            'email_verified_at' => now(),

            'password' => static::$password ??= Hash::make('password'),

            'remember_token' => Str::random(10),

            /*
            |--------------------------------------------------------------------------
            | Role User
            |--------------------------------------------------------------------------
            |
            | Sesuaikan dengan role yang digunakan di aplikasi.
            |
            */
            'role' => fake()->randomElement([
                'admin',
                'operator_desa',
                'kader',
                'orang_tua',
            ]),

            /*
            |--------------------------------------------------------------------------
            | Wilayah
            |--------------------------------------------------------------------------
            */
            'wilayah' => fake()->randomElement([
                'Singaparna',
                'Tasikmalaya',
            ]),
        ];
    }

    /**
     * User tanpa verifikasi email.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    /**
     * User sebagai admin.
     */
    public function admin(): static
    {
        return $this->state(fn (array $attributes) => [
            'role' => 'admin',
        ]);
    }

    /**
     * User sebagai operator desa.
     */
    public function operatorDesa(): static
    {
        return $this->state(fn (array $attributes) => [
            'role' => 'operator_desa',
        ]);
    }

    /**
     * User sebagai kader.
     */
    public function kader(): static
    {
        return $this->state(fn (array $attributes) => [
            'role' => 'kader',
        ]);
    }

    /**
     * User sebagai orang tua.
     */
    public function orangTua(): static
    {
        return $this->state(fn (array $attributes) => [
            'role' => 'orang_tua',
        ]);
    }
}