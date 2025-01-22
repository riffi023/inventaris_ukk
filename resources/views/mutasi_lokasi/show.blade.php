@extends('layouts.admin')

@section('styles')
<style>
    .show-card {
        background: white;
        border-radius: 8px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    }

    .show-header {
        background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
        color: white;
        padding: 20px;
        border-radius: 8px 8px 0 0;
    }

    .show-body {
        padding: 20px;
    }

    .detail-group {
        margin-bottom: 1.5rem;
    }

    .detail-group label {
        font-weight: 600;
        color: #4e73df;
        margin-bottom: 0.5rem;
    }

    .detail-group p {
        margin-bottom: 0;
        padding: 0.5rem 0;
        border-bottom: 1px solid #e3e6f0;
    }

    .button-group {
        margin-top: 2rem;
    }
</style>
@endsection

@section('content')
<div class="show-card">
    <div class="show-header">
        <h5 class="mb-0">
            <i class="fas fa-info-circle me-2"></i>Detail Mutasi Lokasi
        </h5>
        <p class="mb-0 text-white-50">Informasi detail mutasi lokasi</p>
    </div>

    <div class="show-body">
        <div class="row">
            <div class="col-md-6">
                <div class="detail-group">
                    <label>
                        <i class="fas fa-box me-2"></i>Barang
                    </label>
                    <p>{{ $mutasiLokasi->pengadaan->masterBarang->nama_barang }}</p>
                </div>

                <div class="detail-group">
                    <label>
                        <i class="fas fa-map-marker-alt me-2"></i>Lokasi
                    </label>
                    <p>{{ $mutasiLokasi->lokasi->nama_lokasi }}</p>
                </div>
            </div>

            <div class="col-md-6">
                <div class="detail-group">
                    <label>
                        <i class="fas fa-flag me-2"></i>Flag Lokasi
                    </label>
                    <p>{{ $mutasiLokasi->flag_lokasi }}</p>
                </div>

                <div class="detail-group">
                    <label>
                        <i class="fas fa-exchange-alt me-2"></i>Flag Pindah
                    </label>
                    <p>{{ $mutasiLokasi->flag_pindah }}</p>
                </div>

                <div class="detail-group">
                    <label>
                        <i class="fas fa-calendar-alt me-2"></i>Tanggal Dibuat
                    </label>
                    <p>{{ $mutasiLokasi->created_at->format('d F Y H:i:s') }}</p>
                </div>

                <div class="detail-group">
                    <label>
                        <i class="fas fa-calendar-check me-2"></i>Terakhir Diupdate
                    </label>
                    <p>{{ $mutasiLokasi->updated_at->format('d F Y H:i:s') }}</p>
                </div>
            </div>
        </div>

        <div class="button-group text-end">
            <a href="{{ route('mutasi-lokasi.index') }}" class="btn btn-secondary me-2">
                <i class="fas fa-arrow-left me-2"></i>Kembali
            </a>
        </div>
    </div>
</div>
@endsection