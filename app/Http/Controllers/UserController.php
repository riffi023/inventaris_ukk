<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\MasterBarang;
use App\Models\Pengadaan;
use App\Models\HitungDepresiasi;
use App\Models\Lokasi;
use App\Models\Opname;
use App\Models\Depresiasi;


class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $pengadaanCount = Pengadaan::count();
        $opnameCount = Opname::count();
        $depresiasiCount = HitungDepresiasi::count();

        // Ambil data untuk tabel
        $depresiasi = HitungDepresiasi::with('pengadaan.masterBarang')->orderBy('tgl_hitung_depresiasi', 'desc')->take(5)->get();
        $pengadaan = Pengadaan::with('masterBarang')->orderBy('created_at', 'desc')->take(5)->get();
        $opnames = Opname::with('pengadaan.masterBarang')->orderBy('created_at', 'desc')->take(5)->get();

        return view('home', compact('pengadaanCount', 'opnameCount', 'depresiasiCount', 'depresiasi', 'pengadaan', 'opnames'));
    }
}
