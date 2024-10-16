@extends('layouts.app')

@section('content')
    <style>
        .borrowed-books-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            background-color: #151414; /* Background abu-abu terang */
        }

        h1 {
            text-align: center;
            font-size: 2.5em;
            margin-bottom: 20px;
            color: #fefefe; /* Warna teks abu-abu */
        }

        .book-list {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .book-card {
            background-color: #424242; /* Background abu-abu lebih gelap */
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            align-items: center;
            transition: transform 0.3s;
        }

        .book-card:hover {
            transform: scale(1.05);
        }

        .book-image {
            width: 100%;
            max-width: 150px;
            height: auto;
            margin-bottom: 15px;
        }

        .book-details {
            text-align: center;
            color: #ffffff; /* Warna teks abu-abu */
        }

        .book-details h2 {
            font-size: 1.5em;
            margin-bottom: 10px;
            color: #ffffff; /* Warna judul buku abu-abu */
        }

        .book-details p {
            font-size: 0.9em;
            margin: 5px 0;
            color: #ffffff; /* Warna deskripsi lebih terang */
        }

        @media (max-width: 768px) {
            .book-card {
                flex-direction: column;
            }
        }
    </style>

    <div class="borrowed-books-container">
        <h1>Buku yang Dipinjam</h1>
        @if (count($borrowedBooks) <= 0)
            <p>Anda belum meminjam buku apapun.</p>
        @else
            <div class="book-list">
                @foreach ($borrowedBooks as $book)
                    <div class="book-card">
                        <img src="/{{ $book->book->image }}" alt="{{ $book->book->title }} cover" class="book-image"/>
                        <div class="book-details">
                            <h2>{{ $book->book->title }}</h2>
                            <p><strong>Penulis:</strong> {{ $book->book->author }}</p>
                            <p><strong>Tanggal Peminjaman:</strong> {{ $book->borrowed_at->format('d M Y') }}</p>
                            @if ($book->returned_at != null)
                                <p><strong>Batas Pengembalian:</strong> {{ $book->returned_at->format('d M Y') }}</p>
                            @else
                                <p><strong>Batas Pengembalian:</strong> Belum ditentukan</p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
