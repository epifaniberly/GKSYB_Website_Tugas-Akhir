<div class="w-full fs-style-manrope">
    <form id="formPanduan"
          action="{{ route('admin.panduan.store') }}"
          method="POST"
          enctype="multipart/form-data"
          class="space-y-6"
          novalidate>
        @csrf
        <div>
            <label for="jenis_misa" class="block text-sm font-semibold text-gray-800 mb-2">Jenis Panduan / Misa <span class="text-red-500">*</span></label>
            <input name="jenis_misa" id="jenis_misa" required
                   class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-[#8C1007] focus:ring-1 focus:ring-[#8C1007] text-sm transition-colors outline-none"
                   placeholder="Masukkan jenis misa (contoh: Misa Mingguan, Misa Hari Raya)">
        </div>
        <div>
            <label for="perayaan" class="block text-sm font-semibold text-gray-800 mb-2">Nama Perayaan <span class="text-red-500">*</span></label>
            <input name="perayaan" id="perayaan" required
                   class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-[#8C1007] focus:ring-1 focus:ring-[#8C1007] text-sm transition-colors outline-none"
                   placeholder="Masukkan perayaan (contoh: Minggu Adven II, Hari Raya Paskah)">
        </div>
        <div>
            <div class="flex justify-between items-center mb-2">
                <label for="ket_perayaan" class="block text-sm font-semibold text-gray-800">Keterangan Perayaan <span class="text-red-500">*</span> <span class="text-[10px] text-gray-400 font-normal">(Maksimal 15 kata)</span></label>
                <span id="wordCountKet" class="text-[10px] text-gray-400">0/15 kata</span>
            </div>
            <textarea name="ket_perayaan"
                      id="ket_perayaan"
                      required
                      class="w-full h-[120px] p-4 rounded-lg border border-gray-300 focus:border-[#8C1007] focus:ring-1 focus:ring-[#8C1007] text-sm transition-colors outline-none resize-none"
                      placeholder="Masukkan keterangan perayaan..."></textarea>
        </div>
        <div>
            <div class="flex justify-between items-center mb-2">
                <label for="ayat_alkitab" class="block text-sm font-semibold text-gray-800">Ayat Alkitab (Kutipan) <span class="text-red-500">*</span> <span class="text-[10px] text-gray-400 font-normal">(Maksimal 20 kata)</span></label>
                <span id="wordCountAyat" class="text-[10px] text-gray-400">0/20 kata</span>
            </div>
            <textarea name="ayat_alkitab"
                      id="ayat_alkitab"
                      required
                      class="w-full h-[100px] p-4 rounded-lg border border-gray-300 focus:border-[#8C1007] focus:ring-1 focus:ring-[#8C1007] text-sm transition-colors outline-none resize-none"
                      placeholder="Masukkan ayat alkitab (contoh: Sebab di mana dua atau tiga orang berkumpul... - Matius 18:20)"></textarea>
        </div>
        <div>
            <label for="sumber_ayat" class="block text-sm font-semibold text-gray-800 mb-2">Sumber Ayat <span class="text-red-500">*</span></label>
            <input name="sumber_ayat" id="sumber_ayat" required
                   class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-[#8C1007] focus:ring-1 focus:ring-[#8C1007] text-sm transition-colors outline-none"
                   placeholder="Masukkan sumber ayat (contoh: Matius 18:20)">
        </div>
        <div class="space-y-4 p-6 bg-white rounded-xl border border-gray-200 shadow-sm">
            <label class="block text-sm font-semibold text-gray-800">Tanggal Perayaan <span class="text-red-500">*</span></label>
            
            <div class="flex items-center gap-6 pb-2">
                <label class="flex items-center gap-2 cursor-pointer group">
                    <input type="radio" 
                           name="tipe_tanggal" 
                           value="tunggal" 
                           checked 
                           onchange="handleTipeTanggalChange(this.value)"
                           class="w-4 h-4 text-[#8C1007] border-gray-300 focus:ring-[#8C1007]">
                    <span class="text-xs font-semibold text-gray-700 group-hover:text-gray-900 transition-colors">Tanggal Tunggal</span>
                </label>

                <label class="flex items-center gap-2 cursor-pointer group">
                    <input type="radio" 
                           name="tipe_tanggal" 
                           value="rentang" 
                           onchange="handleTipeTanggalChange(this.value)"
                           class="w-4 h-4 text-[#8C1007] border-gray-300 focus:ring-[#8C1007]">
                    <span class="text-xs font-semibold text-gray-700 group-hover:text-gray-900 transition-colors">Rentang Tanggal</span>
                </label>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-800 mb-1.5" id="labelTanggal">Tanggal</label>
                <div class="relative">
                    <input type="text"
                           id="tanggal_picker"
                           class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-[#8C1007] focus:ring-0 text-sm transition-colors pr-10 cursor-pointer bg-white"
                           placeholder="Pilih tanggal"
                           readonly>
                    <div class="absolute top-1/2 -translate-y-1/2 right-0 flex items-center pr-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                </div>
                <p id="tanggal-error" class="hidden text-red-600 text-[11px] mt-4 flex items-center gap-2 font-medium">
                    <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    <span>Kolom ini wajib diisi</span>
                </p>
            </div>
            <input type="hidden" name="tanggal" id="final_tanggal">
            <input type="hidden" name="tanggal_mulai" id="final_tanggal_mulai">
            <input type="hidden" name="tanggal_akhir" id="final_tanggal_akhir">
        </div>
        <div class="space-y-3">
            <label class="block text-sm font-semibold text-gray-800">Upload Dokumen Panduan (PDF) <span class="text-red-500">*</span></label>
            
            <label for="fileInput" class="relative group block cursor-pointer">
                <div id="dropZone" class="border-2 border-dashed border-gray-200 rounded-2xl py-12 px-6 flex flex-col items-center justify-center bg-gray-50/30 group-hover:border-[#8C1007] group-hover:bg-[#FFF3F2]/30 transition-all min-h-[160px] relative overflow-hidden">
                    
                    <input type="file" name="file" id="fileInput" accept="application/pdf" onchange="previewPDF(this)"
                        class="sr-only" required>
                    
                    <div id="uploadPlaceholder" class="flex flex-col items-center text-center z-10 transition-all duration-300">
                        <div class="w-12 h-12 bg-white rounded-xl shadow-sm border border-gray-100 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-7 h-7 text-gray-400 group-hover:text-[#8C1007] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <p class="text-sm font-medium text-gray-700 mb-1">Klik untuk upload file atau drag & drop</p>
                        <p class="text-[11px] text-gray-400">PDF (Maks. 50MB)</p>
                    </div>

                    <div id="previewContainer" class="hidden w-full h-full absolute inset-0 bg-white z-20 flex items-center justify-center p-6">
                        <div class="w-full max-w-md bg-[#FAFAFA] border border-gray-100 rounded-2xl p-4 flex items-center justify-between gap-4 shadow-sm">
                            <div class="flex items-center gap-4 overflow-hidden">
                                 <div class="w-12 h-12 bg-red-50 text-[#8C1007] rounded-xl flex items-center justify-center shrink-0">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 16H8V14H12V16ZM16 8V16H14V8H16ZM20 2H8C6.9 2 6 2.9 6 4V16C6 17.1 6.9 18 8 18H20C21.1 18 22 17.1 22 16V4C22 2.9 21.1 2 20 2ZM20 16H8V4H20V16ZM4 6H2V20C2 21.1 2.9 22 4 22H18V20H4V6Z"/>
                                    </svg>
                                 </div>
                                 <div class="flex flex-col min-w-0 text-left">
                                     <span id="fileName" class="text-sm font-semibold text-gray-700 truncate block">document.pdf</span>
                                     <span id="fileSize" class="text-xs text-gray-400 font-medium tracking-tight">0 KB</span>
                                 </div>
                            </div>
                            <button type="button" onclick="removeFile()" class="w-8 h-8 flex items-center justify-center text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition-all focus:outline-none">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </button>
                        </div>
                    </div>
            <p id="file-error" class="hidden text-red-600 text-[11px] mt-4 flex items-center gap-2">
                <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                </svg>
                <span id="file-error-text">Kolom ini wajib diisi</span>
            </p>
        </div>

        <div class="mt-8">
            <label class="block text-sm font-semibold text-gray-800 mb-3">Status Publikasi</label>
            <div class="flex items-center gap-6">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="radio" name="is_publish" value="0" class="w-4 h-4 text-[#8C1007] focus:ring-[#8C1007] border-gray-300">
                    <span class="text-sm text-gray-700 whitespace-nowrap">Simpan sebagai Draft</span>
                </label>
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="radio" name="is_publish" value="1" checked class="w-4 h-4 text-[#8C1007] focus:ring-[#8C1007] border-gray-300">
                    <span class="text-sm text-gray-700 whitespace-nowrap">Publikasikan</span>
                </label>
            </div>
        </div>
        <div class="flex items-center gap-3 pt-6 border-t border-gray-100 mt-8 mb-6 text-sm">
            <button type="submit" 
                    class="text-white text-[12px] font-medium hover:opacity-90 transition-opacity focus:outline-none"
                    style="background:#8C1007 !important; border-radius: 0.5rem !important; padding: 10px 32px !important; display: inline-block !important;">
                Simpan Panduan
            </button>
            <button type="button"
                    onclick="resetForm()"
                    class="bg-white border border-gray-200 text-gray-700 text-[12px] font-medium hover:bg-gray-50 transition-colors focus:outline-none"
                    style="border-radius: 0.5rem !important; padding: 10px 32px !important; display: inline-block !important;">
                Reset
            </button>
        </div>
    </form>
</div>

@push('script')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://npmcdn.com/flatpickr/dist/l10n/id.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const form = document.getElementById('formPanduan');
        const fileInput = document.getElementById('fileInput');
        const previewContainer = document.getElementById('previewContainer');
        const fileNameDisplay = document.getElementById('fileName');
        const fileSizeDisplay = document.getElementById('fileSize');
        const dropZone = document.getElementById('dropZone');
        let datePicker;

        function initDatePicker(mode) {
            if (datePicker) datePicker.destroy();
            datePicker = flatpickr("#tanggal_picker", {
                mode: mode === 'rentang' ? 'range' : 'single',
                dateFormat: "Y-m-d",
                altInput: true,
                altFormat: "d F Y",
                altInputClass: "w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-[#8C1007] focus:ring-0 text-sm transition-colors pr-10 cursor-pointer bg-white",
                locale: "id",
                disableMobile: "true",
                allowInput: false,
                minDate: "today",
                rangeSeparator: " s/d ",
                onChange: function(selectedDates, dateStr, instance) {
                    document.getElementById('final_tanggal').value = '';
                    document.getElementById('final_tanggal_mulai').value = '';
                    document.getElementById('final_tanggal_akhir').value = '';

                    if (mode === 'tunggal' && selectedDates.length > 0) {
                        document.getElementById('final_tanggal').value = instance.formatDate(selectedDates[0], "Y-m-d");
                        instance.altInput.classList.remove('border-red-500', 'bg-red-50');
                        instance.altInput.style.borderColor = '';
                        instance.altInput.style.backgroundColor = '';
                        document.getElementById('tanggal-error').classList.add('hidden');
                    } else if (mode === 'rentang' && selectedDates.length === 2) {
                        document.getElementById('final_tanggal_mulai').value = instance.formatDate(selectedDates[0], "Y-m-d");
                        document.getElementById('final_tanggal_akhir').value = instance.formatDate(selectedDates[1], "Y-m-d");
                        instance.altInput.classList.remove('border-red-500', 'bg-red-50');
                        instance.altInput.style.borderColor = '';
                        instance.altInput.style.backgroundColor = '';
                        document.getElementById('tanggal-error').classList.add('hidden');
                    }
                },
                onClose: function(selectedDates, dateStr, instance) {
                    if (selectedDates.length === 0) {
                        instance.altInput.classList.add('border-red-500', 'bg-red-50');
                        instance.altInput.style.borderColor = '#ef4444';
                        instance.altInput.style.backgroundColor = '#fef2f2';
                        document.getElementById('tanggal-error').classList.remove('hidden');
                    }
                }
            });
        }

        window.handleTipeTanggalChange = function(mode) {
            initDatePicker(mode);
            document.getElementById('tanggal_picker').value = '';
            document.getElementById('final_tanggal').value = '';
            document.getElementById('final_tanggal_mulai').value = '';
            document.getElementById('final_tanggal_akhir').value = '';
            
            const labelText = mode === 'rentang' ? 'Rentang Tanggal' : 'Tanggal Tunggal';
            document.getElementById('labelTanggal').textContent = labelText;
        }

        function setupWordCount(id, maxWords, displayId) {
            const textarea = document.getElementById(id);
            const display = document.getElementById(displayId);
            if (!textarea || !display) return;

            textarea.addEventListener('input', function() {
                const words = this.value.trim().split(/\s+/).filter(word => word.length > 0);
                if (words.length > maxWords) {
                    this.value = this.value.split(/\s+/).slice(0, maxWords).join(' ');
                    const finalWords = this.value.trim().split(/\s+/).filter(word => word.length > 0);
                    display.textContent = `${finalWords.length}/${maxWords} kata`;
                    display.classList.remove('text-gray-400');
                    display.classList.add('text-red-600', 'font-bold');
                } else {
                    display.textContent = `${words.length}/${maxWords} kata`;
                    display.classList.remove('text-[#8C1007]', 'font-bold');
                    display.classList.add('text-gray-400');
                }
            });
        }

        setupWordCount('ket_perayaan', 15, 'wordCountKet');
        setupWordCount('ayat_alkitab', 20, 'wordCountAyat');

        const validator = new FormValidator('formPanduan');
        
        validator.addValidation('jenis_misa', ['required']);
        validator.addValidation('perayaan', ['required']);
        validator.addValidation('ket_perayaan', ['required']);
        validator.addValidation('ayat_alkitab', ['required']);
        validator.addValidation('sumber_ayat', ['required']);
        
        validator.init();

        fileInput.addEventListener('blur', function() {
            if (!this.files || this.files.length === 0) {
                const dropZone = document.getElementById('dropZone');
                const fileError = document.getElementById('file-error');
                if (dropZone) {
                    dropZone.classList.add('border-red-500', 'bg-red-50');
                    dropZone.style.borderColor = '#ef4444';
                    dropZone.style.borderWidth = '2px';
                    const icon = dropZone.querySelector('svg');
                    const text = dropZone.querySelector('p');
                    if (icon) icon.classList.add('text-red-400');
                    if (text) text.classList.add('text-red-600');
                }
                if (fileError) fileError.classList.remove('hidden');
            }
        });

        window.previewPDF = function(input) {
            const file = input.files[0];
            const placeholder = document.getElementById('uploadPlaceholder');
            const dropZone = document.getElementById('dropZone');
            const fileError = document.getElementById('file-error');
            const fileErrorText = document.getElementById('file-error-text');

            if (!file) { removeFile(); return; }

            if (file.type !== 'application/pdf') {
                if (dropZone) {
                    dropZone.classList.remove('border-gray-200', 'bg-gray-50/30');
                    dropZone.classList.add('border-red-500', 'bg-red-50');
                    dropZone.style.borderColor = '#ef4444';
                    dropZone.style.borderWidth = '2px';
                    dropZone.style.backgroundColor = '#fef2f2';
                    
                    const icon = dropZone.querySelector('svg');
                    const text = dropZone.querySelector('p');
                    if (icon) {
                        icon.classList.remove('text-gray-400');
                        icon.classList.add('text-red-400');
                    }
                    if (text) {
                        text.classList.remove('text-gray-700');
                        text.classList.add('text-red-600');
                    }
                }

                if (fileError) fileError.classList.remove('hidden');
                if (fileErrorText) fileErrorText.textContent = 'Hanya file PDF yang diperbolehkan.';

                input.value = '';
                removeFile();
                return;
            }

            if (file.size > 50 * 1024 * 1024) {
                if (dropZone) {
                    dropZone.classList.remove('border-gray-200', 'bg-gray-50/30');
                    dropZone.classList.add('border-red-500', 'bg-red-50');
                    dropZone.style.borderColor = '#ef4444';
                    dropZone.style.borderWidth = '2px';
                    dropZone.style.backgroundColor = '#fef2f2';

                    const icon = dropZone.querySelector('svg');
                    const text = dropZone.querySelector('p');
                    if (icon) {
                        icon.classList.remove('text-gray-400');
                        icon.classList.add('text-red-400');
                    }
                    if (text) {
                        text.classList.remove('text-gray-700');
                        text.classList.add('text-red-600');
                    }
                }

                if (fileError) fileError.classList.remove('hidden');
                if (fileErrorText) fileErrorText.textContent = 'Ukuran file maksimal 50MB.';

                input.value = '';
                removeFile();
                return;
            }

            fileNameDisplay.textContent = file.name;
            fileSizeDisplay.textContent = (file.size / 1024 / 1024).toFixed(2) + ' MB';
            previewContainer.classList.remove('hidden');
            if (placeholder) placeholder.classList.add('hidden');

            if (dropZone) {
                dropZone.classList.remove('border-red-500', 'bg-red-50');
                dropZone.classList.add('border-gray-200', 'bg-gray-50/30');
                dropZone.style.borderColor = '';
                dropZone.style.borderWidth = '';
                dropZone.style.backgroundColor = '';

                const icon = dropZone.querySelector('svg');
                const text = dropZone.querySelector('p');
                if (icon) {
                    icon.classList.remove('text-red-400');
                    icon.classList.add('text-gray-400');
                }
                if (text) {
                    text.classList.remove('text-red-600');
                    text.classList.add('text-gray-700');
                }
            }
            if (fileError) fileError.classList.add('hidden');
        }

        window.removeFile = function() {
            const placeholder = document.getElementById('uploadPlaceholder');
            const dropZone = document.getElementById('dropZone');
            const fileError = document.getElementById('file-error');

            fileInput.value = '';
            previewContainer.classList.add('hidden');
            if (placeholder) placeholder.classList.remove('hidden');

            if (dropZone) {
                dropZone.classList.remove('border-red-500', 'bg-red-50');
                dropZone.classList.add('border-gray-200', 'bg-gray-50/30');
                dropZone.style.borderColor = '';
                dropZone.style.borderWidth = '';
                dropZone.style.backgroundColor = '';

                const icon = dropZone.querySelector('svg');
                const text = dropZone.querySelector('p');
                if (icon) {
                    icon.classList.remove('text-red-400');
                    icon.classList.add('text-gray-400');
                }
                if (text) {
                    text.classList.remove('text-red-600');
                    text.classList.add('text-gray-700');
                }
            }
            if (fileError) fileError.classList.add('hidden');
        }

        window.resetForm = function() {
            form.reset();
            removeFile();
            handleTipeTanggalChange('tunggal');
            document.getElementById('wordCountKet').textContent = '0/15 kata';
            document.getElementById('wordCountAyat').textContent = '0/20 kata';
            ['ket_perayaan', 'ayat_alkitab', 'tanggal_picker', 'fileInput'].forEach(id => {
                const el = document.getElementById(id);
                if(el) el.setCustomValidity('');
            });
            document.getElementById('wordCountKet').classList.remove('text-red-500', 'font-bold');
            document.getElementById('wordCountKet').classList.add('text-gray-400');
            document.getElementById('wordCountAyat').classList.remove('text-red-500', 'font-bold');
            document.getElementById('wordCountAyat').classList.add('text-gray-400');

            const tanggalInput = document.getElementById('tanggal_picker');
            if (tanggalInput) {
                tanggalInput.classList.remove('border-red-500', 'bg-red-50');
            }
            validator.clearErrors();
        }

        if (form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                if (!validator.validateForm()) {
                    return; 
                }
                const kInput = document.getElementById('ket_perayaan');
                const aInput = document.getElementById('ayat_alkitab');
                const kw = kInput.value.trim().split(/\s+/).filter(w => w.length > 0).length;
                const aw = aInput.value.trim().split(/\s+/).filter(w => w.length > 0).length;

                const wordCountKet = document.getElementById('wordCountKet');
                const wordCountAyat = document.getElementById('wordCountAyat');

                if (kw > 15) {
                    wordCountKet.classList.remove('text-gray-400');
                    wordCountKet.classList.add('text-red-500', 'font-bold');
                    kInput.focus();
                    return;
                }
                if (aw > 20) {
                    wordCountAyat.classList.remove('text-gray-400');
                    wordCountAyat.classList.add('text-red-500', 'font-bold');
                    aInput.focus();
                    return;
                }

                const typeEl = document.querySelector('input[name="tipe_tanggal"]:checked');
                const type = typeEl ? typeEl.value : 'tunggal';
                const t = document.getElementById('final_tanggal').value;
                const tm = document.getElementById('final_tanggal_mulai').value;
                const ta = document.getElementById('final_tanggal_akhir').value;
                const tanggalPickerInput = document.getElementById('tanggal_picker');

                if (type === 'tunggal' && !t) {
                    if (datePicker && datePicker.altInput) {
                        datePicker.altInput.classList.add('border-red-500', 'bg-red-50');
                        datePicker.altInput.style.borderColor = '#ef4444';
                        datePicker.altInput.style.backgroundColor = '#fef2f2';
                        datePicker.altInput.focus();
                        document.getElementById('tanggal-error').classList.remove('hidden');
                    }
                    return;
                }
                if (type === 'rentang' && (!tm || !ta)) {
                    if (datePicker && datePicker.altInput) {
                        datePicker.altInput.classList.add('border-red-500', 'bg-red-50');
                        datePicker.altInput.style.borderColor = '#ef4444';
                        datePicker.altInput.style.backgroundColor = '#fef2f2';
                        datePicker.altInput.focus();
                        document.getElementById('tanggal-error').classList.remove('hidden');
                    }
                    return;
                }

                const fInput = document.getElementById('fileInput');
                if (!fInput || !fInput.files || fInput.files.length === 0) {
                    const dropZone = document.getElementById('dropZone');
                    const fileError = document.getElementById('file-error');
                    const fileErrorText = document.getElementById('file-error-text');
                    
                    if (dropZone) {
                        dropZone.classList.remove('border-gray-200', 'bg-gray-50/30');
                        dropZone.classList.add('border-red-500', 'bg-red-50');
                        dropZone.style.borderColor = '#ef4444';
                        dropZone.style.borderWidth = '2px';
                        dropZone.style.backgroundColor = '#fef2f2';
                        
                        const icon = dropZone.querySelector('svg');
                        const text = dropZone.querySelector('p');
                        if (icon) {
                            icon.classList.remove('text-gray-400');
                            icon.classList.add('text-red-400');
                        }
                        if (text) {
                            text.classList.remove('text-gray-700');
                            text.classList.add('text-red-600');
                        }
                    }

                    if (fileError) {
                        fileError.classList.remove('hidden');
                    }
                    if (fileErrorText) {
                        fileErrorText.textContent = 'Kolom ini wajib diisi';
                    }
                    return;
                }

                this.submit();
            });
        }

        initDatePicker('tunggal');
    });
</script>
@endpush







