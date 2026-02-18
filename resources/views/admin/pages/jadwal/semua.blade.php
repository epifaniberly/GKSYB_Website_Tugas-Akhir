<div class="space-y-4 fs-style-manrope">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-3 md:gap-4 w-full">
        <div class="relative col-span-1 md:col-span-2 min-w-0">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                </svg>
            </div>
            <input type="text" id="searchJadwal" placeholder="Cari jadwal..."
                class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-[#8C1007] focus:border-[#8C1007] placeholder-gray-400 text-[12px] md:text-sm mobile-font-tiny text-gray-700 h-[42px]">
        </div>
        
        <div class="relative col-span-1 min-w-0">
            <select id="kategoriJadwalFilter"
                class="w-full border border-gray-300 rounded-lg px-4 py-2 bg-white text-gray-700 focus:outline-none focus:ring-1 focus:ring-[#8C1007] focus:border-[#8C1007] text-[12px] md:text-sm mobile-font-tiny h-[42px] appearance-none cursor-pointer">
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
            <select id="statusJadwalFilter"
                class="w-full border border-gray-300 rounded-lg px-4 py-2 bg-white text-gray-700 focus:outline-none focus:ring-1 focus:ring-[#8C1007] focus:border-[#8C1007] text-[12px] md:text-sm mobile-font-tiny h-[42px] appearance-none cursor-pointer">
                <option value="">Semua Status</option>
                <option value="1">Published</option>
                <option value="0">Draft</option>
            </select>
            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-gray-400">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
            </div>
        </div>
    </div>


    <div id="jadwal-list-container">
        @include('admin.pages.jadwal.components.list')
    </div>
</div>

@include('admin.pages.jadwal.components.dialog')

@push('script')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://npmcdn.com/flatpickr/dist/l10n/id.js"></script>

<script>
    var searchJadwal = document.getElementById('searchJadwal');
    var kategoriJadwalFilter = document.getElementById('kategoriJadwalFilter');
    var statusJadwalFilter = document.getElementById('statusJadwalFilter');

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

    function fetchJadwal() {
        var search = searchJadwal ? searchJadwal.value : '';
        var kategori = kategoriJadwalFilter ? kategoriJadwalFilter.value : '';
        var status = statusJadwalFilter ? statusJadwalFilter.value : '';

        fetch(`{{ route('admin.jadwal.index') }}?search=${search}&kategori=${kategori}&status=${status}`, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(response => response.text())
        .then(html => {
            var container = document.getElementById('jadwal-list-container');
            if (container) container.innerHTML = html;
        });
    }

    if (searchJadwal) searchJadwal.addEventListener('input', debounce(fetchJadwal, 500));
    if (kategoriJadwalFilter) kategoriJadwalFilter.addEventListener('change', fetchJadwal);
    if (statusJadwalFilter) statusJadwalFilter.addEventListener('change', fetchJadwal);

    let editDatePicker;

    function initEditDatePicker(mode) {
        if (editDatePicker) editDatePicker.destroy();
        editDatePicker = flatpickr("#edit_tanggal_picker", {
            mode: mode === 'range' ? 'range' : 'single',
            dateFormat: "d F Y",
            locale: "id",
            disableMobile: "true",
            minDate: "today",
            rangeSeparator: " - "
        });
    }

    function switchEditType(type) {
        const rutin = document.getElementById('sectionEditRutin');
        const khusus = document.getElementById('sectionEditKhusus');
        const btnR = document.getElementById('btnEditTypeRutin');
        const btnK = document.getElementById('btnEditTypeKhusus');
        document.getElementById('edit_tipe_jadwal').value = type;

        if (type === 'rutin') {
            rutin.classList.remove('hidden');
            khusus.classList.add('hidden');
            btnR.className = "flex-1 py-1.5 text-xs font-medium rounded-lg transition-all bg-white text-[#8C1007] shadow-sm";
            btnK.className = "flex-1 py-1.5 text-xs font-medium rounded-lg transition-all text-gray-500";
        } else {
            rutin.classList.add('hidden');
            khusus.classList.remove('hidden');
            btnK.className = "flex-1 py-1.5 text-xs font-medium rounded-lg transition-all bg-white text-[#8C1007] shadow-sm";
            btnR.className = "flex-1 py-1.5 text-xs font-medium rounded-lg transition-all text-gray-500";

            const mode = document.querySelector('input[name="edit_khusus_mode"]:checked').value;
            initEditDatePicker(mode);
        }
    }

    function toggleEditRutinMode(mode) {
        const divEnd = document.getElementById('divEditHariEnd');
        const labelStart = document.getElementById('labelEditHariStart');
        if (mode === 'range') {
            divEnd.classList.remove('hidden');
            labelStart.innerText = "Dari Hari";
        } else {
            divEnd.classList.add('hidden');
            labelStart.innerText = "Hari";
        }
    }

    function toggleEditKhususMode(mode) {
        initEditDatePicker(mode);
        document.getElementById('edit_tanggal_picker').value = '';
    }

    function toggleEditWaktuMode(mode) {
        const divEnd = document.getElementById('divEditWaktuEnd');
        const labelStart = document.getElementById('labelEditWaktuStart');
        if (mode === 'range') {
            divEnd.classList.remove('hidden');
            labelStart.innerText = "Mulai";
        } else {
            divEnd.classList.add('hidden');
            labelStart.innerText = "Mulai";
        }
    }

    function bukaEdit(data) {
        const modal = document.getElementById('modalEdit');
        if(!modal) return;
        
        modal.classList.remove('hidden');

        const isKhusus = data.hari && /\d/.test(data.hari);
        const type = isKhusus ? 'khusus' : 'rutin';
        switchEditType(type);

        const isRangeHari = data.hari && data.hari.includes(" - ");
        if (type === 'rutin') {
            if (isRangeHari) {
                const parts = data.hari.split(" - ");
                document.getElementById('edit_rutin_range').checked = true;
                toggleEditRutinMode('range');
                document.getElementById('edit_hari_start').value = parts[0];
                document.getElementById('edit_hari_end').value = parts[1];
            } else {
                document.getElementById('edit_rutin_single').checked = true;
                toggleEditRutinMode('single');
                document.getElementById('edit_hari_start').value = data.hari;
            }
        } else {
            const rangeMode = isRangeHari ? 'range' : 'single';
            if (isRangeHari) document.getElementById('edit_khusus_range').checked = true;
            else document.getElementById('edit_khusus_single').checked = true;
            initEditDatePicker(rangeMode);
            document.getElementById('edit_tanggal_picker').value = data.hari;
        }

        const isRangeWaktu = data.waktu && data.waktu.includes(" - ");
        if (isRangeWaktu) {
            const parts = data.waktu.split(" - ");
            document.getElementById('edit_waktu_range').checked = true;
            toggleEditWaktuMode('range');
            document.getElementById('edit_waktu_start').value = parts[0];
            document.getElementById('edit_waktu_end').value = parts[1];
        } else {
            document.getElementById('edit_waktu_single').checked = true;
            toggleEditWaktuMode('single');
            document.getElementById('edit_waktu_start').value = data.waktu;
        }

        document.getElementById('edit_id').value = data.id;
        document.getElementById('edit_nama').value = data.nama_jadwal;
        document.getElementById('edit_kategori').value = data.kategori_jadwal_id;
        document.getElementById('edit_lokasi').value = data.lokasi;
        document.getElementById('edit_keterangan').value = data.keterangan ?? '';
        if (data.is_active) {
            document.getElementById('edit_status_publish').checked = true;
        } else {
            document.getElementById('edit_status_draft').checked = true;
        }

        document.getElementById('formEdit').action = `/admin-jadwal-doa/update/${data.id}`;
    }

    function tutupModal(){
        const modal = document.getElementById('modalEdit');
        if(modal) modal.classList.add('hidden');
    }

    function validateEditTimeInput() {
        const wMode = document.querySelector('input[name="edit_waktu_mode"]:checked').value;
        const wStart = document.getElementById('edit_waktu_start').value;
        const wEnd = document.getElementById('edit_waktu_end').value;
        const inputEnd = document.getElementById('edit_waktu_end');
        const errorMsg = document.getElementById('edit_waktu_error');

        inputEnd.classList.remove('border-red-500', 'focus:border-red-500');
        inputEnd.classList.add('border-gray-200', 'focus:ring-[#8C1007]', 'focus:border-[#8C1007]');
        errorMsg.classList.add('hidden');

        if (wMode === 'range' && wStart && wEnd) {
             if (wEnd < wStart) {
                inputEnd.classList.remove('border-gray-200', 'focus:ring-[#8C1007]', 'focus:border-[#8C1007]');
                inputEnd.classList.add('border-red-500', 'focus:ring-red-500', 'focus:border-red-500');
                errorMsg.classList.remove('hidden');
                return false;
             }
        }
        return true;
    }

    document.getElementById('edit_waktu_start').addEventListener('change', validateEditTimeInput);
    document.getElementById('edit_waktu_end').addEventListener('change', validateEditTimeInput);

    document.addEventListener('DOMContentLoaded', function() {
        const editValidator = new FormValidator('formEdit');
        
        editValidator.addValidation('nama_jadwal', ['required']);
        editValidator.addValidation('kategori_jadwal_id', ['required']);
        editValidator.addValidation('lokasi', ['required']);
        
        editValidator.init();

        const formEdit = document.getElementById('formEdit');
        if(formEdit) {
            formEdit.addEventListener('submit', function(e){
                e.preventDefault();

                if (!validateEditTimeInput()) {
                    return;
                }
                if (!editValidator.validateForm()) {
                    return;
                }

                const type = document.getElementById('edit_tipe_jadwal').value;
                const finalHari = document.getElementById('edit_hari_final');
                const finalWaktu = document.getElementById('edit_waktu_final');

                if (type === 'rutin') {
                    const mode = document.querySelector('input[name="edit_rutin_mode"]:checked').value;
                    const start = document.getElementById('edit_hari_start').value;
                    const end = document.getElementById('edit_hari_end').value;
                    
                    if (mode === 'range' && start === end) {
                        finalHari.value = start;
                    } else {
                        finalHari.value = (mode === 'range') ? (start + " - " + end) : start;
                    }
                } else {
                    let val = document.getElementById('edit_tanggal_picker').value;
                    if (val.includes(' - ')) {
                        const [dStart, dEnd] = val.split(' - ');
                        if (dStart === dEnd) finalHari.value = dStart;
                        else finalHari.value = val;
                    } else {
                        finalHari.value = val;
                    }
                }

                const wMode = document.querySelector('input[name="edit_waktu_mode"]:checked').value;
                const wStart = document.getElementById('edit_waktu_start').value;
                const wEnd = document.getElementById('edit_waktu_end').value;
                
                if (wMode === 'range' && wStart === wEnd) {
                    finalWaktu.value = wStart;
                } else {
                    finalWaktu.value = (wMode === 'range') ? (wStart + " - " + wEnd) : wStart;
                }

                SwalHelper.confirmEdit('jadwal ini').then((result) => {
                    if (result.isConfirmed) {
                        this.submit();
                    }
                });
            });
        }
    });

    function hapusJadwal(id){
        SwalHelper.confirmDelete('jadwal ini').then((result) => {
            if(result.isConfirmed){
                document.getElementById(`form-delete-${id}`).submit();
            }
        });
    }
</script>
@endpush






