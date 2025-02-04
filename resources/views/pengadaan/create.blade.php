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
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 38px !important;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 36px !important;
    }
</style>
@endsection

@section('content')
<div class="edit-card animate__animated animate__fadeIn">
    <div class="edit-header">
        <h5 class="mb-0"><i class="fas fa-plus-square me-2"></i>Tambah Pengadaan</h5>
        <p class="mb-0 text-white-50">Tambah data pengadaan baru</p>
    </div>
    
    <div class="edit-body">
        <form action="{{ route('pengadaan.store') }}" method="POST" id="createForm">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="kode_pengadaan">
                            <i class="fas fa-barcode"></i> Kode Pengadaan
                        </label>
                        <input type="text" class="form-control @error('kode_pengadaan') is-invalid @enderror" 
                               id="kode_pengadaan" name="kode_pengadaan" value="{{ old('kode_pengadaan') }}" required>
                        @error('kode_pengadaan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="id_master_barang">
                            <i class="fas fa-box"></i> Barang
                        </label>
                        <select class="form-control select2 @error('id_master_barang') is-invalid @enderror" 
                                id="id_master_barang" name="id_master_barang" required>
                            <option value="">Pilih Barang</option>
                            @foreach($masterBarangs as $barang)
                                <option value="{{ $barang->id_master_barang }}" 
                                    {{ old('id_master_barang') == $barang->id_master_barang ? 'selected' : '' }}>
                                    {{ $barang->nama_barang }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_master_barang')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="id_depresiasi">
                            <i class="fas fa-chart-line"></i> Depresiasi
                        </label>
                        <select class="form-control select2 @error('id_depresiasi') is-invalid @enderror" 
                                id="id_depresiasi" name="id_depresiasi" required>
                            <option value="">Pilih Depresiasi</option>
                            @foreach($depresiasis as $depresiasi)
                                <option value="{{ $depresiasi->id_depresiasi }}" 
                                    {{ old('id_depresiasi') == $depresiasi->id_depresiasi ? 'selected' : '' }}>
                                    {{ $depresiasi->lama_depresiasi }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_depresiasi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="id_merk">
                            <i class="fas fa-trademark"></i> Merk
                        </label>
                        <select class="form-control select2 @error('id_merk') is-invalid @enderror" 
                                id="id_merk" name="id_merk" required>
                            <option value="">Pilih Merk</option>
                            @foreach($merks as $merk)
                                <option value="{{ $merk->id_merk }}" 
                                    {{ old('id_merk') == $merk->id_merk ? 'selected' : '' }}>
                                    {{ $merk->merk }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_merk')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="id_satuan">
                            <i class="fas fa-balance-scale"></i> Satuan
                        </label>
                        <select class="form-control select2 @error('id_satuan') is-invalid @enderror" 
                                id="id_satuan" name="id_satuan" required>
                            <option value="">Pilih Satuan</option>
                            @foreach($satuans as $satuan)
                                <option value="{{ $satuan->id_satuan }}" 
                                    {{ old('id_satuan') == $satuan->id_satuan ? 'selected' : '' }}>
                                    {{ $satuan->satuan }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_satuan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="id_sub_kategori_asset">
                            <i class="fas fa-tags"></i> Sub Kategori Asset
                        </label>
                        <select class="form-control select2 @error('id_sub_kategori_asset') is-invalid @enderror" 
                                id="id_sub_kategori_asset" name="id_sub_kategori_asset" required>
                            <option value="">Pilih Sub Kategori Asset</option>
                            @foreach($subKategoriAssets as $subKategori)
                                <option value="{{ $subKategori->id_sub_kategori_asset }}" 
                                    {{ old('id_sub_kategori_asset') == $subKategori->id_sub_kategori_asset ? 'selected' : '' }}>
                                    {{ $subKategori->sub_kategori_asset }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_sub_kategori_asset')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="id_distributor">
                            <i class="fas fa-truck"></i> Distributor
                        </label>
                        <select class="form-control select2 @error('id_distributor') is-invalid @enderror" 
                                id="id_distributor" name="id_distributor" required>
                            <option value="">Pilih Distributor</option>
                            @foreach($distributors as $distributor)
                                <option value="{{ $distributor->id_distributor }}" 
                                    {{ old('id_distributor') == $distributor->id_distributor ? 'selected' : '' }}>
                                    {{ $distributor->nama_distributor }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_distributor')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="no_invoice">
                            <i class="fas fa-file-invoice"></i> Nomor Invoice
                        </label>
                        <input type="text" class="form-control @error('no_invoice') is-invalid @enderror" 
                               id="no_invoice" name="no_invoice" value="{{ old('no_invoice') }}" required>
                        @error('no_invoice')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="no_seri_barang">
                            <i class="fas fa-fingerprint"></i> Nomor Seri Barang
                        </label>
                        <input type="text" class="form-control @error('no_seri_barang') is-invalid @enderror" 
                               id="no_seri_barang" name="no_seri_barang" value="{{ old('no_seri_barang') }}" required>
                        @error('no_seri_barang')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="tahun_produksi">
                            <i class="fas fa-calendar"></i> Tahun Produksi
                        </label>
                        <input type="text" class="form-control @error('tahun_produksi') is-invalid @enderror" 
                               id="tahun_produksi" name="tahun_produksi" value="{{ old('tahun_produksi') }}" required>
                        @error('tahun_produksi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="tgl_pengadaan">
                            <i class="fas fa-calendar-alt"></i> Tanggal Pengadaan
                        </label>
                        <input type="date" class="form-control @error('tgl_pengadaan') is-invalid @enderror" 
                               id="tgl_pengadaan" name="tgl_pengadaan" value="{{ old('tgl_pengadaan') }}" required>
                        @error('tgl_pengadaan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="harga_barang" class="form-label">Harga Barang</label>
                        <input type="text" class="form-control @error('harga_barang') is-invalid @enderror" 
                               id="harga_barang" name="harga_barang" value="{{ old('harga_barang') }}" 
                               required onkeyup="formatNumber(this)">
                        @error('harga_barang')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="nilai_barang" class="form-label">Nilai Barang</label>
                        <input type="text" class="form-control @error('nilai_barang') is-invalid @enderror" 
                               id="nilai_barang" name="nilai_barang" value="{{ old('nilai_barang') }}" 
                               required onkeyup="formatNumber(this)">
                        @error('nilai_barang')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="status_login">
                            <i class="fas fa-check-circle"></i> Status
                        </label>
                        <select class="form-control @error('status_login') is-invalid @enderror" 
                                id="status_login" name="status_login" required>
                            <option value="1" {{ old('status_login') == '1' ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ old('status_login') == '0' ? 'selected' : '' }}>Tidak Aktif</option>
                        </select>
                        @error('status_login')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="keterangan">
                            <i class="fas fa-sticky-note"></i> Keterangan
                        </label>
                        <textarea class="form-control @error('keterangan') is-invalid @enderror" 
                                  id="keterangan" name="keterangan" required>{{ old('keterangan') }}</textarea>
                        @error('keterangan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="stock_barang" class="form-label">Stock Barang</label>
                        <input type="number" class="form-control @error('stock_barang') is-invalid @enderror" 
                               id="stock_barang" name="stock_barang" value="{{ old('stock_barang', 0) }}" 
                               min="0" required>
                        @error('stock_barang')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
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

        // Format currency for harga_barang and nilai_barang
        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp ' + rupiah : '');
        }

        // Event handler for harga_barang
        $('#harga_barang').on('input', function(e) {
            var value = $(this).val();
            // Remove any previous 'Rp ' prefix and dots
            value = value.replace(/^Rp /, '').replace(/\./g, '');
            // Format the number
            $(this).val('Rp ' + formatRupiah(value));
        });

        // Event handler for nilai_barang
        $('#nilai_barang').on('input', function(e) {
            var value = $(this).val();
            // Remove any previous 'Rp ' prefix and dots
            value = value.replace(/^Rp /, '').replace(/\./g, '');
            // Format the number
            $(this).val('Rp ' + formatRupiah(value));
        });

        // Before form submit, clean the currency format
        $('#createForm').on('submit', function(e) {
            // Clean harga_barang
            var harga = $('#harga_barang').val().replace(/^Rp /, '').replace(/\./g, '');
            $('#harga_barang').val(harga);

            // Clean nilai_barang
            var nilai = $('#nilai_barang').val().replace(/^Rp /, '').replace(/\./g, '');
            $('#nilai_barang').val(nilai);

            let tahun = $('#tahun_produksi').val();
            let currentYear = new Date().getFullYear();
            
            if (tahun > currentYear) {
                e.preventDefault();
                alert('Tahun produksi tidak boleh lebih besar dari tahun sekarang');
                return false;
            }
        });

        // Validasi tahun produksi (hanya angka dan maksimal 4 digit)
        $('#tahun_produksi').on('input', function() {
            let value = $(this).val().replace(/[^\d]/g, '');
            if (value.length > 4) {
                value = value.slice(0, 4);
            }
            $(this).val(value);
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