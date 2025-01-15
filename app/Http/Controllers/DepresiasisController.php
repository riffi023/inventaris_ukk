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

        Depresiasi::create($request->all());
        return redirect()->route('depresiasi.index')
            ->with('success', 'Depresiasi berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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

        $depresiasi->update($request->all());
        return redirect()->route('depresiasi.index')
            ->with('success', 'Depresiasi berhasil diperbarui.');
    }

    public function destroy(Depresiasi $depresiasi)
    {
        $depresiasi->delete();
        return redirect()->route('depresiasi.index')
            ->with('success', 'Depresiasi berhasil dihapus.');
    }
}
