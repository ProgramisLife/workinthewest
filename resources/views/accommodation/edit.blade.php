@extends('layouts.app')

@section('title', 'Edytuj artykuł')

@section('content')
<div class="container">
    <div class="row py-5">
        <div class="d-flex justify-content-center">
            @include('accommodation.form', [
            'action' => route('accommodation.store', ['accommodation' => $accommodation]),
            'titleValue' => old('title', $accommodation->title),
            'descriptionValue' => old('description', $accommodation->description),
            'emailValue' => old('email', $accommodation->email),
            'contactValue' => old('contact', $accommodation->email),
            'phoneNumber' => old('phone_number', $accommodation->phone_number),
            'priceBuyValue' => old('price_buy', $accommodation->price_buy),
            'priceRentValue' => old('price_rent', $accommodation->price_rent),
            'expiryValue' => old('expiry', $accommodation->expiry),
            'submitBtnText' => 'Zaktualizuj ogłoszenie',
            'method' => 'PUT'
            ])
        </div>
    </div>
</div>

@endsection