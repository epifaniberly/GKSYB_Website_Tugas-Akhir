<div id="detailDialog" class="hidden fixed inset-0 z-50 flex items-center justify-center backdrop-blur-sm bg-black/50 p-4">
    <div class="bg-white rounded-2xl w-full max-w-2xl max-h-[92vh] flex flex-col shadow-2xl relative overflow-hidden fs-style-manrope">
        <div class="p-6 border-b border-gray-100 shrink-0 relative flex items-center gap-4">
            <div id="detailIconBox" class="w-14 h-14 bg-gray-50 border border-gray-100 rounded-xl flex items-center justify-center overflow-hidden shrink-0">
                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l4 4v10a2 2 0 01-2 2z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14 2v6h6"></path>
                </svg>
            </div>
            <div class="flex-1">
                <h2 id="d_judul_header" class="text-base md:text-xl font-semibold text-gray-900 leading-tight">Detail Tulisan</h2>
                <p id="d_kategori_header" class="text-sm text-gray-400 mt-0.5 font-medium">Informasi lengkap tulisan</p>
            </div>
            <button type="button" onclick="closeDetail()" class="p-2 rounded-xl text-gray-400 hover:bg-gray-50 hover:text-red-500 transition-colors focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <div class="overflow-y-auto p-8 space-y-8 flex-1">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-gray-800">Kategori</label>
                    <div id="d_kategori_badge" class="inline-flex px-3 py-1 bg-blue-50 text-blue-600 rounded-full text-xs font-semibold">---</div>
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-gray-800">Status</label>
                    <div id="d_status_badge" class="inline-flex px-3 py-1 rounded-full text-xs font-semibold">---</div>
                </div>
            </div>
            <div class="space-y-2">
                <label class="block text-sm font-semibold text-gray-800">Ringkasan</label>
                <p id="d_ringkasan" class="text-gray-600 leading-relaxed whitespace-pre-line font-light text-sm">---</p>
            </div>
            <div class="space-y-2">
                <label class="block text-sm font-semibold text-gray-800">Konten</label>
                <div id="d_konten" class="text-gray-600 leading-relaxed whitespace-pre-line font-light text-sm prose prose-sm max-w-none">---</div>
            </div>
            <div class="space-y-4 pt-2 border-t border-gray-100">
                <label class="block text-sm font-semibold text-gray-800">Galeri Gambar</label>
                <div id="d_gallery" class="grid grid-cols-2 md:grid-cols-3 gap-3 mt-4">
                </div>
                <div id="d_gallery_empty" class="hidden border-2 border-dashed border-gray-100 rounded-2xl p-10 flex flex-col items-center justify-center bg-gray-50/50">
                    <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center shadow-sm mb-3">
                        <svg class="w-6 h-6 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <p class="text-xs text-gray-400 font-semibold">Belum ada gambar untuk tulisan ini</p>
                </div>
            </div>
        </div>
    </div>
