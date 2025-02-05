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
    }

    .info-label i {
        margin-right: 8px;
        color: #4e73df;
    }

    .info-value {
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

    .detail-item:nth-child(4) {
        animation-delay: 0.4s;
    }
</style>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">
            <i class="fas fa-eye me-2"></i>Detail Opname
        </h5>
        <p class="mb-0 text-white-50">Informasi detail data opname</p>
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="info-group">
                    <strong class="info-label">
                        <i class="fas fa-box"></i>
                        Barang
                    </strong>
                    <p class="info-value">{{ $opname->pengadaan->masterBarang->nama_barang }}</p>
                </div>

                <div class="info-group">
                    <strong class="info-label">
                        <i class="fas fa-calendar-alt"></i>
                        Tanggal Opname
                    </strong>
                    <p class="info-value">{{ $opname->tgl_opname->format('d F Y') }}</p>
                </div>

                <div class="info-group">
                    <strong class="info-label">
                        <i class="fas fa-info-circle"></i>
                        Kondisi
                    </strong>
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
                    <strong class="info-label">
                        <i class="fas fa-boxes"></i>
                        Stock Barang
                    </strong>
                    <p class="info-value">
                        {{ number_format($opname->pengadaan->stock_barang, 0, ',', '.') }}
                        {{ $opname->pengadaan->satuan->nama_satuan }}
                    </p>
                </div>

                @if($opname->stock_update)
                    <div class="info-group">
                        <strong class="info-label">
                            <i class="fas fa-sync"></i>
                            Stock Update
                        </strong>
                        <p class="info-value">
                            {{ number_format($opname->stock_update, 0, ',', '.') }}
                            {{ $opname->pengadaan->satuan->nama_satuan }}
                        </p>
                    </div>
                @endif

                <div class="info-group">
                    <strong class="info-label">
                        <i class="fas fa-sticky-note"></i>
                        Keterangan
                    </strong>
                    <p class="info-value">{{ $opname->keterangan }}</p>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-6">
                <div class="info-group">
                    <strong class="info-label">
                        <i class="fas fa-user"></i>
                        Nama Pegawai
                    </strong>
                    <p class="info-value">{{ $opname->nama_pegawai }}</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="info-group">
                    <strong class="info-label">
                        <i class="fas fa-clock"></i>
                        Dibuat Pada
                    </strong>
                    <p class="info-value">{{ $opname->created_at->format('d F Y H:i') }}</p>
                </div>
            </div>
        </div>

        <div class="text-center mt-4">
            <a href="{{ route('opname.index') }}" class="btn btn-secondary me-2">
                <i class="fas fa-arrow-left me-2"></i>Kembali
            </a>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@endpush
@endsection