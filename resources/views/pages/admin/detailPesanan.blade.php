@extends('layoutsAdmin.master')

@section('konten')
<div class="container-fluid dashboard">
    <h2>Detail Pesanan #{{ $pesanan->id_transaksi }}</h2>
    
    <p><strong>Tanggal:</strong> {{ $pesanan->tanggal_transaksi }}</p>
    <p><strong>Status:</strong> {{ $pesanan->status }}</p>
    <p><strong>Total:</strong> Rp{{ number_format($pesanan->total_harga, 0, ',', '.') }}</p>
    <p><strong>Alamat Pembeli:</strong> {{ $pesanan->user->provinsi }}, {{ $pesanan->user->kota }}, {{ $pesanan->user->daerah }}</p>
    <p><strong>No Telp. Pembeli:</strong> {{ $pesanan->user->no_telp }}</p>
    <ol class="list-group list-group-numbered">
        @foreach ($pesanan->detail as $detail) <!-- Loop di relasi detail -->
            <li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <div class="fw-bold">{{ $detail->produk ? $detail->produk->nama_produk : 'Produk tidak ditemukan' }}</div>
                    <small>Jumlah: {{ $detail->jumlah }} | Harga: Rp{{ number_format($detail->harga_satuan, 0, ',', '.') }}</small>
                </div>
                <span class="badge text-bg-primary rounded-pill">{{ $detail->jumlah }}</span>
            </li>
        @endforeach
    </ol>

    <br>
    <a href="{{ route('admin.pesanan') }}" class="btn btn-secondary">Kembali ke Daftar Pesanan</a>
</div>
@endsection