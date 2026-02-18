<section class="w-full bg-[#3E0703] py-24 fs-style-manrope overflow-hidden" data-aos="fade-up">
    <div class="container mx-auto px-8 md:px-20 max-w-7xl">
        <div class="grid lg:grid-cols-2 gap-12 lg:gap-20 items-center">
            <div class="text-white text-center md:text-left">
                <h2 class="text-2xl md:text-4xl font-semibold mb-6 leading-tight">
                    {{ $title ?? 'Akses Panduan Perayaan Ekaristi dan Terhubung dengan Kami!' }}
                </h2>
                <p class="text-[14px] md:text-lg opacity-80 font-light leading-relaxed max-w-md mx-auto md:mx-0">
                    {{ $desc ?? 'Akses panduan Perayaan Ekaristi dan hubungi tim pastoral kami untuk setiap pertanyaan atau kebutuhan informasi Anda.' }}
                </p>
            </div>
            <div class="grid md:grid-cols-2 gap-6">
                <a href="{{ $link1 ?? route('landing.panduan') }}" class="bg-white p-6 rounded-3xl border border-white/10 shadow-sm hover:shadow-xl transition-all group">
                    <div class="w-10 h-10 bg-[#FEF2F2] rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="#8C1007" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m.75 12l3 3m0 0 3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                        </svg>
                    </div>
                    <h4 class="text-base md:text-xl font-semibold text-[#3E0703] mb-2 md:mb-3">{{ $label1 ?? 'Panduan Perayaan Ekaristi' }}</h4>
                    <p class="text-sm md:text-base text-[#3E0703]/60 font-light leading-relaxed">
                        {{ $sublabel1 ?? 'Teks Perayaan Ekaristi tersedia sebagai panduan bagi umat dalam mengikuti Perayaan Ekaristi mingguan secara tertib dan khidmat.' }}
                    </p>
                </a>
                <a href="{{ route('landing.contact') }}" class="bg-white p-6 rounded-3xl border border-white/10 shadow-sm hover:shadow-xl transition-all group">
                    <div class="w-10 h-10 bg-[#FEF2F2] rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="#8C1007" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 1.5H8.25A2.25 2.25 0 0 0 6 3.75v16.5a2.25 2.25 0 0 0 2.25 2.25h7.5A2.25 2.25 0 0 0 18 20.25V3.75a2.25 2.25 0 0 0-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" />
                        </svg>
                    </div>
                    <h4 class="text-base md:text-xl font-semibold text-[#3E0703] mb-2 md:mb-3">Mari Terhubung</h4>
                    <p class="text-sm md:text-base text-[#3E0703]/60 font-light leading-relaxed">
                        Jangan ragu untuk menghubungi kami jika ada pertanyaan dan kebutuhan informasi seputar kegiatan gereja.
                    </p>
                </a>

            </div>
        </div>
    </div>
</section>
