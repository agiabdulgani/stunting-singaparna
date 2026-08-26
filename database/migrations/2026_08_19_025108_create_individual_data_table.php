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
        Schema::create('individual_data', function (Blueprint $table) {
            $table->id();

            // Wilayah
            $table->string('nama_desa');

            // Data individu
            $table->string('nama_anak');
            $table->unsignedInteger('umur_bulan')->default(0);

            // Data antropometri
            $table->decimal('tinggi_badan', 5, 2)->default(0);
            $table->decimal('berat_badan', 5, 2)->default(0);

            // Alamat
            $table->text('alamat')->nullable();

            $table->timestamps();

            // Index untuk pencarian/filter berdasarkan desa
            $table->index('nama_desa');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('individual_data');
    }
};