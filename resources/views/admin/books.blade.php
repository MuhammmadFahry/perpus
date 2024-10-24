@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Custom Alert -->
    <div id="customAlert" class="alert" style="display:none;"></div>
    {{-- @if (Session::has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success</strong> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif --}}
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
                    <label for="description">Deskripsi Buku</label>
                    <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
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
                    <div class="card mb-4 book-card" data-id="{{ $book->id }}" data-title="{{ $book->title }}" data-author="{{ $book->author }}" data-year="{{ $book->publication_year }}" data-category="{{ $book->category }}" data-description="{{ $book->description }}" data-image="{{ asset($book->image) }}">
                        <img class="card-img-top" src="{{ asset(''.$book->image) }}" alt="Book Cover" style="max-height: 500px; cursor: pointer;">
                        <div class="card-body">
                            <h3 class="card-title" style="cursor: pointer;">{{ $book->title }}</h3>
                            <a href="{{ route('books.show', $book->id ) }}"class="btn btn-primary">show details</a>
                            <button class="btn btn-warning btn-sm editBookBtn" data-id="{{ $book->id }}"
                                data-title="{{ $book->title }}" data-author="{{ $book->author }}"
                                data-year="{{ $book->publication_year }}" data-category="{{ $book->category }}" data-description="{{ $book->description }}">
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

<!-- Modal to show book details -->
<div class="modal fade" id="bookDetailModal" tabindex="-1" aria-labelledby="bookDetailModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bookDetailModalLabel">Detail Buku</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img id="modalBookImage" src="" alt="Book Cover" class="img-fluid mb-3">
                <h4 id="modalBookTitle"></h4>
                <p id="modalBookAuthor"></p>
                <p id="modalBookYear"></p>
                <p id="modalBookCategory"></p>
                <p id="modalBookDescription"></p>
            </div>
        </div>
    </div>
</div>

<!-- JQuery & JS Script -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    // Show and Hide Book Form
    $('#toggleBookForm').click(function() {
        $('#bookFormContainer').toggle();
        $('#bookForm').attr('action', '{{ route('books.store') }}');
        $('#bookForm').html(`@csrf
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
                                <label for="description">Deskripsi Buku</label>
                                <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="image">Cover Buku</label>
                                    <input type="file" class="form-control" id="image" name="image" accept="image/*">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    <button type="button" class="btn btn-secondary" id="cancelBookForm">Batal</button>`)
                                    resetForm();
                                });

                                $('#cancelBookForm').click(function() {
                                    $('#bookFormContainer').hide();
                                    resetForm();
                                });

                                function resetForm() {
                                    $('#bookId').val('');
                                    $('#title').val('');
                                    $('#author').val('');
                                    $('#publication_year').val('');
                                    $('#category').val('fiksi');
                                    $('#description').val('');
                                    $('#image').val('');
                                }

                                // // Show book details in modal when a book card is clicked
                                // $('.book-card').click(function() {
    //     const bookTitle = $(this).data('title');
    //     const bookAuthor = $(this).data('author');
    //     const bookYear = $(this).data('year');
    //     const bookCategory = $(this).data('category');
    //     const bookDescription = $(this).data('description');
    //     const bookImage = $(this).data('image');

    //     // Set modal content
    //     $('#modalBookTitle').text(bookTitle);
    //     $('#modalBookAuthor').text('Pengarang: ' + bookAuthor);
    //     $('#modalBookYear').text('Tahun Terbit: ' + bookYear);
    //     $('#modalBookCategory').text('Kategori: ' + bookCategory.charAt(0).toUpperCase() + bookCategory.slice(1));
    //     $('#modalBookDescription').text(bookDescription);
    //     $('#modalBookImage').attr('src', bookImage);

    //     // Show the modal
    //     $('#bookDetailModal').modal('show');
    // });

    // Handle edit book button
    $('.editBookBtn').click(function() {
        const bookId = $(this).data('id');
        const title = $(this).data('title');
        const author = $(this).data('author');
        const year = $(this).data('year');
        const category = $(this).data('category');
        const description = $(this).data('description');

        $('#bookFormContainer').toggle();
        $('#bookForm').attr('action', `/books/${bookId}`);

        $('#bookForm').html(`@csrf
                @method('PUT')
                <input type="hidden" id="bookId" name="book_id">
                <div class="form-group">
                    <label for="title">Judul Buku</label>
                    <input type="text" class="form-control" id="title" name="title" required value="${title}">
                </div>
                <div class="form-group">
                    <label for="author">Pengarang</label>
                    <input type="text" class="form-control" id="author" name="author" required value="${author}">
                </div>
                <div class="form-group">
                    <label for="publication_year">Tahun Terbit</label>
                    <input type="number" class="form-control" id="publication_year" name="publication_year" required value="${year}">
                </div>
                <div class="form-group">
                    <label for="category">Kategori</label>
                    <select class="form-control" id="category" name="category" required value="${category}">
                        <option value="fiksi">Fiksi</option>
                        <option value="non-fiksi">Non-Fiksi</option>
                        <option value="pendidikan">Pendidikan</option>
                        <option value="lainnya">Lainnya</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="description">Deskripsi Buku</label>
                    <textarea class="form-control" id="description" name="description" rows="3" required>${description}</textarea>
                </div>
                <div class="form-group">
                    <label for="image">Cover Buku</label>
                    <input type="file" class="form-control" id="image" name="image" accept="image/*">
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <button type="button" class="btn btn-secondary" id="cancelBookForm">Batal</button>`);
    });

    // resetForm();
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
        })
        @endif
    </script>
@endpush
