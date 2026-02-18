<header class="flex shadow-sm py-0 px-4 sm:px-10 bg-[#FCFAF7] min-h-[64px] tracking-wide fixed top-0 left-0 w-full z-50">
    <div class="flex flex-wrap items-center justify-between gap-5 w-full max-w-screen-2xl mx-auto">
        <div class="flex items-center">
            <a href="{{route('landing.index')}}" class="block">
                <div class="h-10 flex items-center max-w-[240px]">
                    @if(isset($identitasGlobal) && $identitasGlobal->logo)
                        <img src="{{ asset('storage/' . $identitasGlobal->logo) }}" alt="{{ $identitasGlobal->nama_website }}" class="h-full w-auto object-contain object-left" />
                    @else
                        <img src="{{ asset('assets/logo.png') }}" alt="logo" class="h-full w-auto object-contain object-left" />
                    @endif
                </div>
            </a>
        </div>
        <div id="collapseMenu"
            class="hidden lg:!block lg:static absolute top-[64px] left-0 w-full bg-[#FCFAF7] shadow-lg lg:shadow-none lg:w-auto z-50 lg:bg-transparent border-t border-gray-100 lg:border-t-0 max-lg:overflow-hidden lg:overflow-visible">
            
            <ul class="lg:flex lg:items-center gap-x-12 max-lg:flex-col max-lg:p-6 max-lg:space-y-4">
                <li class="group relative flex flex-col lg:flex-row lg:items-center lg:h-[64px]">
                    <a href='javascript:void(0)'
                        class="hover:text-[#8C1007] text-[#3b0d0d] font-semibold text-[13px] lg:text-[15px] flex items-center justify-between lg:justify-start gap-1 transition-colors fs-style-manrope w-full">
                        Tentang Gereja
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 24 24" class="lg:group-hover:rotate-180 transition-transform">
                            <path d="M12 16a1 1 0 0 1-.71-.29l-6-6a1 1 0 0 1 1.42-1.42l5.29 5.3 5.29-5.29a1 1 0 0 1 1.41 1.41l-6 6a1 1 0 0 1-.7.29z" />
                        </svg>
                    </a>
                    <div class="lg:absolute lg:top-full lg:left-1/2 lg:-translate-x-1/2 lg:left-0 z-50 bg-[#FCFAF7] lg:min-w-[700px] lg:shadow-2xl lg:border-t-4 lg:border-[#8C1007] transform transition-all duration-300 origin-top
                               hidden lg:flex lg:invisible lg:opacity-0 lg:group-hover:visible lg:group-hover:opacity-100 lg:pointer-events-none lg:group-hover:pointer-events-auto lg:[&.show-dropdown]:!visible lg:[&.show-dropdown]:!opacity-100 lg:[&.show-dropdown]:!pointer-events-auto flex-col lg:flex-row lg:overflow-hidden lg:rounded-b-2xl mt-4 lg:mt-0 group-hover:flex">
                        <ul class="lg:w-[55%] flex flex-col lg:pt-2 lg:pb-2">
                            <li class="hover:bg-white/50 transition-colors border-b border-gray-100/50">
                                <a href="{{ route('landing.sejarah') }}" class="lg:px-8 py-3 lg:py-4 flex flex-col group/item fs-style-manrope">
                                    <div class="flex items-center gap-3">
                                        <span class="w-1.5 h-1.5 rounded-full bg-[#8C1007] lg:opacity-0 lg:group-hover/item:opacity-100 transition-opacity"></span>
                                        <span class="text-[#3b0d0d] font-semibold text-[12px] lg:text-[15px]">Tilik Sejarah</span>
                                    </div>
                                    <span class="hidden lg:block text-[11px] text-gray-400 font-medium ml-4.5 mt-0.5">Jelajahi perjalanan iman & warisan sejarah paroki.</span>
                                </a>
                            </li>
                            <li class="hover:bg-white/50 transition-colors border-b border-gray-100/50">
                                <a href="{{ route('landing.gembala') }}" class="lg:px-8 py-3 lg:py-4 flex flex-col group/item fs-style-manrope">
                                    <div class="flex items-center gap-3">
                                        <span class="w-1.5 h-1.5 rounded-full bg-[#8C1007] lg:opacity-0 lg:group-hover/item:opacity-100 transition-opacity"></span>
                                        <span class="text-[#3b0d0d] font-semibold text-[12px] lg:text-[15px]">Gembala Berkarya</span>
                                    </div>
                                    <span class="hidden lg:block text-[11px] text-gray-400 font-medium ml-4.5 mt-0.5">Mengenal para pelayan altar yang menggembalakan umat.</span>
                                </a>
                            </li>
                            <li class="hover:bg-white/50 transition-colors border-b border-gray-100/50">
                                <a href="{{ route('landing.doa') }}" class="lg:px-8 py-3 lg:py-4 flex flex-col group/item fs-style-manrope">
                                    <div class="flex items-center gap-3">
                                        <span class="w-1.5 h-1.5 rounded-full bg-[#8C1007] lg:opacity-0 lg:group-hover/item:opacity-100 transition-opacity"></span>
                                        <span class="text-[#3b0d0d] font-semibold text-[12px] lg:text-[15px]">Doa dan Perayaan Ekaristi</span>
                                    </div>
                                    <span class="hidden lg:block text-[11px] text-gray-400 font-medium ml-4.5 mt-0.5">Jadwal Misa, doa rutin, dan perayaan liturgi paroki.</span>
                                </a>
                            </li>
                            <li class="hover:bg-white/50 transition-colors">
                                <a href="{{ route('landing.sakramen') }}" class="lg:px-8 py-3 lg:py-4 flex flex-col group/item fs-style-manrope">
                                    <div class="flex items-center gap-3">
                                        <span class="w-1.5 h-1.5 rounded-full bg-[#8C1007] lg:opacity-0 lg:group-hover/item:opacity-100 transition-opacity"></span>
                                        <span class="text-[#3b0d0d] font-semibold text-[12px] lg:text-[15px]">Sakramen Gereja Katolik</span>
                                    </div>
                                    <span class="hidden lg:block text-[11px] text-gray-400 font-medium ml-4.5 mt-0.5">7 tanda rahmat Tuhan dalam perjalanan iman Katolik.</span>
                                </a>
                            </li>
                        </ul>
                        <div class="hidden lg:flex lg:w-[45%] bg-[#F5F1EA] p-6 items-center justify-center border-l border-gray-200/50">
                            <div class="bg-white rounded-2xl border border-gray-200/50 p-6 flex flex-col items-center gap-4 shadow-sm w-full group/card hover:shadow-md transition-all">
                                <div class="w-12 h-12 rounded-xl bg-[#8C1007]/5 flex items-center justify-center text-[#8C1007] shadow-inner group-hover/card:rotate-6 transition-transform">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                    </svg>
                                </div>
                                <div class="text-center space-y-1.5">
                                    <h3 class="text-[14px] font-semibold text-gray-800 fs-style-manrope">Visi & Misi Gereja</h3>
                                    <p class="text-[11px] text-gray-500 font-medium leading-relaxed fs-style-manrope mb-2">
                                        Mewujudkan komunitas umat beriman yang guyub, rukun, dan melayani serta berbagi berkat.
                                    </p>
                                    <a href="{{ route('landing.sejarah') }}" class="text-[#8C1007] text-[11px] font-semibold uppercase tracking-widest hover:underline decoration-2 underline-offset-4">Pelajari Selengkapnya &rarr;</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="flex items-center lg:h-[64px]">
                    <a href='{{ route('landing.tulisan') }}' 
                       class="hover:text-[#8C1007] text-[#3b0d0d] font-semibold text-[13px] lg:text-[15px] transition-colors fs-style-manrope w-full">
                       Tulisan Bintaran
                    </a>
                </li>
                <li class="group relative flex flex-col lg:flex-row lg:items-center lg:h-[64px]">
                    <a href='javascript:void(0)'
                        class="hover:text-[#8C1007] text-[#3b0d0d] font-semibold text-[13px] lg:text-[15px] flex items-center justify-between lg:justify-start gap-1 transition-colors fs-style-manrope w-full">
                        Informasi
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 24 24" class="lg:group-hover:rotate-180 transition-transform">
                            <path d="M12 16a1 1 0 0 1-.71-.29l-6-6a1 1 0 0 1 1.42-1.42l5.29 5.3 5.29-5.29a1 1 0 0 1 1.41 1.41l-6 6a1 1 0 0 1-.7.29z" />
                        </svg>
                    </a>

                    @php
                        $gallery = \App\Models\GalleryModel::first();
                    @endphp

                    <div class="lg:absolute lg:top-full lg:left-1/2 lg:-translate-x-1/2 lg:left-0 lg:translate-x-[-40%] z-50 bg-[#FCFAF7] lg:min-w-[650px] lg:shadow-2xl lg:border-t-4 lg:border-[#8C1007] transform transition-all duration-300 origin-top
                               hidden lg:flex lg:invisible lg:opacity-0 lg:group-hover:visible lg:group-hover:opacity-100 lg:pointer-events-none lg:group-hover:pointer-events-auto lg:[&.show-dropdown]:!visible lg:[&.show-dropdown]:!opacity-100 lg:[&.show-dropdown]:!pointer-events-auto flex flex-col lg:flex-row lg:overflow-hidden lg:rounded-b-2xl mt-4 lg:mt-0 group-hover:flex">
                        <ul class="lg:w-1/2 flex flex-col lg:pt-2 lg:pb-2">
                            <li class="hover:bg-white/50 transition-colors border-b border-gray-100/50">
                                <a href='{{ route('landing.contact') }}' class="lg:px-8 py-3 lg:py-4 flex flex-col group/item fs-style-manrope">
                                    <div class="flex items-center gap-3">
                                        <span class="w-1.5 h-1.5 rounded-full bg-[#8C1007] lg:opacity-0 lg:group-hover/item:opacity-100 transition-opacity"></span>
                                        <span class="text-[#3b0d0d] font-semibold text-[12px] lg:text-[15px]">Kontak Kami</span>
                                    </div>
                                    <span class="hidden lg:block text-[11px] text-gray-400 font-medium ml-4.5 mt-0.5">Informasi alamat, telepon, dan layanan sekretariat.</span>
                                </a>
                            </li>
                            <li class="hover:bg-white/50 transition-colors border-b border-gray-100/50">
                                <a href='{{ route('landing.ssd') }}' class="lg:px-8 py-3 lg:py-4 flex flex-col group/item fs-style-manrope">
                                    <div class="flex items-center gap-3">
                                        <span class="w-1.5 h-1.5 rounded-full bg-[#8C1007] lg:opacity-0 lg:group-hover/item:opacity-100 transition-opacity"></span>
                                        <span class="text-[#3b0d0d] font-semibold text-[12px] lg:text-[15px]">Soal Sering Ditanya</span>
                                    </div>
                                    <span class="hidden lg:block text-[11px] text-gray-400 font-medium ml-4.5 mt-0.5">Jawaban cepat untuk berbagai pertanyaan umum umat.</span>
                                </a>
                            </li>
                            <li class="hover:bg-white/50 transition-colors">
                                <a href='{{ route('landing.donasi') }}' class="lg:px-8 py-3 lg:py-4 flex flex-col group/item fs-style-manrope">
                                    <div class="flex items-center gap-3">
                                        <span class="w-1.5 h-1.5 rounded-full bg-[#8C1007] lg:opacity-0 lg:group-hover/item:opacity-100 transition-opacity"></span>
                                        <span class="text-[#3b0d0d] font-semibold text-[12px] lg:text-[15px]">Donasi & Persembahan</span>
                                    </div>
                                    <span class="hidden lg:block text-[11px] text-gray-400 font-medium ml-4.5 mt-0.5">Berbagi berkat untuk pembangunan & pelayanan gereja.</span>
                                </a>
                            </li>
                        </ul>
                        <div class="hidden lg:flex lg:w-1/2 bg-[#F5F1EA] p-8 items-center justify-center border-l border-gray-200/50">
                            <div class="bg-white rounded-2xl border border-gray-200/50 p-6 flex flex-col items-center gap-4 shadow-sm w-full group/card hover:shadow-md transition-all">
                                <div class="w-14 h-14 rounded-full bg-green-50 flex items-center justify-center text-green-600 shadow-inner group-hover/card:scale-110 transition-transform">
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"></path>
                                    </svg>
                                </div>
                                <div class="text-center space-y-1.5">
                                    <h3 class="text-[15px] font-semibold text-gray-800 fs-style-manrope">Galeri & Dokumentasi</h3>
                                    <p class="text-[11px] text-gray-500 font-medium leading-relaxed fs-style-manrope">
                                        Lihat kumpulan dokumentasi kegiatan Paroki Santo Yusup Bintaran
                                    </p>
                                </div>
                                <a href="{{ $gallery->url ?? '#' }}" target="_blank"
                                   class="text-white text-xs font-medium flex items-center gap-2 transition-all shadow-lg shadow-red-900/10 hover:opacity-90 border-none cursor-pointer group/btn"
                                   style="background-color: #8C1007; border-radius: 0.5rem; padding: 10px 24px;">
                                    Buka Galeri
                                    <svg class="w-3.5 h-3.5 group-hover/btn:translate-x-0.5 group-hover/btn:-translate-y-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 3h7m0 0v7m0-7L10 14"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <div class="flex items-center gap-4">
            <a href="{{ route('landing.contact') }}" 
               class="btn-accent px-4 md:px-6 py-1.5 md:py-2.5 rounded-full text-[10px] md:text-[14px] font-semibold transition-all hover:scale-105 active:scale-95 whitespace-nowrap">
                Hubungi Kami
            </a>
            <button id="toggleOpen" class="lg:hidden p-2 text-slate-900 border border-transparent hover:border-gray-200 rounded-lg transition-all">
                <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                </svg>
            </button>
        </div>
    </div>
