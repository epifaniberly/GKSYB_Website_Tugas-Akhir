<div id="modalDetail" class="fixed inset-0 z-50 hidden items-center justify-center p-4">
    <div class="fixed inset-0 bg-black/40 backdrop-blur-sm" onclick="hideDetail()"></div>
    <div class="bg-white w-full max-w-4xl rounded-2xl shadow-2xl relative overflow-hidden animate-in fade-in zoom-in duration-200">
        <div class="px-6 py-4 flex items-center justify-between bg-gray-50/50 border-b border-gray-100">
            <div>
                <h3 class="text-lg font-semibold text-gray-800">Detail Pesan</h3>
                <p class="text-xs text-gray-400 mt-0.5">Informasi lengkap pesan yang diterima</p>
            </div>
            <button onclick="hideDetail()" class="p-1 rounded-md hover:bg-gray-100 text-gray-400 hover:text-gray-600 transition-colors focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div class="p-6 space-y-6">
            <div>
                <label class="block text-sm font-semibold text-gray-800 mb-1.5">Nama Pengirim</label>
                <p id="d_nama" class="text-[12px] sm:text-[13px] font-semibold text-gray-800"></p>
            </div>
            <div class="grid grid-cols-2 gap-y-4 gap-x-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-800 mb-1.5">Email</label>
                    <p id="d_email" class="text-[12px] sm:text-[13px] text-gray-600 truncate"></p>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-800 mb-1.5">No. Kontak</label>
                    <p id="d_telp" class="text-[12px] sm:text-[13px] text-gray-600"></p>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-800 mb-1.5">Asal Paroki</label>
                    <p id="d_paroki" class="text-[12px] sm:text-[13px] text-gray-600"></p>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-800 mb-1.5">Asal Lingkungan</label>
                    <p id="d_lingkungan" class="text-[12px] sm:text-[13px] text-gray-600"></p>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-800 mb-1.5">Tanggal Kirim</label>
                    <p id="d_tgl" class="text-[11px] sm:text-[12px] text-gray-500"></p>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-800 mb-1.5">Status</label>
                    <div id="d_status_badge" class="text-[11px] sm:text-[12px]" ></div>
                </div>
            </div>
            <div class="pt-2">
                <label class="block text-sm font-semibold text-gray-800 mb-1.5">Isi Pesan</label>
                <div class="bg-gray-50 rounded-xl p-3.5 text-gray-700 text-[12px] sm:text-[13px] leading-relaxed border border-gray-100">
                    <p id="d_pesan" class="italic"></p>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="modalEdit" class="fixed inset-0 z-50 hidden items-center justify-center p-4">
    <div class="fixed inset-0 bg-black/40 backdrop-blur-sm" onclick="hideEdit()"></div>
    <div class="bg-white w-full max-w-md rounded-2xl shadow-2xl relative overflow-hidden animate-in fade-in zoom-in duration-200">
        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50">
            <h3 class="text-lg font-semibold text-gray-800">Update Status</h3>
            <p class="text-[11px] text-gray-500 mt-0.5">Sesuaikan status tindak lanjut pesan</p>
        </div>

        <form id="formStatus" method="POST" class="p-0 m-0">
            @csrf
            @method('PATCH')

            <div class="p-6">
                <label class="block text-sm font-semibold text-gray-800 mb-2">Status Saat Ini <span class="text-red-500">*</span></label>
                <div class="relative">
                    <select name="status" id="e_status"
                        class="w-full bg-white border border-gray-200 rounded-xl px-4 py-3 text-[13px] font-medium focus:outline-none focus:ring-2 focus:ring-[#8C1007]/5 focus:border-[#8C1007] transition-all appearance-none cursor-pointer">
                        <option value="baru">Baru</option>
                        <option value="diterima">Dibaca</option>
                        <option value="gagal">Ditindaklanjuti</option>
                    </select>
                    <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" /></svg>
                    </div>
                </div>
            </div>
            <div class="px-6 py-4 bg-gray-50/50 flex items-center justify-end gap-3 border-t border-gray-100 rounded-b-2xl">
                <button type="button" onclick="hideEdit()" 
                    class="bg-white border border-gray-200 text-gray-700 text-[12px] font-medium hover:bg-gray-50 transition-colors focus:outline-none"
                    style="border-radius: 0.5rem !important; padding: 7px 20px !important; display: inline-block !important;">
                    Batal
                </button>
                <button type="button" onclick="submitStatus()"
                    class="text-white text-[10px] font-semibold hover:opacity-90 transition-opacity focus:outline-none"
                    style="background:#8C1007 !important; border-radius: 0.5rem !important; padding: 7px 20px !important; display: inline-block !important;">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>





