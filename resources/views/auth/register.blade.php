<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Inventory System</title>
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
            padding: 2rem 0;
        }

        .register-container {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
        }

        .register-container:hover {
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
            transform: translateY(-5px);
        }

        .register-header {
            background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
            padding: 2rem;
            text-align: center;
            color: white;
        }

        .register-header h1 {
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
            font-weight: 600;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        }

        .register-header p {
            font-size: 1.1rem;
            opacity: 0.9;
        }

        .register-form {
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

        .register-btn {
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

        .register-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(78, 115, 223, 0.3);
        }

        .password-requirements {
            font-size: 0.8rem;
            color: #666;
            margin-top: 0.5rem;
        }

        .requirement {
            margin-bottom: 0.2rem;
        }

        .requirement i {
            margin-right: 0.5rem;
        }

        .valid-requirement {
            color: #28a745;
        }

        .invalid-requirement {
            color: #dc3545;
        }

        .progress {
            height: 6px;
            margin-top: 0.5rem;
            border-radius: 3px;
        }

        .steps {
            display: flex;
            justify-content: space-between;
            margin-bottom: 2rem;
        }

        .step {
            flex: 1;
            text-align: center;
            position: relative;
            padding: 1rem;
        }

        .step.active {
            color: #4e73df;
            font-weight: bold;
        }

        .step::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 2px;
            background: #e1e1e1;
            top: 50%;
            left: 50%;
            z-index: -1;
        }

        .step:last-child::after {
            display: none;
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
    <i class="fas fa-users floating-icon icon-1"></i>
    <i class="fas fa-shield-alt floating-icon icon-2"></i>
    <i class="fas fa-user-lock floating-icon icon-3"></i>
    <i class="fas fa-user-check floating-icon icon-4"></i>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="register-container">
                    <div class="register-header">
                        <h1><i class="fas fa-user-plus"></i> Create Account</h1>
                        <p>Join our inventory management system</p>
                    </div>

                    <div class="register-form">
                        <form method="POST" action="{{ route('register') }}" id="registerForm">
                            @csrf
                            <div class="form-floating mb-3 position-relative">
                                <span class="input-icon">
                                    <i class="fas fa-user"></i>
                                </span>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                    name="name" id="name" placeholder="Full Name" value="{{ old('name') }}" required>
                                <label for="name">Full Name</label>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-floating mb-3 position-relative">
                                <span class="input-icon">
                                    <i class="fas fa-envelope"></i>
                                </span>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                    name="email" id="email" placeholder="name@example.com" value="{{ old('email') }}" required>
                                <label for="email">Email Address</label>
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
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-floating mb-3 position-relative">
                                <span class="input-icon">
                                    <i class="fas fa-key"></i>
                                </span>
                                <input type="password" class="form-control" 
                                    name="password_confirmation" id="password_confirmation" 
                                    placeholder="Confirm Password" required>
                                <label for="password_confirmation">Confirm Password</label>
                            </div>

                            <button type="submit" class="register-btn">
                                <i class="fas fa-user-plus me-2"></i> Register
                            </button>

                            <div class="text-center mt-3">
                                <p class="mb-0">Already have an account? 
                                    <a href="{{ route('login') }}" class="text-decoration-none">Login here</a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            // Form submission with loading state
            $('#registerForm').on('submit', function() {
                const btn = $('.register-btn');
                btn.html('<span class="spinner-border spinner-border-sm me-2"></span>Registering...')
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