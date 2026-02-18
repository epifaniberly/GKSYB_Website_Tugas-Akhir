<style>
    #modalEdit button:focus, 
    #modalEdit button:active {
        outline: none !important;
        box-shadow: none !important;
        ring: 0 !important;
        -webkit-tap-highlight-color: transparent;
    }
</style>

<div id="modalEdit" class="hidden fixed inset-0 bg-black/40 backdrop-blur-sm z-50 flex items-center justify-center p-4 fs-style-manrope">
    <div class="bg-white w-full max-w-3xl rounded-2xl shadow-2xl overflow-hidden flex flex-col max-h-[90vh] animate-in fade-in zoom-in duration-200">
        <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50/50 shrink-0">
            <div>
                <h3 class="text-lg font-semibold text-gray-800">Edit FAQ</h3>
                <p class="text-xs text-gray-400 mt-0.5">Ubah pertanyaan dan jawaban</p>
            </div>
        </div>
        <div class="p-6 overflow-y-auto flex-1">
            <form id="formEditFaq" method="POST" novalidate>
                @csrf
                @method('PATCH')

                <input type="hidden" id="edit_id" name="id">

                <div class="space-y-5">
                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <label for="edit_pertanyaan" class="block text-sm font-semibold text-gray-800">Pertanyaan <span class="text-red-500">*</span></label>
                            <span id="editPertanyaanCounter" class="text-xs text-gray-400 font-medium">0/200</span>
                        </div>
                        <input type="text" name="pertanyaan" id="edit_pertanyaan" required maxlength="200"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-[#8C1007] focus:ring-1 focus:ring-[#8C1007] text-sm transition-colors outline-none"
                            placeholder="Masukkan pertanyaan..."
                            oninput="updateCharCount('edit_pertanyaan', 'editPertanyaanCounter', 200)">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-800 mb-1.5">Jawaban <span class="text-red-500">*</span></label>
                        <textarea name="jawaban" id="edit_jawaban" rows="6"
                            class="w-full bg-gray-50 border border-gray-200 text-gray-900 text-[13px] rounded-lg focus:ring-[#8C1007] focus:border-[#8C1007] block p-3 transition-colors resize-none font-medium"
                            placeholder="Masukkan jawaban..." required></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-800 mb-1.5">Kategori <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <select name="kategori_faq_id" id="edit_kategori_faq_id" 
                                class="w-full bg-gray-50 border border-gray-200 text-gray-900 text-[13px] rounded-lg focus:ring-[#8C1007] focus:border-[#8C1007] block p-3 transition-colors font-medium appearance-none"
                                style="background-image: url('data:image/svg+xml;charset=UTF-8,%3csvg xmlns=\'http://www.w3.org/2000/svg\' fill=\'none\' stroke=\'%236b7280\' stroke-width=\'2\' stroke-linecap=\'round\' stroke-linejoin=\'round\' class=\'feather feather-chevron-down\' viewBox=\'0 0 24 24\'%3e%3cpolyline points=\'6 9 12 15 18 9\'%3e%3c/polyline%3e%3c/svg%3e'); background-repeat: no-repeat; background-position: right 0.75rem center; background-size: 1.25em;" required>
                                <option value="" disabled selected hidden>-- Pilih Kategori --</option>
                                @foreach($kategori as $k)
                                    <option value="{{ $k->id }}">{{ $k->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-800 mb-3">Status FAQ <span class="text-red-500">*</span></label>
                        <div class="flex items-center gap-6">
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="is_active" id="edit_status_aktif" value="1" class="w-4 h-4 text-[#8C1007] focus:ring-[#8C1007] border-gray-300">
                                <span class="text-sm text-gray-700 whitespace-nowrap">Aktif</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="is_active" id="edit_status_nonaktif" value="0" class="w-4 h-4 text-[#8C1007] focus:ring-[#8C1007] border-gray-300">
                                <span class="text-sm text-gray-700 whitespace-nowrap">Nonaktif</span>
                            </label>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="px-6 py-4 border-t border-gray-100 flex justify-end gap-3 shrink-0 bg-gray-50/50 rounded-b-2xl">
            <button type="button" onclick="tutupModal()" 
                class="bg-white border border-gray-200 text-gray-700 text-[10px] font-semibold hover:bg-gray-50 transition-colors focus:outline-none"
                style="border-radius: 0.5rem !important; padding: 7px 20px !important; display: inline-block !important;">
                Batal
            </button>
            <button type="button" onclick="submitFaqEdit()"
                class="text-white text-[10px] font-semibold hover:opacity-90 transition-opacity focus:outline-none"
                style="background:#8C1007 !important; border-radius: 0.5rem !important; padding: 7px 20px !important; display: inline-block !important;">
                Simpan Perubahan
            </button>
        </div>
    </div>
</div>






