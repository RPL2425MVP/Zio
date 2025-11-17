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
            <div class="form-input mt-5">
                <form action="/login" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Email address</label>
                                <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                            </div>
                        </div>                                               
                        <div class="col-sm-12">
                            <div class="mb-2">
                                <label for="exampleInputEmail1" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                            </div>
                        </div>
                    </div>
                        <p>Dont Have Account? <a href="/register" class="text-primary">Sign Up</a></p>
                        <button type="submit" class="btn btn-dark">Submit</button>
                </form>
            </div>    
        </div>
    </div>
@endsection