@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
<div id="welcomeToast" class="welcome-toast hidden">
    <div class="bg-white rounded-lg shadow-xl p-4 max-w-sm w-full">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <svg class="h-8 w-8 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
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
    <!-- Total Master Barang -->
    <div class="bg-white p-6 rounded-xl shadow-md transition-all duration-300 hover:shadow-lg hover:-translate-y-1 hover:bg-gray-50">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-semibold">Master Barang</h3>
            <i class="fas fa-boxes text-blue-500"></i>
        </div>
        <div class="text-3xl font-bold text-blue-600">{{ $totalMasterBarang }}</div>
        <div class="text-sm text-gray-500 mt-2">Total jenis barang</div>
    </div>

    <!-- Total Pengadaan -->
    <div class="bg-white p-6 rounded-xl shadow-md transition-all duration-300 hover:shadow-lg hover:-translate-y-1 hover:bg-gray-50">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-semibold">Pengadaan</h3>
            <i class="fas fa-shopping-cart text-green-500"></i>
        </div>
        <div class="text-3xl font-bold text-green-600">{{ $totalPengadaan }}</div>
        <div class="text-sm text-gray-500 mt-2">Total pengadaan barang</div>
    </div>

    <!-- Total Depresiasi -->
    <div class="bg-white p-6 rounded-xl shadow-md transition-all duration-300 hover:shadow-lg hover:-translate-y-1 hover:bg-gray-50">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-semibold">Depresiasi</h3>
            <i class="fas fa-chart-line text-yellow-500"></i>
        </div>
        <div class="text-3xl font-bold text-yellow-600">{{ $totalDepresiasi }}</div>
        <div class="text-sm text-gray-500 mt-2">Total perhitungan depresiasi</div>
    </div>

    <!-- Total Users -->
    <div class="bg-white p-6 rounded-xl shadow-md transition-all duration-300 hover:shadow-lg hover:-translate-y-1 hover:bg-gray-50">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-semibold">Users</h3>
            <i class="fas fa-users text-purple-500"></i>
        </div>
        <div class="text-3xl font-bold text-purple-600">{{ $totalUsers }}</div>
        <div class="text-sm text-gray-500 mt-2">Total pengguna sistem</div>
    </div>

    <!-- Total Kategori -->
    <div class="bg-white p-6 rounded-xl shadow-md transition-all duration-300 hover:shadow-lg hover:-translate-y-1 hover:bg-gray-50">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-semibold">Kategori Asset</h3>
            <i class="fas fa-tags text-indigo-500"></i>
        </div>
        <div class="text-3xl font-bold text-indigo-600">{{ $totalKategori }}</div>
        <div class="text-sm text-gray-500 mt-2">Total kategori asset</div>
    </div>

    <!-- Total Lokasi -->
    <div class="bg-white p-6 rounded-xl shadow-md transition-all duration-300 hover:shadow-lg hover:-translate-y-1 hover:bg-gray-50">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-semibold">Lokasi</h3>
            <i class="fas fa-map-marker-alt text-red-500"></i>
        </div>
        <div class="text-3xl font-bold text-red-600">{{ $totalLokasi }}</div>
        <div class="text-sm text-gray-500 mt-2">Total lokasi asset</div>
    </div>

    <!-- Total Distributor -->
    <div class="bg-white p-6 rounded-xl shadow-md transition-all duration-300 hover:shadow-lg hover:-translate-y-1 hover:bg-gray-50">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-semibold">Distributor</h3>
            <i class="fas fa-truck text-orange-500"></i>
        </div>
        <div class="text-3xl font-bold text-orange-600">{{ $totalDistributor }}</div>
        <div class="text-sm text-gray-500 mt-2">Total distributor</div>
    </div>

    <!-- Total Merk -->
    <div class="bg-white p-6 rounded-xl shadow-md transition-all duration-300 hover:shadow-lg hover:-translate-y-1 hover:bg-gray-50">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-semibold">Merk</h3>
            <i class="fas fa-copyright text-teal-500"></i>
        </div>
        <div class="text-3xl font-bold text-teal-600">{{ $totalMerk }}</div>
        <div class="text-sm text-gray-500 mt-2">Total merk barang</div>
    </div>

    <!-- Pengadaan Bulan Ini -->
    <div class="bg-white p-6 rounded-xl shadow-md transition-all duration-300 hover:shadow-lg hover:-translate-y-1 hover:bg-gray-50">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-semibold">Pengadaan Baru</h3>
            <i class="fas fa-calendar-plus text-emerald-500"></i>
        </div>
        <div class="text-3xl font-bold text-emerald-600">{{ $pengadaanBulanIni }}</div>
        <div class="text-sm text-gray-500 mt-2">Pengadaan bulan ini</div>
    </div>

    <!-- Depresiasi Bulan Ini -->
    <div class="bg-white p-6 rounded-xl shadow-md transition-all duration-300 hover:shadow-lg hover:-translate-y-1 hover:bg-gray-50">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-semibold">Depresiasi Baru</h3>
            <i class="fas fa-calendar-minus text-rose-500"></i>
        </div>
        <div class="text-3xl font-bold text-rose-600">{{ $depresiasBulanIni }}</div>
        <div class="text-sm text-gray-500 mt-2">Depresiasi bulan ini</div>
    </div>
