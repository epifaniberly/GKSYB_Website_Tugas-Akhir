@extends('layout.admin')

@section('title', 'Dashboard Sekre')

@section('content')

<div class="flex flex-col justify-start text-left fs-style-manrope py-6">
    <h1 class="admin-page-title">Pengaturan Website</h1>
    <p class="text-sm text-gray-500 mt-1">Kelola pengaturan umum website paroki</p>
</div>
<div class="bg-white border border-gray-200 shadow-sm rounded-xl overflow-hidden">
    <div class="flex border-b border-gray-100 overflow-x-auto whitespace-nowrap bg-white">
        <a
            href="{{ route('admin.settings.index', 'identitas') }}"
            class="px-6 py-3 text-[12px] md:text-sm mobile-font-tiny transition-colors border-b-2 -mb-px outline-none focus:outline-none {{ $tab === 'identitas' ? 'font-semibold' : 'text-gray-500 font-medium border-transparent hover:text-gray-700 hover:border-gray-300' }}"
            style="{{ $tab === 'identitas' ? 'border-bottom: 2px solid #8C1007; color: #8C1007;' : '' }}"
        >
            Identitas Website
        </a>

        <a
            href="{{ route('admin.settings.index', 'kontak') }}"
            class="px-6 py-3 text-[12px] md:text-sm mobile-font-tiny transition-colors border-b-2 -mb-px outline-none focus:outline-none {{ $tab === 'kontak' ? 'font-semibold' : 'text-gray-500 font-medium border-transparent hover:text-gray-700 hover:border-gray-300' }}"
            style="{{ $tab === 'kontak' ? 'border-bottom: 2px solid #8C1007; color: #8C1007;' : '' }}"
        >
            Kontak & Jam Pelayanan
        </a>

        <a
            href="{{ route('admin.settings.index', 'medsos') }}"
            class="px-6 py-3 text-[12px] md:text-sm mobile-font-tiny transition-colors border-b-2 -mb-px outline-none focus:outline-none {{ $tab === 'medsos' ? 'font-semibold' : 'text-gray-500 font-medium border-transparent hover:text-gray-700 hover:border-gray-300' }}"
            style="{{ $tab === 'medsos' ? 'border-bottom: 2px solid #8C1007; color: #8C1007;' : '' }}"
        >
            Media Sosial
        </a>

        <a
            href="{{ route('admin.settings.index', 'seo') }}"
            class="px-6 py-3 text-[12px] md:text-sm mobile-font-tiny transition-colors border-b-2 -mb-px outline-none focus:outline-none {{ $tab === 'seo' ? 'font-semibold' : 'text-gray-500 font-medium border-transparent hover:text-gray-700 hover:border-gray-300' }}"
            style="{{ $tab === 'seo' ? 'border-bottom: 2px solid #8C1007; color: #8C1007;' : '' }}"
        >
            SEO & Meta Tags
        </a>
    </div>
    <div class="px-6 py-4">
        @if($tab === 'identitas')
            @include('admin.pages.settings.identitas')
        @elseif($tab === 'kontak')
            @include('admin.pages.settings.kontak')
        @elseif($tab === 'medsos')
            @include('admin.pages.settings.medsos')
        @elseif($tab === 'seo')
            @include('admin.pages.settings.seo')
        @endif
    </div>
</div>
@endsection






