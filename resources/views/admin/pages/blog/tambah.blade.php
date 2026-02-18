
<div class="fs-style-manrope">
    <form id="formTulisanBintaran" action="{{ route('admin.blog.store') }}" method="POST" enctype="multipart/form-data" novalidate>
            @csrf

            <div class="space-y-6">
                <div>
                    <div class="flex justify-between items-center mb-2">
                        <label for="judul_tulisan" class="block text-sm font-semibold text-gray-800">Judul Tulisan <span class="text-red-500">*</span></label>
                        <span id="judulCounter" class="text-xs text-gray-400 font-medium">0/100</span>
                    </div>
                    <input
                        type="text"
                        name="judul_tulisan"
                        id="judul_tulisan"
                        placeholder="Masukkan judul tulisan"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-[#8C1007] focus:ring-1 focus:ring-[#8C1007] text-sm transition-colors outline-none"
                        required
                        maxlength="100"
                        oninput="updateCharCount('judul_tulisan', 'judulCounter', 100)"
                    />
                    @error('judul_tulisan')
                        <p class="text-red-600 text-xs mt-2 font-medium">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="kategori_bintaran_id" class="block text-sm font-semibold text-gray-800 mb-2">Kategori <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <select
                            name="kategori_bintaran_id"
                            id="kategori_bintaran_id"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-[#8C1007] focus:ring-1 focus:ring-[#8C1007] text-sm transition-colors appearance-none bg-white outline-none"
                            required
                        >
                            <option value="" disabled selected hidden>Pilih kategori</option>
                            @foreach ($kategori as $k)
                                <option value="{{ $k->id }}">
                                    {{ $k->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </div>
                    @error('kategori_bintaran_id')
                        <p class="text-red-600 text-xs mt-2 font-medium">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <div class="flex justify-between items-center mb-2">
                        <label for="ringkasan" class="block text-sm font-semibold text-gray-800">Ringkasan <span class="text-red-500">*</span></label>
                        <span id="ringkasanCounter" class="text-xs text-gray-400 font-medium">0/255</span>
                    </div>
                    <textarea
                        name="ringkasan"
                        id="ringkasan"
                        placeholder="Masukkan ringkasan singkat..."
                        rows="3"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-[#8C1007] focus:ring-1 focus:ring-[#8C1007] text-sm transition-colors outline-none"
                        required
                        minlength="50"
                        maxlength="255"
                        oninput="updateCharCount('ringkasan', 'ringkasanCounter', 255)"
                    ></textarea>
                    @error('ringkasan')
                        <p class="text-red-600 text-xs mt-2 font-medium">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <div class="flex justify-between items-center mb-2">
                       <label for="konten" class="block text-sm font-semibold text-gray-800">Konten <span class="text-red-500">*</span></label>
                       <span id="kontenCounter" class="text-xs text-gray-400 font-medium">0 karakter</span>
                    </div>
                    <textarea
                        name="konten"
                        id="konten"
                        placeholder="Masukkan seluruh isi konten tulisan di sini..."
                        rows="8"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-[#8C1007] focus:ring-1 focus:ring-[#8C1007] text-sm transition-colors outline-none"
                        required
                        minlength="300"
                        oninput="updateCharCount('konten', 'kontenCounter', null)"
                    ></textarea>
                    @error('konten')
                        <p class="text-red-600 text-xs mt-2 font-medium">{{ $message }}</p>
                    @enderror
                </div>
                 <div class="pt-2">
                    <div class="flex justify-between items-end mb-3">
                        <div>
                            <label class="block text-sm font-semibold text-gray-800">Galeri Gambar <span class="text-red-500">*</span></label>
                            <p class="text-gray-400 text-[10px] font-semibold mt-1">Maksimal 5 gambar untuk galeri</p>
                        </div>
                        <button type="button" onclick="addBintaranImage()" id="btnAddImage"
                            class="text-white text-[9px] font-medium hover:opacity-90 transition-opacity focus:outline-none flex items-center gap-1.5 whitespace-nowrap shrink-0"
                            style="background:#8C1007 !important; border-radius: 0.5rem !important; padding: 6px 14px !important; display: inline-flex !important;">
                            <span>+ Tambah Gambar</span>
                            <span id="imageCounterText" class="opacity-90 font-medium">( 0/5 )</span>
                        </button>
                    </div>
                    <div id="imageWrapper" class="space-y-3">
                        <div id="emptyImageState" class="border border-dashed border-gray-300 rounded-xl bg-gray-50/50 p-6 flex flex-col items-center justify-center text-center">
                            <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-sm mb-2 border border-gray-100">
                                <svg class="w-5 h-5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                            <p class="text-xs text-gray-500 font-medium">Belum ada gambar.</p>
                        </div>
                        <div id="imageContainer" class="grid gap-3 transition-all">
                        </div>
                    </div>
                </div>

                <script>
                    let bintaranImageIndex = 0;
                    const maxImages = 5;

                    function addBintaranImage() {
                        if (bintaranImageIndex >= maxImages) {
                            alert('Maksimal 5 gambar');
                            return;
                        }

                        const id = Date.now();
                        const container = document.getElementById('imageContainer');
                        
                        const html = `
                            <div class="image-item flex items-center gap-4 p-4 bg-white border border-gray-100 rounded-[1.25rem] relative group transition-all hover:border-[#8C1007] hover:shadow-md box-border overflow-hidden">
                                
                                <input type="text" id="galleryChecker_${id}" value="" 
                                    class="peer absolute opacity-0 pointer-events-none w-px h-px" 
                                    required readonly>

                                <div class="w-24 h-24 bg-gray-50 rounded-2xl overflow-hidden border border-gray-100 flex-shrink-0 cursor-pointer relative group/img shadow-inner transition-all peer-[.border-red-500]:border-red-500 peer-[.border-red-500]:bg-red-50" 
                                    onclick="document.getElementById('imageFile_${id}').click()">
                                    <img src="" class="item-preview-img w-full h-full object-cover hidden">
                                    <div class="item-placeholder absolute inset-0 flex flex-col items-center justify-center text-gray-300 group-hover/img:text-gray-400 transition-colors peer-[.border-red-500]:text-red-400">
                                         <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    </div>
                                </div>
                                <input type="file" id="imageFile_${id}" name="images[]" class="hidden" accept="image/*" 
                                    onchange="previewBintaranImage(this); document.getElementById('galleryChecker_${id}').value = this.value ? 'active' : ''" required>
                                
                                <div class="flex-1 min-w-0 py-1">
                                     <div class="space-y-1.5">
                                        <label class="block text-gray-800 text-sm font-semibold">Caption <span class="mandatory-star">*</span></label>
                                        <input type="text" name="captions[]" placeholder="Masukkan keterangan gambar..." required
                                            class="w-full px-5 py-3 bg-[#FAFAFA] border border-gray-200 rounded-2xl focus:bg-white focus:border-gray-300 focus:ring-0 text-sm font-medium transition-all outline-none placeholder:text-gray-400 text-gray-800">
                                     </div>
                                     <p class="text-[11px] text-gray-400 mt-2 font-medium">Klik kotak foto di kiri untuk pilih file.</p>
                                </div>
                                <button type="button" onclick="this.closest('.image-item').remove(); updateImageCounter();" 
                                    class="rounded-xl transition-all shrink-0 hover:opacity-90 active:scale-95" 
                                    style="width: 40px !important; height: 40px !important; min-width: 40px !important; background-color: #fef2f2 !important; color: #ef4444 !important; display: flex !important; align-items: center !important; justify-content: center !important;" 
                                    title="Hapus Gambar">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width: 24px !important; height: 24px !important;">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </div>
                        `;
                        
                        container.insertAdjacentHTML('beforeend', html);
                        bintaranImageIndex++;
                        updateImageCounter();
                    }

                    function previewBintaranImage(input) {
                        if (input.files && input.files[0]) {
                            const reader = new FileReader();
                            const card = input.closest('.image-item');
                            const img = card.querySelector('.item-preview-img');
                            const placeholder = card.querySelector('.item-placeholder');
                            
                            reader.onload = function(e) {
                                img.src = e.target.result;
                                img.classList.remove('hidden');
                                placeholder.classList.add('hidden');
                            }
                            reader.readAsDataURL(input.files[0]);
                        }
                    }

                    function updateImageCounter() {
                        const count = document.querySelectorAll('.image-item').length;
                        bintaranImageIndex = count;
                        
                        document.getElementById('imageCounterText').textContent = `( ${count}/5 )`;
                        document.getElementById('btnAddImage').disabled = count >= maxImages;
                        
                        if (count >= maxImages) {
                            document.getElementById('btnAddImage').style.opacity = '0.5';
                            document.getElementById('btnAddImage').style.cursor = 'not-allowed';
                        } else {
                            document.getElementById('btnAddImage').style.opacity = '1';
                            document.getElementById('btnAddImage').style.cursor = 'pointer';
                        }
                        
                        const emptyState = document.getElementById('emptyImageState');
                        if (count === 0) {
                            emptyState.classList.remove('hidden');
                        } else {
                            emptyState.classList.add('hidden');
                        }
                    }

                    updateImageCounter();
                </script>
                <div>
                    <label class="block text-sm font-semibold text-gray-800 mb-3">Status Publikasi</label>
                    <div class="flex items-center gap-6">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="is_published" value="0" class="w-4 h-4 text-[#8C1007] focus:ring-[#8C1007] border-gray-300">
                            <span class="text-sm text-gray-700 whitespace-nowrap">Simpan sebagai Draft</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="is_published" value="1" checked class="w-4 h-4 text-[#8C1007] focus:ring-[#8C1007] border-gray-300">
                            <span class="text-sm text-gray-700 whitespace-nowrap">Publikasikan</span>
                        </label>
                    </div>
                </div>
                <div class="flex items-center gap-3 pt-6 border-t border-gray-100 mt-8 mb-6 text-sm">
                    <button
                        type="submit"
                        class="text-white text-[12px] font-medium hover:opacity-90 transition-opacity focus:outline-none"
                        style="background:#8C1007 !important; border-radius: 0.5rem !important; padding: 10px 32px !important; display: inline-block !important;"
                    >
                        Simpan Tulisan
                    </button>
                    <button
                        type="reset"
                        class="bg-white border border-gray-200 text-gray-700 text-[12px] font-medium hover:bg-gray-50 transition-colors focus:outline-none"
                        style="border-radius: 0.5rem !important; padding: 10px 32px !important; display: inline-block !important;"
                    >
                        Reset
                    </button>
                </div>

            </div>
        </form>
</div>

@push('script')
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
        } else {
            counter.textContent = `${currentLength} karakter`;
            counter.classList.add('text-gray-400');
        }
    }
    document.addEventListener('DOMContentLoaded', function() {
        const validator = new FormValidator('formTulisanBintaran');
        
        validator.init();
        
        validator.addValidation('judul_tulisan', [
            'required',
            validator.rules.minLength(10),
            validator.rules.maxLength(100)
        ]);
        
        validator.addValidation('kategori_bintaran_id', ['required']);
        
        validator.addValidation('ringkasan', [
            'required',
            validator.rules.minLength(50),
            validator.rules.maxLength(255)
        ]);
        
        validator.addValidation('konten', [
            'required',
            validator.rules.minLength(300)
        ]);
        
        const form = document.getElementById('formTulisanBintaran');
        form.addEventListener('submit', function(e) {
            const imageCount = document.querySelectorAll('.image-item').length;
            
            if (imageCount === 0) {
                e.preventDefault();
                e.stopImmediatePropagation();
                
                const emptyState = document.getElementById('emptyImageState');
                emptyState.classList.remove('border-gray-300', 'bg-gray-50/50');
                emptyState.classList.add('border-red-500', 'bg-red-50');
                
                emptyState.style.borderColor = '#ef4444';
                emptyState.style.borderWidth = '2px';
                emptyState.style.backgroundColor = '#fef2f2';
                
                const icon = emptyState.querySelector('svg');
                const text = emptyState.querySelector('p');
                if (icon) icon.classList.remove('text-gray-300');
                if (icon) icon.classList.add('text-red-400');
                if (text) text.classList.remove('text-gray-500');
                if (text) text.classList.add('text-red-600');
                
                let errorMsg = document.getElementById('gallery-error-msg');
                if (!errorMsg) {
                    errorMsg = document.createElement('div');
                    errorMsg.id = 'gallery-error-msg';
                    errorMsg.className = 'text-red-600 text-xs mt-2 flex items-center gap-1.5 animate-in fade-in slide-in-from-top-1 duration-200 font-medium';
                    errorMsg.innerHTML = `
                        <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                        <span>Minimal 1 gambar harus ditambahkan ke galeri</span>
                    `;
                    document.getElementById('imageWrapper').appendChild(errorMsg);
                }
                
                document.getElementById('imageWrapper').scrollIntoView({ behavior: 'smooth', block: 'center' });
                return false;
            }
            
            if (!validator.validateForm()) {
                e.preventDefault();
                return false;
            }
        });
        
        const originalAddImage = window.addBintaranImage;
        window.addBintaranImage = function() {
            originalAddImage();
            
            const emptyState = document.getElementById('emptyImageState');
            emptyState.classList.remove('border-red-500', 'bg-red-50');
            emptyState.classList.add('border-gray-300', 'bg-gray-50/50');
            
            emptyState.style.borderColor = '';
            emptyState.style.borderWidth = '';
            emptyState.style.backgroundColor = '';
            
            const icon = emptyState.querySelector('svg');
            const text = emptyState.querySelector('p');
            if (icon) icon.classList.remove('text-red-400');
            if (icon) icon.classList.add('text-gray-300');
            if (text) text.classList.remove('text-red-600');
            if (text) text.classList.add('text-gray-500');
            
            const errorMsg = document.getElementById('gallery-error-msg');
            if (errorMsg) {
                errorMsg.remove();
            }
        };
    });
</script>
@endpush








