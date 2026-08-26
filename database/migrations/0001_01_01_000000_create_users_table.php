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
        | Users
        |--------------------------------------------------------------------------
        */
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            // Data pengguna
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();

            // Password
            $table->string('password');

            // Hak akses pengguna
            $table->string('role')->default('user')->index();

            // Wilayah/desa pengguna
            $table->string('wilayah')->nullable()->index();

            // Remember login
            $table->rememberToken();

            // created_at dan updated_at
            $table->timestamps();
        });

        /*
        |--------------------------------------------------------------------------
        | Password Reset Tokens
        |--------------------------------------------------------------------------
        */
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        /*
        |--------------------------------------------------------------------------
        | Sessions
        |--------------------------------------------------------------------------
        */
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();

            $table->foreignId('user_id')
                ->nullable()
                ->index();

            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Membatalkan migration.
     */
    public function down(): void
    {
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('users');
    }
};