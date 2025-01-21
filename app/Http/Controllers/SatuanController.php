<?php

namespace App\Http\Controllers;

use App\Models\Satuan;
use Illuminate\Http\Request;

class SatuanController extends Controller
{
    public function index()
    {
        $satuans = Satuan::latest()->paginate(5);
        return view('satuan.index', compact('satuans'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        return view('satuan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'satuan' => 'required|string|max:200|unique:tbl_satuan'
        ]);

        Satuan::create($request->all());
        return redirect()->route('satuan.index')
            ->with('success', 'Satuan berhasil ditambahkan.');
    }

    public function show(Satuan $satuan)
    {
        return view('satuan.show', compact('satuan'));
    }

    public function edit(Satuan $satuan)
    {
        return view('satuan.edit', compact('satuan'));
    }

    public function update(Request $request, Satuan $satuan)
    {
        $request->validate([
            'satuan' => 'required|string|max:200|unique:tbl_satuan,satuan,' . $satuan->id_satuan . ',id_satuan'
        ]);

        $satuan->update($request->all());
        return redirect()->route('satuan.index')
            ->with('success', 'Satuan berhasil diperbarui.');
    }

    public function destroy(Satuan $satuan)
    {
        $satuan->delete();
        return redirect()->route('satuan.index')
            ->with('success', 'Satuan berhasil dihapus.');
    }
}
