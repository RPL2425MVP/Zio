@extends('layouts.master')
<style>
@media print {
    .no-print {
        display: none !important;
    }
}
</style>
@section('konten')
<div class="container" style="margin-top: 100px; height:100vh;">
    <div class="card">
        <h5 class="card-header">Invoice #{{ $transaksi->id_transaksi }}</h5>
        <div class="card-body">
            <p><strong>Total:</strong> Rp{{ number_format($transaksi->total_harga, 0, ',', '.') }}</p>
            <p><strong>Tanggal:</strong> {{ $transaksi->tanggal_transaksi }}</p>
            <p><strong>Status:</strong> {{ $transaksi->status }}</p>

            <h5>Detail Produk</h5>
            @if($transaksi->detail->isNotEmpty())
                @foreach ($transaksi->detail as $detail)
                    <div class="row g-0 mb-3">
                        <div class="col-md-6">
                            <p><b>Nama Produk:</b> {{ $detail->produk ? $detail->produk->nama_produk : 'Produk tidak ditemukan' }}</p>
                        </div>
                        <div class="col-md-3">
                            <p><b>Jumlah:</b> {{ $detail->jumlah }}</p>
                        </div>
                        <div class="col-md-3">
                            <p><b>Harga:</b> Rp{{ number_format($detail->harga_satuan, 0, ',', '.') }}</p>
                        </div>
                    </div>
                @endforeach
            @else
                <p>Tidak ada detail transaksi.</p>
            @endif

            <br>
            <div class="d-flex gap-2 no-print">
                <a href="{{ route('produkList.show') }}" class="btn btn-secondary">Kembali Belanja</a>
                <button onclick="window.print()" class="btn btn-info">🖨️ Print</button>
                <a href="{{ route('checkout.download-pdf', $transaksi->id_transaksi) }}" class="btn btn-danger">📥 Download PDF</a>
            </div>
        </div>
    </div>  
</div>
@endsection