@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="mb-4 text-primary">Peminjaman Buku - Perpustakaan Garuda</h1>

    <div class="row">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Form Peminjaman Buku</h5>
                </div>
                <div class="card-body">
                    <form>
                        <div class="mb-3">
                            <label for="book_title" class="form-label">Judul Buku</label>
                            <select class="form-select" id="book_title" required>
                                <option value="">Pilih Buku</option>
                                <option value="1">Laskar Pelangi</option>
                                <option value="2">Bumi Manusia</option>
                                <option value="3">Pulang</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="borrow_date" class="form-label">Tanggal Peminjaman</label>
                            <input type="date" class="form-control" id="borrow_date" required>
                        </div>
                        <div class="mb-3">
                            <label for="return_date" class="form-label">Tanggal Pengembalian</label>
                            <input type="date" class="form-control" id="return_date" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Pinjam Buku</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0">Informasi Peminjaman</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Maksimal peminjaman: 3 buku</li>
                        <li class="list-group-item">Durasi peminjaman: 14 hari</li>
                        <li class="list-group-item">Denda keterlambatan: Rp 5.000/hari</li>
                    </ul>
                    <p class="mt-3 mb-0 text-muted">Untuk informasi lebih lanjut, silakan hubungi petugas perpustakaan.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-5">
        <h2 class="mb-3 text-primary">Buku yang Sedang Dipinjam</h2>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Judul Buku</th>
                        <th>Tanggal Peminjaman</th>
                        <th>Tanggal Pengembalian</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Laskar Pelangi</td>
                        <td>2024-09-20</td>
                        <td>2024-10-04</td>
                        <td><span class="badge bg-warning">Dipinjam</span></td>
                    </tr>
                    <tr>
                        <td>Bumi Manusia</td>
                        <td>2024-09-15</td>
                        <td>2024-09-29</td>
                        <td><span class="badge bg-success">Dikembalikan</span></td>
                    </tr>
                    <tr>
                        <td>Pulang</td>
                        <td>2024-09-22</td>
                        <td>2024-10-06</td>
                        <td><span class="badge bg-warning">Dipinjam</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
