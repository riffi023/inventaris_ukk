@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
    <div id="welcomeToast" class="welcome-toast hidden">
        <div class="bg-white rounded-lg shadow-xl p-4 max-w-sm w-full">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <svg class="h-8 w-8 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div class="ml-3 w-0 flex-1">
                    <p class="text-sm font-medium text-gray-900" id="welcomeMessage"></p>
                    <p class="mt-1 text-sm text-gray-500" id="loginTime"></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Grid -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8" data-aos="fade-up">
        <div class="bg-white p-6 rounded-xl shadow-md">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-semibold">Stok Barang</h3>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
            </div>
            <div class="text-3xl font-bold text-blue-600">150 Unit</div>
            <div class="text-sm text-gray-500 mt-2">Total stok barang saat ini</div>
        </div>

        <!-- Statistik Penjualan -->
        <div class="bg-white p-6 rounded-xl shadow-md">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-semibold">Penjualan Bulan Ini</h3>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                </svg>
            </div>
            <div class="text-3xl font-bold text-green-600">Rp 45.000.000</div>
            <div class="text-sm text-gray-500 mt-2">Peningkatan 12% dari bulan lalu</div>
        </div>

        <!-- Statistik Barang Habis -->
        <div class="bg-white p-6 rounded-xl shadow-md">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-semibold">Barang Hampir Habis</h3>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
            </div>
            <div class="text-3xl font-bold text-red-600">7 Produk</div>
            <div class="text-sm text-gray-500 mt-2">Perlu segera di-restock</div>
        </div>
    </div>

    <!-- Tabel Stok Barang -->
    <div class="mt-8 bg-white rounded-xl shadow-md">
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-xl font-semibold">Daftar Stok Barang</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-100 text-gray-600">
                        <th class="py-3 px-4 text-left">Nama Barang</th>
                        <th class="py-3 px-4 text -left">Kategori</th>
                        <th class="py-3 px-4 text-left">Stok</th>
                        <th class="py-3 px-4 text-left">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b">
                        <td class="py-3 px-4">Laptop Asus</td>
                        <td class="py-3 px-4">Elektronik</td>
                        <td class="py-3 px-4">25 Unit</td>
                        <td class="py-3 px-4">
                            <span class="bg-green-100 text-green-600 px-2 py-1 rounded-full text-xs">Tersedia</span>
                        </td>
                    </tr>
                    <tr class="border-b">
                        <td class="py-3 px-4">Smartphone Samsung</td>
                        <td class="py-3 px-4">Elektronik</td>
                        <td class="py-3 px-4">10 Unit</td>
                        <td class="py-3 px-4">
                            <span class="bg-yellow-100 text-yellow-600 px-2 py-1 rounded-full text-xs">Segera
                                Habis</span>
                        </td>
                    </tr>
                    <tr class="border-b">
                        <td class="py-3 px-4">Printer Canon</td>
                        <td class="py-3 px-4">Elektronik</td>
                        <td class="py-3 px-4">5 Unit</td>
                        <td class="py-3 px-4">
                            <span class="bg-red-100 text-red-600 px-2 py-1 rounded-full text-xs">Habis</span>
                        </td>
                    </tr>
                    <tr class="border-b">
                        <td class="py-3 px-4">Kursi Kantor</td>
                        <td class="py-3 px-4">Furniture</td>
                        <td class="py-3 px-4">15 Unit</td>
                        <td class="py-3 px-4">
                            <span class="bg-green-100 text-green-600 px-2 py-1 rounded-full text-xs">Tersedia</span>
                        </td>
                    </tr>
                    <tr class="border-b">
                        <td class="py-3 px-4">Meja Kerja</td>
                        <td class="py-3 px-4">Furniture</td>
                        <td class="py-3 px-4">8 Unit</td>
                        <td class="py-3 px-4">
                            <span class="bg-yellow-100 text-yellow-600 px-2 py-1 rounded-full text-xs">Segera
                                Habis</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Sales Chart Card with fixed height -->
    <div class="mt-8 bg-white rounded-xl shadow-md p-6 transition-all hover:shadow-lg" data-aos="fade-up">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-xl font-semibold text-gray-800">Grafik Penjualan Bulanan</h3>
            <div class="flex gap-2">
                <button class="px-3 py-1 text-sm bg-gray-100 hover:bg-gray-200 rounded-full transition-colors">
                    Minggu Ini
                </button>
                <button class="px-3 py-1 text-sm bg-blue-500 text-white hover:bg-blue-600 rounded-full transition-colors">
                    Bulan Ini
                </button>
            </div>
        </div>
        <div style="height: 300px;"> <!-- Fixed height container -->
            <canvas id="salesChart"></canvas>
        </div>
    </div>

    <!-- Grafik dan Transaksi -->
    <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <!-- Grafik Aktivitas -->
        <div class="bg-white rounded-xl shadow-md p-6" data-aos="fade-right">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-semibold">Aktivitas Stok Bulanan</h3>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-500" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                </svg>
            </div>
            <div class="h-48 flex items-center justify-center">
                <div class="text-center">
                    <p class="text-gray-500">Grafik aktivitas stok</p>
                    <p class="text-sm text-gray-400">(Placeholder untuk grafik)</p>
                </div>
            </div>
        </div>

        <!-- Transaksi Terakhir -->
        <div class="bg-white rounded-xl shadow-md p-6" data-aos="fade-left">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-semibold">Transaksi Terakhir</h3>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-500" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 14l6-6m-5.5.5h.01m4.99 5h.01M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16l3.5-2 3.5 2 3.5-2 3.5 2zM10 8.5a.5.5 0 11-1 0 .5.5 0 011 0zm4 5a.5.5 0 11-1 0 .5.5 0 011 0z" />
                </svg>
            </div>
            <div class="space-y-3">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="font-medium">Penjualan Laptop</p>
                        <p class="text-sm text-gray-500">12 Mei 2023</p>
                    </div>
                    <span class="text-green-600 font-bold">+Rp 15.000.000</span>
                </div>
                <div class="flex justify-between items-center">
                    <div>
                        <p class="font-medium">Pembelian Printer</p>
                        <p class="text-sm text-gray-500">10 Mei 2023</p>
                    </div>
                    <span class="text-red-600 font-bold">-Rp 5.000.000</span>
                </div>
                <div class="flex justify-between items-center">
                    <div>
                        <p class="font-medium">Penjualan Smartphone</p>
                        <p class="text-sm text-gray-500">08 Mei 2023</p>
                    </div>
                    <span class="text-green-600 font-bold">+Rp 8.000.000</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Ringkasan Aktivitas -->
    <div class="mt-8 bg-white rounded-xl shadow-md">
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-xl font-semibold">Ringkasan Aktivitas</h3>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-4 divide-y md:divide-y-0 md:divide-x">
            <div class="p-6 text-center">
                <div class="text-3xl font-bold text-blue-600">42</div>
                <div class="text-sm text-gray-500 mt-2">Total Transaksi</div>
            </div>
            <div class="p-6 text-center">
                <div class="text-3xl font-bold text-green-600">Rp 250 JT</div>
                <div class="text-sm text-gray-500 mt-2">Pendapatan Bulan Ini</div>
            </div>
            <div class="p-6 text-center">
                <div class="text-3xl font-bold text-purple-600">18</div>
                <div class="text-sm text-gray-500 mt-2">Produk Terjual</div>
            </div>
            <div class="p-6 text-center">
                <div class="text-3xl font-bold text-red-600">7</div>
                <div class="text-sm text-gray-500 mt-2">Produk Habis</div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
