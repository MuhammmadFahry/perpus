@extends('layouts.app')

@section('content')
    <style>
        .container {
            margin-top: 30px;
            font-family: 'Arial', sans-serif;
        }

        h4 {
            font-weight: bold;
            color: #ffffff;
            margin-bottom: 30px
        }

        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
            font-size: 0.9em;
            border-collapse: collapse;
        }

        .table thead {
            background-color: #343a40;
            color: #ffffff;
        }

        .table thead th {
            text-align: center;
            padding: 15px;
        }

        .table tbody td {
            vertical-align: middle;
            text-align: center;
            padding: 12px;
            border: 1px solid #dee2e6;
        }

        .table tbody tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        .book-image {
            width: 80px;
            height: auto;
            border-radius: 5px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .btn {
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 0.9em;
            transition: background-color 0.3s, transform 0.2s;
            border: none;
            cursor: pointer;
        }

        .btn-primary {
            background-color: #28a745;
            color: #ffffff;
        }

        .btn-primary:hover {
            background-color: #218838;
            transform: translateY(-2px);
        }

        .btn-payment {
            background-color: #ff5722;
            color: #ffffff;
        }

        .btn-payment:hover {
            background-color: #e64a19;
            transform: translateY(-2px);
        }

        .alert {
            margin-bottom: 20px;
            padding: 10px 15px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .table {
                font-size: 0.8em;
            }

            .book-image {
                width: 60px;
            }

            .btn {
                font-size: 0.8em;
                padding: 6px 12px;
            }
        }
    </style>

    <div class="container">
        <h4>Daftar Buku yang Sedang Dipinjam</h4>

        {{-- Tabel Buku yang Dipinjam --}}
        @if ($buku_yang_dipinjams->isEmpty())
            <div class="alert alert-info text-center">Tidak ada buku yang sedang dipinjam saat ini.</div>
        @else
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Cover</th>
                            <th>Judul Buku</th>
                            <th>Penulis</th>
                            <th>Tanggal Peminjaman</th>
                            <th>Batas Pengembalian</th>
                            <th>Denda Buku</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($buku_yang_dipinjams as $buku_yang_dipinjam)
                            <tr>
                                <td>
                                    <img src="/{{ $buku_yang_dipinjam->book->image }}" alt="{{ $buku_yang_dipinjam->book->title }} cover" class="book-image" />
                                </td>
                                <td>{{ $buku_yang_dipinjam->book->title }}</td>
                                <td>{{ $buku_yang_dipinjam->book->author }}</td>
                                <td>{{ $buku_yang_dipinjam->borrowed_at->format('d M Y') }}</td>
                                <td>
                                    @if ($buku_yang_dipinjam->returned_at)
                                        <strong>{{ $buku_yang_dipinjam->returned_at->format('d M Y') }}</strong>
                                    @else
                                        <span>Belum ditentukan</span>
                                    @endif
                                </td>
                                <td>{{ $buku_yang_dipinjam->denda > 0 ? 'Rp ' . number_format($buku_yang_dipinjam->denda, 0, ',', '.') : 'Tidak Ada Denda' }}</td>
                                <td>
                                    <form action="{{ $buku_yang_dipinjam->denda > 0 ? route('payment', $buku_yang_dipinjam->id) : route('tambah.historybook') }}" method="{{ $buku_yang_dipinjam->denda > 0 ? 'GET' : 'POST' }}">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $buku_yang_dipinjam->id }}">
                                        <input type="hidden" name="book_id" value="{{ $buku_yang_dipinjam->book->id }}">
                                        <input type="hidden" name="tanggal_dipinjam" value="{{ $buku_yang_dipinjam->borrowed_at }}">
                                        <button type="{{ $buku_yang_dipinjam->denda > 0 ? 'button' : 'submit' }}" class="btn {{ $buku_yang_dipinjam->denda > 0 ? 'btn-payment' : 'btn-primary' }}"
                                            data-denda="{{ $buku_yang_dipinjam->denda }}">
                                            {{ $buku_yang_dipinjam->denda > 0 ? 'Bayar Denda' : 'Kembalikan Buku' }}
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    {{-- Modal untuk konfirmasi pembayaran menggunakan SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.querySelectorAll('.btn-payment').forEach(function(button) {
            button.addEventListener('click', function() {
                let form = this.closest('form');
                let denda = this.dataset.denda; // Ambil data denda dari atribut data

                Swal.fire({
                    title: 'Konfirmasi Pembayaran',
                    text: `Apakah Anda yakin ingin melanjutkan pembayaran denda sebesar Rp ${denda} ?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, lanjutkan',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@endsection

@push('scripts')
    <script>
        @if (Session::has('success'))
        Swal.fire({
            title: 'Success',
            text: '{{ session('success') }}',
            icon: 'success',
            confirmButtonText: 'Nice'
        });
        @endif
    </script>
@endpush
