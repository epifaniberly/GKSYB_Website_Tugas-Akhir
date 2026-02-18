<footer class="fs-style-manrope bg-[var(--clr-secondary)] text-[#F5F5ED]" data-aos="fade-up">
  <div class="px-8 sm:px-10 pt-16 mx-auto max-w-screen-2xl">
    <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-5 border-b border-white/20 pb-12 text-center lg:text-left">
      <div class="flex flex-col items-center lg:items-start md:col-span-full lg:col-span-1">
        <div class="flex items-center mb-6 justify-center lg:justify-start">
          <div class="w-14 h-14 bg-[#FCFAF7] rounded-full flex items-center justify-center shadow-sm overflow-hidden border-2 border-white/5">
            @if(isset($identitasGlobal) && $identitasGlobal->logo)
              <img src="{{ asset('storage/' . $identitasGlobal->logo) }}" alt="{{ $identitasGlobal->nama_website }}" class="w-8 h-8 object-contain object-center">
            @else
              <img src="{{ asset('assets/logo-short.png') }}" alt="Logo Gereja" class="w-8 h-8 object-contain object-center">
            @endif
          </div>
        </div>

        <p class="text-sm md:text-sm leading-relaxed text-white/80 max-w-sm text-center lg:text-left">
          {{ $kontakGlobal->alamat ?? 'Jl. Bintaran Kidul No.5, Wirgunan, Kec. Mergangsan, Kota Yogyakarta, Daerah Istimewa Yogyakarta 55151' }}
        </p>

        <div class="flex flex-wrap gap-3 mt-6 justify-center lg:justify-start">
          @if($kontakGlobal->whatsapp ?? false)
            <a href="https://wa.me/{{ $kontakGlobal->whatsapp }}" target="_blank" class="w-9 h-9 flex items-center justify-center rounded-full bg-white hover:opacity-80 transition shadow-sm overflow-hidden p-1.5" title="WhatsApp">
              <img src="{{ asset('assets/WhatsApp.png') }}" class="w-full h-full object-contain" alt="WhatsApp">
            </a>
          @endif

          @if($sosmedGlobal->url_ig ?? false)
            <a href="{{ $sosmedGlobal->url_ig }}" target="_blank" class="w-9 h-9 flex items-center justify-center rounded-full bg-white hover:opacity-80 transition shadow-sm overflow-hidden p-1.5" title="Instagram">
              <img src="{{ asset('assets/Instagram.png') }}" class="w-full h-full object-contain" alt="Instagram">
            </a>
          @endif

          @if($sosmedGlobal->url_yt ?? false)
            <a href="{{ $sosmedGlobal->url_yt }}" target="_blank" class="w-9 h-9 flex items-center justify-center rounded-full bg-white hover:opacity-80 transition shadow-sm overflow-hidden p-1.5" title="YouTube">
              <img src="{{ asset('assets/YouTube.png') }}" class="w-full h-full object-contain" alt="YouTube">
            </a>
          @endif

          @if($sosmedGlobal->url_gmaps ?? false)
            <a href="{{ $sosmedGlobal->url_gmaps }}" target="_blank" class="w-9 h-9 flex items-center justify-center rounded-full bg-white hover:opacity-80 transition shadow-sm overflow-hidden p-1.5" title="Google Maps">
              <img src="{{ asset('assets/maps.png') }}" class="w-full h-full object-contain" alt="Google Maps">
            </a>
          @endif

          @if($sosmedGlobal->url_tiktok ?? false)
            <a href="{{ $sosmedGlobal->url_tiktok }}" target="_blank" class="w-9 h-9 flex items-center justify-center rounded-full bg-white hover:opacity-80 transition shadow-sm overflow-hidden p-1.5" title="TikTok">
              <img src="{{ asset('assets/TikTok.png') }}" class="w-full h-full object-contain" alt="TikTok">
            </a>
          @endif
        </div>
      </div>

      <div>
        <p class="font-semibold mb-3 md:mb-4 text-[#F5F5ED] text-base md:text-base">Tentang Gereja</p>
        <ul class="space-y-1.5 md:space-y-2 text-sm md:text-sm text-white/80">
          <li><a href="{{ route('landing.sejarah') }}" class="hover:text-white">Tilik Sejarah</a></li>
          <li><a href="{{ route('landing.gembala') }}" class="hover:text-white">Gembala Berkarya</a></li>
          <li><a href="{{ route('landing.doa') }}" class="hover:text-white">Doa dan Perayaan Ekaristi</a></li>
          <li><a href="{{ route('landing.sakramen') }}" class="hover:text-white">Sakramen Gereja Katolik</a></li>
        </ul>
      </div>

      <div>
        <p class="font-semibold mb-3 md:mb-4 text-[#F5F5ED] text-base md:text-base">Akses Umat</p>
        <ul class="space-y-1.5 md:space-y-2 text-sm md:text-sm text-white/80">
          <li><a href="{{ route('landing.panduan') }}" class="hover:text-white">Panduan Perayaan Ekaristi</a></li>
          <li><a href="{{ route('landing.ujud') }}" class="hover:text-white">Kirim Intensi & Ujud Doa</a></li>
          <li><a href="{{ $sosmedGlobal->url_yt ?? '#' }}" target="_blank" class="hover:text-white">Live Streaming</a></li>
          <li><a href="{{ route('landing.dokumen') }}" class="hover:text-white">Dokumen Gereja</a></li>
        </ul>
      </div>

      <div class="md:col-span-full lg:col-span-1">
        <p class="font-semibold mb-3 md:mb-4 text-[#F5F5ED] text-base md:text-base">Tulisan Terbaru</p>
        <ul class="space-y-3 md:space-y-4 text-sm md:text-sm text-white/80">
          @forelse($tulisanBintaranGlobal as $tulisan)
            <li>
              <a href="{{ route('landing.news.detail', $tulisan->id) }}" 
                 class="hover:text-white transition-colors block leading-snug" 
                 style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                {{ $tulisan->judul_tulisan }}
              </a>
              <span class="text-[11px] text-white/40 font-medium mt-1 inline-block">{{ $tulisan->created_at->translatedFormat('d F Y') }}</span>
            </li>
          @empty
            <li class="opacity-50 italic">Belum ada tulisan terbaru.</li>
          @endforelse
        </ul>
      </div>
      <div class="lg:pt-0 pt-4 flex flex-col items-center md:col-span-full lg:col-span-1">
        <p class="font-semibold mb-3 md:mb-4 text-[#F5F5ED] text-base md:text-base whitespace-nowrap">Galeri & Dokumentasi</p>
        <div class="bg-white rounded-3xl p-5 flex flex-col items-center text-center shadow-lg group/card hover:shadow-xl transition-all max-w-[220px] lg:max-w-[180px] xl:max-w-[220px] aspect-square justify-center lg:mx-0 mx-auto">
            <div class="w-12 h-12 rounded-full bg-green-50 flex items-center justify-center text-green-600 mb-4 shadow-inner group-hover/card:scale-110 transition-transform">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"></path>
                </svg>
            </div>
            <div class="space-y-1 mb-4">
                <p class="text-xs text-slate-500 font-medium leading-relaxed">
                    Dokumentasi kegiatan Paroki Santo Yusup Bintaran
                </p>
            </div>
            <a href="{{ $galleryGlobal->url ?? '#' }}" target="_blank"
               class="w-full bg-[#690c05] text-white text-xs font-medium py-2 px-4 rounded-lg flex items-center justify-center gap-1.5 transition-all hover:opacity-90 active:scale-95 group/btn shadow-md shadow-red-900/10">
                Buka Galeri
                <svg class="w-3 h-3 group-hover/btn:translate-x-0.5 group-hover/btn:-translate-y-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 3h7m0 0v7m0-7L10 14"></path>
                </svg>
            </a>
        </div>
      </div>

    </div>
    <div class="text-center text-xs md:text-xs text-white/60 py-6">
      © Copyright 2026, All Rights Reserved by GKSYB
    </div>

  </div>
</footer>

