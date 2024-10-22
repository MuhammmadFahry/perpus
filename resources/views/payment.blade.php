@extends('layouts.app')

@section('content')
<style>
    .payment-container {
        max-width: 600px;
        margin: 50px auto;
        padding: 30px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        text-align: center;
        color: black
    }

    .payment-container h4 {
        font-size: 24px;
        margin-bottom: 20px;
        color: #333;
    }

    .payment-container p {
        font-size: 18px;
        margin-bottom: 30px;
    }

    .payment-container button {
        background-color: #007bff;
        border: none;
        padding: 12px 20px;
        font-size: 16px;
        border-radius: 5px;
        color: #fff;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .payment-container button:hover {
        background-color: #0056b3;
    }

    .payment-container img {
        max-width: 100px;
        margin-bottom: 15px;
    }
</style>

<div class="payment-container">
    <i class="fas fa-money-bill me-2" style="font-size: 60px"></i>
    <h4>Pembayaran Denda</h4>
    <p>Total Denda: <strong>Rp {{ number_format($buku_yang_dipinjam->denda, 0, ',', '.') }}</strong></p>
    <button id="pay-button">Bayar Sekarang</button>
</div>

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
<script type="text/javascript">
    document.getElementById('pay-button').addEventListener('click', function () {
                snap.pay('{{ $snap_token }}');

        // Memulai proses pembayaran
    });
</script>
@endsection
