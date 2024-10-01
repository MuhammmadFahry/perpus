@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
        </div>
        <div class="col-md-10">
            <div class="card mb-4">
                <div class="card-header">
                    <h4>Buku yang Sedang Dipinjam</h4>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Judul Buku</th>
                                <th>Peminjam</th>
                                <th>Tanggal Pinjam</th>
                                <th>Tanggal Kembali</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Buku A</td>
                                <td>User 1</td>
                                <td>01/09/2024</td>
                                <td>15/09/2024</td>
                            </tr>
                            <tr>
                                <td>Buku B</td>
                                <td>User 2</td>
                                <td>02/09/2024</td>
                                <td>16/09/2024</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