<style>
    .welcome-toast {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 1000;
        animation: slideInRight 0.5s ease;
    }

    @keyframes slideInRight {
        from { transform: translateX(100%); }
        to { transform: translateX(0); }
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Initialize AOS
    AOS.init({
        duration: 800,
        once: true
    });

    // Welcome Message Implementation
    document.addEventListener('DOMContentLoaded', function() {
        const hour = new Date().getHours();
        const userName = "{{ Auth::user()->name }}";
        let greeting;

        if (hour < 12) greeting = "Selamat Pagi";
        else if (hour < 15) greeting = "Selamat Siang";
        else if (hour < 18) greeting = "Selamat Sore";
        else greeting = "Selamat Malam";

        Swal.fire({
            title: `<span class="text-2xl font-bold">${greeting}, ${userName}!</span>`,
            html: `
                <div class="space-y-4">
                    <p class="text-lg text-gray-600">Selamat datang di Sistem Inventaris</p>
                    <p class="text-sm text-gray-500">Login pada ${new Date().toLocaleString('id-ID', { 
                        dateStyle: 'full', 
                        timeStyle: 'short' 
                    })}</p>
                </div>
            `,
            icon: 'success',
            confirmButtonText: 'Mulai Bekerja',
            confirmButtonColor: '#3B82F6',
            timer: 3000,
            timerProgressBar: true,
            showClass: {
                popup: 'animate__animated animate__fadeInDown'
            },
            hideClass: {
                popup: 'animate__animated animate__fadeOutUp'
            }
        });

        // Store last login time
        localStorage.setItem('lastLogin', new Date().toLocaleString('id-ID'));
    });

    // Improved chart configuration
    const ctx = document.getElementById('salesChart').getContext('2d');
    const salesChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
            datasets: [{
                label: 'Penjualan',
                data: [12, 19, 3, 5, 2, 3, 7],
                borderColor: '#3B82F6',
                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                borderWidth: 2,
                tension: 0.4,
                fill: true,
                pointBackgroundColor: '#3B82F6',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointRadius: 4,
                pointHoverRadius: 6
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    mode: 'index',
                    intersect: false,
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    padding: 12,
                    titleFont: {
                        size: 14,
                        weight: 'bold'
                    },
                    bodyFont: {
                        size: 13
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        display: true,
                        color: 'rgba(0, 0, 0, 0.05)'
                    },
                    ticks: {
                        font: {
                            size: 12
                        }
                    }
                },
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        font: {
                            size: 12
                        }
                    }
                }
            },
            interaction: {
                intersect: false,
                mode: 'index'
            }
        }
    });

    // Improve card animations
    const cards = document.querySelectorAll('.bg-white');
    cards.forEach(card => {
        card.addEventListener('mouseenter', () => {
            card.style.transform = 'translateY(-5px)';
            card.style.transition = 'all 0.3s ease';
        });
        card.addEventListener('mouseleave', () => {
            card.style.transform = 'translateY(0)';
        });
    });
</script>
@endpush