@extends('layout.main')

@section('hero-title')
    Gembala Berkarya
@endsection


@section('content')
    <div class="">
        @include('partials.gembala.hero')
        @include('partials.gembala.profile')
        @include('components.cta-terhubung')
    </div>
@endsection
