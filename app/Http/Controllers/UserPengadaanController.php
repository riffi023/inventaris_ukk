<?php

namespace App\Http\Controllers;

use App\Models\Pengadaan;
use Illuminate\Http\Request;

class UserPengadaanController extends Controller
{
    public function index()
    {
        // Get data with relationships like in admin
        $pengadaans = Pengadaan::with([
            'masterBarang',
            'depresiasi',
            'merk',
            'satuan',
            'subKategoriAsset',
            'distributor'
        ])->get();
        
        return view('user.pengadaan.index', compact('pengadaans'));
    }

    public function show(Pengadaan $pengadaan)
    {
        return view('user.pengadaan.show', compact('pengadaan'));
    }
}
