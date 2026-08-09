<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mbg_data', function (Blueprint $table) {
            $table->id();
            $table->string('nama_desa');
            $table->integer('penerima_balita')->default(0);
            $table->integer('penerima_bumil')->default(0);
            $table->integer('penerima_paud')->default(0);
            $table->integer('porsi_terdistribusi_harian')->default(0);
            $table->enum('status_layanan', ['Lancar', 'Kendala Distribusi', 'Perlu Evaluasi'])->default('Lancar');
            $table->text('catatan_dapur')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mbg_data');
    }
};