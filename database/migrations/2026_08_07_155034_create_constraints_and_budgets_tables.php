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
        | Tabel Identifikasi Kendala
        |--------------------------------------------------------------------------
        */
        Schema::create('constraints', function (Blueprint $table) {
            $table->id();

            // Ruang lingkup kendala
            $table->string('scope')->index();

            // Permasalahan
            $table->text('problem');

            // Penyebab masalah
            $table->text('cause');

            // Rekomendasi
            $table->text('recommendation');

            // Penilaian
            $table->string('assessment');

            // Kebutuhan anggaran
            $table->decimal('budget_needed', 15, 2)->default(0);

            // Rencana lokasi kegiatan
            $table->string('location_plan')->index();

            $table->timestamps();
        });

        /*
        |--------------------------------------------------------------------------
        | Tabel Penyediaan Anggaran
        |--------------------------------------------------------------------------
        */
        Schema::create('budgets', function (Blueprint $table) {
            $table->id();

            // ID indikator
            $table->string('indicator_id')->index();

            // Nama indikator
            $table->string('indicator_name');

            // Uraian kegiatan
            $table->text('activity_description');

            // Jumlah anggaran dalam Rupiah
            $table->decimal('amount', 15, 2)->default(0);

            $table->timestamps();
        });
    }

    /**
     * Batalkan migration.
     */
    public function down(): void
    {
        Schema::dropIfExists('budgets');
        Schema::dropIfExists('constraints');
    }
};