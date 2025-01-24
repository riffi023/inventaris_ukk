@extends('layouts.user')

@section('title', 'Detail Opname')

@section('styles')
<style>
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
        color: #4e73df;
    }

    .info-value {
        color: #2d3748;
        font-size: 1rem;
        padding: 8px;
        background: white;
        border-radius: 8px;
        border: 1px solid #e2e8f0;
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
@endsection

@section('user-content')
<div class="detail-card">
    <div class="detail-header">
        <h5 class="mb-0">Detail Opname</h5>
        <p class="mb-0 text-white-50">Informasi lengkap data opname</p>
    </div>

    <div class="detail-body">
        <div class="row">
            <div class="col-md-6">
                <div class="info-group">
                    <span class="info-label">
                        <i class="fas fa-box"></i> Barang
                    </span>
                    <p class="info-value">{{ $opname->pengadaan->masterBarang->nama_barang }}</p>
                </div>

                <div class="info-group">
                    <span class="info-label">
                        <i class="fas fa-calendar-alt"></i> Tanggal Opname
                    </span>
                    <p class="info-value">{{ $opname->tgl_opname->format('d F Y') }}</p>
                </div>

                <div class="info-group">
                    <span class="info-label">
                        <i class="fas fa-info-circle"></i> Kondisi
                    </span>
                    <p class="info-value">
                        @if($opname->kondisi == 'Baik')
                            <span class="badge bg-success">{{ $opname->kondisi }}</span>
                        @elseif($opname->kondisi == 'Rusak Ringan')
                            <span class="badge bg-warning">{{ $opname->kondisi }}</span>
                        @else
                            <span class="badge bg-danger">{{ $opname->kondisi }}</span>
                        @endif
                    </p>
                </div>
            </div>

            <div class="col-md-6">
                <div class="info-group">
                    <span class="info-label">
                        <i class="fas fa-boxes"></i> Stock Barang
                    </span>
                    <p class="info-value">
                        {{ number_format($opname->pengadaan->stock_barang, 0, ',', '.') }}
                        {{ $opname->pengadaan->satuan->nama_satuan }}
                    </p>
                </div>

                @if($opname->stock_update)
                    <div class="info-group">
                        <span class="info-label">
                            <i class="fas fa-sync"></i> Stock Update
                        </span>
                        <p class="info-value">
                            {{ number_format($opname->stock_update, 0, ',', '.') }}
                            {{ $opname->pengadaan->satuan->nama_satuan }}
                        </p>
                    </div>
                @endif

                <div class="info-group">
                    <span class="info-label">
                        <i class="fas fa-sticky-note"></i> Keterangan
                    </span>
                    <p class="info-value">{{ $opname->keterangan }}</p>
                </div>
            </div>
        </div>

        <div class="text-center mt-4">
            <a href="{{ route('user.opname.index') }}" class="btn btn-secondary me-2">
                <i class="fas fa-arrow-left me-2"></i>Kembali
            </a>
        </div>
    </div>
</div>
@endsection