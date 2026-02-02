@extends('layoutsAdmin.master')

@section('konten')
<div class="container-fluid dashboard" style="width: 85rem;">
    <div class="mb-3">
        <a href="{{ route('tbKategori.create') }}" class="btn btn-success">Tambah Kategori</a>
    </div>
    
    <table class="table table-dark table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Kategori</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
             @forelse ($kategori as $produk)
            <tr>
                <th scope="row">{{$loop->iteration}}</th>
                <td>{{$produk->nama_kategori}}</td>
                <td>
                    <a href="{{ route('tbKategori.edit', $produk->id_kategori) }}" class="btn btn-warning">Edit</a>
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapus{{$produk->id_kategori}}">
                        Delete
                    </button>
                </td>
            </tr>
            <!-- Modal Konfirmasi Hapus -->
            <div class="modal fade" id="hapus{{ $produk->id_kategori }}" tabindex="-1" aria-labelledby="hapusLabel{{ $produk->id_kategori }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="hapusLabel{{ $produk->id_kategori }}">Konfirmasi Hapus</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Apakah Anda yakin ingin menghapus produk <strong>{{ $produk->nama_kategori }}</strong>?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <form action="{{ route('tbKategori.destroy', $produk->id_kategori) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @empty
                <p class="text-center">Tidak ada Kategori</p>
            @endforelse
        </tbody>
    </table>
</div>
@endsection 