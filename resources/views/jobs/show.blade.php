@extends('layouts.app')

@section('content')
<div class="container my-5" style="margin-top: 150px !important;">
    <div class="h1">
        {{$job->title}}
    </div>
    <div class="bg-light">
        <div class=" text-uppercase py-1">
            <p class="d-inline" style="color: #FF5733;"><i class="bi bi-geo-alt-fill"></i>
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