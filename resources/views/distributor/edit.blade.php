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
        color: #4e73df;
    }
    .form-control {
        height: 45px;
        border-radius: 10px;
        padding: 10px 15px;
        border: 2px solid #e3e6f0;
        font-size: 14px;
        transition: all 0.3s ease;
        padding-left: 40px;
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
    .btn-secondary:hover {
        background-color: #858796;
    }
    .is-invalid {
        border-color: #e74a3b !important;
    }
    .invalid-feedback {
        display: block;
        margin-top: 0.25rem;
        font-size: 0.875em;
        color: #e74a3b;
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
    .input-group {
        position: relative;
        margin-bottom: 1.5rem;
    }
    .floating-label {
        position: absolute;
        pointer-events: none;
        left: 45px;
        top: 12px;
        transition: 0.2s ease all;
        color: #a0aec0;
    }
    .form-control:focus ~ .floating-label,
    .form-control:not(:placeholder-shown) ~ .floating-label {
        top: -10px;
        left: 15px;
        font-size: 12px;
        color: var(--primary);
        background: white;
        padding: 0 5px;
    }
    .input-icon {
        position: absolute;
        left: 15px;
        top: 12px;
        color: #a0aec0;
        transition: 0.2s ease all;
    }
    .form-control:focus ~ .input-icon {
        color: var(--primary);
    }
</style>
@endsection

@section('content')
<div class="edit-card">
    <div class="edit-header">
        <h5 class="mb-0">Edit Distributor</h5>
        <p class="mb-0 text-white-50">Update informasi distributor</p>
    </div>
    
    <div class="edit-body">
        @include('components.alert')
        
        <form action="{{ route('distributor.update', $distributor->id_distributor) }}" method="POST" id="editForm">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nama_distributor">
                            <i class="fas fa-building"></i> Nama Distributor:
                        </label>
                        <input 
                            type="text" 
                            id="nama_distributor" 
                            name="nama_distributor" 
                            value="{{ old('nama_distributor', $distributor->nama_distributor) }}" 
                            class="form-control @error('nama_distributor') is-invalid @enderror" 
                            placeholder="Masukkan Nama Distributor" 
                            required 
                            aria-required="true">
                    </div>
                    <div class="form-group">
                        <label for="alamat">
                            <i class="fas fa-map-marker-alt"></i> Alamat:
                        </label>
                        <textarea 
                            id="alamat" 
                            class="form-control @error('alamat') is-invalid @enderror" 
                            name="alamat" 
                            rows="3" 
                            placeholder="Masukkan Alamat" 
                            required>{{ old('alamat', $distributor->alamat) }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="no_telp">
                            <i class="fas fa-phone"></i> No. Telepon:
                        </label>
                        <input 
                            type="text" 
                            id="no_telp" 
                            name="no_telp" 
                            value="{{ old('no_telp', $distributor->no_telp) }}" 
                            class="form-control @error('no_telp') is-invalid @enderror" 
                            placeholder="Masukkan No. Telepon" 
                            required 
                            pattern="\d+" 
                            aria-required="true">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email">
                            <i class="fas fa-envelope"></i> Email:
                        </label>
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            value="{{ old('email', $distributor->email) }}" 
                            class="form-control @error('email') is-invalid @enderror" 
                            placeholder="Masukkan Email" 
                            required 
                            aria-required="true">
                    </div>
                    <div class="form-group">
                        <label for="keterangan">
                            <i class="fas fa-info-circle"></i> Keterangan:
                        </label>
                        <textarea 
                            id="keterangan" 
                            class="form-control @error('keterangan') is-invalid @enderror" 
                            name="keterangan" 
                            rows="3" 
                            placeholder="Masukkan Keterangan">{{ old('keterangan', $distributor->keterangan) }}</textarea>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Update
                </button>
                <a class="btn btn-secondary" href="{{ route('distributor.index') }}">
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
    // Form validation
    $("#editForm").validate({
        rules: {
            nama_distributor: {
                required: true,
                minlength: 3
            },
            alamat: {
                required: true,
                minlength: 5
            },
            no_telp: {
                required: true,
                digits: true,
                minlength: 10,
                maxlength: 15
            },
            email: {
                required: true,
                email: true
            },
            keterangan: {
                required: true
            }
        },
        messages: {
            nama_distributor: {
                required: "Nama distributor harus diisi",
                minlength: "Minimal 3 karakter"
            },
            alamat: {
                required: "Alamat harus diisi",
                minlength: "Minimal 5 karakter"
            },
            no_telp: {
                required: "Nomor telepon harus diisi",
                digits: "Hanya angka yang diperbolehkan",
                minlength: "Minimal 10 digit",
                maxlength: "Maksimal 15 digit"
            },
            email: {
                required: "Email harus diisi",
                email: "Format email tidak valid"
            },
            keterangan: {
                required: "Keterangan harus diisi"
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
            
            // Simulate loading for better UX
            setTimeout(() => form.submit(), 500);
        }
    });

    // Phone number validation
    $('#no_telp').on('input', function() {
        this.value = this.value.replace(/[^0-9]/g, '');
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
