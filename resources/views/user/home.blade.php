@extends('layouts.user')

@section('title', 'User Dashboard')

@section('user-content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Pengadaan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pengadaanCount }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-shopping-cart fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Opname</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $opnameCount }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-check fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Total Depresiasi
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $depresiasiCount }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-chart-line fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data Hitung Depresiasi Terbaru</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="depresiasiTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Barang</th>
                                    <th>Tanggal Hitung</th>
                                    <th>Bulan</th>
                                    <th>Durasi</th>
                                    <th>Nilai Barang</th>
                                    <th>Depresiasi/Bulan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($depresiasi as $index => $item)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $item->pengadaan->masterBarang->nama_barang }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->tgl_hitung_depresiasi)->format('d/m/Y') }}</td>
                                        <td>{{ $item->bulan }}</td>
                                        <td>{{ $item->durasi }} Bulan</td>
                                        <td>Rp {{ number_format($item->nilai_barang, 0, ',', '.') }}</td>
                                        <td>Rp {{ number_format($item->depresiasi_barang, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data Pengadaan Terbaru</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="pengadaanTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Barang</th>
                                    <th>Kode</th>
                                    <th>Depresiasi</th>
                                    <th>Merk</th>
                                    <th>Satuan</th>
                                    <th>Sub Kategori</th>
                                    <th>Distributor</th>
                                    <th>No Invoice</th>
                                    <th>No Seri</th>
                                    <th>Tahun Produksi</th>
                                    <th>Tanggal Pengadaan</th>
                                    <th>Harga Barang</th>
                                    <th>Nilai Barang</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pengadaan as $index => $item)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $item->kode_pengadaan }}</td>
                            <td>{{ $item->masterBarang->nama_barang }}</td>
                            <td>{{ $item->depresiasi->lama_depresiasi }} Bulan</td>
                            <td>{{ $item->merk->merk }}</td>
                            <td>{{ $item->satuan->satuan }}</td>
                            <td>{{ $item->subKategoriAsset->sub_kategori_asset }}</td>
                            <td>{{ $item->distributor->nama_distributor }}</td>
                            <td>{{ $item->no_invoice }}</td>
                            <td>{{ $item->no_seri_barang }}</td>
                            <td>{{ $item->tahun_produksi }}</td>
                            <td>{{ $item->tgl_pengadaan->format('d/m/Y') }}</td>
                            <td>{{ $item->formatted_harga_barang }}</td>
                            <td>{{ $item->formatted_nilai_barang }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data Opname Terbaru</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="opnameTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Barang</th>
                                    <th>Tanggal Opname</th>
                                    <th>Kondisi</th>
                                    <th>Stock</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($opnames as $index => $item)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $item->pengadaan->masterBarang->nama_barang }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->tanggal_opname)->format('d/m/Y') }}</td>
                                        <td>{{ $item->kondisi }}</td>
                                        <td>{{ $item->pengadaan->stock_barang }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
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
            $('#depresiasiTable').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/id.json'
                }
            });
            $('#pengadaanTable').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/id.json'
                }
            });
            $('#opnameTable').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/id.json'
                }
            });
        });
    </script>
@endpush