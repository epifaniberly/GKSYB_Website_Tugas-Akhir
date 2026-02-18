<div class="py-10 md:py-16 bg-[#FCFAF7] fs-style-manrope" data-aos="fade-up">
    <div class="container mx-auto px-6 md:px-12 max-w-7xl">
        <div class="flex flex-col gap-8 md:gap-12">
            @if($profil)
                <div class="text-center">
                    <h2 class="text-xl md:text-4xl font-semibold text-[#3E0703] mb-4">
                        {{ $profil->nama ?? 'Gereja Santo Yusup Bintaran' }}
                    </h2>
                    @if($profil->deskripsi)
                    <p class="text-[#3E0703] text-xs md:text-lg opacity-80 max-w-3xl mx-auto italic">
                        "{{ $profil->deskripsi }}"
                    </p>
                    @endif
                </div>
                <div class="space-y-6">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="h-px bg-[#3E0703]/20 flex-1"></div>
                        <h3 class="text-xs md:text-xl font-semibold text-[#3E0703] uppercase tracking-widest text-center">Tilik Sejarah</h3>
                        <div class="h-px bg-[#3E0703]/20 flex-1"></div>
                    </div>
                    <div class="text-[#3E0703] text-[11px] md:text-lg leading-relaxed whitespace-pre-line text-justify px-2 md:px-0">
                        {!! $profil->sejarah ? nl2br(e($profil->sejarah)) : 'Belum ada data sejarah yang dimasukkan.' !!}
                    </div>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-12 mt-4 md:mt-8">
                    <div class="bg-white p-6 md:p-8 rounded-3xl shadow-sm border border-gray-100">
                        <h3 class="text-xs md:text-xl font-semibold text-[#3E0703] mb-4 flex items-center gap-2">
                            <svg class="w-6 h-6 text-[#8C1007]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            Visi Gereja
                        </h3>
                        <p class="text-[#3E0703] text-[11px] md:text-base leading-relaxed">
                            {{ $profil->visi ?? 'Belum ada data visi.' }}
                        </p>
                    </div>
                    <div class="bg-white p-6 md:p-8 rounded-3xl shadow-sm border border-gray-100">
                        <h3 class="text-xs md:text-xl font-semibold text-[#3E0703] mb-4 flex items-center gap-2">
                            <svg class="w-6 h-6 text-[#8C1007]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                            Misi Gereja
                        </h3>
                        <ul class="space-y-3 text-[#3E0703] text-[11px] md:text-base">
                            @if($profil->misi && is_array($profil->misi))
                                @foreach($profil->misi as $misi)
                                    <li class="flex items-start gap-3">
                                        <span class="mt-1.5 w-1.5 h-1.5 rounded-full bg-[#8C1007] shrink-0"></span>
                                        <span class="leading-relaxed">{{ $misi }}</span>
                                    </li>
                                @endforeach
                            @else
                                <li class="italic opacity-60">Belum ada data misi.</li>
                            @endif
                        </ul>
                    </div>
                </div>
            @else
                <div class="text-center py-20 opacity-40">
                    <p class="italic">Data profil gereja belum dinputkan di Admin Panel.</p>
                </div>
            @endif
        </div>
    </div>
</div>
