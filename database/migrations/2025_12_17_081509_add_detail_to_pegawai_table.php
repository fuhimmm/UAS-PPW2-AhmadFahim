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
        Schema::table('pegawai', function (Blueprint $table) {
            // Menambahkan kolom baru setelah kolom email
            $table->string('nomor_telepon')->nullable()->after('email');
            $table->text('alamat')->nullable()->after('nomor_telepon');
        });
    }

    public function down(): void
    {
        Schema::table('pegawai', function (Blueprint $table) {
            // Hapus kolom jika rollback
            $table->dropColumn(['nomor_telepon', 'alamat']);
        });
    }
};
