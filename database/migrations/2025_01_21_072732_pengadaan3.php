<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('tbl_pengadaan', function (Blueprint $table) {
            $table->decimal('depresiasi_barang', 15, 2)->default(0)->after('nilai_barang');
        });
    }

    public function down()
    {
        Schema::table('tbl_pengadaan', function (Blueprint $table) {
            $table->dropColumn('depresiasi_barang');
        });
    }
};