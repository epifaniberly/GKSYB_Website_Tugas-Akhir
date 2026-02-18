@extends('layout.main')

@section('hero-title')
    Doa dan Perayaan Ekaristi
@endsection


@section('content')
    <div class="">
        @include('partials.doa.hero')
        @include('partials.doa.jadwal')
        @include('components.cta-cards')
        @include('partials.doa.stream')
    </div>
@endsection
