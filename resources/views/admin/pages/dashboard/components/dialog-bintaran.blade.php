<div id="modalBintaran" class="hidden fixed inset-0 z-[9999] bg-black/40 flex items-center justify-center p-4 backdrop-blur-sm fs-style-manrope">
    <div class="bg-white rounded-2xl w-full max-w-3xl max-h-[90vh] flex flex-col shadow-2xl overflow-hidden animate-in fade-in zoom-in duration-200">
        <div class="p-6 border-b border-gray-100 shrink-0 relative flex items-center gap-4 bg-white">
            <div class="w-14 h-14 bg-gray-50 border border-gray-100 rounded-xl flex items-center justify-center overflow-hidden shrink-0">
                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l4 4v10a2 2 0 01-2 2z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14 2v6h6"></path>
                </svg>
            </div>
            <div class="flex-1">
                <h2 id="d_judul_header" class="text-base md:text-xl font-semibold text-gray-900 leading-tight">Detail Tulisan</h2>
                <p class="text-sm text-gray-400 mt-0.5 font-medium">Pratinjau konten tulisan bintaran</p>
            </div>
            <button onclick="tutupBintaran()" class="p-2 rounded-xl text-gray-400 hover:bg-gray-50 hover:text-red-500 transition-colors focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <div class="overflow-y-auto p-8 space-y-8 flex-1 custom-scrollbar">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-gray-800">Kategori</label>
                    <div id="d_kategori_badge" class="inline-flex px-3 py-1 bg-blue-50 text-blue-600 rounded-lg text-xs font-semibold">---</div>
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-gray-800">Status</label>
                    <div id="d_status_bintaran" class="inline-flex px-3 py-1 rounded-lg text-xs font-semibold">---</div>
                </div>
            </div>
            <div class="space-y-2">
                <label class="block text-sm font-semibold text-gray-800">Ringkasan</label>
                <div class="bg-gray-50 rounded-xl p-4 border border-gray-100">
                    <p id="d_ringkasan" class="text-gray-600 leading-relaxed whitespace-pre-line font-light text-sm italic">---</p>
                </div>
            </div>
            <div class="space-y-2">
                <label class="block text-sm font-semibold text-gray-800">Konten</label>
                <div id="d_konten" class="text-gray-600 leading-relaxed whitespace-pre-line font-light text-sm prose prose-sm max-w-none">---</div>
            </div>
            <div class="space-y-4 pt-4 border-t border-gray-100">
                <label class="block text-sm font-semibold text-gray-800">Galeri Gambar</label>
                <div id="d_gallery" class="grid grid-cols-2 md:grid-cols-3 gap-3 mt-4">
                </div>
                <div id="d_gallery_empty" class="hidden border-2 border-dashed border-gray-100 rounded-2xl p-10 flex flex-col items-center justify-center bg-gray-50/50">
                    <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center shadow-sm mb-3">
                        <svg class="w-6 h-6 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <p class="text-xs text-gray-400 font-semibold">Belum ada gambar</p>
                </div>
            </div>
        </div>
    </div>
</div>





