@extends('layouts.app')

@section('title', 'Dodaj ofertę pracy')

@section('content')
<div class="container">
    <div class="row py-5">
        <div class="d-flex justify-content-center">
            @include('jobs.form', [
            'action' => route('jobs.store'),
            'titleValue' => old('title'),
            'descriptionValue' => old('description'),
            'emailValue' => old('email'),
            'categoryValue' => old('categories'),
            'typeValue' => old('type', []),
            'levelValue' => old('levels', []),
            'salaryFromValue' => old('salary-from'),
            'salaryToValue' => old('salary-to'),
            'currencyValue' => old('currency'),
            'languageValue' => old('language', []),
            'sexOptionValue' => old('sex'),
            'deadlineValue' => old('deadline'),
            'skillValue' => old('skills', []),
            'submitBtnText' => 'Dodaj nową pracę',
            ])
        </div>
    </div>
</div>

@endsection