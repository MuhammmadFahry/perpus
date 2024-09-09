<!-- resources/views/home.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center my-4">Selamat Datang di Perpustakaan Garuda</h1>

    <div class="row">
        <!-- Penjelasan tentang perpustakaan -->
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body">
                    <h3 class="card-title">Tentang Perpustakaan Garuda</h3>
                    <p class="card-text">
                        Perpustakaan Garuda adalah pusat literasi yang menyediakan berbagai buku dan referensi untuk pengembangan pengetahuan Anda. Kami memiliki koleksi buku terbaru, buku favorit, dan akses ke berbagai sumber daya digital untuk mendukung pembelajaran dan penelitian.
                    </p>
                </div>
            </div>
        </div>

        <!-- Tombol Menu Perpustakaan -->
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-body text-center">
                    <h3 class="card-title">Jelajahi Koleksi Buku</h3>
                    <a href="{{ url('/library') }}" class="btn btn-primary">Library</a>
                </div>
            </div>
        </div>

        <!-- Tombol Tim Perpustakaan -->
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-body text-center">
                    <h3 class="card-title">Kenali Tim Perpustakaan</h3>
                    <a href="{{ url('/team') }}" class="btn btn-primary">Team</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
