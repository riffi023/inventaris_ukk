<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Distributor extends Model
{
    protected $table = 'tbl_distributor';
    protected $primaryKey = 'id_distributor';

    protected $fillable = [
        'nama_distributor',
        'alamat',
        'no_telp',
        'email',
        'keterangan'
    ];

    public function pengadaan()
    {
        return $this->hasMany(Pengadaan::class, 'id_distributor', 'id_distributor');
    }
}
