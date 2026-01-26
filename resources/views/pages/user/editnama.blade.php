@extends('layouts.master')

@section('konten')
<div class="container py-5" style="margin-top:100px;">
    <h3>Edit {{ ucfirst($field) }}</h3>
    <form action="{{ route('update.field', $field) }}" method="POST" >
        @csrf
        @method('PATCH') {{-- INI YANG BERUBAH! --}}

        <div class="mb-3">
            <label for="value" class="form-label">{{ ucfirst($field) }}</label>
            <input 
                type="text" 
                name="value" 
                class="form-control" 
                value="{{ old('value', $user->$field) }}" 
                required
            >
            @error('value')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('user.profile') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection