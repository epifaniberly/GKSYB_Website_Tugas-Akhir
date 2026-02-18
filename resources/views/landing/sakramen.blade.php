@extends('layout.main')

@section('hero-title')
    Sakramen Gereja Katolik
@endsection


@section('content')
    <div class="">
        @include('partials.sakramen.hero')
        @include('partials.sakramen.card')
    </div>
@endsection
