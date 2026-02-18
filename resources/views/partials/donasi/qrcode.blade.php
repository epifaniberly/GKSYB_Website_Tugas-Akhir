    <div id="content-qrcode" class="donation-content hidden grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-20 items-center px-4 md:px-12">
        <div class="lg:col-span-4 flex flex-col items-center lg:items-start text-center lg:text-left space-y-6">
            <div class="w-10 h-10 md:w-16 md:h-16 mb-2 mx-auto lg:mx-0">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-full h-full text-[#3E0703]">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 1.5H8.25A2.25 2.25 0 0 0 6 3.75v16.5a2.25 2.25 0 0 0 2.25 2.25h7.5A2.25 2.25 0 0 0 18 20.25V3.75a2.25 2.25 0 0 0-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" />
                </svg>
            </div>
            
            <h3 class="text-lg md:text-2xl font-semibold text-[#3E0703]">Persembahan melalui Kode QR</h3>
            <p class="text-[#3E0703]/70 leading-relaxed max-w-md text-xs md:text-base">
                Cukup pindai kode QR menggunakan aplikasi perbankan mobile atau dompet digital Anda untuk melakukan persembahan instan. Prosesnya cepat, aman, dan nyaman.
            </p>
            
            <ul class="space-y-3 pt-4 flex flex-col items-center lg:items-start text-center lg:text-left text-[11px] md:text-base">
                <li class="flex items-center gap-3 text-[#3E0703]/80">
                    <span class="w-1.5 h-1.5 rounded-full bg-[#8C1007] shrink-0 hidden lg:block"></span>
                    <span>Pembayaran instan dan aman</span>
                </li>
                <li class="flex items-center gap-3 text-[#3E0703]/80">
                    <span class="w-1.5 h-1.5 rounded-full bg-[#8C1007] shrink-0 hidden lg:block"></span>
                    <span>Kompatibel dengan perbankan & e-wallet</span>
                </li>
                <li class="flex items-center gap-3 text-[#3E0703]/80">
                    <span class="w-1.5 h-1.5 rounded-full bg-[#8C1007] shrink-0 hidden lg:block"></span>
                    <span>Tanpa biaya transaksi</span>
                </li>
            </ul>
        </div>
        <div class="lg:col-span-8 flex justify-center lg:justify-end w-full">
            <div class="bg-white p-6 md:p-8 rounded-[2rem] shadow-lg border border-[#3E0703]/5 w-full max-w-[440px] text-center relative overflow-hidden group">
                
                @if($qrcode)
                    <div class="mb-5">
                        <div class="w-8 h-8 md:w-11 md:h-11 mx-auto mb-2 flex items-center justify-center text-[#3E0703]">
                            <svg viewBox="0 0 48 48" fill="none" class="w-full h-full" xmlns="http://www.w3.org/2000/svg">
                                <path d="M14 8H8V14" stroke="currentColor" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M34 8H40V14" stroke="currentColor" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M8 34V40H14" stroke="currentColor" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M40 34V40H34" stroke="currentColor" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M20 20H28V28H20V20Z" stroke="currentColor" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M8 24H12" stroke="currentColor" stroke-width="4" stroke-linecap="round"/>
                                <path d="M36 24H40" stroke="currentColor" stroke-width="4" stroke-linecap="round"/>
                                <path d="M24 8V12" stroke="currentColor" stroke-width="4" stroke-linecap="round"/>
                                <path d="M24 36V40" stroke="currentColor" stroke-width="4" stroke-linecap="round"/>
                            </svg>
                        </div>
                        <h4 class="font-bold text-[#3E0703] text-lg md:text-xl mb-3 tracking-tight">Pindai Untuk Persembahan</h4>
                        <p class="text-xs md:text-base text-[#3E0703]/60 max-w-[280px] mx-auto font-medium leading-relaxed">
                            Scan QR Code menggunakan aplikasi mobile banking atau e-wallet Anda
                        </p>
                    </div>
                    <div class="relative bg-white mb-5 mx-auto max-w-[240px] md:max-w-[280px]">
                        <img src="{{ asset($qrcode->qr_img) }}" 
                             alt="QR Code Persembahan" 
                             class="w-full h-auto object-contain shadow-sm rounded-xl">
                    </div>
                    <a href="{{ asset($qrcode->qr_img) }}" download="QR_Code_Donasi_{{ $qrcode->nama_metode ?? 'GKSYB' }}" 
                       onclick="Swal.fire({
                           icon: 'success',
                           title: 'Berhasil!',
                           text: 'Barcode sedang diunduh...',
                           toast: true,
                           position: 'top-end',
                           showConfirmButton: false,
                           timer: 3000,
                           timerProgressBar: true,
                           iconColor: '#059669',
                           customClass: {
                               title: 'text-[#3E0703] font-bold',
                               popup: 'rounded-2xl border-none shadow-xl'
                           }
                       })"
                       class="btn-accent px-6 py-2.5 md:px-8 md:py-3 text-xs md:text-sm font-bold inline-flex items-center justify-center gap-2 shadow-md">
                        <span>Unduh Barcode</span>
                    </a>
 
                @else
                    <div class="py-16 flex flex-col items-center justify-center opacity-60">
                        <div class="w-16 h-16 mb-5 bg-gray-50 rounded-full flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-gray-400">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0 1 3.75 9.375v-4.5ZM3.75 14.625c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5a1.125 1.125 0 0 1-1.125-1.125v-4.5ZM13.5 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0 1 13.5 9.375v-4.5Z" />
                            </svg>
                        </div>
                        <h4 class="font-semibold text-[#3E0703] text-sm">QR Code Belum Tersedia</h4>
                        <p class="text-xs text-[#3E0703]/50 mt-2">Mohon gunakan metode transfer bank.</p>
                    </div>
                @endif
                
            </div>
        </div>
    </div>

