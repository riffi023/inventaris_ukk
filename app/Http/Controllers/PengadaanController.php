<?php

namespace App\Http\Controllers;

use App\Models\Pengadaan;
use App\Models\MasterBarang;
use App\Models\Depresiasi;
use App\Models\Merk;
use App\Models\Satuan;
use App\Models\SubKategoriAsset;
use App\Models\Distributor;
use Illuminate\Http\Request;

class PengadaanController extends Controller
{
    public function index()
    {
        $pengadaans = Pengadaan::with([
            'masterBarang',
            'depresiasi',
            'merk',
            'satuan',
            'subKategoriAsset',
            'distributor'
        ])->latest()->paginate(10);

        return view('pengadaan.index', compact('pengadaans'));
    }

    public function create()
    {
        $masterBarangs = MasterBarang::all();
        $depresiasis = Depresiasi::all();
        $merks = Merk::all();
        $satuans = Satuan::all();
        $subKategoriAssets = SubKategoriAsset::all();
        $distributors = Distributor::all();

        return view('pengadaan.create', compact(
            'masterBarangs',
            'depresiasis',
            'merks',
            'satuans',
            'subKategoriAssets',
            'distributors'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_master_barang' => 'required',
            'id_depresiasi' => 'required',
            'id_merk' => 'required',
            'id_satuan' => 'required',
            'id_sub_kategori_asset' => 'required',
            'id_distributor' => 'required',
            'kode_pengadaan' => 'required|string|max:20|unique:tbl_pengadaan',
            'no_invoice' => 'required|string|max:20',
            'no_seri_barang' => 'required|string|max:50',
            'tahun_produksi' => 'required|string|max:5',
            'tgl_pengadaan' => 'required|date',
            'harga_barang' => 'required',
            'nilai_barang' => 'required',
            'status_login' => 'required|in:0,1',
            'keterangan' => 'required|string|max:50',
        ]);

        $pengadaan = Pengadaan::create($validated);
        $pengadaan->hitungDepresiasi();

        return redirect()->route('pengadaan.index')
            ->with('success', 'Data pengadaan berhasil ditambahkan');
    }

    public function show(Pengadaan $pengadaan)
    {
        return view('pengadaan.show', compact('pengadaan'));
    }

    public function edit(Pengadaan $pengadaan)
    {
        $masterBarangs = MasterBarang::all();
        $depresiasis = Depresiasi::all();
        $merks = Merk::all();
        $satuans = Satuan::all();
        $subKategoriAssets = SubKategoriAsset::all();
        $distributors = Distributor::all();

        return view('pengadaan.edit', compact(
            'pengadaan',
            'masterBarangs',
            'depresiasis',
            'merks',
            'satuans',
            'subKategoriAssets',
            'distributors'
        ));
    }

    public function update(Request $request, Pengadaan $pengadaan)
    {
        $validated = $request->validate([
            'id_master_barang' => 'required',
            'id_depresiasi' => 'required',
            'id_merk' => 'required',
            'id_satuan' => 'required',
            'id_sub_kategori_asset' => 'required',
            'id_distributor' => 'required',
            'kode_pengadaan' => 'required|string|max:20|unique:tbl_pengadaan,kode_pengadaan,' . $pengadaan->id_pengadaan . ',id_pengadaan',
            'no_invoice' => 'required|string|max:20',
            'no_seri_barang' => 'required|string|max:50',
            'tahun_produksi' => 'required|string|max:5',
            'tgl_pengadaan' => 'required|date',
            'harga_barang' => 'required',
            'nilai_barang' => 'required',
            'status_login' => 'required|in:0,1',
            'keterangan' => 'required|string|max:50',
        ]);

        $pengadaan->update($validated);
        $pengadaan->hitungDepresiasi();

        return redirect()->route('pengadaan.index')
            ->with('success', 'Data pengadaan berhasil diperbarui');
    }

    public function destroy(Pengadaan $pengadaan)
    {
        $pengadaan->delete();

        return redirect()->route('pengadaan.index')
            ->with('success', 'Data pengadaan berhasil dihapus');
    }
}