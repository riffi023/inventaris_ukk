@extends('layouts.user')

@section('title', 'Data Opname')

@section('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap5.min.css">
<style>
    .card {
        border-radius: 15px;
        border: none;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        margin: 0.5rem;
    }

    .card-header {
        background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
        color: white;
        border-radius: 15px 15px 0 0 !important;
        padding: 1rem;
    }

    @media (max-width: 768px) {
        .card-header h5 {
            font-size: 1rem;
        }
        .card-header p {
            font-size: 0.8rem;
        }
        .table {
            font-size: 0.9rem;
        }
    }

    .btn-action {
        width: 38px;
        height: 38px;
        padding: 0;
        line-height: 38px;
        text-align: center;
        margin: 2px;
    }

    .table th {
        background-color: #f8f9fa;
        white-space: nowrap;
        font-weight: 600;
    }

    .badge {
        font-size: 0.8rem;
        padding: 0.4em 0.8em;
    }

    @media (max-width: 768px) {
        .btn-action {
            width: 34px;
            height: 34px;
            line-height: 34px;
        }
    }
</style>
@endsection

@section('user-content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="fas fa-clipboard-check me-2"></i>Data Opname</h5>

            </div>
        </div>

        <div class="card-body">
            @include('components.alert')

            <div class="table-responsive">
                <table class="table table-hover" id="opnameTable" style="width: 100%">
                    <thead>
                        <tr>
                            <th class="text-nowrap px-3"><i class="fas fa-hashtag me-2"></i>No</th>
                            <th class="text-nowrap px-3"><i class="fas fa-box me-2"></i>Barang</th>
                            <th class="text-nowrap px-3"><i class="fas fa-calendar-alt me-2"></i>Tanggal Opname</th>
                            <th class="text-nowrap px-3"><i class="fas fa-info-circle me-2"></i>Kondisi</th>
                            <th class="text-nowrap px-3"><i class="fas fa-boxes me-2"></i>Stock</th>
                            <th class="text-nowrap px-3"><i class="fas fa-user me-2"></i>Nama Pegawai</th>
                            <th class="text-nowrap px-3"><i class="fas fa-comment me-2"></i>Keterangan</th>
                            <th class="text-nowrap px-3"><i class="fas fa-eye me-2"></i>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($opnames as $opname)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $opname->pengadaan->masterBarang->nama_barang }}</td>
                                <td>{{ $opname->tgl_opname->format('d/m/Y') }}</td>
                                <td>
                                    @if($opname->kondisi == 'Baik')
                                        <span class="badge bg-success">{{ $opname->kondisi }}</span>
                                    @elseif($opname->kondisi == 'Rusak Ringan')
                                        <span class="badge bg-warning">{{ $opname->kondisi }}</span>
                                    @elseif($opname->kondisi == 'Rusak Berat')
                                        <span class="badge bg-danger">{{ $opname->kondisi }}</span>
                                    @elseif($opname->kondisi == 'Hilang')
                                    <span class="badge bg-danger">{{ $opname->kondisi }}</span>
                                    @endif
                                </td>
                                <td>{{ number_format($opname->pengadaan->stock_barang, 0, ',', '.') }} {{ $opname->pengadaan->satuan->nama_satuan }}</td>
                                <td>{{ $opname->nama_pegawai }}</td>
                                <td>{{ $opname->keterangan }}</td>
                                <td>
                                    <a href="{{ route('user.opname.show', $opname) }}" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('user.opname.edit', $opname) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">Tidak ada data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#opnameTable').DataTable({
                responsive: false,
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/id.json'
                },
                columnDefs: [
                    { responsivePriority: 1, targets: [0, 1, 6] },  // Kolom yang selalu ditampilkan
                    { responsivePriority: 2, targets: [3, 4] },     // Kolom prioritas kedua
                    { responsivePriority: 3, targets: '_all' }      // Sisanya
                ],
                order: [[2, 'desc']],
                initComplete: function (settings, json) {
                    $(this).closest('.dataTables_wrapper').find('.dataTables_scrollBody').css({
                        'max-height': '500px'
                    });
                }
            });
        });
    </script>
@endpush