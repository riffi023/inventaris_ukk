@extends('layouts.admin')

@section('styles')
<style>
    .card {
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.15);
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
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
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
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    @keyframes fadeIn {
        0% { opacity: 0; transform: translateY(20px); }
        100% { opacity: 1; transform: translateY(0); }
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
    
    .detail-item:nth-child(1) { animation-delay: 0.1s; }
    .detail-item:nth-child(2) { animation-delay: 0.2s; }
    .detail-item:nth-child(3) { animation-delay: 0.3s; }
    .detail-item:nth-child(4) { animation-delay: 0.4s; }
    .detail-item:nth-child(5) { animation-delay: 0.5s; }
    .detail-card {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        animation: slideUp 0.5s ease-out;
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
    .detail-header {
        background: linear-gradient(135deg, var(--primary) 0%, #2a52be 100%);
        color: white;
        padding: 20px;
        border: none;
    }
    .detail-body {
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
    .btn-primary {
        background: linear-gradient(135deg, var(--primary) 0%, #2a52be 100%);
        border: none;
        padding: 12px 35px;
    }
</style>

@endsection

@section('content')
<div class="detail-card">
    <div class="detail-header">
        <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Detail Kategori Asset</h5>
        <p class="mb-0 text-white-50">Informasi lengkap kategori asset</p>
    </div>
    
    <div class="detail-body">
        <div class="row">
            <div class="col-md-6">
                <div class="info-group detail-item" data-toggle="tooltip" title="Kode Kategori">
                    <strong class="info-label"><i class="fas fa-hashtag"></i> Kode Kategori:</strong>
                    <p class="info-value">{{ $kategoriAsset->kode_kategori_asset }}</p>
                </div>
                <div class="info-group detail-item" data-toggle="tooltip" title="Nama Kategori">
                    <strong class="info-label"><i class="fas fa-tag"></i> Nama Kategori:</strong>
                    <p class="info-value">{{ $kategoriAsset->kategori_asset }}</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="info-group detail-item" data-toggle="tooltip" title="Dibuat Pada">
                    <strong class="info-label"><i class="fas fa-calendar-plus"></i> Dibuat Pada:</strong>
                    <p class="info-value">{{ $kategoriAsset->created_at->format('d F Y H:i:s') }}</p>
                </div>
                <div class="info-group detail-item" data-toggle="tooltip" title="Diperbarui Pada">
                    <strong class="info-label"><i class="fas fa-calendar-check"></i> Diperbarui Pada:</strong>
                    <p class="info-value">{{ $kategoriAsset->updated_at->format('d F Y H:i:s') }}</p>
                </div>
            </div>
        </div>
        <div class="text-center mt-4">
            <a class="btn btn-primary" href="{{ route('kategori_asset.index') }}">
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
