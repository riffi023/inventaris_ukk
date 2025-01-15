@extends('layouts.admin')
@section('styles')
<style>
    .distributor-card {
        transition: transform 0.2s ease;
        overflow: hidden;
    }
    .distributor-header {
        background: linear-gradient(135deg, var(--primary) 0%, #2a52be 100%);
        color: white;
        border: none;
    }
    .table-container {
        background: white;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        padding: 20px;
    }
    .table thead th {
        background: #f8f9fa;
        color: #344767;
        font-weight: 600;
        border: none;
    }
    .table tbody tr {
        transition: all 0.2s;
    }
    .table tbody tr:hover {
        background-color: #f8f9fa;
        transform: translateY(-2px);
    }
    .action-buttons .btn {
        width: 32px;
        height: 32px;
        padding: 0;
        line-height: 32px;
        text-align: center;
        margin: 0 2px;
        border-radius: 8px;
        transition: all 0.2s;
    }
    .action-buttons .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    .alert {
        border-radius: 10px;
        border: none;
    }
</style>
@endsection

@section('content')
<div class="distributor-card bg-white rounded-xl shadow-sm">
    <div class="distributor-header p-4 d-flex justify-content-between align-items-center rounded-top">
        <div>
            <h5 class="mb-0 text-white">Data Distributor</h5>
            <p class="mb-0 text-white-50">Kelola data distributor anda</p>
        </div>
        <a href="{{ route('distributor.create') }}" class="btn btn-light">
            <i class="fas fa-plus-circle me-2"></i>Tambah Distributor
        </a>
    </div>
    
    <div class="p-4">
        @include('components.alert')
        
        <div class="table-container">
            <table id="distributorsTable" class="table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Distributor</th>
                        <th>Alamat</th>
                        <th>No. Telepon</th>
                        <th>Email</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
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
                            <form action="{{ route('distributor.destroy',$distributor->id_distributor) }}" method="POST" class="d-inline action-buttons">
                                <a href="{{ route('distributor.show',$distributor->id_distributor) }}" class="btn btn-info btn-sm" title="Lihat Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('distributor.edit',$distributor->id_distributor) }}" class="btn btn-warning btn-sm" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm delete-btn" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')" title="Hapus">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
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

    // Success message animation
    if ($('.alert-success').length > 0) {
        $('.alert-success').addClass('animate__animated animate__fadeInDown');
        setTimeout(function() {
            $('.alert-success').addClass('animate__fadeOutUp');
        }, 3000);
    }
});
</script>
@endpush
