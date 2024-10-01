@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
        </div>
        <div class="col-md-10">
            <div class="card mb-4">
                <div class="card-header">
                    <h4>Pengaturan Denda</h4>
                </div>
                <div class="card-body">
                    <form>
                        <div class="form-group pb-3">
                            <label for="fine_amount">Jumlah Denda Per Hari</label>
                            <input type="number" class="form-control" id="fine_amount" placeholder="Masukkan jumlah denda per hari">
                        </div>
                        <button type="submit" class="btn btn-primary p-2">Simpan Pengaturan Denda</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
