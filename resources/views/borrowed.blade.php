@extends('layouts.app')

@section('content')
    <div class="borrowed-books-container">
        <h1>Buku yang Dipinjam</h1>
        @if($borrowedBooks->isEmpty())
            <p>Anda belum meminjam buku apapun.</p>
        @else
            <div class="book-list">
                @foreach($borrowedBooks as $book)
                    <div class="book-card">
                        <h2>{{ $book->title }}</h2>
                        <p>Penulis: {{ $book->author }}</p>
                        <p>Tanggal Peminjaman: {{ $book->borrowed_at->format('d M Y') }}</p>
                        <p>Batas Pengembalian: {{ $book->return_by->format('d M Y') }}</p>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
