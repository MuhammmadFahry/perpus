@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar Buku</h1>

    <!-- Tempat menampilkan buku-buku -->
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
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{ $books->links() }}
</div>
@endsection
