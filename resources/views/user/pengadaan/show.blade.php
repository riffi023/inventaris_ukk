@extends('layouts.user')

@section('title', 'Detail Pengadaan')

@section('styles')
<style>
    .card {
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
        border: none;
    }

    .detail-card {
        background: white;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        animation: slideUp 0.5s ease-out;
        overflow: hidden;
    }

    .detail-header {
        background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
        color: white;
        padding: 20px;
        border-radius: 15px 15px 0 0;
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
        animation: fadeIn 0.5s ease-out forwards;
        opacity: 0;
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
        color: #2d3748;
        font-size: 1rem;
        padding: 8px;
        background: white;
        border-radius: 8px;
        border: 1px solid #e2e8f0;
    }

    .btn-primary {
        background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
        border: none;
        padding: 12px 35px;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
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

    @keyframes fadeIn {
        to {
            opacity: 1;
        }
    }

    .info-group:nth-child(1) {
        animation-delay: 0.1s;
    }

    .info-group:nth-child(2) {
        animation-delay: 0.2s;
    }

    .info-group:nth-child(3) {
        animation-delay: 0.3s;
    }

    @media (max-width: 768px) {
        .detail-header,
        .detail-body {
            min-width: auto;
            padding: 15px;
        }

        .info-group {
            margin-right: 0;
            margin-bottom: 15px;
        }

        .col-md-6 {
            padding: 0 10px;
        }
    }
</style>
@endsection

@section('user-content')
<div class="detail-card animate__animated animate__fadeIn">
    <div class="detail-header">
        <h5 class="mb-0">
            <i class="fas fa-shopping-cart me-2"></i>Detail Pengadaan
        </h5>
        <p class="mb-0 text-white-50">Informasi lengkap untuk pengadaan #{{ $pengadaan->kode_pengadaan }}</p>
    </div>

    <div class="detail-body">
        <div class="row">
            <div class="col-md-6">
                <!-- Left Column -->
                @include('user.pengadaan._detail_left')
            </div>

            <div class="col-md-6">
                <!-- Right Column -->
                @include('user.pengadaan._detail_right')
            </div>
        </div>

        <div id="simulasi-penyusutan" class="mt-4">
            <h5>Simulasi Penyusutan</h5>
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Bulan</th>
                        <th>Nilai Sisa</th>
                        <th>Penyusutan</th>
                    </tr>
                </thead>
                <tbody id="previewTable">
                    @for ($i = 1; $i <= $pengadaan->depresiasi->lama_depresiasi; $i++)
                        @php
                            $penyusutan = $pengadaan->hitungDepresiasi($pengadaan->nilai_barang, $pengadaan->depresiasi->lama_depresiasi);
                            $nilaiSisa = $pengadaan->nilai_barang - ($penyusutan * $i);
                        @endphp
                        <tr>
                            <td>{{ $i }}</td>
                            <td>Rp {{ number_format($nilaiSisa, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($penyusutan, 0, ',', '.') }}</td>
                        </tr>
                    @endfor
                </tbody>
            </table>
        </div>

        <div class="text-center mt-4">
            <a href="{{ route('user.pengadaan.index') }}" class="btn btn-primary">
                <i class="fas fa-arrow-left me-2"></i>Kembali
            </a>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        // Tooltip initialization
        $('[data-toggle="tooltip"]').tooltip();

        // Format number function
        function formatNumber(num) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR'
            }).format(num);
        }
        
        // Animation for info groups
        $('.info-group').each(function(index) {
            $(this).css({
                'animation-delay': (index * 0.1) + 's'
            });
        });
    });
</script>
@endpush
@endsection
