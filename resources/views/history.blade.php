@extends('layouts.app')

@section('content')
    <style>
        .history-container {
            margin: 20px;
            padding: 20px;
        }

        .history-list {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .history-card {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 15px;
            background-color: #f9f9f9;
        }

        .history-card h2 {
            font-size: 1.2em;
            margin-bottom: 10px;
        }

        .history-card p {
            margin: 5px 0;
        }
    </style>

    <div class="history-container">
        <h1>Riwayat Peminjaman</h1>
        @if($historyBooks->isEmpty())
            <p>Anda belum memiliki riwayat peminjaman.</p>
        @else
            <div class="history-list">
                @foreach($historyBooks as $book)
                    <div class="history-card">
                        <h2>{{ $book->title }}</h2>
                        <p>Penulis: {{ $book->author }}</p>
                        <p>Tanggal Peminjaman: {{ $book->pivot->borrowed_at->format('d M Y') }}</p>
                        <p>Tanggal Pengembalian:
                            @if($book->pivot->returned_at)
                                {{ $book->pivot->returned_at->format('d M Y') }}
                            @else
                                <em>Belum dikembalikan</em>
                            @endif
                        </p>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
