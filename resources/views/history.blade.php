@extends('layouts.app')

@section('content')
    <style>
        .history-container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 20px;
        }

        .history-container h1 {
            text-align: center;
            font-size: 2.5em;
            color: #ffffff;
            margin-bottom: 40px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
        }

        .history-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 30px;
        }

        .history-card {
            border: none;
            border-radius: 15px;
            padding: 20px;
            background-color: #2a2a2a;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s, box-shadow 0.3s;
            overflow: hidden;
        }

        .history-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3);
        }

        .history-card img.book-image {
            width: 100%;
            height: 250px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 20px;
            transition: transform 0.3s;
        }

        .history-card:hover img.book-image {
            transform: scale(1.05);
        }

        .history-card h2 {
            font-size: 1.8em;
            margin-bottom: 15px;
            color: #ffffff;
            line-height: 1.3;
        }

        .history-card p {
            margin: 10px 0;
            color: #cccccc;
            font-size: 1.1em;
        }

        .no-history {
            text-align: center;
            font-size: 1.4em;
            color: #ffffff;
            background-color: #2a2a2a;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        @media (max-width: 768px) {
            .history-container h1 {
                font-size: 2em;
            }
            .history-list {
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            }
        }
    </style>

    <div class="history-container">
        <h1>Riwayat Pengembalian</h1>
        @if (count($historyBooks) <= 0)
            <p class="no-history">Anda belum memiliki riwayat peminjaman. Mulailah petualangan membaca Anda hari ini!</p>
        @else
            <div class="history-list">
                @foreach ($historyBooks as $historyBook)
                    <div class="history-card">
                        <img src="/{{ $historyBook->book->image }}" alt="{{ $historyBook->book->title }} cover" class="book-image"/>
                        <h2>{{ $historyBook->book->title }}</h2>
                        <p><strong>Penulis:</strong> {{ $historyBook->book->author }}</p>
                        <p><strong>Tanggal Pengembalian:</strong> {{ $historyBook->created_at->format('d M Y') }}</p>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
