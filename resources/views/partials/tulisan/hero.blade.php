<section class="w-full py-10 md:py-16 bg-[#FCFAF7] fs-style-manrope" data-aos="fade-up">
    <div class="container mx-auto px-8 md:px-20 max-w-7xl">
        <div class="text-center mb-10">
            <h2 class="text-3xl md:text-4xl lg:text-5xl font-semibold text-[#3E0703] mb-4 leading-tight">
                Tulisan Bintaran Terbaru
            </h2>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 xl:gap-16">

            @if($latestArticles->count() > 0)
                @php $first = $latestArticles->first(); @endphp
                <div class="lg:col-span-12 xl:col-span-7 group">
                    <a href="{{ route('landing.news.detail', $first->id) }}" class="block p-0 md:p-4 border border-transparent hover:border-gray-100 transition-all duration-300">
                        <div class="overflow-hidden mb-5 md:mb-6 shadow-sm rounded-none">
                            <img src="{{ $first->image ? asset('storage/BintaranImage/' . $first->image) : asset('/assets/paroki.png') }}" 
                                 class="w-full h-64 md:h-[280px] object-cover group-hover:scale-105 transition-transform duration-700" 
                                 alt="{{ $first->judul_tulisan }}"
                                 onerror="this.src='{{ asset('/assets/paroki.png') }}'">
                        </div>

                        <div class="flex items-center gap-3 mb-3 md:mb-4">
                            @php
                                $catWarna = $first->kategoriBintaran->warna ?? '#8C1007';
                            @endphp
                            <span class="px-2.5 md:px-4 py-1 md:py-1.5 text-[9px] md:text-xs font-semibold uppercase tracking-widest whitespace-nowrap fs-style-manrope rounded-full"
                                  style="background-color: {{ $catWarna }}15; color: {{ $catWarna }};">
                                {{ $first->kategoriBintaran->nama_kategori }}
                            </span>
                            <span class="text-xs md:text-sm text-[#3A0D0D]/40 ml-1 whitespace-nowrap tracking-tighter">• {{ $first->created_at->translatedFormat('d M Y') }}</span>
                        </div>

                        <div class="flex justify-between items-start gap-4">
                            <h3 class="text-lg md:text-3xl font-semibold text-[#3A0D0D] mb-3 md:mb-4 group-hover:text-[#8C1007] transition-colors leading-tight max-w-2xl line-clamp-2">
                                {{ $first->judul_tulisan }}
                            </h3>
                            <div class="text-[#3A0D0D] group-hover:translate-x-1 group-hover:-translate-y-1 transition-transform pt-2 shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4 md:w-8 md:h-8">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 19.5 15-15m0 0H8.25m11.25 0v11.25" />
                                </svg>
                            </div>
                        </div>

                        <p class="text-sm md:text-base text-[#3A0D0D]/60 mb-4 line-clamp-3 font-light leading-relaxed">
                            {{ $first->ringkasan }}
                        </p>
                    </a>
                </div>
                <div class="lg:col-span-12 xl:col-span-5 flex flex-col gap-5">
                    @foreach($latestArticles->skip(1)->take(3) as $article)
                    <a href="{{ route('landing.news.detail', $article->id) }}" class="group block p-0 md:p-3 border border-transparent hover:border-gray-100 transition-all duration-300">
                        <div class="flex flex-col sm:flex-row gap-4 md:gap-5 items-stretch sm:h-28 text-left">
                            <div class="sm:w-[140px] md:w-[160px] shrink-0 overflow-hidden shadow-sm rounded-none relative h-40 sm:h-full">
                                <img src="{{ $article->image ? asset('storage/BintaranImage/' . $article->image) : asset('/assets/permenungan.png') }}" 
                                     class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" 
                                     alt="{{ $article->judul_tulisan }}"
                                     onerror="this.src='{{ asset('/assets/permenungan.png') }}'">
                            </div>
                            <div class="flex-grow min-w-0 flex flex-col justify-center py-0.5">
                                <div class="flex items-center gap-2 mb-1.5">
                                    @php
                                        $catWarna2 = $article->kategoriBintaran->warna ?? '#8C1007';
                                    @endphp
                                    <span class="px-2.5 py-1 text-[8px] md:text-[9px] font-semibold uppercase tracking-widest whitespace-nowrap fs-style-manrope rounded-full"
                                          style="background-color: {{ $catWarna2 }}15; color: {{ $catWarna2 }};">
                                        {{ $article->kategoriBintaran->nama_kategori }}
                                    </span>
                                    <span class="text-[9px] md:text-[10px] text-[#3A0D0D]/40 ml-1 whitespace-nowrap tracking-tighter">• {{ $article->created_at->translatedFormat('d M Y') }}</span>
                                </div>

                                <div class="flex justify-between items-start gap-2 mb-1.5">
                                    <h4 class="text-lg md:text-base font-semibold text-[#3A0D0D] group-hover:text-[#8C1007] transition-colors leading-tight line-clamp-2" title="{{ $article->judul_tulisan }}">
                                        {{ $article->judul_tulisan }}
                                    </h4>
                                    <div class="text-[#3A0D0D] group-hover:scale-110 group-hover:translate-x-0.5 group-hover:-translate-y-0.5 transition-transform pt-0.5 shrink-0 block">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4 text-[#8C1007]">
                                          <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 19.5 15-15m0 0H8.25m11.25 0v11.25" />
                                        </svg>
                                    </div>
                                </div>

                                <p class="text-xs text-[#3A0D0D]/60 line-clamp-1 font-light leading-relaxed">
                                    {{ $article->ringkasan }}
                                </p>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
            @else
                <div class="lg:col-span-12 py-10 text-center">
                    <p class="text-xl text-[#3A0D0D]/60 italic">Belum ada tulisan terbaru</p>
                </div>
            @endif

        </div>

    </div>
</section>

