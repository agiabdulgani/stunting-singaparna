<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migration.
     */
    public function up(): void
    {
        Schema::create('children', function (Blueprint $table) {
            $table->id();

            /*
            |--------------------------------------------------------------------------
            | Relasi Orang Tua
            |--------------------------------------------------------------------------
            */
            $table->foreignId('parent_id')
                ->constrained('users')
                ->cascadeOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Relasi Posyandu
            |--------------------------------------------------------------------------
            */
            $table->foreignId('posyandu_id')
                ->constrained('posyandus')
                ->cascadeOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Data Anak
            |--------------------------------------------------------------------------
            */
            $table->string('nik', 16)->unique();

            $table->string('name');

            $table->enum('gender', [
                'L',
                'P',
            ]);

            $table->date('birth_date');

            $table->timestamps();

            /*
            |--------------------------------------------------------------------------
            | Index
            |--------------------------------------------------------------------------
            */
            $table->index('parent_id');
            $table->index('posyandu_id');
            $table->index('birth_date');
        });
    }

    /**
     * Batalkan migration.
     */
    public function down(): void
    {
        Schema::dropIfExists('children');
    }
};