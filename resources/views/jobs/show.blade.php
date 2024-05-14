@extends('layouts.app')

@section('content')
<header>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <link rel="stylesheet" href="{{ asset('assets/css/jobs/show.css') }}" />
</header>
<div class="container my-5" style="margin-top: 150px !important;">
    <div class="d-flex">
        <div class="offset-1 col-7 bg-white">
            <div class="mx-4">
                <div class="pt-5">
                    <a href="{{route('jobs.index')}}" class="mx-2 text-decoration-none">Start</a> >
                    <a href="{{route('jobs.search')}}" class="text-decoration-none">Oferty pracy</a> >
                    {{Str::limit($job->title,20)}}
                </div>
                <div class="h1 my-5 mx-2">
                    {{$job->title}}
                </div>
                <div class="d-flex justify-content-between">
                    <div class=" text-uppercase mx-2">
                        <div class="d-flex flex-wrap" style="color: #FF5733;"><i class="bi bi-geo-alt-fill mx-1"></i>
                            lokalizacja:
                            @if(isset($job->country->country))
                            <div class="text-dark mx-1">{{ $job->country->country}},</div>
                            @endif
                            @if(isset($job->state->state))
                            <div class="text-dark">{{ $job->state->state}},</div>
                            @endif
                            @if(isset($job->city->city))
                            <div class="text-dark mx-1">{{ $job->city->city}}</div>
                            @endif
                        </div>
                    </div>
                    <div class="text-uppercase mx-2">
                        <div class="d-flex text-info flex-wrap"><i class="bi bi-cash-coin mx-1"></i>
                            wynagrodzenie:
                            @if(isset($job->salary_from) & isset($job->salary_to))
                            <div class="text-dark mx-1">{{$job->salary_from}} - </div>
                            <div class="text-dark mx-1">{{$job->salary_to}} {{$job->currency->currency}}</div>
                            @else
                            <div class="d-inline-block text-lowercase">
                                do negocjacji
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between my-5 flex-wrap">
                    <div class="text-uppercase mx-2">
                        <div class="d-flex flex-wrap"><i class="bi bi-briefcase-fill text-primary mx-1"></i>
                            <div class="text-primary mx-1">typ pracy:</div>
                            @foreach($job->jobtype()->pluck('type') as $type)
                            <div class="text-dark mx-1">{{$type}},</div>
                            @endforeach
                        </div>
                    </div>
                    <div class="text-uppercase mx-2">
                        <div class="d-flex text-success flex-wrap"><i class="bi bi-calendar mx-1"></i>
                            <div class="mx-1 text-success">opublikowano:</div>
                            <div class="text-dark mx-1">{{$job->created_at->format('d-m-Y')}}</div>
                        </div>
                    </div>
                </div>

                <div class="row my-3">
                    <div class="d-flex justify-content-between mx-2">
                        <div class="text-uppercase">
                            <div class="d-flex" style="color: brown;"><i class="bi bi-tools"></i>
                                <div>kategoria: </div>
                                <div class="text-dark mx-2">{{$job->jobcategory->category}}</div>
                            </div>
                        </div>
                        <div class="d-flex text-uppercase mx-2">
                            <p class="d-inline-block text-info"><i class="bi bi-mortarboard-fill"></i>
                                termin ostateczny: </p>
                            <div class="mx-2">{{ \Carbon\Carbon::parse($job->deadline)->format('d-m-Y') }}</div>
                        </div>
                    </div>
                </div>

                @php
                $now = now();
                $deadline = $job->deadline;
                $difference = $now->diffInDays($deadline);

                $totalDays = 30;
                $progressPercentage = min(100, ($difference / $totalDays) * 100);
                @endphp

                <div class="my-4">
                    <div class="text-dark my-2 text-uppercase mx-2">Do końca oferty pozostało: {{$difference}} dni.
                    </div>
                    <div class="progress mx-2">
                        <div class="progress-bar" role="progressbar" style="width:{{$progressPercentage}}%;"
                            aria-valuenow="{{$progressPercentage}}" aria-valuemin="0" aria-valuemax="100">
                            {{round($progressPercentage)}} %
                        </div>
                    </div>
                </div>

                @if(now() == $job->expiry)
                <div class="alert alert-warning" role="alert">
                    Ta oferta jest nieaktualna.
                </div>
                @endif

                <div class="text-uppercase my-5">
                    <div class="d-flex text-secondary"><i class="bi bi-translate"></i>
                        <div class="mx-2">jezyki:</div>
                        @foreach($job->language()->pluck('language') as $language)
                        <div class="badge bg-primary text-center mx-1">{{$language}}</div>
                        @endforeach
                    </div>
                </div>

                <!-- Opis -->
                <div class="mx-2 my-4">
                    <?php echo $job->description; ?>
                </div>

                <div class="my-3">
                    @if($job->photos()->count() > 0)
                    <div class="d-flex justify-content-center w-70">
                        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                @foreach($job->photos as $key => $photo)
                                <div class="carousel-item {{$key == 0 ? 'active' : ''}}">
                                    <img src="{{ asset('images/jobs/photos/' . $photo->photo) }}" class="d-block w-70"
                                        alt="{{ $photo->photo }}" style="max-height: 400px; object-fit: cover;">
                                </div>
                                @endforeach
                            </div>
                            <button class="carousel-control-prev" type="button"
                                data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button"
                                data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                    @endif
                </div>

                @if(isset($job->city->city))
                <!-- Lokalizacja -->
                <div class="my-5">
                    <div class="text-uppercase fw-bold">Lokalizacja</div>
                </div>
                <div class="d-flex justify-content-center pb-5">
                    <div id="map" style="height: 400px; width:700px;"></div>
                </div>
                <script>
                    var map = L.map('map').setView([{{$job->city->latitude}}, {{$job->city->longitude}}], 13);
                    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                    }).addTo(map);
                    
                    L.marker([{{$job->city->latitude}}, {{$job->city->longitude}}]).addTo(map)
                    .bindPopup('A pretty CSS popup.<br> Easily customizable.')
                    .openPopup();
                </script>
                @endif
            </div>
        </div>
        <div class="mx-5 col-3 bg-white">
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
    </div>
