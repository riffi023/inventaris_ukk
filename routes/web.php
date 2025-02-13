<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriAssetController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\DepresiasisController;
use App\Http\Controllers\DistributorController;
use App\Http\Controllers\SubKategoriAssetController;
use App\Http\Controllers\MerkController;
use App\Http\Controllers\MasterBarangController;
use App\Http\Controllers\SatuanController;
use App\Http\Controllers\PengadaanController;
use App\Http\Controllers\OpnameController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\MutasiLokasiController;
use App\Http\Controllers\HitungDepresiasiController;
use App\Http\Controllers\MonitoringController;
use App\Http\Controllers\UserHitungDepresiasiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserPengadaanController;
use App\Http\Controllers\UserOpnameController;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

/*------------------------------------------
--------------------------------------------
All Normal Users Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:user'])->group(function () {

    Route::get('/home', [HomeController::class, 'userHome'])->name('user.home');

    // Add these routes for user depresiasi
    Route::get('/user/hitung-depresiasi', [UserHitungDepresiasiController::class, 'index'])
        ->name('user.hitung_depresiasi.index');
    Route::get('/user/hitung-depresiasi/{id}', [UserHitungDepresiasiController::class, 'show'])
        ->name('user.hitung_depresiasi.show');

    // Add these routes for user pengadaan
    Route::get('/user/pengadaan', [UserPengadaanController::class, 'index'])->name('user.pengadaan.index');
    Route::get('/user/pengadaan/{pengadaan}', [UserPengadaanController::class, 'show'])->name('user.pengadaan.show');

    // Update user opname routes
    Route::get('/user/opname', [UserOpnameController::class, 'index'])->name('user.opname.index');
    Route::get('/user/opname/create', [UserOpnameController::class, 'create'])->name('user.opname.create');
    Route::post('/user/opname', [UserOpnameController::class, 'store'])->name('user.opname.store');
    Route::get('/user/opname/{opname}', [UserOpnameController::class, 'show'])->name('user.opname.show');
    Route::get('/user/opname/{opname}/edit', [UserOpnameController::class, 'edit'])->name('user.opname.edit');
    Route::put('/user/opname/{opname}', [UserOpnameController::class, 'update'])->name('user.opname.update');
    Route::delete('/user/opname/{opname}', [UserOpnameController::class, 'destroy'])->name('user.opname.destroy');

    // Add this route for History
    Route::get('/user/history', [UserController::class, 'getUserHistory'])->name('user.history');
});


/*------------------------------------------
--------------------------------------------
All Admin Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:admin'])->group(function () {
    Route::get('/admin/home', [HomeController::class, 'adminHome'])->name('admin.home');
    Route::get('/admin/settings', [SettingsController::class, 'index'])->name('admin.settings.index');
    Route::post('/admin/settings', [SettingsController::class, 'update'])->name('admin.settings.update');

    // Kategori Asset Routes
    Route::get('/kategori-asset', [KategoriAssetController::class, 'index'])->name('kategori_asset.index');
    Route::get('/kategori-asset/create', [KategoriAssetController::class, 'create'])->name('kategori_asset.create');
    Route::post('/kategori-asset', [KategoriAssetController::class, 'store'])->name('kategori_asset.store');
    Route::get('/kategori-asset/{kategoriAsset}', [KategoriAssetController::class, 'show'])->name('kategori_asset.show');
    Route::get('/kategori-asset/{kategoriAsset}/edit', [KategoriAssetController::class, 'edit'])->name('kategori_asset.edit');
    Route::put('/kategori-asset/{kategoriAsset}', [KategoriAssetController::class, 'update'])->name('kategori_asset.update');
    Route::delete('/kategori-asset/{kategoriAsset}', [KategoriAssetController::class, 'destroy'])->name('kategori_asset.destroy');

    Route::resource('depresiasi', DepresiasisController::class);

    // Sub Kategori Asset Routes
    Route::resource('sub-kategori-asset', SubKategoriAssetController::class);

    // Pastikan route distributor berada di dalam middleware auth
    Route::resource('distributor', DistributorController::class);

    // Merk Routes
    Route::resource('merk', MerkController::class);

    // Master Barang Routes
    Route::resource('master-barang', MasterBarangController::class)->names([
        'index' => 'master_barang.index',
        'create' => 'master_barang.create',
        'store' => 'master_barang.store',
        'show' => 'master_barang.show',
        'edit' => 'master_barang.edit',
        'update' => 'master_barang.update',
        'destroy' => 'master_barang.destroy',
    ]);

    // Add this route for Satuan
    Route::resource('satuan', SatuanController::class);

    // Add this route for Pengadaan
    Route::resource('pengadaan', PengadaanController::class);
    Route::get('/pengadaan/create', [PengadaanController::class, 'create'])->name('pengadaan.create');

    // Add this route for Opname
    Route::resource('opname', OpnameController::class);

    // Add this route for Lokasi
    Route::resource('lokasi', LokasiController::class);

    // Add this route for Mutasi Lokasi
    Route::resource('mutasi-lokasi', MutasiLokasiController::class);

    // Add this route for Hitung Depresiasi
    Route::resource('hitung-depresiasi', HitungDepresiasiController::class);

    // Add this route for Monitoring
    Route::get('/monitoring', [MonitoringController::class, 'index'])->name('monitoring.index');
});

Route::get('/active-sessions', [UserController::class, 'getActiveSessions'])->middleware('auth');
