<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tbl_requests', function (Blueprint $table) {
            $table->id('id_request');
            $table->foreignId('id_opname')->constrained('tbl_opname')->onDelete('cascade');
            $table->integer('stock_update');
            $table->string('status')->default('pending'); // Status bisa 'pending', 'approved', 'rejected'
            $table->string('keterangan')->nullable();
            $table->string('nama_pegawai');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tbl_requests');
    }
};
