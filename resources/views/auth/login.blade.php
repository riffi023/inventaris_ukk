<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Inventory System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            font-family: 'Poppins', sans-serif;
            overflow: hidden;
        }

        .login-container {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
        }

        .login-container:hover {
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
            transform: translateY(-5px);
        }

        .login-header {
            background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
            padding: 2rem;
            text-align: center;
            color: white;
        }

        .login-header h1 {
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
            font-weight: 600;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        }

        .login-header p {
            font-size: 1.1rem;
            opacity: 0.9;
        }

        .login-form {
            padding: 2rem;
        }

        .form-floating {
            margin-bottom: 1.5rem;
        }

        .form-control {
            border-radius: 10px;
            border: 2px solid #e1e1e1;
            padding: 0.8rem;
            padding-left: 60px !important;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #4e73df;
            box-shadow: 0 0 10px rgba(78, 115, 223, 0.3);
        }

        .login-btn {
            width: 100%;
            padding: 12px;
            border-radius: 10px;
            background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
            border: none;
            color: white;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
        }

        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(78, 115, 223, 0.3);
        }

        .password-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #666;
        }

        .register-link {
            text-align: center;
            margin-top: 1.5rem;
        }

        .register-link a {
            color: #4e73df;
            text-decoration: none;
            font-weight: 500;
        }

        .register-link a:hover {
            text-decoration: underline;
        }

        .alert {
            border-radius: 10px;
            margin-bottom: 1.5rem;
        }

        /* Floating Icons */
        .floating-icon {
            position: absolute;
            color: rgba(255, 255, 255, 0.2);
            z-index: 0;
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }

        .icon-1 { top: 10%; left: 10%; font-size: 2rem; animation-delay: 0s; }
        .icon-2 { top: 20%; right: 15%; font-size: 3rem; animation-delay: 1s; }
        .icon-3 { bottom: 15%; left: 15%; font-size: 2.5rem; animation-delay: 2s; }
        .icon-4 { bottom: 20%; right: 10%; font-size: 2rem; animation-delay: 3s; }

        /* Input Icon */
        .input-icon {
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            z-index: 4;
            width: 48px;
            height: 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-right: 2px solid #dee2e6;
            color: #4e73df;
        }

        .form-floating label {
            padding-left: 60px;
        }
    </style>
</head>
<body>
    <!-- Floating Icons -->
    <i class="fas fa-box floating-icon icon-1"></i>
    <i class="fas fa-clipboard-list floating-icon icon-2"></i>
    <i class="fas fa-truck floating-icon icon-3"></i>
    <i class="fas fa-warehouse floating-icon icon-4"></i>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="login-container">
                    <div class="login-header">
                        <h1><i class="fas fa-boxes"></i> Inventory System</h1>
                        <p class="mb-0">Welcome back! Please login to your account</p>
                    </div>

                    <div class="login-form">
                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('login') }}" id="loginForm">
                            @csrf
                            <div class="form-floating mb-3 position-relative">
                                <span class="input-icon">
                                    <i class="fas fa-envelope"></i>
                                </span>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                    name="email" id="email" placeholder="name@example.com" 
                                    value="{{ old('email') }}" required>
                                <label for="email">Email address</label>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-floating mb-3 position-relative">
                                <span class="input-icon">
                                    <i class="fas fa-lock"></i>
                                </span>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                    name="password" id="password" placeholder="Password" required>
                                <label for="password">Password</label>
                                <i class="fas fa-eye password-toggle" id="togglePassword"></i>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                <label class="form-check-label" for="remember">Remember me</label>
                            </div>

                            <button type="submit" class="login-btn" id="loginBtn">
                                <i class="fas fa-sign-in-alt me-2"></i> Login
                            </button>

                            @if (Route::has('password.request'))
                                <div class="text-center mt-3">
                                    <a href="{{ route('password.request') }}" class="text-decoration-none">
                                        Forgot Password?
                                    </a>
                                </div>
                            @endif
                        </form>

                        <div class="register-link">
                            <p class="mb-0">Don't have an account? 
                                <a href="{{ route('register') }}" class="text-decoration-none">Register here</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            // Toggle password visibility
            $('#togglePassword').click(function() {
                const password = $('#password');
                const icon = $(this);
                
                if (password.attr('type') === 'password') {
                    password.attr('type', 'text');
                    icon.removeClass('fa-eye').addClass('fa-eye-slash');
                } else {
                    password.attr('type', 'password');
                    icon.removeClass('fa-eye-slash').addClass('fa-eye');
                }
            });

            // Form submission with loading state
            $('#loginForm').on('submit', function() {
                const btn = $('#loginBtn');
                btn.html('<span class="spinner-border spinner-border-sm me-2"></span>Logging in...')
                   .attr('disabled', true);
            });

            // Auto-hide alerts after 5 seconds
            setTimeout(function() {
                $('.alert').alert('close');
            }, 5000);
        });
    </script>
</body>
</html>