@extends('layout.admin')

@section('title', 'Pastor Paroki')

@section('content')
    <script>
        const activePastorParokiId = {{ isset($activePastorParoki) && $activePastorParoki ? $activePastorParoki->id : 'null' }};
        const updateUrlBase = "{{ url('admin-pastor-paroki/update') }}";
        const storeUrl = "{{ route('admin.paroki.store') }}";
        const allPastors = @json($data->map(function($p) {
            return ['id' => $p->id, 'nama' => strtolower(trim($p->nama_pastor))];
        }));
    </script>
    <div class="flex flex-col justify-start text-left fs-style-manrope py-6">
        <h1 class="admin-page-title">Data Pastor Paroki</h1>
        <p class="text-sm text-gray-500 mt-1">Kelola informasi pastor yang melayani di Paroki Bintaran</p>
    </div>

    <div class="bg-white border border-gray-200 shadow rounded-xl overflow-hidden fs-style-manrope">
        <div class="flex border-b border-gray-200 overflow-x-auto whitespace-nowrap">
            <a
                href="{{ route('admin.paroki.index', 'semua') }}"
                class="px-6 py-3 text-[12px] md:text-sm mobile-font-tiny transition-colors border-b-2 -mb-px outline-none focus:outline-none {{ $tab === 'semua' ? 'font-semibold' : 'text-gray-500 font-medium border-transparent hover:text-gray-700 hover:border-gray-300' }}"
                style="{{ $tab === 'semua' ? 'border-bottom: 2px solid #8C1007; color: #8C1007;' : '' }}"
            >
                Semua Pastor
            </a>

            <a
                href="{{ route('admin.paroki.index', 'tambah') }}"
                class="px-6 py-3 text-[12px] md:text-sm mobile-font-tiny transition-colors border-b-2 -mb-px outline-none focus:outline-none {{ $tab === 'tambah' ? 'font-semibold' : 'text-gray-500 font-medium border-transparent hover:text-gray-700 hover:border-gray-300' }}"
                style="{{ $tab === 'tambah' ? 'border-bottom: 2px solid #8C1007; color: #8C1007;' : '' }}"
            >
                Tambah Pastor
            </a>
        </div>
        <div class="px-6 py-4">
            @if($tab === 'semua')
                @include('admin.pages.paroki.semua')
            @elseif($tab === 'tambah')
                @include('admin.pages.paroki.tambah')
            @endif
        </div>
    </div>

    @include('admin.pages.paroki.components.dialog')

    <form id="formDelete" method="POST" style="display:none;">
        @csrf
        @method('DELETE')
    </form>
@endsection

