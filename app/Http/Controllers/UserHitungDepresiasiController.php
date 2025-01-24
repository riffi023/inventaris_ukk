<?php

namespace App\Http\Controllers;

use App\Models\HitungDepresiasi;
use Illuminate\Http\Request;

class UserHitungDepresiasiController extends Controller
{
    public function index()
    {
        $depresiasi = HitungDepresiasi::with('pengadaan.masterBarang')
            ->orderBy('tgl_hitung_depresiasi', 'desc')
            ->get();
        return view('user.hitung_depresiasi.index', compact('depresiasi'));
    }

    public function show($id)
    {
        $depresiasi = HitungDepresiasi::with('pengadaan.masterBarang')
            ->findOrFail($id);
        return view('user.hitung_depresiasi.show', compact('depresiasi'));
    }
}
