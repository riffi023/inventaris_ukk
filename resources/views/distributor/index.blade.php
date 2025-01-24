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
                <h5 class="mb-0"><i class="fas fa-user me-2"></i>Data Distributor</h5>
                <p class="mb-0 text-white-50">Kelola data distributor anda</p>
            </div>
            <a href="{{ route('distributor.create') }}" class="btn btn-light">
                <i class="fas fa-plus-circle me-2"></i>Tambah Distributor
            </a>
        </div>
    </div>
    
    <div class="card-body">
        @include('components.alert')
        
        <div class="table-responsive">
            <table id="distributorsTable" class="table table-hover">
                <thead>
                    <tr>
                        <th class="text-nowrap px-3"><i class="fas fa-hashtag me-2"></i>No</th>
                        <th class="text-nowrap px-3"><i class="fas fa-user me-2"></i>Nama Distributor</th>
                        <th class="text-nowrap px-3"><i class="fas fa-map-marker-alt me-2"></i>Alamat</th>
                        <th class="text-nowrap px-3"><i class="fas fa-phone me-2"></i>No. Telepon</th>
                        <th class="text-nowrap px-3"><i class="fas fa-envelope me-2"></i>Email</th>
                        <th class="text-nowrap px-3"><i class="fas fa-info-circle me-2"></i>Keterangan</th>
                        <th class="text-nowrap px-3"><i class="fas fa-cog me-2"></i>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($distributors as $distributor)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $distributor->nama_distributor }}</td>
                        <td>{{ $distributor->alamat }}</td>
                        <td>{{ $distributor->no_telp }}</td>
                        <td>{{ $distributor->email }}</td>
                        <td>{{ $distributor->keterangan }}</td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('distributor.show',$distributor->id_distributor) }}" class="btn btn-info btn-action" title="Lihat Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('distributor.edit',$distributor->id_distributor) }}" class="btn btn-warning btn-action" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('distributor.destroy',$distributor->id_distributor) }}" method="POST" class="d-inline">
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
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function() {
    // Initialize DataTable
    $('#distributorsTable').DataTable({
        responsive: true,
        order: [[0, 'asc']],
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/id.json'
        }
    });

    // Delete confirmation using SweetAlert2
    $(document).on('click', '.delete-btn', function(e) {
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