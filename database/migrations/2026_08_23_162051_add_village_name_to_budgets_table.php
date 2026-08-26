<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi.
     *
     * Aman dijalankan meskipun kolom 'role' sudah pernah ada
     * (misalnya dari migrasi sebelumnya untuk operator_desa),
     * karena dicek dulu dengan Schema::hasColumn.
     */
    public function up(): void
    {
        if (!Schema::hasColumn('users', 'role')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('role')->default('kader')->after('email');
            });
        }

        if (!Schema::hasColumn('users', 'wilayah')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('wilayah')->nullable()->after('role');
            });
        }
    }

    /**
     * Batalkan migrasi.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'role')) {
                $table->dropColumn('role');
            }

            if (Schema::hasColumn('users', 'wilayah')) {
                $table->dropColumn('wilayah');
            }
        });
    }
};