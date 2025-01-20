<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Merk extends Model
{
    protected $table = 'tbl_merk';
    protected $primaryKey = 'id_merk';

    protected $fillable = [
        'merk',  // Changed from 'nama_merk' to 'merk'
        'keterangan'
    ];
}
