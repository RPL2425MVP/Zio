@extends('layouts.master')

@section('konten')
<div class="container" style="margin-top: 100px;">
    <h2>Pesanan</h2>
    <ol class="list-group list-group-numbered mt-5">
        @foreach($pesanan as $transaksi)
            @foreach($transaksi->detail as $detail)
                <a href="" class="mb-3">
                    <li class="list-group-item d-flex justify-content-between align-items-start w-25">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold">{{ $detail->produk->nama_produk }}</div>
                            <p>Jumlah: {{ $detail->jumlah }}</p>
                            Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }} 
                        </div>
                    </li>
                </a>
            @endforeach
        @endforeach
    </ol>
</div>
@endsection