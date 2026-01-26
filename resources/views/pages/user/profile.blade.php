@extends('layouts.master')
@section('konten')
<div class="container py-5" style="margin-top:100px;">   
        <div class="list-group" style="width: 40%; margin-left:30%;">
            <h3>Personal Info</h3>
            <br>
            <a href="{{route('edit.nama', 'nama')}}" class="list-group-item list-group-item-action list-group-item-light d-flex justify-content-between align-items-start">
                <span class="my-auto me-3 text-dark"><i class='bx  bx-user'></i></span>        
                <div class="ms-2 me-auto">
                <div class="fw-bold text-dark">Nama</div>
                {{$bio->nama}}
                </div>
            </a>
            <a href="{{route('edit.nama', 'email')}}" class="list-group-item list-group-item-action list-group-item-light d-flex justify-content-between align-items-start">
                <span class="my-auto me-3 text-dark"><i class='bx  bx-envelope'></i> </span>        
                <div class="ms-2 me-auto">
                <div class="fw-bold text-dark">Email</div>
                {{$bio->email}}
                </div>
            </a>
            <a href="{{route('edit.nama', 'no_telp')}}" class="list-group-item list-group-item-action list-group-item-light d-flex justify-content-between align-items-start">
                <span class="my-auto me-3 text-dark"><i class='bx  bx-phone'></i></span>        
                <div class="ms-2 me-auto">
                <div class="fw-bold text-dark">Telepon</div>
                {{$bio->no_telp}}
                </div>
            </a>
            <a href="{{route('profile.edit.lokasi')}}" class="list-group-item list-group-item-action list-group-item-light d-flex justify-content-between align-items-start">
                <span class="my-auto me-3 text-dark"><i class='bx  bx-location'></i></span>        
                <div class="ms-2 me-auto">
                <div class="fw-bold text-dark">Alamat</div>
                {{$bio->provinsi}}, {{$bio->kota}}, {{$bio->daerah}},
                </div>
            </a>
            <a href="{{route('edit.nama', 'kode_pos')}}" class="list-group-item list-group-item-action list-group-item-light d-flex justify-content-between align-items-start">
                <span class="my-auto me-3 text-dark"><i class='bx  bx-location'></i></span>        
                <div class="ms-2 me-auto">
                <div class="fw-bold text-dark">Kode Pos</div>
                {{$bio->kode_pos}}
                </div>
            </a>
        </div>
</div>
@endsection