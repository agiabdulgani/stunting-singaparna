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
        Schema::create('personal_access_tokens', function (Blueprint $table) {
            $table->id();

            // Relasi polymorphic ke User atau model lain
            $table->morphs('tokenable');

            // Nama token
            $table->string('name');

            // Token Sanctum
            $table->string('token', 64)->unique();

            // Hak akses token
            $table->text('abilities')->nullable();

            // Waktu terakhir token digunakan
            $table->timestamp('last_used_at')->nullable();

            // Waktu token kadaluarsa
            $table->timestamp('expires_at')
                ->nullable()
                ->index();

            $table->timestamps();
        });
    }

    /**
     * Batalkan migration.
     */
    public function down(): void
    {
        Schema::dropIfExists('personal_access_tokens');
    }
};