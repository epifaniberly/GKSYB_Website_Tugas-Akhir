<section data-aos="fade-up" class=" py-12 fs-style-manrope">
    <div class="max-w-6xl mx-auto px-6">
        <div class="max-w-3xl mx-auto space-y-4">
        @forelse($kategori as $kat)
        <div class="doc-accordion bg-[#FFFCFC] border border-[#F4E7E6] rounded-2xl mb-4 overflow-hidden transition-all duration-300 hover:shadow-sm">
            <button class="doc-header w-full flex justify-between items-center p-6 text-left focus:outline-none select-none hover:bg-gray-50/50">
                <span class="font-medium text-[#3E0703] text-xs md:text-lg pr-8">{{ $kat->nama_kategori }}</span>
                <svg class="doc-icon transition-transform duration-300 w-6 h-6 text-[#3E0703]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            <div class="doc-body hidden border-t border-[#F4E7E6]">
                <div class="p-4 md:p-6 space-y-4">
                    @forelse($kat->dokumen as $doc)
                    <div class="flex flex-col sm:flex-row items-start sm:items-center p-4 sm:p-5 bg-[#FFFCFC] border border-[#F4E7E6] rounded-2xl gap-4 sm:gap-6 hover:shadow-sm transition-all">
                        <div class="w-14 h-14 rounded-lg flex items-center justify-center shrink-0">
                            @php
                                $ext = pathinfo($doc->file, PATHINFO_EXTENSION);
                                $isWord = in_array(strtolower($ext), ['doc', 'docx']);
                                $isPdf = strtolower($ext) === 'pdf';
                            @endphp
                            
                            @if($isWord)
                                <div class="relative w-10 h-10 bg-blue-50 flex items-center justify-center border border-blue-100 rounded">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                        <line x1="16" y1="13" x2="8" y2="13"></line>
                                        <line x1="16" y1="17" x2="8" y2="17"></line>
                                        <polyline points="10 9 9 9 8 9"></polyline>
                                    </svg>
                                    <span class="absolute -bottom-1 -right-1 bg-blue-600 text-[8px] text-white px-1 rounded font-semibold uppercase">DOC</span>
                                </div>
                            @elseif($isPdf)
                                <div class="relative w-10 h-10 bg-red-50 flex items-center justify-center border border-red-100 rounded">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-red-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                        <path d="M9 15h3a2 2 0 0 1 0 4h-3v-4Z"></path>
                                        <path d="M9 12v3"></path>
                                    </svg>
                                    <span class="absolute -bottom-1 -right-1 bg-red-600 text-[8px] text-white px-1 rounded font-semibold uppercase">PDF</span>
                                </div>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                </svg>
                            @endif
                        </div>
                        <div class="flex items-center justify-between gap-4 w-full">
                            <div class="flex-1 text-left">
                                <h4 class="font-semibold text-[#3E0703] text-[11px] md:text-lg leading-tight">{{ $doc->judul_dokumen }}</h4>
                                <div class="flex flex-wrap items-center gap-x-2 sm:gap-x-3 gap-y-0.5 mt-1">
                                    <p class="text-[10px] md:text-sm text-[#3E0703]/60 leading-relaxed line-clamp-2 md:line-clamp-none">{{ $doc->keterangan ?? 'Dokumen gereja' }}</p>
                                    <span class="hidden sm:inline text-[10px] md:text-sm text-[#3E0703]/30">•</span>
                                    <p class="text-[9px] md:text-sm font-medium text-[#3E0703]/50 uppercase tracking-wider">{{ $ext }} file</p>
                                </div>
                            </div>
                            <div class="shrink-0">
                                <a href="{{ route('landing.dokumen.download', $doc->id) }}" 
                                   onclick="showDownloadToast('{{ $doc->judul_dokumen }}')"
                                   class="btn-accent inline-flex items-center justify-center px-4 md:px-8 py-2 md:py-2.5 text-white rounded-full text-[10px] md:text-sm font-medium hover:opacity-90 transition-all shadow-sm w-auto whitespace-nowrap">
                                    Download
                                </a>
                            </div>
                        </div>
                    </div>
                    @empty
                    <p class="text-center text-sm text-[#3E0703]/50 py-4 italic">Belum ada dokumen untuk kategori ini.</p>
                    @endforelse
                </div>
            </div>
        </div>
        @empty
        <div class="text-center py-20 bg-white rounded-2xl border border-dashed border-gray-200">
            <p class="text-[#3E0703]/40">Belum ada kategori dokumen tersedia.</p>
        </div>
        @endforelse
    </div>
    </div>
</section>

<style>
    .doc-accordion.is-open .doc-body {
        display: block !important;
        animation: bounceOpen 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        transform-origin: top;
    }
    
    .doc-accordion.is-open .doc-icon {
        transform: rotate(180deg);
    }
    
    @keyframes bounceOpen {
        0% { opacity: 0; transform: scaleY(0.9) translateY(-20px); }
        100% { opacity: 1; transform: scaleY(1) translateY(0); }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const accordions = document.querySelectorAll('.doc-accordion');
        
        accordions.forEach(acc => {
            const header = acc.querySelector('.doc-header');
            header.addEventListener('click', () => {
                accordions.forEach(other => {
                    if (other !== acc) other.classList.remove('is-open');
                });
                acc.classList.toggle('is-open');
            });
        });
    });

    function showDownloadToast(title) {
        Swal.fire({
            icon: 'success',
            title: 'Mengunduh...',
            text: title,
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            background: '#fff',
            iconColor: '#690c05',
            customClass: {
                popup: 'colored-toast',
                title: 'text-[#3E0703] font-bold',
                htmlContainer: 'text-[#3E0703]/80'
            }
        });
    }
</script>

