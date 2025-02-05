@extends('layouts.user')

@section('title', 'Edit Opname')

@section('user-content')
<div class="edit-card">
    <div class="edit-header">
        <h5 class="mb-0">
            <i class="fas fa-edit me-2"></i>Edit Opname
        </h5>
        <p class="mb-0 text-white-50">Edit data opname</p>
    </div>
    
    <div class="edit-body">
        <form action="{{ route('user.opname.update', $opname) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="id_pengadaan">
                            <i class="fas fa-box me-2"></i>Barang
                        </label>
                        <select name="id_pengadaan" id="id_pengadaan" 
                                class="form-select @error('id_pengadaan') is-invalid @enderror" required>
                            <option value="">Pilih Barang</option>
                            @foreach($pengadaans as $pengadaan)
                                <option value="{{ $pengadaan->id_pengadaan }}" 
                                        data-stock="{{ $pengadaan->stock_barang }}"
                                        data-satuan="{{ $pengadaan->satuan->nama_satuan }}"
                                        {{ $opname->id_pengadaan == $pengadaan->id_pengadaan ? 'selected' : '' }}>
                                    {{ $pengadaan->masterBarang->nama_barang }}
                                    (Stock: {{ number_format($pengadaan->stock_barang, 0, ',', '.') }}
                                    {{ $pengadaan->satuan->nama_satuan }})
                                </option>
                            @endforeach
                        </select>
                        @error('id_pengadaan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="tgl_opname">
                            <i class="fas fa-calendar-alt me-2"></i>Tanggal Opname
                        </label>
                        <input type="date" class="form-control @error('tgl_opname') is-invalid @enderror"
                               id="tgl_opname" name="tgl_opname" 
                               value="{{ old('tgl_opname', $opname->tgl_opname->format('Y-m-d')) }}" required>
                        @error('tgl_opname')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="kondisi">
                            <i class="fas fa-info-circle me-2"></i>Kondisi
                        </label>
                        <select name="kondisi" id="kondisi" 
                                class="form-select @error('kondisi') is-invalid @enderror" required>
                            <option value="">Pilih Kondisi</option>
                            <option value="Baik" {{ $opname->kondisi == 'Baik' ? 'selected' : '' }}>Baik</option>
                            <option value="Rusak Ringan" {{ $opname->kondisi == 'Rusak Ringan' ? 'selected' : '' }}>
                                Rusak Ringan
                            </option>
                            <option value="Rusak Berat" {{ $opname->kondisi == 'Rusak Berat' ? 'selected' : '' }}>
                                Rusak Berat
                            </option>
                        </select>
                        @error('kondisi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="nama_pegawai">
                            <i class="fas fa-user me-2"></i>Nama Pegawai
                        </label>
                        <input type="text" class="form-control @error('nama_pegawai') is-invalid @enderror"
                               id="nama_pegawai" name="nama_pegawai" 
                               value="{{ old('nama_pegawai', $opname->nama_pegawai) }}" required>
                        @error('nama_pegawai')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="stock_update">
                            <i class="fas fa-boxes me-2"></i>Update Stock
                        </label>
                        <div class="input-group">
                            <input type="number" class="form-control @error('stock_update') is-invalid @enderror"
                                   id="stock_update" name="stock_update" 
                                   value="{{ old('stock_update', $opname->stock_update) }}" min="0">
                            <span class="input-group-text bg-light" id="satuan-text">
                                {{ $opname->pengadaan->satuan->nama_satuan }}
                            </span>
                        </div>
                        <small class="form-text text-muted" id="current-stock">
                            Stock saat ini: {{ number_format($opname->pengadaan->stock_barang, 0, ',', '.') }}
                            {{ $opname->pengadaan->satuan->nama_satuan }}
                        </small>
                        @error('stock_update')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="keterangan">
                            <i class="fas fa-sticky-note me-2"></i>Keterangan
                        </label>
                        <textarea class="form-control @error('keterangan') is-invalid @enderror"
                                  id="keterangan" name="keterangan" rows="4" required>{{ old('keterangan', $opname->keterangan) }}</textarea>
                        @error('keterangan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="button-group text-end">
                <a href="{{ route('user.opname.index') }}" class="btn btn-secondary me-2">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-2"></i>Update
                </button>
            </div>
        </form>
    </div>
</div>

<style>
    .edit-card {
        background: #f8f9fa;
        border-radius: 10px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        padding: 20px;
        margin-top: 20px;
    }

    .edit-header {
        background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
        color: white;
        padding: 15px;
        border-radius: 10px 10px 0 0;
    }

    .form-group label {
        font-weight: bold;
        color: #4e73df;
    }

    .form-control:focus {
        border-color: #4e73df;
        box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
    }

    .button-group .btn {
        border-radius: 5px;
    }
</style>
@endsection