</header>

<style>
    .visibility-hidden {
        visibility: hidden;
    }
    .group:hover .visibility-hidden {
        visibility: visible;
    }
    @media (max-lg: 1024px) {
        #collapseMenu {
            transition: all 0.3s ease-in-out;
            max-height: 0;
            display: block !important;
        }
        #collapseMenu.show {
            max-height: 80vh;
            overflow-y: auto;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggleOpen = document.getElementById('toggleOpen');
        const collapseMenu = document.getElementById('collapseMenu');

        if (toggleOpen && collapseMenu) {
            toggleOpen.addEventListener('click', () => {
                collapseMenu.classList.toggle('show');
                collapseMenu.classList.toggle('hidden');
            });
        }

        const dropdownToggles = document.querySelectorAll('li.group > a[href="javascript:void(0)"]');
        
        document.addEventListener('click', function(event) {
            if (!event.target.closest('li.group')) {
                document.querySelectorAll('.show-dropdown, .rotate-180').forEach(el => {
                    el.classList.remove('show-dropdown');
                    if (el.tagName === 'svg' || el.tagName === 'SVG') {
                         el.classList.remove('rotate-180');
                    }
                    if(window.innerWidth < 1024 && el.classList.contains('flex')) { 
                        el.classList.add('hidden');
                        el.classList.remove('flex');
                    }
                });
                
                if(window.innerWidth < 1024) {
                     const openMenus = document.querySelectorAll('li.group > div:not(.hidden)');
                     openMenus.forEach(menu => {
                         menu.classList.add('hidden');
                         menu.classList.remove('flex');
                     });
                }
            }
        });

        dropdownToggles.forEach(toggle => {
            toggle.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                const submenu = this.nextElementSibling;
                const icon = this.querySelector('svg');
                
                if (submenu) {
                    document.querySelectorAll('.show-dropdown').forEach(el => {
                        if (el !== submenu) {
                            el.classList.remove('show-dropdown');
                            if(window.innerWidth < 1024) {
                                el.classList.add('hidden');
                                el.classList.remove('flex');
                            }
                        }
                    });
                    document.querySelectorAll('li.group > a svg.rotate-180').forEach(el => {
                        if (el !== icon) el.classList.remove('rotate-180');
                    });
                    submenu.classList.toggle('hidden');
                    submenu.classList.toggle('flex');
                    
                    submenu.classList.toggle('show-dropdown');
                    
                    if (icon) {
                        icon.classList.toggle('rotate-180');
                    }
                }
            });
        });
    });
</script>
