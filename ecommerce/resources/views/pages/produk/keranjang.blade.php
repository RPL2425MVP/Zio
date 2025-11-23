@extends('layouts.master')

@section('konten')
<div class="container" style="margin-top: 100px; height:100vh;">
    <h2>Keranjang Belanja</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($keranjangItems->isEmpty())
        <div class="alert alert-info">Keranjang belanja kamu masih kosong.</div>
        <a href="{{ url('/index') }}" class="btn btn-primary">Lihat Produk</a>
    @else
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Gambar</th>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Total</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($keranjangItems as $item)
                    <tr>
                        <td>
                               @if($item->produk->foto)
                                    <img src="{{ asset('storage/' . $item->produk->foto->foto) }}"
                                        width="60" class="rounded"
                                        alt="{{ $item->produk->nama_produk }}">
                                @else
                                    <div class="bg-light d-flex justify-content-center align-items-center" style="width:60px; height:60px;">
                                        <span class="text-muted">No Image</span>
                                    </div>
                                @endif
                        </td>
                        <td>{{ $item->produk->nama_produk }}</td>
                        <td>Rp{{ number_format($item->produk->harga, 0, ',', '.') }}</td>
                        <td>{{ $item->jumlah }}</td>
                        <td>Rp{{ number_format($item->produk->harga * $item->jumlah, 0, ',', '.') }}</td>
                        <td>
                            <form action="{{ route('keranjang.ubah.qty') }}" method="POST" class="d-flex align-items-center">
                                @csrf
                                <input type="hidden" name="id_keranjang" value="{{ $item->id_keranjang }}">

                                <!-- Tombol Kurangi -->
                                <button type="submit" 
                                        name="aksi" 
                                        value="kurangi"
                                        class="btn btn-sm btn-outline-secondary"
                                        title="Kurangi jumlah">
                                    -
                                </button>

                                <!-- Jumlah -->
                                <span class="mx-2">{{ $item->jumlah }}</span>

                                <!-- Tombol Tambah -->
                                <button type="submit" 
                                        name="aksi" 
                                        value="tambah"
                                        class="btn btn-sm btn-outline-secondary"
                                        title="Tambah jumlah"
                                        {{ $item->jumlah >= $item->produk->stok ? 'disabled' : '' }}>
                                    +
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-between align-items-center mt-4">
            <h4>Total: <strong>Rp{{ number_format($total, 0, ',', '.') }}</strong></h4>
            <div>
                <a href="{{ url('/index') }}" class="btn btn-secondary">Lanjut Belanja</a>
                <button class="btn btn-primary">Lanjut ke Checkout</button>
            </div>
        </div>
    @endif
</div>
@endsection