@extends('layouts.app')
<header>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <link rel="stylesheet" href="{{ asset('assets/css/accommodation/show.css') }}" />

    <title>{{$accommodation->title}} - {{env('APP_NAME')}}</title>
    <meta property="og:title" content="{{$accommodation->title}}">
    <meta property="og:description" content="{{ Str::limit($accommodation->description, 100)}}">
    <meta property="og:image"
        content="{{ asset('images/accommodation/main-photo/' . $accommodation->main_image_path) }}">
    <meta name="keywords" content="{{$accommodation->title}}, praca, oferta pracy, zatrudnienie">
</header>
@section('content')
<!-- Top -->
<div class="section">
    <div class="jumbotron jumbotron-fluid img img-fluid top"
        style="background-image: url('{{asset('assets/images/bg-info-home-3.png') }}'); background-repeat: no-repeat; background-size: cover;">
        <div class="container text-center">
            <h1 class="top-header fw-bold text-uppercase py-4">{{$data['label']['top']['top-header']}}</h1>
        </div>
    </div>
</div>

<!-- Main -->
<div class="row">
    <div class=" offset-2 col-md-6 bg-white my-5">
        <div class="offerts p-5">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a class="text-decoration-none"
                            href="{{ route('accommodations.index') }}">Strona
                            główna</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{$accommodation->slug}}</li>
                </ol>
            </nav>
            <h2 class="offerts-header">{{$accommodation->title}}</h2>
            <div class="d-flex justify-content-between">
                <p><i class="bi bi-geo-alt-fill text-danger"></i> <span
                        class="text-danger text-uppercase">Localizacja:</span>
                    {{$accommodation->country->country}},
                    {{$accommodation->state->state}},
                    {{$accommodation->city->city}}
                </p>
                <p><i class="bi bi-envelope-fill mx-1 text-info"></i><span
                        class="text-info text-uppercase">Email:</span>
                    {{$accommodation->email}}
                </p>
            </div>
            <div class="d-flex justify-content-between">
                <p><i class="bi bi-person-fill text-success"></i><span
                        class="text-success mx-1 text-uppercase">Kontakt:</span>
                    {{$accommodation->contact}}
                </p>
                <p><i class="bi bi-telephone-fill offers-color-oranger"></i>
                    <span class="text-uppercase offers-color-oranger">Telefon: </span>
                    {{$accommodation->phone_number}}
                </p>
            </div>
            <div class="d-flex justify-content-between">
                @if(isset($accommodation->price_buy))
                <p><i class="bi bi-cash-coin offers-color-brown"></i><span
                        class="mx-1 text-uppercase offers-color-brown">
                        Cena zakupu:</span>
                    {{$accommodation->price_buy}}
                    {{$accommodation->currency->currency}}
                </p>
                @endif
                @if(isset($accommodation->price_rent))
                <p><i class="bi bi-cash-coin offers-color-brown"></i><span
                        class="mx-1 text-uppercase offers-color-brown">Cena
                        wynajmu:</span>
                    {{$accommodation->price_rent}}
                    {{$accommodation->currency->currency}}
                </p>
                @endif
            </div>
            <p><i class="bi bi-calendar-event-fill text-primary"></i>
                <span class="mx-1 text-primary text-uppercase">Koniec oferty:</span>
                {{ \Carbon\Carbon::parse($accommodation->expiry)->format('d-m-Y') }}
            </p>
            @php
            $now = now();
            $expiry = $accommodation->expiry;
            $difference = $now->diffInDays($expiry);

            $totalDays = 30;
            $progressPercentage = min(100, ($difference / $totalDays) * 100);
            @endphp

            <div class="my-4">
                <div class="text-dark my-2 mx-1 text-uppercase">Do końca oferty pozostało: {{$difference}} dni.
                </div>
                <div class="progress mx-1">
                    <div class="progress-bar" role="progressbar" style="width:{{$progressPercentage}}%;"
                        aria-valuenow="{{$progressPercentage}}" aria-valuemin="0" aria-valuemax="100">
                        {{round($progressPercentage)}} %
                    </div>
                </div>
            </div>

            @if($accommodation->expiry <= now()) <div class="alert alert-warning" role="alert">
                Ta oferta pracy jest nieaktualna.
        </div>
        @endif

        <div class="my-3">
            @if($accommodation->photos()->count() > 0)
            <div class="d-flex justify-content-center w-70">
                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach($accommodation->photos as $key => $photo)
                        <div class="carousel-item {{$key == 0 ? 'active' : ''}}">
                            <img src="{{ asset('images/accommodation/photos/' . $photo->photo) }}" class="d-block w-70"
                                alt="{{ $photo->photo }}" style="max-height: 400px; object-fit: cover;">
                        </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
            @endif
        </div>

        @if(isset($accommodation->city->city))
        <!-- Lokalizacja -->
        <div class="my-5">
            <div class="text-uppercase fw-bold">Lokalizacja</div>
        </div>
        <div class="d-flex justify-content-center pb-5">
            <div id="map" style="height: 400px; width:700px;"></div>
        </div>
        <script>
            var map = L.map('map').setView([{{$accommodation->city->latitude}}, {{$accommodation->city->longitude}}], 13);
                                        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                                        }).addTo(map);
                                        
                                        L.marker([{{$accommodation->city->latitude}}, {{$accommodation->city->longitude}}]).addTo(map)
                                        .bindPopup('A pretty CSS popup.<br> Easily customizable.')
                                        .openPopup();
        </script>
        @endif

        <p>{!!$accommodation->description!!}</p>
    </div>
