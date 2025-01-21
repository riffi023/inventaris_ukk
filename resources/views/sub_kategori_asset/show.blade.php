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
    .detail-item {
        animation: slideIn 0.3s ease-out forwards;
        opacity: 0;
        transform: translateY(20px);
    }
    @keyframes slideIn {
        to { opacity: 1; transform: translateY(0); }
    }
    .detail-item:nth-child(1) { animation-delay: 0.1s; }
    .detail-item:nth-child(2) { animation-delay: 0.2s; }
    .detail-item:nth-child(3) { animation-delay: 0.3s; }
</style>
@endsection

@section('content')
<div class="detail-card">
    <div class="detail-header">
        <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Detail Sub Kategori Asset</h5>
        <p class="mb-0 text-white-50">Informasi lengkap sub kategori asset</p>
    </div>
    
    <div class="detail-body">
        <div class="row">
            <div class="col-md-6">
                <div class="info-group detail-item">
                    <strong class="info-label"><i class="fas fa-layer-group"></i> Kategori Asset:</strong>
                    <p class="info-value">{{ $subKategoriAsset->kategoriAsset->kategori_asset }}</p>
                </div>
                <div class="info-group detail-item">
                    <strong class="info-label"><i class="fas fa-hashtag"></i> Kode Sub Kategori:</strong>
                    <p class="info-value">{{ $subKategoriAsset->kode_sub_kategori_asset }}</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="info-group detail-item">
                    <strong class="info-label"><i class="fas fa-tag"></i> Nama Sub Kategori:</strong>
                    <p class="info-value">{{ $subKategoriAsset->sub_kategori_asset }}</p>
                </div>
                <div class="info-group detail-item">
                    <strong class="info-label"><i class="fas fa-calendar-check"></i> Terakhir Diperbarui:</strong>
                    <p class="info-value">{{ $subKategoriAsset->updated_at->format('d F Y H:i:s') }}</p>
                </div>
            </div>
        </div>
        <div class="text-center mt-4">
            <a href="{{ route('sub-kategori-asset.edit', $subKategoriAsset->id_sub_kategori_asset) }}" class="btn btn-warning me-2">
                <i class="fas fa-edit me-2"></i>Edit
            </a>
            <a href="{{ route('sub-kategori-asset.index') }}" class="btn btn-primary">
                <i class="fas fa-arrow-left me-2"></i>Kembali
            </a>
        </div>
    </div>
</div>
@endsection
