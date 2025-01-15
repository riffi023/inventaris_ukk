<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubKategoriAsset extends Model
{
    protected $table = 'tbl_sub_kategori_asset';
    protected $primaryKey = 'id_sub_kategori_asset';
    protected $fillable = [
        'id_kategori_asset',
        'kode_sub_kategori_asset',
        'sub_kategori_asset'
    ];
}
