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
                <img class="card-img-top" src="{{ asset('images/article/main-photo/' . $article->main_image_path) }}"
                    alt="Card image cap">
                @else
                <img class="card-img-top"
                    src="{{ asset('images/article/default-images/' . ($files[array_rand($files)])) }}"
                    alt="Default Image">
                @endif
                <div class="card-body">
                    <div class="d-flex d-inline-block my-3">
                        <a href="{{route('articles.index')}}" class="card-text mx-3 text-decoration-none"><i
                                class="bi bi-folder" style="padding-right:5px;"></i>Artykuły</a>
                        <p class="card-text"><i style="padding-right:5px;"
                                class="bi bi-calendar2-event"></i>{{ $article->updated_at->format('d-m-Y') }}</p>
                    </div>
                    <a class="text-decoration-none text-black"
                        href="{{ route('articles.show', ['article' => $article]) }}">
                        <h4 class="card-title title-hover" style="font-weight:bold;">{{ $article->title }}</h4>
                    </a>
                    <p class="card-text">{{ Str::limit($article->description, 400) }}</p>
                    <div class="d-flex justify-content-between">
                        <a href="#" style="font-size:13px;" class="d-flex text-uppercase text-decoration-none">
                            <p class="text-dark d-flex">przez: </p>
                            <p class="text-dark" style="font-weight:bold;">użytkownika</p>
                        </a>
                        <a href="{{ route('articles.show', ['article' => $article]) }}"
                            class="btn btn-primary text-light">
                            Czytaj dalej <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
                <div class="d-flex justify-content-left">
                    <a class="btn btn-info text-light"
                        href="{{ route('articles.edit', ['article' => $article]) }}">Edytuj</a>
                    <form action="{{ route('articles.delete', ['article' => $article]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Usuń</button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>

        <div class="bg-white col-md-3 my-4">
            <p class="text-left my-3 mx-4" style="font-weight:bold;">
                Najnowsze artykuły
            </p>
            <div class="my-4">
                <div class="card-deck">
                    @foreach($articles as $article)
                    <div class="card mb-3 bg-white mx-3 border-0">
                        <div class="align-left">
                            @if($article->main_image_path)
                            <img class="rounded" style="max-width: 15rem; max-height:15rem;"
                                src="{{ asset('images/article/main-photo/' . $article->main_image_path) }}"
                                alt="Card image cap">
                            @else
                            <img class="rounded" style="max-width: 15rem; max-height:15rem;"
                                src="{{ asset('images/article/default-images/' . ($files[array_rand($files)])) }}"
                                alt="Default Image">
                            @endif
                            <div class="card-body">
                                <a class="card-title text-decoration-none text-black"
                                    href="{{ route('articles.show', ['article' => $article]) }}">
                                    <p class="card-title title-hover" style="font-weight:bold;font-size: 12px;">
                                        {{ $article->title }}
                                    </p>
                                </a>
                                <p class="card-text"><small>{{ $article->updated_at->format('d M Y') }}</small></p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <p class="text-left my-3 mx-4" style="font-weight:bold;">Najnowsze komentarze</p>
            </div>
        </div>
    </div>
</div>
@endsection