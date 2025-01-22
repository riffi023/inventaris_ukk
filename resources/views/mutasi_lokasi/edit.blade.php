@extends('layouts.admin')

@section('styles')
<style>
    .edit-card {
        background: white;
        border-radius: 8px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    }

    .edit-header {
        background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
        color: white;
        padding: 20px;
        border-radius: 8px 8px 0 0;
    }

    .edit-body {
        padding: 20px;
    }

    .form-group {
        margin-bottom: 1rem;
    }

    .form-group label {
        font-weight: 500;
        margin-bottom: 0.5rem;
        color: #4e73df;
    }

    .button-group {
        margin-top: 2rem;
    }

    .form-control:focus {
        border-color: #4e73df;
        box-shadow: 0 0 0 0.25rem rgba(78, 115, 223, 0.25);
    }
</style>
@endsection

@section('content')
<div class="edit-card">
    <div class="edit-header">
        <h5 class="mb-0">
            <i class="fas fa-edit me-2"></i>Edit Mutasi Lokasi
        </h5>
        <p class="mb-0 text-white-50">Edit data mutasi lokasi</p>
    </div>

    <div class="edit-body">
        <form action="{{ route('mutasi-lokasi.update', $mutasiLokasi) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="id_pengadaan">
                            <i class="fas fa-box me-2"></i>Barang
                        </label>
                        <select class="form-control @error('id_pengadaan') is-invalid @enderror" 
                                id="id_pengadaan" name="id_pengadaan" required>
                            <option value="">Pilih Barang</option>
                            @foreach($pengadaans as $pengadaan)
                                <option value="{{ $pengadaan->id_pengadaan }}" 
                                    {{ old('id_pengadaan', $mutasiLokasi->id_pengadaan) == $pengadaan->id_pengadaan ? 'selected' : '' }}>
                                    {{ $pengadaan->masterBarang->nama_barang }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_pengadaan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="id_lokasi">
                            <i class="fas fa-map-marker-alt me-2"></i>Lokasi
                        </label>
                        <select class="form-control @error('id_lokasi') is-invalid @enderror" 
                                id="id_lokasi" name="id_lokasi" required>
                            <option value="">Pilih Lokasi</option>
                            @foreach($lokasis as $lokasi)
                                <option value="{{ $lokasi->id_lokasi }}" 
                                    {{ old('id_lokasi', $mutasiLokasi->id_lokasi) == $lokasi->id_lokasi ? 'selected' : '' }}>
                                    {{ $lokasi->nama_lokasi }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_lokasi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="flag_lokasi">
                            <i class="fas fa-flag me-2"></i>Flag Lokasi
                        </label>
                        <input type="text" class="form-control @error('flag_lokasi') is-invalid @enderror"
                               id="flag_lokasi" name="flag_lokasi" 
                               value="{{ old('flag_lokasi', $mutasiLokasi->flag_lokasi) }}" required>
                        @error('flag_lokasi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="flag_pindah">
                            <i class="fas fa-exchange-alt me-2"></i>Flag Pindah
                        </label>
                        <input type="text" class="form-control @error('flag_pindah') is-invalid @enderror"
                               id="flag_pindah" name="flag_pindah" 
                               value="{{ old('flag_pindah', $mutasiLokasi->flag_pindah) }}" required>
                        @error('flag_pindah')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="button-group text-end">
                <a href="{{ route('mutasi-lokasi.index') }}" class="btn btn-secondary me-2">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-2"></i>Update
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
