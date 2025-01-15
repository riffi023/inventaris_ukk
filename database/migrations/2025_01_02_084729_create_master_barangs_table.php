<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tbl_master_barang', function (Blueprint $table) {
            $table->id('id_master_barang');
            $table->string('kode_barang', 20);
            $table->string('nama_barang', 100);
            $table->string('spesifikasi_teknis', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_master_barang');
    }
};
