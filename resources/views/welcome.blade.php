<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Inventaris') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Feather Icons -->
    <script src="https://unpkg.com/feather-icons"></script>

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Nunito', sans-serif;
            overflow: hidden;
        }
        .background-video {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -2;
        }
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(0,0,0,0.6), rgba(0,0,0,0.4));
            z-index: -1;
        }
        .glowing-border {
            transition: all 0.3s ease;
        }
        .glowing-border:hover {
            box-shadow: 0 0 20px rgba(81, 203, 238, 1);
            transform: scale(1.05);
        }
    </style>
</head>
<body class="bg-gray-900 text-white">
    <!-- Background Video (Optional) -->
    <video autoplay loop muted class="background-video">
        <source src="{{ asset('/video/video.mp4') }}" type="video/mp4">
    </video>

    <!-- Overlay -->
    <div class="overlay"></div>

    <div class="relative min-h-screen flex items-center justify-center px-4">
        <div class="text-center max-w-2xl">
            <div class="mb-12 animate-fade-in">
                <h1 class="text-6xl font-bold mb-4 text-transparent bg-clip-text bg-gradient-to-r from-blue-500 to-purple-600">
                    Inventaris Platform
                </h1>
                <p class="text-xl text-gray-300 mb-8 leading-relaxed">
                    Manage your inventory efficiently and seamlessly with our advanced tracking system.
                </p>
            </div>

            <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-4">
                @if (Route::has('login'))
                    @auth
                        @if(auth()->user()->type == 'admin')
                            <a href="{{ url('/admin/home') }}" 
                               class="glowing-border px-8 py-4 bg-blue-600 text-white rounded-full shadow-xl hover:bg-blue-700 transition transform flex items-center justify-center space-x-2">
                                <i data-feather="shield" class="mr-2"></i>
                                Admin Dashboard
                            </a>
                        @else
                            <a href="{{ url('/home') }}" 
                               class="glowing-border px-8 py-4 bg-green-600 text-white rounded-full shadow-xl hover:bg-green-700 transition transform flex items-center justify-center space-x-2">
                                <i data-feather="home" class="mr-2"></i>
                                User Dashboard
                            </a>
                        @endif
                    @else
                        <a href="{{ route('login') }}" 
                           class="glowing-border px-8 py-4 bg-indigo-600 text-white rounded-full shadow-xl hover:bg-indigo-700 transition transform flex items-center justify-center space-x-2">
                            <i data-feather="log-in" class="mr-2"></i>
                            Log in
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" 
                               class="glowing-border px-8 py-4 bg-purple-600 text-white rounded-full shadow-xl hover:bg-purple-700 transition transform flex items-center justify-center space-x-2">
                                <i data-feather="user-plus" class="mr-2"></i>
                                Register
                            </a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </div>

    <script>
        // Initialize Feather Icons
        feather.replace();
    </script>
</body>
</html>