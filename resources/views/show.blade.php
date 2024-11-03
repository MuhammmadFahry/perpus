@extends('layouts.app')

@section('content')
    <style>
        .container {
            margin-top: 30px;
            font-family: 'Arial', sans-serif;
        }

        .row {
            display: flex;
            gap: 20px;
        }

        .col-md-4 img {
            width: 100%;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            font-weight: bold;
            color: #ffffff;
            margin-bottom: 20px;
        }

        .book-details p {
            font-size: 1.1em;
            color: #ffffff;
            margin-bottom: 10px;
        }

        .btn {
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 1em;
            transition: background-color 0.3s, transform 0.2s;
            cursor: pointer;
        }

        .btn-primary {
            background-color: #007bff;
            color: #ffffff;
            border: none;
            margin-right: 10px;
        }

        .btn-primary:hover {
            background-color: #0069d9;
            transform: translateY(-2px);
        }

        .btn-borrow {
            background-color: #28a745;
            color: #ffffff;
            border: none;
        }

        .btn-borrow:hover {
            background-color: #218838;
            transform: translateY(-2px);
        }

        .btn-back {
            background-color: #343a40;
            color: #ffffff;
        }

        .btn-back:hover {
            background-color: #23272b;
        }
    </style>

    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <img src="{{ asset($book->image) }}" alt="Book Cover" class="img-fluid">
            </div>
            <div class="col-md-8">
                <h2>{{ $book->title }}</h2>
                <div class="book-details">
                    <p><strong>Pengarang:</strong> {{ $book->author }}</p>
                    <p><strong>Tahun Terbit:</strong> {{ $book->publication_year }}</p>
                    <p><strong>Kategori:</strong> {{ $book->category->name }}</p>
                    <p><strong>Deskripsi:</strong> {{ $book->description }}</p>
                </div>

                <div class="button-group">
                    <a href="{{ url('/library') }}" class="btn btn-back">Kembali ke Daftar Buku</a>

                    {{-- Tampilkan tombol "Pinjam" hanya jika pengguna bukan admin --}}
                    @if(auth()->user() && auth()->user()->role !== 'admin')
                    {{-- Form untuk meminjam buku --}}
                    <form id="borrow-form" action="{{ route('books.borrow', $book->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @php
                            $defaultReturnDate = \Carbon\Carbon::now()->addDays(-7)->format('Y-m-d');
                        @endphp
                        <input type="hidden" name="return_date" value="{{ $defaultReturnDate }}" required>
                        <button type="button" class="btn btn-borrow" onclick="confirmBorrow('{{ $book->title }}', '{{ $book->author }}')">Pinjam</button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function confirmBorrow(bookTitle, bookAuthor) {
                var returnDate = new Date();
                returnDate.setDate(returnDate.getDate() + 7);
                var returnDateString = returnDate.toISOString().split('T')[0];

                Swal.fire({
                    title: 'Konfirmasi Peminjaman',
                    text: `Anda akan meminjam "${bookTitle}" oleh ${bookAuthor}.\nTanggal Pengembalian: ${returnDateString}`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#28a745',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, pinjam!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('borrow-form').submit();
                    }
                });
            }

            // Menampilkan SweetAlert jika peminjaman berhasil
            @if (Session::has('success'))
            Swal.fire({
                title: 'Sukses!',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'OK'
            });
            @endif

            // Menampilkan SweetAlert jika ada error
            @if (Session::has('error'))
            Swal.fire({
                title: 'Error',
                text: '{{ session('error') }}',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            @endif
        </script>
    @endpush

@endsection
