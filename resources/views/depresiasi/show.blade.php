@extends('layouts.admin')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
<style>
    .detail-card {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(0,0,0,0.05);
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
    .detail-item:nth-child(1) { animation-delay: 0.1s; }
    .detail-item:nth-child(2) { animation-delay: 0.2s; }
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
</style>
@endsection

@section('content')
<div class="detail-card">
    <div class="detail-header">
        <h5 class="mb-0">Detail Depresiasi</h5>
        <p class="mb-0 text-white-50">Informasi lengkap depresiasi</p>
    </div>
    
    <div class="detail-body">
        <div class="row">
            <div class="col-md-6">
                <div class="info-group detail-item" data-toggle="tooltip" title="Lama Depresiasi">
                    <div class="info-label">
                        <i class="fas fa-clock"></i>
                        Lama Depresiasi:
                    </div>
                    <div class="info-value">
                        {{ $depresiasi->lama_depresiasi }}
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
                        {{ $depresiasi->keterangan }}
                    </div>
                </div>
            </div>
        </div>
        
        <div class="text-center mt-4">
            <a href="{{ route('depresiasi.index') }}" class="btn btn-primary">
                <i class="fas fa-arrow-left"></i> Kembali
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
