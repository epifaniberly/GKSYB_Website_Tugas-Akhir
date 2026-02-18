<div id="modalTerhubung" class="fixed inset-0 z-50 hidden items-center justify-center p-4">
    <div class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm" onclick="tutupTerhubung()"></div>
    <div class="bg-white w-full max-w-3xl rounded-2xl shadow-2xl relative overflow-hidden animate-in fade-in zoom-in duration-200">
        <div class="px-6 py-4 flex items-center justify-between bg-gray-50/50 border-b border-gray-100">
            <div>
                <h3 class="text-lg font-semibold text-gray-800">Detail Pesan</h3>
                <p class="text-xs text-gray-400 mt-0.5">Informasi lengkap pesan yang diterima</p>
            </div>
            <button onclick="tutupTerhubung()" class="p-1 rounded-md hover:bg-gray-100 text-gray-400 hover:text-gray-600 transition-colors focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div class="p-6 space-y-6 max-h-[80vh] overflow-y-auto custom-scrollbar">
            <div>
                <label class="block text-sm font-semibold text-gray-800 mb-1.5">Nama Pengirim</label>
                <p id="d_nama" class="text-[13px] font-medium text-gray-800"></p>
            </div>
            <div class="grid grid-cols-2 gap-y-6 gap-x-8">
                <div>
                    <label class="block text-sm font-semibold text-gray-800 mb-1.5">Email</label>
                    <p id="d_email" class="text-[13px] text-gray-600 truncate"></p>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-800 mb-1.5">No. Kontak</label>
                    <p id="d_telp" class="text-[13px] text-gray-600"></p>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-800 mb-1.5">Asal Paroki</label>
                    <p id="d_paroki" class="text-[13px] text-gray-600"></p>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-800 mb-1.5">Asal Lingkungan</label>
                    <p id="d_lingkungan" class="text-[13px] text-gray-600"></p>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-800 mb-1.5">Tanggal Kirim</label>
                    <p id="d_tgl" class="text-[13px] text-gray-500"></p>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-800 mb-1.5">Status</label>
                    <div id="d_status_badge" class="mt-1"></div>
                </div>
            </div>
            <div class="pt-2">
                <label class="block text-sm font-semibold text-gray-800 mb-1.5">Isi Pesan</label>
                <div class="bg-gray-50 rounded-xl p-4 text-gray-700 text-[13px] leading-relaxed border border-gray-100">
                    <p id="d_pesan" class="italic"></p>
                </div>
            </div>
        </div>
    </div>
</div>





