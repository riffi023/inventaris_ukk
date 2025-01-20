@extends('layouts.admin')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
<style>
    .card {
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
        border: none;
    }
    .card-header {
        background: linear-gradient(45deg, #4e73df, #36b9cc);
        color: white;
        border-radius: 15px 15px 0 0 !important;
        padding: 15px 20px;
    }
    .form-group {
        margin-bottom: 1.8rem;
        position: relative;
    }
    .form-group label {
        font-weight: 600;
        color: #4e73df;
        margin-bottom: 0.7rem;
        display: block;
        font-size: 0.95rem;
    }
    .form-group i {
        position: absolute;
        left: 15px;
        top: 45px;
        color: #4e73df;
        font-size: 1.1rem;
    }
    .form-control {
        height: 48px;
        border-radius: 10px;
        padding: 12px 45px;
        border: 2px solid #e3e6f0;
        font-size: 0.95rem;
        transition: all 0.3s ease;
    }
    textarea.form-control {
        height: auto;
        padding-top: 15px;
    }
    .form-control:focus {
        border-color: #4e73df;
        box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
    }
    .btn {
        padding: 12px 25px;
        font-weight: 600;
        border-radius: 10px;
        transition: all 0.3s ease;
    }
    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }
    .edit-card {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        animation: slideIn 0.3s ease-out;
    }
    .edit-header {
        background: linear-gradient(135deg, #4e73df 0%, #1565c0 100%);
        color: white;
        padding: 25px 30px;
        border: none;
    }
    .edit-body {
        padding: 30px;
    }
    .button-group {
        margin-top: 35px;
        padding-top: 25px;
        border-top: 1px solid rgba(0,0,0,0.05);
    }
    .button-group .btn {
        min-width: 140px;
        margin: 0 8px;
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
</style>
@endsection

@section('title', 'Edit Merk')

@section('content')
<div class="edit-card animate__animated animate__fadeIn">
    <div class="edit-header">
        <h5 class="mb-0">Edit Merk</h5>
        <p class="mb-0 text-white-50">Update informasi merk</p>
    </div>
    
    <div class="edit-body">
        @include('components.alert')
        
        <form action="{{ route('merk.update', $merk->id_merk) }}" method="POST" id="editForm">
            @csrf
            @method('PUT')
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="merk">
                            <i class="fas fa-tag"></i> Nama Merk
                        </label>
                        <input 
                            type="text" 
                            id="merk" 
                            name="merk" 
                            value="{{ old('merk', $merk->merk) }}" 
                            class="form-control @error('merk') is-invalid @enderror" 
                            placeholder="Masukkan nama merk"
                            required
                            maxlength="100">
                        <small class="text-muted">Masukkan nama merk (2-100 karakter)</small>
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
                        <textarea 
                            id="keterangan" 
                            class="form-control @error('keterangan') is-invalid @enderror" 
                            name="keterangan" 
                            rows="3" 
                            placeholder="Masukkan Keterangan"
                            maxlength="255"
                            required>{{ old('keterangan', $merk->keterangan) }}</textarea>
                        <small class="text-muted">Masukkan keterangan (5-255 karakter)</small>
                        @error('keterangan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="button-group text-center">
                <button type="submit" class="btn btn-primary shadow-sm" id="submitBtn">
                    <i class="fas fa-save me-2"></i> Update
                </button>
                <a class="btn btn-secondary shadow-sm" href="{{ route('merk.index') }}">
                    <i class="fas fa-arrow-left me-2"></i> Kembali
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
            merk: {
                required: true,
                minlength: 2,
                maxlength: 100
            },
            keterangan: {
                required: true,
                minlength: 5,
                maxlength: 255
            }
        },
        messages: {
            merk: {
                required: "Nama merk harus diisi",
                minlength: "Minimal 2 karakter",
                maxlength: "Maksimal 100 karakter"
            },
            keterangan: {
                required: "Keterangan harus diisi",
                minlength: "Minimal 5 karakter",
                maxlength: "Maksimal 255 karakter"
            }
        },
        errorElement: 'div',
        errorPlacement: function(error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function(element) {
            $(element).addClass('is-invalid').removeClass('is-valid');
        },
        unhighlight: function(element) {
            $(element).removeClass('is-invalid').addClass('is-valid');
        },
        submitHandler: function(form) {
            $('#submitBtn')
                .prop('disabled', true)
                .html('<i class="fas fa-spinner fa-spin"></i> Memproses...');
            form.submit();
        }
    });

    $('.form-control').on('blur', function() {
        $(this).valid();
    });
});
</script>
@endpush
