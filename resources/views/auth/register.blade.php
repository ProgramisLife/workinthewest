@extends('layouts.app')

<link rel="stylesheet" href="{{ asset('assets/css/auth/register.css') }}" />

@section('content')
<!-- Top -->
<div class="jumbotron jumbotron-fluid top img img-fluid"
    style="background-image: url('{{asset('assets/images/bg-info-home-3.png') }}'); background-repeat: no-repeat; background-size: cover;">
    <div class="container text-center">
        <h1 class="top-header fw-bold text-uppercase py-5">{{$data['label']['register-header']}}</h1>
    </div>
</div>
<main>
    <section>
        <div class="container">
            <div class="col-md-6 bg-white my-5 mx-auto p-5">
                <ul class="nav nav-pills justify-content-center flex-column flex-sm-row mb-5">
                    <li class="nav-item">
                        <a class="nav-link text-uppercase px-3 rounded-3 {{ $data['activeTab'] == 'employee' ? 'active' : '' }}"
                            id="employee-tab" data-bs-toggle="pill" href="#employee">{{$data['label']['employee']}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-uppercase px-3 rounded-3 {{ $data['activeTab'] == 'employer' ? 'active' : '' }}"
                            id="employer-tab" data-bs-toggle="pill" href="#employer">{{$data['label']['employer']}}</a>
                    </li>
                </ul>
                <div class="tab-content my-3">
                    <div class="tab-pane fade {{ $data['activeTab'] == 'employee' ? 'active show' : '' }}"
                        id="employee">
                        <form action="{{ route('employee.registerStore') }}" method="POST">
                            @csrf
                            <div class="form-group my-2">
                                <label class="text-uppercase my-1 register-text"
                                    for="username">{{$data['label']['username']}}</label>
                                <input type="text" class="form-control @error('username') is-invalid @enderror"
                                    id="username" name="username" placeholder="Wpisz twoją nazwę użytkownika"
                                    value="{{ old('username') }}">
                                @error('username')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group my-2">
                                <label class="text-uppercase my-1 register-text"
                                    for="email">{{$data['label']['email']}}</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                    name="email" aria-describedby="emailHelp" placeholder="Wprowadź swój email"
                                    value="{{ old('email') }}">
                                @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group my-2">
                                <label class="text-uppercase my-1 register-text"
                                    for="password">{{$data['label']['password']}}</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    id="password" placeholder="Wprowadź hasło." name="password">
                                @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group my-2">
                                <label class="text-uppercase my-1 register-text"
                                    for="password_confirmation">{{$data['label']['confirm_password']}}</label>
                                <input type="password"
                                    class="form-control @error('password_confirmation') is-invalid @enderror"
                                    id="password_confirmation" name="password_confirmation"
                                    placeholder="Potwierdź hasło.">
                                @error('password_confirmation')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-check my-2">
                                <input class="form-check-input" type="checkbox" value="" id="regulamin">
                                <label class="form-check-label" for="regulamin">
                                    {{$data['label']['acceptregulamin']}}
                                    <a class="text-decoration-none"
                                        href="{{route('regulamin')}}">{{$data['label']['regulamin']}}</a>
                                </label>
                            </div>
                            <button type="submit" class="btn-main text-uppercase my-4">
                                {{$data['label']['register']}}
                            </button>
                        </form>
                    </div>
                </div>
                <div class="tab-content my-3">
                    <div class="tab-pane fade {{ $data['activeTab'] == 'employer' ? 'active show' : '' }}"
                        id="employer">
                        <form action="{{ route('employers.registerStore') }}" method="POST">
                            @csrf
                            <div class="form-group my-2">
                                <label class="text-uppercase my-1 register-text"
                                    for="username">{{$data['label']['username']}}</label>
                                <input type="text" class="form-control @error('username') is-invalid @enderror"
                                    id="username" name="username" placeholder="Wpisz twoją nazwę użytkownika"
                                    value="{{ old('username') }}">
                                @error('username')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group my-2">
                                <label class="text-uppercase my-1 register-text"
                                    for="email">{{$data['label']['email']}}</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                    name="email" placeholder="Wprowadź swój email" value="{{ old('email') }}">
                                @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group my-2">
                                <label class="text-uppercase my-1 register-text"
                                    for="password">{{$data['label']['password']}}</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    id="password" name="password" placeholder="Wprowadź hasło.">
                                @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group my-2">
                                <label class="text-uppercase my-1 register-text"
                                    for="password_confirmation">{{$data['label']['confirm_password']}}</label>
                                <input type="password"
                                    class="form-control @error('password_confirmation') is-invalid @enderror"
                                    id="password_confirmation" name="password_confirmation"
                                    placeholder="Potwierdź hasło.">
                                @error('password_confirmation')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-check my-2">
                                <input class="form-check-input" type="checkbox" value="" id="regulamin">
                                <label class="form-check-label" for="regulamin">
                                    {{$data['label']['acceptregulamin']}}
                                    <a class="text-decoration-none"
                                        href="{{route('regulamin')}}">{{$data['label']['regulamin']}}</a>
                                </label>
                            </div>
                            <button type="submit" class="btn-main text-uppercase my-4">
                                {{$data['label']['register']}}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @if ($errors->has('statute'))
        <div class="alert alert-danger" role="alert">
            {{ $errors->first('statute') }}
        </div>
        @endif
    </section>
</main>
@endsection