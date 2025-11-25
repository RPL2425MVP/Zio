@extends('layouts.master')
@section('konten')
    <div class="container-fluid img-home">
        <div class="text-gambar">
            <h2>Your Cozy Era</h2>
            <br>
            <p>
                Get peak comfy-chic
                with new winter essentials.
            </p>
            <a href="#kategori" class="">shop now</a>
        </div>
    </div>
    <div class="kategori" id="kategori">
        <h4 class="text-center mt-5">Shop By Category</h4>
        <div class="card-group my-5 card-kategori">
            <div class="card border-0">
                <a href="">
                    <img src="{{ asset('storage/foto_produk/shirt.webp') }}" class="card-img-top">
                    <div class="card-body text-center">
                        <h5 class="card-title">SHIRT</h5>
                    </div>
                </a>
            </div>
            <div class="card border-0">
                <a href="">
                    <img src="{{ asset('storage/foto_produk/topi.webp') }}" class="card-img-top">
                    <div class="card-body text-center">
                        <h5 class="card-title">HAT</h5>
                    </div>
                </a>
            </div>
            <div class="card border-0">
                <a href="">
                    <img src="{{ asset('storage/foto_produk/pants.webp') }}" class="card-img-top">
                    <div class="card-body text-center">
                        <h5 class="card-title">PANTS</h5>
                    </div>
                </a>
            </div>
            <div class="card border-0">
                <a href="">
                    <img src="{{ asset('storage/foto_produk/sweater.webp') }}" class="card-img-top">
                    <div class="card-body text-center">
                        <h5 class="card-title">SWEATERS</h5>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <hr>
    <div class="rekomend-produk mt-5">    
        <h4 class="text-center mb-4">FaZhion Recomendation</h4>
        <p class="text-center text-muted mb-4">Beautifully Functional. Purposefully Designed. Consciously Crafted.</p>
        
        @if($produkChunked->isEmpty())
            <p class="text-center">Tidak ada produk tersedia.</p>
        @else
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                <!-- Indicators -->
                <div class="carousel-indicators">
                    @foreach($produkChunked as $index => $chunk)
                        <button type="button" 
                                data-bs-target="#carouselExampleIndicators" 
                                data-bs-slide-to="{{ $index }}" 
                                @if($index == 0) class="active" aria-current="true" @endif 
                                aria-label="Slide {{ $index + 1 }}">
                        </button>
                    @endforeach
                </div>

                <!-- Carousel Inner -->
                <div class="carousel-inner">
                    @foreach($produkChunked as $index => $chunk)
                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                            <div class="card-group my-5">
                                @foreach($chunk as $produk)
                                    <div class="card border-0">
                                        <a href="{{ route('produk.show', $produk->id_produk) }}" class="text-decoration-none text-dark card-produk">
                                            @if($produk->foto && $produk->foto->foto)
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
                                                <p class="card-category text-secondary">{{$produk->kategori->nama_kategori}}</p>
                                                <p class="card-text fw-bold text-danger">
                                                    Rp {{ number_format($produk->harga, 0, ',', '.') }}
                                                </p>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Controls -->
                @if($produkChunked->count() > 1)
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                @endif
            </div>
        @endif
    </div>
@endsection