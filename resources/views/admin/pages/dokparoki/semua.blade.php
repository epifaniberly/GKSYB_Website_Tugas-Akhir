<div class="space-y-6">
    <form method="GET" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4" id="filterForm">
        <div class="relative col-span-1 md:col-span-2">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                </svg>
            </div>
            <input type="text" name="keyword" id="searchDokumen" value="{{ request('keyword') }}"
                class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-[#8C1007] focus:border-[#8C1007] placeholder-gray-400 text-[12px] md:text-sm mobile-font-tiny text-gray-700 h-[42px]"
                placeholder="Cari dokumen...">
        </div>
        <div class="relative">
            <select name="kategori" id="kategoriFilter"
                class="w-full border border-gray-300 rounded-lg px-4 py-2 bg-white text-gray-700 focus:outline-none focus:ring-1 focus:ring-[#8C1007] focus:border-[#8C1007] text-[12px] md:text-sm mobile-font-tiny h-[42px] appearance-none cursor-pointer">
                <option value="">Semua Kategori</option>
                @foreach($kategori as $k)
                    <option value="{{ $k->id }}"
                        {{ request('kategori') == $k->id ? 'selected' : '' }}>
                        {{ $k->nama_kategori }}
                    </option>
                @endforeach
            </select>
            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-gray-400">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
            </div>
        </div>
        <div class="relative">
            <select name="status" id="statusFilter"
                class="w-full border border-gray-300 rounded-lg px-4 py-2 bg-white text-gray-700 focus:outline-none focus:ring-1 focus:ring-[#8C1007] focus:border-[#8C1007] text-[12px] md:text-sm mobile-font-tiny h-[42px] appearance-none cursor-pointer">
                <option value="">Semua Status</option>
                <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Published</option>
                <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Draft</option>
            </select>
            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-gray-400">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
            </div>
        </div>
    </form>

    <div id="dokumen-list-container">
        @include('admin.pages.dokparoki.components.list')
    </div>
</div>

@include('admin.pages.dokparoki.components.dialog')


@push('script')
<script src="https://unpkg.com/jszip/dist/jszip.min.js"></script>
<script src="https://unpkg.com/docx-preview/dist/docx-preview.js"></script>
<script>
    const searchInput = document.getElementById('searchDokumen');
    const kategoriFilter = document.getElementById('kategoriFilter');
    const statusFilter = document.getElementById('statusFilter');

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

    function fetchDokumen() {
        const keyword = searchInput.value;
        const kategori = kategoriFilter.value;
        const status = statusFilter.value;

        fetch(`{{ route('admin.dokparoki.index') }}?keyword=${keyword}&kategori=${kategori}&status=${status}`, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(response => response.text())
        .then(html => {
            document.getElementById('dokumen-list-container').innerHTML = html;
        });
    }

    if(searchInput) searchInput.addEventListener('input', debounce(fetchDokumen, 500));
    if(kategoriFilter) kategoriFilter.addEventListener('change', fetchDokumen);
    if(statusFilter) statusFilter.addEventListener('change', fetchDokumen);

    function renderPreview(filePath, type = 'pdf', target = 'view') {
        const iframe = document.getElementById(target === 'view' ? 'd_preview_pdf' : 'preview_pdf');
        const docxContainer = document.getElementById(target === 'view' ? 'd_preview_docx' : 'preview_docx');
        const placeholder = document.getElementById(target === 'view' ? 'd_preview_placeholder' : 'preview_placeholder');
        const loading = document.getElementById('pdf_loading');

        iframe.classList.add('hidden');
        docxContainer.classList.add('hidden');
        if(placeholder) placeholder.classList.add('hidden');
        iframe.src = "";
        docxContainer.innerHTML = "";

        const extension = filePath.split('.').pop().toLowerCase();
        
        if (extension === 'pdf') {
            iframe.classList.remove('hidden');
            iframe.src = filePath;
        } else if (['docx', 'doc'].includes(extension)) {
            docxContainer.classList.remove('hidden');
            if(loading) loading.classList.remove('hidden');
            
            fetch(filePath)
                .then(response => response.arrayBuffer())
                .then(buffer => {
                    docx.renderAsync(buffer, docxContainer, null, {
                        className: "docx",
                        inWrapper: false,
                        ignoreLastRenderedPageBreak: false,
                    }).then(() => {
                        if(loading) loading.classList.add('hidden');
                    });
                })
                .catch(err => {
                    console.error("Docx Preview Error:", err);
                    if(loading) loading.classList.add('hidden');
                    docxContainer.innerHTML = `<div class="p-8 text-center text-red-500">Gagal memuat pratinjau Word.</div>`;
                });
        } else {
            if(placeholder) placeholder.classList.remove('hidden');
        }
    }

function bukaEdit(data, mode = 'edit') {
    if (mode === 'view') {
        document.getElementById('detailDialog').classList.remove('hidden');

        document.getElementById('d_judul_header').innerText = data.judul_dokumen || 'Detail Dokumen';
        document.getElementById('d_kategori_header').innerText = data.kategori ? data.kategori.nama_kategori : 'Dokumen Paroki';
        
        const kategoriText = document.getElementById('d_kategori_text');
        kategoriText.innerText = data.kategori ? data.kategori.nama_kategori : '-';
        
        const statusBadge = document.getElementById('d_status_badge');
        if (data.is_active == 1) {
            statusBadge.innerText = 'Published';
            statusBadge.className = 'inline-flex px-2 py-0.5 rounded-full text-[10px] font-bold bg-green-50 text-green-600 uppercase tracking-wider border border-green-100';
        } else {
            statusBadge.innerText = 'Draft';
            statusBadge.className = 'inline-flex px-2 py-0.5 rounded-full text-[10px] font-bold bg-gray-50 text-gray-400 uppercase tracking-wider border border-gray-100';
        }

        document.getElementById('d_keterangan').innerText = data.keterangan || '-';
        renderPreview(`/storage/DokParoki/${data.file}`, 'auto', 'view');

        return;
    }

    document.getElementById('modalEdit').classList.remove('hidden');
    removeFileEdit();

    const title = document.getElementById('modalEditTitle');
    const desc = document.getElementById('modalEditDesc');
    const sectionFile = document.getElementById('section-ganti-file');

    const inputJudul = document.getElementById('edit_judul_dokumen');
    const selectorKategori = document.getElementById('edit_kategori');
    const inputKeterangan = document.getElementById('edit_keterangan');
    const radioActive1 = document.getElementById('edit_active_1');
    const radioActive0 = document.getElementById('edit_active_0');

    title.textContent = 'Edit Dokumen';
    desc.textContent = 'Ubah informasi atau ganti file dokumen paroki';
    if(sectionFile) sectionFile.classList.remove('hidden');

    inputJudul.readOnly = false;
    selectorKategori.disabled = false;
    inputKeterangan.readOnly = false;
    radioActive1.disabled = false;
    radioActive0.disabled = false;

    document.getElementById('edit_id').value = data.id;
    inputJudul.value = data.judul_dokumen;
    selectorKategori.value = data.kategori_id;
    inputKeterangan.value = data.keterangan ?? '';
    
    radioActive1.checked = data.is_active == 1;
    radioActive0.checked = data.is_active != 1;

    renderPreview(`/storage/DokParoki/${data.file}`, 'auto', 'edit');
    document.getElementById('formEdit').action = `/admin-dokumen-paroki/update/${data.id}`;
    
    const words = (data.keterangan ?? '').trim().split(/\s+/).filter(word => word.length > 0);
    document.getElementById('edit-word-count').textContent = `${words.length}/20 kata`;
}

function closeDetail() {
    document.getElementById('detailDialog').classList.add('hidden');
    document.getElementById('d_preview_pdf').src = '';
}

const editValidator = new FormValidator('formEdit');
document.addEventListener('DOMContentLoaded', function() {
    editValidator.addValidation('judul_dokumen', ['required']);
    editValidator.addValidation('kategori_id', ['required']);
    editValidator.addValidation('keterangan', ['required']);
    editValidator.init();

    const editKeterangan = document.getElementById('edit_keterangan');
    const editErrorText = document.getElementById('edit-word-count-error');
    const editWordCountSpan = document.getElementById('edit-word-count');
    
    if (editKeterangan) {
        editKeterangan.addEventListener('input', function() {
            const words = this.value.trim().split(/\s+/).filter(word => word.length > 0);
            
            if (words.length > 20) {
                this.value = this.value.split(/\s+/).slice(0, 20).join(' ');
                const finalWords = this.value.trim().split(/\s+/).filter(word => word.length > 0);
                
                if (editWordCountSpan) {
                    editWordCountSpan.textContent = `${finalWords.length}/20 kata`;
                    editWordCountSpan.classList.add('text-[#8C1007]', 'font-bold');
                }
                editErrorText.classList.remove('hidden');
            } else {
                if (editWordCountSpan) {
                    editWordCountSpan.textContent = `${words.length}/20 kata`;
                    editWordCountSpan.classList.remove('text-[#8C1007]', 'font-bold');
                    editWordCountSpan.classList.add('text-gray-400');
                }
                editErrorText.classList.add('hidden');
            }
        });
    }
});

function tutupModal() {
    document.getElementById('modalEdit').classList.add('hidden');
    removeFileEdit();
    if(editValidator) editValidator.clearErrors();
}

function previewPDFEdit(input) {
    const file = input.files[0];
    const preview = document.getElementById('editPreviewContainer');
    const placeholder = document.getElementById('editUploadPlaceholder');
    const fileName = document.getElementById('editFileName');
    const fileSize = document.getElementById('editFileSize');
    
    if (!file) {
        removeFileEdit();
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
        input.value = '';
        removeFileEdit();
        return;
    }

    if (file.size > 50 * 1024 * 1024) {
        input.value = '';
        removeFileEdit();
        return;
    }

    fileName.textContent = file.name;
    fileSize.textContent = (file.size / 1024 / 1024).toFixed(2) + ' MB';
    preview.classList.remove('hidden');
    if (placeholder) placeholder.classList.add('hidden');

    const reader = new FileReader();
    reader.onload = function(e) {
        const buffer = e.target.result;
        const extension = file.name.split('.').pop().toLowerCase();
        const iframe = document.getElementById('preview_pdf');
        const docxContainer = document.getElementById('preview_docx');
        const loading = document.getElementById('pdf_loading');

        iframe.classList.add('hidden');
        docxContainer.classList.add('hidden');
        docxContainer.innerHTML = "";

        if (extension === 'pdf') {
            iframe.classList.remove('hidden');
            iframe.src = URL.createObjectURL(file);
        } else if (['docx', 'doc'].includes(extension)) {
            docxContainer.classList.remove('hidden');
            if(loading) loading.classList.remove('hidden');
            docx.renderAsync(buffer, docxContainer).then(() => {
                if(loading) loading.classList.add('hidden');
            });
        }
    };
    reader.readAsArrayBuffer(file);
}

function removeFileEdit() {
    const input = document.getElementById('edit_file');
    const preview = document.getElementById('editPreviewContainer');
    const placeholder = document.getElementById('editUploadPlaceholder');
    
    if (input) input.value = '';
    if (preview) preview.classList.add('hidden');
    if (placeholder) placeholder.classList.remove('hidden');
}

function submitEditForm() {
    if (!editValidator.validateForm()) {
        return;
    }
    const editKeterangan = document.getElementById('edit_keterangan');
    const words = editKeterangan.value.trim().split(/\s+/).filter(word => word.length > 0);
    if (words.length > 20) {
        document.getElementById('edit-word-count-error').classList.remove('hidden');
        editKeterangan.focus();
        return;
    }

    SwalHelper.confirmEdit('dokumen ini').then((result) => {
        if (result.isConfirmed) {
            document.getElementById('formEdit').submit();
        }
    });
}

function hapus(id) {
    SwalHelper.confirmDelete('dokumen ini').then(result => {
        if (result.isConfirmed) {
            document.getElementById(`form-delete-${id}`).submit();
        }
    });
}

</script>
@endpush






