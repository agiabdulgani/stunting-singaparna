<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migration untuk membuat tabel service_data.
     */
    public function up(): void
    {
        Schema::create('service_data', function (Blueprint $table) {
            $table->id();
            $table->string('village_name');
            $table->integer('birth_kia_count')->default(0);
            $table->integer('food_program_count')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Batalkan migration (hapus tabel).
     */
    public function down(): void
    {
        Schema::dropIfExists('service_data');
    }
};