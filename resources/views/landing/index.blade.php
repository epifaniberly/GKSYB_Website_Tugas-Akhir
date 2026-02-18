@extends('layout.main')

@section('hero-class')
    min-h-[500px] h-screen
@endsection

@section('hero-subtitle')
    Selamat Datang di
@endsection

@section('hero-title')
    {{ $identitasGlobal->nama_website ?? 'Gereja Santo Yusup Bintaran' }}
@endsection

@section('hero-desc')
    {{ $profil->deskripsi ?? 'Menapak dari masa kolonial, Gereja Santo Yusup Bintaran menjadi simbol spiritual dan sejarah. Perpaduan arsitektur Belanda dan nuansa Jawa menjadikannya ruang doa sekaligus lambang kebersamaan umat.' }}
@endsection

@section('hero-action')
    <a href="{{ route('landing.sejarah') }}" class="btn-accent px-4 md:px-6 py-1.5 md:py-2.5 text-[10px] md:text-base">
        Tilik Sejarah
    </a>
@endsection

@section('content')
    <div class="">
        @include('partials.mainpage.hero')
        @include('partials.mainpage.jadwal')
        @include('partials.mainpage.kegiatan')
        @include('partials.mainpage.medsos')
        @include('partials.mainpage.aksesumat')
        @include('partials.mainpage.blog')
        @include('components.cta-terhubung')
    </div>
@endsection
