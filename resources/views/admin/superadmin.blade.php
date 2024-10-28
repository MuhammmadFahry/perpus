@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <h1 class="mb-4 text-center display-4 text-primary">Superadmin Dashboard</h1>

        <div class="row">
            <!-- Daftar Admin -->
            <div class="col-md-6 mb-4">
                <div class="card shadow-lg border-0">
                    <div class="card-header bg-primary text-white">
                        <h2 class="h5 mb-0">Daftar Admin</h2>
                    </div>
                    <div class="card-body p-4">
                        <div class="table-responsive">
                            <table class="table table-hover text-center">
                                <thead class="table-primary">
                                    <tr>
                                        <th>Nama</th>
                                        <th>Email</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($admins as $admin)
                                        <tr>
                                            <td>{{ $admin->name }}</td>
                                            <td>{{ $admin->email }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Daftar User -->
            <div class="col-md-6 mb-4">
                <div class="card shadow-lg border-0">
                    <div class="card-header bg-success text-white">
                        <h2 class="h5 mb-0">Daftar User</h2>
                    </div>
                    <div class="card-body p-4">
                        <div class="table-responsive">
                            <table class="table table-hover text-center">
                                <thead class="table-success">
                                    <tr>
                                        <th>Nama</th>
                                        <th>Email</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Tambah Admin Baru -->
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg border-0">
                    <div class="card-header bg-info text-white">
                        <h2 class="h5 mb-0">Tambah Admin Baru</h2>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('superadmin.addAdmin') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama</label>
                                <input type="text" name="name" class="form-control" id="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" id="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group">
                                    <input type="password" name="password" class="form-control" id="password" required>
                                    <button class="btn btn-outline-secondary toggle-password" type="button" onclick="togglePasswordVisibility('password')">
                                        <i class="fa fa-eye" id="togglePasswordIcon_password"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                                <div class="input-group">
                                    <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" required>
                                    <button class="btn btn-outline-secondary toggle-password" type="button" onclick="togglePasswordVisibility('password_confirmation')">
                                        <i class="fa fa-eye" id="togglePasswordIcon_password_confirmation"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary py-2">Tambah Admin</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tambahan CSS Khusus -->
    <style>
        .toggle-password {
            background-color: #e9ecef;
        }

        .toggle-password:focus {
            outline: none;
            background-color: #d4d4d4;
        }

        .form-control:focus {
            border-color: #80bdff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }

        .btn-primary, .btn-primary:hover {
            background-color: #007bff;
            border-color: #007bff;
        }

        .card-header {
            border-radius: 0.25rem 0.25rem 0 0;
            font-weight: bold;
        }

        .table thead th {
            font-weight: bold;
        }
    </style>
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

        function togglePasswordVisibility(id) {
            const passwordInput = document.getElementById(id);
            const icon = document.getElementById('togglePasswordIcon_' + id);
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        }
    </script>
@endpush
