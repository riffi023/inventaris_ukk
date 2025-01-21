@extends('layouts.admin')

@section('styles')
<style>
    .edit-card {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(0,0,0,0.05);
    }
    .edit-header {
        background: linear-gradient(45deg, #4e73df, #36b9cc);
        color: white;
        padding: 20px;
        border: none;
    }
    .edit-body {
        padding: 20px;
    }
    .form-group {
        margin-bottom: 1rem;
    }
    .form-group label {
        color: #4e73df;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: 500;
        margin-bottom: 0.5rem;
    }
    .form-control {
        border: 1px solid #d1d3e2;
        border-radius: 0.35rem;
        transition: all 0.2s linear;
    }
    .form-control:focus {
        border-color: #4e73df;
        box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
    }
    .animate__fadeIn {
        animation-duration: 0.5s;
    }
    .btn-primary {
        padding: 12px 25px;
        font-weight: 600;
        border-radius: 10px;
        transition: all 0.3s ease;
        background: linear-gradient(45deg, #4e73df, #36b9cc);
        border: none;
    }
</style>
@endsection

@section('content')
<div class="edit-card animate__animated animate__fadeIn">
    <div class="edit-header">
        <h5 class="mb-0"><i class="fas fa-plus-square me-2"></i>Tambah Merk</h5>
        <p class="mb-0 text-white-50">Tambah data merk baru</p>
    </div>
    
    <div class="edit-body">
        <form action="{{ route('merk.store') }}" method="POST" id="createForm">
            @csrf
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="merk">
                            <i class="fas fa-tag"></i> Nama Merk
                        </label>
                        <input type="text" 
                               class="form-control @error('merk') is-invalid @enderror"
                               id="merk" 
                               name="merk"
                               value="{{ old('merk') }}"
                               maxlength="50"
                               required>
                        @error('merk')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="keterangan">
                            <i class="fas fa-info-circle"></i> Keterangan
                        </label>
                        <textarea class="form-control @error('keterangan') is-invalid @enderror"
                                  id="keterangan"
                                  name="keterangan"
                                  rows="3"
                                  maxlength="500"
                                  required>{{ old('keterangan') }}</textarea>
                        @error('keterangan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-2"></i>Simpan
                </button>
                <a href="{{ route('merk.index') }}" class="btn btn-primary">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>
            </div>
        </form>
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
