@extends('layouts.admin')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
<style>
    .create-card {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(0,0,0,0.05);
    }
    .create-header {
        background: linear-gradient(135deg, var(--primary) 0%, #2a52be 100%);
        color: white;
        padding: 20px;
        border: none;
    }
    .create-body {
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
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
</style>
@endsection

@section('content')
<div class="create-card">
    <div class="create-header">
        <h5 class="mb-0">Tambah Depresiasi</h5>
        <p class="mb-0 text-white-50">Tambah data depresiasi baru</p>
    </div>
    
    <div class="create-body">
        @include('components.alert')
        
        <form action="{{ route('depresiasi.store') }}" method="POST" id="createForm">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="lama_depresiasi">
                            <i class="fas fa-clock"></i> Lama Depresiasi (Bulan):
                        </label>
                        <input 
                            type="number" 
                            id="lama_depresiasi" 
                            name="lama_depresiasi" 
                            value="{{ old('lama_depresiasi') }}" 
                            class="form-control @error('lama_depresiasi') is-invalid @enderror" 
                            placeholder="Masukkan Lama Depresiasi dalam Bulan"
                            min="1"
                            max="600"
                            required>
                        <small class="text-muted">Masukkan periode depresiasi dalam bulan (1-600 bulan)</small>
                        @error('lama_depresiasi')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="keterangan">
                            <i class="fas fa-info-circle"></i> Keterangan:
                        </label>
                        <textarea 
                            id="keterangan" 
                            class="form-control @error('keterangan') is-invalid @enderror" 
                            name="keterangan" 
                            rows="3" 
                            placeholder="Masukkan Keterangan"
                            required>{{ old('keterangan') }}</textarea>
                        @error('keterangan')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Simpan
                </button>
                <a href="{{ route('depresiasi.index') }}" class="btn btn-secondary">
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
    $("#createForm").validate({
        rules: {
            lama_depresiasi: {
                required: true,
                number: true,
                min: 1,
                max: 600
            },
            keterangan: {
                required: true,
                minlength: 5
            }
        },
        messages: {
            lama_depresiasi: {
                required: "Lama depresiasi harus diisi",
                number: "Harus berupa angka",
                min: "Minimal 1 bulan",
                max: "Maksimal 600 bulan (50 tahun)"
            },
            keterangan: {
                required: "Keterangan harus diisi",
                minlength: "Minimal 5 karakter"
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
