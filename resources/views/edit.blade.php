@extends('layouts.app')

@section('content')
    <div class="edit-profile-container">
        <h1>Edit Profil</h1>

        <form action="{{ route('profile.update') }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Nama</label>
                <input type="text" id="name" name="name" value="{{ auth()->user()->name }}" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ auth()->user()->email }}" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="address">Alamat</label>
                <textarea id="address" name="address" class="form-control">{{ auth()->user()->address }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
    </div>

    @push('styles')
        <link href="{{ asset('css/edit_profile.css') }}" rel="stylesheet">
    @endpush
@endsection
