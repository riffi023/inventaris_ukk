<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Request extends Model
{
    protected $table = 'tbl_requests';
    protected $primaryKey = 'id_request';

    protected $fillable = [
        'id_opname',
        'stock_update',
        'status',
        'keterangan',
        'nama_pegawai'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function opname(): BelongsTo
    {
        return $this->belongsTo(Opname::class, 'id_opname', 'id_opname');
    }
}
