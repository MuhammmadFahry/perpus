@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center my-4">Tim Perpustakaan Garuda</h1>

    <div class="row">
        <!-- Anggota Tim 1 -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <img src="https://via.placeholder.com/150" alt="Foto Tim 1" class="rounded-circle mb-3">
                    <h5 class="card-title">Nama Anggota 1</h5>
                    <p class="card-text">Deskripsi tentang anggota tim ini.</p>
                </div>
            </div>
        </div>

        <!-- Anggota Tim 2 -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <img src="https://via.placeholder.com/150" alt="Foto Tim 2" class="rounded-circle mb-3">
                    <h5 class="card-title">Nama Anggota 2</h5>
                    <p class="card-text">Deskripsi tentang anggota tim ini.</p>
                </div>
            </div>
        </div>

        <!-- Anggota Tim 3 -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <img src="https://via.placeholder.com/150" alt="Foto Tim 3" class="rounded-circle mb-3">
                    <h5 class="card-title">Nama Anggota 3</h5>
                    <p class="card-text">Deskripsi tentang anggota tim ini.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
