<div class="pt-5" data-aos="fade-up">
    <div class="flex flex-col gap-8">
        <div class="py-4 px-8 text-center">
            <h1 class="text-center fs-style-manrope font-semibold text-[#3E0703] text-xl md:text-3xl">
                Peta Lokasi {{ $profil->nama ?? 'Gereja Santo Yusup Bintaran' }}
            </h1>
        </div>
        <div class="">
            @php
                $mapSource = "https://maps.google.com/maps?q=Gereja+Santo+Yusup+Bintaran&t=&z=15&ie=UTF8&iwloc=&output=embed";
                if($profil && $profil->maps) {
                    if(str_contains($profil->maps, 'iframe')) {
                        preg_match('/src="([^"]+)"/', $profil->maps, $match);
                        $mapSource = $match[1] ?? $mapSource;
                    } else {
                        $mapSource = $profil->maps;
                    }
                }
            @endphp
            <iframe 
                src="{{ $mapSource }}" 
                class="w-full h-[400px] md:h-[600px] border-0 rounded-lg shadow-lg" 
                allowfullscreen="" 
                loading="lazy" 
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </div>
</div>
