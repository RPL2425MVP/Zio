@extends('layoutsAdmin.master')

@section('konten')
<div class="container-fluid dashboard">
    <div class="card" style="width: 80rem;">
        <div class="card-header">
            Update Data Produk
        </div>
        <div class="card-body">
            <form action="{{ route('tbProduk.update', $data->id_produk) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="row">
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Nama Produk</label>
                            <input type="text" name="nama_produk" class="form-control" value="{{$data->nama_produk}}">
                            @error('nama_produk')
                                <div class="form-text text-danger">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Harga Produk</label>
                            <input type="number" name="harga" class="form-control" value="{{$data->harga}}">
                            @error('harga')
                                <div class="form-text text-danger">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Jenis Produk</label>
                            <input type="text" name="jenis" class="form-control" value="{{$data->jenis}}">
                            @error('jenis')
                                <div class="form-text text-danger">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label>Kategori Produk</label>
                        <select name="id_kategori" class="form-control">
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($listKategori as $kat)
                                <option value="{{ $kat->id_kategori }}" {{ $kat->id_kategori == $data->id_kategori ? 'selected' : '' }}>
                                    {{ $kat->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_kategori')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Stok</label>
                            <input type="number" name="stok" class="form-control" value="{{$data->stok}}">
                            @error('stok')
                                <div class="form-text text-danger">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label>Foto Saat Ini</label>
                        @if($data->foto)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $data->foto->foto) }}" 
                                    alt="Foto Produk" 
                                    class="img-thumbnail" 
                                    style="max-height: 150px;">
                            </div>
                        @else
                            <p class="text-muted">Belum ada foto.</p>
                        @endif
                        <!-- Input upload foto baru -->
                        <label>Ganti Foto</label>
                        <input type="file" name="foto" class="form-control" accept="image/*">
                        @error('foto')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-sm-12">
                        <div class="form-floating">
                            <textarea class="form-control" name="deskripsi_product" placeholder="Leave a comment here" >{{$data->deskripsi}}</textarea>
                            <label for="floatingTextarea">Deskripsi Produk</label>
                            @error('deskripsi_product')
                                <div class="form-text text-danger">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6 mt-3">
                        <button type="submit" class="btn btn-primary">Update Data</button>
                        <button type="button" class="btn btn-danger">Batalkan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection