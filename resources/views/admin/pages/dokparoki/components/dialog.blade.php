<div id="modalEdit" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-[100] backdrop-blur-sm fs-style-manrope p-4">
    <style>
        .docx-container .docx-wrapper {
            background-color: transparent !important;
            padding: 0 !important;
        }
        .docx-container .docx {
            box-shadow: none !important;
            margin-bottom: 0 !important;
            transform: scale(0.75);
            transform-origin: top center;
            width: 133% !important; /* 1 / 0.75 = 1.33 */
            margin-left: -16.5% !important;
        }
    </style>
    <div class="bg-white rounded-2xl w-full max-w-5xl max-h-[95vh] flex flex-col shadow-2xl overflow-hidden animate-in fade-in zoom-in duration-200">
        <div class="px-6 py-4 border-b border-gray-100 shrink-0 bg-gray-50/50">
            <div>
                <h3 id="modalEditTitle" class="text-lg font-semibold text-gray-800">Edit Dokumen</h3>
                <p id="modalEditDesc" class="text-[11px] text-gray-400 mt-0.5">Ubah informasi atau ganti file dokumen paroki</p>
            </div>
        </div>
        <div class="overflow-y-auto flex-1 p-0">
            <form id="formEdit" method="POST" enctype="multipart/form-data" novalidate>
                @csrf
                @method('PATCH')
                <input type="hidden" name="id" id="edit_id">

                <div class="grid grid-cols-1 lg:grid-cols-2 bg-gray-50/50">
                    <div class="p-6 space-y-4 border-r border-gray-100 bg-white">
                        <div id="e_judul_container" class="space-y-1.5">
                            <label class="block text-sm font-semibold text-gray-800 mb-1.5">Judul Dokumen <span class="text-red-500">*</span></label>
                            <input type="text" name="judul_dokumen" id="edit_judul_dokumen"
                                class="w-full h-[44px] px-4 rounded-xl border border-gray-200 focus:border-[#8C1007] focus:ring-1 focus:ring-[#8C1007] text-[13px] transition-all bg-gray-50/50" required>
                        </div>

                        <div id="e_kategori_container" class="space-y-1.5">
                            <label class="block text-sm font-semibold text-gray-800 mb-1.5">Kategori <span class="text-red-500">*</span></label>
                            <select name="kategori_id" id="edit_kategori"
                                class="w-full h-[44px] px-4 rounded-xl border border-gray-200 focus:border-[#8C1007] focus:ring-1 focus:ring-[#8C1007] text-[13px] transition-all appearance-none bg-gray-50/50"
                                style="background-image: url('data:image/svg+xml;charset=UTF-8,%3csvg xmlns=\'http://www.w3.org/2000/svg\' fill=\'none\' stroke=\'%236b7280\' stroke-width=\'2\' stroke-linecap=\'round\' stroke-linejoin=\'round\' class=\'feather feather-chevron-down\' viewBox=\'0 0 24 24\'%3e%3cpolyline points=\'6 9 12 15 18 9\'%3e%3c/polyline%3e%3c/svg%3e'); background-repeat: no-repeat; background-position: right 1rem center; background-size: 1.2em;" required>
                                <option value="" disabled selected hidden>Pilih Kategori</option>
                                @foreach($kategori as $k)
                                    <option value="{{ $k->id }}">{{ $k->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div id="e_keterangan_container" class="space-y-1.5">
                            <div class="flex justify-between items-center mb-1.5">
                                <label class="text-sm font-semibold text-gray-800">Keterangan <span class="text-red-500">*</span></label>
                                <span id="edit-word-count" class="text-[10px] text-gray-400 font-medium">0/20 kata</span>
                            </div>
                            <textarea name="keterangan" id="edit_keterangan" rows="4"
                                class="w-full p-4 rounded-xl border border-gray-200 focus:border-[#8C1007] focus:ring-1 focus:ring-[#8C1007] text-[13px] transition-all resize-none bg-gray-50/50" placeholder="Masukkan keterangan dokumen..." required></textarea>
                             <p id="edit-word-count-error" class="text-red-500 text-[10px] font-semibold mt-1 hidden">Keterangan melebihi 20 kata!</p>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-800 mb-3">Status Publikasi</label>
                            <div class="flex items-center gap-6">
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="radio" name="is_active" id="edit_active_0" value="0" class="w-4 h-4 text-[#8C1007] focus:ring-[#8C1007] border-gray-300">
                                    <span class="text-sm text-gray-700 whitespace-nowrap">Simpan sebagai Draft</span>
                                </label>
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="radio" name="is_active" id="edit_active_1" value="1" class="w-4 h-4 text-[#8C1007] focus:ring-[#8C1007] border-gray-300">
                                    <span class="text-sm text-gray-700 whitespace-nowrap">Publikasikan</span>
                                </label>
                            </div>
                        </div>

                        <div id="section-ganti-file" class="pt-2">
                            <label class="block text-sm font-semibold text-gray-800 mb-2">Ganti File (PDF/Word)</label>
                            
                            <label for="edit_file" class="relative group block cursor-pointer">
                                <div id="editDropZone" class="border-2 border-dashed border-gray-200 rounded-2xl py-8 px-4 flex flex-col items-center justify-center bg-gray-50/30 group-hover:border-[#8C1007] group-hover:bg-[#FFF3F2]/30 transition-all min-h-[120px] relative overflow-hidden">
                                    
                                    <input type="file" name="file" id="edit_file" accept=".pdf,.doc,.docx,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document" onchange="previewPDFEdit(this)"
                                        class="sr-only">
                                    
                                    <div id="editUploadPlaceholder" class="flex flex-col items-center text-center z-10 transition-all duration-300">
                                        <div class="w-10 h-10 bg-white rounded-xl shadow-sm border border-gray-100 flex items-center justify-center mb-3 group-hover:scale-110 transition-transform duration-300">
                                            <svg class="w-6 h-6 text-gray-400 group-hover:text-[#8C1007] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                        <p class="text-[11px] font-medium text-gray-700">Klik atau drag file baru ke sini</p>
                                        <p class="text-[9px] text-gray-400 mt-0.5">PDF atau Word (Maks. 50MB)</p>
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
                    <div class="p-6 flex flex-col lg:h-full">
                        <label class="block text-[14px] font-semibold text-gray-400 mb-3 flex items-center gap-2">
                            <svg class="w-3 h-3 text-red-500" fill="currentColor" viewBox="0 0 24 24"><path d="M12 16H8V14H12V16ZM16 8V16H14V8H16ZM20 2H8C6.9 2 6 2.9 6 4V16C6 17.1 6.9 18 8 18H20C21.1 18 22 17.1 22 16V4C22 2.9 21.1 2 20 2ZM20 16H8V4H20V16ZM4 6H2V20C2 21.1 2.9 22 4 22H18V20H4V6Z"/></svg>
                            Preview Dokumen
                        </label>
                        <div class="bg-white rounded-2xl border border-gray-200 shadow-inner overflow-hidden relative h-[540px] flex flex-col">
                             <iframe id="preview_pdf" class="w-full h-full border-none hidden" src=""></iframe>
                             <div id="preview_docx" class="w-full h-full overflow-y-auto p-4 bg-gray-50 hidden docx-container"></div>
                             
                             <div id="preview_placeholder" class="absolute inset-0 bg-gray-50 flex flex-col items-center justify-center text-gray-400">
                                 <svg class="w-12 h-12 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                 </svg>
                                 <p class="text-xs italic">Pilih file untuk melihat pratinjau</p>
                             </div>

                             <div id="pdf_loading" class="absolute inset-0 bg-white/80 flex flex-col items-center justify-center hidden z-30">
                                 <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-[#8C1007] mb-2"></div>
                                 <p class="text-xs text-gray-500 italic">Memuat pratinjau...</p>
                             </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div id="modal-footer" class="px-6 py-4 border-t border-gray-100 flex justify-end items-center gap-3 bg-gray-50/50 shrink-0 rounded-b-2xl">
            <button type="button" onclick="tutupModal()"
                class="bg-white border border-gray-200 text-gray-700 text-[10px] font-semibold hover:bg-gray-50 transition-colors focus:outline-none"
                style="border-radius: 0.5rem !important; padding: 7px 20px !important; display: inline-block !important;">
                Batal
            </button>
            <button type="button" id="btn-edit-simpan" onclick="submitEditForm()"
                class="text-white text-[10px] font-semibold hover:opacity-90 transition-opacity focus:outline-none"
                style="background:#8C1007 !important; border-radius: 0.5rem !important; padding: 7px 20px !important; display: inline-block !important;">
                Simpan Perubahan
            </button>
        </div>
    </div>
</div>

<div id="detailDialog" class="hidden fixed inset-0 z-[100] flex items-center justify-center backdrop-blur-sm bg-black/50 p-4">
    <div class="bg-white rounded-2xl w-full max-w-5xl max-h-[92vh] flex flex-col shadow-2xl relative overflow-hidden fs-style-manrope">
        <div class="p-6 border-b border-gray-100 shrink-0 relative flex items-center gap-4">
            <div id="detailIconBox" class="w-14 h-14 bg-gray-50 border border-gray-100 rounded-xl flex items-center justify-center overflow-hidden shrink-0">
                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
            </div>
            <div class="flex-1">
                <h2 id="d_judul_header" class="text-xl font-semibold text-gray-900 leading-tight">Detail Dokumen</h2>
                <p id="d_kategori_header" class="text-sm text-gray-400 mt-0.5 font-medium">Informasi lengkap dokumen paroki</p>
            </div>
            <button type="button" onclick="closeDetail()" class="p-2 rounded-xl text-gray-400 hover:bg-gray-50 hover:text-red-500 transition-colors focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <div class="overflow-y-auto flex-1 p-8 space-y-8 bg-white">
            <div class="space-y-6">
                <div class="space-y-1.5">
                    <label class="block text-sm font-semibold text-gray-800">Kategori</label>
                    <p id="d_kategori_text" class="text-sm font-medium text-gray-700">---</p>
                </div>

                <div class="space-y-1.5">
                    <label class="block text-sm font-semibold text-gray-800">Status</label>
                    <div>
                        <div id="d_status_badge" class="inline-flex px-3 py-1 rounded-full text-[11px] font-medium border">---</div>
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-gray-800">Keterangan / Deskripsi</label>
                    <p id="d_keterangan" class="text-gray-700 text-base font-normal">---</p>
                </div>

                <div class="space-y-4 pt-4 border-t border-gray-100">
                    <label class="block text-sm font-semibold text-gray-800 flex items-center gap-2">
                        <svg class="w-4 h-4 text-[#8C1007]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                        Pratinjau Dokumen
                    </label>
                    <div class="bg-gray-50 rounded-2xl border border-gray-200 shadow-sm overflow-hidden h-[500px] relative flex flex-col">
                        <iframe id="d_preview_pdf" class="w-full h-full border-none hidden" src=""></iframe>
                        <div id="d_preview_docx" class="w-full h-full overflow-y-auto p-4 bg-white hidden docx-container"></div>
                        
                        <div id="d_preview_placeholder" class="w-full h-full flex flex-col items-center justify-center text-gray-400 bg-gray-50 hidden">
                             <svg class="w-12 h-12 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                             </svg>
                             <p class="text-xs italic">Pratinjau tidak tersedia untuk format file ini</p>
                        </div>
                    </div>
                    <p class="text-[10px] text-gray-400 italic text-center">Gunakan kontrol di dalam preview untuk zoom atau unduh.</p>
                </div>
            </div>
        </div>
    </div>
</div>






