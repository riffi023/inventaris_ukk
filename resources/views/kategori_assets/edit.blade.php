@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="mb-0">Edit Kategori Asset</h3>
                        <a class="btn btn-light" href="{{ route('kategori_asset.index') }}">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Error!</strong> Ada beberapa masalah dengan input Anda.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('kategori_asset.update', $kategoriAsset->id_kategori_asset) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="kode_kategori_asset" class="form-label">Kode Kategori Asset</label>
                            <input type="text" name="kode_kategori_asset" class="form-control" 
                                   id="kode_kategori_asset" value="{{ $kategoriAsset->kode_kategori_asset }}" 
                                   placeholder="Masukkan Kode Kategori Asset">
                        </div>

                        <div class="mb-3">
                            <label for="kategori_asset" class="form-label">Kategori Asset</label>
                            <input type="text" name="kategori_asset" class="form-control" 
                                   id="kategori_asset" value="{{ $kategoriAsset->kategori_asset }}"
                                   placeholder="Masukkan Kategori Asset">
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
@endsection
