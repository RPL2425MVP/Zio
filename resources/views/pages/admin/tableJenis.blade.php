@extends('layoutsAdmin.master')

@section('konten')
<div class="container-fluid dashboard" style="width: 85rem;">
    <div class="mb-3">
        <a href="{{ route('tbJenis.create') }}" class="btn btn-success">Tambah Jenis</a>
    </div>
    
    <table class="table table-dark table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Jenis</th>
                <th scope="col">Kategori</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($listjenis as $produk)
                <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td>{{$produk->jenis}}</td>
                    <td>{{$produk->kategori->nama_kategori}}</td>
                    <td>
                        <a href="{{ route('tbJenis.edit', $produk->id_jenis) }}" class="btn btn-warning">Edit</a>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapus{{$produk->id_jenis}}">
                            Delete
                        </button>
                    </td>
                </tr>
                <!-- Modal Konfirmasi Hapus -->
                <div class="modal fade" id="hapus{{ $produk->id_jenis }}" tabindex="-1" aria-labelledby="hapusLabel{{ $produk->id_jenis }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="hapusLabel{{ $produk->id_jenis }}">Konfirmasi Hapus</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Apakah Anda yakin ingin menghapus produk <strong>{{ $produk->jenis}}</strong>?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <form action="{{ route('tbJenis.destroy', $produk->id_jenis) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center">Tidak ada Jenis</p>
            @endforelse
        </tbody>
    </table>
</div>
@endsection 