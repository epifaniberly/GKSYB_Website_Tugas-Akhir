<section class="w-full bg-[#FCFAF7] text-[#3b0d0d] pt-6 pb-20 fs-style-manrope" data-aos="fade-up">
    <div class="container mx-auto px-6 md:px-16 lg:px-24 max-w-5xl">
        <div class="flex justify-center mb-8 px-4">
            <div class="inline-flex p-1.5 rounded-full border border-[#3b0d0d]/10 bg-white/50 backdrop-blur-sm overflow-x-auto max-w-full no-scrollbar">
                @foreach($kategori_jadwal as $index => $kat)
                <button class="tab-btn {{ $index === 0 ? 'active' : '' }} rounded-full font-medium transition-all duration-300 whitespace-nowrap" 
                        data-tab="kat-{{ $kat->id }}">
                    {{ $kat->nama_kategori }}
                </button>
                @endforeach
            </div>
        </div>

        <div class="border-t border-[#3b0d0d]/10 mb-8"></div>
        <div id="tab-content" class="min-h-[80px]">
            
            @foreach($kategori_jadwal as $index => $kat)
                <div class="tab-pane {{ $index === 0 ? '' : 'hidden' }}" id="kat-{{ $kat->id }}">
                    @php
                        $filtered = $jadwal->where('kategori_jadwal_id', $kat->id);
                    @endphp

                    @if($filtered->count() > 0)
                        <div class="flex flex-col gap-4 px-4 md:px-0">
                            @foreach($filtered as $j)
                            <div class="group bg-white rounded-2xl md:rounded-[1.5rem] px-6 py-6 md:py-8 border border-[#3E0703]/5 shadow-[0_2px_10px_rgba(0,0,0,0.03)] hover:shadow-[0_10px_40px_-5px_rgba(62,7,3,0.08)] transition-all duration-500 flex flex-col md:flex-row items-center gap-6 md:gap-8">
                                <div class="flex flex-col items-center md:items-start w-full md:w-36 shrink-0 md:border-r md:border-[#3E0703]/10 md:pr-8">
                                    <h4 class="text-base md:text-sm font-bold text-[#3E0703] tracking-[0.05em] mb-1">{{ $j->hari }}</h4>
                                    <p class="text-sm md:text-xl font-medium text-[#8C1007] leading-none">{{ date('H:i', strtotime($j->waktu)) }} <span class="text-xs opacity-50">WIB</span></p>
                                </div>
                                <div class="flex flex-col items-center md:items-start text-center md:text-left flex-1 min-w-0">
                                    <h3 class="text-lg md:text-2xl font-semibold text-[#3E0703] group-hover:text-[#8C1007] transition-colors leading-tight">
                                        {{ $j->nama_jadwal }}
                                    </h3>
                                    @if($j->keterangan)
                                        <p class="text-xs md:text-sm text-[#3E0703]/40 italic font-light mt-1.5 line-clamp-2">
                                            "{{ $j->keterangan }}"
                                        </p>
                                    @endif
                                </div>
                                <div class="flex justify-center md:justify-end w-full md:w-fit shrink-0 md:ml-auto">
                                    <div class="flex items-start gap-1.5 bg-[#3E0703]/5 border border-[#3E0703]/10 px-3.5 py-2 rounded-xl opacity-80 group-hover:opacity-100 transition-all duration-300 md:max-w-[240px]">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 shrink-0 mt-0.5 text-[#3E0703]/50" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        <span class="text-xs md:text-sm font-medium leading-tight text-left text-[#3E0703]/70">
                                            {{ $j->lokasi ?? 'Gereja' }}
                                        </span>
                                    </div>
                                </div>

                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="py-10 text-center opacity-40 italic">
                            Belum ada jadwal untuk kategori {{ $kat->nama_kategori }}.
                        </div>
                    @endif
                </div>
            @endforeach

        </div>
        <div class="mt-20 bg-[#FAFAF5] rounded-[2rem] p-6 md:p-12 text-[#3A0D0D] relative shadow-2xl">
            <div class="mb-4 md:mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 md:w-10 md:h-10 text-[#8C1007]">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m0-10.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.75c0 5.592 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.57-.598-3.75h-.152c-3.196 0-6.1-1.249-8.25-3.286Zm0 13.036h.008v.008H12v-.008Z" />
                </svg>
            </div>
            
            <h4 class="text-lg md:text-2xl font-semibold mb-3 md:mb-5">Catatan Penting</h4>
            <ul class="space-y-3 md:space-y-4 text-sm md:text-lg opacity-90 font-light list-disc pl-5 leading-relaxed">
                <li>Harap datang 15 menit sebelum misa dimulai untuk menjaga ketertiban dan kekhusyukan ibadah.</li>
                <li>Untuk misa pernikahan, baptis, atau acara khusus, silakan hubungi Sekretariat Paroki. Jadwal Misa Hari Raya dapat berubah sesuai kalender liturgi Gereja.</li>
                <li>Umat diharapkan memperhatikan jadwal penggunaan Ruang Adorasi dan hadir dalam suasana doa, tetap hening dan khusyuk.</li>
                <li>Informasi mengenai kegiatan adorasi, waktu adorasi sakramen Mahakudus, serta jadwal Rosario bersama dapat berubah menyesuaikan kalender liturgi dan kegiatan paroki.</li>
            </ul>
        </div>
    </div>
</section>

<style>
    .no-scrollbar::-webkit-scrollbar { display: none; }
    .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }

    .tab-btn {
        font-size: clamp(10px, 2.5vw, 14px);
        padding: clamp(8px, 1.5vw, 12px) clamp(16px, 2.5vw, 32px);
    }
    .tab-btn.active {
        background-color: #8C1007;
        color: white;
        box-shadow: 0 4px 12px rgba(140, 16, 7, 0.3);
    }
    .tab-btn:not(.active):hover {
        background-color: rgba(140, 16, 7, 0.05);
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tabBtns = document.querySelectorAll(".tab-btn");
        const tabPanes = document.querySelectorAll(".tab-pane");

        tabBtns.forEach(btn => {
            btn.addEventListener("click", () => {
                const target = btn.getAttribute("data-tab");

                tabBtns.forEach(b => b.classList.remove("active"));
                btn.classList.add("active");

                tabPanes.forEach(pane => {
                    if (pane.id === target) {
                        pane.classList.remove("hidden");
                        pane.style.opacity = 0;
                        setTimeout(() => {
                            pane.style.transition = "opacity 0.4s ease-in-out";
                            pane.style.opacity = 1;
                        }, 50);
                    } else {
                        pane.classList.add("hidden");
                        pane.style.opacity = 0;
                    }
                });
            });
        });
    });
</script>

