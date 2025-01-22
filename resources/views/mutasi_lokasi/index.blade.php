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
                <i class="fas fa-exchange-alt me-2"></i>Data Mutasi Lokasi
            </h5>
            <p class="mb-0 text-white-50">Kelola data mutasi lokasi</p>
        </div>
        <a href="{{ route('mutasi-lokasi.create') }}" class="btn btn-light">
            <i class="fas fa-plus-circle me-2"></i>Tambah Mutasi
        </a>
    </div>

    <div class="card-body">
        @include('components.alert')

        <div class="table-responsive">
            <table class="table table-hover" id="mutasiLokasiTable">
                <thead>
                    <tr>
                        <th class="text-nowrap px-3"><i class="fas fa-hashtag me-2"></i>No</th>
                        <th class="text-nowrap px-3"><i class="fas fa-box me-2"></i>Barang</th>
                        <th class="text-nowrap px-3"><i class="fas fa-map-marker-alt me-2"></i>Lokasi</th>
                        <th class="text-nowrap px-3"><i class="fas fa-flag me-2"></i>Flag Lokasi</th>
                        <th class="text-nowrap px-3"><i class="fas fa-exchange-alt me-2"></i>Flag Pindah</th>
                        <th class="text-nowrap px-3"><i class="fas fa-calendar-alt me-2"></i>Tanggal</th>
                        <th class="text-nowrap px-3"><i class="fas fa-cog me-2"></i>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($mutasiLokasis as $mutasi)
                        <tr>
                            <td class="text-nowrap px-3">{{ $loop->iteration }}</td>
                            <td class="text-nowrap px-3">{{ $mutasi->pengadaan->masterBarang->nama_barang }}</td>
                            <td class="text-nowrap px-3">{{ $mutasi->lokasi->nama_lokasi }}</td>
                            <td class="text-nowrap px-3">{{ $mutasi->flag_lokasi }}</td>
                            <td class="text-nowrap px-3">{{ $mutasi->flag_pindah }}</td>
                            <td class="text-nowrap px-3">{{ $mutasi->created_at->format('d F Y') }}</td>
                            <td class="text-nowrap px-3">
                                <div class="d-flex">
                                    <a href="{{ route('mutasi-lokasi.show', $mutasi) }}"
                                        class="btn btn-info btn-action me-1" data-toggle="tooltip" title="Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('mutasi-lokasi.edit', $mutasi) }}"
                                        class="btn btn-warning btn-action me-1" data-toggle="tooltip" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('mutasi-lokasi.destroy', $mutasi) }}" method="POST"
                                        class="d-inline">
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
            $('#mutasiLokasiTable').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/id.json'
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