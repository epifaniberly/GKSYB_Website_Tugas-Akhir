<section class="w-full py-12 md:py-16 fs-style-manrope bg-[#FCFAF7] overflow-hidden" data-aos="fade-up">
    <div class="container mx-auto px-6 md:px-16 lg:px-24 max-w-7xl">

        <div class="text-center lg:text-left">
            <span class="bg-[#8C1007] text-white text-[10px] md:text-xs font-semibold tracking-widest px-4 py-1.5 rounded-full inline-block mb-6 uppercase">
                Agenda Kegiatan
            </span>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 md:gap-8 items-start mb-10">
            <h2 class="text-2xl md:text-4xl font-semibold leading-tight text-[#3A0D0D] mb-2 text-center lg:text-left">
                Agenda Kegiatan<br class="hidden md:block">
                Gereja Bintaran
            </h2>

            <div class="text-center lg:text-left">
                <p class="text-[#3A0D0D] opacity-80 text-sm md:text-lg max-w-md mx-auto lg:ml-auto leading-relaxed">
                    Ikuti berbagai kegiatan rohani dan komunitas yang mempererat persaudaraan iman umat kita.
                </p>
            </div>
        </div>
        <div class="relative group mt-8 md:mt-12">
            
            @if(isset($agendas) && $agendas->count() > 0)
            <button class="swiper-button-prev-agenda absolute left-0 top-1/2 -translate-y-1/2 z-20 w-10 h-10 md:w-12 md:h-12 flex items-center justify-center rounded-full bg-white shadow-lg text-[#3b0d0d] hover:bg-[#8C1007] hover:text-white transition-all opacity-100 lg:opacity-0 lg:group-hover:opacity-100 translate-x-[-50%] lg:-translate-x-12 lg:group-hover:-translate-x-6">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5 md:w-6 md:h-6">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                </svg>
            </button>
            <button class="swiper-button-next-agenda absolute right-0 top-1/2 -translate-y-1/2 z-20 w-10 h-10 md:w-12 md:h-12 flex items-center justify-center rounded-full bg-white shadow-lg text-[#3b0d0d] hover:bg-[#8C1007] hover:text-white transition-all opacity-100 lg:opacity-0 lg:group-hover:opacity-100 translate-x-[50%] lg:translate-x-12 lg:group-hover:translate-x-6">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5 md:w-6 md:h-6">
                  <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                </svg>
            </button>
            <div class="swiper myAgendaSwiper p-1"> 
                <div class="swiper-wrapper">
                    @foreach($agendas as $item)
                    <div class="swiper-slide h-auto">
                        <div class="grid grid-cols-1 md:grid-cols-2 bg-white rounded-[2rem] md:rounded-[2.5rem] overflow-hidden shadow-sm border border-gray-100">
                            <div class="h-60 md:h-[450px] overflow-hidden">
                                <img src="{{ $item->image ? asset('storage/BintaranImage/' . $item->image) : asset('assets/card.png') }}"
                                     class="w-full h-full object-cover" 
                                     alt="{{ $item->judul_tulisan }}"
                                     onerror="this.src='/assets/card.png'" />
                            </div>
                            <div class="p-8 md:p-16 flex flex-col justify-center bg-white">
                                <div class="flex items-center gap-2 md:gap-3 mb-4 md:mb-6">
                                    @php
                                        $catWarna = $item->kategoriBintaran->warna ?? '#8C1007';
                                    @endphp
                                    <span class="px-3 md:px-4 py-1.5 text-[9px] md:text-xs font-semibold uppercase tracking-widest rounded-full fs-style-manrope"
                                          style="background-color: {{ $catWarna }}15; color: {{ $catWarna }};">
                                        {{ $item->kategoriBintaran->nama_kategori ?? 'AGENDA' }}
                                    </span>
                                    <span class="text-xs md:text-sm text-[#3A0D0D]/40 tracking-tight">• {{ $item->created_at->translatedFormat('d M Y') }}</span>
                                </div>

                                <div class="flex justify-between items-start gap-3 mb-4 md:mb-6">
                                     <h3 class="text-lg md:text-3xl lg:text-4xl font-semibold text-[#3E0703] leading-snug"
                                         style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                         {{ $item->judul_tulisan }}
                                      </h3>
                                    <a href="{{ route('landing.news.detail', $item->id) }}" class="text-[#3E0703] hover:translate-x-1 hover:-translate-y-1 transition-transform pt-1 shrink-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-6 h-6 md:w-10 md:h-10">
                                          <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 19.5 15-15m0 0H8.25m11.25 0v11.25" />
                                        </svg>
                                    </a>
                                </div>

                                <p class="text-[#3b0d0d]/70 text-sm md:text-lg font-light leading-relaxed line-clamp-3 md:line-clamp-5">
                                    {{ $item->ringkasan }}
                                </p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @else
                <div class="py-20 text-center">
                    <p class="text-2xl text-[#3A0D0D]/60 italic">Belum ada kegiatan terbaru</p>
                </div>
            @endif

        </div>

    </div>
</section>

<style>
    .myAgendaSwiper .swiper-slide {
        opacity: 0.1;
        transition: opacity 0.5s;
    }
    .myAgendaSwiper .swiper-slide-active {
        opacity: 1;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        if (typeof Swiper !== 'undefined') {
            new Swiper(".myAgendaSwiper", {
                slidesPerView: 1,
                spaceBetween: 40,
                loop: true,
                speed: 1000,
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                },
                navigation: {
                    nextEl: ".swiper-button-next-agenda",
                    prevEl: ".swiper-button-prev-agenda",
                },
                effect: 'fade',
                fadeEffect: {
                    crossFade: true
                }
            });
        }
    });
</script>

