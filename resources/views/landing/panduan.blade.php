@extends('layout.main')

@section('hero-title')
     Panduan Perayaan Ekaristi
@endsection

@section('content')
    <div class="">
        @include('partials.panduan.hero')
        @include('partials.panduan.card')
    </div>
    @include('components.cta-terhubung')
@endsection

