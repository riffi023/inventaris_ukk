@extends('layouts.admin')

@section('styles')
<style>
    .edit-card {
        background: white;
        border-radius: 8px;
        box-shadow: 0 0 15px rgba(0,0,0,0.1);
    }
    .edit-header {
        background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
        color: white;
        padding: 20px;
        border-radius: 8px 8px 0 0;
    }
    .edit-body {
        padding: 20px;
    }
    .form-group {
        margin-bottom: 1rem;
    }
    .form-group label {
        font-weight: 500;
        margin-bottom: 0.5rem;
        color: #4e73df;
    }
    .button-group {
        margin-top: 2rem;
    }
</style>
@endsection

@section('content')
<div class="edit-card animate__animated animate__fadeIn">
    <div class="edit-header">
        <h5 class="mb-0"><i class="fas fa-plus-square me-2"></i>Tambah Master Barang</h5>
        <p class="mb-0 text-white-50">Tambah data master barang baru</p>
    </div>
    
    <div class="edit-body">
        <form action="{{ route('master_barang.store') }}" method="POST" id="createForm">
            @csrf
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="kode_barang">
                            <i class="fas fa-barcode"></i> Kode Barang
                        </label>
                        <input type="text" 
                               class="form-control @error('kode_barang') is-invalid @enderror"
                               id="kode_barang" 
                               name="kode_barang"
                               value="{{ old('kode_barang') }}"
                               maxlength="20"
                               required>
                        @error('kode_barang')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="nama_barang">
                            <i class="fas fa-box"></i> Nama Barang
                        </label>
                        <input type="text"
                               class="form-control @error('nama_barang') is-invalid @enderror"
                               id="nama_barang"
                               name="nama_barang"
                               value="{{ old('nama_barang') }}"
                               maxlength="100"
                               required>
                        @error('nama_barang')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="spesifikasi_teknis">
                            <i class="fas fa-clipboard-list"></i> Spesifikasi Teknis
                        </label>
                        <input type="text"
                               class="form-control @error('spesifikasi_teknis') is-invalid @enderror"
                               id="spesifikasi_teknis"
                               name="spesifikasi_teknis"
                               value="{{ old('spesifikasi_teknis') }}"
                               maxlength="100"
                               required>
                        @error('spesifikasi_teknis')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-2"></i>Simpan
                </button>
                <a href="{{ route('master_barang.index') }}" class="btn btn-primary">
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
                kode_barang: {
                    required: true,
                    maxlength: 20
                },
                nama_barang: {
                    required: true,
                    maxlength: 100
                },
                spesifikasi_teknis: {
                    required: true,
                    maxlength: 100
                }
            },
            messages: {
                kode_barang: {
                    required: "Kode barang harus diisi",
                    maxlength: "Maksimal 20 karakter"
                },
                nama_barang: {
                    required: "Nama barang harus diisi",
                    maxlength: "Maksimal 100 karakter"
                },
                spesifikasi_teknis: {
                    required: "Spesifikasi teknis harus diisi",
                    maxlength: "Maksimal 100 karakter"
                }
            },
            errorElement: 'div',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element) {
                $(element).removeClass('is-invalid');
            }
        });
    });
</script>
@endpush
