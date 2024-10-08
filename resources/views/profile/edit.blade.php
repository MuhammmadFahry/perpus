@extends('layouts.app')

@section('content')
    <div class="edit-profile-container">
        @if(auth()->check())
            <div class="edit-profile-card shadow-lg rounded p-4">
                <div class="edit-profile-header text-center mb-4">
                    <h1 class="font-weight-bold text-primary">Edit Profil</h1>
                </div>

                <!-- Flash message for success -->
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <!-- Form for editing user profile -->
                <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group mb-3">
                        <label for="name" class="form-label">Nama Lengkap</label>
                        <input type="text" id="name" name="name" class="form-control" value="{{ old('name', auth()->user()->name) }}" required>
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" class="form-control" value="{{ old('email', auth()->user()->email) }}" required>
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Profile Picture Upload -->
                    <div class="form-group mb-3">
                        <label for="profile_picture" class="form-label">Foto Profil</label>
                        <input type="file" id="profile_picture" accept="image/png,image/jpeg,image/jpg,image/webp" name="profile_picture" class="form-control">
                        @if(auth()->user()->profile_picture)
                            <img src="{{ asset('img/' . auth()->user()->profile_picture) }}" alt="Profile Picture" class="mt-3" style="width: 150px; height: 150px; object-fit: cover;">
                        @endif
                        @error('profile_picture')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="password" class="form-label">Password Baru (opsional)</label>
                        <input type="password" id="password" name="password" class="form-control" placeholder="Kosongkan jika tidak ingin mengubah password">
                        @error('password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
                    </div>

                    <div class="d-flex justify-content-center mt-4">
                        <button type="submit" class="btn btn-success px-5 py-2 rounded-pill">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        @else
            <div class="guest-message text-center py-5">
                <h1 class="text-danger">Anda belum login</h1>
                <p class="lead mb-4">Silakan login untuk mengedit profil Anda.</p>
                <a href="{{ route('login') }}" class="btn btn-primary px-5 py-2 rounded-pill">Login</a>
            </div>
        @endif
    </div>
@endsection

@push('styles')
    <link href="{{ asset('css/edit-profile.css') }}" rel="stylesheet">
@endpush
