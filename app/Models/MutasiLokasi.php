<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MutasiLokasi extends Model
{
    protected $table = 'tbl_mutasi_lokasi';
    protected $primaryKey = 'id_mutasi_lokasi';

    protected $fillable = [
        'nama_barang',
        'lokasi_asal',
        'lokasi_tujuan',
        'tanggal_mutasi',
        'keterangan'
    ];
}
