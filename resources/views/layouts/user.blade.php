<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'User Dashboard')</title>

    <!-- Core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        :root {
            --primary: #2c3e50;
            --secondary: #2a52be;
        }

        .sidebar {
            width: 260px;
            min-height: 100vh;
            background: var(--primary);
            position: fixed;
            transition: all 0.3s ease;
        }

        .sidebar-brand {
            padding: 1.5rem;
            color: white;
            font-size: 1.5rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            background: rgba(255, 255, 255, 0.1);
        }

        .sidebar-brand i {
            margin-right: 0.75rem;
            font-size: 1.25rem;
        }

        .nav-item {
            margin: 0.2rem 1rem;
        }

        .nav-link {
            color: #ecf0f1 !important;
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
        }

        .nav-link:hover {
            background: rgba(255, 255, 255, 0.1);
            transform: translateX(5px);
        }

        .nav-link.active {
            background: var(--secondary);
            color: white !important;
        }

        .nav-link i {
            width: 20px;
            margin-right: 0.75rem;
            font-size: 1.1rem;
        }

        .content-wrapper {
            margin-left: 260px;
            padding: 2rem;
        }

        /* User Profile Section */
        .sidebar .user-profile {
            padding: 1.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .user-profile .profile-icon {
            width: 45px;
            height: 45px;
            background: var(--secondary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: white;
            margin-right: 1rem;
        }

        .user-info h6 {
            margin: 0;
            color: white;
            font-size: 1rem;
        }

        .user-info small {
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.85rem;
        }

        /* Responsive Sidebar */
        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-260px);
                z-index: 1040;
            }
            
            .sidebar.active {
                transform: translateX(0);
            }
            
            .content-wrapper {
                margin-left: 0;
            }
            
            .sidebar-toggle {
                display: block !important;
            }
        }

        .sidebar-toggle {
            display: none;
            position: fixed;
            top: 1rem;
            left: 1rem;
            z-index: 1050;
            padding: 0.5rem;
            border-radius: 0.5rem;
            background: var(--primary);
            color: white;
            border: none;
        }
    </style>

    @yield('styles')
</head>

<body class="bg-gray-50">
    <!-- Sidebar Toggle Button -->
    <button class="sidebar-toggle" id="sidebarToggle">
        <i class="fas fa-bars"></i>
    </button>

    <div class="wrapper">
        <!-- Sidebar -->
        <nav class="sidebar">
            <div class="sidebar-brand">
                <i class="fas fa-box-open"></i>
                <span>Inventaris</span>
            </div>

            <!-- User Profile -->
            <div class="user-profile">
                <div class="d-flex align-items-center">
                    <div class="profile-icon">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <div class="user-info">
                        <h6>{{ Auth::user()->name }}</h6>
                        <small>{{ Auth::user()->email }}</small>
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <ul class="nav flex-column py-3">
                <li class="nav-item">
                    <a href="{{ route('user.home') }}"
                        class="nav-link {{ request()->routeIs('user.dashboard') ? 'active' : '' }}">
                        <i class="fas fa-home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('user.hitung_depresiasi.index') }}"
                        class="nav-link {{ request()->routeIs('user.hitung_depresiasi.*') ? 'active' : '' }}">
                        <i class="fas fa-calculator"></i>
                        <span>Data Hitung Depresiasi</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('user.pengadaan.index') }}"
                        class="nav-link {{ request()->routeIs('user.pengadaan.*') ? 'active' : '' }}">
                        <i class="fas fa-boxes"></i>
                        <span>Data Pengadaan</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('user.opname.index') }}"
                        class="nav-link {{ request()->routeIs('user.opname.*') ? 'active' : '' }}">
                        <i class="fas fa-clipboard-check"></i>
                        <span>Data Opname</span>
                    </a>
                </li>
            </ul>

            <!-- Logout -->
            <div class="mt-auto p-3" style="border-top: 1px solid rgba(255, 255, 255, 0.1);">
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
                @yield('user-content')
            </div>
        </div>
    </div>

    <!-- Core Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Initialize DataTables default settings -->
    <script>
        $.extend(true, $.fn.dataTable.defaults, {
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/id.json'
            },
            pageLength: 10,
            processing: true,
            stateSave: true,
        });

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

            // Sidebar Toggle
            $('#sidebarToggle').click(function() {
                $('.sidebar').toggleClass('active');
            });

            // Close sidebar when clicking outside on mobile
            $(document).click(function(e) {
                if ($(window).width() < 992) {
                    if (!$(e.target).closest('.sidebar').length && !$(e.target).closest('#sidebarToggle').length) {
                        $('.sidebar').removeClass('active');
                    }
                }
            });

            // Handle window resize
            $(window).resize(function() {
                if ($(window).width() > 992) {
                    $('.sidebar').removeClass('active');
                }
            });
        });
    </script>
    @stack('scripts')
</body>

</html>