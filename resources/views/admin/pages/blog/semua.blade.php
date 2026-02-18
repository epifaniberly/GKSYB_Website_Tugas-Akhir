<div class="space-y-4 fs-style-manrope">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-3 md:gap-4 w-full">
        <div class="relative col-span-1 md:col-span-2 min-w-0">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                </svg>
            </div>
            <input type="text" id="searchInput" placeholder="Cari tulisan..."
                class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-[#8C1007] focus:border-[#8C1007] placeholder-gray-400 text-base md:text-sm text-gray-700 h-[42px] bg-white">
        </div>
        <div class="relative col-span-1 min-w-0">
            <select id="kategoriFilter"
                class="w-full border border-gray-300 rounded-lg px-4 py-2 bg-white text-gray-700 focus:outline-none focus:ring-1 focus:ring-[#8C1007] focus:border-[#8C1007] text-base md:text-sm h-[42px] appearance-none cursor-pointer">
                <option value="">Semua Kategori</option>
                @foreach($kategori as $k)
                    <option value="{{ $k->id }}">{{ $k->nama_kategori }}</option>
                @endforeach
            </select>
            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-gray-400">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
            </div>
        </div>
        <div class="relative col-span-1 min-w-0">
            <select id="statusFilter"
                class="w-full border border-gray-300 rounded-lg px-4 py-2 bg-white text-gray-700 focus:outline-none focus:ring-1 focus:ring-[#8C1007] focus:border-[#8C1007] text-base md:text-sm h-[42px] appearance-none cursor-pointer">
                <option value="">Semua Status</option>
                <option value="1">Published</option>
                <option value="0">Draft</option>
            </select>
            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-gray-400">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
            </div>
        </div>
    </div>
    <div id="list-container">
        @include('admin.pages.blog.components.list')
    </div>
</div>

@include('admin.pages.blog.components.dialog')

@push('script')
<script>
    window.storagePath = "{{ asset('storage/BintaranImage') }}";
    
    var searchInput = document.getElementById('searchInput');
    var kategoriFilter = document.getElementById('kategoriFilter');
    var statusFilter = document.getElementById('statusFilter');
    function debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }

    function fetchTulisan() {
        var search = searchInput ? encodeURIComponent(searchInput.value) : '';
        var kategori = kategoriFilter ? encodeURIComponent(kategoriFilter.value) : '';
        var status = statusFilter ? encodeURIComponent(statusFilter.value) : '';

        const url = `{{ route('admin.blog.index', 'semua') }}?search=${search}&kategori=${kategori}&status=${status}`;

        fetch(url, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(response => {
            if (!response.ok) throw new Error('Network response was not ok');
            return response.text();
        })
        .then(html => {
            var container = document.getElementById('list-container');
            if (container) container.innerHTML = html;
        })
        .catch(error => {
            console.error('Filtering failed:', error);
        });
    }

    if (searchInput) {
        searchInput.addEventListener('input', debounce(fetchTulisan, 500));
    }
    if (kategoriFilter) {
        kategoriFilter.addEventListener('change', fetchTulisan);
    }
    if (statusFilter) {
        statusFilter.addEventListener('change', fetchTulisan);
    }

    function resetFilters() {
        if (searchInput) searchInput.value = '';
        if (kategoriFilter) kategoriFilter.value = '';
        if (statusFilter) statusFilter.value = '';
        fetchTulisan();
    }

    function showDetailDialog(id) {
        document.getElementById('d_judul_header').innerText = 'Loading...';
        document.getElementById('d_kategori_header').innerText = 'Loading...';
        document.getElementById('d_ringkasan').innerText = 'Loading...';
        document.getElementById('d_konten').innerHTML = 'Loading...';
        
        const gallery = document.getElementById('d_gallery');
        const emptyState = document.getElementById('d_gallery_empty');
        gallery.innerHTML = '';
        gallery.classList.add('hidden');
        emptyState.classList.add('hidden');

        document.getElementById('detailDialog').classList.remove('hidden');

        const template = "{{ route('admin.blog.detail', '0000') }}";
        const url = template.replace('0000', id);

        fetch(url)
            .then(response => {
                if (!response.ok) throw new Error(`HTTP Error: ${response.status}`);
                return response.json();
            })
            .then(data => {
                document.getElementById('d_judul_header').innerText = data.judul_tulisan || 'Detail Tulisan';
                document.getElementById('d_kategori_header').innerText = data.kategori_bintaran ? data.kategori_bintaran.nama_kategori : 'Tanpa Kategori';
                
                const kategoriBadge = document.getElementById('d_kategori_badge');
                kategoriBadge.innerText = data.kategori_bintaran ? data.kategori_bintaran.nama_kategori : '-';
                
                const statusBadge = document.getElementById('d_status_badge');
                if (data.is_published) {
                    statusBadge.innerText = 'Published';
                    statusBadge.className = 'inline-flex px-2 py-0.5 rounded-full text-[10px] font-bold bg-green-50 text-green-600 uppercase tracking-wider border border-green-100';
                } else {
                    statusBadge.innerText = 'Draft';
                    statusBadge.className = 'inline-flex px-2 py-0.5 rounded-full text-[10px] font-bold bg-gray-50 text-gray-400 uppercase tracking-wider border border-gray-100';
                }

                document.getElementById('d_ringkasan').innerText = data.ringkasan || '-';
                document.getElementById('d_konten').innerHTML = data.konten || '<p class="text-gray-500 italic">Tidak ada konten</p>'; 

                let allImages = [];
                if (data.image) {
                     allImages.push({ file: data.image, caption: 'Gambar Utama' });
                }
                if (data.images && Array.isArray(data.images)) {
                    data.images.forEach(img => {
                        if(img && img.image) {
                            allImages.push({ 
                                file: img.image, 
                                caption: img.caption || '' 
                            });
                        }
                    });
                }

                if (allImages.length > 0) {
                    gallery.classList.remove('hidden');
                    emptyState.classList.add('hidden');
                    allImages.forEach(img => {
                        const imgHtml = `
                            <div class="group relative aspect-square bg-gray-50 rounded-2xl overflow-hidden border border-gray-100">
                                <img src="${window.storagePath}/${img.file}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                                ${img.caption ? `
                                <div class="absolute inset-x-0 bottom-0 p-3 bg-gradient-to-t from-black/60 to-transparent">
                                    <p class="text-[10px] text-white font-medium line-clamp-1">${img.caption}</p>
                                </div>` : ''}
                            </div>
                        `;
                        gallery.insertAdjacentHTML('beforeend', imgHtml);
                    });
                } else {
                    gallery.classList.add('hidden');
                    emptyState.classList.remove('hidden');
                }
            })
            .catch(error => {
                console.error('Fetch error:', error);
                document.getElementById('d_judul_header').innerText = 'Error';
                document.getElementById('d_konten').innerHTML = `<p class="text-red-500">Gagal memuat data: ${error.message}</p>`;
            });
    }

    function closeDetail() {
        document.getElementById('detailDialog').classList.add('hidden');
    }

    function updateGalleryEmptyState() {
        const container = document.getElementById('e_gallery_container');
        const emptyState = document.getElementById('e_gallery_empty');
        if (!container) return;

        const items = container.querySelectorAll('.bintaran-gallery-item');
        const count = items.length;
        
        const counterEl = document.getElementById('galleryCounterText');
        if (counterEl) {
            counterEl.innerText = `( ${count}/5 )`;
        }
        
        if (count === 0) {
            if(emptyState) emptyState.classList.remove('hidden');
            container.classList.add('hidden');
        } else {
            if(emptyState) {
                emptyState.classList.add('hidden');
                emptyState.style.borderColor = '';
                emptyState.style.borderWidth = '';
                emptyState.style.backgroundColor = '';
            }
            container.classList.remove('hidden');
            
            const slideError = document.getElementById('slide-error');
            if (slideError) slideError.classList.add('hidden');
        }

        const btn = document.getElementById('btn_add_gallery');
        if (btn) {
            if (count >= 5) {
                btn.classList.add('opacity-50', 'pointer-events-none');
            } else {
                btn.classList.remove('opacity-50', 'pointer-events-none');
            }
        }
    }

    function addBintaranGalleryItem(existingData = null) {
        const container = document.getElementById('e_gallery_container');
        if (!container) return;

        const currentItems = container.querySelectorAll('.bintaran-gallery-item');
        if (currentItems.length >= 5) return;

        bintaranGalleryIndex++;
        const id = bintaranGalleryIndex;
        
        let fileSrc = '';
        if (existingData && existingData.image) {
            fileSrc = (existingData.image.startsWith('http')) ? existingData.image : `${window.storagePath}/${existingData.image}`;
        }

        const caption = existingData ? (existingData.caption || '') : '';
        const hasImg = !!fileSrc;

        const html = `
            <div class="bintaran-gallery-item flex items-center gap-4 p-4 bg-white border border-gray-200 rounded-[1.25rem] relative group transition-all hover:border-[#8C1007] hover:shadow-md w-full mb-3 last:mb-0 box-border overflow-hidden">
                ${existingData ? `<input type="hidden" name="existing_images_ids[]" value="${existingData.id}">` : ''}

                <input type="text" id="galleryChecker_${id}" value="${existingData ? 'active' : ''}" 
                    class="peer absolute opacity-0 pointer-events-none w-px h-px" required readonly>

                <div class="w-24 h-24 bg-gray-50 rounded-2xl overflow-hidden border border-gray-100 flex-shrink-0 cursor-pointer relative group/img shadow-sm transition-all" 
                    onclick="document.getElementById('galleryFile_${id}').click()">
                    <img src="${fileSrc}" class="item-preview-img w-full h-full object-cover ${hasImg ? '' : 'hidden'}">
                    <div class="item-placeholder absolute inset-0 flex flex-col items-center justify-center text-gray-300 ${hasImg ? 'hidden' : ''} group-hover/img:text-gray-400 transition-colors">
                         <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                </div>
                <input type="file" id="galleryFile_${id}" name="images[]" class="hidden" accept="image/*" 
                    onchange="previewGalleryItem(this); document.getElementById('galleryChecker_${id}').value = this.value ? 'active' : ''">

                <div class="flex-1 min-w-0 py-1">
                     <div class="space-y-1.5">
                        <label class="block text-gray-800 text-sm font-semibold">Caption <span class="mandatory-star">*</span></label>
                        <input type="text" name="${existingData ? `existing_captions[${existingData.id}]` : 'captions[]'}" value="${caption}" required
                            class="w-full px-5 py-3 bg-[#FAFAFA] border border-gray-200 rounded-2xl focus:bg-white focus:border-gray-300 focus:ring-0 text-sm font-medium transition-all outline-none placeholder:text-gray-400 text-gray-800" placeholder="Masukkan keterangan foto...">
                     </div>
                     <p class="text-[11px] text-gray-400 mt-2 font-medium">Klik foto untuk ${existingData ? 'mengganti' : 'memilih'} file.</p>
                </div>
                <button type="button" onclick="this.closest('.bintaran-gallery-item').remove(); updateGalleryEmptyState();" 
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
        updateGalleryEmptyState();
    }

    function previewGalleryItem(input) {
        const card = input.closest('.bintaran-gallery-item');
        const img = card.querySelector('.item-preview-img');
        const placeholder = card.querySelector('.item-placeholder');
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = e => {
                img.src = e.target.result;
                img.classList.remove('hidden');
                placeholder.classList.add('hidden');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function openEditDialog(id) {
        const template = "{{ route('admin.blog.detail', '0000') }}";
        const url = template.replace('0000', id);

        fetch(url)
            .then(res => {
                if (!res.ok) {
                    throw new Error('Gagal mengambil data tulisan');
                }
                return res.json();
            })
            .then(data => {
                const form = document.getElementById('formEdit');
                form.action = `/admin-blog/update/${data.id}`;
                
                document.getElementById('e_judul').value = data.judul_tulisan || '';
                document.getElementById('e_ringkasan').value = data.ringkasan || '';
                document.getElementById('e_konten').value = data.konten || '';
                
                if (data.is_published) {
                    document.getElementById('e_status_published').checked = true;
                } else {
                    document.getElementById('e_status_draft').checked = true;
                }
                
                document.getElementById('e_kategori').value = data.kategori_bintaran_id ?? '';

                const container = document.getElementById('e_gallery_container');
                if (container) {
                    container.innerHTML = '';
                    bintaranGalleryIndex = 0;

                    if (data.images && Array.isArray(data.images)) {
                        console.log(`Found ${data.images.length} images for bintaran edit`);
                        data.images.forEach(img => addBintaranGalleryItem(img));
                    }
                }

                if (window.editBintaranValidator) {
                    window.editBintaranValidator.clearErrors();
                }

                document.getElementById('editDialog').classList.remove('hidden');
            })
            .catch(err => {
                console.error("Error fetching for edit:", err);
                SwalHelper.error('Gagal Membuka Data', 'Tidak dapat memuat data tulisan untuk diedit.');
            });
    }

    document.addEventListener('DOMContentLoaded', function() {
        const editBintaranValidator = new FormValidator('formEdit');
        
        editBintaranValidator.addValidation('e_judul', ['required']);
        editBintaranValidator.addValidation('e_kategori', ['required']);
        editBintaranValidator.addValidation('e_ringkasan', ['required']);
        editBintaranValidator.addValidation('e_konten', ['required']);
        
        editBintaranValidator.init();
        window.editBintaranValidator = editBintaranValidator;

        const formEdit = document.getElementById('formEdit');
        if (formEdit) {
            formEdit.addEventListener('submit', function(e) {
                e.preventDefault();

                if (!editBintaranValidator.validateForm()) {
                    return;
                }
                const galleryItems = document.querySelectorAll('.bintaran-gallery-item');
                if (galleryItems.length === 0) {
                    const slideError = document.getElementById('slide-error');
                    if (slideError) slideError.classList.remove('hidden');
                    
                    const emptyState = document.getElementById('e_gallery_empty');
                    if (emptyState) {
                         emptyState.style.borderColor = '#ef4444';
                         emptyState.style.borderWidth = '2px';
                         emptyState.style.backgroundColor = '#fef2f2';
                    }
                    
                    document.getElementById('e_gallery_wrapper').scrollIntoView({ behavior: 'smooth', block: 'center' });
                    return;
                }

                SwalHelper.confirmEdit('tulisan ini').then((result) => {
                    if (result.isConfirmed) {
                        this.submit();
                    }
                });
            });
        }
    });


    function closeEdit() {
        document.getElementById('editDialog').classList.add('hidden');
    }
</script>
@endpush