</div>

<div class="col-md-3 bg-white my-5 mx-4">
    <form class="py-3">
        Jego Avatar<br />
        Nazwa użytkownika do którego należy ogłoszenie
        <div class="text-uppercase fw-bold mx-4 my-4">Formularz kontaktowy</div>
        <hr class="mx-4 border-top border-4 border-dark">
        <div class="mb-3 mx-4">
            <input type="text" class="form-control" placeholder="Twoje imię">
        </div>
        <div class="mb-3 mx-4">
            <input type="email" class="form-control" placeholder="Twój email">
        </div>
        <div class="mb-3 mx-4">
            <input type="text" class="form-control" placeholder="Przedmiot">
        </div>
        <div class="mb-3 mx-4">
            <input type="text" class="form-control" placeholder="Wiadomość">
        </div>
        <div class="text-start">
            <a href="" class="btn btn-success text-uppercase mx-4">wyślij teraz</a>
        </div>
    </form>
</div>


<div class="offset-2 col-6 bg-white">
    <div class="text-center my-3 pt-5 mx-4 fw-bold h2 text-primary text-uppercase">
        powiązana oferta
    </div>
    <div class="my-4">
        <div class="card-deck mb-3 mx-3 border-0 bg-white py-3">
            @foreach($data['similar']['accommodationSimilar'] as $similar)
            <div class="card mb-3 border-0 bg-white" style="max-height: 200px;">
                <div class="row g-0">
                    @if($similar->main_image_path)
                    <div class="col-md-4 image-container">
                        <img src="{{asset('images/accommodation/main-photo/' . $similar->main_image_path)}}"
                            class="img-fluid rounded">
                        @else
                        <img src="{{asset('images/accommodation/default-images/acc.jpg/')}}" class="img-fluid rounded">
                        @endif
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <a href="{{ route('accommodations.show', ['accommodation' => $similar]) }}"
                                class="h5 card-title mx-1 text-decoration-none">
                                {{ Str::limit($similar->title,30) }}
                            </a>
                            <p class="card-text mx-1 my-3">
                                <i class="bi bi-briefcase-fill"></i>
                                Nazwa użytkownika
                            </p>
                            <p class="card-text mx-1">
                            <div class="d-flex offers-color-oranger"><i class="bi bi-geo-alt-fill mx-1"></i>
                                <div class="text-uppercase">lokalizacja: </div>
                                @if(isset($similar->country->country))
                                <a href="{{ route('accommodations.search', ['localisation' => $similar->country->country ]) }}"
                                    class="text-decoration-none mx-1">
                                    {{$similar->country->country}},
                                </a>
                                @endif
                                @if(isset($similar->state->state))
                                <a href="{{ route('accommodations.search', ['localisation' => $similar->state->state ]) }}"
                                    class="text-decoration-none">
                                    {{$similar->state->state}},
                                </a>
                                @endif
                                @if(isset($similar->city->city))
                                <a href="{{ route('accommodations.search', ['localisation' => $similar->city->city ]) }}"
                                    class="text-decoration-none mx-1">
                                    {{$similar->city->city}}
                                </a>
                                @endif
                            </div>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
</div>

@endsection