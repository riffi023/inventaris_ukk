@extends('layouts.admin')

@section('styles')
<style>
    .card {
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
        border: none;
    }

    .card-header {
        background: linear-gradient(135deg, #4e73df 0%, #224abe 100%); /* Changed to match CRUD gradient */
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

    .btn-primary {
        background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
        border: none;
    }

    .btn-secondary {
        background: #858796;
        border: none;
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
</style>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">
            <i class="fas fa-eye me-2"></i>Detail Merk
        </h5>
        <p class="mb-0 text-white-50">Informasi detail merk #{{ $merk->id_merk }}</p>
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="info-group detail-item">
                    <strong class="info-label">
                        <i class="fas fa-tag"></i>
                        Nama Merk
                    </strong>
                    <p class="info-value">{{ $merk->merk }}</p>
                </div>

                <div class="info-group detail-item">
                    <strong class="info-label">
                        <i class="fas fa-info-circle"></i>
                        Keterangan
                    </strong>
                    <p class="info-value">{{ $merk->keterangan }}</p>
                </div>
            </div>

            <div class="col-md-6">
                <div class="info-group detail-item">
                    <strong class="info-label">
                        <i class="fas fa-clock"></i>
                        Dibuat Pada
                    </strong>
                    <p class="info-value">{{ $merk->created_at->format('d F Y H:i') }}</p>
                </div>

                <div class="info-group detail-item">
                    <strong class="info-label">
                        <i class="fas fa-history"></i>
                        Diperbarui Pada
                    </strong>
                    <p class="info-value">{{ $merk->updated_at->format('d F Y H:i') }}</p>
                </div>
            </div>
        </div>

        <div class="text-center mt-4">
            <a href="{{ route('merk.index') }}" class="btn btn-secondary me-2">
                <i class="fas fa-arrow-left me-2"></i>Kembali
            </a>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();
});
</script>
@endpush