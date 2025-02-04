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
    .form-control, .form-select {
        height: 45px;
        border-radius: 10px;
        padding: 10px 15px;
        border: 2px solid #e3e6f0;
        font-size: 14px;
        transition: all 0.3s ease;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="edit-card">
                <div class="edit-header">
                    <h5 class="mb-0"><i class="fas fa-plus-circle me-2"></i>Tambah Sub Kategori Asset</h5>
                    <p class="mb-0 text-white-50">Tambah sub kategori asset baru</p>
                </div>

                <div class="edit-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('sub-kategori-asset.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><i class="fas fa-layer-group me-2"></i>Kategori Asset</label>
                                    <select name="id_kategori_asset" class="form-select @error('id_kategori_asset') is-invalid @enderror">
                                        <option value="">Pilih Kategori Asset</option>
                                        @foreach($kategoriAssets as $kategori)
                                            <option value="{{ $kategori->id_kategori_asset }}">{{ $kategori->kategori_asset }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_kategori_asset')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><i class="fas fa-hashtag me-2"></i>Kode Sub Kategori</label>
                                    <input type="text" name="kode_sub_kategori_asset" class="form-control @error('kode_sub_kategori_asset') is-invalid @enderror">
                                    @error('kode_sub_kategori_asset')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label><i class="fas fa-tag me-2"></i>Nama Sub Kategori</label>
                                    <input type="text" name="sub_kategori_asset" class="form-control @error('sub_kategori_asset') is-invalid @enderror">
                                    @error('sub_kategori_asset')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="text-center mt-4">
                            <a href="{{ route('sub-kategori-asset.index') }}" class="btn btn-secondary me-2">
                                <i class="fas fa-arrow-left me-2"></i>Kembali
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
