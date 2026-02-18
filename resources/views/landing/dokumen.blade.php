@extends('layout.main')

@section('hero-title')
    Dokumen Gereja
@endsection

@section('content')
    @include('partials.dokumen.hero')

    @include('partials.dokumen.content')

    @include('components.cta-terhubung')
@endsection

