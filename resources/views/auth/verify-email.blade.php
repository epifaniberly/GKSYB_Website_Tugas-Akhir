@extends('layout.admin')

@section('title', 'Verifikasi Email')

@section('content')
<div class="min-h-[60vh] flex flex-col items-center justify-center font-manrope text-center">
    <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-200 max-w-md w-full">
        <div class="mb-6">
            <svg class="w-16 h-16 text-[#3E0703] mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
            </svg>
        </div>
        
        <h2 class="text-2xl font-semibold text-gray-800 mb-2">Verifikasi Email Anda</h2>
        <p class="text-gray-600 mb-6 text-sm">
            Terima kasih telah bergabung! Sebelum memulai, silakan verifikasi alamat email Anda dengan mengklik tautan yang baru saja kami kirimkan ke email Anda.
        </p>

        @if (session('message'))
            <div class="bg-green-50 text-green-700 p-3 rounded-lg text-sm mb-6">
                {{ session('message') }}
            </div>
        @endif

        <div class="flex flex-col gap-3">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit" class="w-full bg-[#3E0703] text-white py-3 rounded-xl font-semibold hover:opacity-90 transition-all">
                    Kirim Ulang Email Verifikasi
                </button>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-gray-500 hover:text-gray-800 py-2 text-sm font-semibold transition-all">
                    Keluar
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

