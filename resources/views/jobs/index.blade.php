@extends('layouts.app')

@section('content')

<head>
    <link rel="stylesheet" href="{{ asset('assets/css/shared/main.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('assets/css/jobs/index.css') }}" type="text/css" />
</head>

<!-- Top -->
<div class="jumbotron jumbotron-fluid top img img-fluid"
    style="background-image: url('{{asset('assets/images/bg-info-home-3.png') }}'); background-repeat: no-repeat; background-size: cover;">
    <div class="container text-center">
        <h1 class="top-header fw-bold text-uppercase py-4">{{$data['label']['top']['top-header']}}</h1>
        <p class="lead text-white">{{$data['label']['top']['top-text']}}</p>

        <form class="text-center text-white mx-5 flex-column flex-sm-row" method="POST"
            action="{{ route('jobs.search') }}">
            <div class="input-group row">
                <div class="form-group col-md mt-3">
                    <label class="text-uppercase pb-3" for="keyword">
                        {{$data['label']['top']['top-input-keyword']}}
                    </label>
                    <input type="text" class="form-control @error('keyword') is-invalid @enderror" id="keyword"
                        name="keyword" placeholder="Posada, zawód ...">
                </div>
                <div class="form-group col-md mt-3">
                    <label class="text-uppercase  pb-3" for="localisation">
                        {{$data['label']['top']['top-input-location']}}
                    </label>
                    <input type="text" class="form-control @error('localisation') is-invalid @enderror"
                        id="localisation" name="localisation" placeholder="Wpisz lokalizację">
                </div>
                <div class="form-group col-md mt-3">
                    <label class="text-uppercase pb-3" for="category">
                        {{$data['label']['top']['top-input-profession']}}
                    </label>
                    <select class="form-select" name="category">
                        <option value="" selected>Wybierz kategorię</option>
                        @foreach($data['categories'] as $category)
                        <option value="{{$category->category}}" @if($category->id == old('category', $category))
                            selected @endif>
                            {{$category->category}}
                        </option>
                        @endforeach
                    </select>
                    @error('category')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-lg btn-search background-main text-white mt-4">
                        {{$data['label']['top']['top-search']}}
                    </button>
                </div>
            </div>
            @method('POST')
            @csrf
        </form>
    </div>
</div>


