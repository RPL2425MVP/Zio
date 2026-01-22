@extends('layouts.master')

@section('konten')
<div class="container" style="margin-top: 100px; height:100vh;">
    <div class="card">
        <h5 class="card-header">Invoice</h5>
        <div class="card-body">
            <h4 class="card-title">Keterangan</h4> 
            @foreach ($items as $item)               
                <div class="row g-0 text-center">
                    <div class="col-sm-3 col-md-3"><p><b>Nama Produk : </b></p></div>
                    <div class="col-sm-5 col-md-6"><p>{{$item->produk->nama_produk}}</p></div>
                </div>
                <div class="row g-0 text-center">
                    <div class="col-sm-0 col-md-3"><p><b>Harga Produk : </b></p></div>
                    <div class="col-sm-12 col-md-6"><p>{{$item->produk->harga}}</p></div>
                </div>
                <br>
            @endforeach
            <br>
            <a href="{{ route('produkList.show') }}" class="btn btn-primary">Kembali Belanja</a>
        </div>
    </div>  
</div>
@endsection