<?php

namespace App\Http\Controllers;

use App\Models\Request;
use App\Models\Opname;
use Illuminate\Http\Request as HttpRequest;

class RequestController extends Controller
{
    public function index()
    {
        $requests = Request::with('opname')->get();
        return view('request.index', compact('requests'));
    }

    public function create()
    {
        $opnames = Opname::all();
        return view('request.create', compact('opnames'));
    }

    public function store(HttpRequest $request)
    {
        $validated = $request->validate([
            'id_opname' => 'required|exists:tbl_opname,id_opname',
            'stock_update' => 'required|integer|min:0',
            'keterangan' => 'nullable|string|max:100',
            'nama_pegawai' => 'required|string|max:100'
        ]);

        Request::create($validated);

        return redirect()->route('request.index')
            ->with('success', 'Permintaan berhasil dibuat');
    }

    public function show(Request $request)
    {
        return view('request.show', compact('request'));
    }

    public function edit(Request $request)
    {
        $opnames = Opname::all();
        return view('request.edit', compact('request', 'opnames'));
    }

    public function update(HttpRequest $request, Request $requestModel)
    {
        $validated = $request->validate([
            'id_opname' => 'required|exists:tbl_opname,id_opname',
            'stock_update' => 'required|integer|min:0',
            'keterangan' => 'nullable|string|max:100',
            'nama_pegawai' => 'required|string|max:100'
        ]);

        $requestModel->update($validated);

        return redirect()->route('request.index')
            ->with('success', 'Permintaan berhasil diperbarui');
    }

    public function destroy(Request $requestModel)
    {
        $requestModel->delete();

        return redirect()->route('request.index')
            ->with('success', 'Permintaan berhasil dihapus');
    }
}
