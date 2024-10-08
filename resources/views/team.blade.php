@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center my-4">Tim Perpustakaan Garuda</h1>
    <p class="text-center mb-5">Tim kami terdiri dari individu-individu yang berdedikasi untuk menyediakan layanan perpustakaan terbaik bagi para pengunjung. Berikut adalah anggota tim kami yang siap membantu Anda:</p>

    <div class="row justify-content-center">
        <!-- Anggota Tim 1 -->
        <div class="col-md-4 mb-4">
            <div class="text-center">
                <div class="team-image-wrapper">
                    <img src="https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NHx8bWFuJTIwd2l0aCUyMHN1aXR8ZW58MHx8MHx8fDA%3D" alt="Foto Tim 1" class="img-fluid mb-3 team-image">
                </div>
                <h5 class="font-weight-bold">John Smith</h5>
                <p class="text-muted">Kepala Perpustakaan</p>
                <p>John telah mengelola Perpustakaan Garuda selama 10 tahun dengan visi untuk meningkatkan minat baca di komunitas lokal. Ia bertanggung jawab atas pengembangan koleksi buku serta pelatihan staf perpustakaan.</p>
            </div>
        </div>

        <!-- Anggota Tim 2 -->
        <div class="col-md-4 mb-4">
            <div class="text-center">
                <div class="team-image-wrapper">
                    <img src="https://images.unsplash.com/photo-1584273143981-41c073dfe8f8?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Nnx8d29tYW4lMjB3aXRoJTIwc3VpdHxlbnwwfHwwfHx8MA%3D%3D" alt="Foto Tim 2" class="img-fluid mb-3 team-image">
                </div>
                <h5 class="font-weight-bold">Emily Johnson</h5>
                <p class="text-muted">Koordinator Kegiatan</p>
                <p>Emily bertanggung jawab atas perencanaan dan pelaksanaan berbagai acara di Perpustakaan Garuda. Ia bersemangat dalam menyelenggarakan lokakarya serta diskusi buku untuk semua kalangan.</p>
            </div>
        </div>

        <!-- Anggota Tim 3 -->
        <div class="col-md-4 mb-4">
            <div class="text-center">
                <div class="team-image-wrapper">
                    <img src="https://plus.unsplash.com/premium_photo-1661517142227-aa326744da45?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTN8fHdvbWFuJTIwd2l0aCUyMHN1aXR8ZW58MHx8MHx8fDA%3D" alt="Foto Tim 3" class="img-fluid mb-3 team-image">
                </div>
                <h5 class="font-weight-bold">Sarah Williams</h5>
                <p class="text-muted">Pustakawan Digital</p>
                <p>Sarah bertugas mengelola koleksi digital perpustakaan dan memberikan konsultasi teknologi bagi pengunjung yang membutuhkan bantuan dalam menggunakan e-book serta basis data online.</p>
            </div>
        </div>
    </div>
</div>

<!-- CSS for hover effect and responsiveness -->
<style>
    .team-image-wrapper {
        position: relative;
        overflow: hidden;
    }

    .team-image {
        width: 100%;
        height: auto;
        object-fit: cover;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .team-image:hover {
        transform: scale(1.05);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }
</style>
@endsection
