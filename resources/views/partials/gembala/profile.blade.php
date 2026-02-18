<section class="pt-4 pb-8 md:pb-12 px-6 md:px-12 max-w-7xl mx-auto text-center" data-aos="fade-up">
        
        <div class="grid grid-cols-1 md:flex md:flex-wrap md:justify-center gap-y-14 md:gap-12">

            @foreach($aktif as $p)
            <div class="flex flex-col items-center w-full md:max-w-[400px]">
                <div class="w-36 h-36 md:w-56 md:h-56 rounded-full overflow-hidden shadow-md">
                    <img src="{{ asset('storage/FotoPastor/' . ($p->foto_pastor ?? 'default.png')) }}" 
                         class="w-full h-full object-cover">
                </div>
                <h3 class="mt-4 text-[15px] md:text-xl font-semibold text-[#3E0703] leading-tight px-2 whitespace-nowrap">{{ $p->nama_pastor }}</h3>
                <p class="text-[10px] md:text-base mt-1.5 text-[#8C1007] font-medium opacity-80 px-2">{{ $p->jabatan }}</p>
                <p class="text-[10px] md:text-sm mt-0.5 opacity-60">{{ $p->tahun_mulai }} - Sekarang</p>
            </div>
            @endforeach

        </div>

    </section>

    <section class="pt-8 pb-16 md:pt-12 md:pb-24 px-6 md:px-12 max-w-7xl mx-auto">

        <h2 class="text-center text-xl md:text-3xl font-semibold mb-4">
            Romo yang Pernah Berkarya
        </h2>

        <p class="text-sm md:text-lg text-center text-[#3A0D0D] leading-relaxed max-w-3xl opacity-90 mx-auto">
            Mereka telah menabur benih iman dan kasih melalui pelayanan tanpa pamrih di tengah umat,
            menjadi saksi kasih Kristus dalam setiap karya di Paroki Santo Yusup Bintaran.
        </p>
        <div class="mt-12 grid grid-cols-2 gap-x-4 gap-y-12 md:flex md:flex-wrap md:justify-center md:gap-x-8 md:gap-y-12">

            @foreach($past as $p)
            <div class="text-center flex flex-col items-center w-full md:w-[220px]">
                <div class="w-24 h-24 md:w-28 md:h-28 rounded-full overflow-hidden shadow">
                    <img src="{{ asset('storage/FotoPastor/' . ($p->foto_pastor ?? 'default.png')) }}" 
                         class="w-full h-full object-cover">
                </div>
                <h3 class="mt-5 text-[11px] md:text-sm font-semibold leading-tight whitespace-nowrap px-1">{{ $p->nama_pastor }}</h3>
                <p class="text-[11px] mt-1 opacity-80">{{ $p->tahun_mulai }} - {{ $p->tahun_selesai }}</p>
            </div>
            @endforeach

        </div>

    </section>
