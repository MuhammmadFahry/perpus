@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <img src="{{ asset($book->image) }}" alt="Book Cover" class="img-fluid">
        </div>
        <div class="col-md-8">
            <h2>{{ $book->title }}</h2>
            <p><strong>Pengarang:</strong> {{ $book->author }}</p>
            <p><strong>Tahun Terbit:</strong> {{ $book->publication_year }}</p>
            <p><strong>Kategori:</strong> {{ $book->category->name }}</p>
            <p><strong>Deskripsi:</strong> {{ $book->description }}</p>

            <a href="{{ url('/library') }}" class="btn btn-primary">Kembali ke Daftar Buku</a>

            {{-- Tampilkan tombol "Pinjam" hanya jika pengguna bukan admin --}}
            @if(auth()->user() && auth()->user()->role !== 'admin')
            {{-- Form untuk meminjam buku --}}
            <form id="borrow-form" action="{{ route('books.borrow', $book->id) }}" method="POST">
                @csrf
                @php
                    $defaultReturnDate = \Carbon\Carbon::now()->addDays(7)->format('Y-m-d');
                @endphp
                <input type="hidden" name="return_date" value="{{ $defaultReturnDate }}" required>
                <button type="button" class="btn btn-primary" onclick="confirmBorrow('{{ $book->title }}', '{{ $book->author }}')">Pinjam</button>
            </form>
            @endif
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
