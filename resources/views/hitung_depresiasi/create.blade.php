@extends('layouts.admin')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
<style>
    .create-card {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
    }

    .create-header {
        background: linear-gradient(135deg, var(--primary) 0%, #2a52be 100%);
        color: white;
        padding: 20px;
        border: none;
    }

    .create-body {
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
<div class="create-card">
    <div class="create-header">
        <h5 class="mb-0">Tambah Perhitungan Depresiasi</h5>
        <p class="mb-0 text-white-50">Tambah data perhitungan depresiasi baru</p>
    </div>

    <div class="create-body">
        @include('components.alert')

        <form action="{{ route('hitung-depresiasi.store') }}" method="POST" id="createForm">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="id_pengadaan">
                            <i class="fas fa-box"></i> Pilih Barang:
                        </label>
                        <select class="form-control @error('id_pengadaan') is-invalid @enderror" id="id_pengadaan"
                            name="id_pengadaan" required>
                            <option value="">Pilih Barang</option>
                            @foreach($pengadaan as $item)
                                <option value="{{ $item->id_pengadaan }}" data-harga="{{ $item->harga_barang }}">
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
                            id="tgl_hitung_depresiasi" name="tgl_hitung_depresiasi" required>
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
                        <input type="text" class="form-control @error('bulan') is-invalid @enderror" id="bulan"
                            name="bulan" required>
                        @error('bulan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="durasi">
                            <i class="fas fa-hourglass-half"></i> Durasi (Bulan):
                        </label>
                        <input type="number" class="form-control @error('durasi') is-invalid @enderror" id="durasi"
                            name="durasi" required min="1">
                        @error('durasi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="nilai_barang">
                            <i class="fas fa-money-bill"></i> Nilai Barang:
                        </label>
                        <input type="text" class="form-control @error('nilai_barang') is-invalid @enderror"
                            id="nilai_barang" name="nilai_barang" required readonly>
                        @error('nilai_barang')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Simpan
                </button>
                <a href="{{ route('hitung-depresiasi.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </form>

        <!-- Preview Depresiasi -->
        <div class="mt-4 preview-section">
            <h5>Simulasi Penyusutan</h5>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Bulan ke-</th>
                            <th>Nilai Sisa</th>
                            <th>Penyusutan</th>
                        </tr>
                    </thead>
                    <tbody id="previewTable">
                        <tr>
                            <td colspan="3" class="text-center" id="tableMessage">
                                Silakan isi durasi bulan untuk melihat simulasi penyusutan
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <small class="text-muted">* Menampilkan 12 bulan pertama</small>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            function calculateDepreciation() {
                let nilaiBarang = parseFloat($('#nilai_barang').val()) || 0;
                let durasi = parseInt($('#durasi').val()) || 0;
                
                if (nilaiBarang > 0 && durasi > 0) {
                    let depresiasiBulan = nilaiBarang / durasi;
                    updatePreviewTable(nilaiBarang, depresiasiBulan, durasi);
                } else {
                    $('#previewTable').html('<tr><td colspan="3" class="text-center">Silakan isi durasi bulan untuk melihat simulasi penyusutan</td></tr>');
                }
            }

            function updatePreviewTable(nilaiBarang, depresiasiBulan, durasi) {
                let html = '';
                let maxMonths = Math.min(durasi, 12);
                
                for (let i = 1; i <= maxMonths; i++) {
                    let nilaiSisa = nilaiBarang - (depresiasiBulan * i);
                    nilaiSisa = Math.max(0, nilaiSisa);
                    
                    html += `<tr>
                        <td>${i}</td>
                        <td>Rp ${formatNumber(nilaiSisa)}</td>
                        <td>Rp ${formatNumber(depresiasiBulan)}</td>
                    </tr>`;
                }
                
                $('#previewTable').html(html);
            }

            function formatNumber(number) {
                return new Intl.NumberFormat('id-ID').format(Math.round(number));
            }

            $('#id_pengadaan').change(function () {
                let harga = $(this).find(':selected').data('harga');
                if (harga) {
                    $('#nilai_barang').val(harga);
                    calculateDepreciation();
                } else {
                    $('#nilai_barang').val('');
                    $('.preview-section').addClass('d-none');
                }
            });

            $('#durasi').on('input', calculateDepreciation);

            // Set tanggal hari ini sebagai default
            let today = new Date().toISOString().split('T')[0];
            $('#tgl_hitung_depresiasi').val(today);

            // Set bulan saat ini
            let months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
            let currentMonth = months[new Date().getMonth()];
            $('#bulan').val(currentMonth);
        });
    </script>
@endpush