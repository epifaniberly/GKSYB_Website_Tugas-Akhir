@extends('layout.main')

@php
    $rawSlides = $sakramen->gambar_slide ?? [];
    if (is_string($rawSlides)) {
        $rawSlides = json_decode($rawSlides, true);
    }
    $slides = [];
    if (is_array($rawSlides)) {
        foreach ($rawSlides as $index => $item) {
            if (is_array($item)) {
                $file = $item['file'] ?? $item['path'] ?? $item['name'] ?? $item['url'] ?? null;
                if ($file) {
                    $slides[] = [
                        'file' => $file,
                        'caption' => $item['caption'] ?? $item['desc'] ?? $item['deskripsi'] ?? $item['title'] ?? $item['judul'] ?? null
                    ];
                }
            } else if (is_string($item)) {
                $slides[] = [
                    'file' => $item,
                    'caption' => null
                ];
            }
        }
    }
    $heroBg = count($slides) > 0 ? asset('storage/' . $slides[0]['file']) : asset('/assets/paroki.png');
@endphp

@section('hero-title')
    <div class="flex flex-col items-center gap-1 md:gap-4 py-4 md:py-12">
        <nav class="flex items-center gap-2 text-white/70 text-[10px] md:text-sm mb-0 md:mb-2 fs-style-manrope overflow-hidden max-w-full px-4">
            <a href="{{ route('landing.sakramen') }}" class="hover:text-white transition-colors font-light shrink-0">Sakramen</a>
            <span class="shrink-0">›</span>
            <span class="text-white font-medium truncate max-w-[180px] sm:max-w-[300px] md:max-w-xl" title="{{ $sakramen->judul_sakramen }}">
                {{ $sakramen->judul_sakramen }}
            </span>
        </nav>
        <div class="relative w-full flex flex-col items-center">
            <a href="{{ route('landing.sakramen') }}" 
               class="fixed left-4 md:left-10 top-1/2 -translate-y-1/2 z-[100] group flex items-center justify-center w-12 h-12 md:w-14 md:h-14 bg-[#8C1007] border border-white/20 rounded-full text-white shadow-2xl hover:bg-[#8C1007]/90 hover:scale-110 active:scale-95 transition-all duration-300"
               title="Kembali ke Daftar Sakramen">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-6 h-6 md:w-7 md:h-7 group-hover:-translate-x-1 transition-transform">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
            </a>

            <h1 class="hero-title fs-style-manrope text-xl sm:text-2xl md:text-4xl lg:text-5xl font-medium max-w-4xl mx-auto text-white">
                {{ $sakramen->judul_sakramen }}
            </h1>
        </div>
    </div>
@endsection

