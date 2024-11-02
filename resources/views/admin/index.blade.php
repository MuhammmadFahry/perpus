@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center my-5 font-weight-bold">Selamat Datang di Perpustakaan Garuda</h1>

    <div class="row">
        <!-- Penjelasan tentang perpustakaan -->
        <div class="col-md-12">
            <div class="card mb-5 shadow-sm border-0">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <!-- Gambar perpustakaan -->
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTBHbK6Sl5zXxEZJa_g7vBuxhU3aQJ1NnV2rQ&s" class="card-img h-100" alt="Perpustakaan Garuda" style="object-fit: cover;">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body p-4">
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

        <!-- Tombol Menu Perpustakaan (Hanya untuk Non-User) -->
        @if (auth()->user()->isAdmin)
        <div class="col-md-6">
            <div class="card mb-4 shadow-sm border-0">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT4V0dA51AFAXPGnsuZPjeJc19_fnO-ciWHxQ&s" class="card-img-top" alt="Koleksi Buku" style="height: 300px; object-fit: cover;">
                <div class="card-body text-center">
                    <h3 class="card-title font-weight-bold">Jelajahi Koleksi Buku</h3>
                    <p class="card-text mb-4">Temukan berbagai macam buku terbaru dan buku favorit yang tersedia untuk Anda di perpustakaan kami.</p>
                    <a href="{{ url('/library') }}" class="btn btn-primary btn-lg rounded-pill px-5">Library</a>
                </div>
            </div>
        </div>
        @endif

        <!-- Tombol Tim Perpustakaan (untuk semua pengguna) -->
        <div class="@cannot('isUser') col-md-6 @else col-md-12 @endcannot">
            <div class="card mb-4 shadow-sm border-0">
                <img src="https://storage.googleapis.com/ekrutassets/blogs/images/000/004/582/original/H1_1._15_Keahlian_teamwork_yang_harus_dikuasai_dalam_dunia_kerja_saat_ini.jpg" class="card-img-top" alt="Tim Perpustakaan" style="height: 300px; object-fit: cover;">
                <div class="card-body text-center">
                    <h3 class="card-title font-weight-bold">Kenali Tim Perpustakaan</h3>
                    <p class="card-text mb-4">Berkenalan dengan para pustakawan profesional yang siap membantu Anda menemukan informasi yang Anda butuhkan.</p>
                    <a href="{{ url('/team') }}" class="btn btn-primary btn-lg rounded-pill px-5">Team</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
