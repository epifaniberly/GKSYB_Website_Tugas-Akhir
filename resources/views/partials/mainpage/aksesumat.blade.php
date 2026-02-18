<section class="w-full py-16 fs-style-manrope overflow-hidden" data-aos="fade-up">
    <div class="container mx-auto px-6 md:px-16 lg:px-24 max-w-7xl">

        <div class="text-center mb-12">
            <h2 class="text-2xl md:text-4xl font-semibold text-[#3A0D0D] mb-3">Akses Umat</h2>
            <p class="text-[#3A0D0D] opacity-80 text-sm md:text-lg">
                Kami menyediakan berbagai layanan untuk mendukung kehidupan iman Anda. <br class="hidden md:block">
                Semoga layanan ini membantu Anda tetap terhubung dalam doa dan kebersamaan.
            </p>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">

            <div class="bg-white rounded-2xl p-4 md:p-6 border border-gray-200 shadow-sm hover:shadow-md transition flex flex-col items-center">
                <div class="w-11 h-11 md:w-16 md:h-16 flex items-center justify-center mx-auto rounded-full mb-3 md:mb-4"
                    style="background-color: #EEDBDA;">
                    <img src="{{ asset('/assets/hst.png') }}" class="w-5 h-5 md:w-8 md:h-8" alt="Panduan Ekaristi">
                </div>

                <h3 class="text-center text-[#3A0D0D] font-semibold mb-2 text-xs md:text-base px-2">Panduan Perayaan Ekaristi</h3>
                <p class="text-center text-[10px] md:text-sm text-[#3A0D0D] opacity-70 mb-4 line-clamp-3">
                    Teks Misa Mingguan tersedia untuk mendukung umat dalam perayaan Ekaristi.
                </p>

                <div class="text-center mt-auto">
                    <a href="{{ route('landing.panduan') }}" class="font-semibold text-[#8B2C2C] hover:underline text-[11px] md:text-base">
                        Lihat Informasi
                    </a>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-4 md:p-6 border border-gray-200 shadow-sm hover:shadow-md transition flex flex-col items-center">
                <div class="w-11 h-11 md:w-16 md:h-16 flex items-center justify-center mx-auto rounded-full mb-3 md:mb-4"
                    style="background-color: #EEDBDA;">
                    <img src="{{ asset('/assets/pray.png') }}" class="w-5 h-5 md:w-8 md:h-8" alt="Intensi Doa">
                </div>

                <h3 class="text-center text-[#3A0D0D] font-semibold mb-2 text-xs md:text-base px-2">Kirim Intensi dan Ujud Doa</h3>
                <p class="text-center text-[10px] md:text-sm text-[#3A0D0D] opacity-70 mb-4 line-clamp-3">
                    Sampaikan intensi dan ujud doa Anda untuk didoakan dalam Perayaan Ekaristi.
                </p>

                <div class="text-center mt-auto">
                    <a href="{{ route('landing.ujud') }}" class="font-semibold text-[#8B2C2C] hover:underline text-[11px] md:text-base">
                        Lihat Informasi
                    </a>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-4 md:p-6 border border-gray-200 shadow-sm hover:shadow-md transition flex flex-col items-center">
                <div class="w-11 h-11 md:w-16 md:h-16 flex items-center justify-center mx-auto rounded-full mb-3 md:mb-4"
                    style="background-color: #EEDBDA;">
                    <img src="{{ asset('/assets/stream.png') }}" class="w-5 h-5 md:w-8 md:h-8" alt="Live Streaming">
                </div>

                <h3 class="text-center text-[#3A0D0D] font-semibold mb-2 text-xs md:text-base px-2">Live Streaming</h3>
                <p class="text-center text-[10px] md:text-sm text-[#3A0D0D] opacity-70 mb-4 line-clamp-3">
                    Ikuti misa serta acara gereja secara langsung melalui liputan live streaming.
                </p>

                <div class="text-center mt-auto">
                    <a href="https://www.youtube.com/@KomsosParokiStYusupBintaran" class="font-semibold text-[#8B2C2C] hover:underline text-[11px] md:text-base">
                        Lihat Informasi
                    </a>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-4 md:p-6 border border-gray-200 shadow-sm hover:shadow-md transition flex flex-col items-center">
                <div class="w-11 h-11 md:w-16 md:h-16 flex items-center justify-center mx-auto rounded-full mb-3 md:mb-4"
                    style="background-color: #EEDBDA;">
                    <img src="{{ asset('/assets/doc.png') }}" class="w-5 h-5 md:w-8 md:h-8" alt="Dokumen Gereja">
                </div>

                <h3 class="text-center text-[#3A0D0D] font-semibold mb-2 text-xs md:text-base px-2">Dokumen Gereja</h3>
                <p class="text-center text-[10px] md:text-sm text-[#3A0D0D] opacity-70 mb-4 line-clamp-3">
                    Unduh formulir gereja yang Anda butuhkan untuk berbagai keperluan gereja.
                </p>

                <div class="text-center mt-auto">
                    <a href="{{ route('landing.dokumen') }}" class="font-semibold text-[#8B2C2C] hover:underline text-[11px] md:text-base">
                        Lihat Informasi
                    </a>
                </div>
            </div>

        </div>

    </div>
</section>

