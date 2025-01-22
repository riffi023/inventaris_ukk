<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('tbl_opname', function (Blueprint $table) {
            $table->integer('stock_update')->nullable()->after('keterangan');
        });
    }

    public function down()
    {
        Schema::table('tbl_opname', function (Blueprint $table) {
            $table->dropColumn('stock_update');
        });
    }
};