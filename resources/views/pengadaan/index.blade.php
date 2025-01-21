@extends('layouts.admin')

@section('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
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

    /* Tambahan style untuk scroll */
    .dataTables_wrapper {
        width: 100%;
        overflow-x: auto;
        position: relative;
    }

    .dataTables_scrollBody {
        overflow-x: auto;
        width: 100%;
    }

    .table {
        margin-bottom: 0;
        width: 100% !important;
    }

    .table th,
    .table td {
        white-space: nowrap;
        vertical-align: middle;
    }
</style>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h5 class="mb-0"><i class="fas fa-shopping-cart me-2"></i>Manajemen Pengadaan</h5>
                <p class="mb-0 text-white-50">Kelola data pengadaan barang</p>
            </div>
            <a href="{{ route('pengadaan.create') }}" class="btn btn-light">
                <i class="fas fa-plus-circle me-2"></i>Tambah Pengadaan
            </a>
        </div>
    </div>

    <div class="card-body">
        @include('components.alert')

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
                        <th class="text-nowrap px-3"><i class="fas fa-cog me-2"></i>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pengadaans as $pengadaan)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $pengadaan->kode_pengadaan }}</td>
                            <td>{{ $pengadaan->masterBarang->nama_barang }}</td>
                            <td>{{ $pengadaan->depresiasi->lama_depresiasi }} Bulan</td>
                            <td>{{ $pengadaan->merk->merk }}</td>
                            <td>{{ $pengadaan->satuan->satuan }}</td>
                            <td>{{ $pengadaan->subKategoriAsset->sub_kategori_asset }}</td>
                            <td>{{ $pengadaan->distributor->nama_distributor }}</td>
                            <td>{{ $pengadaan->no_invoice }}</td>
                            <td>{{ $pengadaan->no_seri_barang }}</td>
                            <td>{{ $pengadaan->tahun_produksi }}</td>
                            <td>{{ $pengadaan->tgl_pengadaan->format('d/m/Y') }}</td>
                            <td>{{ $pengadaan->formatted_harga_barang }}</td>
                            <td>{{ $pengadaan->formatted_nilai_barang }}</td>
                            <td>{{ 'Rp ' . number_format($pengadaan->depresiasi_barang, 0, ',', '.') }}/bulan</td>
                            <td>
                                @if($pengadaan->status_login == '1')
                                    <span class="badge bg-success">Aktif</span>
                                @else
                                    <span class="badge bg-danger">Tidak Aktif</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('pengadaan.show', $pengadaan) }}" class="btn btn-info btn-action">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('pengadaan.edit', $pengadaan) }}" class="btn btn-warning btn-action">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('pengadaan.destroy', $pengadaan) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-action delete-btn">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="17" class="text-center">Tidak ada data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function () {
            // Inisialisasi DataTable dengan konfigurasi scroll
            $('#pengadaanTable').DataTable({
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
                // Tambahan konfigurasi untuk scroll yang lebih baik
                fixedHeader: true,
                responsive: false,
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
            });

            // Konfirmasi Delete dengan SweetAlert2
            $('.delete-btn').click(function (e) {
                e.preventDefault();
                let form = $(this).closest('form');

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data yang dihapus tidak dapat dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });

            // Format angka ke format rupiah
            function formatRupiah(angka) {
                return 'Rp ' + new Intl.NumberFormat('id-ID').format(angka);
            }
        });
    </script>
@endpush