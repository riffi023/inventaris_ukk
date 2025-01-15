<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriAsset extends Model
{
    protected $table = 'tbl_kategori_asset';
    protected $primaryKey = 'id_kategori_asset';

    protected $fillable = [
        'kode_kategori_asset',
        'kategori_asset',
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];
}
