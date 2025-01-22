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
            <i class="fas fa-edit me-2"></i>Edit Lokasi
        </h5>
        <p class="mb-0 text-white-50">Edit data lokasi #{{ $lokasi->kode_lokasi }}</p>
    </div>

    <div class="edit-body">
        <form action="{{ route('lokasi.update', $lokasi) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nama_lokasi">
                            <i class="fas fa-map-marker-alt me-2"></i>Nama Lokasi
                        </label>
                        <input type="text" class="form-control @error('nama_lokasi') is-invalid @enderror"
                            id="nama_lokasi" name="nama_lokasi" value="{{ old('nama_lokasi', $lokasi->nama_lokasi) }}"
                            required>
                        @error('nama_lokasi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="keterangan">
                            <i class="fas fa-sticky-note me-2"></i>Keterangan
                        </label>
                        <textarea class="form-control @error('keterangan') is-invalid @enderror" id="keterangan"
                            name="keterangan" rows="4" required>{{ old('keterangan', $lokasi->keterangan) }}</textarea>
                        @error('keterangan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="button-group text-end">
                <a href="{{ route('lokasi.index') }}" class="btn btn-secondary me-2">
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