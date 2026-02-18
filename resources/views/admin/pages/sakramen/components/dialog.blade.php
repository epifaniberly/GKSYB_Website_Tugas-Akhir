<div id="sakramenDialog" class="fixed inset-0 z-50 flex items-center justify-center backdrop-blur-sm bg-black/50 p-4" style="display:none;">
    <div class="bg-white rounded-2xl w-full max-w-4xl max-h-[95vh] flex flex-col shadow-2xl relative">
        <div class="px-8 py-5 border-b border-gray-100 flex justify-between items-center sticky top-0 bg-white z-20 rounded-t-2xl shrink-0">
            <div>
                <h2 id="modalTitle" class="text-xl font-semibold text-gray-800">Tambah Sakramen</h2>
                <p class="text-xs text-gray-400 mt-0.5">Lengkapi data sakramen di bawah ini</p>
            </div>
        </div>
        <form id="sakramenForm" method="POST" enctype="multipart/form-data" action="{{ route('admin.sakramen.store') }}" class="overflow-y-auto p-8 space-y-6 flex-1" novalidate>
            @csrf
            <div>
                <label class="block text-sm font-semibold text-gray-800 mb-2">Icon Sakramen <span class="text-red-500">*</span></label>
                <div class="flex items-start gap-6 p-4 bg-gray-50/50 rounded-xl border border-gray-100">
                    <div id="iconPreviewBox" class="w-24 h-24 bg-white border border-gray-200 rounded-xl flex items-center justify-center overflow-hidden shrink-0 relative group shadow-sm">
                        <img id="iconPreviewImg" src="" class="w-full h-full object-contain p-3 hidden">
                        <div id="iconPlaceholder" class="flex flex-col items-center justify-center text-gray-300">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                    </div>
                    <div class="flex-1 pt-1">
                        <button type="button" onclick="document.getElementById('iconInput').click()" 
                            class="flex flex-row items-center justify-center gap-2 bg-[#8C1007] hover:bg-[#8C1007] text-white rounded-lg py-2 px-5 transition-colors duration-150 shadow-sm focus:outline-none" 
                            style="background-color: #8C1007;">
                            <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="text-white">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                            </svg>
                            <span class="font-semibold text-sm">Pilih Icon</span>
                        </button>
                        <input type="file" id="iconInput" name="icon_sakramen" class="hidden" accept="image/*" onchange="previewIcon(this)">
                        
                        <div class="mt-2 space-y-0.5">
                            <p class="text-[10px] font-semibold text-gray-500">Unggah file icon sakramen</p>
                            <p class="text-[10px] text-gray-400">Format: PNG, SVG, JPG (Max 10MB)</p>
                        </div>
                        <p id="icon-error" class="hidden text-red-600 text-[10px] mt-1.5 flex items-center gap-1.5 font-medium">
                            <svg class="w-3 h-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            <span id="icon-error-text">Icon sakramen wajib diisi</span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-800 mb-1.5">Judul Sakramen <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <input id="judul_sakramen" type="text" name="judul_sakramen" required
                            class="w-full px-5 py-3 bg-[#FAFAFA] border border-gray-200 rounded-2xl focus:bg-white focus:border-gray-300 focus:ring-0 text-[12px] sm:text-sm font-medium transition-all outline-none placeholder:text-gray-400 text-gray-800" placeholder="Masukkan nama sakramen (contoh: Sakramen Baptis)">
                    </div>
                </div>
                <div>
                    <div class="flex justify-between items-center mb-1">
                         <div class="flex items-center gap-2">
                             <label class="block text-sm font-semibold text-gray-800">Deskripsi Singkat <span class="text-red-500">*</span></label>
                            <span class="text-xs text-gray-400 font-medium normal-case">(Maksimal 15 kata)</span>
                         </div>
                         <span id="wordCount" class="text-xs text-gray-400 font-medium tracking-wide">0/15 kata</span>
                    </div>
                    <div class="relative">
                        <textarea id="deskripsi_singkat" name="deskripsi_singkat" rows="3" required oninput="updateWordCount(this)"
                            class="w-full px-5 py-3 bg-[#FAFAFA] border border-gray-200 rounded-2xl focus:bg-white focus:border-gray-300 focus:ring-0 text-[12px] sm:text-sm font-medium transition-all outline-none resize-none placeholder:text-gray-400 text-gray-800 leading-relaxed" placeholder="Masukkan ringkasan singkat..."></textarea>
                    </div>
                    <p class="text-[10px] text-gray-400 mt-1.5 font-medium">Ditampilkan di card preview halaman Sakramen</p>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-800 mb-1.5">Deskripsi Lengkap <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <textarea id="deskripsi_lengkap" name="deskripsi_lengkap" rows="4" required
                            class="w-full px-5 py-3 bg-[#FAFAFA] border border-gray-200 rounded-2xl focus:bg-white focus:border-gray-300 focus:ring-0 text-[12px] sm:text-sm font-medium transition-all outline-none resize-none placeholder:text-gray-400 text-gray-800 leading-relaxed" placeholder="Masukkan deskripsi lengkap..."></textarea>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-800 mb-1.5">Kutipan Ayat <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <textarea id="kutipan_ayat" name="kutipan_ayat" rows="2" required
                                class="w-full px-5 py-3 bg-[#FAFAFA] border border-gray-200 rounded-2xl focus:bg-white focus:border-gray-300 focus:ring-0 text-[12px] sm:text-sm font-medium transition-all outline-none resize-none placeholder:text-gray-400 text-gray-800 leading-relaxed" placeholder='"Karena kita semua..."'></textarea>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-800 mb-1.5">Sumber Ayat <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <input id="sumber_ayat" type="text" name="sumber_ayat" required
                                class="w-full px-5 py-3 bg-[#FAFAFA] border border-gray-200 rounded-2xl focus:bg-white focus:border-gray-300 focus:ring-0 text-[12px] sm:text-sm font-medium transition-all outline-none placeholder:text-gray-400 text-gray-800" placeholder="Masukkan sumber ayat (contoh: 1 Korintus 12:13)">
                        </div>
                    </div>
                </div>
            </div>
            <div class="pt-2">
                <div class="flex justify-between items-end mb-3">
                    <div>
                        <label class="block text-sm font-semibold text-gray-800">Gambar Slide <span class="text-red-500">*</span></label>
                        <p class="text-gray-400 text-[10px] font-semibold mt-1">Maksimal 5 gambar untuk carousel</p>
                    </div>
                    <button type="button" onclick="addSlide()" id="btnAddSlide"
                        class="text-white text-[9px] font-semibold hover:opacity-90 transition-opacity focus:outline-none flex items-center gap-1.5 whitespace-nowrap shrink-0"
                        style="background:#8C1007 !important; border-radius: 0.5rem !important; padding: 6px 14px !important; display: inline-flex !important;">
                        <span>+ Tambah Gambar</span>
                        <span id="slideCounterText" class="opacity-90 font-medium">( 0/5 )</span>
                    </button>
                </div>
                <div id="slideWrapper" class="space-y-3">
                    <div id="emptySlideState" class="border border-dashed border-gray-300 rounded-xl bg-gray-50/50 p-6 flex flex-col items-center justify-center text-center">
                        <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-sm mb-2 border border-gray-100">
                            <svg class="w-5 h-5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                        <p class="text-xs text-gray-500 font-medium">Belum ada slide.</p>
                    </div>
                    <div id="slideContainer" class="grid gap-3 transition-all">
                    </div>
                </div>
                <p id="slide-error" class="hidden text-red-600 text-[10px] mt-1.5 flex items-center gap-1.5 font-medium">
                    <svg class="w-3 h-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    <span id="slide-error-text">Minimal 1 gambar slide harus ditambahkan</span>
                </p>
            </div>
        </form>
        <div class="px-6 py-4 border-t border-gray-100 flex justify-end items-center gap-3 shrink-0 rounded-b-2xl bg-white">
            <button type="button" onclick="modalHide()" 
                class="bg-white border border-gray-200 text-gray-700 text-[10px] font-semibold hover:bg-gray-50 transition-colors focus:outline-none"
                style="border-radius: 0.5rem !important; padding: 7px 20px !important; display: inline-block !important;">
                Batal
            </button>
            <button type="button" onclick="submitSakramenForm()" id="btnSubmitSakramen"
                class="text-white text-[10px] font-semibold hover:opacity-90 transition-opacity focus:outline-none"
                style="background:#8C1007 !important; border-radius: 0.5rem !important; padding: 7px 20px !important; display: inline-block !important;">
                Simpan Sakramen
            </button>
        </div>
    </div>
