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
        /*
        |--------------------------------------------------------------------------
        | Tabel Data Sasaran
        |--------------------------------------------------------------------------
        */
        Schema::create('target_data', function (Blueprint $table) {
            $table->id();

            // Nama desa
            $table->string('village_name')->index();

            // Jumlah penduduk
            $table->unsignedInteger('population_count')->default(0);

            // Jumlah keluarga / rumah tangga
            $table->unsignedInteger('family_count')->default(0);

            // Jumlah remaja putri (10-24 tahun)
            $table->unsignedInteger('young_female_count')->default(0);

            // Jumlah anak (0-17 tahun)
            $table->unsignedInteger('children_count')->default(0);

            $table->timestamps();

            // Mencegah duplikasi data untuk desa yang sama
            $table->unique('village_name');
        });

        /*
        |--------------------------------------------------------------------------
        | Tabel Data Pendukung
        |--------------------------------------------------------------------------
        */
        Schema::create('support_data', function (Blueprint $table) {
            $table->id();

            // Nama desa
            $table->string('village_name')->index();

            // Jumlah lembaga PAUD
            $table->unsignedInteger('paud_institution_count')->default(0);

            // Jumlah SMP / MTs
            $table->unsignedInteger('smp_mts_count')->default(0);

            // Jumlah SMA / MA
            $table->unsignedInteger('sma_ma_count')->default(0);

            // Jumlah guru PAUD
            $table->unsignedInteger('paud_teacher_count')->default(0);

            $table->timestamps();

            // Satu data pendukung untuk setiap desa
            $table->unique('village_name');
        });
    }

    /**
     * Batalkan migration.
     */
    public function down(): void
    {
        Schema::dropIfExists('support_data');
        Schema::dropIfExists('target_data');
    }
};