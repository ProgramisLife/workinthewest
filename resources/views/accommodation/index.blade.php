@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="{{ asset('assets/css/accommodation/index.css') }}" />

<div style="margin-top: 2rem;">
    <div class="round p-5 text-center bg-image"
        style="background-image: url('{{ asset('assets/images/slider-image-acc.jpg') }}');background-repeat: no-repeat; background-size: cover;">
        <div class="d-flex justify-content-center align-items-center h-100">
            <div class="text-white">
                <div class="h1 text-left fw-bold mt-5">
                    <span class="mx-2 image-header-blue">Znajdź</span>
                    <span class="image-header-white">Zakwaterowanie</span>
                </div>
                <div class="mt-5 image-p">Przeszukaj naszą bazę mieszkań i pokoi w całej Polsce</div>
            </div>
        </div>
    </div>
</div>
<div class="container mx-5 my-5">
    <form method="POST" action="{{ route('accommodation.search') }}">
        @csrf
        <div class="form-outline mb-4" data-mdb-input-init>
            <div class="d-flex bg-white border border-2 p-5">
                <input type="search" class="form-control mx-2" placeholder="Słowo Kluczowe...">
                <input type="search" class="form-control" placeholder="Lokalizacja...">
                <div class="mx-3 d-flex align-items-center">
                    <button type="submit" class="btn btn-primary d-flex align-items-center">
                        <i class="bi bi-search"></i>
                        <span class="margin">Szukaj</span>
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="container">
    <div class="row py-5">
        <div class="col-lg-10 offset-1">
            <div class="row">
                <ul class="nav nav-pills nav-justified my-3 justify-content-center" id="pills-tab">
                    <li class="nav-item">
                        <a class="nav-text nav-link active text-uppercase" id="new-tab" data-bs-toggle="pill"
                            href="#new">
                            {{$data['label']['newest']}}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-text nav-link text-uppercase" id="featured-tab" data-bs-toggle="pill"
                            href="#featured">
                            {{$data['label']['featured']}}
                        </a>
                    </li>
                </ul>
                <div class="row">
                    <div class="tab-content my-3">
                        <div class="tab-pane fade show active" id="new">
                            <div class="row">
                                @forelse($data['accommodation']['news'] as $new)
                                <div class="col-md-6">
                                    <div class="card mb-3" style="max-width: 540px;">
                                        <div class="row g-0">
                                            <div class="d-flex justify-content-between">
                                                <div class="mx-2 my-2">
                                                    <a href="{{ route('accommodation.show', ['accommodation' => $new]) }}"
                                                        class="text-decoration-none">
                                                        <h2 class="card-title">
                                                            {{ Str::limit($new->title, 25) }}
                                                        </h2>
                                                    </a>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                @if($new->main_image_path)
                                                <div class="mx-1 my-3 image-container">
                                                    <img src="{{asset('images/accommodation/main-photo/' . $new->main_image_path)}}"
                                                        class="img-fluid rounded" alt="...">
                                                </div>
                                                @else
                                                <div class="mx-1 my-3 image-container">
                                                    <img src="{{asset('images/accommodation/default-images//')}}"
                                                        class="img-fluid rounded" alt="...">
                                                    <!-- Tutaj musisz wrócić -->
                                                </div>
                                                @endif
                                            </div>
                                            <div class="col-md-8">
                                                <div class="mx-1 card-body">
                                                    <p class="card-text"><i
                                                            class="bi bi-suitcase-lg-fill text-dark"></i> Nazwa
                                                        użytkownika
                                                    </p>

                                                    @if(!is_null($new->email))
                                                    <p class="card-text">
                                                        <i class="bi bi-envelope"></i>
                                                        Email: {{ $new->email }}
                                                    </p>
                                                    @endif

                                                    @if(!is_null($new->phone_number))
                                                    <p class="card-text">
                                                        <i class="bi bi-telephone"></i>
                                                        Numer Telefonu: {{ $new->phone_number }}
                                                    </p>
                                                    @endif

                                                    @if(!is_null($new->price_rent))
                                                    <p class="card-text">
                                                        <i class="bi bi-cash-coin"></i>
                                                        Wynajem: {{ $new->price_rent }} {{$new->currency->currency}}
                                                    </p>
                                                    @else
                                                    <p class="card-text">do negocjacji</p>
                                                    @endif

                                                    @if(!is_null($new->price_buy))
                                                    <p class="card-text">
                                                        <i class="bi bi-cash-coin"></i>
                                                        Kupno: {{ $new->price_buy }} {{$new->currency->currency}}
                                                    </p>
                                                    @else
                                                    <p class="card-text">do negocjacji</p>
                                                    @endif

                                                    <p class="card-text"><i class="bi bi-geo-alt-fill text-danger"></i>
                                                        @if(isset($new->country->country))
                                                        <a href="{{ route('accommodation.search', ['localisation' => $new->country->country ]) }}"
                                                            class="text-decoration-none">
                                                            {{$new->country->country}},
                                                        </a>
                                                        @endif
                                                        @if(isset($new->state->state))
                                                        <a href="{{ route('accommodation.search', ['localisation' => $new->state->state ]) }}"
                                                            class="text-decoration-none">
                                                            {{$new->state->state}},
                                                        </a>
                                                        @endif
                                                        @if(isset($new->city->city))
                                                        <a href="{{ route('accommodation.search', ['localisation' => $new->city->city ]) }}"
                                                            class="text-decoration-none">
                                                            {{$new->city->city}}
                                                        </a>
                                                        @endif
                                                    </p>

                                                    <p class="card-text">
                                                        <small class="text-muted">
                                                            <i class="bi bi-clock text-primary"></i>
                                                            Ogłoszenie dodano:
                                                            @if($data['date']['yearsDifference'] > 0)
                                                            {{ $data['date']['yearsDifference'] }} lat temu
                                                            @elseif($data['date']['monthsDifference'] > 0 )
                                                            {{ $data['date']['monthsDifference'] }} miesięcy temu
                                                            @elseif($data['date']['daysDifference'] > 0 )
                                                            {{ $data['date']['daysDifference'] }} dni temu
                                                            @elseif($data['date']['hoursDifference'] > 0 )
                                                            {{ $data['date']['hoursDifference'] }} godzin temu
                                                            @elseif($data['date']['minutesDifference'] > 0 )
                                                            {{ $data['date']['minutesDifference'] }} minut temu
                                                            @else
                                                            <p>Przed chwilą</p>
                                                            @endif
                                                        </small>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                <div class="col-sm-12">
                                    <p>{{ $data['label']['empty'] }}</p>
                                </div>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    <div class="tab-content my-3">
                        <div class="tab-pane fade show" id="featured">
                            <div class="row">
                                @forelse($data['accommodation']['featureds'] as $featured)
                                <div class="col-md-6">
                                    <div class="card mb-3" style="max-width: 540px;">
                                        <div class="row g-0">
                                            <div class="d-flex justify-content-between">
                                                <div class="mx-2 my-2">
                                                    <a href="{{ route('accommodation.show', ['accommodation' => $featured]) }}"
                                                        class="text-decoration-none">
                                                        <h2 class="card-title">
                                                            {{ Str::limit($featured->title, 20) }}
                                                        </h2>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                @if($featured->main_image_path)
                                                <div class="mx-1 my-3 image-container">
                                                    <img src="{{asset('images/accommodation/main-photo/' . $featured->main_image_path)}}"
                                                        class="img-fluid rounded-start" alt="...">
                                                </div>
                                                @else
                                                <div class="mx-1 my-3 image-container">
                                                    <img src="{{asset('images/accommodation/default-images/skytower.jpg/')}}"
                                                        class="img-fluid rounded-start" alt="...">
                                                </div>
                                                @endif
                                            </div>
                                            <div class="col-md-8">
                                                <div class="card-body">
                                                    <p class="card-text"><i
                                                            class="bi bi-suitcase-lg-fill text-dark"></i> Nazwa
                                                        użytkownika</p>

                                                    @if(!is_null($featured->salary_from) &&
                                                    !is_null($featured->salary_to))
                                                    <p class="card-text">
                                                        <i class="bi bi-cash-coin"></i>
                                                        Od: {{ $featured->salary_from }} Do:
                                                        {{ $featured->salary_to }}
                                                        {{$featured->currency->currency}}
                                                    </p>
                                                    @else
                                                    <p class="card-text">do negocjacji</p>
                                                    @endif

                                                    <p class="card-text"><i class="bi bi-geo-alt-fill text-danger"></i>
                                                        @if(isset($featured->country->country))
                                                        <a href="{{ route('accommodation.search', ['localisation' => $featured->country->country ]) }}"
                                                            class="text-decoration-none">
                                                            {{$featured->country->country}},
                                                        </a>
                                                        @endif
                                                        @if(isset($featured->state->state))
                                                        <a href="{{ route('accommodation.search', ['localisation' => $featured->state->state ]) }}"
                                                            class="text-decoration-none">
                                                            {{$featured->state->state}},
                                                        </a>
                                                        @endif
                                                        @if(isset($featured->city->city))
                                                        <a href="{{ route('accommodation.search', ['localisation' => $featured->city->city ]) }}"
                                                            class="text-decoration-none">
                                                            {{$featured->city->city}}
                                                        </a>
                                                        @endif
                                                    </p>

                                                    <p class="card-text">
                                                        <small class="text-muted">
                                                            <i class="bi bi-clock text-primary"></i>
                                                            Ogłoszenie dodano:
                                                            @if($data['date']['yearsDifference'] > 0)
                                                            {{ $data['date']['yearsDifference'] }} lat temu
                                                            @elseif($data['date']['monthsDifference'] > 0 )
                                                            {{ $data['date']['monthsDifference'] }} miesięcy temu
                                                            @elseif($data['date']['daysDifference'] > 0 )
                                                            {{ $data['date']['daysDifference'] }} dni temu
                                                            @elseif($data['date']['hoursDifference'] > 0 )
                                                            {{ $data['date']['hoursDifference'] }} godzin temu
                                                            @elseif($data['date']['minutesDifference'] > 0 )
                                                            {{ $data['date']['minutesDifference'] }} minut temu
                                                            @else
                                                            <p>Przed chwilą</p>
                                                            @endif
                                                        </small>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                <div class="col-sm-12">
                                    <p>{{ $data['label']['empty'] }}</p>
                                </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection