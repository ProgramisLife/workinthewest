@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="{{ asset('assets/css/articles/index.css') }}" />

<div class="container" style="margin-top: 10rem;">
    <div class="h1 text-align-center offset-1">Artykuły</div>
    <div class="row">
        <div class="offset-lg-1 col-md-8">
            @foreach($articles as $article)
            <div class="mb-4"></div>
            <div class="card bg-white">
                @if($article->main_image_path)
                <img class="card-img-top" src="{{ asset('images/article/main-photo/' . $article->main_image_path) }}" alt="Card image cap">
                @else
                <img class="card-img-top" src="{{ asset('images/article/default-images/' . ($files[array_rand($files)])) }}" alt="Default Image">
                @endif
                <div class="card-body">
                    <div class="d-flex d-inline-block">
                        <p class="card-text mx-3"><i class="bi bi-folder" style="padding-right:5px;"></i>Artykuły</p>
                        <p class="card-text"><i style="padding-right:5px;" class="bi bi-calendar2-event"></i>{{ $article->updated_at->format('d-m-Y') }}</p>
                    </div>
                    <h4 class="card-title" style="font-weight:bold;">{{ $article->title }}</h4>
                    <p class="card-text">{{ Str::limit($article->description, 400) }}</p>
                    <div class="d-flex justify-content-between">
                        <a href="#" style="font-size:13px;" class="d-flex text-uppercase text-decoration-none">
                            <p class="text-dark d-flex">przez: </p>
                            <p class="text-dark" style="font-weight:bold;">użytkownika</p>
                        </a>
                        <a href="#" class="btn btn-primary ">Zobacz</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="bg-white col-md-3 my-4">
            <p class="text-left my-3 mx-4" style="font-weight:bold;">Najnowsze artykuły</p>
            <div class="border border-bottom-3 border-dark"></div>
            <div class="my-4">
                @foreach($articles as $article)
                <div class="d-flex card mb-3 bg-white mx-3">
                    <div class="row">
                        <div class="img-container">
                            @if($article->main_image_path)
                            <img class="img-fluid rounded-start" style="max-width: 80px; max-height:80px;" src="{{ asset('images/article/main-photo/' . $article->main_image_path) }}" alt="Card image cap">
                            @else
                            <img class="img-fluid rounded-start" style="max-width: 80px; max-height:80px;" src="{{ asset('images/article/default-images/' . ($files[array_rand($files)])) }}" alt="Default Image">
                            @endif
                            <div class="card-body">
                                <p class="card-text"><small>{{ $article->updated_at->format('d-m-Y') }}</small></p>
                                <p class="card-title" style="font-size:12px; font-weight:bold;">{{ $article->title }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endsection