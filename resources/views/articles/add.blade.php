@extends('layouts.app')

@section('title', 'Dodaj artykuł')

@section('content')
<div class="container">
    <div class="row py-5">
        <div class="d-flex justify-content-center">
            @include('articles.form', [
            'action' => route('articles.store'),
            'titleValue' => old('title'),
            'descriptionValue' => old('description'),
            'sourceValue' => old('source'),
            'youtubeValue' => old('youtube'),
            'facebookValue' => old('facebook'),
            'vimeoValue' => old('vimeo'),
            'xValue' => old('x'),
            'linkedinValue' => old('linkedin'),
            'submitBtnText' => 'Dodaj nowy artykuł',
            ])
        </div>
    </div>
</div>

@endsection