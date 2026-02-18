@extends('layout.admin')

@section('title', 'Perayaan Ekaristi')

@section('content')
    <div class="flex flex-col justify-start text-left fs-style-manrope py-6">
        <h1 class="admin-page-title">Panduan Perayaan Ekaristi</h1>
        <p class="text-sm text-gray-500 mt-1">Kelola dokumen panduan tata cara Perayaan Ekaristi untuk berbagai perayaan liturgi</p>
    </div>
    <div class="bg-white border border-gray-200 shadow rounded-xl">
        <div class="flex border-b border-gray-200 overflow-x-auto whitespace-nowrap">
            <a
                href="{{ route('admin.panduan.index', 'semua') }}"
                class="px-6 py-3 text-[12px] md:text-sm mobile-font-tiny transition-colors border-b-2 -mb-px outline-none focus:outline-none {{ $tab === 'semua' ? 'font-semibold' : 'text-gray-500 font-medium border-transparent hover:text-gray-700 hover:border-gray-300' }}"
                style="{{ $tab === 'semua' ? 'border-bottom: 2px solid #8C1007; color: #8C1007;' : '' }}"
            >
                Semua Panduan
            </a>

            <a
                href="{{ route('admin.panduan.index', 'tambah') }}"
                class="px-6 py-3 text-[12px] md:text-sm mobile-font-tiny transition-colors border-b-2 -mb-px outline-none focus:outline-none {{ $tab === 'tambah' ? 'font-semibold' : 'text-gray-500 font-medium border-transparent hover:text-gray-700 hover:border-gray-300' }}"
                style="{{ $tab === 'tambah' ? 'border-bottom: 2px solid #8C1007; color: #8C1007;' : '' }}"
            >
                Tambah Panduan
            </a>

        </div>

        <div class="px-6 py-4">
            @if($tab === 'semua')
                @include('admin.pages.panduan.semua')
            @elseif($tab === 'tambah')
                @include('admin.pages.panduan.tambah')
            @endif
        </div>
    </div>
@endsection






