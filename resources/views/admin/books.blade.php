@extends('layouts.app')

@section('content')
<div class="container">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Pengaturan Buku</h4>
            <button id="toggleAddBookForm" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Buku Baru
            </button>
        </div>

        <!-- Form to add a new book, initially hidden -->
        <div class="card-body" id="addBookForm" style="display: none;">
            <form id="bookForm" action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
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
                    <label for="book_image">Foto Buku</label>
                    <input type="file" class="form-control-file" id="book_image" name="book_image" required>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>

        <!-- Book List Table -->
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Judul</th>
                            <th>Pengarang</th>
                            <th>Tahun Terbit</th>
                            <th>Kategori</th>
                            <th>Deskripsi</th>
                            <th>Foto</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="bookTableBody">
                        @forelse($books as $book)
                        <tr id="bookRow{{ $book->id }}">
                            <td>{{ $book->id }}</td>
                            <td>{{ $book->title }}</td>
                            <td>{{ $book->author }}</td>
                            <td>{{ $book->publication_year }}</td>
                            <td>{{ ucfirst($book->category) }}</td>
                            <td>{{ Str::limit($book->description, 50) }}</td>
                            <td><img src="{{ asset('storage/' . $book->book_image) }}" alt="{{ $book->title }}" width="50"></td>
                            <td>
                                <!-- Delete form -->
                                <form action="{{ route('books.destroy', $book->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus buku ini?')">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center">Tidak ada buku yang tersedia.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{ $books->links() }}
        </div>
    </div>
</div>

<!-- Search Books -->
<div class="container mt-4">
    <h4>Cari Buku</h4>
    <form action="{{ route('books.search') }}" method="GET">
        <div class="form-group">
            <input type="text" class="form-control" name="search" placeholder="Cari judul atau pengarang buku...">
        </div>
        <button type="submit" class="btn btn-primary">Cari</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    // Toggle Add Book Form
    $('#toggleAddBookForm').click(function() {
        $('#addBookForm').toggle(); // Show/hide form
    });

    // Handle form submission via AJAX to prevent page reload
    $('#bookForm').submit(function(event) {
        event.preventDefault(); // Prevent the form from submitting the normal way

        var formData = new FormData(this);

        $.ajax({
            url: $(this).attr('action'),
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                if (response.success) {
                    // Add the new book row to the table
                    const newBook = response.book;
                    const newRow = `
                        <tr id="bookRow${newBook.id}">
                            <td>${newBook.id}</td>
                            <td>${newBook.title}</td>
                            <td>${newBook.author}</td>
                            <td>${newBook.publication_year}</td>
                            <td>${newBook.category.charAt(0).toUpperCase() + newBook.category.slice(1)}</td>
                            <td>${newBook.description}</td>
                            <td><img src="/storage/${newBook.book_image}" alt="${newBook.title}" width="50"></td>
                            <td>
                                <form action="/books/${newBook.id}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    `;
                    $('#bookTableBody').append(newRow); // Append new book to table

                    // Hide the form and reset it
                    $('#addBookForm').hide();
                    $('#bookForm')[0].reset();
                }
            },
            error: function(response) {
                alert('Ada kesalahan, silakan coba lagi.');
            }
        });
    });
</script>
@endsection
