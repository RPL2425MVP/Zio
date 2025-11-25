@extends('layouts.master')
@section('konten')
    <div class="container-fluid banner">
    {{-- isi konten --}}
        <div class="container isi d-flex">
            <div class="text">
                <h3>Your Cozy Era</h3>
                <p>Get peak comfy-chic
                    with new winter essentials.
                </p>
            </div>
            <div class="form-input">
                <form action="/register" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                            </div>
                        </div>
                        
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Nama</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" name="nama" aria-describedby="emailHelp">
                                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">No Telp</label>
                                    <input type="number" name="no_telp" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                                </div>
                            </div>
                        
                        <div class="col-sm-12">
                            <div class="mb-2">
                                <label for="exampleInputEmail1" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                <div id="emailHelp" class="form-text"></div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-2">
                                <label for="exampleInputEmail1" class="form-label">Provinsi</label>
                                <input type="text" name="provinsi" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                <div id="emailHelp" class="form-text"></div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-2">
                                <label for="exampleInputEmail1" class="form-label">Kota</label>
                                <input type="text" name="kota" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                <div id="emailHelp" class="form-text"></div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-2">
                                <label for="exampleInputEmail1" class="form-label">Daerah</label>
                                <input type="text" name="daerah" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                <div id="emailHelp" class="form-text"></div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-2">
                                <label for="exampleInputEmail1" class="form-label">Kode Pos</label>
                                <input type="text" name="kode_pos" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                <div id="emailHelp" class="form-text"></div>
                            </div>
                        </div>
                        <div class="mb-3 ps-5 form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Check me out</label>
                        </div>
                    </div>
                        <button type="submit" class="btn btn-dark">Submit</button>
                </form>
            </div>    
        </div>
    </div>
@endsection