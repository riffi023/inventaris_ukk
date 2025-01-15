<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengadaan extends Model
{
    protected $table = 'tbl_pengadaan';
    protected $primaryKey = 'id_pengadaan';

    protected $fillable = [
        'nama_barang',
        'jumlah',
        'harga',
        'tanggal_pengadaan',
        'keterangan'
    ];
}