<!-- Oferty Pracy -->
<section class="job">
    <div class="container ">
        <div class="col-lg-10 offset-1">
            <div class="row my-3">
                <ul class="nav nav-pills justify-content-center flex-column flex-sm-row ">
                    <li class="nav-item">
                        <a class="nav-link active text-uppercase px-3" id="newjob-tab" data-bs-toggle="pill"
                            href="#newjob">{{$data['label']['newest-ofert']}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-uppercase px-3" id="featuredjobs-tab" data-bs-toggle="pill"
                            href="#featuredJobs">{{$data['label']['featured-ofert']}}</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="tab-content my-3">
                    <div class="tab-pane fade show active" id="newjob">
                        <div class="row">
                            @forelse($data['jobs']['newJobs'] as $newJob)
                            <div class="col-md-6">
                                <div class="card mb-3 shadow p-3 mb-5 rounded">
                                    <div class="row g-0">
                                        <div class="d-flex justify-content-between">
                                            <div class="mx-2 my-2">
                                                <a href="{{ route('jobs.show', ['job' => $newJob]) }}"
                                                    class="text-decoration-none">
                                                    <h3 class="card-title">
                                                        {{ Str::limit($newJob->title, 25) }}
                                                    </h3>
                                                </a>
                                            </div>
                                            <div class="d-flex">
                                                <div class="mx-2 my-2">
                                                    @if($newJob->jobtype->isNotEmpty())
                                                    @php
                                                    $buttonColor = '';
                                                    switch($newJob->jobtype->first()->type) {
                                                    case 'Pełny etat':
                                                    $buttonColor = 'btn-warning';
                                                    break;
                                                    case 'Kontrakt':
                                                    $buttonColor = 'btn-danger';
                                                    break;
                                                    case 'Freelancer':
                                                    $buttonColor = 'btn-dark';
                                                    break;
                                                    default:
                                                    $buttonColor = 'btn-primary';
                                                    break;
                                                    }
                                                    @endphp
                                                    <a class="btn text-white rounded-3 {{$buttonColor}} my-1"
                                                        href="{{ route('jobs.search', ['keyword' => $newJob->jobtype->first()->type]) }}"
                                                        role="button">{{$newJob->jobtype->first()->type}}</a>
                                                    @endif
                                                </div>
                                                <div class="hear-icon align-self-center">
                                                    <i class="bi bi-heart-fill"></i>
                                                </div>
                                            </div>
                                        </div>

                                        <div
                                            class="col-sm-4 col-md-4 mx-auto d-flex justify-content-center align-items-center">
                                            @if($newJob->main_image_path)
                                            <div class="my-3 image-container">
                                                <img src="{{asset('images/jobs/main-photo/' . $newJob->main_image_path)}}"
                                                    class="img img-fluid rounded" alt="...">
                                            </div>
                                            @else
                                            <div class="my-3 image-container">
                                                <img src="{{asset('images/jobs/default-images/skytower.jpg')}}"
                                                    class="img img-fluid rounded" alt="...">
                                            </div>
                                            @endif
                                        </div>
                                        <div class="col-md-8">
                                            <div class="mx-1 card-body">
                                                <p class="card-text"><i class="bi bi-suitcase-lg-fill text-dark"></i>
                                                    Nazwa
                                                    użytkownika</p>

                                                @if(!is_null($newJob->salary_from) &&
                                                !is_null($newJob->salary_to))
                                                <p class="card-text">
                                                    <i class="bi bi-cash-coin"></i>
                                                    Od: {{ $newJob->salary_from }} Do:
                                                    {{ $newJob->salary_to }} {{$newJob->currency->currency}}
                                                </p>
                                                @else
                                                <p class="card-text">do negocjacji</p>
                                                @endif

                                                <p class="card-text"><i class="bi bi-geo-alt-fill text-danger"></i>
                                                    @if(isset($newJob->country->country))
                                                    <a href="{{ route('jobs.search', ['localisation' => $newJob->country->country ]) }}"
                                                        class="text-decoration-none">
                                                        {{$newJob->country->country}},
                                                    </a>
                                                    @endif
                                                    @if(isset($newJob->state->state))
                                                    <a href="{{ route('jobs.search', ['localisation' => $newJob->state->state ]) }}"
                                                        class="text-decoration-none">
                                                        {{$newJob->state->state}},
                                                    </a>
                                                    @endif
                                                    @if(isset($newJob->city->city))
                                                    <a href="{{ route('jobs.search', ['localisation' => $newJob->city->city ]) }}"
                                                        class="text-decoration-none">
                                                        {{$newJob->city->city}}
                                                    </a>
                                                    @endif
                                                </p>

                                                @if($newJob->jobstate->isNotEmpty())
                                                <p class="card-text"><i class="bi bi-building-fill text-dark"></i>
                                                    @foreach($newJob->jobstate->take(2) as $jobstate)
                                                    {{ $jobstate->name }},
                                                    @endforeach
                                                </p>
                                                @endif

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

                                                <div class="skill-badge" id="skill-badge">
                                                    @foreach($newJob->skill as $skill)
                                                    <a href="{{ route('jobs.search', ['keyword' => $skill->skill ]) }}"
                                                        class="badge badge-pill bg-primary text-decoration-none">{{$skill->skill}}</a>
                                                    @endforeach
                                                </div>
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
                    <div class="tab-pane fade show" id="featuredJobs">
                        <div class="row">
                            @forelse($data['jobs']['featuredJobs'] as $featuredJobs)
                            <div class="col-md-6">
                                <div class="card shadow p-3 mb-5 bg-body rounded mx-3" style="max-width: 540px;">
                                    <div class="row g-0">
                                        <div class="d-flex justify-content-between">
                                            <div class="mx-2 my-2">
                                                <a href="{{ route('jobs.show', ['job' => $featuredJobs]) }}"
                                                    class="text-decoration-none">
                                                    <h3 class="card-title">
                                                        {{ Str::limit($featuredJobs->title, 25) }}
                                                    </h3>
                                                </a>
                                            </div>
                                            <div class="d-flex">
                                                <div class="mx-2 my-2">
                                                    @if($featuredJobs->jobtype->isNotEmpty())
                                                    @php
                                                    $buttonColor = '';
                                                    switch($newJob->jobtype->first()->type) {
                                                    case 'Pełny etat':
                                                    $buttonColor = 'btn-warning';
                                                    break;
                                                    case 'Kontrakt':
                                                    $buttonColor = 'btn-danger';
                                                    break;
                                                    case 'Freelancer':
                                                    $buttonColor = 'btn-dark';
                                                    break;
                                                    default:
                                                    $buttonColor = 'btn-primary';
                                                    break;
                                                    }
                                                    @endphp
                                                    <a class="btn text-white rounded-3 {{$buttonColor}} my-1"
                                                        href="{{ route('jobs.search', ['keyword' => $featuredJobs->jobtype->first()->type ]) }}"
                                                        role="button">{{$featuredJobs->jobtype->first()->type}}</a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4 d-flex justify-content-center align-items-center">
                                            @if($featuredJobs->main_image_path)
                                            <div class="mx-1 my-3 image-container">
                                                <img src="{{asset('images/jobs/main-photo/' . $featuredJobs->main_image_path)}}"
                                                    class="img-fluid rounded-start" alt="...">
                                            </div>
                                            @else
                                            <div class="mx-1 my-3 image-container">
                                                <img src="{{asset('images/jobs/default-images/skytower.jpg/')}}"
                                                    class="img-fluid rounded-start" alt="...">
                                            </div>
                                            @endif
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <p class="card-text"><i class="bi bi-suitcase-lg-fill text-dark"></i>
                                                    Nazwa
                                                    użytkownika</p>

                                                @if(!is_null($featuredJobs->salary_from) &&
                                                !is_null($featuredJobs->salary_to))
                                                <p class="card-text">
                                                    <i class="bi bi-cash-coin"></i>
                                                    Od: {{ $featuredJobs->salary_from }} Do:
                                                    {{ $featuredJobs->salary_to }}
                                                    {{$featuredJobs->currency->currency}}
                                                </p>
                                                @else
                                                <p class="card-text">do negocjacji</p>
                                                @endif

                                                <p class="card-text"><i class="bi bi-geo-alt-fill text-danger"></i>
                                                    @if(isset($featuredJobs->country->country))
                                                    <a href="{{ route('jobs.search', ['localisation' => $featuredJobs->country->country ]) }}"
                                                        class="text-decoration-none">
                                                        {{$featuredJobs->country->country}},
                                                    </a>
                                                    @endif
                                                    @if(isset($featuredJobs->state->state))
                                                    <a href="{{ route('jobs.search', ['localisation' => $featuredJobs->state->state ]) }}"
                                                        class="text-decoration-none">
                                                        {{$featuredJobs->state->state}},
                                                    </a>
                                                    @endif
                                                    @if(isset($featuredJobs->city->city))
                                                    <a href="{{ route('jobs.search', ['localisation' => $featuredJobs->city->city ]) }}"
                                                        class="text-decoration-none">
                                                        {{$featuredJobs->city->city}}
                                                    </a>
                                                    @endif
                                                </p>

                                                <p class="card-text"><i class="bi bi-building-fill text-dark"></i>
                                                    @foreach($featuredJobs->jobstate->take(2) as $jobstate)
                                                    {{ $jobstate->name }},
                                                    @endforeach
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

                                                <div class="skill-badge">
                                                    @foreach($featuredJobs->skill as $skill)
                                                    <a href="{{ route('jobs.search', ['keyword' => $skill->skill]) }}"
                                                        class="badge badge-pill bg-primary text-decoration-none">{{ $skill->skill }}</a>
                                                    @endforeach
                                                </div>
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
</section>

<div class="container d-flex justify-content-center">
    <button class="btn btn-primary text-uppercase rounded-5 job-search-button">
        <div class="d-flex justify-content-center text-center align-items-center">
            <div>{{ $data['label']['look-all'] }}</div>
            <i class="bi bi-arrow-right-circle-fill text-center text-icon"></i>
        </div>
    </button>
</div>

<!-- Współpraca -->
<h2 class="text-center text-uppercase py-5 fw-bold">{{ $data['label']['cooperation'] }}</h2>
<div id="carousel-partners" class="carousel slide carousel-fade" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="font-weight-bold carousel-item active d-flex" data-bs-interval="2000">
            @for($i = 1; $i <= 11; $i++) <img class="partner-images d-inline-block mx-3 overflow-visible"
                src="{{ asset('assets/images/thumbnail/'.$i.'.png') }}">
                @endfor
        </div>
    </div>
</div>

<!-- Rejestracja -->
<section class="register">
    <div class="row my-5">
        <div class="col-md-6 p-0">
            <div class="round p-5 text-center"
                style="background-image: url('{{asset('assets/images/pracodawca.jpg') }}');background-repeat: no-repeat; background-size: cover;">
                <div class="d-flex justify-content-center align-items-center h-100">
                    <div class="text-white">
                        <p class="mb-3 fw-bold text-uppercase register-subheader">
                            {{ $data['label']['register']['employer-subheader'] }}
                        </p>
                        <h2 class="mb-4 fw-bold text-uppercase register-header">
                            {{ $data['label']['register']['employer-header'] }}
                        </h2>
                        <p class=" my-5 register-text">{{ $data['label']['register']['employer-text'] }}</p>
                        <div class="mb-4">
                            <a href=""
                                class="text-align-start text-uppercase bg-primary text-white p-3 text-decoration-none">
                                <i class="bi bi-building-fill"></i>
                                {{ $data['label']['register']['employer-button'] }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="register col-md-6 p-0">
            <div class="round p-5 text-center bg-image"
                style="background-image: url('{{asset('assets/images/pracownik.jpg') }}');background-repeat: no-repeat; background-size: cover;">
                <div class="d-flex justify-content-center align-items-center h-100">
                    <div class="text-white">
                        <p class="mb-3 fw-bold register-subheader text-uppercase">
                            {{ $data['label']['register']['employee-subheader'] }}
                        </p>
                        <h2 class="mb-4 fw-bold register-header text-uppercase">
                            {{ $data['label']['register']['employee-header'] }}
                        </h2>
                        <p class="register-text my-5">{{ $data['label']['register']['employee-text'] }}</p>
                        <div class="mb-4">
                            <a href=""
                                class="text-align-start text-uppercase bg-success text-white p-3 text-decoration-none">
                                <i class="bi bi-person-fill"></i>{{ $data['label']['register']['employee-button'] }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Artykuły -->
<section class="articles">
    <h2 class="text-center pt-5 articles-header">{{$data['label']['articles']['news']}}</h2>
    <p class="text-center pt-2 articles-text">{{$data['label']['articles']['news-content']}}</p>
</section>

<div class="container articles-section">
    <div class="row row-cols-1 row-cols-md-3 g-4">
        @forelse($newArticles as $article)
        <div class="col">
            <div class="card h-100">
                @if($article->main_image_path)
                <img class="card-img-top" src="{{asset('images/article/main-photo/' . $article->main_image_path)}}"
                    alt="Card image cap">
                @else
                <img class="card-img-top" src="{{asset('images/jobs/default-images/skytower.jpg/')}}"
                    alt="Default Image">
                @endif
                <div class="card-body">
                    <a class="text-decoration-none" href="{{ route('articles.show', ['article' => $article]) }}">
                        <h3 class="card-title articles-header">
                            {{ Str::limit($article->title, 50) }}
                        </h3>
                    </a>
                    <p class="card-text articles-text">{!! Str::limit($article->description, 75) !!}</p>
                </div>
                <div class="card-footer">
                    <small class="text-muted d-flex justify-content-end">
                        <a href="{{ route('articles.show', ['article' => $article]) }}" class="btn fw-bold text-main">
                            Czytaj dalej <i class="bi fw-bold bi-arrow-right"></i>
                        </a>
                    </small>
                </div>
            </div>
        </div>
        @empty
        <div class="col-sm-12">
            <p>{{ $data['label']['articles'] }}</p>
        </div>
        @endforelse
    </div>
</div>
@endsection