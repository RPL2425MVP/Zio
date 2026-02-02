@extends('layoutsAdmin.master')

@section('konten')
<div class="container-fluid dashboard">
    <div class="card" style="width: 80rem;">
        <div class="card-header">
            Update Data Kategori
        </div>
        <div class="card-body">
            <form action="{{ route('tbKategori.update', $data->id_kategori) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="row">
                    <div class="col-sm-12">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Nama Kategori</label>
                            <input type="text" name="nama_kategori" class="form-control" value="{{$data->nama_kategori}}">
                            @error('nama_kategori')
                                <div class="form-text text-danger">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-5 mt-3">
                        <button type="submit" class="btn btn-primary">Update Data</button>
                        <button type="button" class="btn btn-danger">Batalkan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection