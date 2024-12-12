@extends('layouts.app')

@section('content')
    <style>
        .container {
            margin-top: 30px;
            font-family: 'Arial', sans-serif;
            color: #e0e0e0;
            max-width: 800px;
            padding: 20px;
            border-radius: 8px;
            background-color: #000000; /* Background hitam sesuai default */
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
        }

        .row {
            display: flex;
            gap: 20px;
            align-items: flex-start;
            flex-wrap: wrap;
        }

        .col-md-4 img {
            width: 100%;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }

        h2 {
            font-weight: bold;
            color: #f8f9fa;
            margin-bottom: 20px;
        }

        .book-details {
            max-width: 350px;
            color: #b0b0b0;
        }

        .book-details p {
            font-size: 1em;
            margin-bottom: 8px;
        }

        .btn {
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 1em;
            font-weight: bold;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .btn-primary, .btn-borrow, .btn-back {
            color: #ffffff;
            border: none;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .btn-primary {
            background-color: #007bff;
            margin-right: 10px;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            transform: translateY(-3px);
        }

        .btn-borrow {
            background-color: #28a745;
        }

        .btn-borrow:hover {
            background-color: #218838;
            transform: translateY(-3px);
        }

        .btn-back {
            background-color: #343a40;
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
            <div class="book-details">
                <h2>{{ $book->title }}</h2>
                <p><strong>Pengarang:</strong> {{ $book->author }}</p>
                <p><strong>Tahun Terbit:</strong> {{ $book->publication_year }}</p>
                <p><strong>Kategori:</strong> {{ $book->category->name }}</p>
                <p><strong>Deskripsi:</strong> {{ $book->description }}</p>

                <div class="button-group mt-4">
                    <a href="{{ url('/library') }}" class="btn btn-back">Kembali ke Daftar Buku</a>

                    @if(auth()->user() && auth()->user()->role !== 'admin')
                    <form id="borrow-form" action="{{ route('books.borrow', $book->id) }}" method="POST" style="display: inline;">
                        @csrf
                        <input type="hidden" name="return_date" value="{{ \Carbon\Carbon::now()->addDays(7)->format('Y-m-d') }}" required>
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

            @if (Session::has('success'))
            Swal.fire({
                title: 'Sukses!',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'OK'
            });
            @endif

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
