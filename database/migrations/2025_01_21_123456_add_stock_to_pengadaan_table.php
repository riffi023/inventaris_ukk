<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('tbl_pengadaan', function (Blueprint $table) {
            $table->integer('stock_barang')->default(0)->after('nilai_barang');
        });
    }

    public function down()
    {
        Schema::table('tbl_pengadaan', function (Blueprint $table) {
            $table->dropColumn('stock_barang');
        });
    }
};