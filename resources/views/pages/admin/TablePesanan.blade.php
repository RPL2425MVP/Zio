@extends('layoutsAdmin.master')

@section('konten')
<div class="container-fluid dashboard" style="width: 85rem;">
    <h3>List Pesanan Semua User</h3>
    <table class="table table-dark table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>User</th>
                <th>Tanggal</th>
                <th>Total</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @if($pesanan->isNotEmpty())
                @foreach ($pesanan as $item)
                    <tr>
                        <td>{{$item->id_transaksi}}</td>
                        <td>{{$item->user->nama}}</td>
                        <td>{{$item->tanggal_transaksi}}</td>
                        <td>{{$item->total_harga}}</td>
                        <td>{{$item->status}}</td>
                        <td>
                            <a href="{{ route('admin.pesanan.detail', $item->id_transaksi) }}" class="btn btn-success">Detail</a>
                            <a href="{{ route('admin.pesanan.edit-status', $item->id_transaksi) }}" class="btn btn-warning ">Edit Status</a>
                        </td>
                    </tr>
                @endforeach
            @else
                <p>Tidak ada detail transaksi.</p>
            @endif
        </tbody>
    </table>
</div>
@endsection