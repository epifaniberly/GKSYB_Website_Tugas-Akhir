@extends('layout.main')

@php
    // Merge single cover image and multiple images relationship
    $slides = [];
    
    // 1. Add cover image if exists
    if ($tulisan->image) {
        $coverCaption = null;
        // Search for this specific image in the related images to get its caption
        if ($tulisan->images) {
            foreach($tulisan->images as $relImg) {
                if($relImg->image === $tulisan->image) {
                    $coverCaption = $relImg->caption;
                    break;
                }
            }
        }
        
        $slides[] = [
            'file' => $tulisan->image,
            'caption' => $coverCaption
        ];
    }

    // 2. Add multiple images from relationship
    if ($tulisan->images && $tulisan->images->count() > 0) {
        foreach ($tulisan->images as $img) {
            // Check if cover image already added (to avoid dupes)
            if ($tulisan->image === $img->image) continue;
            
            $slides[] = [
                'file' => $img->image,
                'caption' => $img->caption
            ];
        }
    }
    
    // Header background
    $heroBg = count($slides) > 0 ? asset('storage/BintaranImage/' . $slides[0]['file']) : asset('/assets/paroki.png');
@endphp

@section('hero-title')
    <div class="flex flex-col items-center gap-2 md:gap-4 py-4 md:py-12">
        @php
            $catWarna = $tulisan->kategoriBintaran->warna ?? '#8C1007';
        @endphp
        <span class="px-3 py-1 md:px-4 md:py-1.5 text-[9px] md:text-[10px] font-bold rounded-full uppercase tracking-[0.2em] transition-colors fs-style-manrope shadow-lg mb-1"
              style="background-color: #ffffff; color: {{ $catWarna }};">
            {{ $tulisan->kategoriBintaran->nama_kategori ?? 'Berita' }}
        </span>
        <nav class="flex items-center gap-2 text-white/70 text-[10px] md:text-sm mb-0 md:mb-2 fs-style-manrope overflow-hidden max-w-full px-4">
            <a href="{{ route('landing.tulisan') }}" class="hover:text-white transition-colors font-light shrink-0">Tulisan Bintaran</a>
            <span class="shrink-0">›</span>
            <span class="text-white font-medium truncate max-w-[180px] sm:max-w-[300px] md:max-w-xl" title="{{ $tulisan->judul_tulisan }}">
                {{ $tulisan->judul_tulisan }}
            </span>
        </nav>
        <div class="relative w-full flex flex-col items-center">
            <a href="{{ route('landing.tulisan') }}" 
               class="fixed left-4 md:left-10 top-1/2 -translate-y-1/2 z-[100] group flex items-center justify-center w-12 h-12 md:w-14 md:h-14 bg-[#8C1007] border border-white/20 rounded-full text-white shadow-2xl hover:bg-[#8C1007]/90 hover:scale-110 active:scale-95 transition-all duration-300"
               title="Kembali ke Galeri Tulisan">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-6 h-6 md:w-7 md:h-7 group-hover:-translate-x-1 transition-transform">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
            </a>

            <h1 class="hero-title fs-style-manrope text-xl sm:text-2xl md:text-3xl lg:text-4xl font-medium max-w-4xl mx-auto text-white">
                “{{ $tulisan->judul_tulisan }}”
            </h1>
        </div>
    </div>
@endsection

