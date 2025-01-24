<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\MasterBarang;
use App\Models\Pengadaan;
use App\Models\HitungDepresiasi;
use App\Models\User;
use App\Models\Lokasi;
use App\Models\Distributor;
use App\Models\KategoriAsset;
use App\Models\Merk;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function adminHome(): View
    {
        // Additional statistics
        $totalKategori = KategoriAsset::count();
        $totalLokasi = Lokasi::count();
        $totalDistributor = Distributor::count();
        $totalMerk = Merk::count();
        
        // Monthly calculations
        $bulanIni = now()->month;
        $tahunIni = now()->year;
        
        $pengadaanBulanIni = Pengadaan::whereMonth('created_at', $bulanIni)
            ->whereYear('created_at', $tahunIni)
            ->count();
            
        $depresiasBulanIni = HitungDepresiasi::whereMonth('created_at', $bulanIni)
            ->whereYear('created_at', $tahunIni)
            ->count();

        $data = [
            // Existing counts
            'totalMasterBarang' => MasterBarang::count(),
            'totalPengadaan' => Pengadaan::count(),
            'totalDepresiasi' => HitungDepresiasi::count(),
            'totalLokasi' => Lokasi::count(),
            'totalDistributor' => Distributor::count(),
            'totalKategori' => KategoriAsset::count(),
            'totalMerk' => Merk::count(),
            'totalUsers' => User::count(),
            
            // Monthly statistics
            'pengadaanBulanIni' => $pengadaanBulanIni,
            'depresiasBulanIni' => $depresiasBulanIni,
            
            // Existing data
            'barangTerbaru' => MasterBarang::latest()->take(5)->get(),
            'recentPengadaan' => Pengadaan::with(['masterBarang'])->latest()->take(5)->get(),
            'recentDepresiasi' => HitungDepresiasi::with(['pengadaan.masterBarang'])->latest()->take(5)->get(),
        ];

        return view('adminHome', $data);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function managerHome(): View
    {
        return view('managerHome');
    }
}
