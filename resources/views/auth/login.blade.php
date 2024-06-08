@extends('layouts.app')

<link rel="stylesheet" href="{{ asset('assets/css/auth/login.css') }}" />

@section('content')
<!-- Top -->
<div class="jumbotron jumbotron-fluid top img img-fluid"
    style="background-image: url('{{asset('assets/images/bg-info-home-3.png') }}'); background-repeat: no-repeat; background-size: cover;">
    <div class="container text-center">
        <h1 class="top-header fw-bold text-uppercase py-5">{{$data['label']['login']}}</h1>
    </div>
</div>
<div class="container my-5 login">
    <form class="col-md-7 mx-auto bg-white border-2 p-5" action="{{ route('authentication') }}" method="POST">
        @csrf
        <div class="form-group">
            <label class="login-text text-uppercase py-2" for="email">{{ $data['label']['email'] }}</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                aria-describedby="emailHelp" placeholder="Wprowadź swój adres e-mail" name="email"
                value="{{ old('email') }}">
            @error('email')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="form-group my-3">
            <label class="login-text text-uppercase py-2 @error('password') is-invalid @enderror"
                for="password">{{ $data['label']['password'] }}</label>
            <input type="password" class="form-control" id="password" placeholder="Wprowadź hasło" name="password">
            @error('password')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="d-flex justify-content-center">
            <button type="submit" class="btn-main text-uppercase mt-3">Login</button>
        </div>
        <div class="d-flex justify-content-between">
            <div class="form-group mt-3">
                <a class="text-decoration-none" href="{{ route('register') }}">{{ $data['label']['dontremember'] }}</a>
            </div>
            <div class="form-group mt-3">
                <div class="d-flex">
                    <p>Czy posiadasz konto? </p>
                    <a class="text-decoration-none px-2"
                        href="{{ route('register') }}">{{ $data['label']['register'] }}</a>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection