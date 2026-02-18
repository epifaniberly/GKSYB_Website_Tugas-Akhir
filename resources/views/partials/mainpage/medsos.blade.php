<div class="bg-[#3E0703] py-10 fs-style-manrope overflow-hidden" data-aos="fade-up">
    <div class="container mx-auto px-6 md:px-16 lg:px-24 max-w-7xl">
        <div class="flex flex-col items-center justify-center">
        
        <h2 class="text-white text-center font-medium text-sm md:text-lg mx-auto md:ml-auto leading-relaxed opacity-90">
            Mari tetap terhubung melalui kanal media sosial kami!
        </h2>

        <div class="grid grid-cols-2 md:flex md:flex-row md:flex-wrap justify-center gap-x-6 gap-y-8 md:gap-12 mt-8 md:mt-12 w-full max-w-5xl mx-auto font-medium px-6 justify-items-center">

            @if($kontakGlobal->whatsapp ?? false)
            <a href="https://wa.me/{{ $kontakGlobal->whatsapp }}" target="_blank" class="flex flex-row items-center gap-4 text-white hover:text-clr-accent transition group whitespace-nowrap odd:last:col-span-2">
                <img src="{{ asset('assets/WhatsApp.png') }}" class="w-8 h-8 md:w-14 md:h-14 group-hover:scale-110 transition-transform" alt="WhatsApp">
                <span class="text-xs md:text-xl">WhatsApp</span>
            </a>
            @endif

            @if($sosmedGlobal->url_ig ?? false)
            <a href="{{ $sosmedGlobal->url_ig }}" target="_blank" class="flex flex-row items-center gap-4 text-white hover:text-clr-accent transition group whitespace-nowrap odd:last:col-span-2">
                <img src="{{ asset('assets/Instagram.png') }}" class="w-8 h-8 md:w-14 md:h-14 group-hover:scale-110 transition-transform" alt="Instagram">
                <span class="text-xs md:text-xl">Instagram</span>
            </a>
            @endif

            @if($sosmedGlobal->url_yt ?? false)
            <a href="{{ $sosmedGlobal->url_yt }}" target="_blank" class="flex flex-row items-center gap-4 text-white hover:text-clr-accent transition group whitespace-nowrap odd:last:col-span-2">
                <img src="{{ asset('assets/YouTube.png') }}" class="w-8 h-8 md:w-14 md:h-14 group-hover:scale-110 transition-transform" alt="YouTube">
                <span class="text-xs md:text-xl">YouTube</span>
            </a>
            @endif

            @if($sosmedGlobal->url_gmaps ?? false)
            <a href="{{ $sosmedGlobal->url_gmaps }}" target="_blank" class="flex flex-row items-center gap-4 text-white hover:text-clr-accent transition group whitespace-nowrap odd:last:col-span-2">
                <img src="{{ asset('assets/maps.png') }}" class="w-8 h-8 md:w-14 md:h-14 group-hover:scale-110 transition-transform" alt="Google Maps">
                <span class="text-xs md:text-xl">Maps</span>
            </a>
            @endif

            @if($sosmedGlobal->url_tiktok ?? false)
            <a href="{{ $sosmedGlobal->url_tiktok }}" target="_blank" class="flex flex-row items-center gap-4 text-white hover:text-clr-accent transition group whitespace-nowrap odd:last:col-span-2">
                <img src="{{ asset('assets/TikTok.png') }}" class="w-8 h-8 md:w-14 md:h-14 group-hover:scale-110 transition-transform" alt="TikTok">
                <span class="text-sm md:text-xl">TikTok</span>
            </a>
            @endif

        </div>
        </div>
    </div>
</div>

