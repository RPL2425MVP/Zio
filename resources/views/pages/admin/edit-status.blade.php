@extends('layoutsAdmin.master')

@section('konten')
<div class="container-fluid dashboard">
    <h2>Edit Status Pesanan #{{ $transaksi->id_transaksi }}</h2>

    <form action="{{ route('admin.pesanan.update-status', $transaksi->id_transaksi) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="status" class="form-label">Status Saat Ini: <strong>{{ ucfirst($transaksi->status) }}</strong></label>
            <select name="status" id="status" class="form-select" required>
                <option value="">-- Pilih Status Baru --</option>
                @foreach ($statuses as $status)
                    <option value="{{ $status }}" {{ old('status', $transaksi->status) == $status ? 'selected' : '' }}>
                        {{ ucfirst(str_replace('_', ' ', $status)) }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection