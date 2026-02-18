@extends('layout.admin')

@section('title', 'FAQ Management')

@section('content')

<div class="flex flex-col justify-start text-left fs-style-manrope py-6">
    <h1 class="admin-page-title">Soal Sering Ditanya (SSD)</h1>
    <p class="text-sm text-gray-500 mt-1">Kelola pertanyaan yang sering ditanyakan oleh umat</p>
</div>
<div class="bg-white border border-gray-200 shadow rounded-xl">
    <div class="flex border-b border-gray-200 overflow-x-auto whitespace-nowrap">
        <a
            href="{{ route('admin.faq.index', 'semua') }}"
            class="px-6 py-3 text-[12px] md:text-sm mobile-font-tiny transition-colors border-b-2 -mb-px outline-none focus:outline-none focus:ring-0 {{ $tab === 'semua' ? 'font-semibold' : 'text-gray-500 font-medium border-transparent hover:text-gray-700 hover:border-gray-300' }}"
            style="{{ $tab === 'semua' ? 'border-bottom: 2px solid #8C1007; color: #8C1007;' : '' }}"
        >
            Semua SSD
        </a>

        <a
            href="{{ route('admin.faq.index', 'tambah') }}"
            class="px-6 py-3 text-[12px] md:text-sm mobile-font-tiny transition-colors border-b-2 -mb-px outline-none focus:outline-none focus:ring-0 {{ $tab === 'tambah' ? 'font-semibold' : 'text-gray-500 font-medium border-transparent hover:text-gray-700 hover:border-gray-300' }}"
            style="{{ $tab === 'tambah' ? 'border-bottom: 2px solid #8C1007; color: #8C1007;' : '' }}"
        >
            Tambah SSD
        </a>

        <a
            href="{{ route('admin.faq.index', 'kategori') }}"
            class="px-6 py-3 text-[12px] md:text-sm mobile-font-tiny transition-colors border-b-2 -mb-px outline-none focus:outline-none focus:ring-0 {{ $tab === 'kategori' ? 'font-semibold' : 'text-gray-500 font-medium border-transparent hover:text-gray-700 hover:border-gray-300' }}"
            style="{{ $tab === 'kategori' ? 'border-bottom: 2px solid #8C1007; color: #8C1007;' : '' }}"
        >
            Kelola Kategori SSD
        </a>
    </div>

    <div class="px-6 py-4">
        @if($tab === 'semua')
            @include('admin.pages.faq.semua')
        @elseif($tab === 'tambah')
            @include('admin.pages.faq.tambah')
        @elseif($tab === 'kategori')
            @include('admin.pages.faq.kategori')
        @endif
    </div>
</div>
@endsection





