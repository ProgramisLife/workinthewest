@extends('layouts.app')

@section('title', 'Dodaj nowe ogłoszenie')

@section('content')
<div class="container">
    <div class="row py-5">
        <div class="d-flex justify-content-center">
            @include('accommodation.form', [
            'action' => route('accommodation.store'),
            'titleValue' => old('title'),
            'descriptionValue' => old('description'),
            'emailValue' => old('email'),
            'contactValue' => old('contact'),
            'phoneNumber' => old('phone_number'),
            'priceBuyValue' => old('price_buy'),
            'priceRentValue' => old('price_rent'),
            'expiryValue' => old('expiry'),
            'submitBtnText' => 'Dodaj nowe ogłoszenie',
            ])
        </div>
    </div>
</div>

@endsection