</div>

<div class="container">
    <div class="offset-1 col-7 bg-white">
        <div class="text-center my-3 pt-5 mx-4 fw-bold h2 text-primary">
            POWIĄZANA OFERTA
        </div>
        <div class="my-4">
            <div class="card-deck mb-3 mx-3 border-0 bg-white py-3">
                @foreach($jobSimilarCategorys as $jobSimilarCategory)
                <div class="card mb-3 border-0 bg-white" style="max-height: 200px;">
                    <div class="row g-0">
                        @if($jobSimilarCategory->main_image_path)
                        <div class="col-md-4 image-container">
                            <img src="{{asset('images/jobs/main-photo/' . $jobSimilarCategory->main_image_path)}}"
                                class="img-fluid rounded mx-5">
                            @else
                            <img src="{{asset('images/jobs/default-images/skytower.jpg/')}}"
                                class="img-fluid rounded mx-5 ">
                            @endif
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <a href="{{ route('jobs.show', ['job' => $jobSimilarCategory]) }}"
                                    class="h5 card-title mx-1 text-decoration-none">
                                    {{ Str::limit($jobSimilarCategory->title,30) }}
                                </a>
                                <p class="card-text mx-1 my-3">
                                    <i class="bi bi-briefcase-fill"></i>
                                    Nazwa użytkownika
                                </p>
                                <p class="card-text mx-1">
                                <div class="d-flex" style="color: #FF5733;"><i class="bi bi-geo-alt-fill mx-1"></i>
                                    <div class="text-uppercase">lokalizacja: </div>
                                    @if(isset($jobSimilarCategory->country->country))
                                    <a href="{{ route('jobs.search', ['localisation' => $jobSimilarCategory->country->country ]) }}"
                                        class="text-decoration-none mx-1">
                                        {{$jobSimilarCategory->country->country}},
                                    </a>
                                    @endif
                                    @if(isset($jobSimilarCategory->state->state))
                                    <a href="{{ route('jobs.search', ['localisation' => $jobSimilarCategory->state->state ]) }}"
                                        class="text-decoration-none">
                                        {{$jobSimilarCategory->state->state}},
                                    </a>
                                    @endif
                                    @if(isset($jobSimilarCategory->city->city))
                                    <a href="{{ route('jobs.search', ['localisation' => $jobSimilarCategory->city->city ]) }}"
                                        class="text-decoration-none mx-1">
                                        {{$jobSimilarCategory->city->city}}
                                    </a>
                                    @endif
                                </div>
                                </p>
                                <div class="mx-2">
                                    @if($jobSimilarCategory->jobtype->isNotEmpty())
                                    <a class="btn btn-primary my-1"
                                        href="{{ route('jobs.search', ['keyword' => $jobSimilarCategory->jobtype->first()->type]) }}"
                                        role="button">{{$jobSimilarCategory->jobtype->first()->type}}</a>
                                    @endif
                                </div>
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