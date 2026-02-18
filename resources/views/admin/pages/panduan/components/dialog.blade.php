<div id="modalEdit" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-[100] backdrop-blur-sm fs-style-manrope p-4">
    <div class="bg-white rounded-2xl w-full max-w-5xl max-h-[95vh] flex flex-col shadow-2xl overflow-hidden">
        <div class="px-8 py-5 border-b border-gray-100 flex justify-between items-center shrink-0">
            <div>
                <h3 id="modalEditTitle" class="text-xl font-semibold text-gray-800">Edit Panduan Ekaristi</h3>
                <p id="modalEditDesc" class="text-xs text-gray-400 mt-0.5">Sesuaikan informasi panduan perayaan ekaristi</p>
            </div>
        </div>
        <div class="overflow-y-auto flex-1 p-0 bg-gray-50/50">
            <form id="formEdit" method="POST" enctype="multipart/form-data" novalidate>
                @csrf
                @method('PATCH')
                <input type="hidden" name="id" id="edit_id">

                <div class="grid grid-cols-1 lg:grid-cols-2">
                    <div class="p-8 space-y-5 border-r border-gray-100 bg-white pb-12">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div id="e_jenis_misa_container" class="space-y-1.5">
                                <label class="block text-sm font-semibold text-gray-800 mb-1.5">Jenis Misa <span class="text-red-500">*</span></label>
                                <input type="text" name="jenis_misa" id="edit_jenis_misa"
                                    class="w-full h-[45px] px-4 rounded-xl border border-gray-200 focus:border-[#8C1007] focus:ring-1 focus:ring-[#8C1007] text-sm transition-all bg-gray-50/50" required>
                            </div>
                            <div id="e_perayaan_container" class="space-y-1.5">
                                <label class="block text-sm font-semibold text-gray-800 mb-1.5">Nama Perayaan <span class="text-red-500">*</span></label>
                                <input type="text" name="perayaan" id="edit_perayaan"
                                    class="w-full h-[45px] px-4 rounded-xl border border-gray-200 focus:border-[#8C1007] focus:ring-1 focus:ring-[#8C1007] text-sm transition-all bg-gray-50/50" required>
                            </div>
                        </div>

                        <div id="e_ket_perayaan_container" class="space-y-1.5">
                            <div class="flex justify-between items-center mb-1.5 px-0.5">
                                <label class="text-sm font-semibold text-gray-800">Keterangan Perayaan <span class="text-red-500">*</span></label>
                                <span id="wordCountKetEdit" class="text-[10px] text-gray-400 font-medium tracking-tight">0/15 kata</span>
                            </div>
                            <textarea name="ket_perayaan" id="edit_ket_perayaan"
                                class="w-full h-[100px] p-4 rounded-xl border border-gray-200 focus:border-[#8C1007] focus:ring-1 focus:ring-[#8C1007] text-sm transition-all resize-none bg-gray-50/50 outline-none" required></textarea>
                        </div>

                        <div id="e_ayat_alkitab_container" class="space-y-1.5">
                            <div class="flex justify-between items-center mb-1.5 px-0.5">
                                <label class="text-sm font-semibold text-gray-800">Ayat Alkitab <span class="text-red-500">*</span></label>
                                <span id="wordCountAyatEdit" class="text-[10px] text-gray-400 font-medium tracking-tight">0/20 kata</span>
                            </div>
                            <textarea name="ayat_alkitab" id="edit_ayat_alkitab"
                                class="w-full h-[80px] p-4 rounded-xl border border-gray-200 focus:border-[#8C1007] focus:ring-1 focus:ring-[#8C1007] text-sm transition-all resize-none bg-gray-50/50 outline-none" required></textarea>
                        </div>

                        <div id="e_sumber_ayat_container" class="space-y-1.5">
                            <label class="block text-sm font-semibold text-gray-800 mb-1.5">Sumber Ayat <span class="text-red-500">*</span></label>
                            <input type="text" name="sumber_ayat" id="edit_sumber_ayat"
                                class="w-full h-[45px] px-4 rounded-xl border border-gray-200 focus:border-[#8C1007] focus:ring-1 focus:ring-[#8C1007] text-sm transition-all bg-gray-50/50" required>
                        </div>

                        <div id="e_tanggal_container" class="p-4 bg-gray-50/50 rounded-2xl border border-gray-100 space-y-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-800 mb-2">Tanggal Perayaan <span class="text-red-500">*</span></label>
                                <div class="flex gap-6">
                                    <label class="flex items-center gap-2 cursor-pointer group">
                                        <input type="radio" name="tipe_tanggal" value="tunggal" id="edit_tipe_tunggal" onchange="window.toggleTanggalEdit('tunggal')" 
                                            class="w-4 h-4 text-[#8C1007] border-gray-300 focus:ring-[#8C1007]">
                                        <span class="text-xs text-gray-600 font-medium group-hover:text-gray-900 transition-colors">Tanggal Tunggal</span>
                                    </label>
                                    <label class="flex items-center gap-2 cursor-pointer group">
                                        <input type="radio" name="tipe_tanggal" value="rentang" id="edit_tipe_rentang" onchange="window.toggleTanggalEdit('rentang')" 
                                            class="w-4 h-4 text-[#8C1007] border-gray-300 focus:ring-[#8C1007]">
                                        <span class="text-xs text-gray-600 font-medium group-hover:text-gray-900 transition-colors">Rentang Tanggal</span>
                                    </label>
                                </div>
                            </div>

                            <div id="wrapTanggalEdit" class="space-y-1.5">
                                <label id="labelTanggalEdit" class="block text-sm font-semibold text-gray-800">Pilih Tanggal</label>
                                <div class="relative">
                                    <input type="text"
                                           id="edit_tanggal_picker"
                                           class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-[#8C1007] focus:ring-0 text-sm transition-colors pr-10 cursor-pointer"
                                           placeholder="Pilih tanggal"
                                           readonly>
                                    <div class="absolute top-1/2 -translate-y-1/2 right-0 flex items-center pr-3 pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <input type="hidden" name="tanggal" id="edit_final_tanggal">
                                <input type="hidden" name="tanggal_mulai" id="edit_final_tanggal_mulai">
                                <input type="hidden" name="tanggal_akhir" id="edit_final_tanggal_akhir">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-2">
                            <div class="col-span-1 md:col-span-2">
                                <label class="block text-sm font-semibold text-gray-800 mb-2">Status Publikasi</label>
                                <div class="flex items-center gap-6">
                                    <label class="flex items-center gap-2 cursor-pointer">
                                        <input type="radio" name="is_publish" value="0" id="edit_draft" 
                                            class="w-4 h-4 text-[#8C1007] border-gray-300 focus:ring-[#8C1007]">
                                        <span class="text-sm text-gray-700 whitespace-nowrap">Simpan sebagai Draft</span>
                                    </label>
                                    <label class="flex items-center gap-2 cursor-pointer">
                                        <input type="radio" name="is_publish" value="1" id="edit_publish" 
                                            class="w-4 h-4 text-[#8C1007] border-gray-300 focus:ring-[#8C1007]">
                                        <span class="text-sm text-gray-700 whitespace-nowrap">Publikasikan</span>
                                    </label>
                                </div>
                            </div>
                            <div id="section-ganti-file" class="col-span-1 md:col-span-2">
                                <label class="block text-sm font-semibold text-gray-800 mb-2">Ganti File (PDF)</label>
                                
                                <label for="edit_file" class="relative group block cursor-pointer">
                                    <div id="editDropZone" class="border-2 border-dashed border-gray-200 rounded-2xl py-8 px-4 flex flex-col items-center justify-center bg-gray-50/30 group-hover:border-[#8C1007] group-hover:bg-[#FFF3F2]/30 transition-all min-h-[120px] relative overflow-hidden">
                                        
                                        <input type="file" name="file" id="edit_file" accept="application/pdf" onchange="previewPDFEdit(this)"
                                            class="sr-only">
                                        
                                        <div id="editUploadPlaceholder" class="flex flex-col items-center text-center z-10 transition-all duration-300">
                                            <div class="w-10 h-10 bg-white rounded-xl shadow-sm border border-gray-100 flex items-center justify-center mb-3 group-hover:scale-110 transition-transform duration-300">
                                                <svg class="w-6 h-6 text-gray-400 group-hover:text-[#8C1007] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                                </svg>
                                            </div>
                                            <p class="text-[11px] font-medium text-gray-700">Klik atau drag file baru ke sini</p>
                                            <p class="text-[9px] text-gray-400 mt-0.5">PDF (Maks. 50MB)</p>
                                        </div>

                                        <div id="editPreviewContainer" class="hidden w-full h-full absolute inset-0 bg-white z-20 flex items-center justify-center p-4">
                                            <div class="w-full bg-[#FAFAFA] border border-gray-100 rounded-xl p-3 flex items-center justify-between gap-3 shadow-sm">
                                                <div class="flex items-center gap-3 overflow-hidden">
                                                     <div class="w-10 h-10 bg-red-50 text-[#8C1007] rounded-lg flex items-center justify-center shrink-0">
                                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                                            <path d="M12 16H8V14H12V16ZM16 8V16H14V8H16ZM20 2H8C6.9 2 6 2.9 6 4V16C6 17.1 6.9 18 8 18H20C21.1 18 22 17.1 22 16V4C22 2.9 21.1 2 20 2ZM20 16H8V4H20V16ZM4 6H2V20C2 21.1 2.9 22 4 22H18V20H4V6Z"/>
                                                        </svg>
                                                     </div>
                                                     <div class="flex flex-col min-w-0 text-left">
                                                         <span id="editFileName" class="text-[12px] font-semibold text-gray-700 truncate block">document.pdf</span>
                                                         <span id="editFileSize" class="text-[10px] text-gray-400 font-medium tracking-tight">0 KB</span>
                                                     </div>
                                                </div>
                                                <button type="button" onclick="removeFileEdit()" class="w-7 h-7 flex items-center justify-center text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition-all focus:outline-none">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </label>
                                <p class="text-[10px] text-gray-400 mt-2 italic text-center">Biarkan kosong jika tidak ingin mengganti file</p>
                            </div>
                        </div>
                    </div>
                    <div class="p-8 flex flex-col lg:sticky lg:top-0 lg:max-h-screen">
                        <label class="block text-[14px] font-semibold text-gray-400 mb-3 flex items-center gap-2">
                            <svg class="w-4 h-4 text-red-500" fill="currentColor" viewBox="0 0 24 24"><path d="M12 16H8V14H12V16ZM16 8V16H14V8H16ZM20 2H8C6.9 2 6 2.9 6 4V16C6 17.1 6.9 18 8 18H20C21.1 18 22 17.1 22 16V4C22 2.9 21.1 2 20 2ZM20 16H8V4H20V16ZM4 6H2V20C2 21.1 2.9 22 4 22H18V20H4V6Z"/></svg>
                            Preview Panduan
                        </label>
                        <div class="flex-1 bg-white rounded-2xl border border-gray-200 shadow-inner overflow-hidden relative min-h-[500px] lg:min-h-[600px]">
                             <iframe id="preview_pdf" class="absolute inset-0 w-full h-full border-none" src=""></iframe>
                             <div id="pdf_loading" class="absolute inset-0 bg-white flex flex-col items-center justify-center hidden z-10">
                                 <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-[#8C1007] mb-2"></div>
                                 <p class="text-[10px] text-gray-400 italic">Memuat pratinjau...</p>
                             </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div id="modal-footer" class="px-6 py-4 border-t border-gray-100 flex justify-end items-center gap-3 shrink-0 bg-gray-50/50 rounded-b-2xl">
            <button type="button" id="btn-edit-batal" onclick="tutupModal()"
                class="bg-white border border-gray-200 text-gray-700 text-[10px] font-semibold hover:bg-gray-50 transition-colors focus:outline-none"
                style="border-radius: 0.5rem !important; padding: 7px 20px !important; display: inline-block !important;">
                Batal
            </button>
            <button type="submit" id="btn-edit-simpan" form="formEdit"
                class="text-white text-[10px] font-semibold hover:opacity-90 transition-opacity focus:outline-none"
                style="background:#8C1007 !important; border-radius: 0.5rem !important; padding: 7px 20px !important; display: inline-block !important;">
                Simpan Perubahan
            </button>
        </div>
    </div>
</div>
<div id="detailDialog" class="hidden fixed inset-0 z-[100] flex items-center justify-center backdrop-blur-sm bg-black/50 p-4">
    <div class="bg-white rounded-2xl w-full max-w-4xl max-h-[92vh] flex flex-col shadow-2xl relative overflow-hidden fs-style-manrope">
        <div class="p-6 border-b border-gray-100 shrink-0 relative flex items-center gap-4">
            <div id="detailIconBox" class="w-14 h-14 bg-gray-50 border border-gray-100 rounded-xl flex items-center justify-center overflow-hidden shrink-0">
                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
            </div>
            <div class="flex-1">
                <h2 id="d_judul_header" class="text-xl font-semibold text-gray-900 leading-tight">Detail Panduan Ekaristi</h2>
                <p id="d_subtitle_header" class="text-sm text-gray-400 mt-0.5 font-medium">Informasi lengkap panduan perayaan</p>
            </div>
            <button type="button" onclick="closeDetail()" class="p-2 rounded-xl text-gray-400 hover:bg-gray-50 hover:text-red-500 transition-colors focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <div class="overflow-y-auto flex-1 p-8 space-y-8 bg-white">
            <div class="space-y-6">
                <div class="space-y-1.5">
                    <label class="block text-sm font-semibold text-gray-800">Keterangan Perayaan</label>
                    <p id="d_ket_perayaan" class="text-sm font-normal text-gray-700 leading-relaxed">---</p>
                </div>
                <div class="space-y-1.5">
                    <label class="block text-sm font-semibold text-gray-800">Ayat Alkitab</label>
                    <p id="d_ayat_alkitab" class="text-sm font-normal text-gray-700 italic leading-relaxed">---</p>
                </div>
                <div class="space-y-1.5">
                    <label class="block text-sm font-semibold text-gray-800">Sumber Ayat</label>
                    <p id="d_sumber_ayat" class="text-sm font-medium text-gray-700">---</p>
                </div>
                <div class="space-y-1.5">
                    <label class="block text-sm font-semibold text-gray-800">Tanggal Perayaan</label>
                    <p id="d_tanggal" class="text-sm font-medium text-gray-700">---</p>
                </div>
                <div class="space-y-1.5">
                    <label class="block text-sm font-semibold text-gray-800">Status</label>
                    <div>
                        <div id="d_status_badge" class="inline-flex px-3 py-1 rounded-full text-[11px] font-medium border">---</div>
                    </div>
                </div>
            </div>
            <div class="space-y-4 pt-4 border-t border-gray-100">
                <label class="block text-sm font-semibold text-gray-800 flex items-center gap-2">
                    <svg class="w-4 h-4 text-[#8C1007]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    Pratinjau Panduan
                </label>
                <div class="bg-gray-50 rounded-2xl border border-gray-200 shadow-sm overflow-hidden h-[500px]">
                    <iframe id="d_preview_pdf" class="w-full h-full border-none" src=""></iframe>
                </div>
                <p class="text-[10px] text-gray-400 italic text-center">Gunakan kontrol di dalam preview untuk zoom atau unduh.</p>
            </div>
        </div>
    </div>
</div>


