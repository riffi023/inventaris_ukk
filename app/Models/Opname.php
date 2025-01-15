<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Opname extends Model
{
    protected $table = 'tbl_opname';
    protected $primaryKey = 'id_opname';

    protected $fillable = [
        'nama_barang',
        'jumlah',
        'tanggal_opname',
        'keterangan'
    ];
}
