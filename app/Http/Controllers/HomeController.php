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
    public function index(): View
    {
        return view('home');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function adminHome(): View
    {
        $data = [
            'totalMasterBarang' => MasterBarang::count(),
            'totalPengadaan' => Pengadaan::count(),
            'totalDepresiasi' => HitungDepresiasi::count(),
            'totalLokasi' => Lokasi::count(),
            'totalDistributor' => Distributor::count(),
            'totalKategori' => KategoriAsset::count(),
            'totalMerk' => Merk::count(),
            'totalUsers' => User::count(),
            'barangTerbaru' => MasterBarang::latest()->take(5)->get(),
            'recentPengadaan' => Pengadaan::with(['masterBarang'])->latest()->take(5)->get(),  // Changed from pengadaanTerbaru
            'recentDepresiasi' => HitungDepresiasi::with(['pengadaan.masterBarang'])->latest()->take(5)->get(),  // Add this line
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
