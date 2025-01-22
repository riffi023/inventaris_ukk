<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lokasi extends Model
{
    protected $table = 'tbl_lokasi';
    protected $primaryKey = 'id_lokasi';

    protected $fillable = [
        'kode_lokasi',
        'nama_lokasi',
        'keterangan'
    ];
}
