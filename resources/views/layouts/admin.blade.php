<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Inventaris Dashboard')</title>

    <!-- Core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Base Styles -->
    <style>
        :root {
            --primary: #4e73df;
            --secondary: #858796;
            --success: #1cc88a;
            --info: #36b9cc;
            --warning: #f6c23e;
            --danger: #e74a3b;
            --light: #f8f9fc;
            --dark: #5a5c69;
            --sidebar-dark: #4e73df;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: var(--light);
            font-family: 'Nunito', sans-serif;
        }

        /* Sidebar Styles */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
            width: 250px;
            background: linear-gradient(180deg, var(--sidebar-dark) 10%, #224abe 100%);
            color: white;
            z-index: 100;
            transition: all 0.3s;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            height: 100vh;
            overflow-y: auto;
        }

        .sidebar-brand {
            padding: 1.5rem 1rem;
            text-align: center;
            font-size: 1.25rem;
            font-weight: 700;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .nav-item {
            position: relative;
            margin: 0.25rem 1rem;
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            color: rgba(255, 255, 255, 0.8);
            border-radius: 0.35rem;
            transition: all 0.3s;
        }

        .nav-link:hover {
            color: white;
            background: rgba(255, 255, 255, 0.1);
            transform: translateX(5px);
        }

        .nav-link.active {
            color: white;
            background: rgba(255, 255, 255, 0.15);
        }

        .nav-link i {
            margin-right: 0.75rem;
            width: 1.25rem;
        }

        /* Content Area */
        .content {
            margin-left: 250px;
            padding: 1.5rem;
            transition: all 0.3s;
        }

        /* Cards */
        .card {
            border: none;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            border-radius: 0.35rem;
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 0.5rem 2rem rgba(58, 59, 69, 0.15);
        }

        .card-header {
            background-color: #f8f9fc;
            border-bottom: 1px solid #e3e6f0;
            padding: 1rem 1.25rem;
        }

        /* Utilities */
        .shadow {
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15) !important;
        }

        .rounded {
            border-radius: 0.35rem !important;
        }

        /* Restore original styles */
        .sidebar-nav {
            height: calc(100vh - 200px);
            overflow-y: auto;
            scrollbar-width: thin;
            padding: 1rem;
            margin-right: -8px;
            position: relative;
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            background: rgba(255, 255, 255, 0.05);
            transform: translateX(5px);
        }

        .nav-link.active {
            background: rgba(59, 130, 246, 0.15);
        }

        .user-avatar {
            width: 3rem;
            height: 3rem;
        }

        /* Additional fixes */
        .card {
            background-color: #fff !important;
            border: none !important;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15) !important;
        }

        .content-wrapper {
            margin-left: 16rem;
            padding: 2rem;
            min-height: 100vh;
            background: var(--light);
            padding: 1rem;
        }

        /* Form Improvements */
        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
        }

        /* Button Enhancements */
        .btn {
            font-weight: 600;
            padding: 0.5rem 1rem;
            border-radius: 0.35rem;
            transition: all 0.2s;
        }

        .btn-primary {
            background: var(--primary);
            border: none;
        }

        .btn-primary:hover {
            background: #2e59d9;
            transform: translateY(-1px);
        }

        /* Table Improvements */
        .table-responsive {
            border-radius: 0.35rem;
            overflow: hidden;
        }

        .table thead th {
            background: var(--primary);
            color: white;
            border: none;
        }

        /* Loading States */
        .loading {
            position: relative;
            pointer-events: none;
        }

        .loading:after {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            background: rgba(255, 255, 255, 0.7);
            z-index: 1;
        }
    </style>

    @yield('styles')
</head>

