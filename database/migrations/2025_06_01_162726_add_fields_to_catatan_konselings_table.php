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
        Schema::table('catatan_konselings', function (Blueprint $table) {
            $table->string('penyakit')->after('isi');
            $table->string('nama_dokter')->after('penyakit');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('catatan_konselings', function (Blueprint $table) {
            $table->dropColumn(['penyakit', 'nama_dokter']);
        });
    }
};
