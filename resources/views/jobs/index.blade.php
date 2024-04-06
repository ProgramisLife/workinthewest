@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="{{ asset('assets/css/jobs/index.css') }}" />

<div id="main-search-carousel" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img class="caroseul-image rounded" src="{{asset('assets/images/bg-info-home-3.png') }}" alt="First slide">
            <div class="carousel-caption d-none d-md-block" style="top: 5%;">
                <h1 class="h-work text-center text-uppercase">znajdź pracę</h1>
                <p class=" text-center h5 my-5">Przeszukaj naszą bazę ofert, by odkryć coś dla siebie!</p>
                <form class="text-center" method="POST" action="{{ route('jobs.search') }}">
                    <div class="form-group d-inline-block mx-3">
                        <label class="text-uppercase py-1" for="keyword">
                            Słowo kluczowe?
                        </label>
                        <input type="text" class="form-control d-inline-block @error('keyword') is-invalid @enderror" id="keyword" name="keyword" placeholder="Posada, zawód ...">
                    </div>
                    <div class="form-group d-inline-block mx-3">
                        <label class="text-uppercase py-1" for="localisation">
                            gdzie ?
                        </label>
                        <input type="text" class="form-control inline-block @error('localisation') is-invalid @enderror" id="localisation" name="localisation" placeholder="Wpisz lokalizację">
                    </div>
                    <div class="form-group d-inline-block mx-3">
                        <label class="text-uppercase py-1" for="category">
                            branża ?
                        </label>
                        <select class="form-select" name="category">
                            <option value="" selected>Wybierz kategorię</option>
                            @foreach($data['categories'] as $category)
                            <option value="{{$category->category}}" @if($category->id == old('category', $category)) selected @endif>
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
                    <button type="submit" class="btn btn-search btn-primary"><i class="bi d-flex justify-content-center bi-arrow-right-short"></i></button>
                    @method('POST')
                    @csrf
                </form>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row py-5">
        <div class="col-lg-10 offset-1">
            <div class="row">
                <ul class="nav nav-pills nav-justified my-3 justify-content-center" id="pills-tab">
                    <li class="nav-item">
                        <a class="nav-link active text-uppercase" id="newjob-tab" data-bs-toggle="pill" href="#newjob">
                            Najnowsze oferty
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-uppercase" id="featuredjobs-tab" data-bs-toggle="pill" href="#featuredjobs">
                            Wyróżnione
                        </a>
                    </li>
                </ul>
                <div class="row">
                    <div class="tab-content my-3">
                        <div class="tab-pane fade show active" id="newjob">
                            <div class="row">
                                @forelse($data['jobs']['newJobs'] as $newJob)
                                <div class="col-md-6">
                                    <a href="{{ route('jobs.show', ['job' => $newJob]) }}">
                                        <div class="card my-2 mx-2">
                                            <div class="card-body card-body d-flex flex-column">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <h3 class="card-title d-inline-block">{{ Str::limit($newJob->title, 20) }}</h3>
                                                    @if($newJob->jobtype->isNotEmpty())
                                                    <a class="btn btn-primary" href="{{ route('jobs.search', ['results' => $newJob->jobtype->first()->type ]) }}" role="button">{{$newJob->jobtype->first()->type}}</a>
                                                    @endif
                                                </div>
                                                <div class="d-flex flex-row align-items-center">
                                                    @if($newJob->main_image_path)
                                                    <img class="thumbnail mr-2" style="max-width: 140px; max-height: 140px;" src="{{asset('images/jobs/main-photo/' . $newJob->main_image_path)}}" alt="Card image cap">
                                                    @else
                                                    <img class="thumbnail mr-2" style="max-width: 140px; max-height: 140px;" src="{{asset('images/jobs/default-images/skytower.jpg/')}}" alt="Default Image">
                                                    @endif

                                                    <div class="mx-3">
                                                        <p class="card-text"><i class="bi bi-suitcase-lg-fill text-dark"></i> Nazwa użytkownika</p>
                                                        @if(!is_null($newJob->salary_from) && !is_null($newJob->salary_to))
                                                        <p class="card-text">Od: {{ $newJob->salary_from }} Do: {{ $newJob->salary_to }} {{$newJob->currency->currency}}</p>
                                                        @else
                                                        <p class="card-text">do negocjacji</p>
                                                        @endif
                                                        <p class="card-text"><i class="bi bi-geo-alt-fill text-danger"></i>Niemcy</p>
                                                        <p class="card-text"><i class="bi bi-calendar-week text-primary"></i> {{ $newJob->created_at->year }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                @empty
                                <div class="col-sm-12">
                                    <p>{{ $data['label']['empty'] }}</p>
                                </div>
                                @endforelse
                            </div>
                        </div>

                        <div class="row">
                            <div class="tab-content my-3">
                                <div class="tab-pane fade" id="featuredjobs">
                                    <div class="row">
                                        @forelse($data['jobs']['featuredJobs'] as $job)
                                        <div class="col-md-6">
                                            <a href="{{ route('jobs.show', ['job' => $newJob]) }}">
                                                <div class="card my-2 mx-2">
                                                    <div class="card-body card-body d-flex flex-column">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <h3 class="card-title d-inline-block">{{ Str::limit($job->title, 20) }}</h3>
                                                            <a class="btn btn-primary" href="#" role="button">{{$job->jobtype->first()->type}}</a>
                                                        </div>
                                                        <div class="d-flex flex-row align-items-center">
                                                            @if($newJob->main_image_path)
                                                            <img class="thumbnail mr-2" style="max-width: 140px; max-height: 140px;" src="{{asset('images/jobs/main-photo/' . $newJob->main_image_path)}}" alt="Card image cap">
                                                            @else
                                                            <img class="thumbnail mr-2" style="max-width: 140px; max-height: 140px;" src="{{asset('images/jobs/default-images/skytower.jpg/')}}" alt="Default Image">
                                                            @endif
                                                            <div class="mx-3">
                                                                <p class="card-text"><i class="bi bi-suitcase-lg-fill text-dark"></i> Nazwa użytkownika</p>
                                                                @if(!is_null($job->salary_from) && !is_null($job->salary_to))
                                                                <p class="card-text">Od: {{ $job->salary_from }} Do: {{ $job->salary_to }} {{$job->currency->currency}}</p>
                                                                @else
                                                                <p class="card-text">do negocjacji</p>
                                                                @endif
                                                                <p class="card-text"><i class="bi bi-geo-alt-fill text-danger"></i>Niemcy</p>
                                                                <p class="card-text"><i class="bi bi-calendar-week text-primary"></i> {{ $job->created_at->year }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
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
    </div>
</div>

<p class="text-center h2 text-uppercase py-5 font-weight-bold">{{ $data['label']['cooperation'] }}</p>

<div id="carousel-partners" class="carousel slide carousel-fade" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="font-weight-bold carousel-item active d-flex" data-bs-interval="2000">
            @for($i = 1; $i <= 11; $i++) <img class="partner-images d-inline-block mx-3 overflow-visible" src="{{ asset('assets/images/thumbnail/'.$i.'.png') }}">
                @endfor
        </div>
    </div>
</div>

<div class="row mx-0 my-5">
    <div class="col-6 p-0">
        <div id="carousel1" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="caroseul-image-log img-fluid" src="{{asset('assets/images/pracodawca.jpg') }}" alt="Pracodawca">
                    <div class="carousel-caption d-none d-md-block d-flex flex-column justify-content-center">
                        <p class="font-weight-bold text-uppercase">Jestem</p>
                        <h1 class="font-weight-bold text-uppercase">pracodawcą</h1>
                        <p class="h5 my-5">Dodawaj ogłoszenia pracy, oraz szukaj kandydatów...</p>
                        <a href="" class="text-align-start text-uppercase bg-primary text-white p-3 text-decoration-none">
                            <i class="bi bi-building-fill"></i>
                            Zarejestruj firmę</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 p-0">
        <div id="carousel12" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="caroseul-image-log img-fluid" src="{{asset('assets/images/pracownik.jpg') }}" alt="Pracodawca">
                    <div class="carousel-caption d-none d-md-block d-flex flex-column justify-content-center">
                        <p class="font-weight-bold text-uppercase">Jestem</p>
                        <h1 class="font-weight-bold text-uppercase">kandydatem</h1>
                        <p class="h5 my-5">Przeszukaj bazę ofert pracy, aplikuj, zapisuj na później...</p>
                        <a href="" class="text-align-start text-uppercase bg-success text-white p-3 text-decoration-none">
                            <i class="bi bi-person-fill"></i>
                            Zarejestruj się jako kandydat</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<h1 class="text-center py-5">{{$data['label']['news']}}</h1>
<p class="text-center">{{$data['label']['news-content']}}</p>

<div class="container">
    <div class="card-group">
        @forelse($newArticles as $article)
        <div class="card mx-3">
            @if($article->main_image_path)
            <img class="card-img-top" style="height:350px; width:245;" src="{{asset('images/article/main-photo/' . $article->main_image_path)}}" alt="Card image cap">
            @else
            <img class="card-img-top img-fluid" style="height:350px; width:245;" src="{{asset('images/jobs/default-images/skytower.jpg/')}}" alt="Default Image">
            @endif
            <div class="card-body">
                <h5 class="card-title">{{ Str::limit($article->title, 50) }}</h5>
                <p class="card-text">{{ Str::limit($article->description, 75) }}</p>
            </div>
            <div class="card-footer">
                <small class="text-muted d-flex justify-content-end">
                    <a href="{{ route('articles.show', ['article' => $article]) }}" class="btn btn-primary text-light">
                        Czytaj dalej <i class="bi bi-arrow-right"></i>
                    </a>
                </small>
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