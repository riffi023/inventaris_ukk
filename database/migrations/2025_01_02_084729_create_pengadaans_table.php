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
        Schema::create('tbl_pengadaan', function (Blueprint $table) {
            $table->id('id_pengadaan');
            $table->foreignId('id_master_barang')->constrained('tbl_master_barang','id_master_barang')->cascadeOnDelete();
            $table->foreignId('id_depresiasi')->constrained('tbl_depresiasi','id_depresiasi')->cascadeOnDelete();
            $table->foreignId('id_merk')->constrained('tbl_merk','id_merk')->cascadeOnDelete();
            $table->foreignId('id_satuan')->constrained('tbl_satuan','id_satuan')->cascadeOnDelete();
            $table->foreignId('id_sub_kategori_asset')->constrained('tbl_sub_kategori_asset','id_sub_kategori_asset')->cascadeOnDelete();
            $table->foreignId('id_distributor')->constrained('tbl_distributor','id_distributor')->cascadeOnDelete();
            $table->string('kode_pengadaan',20);
            $table->string('no_invoice',20);
            $table->string('no_seri_barang',50);
            $table->string('tahun_produksi',5);
            $table->date('tgl_pengadaan');
            $table->string('harga_barang');
            $table->string('nilai_barang');
            $table->enum('status_login',['0','1']);
            $table->string('keterangan',50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_pengadaan');
    }
};
