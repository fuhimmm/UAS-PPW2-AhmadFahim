<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('pekerjaan', function (Blueprint $table) {
            $table->integer('jumlah_pegawai')->default(0)->after('deskripsi');
        });
    }

    public function down()
    {
        Schema::table('pekerjaan', function (Blueprint $table) {
            $table->dropColumn('jumlah_pegawai');
        });
    }
};
