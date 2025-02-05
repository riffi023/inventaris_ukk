<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Opname extends Model
{
    protected $table = 'tbl_opname';
    protected $primaryKey = 'id_opname';

    protected $fillable = [
        'id_pengadaan',
        'tgl_opname',
        'kondisi',
        'keterangan',
        'stock_update',
        'nama_pegawai'
    ];

    protected $casts = [
        'tgl_opname' => 'date'
    ];

    public function pengadaan(): BelongsTo
    {
        return $this->belongsTo(Pengadaan::class, 'id_pengadaan', 'id_pengadaan');
    }
}
