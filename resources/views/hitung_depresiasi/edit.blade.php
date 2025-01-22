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
        background: linear-gradient(135deg, var(--primary) 0%, #2a52be 100%);
        color: white;
        padding: 20px;
        border: none;
    }
    .edit-body {
        padding: 30px;
    }
    .form-group {
        margin-bottom: 1.5rem;
    }
    .form-control {
        border-radius: 10px;
        padding: 10px 15px;
    }
</style>
@endsection

@section('content')
<div class="edit-card">
    <div class="edit-header">
        <h5 class="mb-0">Edit Perhitungan Depresiasi</h5>
        <p class="mb-0 text-white-50">Ubah data perhitungan depresiasi</p>
    </div>
    
    <div class="edit-body">
        @include('components.alert')
        
        <form action="{{ route('hitung-depresiasi.update', $depresiasi->id_hitung_depresiasi) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="id_pengadaan">
                            <i class="fas fa-box"></i> Pilih Barang:
                        </label>
                        <select class="form-control @error('id_pengadaan') is-invalid @enderror" 
                                id="id_pengadaan" name="id_pengadaan" required>
                            <option value="">Pilih Barang</option>
                            @foreach($pengadaan as $item)
                                <option value="{{ $item->id_pengadaan }}" 
                                    data-harga="{{ $item->harga_barang }}"
                                    {{ $depresiasi->id_pengadaan == $item->id_pengadaan ? 'selected' : '' }}>
                                    {{ $item->masterBarang->nama_barang }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_pengadaan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="tgl_hitung_depresiasi">
                            <i class="fas fa-calendar"></i> Tanggal Hitung:
                        </label>
                        <input type="date" class="form-control @error('tgl_hitung_depresiasi') is-invalid @enderror" 
                               id="tgl_hitung_depresiasi" name="tgl_hitung_depresiasi" 
                               value="{{ old('tgl_hitung_depresiasi', $depresiasi->tgl_hitung_depresiasi) }}" required>
                        @error('tgl_hitung_depresiasi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="bulan">
                            <i class="fas fa-clock"></i> Bulan:
                        </label>
                        <input type="text" class="form-control @error('bulan') is-invalid @enderror" 
                               id="bulan" name="bulan" value="{{ old('bulan', $depresiasi->bulan) }}" required>
                        @error('bulan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="durasi">
                            <i class="fas fa-hourglass-half"></i> Durasi (Bulan):
                        </label>
                        <input type="number" class="form-control @error('durasi') is-invalid @enderror" 
                               id="durasi" name="durasi" value="{{ old('durasi', $depresiasi->durasi) }}" 
                               required min="1">
                        @error('durasi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="nilai_barang">
                            <i class="fas fa-money-bill"></i> Nilai Barang:
                        </label>
                        <input type="text" class="form-control @error('nilai_barang') is-invalid @enderror" 
                               id="nilai_barang" name="nilai_barang" 
                               value="{{ old('nilai_barang', $depresiasi->nilai_barang) }}" required>
                        @error('nilai_barang')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Simpan Perubahan
                </button>
                <a href="{{ route('hitung-depresiasi.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('#id_pengadaan').change(function() {
        let harga = $(this).find(':selected').data('harga');
        if(harga) {
            $('#nilai_barang').val(harga);
        } else {
            $('#nilai_barang').val('');
        }
    });
});
</script>
@endpush
