@extends('layouts.app')

@section('content')
    <style>
        .container {
            margin-top: 20px;
        }

        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
            font-size: 0.85em;
            border-collapse: collapse;
        }

        .table thead th {
            background-color: #343a40;
            color: #fff;
            text-align: center;
            padding: 8px;
            border: 1px solid #dee2e6;
        }

        .table tbody td {
            vertical-align: middle;
            text-align: center;
            padding: 8px;
            border: 1px solid #dee2e6;
        }

        .book-image {
            width: 60px;
            height: auto;
            border-radius: 5px;
            border: 1px solid #ced4da;
        }

        .btn-primary {
            background-color: #28a745;
            border-color: #28a745;
            padding: 4px 8px;
            border-radius: 3px;
            font-size: 0.8em;
            margin: 0;
        }

        .btn-primary:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }

        .alert {
            margin-bottom: 15px;
            padding: 8px 12px;
        }

        .table-responsive {
            margin-top: 10px;
        }

        .return-date {
            width: 130px;
            padding: 4px;
            border-radius: 4px;
            border: 1px solid #ced4da;
        }

        /* Responsif di layar kecil */
        @media (max-width: 768px) {
            .book-image {
                width: 50px;
            }

            .table {
                font-size: 0.75em;
            }

            .btn-primary {
                padding: 4px 6px;
                font-size: 0.75em;
            }
        }
    </style>

    <div class="container">
        <h4 class="text-center mb-4">Daftar Buku yang Tersedia untuk Dipinjam</h4>

        {{-- Pesan notifikasi jika ada --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        {{-- Cek apakah ada buku yang tersedia --}}
        @if (count($buku_yang_dipinjams) == 0)
            <div class="alert alert-info text-center">Tidak ada buku yang tersedia saat ini untuk dikembalikan.</div>
        @else
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Cover</th>
                            <th>Judul Buku</th>
                            <th>Penulis</th>
                            <th>Denda Buku</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($buku_yang_dipinjams as $buku_yang_dipinjam)
                            <form action="{{ route('tambah.historybook') }}" method="POST">
                                @csrf
                                <input hidden type="number" value="{{ $buku_yang_dipinjam->book->id }}" name="book_id">
                                <input hidden type="datetime" value="{{ $buku_yang_dipinjam->borrowed_at }}" name="tanggal_dipinjam" id="tanggal_dipinjam">
                                <tr>
                                    <td>
                                        <img src="/{{ $buku_yang_dipinjam->book->image }}" alt="{{ $buku_yang_dipinjam->book->title }} cover"
                                            class="book-image" />
                                    </td>
                                    <td>{{ $buku_yang_dipinjam->book->title }}</td>
                                    <td>{{ $buku_yang_dipinjam->book->author }}</td>
                                    <td>{{ $buku_yang_dipinjam->denda }}</td>
                                    <td>
                                        {{-- Tombol untuk mengembalikan buku --}}
                                        <button type="submit" class="btn btn-primary">Kembalikan</button>
                                    </td>
                                </tr>
                            </form>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
