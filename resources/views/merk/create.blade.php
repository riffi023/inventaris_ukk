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
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="edit-card">
                <div class="edit-header">
                    <h5 class="mb-0">
                        <i class="fas fa-plus-circle me-2"></i>Tambah Merk
                    </h5>
                    <p class="mb-0 text-white-50">Tambah data merk baru</p>
                </div>

                <div class="edit-body">
                    <form action="{{ route('merk.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="merk">
                                <i class="fas fa-tag me-2"></i>Nama Merk
                            </label>
                            <input type="text" class="form-control @error('merk') is-invalid @enderror"
                                id="merk" name="merk" value="{{ old('merk') }}" required>
                            @error('merk')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="keterangan">
                                <i class="fas fa-info-circle me-2"></i>Keterangan
                            </label>
                            <textarea class="form-control @error('keterangan') is-invalid @enderror"
                                id="keterangan" name="keterangan" rows="4" required>{{ old('keterangan') }}</textarea>
                            @error('keterangan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="button-group text-end">
                            <a href="{{ route('merk.index') }}" class="btn btn-secondary me-2">
                                <i class="fas fa-arrow-left me-2"></i>Kembali
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
<script>
$(document).ready(function() {
    $('#createForm').validate({
        rules: {
            merk: {
                required: true,
                maxlength: 50
            },
            keterangan: {
                required: true,
                maxlength: 500
            }
        },
    });
});
</script>
@endpush
