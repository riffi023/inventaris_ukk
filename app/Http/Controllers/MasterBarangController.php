<?php

namespace App\Http\Controllers;

use App\Models\MasterBarang;
use Illuminate\Http\Request;

class MasterBarangController extends Controller
{
    public function index()
    {
        $masterBarangs = MasterBarang::latest()->paginate(10);
        return view('master_barang.index', compact('masterBarangs'));
    }

    public function create()
    {
        return view('master_barang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_barang' => 'required|unique:tbl_master_barang',
            'nama_barang' => 'required',
            'spesifikasi_teknis' => 'required'
        ]);

        MasterBarang::create($request->all());
        return redirect()->route('master_barang.index')
            ->with('success', 'Barang berhasil ditambahkan.');
    }

    public function show(MasterBarang $masterBarang)
    {
        return view('master_barang.show', compact('masterBarang'));
    }

    public function edit(MasterBarang $masterBarang)
    {
        return view('master_barang.edit', compact('masterBarang'));
    }

    public function update(Request $request, MasterBarang $masterBarang)
    {
        $request->validate([
            'kode_barang' => 'required|unique:tbl_master_barang,kode_barang,'.$masterBarang->id_master_barang.',id_master_barang',
            'nama_barang' => 'required',
            'spesifikasi_teknis' => 'required'
        ]);

        $masterBarang->update($request->all());
        return redirect()->route('master_barang.index')
            ->with('success', 'Barang berhasil diperbarui.');
    }

    public function destroy(MasterBarang $masterBarang)
    {
        // Cek apakah ada pengadaan yang menggunakan barang ini
        if ($masterBarang->pengadaan()->exists()) {
            return redirect()->route('master_barang.index')
                ->with('error', 'Barang tidak dapat dihapus karena sedang digunakan di pengadaan.');
        }

        $masterBarang->delete();
        return redirect()->route('master_barang.index')
            ->with('success', 'Barang berhasil dihapus.');
    }
}
