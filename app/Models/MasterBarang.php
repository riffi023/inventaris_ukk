<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterBarang extends Model
{
    protected $table = 'tbl_master_barang';
    protected $primaryKey = 'id_master_barang';

    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'spesifikasi_teknis'
    ];

    public function pengadaan()
    {
        return $this->hasMany(Pengadaan::class, 'id_master_barang', 'id_master_barang');
    }
}
