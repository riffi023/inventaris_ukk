@extends('layouts.admin')

@section('styles')
<style>
    .show-card {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
    }

    .show-header {
        background: linear-gradient(135deg, var(--primary) 0%, #2a52be 100%);
        color: white;
        padding: 20px;
        border: none;
    }

    .show-body {
        padding: 30px;
    }

    .info-group {
        margin-bottom: 1.5rem;
    }

    .info-label {
        display: block;
        color: #6c757d;
        margin-bottom: 0.5rem;
    }

    .info-value {
        font-size: 1.1rem;
        color: #2d2d2d;
    }
</style>
@endsection

@section('content')
<div class="show-card">
    <div class="show-header">
        <h5 class="mb-0">Detail Perhitungan Depresiasi</h5>
        <p class="mb-0 text-white-50">Informasi lengkap perhitungan depresiasi</p>
    </div>

    <div class="show-body">
        <div class="row">
            <div class="col-md-6">
                <div class="info-group">
                    <span class="info-label">
                        <i class="fas fa-box"></i> Nama Barang
                    </span>
                    <p class="info-value">{{ $depresiasi->pengadaan->masterBarang->nama_barang }}</p>
                </div>

                <div class="info-group">
                    <span class="info-label">
                        <i class="fas fa-calendar"></i> Tanggal Hitung
                    </span>
                    <p class="info-value">
                        {{ \Carbon\Carbon::parse($depresiasi->tgl_hitung_depresiasi)->format('d F Y') }}
                    </p>
                </div>

                <div class="info-group">
                    <span class="info-label">
                        <i class="fas fa-clock"></i> Bulan
                    </span>
                    <p class="info-value">{{ $depresiasi->bulan }}</p>
                </div>
            </div>

            <div class="col-md-6">
                <div class="info-group">
                    <span class="info-label">
                        <i class="fas fa-hourglass-half"></i> Durasi
                    </span>
                    <p class="info-value">{{ $depresiasi->durasi }} Bulan</p>
                </div>

                <div class="info-group">
                    <span class="info-label">
                        <i class="fas fa-money-bill"></i> Nilai Barang
                    </span>
                    <p class="info-value">Rp {{ number_format($depresiasi->nilai_barang, 0, ',', '.') }}</p>
                </div>

                <div class="info-group">
                    <span class="info-label">
                        <i class="fas fa-calculator"></i> Nilai Depresiasi per Bulan
                    </span>
                    <p class="info-value">Rp
                        {{ number_format($depresiasi->nilai_barang / $depresiasi->durasi, 0, ',', '.') }}
                    </p>
                </div>
            </div>
        </div>

        <div class="mt-4">
            <h5>Simulasi Penyusutan</h5>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Bulan ke-</th>
                            <th>Nilai Sisa</th>
                            <th>Penyusutan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i = 1; $i <= min($depresiasi->durasi, 12); $i++)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>Rp {{ number_format($depresiasi->hitungNilaiSisaBulan($i), 0, ',', '.') }}</td>
                                <td>Rp {{ number_format($depresiasi->depresiasi_barang, 0, ',', '.') }}</td>
                            </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
            <small class="text-muted">* Menampilkan 12 bulan pertama dari total {{ $depresiasi->durasi }} bulan</small>
        </div>

        <div class="text-center mt-4">
            <a href="{{ route('hitung-depresiasi.edit', $depresiasi->id_hitung_depresiasi) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('hitung-depresiasi.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
</div>
@endsection