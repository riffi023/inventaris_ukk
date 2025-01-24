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
                <h5 class="mb-0"><i class="fas fa-boxes me-2"></i>Manajemen Master Barang</h5>
                <p class="mb-0 text-white-50">Kelola data master barang</p>
            </div>
            <a href="{{ route('master_barang.create') }}" class="btn btn-light">
                <i class="fas fa-plus-circle me-2"></i>Tambah Barang
            </a>
        </div>
    </div>
    
    <div class="card-body">
        @include('components.alert')
        
        <div class="table-responsive">
            <table class="table table-hover" id="masterBarangTable">
                <thead>
                    <tr>
                        <th><i class="fas fa-hashtag me-2"></i>No</th>
                        <th><i class="fas fa-barcode me-2"></i>Kode Barang</th>
                        <th><i class="fas fa-box me-2"></i>Nama Barang</th>
                        <th><i class="fas fa-clipboard-list me-2"></i>Spesifikasi</th>
                        <th><i class="fas fa-cog me-2"></i>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($masterBarangs as $barang)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $barang->kode_barang }}</td>
                        <td>{{ $barang->nama_barang }}</td>
                        <td>{{ $barang->spesifikasi_teknis }}</td>
                        <td>
                            <form action="{{ route('master_barang.destroy', $barang->id_master_barang) }}" method="POST" class="d-inline">
                                <a href="{{ route('master_barang.show', $barang->id_master_barang) }}" class="btn btn-info btn-action" title="Lihat">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('master_barang.edit', $barang->id_master_barang) }}" class="btn btn-warning btn-action" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-action delete-btn" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">Data Kosong</td>
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
        $('#masterBarangTable').DataTable({
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
        });

        $('.delete-btn').click(function(e) {
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