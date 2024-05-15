@extends('layouts.app')

<link rel="stylesheet" href="{{ asset('assets/css/accommodation/show.css') }}" />

@section('content')
<!-- Top -->
<div class="section">
    <div class="jumbotron jumbotron-fluid img img-fluid top"
        style="background-image: url('{{asset('assets/images/bg-info-home-3.png') }}'); background-repeat: no-repeat; background-size: cover;">
        <div class="container text-center">
            <h1 class="top-header fw-bold text-uppercase py-4">{{$data['label']['top']['top-header']}}</h1>
        </div>
    </div>
</div>

<!-- Main -->
<div class="col-md-6 mx-auto">
    @foreach($accommodationShows as $accommodationShow)
    <h3>{{$accommodationShow->title}}</h3>
    <p>{{$accommodationShow->email}}</p>
    <p>{!!$accommodationShow->description!!}</p>
    {{$accommodationShow->contact}}
    {{$accommodationShow->phone_number}}
    @if(isset($accommodationShow->price_buy))
    {{$accommodationShow->price_buy}}
    @endif
    @if(isset($accommodationShow->price_rent))
    {{$accommodationShow->price_rent}}
    @endif
    {{$accommodationShow->expiry}}
    @endforeach
</div>
@endsection