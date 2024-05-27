@extends('layouts.app')

@section('title', 'Zarejestruj się jako pracodawca')

@section('content')

<head>
    <link rel="stylesheet" href="{{ asset('assets/css/employer/register.css') }}" />
</head>

<!-- -->
<div class="jumbotron jumbotron-fluid img img-fluid"
    style="background-image: url('{{asset('assets/images/bg-info-home-3.png') }}'); background-repeat: no-repeat; background-size: cover;">
    <div class="container text-center">
        <h1 class="fw-bold text-uppercase py-5 text-white">{{$data['label']['top']['register']}}</h1>
    </div>
</div>

<div class="container mt-5">
    <div class="col-md-6 bg-white mx-auto p-5">
        <h2 class="d-flex justify-content-center mb-4">Rejestracja pracodawcy</h2>
        <form action="{{ route('employers.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="username"
                    class="form-label text-uppercase main-color">{{$data['label']['register-forms']['user-name']}}
                </label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="bi bi-person-fill"></i></span>
                    </div>
                    <input type="text" name="username" class="form-control" id="username" aria-describedby="username">
                </div>
            </div>
            <div class="mb-3">
                <label for="email"
                    class="form-label text-uppercase main-color">{{$data['label']['register-forms']['email']}}</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">
                            <i class="bi bi-envelope"></i>
                        </span>
                    </div>
                    <input type="email" name="email" class="form-control" id="email" aria-describedby="email">
                </div>
            </div>
            <div class="mb-3">
                <label for="companyname"
                    class="form-label text-uppercase main-color">{{$data['label']['register-forms']['companyname']}}</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">
                            <i class="bi bi-person-vcard"></i>
                        </span>
                    </div>
                    <input type="text" name="companyname" class="form-control" id="companyname"
                        aria-describedby="companyname">
                </div>
            </div>
            <div class="mb-3">
                <label for="password"
                    class="form-label text-uppercase main-color">{{$data['label']['register-forms']['password']}}
                </label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">
                            <i class="bi bi-key-fill"></i>
                        </span>
                    </div>
                    <input type="password" name="password" class="form-control" id="password">
                </div>
            </div>
            <div class="mb-3">
                <label for="password_confirmation"
                    class="form-label text-uppercase main-color">{{$data['label']['register-forms']['password-repeat']}}</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">
                            <i class="bi bi-key-fill"></i>
                        </span>
                    </div>
                    <input type="password" name="password_confirmation" class="form-control" id="password_confirmation">
                </div>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="statute" name="statute">
                <label class="form-check-label" for="statute">
                    {{ $data['label']['register-forms']['statute'] }}
                    {{ env('APP_NAME', 'Workinthewest') }}.
                </label>
            </div>
            <div class="d-grid gap-2">
                <button type="submit" class="btn second-bg-color text-white text-uppercase">ZAREJESTRUJ SIĘ</button>
            </div>

            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

        </form>
    </div>
</div>

@endsection