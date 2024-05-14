@extends('layouts.app')

@section('title', 'Edytuj ofertę pracy')

@section('content')
<div class="container my-5">
    <div class="row py-5">
        <div class="d-flex justify-content-center">
            @include('jobs.form', [
            'action' => route('jobs.update', ['job' => $job]),
            'titleValue' => old('title', $job->title),
            'descriptionValue' => old('description', $job->description),
            'emailValue' => old('email', $job->email),
            'categoryValue' => old('categories' ,$job->jobcategory_id),
            'typeValue' => old('type', $job->jobtype->pluck('id')->toArray()),
            'levelValue' => old('levels', $job->joblevel_id),
            'salaryFromValue' => old('salary_from', $job->salary_from),
            'salaryToValue' => old('salary_to', $job->salary_to),
            'currencyValue' => old('currency', $job->currencies_id),
            'languageValue' => old('language', optional($job->language)->isNotEmpty() ?
            $job->language->pluck('id')->toArray() : []),
            'sexOptionValue' => old('sex', $job->sex),
            'deadlineValue' => old('deadline', $job->deadline),
            'skillValue' => old('skills', optional($job->skill)->isNotEmpty() ? $job->skill->pluck('id')->toArray() :
            []),
            'jobstateValue' => old('jobstate', optional($job->jobstate)->isNotEmpty() ?
            $job->jobstate->pluck('id')->toArray() : []),
            'countryValue' => old('countries', $job->country_id),
            'stateValue' => old('states', $job->state_id),
            'cityValue' => old('cities', $job->city_id),
            'submitBtnText' => 'Zaktualizuj ofertę pracy',
            'method' => 'PUT'
            ])
        </div>
    </div>
</div>

@endsection