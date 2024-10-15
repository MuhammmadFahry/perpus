@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">
                    <h4>Pengaturan Denda</h4>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @elseif(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('admin.penalties.save') }}" method="POST">
                        @csrf
                        <div class="form-group pb-3">
                            <label for="fine_amount">Jumlah Denda Per Hari</label>
                            <input type="number" name="fine_amount" class="form-control @error('fine_amount') is-invalid @enderror" id="fine_amount" placeholder="Masukkan jumlah denda per hari" value="{{ old('fine_amount', $fineAmount ?? '') }}">
                            @error('fine_amount')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary p-2">Simpan Pengaturan Denda</button>
                    </form>

                    <hr>

                    <h5>Denda yang Telah Dimasukkan:</h5>
                    <p>Jumlah Denda Per Hari: <strong>Rp {{ $fineAmount ?? 'Belum disetel' }}</strong></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
