@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center my-4">Koleksi Buku Perpustakaan Garuda</h1>

    <div class="row">
        <!-- Buku Favorit -->
        <div class="col-md-12 mb-4">
            <div class="card shadow-lg border-0">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">Buku Favorit</h3>
                        @if(Auth::user() && Auth::user()->isAdmin)
                            <a href="#" class="btn btn-outline-primary btn-sm">Edit</a>
                        @endif
                    </div>
                    <p class="card-text">Jelajahi buku-buku yang menjadi favorit di Perpustakaan Garuda.</p>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Buku 1</li>
                        <li class="list-group-item">Buku 2</li>
                        <li class="list-group-item">Buku 3</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Buku Terbaru -->
        <div class="col-md-12 mb-4">
            <div class="card shadow-lg border-0">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">Buku Terbaru</h3>
                        @if(Auth::user() && Auth::user()->isAdmin)
                            <a href="#" class="btn btn-outline-primary btn-sm">Edit</a>
                        @endif
                    </div>
                    <p class="card-text">Temukan koleksi buku terbaru di Perpustakaan Garuda.</p>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Buku 4</li>
                        <li class="list-group-item">Buku 5</li>
                        <li class="list-group-item">Buku 6</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Semua Buku -->
        <div class="col-md-12">
            <div class="card shadow-lg border-0">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">Semua Buku</h3>
                        @if(Auth::user() && Auth::user()->isAdmin)
                            <a href="#" class="btn btn-outline-primary btn-sm">Edit</a>
                        @endif
                    </div>
                    <p class="card-text">Berikut adalah daftar semua buku yang tersedia di perpustakaan kami.</p>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Buku 7</li>
                        <li class="list-group-item">Buku 8</li>
                        <li class="list-group-item">Buku 9</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- CSS for better appearance -->
<style>
    .card {
        border-radius: 10px;
    }

    .card-title {
        font-weight: 700;
        font-size: 1.5rem;
    }

    .card-body p {
        font-size: 1rem;
    }

    .btn-outline-primary {
        border-radius: 20px;
        font-weight: 600;
    }

    .list-group-item {
        background-color: #36383a;
        font-size: 1rem;
        padding: 10px 20px;
    }

    .btn-outline-primary {
    border-radius: 20px;
    font-weight: 600;
    color: #007bff;
    border-color: #007bff;
    transition: background-color 0.3s ease, color 0.3s ease;
}

.btn-outline-primary:hover {
    background-color: #007bff;
    color: white;
    border-color: #0056b3;
}

</style>
@endsection
