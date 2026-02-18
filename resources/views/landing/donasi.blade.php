@extends('layout.main')

@section('hero-title')
    Saluran Berkat Melalui Persembahan Anda
@endsection


@section('content')
    <div class="">
        @include('partials.donasi.hero')
        @include('partials.donasi.metode')
    </div>
@endsection
