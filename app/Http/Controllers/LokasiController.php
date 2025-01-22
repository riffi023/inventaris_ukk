<?php

namespace App\Http\Controllers;

use App\Models\Lokasi;
use Illuminate\Http\Request;

class LokasiController extends Controller
{
    public function index()
    {
        $lokasis = Lokasi::all();
        return view('lokasi.index', compact('lokasis'));
    }

    public function create()
    {
        return view('lokasi.create');
    }

    private function generateKodeLokasi()
    {
        $lastLokasi = Lokasi::orderBy('id_lokasi', 'desc')->first();
        $lastNumber = $lastLokasi ? intval(substr($lastLokasi->kode_lokasi, 3)) : 0;
        $newNumber = $lastNumber + 1;
        return 'LOK' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_lokasi' => 'required|string|max:200',
            'keterangan' => 'required|string|max:50'
        ]);

        // Generate kode lokasi otomatis
        $validated['kode_lokasi'] = $this->generateKodeLokasi();

        Lokasi::create($validated);

        return redirect()->route('lokasi.index')
            ->with('success', 'Data lokasi berhasil ditambahkan');
    }

    public function show(Lokasi $lokasi)
    {
        return view('lokasi.show', compact('lokasi'));
    }

    public function edit(Lokasi $lokasi)
    {
        return view('lokasi.edit', compact('lokasi'));
    }

    public function update(Request $request, Lokasi $lokasi)
    {
        $validated = $request->validate([
            'kode_lokasi' => 'required|string|max:20|unique:tbl_lokasi,kode_lokasi,' . $lokasi->id_lokasi . ',id_lokasi',
            'nama_lokasi' => 'required|string|max:200',
            'keterangan' => 'required|string|max:50'
        ]);

        $lokasi->update($validated);

        return redirect()->route('lokasi.index')
            ->with('success', 'Data lokasi berhasil diperbarui');
    }

    public function destroy(Lokasi $lokasi)
    {
        $lokasi->delete();

        return redirect()->route('lokasi.index')
            ->with('success', 'Data lokasi berhasil dihapus');
    }
}