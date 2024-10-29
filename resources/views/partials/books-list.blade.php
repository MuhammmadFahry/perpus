<!-- resources/views/partials/books-list.blade.php -->
@if ($books->isEmpty())
    <div class="alert alert-info text-center">Tidak ada buku dalam kategori ini.</div>
@else
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
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
    </div>
@endif
