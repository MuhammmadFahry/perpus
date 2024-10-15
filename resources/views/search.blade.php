@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Pencarian Buku</h1>

    <!-- Search Bar -->
    <div class="row justify-content-center mb-5">
        <div class="col-md-8">
            <form action="{{ route('search.submit') }}" method="GET">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Cari judul buku dan penulis...." name="query">
                    <button class="btn btn-primary" type="submit">Cari</button>
                </div>
            </form>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (Session::has('success'))
                @foreach (session('success') as $book)
                <br>
                <!-- Card for each book -->
                <div class="card shadow-sm mb-3">
                    <div class="row g-0">
                        <div class="col-md-3"> <!-- Ubah ukuran kolom untuk gambar -->
                            <img class="card-img-top" src="{{ asset($book->image) }}" alt="Book Cover" style="height: 200px; object-fit: contain; width: 100%; border-radius: 8px;"> <!-- Tinggi gambar dikurangi dan object-fit diubah -->
                        </div>
                        <div class="col-md-9">
                            <div class="card-body">
                                <h5 class="card-title">{{ $book->title }}</h5>
                                <a href="{{ route('books.show', $book->id ) }}"class="btn btn-primary">show details</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
@endsection
