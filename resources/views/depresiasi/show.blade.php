@extends('layouts.admin')

@section('styles')
<style>
    .show-card {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
    }

    .show-header {
        background: linear-gradient(135deg, var(--primary) 0%, #2a52be 100%);
        color: white;
        padding: 20px;
        border: none;
    }

    .show-body {
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
</style>
@endsection

@section('content')
<div class="show-card">
    <div class="show-header">
        <h5 class="mb-0">Detail Depresiasi</h5>
        <p class="mb-0 text-white-50">Informasi lengkap depresiasi</p>
    </div>

    <div class="show-body">
        <div class="row">
            <div class="col-md-6">
                <div class="info-group">
                    <span class="info-label">
                        <i class="fas fa-clock"></i> Lama Depresiasi:
                    </span>
                    <p class="info-value">{{ $depresiasi->lama_depresiasi }} Bulan</p>
                </div>

                <div class="info-group">
                    <span class="info-label">
                        <i class="fas fa-info-circle"></i> Keterangan:
                    </span>
                    <p class="info-value">{{ $depresiasi->keterangan }}</p>
                </div>
            </div>
        </div>

        <div class="mt-4">
            <h5>Simulasi Penyusutan</h5>
            @php
                $contohHarga = 1000000; // Contoh harga 1 juta
            @endphp
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Bulan ke-</th>
                            <th>Nilai Sisa</th>
                            <th>Penyusutan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i = 1; $i <= min(5, $depresiasi->lama_depresiasi); $i++)
                            @php
                                $hasil = $depresiasi->hitungNilaiSisaBulan($contohHarga, $i);
                            @endphp
                            <tr>
                                <td>{{ $i }}</td>
                                <td>Rp {{ number_format($hasil['nilai_sisa'], 0, ',', '.') }}</td>
                                <td>Rp {{ number_format($hasil['penyusutan'], 0, ',', '.') }}</td>
                            </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
            <small class="text-muted">* Simulasi menggunakan contoh harga barang Rp {{ number_format($contohHarga, 0, ',', '.') }}</small>
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