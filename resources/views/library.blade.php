@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <h1 class="text-center mb-5">Daftar Buku</h1>

        <!-- Search Bar with Category Button -->
        <div class="row justify-content-center mb-4">
            <div class="col-md-8">
                <form action="{{ route('search.submit') }}" method="GET" class="input-group">
                    <input type="text" class="form-control" placeholder="Cari judul buku dan penulis..." name="query"
                        required>
                    <button class="btn btn-primary" type="submit">Cari</button>
                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#categoryModal">
                        <i class="fas fa-tags me-2"></i> Kategori
                    </button>
                </form>
            </div>
        </div>

        <!-- Category Modal -->
        <div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="categoryModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="categoryModalLabel">Daftar Kategori</h5>
                    </div>
                    <div class="modal-body">
                        <ul class="list-group">
                            @forelse($categories as $category)
                                <li class="list-group-item d-flex justify-content-between align-items-center category-item"
                                    data-id="{{ $category->id }}">
                                    {{ $category->name }}
                                    <span
                                        class="badge bg-primary rounded-pill">{{ $category->countBooksByGenre($category->id) ?? 0 }}
                                        Buku</span>
                                </li>
                            @empty
                                <li class="list-group-item text-center">Tidak ada kategori yang tersedia.</li>
                            @endforelse
                        </ul>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Search Results with Grid Layout -->
        <div id="books-container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
                @if (Session::has('success'))
                    @foreach (session('success') as $book)
                        <div class="col d-flex align-items-stretch">
                            <div class="card book-card shadow-sm">
                                <div class="img-wrapper">
                                    <img src="{{ asset($book->image) }}" alt="Book Cover" class="card-img-top">
                                </div>
                                <div class="card-body text-center d-flex flex-column">
                                    <h6 class="card-title">{{ $book->title }}</h6>
                                    <div class="mt-auto">
                                        <a href="{{ route('books.show', $book->id) }}" class="btn btn-primary btn-sm">Show
                                            Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    @foreach ($books as $book)
                        <div class="col d-flex align-items-stretch">
                            <div class="card book-card shadow-sm">
                                <div class="img-wrapper">
                                    <img src="{{ asset($book->image) }}" alt="Book Cover" class="card-img-top">
                                </div>
                                <div class="card-body text-center d-flex flex-column">
                                    <h6 class="card-title">{{ $book->title }}</h6>
                                    <div class="mt-auto">
                                        <a href="{{ route('books.show', $book->id) }}" class="btn btn-primary btn-sm">Show
                                            Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $books->links() }}
        </div>
    </div>

    <!-- Custom Styling -->
    <style>
        .book-card {
            border-radius: 10px;
            border: 1px solid #e0e0e0;
            transition: transform 0.3s, box-shadow 0.3s;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100%;
            margin: 0.5rem;
        }

        .book-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
        }

        .img-wrapper {
            width: 100%;
            height: 250px;
            overflow: hidden;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f8f8f8;
        }

        .book-card .card-img-top {
            width: 100%;
            height: auto;
            object-fit: cover;
        }

        .card-body {
            padding: 0.5rem 1rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            flex-grow: 1;
        }

        .card-title {
            font-size: 1rem;
            font-weight: bold;
            color: #ffffff;
            margin: 0.5rem 0;
            text-align: center;
        }

        .row-cols-1 .col,
        .row-cols-sm-2 .col,
        .row-cols-md-3 .col,
        .row-cols-lg-4 .col {
            display: flex;
            justify-content: center;
            margin-bottom: 1rem;
        }
    </style>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.category-item').forEach(item => {
                item.addEventListener('click', function() {
                    const categoryId = this.getAttribute('data-id');

                    fetch(`/books/category/${categoryId}`)
                        .then(response => response.text())
                        .then(data => {
                            document.getElementById('books-container').innerHTML = data;
                            const categoryModal = new bootstrap.Modal(document.getElementById('categoryModal'));
                            categoryModal.hide();
                        })
                        .catch(error => console.error('Error:', error));
                });
            });
        });
    </script>
@endpush
