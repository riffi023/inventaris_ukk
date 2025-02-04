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
    private function formatNumber($number)
    {
        // Menghapus semua karakter kecuali angka dan titik
        $number = preg_replace('/[^0-9.]/', '', $number);
        // Mengubah string menjadi float
        return (float) str_replace('.', '', $number);
    }

    private function generateKodePengadaan()
    {
        // Get latest pengadaan to generate the next code
        $lastPengadaan = Pengadaan::orderBy('created_at', 'desc')->first();
        
        if (!$lastPengadaan) {
            // If no pengadaan exists yet, start with PGD00001
            return 'PGD00001';
        }

        // Get the numeric part of the last code
        $lastNumber = (int) substr($lastPengadaan->kode_pengadaan, 3);
        
        // Increment and pad with zeros
        $newNumber = str_pad($lastNumber + 1, 5, '0', STR_PAD_LEFT);
        
        // Return new code
        return 'PGD' . $newNumber;
    }

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
            'id_master_barang' => 'required|exists:tbl_master_barang,id_master_barang',
            'id_depresiasi' => 'required|exists:tbl_depresiasi,id_depresiasi',
            'id_merk' => 'required|exists:tbl_merk,id_merk',
            'id_satuan' => 'required|exists:tbl_satuan,id_satuan',
            'id_sub_kategori_asset' => 'required|exists:tbl_sub_kategori_asset,id_sub_kategori_asset',
            'id_distributor' => 'required|exists:tbl_distributor,id_distributor',
            'no_invoice' => 'required|string|max:45',
            'no_seri_barang' => 'required|string|max:45',
            'tahun_produksi' => 'required|string|max:4',
            'tgl_pengadaan' => 'required|date',
            'harga_barang' => 'required|string',
            'nilai_barang' => 'required|string',
            'stock_barang' => 'required|integer|min:0',
            'keterangan' => 'required|string|max:255',  // Add this
            'status_login' => 'required|in:0,1'         // Add this
        ]);

        // Format harga dan nilai barang
        $validated['harga_barang'] = $this->formatNumber($request->harga_barang);
        $validated['nilai_barang'] = $this->formatNumber($request->nilai_barang);

        // Generate kode pengadaan
        $validated['kode_pengadaan'] = $this->generateKodePengadaan();

        // Set default status if not provided
        $validated['status_login'] = $request->status_login ?? '1';

        // Hitung depresiasi
        $depresiasi = Depresiasi::find($request->id_depresiasi);
        $validated['depresiasi_barang'] = $validated['nilai_barang'] / ($depresiasi->lama_depresiasi ?? 1);

        Pengadaan::create($validated);

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

        // Hitung depresiasi
        $depresiasiBarang = $pengadaan->hitungDepresiasi($pengadaan->nilai_barang, $pengadaan->depresiasi->lama_depresiasi);

        return view('pengadaan.edit', compact(
            'pengadaan',
            'masterBarangs',
            'depresiasis',
            'merks',
            'satuans',
            'subKategoriAssets',
            'distributors',
            'depresiasiBarang'
        ));
    }

    public function update(Request $request, Pengadaan $pengadaan)
    {
        $validated = $request->validate([
            'id_master_barang' => 'required|exists:tbl_master_barang,id_master_barang',
            'id_depresiasi' => 'required|exists:tbl_depresiasi,id_depresiasi',
            'id_merk' => 'required|exists:tbl_merk,id_merk',
            'id_satuan' => 'required|exists:tbl_satuan,id_satuan',
            'id_sub_kategori_asset' => 'required|exists:tbl_sub_kategori_asset,id_sub_kategori_asset',
            'id_distributor' => 'required|exists:tbl_distributor,id_distributor',
            'no_invoice' => 'required|string|max:45',
            'no_seri_barang' => 'required|string|max:45',
            'tahun_produksi' => 'required|string|max:4',
            'tgl_pengadaan' => 'required|date',
            'harga_barang' => 'required|string',
            'nilai_barang' => 'required|string',
            'stock_barang' => 'required|integer|min:0',
            'keterangan' => 'required|string|max:255',  // Add this
            'status_login' => 'required|in:0,1'         // Add this
        ]);

        // Format harga dan nilai barang
        $validated['harga_barang'] = $this->formatNumber($request->harga_barang);
        $validated['nilai_barang'] = $this->formatNumber($request->nilai_barang);

        // Hitung ulang depresiasi
        $depresiasi = Depresiasi::find($request->id_depresiasi);
        $validated['depresiasi_barang'] = $validated['nilai_barang'] / ($depresiasi->lama_depresiasi ?? 1);

        $pengadaan->update($validated);

        return redirect()->route('pengadaan.index')
            ->with('success', 'Data pengadaan berhasil diperbarui');
    }

    public function destroy(Pengadaan $pengadaan)
    {
        $pengadaan->delete();

        return redirect()->route('pengadaan.index')
            ->with('success', 'Data pengadaan berhasil dihapus');
    }

    protected function validateRequest(Request $request)
    {
        return $request->validate([
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
            'harga_barang' => 'required|numeric',
            'nilai_barang' => 'required|numeric',
            'stock_barang' => 'required|integer|min:0',
            'status_login' => 'required|in:0,1',
            'keterangan' => 'required|string|max:50',
        ]);
    }
}