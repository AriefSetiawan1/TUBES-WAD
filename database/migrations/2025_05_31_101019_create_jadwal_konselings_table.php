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
        Schema::create('jadwal_konselings', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('konselor_id');
        $table->date('tanggal');
        $table->time('jam');
        $table->enum('status', ['tersedia', 'dipesan'])->default('tersedia');
        $table->timestamps();

        $table->foreign('konselor_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_konselings');
    }
};
