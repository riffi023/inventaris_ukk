@extends('layouts.admin')

@section('styles')
<style>
    .card {
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
        border: none;
    }

    .card-header {
        background: linear-gradient(45deg, #4e73df, #36b9cc);
        color: white;
        border-radius: 15px 15px 0 0 !important;
        padding: 15px 20px;
    }

    .form-group {
        background: #f8f9fc;
        padding: 20px;
        border-radius: 10px;
        margin-bottom: 1.5rem;
        transition: all 0.3s ease;
        animation: fadeIn 0.5s ease-in-out;
    }

    .form-group:hover {
        background: #fff;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .form-group strong {
        color: #4e73df;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: flex;
        align-items: center;
        margin-bottom: 10px;
    }

    .form-group strong i {
        margin-right: 10px;
        font-size: 1.1rem;
    }

    .form-group p {
        background: white;
        padding: 15px;
        border-radius: 8px;
        margin: 0;
        border: 1px solid #e3e6f0;
        font-size: 0.9rem;
    }

    .btn {
        padding: 12px 25px;
        font-weight: 600;
        border-radius: 10px;
        transition: all 0.3s ease;
    }

    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    @keyframes fadeIn {
        0% {
            opacity: 0;
            transform: translateY(20px);
        }

        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .detail-item {
        animation: slideIn 0.3s ease-out forwards;
        opacity: 0;
        transform: translateY(20px);
    }

    @keyframes slideIn {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .detail-item:nth-child(1) {
        animation-delay: 0.1s;
    }

    .detail-item:nth-child(2) {
        animation-delay: 0.2s;
    }

    .detail-item:nth-child(3) {
        animation-delay: 0.3s;
    }

    .detail-card {
        background: white;
        border-radius: 15px;
        overflow-x: auto;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        animation: slideUp 0.5s ease-out;
    }

    .detail-header {
        background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
        color: white;
        padding: 20px;
        border: none;
        min-width: 1200px;
    }

    .detail-body {
        padding: 30px;
        min-width: 1200px;
    }

    .info-group {
        background: #f8f9fa;
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 20px;
        transition: all 0.3s ease;
        border-left: 4px solid #4e73df;
        margin-right: 15px;
    }

    .info-group:hover {
        background: white;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        transform: translateY(-2px);
    }

    .info-label {
        color: #4a5568;
        font-size: 0.875rem;
        font-weight: 600;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        white-space: nowrap;
    }

    .info-label i {
        margin-right: 8px;
        color: #4e73df;
    }

    .info-value {
        color: #2d3748;
        font-size: 1rem;
        padding: 8px;
        background: white;
        border-radius: 8px;
        border: 1px solid #e2e8f0;
        min-width: 150px;
    }

    .btn-primary {
        background: linear-gradient(135deg, var(--primary) 0%, #2a52be 100%);
        border: none;
        padding: 12px 35px;
    }

    .row {
        margin: 0 -15px;
    }

    .col-md-6 {
        padding: 0 15px;
    }

    @media (max-width: 768px) {

        .detail-header,
        .detail-body {
            min-width: 800px;
        }
    }
</style>
@endsection

@section('content')
<div class="detail-card">
    <div class="detail-header">
        <h5 class="mb-0">
            <i class="fas fa-shopping-cart me-2"></i>Detail Pengadaan
        </h5>
        <p class="mb-0 text-white-50">Informasi lengkap untuk pengadaan #{{ $pengadaan->kode_pengadaan }}</p>
    </div>

    <div class="detail-body">
        <div class="row">
            <div class="col-md-6">
                <div class="info-group detail-item">
                    <strong class="info-label">
                        <i class="fas fa-barcode"></i>
                        Kode Pengadaan
                    </strong>
                    <p class="info-value">{{ $pengadaan->kode_pengadaan }}</p>
                </div>

                <div class="info-group detail-item">
                    <strong class="info-label">
                        <i class="fas fa-box"></i>
                        Barang
                    </strong>
                    <p class="info-value">{{ $pengadaan->masterBarang->nama_barang }}</p>
                </div>

                <div class="info-group detail-item">
                    <strong class="info-label">
                        <i class="fas fa-chart-line"></i>
                        Depresiasi
                    </strong>
                    <p class="info-value">{{ $pengadaan->depresiasi->lama_depresiasi }}</p>
                </div>

                <div class="info-group detail-item">
                    <strong class="info-label">
                        <i class="fas fa-trademark"></i>
                        Merk
                    </strong>
                    <p class="info-value">{{ $pengadaan->merk->merk }}</p>
                </div>

                <div class="info-group detail-item">
                    <strong class="info-label">
                        <i class="fas fa-balance-scale"></i>
                        Satuan
                    </strong>
                    <p class="info-value">{{ $pengadaan->satuan->satuan }}</p>
                </div>

                <div class="info-group detail-item">
                    <strong class="info-label">
                        <i class="fas fa-tags"></i>
                        Sub Kategori Asset
                    </strong>
                    <p class="info-value">{{ $pengadaan->subKategoriAsset->sub_kategori_asset }}</p>
                </div>

                <div class="info-group detail-item">
                    <strong class="info-label">
                        <i class="fas fa-truck"></i>
                        Distributor
                    </strong>
                    <p class="info-value">{{ $pengadaan->distributor->nama_distributor }}</p>
                </div>
            </div>

            <div class="col-md-6">
                <div class="info-group detail-item">
                    <strong class="info-label">
                        <i class="fas fa-file-invoice"></i>
                        Nomor Invoice
                    </strong>
                    <p class="info-value">{{ $pengadaan->no_invoice }}</p>
                </div>

                <div class="info-group detail-item">
                    <strong class="info-label">
                        <i class="fas fa-fingerprint"></i>
                        Nomor Seri Barang
                    </strong>
                    <p class="info-value">{{ $pengadaan->no_seri_barang }}</p>
                </div>

                <div class="info-group detail-item">
                    <strong class="info-label">
                        <i class="fas fa-calendar"></i>
                        Tahun Produksi
                    </strong>
                    <p class="info-value">{{ $pengadaan->tahun_produksi }}</p>
                </div>

                <div class="info-group detail-item">
                    <strong class="info-label">
                        <i class="fas fa-calendar-alt"></i>
                        Tanggal Pengadaan
                    </strong>
                    <p class="info-value">{{ $pengadaan->tgl_pengadaan->format('d F Y') }}</p>
                </div>

                <div class="info-group detail-item">
                    <strong class="info-label">
                        <i class="fas fa-money-bill"></i>
                        Harga Barang
                    </strong>
                    <p class="info-value">{{ $pengadaan->formatted_harga_barang }}</p>
                </div>

                <div class="info-group detail-item">
                    <strong class="info-label">
                        <i class="fas fa-coins"></i>
                        Nilai Barang
                    </strong>
                    <p class="info-value">{{ $pengadaan->formatted_nilai_barang }}</p>
                </div>

                <div class="info-group detail-item">
                    <strong class="info-label">
                        <i class="fas fa-calculator"></i>
                        Depresiasi per Bulan
                    </strong>
                    <p class="info-value">{{ $pengadaan->formatted_depresiasi_barang }}/bulan</p>
                </div>

                <div class="info-group detail-item">
                    <strong class="info-label">
                        <i class="fas fa-check-circle"></i>
                        Status
                    </strong>
                    <p class="info-value">
                        @if($pengadaan->status_login == '1')
                            <span class="badge bg-success">Aktif</span>
                        @else
                            <span class="badge bg-danger">Tidak Aktif</span>
                        @endif
                    </p>
                </div>

                <div class="info-group detail-item">
                    <strong class="info-label">
                        <i class="fas fa-sticky-note"></i>
                        Keterangan
                    </strong>
                    <p class="info-value">{{ $pengadaan->keterangan }}</p>
                </div>
            </div>
        </div>

        <div class="text-center mt-4">
            <a href="{{ route('pengadaan.index') }}" class="btn btn-primary">
                <i class="fas fa-arrow-left me-2"></i>Kembali
            </a>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@endpush