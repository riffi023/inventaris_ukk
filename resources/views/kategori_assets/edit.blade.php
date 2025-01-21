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

@section('content')
<div class="edit-card">
    <div class="edit-header">
        <h5 class="mb-0"><i class="fas fa-edit me-2"></i>Edit Kategori Asset</h5>
        <p class="mb-0 text-white-50">Update informasi kategori asset</p>
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

        <form action="{{ route('kategori_asset.update', $kategoriAsset->id_kategori_asset) }}" method="POST" id="editForm">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="kode_kategori_asset">
                            <i class="fas fa-hashtag"></i> Kode Kategori Asset
                        </label>
                        <input type="text" name="kode_kategori_asset" 
                               class="form-control @error('kode_kategori_asset') is-invalid @enderror" 
                               id="kode_kategori_asset" 
                               value="{{ old('kode_kategori_asset', $kategoriAsset->kode_kategori_asset) }}" 
                               placeholder="Masukkan Kode Kategori Asset">
                        @error('kode_kategori_asset')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="kategori_asset">
                            <i class="fas fa-tags"></i> Kategori Asset
                        </label>
                        <input type="text" name="kategori_asset" 
                               class="form-control @error('kategori_asset') is-invalid @enderror" 
                               id="kategori_asset" 
                               value="{{ old('kategori_asset', $kategoriAsset->kategori_asset) }}"
                               placeholder="Masukkan Kategori Asset">
                        @error('kategori_asset')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary me-2">
                    <i class="fas fa-save me-2"></i>Update
                </button>
                <a class="btn btn-primary" href="{{ route('kategori_asset.index') }}">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
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
            kode_kategori_asset: {
                required: true,
                minlength: 3
            },
            kategori_asset: {
                required: true,
                minlength: 3
            }
        },
        messages: {
            kode_kategori_asset: {
                required: "Kode kategori harus diisi",
                minlength: "Minimal 3 karakter"
            },
            kategori_asset: {
                required: "Kategori asset harus diisi",
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
