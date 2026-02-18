<section data-aos="fade-up" class="max-w-6xl mx-auto px-6 py-12">
    <div class="flex justify-center mb-8 px-4">
        <div class="inline-flex p-1.5 rounded-full border border-[#3b0d0d]/10 bg-white/50 backdrop-blur-sm overflow-x-auto max-w-full no-scrollbar">
            <button class="tab-btn active rounded-full font-medium transition-all duration-300 whitespace-nowrap"
                    data-tab="semua">Semua</button>

            @foreach($kategori as $kat)
            <button class="tab-btn rounded-full font-medium transition-all duration-300 whitespace-nowrap"
                    data-tab="{{ strtolower($kat->nama_kategori) }}">
                {{ $kat->nama_kategori }}
            </button>
            @endforeach
        </div>
    </div>

    <div id="tab-content">
        <div class="tab-pane" id="semua">

            <div class="max-w-3xl mx-auto space-y-4">

                @php
                    $semuaFaq = $faq->flatten();
                @endphp

                @forelse($semuaFaq as $index => $item)

                <div class="faq-card bg-[#FFFCFC] border border-[#F4E7E6] rounded-2xl mb-4 overflow-hidden transition-all duration-300 hover:shadow-sm">
                    <button class="faq-header w-full flex justify-between items-center p-6 text-left focus:outline-none select-none">
                        <span class="font-medium text-[#3E0703] text-sm md:text-lg pr-8">{{ $item->pertanyaan }}</span>
                        <svg class="faq-icon transition-transform duration-300 w-5 h-5 text-[#3E0703] shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                        </svg>
                    </button>
                    
                    <div class="faq-body hidden border-t border-[#F4E7E6]">
                        <div class="p-6 text-[#3E0703]/80 leading-relaxed font-light text-xs md:text-base">
                            {!! nl2br(e($item->jawaban)) !!}
                        </div>
                    </div>
                </div>

                @empty
                    <div class="empty-state text-center opacity-80 py-8">
                        Belum ada konten
                    </div>
                @endforelse
                <div id="no-search-results" class="hidden text-center py-8 opacity-80">
                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-gray-400">
                          <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                    </div>
                    <p class="font-semibold text-[#3b0d0d]">Pertanyaan Tidak Tersedia</p>
                </div>

            </div>
        </div>

        @foreach($kategori as $kat)

        <div class="tab-pane hidden" id="{{ strtolower($kat->nama_kategori) }}">

            <div class="max-w-3xl mx-auto space-y-4">

                @php
                    $list = $faq[strtolower($kat->nama_kategori)] ?? [];
                @endphp

                @forelse($list as $index => $item)

                <div class="faq-card bg-[#FFFCFC] border border-[#F4E7E6] rounded-2xl mb-4 overflow-hidden transition-all duration-300 hover:shadow-sm">
                    <button class="faq-header w-full flex justify-between items-center p-6 text-left focus:outline-none select-none">
                        <span class="font-medium text-[#3E0703] text-sm md:text-lg pr-8">{{ $item->pertanyaan }}</span>
                        <svg class="faq-icon transition-transform duration-300 w-5 h-5 text-[#3E0703] shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                        </svg>
                    </button>
                    
                    <div class="faq-body hidden border-t border-[#F4E7E6]">
                        <div class="p-6 text-[#3E0703]/80 leading-relaxed font-light text-xs md:text-base">
                            {!! nl2br(e($item->jawaban)) !!}
                        </div>
                    </div>
                </div>

                @empty
                    <div class="empty-state text-center opacity-80 py-8">
                        Belum ada konten
                    </div>
                @endforelse

            </div>
        </div>

        @endforeach

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

    .faq-card.is-open .faq-body {
        display: block !important;
        animation: bounceOpen 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        transform-origin: top;
    }
    
    .faq-card.is-open .faq-icon {
        transform: rotate(180deg);
    }
    
    @keyframes bounceOpen {
        0% { opacity: 0; transform: scaleY(0.9) translateY(-20px); }
        100% { opacity: 1; transform: scaleY(1) translateY(0); }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tabBtns = document.querySelectorAll(".tab-btn");
        const tabPanes = document.querySelectorAll(".tab-pane");

        function switchTab(targetId) {
            tabBtns.forEach(b => {
                if(b.dataset.tab === targetId) b.classList.add("active");
                else b.classList.remove("active");
            });

            tabPanes.forEach(pane => {
                if (pane.id === targetId) {
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
        }

        tabBtns.forEach(btn => {
            btn.addEventListener("click", () => {
                switchTab(btn.dataset.tab);
                
            });
        });
        
        const tabContent = document.getElementById('tab-content');
        
        tabContent.addEventListener('click', function(e) {
            const header = e.target.closest('.faq-header');
            if (header) {
                const card = header.closest('.faq-card');
                card.classList.toggle('is-open');
            }
        });

        const searchInput = document.getElementById('ssd-search-input');
        const noResultsMsg = document.getElementById('no-search-results');
        
        if (searchInput) {
            searchInput.addEventListener('input', function(e) {
                const term = e.target.value.toLowerCase().trim();
                
                if (term.length > 0) {
                    switchTab('semua');
                    
                    const semuaPane = document.getElementById('semua');
                    const cards = semuaPane.querySelectorAll('.faq-card');
                    const emptyStates = semuaPane.querySelectorAll('.empty-state');
                    
                    emptyStates.forEach(el => el.classList.add('hidden'));

                    let visibleCount = 0;

                    cards.forEach(card => {
                        const question = card.querySelector('.faq-header span').textContent.toLowerCase();
                        const answer = card.querySelector('.faq-body').textContent.toLowerCase();
                        
                        if (question.includes(term) || answer.includes(term)) {
                            card.classList.remove('hidden');
                            visibleCount++;
                        } else {
                            card.classList.add('hidden');
                        }
                    });

                    if (visibleCount === 0) {
                        noResultsMsg.classList.remove('hidden');
                    } else {
                        noResultsMsg.classList.add('hidden');
                    }

                } else {
                    const semuaPane = document.getElementById('semua');
                    const cards = semuaPane.querySelectorAll('.faq-card');
                    const emptyStates = semuaPane.querySelectorAll('.empty-state');
                    
                    cards.forEach(card => card.classList.remove('hidden'));
                    emptyStates.forEach(el => el.classList.remove('hidden'));
                    noResultsMsg.classList.add('hidden');
                }
            });
        }
    });
</script>

