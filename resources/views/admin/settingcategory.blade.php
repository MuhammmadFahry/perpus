@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Pengaturan Kategori Buku</h2>

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
                <form action="{{ route('admin.settingcategory.destroy', $category->id) }}" method="POST" class="delete-form">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-danger btn-sm delete-button">Hapus</button>
                </form>
            </li>
        @empty
            <li class="list-group-item">Belum ada kategori.</li>
        @endforelse
    </ul>
</div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const deleteButtons = document.querySelectorAll('.delete-button');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function () {
                    Swal.fire({
                        title: 'Apakah Anda yakin?',
                        text: "Kategori ini akan dihapus secara permanen!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Akses form di sekitar tombol dan submit form
                            button.closest('.delete-form').submit();
                        }
                    });
                });
            });

            // Tampilkan pesan sukses atau error dengan SweetAlert jika ada
            @if (Session::has('success'))
                Swal.fire({
                    title: 'Success',
                    text: '{{ session('success') }}',
                    icon: 'success',
                    confirmButtonText: 'Nice'
                });
            @endif

            @if (Session::has('error'))
                Swal.fire({
                    title: 'Error',
                    text: '{{ session('error') }}',
                    icon: 'error',
                    confirmButtonText: 'Okay'
                });
            @endif
        });
    </script>
@endpush
