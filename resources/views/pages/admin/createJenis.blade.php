@extends('layoutsAdmin.master')

@section('konten')
<div class="container-fluid dashboard" style="width: 85rem;">
    <h3 class="mb-4">Tambah Produk Baru</h3>

    <form action="{{ route('tbJenis.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="nama_produk" class="form-label">Nama Jenis</label>
            <input type="text" class="form-control" id="nama_jenis" name="nama_jenis" required>
        </div>
        <div class="mb-3">
            <label for="id_kategori" class="form-label">Kategori</label>
            <select class="form-select" name="id_kategori" required>
                <option value="">Pilih Kategori</option>
                @foreach($listKategori as $kategori)
                    <option value="{{ $kategori->id_kategori }}">
                        {{ $kategori->nama_kategori }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">Simpan Jenis</button>
            <a href="{{ route('admin.jenis.show') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection