@extends('layouts.admin')
@section('styles')
<style>
    .card {
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.15);
        border: none;
    }
    .card-header {
        background: linear-gradient(45deg, #4e73df, #36b9cc);
        color: white;
        border-radius: 15px 15px 0 0 !important;
        padding: 15px 20px;
    }
    .form-label-group {
        position: relative;
        margin-bottom: 1.5rem;
    }
    .form-label-group label {
        font-weight: 600;
        color: #4e73df;
        margin-bottom: 0.5rem;
        display: block;
    }
    .form-label-group i {
        position: absolute;
        left: 15px;
        top: 42px;
        color: #4e73df;
        z-index: 2;
    }
    .form-control {
        height: 45px;
        border-radius: 10px;
        padding: 10px 15px 10px 40px;
        border: 2px solid #e3e6f0;
        font-size: 14px;
        transition: all 0.3s ease;
    }
    textarea.form-control {
        height: auto;
        padding-top: 15px;
    }
    .form-control:focus {
        border-color: #4e73df;
        box-shadow: 0 0 0 0.2rem rgba(78,115,223,0.25);
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
    .alert {
        border-radius: 10px;
        border: none;
    }
    /* Use more specific selectors */
    .distributor-card {
        border-radius: 15px !important;
        box-shadow: 0 5px 15px rgba(0,0,0,0.15) !important;
        border: none !important;
    }
    .distributor-card .card-header {
        background: linear-gradient(45deg, #4e73df, #36b9cc) !important;
        color: white !important;
    }
    /* Add more specific selectors */
    .distributor-form .form-control {
        height: 45px !important;
        padding-left: 40px !important;
    }
    
    .distributor-form .form-label-group {
        position: relative;
        margin-bottom: 1.5rem;
    }
    
    .distributor-form .form-label-group i {
        position: absolute;
        left: 15px;
        top: 42px;
        color: var(--primary-color);
        z-index: 2;
    }
    
    .distributor-form .invalid-feedback {
        display: block;
        color: var(--danger-color);
    }
    .form-card {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(0,0,0,0.05);
    }
    .form-card .card-header {
        background: linear-gradient(135deg, var(--primary) 0%, #2a52be 100%);
        color: white;
        padding: 20px;
        border: none;
    }
    .form-body {
        padding: 30px;
    }
    .form-group {
        margin-bottom: 1.5rem;
        position: relative;
    }
    .form-control {
        border-radius: 10px;
        border: 2px solid #edf2f7;
        padding: 12px 16px 12px 45px;
        font-size: 0.95rem;
        transition: all 0.2s;
    }
    .form-control:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 0.2rem rgba(78,115,223,0.15);
    }
    .form-icon {
        position: absolute;
        left: 15px;
        top: 42px;
        color: #a0aec0;
        transition: all 0.2s;
    }
    .form-control:focus + .form-icon {
        color: var(--primary);
    }
    .btn-submit {
        padding: 12px 30px;
        font-weight: 600;
        border-radius: 10px;
        transition: all 0.2s;
    }
    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
@endsection

@section('content')
<div class="form-card">
    <div class="card-header">
        <h5 class="mb-0">Tambah Distributor Baru</h5>
        <p class="mb-0 text-white-50">Isi form dibawah dengan data yang benar</p>
    </div>
    
    <div class="form-body">
        @include('components.alert')
        
        <form action="{{ route('distributor.store') }}" method="POST" class="needs-validation" novalidate>
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-label-group">
                        <i class="fas fa-building"></i>
                        <label>Nama Distributor:</label>
                        <input type="text" name="nama_distributor" class="form-control" placeholder="Masukkan Nama Distributor">
                    </div>
                    <div class="form-label-group">
                        <i class="fas fa-map-marker-alt"></i>
                        <label>Alamat:</label>
                        <textarea class="form-control" name="alamat" rows="3" placeholder="Masukkan Alamat"></textarea>
                    </div>
                    <div class="form-label-group">
                        <i class="fas fa-phone"></i>
                        <label>No. Telepon:</label>
                        <input type="text" name="no_telp" class="form-control" placeholder="Masukkan No. Telepon">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-label-group">
                        <i class="fas fa-envelope"></i>
                        <label>Email:</label>
                        <input type="email" name="email" class="form-control" placeholder="Masukkan Email">
                    </div>
                    <div class="form-label-group">
                        <i class="fas fa-info-circle"></i>
                        <label>Keterangan:</label>
                        <textarea class="form-control" name="keterangan" rows="3" placeholder="Masukkan Keterangan"></textarea>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Simpan
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
    $("form").validate({
        rules: {
            nama_distributor: "required",
            alamat: "required",
            no_telp: {
                required: true,
                digits: true,
                minlength: 10
            },
            email: {
                required: true,
                email: true
            },
            keterangan: "required"
        },
        messages: {
            nama_distributor: "Nama distributor harus diisi",
            alamat: "Alamat harus diisi",
            no_telp: {
                required: "Nomor telepon harus diisi",
                digits: "Hanya angka yang diperbolehkan",
                minlength: "Minimal 10 digit"
            },
            email: {
                required: "Email harus diisi",
                email: "Format email tidak valid"
            },
            keterangan: "Keterangan harus diisi"
        },
        errorElement: 'span',
        errorPlacement: function(error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-label-group').append(error);
        },
        highlight: function(element) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function(element) {
            $(element).removeClass('is-invalid');
        },
        submitHandler: function(form) {
            $('.btn-primary').prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Menyimpan...');
            form.submit();
        }
    });

    // Input mask for phone number
    $('input[name="no_telp"]').on('input', function() {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
});
</script>
@endpush
