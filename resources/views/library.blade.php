@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar Buku</h1>

    <!-- Tempat menampilkan buku-buku -->
    <div class="row">
        @foreach($books as $book)
        <div class="col-md-3">
            <div class="card mb-4">
                <img class="card-img-top" src="{{ asset($book->image) }}" alt="Book Cover" style="max-height: 500px;">
                <div class="card-body">
                    <h5 class="card-title">{{ $book->title }}</h5>
                    <a href="{{ route('books.show', $book->id ) }}"class="btn btn-primary">show details</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{ $books->links() }}
</div>
@endsection
