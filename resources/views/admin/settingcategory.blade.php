@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Pengaturan Kategori Buku</h2>

    <!-- Tampilkan pesan sukses -->
    {{-- @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif --}}

    <!-- Formulir untuk menambahkan kategori baru -->
    <form action="{{ route('admin.settingcategory.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nama Kategori</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <button type="submit" class="btn btn-primary">Tambahkan Kategori</button>
    </form>

    <!-- Daftar kategori -->
    <h3 class="mt-5">Daftar Kategori</h3>
    <ul class="list-group">
        @forelse($categories as $category)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                {{ $category->name }}
                <!-- Tombol Hapus -->
                <form action="{{ route('admin.settingcategory.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                </form>
            </li>
        @empty
            <li class="list-group-item">Belum ada kategori.</li>
        @endforelse
    </ul>
</div>
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
