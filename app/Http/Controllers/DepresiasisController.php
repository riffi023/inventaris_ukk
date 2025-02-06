<?php

namespace App\Http\Controllers;

use App\Models\Depresiasi;
use Illuminate\Http\Request;

class DepresiasisController extends Controller
{
    public function index()
    {
        $depresiasis = Depresiasi::latest()->paginate(5);
        return view('depresiasi.index', compact('depresiasis'));
    }

    public function create()
    {
        return view('depresiasi.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'lama_depresiasi' => 'required',
        'keterangan' => 'required|max:50',
    ]);

    // Hitung nilai penyusutan default (misalnya dengan harga contoh 1 juta)
    $contohHarga = 1000000;
    $nilaiPenyusutan = $contohHarga / $request->lama_depresiasi;

    // Tambahkan nilai penyusutan ke data yang akan disimpan
    $data = $request->all();
    $data['nilai_penyusutan'] = $nilaiPenyusutan;

    Depresiasi::create($data);
    return redirect()->route('depresiasi.index')
        ->with('success', 'Depresiasi berhasil ditambahkan.');
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id): \Illuminate\Contracts\View\View
    {
        $depresiasi = Depresiasi::findOrFail($id);
        return view('depresiasi.show', compact('depresiasi'));
    }

    public function edit(Depresiasi $depresiasi)
    {
        return view('depresiasi.edit', compact('depresiasi'));
    }

    public function update(Request $request, Depresiasi $depresiasi)
{
    $request->validate([
        'lama_depresiasi' => 'required',
        'keterangan' => 'required|max:50',
    ]);

    // Hitung ulang nilai penyusutan
    $contohHarga = 1000000;
    $nilaiPenyusutan = $contohHarga / $request->lama_depresiasi;

    // Update data termasuk nilai penyusutan
    $data = $request->all();
    $data['nilai_penyusutan'] = $nilaiPenyusutan;

    $depresiasi->update($data);
    return redirect()->route('depresiasi.index')
        ->with('success', 'Depresiasi berhasil diperbarui.');
}

    public function destroy(Depresiasi $depresiasi)
    {
        // Cek apakah ada pengadaan yang menggunakan depresiasi ini
        if ($depresiasi->pengadaan()->exists()) {
            return redirect()->route('depresiasi.index')
                ->with('error', 'Depresiasi tidak dapat dihapus karena sedang digunakan di pengadaan.');
        }

        $depresiasi->delete();
        return redirect()->route('depresiasi.index')
            ->with('success', 'Depresiasi berhasil dihapus.');
    }
}
