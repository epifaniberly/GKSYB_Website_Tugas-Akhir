<div class="py-16 md:py-24 bg-[#FCFAF7]" data-aos="fade-up">
    <div class="container mx-auto px-6 md:px-12 lg:px-20 mb-20 text-center fs-style-manrope text-[#3E0703]">
        <h2 class="text-xl md:text-3xl lg:text-4xl font-semibold text-[#3E0703] mb-4 leading-tight">
            “100% Katolik, 100% Indonesia”
        </h2>  
        <p class="font-light text-xs md:text-lg tracking-[0.3em] uppercase opacity-50">Mgr. Albertus Soegijapranata</p>
    </div>
    <div class="container mx-auto px-6 md:px-12 lg:px-20 max-w-4xl">
        <div class="relative group">
            <div class="absolute -top-12 right-4 md:right-0 z-20 fs-style-manrope text-[#3b0d0d] font-medium tracking-widest text-sm opacity-60">
                <span id="gallery-current">01</span> / <span id="gallery-total">05</span>
            </div>
            <div class="swiper art-gallery-swiper overflow-visible">
                <div class="swiper-wrapper">
                    @if($profil && !empty($profil->galeri) && is_array($profil->galeri))
                        @foreach($profil->galeri as $img)
                        <div class="swiper-slide">
                            <img src="{{ asset('storage/' . ($img['file'] ?? '')) }}" class="w-full aspect-[16/9] object-cover rounded-none" alt="Galeri Sejarah">
                            
                            @if(!empty($img['caption']))
                            <div class="mt-8 text-center">
                                <h3 class="text-xs md:text-base font-medium text-[#3b0d0d] fs-style-manrope opacity-80">
                                    {{ $img['caption'] }}
                                </h3>
                            </div>
                            @endif
                        </div>
                        @endforeach
                    @else
                        <div class="swiper-slide">
                            <img src="{{ asset('assets/slide1.png') }}" class="w-full aspect-[16/9] object-cover rounded-none" alt="History 1">
                            <div class="mt-8 text-center">
                                <h3 class="text-sm md:text-base font-medium text-[#3b0d0d] fs-style-manrope opacity-80">
                                    Pondasi Awal Berdirinya Gereja Bintaran
                                </h3>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <img src="{{ asset('assets/slide2.png') }}" class="w-full aspect-[16/9] object-cover rounded-none" alt="History 2">
                            <div class="mt-8 text-center">
                                <h3 class="text-sm md:text-base font-medium text-[#3b0d0d] fs-style-manrope opacity-80">
                                    Semangat Kebangsaan Mgr. Albertus Soegijapranata
                                </h3>
                            </div>
                        </div>
                    @endif
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
                      <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>

<style>
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
        background: #3b0d0d !important;
    }
    
    :root {
        --swiper-theme-color: #3b0d0d !important;
        --swiper-navigation-color: #3b0d0d !important;
        --swiper-pagination-color: #3b0d0d !important;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof Swiper !== 'undefined') {
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
                        const realSlides = s.el.querySelectorAll('.swiper-slide:not(.swiper-slide-duplicate)');
                        const total = realSlides.length;
                        if(totalEl) totalEl.textContent = total.toString().padStart(2, '0');
                        updateCounter(s);
                    },
                    slideChange: function (s) {
                        updateCounter(s);
                    }
                }
            });

            function updateCounter(s) {
                if(currentEl) {
                    currentEl.textContent = (s.realIndex + 1).toString().padStart(2, '0');
                }
            }
        }
    });
</script>

