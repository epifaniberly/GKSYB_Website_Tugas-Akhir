@extends('layout.main')

@section('hero-title')
    <a href="{{ route('landing.panduan') }}" 
       class="fixed left-4 md:left-10 top-1/2 -translate-y-1/2 z-[100] group flex items-center justify-center w-10 h-10 md:w-14 md:h-14 bg-[#8C1007] border border-white/20 rounded-full text-white shadow-2xl hover:bg-[#8C1007]/90 hover:scale-110 active:scale-95 transition-all duration-300"
       title="Kembali ke Daftar Panduan">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5 md:w-7 md:h-7 group-hover:-translate-x-1 transition-transform">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
        </svg>
    </a>
    {{ $panduan->jenis_misa }}
@endsection

@section('content')
<section class="w-full py-16 fs-style-manrope" data-aos="fade-up">
    <div class="container mx-auto px-8 md:px-16 lg:px-24 max-w-7xl">
        
        <div class="text-center mb-12 px-4">
            <h2 class="text-2xl md:text-4xl font-semibold text-[#3A0D0D] mb-4">
                {{ $panduan->perayaan }}
            </h2>
            <p class="text-[#3A0D0D]/60 text-sm md:text-lg mb-6 leading-relaxed">
                {{ $panduan->ket_perayaan }}
            </p>
            <div class="flex items-center justify-center gap-2 text-[#8C1007] font-medium text-sm md:text-base bg-[#8C1007]/5 w-fit mx-auto px-4 py-2 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 md:w-5 md:h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                </svg>
                <span>
                    @if($panduan->tanggal)
                        {{ \Carbon\Carbon::parse($panduan->tanggal)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}
                    @elseif($panduan->tanggal_mulai && $panduan->tanggal_akhir)
                        {{ \Carbon\Carbon::parse($panduan->tanggal_mulai)->locale('id')->isoFormat('D MMMM YYYY') }} - {{ \Carbon\Carbon::parse($panduan->tanggal_akhir)->locale('id')->isoFormat('D MMMM YYYY') }}
                    @endif
                </span>
            </div>
        </div>

        @if($panduan->ayat_alkitab)
        <div class="max-w-4xl mx-auto text-center mb-16 px-6">
            <h3 class="text-lg md:text-2xl font-semibold text-[#3E0703] leading-tight mb-4 italic">
                “{{ strip_tags($panduan->ayat_alkitab) }}”
            </h3>
            <p class="text-sm md:text-lg font-semibold text-[#3E0703] opacity-60">
                {{ $panduan->sumber_ayat ?? '-' }}
            </p>
            <div class="flex justify-center mt-8">
                <div class="w-12 h-0.5 bg-[#8C1007]/20 rounded-full"></div>
            </div>
        </div>
        @endif
        <div class="bg-white rounded-2xl md:rounded-[32px] overflow-hidden shadow-2xl border border-gray-100 mb-16">
            <div class="h-[75vh] w-full">
                <iframe src="{{ asset('storage/PanduanFile/' . $panduan->file) }}" class="w-full h-full" frameborder="0"></iframe>
            </div>
            
            <div class="p-6 md:p-8 bg-gray-50 flex flex-col md:flex-row items-center justify-between gap-6 border-t border-gray-100">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 md:w-12 md:h-12 bg-red-100 rounded-xl flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="#8C1007" class="w-5 h-5 md:w-6 md:h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m.75 12 3 3m0 0 3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                        </svg>
                    </div>
                    <div>
                        <p class="font-semibold text-[#3A0D0D] text-sm md:text-base">Unduh Berkas Panduan</p>
                        <p class="text-[10px] md:text-sm text-gray-400">Tersedia dalam format PDF</p>
                    </div>
                </div>
                
                <a href="{{ asset('storage/PanduanFile/' . $panduan->file) }}" 
                   download="{{ $panduan->original_filename ?? ($panduan->perayaan ? ($panduan->jenis_misa . ' - ' . $panduan->perayaan . '.pdf') : ($panduan->jenis_misa . '.pdf')) }}" 
                   onclick="Swal.fire({
                       icon: 'success',
                       title: 'Berhasil!',
                       text: 'Berkas panduan sedang diunduh...',
                       toast: true,
                       position: 'top-end',
                       showConfirmButton: false,
                       timer: 3000,
                       timerProgressBar: true,
                       iconColor: '#059669',
                       customClass: {
                           title: 'text-[#3E0703] font-bold',
                           popup: 'rounded-2xl border-none shadow-xl'
                       }
                   })"
                   class="btn-accent px-6 py-2 md:px-8 md:py-2.5 text-xs md:text-sm inline-flex items-center justify-center gap-2">
                    Unduh PDF
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 md:w-5 md:h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M7.5 12 12 16.5m0 0L16.5 12M12 16.5V3" />
                    </svg>
                </a>
            </div>
        </div>


    </div>
</section>

@include('components.cta-terhubung')
@endsection

