@extends('layout.main')

@section('hero-title')
    SSD
@endsection


@section('content')
    <div class="">
        @include('partials.ssd.hero')
        @include('partials.ssd.accordion')
        @include('components.cta-terhubung')
    </div>
@endsection
