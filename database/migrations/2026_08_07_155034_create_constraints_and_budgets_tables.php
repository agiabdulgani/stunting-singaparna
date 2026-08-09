<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Tabel 1: Identifikasi Kendala
        Schema::create('constraints', function (Blueprint $table) {
            $table->id();
            $table->string('scope'); // Ruang Lingkup
            $table->text('problem'); // Permasalahan
            $table->text('cause'); // Penyebab Masalah
            $table->text('recommendation'); // Rekomendasi
            $table->string('assessment'); // Penilaian
            $table->decimal('budget_needed', 15, 2)->default(0); // Kebutuhan Anggaran
            $table->string('location_plan'); // Rencana Lokasi Kegiatan
            $table->timestamps();
        });

        // Tabel 2: Penyediaan Anggaran
        Schema::create('budgets', function (Blueprint $table) {
            $table->id();
            $table->string('indicator_id'); // ID Indikator
            $table->string('indicator_name'); // Indikator
            $table->text('activity_description'); // Uraian Kegiatan
            $table->decimal('amount', 15, 2)->default(0); // Jumlah (Rp)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('constraints');
        Schema::dropIfExists('budgets');
    }
};