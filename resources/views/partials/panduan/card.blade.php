<section class="w-full pb-24 fs-style-manrope" data-aos="fade-up">
    <div class="container mx-auto px-8 md:px-16 lg:px-24 max-w-7xl">
        <div class="flex flex-wrap justify-center gap-8">
            @foreach($panduan as $item)
            <div class="relative w-full max-w-[200px] md:max-w-[300px] aspect-square group rounded-[1.5rem] md:rounded-[2rem] overflow-hidden bg-white shadow-sm border border-gray-100 transition-all duration-500 hover:shadow-xl"
                 onclick="this.classList.toggle('is-touched')">
                <div class="absolute inset-0 w-full h-full flex flex-col items-center justify-center text-center p-4 md:p-6 transition-transform duration-500 group-hover:-translate-y-4 group-[.is-touched]:-translate-y-4">
                    <div class="w-12 h-12 md:w-16 md:h-16 bg-[#FEF2F2] rounded-2xl flex items-center justify-center mb-4 md:mb-6 group-hover:scale-90 group-[.is-touched]:scale-90 transition-transform duration-500">
                        <img src="{{ asset('/assets/hst.png') }}" class="w-6 h-6 md:w-8 md:h-8 object-contain" alt="Icon">
                    </div>
                    <h3 class="text-xs md:text-base font-semibold text-[#3b0d0d] mb-2 md:mb-3 leading-tight px-1 md:px-2">
                        {{ $item->jenis_misa }}
                    </h3>
                    <p class="text-[#3b0d0d] opacity-70 text-[10px] md:text-sm leading-relaxed line-clamp-3 px-1 md:px-2 font-light mb-4">
                        {{ $item->ket_perayaan }}
                    </p>
                </div>
                <div class="absolute inset-x-0 bottom-0 h-full bg-[#3E0703] text-white p-6 md:p-8 flex flex-col items-center justify-center text-center transition-all duration-500 translate-y-full opacity-0 group-hover:translate-y-0 group-hover:opacity-100 group-[.is-touched]:translate-y-0 group-[.is-touched]:opacity-100">
                    
                    @if($item->ayat_alkitab)
                    <div class="mb-4 md:mb-5">
                        <p class="text-[10px] md:text-sm font-medium italic leading-relaxed fs-style-manrope mb-2 md:mb-3 line-clamp-4">
                            "{{ $item->ayat_alkitab }}"
                        </p>
                        <p class="text-[9px] md:text-[11px] opacity-60 font-light">
                            {{ $item->sumber_ayat ?? '-' }}
                        </p>
                    </div>
                    @endif
                    
                    <a href="{{ route('landing.panduan.detail', $item->id) }}" 
                       class="text-[10px] md:text-sm font-semibold border-b border-white/30 hover:border-white transition-all pb-0.5 z-10 relative">
                        Lanjutkan Membaca
                    </a>
                </div>

            </div>
            @endforeach
        </div>

        @if($panduan->isEmpty())
        <div class="text-center py-20 bg-gray-50 rounded-[32px] border-2 border-dashed border-gray-200">
            <p class="text-gray-400 text-lg">Belum ada panduan yang tersedia saat ini.</p>
        </div>
        @endif
    </div>
</section>

