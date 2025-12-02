@extends('layoutsAdmin.master')

@section('konten')
<div class="container-fluid dashboard" style="width: 85rem;">
    <h3 class="mb-4">Tambah Produk Baru</h3>

    <form action="{{ route('tbProduk.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="nama_produk" class="form-label">Nama Produk</label>
            <input type="text" class="form-control" id="nama_produk" name="nama_produk" value="{{ old('nama_produk') }}" required>
        </div>

        <div class="mb-3">
            <label for="id_kategori" class="form-label">Kategori</label>
            <select class="form-select" name="id_kategori" required>
                <option value="">Pilih Kategori</option>
                @foreach($listKategori as $kategori)
                    <option value="{{ $kategori->id_kategori }}" {{ old('id_kategori') == $kategori->id_kategori ? 'selected' : '' }}>
                        {{ $kategori->nama_kategori }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="jenis" class="form-label">Jenis</label>
            <input type="text" class="form-control" name="jenis" value="{{ old('jenis') }}" required>
        </div>

        <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input type="number" class="form-control" name="harga" value="{{ old('harga') }}" step="0.01" required>
        </div>

        <div class="mb-3">
            <label for="stok" class="form-label">Stok</label>
            <input type="number" class="form-control" name="stok" value="{{ old('stok') }}" required>
        </div>

        <div class="mb-3">
            <label for="deskripsi_product" class="form-label">Deskripsi</label>
            <textarea class="form-control" name="deskripsi_product" rows="3">{{ old('deskripsi_product') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="foto" class="form-label">Foto Produk</label>
            <input class="form-control" type="file" name="foto" accept="image/*" required>
            @error('foto')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">Simpan Produk</button>
            <a href="{{ route('tbProduk.show') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection