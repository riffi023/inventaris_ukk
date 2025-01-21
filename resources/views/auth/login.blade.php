@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg rounded-lg" style="background-image: url('{{ asset('foto/inventaris.webp') }}'); background-size: cover; background-position: center;">
                <div class="card-header text-center bg-primary text-white">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter your email">

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
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Enter your password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary btn-block py-2">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
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
        background-color: rgba(255, 255, 255, 0.9); /* Semi-transparent white background */
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
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(78, 115, 223, 0.3);
    }

    .form-check-input {
        width: 18px;
        height: 18px;
        margin-top: 3px;
        position: relative;
        z-index: 1;
    }

    .form-check-label {
        font-size: 0.95rem;
        color: #333;
        margin-left: 5px;
        position: relative;
        z-index: 1;
    }

    .btn-link {
        color: #4e73df;
        text-decoration: none;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        position: relative;
        z-index: 1;
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