</div>
<div id="detailDialog" class="fixed inset-0 z-50 flex items-center justify-center backdrop-blur-sm bg-black/50 p-4" style="display:none;">
    <div class="bg-white rounded-2xl w-full max-w-2xl max-h-[92vh] flex flex-col shadow-2xl relative overflow-hidden">
        <div class="p-6 border-b border-gray-100 shrink-0 relative flex items-center gap-4">
            <div id="detailIconBox" class="w-14 h-14 bg-gray-50 border border-gray-100 rounded-xl flex items-center justify-center overflow-hidden shrink-0">
            </div>
            <div class="flex-1">
                <h2 id="detailTitle" class="text-xl font-semibold text-gray-900 leading-tight">Detail Sakramen</h2>
                <p class="text-sm text-gray-400 mt-0.5 font-medium">Informasi lengkap sakramen</p>
            </div>
            <button type="button" onclick="detailHide()" class="p-2 rounded-xl text-gray-400 hover:bg-gray-50 hover:text-red-500 transition-colors focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <div id="detailScrollableContent" class="overflow-y-auto p-8 space-y-8 flex-1">
            <div class="space-y-2">
                <label class="block text-sm font-semibold text-gray-800 mb-2">Deskripsi Singkat</label>
                <p id="detailSingkat" class="text-gray-600 leading-relaxed whitespace-pre-line font-light text-sm">---</p>
            </div>
            <div class="space-y-2">
                <label class="block text-sm font-semibold text-gray-800 mb-2">Deskripsi Lengkap</label>
                <div id="detailLengkap" class="text-gray-600 leading-relaxed whitespace-pre-line font-light text-sm">---</div>
            </div>
            <div class="space-y-4">
                <label class="block text-sm font-semibold text-gray-800 mb-2">Galeri Gambar</label>
                <div id="detailGallery" class="grid grid-cols-2 md:grid-cols-3 gap-3 mt-4">
                </div>
                <div id="detailGalleryEmpty" class="hidden border-2 border-dashed border-gray-100 rounded-2xl p-10 flex flex-col items-center justify-center bg-gray-50/50">
                    <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center shadow-sm mb-3">
                        <svg class="w-6 h-6 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <p class="text-xs text-gray-400 font-semibold">Belum ada gambar untuk sakramen ini</p>
                </div>
            </div>
        </div>
    </div>
