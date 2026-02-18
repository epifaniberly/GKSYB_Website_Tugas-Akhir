<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10" id="articles-grid-container">
    @forelse ($allArticles as $item)
    <a href="{{ route('landing.news.detail', $item->id) }}" class="group block border border-transparent hover:border-gray-100 transition-all duration-300" data-aos="fade-up">
        <div class="overflow-hidden mb-6 shadow-sm">
            <img src="{{ $item->image ? asset('storage/BintaranImage/' . $item->image) : asset('assets/doabersama.jpg') }}"
                alt="{{ $item->judul_tulisan }}"
                class="w-full aspect-[4/3] object-cover group-hover:scale-105 transition-transform duration-700">
        </div>

        <div class="px-0">
            <div class="flex items-center gap-3 mb-5">
                @php
                    $catWarna = $item->kategoriBintaran->warna ?? '#8C1007';
                @endphp
                <span class="px-2.5 py-1 text-[8px] font-semibold uppercase tracking-widest whitespace-nowrap fs-style-manrope rounded-full"
                      style="background-color: {{ $catWarna }}15; color: {{ $catWarna }};">
                    {{ $item->kategoriBintaran->nama_kategori }}
                </span>
                <span class="text-[9px] text-[#3A0D0D]/40 ml-1 whitespace-nowrap">• {{ $item->created_at->format('d M Y') }}</span>
            </div>

            <div class="flex justify-between items-start gap-4 mb-4">
                <h3 class="text-lg md:text-2xl font-semibold text-[#3A0D0D] group-hover:text-[#8C1007] transition-colors line-clamp-2">
                    {{ $item->judul_tulisan }}
                </h3>
                <div class="text-[#3A0D0D] group-hover:translate-x-1 group-hover:-translate-y-1 transition-transform pt-1 shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3.5 h-3.5 md:w-6 md:h-6">
                      <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 19.5 15-15m0 0H8.25m11.25 0v11.25" />
                    </svg>
                </div>
            </div>

            <p class="text-[10px] text-[#3A0D0D]/60 line-clamp-3 font-light leading-relaxed">
                {{ $item->ringkasan }}
            </p>
        </div>
    </a>
    @empty
    <div class="col-span-full py-20 text-center">
        <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 text-gray-400">
              <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
            </svg>
        </div>
        <h3 class="text-xl font-semibold text-[#3b0d0d]">Tidak ditemukan tulisan</h3>
        <p class="text-gray-500 mt-2">Coba gunakan kata kunci atau kategori lain.</p>
    </div>
    @endforelse
</div>
@if($allArticles->hasPages())
<div class="mt-20 flex justify-center">
    {{ $allArticles->appends(request()->query())->links('vendor.pagination.custom') }}
</div>
@endif

