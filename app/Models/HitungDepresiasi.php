<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HitungDepresiasi extends Model
{
    protected $table = 'tbl_hitung_depresiasi';
    protected $primaryKey = 'id_hitung_depresiasi';

    protected $fillable = [
        'nama_barang',
        'nilai_awal',
        'nilai_akhir',
        'umur_ekonomis',
        'keterangan'
    ];
}
