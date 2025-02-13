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
        background: #f8f9fa;
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 20px;
        transition: all 0.3s ease;
        border-left: 4px solid var(--primary);
    }

    .info-label {
        color: #4a5568;
        font-size: 0.875rem;
        font-weight: 600;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
    }

    .info-label i {
        margin-right: 8px;
        color: var(--primary);
    }

    .info-value {
        color: #2d3748;
        font-size: 1rem;
        padding: 8px;
        background: white;
        border-radius: 8px;
        border: 1px solid #e2e8f0;
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
                    <p class="info-value">Rp {{ number_format($depresiasi->hitungDepresiasi(), 0, ',', '.') }}</p>
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
                                <td>Rp {{ number_format($depresiasi->hitungDepresiasi(), 0, ',', '.') }}</td>
                            </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
            <small class="text-muted">* Menampilkan 12 bulan pertama dari total {{ $depresiasi->durasi }} bulan</small>
        </div>

        <div class="text-center mt-4">
            <a href="{{ route('hitung-depresiasi.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
</div>
@endsection