@section('content')
<div class="bg-[#FCFAF7] fs-style-manrope relative">
    <div class="absolute left-1/2 -translate-x-1/2 -top-7 md:-top-10 z-10">
        <div class="w-14 h-14 md:w-20 md:h-20 bg-[#FEF2F2] rounded-full flex items-center justify-center shadow-lg border-4 border-[#FCFAF7] overflow-hidden">
            @php
                $bridgeIcon = $sakramen->icon_sakramen
                    ? asset('storage/'.$sakramen->icon_sakramen)
                    : asset('/assets/doc.png');
            @endphp
            <img src="{{ $bridgeIcon }}" class="w-7 h-7 md:w-10 md:h-10 object-contain" alt="Sakramen Icon">
        </div>
    </div>
    <div class="container mx-auto px-8 md:px-20 max-w-5xl pt-24 pb-12 text-center">
        <div class="max-w-4xl mx-auto">
            <h2 class="text-xl md:text-3xl lg:text-4xl font-semibold italic text-[#3E0703] max-w-[400px] md:max-w-5xl mx-auto leading-tight mb-4 md:mb-6">
                “{{ strip_tags($sakramen->kutipan_ayat) }}”
            </h2>
            <p class="text-base md:text-lg lg:text-base font-semibold opacity-70 max-w-4xl mx-auto mb-6">
                {{ $sakramen->sumber_ayat ?? '-' }}  
            </p>

        </div>
    </div>

    @if(count($slides) > 0)
    <div class="container mx-auto px-10 md:px-16 lg:px-20 max-w-4xl py-12">
        <div class="relative group">
            <div class="absolute -top-12 right-0 z-20 fs-style-manrope text-[#3b0d0d] font-medium tracking-widest text-sm opacity-60">
                <span id="gallery-current">01</span> / <span id="gallery-total">{{ str_pad(count($slides), 2, '0', STR_PAD_LEFT) }}</span>
            </div>
            <div class="swiper art-gallery-swiper overflow-visible">
                <div class="swiper-wrapper">
                    @foreach($slides as $slide)
                    <div class="swiper-slide">
                        <img src="{{ asset('storage/' . $slide['file']) }}" 
                             class="w-full aspect-[16/9] object-cover rounded-none" 
                             alt="Detail {{ $sakramen->judul_sakramen }}">
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="mt-12 flex items-center justify-between border-t border-[#3b0d0d]/10 pt-8 max-w-xs mx-auto">
                <button class="art-prev p-2 group cursor-pointer transition-transform active:scale-95">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-[#3b0d0d] opacity-40 group-hover:opacity-100 transition-opacity">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                    </svg>
                </button>
                <div class="flex-1 flex justify-center">
                    <div class="swiper-pagination !static !w-auto"></div>
                </div>

                <button class="art-next p-2 group cursor-pointer transition-transform active:scale-95">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-[#3b0d0d] opacity-40 group-hover:opacity-100 transition-opacity">
                      <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5l7.5 7.5-7.5 7.5" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
    @endif
    <div class="container mx-auto px-8 md:px-20 max-w-4xl pt-2 pb-12">
        <div class="text-[#3E0703] text-[11px] md:text-lg leading-relaxed whitespace-pre-line text-justify px-2 md:px-0">
            {!! $sakramen->deskripsi_lengkap !!}
        </div>
    </div>
    @include('components.cta-cards', [
        'title' => 'Akses Dokumen Sakramen dan Terhubung dengan Kami!',
        'desc' => 'Unduh dokumen penerimaan sakramen dan hubungi tim pastoral kami untuk setiap pertanyaan anda.',
        'link1' => route('landing.dokumen'),
        'label1' => 'Unduh Dokumen',
        'sublabel1' => 'Akses dokumen dan formulir resmi yang diperlukan untuk berbagai penerimaan sakramen di Gereja Santo Yusup Bintaran.'
    ])
</div>

<style>
    /* Hero Background with Blur Overlay Effect */
    .hero-section {
        background-image: url('{{ $heroBg }}');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
    }
    .hero-overlay {
        background: linear-gradient(rgba(62, 7, 3, 0.7), rgba(62, 7, 3, 0.9));
        backdrop-filter: blur(4px);
    }
    
    /* Pagination Bullets */
    .swiper-pagination-bullet {
        width: 6px !important;
        height: 6px !important;
        background: #3b0d0d !important;
        opacity: 0.2 !important;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        margin: 0 6px !important;
    }
    .swiper-pagination-bullet-active {
        opacity: 1 !important;
        transform: scale(1.5);
        background: #8C1007 !important;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Prepare captions data
        const captions = @json(array_column($slides, 'caption'));
        const captionEl = document.getElementById('active-sakramen-caption');
        const currentEl = document.getElementById('gallery-current');
        const totalEl = document.getElementById('gallery-total');

        // Debug: Log captions to console
        console.log('Sakramen Captions:', captions);

        const swiper = new Swiper('.art-gallery-swiper', {
            speed: 800,
            loop: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.art-next',
                prevEl: '.art-prev',
            },
            on: {
                init: function (s) {
                    updateUI(s);
                },
                slideChange: function (s) {
                    updateUI(s);
                }
            }
        });

        function updateUI(s) {
            // Update Counter
            if(currentEl) {
                currentEl.textContent = (s.realIndex + 1).toString().padStart(2, '0');
            }
            // Update Caption
            if(captionEl) {
                const caption = captions[s.realIndex];
                console.log('Current caption:', caption); // Debug
                
                if (caption && caption.trim() !== '') {
                    captionEl.textContent = caption;
                    captionEl.style.opacity = '1';
                } else {
                    captionEl.textContent = '';
                    captionEl.style.opacity = '0';
                }
            }
        }
    });
</script>
@endsection

