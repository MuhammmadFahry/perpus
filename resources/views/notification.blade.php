@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Pemberitahuan</h1>

    <!-- Notification Card -->
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Example of notification card -->
            <div class="card shadow-sm mb-3">
                <div class="card-body">
                    <h5 class="card-title">Pemberitahuan 1</h5>
                    <p class="card-text">
                        Buku yang Anda pinjam berjudul "Belajar Laravel" akan jatuh tempo pengembaliannya besok.
                        Pastikan untuk segera mengembalikan buku tersebut atau perpanjang waktu peminjaman.
                    </p>
                    <small class="text-muted">Diterima pada 24 September 2024, 14:35</small>
                </div>
            </div>

            <div class="card shadow-sm mb-3">
                <div class="card-body">
                    <h5 class="card-title">Pemberitahuan 2</h5>
                    <p class="card-text">
                        Koleksi buku baru telah tersedia! Jelajahi koleksi terbaru kami di halaman perpustakaan.
                    </p>
                    <small class="text-muted">Diterima pada 23 September 2024, 10:15</small>
                </div>
            </div>

            <!-- Add more notifications here -->
        </div>
    </div>
</div>
@endsection
