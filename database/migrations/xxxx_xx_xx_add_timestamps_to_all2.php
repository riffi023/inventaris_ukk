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
            $table->integer('stock_barang')->default(0); // Added stock_barang column
            $table->decimal('depresiasi_barang', 15, 2)->default(0);
            $table->enum('status_login',['0','1']);
            $table->string('keterangan',50);
            $table->timestamps();
        });

        Schema::create('tbl_opname', function (Blueprint $table) {
            $table->id('id_opname');
            $table->foreignId('id_pengadaan')->constrained('tbl_pengadaan','id_pengadaan')->cascadeOnDelete();
            $table->string('tgl_opname',45);
            $table->string('kondisi',45);
            $table->string('keterangan',100);
            $table->integer('stock_update')->nullable();
            $table->timestamps();
        });

        Schema::create('tbl_mutasi_lokasi', function (Blueprint $table) {
            $table->id('id_mutasi_lokasi');
            $table->foreignId('id_lokasi')->constrained('tbl_lokasi','id_lokasi')->cascadeOnDelete();
            $table->foreignId('id_pengadaan')->constrained('tbl_pengadaan','id_pengadaan')->cascadeOnDelete();
            $table->string('flag_lokasi');
            $table->string('flag_pindah');
            $table->timestamps();
        });

        Schema::create('tbl_hitung_depresiasi', function (Blueprint $table) {
            $table->id('id_hitung_depresiasi');
            $table->foreignId('id_pengadaan')->constrained('tbl_pengadaan','id_pengadaan')->cascadeOnDelete();
            $table->date('tgl_hitung_depresiasi');
            $table->string('bulan', 10);
            $table->string('durasi'); // dalam bulan
            $table->string('nilai_barang');
            $table->decimal('depresiasi_barang', 15, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_hitung_depresiasi');
        Schema::dropIfExists('tbl_mutasi_lokasi');
        Schema::dropIfExists('tbl_opname');
        Schema::dropIfExists('tbl_pengadaan');
    }
};
