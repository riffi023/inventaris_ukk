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
        'status_login',
        'keterangan',
        'depresiasi_barang'
    ];

    protected $dates = [
        'tgl_pengadaan',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'status_login' => 'string',
        'harga_barang' => 'decimal:0',
        'nilai_barang' => 'decimal:0',
        'tgl_pengadaan' => 'date',
        'depresiasi_barang' => 'decimal:2'
    ];

    // Relationships
    public function masterBarang(): BelongsTo
    {
        return $this->belongsTo(MasterBarang::class, 'id_master_barang', 'id_master_barang')
            ->withDefault(['nama_barang' => 'N/A']);
    }

    public function depresiasi(): BelongsTo
    {
        return $this->belongsTo(Depresiasi::class, 'id_depresiasi', 'id_depresiasi')
            ->withDefault(['nama_depresiasi' => '-']);
    }

    public function merk(): BelongsTo
    {
        return $this->belongsTo(Merk::class, 'id_merk', 'id_merk')
            ->withDefault(['nama_merk' => '-']);
    }

    public function satuan(): BelongsTo
    {
        return $this->belongsTo(Satuan::class, 'id_satuan', 'id_satuan')
            ->withDefault(['nama_satuan' => '-']);
    }

    public function subKategoriAsset(): BelongsTo
    {
        return $this->belongsTo(SubKategoriAsset::class, 'id_sub_kategori_asset', 'id_sub_kategori_asset')
            ->withDefault(['nama_sub_kategori_asset' => '-']);
    }

    public function distributor(): BelongsTo
    {
        return $this->belongsTo(Distributor::class, 'id_distributor', 'id_distributor')
            ->withDefault(['nama_distributor' => 'N/A']);
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

    public function setHargaBarangAttribute($value)
    {
        $this->attributes['harga_barang'] = str_replace(['Rp', '.', ' '], '', $value);
    }

    public function setNilaiBarangAttribute($value)
    {
        $this->attributes['nilai_barang'] = str_replace(['Rp', '.', ' '], '', $value);
    }

    public function hitungDepresiasi()
    {
        $hargaBarang = (float) str_replace(['Rp', '.', ' '], '', $this->harga_barang);
        $lamaDepresiasi = $this->depresiasi->lama_depresiasi;

        if ($lamaDepresiasi > 0) {
            $this->depresiasi_barang = $hargaBarang / $lamaDepresiasi;
            $this->save();
        }

        return $this->depresiasi_barang;
    }

    public function getFormattedDepresiasiBarangAttribute(): string
    {
        return 'Rp ' . number_format($this->depresiasi_barang, 0, ',', '.');
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
