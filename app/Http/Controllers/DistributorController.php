<?php

namespace App\Http\Controllers;

use App\Models\Distributor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DistributorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $distributors = Distributor::latest()->paginate(5);
        return view('distributor.index', compact('distributors'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        return view('distributor.create');
    }

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'nama_distributor' => 'required|string|max:500',
            'alamat' => 'required|string|max:50',
            'no_telp' => 'required|string|max:15',
            'email' => 'required|email|max:30',
            'keterangan' => 'required|string|max:45',
        ]);

        DB::beginTransaction();
        try {
            // Buat distributor baru
            Distributor::create($validated);
            
            DB::commit();
            return redirect()
                ->route('distributor.index')
                ->with('success', 'Distributor berhasil ditambahkan');
                
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function show(Distributor $distributor)
    {
        return view('distributor.show', compact('distributor'));
    }

    public function edit(Distributor $distributor)
    {
        return view('distributor.edit', compact('distributor'));
    }

    public function update(Request $request, Distributor $distributor)
    {
        $request->validate([
            'nama_distributor' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required',
            'email' => 'required|email',
            'keterangan' => 'required',
        ]);

        $distributor->update($request->all());
        return redirect()->route('distributor.index')->with('success', 'Distributor berhasil diperbarui.');
    }

    public function destroy(Distributor $distributor)
    {
        $distributor->delete();
        return redirect()->route('distributor.index')->with('success', 'Distributor berhasil dihapus.');
    }
}
