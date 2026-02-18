@extends('layout.admin')

@section('title', 'Dokumen Paroki')

@section('content')
<div class="flex flex-col justify-start text-left fs-style-manrope py-6">
    <h1 class="admin-page-title">Dokumen Paroki</h1>
    <p class="text-sm text-gray-500 mt-1">Kelola dan simpan dokumen penting Paroki Bintaran</p>
</div>
<div class="bg-white border border-gray-200 shadow rounded-xl fs-style-manrope">
    <div class="flex border-b border-gray-200 overflow-x-auto whitespace-nowrap">
        <a
            href="{{ route('admin.dokparoki.index', 'semua') }}"
            class="px-6 py-3 text-[12px] md:text-sm mobile-font-tiny transition-colors border-b-2 -mb-px outline-none focus:outline-none {{ $tab === 'semua' ? 'font-semibold' : 'text-gray-500 font-medium border-transparent hover:text-gray-700 hover:border-gray-300' }}"
            style="{{ $tab === 'semua' ? 'border-bottom: 2px solid #8C1007; color: #8C1007;' : '' }}"
        >
            Semua Dokumen
        </a>

        <a
            href="{{ route('admin.dokparoki.index', 'tambah') }}"
            class="px-6 py-3 text-[12px] md:text-sm mobile-font-tiny transition-colors border-b-2 -mb-px outline-none focus:outline-none {{ $tab === 'tambah' ? 'font-semibold' : 'text-gray-500 font-medium border-transparent hover:text-gray-700 hover:border-gray-300' }}"
            style="{{ $tab === 'tambah' ? 'border-bottom: 2px solid #8C1007; color: #8C1007;' : '' }}"
        >
            Tambah Dokumen
        </a>

        <a
            href="{{ route('admin.dokparoki.index', 'kategori') }}"
            class="px-6 py-3 text-[12px] md:text-sm mobile-font-tiny transition-colors border-b-2 -mb-px outline-none focus:outline-none {{ $tab === 'kategori' ? 'font-semibold' : 'text-gray-500 font-medium border-transparent hover:text-gray-700 hover:border-gray-300' }}"
            style="{{ $tab === 'kategori' ? 'border-bottom: 2px solid #8C1007; color: #8C1007;' : '' }}"
        >
            Kelola Kategori Dokumen
        </a>
    </div>

    <div class="px-6 py-4">
        @if($tab === 'semua')
            @include('admin.pages.dokparoki.semua')
        @elseif($tab === 'tambah')
            @include('admin.pages.dokparoki.tambah')
        @elseif($tab === 'kategori')
            @include('admin.pages.dokparoki.kategori')
        @endif
    </div>
</div>
@endsection






