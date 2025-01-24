@extends('layouts.user')

@section('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
<style>
    .card {
        border-radius: 15px;
        border: none;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
    }

    .card-header {
        background: #4e73df;
        color: white;
        border-radius: 15px 15px 0 0 !important;
        border: none;
    }

    .table th {
        background-color: #f8f9fa;
        font-weight: 600;
    }

    .btn-group .btn {
        border-radius: 8px;
        margin: 0 2px;
    }

    .btn-action {
        width: 32px;
        height: 32px;
        padding: 0;
        line-height: 32px;
        text-align: center;
    }
</style>
@endsection

@section('user-content')
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h5 class="mb-0">
                    <i class="fas fa-calculator me-2"></i>Data Perhitungan Depresiasi
                </h5>
                <p class="mb-0 text-white-50">
                    <i class="fas fa-info-circle me-2"></i>Daftar perhitungan depresiasi barang
                </p>
            </div>
        </div>
    </div>

    <div class="card-body">
        @include('components.alert')

        <div class="table-responsive">
            <table class="table table-hover" id="hitungDepresiasiTable">
                <thead>
                    <tr>
                        <th><i class="fas fa-list me-2"></i>No</th>
                        <th><i class="fas fa-box me-2"></i>Barang</th>
                        <th><i class="fas fa-calendar me-2"></i>Tanggal Hitung</th>
                        <th><i class="fas fa-calendar-alt me-2"></i>Bulan</th>
                        <th><i class="fas fa-clock me-2"></i>Durasi</th>
                        <th><i class="fas fa-money-bill me-2"></i>Nilai Barang</th>
                        <th><i class="fas fa-chart-line me-2"></i>Depresiasi/Bulan</th>
                        <th><i class="fas fa-cog me-2"></i>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($depresiasi as $index => $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->pengadaan->masterBarang->nama_barang }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->tgl_hitung_depresiasi)->format('d/m/Y') }}</td>
                            <td>{{ $item->bulan }}</td>
                            <td>{{ $item->durasi }} Bulan</td>
                            <td>Rp {{ number_format($item->nilai_barang, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($item->depresiasi_barang, 0, ',', '.') }}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('user.hitung_depresiasi.show', $item->id_hitung_depresiasi) }}"
                                        class="btn btn-info btn-action">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#hitungDepresiasiTable').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/id.json'
                }
            });
        });
    </script>
@endpush