@push('script')
<script>
    function openEdit(data, mode = 'edit') {
        const modal = document.getElementById('modalPastor');
        const form = document.getElementById('formPastorModal');
        const title = document.getElementById('modalTitle');
        const desc = document.getElementById('modalDesc');
        const submitBtn = document.getElementById('modalSubmitBtn');
        const cancelBtn = document.getElementById('modalCancelBtn');
        const closeIcon = document.getElementById('modalCloseIcon');
        const uploadArea = document.getElementById('modal_upload_container');
        const methodInput = document.getElementById('modalMethod');
        const displaySection = document.getElementById('displaySection');
        const formSection = document.getElementById('formSection');
        const footer = document.getElementById('modalFooter');
        const headerPhotoBox = document.getElementById('modalHeaderPhotoBox');

        if (!modal || !form || !title || !desc || !displaySection || !formSection) {
            console.error('Modal elements missing');
            return;
        }

        modal.classList.remove('hidden');
        form.classList.remove('hidden');

        const errorContainers = ['modal_nama_container', 'modal_jabatan_container', 'modal_tahun_selesai_container'];
        const errorMsgs = ['modal_nama_error_msg', 'modal_jabatan_error_msg', 'modal_tahun_selesai_error_msg'];
        
        errorContainers.forEach(id => {
            const el = document.getElementById(id);
            if(el) el.classList.remove('error');
        });
        errorMsgs.forEach(id => {
            const el = document.getElementById(id);
            if(el) el.classList.add('hidden');
        });

        [displaySection, formSection, headerPhotoBox, footer, submitBtn, cancelBtn].forEach(el => {
            if(el) el.classList.add('hidden');
        });
        if(closeIcon) closeIcon.classList.remove('hidden');

        if (mode === 'view') {
            displaySection.classList.remove('hidden');
            
            title.innerText = data.nama_pastor || 'Detail Pastor';
            title.className = "text-xl font-semibold text-gray-900";
            desc.innerText = data.jabatan || 'Informasi lengkap pastor paroki';
            desc.className = "text-sm text-gray-500 mt-0.5 font-medium"; 

            if (headerPhotoBox) {
                headerPhotoBox.classList.remove('hidden');
                const headerFoto = document.getElementById('display_header_foto');
                const headerPlaceholder = document.getElementById('display_header_placeholder');
                
                if (data.foto_pastor) {
                    if(headerFoto) {
                        headerFoto.src = "/storage/FotoPastor/" + data.foto_pastor;
                        headerFoto.classList.remove('hidden');
                    }
                    if(headerPlaceholder) headerPlaceholder.classList.add('hidden');
                } else {
                    if(headerFoto) headerFoto.classList.add('hidden');
                    if(headerPlaceholder) headerPlaceholder.classList.remove('hidden');
                }
            }

            const tm = document.getElementById('display_tahun_mulai');
            const ts = document.getElementById('display_tahun_selesai');
            const bd = document.getElementById('display_status_badge');
            const mk = document.getElementById('display_masa_karya');

            if(tm) tm.innerText = data.tahun_mulai || '-';
            if(ts) ts.innerText = data.tahun_selesai || 'Masih Menjabat';
            
            if(bd && mk) {
                if (data.status == 1) {
                    bd.innerText = "AKTIF";
                    bd.className = "inline-flex px-2 py-0.5 rounded text-[10px] font-bold bg-green-50 text-green-600 uppercase tracking-wider border border-green-100";
                    mk.innerText = `Mulai: ${data.tahun_mulai}`;
                } else {
                    bd.innerText = "TIDAK AKTIF";
                    bd.className = "inline-flex px-2 py-0.5 rounded text-[10px] font-bold bg-gray-50 text-gray-400 uppercase tracking-wider border border-gray-100";
                    mk.innerText = `${data.tahun_mulai} - ${data.tahun_selesai || '?'}`;
                }
            }

        } else {
            formSection.classList.remove('hidden');
            if(footer) footer.classList.remove('hidden');
            if(submitBtn) submitBtn.classList.remove('hidden');
            if(cancelBtn) {
                cancelBtn.classList.remove('hidden');
                cancelBtn.innerText = "Batal";
            }
            if(closeIcon) closeIcon.classList.add('hidden'); 

            title.innerText = "Edit Data Pastor";
            title.className = "text-xl font-semibold text-gray-800";
            desc.innerText = "Ubah informasi pastor paroki";
            desc.className = "text-xs text-gray-400 mt-0.5";

            if(methodInput) methodInput.value = "PATCH";
            form.action = updateUrlBase + "/" + data.id;

            const inputs = [
                {id: 'modal_nama_pastor', key: 'nama_pastor'},
                {id: 'modal_jabatan', key: 'jabatan'},
                {id: 'modal_tahun_mulai', key: 'tahun_mulai'},
                {id: 'modal_tahun_selesai', key: 'tahun_selesai'}
            ];

            inputs.forEach(item => {
                const el = document.getElementById(item.id);
                if (el) {
                    el.value = data[item.key] ?? "";
                    el.disabled = false; 
                }
            });

            const stAktif = document.getElementById('modal_status_aktif');
            const stNonaktif = document.getElementById('modal_status_nonaktif');
            if(stAktif && stNonaktif) {
                stAktif.disabled = false;
                stNonaktif.disabled = false;
                if (data.status == 1) {
                    stAktif.checked = true;
                    toggleStatusInputsModal(true);
                } else {
                    stNonaktif.checked = true;
                    toggleStatusInputsModal(false);
                }
            }

            const preview = document.getElementById('modal_preview');
            const previewContainer = document.getElementById('modal_preview_container');
            const uploadContainer = document.getElementById('modal_upload_container');
            
            if (preview && previewContainer && uploadContainer) {
                if (data.foto_pastor) {
                    preview.src = "/storage/FotoPastor/" + data.foto_pastor;
                    previewContainer.classList.remove('hidden');
                    uploadContainer.classList.add('hidden');
                    const nameDisplay = document.getElementById('modal_filename_display');
                    const sizeDisplay = document.getElementById('modal_filesize_display');
                    if(nameDisplay) nameDisplay.textContent = data.foto_pastor;
                    if(sizeDisplay) sizeDisplay.textContent = "Gambar tersimpan";
                } else {
                    preview.src = "";
                    previewContainer.classList.add('hidden');
                    uploadContainer.classList.remove('hidden');
                }
            }
        }
        updateModalSubmitState();
    }

    function hapus(id) {
        SwalHelper.confirmDelete('pastor ini').then((result) => {
            if (result.isConfirmed) {
                const f = document.getElementById('formDelete');
                f.action = "/admin-pastor-paroki/destroy/" + id;
                f.submit();
            }
        });
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
        document.getElementById('modal_upload_container').classList.remove('hidden');
        document.getElementById('modal_remove_foto_val').value = "1";
    }
    function validateNamaPastor() {
        const nameInput = document.getElementById('modal_nama_pastor');
        const container = document.getElementById('modal_nama_container');
        const errorMsg = document.getElementById('modal_nama_error_msg');
        
        if (!nameInput || !container || !errorMsg) return;

        const rawVal = nameInput.value.trim();
        const lowerVal = rawVal.toLowerCase();
        
        const formAction = document.getElementById('formPastorModal').action;
        const currentIdMatch = formAction.match(/\/update\/(\d+)/);
        const currentId = currentIdMatch ? parseInt(currentIdMatch[1]) : null;

        const isDuplicate = allPastors.some(p => p.nama === lowerVal && p.id !== currentId);

        if (isDuplicate) {
            container.classList.add('error');
            errorMsg.innerText = "Nama pastor ini sudah ada di database.";
            errorMsg.classList.remove('hidden');
        } else {
            container.classList.remove('error');
            errorMsg.classList.add('hidden');
        }
        updateModalSubmitState();
    }

    function updateModalSubmitState() {
        const submitBtn = document.querySelector('#formPastorModal button[type="submit"]');
        if (!submitBtn) return;

        const nameEl = document.getElementById('modal_nama_container');
        const jabatanEl = document.getElementById('modal_jabatan_container');
        const tahunSelesaiEl = document.getElementById('modal_tahun_selesai_container');

        const nameError = nameEl ? nameEl.classList.contains('error') : false;
        const jabatanError = jabatanEl ? jabatanEl.classList.contains('error') : false;
        const tahunSelesaiError = tahunSelesaiEl ? tahunSelesaiEl.classList.contains('error') : false;

        if (nameError || jabatanError || tahunSelesaiError) {
            submitBtn.disabled = true;
            submitBtn.style.opacity = "0.5";
            submitBtn.style.cursor = "not-allowed";
        } else {
            submitBtn.disabled = false;
            submitBtn.style.opacity = "1";
            submitBtn.style.cursor = "pointer";
        }
    }

    function validateTahun() {
        const mulaiInput = document.getElementById('modal_tahun_mulai');
        const selesaiInput = document.getElementById('modal_tahun_selesai');
        const container = document.getElementById('modal_tahun_selesai_container');
        const errorMsg = document.getElementById('modal_tahun_selesai_error_msg');

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
        updateModalSubmitState();
    }

    function validateJabatan() {
        const jabatanInput = document.getElementById('modal_jabatan');
        const statusAktif = document.getElementById('modal_status_aktif');
        const container = document.getElementById('modal_jabatan_container');
        const errorMsg = document.getElementById('modal_jabatan_error_msg');
        
        if (!jabatanInput || !statusAktif || !container || !errorMsg) return;

        const rawVal = jabatanInput.value.trim();
        const jabatanVal = rawVal.toLowerCase().replace(/\s+/g, ' ');
        const isPastorParoki = jabatanVal.includes('pastor paroki');
        
        const formAction = document.getElementById('formPastorModal').action;
        const currentIdMatch = formAction.match(/\/update\/(\d+)/);
        const currentId = currentIdMatch ? parseInt(currentIdMatch[1]) : null;

        let isError = false;
        let msg = "";

        if (statusAktif.checked) {
            if (isPastorParoki && activePastorParokiId !== null && currentId !== activePastorParokiId) {
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
        updateModalSubmitState();
    }

    let modalValidator;
    document.addEventListener('DOMContentLoaded', function() {
        modalValidator = new FormValidator('formPastorModal');
        
        modalValidator.addValidation('modal_nama_pastor', [
            'required',
            modalValidator.rules.minLength(5),
            modalValidator.rules.maxLength(100)
        ]);
        
        modalValidator.addValidation('modal_tahun_mulai', ['required']);
        modalValidator.addValidation('modal_jabatan', [
            modalValidator.rules.maxLength(50)
        ]);
        modalValidator.addValidation('modal_tahun_selesai', []);
        
        modalValidator.init();

        const modalNama = document.getElementById('modal_nama_pastor');
        const modalJabatan = document.getElementById('modal_jabatan');
        const modalTahunMulai = document.getElementById('modal_tahun_mulai');
        const modalTahunSelesai = document.getElementById('modal_tahun_selesai');
        const statusAktif = document.getElementById('modal_status_aktif');
        const statusNonAktif = document.getElementById('modal_status_nonaktif');

        if(modalNama) {
            modalNama.addEventListener('input', validateNamaPastor);
            modalNama.addEventListener('blur', validateNamaPastor);
        }
        if(modalJabatan) {
            modalJabatan.addEventListener('input', validateJabatan);
            modalJabatan.addEventListener('blur', validateJabatan);
        }
        if(modalTahunMulai) {
            modalTahunMulai.addEventListener('input', validateTahun);
            modalTahunMulai.addEventListener('blur', validateTahun);
        }
        if(modalTahunSelesai) {
            modalTahunSelesai.addEventListener('input', validateTahun);
            modalTahunSelesai.addEventListener('blur', validateTahun);
        }
        if(statusAktif) statusAktif.addEventListener('change', validateJabatan);
        if(statusNonAktif) statusNonAktif.addEventListener('change', validateJabatan);
    });
    
    function submitEditPastor() {
        if (typeof validateNamaPastor === 'function') validateNamaPastor();
        if (typeof validateJabatan === 'function') validateJabatan();
        if (typeof validateTahun === 'function') validateTahun();
        const hasError = document.querySelector('#formPastorModal .error') !== null;
        
        if (modalValidator) {
            if (!modalValidator.validateForm()) {
                return;
            }
        }
        
        if (hasError) {
             SwalHelper.error('Gagal', 'Mohon periksa inputan yang bertanda merah.');
             return;
        }

        SwalHelper.confirmEdit('Pastor Paroki').then((result) => {
            if (result.isConfirmed) {
                document.getElementById('formPastorModal').submit();
            }
        });
    }
</script>
@endpush






