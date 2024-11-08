@extends('layouts.app')

@section('content')
<style>
    .welcome-title {
        font-size: 2.5rem;
        color: #ffffff;
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

    .highlight {
        color: #0069d9;
        font-weight: bold;
    }
</style>

<div class="container">
    <h1 class="text-center my-5 font-weight-bold welcome-title">
        Selamat Datang di Garuda Perpustakaan, {{ auth()->user()->name }}!
    </h1>
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
                                Perpustakaan Garuda adalah pusat literasi yang berkomitmen memberikan akses ke berbagai sumber daya berkualitas tinggi, baik fisik maupun digital. Kami menyediakan koleksi buku yang <span class="highlight">beragam dan terbaru</span>, mencakup topik-topik dari literatur klasik hingga ilmu pengetahuan modern, untuk memenuhi kebutuhan pembaca dari berbagai kalangan.
                            </p>
                            <p class="card-text text-justify">
                                Selain menjadi tempat membaca, kami adalah pusat bagi komunitas pembaca dan pecinta literasi. Dengan fasilitas baca yang nyaman dan suasana yang tenang, Anda dapat menjelajahi dunia melalui halaman-halaman buku kami. Kami percaya bahwa setiap halaman adalah <span class="highlight">jendela menuju dunia baru</span>, yang dapat memperkaya pengetahuan, inspirasi, dan imajinasi Anda.
                            </p>
                            <p class="card-text text-justify">
                                Perpustakaan Garuda juga menawarkan berbagai <span class="highlight">program edukasi dan kegiatan literasi</span> yang bertujuan untuk menghubungkan para anggota komunitas. Diskusi buku, workshop penulisan, dan seminar literasi adalah sebagian kecil dari upaya kami untuk menjadikan perpustakaan sebagai pusat pembelajaran yang interaktif dan inklusif.
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
                    <p class="card-text mb-4">Telusuri ribuan koleksi buku yang tersedia, dari literatur klasik hingga publikasi terbaru.</p>
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
                    <p class="card-text mb-4">Bertemu dengan tim pustakawan kami, yang selalu siap membantu Anda menemukan informasi yang Anda butuhkan.</p>
                    <a href="{{ url('/team') }}" class="btn btn-custom">Team</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
