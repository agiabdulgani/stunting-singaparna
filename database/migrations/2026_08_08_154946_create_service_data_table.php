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

            // Nama desa
            $table->string('village_name')->index();

            // Jumlah layanan kelahiran / KIA
            $table->unsignedInteger('birth_kia_count')->default(0);

            // Jumlah penerima program makanan
            $table->unsignedInteger('food_program_count')->default(0);

            $table->timestamps();

            // Satu data layanan untuk setiap desa
            $table->unique('village_name');
        });
    }

    /**
     * Batalkan migration.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_data');
    }
};