</div>

    <style>
        .mandatory-star { color: #ef4444 !important; font-weight: 700 !important; margin-left: 1px; }
    </style>

    <div id="editDialog" class="hidden fixed inset-0 bg-black/40 flex items-center justify-center z-50 backdrop-blur-sm fs-style-manrope p-4">
        <div class="bg-white rounded-2xl w-full max-w-3xl max-h-[90vh] flex flex-col shadow-2xl overflow-hidden animate-in fade-in zoom-in duration-200">
            <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50 shrink-0">
                <h3 class="text-lg font-semibold text-gray-800">Edit Tulisan</h3>
                <p class="text-xs text-gray-400 mt-0.5">Ubah informasi tulisan bintaran</p>
            </div>
            <div class="overflow-y-auto p-6 flex-1">
                <form method="POST" id="formEdit" enctype="multipart/form-data" novalidate>
                    @csrf
                    @method('PATCH')

                    <div class="space-y-6">
                        <div id="e_judul_container" class="space-y-1.5">
                            <label class="block text-sm font-semibold text-gray-800">Judul Tulisan <span class="mandatory-star">*</span></label>
                            <input type="text" name="judul_tulisan" id="e_judul" 
                                class="w-full px-5 py-3 bg-[#FAFAFA] border border-gray-200 rounded-2xl focus:bg-white focus:border-gray-300 focus:ring-0 text-sm font-medium transition-all outline-none placeholder:text-gray-400 text-gray-800" placeholder="Judul tulisan berita/blog..." required>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div id="e_kategori_container" class="space-y-1.5">
                                <label class="block text-sm font-semibold text-gray-800">Kategori <span class="mandatory-star">*</span></label>
                                <select name="kategori_bintaran_id" id="e_kategori" 
                                    class="w-full px-5 py-3 bg-[#FAFAFA] border border-gray-200 rounded-2xl focus:bg-white focus:border-gray-300 focus:ring-0 text-sm font-medium transition-all outline-none text-gray-800 appearance-none cursor-pointer" required>
                                    <option value="" disabled selected hidden>Pilih Kategori</option>
                                    @foreach($kategori as $k)
                                        <option value="{{ $k->id }}">{{ $k->nama_kategori }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div id="e_status_container" class="space-y-1.5">
                                <label class="block text-sm font-semibold text-gray-800 mb-1.5">Status Publikasi</label>
                                <div class="flex items-center gap-6 h-[46px]">
                                    <label class="flex items-center gap-2 cursor-pointer">
                                        <input type="radio" name="is_published" id="e_status_draft" value="0" class="w-4 h-4 text-[#8C1007] focus:ring-[#8C1007] border-gray-300">
                                        <span class="text-sm text-gray-700 whitespace-nowrap">Draft</span>
                                    </label>
                                    <label class="flex items-center gap-2 cursor-pointer">
                                        <input type="radio" name="is_published" id="e_status_published" value="1" class="w-4 h-4 text-[#8C1007] focus:ring-[#8C1007] border-gray-300">
                                        <span class="text-sm text-gray-700 whitespace-nowrap">Publikasikan</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div id="e_ringkasan_container" class="space-y-1.5">
                            <label class="block text-sm font-semibold text-gray-800">Ringkasan <span class="mandatory-star">*</span></label>
                            <textarea name="ringkasan" id="e_ringkasan" rows="3" 
                                class="w-full px-5 py-3 bg-[#FAFAFA] border border-gray-200 rounded-2xl focus:bg-white focus:border-gray-300 focus:ring-0 text-sm font-medium transition-all outline-none resize-none placeholder:text-gray-400 text-gray-800 leading-relaxed" 
                                placeholder="Masukkan ringkasan singkat..." required></textarea>
                            <p class="text-[10px] text-gray-400 mt-1">*Minimal 50 karakter, Maksimal 255 karakter</p>
                        </div>
                        <div id="e_konten_container" class="space-y-1.5">
                            <label class="block text-sm font-semibold text-gray-800">Konten Lengkap <span class="mandatory-star">*</span></label>
                            <textarea name="konten" id="e_konten" rows="8" 
                                class="w-full px-5 py-3 bg-[#FAFAFA] border border-gray-200 rounded-2xl focus:bg-white focus:border-gray-300 focus:ring-0 text-sm font-medium transition-all outline-none resize-none placeholder:text-gray-400 text-gray-800 leading-relaxed" 
                                placeholder="Masukkan seluruh isi konten tulisan di sini..." required></textarea>
                            <p class="text-[10px] text-gray-400 mt-1">*Minimal 300 karakter</p>
                        </div>
                    <div class="pt-2">
                        <div class="flex justify-between items-end mb-3">
                            <div>
                                <label class="block text-sm font-semibold text-gray-800">Galeri Tambahan</label>
                                <p class="text-gray-400 text-[10px] font-semibold mt-1">Maksimal 5 gambar tambahan</p>
                            </div>  
                            <button type="button" onclick="addBintaranGalleryItem()" id="btn_add_gallery"
                                class="text-white text-[9px] font-medium hover:opacity-90 transition-opacity focus:outline-none flex items-center gap-1.5 whitespace-nowrap shrink-0"
                                style="background:#8C1007 !important; border-radius: 0.5rem !important; padding: 6px 14px !important; display: inline-flex !important;">
                                <span>+ Tambah Gambar</span>
                                <span id="galleryCounterText" class="opacity-90 font-medium">( 0/5 )</span>
                            </button>
                        </div>
                        <div id="e_gallery_wrapper" class="space-y-3">
                            <div id="e_gallery_empty" class="border border-dashed border-gray-300 rounded-[1.5rem] bg-gray-50/50 p-6 flex flex-col items-center justify-center text-center">
                                <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-sm mb-2 border border-gray-100">
                                    <svg class="w-5 h-5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                                <p class="text-xs text-gray-500 font-medium">Belum ada foto galeri.</p>
                            </div>
                            <div id="e_gallery_container" class="grid grid-cols-1 gap-3 w-full min-h-[50px] border border-dashed border-gray-100 rounded-2xl p-2">
                            </div>
                        </div>
                        <p id="slide-error" class="hidden text-red-600 text-[10px] mt-1.5 flex items-center gap-1.5 font-medium">
                            <svg class="w-3 h-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            <span id="slide-error-text">Minimal 1 gambar galeri harus ditambahkan</span>
                        </p>
                    </div>
                </div>
            </form>
        </div>
        <div class="px-6 py-4 border-t border-gray-100 flex justify-end gap-3 shrink-0 bg-gray-50/50 rounded-b-2xl">
            <button type="button" onclick="closeEdit()" class="bg-white border border-gray-200 text-gray-700 text-[10px] font-semibold hover:bg-gray-50 transition-colors focus:outline-none" style="border-radius: 0.5rem !important; padding: 7px 20px !important; display: inline-block !important;">
                Batal
            </button>
            <button type="submit" form="formEdit" class="text-white text-[10px] font-semibold hover:opacity-90 transition-opacity focus:outline-none" style="background:#8C1007 !important; border-radius: 0.5rem !important; padding: 7px 20px !important; display: inline-block !important;">
                Simpan Perubahan
            </button>
        </div>
    </div>
</div>





