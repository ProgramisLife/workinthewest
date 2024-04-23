@extends('layouts.app')

@section('title', 'Edytuj artykuł')

@section('content')
<div class="container">
    <div class="row py-5">
        <div class="d-flex justify-content-center">
            @include('accommodation.form', [
            'action' => route('accommodation.update', ['job' => $job]),
            'titleValue' => old('title', $job->title),
            'descriptionValue' => old('description', $job->description),
            'emailValue' => old('email', $job->email),
            'categoryValue' => old('categories' ,$job->jobcategory_id),
            'typeValue' => old('type', $job->jobtype->pluck('id')->toArray()),
            'levelValue' => old('levels', $job->joblevel_id),
            'salaryFromValue' => old('salary_from', $job->salary_from),
            'salaryToValue' => old('salary_to', $job->salary_to),
            'currencyValue' => old('currency', $job->currencies_id),
            'languageValue' => old('language', optional($job->language)->isNotEmpty() ? $job->language->pluck('id')->toArray() : []),
            'sexOptionValue' => old('sex', $job->sex),
            'deadlineValue' => old('deadline', optional($job->deadline)->format('Y-m-d')),
            'skillValue' => old('skills', optional($job->skill)->isNotEmpty() ? $job->skill->pluck('id')->toArray() : []),
            'submitBtnText' => 'Zaktualizuj ofertę pracy',
            'method' => 'PUT'
            ])
        </div>
    </div>
</div>

@endsection