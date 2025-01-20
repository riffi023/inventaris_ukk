@extends('layouts.admin')

@section('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
<style>
    .card {
        border-radius: 15px;
        border: none;
        box-shadow: 0 5px 20px rgba(0,0,0,0.05);
    }
    .card-header {
        background: linear-gradient(135deg, var(--primary) 0%, #2a52be 100%);
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

@section('content')
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h5 class="mb-0">Manajemen Merk</h5>
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
                        <th>No</th>
                        <th>Nama Merk</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($merks as $merk)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $merk->merk }}</td>
                        <td>{{ $merk->keterangan }}</td>
                        <td>
                            <form action="{{ route('merk.destroy', $merk->id_merk) }}" 
                                  method="POST" class="d-inline">
                                <a href="{{ route('merk.show', $merk->id_merk) }}" 
                                   class="btn btn-info btn-action">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('merk.edit', $merk->id_merk) }}" 
                                   class="btn btn-warning btn-action">
                                    <i class="fas fa-edit"></i>
                                </a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-action delete-btn">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr></tr>
                        <td colspan="4" class="text-center">Data Kosong</td>
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
<script>
$(document).ready(function() {
    $('#merkTable').DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/id.json'
        }
    });

    $('.delete-btn').click(function(e) {
        e.preventDefault();
        let form = $(this).closest('form');
        
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
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
