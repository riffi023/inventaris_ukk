<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Satuan extends Model
{
    protected $table = 'tbl_satuan';
    protected $primaryKey = 'id_satuan';
    protected $fillable = ['satuan'];
    // ...existing code...
}
