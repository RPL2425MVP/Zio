@extends('layoutsAdmin.master')

@section('konten')
<div class="container-fluid dashboard" style="width: 85rem;">
    <div class="mb-3">
        <a href="{{ route('tbProduk.create') }}" class="btn btn-success">Tambah Produk</a>
    </div>
    
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
            <!-- Modal Konfirmasi Hapus -->
            <div class="modal fade" id="hapus{{ $produk->id_produk }}" tabindex="-1" aria-labelledby="hapusLabel{{ $produk->id_produk }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="hapusLabel{{ $produk->id_produk }}">Konfirmasi Hapus</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Apakah Anda yakin ingin menghapus produk <strong>{{ $produk->nama_produk }}</strong>?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <form action="{{ route('tbProduk.destroy', $produk->id_produk) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @empty
                <p class="text-center">Tidak ada Produk</p>
            @endforelse
        </tbody>
    </table>
</div>
@endsection