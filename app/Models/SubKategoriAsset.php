<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubKategoriAsset extends Model
{
    protected $table = 'tbl_sub_kategori_asset';  // Ensure this matches your migration
    protected $primaryKey = 'id_sub_kategori_asset';
    public $timestamps = true;
    
    // Prevent Laravel from trying to pluralize the table name
    public function getTable()
    {
        return $this->table;
    }
    
    protected $fillable = [
        'id_kategori_asset',
        'kode_sub_kategori_asset',
        'sub_kategori_asset'
    ];

    public function kategoriAsset()
    {
        return $this->belongsTo(KategoriAsset::class, 'id_kategori_asset', 'id_kategori_asset');
    }
}
