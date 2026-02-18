<form id="formTambah" action="{{ route('admin.dokparoki.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6 fs-style-manrope" novalidate>
    @csrf
    
    <div class="space-y-4">
        <div>
            <label for="judul_dokumen" class="block text-sm font-semibold text-gray-800 mb-2">Judul Dokumen <span class="text-red-500">*</span></label>
            <input type="text" name="judul_dokumen" id="judul_dokumen" required
                   class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-[#8C1007] focus:ring-1 focus:ring-[#8C1007] text-sm transition-colors outline-none" 
                   placeholder="Masukkan judul dokumen (contoh: Jadwal Misa Pekan Ini)">
        </div>
        <div>
            <label for="kategori_id" class="block text-sm font-semibold text-gray-800 mb-2">Kategori <span class="text-red-500">*</span></label>
            <div class="relative">
                <select name="kategori_id" id="kategori_id" required
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-[#8C1007] focus:ring-1 focus:ring-[#8C1007] text-sm transition-colors outline-none appearance-none cursor-pointer">
                    <option value="" disabled selected hidden>Pilih Kategori</option>
                    @foreach($kategori as $k)
                        <option value="{{ $k->id }}">{{ $k->nama_kategori }}</option>
                    @endforeach
                </select>
                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-gray-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </div>
            </div>
        </div>
        <div>
            <div class="flex justify-between items-center mb-2">
                <label for="keterangan" class="block text-sm font-semibold text-gray-800">Keterangan <span class="text-red-500">*</span> <span class="text-[10px] text-gray-400 font-normal">(Maksimal 20 kata)</span></label>
                <span id="word-count-display" class="text-[10px] text-gray-400 font-medium tracking-wide">0/20 kata</span>
            </div>
            <textarea name="keterangan" id="keterangan" rows="3" required
                      class="w-full p-4 rounded-lg border border-gray-300 focus:border-[#8C1007] focus:ring-1 focus:ring-[#8C1007] text-sm transition-colors outline-none resize-none" 
                      placeholder="Masukkan keterangan dokumen..."></textarea>
            <p id="word-count-error" class="text-red-600 text-[10px] font-semibold mt-1.5 hidden">Keterangan melebihi 20 kata!</p>
        </div>
        <div class="space-y-3">
            <label for="fileInput" class="block text-gray-700 text-sm font-semibold">Upload Dokumen Paroki <span class="text-red-500">*</span></label>
            
            <div class="relative group">
                <div id="dropZone" class="border-2 border-dashed border-gray-200 rounded-2xl py-12 px-6 flex flex-col items-center justify-center bg-gray-50/30 group-hover:border-[#8C1007] group-hover:bg-[#FFF3F2]/30 transition-all min-h-[160px] relative overflow-hidden">
                    
                    <input type="file" name="file" id="fileInput" accept=".pdf,.doc,.docx,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document" onchange="previewPDF(this)"
                        class="opacity-0 absolute inset-0 w-full h-full cursor-pointer z-20" required>
                    
                    <div id="uploadPlaceholder" class="flex flex-col items-center text-center z-10 transition-all duration-300">
                        <div class="w-12 h-12 bg-white rounded-xl shadow-sm border border-gray-100 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-7 h-7 text-gray-400 group-hover:text-[#8C1007] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <p class="text-sm font-medium text-gray-700 mb-1">Klik untuk upload file atau drag & drop</p>
                        <p class="text-[11px] text-gray-400">PDF atau Word (Maks. 50MB)</p>
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
                </div>
            </div>
            <p id="file-error" class="hidden text-red-600 text-xs mt-1.5 flex items-center gap-1.5">
                <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                </svg>
                <span id="file-error-text">Kolom ini wajib diisi</span>
            </p>
        </div>
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-3">Status Publikasi</label>
            <div class="flex items-center gap-6">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="radio" name="is_active" value="0" class="w-4 h-4 text-[#8C1007] focus:ring-[#8C1007] border-gray-300">
                    <span class="text-sm text-gray-700">Simpan sebagai Draft</span>
                </label>
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="radio" name="is_active" value="1" checked class="w-4 h-4 text-[#8C1007] focus:ring-[#8C1007] border-gray-300">
                    <span class="text-sm text-gray-700">Publikasikan</span>
                </label>
            </div>
        </div>
    </div>
    <div class="flex items-center gap-3 pt-6 border-t border-gray-100 mt-8 mb-6 text-sm">
        <button type="submit" 
                class="text-white text-[12px] font-medium hover:opacity-90 transition-opacity focus:outline-none"
                style="background:#8C1007 !important; border-radius: 0.5rem !important; padding: 10px 32px !important; display: inline-block !important;">
            Simpan Dokumen
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
    const formTambah = document.getElementById('formTambah');
    const fileInput = document.getElementById('fileInput');
    const previewContainer = document.getElementById('previewContainer');
    const fileNameDisplay = document.getElementById('fileName');
    const fileSizeDisplay = document.getElementById('fileSize');
    const dropZone = document.getElementById('dropZone');
    const keteranganInput = document.getElementById('keterangan');
    const wordCountDisplay = document.getElementById('word-count-display');
    const wordCountError = document.getElementById('word-count-error');

    keteranganInput.addEventListener('input', function() {
        const words = this.value.trim().split(/\s+/).filter(word => word.length > 0);
        
        if (words.length > 20) {
            const truncatedValue = this.value.split(/\s+/).slice(0, 20).join(' ');
            this.value = truncatedValue;
            
            const finalWords = this.value.trim().split(/\s+/).filter(word => word.length > 0);
            wordCountDisplay.textContent = `${finalWords.length}/20 kata`;
            wordCountDisplay.classList.add('text-[#8C1007]', 'font-bold');
            wordCountError.classList.remove('hidden');
        } else {
            wordCountDisplay.textContent = `${words.length}/20 kata`;
            wordCountDisplay.classList.remove('text-[#8C1007]', 'font-bold');
            wordCountDisplay.classList.add('text-gray-400');
            wordCountError.classList.add('hidden');
        }
    });

    function previewPDF(input) {
        const file = input.files[0];
        const placeholder = document.getElementById('uploadPlaceholder');
        const dropZone = document.getElementById('dropZone');
        const fileError = document.getElementById('file-error');
        const fileErrorText = document.getElementById('file-error-text');

        if (!file) {
            removeFile();
            return;
        }

        const allowedTypes = [
            'application/pdf',
            'application/msword',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
        ];

        const allowedExtensions = ['pdf', 'doc', 'docx'];
        const fileExtension = file.name.split('.').pop().toLowerCase();

        if (!allowedTypes.includes(file.type) && !allowedExtensions.includes(fileExtension)) {
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
            
            fileError.classList.remove('hidden');
            fileErrorText.textContent = 'Hanya file PDF dan Word yang diperbolehkan.';
            
            input.value = '';
            removeFile();
            return;
        }

        if (file.size > 50 * 1024 * 1024) {
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
            
            fileError.classList.remove('hidden');
            fileErrorText.textContent = 'Ukuran file maksimal 50MB.';
            
            input.value = '';
            removeFile();
            return;
        }

        fileNameDisplay.textContent = file.name;
        fileSizeDisplay.textContent = (file.size / 1024 / 1024).toFixed(2) + ' MB';
        previewContainer.classList.remove('hidden');
        if (placeholder) placeholder.classList.add('hidden');
        
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
        
        fileError.classList.add('hidden');
    }

    function removeFile() {
        const placeholder = document.getElementById('uploadPlaceholder');
        const dropZone = document.getElementById('dropZone');
        const fileError = document.getElementById('file-error');
        
        fileInput.value = '';
        previewContainer.classList.add('hidden');
        if (placeholder) placeholder.classList.remove('hidden');
        
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
        
        fileError.classList.add('hidden');
    }

    function resetFormTambah() {
        formTambah.reset();
        removeFile();
        wordCountDisplay.textContent = '0/20 kata';
        wordCountDisplay.classList.remove('text-red-500', 'font-bold');
        wordCountDisplay.classList.add('text-gray-400');
        wordCountError.classList.add('hidden');
    }

    document.addEventListener('DOMContentLoaded', function() {
        const validator = new FormValidator('formTambah');
        
        validator.addValidation('judul_dokumen', [
            'required',
            validator.rules.minLength(5),
            validator.rules.maxLength(100)
        ]);
        
        validator.addValidation('kategori_id', ['required']);
        validator.addValidation('keterangan', ['required']);
        
        validator.init();
    });

    formTambah.addEventListener('submit', function(e) {
        e.preventDefault();

        const validator = new FormValidator('formTambah');
        if (!validator.validateForm()) {
            return;
        }
        const judulDokumen = document.getElementById('judul_dokumen').value.trim();
        const kategori = document.getElementById('kategori_id').value;
        const keterangan = keteranganInput.value.trim();
        const file = fileInput.files[0];
        const words = keterangan.split(/\s+/).filter(word => word.length > 0);
        if (words.length > 20) {
            wordCountError.classList.remove('hidden');
            wordCountError.textContent = `Keterangan melebihi 20 kata! (Saat ini: ${words.length} kata)`;
            keteranganInput.focus();
            return;
        }

        if (!file) {
            const dropZone = document.getElementById('dropZone');
            const fileError = document.getElementById('file-error');
            const fileErrorText = document.getElementById('file-error-text');
            
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
            
            fileError.classList.remove('hidden');
            fileErrorText.textContent = 'Kolom ini wajib diisi';
            
            fileInput.focus();
            return;
        }

        this.submit();
    });
</script>






