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

    .table > thead {
        background-color: #f8f9fc;
    }

    .table thead th {
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
        border-bottom: 2px solid #e3e6f0;
    }

    .btn-action:hover {
        transform: translateY(-2px);
        box-shadow: 0 3px 10px rgba(0,0,0,0.1);
    }

    .table tbody tr td {
        vertical-align: middle;
    }

    .btn-group .btn-action {
        margin: 0 2px;
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
                <h5 class="mb-0"><i class="fas fa-tag me-2"></i>Manajemen Merk</h5>
                <p class="mb-0 text-white-50">Kelola data merk</p>
            </div>
            <a href="{{ route('merk.create') }}" class="btn btn-light">
                <i class="fas fa-plus-circle me-2"></i>Tambah Merk
            </a>
        </div>
    </div>
    
    <div class="card-body">
        @include('components.alert')
        
        <div class="table-responsive">
            <table class="table table-hover" id="merkTable">
                <thead>
                    <tr>
                        <th width="5%"><i class="fas fa-hashtag me-2"></i>No</th>
                        <th width="30%"><i class="fas fa-tag me-2"></i>Nama Merk</th>
                        <th width="50%"><i class="fas fa-info-circle me-2"></i>Keterangan</th>
                        <th width="15%"><i class="fas fa-cog me-2"></i>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($merks as $merk)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $merk->merk }}</td>
                        <td>{{ $merk->keterangan }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('merk.show', $merk->id_merk) }}" 
                                   class="btn btn-info btn-action" title="Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('merk.edit', $merk->id_merk) }}" 
                                   class="btn btn-warning btn-action" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('merk.destroy', $merk->id_merk) }}" 
                                      method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="btn btn-danger btn-action delete-btn" 
                                            title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center">Tidak ada data</td>
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
$(document).ready(function() {
    $('#merkTable').DataTable({
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

    // Delete confirmation
    $('.delete-btn').click(function(e) {
        e.preventDefault();
        let form = $(this).closest('form');
        
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
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