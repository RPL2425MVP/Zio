@extends('layouts.master') <!-- Sesuaikan dengan layout-mu -->

@section('konten')
<div class="container" style="margin-top:100px;">
    <!-- Detail Produk Utama -->
    <div class="row mb-5">
        <!-- Gambar -->
        <div class="col-md-9" style="width: 50rem;">
            @if($produk->foto)
                <img src="{{ asset('storage/' . $produk->foto->foto) }}"
                     class="img-fluid rounded shadow"
                     alt="{{ $produk->nama }}"
                     style="max-height: 500px; object-fit: cover; width:100%;">
            @else
                <div class="bg-light d-flex align-items-center justify-content-center"
                     style="height: 500px; border: 1px solid #eee;">
                    <span class="text-muted">No Image</span>
                </div>
            @endif
        </div>

        <!-- Info Produk -->
        <div class="col-md-3">
            <h1 class="fw-bold">{{ $produk->nama_produk }}</h1>
            <p class="text-muted">Kategori: {{ $produk->kategori?->nama_kategori ?? '—' }}</p>

            <h2 class="text-secondary fw-bold mt-3">Rp{{ number_format($produk->harga, 0, ',', '.') }}</h2>

            <p class="mt-3">{{ $produk->deskripsi }}</p>

            <div class="mt-4">
                <p><strong>Stok Tersedia:</strong> {{ $produk->stok }} pcs</p>

                <form action="/keranjang/tambah/{{$produk->id_produk}}" method="POST" class="mt-3">
                    @csrf
                    <div class="input-group mb-3" style="max-width: 200px;">
                        <span class="input-group-text">Jumlah</span>
                        <input type="number" name="jumlah" value="1" min="1" max="{{ $produk->stok }}" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-secondary btn-lg">Tambah ke Keranjang</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Rekomendasi Produk -->
    @if($rekomendasi->isNotEmpty())
    <div class="row mt-5">
        <div class="col-12">
            <h3>Produk Serupa</h3>
            <div class="row g-3 mt-2">
                @foreach($rekomendasi as $item)
                <div class="col-6 col-md-3">
                    <a href="{{ route('produk.show', $item->id_produk) }}" class="text-decoration-none text-dark">
                        <div class="card border-0 shadow-sm h-100">
                            @if($item->foto)
                                <img src="{{ asset('storage/' . $item->foto->foto) }}"
                                     class="card-img-top" alt="{{ $item->nama_produk }}"
                                     style="height: 180px; object-fit: cover;">
                            @else
                                <div class="bg-light" style="height: 180px;"></div>
                            @endif
                            <div class="card-body text-center p-2">
                                <h6 class="card-title small">{{ $item->nama_produk }}</h6>
                                <p class="text-primary fw-bold mb-0">Rp{{ number_format($item->harga, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif
</div>
@endsection