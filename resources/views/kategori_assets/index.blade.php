@extends('layouts.admin')
@section('styles')
<style>
    .kategori-card {
        transition: transform 0.2s ease;
        overflow: hidden;
    }
    .kategori-header {
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
    // ...existing code from distributor/index styles...
</style>
@endsection

@section('content')
<div class="kategori-card bg-white rounded-xl shadow-sm">
    <div class="kategori-header p-4 d-flex justify-content-between align-items-center rounded-top">
        <div>
            <h5 class="mb-0 text-white">Data Kategori Asset</h5>
            <p class="mb-0 text-white-50">Kelola data kategori asset anda</p>
        </div>
        <a href="{{ route('kategori_asset.create') }}" class="btn btn-light">
            <i class="fas fa-plus-circle me-2"></i>Tambah Kategori Asset
        </a>
    </div>
    
    <div class="p-4">
        @include('components.alert')
        
        <div class="table-container">
            <table id="kategoriTable" class="table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Kategori Asset</th>
                        <th>Kategori Asset</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kategoriAssets as $kategori)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $kategori->kode_kategori_asset }}</td>
                        <td>{{ $kategori->kategori_asset }}</td>
                        <td>
                            <form action="{{ route('kategori_asset.destroy',$kategori->id_kategori_asset) }}" method="POST" class="d-inline action-buttons">
                                <a href="{{ route('kategori_asset.show',$kategori->id_kategori_asset) }}" class="btn btn-info btn-sm" title="Lihat Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('kategori_asset.edit',$kategori->id_kategori_asset) }}" class="btn btn-warning btn-sm" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm delete-btn" title="Hapus">
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
    $('#kategoriTable').DataTable({
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
        $('..alert-success').addClass('animate__animated animate__fadeInDown');
        setTimeout(function() {
            $('.alert-success').addClass('animate__fadeOutUp');
        }, 3000);
    }
});
</script>
@endpush
