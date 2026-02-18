@extends('layout.admin')

@section('title', 'Bintaran')

@section('content')

<div class="flex flex-col justify-start text-left fs-style-manrope py-6">
    <h1 class="admin-page-title">Tulisan Bintaran</h1>
    <p class="text-sm text-gray-500 mt-1">Kelola artikel, berita, dan publikasi Paroki Bintaran</p>
</div>

<div class="bg-white border-y md:border border-gray-200 shadow-sm md:shadow md:rounded-xl">
    <div class="flex border-b border-gray-200 overflow-x-auto whitespace-nowrap">
        <a
            href="{{ route('admin.blog.index', 'semua') }}"
            class="px-6 py-3 text-[12px] md:text-sm mobile-font-tiny transition-colors border-b-2 -mb-px outline-none focus:outline-none {{ $tab === 'semua' ? 'font-semibold' : 'text-gray-500 font-medium border-transparent hover:text-gray-700 hover:border-gray-300' }}"
            style="{{ $tab === 'semua' ? 'border-bottom: 2px solid #8C1007; color: #8C1007;' : '' }}"
        >
            Semua Tulisan
        </a>

        <a
            href="{{ route('admin.blog.index', 'tambah') }}"
            class="px-6 py-3 text-[12px] md:text-sm mobile-font-tiny transition-colors border-b-2 -mb-px outline-none focus:outline-none {{ $tab === 'tambah' ? 'font-semibold' : 'text-gray-500 font-medium border-transparent hover:text-gray-700 hover:border-gray-300' }}"
            style="{{ $tab === 'tambah' ? 'border-bottom: 2px solid #8C1007; color: #8C1007;' : '' }}"
        >
            Tambah Tulisan
        </a>

        <a
            href="{{ route('admin.blog.index', 'kategori') }}"
            class="px-6 py-3 text-[12px] md:text-sm mobile-font-tiny transition-colors border-b-2 -mb-px outline-none focus:outline-none {{ $tab === 'kategori' ? 'font-semibold' : 'text-gray-500 font-medium border-transparent hover:text-gray-700 hover:border-gray-300' }}"
            style="{{ $tab === 'kategori' ? 'border-bottom: 2px solid #8C1007; color: #8C1007;' : '' }}"
        >
            Kelola Kategori Tulisan
        </a>
    </div>

    <div class="px-4 sm:px-6 py-4">
        @if($tab === 'semua')
            @include('admin.pages.blog.semua')
        @elseif($tab === 'tambah')
            @include('admin.pages.blog.tambah')
        @elseif($tab === 'kategori')
            @include('admin.pages.blog.kategori')
        @endif
    </div>
</div>

@endsection






