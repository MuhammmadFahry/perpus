@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="mb-5 text-center">Daftar Buku</h1>

    <!-- Tempat menampilkan buku-buku -->
    <div class="row justify-content-center">
        @foreach($books as $book)
        <div class="col-md-3 d-flex align-items-stretch">
            <div class="card border-0 mb-4 shadow-sm hover-zoom d-flex flex-column justify-content-between" style="transition: all 0.3s ease-in-out;">
                <img class="card-img-top rounded-top" src="{{ asset($book->image) }}" alt="Book Cover" style="height: 300px; object-fit: cover;">
                <div class="card-body text-center d-flex flex-column justify-content-between">
                    <h6 class="card-title mt-2">{{ $book->title }}</h6>
                    <div class="mt-auto">
                        <a href="{{ route('books.show', $book->id ) }}" class="btn btn-sm btn-primary">Show Details</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $books->links() }}
    </div>
</div>

<style>
    .hover-zoom:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2);
    }
    .card {
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    .card-title {
        font-size: 1.1rem;
        font-weight: bold;
        margin-bottom: 0.5rem;
    }
    .btn {
        font-size: 0.875rem;
        padding: 0.5rem 1rem;
    }
</style>
@endsection
