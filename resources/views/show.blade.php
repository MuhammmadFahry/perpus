<!-- resources/views/books/show.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <img src="{{ asset($book->image) }}" alt="Book Cover" class="img-fluid">
        </div>
        <div class="col-md-8">
            <h2>{{ $book->title }}</h2>
            <p><strong>Pengarang:</strong> {{ $book->author }}</p>
            <p><strong>Tahun Terbit:</strong> {{ $book->publication_year }}</p>
            <p><strong>Kategori:</strong> {{ ucfirst($book->category) }}</p>
            <p><strong>Deskripsi:</strong> {{ $book->description }}</p>

            <a href="{{ route('books.index') }}" class="btn btn-primary">Kembali ke Daftar Buku</a>
        </div>
    </div>
</div>
@endsection