<body class="bg-gray-50">
    <div class="wrapper">
        <!-- Sidebar -->
        <nav class="sidebar">
            <div class="sidebar-brand">
                <i class="fas fa-box-open mr-2"></i>
                Inventaris
            </div>

            <!-- User Profile -->
            <div class="p-4 border-bottom border-light">
                <div class="d-flex align-items-center">
                    <div class="rounded-circle bg-white text-primary d-flex align-items-center justify-content-center"
                        style="width: 40px; height: 40px;">
                        <span class="font-weight-bold">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                    </div>
                    <div class="ml-3">
                        <h6 class="mb-0 text-white">{{ Auth::user()->name }}</h6>
                        <small class="text-white-50">{{ Auth::user()->email }}</small>
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <ul class="nav flex-column py-3">
                <li class="nav-item">
                    <a href="{{ route('admin.home') }}"
                        class="nav-link {{ request()->routeIs('admin.home') ? 'active' : '' }}">
                        <i class="fas fa-home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <!-- Master Data Barang Group -->
                <li class="nav-header pt-3 pb-2 px-3 text-white-50 text-uppercase small">
                    Master Data Barang
                </li>
                <li class="nav-item">
                    <a href="{{ route('master_barang.index') }}"
                        class="nav-link {{ request()->routeIs('master-barang.*') ? 'active' : '' }}">
                        <i class="fas fa-boxes"></i>
                        <span>Master Barang</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('kategori_asset.index') }}"
                        class="nav-link {{ request()->routeIs('kategori_asset.*') ? 'active' : '' }}">
                        <i class="fas fa-layer-group"></i>
                        <span>Kategori Asset</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('sub-kategori-asset.index') }}"
                        class="nav-link {{ request()->routeIs('sub-kategori-asset.*') ? 'active' : '' }}">
                        <i class="fas fa-code-branch"></i>
                        <span>Sub Kategori Asset</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('merk.index') }}"
                        class="nav-link {{ request()->routeIs('merk.*') ? 'active' : '' }}">
                        <i class="fas fa-trademark"></i>
                        <span>Merk</span>
                    </a>
                </li>

                <!-- Lokasi Group -->
                <li class="nav-header pt-3 pb-2 px-3 text-white-50 text-uppercase small">
                    Data Lokasi
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link {{ request()->routeIs('lokasi.*') ? 'active' : '' }}">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>Lokasi</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-exchange-alt"></i>
                        <span>Mutasi Lokasi</span>
                    </a>
                </li>

                <!-- Manajemen Barang -->
                <li class="nav-header pt-3 pb-2 px-3 text-white-50 text-uppercase small">
                    Manajemen Barang
                </li>
                <li class="nav-item">
                    <a href="{{ route('satuan.index') }}"
                        class="nav-link {{ request()->routeIs('satuan.*') ? 'active' : '' }}">
                        <i class="fas fa-balance-scale"></i>
                        <span>Satuan</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('pengadaan.index') }}"
                        class="nav-link {{ request()->routeIs('pengadaan.*') ? 'active' : '' }}">
                        <i class="fas fa-shopping-cart"></i>
                        <span>Pengadaan</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-clipboard-check"></i>
                        <span>Opname</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('distributor.index') }}"
                        class="nav-link {{ request()->routeIs('distributor.*') ? 'active' : '' }}">
                        <i class="fas fa-truck"></i>
                        <span>Distributor</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('depresiasi.index') }}"
                        class="nav-link {{ request()->routeIs('depresiasi.*') ? 'active' : '' }}">
                        <i class="fas fa-calculator"></i>
                        <span>Depresiasi</span>
                    </a>
                </li>

                <!-- Settings -->
                <li class="nav-header pt-3 pb-2 px-3 text-white-50 text-uppercase small">
                    Pengaturan
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.settings.index') }}" class="nav-link">
                        <i class="fas fa-cogs"></i>
                        <span>Settings</span>
                    </a>
                </li>
            </ul>

            <!-- Logout -->
            <div class="mt-auto p-3 border-top border-light">
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                    class="nav-link text-danger">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </nav>

        <!-- Content -->
        <div class="content-wrapper">
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function () {
            // Initialize tooltips
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            });

            // Active link handling
            $('.nav-link').each(function () {
                if (window.location.href.includes($(this).attr('href'))) {
                    $(this).addClass('active');
                }
            });

            // Form submit loading state
            $('form').on('submit', function () {
                $(this).addClass('loading');
                $(this).find('button[type="submit"]').prop('disabled', true);
            });

            // Table row hover effect
            $('.table tbody tr').hover(
                function () { $(this).addClass('bg-light'); },
                function () { $(this).removeClass('bg-light'); }
            );
        });
    </script>
    @stack('scripts')
</body>

</html>