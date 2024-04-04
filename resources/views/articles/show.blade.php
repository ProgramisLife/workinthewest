@extends('layouts.app')

@section('content')

<div class="container my-5" style="margin-top: 150px !important;">
    <a href="{{route('articles.index')}}" class="text-decoration-none offset-1">Artykuły</a>
    <h1 class="d-flex justify-content-center">{{$article->title}}</h1>
    <div class="d-flex justify-content-center my-4">
        @if($article->main_image_path)
        <img class="thumbnail mr-2" src="{{asset('images/article/main-photo/' . $article->main_image_path)}}" alt="Card image cap">
        @endif
    </div>
    <div class="container col-md-8">
        <h1>{{$article->title}}</h1>

        <p><b></b>Data publikacji: {{$article->updated_at->format('d-M-Y')}}</p>
        <p>{{$article->description}}</p>
        <div class="d-flex">
            <p>Źródło:</p>
            <a href="{{$article->source}}" class="text-decoration-none mx-3">
                {{$article->source}}
            </a>
        </div>
        @if(isset($article->youtube))
        <a href="{{$article->source}}">Youtube</a>
        @endif
        @if(isset($article->facebook))
        <a href="{{$article->source}}">facebook</a>
        @endif
        @if(isset($article->vimeo))
        <a href="{{$article->source}}">vimeo</a>
        @endif
        @if(isset($article->linkedin))
        <a href="{{$article->source}}">linkedin</a>
        @endif
        <div class="d-flex justify-content-start">
            @if($nextArticle)
            <div class="d-flex text-center mt-3">
                <p>Następny artykuł</p>
                <a href="{{ route('articles.show', ['article' => $nextArticle]) }}" class="text-decoration-none mx-2">{{$nextArticle->title}}</a>
            </div>
            @endif
        </div>

        <div class="d-flex justify-content-start">
            @if($previousArticle)
            <div class="d-flex text-center mt-3">
                <p>Poprzedni artykuł</p>
                <a href="{{ route('articles.show', ['article' => $previousArticle]) }}" class="text-decoration-none mx-2">{{$previousArticle->title}}</a>
            </div>
            @endif
        </div>
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
                        <img class="rounded" style="max-width: 15rem; max-height:15rem;" src="{{ asset('images/article/main-photo/' . $article->main_image_path) }}" alt="Card image cap">
                        @else
                        <img class="rounded" style="max-width: 15rem; max-height:15rem;" src="{{ asset('images/article/default-images/' . ($files[array_rand($files)])) }}" alt="Default Image">
                        @endif
                        <div class="card-body">
                            <a class="card-title text-decoration-none text-black" href="{{ route('articles.show', ['article' => $article]) }}">
                                <p class="card-title title-hover" style="font-weight:bold;font-size: 12px;">{{ $article->title }}</p>
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

@endsection