@extends('layouts.admin')

@section('styles')
<style>
    .detail-card {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        animation: slideUp 0.5s ease-out;
    }
    .btn-primary {
        background: linear-gradient(135deg, var(--primary) 0%, #2a52be 100%);
        border: none;
        padding: 12px 35px;
        transition: all 0.3s ease;
    }
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    .detail-header {
        background: linear-gradient(45deg, #4e73df, #36b9cc);
        color: white;
        padding: 20px;
        border: none;
    }
    .detail-body {
        padding: 30px;
    }
    .info-group {
        background: #f8f9fc;
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 20px;
        transition: all 0.3s ease;
        border-left: 4px solid #4e73df;
        animation: fadeIn 0.5s ease-in-out;
    }
    .info-group:hover {
        background: white;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
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
    .info-group strong {
        color: #4e73df;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
</style>
@endsection

@section('content')
<div class="detail-card">
    <div class="detail-header">
        <h5 class="mb-0">
            <i class="fas fa-tag me-2"></i>Detail Merk
        </h5>
        <p class="mb-0 text-white-50">Informasi lengkap untuk merk #{{ $merk->id_merk }}</p>
    </div>
    
    <div class="detail-body">
        <div class="row">
            <div class="col-md-6">
                <div class="info-group detail-item">
                    <div class="info-label">
                        <i class="fas fa-tag"></i>Nama Merk
                    </div>
                    <div class="info-value">
                        {{ $merk->merk }}
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="info-group detail-item">
                    <div class="info-label">
                        <i class="fas fa-info-circle"></i>Keterangan
                    </div>
                    <div class="info-value">
                        {{ $merk->keterangan }}
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mt-4">
            <a href="{{ route('merk.index') }}" class="btn btn-primary">
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