@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="borrowed-books-container mb-5">
        <h1 class="mb-4 text-primary">Buku yang Dipinjam</h1>

        <!-- Status peminjaman -->
        <div class="alert alert-info mb-4" role="alert">
            <i class="fas fa-info-circle me-2"></i>
            Anda memiliki <strong>1 buku</strong> yang sedang dipinjam.
        </div>

        <!-- Jika tidak ada buku yang dipinjam -->
        <div class="no-books-message" style="display: none;">
            <div class="alert alert-warning" role="alert">
                <i class="fas fa-exclamation-triangle me-2"></i>
                Anda belum meminjam buku apapun.
            </div>
            <a href="#" class="btn btn-primary">
                <i class="fas fa-book me-2"></i>Pinjam Buku Sekarang
            </a>
        </div>

        <!-- Jika ada buku yang dipinjam -->
        <div class="row">
            <!-- Ulangi blok ini untuk setiap buku yang dipinjam -->
            <div class="col-md-4 mb-4">
                <div class="card book-card h-100 shadow-sm">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title text-primary">Laskar Pelangi</h5>
                        <h6 class="card-subtitle mb-2 text-muted">Andrea Hirata</h6>
                        <p class="card-text flex-grow-1">
                            <small><i class="far fa-calendar-alt me-2"></i>Tanggal Peminjaman: 25 Sept 2024</small><br>
                            <small><i class="far fa-calendar-check me-2"></i>Batas Pengembalian: 25 Okt 2024</small>
                        </p>
                        <div class="mt-auto">
                            <div class="progress mb-2">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 70%;" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100">70% Waktu Tersisa</div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <a href="#" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#extendLoanModal" data-book-id="1" data-book-title="Laskar Pelangi">
                                    <i class="fas fa-undo-alt me-1"></i>Perpanjang
                                </a>
                                <a href="#" class="btn btn-outline-success btn-sm" data-bs-toggle="modal" data-bs-target="#returnBookModal" data-book-id="1" data-book-title="Laskar Pelangi">
                                    <i class="fas fa-check me-1"></i>Kembalikan
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Akhir dari blok buku -->
        </div>
    </div>

    <!-- Bagian Pengembalian Buku -->
    <div class="return-books-container mt-5">
        <h2 class="mb-4 text-primary">Pengembalian Buku</h2>
        <div class="card shadow-sm">
            <div class="card-body">
                <form id="returnBookForm">
                    <div class="mb-3">
                        <label for="bookToReturn" class="form-label">Pilih Buku untuk Dikembalikan</label>
                        <select class="form-select" id="bookToReturn" required>
                            <option value="">Pilih buku...</option>
                            <option value="1">Laskar Pelangi - Andrea Hirata</option>
                            <option value="2">Bumi Manusia - Pramoedya Ananta Toer</option>
                            <option value="3">Pulang - Tere Liye</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="returnDate" class="form-label">Tanggal Pengembalian</label>
                        <input type="date" class="form-control" id="returnDate" required>
                    </div>
                    <div class="mb-3">
                        <label for="bookCondition" class="form-label">Kondisi Buku</label>
                        <select class="form-select" id="bookCondition" required>
                            <option value="">Pilih kondisi...</option>
                            <option value="baik">Baik</option>
                            <option value="rusak_ringan">Rusak Ringan</option>
                            <option value="rusak_berat">Rusak Berat</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="lateFee" class="form-label">Denda Keterlambatan</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" class="form-control" id="lateFee" readonly>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="notes" class="form-label">Catatan (opsional)</label>
                        <textarea class="form-control" id="notes" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-check-circle me-2"></i>Kembalikan Buku
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Pengembalian Buku -->
<div class="modal fade" id="returnBookModal" tabindex="-1" aria-labelledby="returnBookModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="returnBookModalLabel">Konfirmasi Pengembalian Buku</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Anda yakin ingin mengembalikan buku "<span id="bookTitleToReturn"></span>"?</p>
                <div id="lateFeeInfo" class="alert alert-warning" style="display: none;">
                    <p>Anda memiliki denda keterlambatan sebesar <strong>Rp <span id="lateFeeAmount"></span></strong>.</p>
                    <p>Silakan bayar denda di kasir sebelum mengembalikan buku.</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="confirmReturn">Ya, Kembalikan</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Perpanjangan Peminjaman -->