</div>

<!-- Recent Data Tables -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Recent Pengadaan -->
    <div class="bg-white rounded-xl shadow-md transition-all duration-300 hover:shadow-lg">
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-xl font-semibold">Pengadaan Terbaru</h3>
        </div>
        <div class="p-6">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-4 py-2 text-left">Barang</th>
                            <th class="px-4 py-2 text-left">Tanggal</th>
                            <th class="px-4 py-2 text-left">Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentPengadaan as $pengadaan)
                            <tr class="border-b transition-colors duration-200 hover:bg-gray-50">
                                <td class="px-4 py-2">{{ $pengadaan->masterBarang->nama_barang }}</td>
                                <td class="px-4 py-2">{{ $pengadaan->created_at->format('d/m/Y') }}</td>
                                <td class="px-4 py-2">Rp {{ number_format($pengadaan->harga_barang, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Recent Depresiasi -->
    <div class="bg-white rounded-xl shadow-md transition-all duration-300 hover:shadow-lg">
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-xl font-semibold">Depresiasi Terbaru</h3>
        </div>
        <div class="p-6">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-4 py-2 text-left">Barang</th>
                            <th class="px-4 py-2 text-left">Nilai Awal</th>
                            <th class="px-4 py-2 text-left">Depresiasi/Bulan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentDepresiasi as $depresiasi)
                            <tr class="border-b transition-colors duration-200 hover:bg-gray-50">
                                <td class="px-4 py-2">{{ $depresiasi->pengadaan->masterBarang->nama_barang }}</td>
                                <td class="px-4 py-2">Rp {{ number_format($depresiasi->nilai_barang, 0, ',', '.') }}</td>
                                <td class="px-4 py-2">Rp {{ number_format($depresiasi->depresiasi_barang, 0, ',', '.') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
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
            from {
                transform: translateX(100%);
            }

            to {
                transform: translateX(0);
            }
        }

        /* Add new animation styles */
        .hover-trigger .hover-target {
            transition: all 0.3s ease;
        }
        
        .hover-trigger:hover .hover-target {
            transform: scale(1.05);
        }

        .table-row-hover {
            transition: all 0.2s ease;
        }

        .table-row-hover:hover {
            background-color: rgba(59, 130, 246, 0.05);
            transform: translateX(5px);
        }

        .stat-card {
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        .stat-card:hover .stat-icon {
            transform: scale(1.1) rotate(5deg);
        }
        
        .stat-icon {
            transition: all 0.3s ease;
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
        document.addEventListener('DOMContentLoaded', function () {
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

        // Add new animation initializations
        document.addEventListener('DOMContentLoaded', function() {
            // Add hover effects to statistic cards
            const statCards = document.querySelectorAll('.bg-white');
            statCards.forEach(card => {
                card.classList.add('stat-card');
                const icon = card.querySelector('i');
                if (icon) icon.classList.add('stat-icon');
            });

            // Add hover effects to table rows
            const tableRows = document.querySelectorAll('tbody tr');
            tableRows.forEach(row => {
                row.classList.add('table-row-hover');
            });

            // Add hover effects to action buttons
            const actionButtons = document.querySelectorAll('button, .btn');
            actionButtons.forEach(button => {
                button.classList.add('transition-all', 'duration-200', 'transform', 'hover:scale-105');
            });
        });

        // Add smooth scroll behavior
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>
@endpush