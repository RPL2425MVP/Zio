@extends('layouts.master')
@section('konten')
<div class="container" style="margin-top:100px;">
    <div class="row">
        <!-- Daftar Produk -->
        <div class="col-md-9">
            @if($produkChunked->isEmpty())
                <p class="text-center">Tidak ada produk ditemukan.</p>
            @else
                @foreach($produkChunked as $chunk)
                    <div class="card-group mb-4">
                        @foreach($chunk as $produk)
                            <div class="card border-0">
                                <a href="{{ route('produk.show', $produk->id_produk) }}" class="text-decoration-none text-dark card-list">
                                    @if($produk->foto)
                                        <img src="{{ asset('storage/' . $produk->foto->foto) }}"
                                            class="card-img-top"
                                            alt="{{ $produk->nama_produk }}"
                                            style="height: 45vh; object-fit: cover;">
                                    @else
                                        <img src="{{ Vite::asset('resources/image/placeholder.jpg') }}"
                                            class="card-img-top"
                                            alt="No image"
                                            style="height: 45vh; object-fit: cover;">
                                    @endif
                                    <div class="card-body text-center">
                                        <h5 class="card-title">{{ $produk->nama_produk }}</h5>
                                        <p class="card-category text-secondary">{{ $produk->kategori->nama_kategori ?? 'Tanpa Kategori' }}</p>
                                        <p class="card-text fw-bold text-danger">
                                            Rp {{ number_format($produk->harga, 0, ',', '.') }}
                                        </p>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            @endif
        </div>

        <!-- Sidebar Filter -->
        <div class="col-md-3" style="border-left: 1px solid;">
            <h4 class="mb-3">Search By Category</h4>

            <form method="GET" id="filter-form">
                <!-- Daftar Semua Kategori sebagai Checkbox -->
                @foreach($categories as $cat)
                    <div class="form-check mb-2">
                        <input type="checkbox"
                            name="kategori[]"
                            value="{{ $cat->id_kategori }}"
                            id="cat-{{ $cat->id_kategori }}"
                            {{ in_array($cat->id_kategori, request('kategori', [])) ? 'checked' : '' }}
                            onchange="document.getElementById('filter-form').submit();">
                        <label for="cat-{{ $cat->id_kategori }}" class="form-check-label">
                            {{ $cat->nama_kategori }}
                        </label>
                    </div>
                @endforeach           
            </form>
        </div>
    </div>
</div>
@endsection