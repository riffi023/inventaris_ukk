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
        // Tabel Kategori Asset
        Schema::create('tbl_kategori_asset', function (Blueprint $table) {
            $table->id('id_kategori_asset');
            $table->string('kode_kategori_asset', 20);
            $table->string('kategori_asset', 25);
            $table->timestamps();
        });

        // Tabel Master Barang
        Schema::create('tbl_master_barang', function (Blueprint $table) {
            $table->id('id_master_barang');
            $table->string('kode_barang', 20);
            $table->string('nama_barang', 100);
            $table->string('spesifikasi_teknis', 100);
            $table->timestamps();
        });

        // Tabel Sub Kategori Asset
        Schema::create('tbl_sub_kategori_asset', function (Blueprint $table) {
            $table->id('id_sub_kategori_asset');
            $table->foreignId('id_kategori_asset')->constrained('tbl_kategori_asset', 'id_kategori_asset')->cascadeOnDelete();
            $table->string('kode_sub_kategori_asset', 20);
            $table->string('sub_kategori_asset', 25);
            $table->timestamps();
        });

        // Tabel Merk
        Schema::create('tbl_merk', function (Blueprint $table) {
            $table->id('id_merk');
            $table->string('merk', 50);
            $table->string('keterangan', 500);
            $table->timestamps();
        });

        // Tabel Satuan
        Schema::create('tbl_satuan', function (Blueprint $table) {
            $table->id('id_satuan');
            $table->string('satuan', 200);
            $table->timestamps();
        });

        // Tabel Distributor
        Schema::create('tbl_distributor', function (Blueprint $table) {
            $table->id('id_distributor');
            $table->string('nama_distributor', 500);
            $table->string('alamat', 50);
            $table->string('no_telp', 15);
            $table->string('email', 30);
            $table->string('keterangan', 45);
            $table->timestamps();
        });

        // Tabel Depresiasi
        Schema::create('tbl_depresiasi', function (Blueprint $table) {
            $table->id('id_depresiasi');
            $table->integer('lama_depresiasi')->comment('Dalam bulan');
            $table->decimal('nilai_penyusutan', 15, 2)->default(0)->nullable();
            $table->string('keterangan', 100);
            $table->timestamps();
        });

        // Tabel Lokasi
        Schema::create('tbl_lokasi', function (Blueprint $table) {
            $table->id('id_lokasi');
            $table->string('kode_lokasi', 20);
            $table->string('nama_lokasi', 200);
            $table->string('keterangan', 50);
            $table->timestamps();
        });

        // Menambahkan kolom 'type' pada tabel Users
        Schema::table('users', function (Blueprint $table) {
            $table->tinyInteger('type')->default(0); // Users: 0=>User, 1=>Admin, 2=>Manager
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Hapus tabel sesuai urutan relasi untuk menghindari error
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('type');
        });

        Schema::dropIfExists('tbl_lokasi');
        Schema::dropIfExists('tbl_depresiasi');
        Schema::dropIfExists('tbl_distributor');
        Schema::dropIfExists('tbl_satuan');
        Schema::dropIfExists('tbl_merk');
        Schema::dropIfExists('tbl_sub_kategori_asset');
        Schema::dropIfExists('tbl_master_barang');
        Schema::dropIfExists('tbl_kategori_asset');
    }
};
