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
        Schema::create('tbl_sub_kategori_asset', function (Blueprint $table) {
            $table->id('id_sub_kategori_asset');
            $table->foreignId('id_kategori_asset')->constrained('tbl_kategori_asset','id_kategori_asset')->cascadeOnDelete();
            $table->string('kode_sub_kategori_asset', 20);
            $table->string('sub_kategori_asset',25);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_sub_kategori_asset');
    }
};
