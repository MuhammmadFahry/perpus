@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Custom Alert -->
    <div id="customAlert" class="alert" style="display:none;"></div>

    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Pengelolaan Buku</h4>
            <button id="toggleBookForm" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Buku Baru
            </button>
        </div>

        <!-- Form to add and update book -->
        <div class="card-body" id="bookFormContainer" style="display: none;">
            <form id="bookForm" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="bookId" name="book_id">
                <div class="form-group">
                    <label for="title">Judul Buku</label>
                    <input type="text" class="form-control" id="title" name="title" required>
                </div>
                <div class="form-group">
                    <label for="author">Pengarang</label>
                    <input type="text" class="form-control" id="author" name="author" required>
                </div>
                <div class="form-group">
                    <label for="publication_year">Tahun Terbit</label>
                    <input type="number" class="form-control" id="publication_year" name="publication_year" required>
                </div>
                <div class="form-group">
                    <label for="category">Kategori</label>
                    <select class="form-control" id="category" name="category" required>
                        <option value="fiksi">Fiksi</option>
                        <option value="non-fiksi">Non-Fiksi</option>
                        <option value="pendidikan">Pendidikan</option>
                        <option value="lainnya">Lainnya</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="image">Cover Buku</label>
                    <input type="file" class="form-control" id="image" name="image" accept="image/*">
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <button type="button" class="btn btn-secondary" id="cancelBookForm">Batal</button>
            </form>
        </div>

        <!-- Book List Table -->
        <div class="card-body">
            <div class="row">
                @foreach($books as $book)
                <div class="col-md-3">
                    <div class="card mb-4">
                        <img class="card-img-top" src="{{ asset($book->image) }}" alt="Book Cover" style="max-height: 200px;">
                        <div class="card-body">
                            <h5 class="card-title">{{ $book->title }}</h5>
                            <p class="card-text">{{ $book->author }}</p>
                            <p>{{ $book->publication_year }}</p>
                            <p>{{ ucfirst($book->category) }}</p>

                            <!-- Edit button -->
                            <button class="btn btn-warning btn-sm editBookBtn" data-id="{{ $book->id }}"
                                data-title="{{ $book->title }}" data-author="{{ $book->author }}"
                                data-year="{{ $book->publication_year }}" data-category="{{ $book->category }}">
                                Edit
                            </button>

                            <!-- Delete button with confirmation -->
                            <form action="{{ route('books.destroy', $book->id) }}" method="POST" class="d-inline deleteBookForm">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            {{ $books->links() }}
        </div>
    </div>
</div>

<!-- JQuery & JS Script -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    // Show and Hide Book Form
    $('#toggleBookForm').click(function() {
        $('#bookFormContainer').toggle();
        $('#bookForm').attr('action', '{{ route('books.store') }}');
        resetForm();
    });

    // Cancel button functionality
    $('#cancelBookForm').click(function() {
        $('#bookFormContainer').hide();
        resetForm();
    });

    // Function to reset form
    function resetForm() {
        $('#bookId').val('');
        $('#title').val('');
        $('#author').val('');
        $('#publication_year').val('');
        $('#category').val('fiksi');
        $('#image').val('');
    }

    // Handle edit book button
    $('.editBookBtn').click(function() {
    const bookId = $(this).data('id');
    const title = $(this).data('title');
    const author = $(this).data('author');
    const year = $(this).data('year');
    const category = $(this).data('category');

    $('#bookForm').html(`@csrf
                @method('PUT')
                <input type="hidden" id="bookId" name="book_id">
                <div class="form-group">
                    <label for="title">Judul Buku</label>
                    <input type="text" class="form-control" id="title" name="title" required>
                </div>
                <div class="form-group">
                    <label for="author">Pengarang</label>
                    <input type="text" class="form-control" id="author" name="author" required>
                </div>
                <div class="form-group">
                    <label for="publication_year">Tahun Terbit</label>
                    <input type="number" class="form-control" id="publication_year" name="publication_year" required>
                </div>
                <div class="form-group">
                    <label for="category">Kategori</label>
                    <select class="form-control" id="category" name="category" required>
                        <option value="fiksi">Fiksi</option>
                        <option value="non-fiksi">Non-Fiksi</option>
                        <option value="pendidikan">Pendidikan</option>
                        <option value="lainnya">Lainnya</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="image">Cover Buku</label>
                    <input type="file" class="form-control" id="image" name="image" accept="image/*">
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <button type="button" class="btn btn-secondary" id="cancelBookForm">Batal</button>`);
    // Mengisi field form dengan data yang diambil
    $('#bookId').val(bookId);
    $('#title').val(title);
    $('#author').val(author);
    $('#publication_year').val(year);
    $('#category').val(category);

    // Menampilkan form
    $('#bookFormContainer').show();

    // Menetapkan action form untuk update
    $('#bookForm').attr('action', `{{ url('books') }}/${bookId}`);
});


    // Handle delete book action with confirmation
    $('.deleteBookForm').submit(function(event) {
        event.preventDefault();
        if (confirm('Apakah Anda yakin ingin menghapus buku ini?')) {
            const form = $(this);

            $.ajax({
                url: form.attr('action'),
                method: 'POST',
                data: form.serialize(),
                success: function(response) {
                    if (response.success) {
                        form.closest('.card').fadeOut(); // Remove book card
                        showAlert(response.message, 'success');
                    } else {
                        showAlert(response.message, 'danger');
                    }
                },
                error: function() {
                    showAlert('Gagal menghapus buku, silakan coba lagi.', 'danger');
                }
            });
        }
    });

    // Function to show alert
    function showAlert(message, type) {
        const alert = $('#customAlert');
        alert.text(message).removeClass().addClass('alert alert-' + type).fadeIn();

        setTimeout(() => {
            alert.fadeOut();
        }, 3000); // Auto-hide after 3 seconds
    }
</script>
@endsection
