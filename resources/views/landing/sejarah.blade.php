@extends('layout.main')

@section('hero-title')
    Tilik Sejarah
@endsection


@section('content')
    <div class="">
        @include('partials.sejarah.carousels')
        @include('partials.sejarah.description')
        @include('partials.sejarah.maps')
        @include('components.cta-terhubung')
    </div>
@endsection
