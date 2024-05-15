@extends('layouts.app')

@section('content')

<div class="container" style="margin-top: 10rem;">
    <div class="offset-1 d-flex my-2">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('jobs.index')}}">Start</a></li>
                <li class="breadcrumb-item"><a href="{{route('articles.index')}}">Artykuły</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$article->title}}</li>
            </ol>
        </nav>
    </div>
    <h1 class="col-8 h1 text-align-center text-decoration-none offset-1">{{$article->title}}</h1>
    <div class="row">
        <div class="offset-lg-1 col-md-8">
            <div class="mb-4"></div>
            <div class="card bg-white">
                @if($article->main_image_path)
                <img class="card-img-top" src="{{asset('images/article/main-photo/' . $article->main_image_path)}}"
                    alt="Article Image">
                @endif
                <div class="card-body border-0">
                    <div class="h1 px-5 my-4">{{$article->title}}</div>
                    <div class="px-5 my-4"><b>Data publikacji:</b> {{$article->updated_at->format('d-M-Y')}}</div>
                    <div class="px-5">{!!$article->description!!}</div>
                    <div class="d-flex px-5 my-4">
                        <p>Źródło:</p>
                        <a href="{{$article->source}}" class="text-decoration-none mx-3">
                            {{$article->source}}
                        </a>
                    </div>
                    @if(isset($article->youtube) || isset($article->facebook) || isset($article->vimeo) ||
                    isset($article->linkedin))
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <p class="mb-0">Udostępnij:</p>
                        </div>
                        <div class="col display-6">
                            @if(isset($article->youtube))
                            <a href="{{$article->youtube}}"><i class="bi text-danger bi-youtube"></i></a>
                            @endif
                            @if(isset($article->facebook))
                            <a href="{{$article->facebook}}"><i class="bi bi-facebook"></i></a>
                            @endif
                            @if(isset($article->vimeo))
                            <a href="{{$article->vimeo}}"><i class="bi bi-vimeo"></i></a>
                            @endif
                            @if(isset($article->linkedin))
                            <a href="{{$article->linkedin}}"><i class="bi bi-linkedin"></i></a>
                            @endif
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            <div class="d-flex justify-content-start">
                @if($previousArticle)
                <div class="d-flex text-center mt-3">
                    <p>Poprzedni artykuł: </p>
                    <a href="{{ route('articles.show', ['article' => $previousArticle]) }}"
                        class="text-decoration-none mx-2">{{$previousArticle->title}}</a>
                </div>
                @endif
            </div>
            <div class="d-flex justify-content-end">
                @if($nextArticle)
                <div class="d-flex text-center mt-3">
                    <p>Następny artykuł: </p>
                    <a href="{{ route('articles.show', ['article' => $nextArticle]) }}"
                        class="text-decoration-none mx-2">{{$nextArticle->title}}</a>
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
                                <p class="card-text"><small>{{ $article->updated_at->format('d-m-Y') }}</small></p>
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