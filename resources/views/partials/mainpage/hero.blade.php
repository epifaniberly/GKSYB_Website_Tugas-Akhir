<section class="fs-style-manrope overflow-hidden" data-aos="fade-up">
  <div class="max-w-screen-xl mx-auto px-6 md:px-16 lg:px-24 pt-12 lg:pt-24 pb-12 lg:pb-24">

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-center">

      <div class="text-center lg:text-left">
        <h2 class="text-2xl md:text-4xl font-semibold text-[#3E0703] mb-4 md:mb-6 leading-tight">
          Selamat datang di Gereja Santo Yusup Bintaran,
          salah satu gereja bersejarah di Yogyakarta
          yang telah berdiri sejak tahun 1934.
        </h2>

        <p class="text-sm md:text-lg text-[#3A0D0D] leading-relaxed max-w-xl opacity-90 mx-auto lg:mx-0">
          Gereja ini hadir sebagai rumah doa dan pusat persaudaraan umat.
          Di sini, umat diajak untuk tidak hanya beribadah, tetapi juga
          merasakan kedamaian, kebersamaan, dan kekuatan iman.
        </p>
      </div>

      <div class="flex justify-center lg:justify-end">
        <div class="relative rounded-[2rem] overflow-hidden shadow-2xl max-w-sm w-full md:w-[480px] md:h-[423px] group bg-gray-100 border border-gray-200">

          @if($romoKepala && $romoKepala->foto_pastor)
            <img
              src="{{ asset('storage/FotoPastor/' . $romoKepala->foto_pastor) }}"
              alt=""
              class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
            >
            <div class="absolute bottom-0 left-0 right-0 h-[60%] bg-gradient-to-t from-black/95 via-black/40 to-transparent flex flex-col justify-end p-5 md:p-8">
              <h3 class="text-white text-[11px] md:text-xl font-semibold mb-0.5 leading-snug drop-shadow-md">
                {{ $romoKepala->nama_pastor }}
              </h3>
              <p class="text-white/90 text-[9px] md:text-xs font-medium mt-0.5 drop-shadow-sm">
                {{ $romoKepala->jabatan }}
              </p>
            </div>
          @else
            <div class="w-full h-full flex flex-col items-center justify-center text-gray-400 p-12 text-center">
              <svg class="w-16 h-16 mb-4 opacity-20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
              </svg>
              <p class="text-sm font-semibold uppercase tracking-widest opacity-40 italic">Belum Ada Data Romo Paroki</p>
            </div>
          @endif
          
        </div>
      </div>

    </div>

  </div>
</section>

