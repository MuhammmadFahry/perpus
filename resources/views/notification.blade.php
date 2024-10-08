@extends('layouts.app')

@section('content')
<div class="container-fluid py-5">
    <h1 class="text-center mb-5 font-weight-bold">Pemberitahuan</h1>
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            @if(Auth::user()->is_admin)
                <div class="admin-notifications mb-5">
                    <h2 class="mb-4 text-primary font-weight-bold">Pemberitahuan Admin</h2>
                    <div class="notification-list">
                        @forelse($adminNotifications as $notification)
                            <div class="card shadow-sm mb-4 border-left-primary animate__animated animate__fadeIn">
                                <div class="card-body">
                                    <h5 class="card-title font-weight-bold text-primary">{{ $notification->title }}</h5>
                                    <p class="card-text">{{ $notification->message }}</p>
                                    <small class="text-muted">
                                        <i class="fas fa-clock mr-1"></i>
                                        Diterima pada {{ $notification->received_at->format('d M Y, H:i') }}
                                    </small>
                                </div>
                            </div>
                        @empty
                            <div class="alert alert-info" role="alert">
                                <i class="fas fa-info-circle mr-2"></i>Tidak ada pemberitahuan untuk Admin.
                            </div>
                        @endforelse
                    </div>
                </div>
            @endif

            <div class="user-notifications">
                <h2 class="mb-4 text-info font-weight-bold">
                    {{ Auth::user()->is_admin ? 'Pemberitahuan Pengguna' : 'Pemberitahuan Anda' }}
                </h2>
                <div class="notification-list">
                    @forelse($userNotifications as $notification)
                        <div class="card shadow-sm mb-4 border-left-info animate__animated animate__fadeIn">
                            <div class="card-body">
                                <h5 class="card-title font-weight-bold text-info">{{ $notification->title }}</h5>
                                <p class="card-text">{{ $notification->message }}</p>
                                <small class="text-muted">
                                    <i class="fas fa-clock mr-1"></i>
                                    Diterima pada {{ $notification->received_at->format('d M Y, H:i') }}
                                </small>
                            </div>
                        </div>
                    @empty
                        <div class="alert alert-info" role="alert">
                            <i class="fas fa-info-circle mr-2"></i>Tidak ada pemberitahuan untuk Anda.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
<style>
    .card {
        border-radius: 15px;
        transition: transform 0.3s ease-in-out;
    }
    .card:hover {
        transform: translateY(-5px);
    }
    .border-left-primary {
        border-left: 5px solid #4e73df;
    }
    .border-left-info {
        border-left: 5px solid #36b9cc;
    }
    .card-title {
        font-size: 1.1rem;
    }
    .notification-list {
        max-height: 600px;
        overflow-y: auto;
        padding-right: 10px;
    }
    .notification-list::-webkit-scrollbar {
        width: 5px;
    }
    .notification-list::-webkit-scrollbar-thumb {
        background-color: rgba(0,0,0,.2);
        border-radius: 10px;
    }
    @media (max-width: 768px) {
        .container-fluid {
            padding-left: 15px;
            padding-right: 15px;
        }
    }
</style>
@endpush

@push('scripts')
<script src="https://kit.fontawesome.com/your-fontawesome-kit.js" crossorigin="anonymous"></script>
<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        const cards = document.querySelectorAll('.card');
        cards.forEach((card, index) => {
            card.style.animationDelay = `${index * 0.1}s`;
        });
    });
</script>
@endpush
@endsection
