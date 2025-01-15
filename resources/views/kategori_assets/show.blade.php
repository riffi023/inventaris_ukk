@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-info text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="mb-0">Detail Kategori Asset</h3>
                        <a class="btn btn-light" href="{{ route('kategori_asset.index') }}">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <th class="bg-light" width="30%">Kode Kategori</th>
                                <td>{{ $kategoriAsset->kode_kategori_asset }}</td>
                            </tr>
                            <tr>
                                <th class="bg-light">Kategori Asset</th>
                                <td>{{ $kategoriAsset->kategori_asset }}</td>
                            </tr>
                            <tr>
                                <th class="bg-light">Dibuat pada</th>
                                <td>{{ $kategoriAsset->created_at->format('d F Y H:i:s') }}</td>
                            </tr>
                            <tr>
                                <th class="bg-light">Diperbarui pada</th>
                                <td>{{ $kategoriAsset->updated_at->format('d F Y H:i:s') }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
@endsection
