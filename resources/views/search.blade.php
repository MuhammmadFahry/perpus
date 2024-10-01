@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Pencarian Buku</h1>

    <!-- Search Bar -->
    <div class="row justify-content-center mb-5">
        <div class="col-md-8">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Cari judul buku, penulis, atau kategori...">
                <button class="btn btn-primary" type="button">Cari</button>
            </div>
        </div>
    </div>

    <!-- Search Results (Static Example) -->
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Example of search result card -->
            <div class="card shadow-sm mb-3">
                <div class="card-body">
                    <h5 class="card-title">Belajar Laravel</h5>
                    <h6 class="card-subtitle mb-2 text-muted">Penulis: John Doe</h6>
                    <p class="card-text">
                        Buku ini memberikan panduan lengkap tentang pengembangan aplikasi menggunakan Laravel.
                    </p>
                </div>
            </div>

            <div class="card shadow-sm mb-3">
                <div class="card-body">
                    <h5 class="card-title">Pemrograman PHP</h5>
                    <h6 class="card-subtitle mb-2 text-muted">Penulis: Jane Doe</h6>
                    <p class="card-text">
                        Buku ini membahas dasar-dasar pemrograman PHP untuk pemula hingga mahir.
                    </p>
                </div>
            </div>

            <!-- Add more results as needed -->
        </div>
    </div>
</div>
@endsection
