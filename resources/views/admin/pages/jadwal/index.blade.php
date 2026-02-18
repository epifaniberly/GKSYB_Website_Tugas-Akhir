@extends('layout.admin')

@section('title', 'Dashboard Sekre')

@section('content')

<div class="flex flex-col justify-start text-left fs-style-manrope py-6">
    <h1 class="admin-page-title">Jadwal Ibadat & Devosi</h1>
    <p class="text-sm text-gray-500 mt-1">Kelola jadwal Misa, doa, dan perayaan liturgi Paroki Bintaran</p>
</div>

<div class="bg-white border border-gray-200 shadow rounded-xl">
    <div class="flex border-b border-gray-200 overflow-x-auto whitespace-nowrap">
        <a
            href="{{ route('admin.jadwal.index') }}"
            class="px-6 py-3 text-[12px] md:text-sm mobile-font-tiny transition-colors border-b-2 -mb-px outline-none focus:outline-none {{ $tab === 'semua' ? 'font-semibold' : 'text-gray-500 font-medium border-transparent hover:text-gray-700 hover:border-gray-300' }}"
            style="{{ $tab === 'semua' ? 'border-bottom: 2px solid #8C1007; color: #8C1007;' : '' }}"
        >
            Semua Jadwal
        </a>

        <a
            href="{{ route('admin.jadwal.index', 'tambah') }}"
            class="px-6 py-3 text-[12px] md:text-sm mobile-font-tiny transition-colors border-b-2 -mb-px outline-none focus:outline-none {{ $tab === 'tambah' ? 'font-semibold' : 'text-gray-500 font-medium border-transparent hover:text-gray-700 hover:border-gray-300' }}"
            style="{{ $tab === 'tambah' ? 'border-bottom: 2px solid #8C1007; color: #8C1007;' : '' }}"
        >
            Tambah Jadwal
        </a>

        <a
            href="{{ route('admin.jadwal.index', 'kategori') }}"
            class="px-6 py-3 text-[12px] md:text-sm mobile-font-tiny transition-colors border-b-2 -mb-px outline-none focus:outline-none {{ $tab === 'kategori' ? 'font-semibold' : 'text-gray-500 font-medium border-transparent hover:text-gray-700 hover:border-gray-300' }}"
            style="{{ $tab === 'kategori' ? 'border-bottom: 2px solid #8C1007; color: #8C1007;' : '' }}"
        >
            Kelola Kategori Jadwal
        </a>
    </div>
    <div class="px-6 py-4">
        @if($tab === 'semua')
            @include('admin.pages.jadwal.semua')
        @elseif($tab === 'tambah')
            @include('admin.pages.jadwal.tambah')
        @elseif($tab === 'kategori')
            @include('admin.pages.jadwal.kategori')
        @endif
    </div>
</div>

@endsection







