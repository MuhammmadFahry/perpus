@extends('layouts.app')

@section('content')
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
                        <p>Tanggal Peminjaman: {{ $book->borrowed_at->format('d M Y') }}</p>
                        <p>Tanggal Pengembalian: {{ $book->returned_at->format('d M Y') }}</p>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    @push('styles')
        <link href="{{ asset('css/history_books.css') }}" rel="stylesheet">
    @endpush
@endsection
