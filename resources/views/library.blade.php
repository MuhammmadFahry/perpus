@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center my-4">Koleksi Buku Perpustakaan Garuda</h1>

    <div class="row">
        <!-- Buku Favorit -->
        <div class="col-md-12 mb-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h3 class="card-title">Buku Favorit</h3>
                    <p class="card-text">Jelajahi buku-buku yang menjadi favorit di Perpustakaan Garuda.</p>
                    <ul>
                        <li>Buku 1</li>
                        <li>Buku 2</li>
                        <li>Buku 3</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Buku Terbaru -->
        <div class="col-md-12 mb-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h3 class="card-title">Buku Terbaru</h3>
                    <p class="card-text">Temukan koleksi buku terbaru di Perpustakaan Garuda.</p>
                    <ul>
                        <li>Buku 4</li>
                        <li>Buku 5</li>
                        <li>Buku 6</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Semua Buku -->
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h3 class="card-title">Semua Buku</h3>
                    <p class="card-text">Berikut adalah daftar semua buku yang tersedia di perpustakaan kami.</p>
                    <ul>
                        <li>Buku 7</li>
                        <li>Buku 8</li>
                        <li>Buku 9</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
