<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Depresiasi extends Model
{
    protected $table = 'tbl_depresiasi';
    protected $primaryKey = 'id_depresiasi';

    protected $fillable = [
        'lama_depresiasi',
        'nilai_penyusutan',
        'keterangan'
    ];

    public function hitungPenyusutanPerBulan($hargaAwal)
    {
        return $hargaAwal / $this->lama_depresiasi;
    }

    public function hitungNilaiSisaBulan($hargaAwal, $bulanKe)
    {
        $penyusutanPerBulan = $this->hitungPenyusutanPerBulan($hargaAwal);
        $totalPenyusutan = $penyusutanPerBulan * $bulanKe;
        $nilaiSisa = max(0, $hargaAwal - $totalPenyusutan);
        
        return [
            'nilai_sisa' => $nilaiSisa,
            'penyusutan' => $penyusutanPerBulan
        ];
    }

    public function pengadaan()
    {
        return $this->hasMany(Pengadaan::class, 'id_depresiasi', 'id_depresiasi');
    }
}
