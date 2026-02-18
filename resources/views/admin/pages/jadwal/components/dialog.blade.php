
<div id="modalEdit" class="hidden fixed inset-0 bg-black/40 backdrop-blur-sm z-50 flex items-center justify-center p-4 fs-style-manrope">
    <div class="bg-white w-full max-w-3xl rounded-2xl shadow-2xl overflow-hidden flex flex-col max-h-[90vh] animate-in fade-in zoom-in duration-200">
        <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50/50 shrink-0">
            <div>
                <h3 class="text-lg font-semibold text-gray-800">Edit Jadwal</h3>
                <p class="text-xs text-gray-400 mt-0.5">Ubah informasi jadwal doa dan perayaan</p>
            </div>
        </div>
        <div class="p-6 overflow-y-auto flex-1">
            <form id="formEdit" method="POST" novalidate>
                @csrf
                @method('PATCH')
                <input type="hidden" name="id" id="edit_id">
                
                <div class="space-y-6">
                    <div id="e_nama_container" class="space-y-1.5">
                        <label class="block text-sm font-semibold text-gray-800 mb-1.5">Nama Jadwal <span class="text-red-500">*</span></label>
                        <input type="text" name="nama_jadwal" id="edit_nama" 
                            class="w-full bg-gray-50 border border-gray-200 text-gray-900 text-[13px] rounded-lg focus:ring-[#8C1007] focus:border-[#8C1007] block p-3 transition-colors font-medium"
                            placeholder="Masukkan nama jadwal (contoh: Misa Harian)" required>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div id="e_kategori_container" class="space-y-1.5">
                            <label class="block text-sm font-semibold text-gray-800 mb-1.5">Kategori Jadwal <span class="text-red-500">*</span></label>
                            <select name="kategori_jadwal_id" id="edit_kategori" 
                                class="w-full bg-gray-50 border border-gray-200 text-gray-900 text-[13px] rounded-lg focus:ring-[#8C1007] focus:border-[#8C1007] block p-3 transition-colors font-medium appearance-none" 
                                style="background-image: url('data:image/svg+xml;charset=UTF-8,%3csvg xmlns=\'http://www.w3.org/2000/svg\' fill=\'none\' stroke=\'%236b7280\' stroke-width=\'2\' stroke-linecap=\'round\' stroke-linejoin=\'round\' class=\'feather feather-chevron-down\' viewBox=\'0 0 24 24\'%3e%3cpolyline points=\'6 9 12 15 18 9\'%3e%3c/polyline%3e%3c/svg%3e'); background-repeat: no-repeat; background-position: right 0.75rem center; background-size: 1em;" required>
                                @foreach($kategori as $k)
                                    <option value="{{ $k->id }}">{{ $k->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-800 mb-1.5">Tipe Penjadwalan <span class="text-red-500">*</span></label>
                            <div class="flex p-1 bg-gray-100 rounded-lg h-[46px]">
                                <button type="button" onclick="switchEditType('rutin')" id="btnEditTypeRutin"
                                    class="flex-1 py-1.5 text-[11px] font-semibold rounded-lg transition-all bg-white text-[#8C1007] shadow-sm focus:outline-none">
                                    Rutin
                                </button>
                                <button type="button" onclick="switchEditType('khusus')" id="btnEditTypeKhusus"
                                    class="flex-1 py-1.5 text-[11px] font-semibold rounded-lg transition-all text-gray-500 focus:outline-none">
                                    Khusus
                                </button>
                            </div>
                            <input type="hidden" name="edit_tipe_jadwal" id="edit_tipe_jadwal" value="rutin">
                        </div>
                    </div>
                    <div id="sectionEditRutin" class="space-y-4 p-6 bg-white rounded-xl border border-gray-200 shadow-sm">
                        <div class="flex items-center gap-6 pb-2">
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="edit_rutin_mode" id="edit_rutin_single" value="single" checked onchange="toggleEditRutinMode(this.value)"
                                    class="w-4 h-4 text-[#8C1007] focus:ring-[#8C1007] border-gray-300">
                                <span class="text-xs font-semibold text-gray-700">Hari Tunggal</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="edit_rutin_mode" id="edit_rutin_range" value="range" onchange="toggleEditRutinMode(this.value)"
                                    class="w-4 h-4 text-[#8C1007] focus:ring-[#8C1007] border-gray-300">
                                <span class="text-xs font-semibold text-gray-700">Rentang Hari</span>
                            </label>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-800 mb-1.5" id="labelEditHariStart">Dari Hari</label>
                                <select id="edit_hari_start" class="w-full p-3 rounded-lg border border-gray-200 text-sm bg-gray-50 focus:ring-[#8C1007] focus:border-[#8C1007] font-medium appearance-none" style="background-image: url('data:image/svg+xml;charset=UTF-8,%3csvg xmlns=\'http://www.w3.org/2000/svg\' fill=\'none\' stroke=\'%236b7280\' stroke-width=\'2\' stroke-linecap=\'round\' stroke-linejoin=\'round\' class=\'feather feather-chevron-down\' viewBox=\'0 0 24 24\'%3e%3cpolyline points=\'6 9 12 15 18 9\'%3e%3c/polyline%3e%3c/svg%3e'); background-repeat: no-repeat; background-position: right 0.75rem center; background-size: 1em;">
                                    @foreach(['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu'] as $h)
                                        <option value="{{ $h }}">{{ $h }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div id="divEditHariEnd" class="hidden">
                                <label class="block text-sm font-semibold text-gray-800 mb-1.5">Sampai</label>
                                <select id="edit_hari_end" class="w-full p-3 rounded-lg border border-gray-200 text-sm bg-gray-50 focus:ring-[#8C1007] focus:border-[#8C1007] font-medium appearance-none" style="background-image: url('data:image/svg+xml;charset=UTF-8,%3csvg xmlns=\'http://www.w3.org/2000/svg\' fill=\'none\' stroke=\'%236b7280\' stroke-width=\'2\' stroke-linecap=\'round\' stroke-linejoin=\'round\' class=\'feather feather-chevron-down\' viewBox=\'0 0 24 24\'%3e%3cpolyline points=\'6 9 12 15 18 9\'%3e%3c/polyline%3e%3c/svg%3e'); background-repeat: no-repeat; background-position: right 0.75rem center; background-size: 1em;">
                                    @foreach(['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu'] as $h)
                                        <option value="{{ $h }}">{{ $h }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div id="sectionEditKhusus" class="hidden space-y-4 p-6 bg-white rounded-xl border border-gray-200 shadow-sm">
                        <div class="flex items-center gap-6 pb-2">
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="edit_khusus_mode" id="edit_khusus_single" value="single" checked onchange="toggleEditKhususMode(this.value)"
                                    class="w-4 h-4 text-[#8C1007] focus:ring-[#8C1007] border-gray-300">
                                <span class="text-xs font-semibold text-gray-700">Tanggal Tunggal</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="edit_khusus_mode" id="edit_khusus_range" value="range" onchange="toggleEditKhususMode(this.value)"
                                    class="w-4 h-4 text-[#8C1007] focus:ring-[#8C1007] border-gray-300">
                                <span class="text-xs font-semibold text-gray-700">Rentang Tanggal</span>
                            </label>
                        </div>
                        <div class="relative">
                            <label class="block text-sm font-semibold text-gray-800 mb-1.5">Tanggal</label>
                            <input type="text" id="edit_tanggal_picker"
                                class="w-full p-3 bg-gray-50 border border-gray-200 text-gray-900 text-[13px] rounded-lg focus:ring-[#8C1007] focus:border-[#8C1007] block transition-colors pr-10 font-medium"
                                placeholder="Pilih tanggal" readonly>
                        </div>
                    </div>

                    <input type="hidden" name="hari" id="edit_hari_final">
                    <div class="space-y-4 p-6 border border-gray-200 rounded-xl bg-white shadow-sm">
                        <label class="block text-sm font-semibold text-gray-800 mb-1.5">Waktu Perayaan <span class="text-red-500">*</span></label>
                        <div class="flex items-center gap-6 pb-2">
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="edit_waktu_mode" id="edit_waktu_single" value="single" checked onchange="toggleEditWaktuMode(this.value)"
                                    class="w-4 h-4 text-[#8C1007] focus:ring-[#8C1007] border-gray-300">
                                <span class="text-xs font-semibold text-gray-700">Tunggal</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="edit_waktu_mode" id="edit_waktu_range" value="range" onchange="toggleEditWaktuMode(this.value)"
                                    class="w-4 h-4 text-[#8C1007] focus:ring-[#8C1007] border-gray-300">
                                <span class="text-xs font-semibold text-gray-700">Rentang</span>
                            </label>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-800 mb-1.5" id="labelEditWaktuStart">Mulai</label>
                                <input type="time" id="edit_waktu_start" class="w-full p-3 rounded-lg border border-gray-200 text-[13px] bg-gray-50 focus:ring-[#8C1007] focus:border-[#8C1007] font-medium">
                            </div>
                            <div id="divEditWaktuEnd" class="hidden">
                                <label class="block text-sm font-semibold text-gray-800 mb-1.5">Selesai</label>
                                <input type="time" id="edit_waktu_end" class="w-full p-3 rounded-lg border border-gray-200 text-[13px] bg-gray-50 focus:ring-[#8C1007] focus:border-[#8C1007] font-medium">
                            </div>
                        </div>
                        <p id="edit_waktu_error" class="hidden text-xs text-red-500 font-medium mt-2 flex items-center gap-1">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <span>Jam Selesai tidak boleh lebih awal dari Jam Mulai.</span>
                        </p>
                        <input type="hidden" name="waktu" id="edit_waktu_final">
                    </div>
                    <div id="e_lokasi_container" class="space-y-1.5">
                        <label class="block text-sm font-semibold text-gray-800 mb-1.5">Lokasi <span class="text-red-500">*</span></label>
                        <input type="text" name="lokasi" id="edit_lokasi" 
                            class="w-full bg-gray-50 border border-gray-200 text-gray-900 text-[13px] rounded-lg focus:ring-[#8C1007] focus:border-[#8C1007] block p-3 transition-colors font-medium"
                            placeholder="Gereja Utama" required>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-800 mb-1.5">Keterangan (Opsional)</label>
                        <textarea name="keterangan" id="edit_keterangan" rows="3"
                            class="w-full bg-gray-50 border border-gray-200 text-gray-900 text-[13px] rounded-lg focus:ring-[#8C1007] focus:border-[#8C1007] block p-3 transition-colors resize-none font-medium"
                            placeholder="Informasi tambahan..."></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-800 mb-3">Status Publikasi</label>
                        <div class="flex items-center gap-6">
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="is_active" id="edit_status_draft" value="0" class="w-4 h-4 text-[#8C1007] focus:ring-[#8C1007] border-gray-300">
                                <span class="text-sm text-gray-700 whitespace-nowrap">Simpan sebagai Draft</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="is_active" id="edit_status_publish" value="1" class="w-4 h-4 text-[#8C1007] focus:ring-[#8C1007] border-gray-300">
                                <span class="text-sm text-gray-700 whitespace-nowrap">Publikasikan</span>
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
            <button type="button" onclick="document.getElementById('formEdit').dispatchEvent(new Event('submit'))"
                class="text-white text-[10px] font-semibold hover:opacity-90 transition-opacity focus:outline-none"
                style="background:#8C1007 !important; border-radius: 0.5rem !important; padding: 7px 20px !important; display: inline-block !important;">
                Simpan Perubahan
            </button>
        </div>
    </div>
</div>









