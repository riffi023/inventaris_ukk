@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg rounded-lg">
                <div class="card-header text-center bg-primary text-white">{{ __('Register') }}</div>

                <div class="card-body" style="background-image: url('{{ asset('foto/inventaris.webp') }}'); background-size: cover; background-position: center;">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Enter your name">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Enter your email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Create a password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm your password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary btn-block py-2">
                                    {{ __('Register') }}
                                </button>
                                <a href="{{ route('login') }}" class="btn btn-link">
                                    {{ __('Already have an account?') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('styles')
<style>
    .card {
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        background-color: rgba(255, 255, 255, 0.9);
    }

    .card-header {
        font-size: 1.5rem;
        font-weight: bold;
        background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
        padding: 20px;
        border-radius: 15px 15px 0 0;
    }

    .card-body {
        padding: 30px;
        position: relative;
    }

    .card-body::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(255, 255, 255, 0.8);
        z-index: 0;
        border-radius: 0 0 15px 15px;
    }

    .form-control {
        border-radius: 10px;
        border: 1px solid #ddd;
        padding: 12px 15px;
        background-color: rgba(255, 255, 255, 0.9);
        position: relative;
        z-index: 1;
    }

    .form-control:focus {
        border-color: #4e73df;
        box-shadow: 0 0 10px rgba(78, 115, 223, 0.3);
    }

    .btn-primary {
        background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
        border: none;
        color: #fff;
        font-size: 1.1rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        padding: 12px 30px;
        border-radius: 10px;
        transition: all 0.3s ease;
        position: relative;
        z-index: 1;
        width: auto;
        min-width: 200px;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(78, 115, 223, 0.3);
    }

    .btn-link {
        color: #4e73df;
        text-decoration: none;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        position: relative;
        z-index: 1;
        margin-left: 15px;
    }

    .btn-link:hover {
        color: #224abe;
        text-decoration: none;
        transform: translateX(5px);
    }

    .col-form-label {
        color: #333;
        font-weight: 500;
        position: relative;
        z-index: 1;
    }

    /* Animasi loading */
    .btn-primary.loading {
        position: relative;
        pointer-events: none;
    }

    .btn-primary.loading:after {
        content: '';
        position: absolute;
        width: 20px;
        height: 20px;
        top: 50%;
        left: 50%;
        margin: -10px 0 0 -10px;
        border: 2px solid #fff;
        border-radius: 50%;
        border-top-color: transparent;
        animation: spin 0.8s linear infinite;
    }

    @keyframes spin {
        to {
            transform: rotate(360deg);
        }
    }

    /* Efek hover pada card */
    .card:hover {
        transform: translateY(-5px);
        transition: all 0.3s ease;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .card {
            margin: 15px;
        }
        
        .btn-primary {
            width: 100%;
            margin-bottom: 10px;
        }
        
        .btn-link {
            display: block;
            text-align: center;
            margin-left: 0;
        }
    }
</style>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Animasi loading saat submit
        $('form').on('submit', function() {
            $(this).find('button[type="submit"]').addClass('loading');
        });

        // Efek ripple pada button
        $('.btn-primary').on('click', function(e) {
            let x = e.pageX - $(this).offset().left;
            let y = e.pageY - $(this).offset().top;

            let ripples = document.createElement('span');
            ripples.style.left = x + 'px';
            ripples.style.top = y + 'px';
            this.appendChild(ripples);

            setTimeout(() => {
                ripples.remove();
            }, 1000);
        });
    });
</script>
@endpush
