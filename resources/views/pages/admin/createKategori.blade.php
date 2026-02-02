@extends('layoutsAdmin.master')

@section('konten')
<div class="container-fluid dashboard" style="width: 85rem;">
    <h3 class="mb-4">Tambah Produk Baru</h3>

    <form action="{{ route('tbKategori.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="nama_produk" class="form-label">Nama Kategori</label>
            <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" required>
        </div>
        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">Simpan Kategori</button>
            <a href="{{ route('admin.kategori.show') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection