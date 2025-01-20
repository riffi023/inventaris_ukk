@extends('layouts.admin')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
<style>
    .edit-card {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(0,0,0,0.05);
    }
    .edit-header {
        background: linear-gradient(135deg, var(--primary) 0%, #2a52be 100%);
        color: white;
        padding: 20px;
        border: none;
    }
    .edit-body {
        padding: 30px;
    }
    .form-control {
        border-radius: 10px;
        border: 2px solid #edf2f7;
        padding: 12px 16px;
        transition: all 0.2s;
    }
    .form-control:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 0.2rem rgba(78,115,223,0.15);
    }
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
    .form-group {
        position: relative;
    }
    .form-group i.icon {
        position: absolute;
        left: 15px;
        top: 40px;
        color: #666;
    }
    .form-control {
        padding-left: 40px;
    }
</style>
@endsection

@section('title', 'Tambah Sub Kategori Asset')

@section('content')
<div class="edit-card">
    <div class="edit-header">
        <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <div>
                    <h5 class="mb-0">Tambah Sub Kategori Asset</h5>
                    <p class="mb-0 text-white-50">Tambah sub kategori asset baru</p>
                </div>
            </div>
            <a href="{{ route('sub-kategori-asset.index') }}" class="btn btn-light">
                <i class="fas fa-arrow-left me-2"></i>Kembali
            </a>
        </div>
    </div>

    <div class="edit-body">
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> Ada beberapa masalah dengan input Anda.<br><br>
                <ul class="list-unstyled mb-0">
                    @foreach ($errors->all() as $error)
                        <li><i class="fas fa-exclamation-circle me-2"></i>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form method="POST" action="{{ route('sub-kategori-asset.store') }}" id="editForm">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label>
                            <i class="fas fa-tags icon"></i> Kategori Asset <span class="text-danger">*</span>
                        </label>
                        <select name="id_kategori_asset" class="form-control @error('id_kategori_asset') is-invalid @enderror">
                            <option value="">Pilih Kategori Asset</option>
                            @foreach($kategoriAssets as $kategori)
                                <option value="{{ $kategori->id_kategori_asset }}" 
                                    {{ old('id_kategori_asset') == $kategori->id_kategori_asset ? 'selected' : '' }}>
                                    {{ $kategori->kategori_asset }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_kategori_asset')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label>
                            <i class="fas fa-barcode icon"></i> Kode Sub Kategori <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control @error('kode_sub_kategori_asset') is-invalid @enderror"
                               name="kode_sub_kategori_asset" value="{{ old('kode_sub_kategori_asset') }}"
                               placeholder="Masukkan kode sub kategori">
                        @error('kode_sub_kategori_asset')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form-group mb-3">
                <label>
                    <i class="fas fa-folder icon"></i> Nama Sub Kategori <span class="text-danger">*</span>
                </label>
                <input type="text" class="form-control @error('sub_kategori_asset') is-invalid @enderror"
                       name="sub_kategori_asset" value="{{ old('sub_kategori_asset') }}"
                       placeholder="Masukkan nama sub kategori">
                @error('sub_kategori_asset')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="text-end mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-2"></i>Simpan
                </button>
                <button type="reset" class="btn btn-secondary">
                    <i class="fas fa-undo me-2"></i>Reset
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<script>
    $(document).ready(function() {
        $("#editForm").validate({
            // ...existing validation rules...
        });
    });
</script>
@endpush
