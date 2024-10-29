@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
        </div>
        <div class="col-md-10">
            <div class="card mb-4">
                <div class="card-header">
                    <h4>Buku yang Sedang Dipinjam</h4>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Judul Buku</th>
                                <th>Peminjam</th>
                                <th>Tanggal Pinjam</th>
                                <th>Tanggal Kembali</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($historysemuanya as $history)
                                <tr>
                                    <td>{{ $history->book?->title ?? 'Data tidak tersedia' }}</td>
                                    <td>{{ $history->user?->name ?? 'Data tidak tersedia' }}</td>
                                    <td>{{ $history->tanggal_dipinjam ?? 'Data tidak tersedia' }}</td>
                                    <td>{{ $history->created_at?->format('d M Y') ?? 'Data tidak tersedia' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
