<div id="addImageModal"
    class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden flex items-center justify-center z-[100] p-4 animate-in fade-in duration-300">

    <div class="bg-white w-full max-w-lg rounded-[1.5rem] shadow-2xl fs-style-manrope overflow-hidden animate-in zoom-in-95 duration-300">
        <div class="px-10 py-8 border-b border-gray-100">
            <h2 class="text-2xl font-semibold text-[#3A0D0D]">Tambah Gambar Gereja</h2>
        </div>

        <div class="p-10 space-y-8">
            <div class="space-y-3">
                <div class="flex justify-between items-center mb-1.5">
                    <label class="block text-sm font-semibold text-gray-800">
                        Caption/Keterangan <span class="text-red-500">*</span> <span class="text-xs font-normal text-gray-400 ml-1">(Maksimal 15 kata)</span>
                    </label>
                    <span id="captionCounter" class="text-xs text-gray-400 font-medium">0/15 kata</span>
                </div>
                <div class="relative">
                    <input type="text" id="modalCaption" required oninput="updateWordCount(this)"
                        class="w-full px-4 py-3 bg-white border border-gray-300 rounded-lg focus:border-[#8C1007] focus:ring-1 focus:ring-[#8C1007] text-sm text-[#3A0D0D] placeholder:text-gray-400 font-medium transition-all"
                        placeholder="Masukkan keterangan foto (contoh: Tampak depan gereja)">
                </div>
            </div>
            <div class="space-y-3">
                <label class="block text-sm font-semibold text-gray-800">Upload Gambar <span class="text-red-500">*</span></label>
                <label for="modalImage" class="relative group block cursor-pointer">
                    <div class="border-2 border-dashed border-gray-200 rounded-2xl py-12 px-6 flex flex-col items-center justify-center bg-gray-50/30 group-hover:border-[#8C1007] group-hover:bg-[#FFF3F2]/30 transition-all min-h-[140px] relative overflow-hidden">
                        
                        <input type="file" id="modalImage" required class="sr-only" accept="image/*" onchange="updateFileName(this)">
                        
                        <div id="modalImagePlaceholder" class="flex flex-col items-center text-center z-10">
                            <svg class="w-10 h-10 text-gray-400 mb-4 group-hover:text-[#8C1007] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <p class="text-[12px] sm:text-sm font-medium text-gray-700 mb-1">Klik untuk upload foto atau drag & drop</p>
                            <p class="text-xs text-gray-400">JPG, JPEG, PNG (Maks. 10MB)</p>
                        </div>

                        <div id="modalImageSelected" class="hidden w-full h-full absolute inset-0 bg-white z-20 flex items-center justify-center p-6">
                            <div class="w-full bg-[#f9fafb] border border-gray-200 rounded-xl p-4 flex items-center justify-between gap-4 transition-all">
                                <div class="flex items-center gap-4 overflow-hidden">
                                     <div class="w-10 h-10 bg-red-50 text-[#8C1007] rounded-lg flex items-center justify-center shrink-0">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                     </div>
                                     <div class="flex flex-col min-w-0 text-left">
                                         <span id="fileNameDisplay" class="text-[14px] font-semibold text-gray-700 truncate block max-w-[250px]"></span>
                                         <span id="fileSizeDisplay" class="text-[12px] text-gray-400 font-medium"></span>
                                     </div>
                                </div>
                                <button type="button" onclick="resetModalImage()" class="w-8 h-8 flex items-center justify-center text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition-all cursor-pointer focus:outline-none">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </label>
                <div id="imageSizeError" class="hidden mt-3 flex items-center gap-2 text-red-500">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                    <span class="text-[13px] font-medium">Ukuran file maksimal 10MB.</span>
                </div>
            </div>
        </div>
        <div class="px-6 py-5 bg-gray-50/50 border-t border-gray-100 flex justify-end gap-3">
            <button type="button" onclick="closeAddModal()"
                class="bg-white border border-gray-200 text-gray-700 text-[10px] font-semibold hover:bg-gray-50 transition-colors focus:outline-none"
                style="border-radius: 0.5rem !important; padding: 7px 20px !important; display: inline-block !important;">
                Batal
            </button>

            <button type="button" onclick="addImageToEdit()"
                class="text-white text-[10px] font-semibold hover:opacity-90 transition-opacity focus:outline-none"
                style="background:#8C1007 !important; border-radius: 0.5rem !important; padding: 7px 20px !important; display: inline-block !important;">
                Tambah Gambar
            </button>
        </div>

    </div>
</div>
