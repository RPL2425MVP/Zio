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
            <button>shop now</button>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger">Logout</button>
            </form>
        </div>
    </div>
@endsection