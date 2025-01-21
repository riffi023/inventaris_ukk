@extends('layouts.admin')

@section('styles')
<style>
    .edit-card {
        background: white;
        border-radius: 8px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
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

    .form-control-static {
        padding: 12px 16px;
        background: #f8f9fc;
        border-radius: 4px;
        min-height: 45px;
        border: 1px solid #e3e6f0;
    }
</style>
@endsection

@section('content')
<div class="edit-card animate__animated animate__fadeIn">
    <div class="edit-header">
        <h5 class="mb-0"><i class="fas fa-eye me-2"></i>Detail Satuan</h5>
        <p class="mb-0 text-white-50">Informasi detail satuan</p>
    </div>

    <div class="edit-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>
                        <i class="fas fa-ruler me-2"></i>Satuan
                    </label>
                    <p class="form-control-static">{{ $satuan->satuan }}</p>
                </div>
            </div>
        </div>

        <div class="text-center mt-4">
            <a href="{{ route('satuan.index') }}" class="btn btn-primary">
                <i class="fas fa-arrow-left me-2"></i>Kembali
            </a>
        </div>
    </div>
</div>
@endsection