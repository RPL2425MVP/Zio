@extends('layoutsAdmin.master')

@section('konten')
<div class="container-fluid dashboard" style="width: 85rem;">
    <h3>Isi Keranjang Semua User</h3>
    <table class="table table-dark table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>User</th>
                <th>Produk</th>
                <th>Jumlah</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($keranjangItems as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->user->nama ?? 'User dihapus' }}</td>
                <td>{{ $item->produk->nama_produk ?? 'Produk dihapus' }}</td>
                <td>{{ $item->jumlah }}</td>
                <td>{{ $item->tanggal_ditambahkan ?? '-' }}</td>
                <td>
                    <form action="{{ route('admin.keranjang.destroy', $item->id_keranjang) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection