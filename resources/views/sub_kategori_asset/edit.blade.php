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
    .form-control {
        height: 45px;
        border-radius: 10px;
        padding: 10px 15px 10px 40px;
        border: 2px solid #e3e6f0;
        font-size: 14px;
        transition: all 0.3s ease;
    }
    .form-control:focus {
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
    .btn-loading {
        position: relative;
        color: transparent !important;
    }
    .btn-loading:after {
        content: '';
        position: absolute;
        width: 16px;
        height: 16px;
        top: 50%;
        left: 50%;
        margin-top: -8px;
        margin-left: -8px;
        border-radius: 50%;
        border: 2px solid rgba(255,255,255,0.3);
        border-top-color: #fff;
        animation: spin 1s linear infinite;
    }
    @keyframes spin {
        to { transform: rotate(360deg); }
    }
</style>
@endsection

@section('title', 'Edit Sub Kategori Asset')

@section('content')
<div class="edit-card">
    <div class="edit-header">
        <h5 class="mb-0">Edit Sub Kategori Asset</h5>
        <p class="mb-0 text-white-50">Update informasi sub kategori asset</p>
    </div>

    <div class="edit-body">
        @include('components.alert')

        <form action="{{ route('sub-kategori-asset.update', $subKategoriAsset->id_sub_kategori_asset) }}" method="POST" id="editForm">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="id_kategori_asset">
                            <i class="fas fa-folder"></i> Kategori Asset:
                        </label>
                        <select name="id_kategori_asset" id="id_kategori_asset" 
                                class="form-control @error('id_kategori_asset') is-invalid @enderror">
                            <option value="">Pilih Kategori Asset</option>
                            @foreach($kategoriAssets as $kategori)
                                <option value="{{ $kategori->id_kategori_asset }}" 
                                    {{ $subKategoriAsset->id_kategori_asset == $kategori->id_kategori_asset ? 'selected' : '' }}>
                                    {{ $kategori->kategori_asset }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_kategori_asset')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="kode_sub_kategori_asset">
                            <i class="fas fa-hashtag"></i> Kode Sub Kategori:
                        </label>
                        <input type="text" id="kode_sub_kategori_asset" name="kode_sub_kategori_asset" 
                               value="{{ old('kode_sub_kategori_asset', $subKategoriAsset->kode_sub_kategori_asset) }}"
                               class="form-control @error('kode_sub_kategori_asset') is-invalid @enderror" 
                               placeholder="Masukkan Kode Sub Kategori">
                        @error('kode_sub_kategori_asset')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="sub_kategori_asset">
                            <i class="fas fa-tag"></i> Nama Sub Kategori:
                        </label>
                        <input type="text" id="sub_kategori_asset" name="sub_kategori_asset"
                               value="{{ old('sub_kategori_asset', $subKategoriAsset->sub_kategori_asset) }}"
                               class="form-control @error('sub_kategori_asset') is-invalid @enderror"
                               placeholder="Masukkan Nama Sub Kategori">
                        @error('sub_kategori_asset')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary me-2">
                    <i class="fas fa-save"></i> Update
                </button>
                <a class="btn btn-secondary" href="{{ route('sub-kategori-asset.index') }}">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
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
        rules: {
            id_kategori_asset: {
                required: true
            },
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
            id_kategori_asset: {
                required: "Kategori asset harus dipilih"
            },
            kode_sub_kategori_asset: {
                required: "Kode sub kategori harus diisi",
                minlength: "Minimal 3 karakter"
            },
            sub_kategori_asset: {
                required: "Nama sub kategori harus diisi",
                minlength: "Minimal 3 karakter"
            }
        },
        errorElement: 'span',
        errorPlacement: function(error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function(element) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function(element) {
            $(element).removeClass('is-invalid');
        },
        submitHandler: function(form) {
            const submitBtn = $('.btn-primary');
            submitBtn.prop('disabled', true)
                    .addClass('btn-loading')
                    .html('<i class="fas fa-spinner fa-spin"></i> Memperbarui...');
            
            setTimeout(() => form.submit(), 500);
        }
    });

    // Real-time validation
    $('.form-control').on('blur', function() {
        $(this).valid();
    });

    // Prevent form submission on Enter
    $(window).keydown(function(event) {
        if(event.keyCode == 13) {
            event.preventDefault();
            return false;
        }
    });
});
</script>
@endpush
