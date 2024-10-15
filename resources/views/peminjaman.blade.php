@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Riwayat Peminjaman Buku</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Buku</th>
                <th>Tanggal Peminjaman</th>
                <th>Tanggal Pengembalian</th>
                <th>Status</th>
                <th>Denda (Rp)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($borrowings as $borrowing)
            <tr>
                <td>{{ $borrowing->book->title }}</td>
                <td>{{ $borrowing->borrowed_at }}</td>
                <td>{{ $borrowing->returned_at ?? '-' }}</td>
                <td>{{ $borrowing->status }}</td>
                <td>{{ $borrowing->fine ?? 0 }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
