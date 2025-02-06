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
    .select2-container .select2-selection--single {
        height: 38px !important;
    }
</style>
@endsection

@section('content')
<div class="edit-card">
    <div class="edit-header">
        <h5 class="mb-0"><i class="fas fa-edit me-2"></i>Edit Pengadaan</h5>
        <p class="mb-0 text-white-50">Edit data pengadaan #{{ $pengadaan->kode_pengadaan }}</p>
                    </div>
    
    <div class="edit-body">
                        <form action="{{ route('pengadaan.update', $pengadaan) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                        <label for="kode_pengadaan">
                            <i class="fas fa-barcode"></i> Kode Pengadaan
                        </label>
                                        <input type="text" class="form-control @error('kode_pengadaan') is-invalid @enderror" 
                                               id="kode_pengadaan" name="kode_pengadaan" 
                                               value="{{ old('kode_pengadaan', $pengadaan->kode_pengadaan) }}" required>
                                        @error('kode_pengadaan')
                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="id_master_barang">Barang</label>
                                        <select class="form-control select2 @error('id_master_barang') is-invalid @enderror" 
                                                id="id_master_barang" name="id_master_barang" required>
                                            <option value="">Pilih Barang</option>
                                            @foreach($masterBarangs as $barang)
                                                <option value="{{ $barang->id_master_barang }}" 
                                                    {{ old('id_master_barang', $pengadaan->id_master_barang) == $barang->id_master_barang ? 'selected' : '' }}>
                                                    {{ $barang->nama_barang }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('id_master_barang')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="id_depresiasi">Depresiasi</label>
                                        <select class="form-control select2 @error('id_depresiasi') is-invalid @enderror" 
                                                id="id_depresiasi" name="id_depresiasi" required>
                                            <option value="">Pilih Depresiasi</option>
                                            @foreach($depresiasis as $depresiasi)
                                                <option value="{{ $depresiasi->id_depresiasi }}" 
                                                    {{ old('id_depresiasi', $pengadaan->id_depresiasi) == $depresiasi->id_depresiasi ? 'selected' : '' }}>
                                                    {{ $depresiasi->lama_depresiasi }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('id_depresiasi')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="id_merk">Merk</label>
                                        <select class="form-control select2 @error('id_merk') is-invalid @enderror" 
                                                id="id_merk" name="id_merk" required>
                                            <option value="">Pilih Merk</option>
                                            @foreach($merks as $merk)
                                                <option value="{{ $merk->id_merk }}" 
                                                    {{ old('id_merk', $pengadaan->id_merk) == $merk->id_merk ? 'selected' : '' }}>
                                                    {{ $merk->merk }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('id_merk')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="id_satuan">Satuan</label>
                                        <select class="form-control select2 @error('id_satuan') is-invalid @enderror" 
                                                id="id_satuan" name="id_satuan" required>
                                            <option value="">Pilih Satuan</option>
                                            @foreach($satuans as $satuan)
                                                <option value="{{ $satuan->id_satuan }}" 
                                                    {{ old('id_satuan', $pengadaan->id_satuan) == $satuan->id_satuan ? 'selected' : '' }}>
                                                    {{ $satuan->satuan }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('id_satuan')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="id_sub_kategori_asset">Sub Kategori Asset</label>
                                        <select class="form-control select2 @error('id_sub_kategori_asset') is-invalid @enderror" 
                                                id="id_sub_kategori_asset" name="id_sub_kategori_asset" required>
                                            <option value="">Pilih Sub Kategori Asset</option>
                                            @foreach($subKategoriAssets as $subKategori)
                                                <option value="{{ $subKategori->id_sub_kategori_asset }}" 
                                                    {{ old('id_sub_kategori_asset', $pengadaan->id_sub_kategori_asset) == $subKategori->id_sub_kategori_asset ? 'selected' : '' }}>
                                                    {{ $subKategori->sub_kategori_asset }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('id_sub_kategori_asset')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="id_distributor">Distributor</label>
                                        <select class="form-control select2 @error('id_distributor') is-invalid @enderror" 
                                                id="id_distributor" name="id_distributor" required>
                                            <option value="">Pilih Distributor</option>
                                            @foreach($distributors as $distributor)
                                                <option value="{{ $distributor->id_distributor }}" 
                                                    {{ old('id_distributor', $pengadaan->id_distributor) == $distributor->id_distributor ? 'selected' : '' }}>
                                                    {{ $distributor->nama_distributor }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('id_distributor')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="no_invoice">Nomor Invoice</label>
                                        <input type="text" class="form-control @error('no_invoice') is-invalid @enderror" 
                                               id="no_invoice" name="no_invoice" 
                                               value="{{ old('no_invoice', $pengadaan->no_invoice) }}" required>
                                        @error('no_invoice')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="no_seri_barang">Nomor Seri Barang</label>
                                        <input type="text" class="form-control @error('no_seri_barang') is-invalid @enderror" 
                                               id="no_seri_barang" name="no_seri_barang" 
                                               value="{{ old('no_seri_barang', $pengadaan->no_seri_barang) }}" required>
                                        @error('no_seri_barang')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="tahun_produksi">Tahun Produksi</label>
                                        <input type="text" class="form-control @error('tahun_produksi') is-invalid @enderror" 
                                               id="tahun_produksi" name="tahun_produksi" 
                                               value="{{ old('tahun_produksi', $pengadaan->tahun_produksi) }}" required>
                                        @error('tahun_produksi')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="tgl_pengadaan">Tanggal Pengadaan</label>
                                        <input type="date" class="form-control @error('tgl_pengadaan') is-invalid @enderror" 
                                               id="tgl_pengadaan" name="tgl_pengadaan" 
                                               value="{{ old('tgl_pengadaan', $pengadaan->tgl_pengadaan->format('Y-m-d')) }}" required>
                                        @error('tgl_pengadaan')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="harga_barang" class="form-label">Harga Barang</label>
                                        <input type="text" class="form-control @error('harga_barang') is-invalid @enderror" 
                                               id="harga_barang" name="harga_barang" 
                                               value="{{ old('harga_barang', number_format($pengadaan->harga_barang, 0, ',', '.')) }}" 
                                               required onkeyup="formatNumber(this)">
                                        @error('harga_barang')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="nilai_barang" class="form-label">Nilai Barang</label>
                                        <input type="text" class="form-control @error('nilai_barang') is-invalid @enderror" 
                                               id="nilai_barang" name="nilai_barang" 
                                               value="{{ old('nilai_barang', number_format($pengadaan->nilai_barang, 0, ',', '.')) }}" 
                                               required onkeyup="formatNumber(this)">
                                        @error('nilai_barang')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="stock_barang" class="form-label">Stock Barang</label>
                                        <input type="number" class="form-control @error('stock_barang') is-invalid @enderror" 
                                               id="stock_barang" name="stock_barang" 
                                               value="{{ old('stock_barang', $pengadaan->stock_barang) }}" 
                                               min="0" required>
                                        @error('stock_barang')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                                    <div class="form-group">
                                        <label for="status_login">Status</label>
                                        <select class="form-control @error('status_login') is-invalid @enderror" 
                                                id="status_login" name="status_login" required>
                                            <option value="1" {{ old('status_login', $pengadaan->status_login) == '1' ? 'selected' : '' }}>
                                                Aktif
                                            </option>
                                            <option value="0" {{ old('status_login', $pengadaan->status_login) == '0' ? 'selected' : '' }}>
                                                Tidak Aktif
                                            </option>
                                        </select>
                                        @error('status_login')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>


                                    <div class="form-group">
                                        <label for="keterangan">Keterangan</label>
                                        <textarea class="form-control @error('keterangan') is-invalid @enderror" 
                                                  id="keterangan" name="keterangan" required>{{ old('keterangan', $pengadaan->keterangan) }}</textarea>
                                        @error('keterangan')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>


            <div class="button-group">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-2"></i>Simpan
                </button>
                <a href="{{ route('pengadaan.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>
                            </div>
                        </form>
        </div>
    </div>

    @push('scripts')
    <script>
        $(document).ready(function() {
        $('.select2').select2({
            theme: 'bootstrap4'
        });

            // Format input harga dan nilai barang
            $('#harga_barang, #nilai_barang').on('input', function() {
                let value = $(this).val().replace(/[^\d.]/g, '');
                if (value) {
                    value = parseInt(value).toLocaleString('id-ID');
                    $(this).val('Rp ' + value);
                }
            });

        // Validasi tahun produksi
        $('#tahun_produksi').on('input', function() {
            let value = $(this).val().replace(/[^\d]/g, '');
            if (value.length > 4) {
                value = value.slice(0, 4);
            }
            $(this).val(value);
        });

        // Validasi form sebelum submit
        $('form').on('submit', function(e) {
            let tahun = $('#tahun_produksi').val();
            let currentYear = new Date().getFullYear();
            
            if (tahun > currentYear) {
                e.preventDefault();
                alert('Tahun produksi tidak boleh lebih besar dari tahun sekarang');
                return false;
            }
        });

        function formatNumber(input) {
            // Hapus semua karakter kecuali angka dan titik
            let value = input.value.replace(/[^\d.]/g, '');
            
            // Pisahkan dengan titik setiap 3 digit
            value = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            
            // Update nilai input
            input.value = value;
        }
        });
    </script>
    @endpush
@endsection 