@extends('layoutsAdmin.master')

@section('konten')
<div class="container-fluid dashboard">
    <div class="card" style="width: 80rem;">
        <div class="card-header">
            Update Data Kategori
        </div>
        <div class="card-body">
            <form action="{{ route('tbJenis.update', $data->id_jenis) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="row">
                    <div class="col-sm-12">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Nama Jenis</label>
                            <input type="text" name="nama_jenis" class="form-control" value="{{$data->jenis}}">
                            @error('nama_jenis')
                                <div class="form-text text-danger">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="id_kategori" class="form-label">Kategori</label>
                        <select class="form-select" name="id_kategori" required>
                            <option value="">Pilih Kategori</option>
                            @foreach($listKat as $kategori)
                                <option value="{{ $kategori->id_kategori }}">
                                    {{ $kategori->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
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