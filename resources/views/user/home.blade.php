@extends('layouts.user')

@section('title', 'Dashboard Pengguna')

@section('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap5.min.css">
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

    .stat-card {
        transition: all 0.3s ease;
    }
    
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 7px 25px rgba(0, 0, 0, 0.1);
    }

    /* Responsive styles */
    @media (max-width: 768px) {
        .stat-card {
            margin-bottom: 1rem;
        }
        
        .card-body {
            padding: 1rem;
        }

        .h2 {
            font-size: 1.5rem;
        }

        .table-responsive {
            margin: 0 -15px;
        }
        
        .card {
            margin: 0 10px;
        }
    }

    @media (max-width: 576px) {
        .container-fluid {
            padding: 0.5rem;
        }
        
        h1.h3 {
            font-size: 1.5rem;
        }
    }
</style>
@endsection

@section('user-content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="h3 mb-0 text-gray-800">
                <i class="fas fa-tachometer-alt me-2"></i>Dashboard
            </h1>
        </div>
    </div>

    <div class="row mb-4">
        <!-- Pengadaan Card -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card stat-card h-100 py-2">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="m-0 font-weight-bold text-primary">Total Pengadaan</h5>
                        <i class="fas fa-shopping-cart fa-2x text-primary"></i>
                    </div>
                    <div class="h2 font-weight-bold text-primary">{{ $pengadaanCount }}</div>
                    <div class="text-muted">Total pengadaan barang</div>
                </div>
            </div>
        </div>

        <!-- Opname Card -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card stat-card h-100 py-2">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="m-0 font-weight-bold text-info">Total Opname</h5>
                        <i class="fas fa-clipboard-check fa-2x text-info"></i>
                    </div>
                    <div class="h2 font-weight-bold text-info">{{ $opnameCount }}</div>
                    <div class="text-muted">Total opname barang</div>
                </div>
            </div>
        </div>

        <!-- Depresiasi Card -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card stat-card h-100 py-2">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="m-0 font-weight-bold text-warning">Total Depresiasi</h5>
                        <i class="fas fa-chart-line fa-2x text-warning"></i>
                    </div>
                    <div class="h2 font-weight-bold text-warning">{{ $depresiasiCount }}</div>
                    <div class="text-muted">Total perhitungan depresiasi</div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Depresiasi Table -->
        <div class="col-12 mb-4">
            <div class="card shadow">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold">
                        <i class="fas fa-calculator me-2"></i>Data Hitung Depresiasi Terbaru
                    </h6>
                </div>
                <div class="card-body">
                    @include('components.alert')
                    <div class="table-responsive">
                        <table class="table table-hover" id="depresiasiTable">
                            <thead>
                                <tr>
                                    <th><i class="fas fa-list me-2"></i>No</th>
                                    <th><i class="fas fa-box me-2"></i>Barang</th>
                                    <th><i class="fas fa-calendar me-2"></i>Tanggal Hitung</th>
                                    <th><i class="fas fa-calendar-alt me-2"></i>Bulan</th>
                                    <th><i class="fas fa-clock me-2"></i>Durasi</th>
                                    <th><i class="fas fa-money-bill me-2"></i>Nilai Barang</th>
                                    <th><i class="fas fa-chart-line me-2"></i>Depresiasi/Bulan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($depresiasi as $index => $item)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $item->pengadaan->masterBarang->nama_barang }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->tgl_hitung_depresiasi)->format('d/m/Y') }}</td>
                                        <td>{{ $item->bulan }}</td>
                                        <td>{{ $item->durasi }} Bulan</td>
                                        <td>Rp {{ number_format($item->nilai_barang, 0, ',', '.') }}</td>
                                        <td>Rp {{ number_format($item->depresiasi_barang, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pengadaan Table -->
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold">
                        <i class="fas fa-shopping-cart me-2"></i>Data Pengadaan Terbaru
                    </h6>
                </div>
                <div class="card-body">
                    @include('components.alert')
                    <div class="table-responsive">
                        <table class="table table-hover" id="pengadaanTable">
                            <thead>
                                <tr>
                                    <th><i class="fas fa-list me-2"></i>No</th>
                                    <th><i class="fas fa-box me-2"></i>Barang</th>
                                    <th><i class="fas fa-barcode me-2"></i>Kode</th>
                                    <th><i class="fas fa-chart-line me-2"></i>Depresiasi</th>
                                    <th><i class="fas fa-tag me-2"></i>Merk</th>
                                    <th><i class="fas fa-balance-scale me-2"></i>Satuan</th>
                                    <th><i class="fas fa-folder me-2"></i>Sub Kategori</th>
                                    <th><i class="fas fa-truck me-2"></i>Distributor</th>
                                    <th><i class="fas fa-file-invoice me-2"></i>No Invoice</th>
                                    <th><i class="fas fa-fingerprint me-2"></i>No Seri</th>
                                    <th><i class="fas fa-calendar-check me-2"></i>Tahun Produksi</th>
                                    <th><i class="fas fa-calendar-plus me-2"></i>Tanggal Pengadaan</th>
                                    <th><i class="fas fa-tag me-2"></i>Harga Barang</th>
                                    <th><i class="fas fa-money-bill-wave me-2"></i>Nilai Barang</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pengadaan as $index => $item)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $item->masterBarang->nama_barang }}</td>
                                        <td>{{ $item->kode_pengadaan }}</td>
                                        <td>{{ $item->depresiasi->lama_depresiasi }} Bulan</td>
                                        <td>{{ $item->merk->merk }}</td>
                                        <td>{{ $item->satuan->satuan }}</td>
                                        <td>{{ $item->subKategoriAsset->sub_kategori_asset }}</td>
                                        <td>{{ $item->distributor->nama_distributor }}</td>
                                        <td>{{ $item->no_invoice }}</td>
                                        <td>{{ $item->no_seri_barang }}</td>
                                        <td>{{ $item->tahun_produksi }}</td>
                                        <td>{{ $item->tgl_pengadaan->format('d/m/Y') }}</td>
                                        <td>Rp {{ number_format($item->harga_barang, 0, ',', '.') }}</td>
                                        <td>Rp {{ number_format($item->nilai_barang, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/responsive.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function () {
            const commonConfig = {
                responsive: {
                    details: {
                        display: $.fn.dataTable.Responsive.display.modal({
                            header: function (row) {
                                return 'Detail Data';
                            }
                        }),
                        renderer: $.fn.dataTable.Responsive.renderer.tableAll({
                            tableClass: 'table'
                        })
                    }
                },
                scrollX: true,
                scrollCollapse: true,
                autoWidth: false,
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/id.json'
                },
                columnDefs: [
                    {
                        targets: '_all',
                        className: 'px-3'
                    }
                ],
                fixedHeader: true,
                paging: true,
                ordering: true,
                info: true,
                lengthChange: true,
                searching: true,
                initComplete: function (settings, json) {
                    $(this).closest('.dataTables_wrapper').find('.dataTables_scrollBody').css({
                        'max-height': '500px',
                        'overflow-y': 'auto',
                        'overflow-x': 'auto'
                    });
                }
            };

            $('#depresiasiTable').DataTable(commonConfig);
            $('#pengadaanTable').DataTable(commonConfig);

            // Handle window resize for responsive tables
            $(window).on('resize', function() {
                $('.dataTable').DataTable().columns.adjust();
            });
        });
    </script>
@endpush