@section('content')
<div class="bg-[#FCFAF7] fs-style-manrope relative">
    <div class="absolute left-1/2 -translate-x-1/2 -top-7 md:-top-10 z-10 flex flex-col items-center">
        <div class="w-14 h-14 md:w-20 md:h-20 bg-[#FEF2F2] rounded-full flex items-center justify-center shadow-lg border-4 border-[#FCFAF7] overflow-hidden">
            <img src="{{ $tulisan->user->foto_profil ? asset('storage/ProfileMedia/' . $tulisan->user->foto_profil) : 'https://ui-avatars.com/api/?name='.urlencode($tulisan->user->name ?? 'Komsos').'&background=random' }}" 
                 class="w-full h-full object-cover" alt="Author Icon">
        </div>
        <span class="mt-2 text-[9px] md:text-sm font-medium text-[#8C1007] whitespace-nowrap capitalize">
            by {{ $tulisan->user->name ?? 'komsos bintaran' }}
        </span>
    </div>
    <div class="container mx-auto px-8 md:px-20 max-w-5xl pt-28 pb-12 text-center">

        <div class="max-w-4xl mx-auto">
            <h2 class="text-xs md:text-sm lg:text-base font-medium text-[#3E0703] max-w-[350px] md:max-w-3xl mx-auto leading-snug mb-4 md:mb-6">
                “{{ $tulisan->ringkasan }}”
            </h2>
            <p class="text-xs md:text-base font-medium opacity-50 max-w-4xl mx-auto">
                {{ $tulisan->created_at->isoFormat('dddd, D MMMM Y') }}
            </p>
        </div>
    </div>
    <div class="container mx-auto px-10 md:px-16 lg:px-20 max-w-4xl py-12">
        <div class="relative group">
            @if(count($slides) > 0)
                <div class="absolute -top-12 right-0 z-20 fs-style-manrope text-[#3b0d0d] font-medium tracking-widest text-sm opacity-60">
                    <span id="gallery-current">01</span> / <span id="gallery-total">{{ str_pad(count($slides), 2, '0', STR_PAD_LEFT) }}</span>
                </div>
                <div class="swiper art-gallery-swiper overflow-visible shadow-sm">
                    <div class="swiper-wrapper">
                        @foreach($slides as $slide)
                        <div class="swiper-slide">
                            <img src="{{ asset('storage/BintaranImage/' . $slide['file']) }}" 
                                 class="w-full aspect-[16/9] object-cover rounded-none" 
                                 alt="{{ $tulisan->judul_tulisan }}">
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="mt-4 text-center px-4 min-h-[2.5rem] flex items-center justify-center">
                    <h3 id="active-tulisan-caption" class="text-[10px] md:text-base font-medium text-[#3b0d0d] fs-style-manrope opacity-80 leading-relaxed">
                    </h3>
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
            @else
                <div class="w-full aspect-[16/9] bg-[#f5f5f5] rounded-none flex flex-col items-center justify-center text-center p-8 border border-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 text-[#3A0D0D]/20 mb-4">
                      <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                    </svg>
                    <p class="text-sm font-medium text-[#3A0D0D]/40 uppercase tracking-widest">
                        Belum ada foto
                    </p>
                </div>
            @endif
        </div>
    </div>
    <div class="container mx-auto px-8 md:px-20 max-w-4xl pt-2 pb-12">
        <div class="text-[#3E0703] text-[11px] md:text-lg leading-relaxed whitespace-pre-line text-justify px-2 md:px-0">
            {!! $tulisan->konten !!}
        </div>
    </div>
</div>

<style>
    /* Ensure hero content doesn't get clipped by fixed navbar and allows growth */
    .hero-inner {
        position: relative !important;
        height: auto !important;
        min-height: inherit !important;
        inset: auto !important;
    }

    /* Hero Background with Blur Overlay */
    .hero-section {
        background-image: url('{{ $heroBg }}') !important;
        background-size: cover !important;
        background-position: center !important;
        background-attachment: fixed !important;
    }
    .hero-overlay {
        background: linear-gradient(rgba(62, 7, 3, 0.7), rgba(62, 7, 3, 0.9)) !important;
        backdrop-filter: blur(4px) !important;
        mix-blend-mode: normal !important;
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
        if (typeof Swiper !== 'undefined') {
            const captions = @json(array_column($slides, 'caption'));
            const captionEl = document.getElementById('active-tulisan-caption');
            const currentEl = document.getElementById('gallery-current');
            const totalEl = document.getElementById('gallery-total');

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
                    captionEl.textContent = captions[s.realIndex] || '';
                }
            }
        }
    });
</script>
@endsection

