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
    .form-group {
        margin-bottom: 1.5rem;
        color: #4e73df;
        position: relative;
    }
    .form-control {
        border-radius: 10px;
        border: 2px solid #edf2f7;
        padding: 12px 16px 12px 45px;
        font-size: 0.95rem;
        transition: all 0.2s;
        height: 45px;
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
</style>
@endsection

@section('content')
<div class="edit-card">
    <div class="edit-header">
        <h5 class="mb-0"><i class="fas fa-plus-circle me-2"></i>Tambah Kategori Asset</h5>
        <p class="mb-0 text-white-50">Tambah kategori asset baru</p>
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

        <form method="POST" action="{{ route('kategori_asset.store') }}" id="editForm">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="kode_kategori_asset">
                            <i class="fas fa-barcode"></i> Kode Kategori Asset:
                        </label>
                        <input 
                            type="text" 
                            class="form-control @error('kode_kategori_asset') is-invalid @enderror" 
                            id="kode_kategori_asset" 
                            name="kode_kategori_asset" 
                            value="{{ old('kode_kategori_asset') }}" 
                            required 
                            placeholder="Masukkan Kode Kategori Asset">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="kategori_asset">
                            <i class="fas fa-tags"></i> Kategori Asset:
                        </label>
                        <input 
                            type="text" 
                            class="form-control @error('kategori_asset') is-invalid @enderror" 
                            id="kategori_asset" 
                            name="kategori_asset" 
                            value="{{ old('kategori_asset') }}" 
                            required 
                            placeholder="Masukkan Nama Kategori Asset">
                    </div>
                </div>
            </div>
            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-2"></i>Simpan
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
                required: "Kode kategori asset harus diisi",
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
                    .html('<i class="fas fa-spinner fa-spin"></i> Menyimpan...');
            
            setTimeout(() => form.submit(), 500);
        }
    });

    $('.form-control').on('blur', function() {
        $(this).valid();
    });
});
</script>
@endpush
