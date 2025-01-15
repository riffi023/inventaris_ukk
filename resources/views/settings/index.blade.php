@extends('layouts.admin')

@section('styles')
<style>
    .settings-icon {
        font-size: 3rem;
        color: #4a90e2;
        margin-bottom: 1rem;
    }
    .form-control:focus {
        box-shadow: 0 0 0 0.2rem rgba(74, 144, 226, 0.25);
        border-color: #4a90e2;
    }
    .settings-card {
        transition: all 0.3s ease;
    }
    .settings-card:hover {
        transform: translateY(-5px);
    }
</style>
@endsection

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="text-center mb-4">
                <i class="fas fa-user-cog settings-icon"></i>
                <h2 class="fw-bold">{{ __('Pengaturan Akun') }}</h2>
                <p class="text-muted">Kelola informasi profil dan keamanan akun Anda</p>
            </div>

            <div class="card settings-card shadow-lg">
                <div class="card-header bg-primary text-white py-3">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-shield-alt me-2"></i>
                        <h4 class="mb-0">{{ __('Informasi Akun') }}</h4>
                    </div>
                </div>

                <div class="card-body p-4">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form method="POST" action="{{ Auth::user()->type == 'admin' ? route('admin.settings.update') : route('settings.update') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="name" class="form-label">
                                <i class="fas fa-user me-2"></i>{{ __('Nama') }}
                            </label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" 
                                   name="name" value="{{ old('name', Auth::user()->name) }}" required autocomplete="name">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="email" class="form-label">
                                <i class="fas fa-envelope me-2"></i>{{ __('Email') }}
                            </label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                                   name="email" value="{{ old('email', Auth::user()->email) }}" required autocomplete="email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <hr class="my-4">
                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-key me-2"></i>
                            <h5 class="mb-0">{{ __('Ubah Password') }}</h5>
                        </div>
                        <p class="text-muted small">
                            <i class="fas fa-info-circle me-1"></i>
                            {{ __('Kosongkan jika tidak ingin mengubah password') }}
                        </p>

                        <div class="mb-4">
                            <label for="current_password" class="form-label">
                                <i class="fas fa-lock me-2"></i>{{ __('Password Saat Ini') }}
                            </label>
                            <div class="input-group">
                                <input id="current_password" type="password" 
                                       class="form-control @error('current_password') is-invalid @enderror" 
                                       name="current_password">
                                <button class="btn btn-outline-secondary toggle-password" type="button">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            @error('current_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="new_password" class="form-label">
                                <i class="fas fa-key me-2"></i>{{ __('Password Baru') }}
                            </label>
                            <div class="input-group">
                                <input id="new_password" type="password" 
                                       class="form-control @error('new_password') is-invalid @enderror" 
                                       name="new_password">
                                <button class="btn btn-outline-secondary toggle-password" type="button">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            @error('new_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="new_password_confirmation" class="form-label">
                                <i class="fas fa-check-double me-2"></i>{{ __('Konfirmasi Password Baru') }}
                            </label>
                            <div class="input-group">
                                <input id="new_password_confirmation" type="password" class="form-control"
                                       name="new_password_confirmation">
                                <button class="btn btn-outline-secondary toggle-password" type="button">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-save me-2"></i>{{ __('Simpan Perubahan') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
document.querySelectorAll('.toggle-password').forEach(button => {
    button.addEventListener('click', function() {
        const input = this.closest('.input-group').querySelector('input');
        const icon = this.querySelector('i');
        
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    });
});

// Animate success alert
const alertSuccess = document.querySelector('.alert-success');
if (alertSuccess) {
    setTimeout(() => {
        alertSuccess.classList.add('fade');
        setTimeout(() => alertSuccess.remove(), 300);
    }, 3000);
}
</script>
@endsection
