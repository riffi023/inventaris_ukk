<?php

namespace App\Http\Controllers;

use App\Models\KategoriAsset;
use Illuminate\Http\Request;

class KategoriAssetController extends Controller
{
    public function index()
    {
        $kategoriAssets = KategoriAsset::all();
        return view('kategori_assets.index', compact('kategoriAssets'));
    }

    public function create()
    {
        return view('kategori_assets.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_kategori_asset' => 'required|string',
            'kategori_asset' => 'required|string',
        ]);

        KategoriAsset::create([
            'kode_kategori_asset' => $request->kode_kategori_asset,
            'kategori_asset' => $request->kategori_asset,
        ]);

        return redirect()->route('kategori_asset.index')
                         ->with('success', 'Kategori Asset created successfully.');
    }

    public function show($id)
    {
        $kategoriAsset = KategoriAsset::findOrFail($id);
        return view('kategori_assets.show', compact('kategoriAsset'));
    }

    public function edit(KategoriAsset $kategoriAsset)
    {
        return view('kategori_assets.edit', compact('kategoriAsset'));
    }

    public function update(Request $request, KategoriAsset $kategoriAsset)
    {
        $request->validate([
            'kode_kategori_asset' => 'required',
            'kategori_asset' => 'required',
        ]);

        $kategoriAsset->update($request->all());

        return redirect()->route('kategori_asset.index')
                         ->with('success', 'Kategori Asset updated successfully.');
    }

    public function destroy(KategoriAsset $kategoriAsset)
    {
        $kategoriAsset->delete();

        return redirect()->route('kategori_asset.index')
                         ->with('success', 'Kategori Asset deleted successfully.');
    }
}
