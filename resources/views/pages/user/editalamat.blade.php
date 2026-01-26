@extends('layouts.master')

@section('konten')
<div class="container py-5" style="margin-top:100px;">
    <h4>Edit Alamat</h4>
    <form action="{{ route('profile.update.alamat') }}" method="POST">
        @csrf
        @method('PATCH')

        <div class="mb-3">
            <label for="provinsi" class="form-label">Provinsi</label>
            <input type="text" name="provinsi" class="form-control" value="{{ old('provinsi', $user->provinsi) }}" required>
            @error('provinsi')<div class="text-danger">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label for="kota" class="form-label">Kota/Kabupaten</label>
            <input type="text" name="kota" class="form-control" value="{{ old('kota', $user->kota) }}" required>
            @error('kota')<div class="text-danger">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label for="daerah" class="form-label">Kecamatan / Kelurahan / Jalan</label>
            <textarea name="daerah" class="form-control" rows="3" required>{{ old('daerah', $user->daerah) }}</textarea>
            @error('daerah')<div class="text-danger">{{ $message }}</div>@enderror
        </div>

        <button type="submit" class="btn btn-primary">Simpan Alamat</button>
        <a href="{{ route('user.profile') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection