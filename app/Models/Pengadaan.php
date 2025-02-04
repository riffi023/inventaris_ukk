<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pengadaan extends Model
{
    protected $table = 'tbl_pengadaan';
    protected $primaryKey = 'id_pengadaan';

    protected $fillable = [
        'id_master_barang',
        'id_depresiasi',
        'id_merk',
        'id_satuan',
        'id_sub_kategori_asset',
        'id_distributor',
        'kode_pengadaan',
        'no_invoice',
        'no_seri_barang',
        'tahun_produksi',
        'tgl_pengadaan',
        'harga_barang',
        'nilai_barang',
        'depresiasi_barang',
        'stock_barang',
        'keterangan',    // Add this
        'status_login'   // Add this
    ];

    protected $dates = [
        'tgl_pengadaan',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'tgl_pengadaan' => 'date',
        'harga_barang' => 'decimal:2',
        'nilai_barang' => 'decimal:2',
        'depresiasi_barang' => 'decimal:2',
        'stock_barang' => 'integer'
    ];

    // Relationships
    public function masterBarang(): BelongsTo
    {
        return $this->belongsTo(MasterBarang::class, 'id_master_barang', 'id_master_barang');
    }

    public function depresiasi(): BelongsTo
    {
        return $this->belongsTo(Depresiasi::class, 'id_depresiasi', 'id_depresiasi');
    }

    public function merk(): BelongsTo
    {
        return $this->belongsTo(Merk::class, 'id_merk', 'id_merk');
    }

    public function satuan(): BelongsTo
    {
        return $this->belongsTo(Satuan::class, 'id_satuan', 'id_satuan');
    }

    public function subKategoriAsset(): BelongsTo
    {
        return $this->belongsTo(SubKategoriAsset::class, 'id_sub_kategori_asset', 'id_sub_kategori_asset');
    }

    public function distributor(): BelongsTo
    {
        return $this->belongsTo(Distributor::class, 'id_distributor', 'id_distributor');
    }

    // Accessors & Mutators
    public function getFormattedHargaBarangAttribute(): string
    {
        return 'Rp ' . number_format($this->harga_barang, 0, ',', '.');
    }

    public function getFormattedNilaiBarangAttribute(): string
    {
        return 'Rp ' . number_format($this->nilai_barang, 0, ',', '.');
    }

    public function getFormattedDepresiasiBarangAttribute(): string
    {
        return 'Rp ' . number_format($this->depresiasi_barang, 0, ',', '.');
    }

    public function hitungDepresiasi($nilaiBarang, $lamaDepresiasi)
    {
        return $lamaDepresiasi > 0 ? $nilaiBarang / $lamaDepresiasi : 0;
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status_login', '1');
    }

    public function scopeInactive($query)
    {
        return $query->where('status_login', '0');
    }
}
