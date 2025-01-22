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
        Schema::create('tbl_mutasi_lokasi', function (Blueprint $table) {
            $table->id('id_mutasi_lokasi');
            $table->foreignId('id_lokasi')->constrained('tbl_lokasi','id_lokasi')->cascadeOnDelete();
            $table->foreignId('id_pengadaan')->constrained('tbl_pengadaan','id_pengadaan')->cascadeOnDelete();
            $table->string('flag_lokasi');
            $table->string('flag_pindah');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_mutasi_lokasi');
    }
};
