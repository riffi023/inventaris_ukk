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
        background: linear-gradient(135deg, #4e73df 0%, #36b9cc 100%);
        color: white;
        padding: 25px 30px;
    }
    .info-group {
        background: #f8f9fa;
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 20px;
        transition: all 0.3s ease;
        border-left: 4px solid #4e73df;
    }
    .info-group:hover {
        background: white;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        transform: translateY(-2px);
    }
    @keyframes fadeInUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    .info-group:nth-child(1) { animation-delay: 0.1s; }
    .info-group:nth-child(2) { animation-delay: 0.2s; }
    .info-group:nth-child(3) { animation-delay: 0.3s; }
    .info-group:nth-child(4) { animation-delay: 0.4s; }
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
        font-size: 1.1rem;
        font-weight: 500;
        color: #2d3748;
        background: rgba(255,255,255,0.9);
        padding: 12px 15px;
        border-radius: 8px;
        border: 1px solid #e2e8f0;
        box-shadow: inset 0 1px 2px rgba(0,0,0,0.05);
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
    .btn {
        min-width: 130px;
        padding: 12px 25px;
        font-weight: 600;
        border-radius: 10px;
        transition: all 0.3s ease;
        margin: 0 5px;
    }
    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    .btn-primary {
        background: linear-gradient(135deg, #4e73df 0%, #36b9cc 100%);
        border: none;
        padding: 12px 35px;
        min-width: 140px;
    }
</style>
@endsection

@section('content')
<div class="detail-card animate__animated animate__fadeIn">
    <div class="detail-header">
        <h5 class="mb-0">Detail Merk</h5>
        <p class="mb-0 text-white-50">Informasi lengkap merk</p>
    </div>
    
    <div class="detail-body">
        <div class="row g-4">
            <div class="col-md-6">
                <div class="info-group detail-item" data-toggle="tooltip" title="Nama Merk">
                    <div class="info-label">
                        <i class="fas fa-tag"></i>
                        Nama Merk:
                    </div>
                    <div class="info-value">
                        {{ $merk->merk }}
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="info-group detail-item" data-toggle="tooltip" title="Keterangan">
                    <div class="info-label">
                        <i class="fas fa-info-circle"></i>
                        Keterangan:
                    </div>
                    <div class="info-value">
                        {{ $merk->keterangan }}
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="info-group detail-item" data-toggle="tooltip" title="Tanggal Dibuat">
                    <div class="info-label">
                        <i class="fas fa-calendar-plus"></i>
                        Tanggal Dibuat:
                    </div>
                    <div class="info-value">
                        {{ $merk->created_at->format('d/m/Y H:i') }}
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="info-group detail-item" data-toggle="tooltip" title="Terakhir Diupdate">
                    <div class="info-label">
                        <i class="fas fa-clock"></i>
                        Terakhir Diupdate:
                    </div>
                    <div class="info-value">
                        {{ $merk->updated_at->format('d/m/Y H:i') }}
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mt-4">
            <a href="{{ route('merk.index') }}" class="btn btn-primary shadow-sm">
                <i class="fas fa-arrow-left me-2"></i> Kembali
            </a>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Initialize tooltips
    $('[data-toggle="tooltip"]').tooltip();

    // Add hover effect to info groups
    $('.info-group').hover(
        function() {
            $(this).addClass('shadow-sm');
        },
        function() {
            $(this).removeClass('shadow-sm');
        }
    );
});
</script>
@endpush
