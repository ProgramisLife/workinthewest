@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="{{ asset('assets/css/jobs/search.css') }}" />

<div class="container">
    <div class="row py-2">
        <h1 class="text-left text-uppercase oferty my-5">oferty pracy</h1>
    </div>
    <div class="row">
        <div class="d-inline-block offset-1 bg-white col-md-2">
            <p class="p-bold text-uppercase pt-3">branża
            <div class="border-top border-dark border-1 mb-0"></div>
            </p>
            @foreach($data['jobs']['jobCategories'] as $category)
            <div class="d-block"></div>
            <div class="form-check" style="margin-left: 10px;">
                <input class="form-check-input" type="checkbox" value="{{$category->id}}"
                    id="category_{{$category->id}}" name="category[]" @if(in_array($category->id, old('category', [])))
                checked @endif>
                <label class="form-check-label" for="category_{{$category->id}}">
                    {{$category->category}}
                </label>
            </div>
            @endforeach

            <p class="p-bold text-uppercase pt-3 font-weight-bold">umiejętności
            <div class="border-top border-dark border-1 mb-0"></div>
            </p>
            @foreach($data['jobs']['jobSkills'] as $skill)
            <div class="d-block"></div>
            <div class="form-check" style="margin-left: 10px;">
                <input class="form-check-input" type="checkbox" value="{{$skill->id}}" id="skill_{{$skill->id}}"
                    name="skill[]" @if(in_array($skill->id, old('skill', []))) checked @endif>
                <label class="form-check-label" for="skill_{{$skill->id}}">
                    {{$skill->skill}}
                </label>
            </div>
            @endforeach

            <p class="p-bold text-uppercase pt-3 font-weight-bold">typy
            <div class="border-top border-dark border-1 mb-0"></div>
            </p>
            @foreach($data['jobs']['jobtype'] as $type)
            <div class="d-block"></div>
            <div class="form-check" style="margin-left: 10px;">
                <input class="form-check-input" type="checkbox" value="{{$type->id}}" id="type_{{$type->id}}"
                    name="type[]" @if(in_array($type->id, old('type', []))) checked @endif>
                <label class="form-check-label" for="type_{{$type->id}}">
                    {{$type->type}}
                </label>
            </div>
            @endforeach

            <p class="p-bold text-uppercase pt-3 font-weight-bold">poziomy
            <div class="border-top border-dark border-1 mb-0"></div>
            </p>
            @foreach($data['jobs']['joblevels'] as $level)
            <div class="d-block"></div>
            <div class="form-check" style="margin-left: 10px;">
                <input class="form-check-input" type="checkbox" value="{{$level->id}}" id="level_{{$level->id}}"
                    name="level[]" @if(in_array($level->id, old('level', []))) checked @endif>
                <label class="form-check-label" for="level_{{$level->id}}">
                    {{$level->level}}
                </label>
            </div>
            @endforeach
        </div>

        <div class="d-inline-block bg-white col-md-6 mx-4 overflow-auto">
            <form action="{{ route('jobs.search') }}" method="GET">
                <label for="sorting">
                    <p class="p-bold text-uppercase pt-3 font-weight-bold">sortowanie
                    <div class="border-top border-dark border-1 mb-0"></div>
                    </p>
                </label>
                <div class="d-flex justify-content-between">
                    <select class="form-select my-1" name="sorting">
                        <option selected>Ustawienia domyślne</option>
                        <option value="salary">Wynagrodzenie</option>
                        <option value="title">Tytuł pracy</option>
                    </select>
                    <button type="submit" class="btn btn-primary mx-3">Szukaj</button>
                </div>
            </form>
            @foreach($jobSearchs as $jobSearch)
            <a class="text-decoration-none" href="{{ route('jobs.show', ['job' => $jobSearch]) }}">
                <div class="card my-2">
                    <div class="card-body card-body d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-center">
                            <h3 class="card-title d-inline-block">{{ Str::limit($jobSearch->title, 20) }}</h3>
                            @if($jobSearch->jobtype->isNotEmpty())
                            <a class="btn btn-primary my-1"
                                href="{{ route('jobs.search', ['jobSearch' => $jobSearch->jobtype->first()->type]) }}"
                                role="button">{{$jobSearch->jobtype->first()->type}}</a>
                            @endif
                        </div>
                    </div>
                    <div class="d-flex flex-row align-items-center">
                        @if($jobSearch->main_image_path)
                        <div class="mx-1 my-1 image-container">
                            <img src="{{asset('images/jobs/main-photo/' . $jobSearch->main_image_path)}}"
                                class="img-fluid rounded" alt="...">
                        </div>
                        @else
                        <img class="thumbnail mr-2" style="max-width: 140px; max-height: 140px;"
                            src="{{asset('images/jobs/default-images/skytower.jpg/')}}" alt="Default Image">
                        @endif
                        <div class="mx-3">
                            <p class="card-text"><i class="bi bi-suitcase-lg-fill text-dark"></i> Nazwa użytkownika</p>
                            @if(!is_null($jobSearch->salary_from) && !is_null($jobSearch->salary_to))
                            <p class="card-text">Od: {{ $jobSearch->salary_from }} Do: {{ $jobSearch->salary_to }}
                                {{$jobSearch->currency->currency}}
                            </p>
                            @else
                            <p class="card-text">do negocjacji</p>
                            @endif
                            <p class="card-text"><i class="bi bi-geo-alt-fill text-danger"></i>
                                @if(isset($jobSearch->country->country))
                                <a href="{{ route('jobs.search', ['localisation' => $jobSearch->country->country ]) }}"
                                    class="text-decoration-none">
                                    {{$jobSearch->country->country}},
                                </a>
                                @endif
                                @if(isset($jobSearch->state->state))
                                <a href="{{ route('jobs.search', ['localisation' => $jobSearch->state->state ]) }}"
                                    class="text-decoration-none">
                                    {{$jobSearch->state->state}},
                                </a>
                                @endif
                                @if(isset($jobSearch->city->city))
                                <a href="{{ route('jobs.search', ['localisation' => $jobSearch->city->city ]) }}"
                                    class="text-decoration-none">
                                    {{$jobSearch->city->city}}
                                </a>
                                @endif
                            </p>

                            @if($jobSearch->jobstate->isNotEmpty())
                            <p class="card-text"><i class="bi bi-building-fill text-dark"></i>
                                @foreach($jobSearch->jobstate->take(2) as $jobstate)
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

                            <div class="skill-badge my-2">
                                @foreach($jobSearch->skill as $skill)
                                <a href="{{ route('jobs.search', ['keyword' => $skill->skill]) }}"
                                    class="badge badge-pill bg-primary text-decoration-none">{{ $skill->skill }}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            @endforeach

            {{ $jobSearchs->links() }}

            @if($jobSearchs->isEmpty())
            <div class="col-sm-4">
                <p>Nie znaleziono takiej oferty</p>
            </div>
            @endif
        </div>

        <div class="d-inline-block bg-white col-md-2">
            <p class="p-bold text-uppercase pt-3">ostatni pracodawcy
            <div class="border-top border-dark border-1 mb-0"></div>
            </p>

            <p class="p-bold text-uppercase pt-3">statystyki
            <div class="border-top border-dark border-1 mb-0"></div>
            </p>
            <div class="display-info">
                <div class="h1 text-light text-center mb-0">0</div>
                <p class="p-bold text-uppercase text-center pt-3 mb-0 green">pracodawcy</p>
            </div>
            <div class="display-info my-2">
                <div class="h1 text-light text-center mb-0">0</div>
                <p class="p-bold text-uppercase text-center pt-3 mb-0 green">utworzono cv</p>
            </div>
            <div class="display-info my-2">
                <div class="h1 text-light text-center mb-0">{{ $data['jobs']['jobCount'] }}</div>
                <p class="p-bold text-uppercase text-center pt-3 mb-0 green">opublikowane prace</p>
            </div>

            <p class="p-bold text-uppercase pt-4">ostatnie prace
            <div class="border-top border-dark border-1 mb-0"></div>
            </p>
            @foreach($data['jobs']['latestJob'] as $latest)
            <p class="newesttitle text-uppercase p-bold">{{$latest->title}}</p>
            <p class="newesttitle">opublikowano w</p>
            <a href="{{ route('jobs.search', ['category' => $latest->jobcategory->category]) }}"
                class="newestcontent">{{$latest->jobcategory->category}}</a>
            @endforeach
        </div>
    </div>
</div>


@endsection