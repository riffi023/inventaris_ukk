@extends('layouts.admin')

@section('title', 'Data Sub Kategori Asset')

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
</style>
@endsection

@section('content')
<div class="kategori-card bg-white rounded-xl shadow-sm">
    <div class="kategori-header p-4 d-flex justify-content-between align-items-center rounded-top">
        <div class="d-flex align-items-center">
            <div>
                <h5 class="mb-0 text-white">Data Sub Kategori Asset</h5>
                <p class="mb-0 text-white-50">Kelola data sub kategori asset anda</p>
            </div>
        </div>
        <a href="{{ route('sub-kategori-asset.create') }}" class="btn btn-light">
            <i class="fas fa-plus-circle me-2"></i>Tambah Sub Kategori
        </a>
    </div>
    
    <div class="p-4">
        @include('components.alert')
        <div class="table-container">
            <table id="subKategoriTable" class="table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Nama Sub Kategori</th>
                        <th>Kategori</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($subKategoriAssets as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->kode_sub_kategori_asset }}</td>
                        <td>{{ $item->sub_kategori_asset }}</td>
                        <td>{{ $item->kategoriAsset->kategori_asset ?? '-' }}</td>
                        <td class="text-center">
                            <a href="{{ route('sub-kategori-asset.show', $item->id_sub_kategori_asset) }}" 
                               class="btn btn-info btn-sm">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('sub-kategori-asset.edit', $item->id_sub_kategori_asset) }}" 
                               class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('sub-kategori-asset.destroy', $item->id_sub_kategori_asset) }}" 
                                  method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm delete-btn">
                                    <i class="fas fa-trash"></i>
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

@push('styles')
<link href="{{ asset('vendor/datatables/dataTables.bootstrap5.min.css') }}" rel="stylesheet">
@endpush

@push('scripts')
<script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/dataTables.bootstrap5.min.js') }}"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function() {
    $('#subKategoriTable').DataTable({
        responsive: true,
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/id.json'
        }
    });

    // Delete confirmation using SweetAlert2
    $('.delete-btn').click(function(e) {
        e.preventDefault();
        const form = $(this).closest('form');
        
        Swal.fire({
            title: 'Anda yakin?',
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
