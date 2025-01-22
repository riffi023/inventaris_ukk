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
    <div class="card-header d-flex justify-content-between align-items-center">
        <div>
            <h5 class="mb-0">
                <i class="fas fa-map-marker-alt me-2"></i>Data Lokasi
            </h5>
            <p class="mb-0 text-white-50">Kelola data lokasi</p>
        </div>
        <a href="{{ route('lokasi.create') }}" class="btn btn-light">
            <i class="fas fa-plus-circle me-2"></i>Tambah Lokasi
        </a>
    </div>

    <div class="card-body">
        @include('components.alert')

        <div class="table-responsive">
            <table class="table table-hover" id="lokasiTable">
                <thead>
                    <tr>
                        <th class="text-nowrap px-3"><i class="fas fa-hashtag me-2"></i>No</th>
                        <th class="text-nowrap px-3"><i class="fas fa-barcode me-2"></i>Kode Lokasi</th>
                        <th class="text-nowrap px-3"><i class="fas fa-map-marker-alt me-2"></i>Nama Lokasi</th>
                        <th class="text-nowrap px-3"><i class="fas fa-sticky-note me-2"></i>Keterangan</th>
                        <th class="text-nowrap px-3"><i class="fas fa-cog me-2"></i>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($lokasis as $lokasi)
                        <tr>
                            <td class="text-nowrap px-3">{{ $loop->iteration }}</td>
                            <td class="text-nowrap px-3">{{ $lokasi->kode_lokasi }}</td>
                            <td class="text-nowrap px-3">{{ $lokasi->nama_lokasi }}</td>
                            <td class="text-nowrap px-3">{{ $lokasi->keterangan }}</td>
                            <td class="text-nowrap px-3">
                                <div class="d-flex">
                                    <a href="{{ route('lokasi.show', $lokasi) }}" class="btn btn-info btn-action me-1"
                                        data-toggle="tooltip" title="Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('lokasi.edit', $lokasi) }}" class="btn btn-warning btn-action me-1"
                                        data-toggle="tooltip" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('lokasi.destroy', $lokasi) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-action delete-btn"
                                            data-toggle="tooltip" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@push('scripts')
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#lokasiTable').DataTable({
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
@endsection