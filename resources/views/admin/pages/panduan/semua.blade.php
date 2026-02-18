<div class="space-y-6">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-3 md:gap-4 w-full">
        <div class="relative col-span-1 md:col-span-2 lg:col-span-3 min-w-0">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                </svg>
            </div>
            <input type="text" id="searchPanduan" 
                class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-[#8C1007] focus:border-[#8C1007] placeholder-gray-400 text-[12px] md:text-sm mobile-font-tiny text-gray-700 h-[42px] bg-white transition-all" 
                placeholder="Cari panduan...">
        </div>
        <div class="relative col-span-1 min-w-0">
            <select id="statusPanduanFilter" 
                class="w-full border border-gray-300 rounded-lg px-4 py-2 bg-white text-gray-700 focus:outline-none focus:ring-1 focus:ring-[#8C1007] focus:border-[#8C1007] text-[12px] md:text-sm mobile-font-tiny h-[42px] appearance-none cursor-pointer transition-all">
                <option value="">Semua Status</option>
                <option value="1">Published</option>
                <option value="0">Draft</option>
            </select>
            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-gray-400">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
            </div>
        </div>
    </div>
    <div id="panduanListContainer">
        @include('admin.pages.panduan.components.list', ['ekaristi' => $ekaristi])
    </div>
</div>


@include('admin.pages.panduan.components.dialog')

@push('script')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://npmcdn.com/flatpickr/dist/l10n/id.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const editKet = document.getElementById('edit_ket_perayaan');
        const editAyat = document.getElementById('edit_ayat_alkitab');

        const searchInput = document.getElementById('searchPanduan');
        const statusFilter = document.getElementById('statusPanduanFilter');
        const listContainer = document.getElementById('panduanListContainer');

        function fetchPanduan() {
            const keyword = searchInput.value;
            const status = statusFilter.value;
            const url = new URL(window.location.href);
            
            url.searchParams.set('keyword', keyword);
            url.searchParams.set('status', status);

            fetch(url, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.text())
            .then(html => {
                listContainer.innerHTML = html;
            })
            .catch(error => console.error('Error fetching panduan:', error));
        }

        function debounce(func, timeout = 300) {
            let timer;
            return (...args) => {
                clearTimeout(timer);
                timer = setTimeout(() => { func.apply(this, args); }, timeout);
            };
        }

        const handleSearch = debounce(() => fetchPanduan());

        searchInput.addEventListener('input', handleSearch);
        statusFilter.addEventListener('change', fetchPanduan);

        function updateWordCountEdit(textarea, displayId, maxWords) {
            if (!textarea) return;
            const words = textarea.value.trim().split(/\s+/).filter(word => word.length > 0);
            const display = document.getElementById(displayId);
            
            if (display) {
                if (words.length > maxWords) {
                    textarea.value = textarea.value.split(/\s+/).slice(0, maxWords).join(' ');
                    const finalWords = textarea.value.trim().split(/\s+/).filter(word => word.length > 0);
                    display.textContent = `${finalWords.length}/${maxWords} kata`;
                    display.classList.add('text-[#8C1007]', 'font-bold');
                    display.classList.remove('text-gray-400');
                } else {
                    display.textContent = `${words.length}/${maxWords} kata`;
                    display.classList.remove('text-[#8C1007]', 'font-bold');
                    display.classList.add('text-gray-400');
                }
            }
        }

        if (editKet) {
            editKet.addEventListener('input', () => updateWordCountEdit(editKet, 'wordCountKetEdit', 15));
        }
        if (editAyat) {
            editAyat.addEventListener('input', () => updateWordCountEdit(editAyat, 'wordCountAyatEdit', 20));
        }

        window.editDatePicker = null;
        window.initEditDatePicker = function(mode) {
            if (window.editDatePicker) window.editDatePicker.destroy();
            window.editDatePicker = flatpickr("#edit_tanggal_picker", {
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
                    document.getElementById('edit_final_tanggal').value = '';
                    document.getElementById('edit_final_tanggal_mulai').value = '';
                    document.getElementById('edit_final_tanggal_akhir').value = '';

                    if (mode === 'single' && selectedDates.length > 0) {
                        document.getElementById('edit_final_tanggal').value = instance.formatDate(selectedDates[0], "Y-m-d");
                    } else if (mode === 'rentang' && selectedDates.length === 2) {
                        document.getElementById('edit_final_tanggal_mulai').value = instance.formatDate(selectedDates[0], "Y-m-d");
                        document.getElementById('edit_final_tanggal_akhir').value = instance.formatDate(selectedDates[1], "Y-m-d");
                    }

                    if (typeof editValidator !== 'undefined' && editValidator.clearFieldError) {
                        editValidator.clearFieldError('e_tanggal_container');
                    }
                }
            });
        };

        window.toggleTanggalEdit = function (type) {
            window.initEditDatePicker(type);
            document.getElementById('edit_tanggal_picker').value = '';
            document.getElementById('edit_final_tanggal').value = '';
            document.getElementById('edit_final_tanggal_mulai').value = '';
            document.getElementById('edit_final_tanggal_akhir').value = '';
        };

        const editValidator = new FormValidator('formEdit');
        editValidator.addValidation('jenis_misa', ['required']);
        editValidator.addValidation('perayaan', ['required']);
        editValidator.addValidation('ket_perayaan', ['required']);
        editValidator.addValidation('ayat_alkitab', ['required']);
        editValidator.addValidation('sumber_ayat', ['required']);
        editValidator.init();


        const formEdit = document.getElementById('formEdit');
        if (formEdit) {
            formEdit.addEventListener('submit', function (e) {
                e.preventDefault();

                if (!editValidator.validateForm()) {
                    return;
                }
                const ketVal = document.getElementById('edit_ket_perayaan').value.trim();
                const ayatVal = document.getElementById('edit_ayat_alkitab').value.trim();
                const kw = ketVal.split(/\s+/).filter(w => w.length > 0).length;
                const aw = ayatVal.split(/\s+/).filter(w => w.length > 0).length;

                if (kw > 15 || aw > 20) {
                    return; 
                }

                const editType = document.querySelector('input[name="tipe_tanggal"]:checked')?.value;
                const ft = document.getElementById('edit_final_tanggal').value;
                const ftm = document.getElementById('edit_final_tanggal_mulai').value;
                const fta = document.getElementById('edit_final_tanggal_akhir').value;

                if (editType === 'tunggal' && !ft) {
                    editValidator.showFieldError('e_tanggal_container', 'Silakan pilih tanggal');
                    return;
                }
                if (editType === 'rentang' && (!ftm || !fta)) {
                    editValidator.showFieldError('e_tanggal_container', 'Silakan pilih rentang tanggal');
                    return;
                }

                SwalHelper.confirmEdit('panduan ini').then((result) => {
                    if (!result.isConfirmed) return;

                    const formData = new FormData(this);
                    const submitBtn = document.getElementById('btn-edit-simpan');
                    
                    if (editType === 'tunggal') {
                        formData.delete('tanggal_mulai');
                        formData.delete('tanggal_akhir');
                    } else {
                        formData.delete('tanggal');
                    }
                    
                    submitBtn.disabled = true;

                    const id = document.getElementById('edit_id').value;
                    
                    fetch(`/admin-panduan/update/${id}`, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => {
                        if (!response.ok) {
                            return response.json().then(err => {
                                throw new Error(err.message || 'Terjadi kesalahan pada server');
                            });
                        }
                        return response.json();
                    })
                    .then(data => {
                        submitBtn.disabled = false;

                        if (data.success || data.message) {
                            SwalHelper.successEdit(data.message || 'Data berhasil diperbarui').then(() => {
                                tutupModal();
                                if (typeof fetchPanduan === 'function') {
                                    fetchPanduan();
                                } else {
                                    window.location.reload();
                                }
                            });
                        } else {
                            throw new Error(data.error || 'Terjadi kesalahan');
                        }
                    })
                    .catch(error => {
                        submitBtn.disabled = false;
                        
                        SwalHelper.errorEdit(error.message || 'Terjadi kesalahan saat menyimpan data');
                    });
                });
            });
        }
    });

    function bukaEdit(data, mode = 'edit') {
        if (mode === 'view') {
            const detailDialog = document.getElementById('detailDialog');
            detailDialog.classList.remove('hidden');
            document.getElementById('d_judul_header').innerText = data.perayaan || 'Detail Panduan Ekaristi';
            document.getElementById('d_subtitle_header').innerText = data.jenis_misa || 'Informasi lengkap panduan perayaan';

            document.getElementById('d_ket_perayaan').innerText = data.ket_perayaan || '---';
            document.getElementById('d_ayat_alkitab').innerText = data.ayat_alkitab || '---';
            document.getElementById('d_sumber_ayat').innerText = data.sumber_ayat || '---';
            let tanggalText = '---';
            if (data.tanggal) {
                tanggalText = new Date(data.tanggal).toLocaleDateString('id-ID', { 
                    day: 'numeric', 
                    month: 'long', 
                    year: 'numeric' 
                });
            } else if (data.tanggal_mulai && data.tanggal_akhir) {
                const mulai = new Date(data.tanggal_mulai).toLocaleDateString('id-ID', { 
                    day: 'numeric', 
                    month: 'long', 
                    year: 'numeric' 
                });
                const akhir = new Date(data.tanggal_akhir).toLocaleDateString('id-ID', { 
                    day: 'numeric', 
                    month: 'long', 
                    year: 'numeric' 
                });
                tanggalText = `${mulai} - ${akhir}`;
            }
            document.getElementById('d_tanggal').innerText = tanggalText;

            const statusBadge = document.getElementById('d_status_badge');
            if (data.is_publish == 1) {
                statusBadge.innerText = 'Published';
                statusBadge.className = 'inline-flex px-2 py-0.5 rounded-full text-[10px] font-bold bg-green-50 text-green-600 uppercase tracking-wider border border-green-100';
            } else {
                statusBadge.innerText = 'Draft';
                statusBadge.className = 'inline-flex px-2 py-0.5 rounded-full text-[10px] font-bold bg-gray-50 text-gray-400 uppercase tracking-wider border border-gray-100';
            }

            document.getElementById('d_preview_pdf').src = `/storage/PanduanFile/${data.file}`;
            
            return;
        }

        const modal = document.getElementById('modalEdit');
        modal.classList.remove('hidden');
        window.removeFileEdit(); 
        const title = document.getElementById('modalEditTitle');
        const desc = document.getElementById('modalEditDesc');
        const footer = document.getElementById('modal-footer');
        const btnSimpan = document.getElementById('btn-edit-simpan');
        const btnBatal = document.getElementById('btn-edit-batal');
        const sectionFile = document.getElementById('section-ganti-file');

        title.textContent = 'Edit Panduan Ekaristi';
        desc.textContent = 'Sesuaikan informasi panduan perayaan ekaristi';
        btnSimpan.style.display = 'inline-block';
        btnBatal.textContent = 'Batal';
        footer.classList.remove('hidden');
        if(sectionFile) sectionFile.classList.remove('hidden');

        const form = document.getElementById('formEdit');
        form.action = `/admin-panduan/update/${data.id}`;

        document.getElementById('edit_id').value = data.id;
        document.getElementById('edit_jenis_misa').value = data.jenis_misa;
        document.getElementById('edit_perayaan').value = data.perayaan ?? '';
        document.getElementById('edit_ket_perayaan').value = data.ket_perayaan ?? '';
        document.getElementById('edit_ayat_alkitab').value = data.ayat_alkitab ?? '';
        document.getElementById('edit_sumber_ayat').value = data.sumber_ayat ?? '';

        if (data.is_publish == 1) {
            document.getElementById('edit_publish').checked = true;
        } else {
            document.getElementById('edit_draft').checked = true;
        }

        if (data.tanggal) {
            document.getElementById('edit_tipe_tunggal').checked = true;
            window.initEditDatePicker('single');
            window.editDatePicker.setDate(data.tanggal);
            document.getElementById('edit_final_tanggal').value = data.tanggal;
        } else if (data.tanggal_mulai && data.tanggal_akhir) {
            document.getElementById('edit_tipe_rentang').checked = true;
            window.initEditDatePicker('rentang');
            window.editDatePicker.setDate([data.tanggal_mulai, data.tanggal_akhir]);
            document.getElementById('edit_final_tanggal_mulai').value = data.tanggal_mulai;
            document.getElementById('edit_final_tanggal_akhir').value = data.tanggal_akhir;
        } else {
            document.getElementById('edit_tipe_tunggal').checked = true;
            window.initEditDatePicker('single');
        }

        document.getElementById('preview_pdf').src = `/storage/PanduanFile/${data.file}`;
        
        const updateCount = (tid, did, max) => {
            const el = document.getElementById(tid);
            const words = el.value.trim().split(/\s+/).filter(w => w.length > 0).length;
            const disp = document.getElementById(did);
            if (disp) {
                disp.textContent = `${words}/${max} kata`;
                disp.className = `text-[10px] font-medium ${words > max ? 'text-red-500 font-bold' : 'text-gray-400'}`;
            }
        };
        updateCount('edit_ket_perayaan', 'wordCountKetEdit', 15);
        updateCount('edit_ayat_alkitab', 'wordCountAyatEdit', 20);
    }

    function closeDetail() {
        document.getElementById('detailDialog').classList.add('hidden');
    }

    function tutupModal() {
        document.getElementById('modalEdit').classList.add('hidden');
        window.removeFileEdit();
    }

    window.previewPDFEdit = function(input) {
        const file = input.files[0];
        const preview = document.getElementById('editPreviewContainer');
        const placeholder = document.getElementById('editUploadPlaceholder');
        const fileName = document.getElementById('editFileName');
        const fileSize = document.getElementById('editFileSize');
        
        input.setCustomValidity('');

        if (!file) {
            window.removeFileEdit();
            return;
        }

        if (file.type !== 'application/pdf') {
            input.setCustomValidity('Hanya file PDF yang diperbolehkan.');
            input.reportValidity();
            input.value = '';
            window.removeFileEdit();
            return;
        }

        if (file.size > 50 * 1024 * 1024) {
            input.setCustomValidity('Ukuran file maksimal 50MB.');
            input.reportValidity();
            input.value = '';
            window.removeFileEdit();
            return;
        }

        fileName.textContent = file.name;
        fileSize.textContent = (file.size / 1024 / 1024).toFixed(2) + ' MB';
        preview.classList.remove('hidden');
        if (placeholder) placeholder.classList.add('hidden');
    }

    window.removeFileEdit = function() {
        const input = document.getElementById('edit_file');
        const preview = document.getElementById('editPreviewContainer');
        const placeholder = document.getElementById('editUploadPlaceholder');
        
        if (input) input.value = '';
        if (preview) preview.classList.add('hidden');
        if (placeholder) placeholder.classList.remove('hidden');
    }

    function hapus(id) {
        SwalHelper.confirmDelete('panduan ini').then(r => {
            if (r.isConfirmed) {
                document.getElementById(`form-delete-${id}`).submit();
            }
        });
    }
</script>
@endpush








