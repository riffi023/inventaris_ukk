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
        background: linear-gradient(45deg, #4e73df, #36b9cc);
        color: white;
        padding: 20px;
        border: none;
    }
    .edit-body {
        padding: 20px;
    }
    .form-group {
        background: #f8f9fc;
        padding: 20px;
        border-radius: 10px;
        margin-bottom: 1.5rem;
        transition: all 0.3s ease;
    }
    .form-group:hover {
        background: #fff;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    .form-group label {
        font-weight: 500;
        margin-bottom: 0.5rem;
        color: #4e73df;
    }
    .form-control:focus {
        border-color: #4e73df;
        box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
    }
    .btn-primary {
        background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
        border: none;
        padding: 12px 35px;
        transition: all 0.3s ease;
    }
</style>
@endsection

@section('content')
<div class="edit-card animate__animated animate__fadeIn">
    <div class="edit-header">
        <h5 class="mb-0">
            <i class="fas fa-edit me-2"></i>Edit Merk
        </h5>
        <p class="mb-0 text-white-50">Update informasi untuk merk #{{ $merk->id_merk }}</p>
    </div>
    
    <div class="edit-body">
        <form action="{{ route('merk.update', $merk->id_merk) }}" method="POST" id="editForm">
            @csrf
            @method('PUT')
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="merk">
                            <i class="fas fa-tag"></i> Nama Merk
                        </label>
                        <input type="text" 
                               class="form-control @error('merk') is-invalid @enderror"
                               id="merk" 
                               name="merk"
                               value="{{ old('merk', $merk->merk) }}"
                               maxlength="50"
                               required>
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
                        <textarea class="form-control @error('keterangan') is-invalid @enderror"
                                  id="keterangan"
                                  name="keterangan"
                                  rows="3"
                                  maxlength="500"
                                  required>{{ old('keterangan', $merk->keterangan) }}</textarea>
                        @error('keterangan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-2"></i>Update
                </button>
                <a href="{{ route('merk.index') }}" class="btn btn-primary">
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
        $('#editForm').validate({
            rules: {
                merk: {
                    required: true,
                    maxlength: 50
                },
                keterangan: {
                    required: true,
                    maxlength: 500
                }
            },
            messages: {
                merk: {
                    required: "Nama merk harus diisi",
                    maxlength: "Maksimal 50 karakter"
                },
                keterangan: {
                    required: "Keterangan harus diisi",
                    maxlength: "Maksimal 500 karakter"
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