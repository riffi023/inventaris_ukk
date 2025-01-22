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
                <h5 class="mb-0"><i class="fas fa-clipboard-check me-2"></i>Manajemen Opname</h5>
                <p class="mb-0 text-white-50">Kelola data opname barang</p>
            </div>
            <a href="{{ route('opname.create') }}" class="btn btn-light">
                <i class="fas fa-plus-circle me-2"></i>Tambah Opname
            </a>
        </div>
    </div>

    <div class="card-body">
        @include('components.alert')

        <div class="table-responsive">
            <table class="table table-hover" id="opnameTable" style="width: 100%">
                <thead>
                    <tr>
                        <th class="text-nowrap px-3"><i class="fas fa-hashtag me-2"></i>No</th>
                        <th class="text-nowrap px-3"><i class="fas fa-box me-2"></i>Barang</th>
                        <th class="text-nowrap px-3"><i class="fas fa-calendar-alt me-2"></i>Tanggal Opname</th>
                        <th class="text-nowrap px-3"><i class="fas fa-info-circle me-2"></i>Kondisi</th>
                        <th class="text-nowrap px-3"><i class="fas fa-boxes me-2"></i>Stock</th>
                        <th class="text-nowrap px-3"><i class="fas fa-sync me-2"></i>Stock Update</th>
                        <th class="text-nowrap px-3"><i class="fas fa-comment me-2"></i>Keterangan</th>
                        <th class="text-nowrap px-3"><i class="fas fa-cog me-2"></i>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($opnames as $opname)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $opname->pengadaan->masterBarang->nama_barang }}</td>
                            <td>{{ $opname->tgl_opname->format('d/m/Y') }}</td>
                            <td>
                                @if($opname->kondisi == 'Baik')
                                    <span class="badge bg-success">{{ $opname->kondisi }}</span>
                                @elseif($opname->kondisi == 'Rusak Ringan')
                                    <span class="badge bg-warning">{{ $opname->kondisi }}</span>
                                @else
                                    <span class="badge bg-danger">{{ $opname->kondisi }}</span>
                                @endif
                            </td>
                            <td>{{ number_format($opname->pengadaan->stock_barang, 0, ',', '.') }}
                                {{ $opname->pengadaan->satuan->nama_satuan }}
                            </td>
                            <td>
                                @if($opname->stock_update)
                                    {{ number_format($opname->stock_update, 0, ',', '.') }}
                                    {{ $opname->pengadaan->satuan->nama_satuan }}
                                @else
                                    -
                                @endif
                            </td>
                            <td>{{ $opname->keterangan }}</td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="{{ route('opname.show', $opname) }}" class="btn btn-info btn-sm text-white">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('opname.edit', $opname) }}" class="btn btn-warning btn-sm text-white">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('opname.destroy', $opname) }}" method="POST"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">Tidak ada data</td>
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
            $('#opnameTable').DataTable({
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
        });
    </script>
@endpush