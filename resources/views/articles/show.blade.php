@extends('layouts.app')

@section('content')

<div class="container my-5" style="margin-top: 150px !important;">
    <h1 class="d-flex justify-content-center">{{$article->title}}</h1>
    <div class="d-flex justify-content-center">
        @if($article->main_image_path)
        <img class="thumbnail mr-2" src="{{asset('images/article/main-photo/' . $article->main_image_path)}}" alt="Card image cap">
        @endif
    </div>
    <div class="container col-md-8">
        <h1>{{$article->title}}</h1>
        <a href="{{route('articles.index')}}">Artykuły</a>
        <p>Data publikacji</p>
        <p>{{$article->description}}</p>
        <a href="{{$article->source}}">Źródło</a>
        @if(isset($article->youtube))
        <a href="{{$article->source}}">Youtube</a>
        @endif
        @if(isset($article->facebook))
        <a href="{{$article->source}}">facebook</a>
        @endif
    </div>
</div>

@endsection