<?php

namespace App\Http\Controllers;

use App\Models\Opname;
use App\Models\Pengadaan;
use Illuminate\Http\Request;

class OpnameController extends Controller
{
    public function index()
    {
        $opnames = Opname::with('pengadaan.masterBarang')->get();
        return view('opname.index', compact('opnames'));
    }

    public function create()
    {
        $pengadaans = Pengadaan::with('masterBarang')->get();
        return view('opname.create', compact('pengadaans'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_pengadaan' => 'required|exists:tbl_pengadaan,id_pengadaan',
            'tgl_opname' => 'required|date',
            'kondisi' => 'required|string|max:45',
            'keterangan' => 'required|string|max:100',
            'stock_update' => 'nullable|integer|min:0',
            'nama_pegawai' => 'required|string|max:100'
        ]);

        // Buat opname baru
        $opname = Opname::create($validated);

        // Update stock di pengadaan jika ada perubahan
        if ($request->filled('stock_update')) {
            $opname->pengadaan->update([
                'stock_barang' => $validated['stock_update']
            ]);
        }

        return redirect()->route('opname.index')
            ->with('success', 'Data opname berhasil ditambahkan');
    }

    public function show(Opname $opname)
    {
        return view('opname.show', compact('opname'));
    }

    public function edit(Opname $opname)
    {
        $pengadaans = Pengadaan::with('masterBarang')->get();
        return view('opname.edit', compact('opname', 'pengadaans'));
    }

    public function update(Request $request, Opname $opname)
    {
        $validated = $request->validate([
            'id_pengadaan' => 'required|exists:tbl_pengadaan,id_pengadaan',
            'tgl_opname' => 'required|date',
            'kondisi' => 'required|string|max:45',
            'keterangan' => 'required|string|max:100',
            'stock_update' => 'nullable|integer|min:0',
            'nama_pegawai' => 'required|string|max:100'
        ]);

        // Update stock di pengadaan jika ada perubahan
        if ($request->filled('stock_update')) {
            $opname->pengadaan->update([
                'stock_barang' => $validated['stock_update']
            ]);
        }

        $opname->update($validated);

        return redirect()->route('opname.index')
            ->with('success', 'Data opname berhasil diperbarui');
    }

    public function destroy(Opname $opname)
    {
        $opname->delete();

        return redirect()->route('opname.index')
            ->with('success', 'Data opname berhasil dihapus');
    }
}