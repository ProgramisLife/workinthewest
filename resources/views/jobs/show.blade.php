@extends('layouts.app')

@section('content')
<div class="container my-5" style="margin-top: 150px !important;">
    <div class="h1">
        {{$job->title}}
    </div>
    <div class="bg-light">
        <div class="d-flex row">
            <div class=" text-uppercase py-1">
                <p class="d-inline-block" style="color: #FF5733;"><i class="bi bi-geo-alt-fill"></i>
                    lokalizacja: </p>
            </div>
            <div class="text-uppercase py-1">
                <p class="d-inline-block text-info py-1"><i class="bi bi-cash-coin"></i>
                    wynagrodzenie: </p>
                @if(isset($job->salary_from) & isset($job->salary_to))
                {{$job->salary_from}} {{$job->salary_to}}
                @else
                <p class="d-inline-block text-lowercase">
                    do negocjacji</p>
                @endif
            </div>
            <div class="text-uppercase py-1">
                <p class="d-inline-block text-primary py-1"><i class=" bi bi-briefcase-fill"></i>
                    typ pracy:
                </p>
                @foreach($job->jobtype()->pluck('type') as $type)
                {{$type}},
                @endforeach
            </div>
            <div class="text-uppercase py-1">
                <p class="d-inline-block text-success py-1"><i class="bi bi-calendar"></i>
                    opublikowano</p>
                {{$job->created_at->format('d-m-Y')}}
            </div>
            <div class="text-uppercase py-1">
                <p class="d-inline-block py-1" style="color: brown;"><i class="bi bi-tools"></i>
                    kategoria: </p>
                {{$job->jobcategory->category}}
            </div>
            <div class="text-uppercase py-1">
                <p class="d-inline-block py-1 text-info"><i class="bi bi-mortarboard-fill"></i>
                    termin ostateczny</p>
                {{ \Carbon\Carbon::parse($job->expiry)->format('d-m-Y') }}
            </div>
            <div class="text-uppercase py-1">
                <p class="d-inline-block py-1 text-secondary"><i class="bi bi-translate"></i>
                    jezyki: </p>
                @foreach($job->language()->pluck('language') as $language)
                {{$language}},
                @endforeach
            </div>
        </div>

        @if($job->photos()->count() > 0)
        <div class="d-flex justify-content-center w-50 h-50">
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach($job->photos as $key => $photo)
                    <div class="carousel-item {{$key == 0 ? 'active' : ''}}">
                        <img src="{{ asset('images/jobs/photos/' . $photo->photo) }}" class="d-block w-100" alt="{{ $photo->photo }}">
                    </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
        @endif

        <!-- Opis -->
        <div class="">
            {{$job->description}}
        </div>

        <!-- Lokalizacja -->
        <div class="my-5">
            Lokalizacja
        </div>
    </div>
</div>
@endsection