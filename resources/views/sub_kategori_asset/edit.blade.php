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
        background: linear-gradient(135deg, #4e73df 0%, #1565c0 100%);
        color: white;
        padding: 20px;
        border: none;
    }
    .edit-body {
        padding: 30px;
    }
    .form-group {
        margin-bottom: 1.5rem;
        position: relative;
    }
    .form-group label {
        font-weight: 600;
        color: #4e73df;
        margin-bottom: 0.5rem;
        display: block;
    }
    .form-group i {
        position: absolute;
        left: 15px;
        top: 42px;
        color: #1976d2;
    }
    .form-control, .form-select {
        height: 45px;
        border-radius: 10px;
        padding: 10px 15px 10px 40px;
        border: 2px solid #e3e6f0;
        font-size: 14px;
        transition: all 0.3s ease;
    }
    .form-control:focus, .form-select:focus {
        border-color: #1976d2;
        box-shadow: 0 0 0 0.2rem rgba(25, 118, 210, 0.25);
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
</style>
@endsection

@section('content')
<div class="edit-card">
    <div class="edit-header">
        <h5 class="mb-0"><i class="fas fa-edit me-2"></i>Edit Sub Kategori Asset</h5>
        <p class="mb-0 text-white-50">Update informasi sub kategori asset</p>
    </div>

    <div class="edit-body">
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form action="{{ route('sub-kategori-asset.update', $subKategoriAsset->id_sub_kategori_asset) }}" method="POST" id="editForm">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label><i class="fas fa-layer-group me-2"></i>Kategori Asset</label>
                        <select name="id_kategori_asset" class="form-select @error('id_kategori_asset') is-invalid @enderror">
                            <option value="">Pilih Kategori Asset</option>
                            @foreach($kategoriAssets as $kategori)
                            <option value="{{ $kategori->id_kategori_asset }}"
                                {{ $kategori->id_kategori_asset == $subKategoriAsset->id_kategori_asset ? 'selected' : '' }}>
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
                    <div class="form-group">
                        <label><i class="fas fa-hashtag me-2"></i>Kode Sub Kategori</label>
                        <input type="text" name="kode_sub_kategori_asset"
                            value="{{ $subKategoriAsset->kode_sub_kategori_asset }}"
                            class="form-control @error('kode_sub_kategori_asset') is-invalid @enderror">
                        @error('kode_sub_kategori_asset')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label><i class="fas fa-tag me-2"></i>Nama Sub Kategori</label>
                        <input type="text" name="sub_kategori_asset"
                            value="{{ $subKategoriAsset->sub_kategori_asset }}"
                            class="form-control @error('sub_kategori_asset') is-invalid @enderror">
                        @error('sub_kategori_asset')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="text-center mt-4">
                <button type="submit" class="btn btn-warning me-2">
                    <i class="fas fa-save me-2"></i>Update
                </button>
                <a href="{{ route('sub-kategori-asset.index') }}" class="btn btn-primary">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $("#editForm").validate({
        rules: {
            id_kategori_asset: "required",
            kode_sub_kategori_asset: {
                required: true,
                minlength: 3
            },
            sub_kategori_asset: {
                required: true,
                minlength: 3
            }
        },
        messages: {
            id_kategori_asset: "Pilih kategori asset",
            kode_sub_kategori_asset: {
                required: "Kode sub kategori harus diisi",
                minlength: "Minimal 3 karakter"
            },
            sub_kategori_asset: {
                required: "Nama sub kategori harus diisi",
                minlength: "Minimal 3 karakter"
            }
        },
        submitHandler: function(form) {
            const submitBtn = $('.btn-primary');
            submitBtn.prop('disabled', true)
                    .addClass('btn-loading')
                    .html('<i class="fas fa-spinner fa-spin"></i> Memperbarui...');
            
            setTimeout(() => form.submit(), 500);
        }
    });
});
</script>
@endpush