</div>

@push('script')
<script>
    let slideIndex = 0;

    function updateWordCount(input) {
        const maxWords = 15;
        let words = input.value.trim().split(/\s+/).filter(word => word.length > 0);
        
        if (words.length > maxWords) {
            input.value = words.slice(0, maxWords).join(" ");
            words = input.value.trim().split(/\s+/).filter(word => word.length > 0);
        }
        
        const count = words.length;
        const counterEl = document.getElementById('wordCount');
        if(counterEl) {
            counterEl.innerText = `${count}/${maxWords} kata`;
            if (count >= maxWords) {
                counterEl.classList.add('text-red-500');
                counterEl.classList.remove('text-gray-400');
            } else {
                counterEl.classList.remove('text-red-500');
                counterEl.classList.add('text-gray-400');
            }
        }
    }

    function updateEmptyState() {
        const container = document.getElementById('slideContainer');
        const emptyState = document.getElementById('emptySlideState');
        const items = container.querySelectorAll('.slide-item');
        const count = items.length;
        
        const counterEl = document.getElementById('slideCounterText');
        if (counterEl) {
            counterEl.innerText = `( ${count}/5 )`;
        }
        
        if (count === 0) {
            emptyState.classList.remove('hidden');
            container.classList.add('hidden');
        } else {
            emptyState.classList.add('hidden');
            container.classList.remove('hidden');
            
            if (emptyState) {
                emptyState.style.borderColor = '';
                emptyState.style.borderWidth = '';
                emptyState.style.backgroundColor = '';
                const icon = emptyState.querySelector('svg');
                const text = emptyState.querySelector('p');
                if (icon) icon.classList.remove('text-red-400');
                if (text) text.classList.remove('text-red-600');
            }
            const slideError = document.getElementById('slide-error');
            if (slideError) slideError.classList.add('hidden');
        }

        const btn = document.getElementById('btnAddSlide');
        if (btn) {
            if (count >= 5) {
                btn.classList.add('opacity-50', 'pointer-events-none');
            } else {
                btn.classList.remove('opacity-50', 'pointer-events-none');
            }
        }
    }

    function previewIcon(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('iconPreviewImg').src = e.target.result;
                document.getElementById('iconPreviewImg').classList.remove('hidden');
                document.getElementById('iconPlaceholder').classList.add('hidden');
                
                const iconPreviewBox = document.getElementById('iconPreviewBox');
                const iconError = document.getElementById('icon-error');
                if (iconPreviewBox) {
                    iconPreviewBox.style.borderColor = '';
                    iconPreviewBox.style.borderWidth = '';
                    iconPreviewBox.style.backgroundColor = '';
                    const iconPlaceholder = document.getElementById('iconPlaceholder');
                    if (iconPlaceholder) {
                        const iconSvg = iconPlaceholder.querySelector('svg');
                        if (iconSvg) iconSvg.classList.remove('text-red-400');
                    }
                }
                if (iconError) iconError.classList.add('hidden');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function previewSlide(input) {
        const parent = input.closest('.slide-item');
        const img = parent.querySelector('.slide-preview-img');
        const placeholder = parent.querySelector('.slide-placeholder');

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                img.src = e.target.result;
                img.classList.remove('hidden');
                if (placeholder) placeholder.classList.add('hidden');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function ensureArray(input) {
        if (!input) return [];
        if (Array.isArray(input)) return input;
        if (typeof input === 'string') {
            try {
                let parsed = JSON.parse(input);
                return ensureArray(parsed);
            } catch (e) {
                return [];
            }
        }
        return [];
    }

    function resetForm() {
        const form = document.getElementById('sakramenForm');
        form.reset();
        
        const methodField = form.querySelector('input[name="_method"]');
        if (methodField) methodField.remove();
        
        document.getElementById('iconInput').value = '';
        document.getElementById('iconPreviewImg').src = '';
        document.getElementById('iconPreviewImg').classList.add('hidden');
        document.getElementById('iconPlaceholder').classList.remove('hidden');
        
        const iconPreviewBox = document.getElementById('iconPreviewBox');
        const iconError = document.getElementById('icon-error');
        if (iconPreviewBox) {
            iconPreviewBox.style.borderColor = '';
            iconPreviewBox.style.borderWidth = '';
            iconPreviewBox.style.backgroundColor = '';
            const iconPlaceholder = document.getElementById('iconPlaceholder');
            if (iconPlaceholder) {
                const iconSvg = iconPlaceholder.querySelector('svg');
                if (iconSvg) iconSvg.classList.remove('text-red-400');
            }
        }
        if (iconError) iconError.classList.add('hidden');

        document.getElementById('slideContainer').innerHTML = '';
        updateEmptyState();
        slideIndex = 0;
        
        const emptySlideState = document.getElementById('emptySlideState');
        const slideError = document.getElementById('slide-error');
        if (emptySlideState) {
            emptySlideState.style.borderColor = '';
            emptySlideState.style.borderWidth = '';
            emptySlideState.style.backgroundColor = '';
            const icon = emptySlideState.querySelector('svg');
            const text = emptySlideState.querySelector('p');
            if (icon) icon.classList.remove('text-red-400');
            if (text) text.classList.remove('text-red-600');
        }
        if (slideError) slideError.classList.add('hidden');

        const counterEl = document.getElementById('wordCount');
        if (counterEl) {
            counterEl.innerText = '0/15 kata';
            counterEl.classList.remove('text-red-500', 'font-bold');
            counterEl.classList.add('text-gray-400');
        }

        const validator = new FormValidator('sakramenForm');
        validator.clearErrors();
    }

    function addSlide(existingData = null) {
        const container = document.getElementById('slideContainer');
        if (container.querySelectorAll('.slide-item').length >= 5) return;

        slideIndex++;
        const currentId = slideIndex;
        
        const captionValue = existingData ? (existingData.caption || '') : '';
        const fileSrc = existingData ? `/storage/${existingData.file}` : '';
        const showImgClass = existingData && existingData.file ? '' : 'hidden';
        const hidePlaceholderClass = existingData && existingData.file ? 'hidden' : '';

        const html = `
            <div class="slide-item flex items-center gap-6 p-4 bg-white border border-gray-100 rounded-[1.5rem] relative group transition-all hover:border-[#8C1007] hover:shadow-md">
                <input type="text" id="slideChecker_${currentId}" value="${existingData && existingData.file ? 'active' : ''}" 
                    class="peer absolute opacity-0 pointer-events-none w-px h-px" 
                    required readonly>
                <div class="w-24 h-24 bg-gray-50 rounded-2xl overflow-hidden border border-gray-100 flex-shrink-0 cursor-pointer relative group/img shadow-inner transition-all peer-[.border-red-500]:border-red-500 peer-[.border-red-500]:bg-red-50" 
                    onclick="document.getElementById('slideFile_${currentId}').click()">
                    <img src="${fileSrc}" class="slide-preview-img w-full h-full object-cover ${showImgClass}">
                    <div class="slide-placeholder absolute inset-0 flex flex-col items-center justify-center text-gray-300 ${hidePlaceholderClass} group-hover/img:text-gray-400 transition-colors peer-[.border-red-500]:text-red-400">
                         <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                </div>
                <input type="file" id="slideFile_${currentId}" name="slides[${currentId}][file]" class="hidden" accept="image/*" 
                    onchange="previewSlide(this); document.getElementById('slideChecker_${currentId}').value = this.value ? 'active' : ''">
                <div class="flex-1 min-w-0 py-1">
                     <div class="space-y-1.5">
                        <label class="block text-gray-800 text-sm font-semibold">Caption <span class="text-red-500">*</span></label>
                        <input type="text" name="slides[${currentId}][caption]" value="${captionValue}" required
                            class="w-full px-5 py-3 bg-[#FAFAFA] border border-gray-200 rounded-2xl focus:bg-white focus:border-gray-300 focus:ring-0 text-[12px] sm:text-sm font-medium transition-all outline-none placeholder:text-gray-400 text-gray-800" placeholder="Masukkan keterangan gambar...">
                     </div>
                     <p class="text-[11px] text-gray-400 mt-2 font-medium">Klik kotak gambar di kiri untuk ${existingData ? 'mengganti' : 'mengunggah'} foto.</p>
                     ${existingData && existingData.file ? `<input type="hidden" name="existing_slides[${currentId}]" value="${existingData.file}">` : ''}
                </div>
                <button type="button" onclick="removeSlide(this)" 
                    class="p-2 hover:opacity-70 transition-all focus:outline-none shrink-0"
                    style="color: #ef4444 !important;">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                </button>
            </div>
        `;
        
        container.insertAdjacentHTML('beforeend', html);
        updateEmptyState();
    }

    function removeSlide(btn) {
        btn.closest('.slide-item').remove();
        updateEmptyState();
        
        const slideItems = document.querySelectorAll('.slide-item');
        if (slideItems.length === 0) {
            const emptySlideState = document.getElementById('emptySlideState');
            const slideError = document.getElementById('slide-error');
            if (emptySlideState) {
                emptySlideState.style.borderColor = '#ef4444';
                emptySlideState.style.borderWidth = '2px';
                emptySlideState.style.backgroundColor = '#fef2f2';
                const icon = emptySlideState.querySelector('svg');
                const text = emptySlideState.querySelector('p');
                if (icon) icon.classList.add('text-red-400');
                if (text) text.classList.add('text-red-600');
            }
            if (slideError) slideError.classList.remove('hidden');
        }
    }

    function openAddDialog() {
        resetForm();
        document.getElementById('modalTitle').innerText = 'Tambah Sakramen';
        document.getElementById('btnSubmitSakramen').innerText = 'Simpan Sakramen';
        document.getElementById('sakramenForm').action = "{{ route('admin.sakramen.store') }}";
        
        modalShow();
    }

    function openEditDialog(id) {
        try {
            const data = window.sakramenMap[id];
            if (!data) return;

            resetForm();
            document.getElementById('modalTitle').innerText = 'Edit Sakramen';
            document.getElementById('btnSubmitSakramen').innerText = 'Simpan Perubahan';
            
            const form = document.getElementById('sakramenForm');
            form.action = `/admin-sakramen/update/${data.id}`;
            
            document.getElementById('judul_sakramen').value = data.judul_sakramen || '';
            document.getElementById('deskripsi_singkat').value = data.deskripsi_singkat || '';
            document.getElementById('deskripsi_lengkap').value = data.deskripsi_lengkap || '';
            document.getElementById('kutipan_ayat').value = data.kutipan_ayat || '';
            document.getElementById('sumber_ayat').value = data.sumber_ayat || '';
            
            if (data.icon_sakramen) {
                document.getElementById('iconPreviewImg').src = `/storage/${data.icon_sakramen}`;
                document.getElementById('iconPreviewImg').classList.remove('hidden');
                document.getElementById('iconPlaceholder').classList.add('hidden');
            }

            const slides = ensureArray(data.gambar_slide);
            slides.forEach(s => addSlide(s));

            modalShow();
        } catch (err) {
            console.error("Error opening edit dialog:", err);
            SwalHelper.error('Error', 'Gagal membuka jendela edit. Data mungkin rusak.');
        }
    }

    function modalShow() {
        const dialog = document.getElementById('sakramenDialog');
        if (dialog) {
            dialog.style.display = 'flex';
            document.body.style.overflow = 'hidden';
        }
    }

    function modalHide() {
        const dialog = document.getElementById('sakramenDialog');
        if (dialog) {
            dialog.style.display = 'none';
            document.body.style.overflow = 'auto';
        }
    }

    function detailHide() {
        const dialog = document.getElementById('detailDialog');
        if (dialog) {
            dialog.style.display = 'none';
            document.body.style.overflow = 'auto';
        }
    }

    function openDetailDialog(id) {
        try {
            const data = window.sakramenMap[id];
            if (!data) return;

            document.getElementById('detailTitle').innerText = data.judul_sakramen || 'Detail Sakramen';
            document.getElementById('detailSingkat').innerText = data.deskripsi_singkat || '-';
            document.getElementById('detailLengkap').innerText = data.deskripsi_lengkap || 'Tidak ada deskripsi lengkap.';
            const iconBox = document.getElementById('detailIconBox');
            if (data.icon_sakramen) {
                iconBox.innerHTML = `<img src="/storage/${data.icon_sakramen}" class="w-10 h-10 object-contain">`;
            } else {
                iconBox.innerHTML = `<svg class="w-8 h-8 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="4" fill="#F9FAFB"/><path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" stroke="#E5E7EB" stroke-width="1.5"/></svg>`;
            }

            const gallery = document.getElementById('detailGallery');
            const emptyState = document.getElementById('detailGalleryEmpty');
            gallery.innerHTML = '';
            
            const slides = ensureArray(data.gambar_slide);

            if (slides.length > 0) {
                gallery.classList.remove('hidden');
                emptyState.classList.add('hidden');
                slides.forEach(s => {
                    const imgHtml = `
                        <div class="group relative aspect-square bg-gray-50 rounded-2xl overflow-hidden border border-gray-100">
                            <img src="/storage/${s.file}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                            ${s.caption ? `<div class="absolute inset-x-0 bottom-0 p-3 bg-gradient-to-t from-black/60 to-transparent">
                                <p class="text-[10px] text-white font-medium line-clamp-1">${s.caption}</p>
                            </div>` : ''}
                        </div>
                    `;
                    gallery.insertAdjacentHTML('beforeend', imgHtml);
                });
            } else {
                gallery.classList.add('hidden');
                emptyState.classList.remove('hidden');
            }

            document.getElementById('detailDialog').style.display = 'flex';
            document.body.style.overflow = 'hidden';
        } catch (err) {
            console.error("Error opening detail dialog:", err);
            SwalHelper.error('Error', 'Gagal membuka detail. Data mungkin rusak.');
        }
    }

    function hapusSakramen(id) {
        SwalHelper.confirmDelete('data sakramen ini').then((result) => {
            if (result.isConfirmed) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `/admin-sakramen/delete/${id}`;
                form.innerHTML = `@csrf<input type="hidden" name="_method" value="DELETE">`;
                document.body.appendChild(form);
                form.submit();
            }
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        const sakramenForm = document.getElementById('sakramenForm');
        if (!sakramenForm) return;

        const validator = new FormValidator('sakramenForm');
        
        validator.addValidation('judul_sakramen', ['required']);
        validator.addValidation('deskripsi_singkat', ['required']);
        validator.addValidation('deskripsi_lengkap', ['required']);
        validator.addValidation('kutipan_ayat', ['required']);
        validator.addValidation('sumber_ayat', ['required']);
        
        validator.init();

        const iconInput = document.getElementById('iconInput');
        if (iconInput) {
            iconInput.addEventListener('blur', function() {
                const isEditMode = sakramenForm.action.includes('/update/');
                const iconPreviewImg = document.getElementById('iconPreviewImg');
                const hasNewIcon = iconInput.files && iconInput.files.length > 0;
                
                if (!isEditMode && !hasNewIcon) {
                    const iconPreviewBox = document.getElementById('iconPreviewBox');
                    const iconError = document.getElementById('icon-error');
                    if (iconPreviewBox) {
                        iconPreviewBox.style.borderColor = '#ef4444';
                        iconPreviewBox.style.borderWidth = '2px';
                        iconPreviewBox.style.backgroundColor = '#fef2f2';
                        const iconPlaceholder = document.getElementById('iconPlaceholder');
                        if (iconPlaceholder) {
                            const iconSvg = iconPlaceholder.querySelector('svg');
                            if (iconSvg) iconSvg.classList.add('text-red-400');
                        }
                    }
                    if (iconError) iconError.classList.remove('hidden');
                }
            });
        }

        sakramenForm.addEventListener('input', function(e) {
            if (e.target.name && e.target.name.includes('caption')) {
                if (e.target.value.trim() !== '') {
                    e.target.classList.remove('border-red-500', 'bg-red-50');
                }
            }
        });

    }); 

    function submitSakramenForm() {
        const sakramenForm = document.getElementById('sakramenForm');
        if (!sakramenForm) return;

        const validator = new FormValidator('sakramenForm');
        
        validator.addValidation('judul_sakramen', ['required']);
        validator.addValidation('deskripsi_singkat', ['required']);
        validator.addValidation('deskripsi_lengkap', ['required']);
        validator.addValidation('kutipan_ayat', ['required']);
        validator.addValidation('sumber_ayat', ['required']);

        if (!validator.validateForm()) {
            return;
        }
        
        const deskripsiSingkatInput = document.getElementById('deskripsi_singkat');
        const deskripsiSingkat = deskripsiSingkatInput.value.trim();
        const words = deskripsiSingkat.split(/\s+/).filter(word => word.length > 0);
        const wordCountDisplay = document.getElementById('wordCount');
        
        if (words.length > 15) {
            wordCountDisplay.classList.remove('text-gray-400');
            wordCountDisplay.classList.add('text-red-500', 'font-bold');
            deskripsiSingkatInput.focus();
            return;
        }
        
        const iconInput = document.getElementById('iconInput');
        const iconPreviewImg = document.getElementById('iconPreviewImg');
        const iconPreviewBox = document.getElementById('iconPreviewBox');
        const iconError = document.getElementById('icon-error');
        const isEditMode = sakramenForm.action.includes('/update/');
        const hasExistingIcon = !iconPreviewImg.classList.contains('hidden') && iconPreviewImg.src;
        const hasNewIcon = iconInput.files && iconInput.files.length > 0;
        
        if (!isEditMode && !hasNewIcon) {
            if (iconPreviewBox) {
                iconPreviewBox.style.borderColor = '#ef4444';
                iconPreviewBox.style.borderWidth = '2px';
                iconPreviewBox.style.backgroundColor = '#fef2f2';
                const iconPlaceholder = document.getElementById('iconPlaceholder');
                if (iconPlaceholder) {
                    const iconSvg = iconPlaceholder.querySelector('svg');
                    if (iconSvg) iconSvg.classList.add('text-red-400');
                }
            }
            if (iconError) iconError.classList.remove('hidden');
            return;
        }
        
        const slideItems = document.querySelectorAll('.slide-item');
        const emptySlideState = document.getElementById('emptySlideState');
        const slideError = document.getElementById('slide-error');
        
        if (slideItems.length === 0) {
            if (emptySlideState) {
                emptySlideState.style.borderColor = '#ef4444';
                emptySlideState.style.borderWidth = '2px';
                emptySlideState.style.backgroundColor = '#fef2f2';
                const icon = emptySlideState.querySelector('svg');
                const text = emptySlideState.querySelector('p');
                if (icon) icon.classList.add('text-red-400');
                if (text) icon.classList.add('text-red-600');
            }
            if (slideError) slideError.classList.remove('hidden');
            return;
        }
        
        let allCaptionsFilled = true;
        slideItems.forEach((item, index) => {
            const captionInput = item.querySelector('input[type="text"]');
            if (!captionInput || !captionInput.value.trim()) {
                allCaptionsFilled = false;
                captionInput.classList.add('border-red-500', 'bg-red-50');
                captionInput.focus();
            } else {
                captionInput.classList.remove('border-red-500', 'bg-red-50');
            }
        });
        
        if (!allCaptionsFilled) return;
        
        if (isEditMode) {
            SwalHelper.confirmEdit('Sakramen').then((result) => {
                if (result.isConfirmed) {
                    sakramenForm.submit();
                }
            });
        } else {
            sakramenForm.submit();
        }
    }


</script>
@endpush




