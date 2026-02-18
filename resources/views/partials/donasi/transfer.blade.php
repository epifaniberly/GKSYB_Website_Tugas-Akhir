    <div id="content-transfer" class="donation-content grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-20 items-center px-4 md:px-12">
        <div class="lg:col-span-5 flex flex-col items-center lg:items-start text-center lg:text-left space-y-8">
            <div class="w-10 h-10 md:w-16 md:h-16 mx-auto lg:mx-0">
                <svg viewBox="0 0 24 24" fill="none" class="w-full h-full text-[#3E0703]" stroke="currentColor" stroke-width="1.5">
                    <path d="M12 21V7" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M5 21V7" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M19 21V7" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M22 21H2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M12 2L2 7H22L12 2Z" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            
            <p class="text-[#3E0703] leading-relaxed text-sm md:text-base opacity-70 max-w-md">
                Hubungi kami melalui nomor rekening resmi di bawah ini untuk penyaluran persembahan Bapak/Ibu.
            </p>
            <div class="pt-6 border-t border-[#3E0703]/10 w-full">
                <p class="text-[11px] md:text-sm text-[#3E0703] opacity-50 mb-4 leading-relaxed italic">
                    * Untuk persembahan jumlah besar atau permintaan tanda terima resmi (pastoral), silakan hubungi Sekretariat:
                </p>
                <div class="flex flex-col items-center lg:items-start gap-1 font-semibold text-[#3E0703] text-xs md:text-base">
                    <a href="tel:{{ $profil->telepon ?? '' }}" class="hover:underline">{{ $profil->telepon ?? '(0274) 375231' }}</a>
                    <a href="mailto:{{ $profil->email ?? '' }}" class="hover:underline opacity-80">{{ $profil->email ?? 'parokibintaran@gmail.com' }}</a>
                </div>
            </div>
        </div>
        <div class="lg:col-span-7 flex flex-wrap gap-6 md:gap-8 justify-center items-stretch">
            @foreach($bank as $item)
            <div class="bg-white rounded-3xl md:rounded-[2rem] p-5 md:p-8 border border-[#3E0703]/5 shadow-sm hover:shadow-md transition-all duration-300 w-full max-w-[280px] md:max-w-[330px] lg:max-w-[380px]">
                <div class="mb-4 md:mb-6">
                    <div class="w-8 h-8 md:w-10 md:h-10 mb-4 text-[#3E0703]">
                         <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-full h-full">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0 0 12 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75Z" />
                        </svg>
                    </div>
                    <h4 class="font-medium text-[#3E0703] text-base md:text-lg tracking-tight">{{ $item->nama_bank }}</h4>
                </div>

                <div class="space-y-4 md:space-y-6">
                    <div class="group/copy cursor-pointer" onclick="copyToClipboard('{{ $item->nomor_rekening }}')">
                        <label class="text-[11px] md:text-xs font-medium text-[#3E0703] opacity-50 mb-2 block">Nomor Rekening</label>
                        <div class="flex justify-between items-center rounded-xl border border-[#3E0703]/10 px-4 md:px-5 py-2.5 md:py-3 bg-white group-hover/copy:border-[#3E0703]/30 transition-all shadow-sm">
                            <span class="text-[13px] md:text-sm font-medium text-[#3E0703] tracking-tight" id="rek-{{ $item->id }}">{{ $item->nomor_rekening }}</span>
                            <button class="text-[#3E0703]/30 group-hover/copy:text-[#3E0703] transition-colors pl-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 md:w-5 md:h-5">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 0 1-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 0 1 1.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 0 0-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 0 1-1.125-1.125v-9.25m12 6.625v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H9.75" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div>
                        <label class="text-[11px] md:text-xs font-medium text-[#3E0703] opacity-50 mb-2 block">Nama Akun</label>
                        <p class="font-medium text-[#3E0703] text-[13px] md:text-sm leading-tight tracking-tight">{{ $item->atas_nama }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

