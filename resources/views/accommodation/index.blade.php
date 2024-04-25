@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="{{ asset('assets/css/accommodation/index.css') }}" />

<div style="margin-top: 2rem;">
    <div id="intro-example" class="round p-5 text-center bg-image"
        style="background-image: url('{{ asset('assets/images/slider-image-acc.jpg') }}');;background-repeat: no-repeat; background-size: cover;">
        <div class="d-flex justify-content-center align-items-center h-100">
            <div class="text-white">
                <h1 class="text-left fw-bold mt-5">
                    <span style="color:#2980b9;">Znajdź</span>
                    Zakwaterowanie
                </h1>
                <div class="mt-5">Przeszukaj naszą bazę mieszkań i pokoi w całej Polsce</div>
            </div>
        </div>
    </div>
</div>

<div class="container my-5">
    <div class="d-flex justify-content-center">
        <form>
            <div class="d-flex">
                <div class="form-group mx-2">
                    <input type="name" class="form-control" aria-describedby="emailHelp"
                        placeholder="Słowo Kluczowe...">
                </div>
                <div class="form-group mx-2">
                    <input type="name" class="form-control" placeholder="Lokalizacja...">
                </div>
                <div class="mx-3">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection