@extends('layout.main')

@section('hero-class', 'min-h-[120px] h-auto py-6 md:py-0')

@section('hero-title')
    Tulisan Bintaran
@endsection

@section('hero-desc')
    “Kumpulan tulisan berisi informasi, inspirasi, dan refleksi iman 
    untuk meneguhkan kehidupan rohani serta keterlibatan umat.”
@endsection

@section('content')
    <div class="bg-[#FCFAF7]">
        @include('partials.tulisan.hero')
        @include('partials.tulisan.kegiatan')
        @include('partials.tulisan.semua')
    </div>
@endsection
