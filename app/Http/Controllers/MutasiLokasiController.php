<?php

namespace App\Http\Controllers;

use App\Models\MutasiLokasi;
use App\Models\Lokasi;
use App\Models\Pengadaan;
use Illuminate\Http\Request;

class MutasiLokasiController extends Controller
{
    public function index()
    {
        $mutasiLokasis = MutasiLokasi::with(['lokasi', 'pengadaan'])->get();
        return view('mutasi_lokasi.index', compact('mutasiLokasis'));
    }

    public function create()
    {
        $lokasis = Lokasi::all();
        $pengadaans = Pengadaan::all();
        return view('mutasi_lokasi.create', compact('lokasis', 'pengadaans'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_lokasi' => 'required|exists:tbl_lokasi,id_lokasi',
            'id_pengadaan' => 'required|exists:tbl_pengadaan,id_pengadaan',
            'flag_lokasi' => 'required|string',
            'flag_pindah' => 'required|string'
        ]);

        MutasiLokasi::create($validated);

        return redirect()->route('mutasi-lokasi.index')
            ->with('success', 'Data mutasi lokasi berhasil ditambahkan');
    }

    public function show(MutasiLokasi $mutasiLokasi)
    {
        return view('mutasi_lokasi.show', compact('mutasiLokasi'));
    }

    public function edit(MutasiLokasi $mutasiLokasi)
    {
        $lokasis = Lokasi::all();
        $pengadaans = Pengadaan::all();
        return view('mutasi_lokasi.edit', compact('mutasiLokasi', 'lokasis', 'pengadaans'));
    }

    public function update(Request $request, MutasiLokasi $mutasiLokasi)
    {
        $validated = $request->validate([
            'id_lokasi' => 'required|exists:tbl_lokasi,id_lokasi',
            'id_pengadaan' => 'required|exists:tbl_pengadaan,id_pengadaan',
            'flag_lokasi' => 'required|string',
            'flag_pindah' => 'required|string'
        ]);

        $mutasiLokasi->update($validated);

        return redirect()->route('mutasi-lokasi.index')
            ->with('success', 'Data mutasi lokasi berhasil diperbarui');
    }

    public function destroy(MutasiLokasi $mutasiLokasi)
    {
        $mutasiLokasi->delete();

        return redirect()->route('mutasi-lokasi.index')
            ->with('success', 'Data mutasi lokasi berhasil dihapus');
    }
}