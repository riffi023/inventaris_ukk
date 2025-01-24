@extends('layouts.user')

@section('title', 'Data Opname')

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
</style>
@endsection

@section('user-content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <div>
                <h5 class="mb-0"><i class="fas fa-clipboard-check me-2"></i>Data Opname</h5>
                <p class="mb-0 text-white-50">Data opname barang dari admin</p>
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
                                    @else
                                        <span class="badge bg-danger">{{ $opname->kondisi }}</span>
                                    @endif
                                </td>
                                <td>{{ number_format($opname->pengadaan->stock_barang, 0, ',', '.') }}</td>
                                <td>{{ $opname->keterangan }}</td>
                                <td>
                                    <a href="{{ route('user.opname.show', $opname) }}" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Tidak ada data</td>
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
    <script>
        $(document).ready(function () {
            $('#opnameTable').DataTable({
                scrollX: true,
                scrollCollapse: true,
                autoWidth: false,
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/id.json'
                }
            });
        });
    </script>
@endpush