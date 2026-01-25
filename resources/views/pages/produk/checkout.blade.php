@extends('layouts.master')

@section('konten')
<div class="container" style="margin-top: 100px; height:100vh;">
    <h2>Konfirmasi Checkout</h2>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card p-4">
        <h5>Total yang Harus Dibayar:</h5>
        <h2 class="text-success">Rp{{ number_format($total, 0, ',', '.') }}</h2>
        <p class="text-muted">Pastikan data Anda sudah benar.</p>
        <form action="{{ route('checkout.proses') }}" method="POST">
            @csrf
            <a href="{{ url('/keranjang') }}" class="btn btn-secondary">Kembali</a>

            <button type="submit" class="btn btn-success">Konfirmasi & Bayar</button>
        </form>
    </div>
</div>
@endsection