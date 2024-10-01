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
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addBookModal">
                <i class="fas fa-plus"></i> Tambah Buku Baru
            </button>
        </div>

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
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($books as $book)
                        <tr>
                            <td>{{ $book->id }}</td>
                            <td>{{ $book->title }}</td>
                            <td>{{ $book->author }}</td>
                            <td>{{ $book->publication_year }}</td>
                            <td>{{ ucfirst($book->category) }}</td>
                            <td>
                                <!-- Edit button -->
                                <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#editBookModal{{ $book->id }}">
                                    <i class="fas fa-edit"></i> Edit
                                </button>

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
                            <td colspan="6" class="text-center">Tidak ada buku yang tersedia.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{ $books->links() }}
        </div>
    </div>

    <!-- Tambah Buku Modal -->
    <div class="modal fade" id="addBookModal" tabindex="-1" role="dialog" aria-labelledby="addBookModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addBookModalLabel">Tambah Buku Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('books.store') }}" method="POST">
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
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Buku Modal -->
    @foreach($books as $book)
    <div class="modal fade" id="editBookModal{{ $book->id }}" tabindex="-1" role="dialog" aria-labelledby="editBookModalLabel{{ $book->id }}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editBookModalLabel{{ $book->id }}">Edit Buku</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('books.update', $book->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="title">Judul Buku</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ $book->title }}" required>
                        </div>
                        <div class="form-group">
                            <label for="author">Pengarang</label>
                            <input type="text" class="form-control" id="author" name="author" value="{{ $book->author }}" required>
                        </div>
                        <div class="form-group">
                            <label for="publication_year">Tahun Terbit</label>
                            <input type="number" class="form-control" id="publication_year" name="publication_year" value="{{ $book->publication_year }}" required>
                        </div>
                        <div class="form-group">
                            <label for="category">Kategori</label>
                            <select class="form-control" id="category" name="category" required>
                                <option value="fiksi" {{ $book->category == 'fiksi' ? 'selected' : '' }}>Fiksi</option>
                                <option value="non-fiksi" {{ $book->category == 'non-fiksi' ? 'selected' : '' }}>Non-Fiksi</option>
                                <option value="pendidikan" {{ $book->category == 'pendidikan' ? 'selected' : '' }}>Pendidikan</option>
                                <option value="lainnya" {{ $book->category == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach

</div>
@endsection
