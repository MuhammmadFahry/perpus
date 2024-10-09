@extends('layouts.app')

@section('content')
    <div class="profile-container">
        @if(auth()->check())
            <div class="profile-card shadow-lg rounded p-4">
                <div class="profile-header text-center mb-4">
                    <h1 class="font-weight-bold text-primary">Profil Anggota</h1>
                </div>
                <div class="profile-body d-flex flex-column align-items-center">
                    <div class="profile-avatar mb-3">
                        <img src="{{ auth()->user()->profile_picture ? asset('img/' . auth()->user()->profile_picture) : asset('img/default-profile.png') }}"
     alt="Profile Avatar" class="rounded-circle" style="width: 150px; height: 150px; object-fit: cover;">
                    </div>
                    <div class="profile-info text-center">
                        <h2 class="mb-3">Selamat datang, <strong>{{ auth()->user()->name }}</strong></h2>
                        <p class="text-muted">Email: {{ auth()->user()->email }}</p>
                        <p class="text-muted">Bergabung Sejak: {{ auth()->user()->created_at->format('d M Y') }}</p>
                    </div>

                    <!-- Tombol untuk user biasa (bukan admin) -->
                    @if(!auth()->user()->isAdmin)
                        <div class="profile-actions mt-4 d-flex flex-column flex-md-row justify-content-center">
                            <a href="{{ route('books.borrowed') }}" class="btn btn-success mx-2 mb-3 mb-md-0 px-4 py-2 rounded-pill">Buku yang Dipinjam</a>
                            <a href="{{ route('books.history') }}" class="btn btn-secondary mx-2 mb-3 mb-md-0 px-4 py-2 rounded-pill">Riwayat Peminjaman</a>
                        </div>
                    @endif

                    <!-- Tombol untuk semua pengguna (termasuk admin) -->
                    <div class="profile-actions mt-4 d-flex flex-column flex-md-row justify-content-center">
                        <a href="{{ route('profile.edit') }}" class="btn btn-primary mx-2 px-4 py-2 rounded-pill">Edit Profil</a>
                    </div>
                </div>
            </div>
        @else
            <div class="guest-message text-center py-5">
                <h1 class="text-danger">Anda belum login</h1>
                <p class="lead mb-4">Silakan login untuk melihat profil Anda.</p>
                <a href="{{ route('login') }}" class="btn btn-primary px-5 py-2 rounded-pill">Login</a>
            </div>
        @endif
    </div>
@endsection

@push('styles')
    <link href="{{ asset('css/profile.css') }}" rel="stylesheet">
@endpush
