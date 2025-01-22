<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('tbl_hitung_depresiasi', function (Blueprint $table) {
            $table->id('id_hitung_depresiasi');
            $table->foreignId('id_pengadaan')->constrained('tbl_pengadaan','id_pengadaan')->cascadeOnDelete();
            $table->date('tgl_hitung_depresiasi');
            $table->string('bulan', 10);
            $table->string('durasi'); // dalam bulan
            $table->string('nilai_barang');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tbl_hitung_depresiasi');
    }
};