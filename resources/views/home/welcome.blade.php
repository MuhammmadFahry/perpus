@extends('layouts.app')

@section('content')
<style>
    .welcome-title {
        font-size: 2.5rem;
        color: #333;
    }

    .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border-radius: 10px;
    }

    .card:hover {
        transform: translateY(-10px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
    }

    .card-img-top,
    .card-img {
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
        object-fit: cover;
        height: 300px;
    }

    .card-body {
        padding: 2rem;
    }

    .btn-custom {
        background-color: #0069d9;
        border: none;
        color: white;
        font-size: 1.2rem;
        padding: 0.8rem 2rem;
        border-radius: 30px;
        transition: background-color 0.3s ease;
    }

    .btn-custom:hover {
        background-color: #004aad;
        color: #fff;
    }

    .container {
        max-width: 1100px;
    }
</style>

<div class="container">
    <h1 class="text-center my-5 font-weight-bold welcome-title">Selamat Datang di Perpustakaan Garuda</h1>

    <div class="row">
        <!-- Penjelasan tentang perpustakaan -->
        <div class="col-md-12">
            <div class="card mb-5 shadow-sm border-0">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <!-- Gambar perpustakaan -->
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTBHbK6Sl5zXxEZJa_g7vBuxhU3aQJ1NnV2rQ&s" class="card-img h-100" alt="Perpustakaan Garuda">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h3 class="card-title text-center font-weight-bold">Tentang Perpustakaan Garuda</h3>
                            <p class="card-text text-justify my-4">
                                Perpustakaan Garuda adalah pusat literasi yang menyediakan berbagai buku dan referensi untuk pengembangan pengetahuan Anda. Kami berkomitmen menjadi sumber daya utama dalam menunjang pembelajaran, penelitian, dan eksplorasi ilmu pengetahuan. Selain koleksi buku terbaru dan buku favorit, perpustakaan kami juga memberikan akses ke sumber daya digital dan fasilitas baca yang nyaman.
                            </p>
                            <p class="card-text text-justify">
                                Perpustakaan Garuda juga menjadi rumah bagi komunitas pecinta literasi di mana para anggota bisa berbagi pengetahuan, berdiskusi, dan memperluas wawasan. Kami percaya bahwa akses informasi yang luas adalah kunci untuk membuka masa depan yang lebih baik.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tombol Menu Perpustakaan (Hanya untuk Admin) -->
        @if (auth()->user()->isAdmin)
        <div class="col-md-6">
            <div class="card mb-4 shadow-sm border-0">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT4V0dA51AFAXPGnsuZPjeJc19_fnO-ciWHxQ&s" class="card-img-top" alt="Koleksi Buku">
                <div class="card-body text-center">
                    <h3 class="card-title font-weight-bold">Jelajahi Koleksi Buku</h3>
                    <p class="card-text mb-4">Temukan berbagai macam buku terbaru dan buku favorit yang tersedia untuk Anda di perpustakaan kami.</p>
                    <a href="{{ url('/library') }}" class="btn btn-custom">Library</a>
                </div>
            </div>
        </div>
        @endif

        <!-- Tombol Tim Perpustakaan (untuk semua pengguna) -->
        <div class="@if(auth()->user()->isAdmin) col-md-6 @else col-md-12 @endif">
            <div class="card mb-4 shadow-sm border-0">
                <img src="https://storage.googleapis.com/ekrutassets/blogs/images/000/004/582/original/H1_1._15_Keahlian_teamwork_yang_harus_dikuasai_dalam_dunia_kerja_saat_ini.jpg" class="card-img-top" alt="Tim Perpustakaan">
                <div class="card-body text-center">
                    <h3 class="card-title font-weight-bold">Kenali Tim Perpustakaan</h3>
                    <p class="card-text mb-4">Berkenalan dengan para pustakawan profesional yang siap membantu Anda menemukan informasi yang Anda butuhkan.</p>
                    <a href="{{ url('/team') }}" class="btn btn-custom">Team</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
