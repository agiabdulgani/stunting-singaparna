<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tabel Data Sasaran
        Schema::create('target_data', function (Blueprint $table) {
            $table->id();
            $table->string('village_name'); // Nama Desa
            $table->integer('population_count')->default(0); // Jml Penduduk
            $table->integer('family_count')->default(0); // Jml Keluarga / RT
            $table->integer('young_female_count')->default(0); // Jml Remaja Putri (10-24 Th)
            $table->integer('children_count')->default(0); // Anak Umur 0-17 Th
            $table->timestamps();
        });

        // Tabel Data Pendukung
        Schema::create('support_data', function (Blueprint $table) {
            $table->id();
            $table->string('village_name'); // Nama Desa
            $table->integer('paud_institution_count')->default(0); // Jml Lembaga PAUD
            $table->integer('smp_mts_count')->default(0); // Jml SMP / MTs
            $table->integer('sma_ma_count')->default(0); // Jml SMA / MA
            $table->integer('paud_teacher_count')->default(0); // Jml Guru PAUD
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('support_data');
        Schema::dropIfExists('target_data');
    }
};