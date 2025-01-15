<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventaris Dashboard</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <!-- Add these new CSS libraries -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

    <style>
        :root {
            --primary-color: #3B82F6;
            --secondary-color: #10B981;
            --bg-light: #F3F4F6;
            --text-dark: #1F2937;
        }

        /* Update welcome banner style */
        .welcome-banner {
            background-color: var(--primary-color);
            color: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        body {
            background-color: var(--bg-light);
            font-family: 'Arial', sans-serif;
        }

        .sidebar {
            background: linear-gradient(180deg, rgba(17, 24, 39, 0.98) 0%, rgba(17, 24, 39, 0.95) 100%);
            backdrop-filter: blur(10px);
            color: white;
            border-right: 1px solid #E5E7EB;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            width: 260px;
            padding-top: 20px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        .sidebar-logo {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 30px;
        }

        .sidebar-logo img {
            max-width: 50px;
            margin-right: 10px;
        }

        .sidebar-logo h2 {
            color: var(--primary-color);
            font-weight: bold;
        }

        .nav-pills .nav-link {
            color: var(--text-dark);
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
        }

        .nav-pills .nav-link i {
            margin-right: 10px;
        }

        .nav-pills .nav-link:hover,
        .nav-pills .nav-link.active {
            background-color: var(--primary-color);
            color: white;
        }

        .main-content {
            margin-left: 260px;
            padding: 20px;
        }

        .product-card {
            transition: all 0.3s ease;
            border: none;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        .product-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        .product-card .card-img-top {
            height: 220px;
            object-fit: cover;
        }

        .badge-category {
            position: absolute;
            top: 10px;
            right: 10px;
        }

        /* Add animation classes */
        .animate-fadeIn {
            animation: fadeIn 0.5s ease;
        }

        .animate-slideIn {
            animation: slideIn 0.5s ease;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Add toast container -->
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

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-logo">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="width: 30px; height: 30px;">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
            </svg>
            <h2 class="ms-2" style="font-size: 1.2rem;">Inventaris</h2>
        </div>

        <div class="text-center mb-4">
            <img src="https://via.placeholder.com/100" class="rounded-circle mb-3" alt="User Profile">
            <h5>{{ Auth::user()->name }}</h5>
            <p class="text-muted">{{ Auth::user()->email }}</p>
        </div>

        <ul class="nav nav-pills flex-column px-3">
            <li class="nav-item mb-2">
                <a class="nav-link active" href="#">
                    <i class="fas fa-home"></i> Dashboard
                </a>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link" href="#">
                    <i class="fas fa-shopping-cart"></i> Produk
                </a>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link" href="#">
                    <i class="fas fa-user"></i> Profil
                </a>
            </li>
            <li class="nav-item mb-2">
                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="nav-link text-danger w-100 text-start">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="container-fluid">
            <!-- Welcome Banner -->
            <div class="welcome-banner">
                <h3>Selamat Datang, {{ Auth::user()->name }}!</h3>
                <p class="mb-0">
                    @php
                        $waktu = date('H');
                        $sambutan = '';
                        
                        if ($waktu >= 0 && $waktu < 11) {
                            $sambutan = 'Selamat Pagi';
                        } elseif ($waktu >= 11 && $waktu < 15) {
                            $sambutan = 'Selamat Siang';
                        } elseif ($waktu >= 15 && $waktu < 18) {
                            $sambutan = 'Selamat Sore';
                        } else {
                            $sambutan = 'Selamat Malam';
                        }
                    @endphp
                    {{ $sambutan }}! Semoga hari Anda menyenangkan dan produktif.
                </p>
            </div>

            <h1 class="mb-4">Daftar Produk</h1>
            <div class="row">
                <!-- Produk 1 -->
                <div class="col-md-4 mb-4">
                    <div class="card product-card position-relative">
                        <span class="badge bg-primary badge-category">Elektronik</span>
                        <img src="https://via.placeholder.com/350x220" class="card-img-top" alt="Laptop Asus">
                        <div class="card-body">
                            <h5 class="card-title">Laptop Asus</h5>
                            <p class="card-text text-muted">Laptop gaming berkualitas dengan spesifikasi tinggi</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="h5 text-success mb-0">Rp 15.000.000</span>
                                <button class="btn btn-primary">
                                    <i class="fas fa-shopping-cart me-2"></i>Beli
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Produk 2 -->
                <div class="col-md-4 mb-4">
                    <div class="card product-card position-relative">
                        <span class="badge bg-primary badge-category">Elektronik</span>
                        <img src="https://via.placeholder.com/350x220" class="card-img-top" alt="Smartphone Samsung">
                        <div class="card-body">
                            <h5 class="card-title">Smartphone Samsung</h5>
                            <p class="card-text text-muted">Smartphone canggih dengan kamera resolusi tinggi</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="h5 text-success mb-0">Rp 8.000.000</span>
                                <button class="btn btn-primary">
                                    <i class="fas fa-shopping-cart me-2"></i>Beli
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Produk 3 -->
                <div class="col-md-4 mb-4">
                    <div class="card product-card position-relative">
                        <span class="badge bg-primary badge-category">Elektronik</span>
                        <img src="https://via.placeholder.com/350x220" class="card-img-top" alt="Printer Canon">
                        <div class="card-body">
                            <h5 class="card-title">Printer Canon</h5>
                            <p class="card-text text-muted">Printer berkualitas untuk kebutuhan kantor</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="h5 text-success mb-0">Rp 1.500.000</span>
                                <button class="btn btn-primary">
                                    <i class="fas fa-shopping-cart me-2"></i>Beli
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Optional: Sweet Alert for Welcome Message -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true
        });

        document.addEventListener('DOMContentLoaded', function() {
            const hour = new Date().getHours();
            const userName = "{{ Auth::user()->name }}";
            let greeting;

            if (hour < 12) greeting = "Selamat Pagi";
            else if (hour < 15) greeting = "Selamat Siang";
            else if (hour < 18) greeting = "Selamat Sore";
            else greeting = "Selamat Malam";

            // Show welcome toast
            setTimeout(() => {
                Toastify({
                    text: `${greeting}, ${userName}!\nSelamat datang di Dashboard User`,
                    duration: 5000,
                    gravity: "top",
                    position: "right",
                    backgroundColor: "#3B82F6",
                    stopOnFocus: true,
                    onClick: function(){},
                    className: "rounded-lg shadow-lg",
                    style: {
                        background: "linear-gradient(to right, #3B82F6, #2563EB)",
                        padding: "1rem",
                        fontSize: "0.875rem",
                        lineHeight: "1.5"
                    }
                }).showToast();
            }, 1000);

            // Show last login toast
            const lastLogin = localStorage.getItem('lastLogin');
            if (lastLogin) {
                setTimeout(() => {
                    Toastify({
                        text: `Login terakhir: ${lastLogin}`,
                        duration: 4000,
                        gravity: "top",
                        position: "right",
                        backgroundColor: "#10B981",
                        stopOnFocus: true,
                        className: "rounded-lg shadow-lg",
                        style: {
                            background: "linear-gradient(to right, #10B981, #059669)",
                            padding: "1rem",
                            fontSize: "0.875rem"
                        }
                    }).showToast();
                }, 6000);
            }
            localStorage.setItem('lastLogin', new Date().toLocaleString('id-ID'));
        });

        // Add card animations
        const cards = document.querySelectorAll('.product-card');
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
</body>
</html>