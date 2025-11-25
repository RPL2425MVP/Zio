@extends('layoutsAdmin.master')

@section('konten')
<div class="container-fluid dashboard" style="width: 85rem;">
    <table class="table table-dark table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Gambar Produk</th>
                <th scope="col">Nama Produk</th>
                <th scope="col">Kategori</th>
                <th scope="col">Jenis</th>
                <th scope="col">Harga</th>
                <th scope="col">Stok</th>
                <th scope="col">Deskripsi</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
             @forelse ($dataProduk as $item => $produk )
            <tr>
                <th scope="row">{{$loop->iteration}}</th>
                <td style="width:70px;"><img src="{{ asset('storage/' . $produk->foto->foto) }}"
                    class="card-img-top"
                    alt="{{ $produk->nama_produk }}"
                    style="height: 10vh; width:70px; background-size: cover;"></td>
                <td>{{$produk->nama_produk}}</td>
                <td>{{$produk->kategori->nama_kategori}}</td>
                <td>{{$produk->jenis}}</td>
                <td>{{$produk->harga}}</td>
                <td>{{$produk->stok}}</td>
                <td>{{$produk->deskripsi}}</td>
                <td>
                    <a href="{{ route('tbProduk.edit', $produk->id_produk) }}" class="btn btn-warning">Edit</a>
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapus{{$produk->id_produk}}">
                    Delete
                    </button>
                </td>
            </tr>
            @empty
                <p class="text-center">Tidak ada Produk</p>
            @endforelse
            
        </tbody>
    </table>
</div>
@endsection