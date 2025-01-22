<?php

namespace App\Http\Controllers;

use App\Models\HitungDepresiasi;
use App\Models\Pengadaan;
use Illuminate\Http\Request;
use Carbon\Carbon;

class HitungDepresiasiController extends Controller
{
    public function index()
    {
        $depresiasi = HitungDepresiasi::with('pengadaan.masterBarang')->latest()->get();
        return view('hitung_depresiasi.index', compact('depresiasi'));
    }

    public function create()
    {
        $pengadaan = Pengadaan::with('masterBarang')->get();
        return view('hitung_depresiasi.create', compact('pengadaan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_pengadaan' => 'required|exists:tbl_pengadaan,id_pengadaan',
            'tgl_hitung_depresiasi' => 'required|date',
            'bulan' => 'required|string',
            'durasi' => 'required|integer|min:1',
            'nilai_barang' => 'required|numeric'
        ]);

        $hitungDepresiasi = new HitungDepresiasi($request->all());
        $hitungDepresiasi->depresiasi_barang = $hitungDepresiasi->hitungDepresiasi();
        $hitungDepresiasi->save();

        return redirect()
            ->route('hitung-depresiasi.index')
            ->with('success', 'Perhitungan depresiasi berhasil ditambahkan');
    }

    public function show($id)
    {
        $depresiasi = HitungDepresiasi::with('pengadaan.masterBarang')->findOrFail($id);
        return view('hitung_depresiasi.show', compact('depresiasi'));
    }

    public function edit($id)
    {
        $depresiasi = HitungDepresiasi::findOrFail($id);
        $pengadaan = Pengadaan::with('masterBarang')->get();
        return view('hitung_depresiasi.edit', compact('depresiasi', 'pengadaan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_pengadaan' => 'required|exists:tbl_pengadaan,id_pengadaan',
            'tgl_hitung_depresiasi' => 'required|date',
            'bulan' => 'required|string',
            'durasi' => 'required|integer|min:1',
            'nilai_barang' => 'required|numeric'
        ]);

        $depresiasi = HitungDepresiasi::findOrFail($id);
        $depresiasi->fill($request->all());
        $depresiasi->depresiasi_barang = $depresiasi->hitungDepresiasi();
        $depresiasi->save();

        return redirect()
            ->route('hitung-depresiasi.index')
            ->with('success', 'Perhitungan depresiasi berhasil diperbarui');
    }

    public function destroy($id)
    {
        $depresiasi = HitungDepresiasi::findOrFail($id);
        $depresiasi->delete();

        return redirect()
            ->route('hitung-depresiasi.index')
            ->with('success', 'Perhitungan depresiasi berhasil dihapus');
    }
}