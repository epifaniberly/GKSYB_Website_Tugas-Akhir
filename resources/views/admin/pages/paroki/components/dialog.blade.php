<div id="modalPastor" class="fixed inset-0 z-[50] hidden flex items-center justify-center p-4 sm:p-6" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-black/60 backdrop-blur-sm transition-opacity" onclick="closeModalPastor()"></div>
    <div class="relative bg-white rounded-2xl text-left shadow-2xl transform transition-all max-w-2xl w-full font-manrope overflow-hidden flex flex-col max-h-[90vh] animate-in fade-in zoom-in duration-200">
        
        <form id="formPastorModal" action="" method="POST" enctype="multipart/form-data" class="flex flex-col h-full overflow-hidden" novalidate>
            @csrf
            <input type="hidden" name="_method" id="modalMethod" value="POST">
            <div class="px-8 py-5 border-b border-gray-100 bg-white sticky top-0 z-20">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div id="modalHeaderPhotoBox" class="w-14 h-14 bg-gray-50 rounded-full overflow-hidden border border-gray-100 flex-shrink-0 relative group shadow-sm flex items-center justify-center hidden">
                            <img id="display_header_foto" class="w-full h-full object-cover">
                            <div id="display_header_placeholder" class="hidden text-[#8C1007]">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-gray-800" id="modalTitle">Lihat Detail Pastor</h3>
                            <p class="text-xs text-gray-400 mt-0.5" id="modalDesc">Informasi lengkap pastor paroki</p>
                        </div>
                    </div>
                    <button id="modalCloseIcon" type="button" onclick="closeModalPastor()" class="text-gray-400 hover:text-gray-500 transition-colors p-2 bg-gray-50 rounded-xl outline-none focus:outline-none">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                </div>
            </div>
            <div class="p-8 overflow-y-auto flex-1">
                <div id="displaySection" class="hidden space-y-8">
                    <div class="grid grid-cols-2 gap-8">
                        <div>
                            <label class="block text-sm font-semibold text-gray-800 mb-2">Status Pelayanan</label>
                            <span id="display_status_badge" class="inline-flex px-2 py-0.5 rounded text-[10px] font-bold bg-green-50 text-green-600 uppercase tracking-wider border border-green-100">
                                AKTIF
                            </span>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-800 mb-2">Masa Karya</label>
                            <p id="display_masa_karya" class="text-gray-600 text-sm font-light leading-relaxed">
                                Mulai: 2022
                            </p>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-8">
                        <div>
                            <label class="block text-sm font-semibold text-gray-800 mb-2">Terdaftar Sejak</label>
                            <p id="display_tahun_mulai" class="text-gray-600 text-sm font-light leading-relaxed">2022</p>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-800 mb-2">Selesai Tugas</label>
                            <p id="display_tahun_selesai" class="text-gray-600 text-sm font-light leading-relaxed">Masih Menjabat</p>
                        </div>
                    </div>
                </div>
                <div id="formSection" class="hidden space-y-5">
                    <div class="space-y-5">
                        <div>
                            <div class="flex justify-between items-center mb-2">
                                <label for="modal_nama_pastor" class="block text-sm font-semibold text-gray-800">Nama Pastor <span class="text-red-500">*</span></label>
                                <span id="modalNamaPastorCounter" class="text-xs text-gray-400 font-medium">0/100</span>
                            </div>
                            <input id="modal_nama_pastor" name="nama_pastor" type="text" autocomplete="off" required maxlength="100"
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-[#8C1007] focus:ring-1 focus:ring-[#8C1007] text-sm transition-colors outline-none"
                                oninput="updateCharCount('modal_nama_pastor', 'modalNamaPastorCounter', 100)">
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div id="modal_tahun_mulai_container">
                                <label class="block text-sm font-semibold text-gray-800 mb-2">Tahun Mulai <span class="text-red-500">*</span></label>
                                <input id="modal_tahun_mulai" name="tahun_mulai" type="number" autocomplete="off"
                                    class="w-full px-5 py-3 bg-[#FAFAFA] border border-gray-200 rounded-2xl focus:bg-white focus:border-gray-300 focus:ring-0 text-[12px] sm:text-sm font-medium transition-all outline-none placeholder:text-gray-400 text-gray-800 group-[.error]:!border-red-600 group-[.error]:!bg-[#FFF5F5] group-[.error]:!text-red-900 group-[.error]:!ring-red-100" required>
                            </div>
                            <div id="modal_tahun_selesai_container" class="group @error('tahun_selesai') error @enderror">
                                <label class="block text-sm font-semibold text-gray-800 mb-2">Tahun Selesai</label>
                                <input id="modal_tahun_selesai" name="tahun_selesai" type="number" autocomplete="off"
                                    class="w-full px-5 py-3 bg-[#FAFAFA] border border-gray-200 rounded-2xl focus:bg-white focus:border-gray-300 focus:ring-0 text-[12px] sm:text-sm font-medium transition-all outline-none placeholder:text-gray-400 text-gray-800 disabled:bg-white disabled:border-gray-100 disabled:text-gray-400 group-[.error]:!border-red-600 group-[.error]:!bg-[#FFF5F5] group-[.error]:!text-red-900 group-[.error]:!ring-red-100">
                                <p id="modal_tahun_selesai_error_msg" class="text-xs text-red-500 mt-1 @if(!$errors->has('tahun_selesai')) hidden @endif">
                                    @error('tahun_selesai') {{ $message }} @else Tahun selesai tidak boleh kurang dari tahun mulai. @enderror
                                </p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-sm font-semibold text-gray-800 mb-2">Status <span class="text-red-500">*</span></label>
                                <div class="flex items-center gap-6 p-1">
                                    <label class="flex items-center gap-2 cursor-pointer">
                                        <input id="modal_status_aktif" type="radio" name="status" value="1" onchange="toggleStatusInputsModal(true)"
                                            class="w-4 h-4 text-[#8C1007] border-gray-300 focus:ring-[#8C1007]">
                                        <span class="text-sm font-medium text-gray-600">Aktif</span>
                                    </label>
                                    <label class="flex items-center gap-2 cursor-pointer">
                                        <input id="modal_status_nonaktif" type="radio" name="status" value="0" onchange="toggleStatusInputsModal(false)"
                                            class="w-4 h-4 text-[#8C1007] border-gray-300 focus:ring-[#8C1007]">
                                        <span class="text-sm font-medium text-gray-600">Nonaktif</span>
                                    </label>
                                </div>
                            </div>
                            <div id="modal_jabatan_container" class="group @error('jabatan') error @enderror">
                                <label class="block text-sm font-semibold text-gray-800 mb-2">Jabatan <span class="text-red-500">*</span></label>
                                <input id="modal_jabatan" name="jabatan" type="text" value="{{ old('jabatan') }}" autocomplete="off"
                                    class="w-full px-5 py-3 bg-[#FAFAFA] border border-gray-200 rounded-2xl focus:bg-white focus:border-gray-300 focus:ring-0 text-[12px] sm:text-sm font-medium transition-all outline-none placeholder:text-gray-400 text-gray-800 disabled:bg-white disabled:border-gray-100 disabled:text-gray-400 group-[.error]:!border-red-600 group-[.error]:!bg-[#FFF5F5] group-[.error]:!text-red-900 group-[.error]:!ring-red-100">
                                <p id="modal_jabatan_error_msg" class="text-xs text-red-500 mt-1 @if(!$errors->has('jabatan')) hidden @endif">
                                    @error('jabatan') {{ $message }} @else Jabatan "Pastor Paroki" sudah terisi oleh pastor lain. @enderror
                                </p>
                            </div>
                        </div>
                    </div>
                    <div id="modal_foto_section" class="pt-2">
                        <label class="block text-sm font-semibold text-gray-800 mb-2">Foto Pastor</label>
                        <label for="modal_foto_input" class="relative group block cursor-pointer">
                            <input type="file" name="foto_pastor" id="modal_foto_input" accept="image/*" onchange="previewFotoModal(event)"
                                class="sr-only">
                            <div class="w-full border-2 border-dashed border-gray-200 rounded-2xl py-12 px-6 flex flex-col items-center justify-center bg-gray-50/30 group-hover:border-[#8C1007] group-hover:bg-[#FFF3F2]/30 transition-all text-center @error('foto_pastor') border-red-500 bg-red-50 @enderror">
                                <svg class="w-10 h-10 text-gray-400 mb-4 group-hover:text-[#8C1007] transition-colors @error('foto_pastor') text-red-500 @enderror" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <p class="text-[12px] sm:text-sm font-medium text-gray-700 mb-1 @error('foto_pastor') text-red-900 @enderror">Klik untuk upload foto atau drag & drop</p>
                                <p class="text-xs text-gray-400 @error('foto_pastor') text-red-400 @enderror">JPG, JPEG, PNG (Maks. 10MB)</p>
                            </div>
                        </label>
                        @error('foto_pastor')
                            <p class="text-xs text-red-500 mt-1 text-right">{{ $message }}</p>
                        @enderror
                        <div id="modal_preview_container" class="hidden mt-3">
                            <div class="flex items-center gap-4 p-3 bg-white border border-gray-200 rounded-xl shadow-sm group hover:border-[#8C1007]/30 transition-all">
                                <div class="w-16 h-16 shrink-0 bg-gray-100 rounded-lg overflow-hidden border border-gray-100">
                                    <img id="modal_preview" class="w-full h-full object-cover">
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h5 id="modal_filename_display" class="text-sm font-semibold text-gray-800 truncate">Foto Pastor</h5>
                                    <p class="text-xs text-gray-500 mt-0.5" id="modal_filesize_display">Gambar terpilih</p>
                                </div>
                                <button type="button" onclick="removeFotoModal()" 
                                    class="p-2 text-red-500 hover:bg-red-50 rounded-lg transition-all focus:outline-none cursor-pointer" 
                                    style="color: #ef4444 !important;"
                                    title="Hapus Foto">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        
                        <input type="hidden" name="remove_foto" id="modal_remove_foto_val" value="0">
                    </div>
                </div>
            </div>
            <div id="modalFooter" class="px-6 py-4 border-t border-gray-100 flex justify-end items-center gap-3 shrink-0 bg-white">
                <button type="button" onclick="closeModalPastor()" class="bg-white border border-gray-200 text-gray-700 text-[10px] font-semibold hover:bg-gray-50 transition-colors focus:outline-none" style="border-radius: 0.5rem !important; padding: 7px 20px !important; display: inline-block !important;">Batal</button>
                <button type="button" onclick="submitEditPastor()" class="text-white text-[10px] font-semibold hover:opacity-90 transition-opacity focus:outline-none" style="background:#8C1007 !important; border-radius: 0.5rem !important; padding: 7px 20px !important; display: inline-block !important;">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<script>
    function toggleStatusInputsModal(isActive) {
        const jabatanInput = document.getElementById('modal_jabatan');
        const tahunSelesaiInput = document.getElementById('modal_tahun_selesai');
        
        if (isActive) {
            jabatanInput.disabled = false;
            jabatanInput.required = true;
            tahunSelesaiInput.disabled = true;
            tahunSelesaiInput.required = false;
            tahunSelesaiInput.value = "";

            if (modalValidator) {
                modalValidator.clearError(tahunSelesaiInput);
                const container = document.getElementById('modal_tahun_selesai_container');
                if (container) {
                    container.classList.remove('error');
                    const msg = document.getElementById('modal_tahun_selesai_error_msg');
                    if (msg) msg.classList.add('hidden');
                }
            }
        } else {
            jabatanInput.disabled = true;
            jabatanInput.required = false;
            jabatanInput.value = "";
            tahunSelesaiInput.disabled = false;
            tahunSelesaiInput.required = true;

            if (modalValidator) {
                modalValidator.clearError(jabatanInput);
                const container = document.getElementById('modal_jabatan_container');
                if (container) {
                    container.classList.remove('error');
                    const msg = document.getElementById('modal_jabatan_error_msg');
                    if (msg) msg.classList.add('hidden');
                }
            }
        }
        if(typeof validateJabatan === "function") validateJabatan();
    }

    function previewFotoModal(event) {
        if (event.target.files && event.target.files[0]) {
            const file = event.target.files[0];
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('modal_preview').src = e.target.result;
                document.getElementById('modal_preview_container').classList.remove('hidden');
                document.getElementById('modal_upload_container').classList.add('hidden');
                document.getElementById('modal_remove_foto_val').value = "0";

                const nameDisplay = document.getElementById('modal_filename_display');
                const sizeDisplay = document.getElementById('modal_filesize_display');
                if(nameDisplay) nameDisplay.textContent = file.name;
                if(sizeDisplay) sizeDisplay.textContent = (file.size / 1024).toFixed(1) + " KB";
            }
            reader.readAsDataURL(file);
        }
    }

    function removeFotoModal() {
        document.getElementById('modal_foto_input').value = "";
        document.getElementById('modal_preview').src = "";
        document.getElementById('modal_preview_container').classList.add('hidden');
        document.getElementById('modal_upload_container').classList.remove('hidden'); // Show upload container
        document.getElementById('modal_remove_foto_val').value = "1";
    }

    function closeModalPastor() {
        document.getElementById('modalPastor').classList.add('hidden');
    }
</script>
