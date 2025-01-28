@extends('layouts.user')

@section('title', 'Data Pengadaan')

@section('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap5.min.css">
<style>
    .btn-action {
        width: 35px;
        height: 35px;
        padding: 5px;
        margin: 2px;
    }

    .card-header {
        background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
        color: white;
    }

    .table>thead {
        background-color: #f8f9fc;
    }

    .dataTables_wrapper {
        width: 100%;
        position: relative;
    }

    .table {
        margin-bottom: 0;
        width: 100% !important;
    }

    @media screen and (max-width: 768px) {
        .table th,
        .table td {
            min-width: 100px;
        }
        
        .card-body {
            padding: 0.5rem;
        }
        
        .btn-action {
            width: 30px;
            height: 30px;
            padding: 3px;
        }
        
        .dtr-details {
            width: 100%;
        }
    }
</style>
@endsection

@section('user-content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <div>
                <h5 class="mb-0"><i class="fas fa-shopping-cart me-2"></i>Data Pengadaan</h5>
                <p class="mb-0 text-white-50">Data pengadaan barang</p>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover" id="pengadaanTable" style="width: 100%">
                    <thead>
                        <tr>
                            <th class="text-nowrap px-3"><i class="fas fa-hashtag me-2"></i>No</th>
                            <th class="text-nowrap px-3"><i class="fas fa-barcode me-2"></i>Kode</th>
                            <th class="text-nowrap px-3"><i class="fas fa-box me-2"></i>Barang</th>
                            <th class="text-nowrap px-3"><i class="fas fa-calculator me-2"></i>Depresiasi</th>
                            <th class="text-nowrap px-3"><i class="fas fa-trademark me-2"></i>Merk</th>
                            <th class="text-nowrap px-3"><i class="fas fa-balance-scale me-2"></i>Satuan</th>
                            <th class="text-nowrap px-3"><i class="fas fa-tags me-2"></i>Sub Kategori</th>
                            <th class="text-nowrap px-3"><i class="fas fa-truck me-2"></i>Distributor</th>
                            <th class="text-nowrap px-3"><i class="fas fa-file-invoice me-2"></i>No Invoice</th>
                            <th class="text-nowrap px-3"><i class="fas fa-fingerprint me-2"></i>No Seri</th>
                            <th class="text-nowrap px-3"><i class="fas fa-calendar me-2"></i>Tahun</th>
                            <th class="text-nowrap px-3"><i class="fas fa-calendar-alt me-2"></i>Tanggal</th>
                            <th class="text-nowrap px-3"><i class="fas fa-money-bill me-2"></i>Harga</th>
                            <th class="text-nowrap px-3"><i class="fas fa-coins me-2"></i>Nilai</th>
                            <th class="text-nowrap px-3"><i class="fas fa-chart-line me-2"></i>Depresiasi/Bulan</th>
                            <th class="text-nowrap px-3"><i class="fas fa-check-circle me-2"></i>Status</th>
                            <th class="text-nowrap px-3"><i class="fas fa-boxes me-2"></i>Stock</th>
                            <th class="text-nowrap px-3"><i class="fas fa-cog me-2"></i>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pengadaans as $pengadaan)
                        <tr>
                            <td class="px-3">{{ $loop->iteration }}</td>
                            <td class="px-3">{{ $pengadaan->kode_pengadaan }}</td>
                            <td class="px-3">{{ $pengadaan->masterBarang->nama_barang }}</td>
                            <td class="px-3">{{ $pengadaan->depresiasi->lama_depresiasi }} Bulan</td>
                            <td class="px-3">{{ $pengadaan->merk->merk }}</td>
                            <td class="px-3">{{ $pengadaan->satuan->satuan }}</td>
                            <td class="px-3">{{ $pengadaan->subKategoriAsset->sub_kategori_asset }}</td>
                            <td class="px-3">{{ $pengadaan->distributor->nama_distributor }}</td>
                            <td class="px-3">{{ $pengadaan->no_invoice }}</td>
                            <td class="px-3">{{ $pengadaan->no_seri_barang }}</td>
                            <td class="px-3">{{ $pengadaan->tahun_produksi }}</td>
                            <td class="px-3">{{ $pengadaan->tgl_pengadaan->format('d/m/Y') }}</td>
                            <td class="px-3">{{ $pengadaan->formatted_harga_barang }}</td>
                            <td class="px-3">{{ $pengadaan->formatted_nilai_barang }}</td>
                            <td class="px-3">{{ 'Rp ' . number_format($pengadaan->depresiasi_barang, 0, ',', '.') }}/bulan</td>
                            <td class="px-3">
                                @if($pengadaan->status_login == '1')
                                    <span class="badge bg-success">Aktif</span>
                                @else
                                    <span class="badge bg-danger">Tidak Aktif</span>
                                @endif
                            </td>
                            <td class="px-3 text-end">{{ number_format($pengadaan->stock_barang, 0, ',', '.') }}</td>
                            <td class="px-3">
                                <a href="{{ route('user.pengadaan.show', $pengadaan) }}" 
                                   class="btn btn-info btn-action">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="18" class="text-center px-3">Tidak ada data</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
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
        $('#pengadaanTable').DataTable({
            responsive: {
                details: {
                    display: $.fn.dataTable.Responsive.display.modal({
                        header: function (row) {
                            return 'Detail Pengadaan';
                        }
                    }),
                    renderer: $.fn.dataTable.Responsive.renderer.tableAll({
                        tableClass: 'table'
                    })
                }
            },
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/id.json'
            },
            columnDefs: [
                {
                    targets: '_all',
                    className: 'px-3'
                },
                {
                    responsivePriority: 1,
                    targets: [0, 1, 2, 17] // No, Kode, Barang, dan Aksi
                },
                {
                    responsivePriority: 2,
                    targets: [12, 13, 15] // Harga, Nilai, dan Status
                }
            ],
            ordering: true,
            info: true,
            paging: true,
            lengthChange: true,
            searching: true,
            autoWidth: false
        });
    });
</script>
@endpush
