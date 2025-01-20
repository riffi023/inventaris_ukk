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
        Schema::create('tbl_depresiasi', function (Blueprint $table) {
            $table->id('id_depresiasi');
            $table->integer('lama_depresiasi')->comment('Dalam bulan');
            $table->decimal('nilai_penyusutan', 15, 2)->default(0);
            $table->string('keterangan', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_depresiasi');
    }
};

