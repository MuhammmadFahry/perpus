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
            font-size: 0.9em;
        }

        .table thead th {
            background-color: #343a40;
            color: #fff;
            text-align: center;
            padding: 10px;
        }

        .table tbody td {
            vertical-align: middle;
            text-align: center;
            padding: 8px;
        }

        .book-image {
            width: 80px;
            height: auto;
            border-radius: 5px;
        }

        .btn-primary {
            background-color: #28a745;
            border-color: #28a745;
            padding: 6px 12px;
            border-radius: 4px;
            font-size: 0.85em;
        }

        .btn-primary:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }

        .alert {
            margin-bottom: 20px;
        }

        .table-responsive {
            margin-top: 20px;
        }

        .return-date {
            width: 150px;
            padding: 5px;
            border-radius: 5px;
            border: 1px solid #ced4da;
        }

        @media (max-width: 768px) {
            .book-image {
                width: 60px;
            }

            .table {
                font-size: 0.85em;
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
        @if ($books->isEmpty())
            <div class="alert alert-info text-center">Tidak ada buku yang tersedia saat ini untuk dipinjam.</div>
        @else
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Cover</th>
                            <th>Judul Buku</th>
                            <th>Penulis</th>
                            <th>Tanggal Pengembalian</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($books as $book)
                            <form id="borrow-form-{{ $book->id }}" action="{{ route('books.borrow', $book->id) }}"
                                method="POST">
                                <tr>
                                    <td>
                                        <img src="/{{ $book->image }}" alt="{{ $book->title }} cover"
                                            class="book-image" />
                                    </td>
                                    <td>{{ $book->title }}</td>
                                    <td>{{ $book->author }}</td>
                                    @php
                                    // Menggunakan Carbon untuk menghitung 7 hari ke depan tanpa 'use' statement
                                    $defaultReturnDate = \Carbon\Carbon::now()->addDays(7)->format('Y-m-d');
                                @endphp

                                <td>
                                    {{-- Input untuk tanggal pengembalian dengan default 7 hari ke depan --}}
                                    <input hidden type="date" name="return_date" class="return-date" value="{{ $defaultReturnDate }}" required>
                                    <input disabled type="date"class="return-date" value="{{ $defaultReturnDate }}">
                                </td>

                                    <td>
                                        {{-- Form untuk meminjam buku --}}
                                        @csrf
                                        <button type="submit" class="btn btn-primary">Pinjam</button>
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
