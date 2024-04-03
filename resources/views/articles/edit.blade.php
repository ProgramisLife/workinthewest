@extends('layouts.app')

@section('title', 'Edytuj artykuł')

@section('content')
<div class="container">
    <div class="row py-5">
        <div class="d-flex justify-content-center">
            @include('articles.form', [
            'action' => route('articles.update', ['article' => $article]),
            'titleValue' => old('title', $article->title),
            'descriptionValue' => old('description', $article->description),
            'sourceValue' => old('source', $article->source),
            'youtubeValue' => old('youtube', $article->youtube),
            'facebookValue' => old('facebook', $article->facebook),
            'vimeoValue' => old('vimeo', $article->vimeo),
            'xValue' => old('x', $article->x),
            'linkedinValue' => old('linkedin', $article->linkedin),
            'submitBtnText' => 'Edytuj artykuł',
            'method' => 'PUT',
            ])
        </div>
    </div>
</div>

@endsection