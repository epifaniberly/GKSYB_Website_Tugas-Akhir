<form id="formPastor" action="{{ route('admin.paroki.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6 fs-style-manrope" novalidate>
    @csrf
    <input type="hidden" name="_method" id="method" value="POST">
    
    <div class="space-y-4">
        <div id="nama_pastor_container">
            <div class="flex justify-between items-center mb-2">
                <label for="nama_pastor" class="block text-sm font-semibold text-gray-800">Nama Pastor <span class="text-red-500">*</span></label>
                <span id="namaPastorCounter" class="text-xs text-gray-400 font-medium">0/100</span>
            </div>
            <div class="relative">
                <input 
                    id="nama_pastor" 
                    name="nama_pastor" 
                    type="text" 
                    placeholder="Masukkan nama pastor (contoh: Rm. Yohanes Suryadi)" 
                    value="{{ old('nama_pastor') }}" 
                    autocomplete="off"
                    maxlength="100"
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-[#8C1007] focus:ring-1 focus:ring-[#8C1007] text-sm transition-colors outline-none"
                    oninput="updateCharCount('nama_pastor', 'namaPastorCounter', 100)"
                    required
                >
            </div>
            <p id="tambah_nama_error_msg" class="text-xs text-red-500 mt-1 hidden"></p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div id="tahun_mulai_container">
                <label for="tahun_mulai" class="block text-sm font-semibold text-gray-800 mb-2">Tahun Mulai <span class="text-red-500">*</span></label>
                <div class="relative">
                    <input 
                        id="tahun_mulai" 
                        name="tahun_mulai" 
                        type="number" 
                        min="1900" 
                        max="2100" 
                        placeholder="2021" 
                        value="{{ old('tahun_mulai') }}"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-[#8C1007] focus:ring-1 focus:ring-[#8C1007] text-sm transition-colors outline-none"
                        required
                    >
                </div>
            </div>
            <div id="tahun_selesai_container">
                <label for="tahun_selesai" class="block text-sm font-semibold text-gray-800 mb-2">Tahun Selesai</label>
                <div class="relative">
                    <input 
                        id="tahun_selesai" 
                        name="tahun_selesai" 
                        type="number" 
                        min="1900" 
                        max="2100" 
                        placeholder="Sekarang" 
                        value="{{ old('tahun_selesai') }}" 
                        autocomplete="off"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-[#8C1007] focus:ring-1 focus:ring-[#8C1007] text-sm transition-colors outline-none disabled:bg-gray-100 disabled:cursor-not-allowed"
                    >
                </div>
                <p id="tambah_tahun_selesai_error_msg" class="text-xs text-red-500 mt-1 hidden">Tahun selesai tidak boleh kurang dari tahun mulai.</p>
            </div>
        </div>
        <div>
            <label class="block text-gray-700 text-sm font-semibold mb-3">Status Pastor <span class="text-red-500">*</span></label>
            <div class="flex items-center gap-6">
                <label class="flex items-center gap-2 cursor-pointer group">
                    <input id="status_aktif" type="radio" name="status" value="1" onchange="toggleStatusInputs(true)" checked
                        class="w-4 h-4 text-[#8C1007] border-gray-300 focus:ring-[#8C1007]">
                    <span class="text-sm text-gray-700 group-hover:text-gray-900 transition-colors font-medium">Aktif</span>
                </label>
                <label class="flex items-center gap-2 cursor-pointer group">
                    <input id="status_nonaktif" type="radio" name="status" value="0" onchange="toggleStatusInputs(false)"
                        class="w-4 h-4 text-[#8C1007] border-gray-300 focus:ring-[#8C1007]">
                    <span class="text-sm text-gray-700 group-hover:text-gray-900 transition-colors font-medium">Nonaktif</span>
                </label>
            </div>
        </div>
        <div id="jabatan_container">
            <div class="flex justify-between items-center mb-2">
                <label for="jabatan" class="block text-sm font-semibold text-gray-800">Jabatan <span class="text-xs text-gray-400 font-normal">(Hanya Status Aktif)</span> <span class="text-red-500">*</span></label>
                <span id="jabatanCounter" class="text-xs text-gray-400 font-medium">0/50</span>
            </div>
            <div class="relative">
                <input 
                    id="jabatan" 
                    name="jabatan" 
                    type="text" 
                    placeholder="Masukkan jabatan (contoh: Pastor Paroki)" 
                    value="{{ old('jabatan') }}" 
                    autocomplete="off"
                    maxlength="50"
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-[#8C1007] focus:ring-1 focus:ring-[#8C1007] text-sm transition-colors outline-none disabled:bg-gray-100 disabled:cursor-not-allowed"
                    oninput="updateCharCount('jabatan', 'jabatanCounter', 50)"
                >
            </div>
            <p id="tambah_jabatan_error_msg" class="text-xs text-red-500 mt-1 hidden">Jabatan "Pastor Paroki" sudah terisi oleh pastor lain.</p>
        </div>
        <div>
            <label class="block text-sm font-semibold text-gray-800 mb-2">Foto Pastor</label>
            
            <label for="foto_input" class="relative group block cursor-pointer">
                <input type="file" id="foto_input" name="foto_pastor" accept="image/*" onchange="previewFoto(event)"
                    class="sr-only">
                
                <div id="upload_area" class="w-full py-12 px-6 border-2 border-dashed border-gray-200 rounded-2xl bg-gray-50/30 group-hover:border-[#8C1007] group-hover:bg-[#FFF3F2]/30 transition-all flex flex-col items-center justify-center text-center @error('foto_pastor') border-red-500 bg-red-50 @enderror">
                    <svg class="w-10 h-10 text-gray-400 mb-4 group-hover:text-[#8C1007] transition-colors @error('foto_pastor') text-red-400 @enderror" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <p class="text-[12px] sm:text-sm font-medium text-gray-700 mb-1 @error('foto_pastor') text-red-900 @enderror">Klik untuk upload foto atau drag & drop</p>
                    <p class="text-xs text-gray-400 @error('foto_pastor') text-red-400 @enderror">JPG, JPEG, PNG (Maks. 10MB)</p>
                </div>
            </label>
            @error('foto_pastor')
                <p class="text-xs text-red-500 mt-1 text-right">{{ $message }}</p>
            @enderror

            <div id="preview_container" class="hidden mt-4 p-4 border border-gray-100 rounded-xl bg-gray-50">
                <div class="flex items-center gap-4">
                    <div class="w-16 h-20 bg-white rounded-lg overflow-hidden border border-gray-200 flex-shrink-0">
                        <img id="preview" class="w-full h-full object-cover">
                    </div>
                    <div class="flex-1 overflow-hidden">
                        <p class="text-[12px] sm:text-sm font-medium text-gray-700">Preview Foto Pastor</p>
                        <p class="text-xs text-gray-400 mt-1">Siap untuk diunggah</p>
                    </div>
                    <button type="button" onclick="removeSelectedFoto()" class="p-2 text-gray-400 hover:text-red-500 transition-colors focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
            </div>
            <input type="hidden" name="remove_foto" id="remove_foto" value="0">
        </div>
    </div>
    <div class="flex items-center gap-3 pt-6 border-t border-gray-100 mt-8 mb-6 text-sm">
        <button type="submit" 
                class="text-white text-[12px] font-medium hover:opacity-90 transition-opacity focus:outline-none"
                style="background:#8C1007 !important; border-radius: 0.5rem !important; padding: 10px 32px !important; display: inline-block !important;">
            Simpan Data Pastor
        </button>
        <button type="button"
                onclick="resetFormTambah()"
                class="bg-white border border-gray-200 text-gray-700 text-[12px] font-medium hover:bg-gray-50 transition-colors focus:outline-none"
                style="border-radius: 0.5rem !important; padding: 10px 32px !important; display: inline-block !important;">
            Reset
        </button>
    </div>
</form>

<script>
    function updateCharCount(inputId, counterId, maxLength) {
        const input = document.getElementById(inputId);
        const counter = document.getElementById(counterId);
        const currentLength = input.value.length;
        
        if (maxLength) {
            counter.textContent = `${currentLength}/${maxLength}`;
            
            if (currentLength >= maxLength) {
                counter.classList.remove('text-gray-400', 'text-yellow-500');
                counter.classList.add('text-red-500');
            } else if (currentLength >= maxLength * 0.9) {
                counter.classList.remove('text-gray-400', 'text-red-500');
                counter.classList.add('text-yellow-500');
            } else {
                counter.classList.remove('text-yellow-500', 'text-red-500');
                counter.classList.add('text-gray-400');
            }
        }
    }

    let pastorValidator;
    document.addEventListener('DOMContentLoaded', function() {
        pastorValidator = new FormValidator('formPastor');
        
        pastorValidator.addValidation('nama_pastor', [
            'required',
            pastorValidator.rules.minLength(5),
            pastorValidator.rules.maxLength(100)
        ]);
        
        pastorValidator.addValidation('tahun_mulai', ['required']);
        pastorValidator.addValidation('jabatan', [
            pastorValidator.rules.maxLength(50)
        ]);
        pastorValidator.addValidation('tahun_selesai', []);
        
        pastorValidator.init();
    });

    function toggleStatusInputs(isActive) {
        const jabatanInput = document.getElementById('jabatan');
        const tahunSelesaiInput = document.getElementById('tahun_selesai');
        
        if (isActive) {
            jabatanInput.disabled = false;
            jabatanInput.required = true;
            tahunSelesaiInput.disabled = true;
            tahunSelesaiInput.required = false;
            tahunSelesaiInput.value = "";
            tahunSelesaiInput.placeholder = "Sekarang";
            
            if (pastorValidator) {
                pastorValidator.clearError(tahunSelesaiInput);
                const container = document.getElementById('tahun_selesai_container');
                if (container) {
                    container.classList.remove('error');
                    const msg = document.getElementById('tambah_tahun_selesai_error_msg');
                    if (msg) msg.classList.add('hidden');
                }
            }
        } else {
            jabatanInput.disabled = true;
            jabatanInput.required = false;
            jabatanInput.value = "";
            tahunSelesaiInput.disabled = false;
            tahunSelesaiInput.required = true;
            tahunSelesaiInput.placeholder = "Contoh: 2024";
            
            if (pastorValidator) {
                pastorValidator.clearError(jabatanInput);
                const container = document.getElementById('jabatan_container');
                if (container) {
                    container.classList.remove('error');
                    const msg = document.getElementById('tambah_jabatan_error_msg');
                    if (msg) msg.classList.add('hidden');
                }
            }
        }
        validateJabatanTambah();
    }

    function removeSelectedFoto() {
        document.getElementById('foto_input').value = "";
        document.getElementById('preview').src = "";
        document.getElementById('preview_container').classList.add('hidden');
        document.getElementById('upload_area').classList.remove('hidden');
        document.getElementById('remove_foto').value = "1";
    }

    function previewFoto(e) {
        let file;
        if (e.target.files && e.target.files[0]) {
            file = e.target.files[0];
        } else if (e.dataTransfer && e.dataTransfer.files[0]) {
            file = e.dataTransfer.files[0];
            document.getElementById('foto_input').files = e.dataTransfer.files;
        }

        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                document.getElementById('preview').src = event.target.result;
                document.getElementById('preview_container').classList.remove('hidden');
                document.getElementById('upload_area').classList.add('hidden');
                document.getElementById('remove_foto').value = "0";
            }
            reader.readAsDataURL(file);
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        const uploadArea = document.getElementById('upload_area');
        const fileInput = document.getElementById('foto_input');

        if (uploadArea && fileInput) {
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                uploadArea.addEventListener(eventName, (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                }, false);
            });

            ['dragenter', 'dragover'].forEach(eventName => {
                uploadArea.addEventListener(eventName, () => {
                    uploadArea.classList.add('border-[#8C1007]', 'bg-[#FFF3F2]/30');
                }, false);
            });

            ['dragleave', 'drop'].forEach(eventName => {
                uploadArea.addEventListener(eventName, () => {
                    uploadArea.classList.remove('border-[#8C1007]', 'bg-[#FFF3F2]/30');
                }, false);
            });

            uploadArea.addEventListener('drop', (e) => {
                previewFoto(e);
            }, false);
        }
    });

    function validateNamaPastorTambah() {
        const nameInput = document.getElementById('nama_pastor');
        const container = document.getElementById('nama_pastor_container');
        const errorMsg = document.getElementById('tambah_nama_error_msg');
        
        if (!nameInput || !container || !errorMsg) return;

        const rawVal = nameInput.value.trim();
        const lowerVal = rawVal.toLowerCase();
        
        const isDuplicate = allPastors.some(p => p.nama === lowerVal);

        if (isDuplicate) {
            container.classList.add('error');
            errorMsg.innerText = "Nama pastor ini sudah ada di database.";
            errorMsg.classList.remove('hidden');
        } else {
            container.classList.remove('error');
            errorMsg.classList.add('hidden');
        }
        updateTambahSubmitState();
    }

    function updateTambahSubmitState() {
        const submitBtn = document.querySelector('#formPastor button[type="submit"]');
        if (!submitBtn) return;

        const nameContainer = document.getElementById('nama_pastor_container');
        const jabatanContainer = document.getElementById('jabatan_container');
        const tahunSelesaiContainer = document.getElementById('tahun_selesai_container');

        const nameError = nameContainer ? nameContainer.classList.contains('error') : false;
        const jabatanError = jabatanContainer ? jabatanContainer.classList.contains('error') : false;
        const tahunSelesaiError = tahunSelesaiContainer ? tahunSelesaiContainer.classList.contains('error') : false;

        const hasValidatorErrors = document.querySelector('#formPastor .text-red-600') !== null;

        if (nameError || jabatanError || tahunSelesaiError || hasValidatorErrors) {
            submitBtn.disabled = true;
            submitBtn.style.opacity = "0.5";
            submitBtn.style.cursor = "not-allowed";
        } else {
            submitBtn.disabled = false;
            submitBtn.style.opacity = "1";
            submitBtn.style.cursor = "pointer";
        }
    }

    function validateTahunTambah() {
        const mulaiInput = document.getElementById('tahun_mulai');
        const selesaiInput = document.getElementById('tahun_selesai');
        const container = document.getElementById('tahun_selesai_container');
        const errorMsg = document.getElementById('tambah_tahun_selesai_error_msg');

        if (!mulaiInput || !selesaiInput || !container || !errorMsg) return;

        const mulaiVal = parseInt(mulaiInput.value);
        const selesaiVal = parseInt(selesaiInput.value);

        if (!isNaN(mulaiVal) && !isNaN(selesaiVal) && selesaiVal < mulaiVal) {
            container.classList.add('error');
            errorMsg.innerText = "Tahun selesai tidak boleh kurang dari tahun mulai.";
            errorMsg.classList.remove('hidden');
        } else {
            container.classList.remove('error');
            errorMsg.classList.add('hidden');
        }
        updateTambahSubmitState();
    }

    function validateJabatanTambah() {
        const jabatanInput = document.getElementById('jabatan');
        const statusAktif = document.getElementById('status_aktif');
        const container = document.getElementById('jabatan_container');
        const errorMsg = document.getElementById('tambah_jabatan_error_msg');
        
        if (!jabatanInput || !statusAktif || !container || !errorMsg) return;

        const rawVal = jabatanInput.value.trim();
        const jabatanVal = rawVal.toLowerCase().replace(/\s+/g, ' ');
        const isPP = jabatanVal.includes('pastor paroki');

        let isError = false;
        let msg = "";

        if (statusAktif.checked) {
            if (isPP && activePastorParokiId !== null) {
                isError = true;
                msg = 'Jabatan "Pastor Paroki" sudah terisi oleh pastor lain.';
            }
        }

        if (isError) {
            container.classList.add('error');
            errorMsg.innerText = msg;
            errorMsg.classList.remove('hidden');
        } else {
            container.classList.remove('error');
            errorMsg.classList.add('hidden');
        }
        updateTambahSubmitState();
    }

    function resetFormTambah() {
        const form = document.getElementById('formPastor');
        if (!form) return;
        
        form.reset();
        
        toggleStatusInputs(true);
        removeSelectedFoto();
        
        updateCharCount('nama_pastor', 'namaPastorCounter', 100);
        updateCharCount('jabatan', 'jabatanCounter', 50);
        
        if (pastorValidator) {
            pastorValidator.clearErrors();
        }
        
        ['tambah_nama_error_msg', 'tambah_jabatan_error_msg', 'tambah_tahun_selesai_error_msg'].forEach(id => {
            const el = document.getElementById(id);
            if (el) el.classList.add('hidden');
        });
        
        ['nama_pastor_container', 'jabatan_container', 'tahun_selesai_container'].forEach(id => {
            const el = document.getElementById(id);
            if (el) el.classList.remove('error');
        });

        updateTambahSubmitState();
    }

    document.addEventListener('DOMContentLoaded', function() {
        toggleStatusInputs(true);
        
        const nameInput = document.getElementById('nama_pastor');
        const jabatanInput = document.getElementById('jabatan');
        const tahunMulaiInput = document.getElementById('tahun_mulai');
        const tahunSelesaiInput = document.getElementById('tahun_selesai');
        const stAktif = document.getElementById('status_aktif');
        const stNonAktif = document.getElementById('status_nonaktif');

        if(nameInput) {
            nameInput.addEventListener('input', validateNamaPastorTambah);
            nameInput.addEventListener('blur', validateNamaPastorTambah);
        }
        if(jabatanInput) {
            jabatanInput.addEventListener('input', validateJabatanTambah);
            jabatanInput.addEventListener('blur', validateJabatanTambah);
        }
        if(tahunMulaiInput) {
            tahunMulaiInput.addEventListener('input', validateTahunTambah);
            tahunMulaiInput.addEventListener('blur', validateTahunTambah);
        }
        if(tahunSelesaiInput) {
            tahunSelesaiInput.addEventListener('input', validateTahunTambah);
            tahunSelesaiInput.addEventListener('blur', validateTahunTambah);
        }
        if(stAktif) stAktif.addEventListener('change', validateJabatanTambah);
        if(stNonAktif) stNonAktif.addEventListener('change', validateJabatanTambah);
    });
</script>






