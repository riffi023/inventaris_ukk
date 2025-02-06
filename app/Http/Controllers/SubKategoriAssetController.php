<?php

namespace App\Http\Controllers;

use App\Models\SubKategoriAsset;
use App\Models\KategoriAsset;

use Illuminate\Http\Request;

class SubKategoriAssetController extends Controller
{
    public function index()
    {
        $subKategoriAssets = SubKategoriAsset::with('kategoriAsset')->get();
        return view('sub_kategori_asset.index', compact('subKategoriAssets'));
    }

    public function create()
    {
        $kategoriAssets = KategoriAsset::all();
        return view('sub_kategori_asset.create', compact('kategoriAssets'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_kategori_asset' => 'required|exists:tbl_kategori_asset,id_kategori_asset',
            'kode_sub_kategori_asset' => 'required|string|max:20|unique:tbl_sub_kategori_asset',
            'sub_kategori_asset' => 'required|string|max:25'
        ]);

        SubKategoriAsset::create($request->all());

        return redirect()->route('sub-kategori-asset.index')
            ->with('success', 'Sub Kategori Asset berhasil ditambahkan.');
    }

    public function show(SubKategoriAsset $subKategoriAsset)
    {
        return view('sub_kategori_asset.show', compact('subKategoriAsset'));
    }

    public function edit(SubKategoriAsset $subKategoriAsset)
    {
        $kategoriAssets = KategoriAsset::all();
        return view('sub_kategori_asset.edit', compact('subKategoriAsset', 'kategoriAssets'));
    }

    public function update(Request $request, SubKategoriAsset $subKategoriAsset)
    {
        $request->validate([
            'id_kategori_asset' => 'required|exists:tbl_kategori_asset,id_kategori_asset',
            'kode_sub_kategori_asset' => 'required|string|max:20|unique:tbl_sub_kategori_asset,kode_sub_kategori_asset,'.$subKategoriAsset->id_sub_kategori_asset.',id_sub_kategori_asset',
            'sub_kategori_asset' => 'required|string|max:25'
        ]);

        $subKategoriAsset->update($request->all());

        return redirect()->route('sub-kategori-asset.index')
            ->with('success', 'Sub Kategori Asset berhasil diperbarui.');
    }

    public function destroy(SubKategoriAsset $subKategoriAsset)
    {
        // Cek apakah ada pengadaan yang menggunakan sub kategori asset ini
        if ($subKategoriAsset->pengadaan()->exists()) {
            return redirect()->route('sub-kategori-asset.index')
                ->with('error', 'Sub Kategori Asset tidak dapat dihapus karena sedang digunakan di pengadaan.');
        }

        $subKategoriAsset->delete();
        return redirect()->route('sub-kategori-asset.index')->with('success', 'Sub Kategori Asset berhasil dihapus.');
        
        
    }

    public function pengadaan()
    {
        return $this->hasMany(PengadaanController::class, 'id_sub_kategori_asset', 'id_sub_kategori_asset');
    }
}
