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
                <h5 class="mb-0"><i class="fas fa-list-alt me-2"></i>Data Sub Kategori Asset</h5>
                <p class="mb-0 text-white-50">Kelola data sub kategori asset anda</p>
            </div>
            <a href="{{ route('sub-kategori-asset.create') }}" class="btn btn-light">
                <i class="fas fa-plus-circle me-2"></i>Tambah Sub Kategori Asset
            </a>
        </div>
    </div>

    <div class="card-body">
        @include('components.alert')

        <div class="table-responsive">
            <table class="table table-hover" id="subKategoriTable" style="width: 100%">
                <thead>
                    <tr>
                        <th class="text-nowrap px-3"><i class="fas fa-hashtag me-2"></i>No</th>
                        <th class="text-nowrap px-3"><i class="fas fa-tag me-2"></i>Kode Sub Kategori Asset</th>
                        <th class="text-nowrap px-3"><i class="fas fa-box me-2"></i>Sub Kategori Asset</th>
                        <th class="text-nowrap px-3"><i class="fas fa-cog me-2"></i>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($subKategoriAssets as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->kode_sub_kategori_asset }}</td>
                        <td>{{ $item->sub_kategori_asset }}</td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('sub-kategori-asset.show', $item->id_sub_kategori_asset) }}" class="btn btn-info btn-action" title="Lihat Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('sub-kategori-asset.edit', $item->id_sub_kategori_asset) }}" class="btn btn-warning btn-action" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('sub-kategori-asset.destroy', $item->id_sub_kategori_asset) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-action delete-btn" title="Hapus">
                                        <i class="fas fa-trash-alt"></i>
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
@endsection

@push('scripts')
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function () {
        $('#subKategoriTable').DataTable({
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