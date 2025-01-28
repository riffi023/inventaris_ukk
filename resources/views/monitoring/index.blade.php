@extends('layouts.admin')

@section('styles')
<style>
    .monitoring-card {
        border-radius: 15px;
        border: none;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
    }

    .card-header {
        background: linear-gradient(135deg, var(--primary) 0%, #2a52be 100%);
        color: white;
        border-radius: 15px 15px 0 0 !important;
    }

    .active-session {
        background-color: #e8f5e9;
        border-left: 4px solid #4caf50;
        padding: 15px;
        margin-bottom: 10px;
        border-radius: 8px;
    }

    .history-card {
        border-radius: 15px;
        border: none;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
    }

    .history-item {
        padding: 10px;
        border-bottom: 1px solid #eaeaea;
    }
</style>
@endsection

@section('content')
<div class="card monitoring-card">
    <div class="card-header">
        <h5 class="mb-0">
            <i class="fas fa-user-clock me-2"></i>
            Sesi Aktif Anda
        </h5>
    </div>
    <div class="card-body">
        <div class="active-session">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="mb-1">{{ auth()->user()->name }}</h6>
                    <small class="text-muted">
                        <i class="fas fa-clock me-1"></i>
                        Login sejak: {{ now()->format('d/m/Y H:i') }}
                    </small>
                </div>
                <div>
                    <span class="badge bg-success">
                        <i class="fas fa-circle me-1"></i>
                        Online
                    </span>
                </div>
            </div>
            <div class="mt-3">
                <p class="mb-1">
                    <i class="fas fa-desktop me-2"></i>
                    {{ request()->userAgent() }}
                </p>
                <p class="mb-0">
                    <i class="fas fa-map-marker-alt me-2"></i>
                    IP Address: {{ request()->ip() }}
                </p>
            </div>
        </div>
    </div>
</div>
@endsection