<div class="modal fade" id="extendLoanModal" tabindex="-1" aria-labelledby="extendLoanModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="extendLoanModalLabel">Perpanjang Peminjaman</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Anda ingin memperpanjang peminjaman buku "<span id="bookTitleToExtend"></span>"?</p>
                <form id="extendLoanForm">
                    <div class="mb-3">
                        <label for="extensionDuration" class="form-label">Durasi Perpanjangan</label>
                        <select class="form-select" id="extensionDuration" required>
                            <option value="">Pilih durasi...</option>
                            <option value="7">1 Minggu</option>
                            <option value="14">2 Minggu</option>
                            <option value="30">1 Bulan</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="extensionReason" class="form-label">Alasan Perpanjangan</label>
                        <textarea class="form-control" id="extensionReason" rows="3" required></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="confirmExtension">Perpanjang</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .book-card {
        transition: transform 0.2s;
    }
    .book-card:hover {
        transform: translateY(-5px);
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Logika untuk modal konfirmasi pengembalian
        var returnBookModal = document.getElementById('returnBookModal')
        returnBookModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget
            var bookId = button.getAttribute('data-book-id')
            var bookTitle = button.getAttribute('data-book-title')
            var modalBodyInput = returnBookModal.querySelector('.modal-body span#bookTitleToReturn')
            modalBodyInput.textContent = bookTitle

            // Simulasi pengecekan denda
            var lateFee = Math.floor(Math.random() * 50000) // Denda acak antara 0 - 50000
            var lateFeeInfo = document.getElementById('lateFeeInfo')
            var lateFeeAmount = document.getElementById('lateFeeAmount')

            if (lateFee > 0) {
                lateFeeInfo.style.display = 'block'
                lateFeeAmount.textContent = lateFee
            } else {
                lateFeeInfo.style.display = 'none'
            }
        })

        // Logika untuk form pengembalian buku
        document.getElementById('returnBookForm').addEventListener('submit', function(e) {
            e.preventDefault()
            // Di sini Anda bisa menambahkan logika untuk mengirim data pengembalian ke server
            alert('Buku berhasil dikembalikan!')
            this.reset()
        })

        // Logika untuk modal perpanjangan peminjaman
        var extendLoanModal = document.getElementById('extendLoanModal')
        extendLoanModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget
            var bookId = button.getAttribute('data-book-id')
            var bookTitle = button.getAttribute('data-book-title')
            var modalBodyInput = extendLoanModal.querySelector('.modal-body span#bookTitleToExtend')
            modalBodyInput.textContent = bookTitle
        })

        // Logika untuk konfirmasi perpanjangan
        document.getElementById('confirmExtension').addEventListener('click', function() {
            var duration = document.getElementById('extensionDuration').value
            var reason = document.getElementById('extensionReason').value

            if (duration && reason) {
                // Di sini Anda bisa menambahkan logika untuk mengirim data perpanjangan ke server
                alert('Peminjaman buku berhasil diperpanjang!')
                var modal = bootstrap.Modal.getInstance(extendLoanModal)
                modal.hide()
                document.getElementById('extendLoanForm').reset()
            } else {
                alert('Harap isi semua field yang diperlukan.')
            }
        })

        // Simulasi perhitungan denda otomatis
        document.getElementById('returnDate').addEventListener('change', function() {
            var returnDate = new Date(this.value)
            var dueDate = new Date('2024-10-25') // Tanggal jatuh tempo dari contoh sebelumnya
            var lateFee = 0

            if (returnDate > dueDate) {
                var dayLate = Math.ceil((returnDate - dueDate) / (1000 * 60 * 60 * 24))
                lateFee = dayLate * 5000 // Misalnya, denda Rp 5.000 per hari
            }

            document.getElementById('lateFee').value = lateFee
        })
    })
</script>
@endpush
