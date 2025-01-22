@extends('layouts.admin')

@section('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
<style>
    .card {
        border-radius: 15px;
        border: none;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
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
                <h5 class="mb-0">Manajemen Hitung Depresiasi</h5>
                <p class="mb-0 text-white-50">Kelola data perhitungan depresiasi</p>
            </div>
            <a href="{{ route('hitung-depresiasi.create') }}" class="btn btn-light">
                <i class="fas fa-plus-circle me-2"></i>Tambah Perhitungan
            </a>
        </div>
    </div>

    <div class="card-body">
        @include('components.alert')

        <div class="table-responsive">
            <table class="table table-hover" id="hitungDepresiasiTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Barang</th>
                        <th>Tanggal Hitung</th>
                        <th>Bulan</th>
                        <th>Durasi</th>
                        <th>Nilai Barang</th>
                        <th>Depresiasi/Bulan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($depresiasi as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->pengadaan->masterBarang->nama_barang }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->tgl_hitung_depresiasi)->format('d/m/Y') }}</td>
                            <td>{{ $item->bulan }}</td>
                            <td>{{ $item->durasi }} Bulan</td>
                            <td>Rp {{ number_format($item->nilai_barang, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($item->depresiasi_barang, 0, ',', '.') }}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('hitung-depresiasi.show', $item->id_hitung_depresiasi) }}"
                                        class="btn btn-info btn-action">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('hitung-depresiasi.edit', $item->id_hitung_depresiasi) }}"
                                        class="btn btn-warning btn-action">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('hitung-depresiasi.destroy', $item->id_hitung_depresiasi) }}"
                                        method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-action delete-btn">
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
@endsection

@push('scripts')
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#hitungDepresiasiTable').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/id.json'
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