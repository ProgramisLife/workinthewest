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
                od {{$job->salary_from}} do {{$job->salary_to}} {{$job->currency->currency}}
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
    <div>
        <div class="bg-white col-md-3 my-4">
            <p class="text-left my-3 mx-4" style="font-weight:bold;">
                Podobne oferty pracy
            </p>
            <div class="my-4">
                <div class="card-deck">
                    @foreach($jobSimilarCategorys as $jobSimilarCategory)
                    <div class="card mb-3 bg-white mx-3 border-0">
                        <div class="d-flex align-left">
                            @if($jobSimilarCategory->main_image_path)
                            <img class="rounded" style="max-width: 5rem; max-height:5rem;" src="{{asset('images/jobs/main-photo/' . $jobSimilarCategory->main_image_path)}}" alt="Card image cap">
                            @else
                            <img class="rounded" style="max-width: 5rem; max-height:5rem;" src="{{asset('images/jobs/default-images/skytower.jpg/')}}" alt="Default Image">
                            @endif
                            <div class="card-body">
                                <a class="card-title text-decoration-none text-black" href="{{ route('jobs.show', ['job' => $job]) }}">
                                    <p class="card-title title-hover" style="font-weight:bold;font-size: 14px;">{{ $jobSimilarCategory->title }}</p>
                                    <p class="card-title title-hover" style="font-size: 12px;">{{ Str::limit($jobSimilarCategory->description, 20) }}</p>
                                </a>
                                <p class="card-text"><small>{{ $jobSimilarCategory->updated_at->format('d M Y') }}</small></p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection