    <form id="formJadwal" action="{{ route('admin.jadwal.store') }}" method="POST" class="space-y-6" novalidate>
        @csrf
        <input type="hidden" id="method" name="_method" value="POST">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="md:col-span-2">
                <label for="nama_jadwal" class="block text-sm font-semibold text-gray-800 mb-2">Nama Jadwal <span class="text-red-500">*</span></label>
                <input type="text" name="nama_jadwal" id="nama_jadwal" required
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-[#8C1007] focus:ring-1 focus:ring-[#8C1007] text-sm transition-colors outline-none"
                    placeholder="Masukkan nama jadwal (contoh: Misa Pagi Hari Minggu)">
            </div>
            <div class="md:col-span-1">
                <label for="kategori_jadwal_id" class="block text-sm font-semibold text-gray-800 mb-2">Kategori <span class="text-red-500">*</span></label>
                <select name="kategori_jadwal_id" id="kategori_jadwal_id" required
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-[#8C1007] focus:ring-1 focus:ring-[#8C1007] text-sm transition-colors outline-none appearance-none cursor-pointer" 
                    style="background-image: url('data:image/svg+xml;charset=UTF-8,%3csvg xmlns=\'http://www.w3.org/2000/svg\' fill=\'none\' stroke=\'%236b7280\' stroke-width=\'2\' stroke-linecap=\'round\' stroke-linejoin=\'round\' class=\'feather feather-chevron-down\' viewBox=\'0 0 24 24\'%3e%3cpolyline points=\'6 9 12 15 18 9\'%3e%3c/polyline%3e%3c/svg%3e'); background-repeat: no-repeat; background-position: right 0.75rem center; background-size: 1em;">
                    <option value="" disabled selected hidden>Pilih kategori</option>
                    @foreach($kategori as $k)
                        <option value="{{ $k->id }}">{{ $k->nama_kategori }}</option>
                    @endforeach
                </select>
            </div>
            <div class="md:col-span-1">
                <label class="block text-sm font-semibold text-gray-800 mb-2">Tipe Penjadwalan <span class="text-red-500">*</span></label>
                <div class="flex p-1 bg-gray-100 rounded-lg h-[46px]">
                    <button type="button" onclick="switchScheduleType('rutin')" id="btnTypeRutin"
                        class="flex-1 py-1.5 text-xs font-medium rounded-lg transition-all bg-white text-[#8C1007] shadow-sm focus:outline-none">
                        Jadwal Rutin
                    </button>
                    <button type="button" onclick="switchScheduleType('khusus')" id="btnTypeKhusus"
                        class="flex-1 py-1.5 text-xs font-medium rounded-lg transition-all text-gray-500 focus:outline-none">
                        Jadwal Khusus
                    </button>
                </div>
                <input type="hidden" name="tipe_jadwal" id="tipe_jadwal" value="rutin">
            </div>
            <div id="sectionRutin" class="md:col-span-2 space-y-4 p-6 bg-white rounded-xl border border-gray-200 shadow-sm">
                <div class="flex items-center gap-6 pb-2">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="radio" name="rutin_mode" value="single" checked onchange="toggleRutinMode(this.value)"
                            class="w-4 h-4 text-[#8C1007] focus:ring-[#8C1007] border-gray-300">
                        <span class="text-xs font-semibold text-gray-700">Hari Tunggal</span>
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="radio" name="rutin_mode" value="range" onchange="toggleRutinMode(this.value)"
                            class="w-4 h-4 text-[#8C1007] focus:ring-[#8C1007] border-gray-300">
                        <span class="text-xs font-semibold text-gray-700">Rentang Hari</span>
                    </label>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div id="divHariStart" class="col-span-1">
                        <label for="hari_start" class="block text-sm font-semibold text-gray-800 mb-1.5" id="labelHariStart">Pilih Hari <span class="text-red-500">*</span></label>
                        <select id="hari_start" required class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-[#8C1007] focus:ring-1 focus:ring-[#8C1007] text-sm transition-colors outline-none appearance-none bg-white" style="background-image: url('data:image/svg+xml;charset=UTF-8,%3csvg xmlns=\'http://www.w3.org/2000/svg\' fill=\'none\' stroke=\'%236b7280\' stroke-width=\'2\' stroke-linecap=\'round\' stroke-linejoin=\'round\' class=\'feather feather-chevron-down\' viewBox=\'0 0 24 24\'%3e%3cpolyline points=\'6 9 12 15 18 9\'%3e%3c/polyline%3e%3c/svg%3e'); background-repeat: no-repeat; background-position: right 0.75rem center; background-size: 1em;">
                            @foreach(['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu'] as $h)
                                <option value="{{ $h }}">{{ $h }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div id="divHariEnd" class="col-span-1 hidden">
                        <label class="block text-sm font-semibold text-gray-800 mb-1.5">Sampai</label>
                        <select id="hari_end" class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-[#8C1007] focus:ring-0 text-sm transition-colors appearance-none bg-white" style="background-image: url('data:image/svg+xml;charset=UTF-8,%3csvg xmlns=\'http://www.w3.org/2000/svg\' fill=\'none\' stroke=\'%236b7280\' stroke-width=\'2\' stroke-linecap=\'round\' stroke-linejoin=\'round\' class=\'feather feather-chevron-down\' viewBox=\'0 0 24 24\'%3e%3cpolyline points=\'6 9 12 15 18 9\'%3e%3c/polyline%3e%3c/svg%3e'); background-repeat: no-repeat; background-position: right 0.75rem center; background-size: 1em;">
                            @foreach(['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu'] as $h)
                                <option value="{{ $h }}">{{ $h }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div id="sectionKhusus" class="md:col-span-2 space-y-4 hidden p-6 bg-white rounded-xl border border-gray-200 shadow-sm">
                <div class="flex items-center gap-6 pb-2">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="radio" name="khusus_mode" value="single" checked onchange="toggleKhususMode(this.value)"
                            class="w-4 h-4 text-[#8C1007] focus:ring-[#8C1007] border-gray-300">
                        <span class="text-xs font-semibold text-gray-700">Tanggal Tunggal</span>
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="radio" name="khusus_mode" value="range" onchange="toggleKhususMode(this.value)"
                            class="w-4 h-4 text-[#8C1007] focus:ring-[#8C1007] border-gray-300">
                        <span class="text-xs font-semibold text-gray-700">Rentang Tanggal</span>
                    </label>
                </div>
                <div class="relative">
                    <label for="tanggal_picker" class="block text-sm font-semibold text-gray-800 mb-1.5">Tanggal <span class="text-red-500">*</span></label>
                    <input type="text" id="tanggal_picker" required
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-[#8C1007] focus:ring-1 focus:ring-[#8C1007] text-sm transition-colors outline-none pr-10"
                        placeholder="Pilih tanggal" readonly>
                    <div class="absolute bottom-3 right-0 flex items-center pr-3 pointer-events-none">
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
            <input type="hidden" name="hari" id="final_hari">
            <div class="md:col-span-2 space-y-4 p-6 border border-gray-200 rounded-xl bg-white shadow-sm">
                <label class="block text-sm font-semibold text-gray-800">Waktu Perayaan <span class="text-red-500">*</span></label>
                <div class="flex items-center gap-6 pb-2">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="radio" name="waktu_mode" value="single" checked onchange="toggleWaktuMode(this.value)"
                            class="w-4 h-4 text-[#8C1007] focus:ring-[#8C1007] border-gray-300">
                        <span class="text-xs font-semibold text-gray-700">Tunggal</span>
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="radio" name="waktu_mode" value="range" onchange="toggleWaktuMode(this.value)"
                            class="w-4 h-4 text-[#8C1007] focus:ring-[#8C1007] border-gray-300">
                        <span class="text-xs font-semibold text-gray-700">Rentang</span>
                    </label>
                </div>
                
                <div class="grid grid-cols-2 gap-4">
                    <div id="divWaktuStart" class="col-span-1">
                        <label for="waktu_start" class="block text-sm font-semibold text-gray-800 mb-1.5" id="labelWaktuStart">Waktu <span class="text-red-500">*</span></label>
                        <input type="time" id="waktu_start" required
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-[#8C1007] focus:ring-1 focus:ring-[#8C1007] text-sm transition-colors outline-none">
                    </div>
                    <div id="divWaktuEnd" class="col-span-1 hidden">
                        <label for="waktu_end" class="block text-sm font-semibold text-gray-800 mb-1.5">Selesai</label>
                        <input type="time" id="waktu_end"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-[#8C1007] focus:ring-1 focus:ring-[#8C1007] text-sm transition-colors outline-none">
                    </div>
                </div>
                <p id="waktu_error" class="hidden text-xs text-red-500 font-medium mt-2 flex items-center gap-1">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span>Jam Selesai tidak boleh lebih awal dari Jam Mulai.</span>
                </p>
                <input type="hidden" name="waktu" id="final_waktu">
            </div>
            <div class="md:col-span-2">
                <label for="lokasi" class="block text-sm font-semibold text-gray-800 mb-2">Lokasi <span class="text-red-500">*</span></label>
                <input type="text" name="lokasi" id="lokasi" required
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-[#8C1007] focus:ring-1 focus:ring-[#8C1007] text-sm transition-colors outline-none"
                    placeholder="Masukkan lokasi (contoh: Gereja Utama)">
            </div>
            <div class="md:col-span-2">
                <label class="block text-sm font-semibold text-gray-800 mb-2">Keterangan (Opsional)</label>
                <textarea name="keterangan" id="keterangan" rows="3"
                    class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-[#8C1007] focus:ring-0 text-sm transition-colors resize-none"
                    placeholder="Masukkan keterangan (opsional)..."></textarea>
            </div>
            <div class="md:col-span-2">
                <label class="block text-sm font-semibold text-gray-800 mb-3">Status Publikasi</label>
                <div class="flex items-center gap-6">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="radio" name="is_active" value="0" id="status_draft" class="w-4 h-4 text-[#8C1007] focus:ring-[#8C1007] border-gray-300">
                        <span class="text-sm text-gray-700">Simpan sebagai Draft</span>
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="radio" name="is_active" value="1" id="status_publish" checked class="w-4 h-4 text-[#8C1007] focus:ring-[#8C1007] border-gray-300">
                        <span class="text-sm text-gray-700">Publikasikan</span>
                    </label>
                </div>
            </div>
        </div>
        <div class="flex items-center gap-3 pt-6 border-t border-gray-100 mt-8 mb-6 text-sm">
            <button type="submit"
                class="text-white text-[12px] font-medium hover:opacity-90 transition-opacity focus:outline-none"
                style="background:#8C1007 !important; border-radius: 0.5rem !important; padding: 10px 32px !important; display: inline-block !important;">
                Simpan Jadwal
            </button>
            <button type="button" onclick="resetForm()"
                class="bg-white border border-gray-200 text-gray-700 text-[12px] font-medium hover:bg-gray-50 transition-colors focus:outline-none"
                style="border-radius: 0.5rem !important; padding: 10px 32px !important; display: inline-block !important;">
                Reset
            </button>
        </div>
    </form>

@push('script')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://npmcdn.com/flatpickr/dist/l10n/id.js"></script>

<script>
    let datePicker;
    
    document.addEventListener('DOMContentLoaded', function() {
        initDatePicker('single');
    });

    function switchScheduleType(type) {
        const rutin = document.getElementById('sectionRutin');
        const khusus = document.getElementById('sectionKhusus');
        const btnR = document.getElementById('btnTypeRutin');
        const btnK = document.getElementById('btnTypeKhusus');
        const hiddenType = document.getElementById('tipe_jadwal');

        hiddenType.value = type;

        if (type === 'rutin') {
            rutin.classList.remove('hidden');
            khusus.classList.add('hidden');
            btnR.className = "flex-1 py-1.5 text-xs font-medium rounded-lg transition-all bg-white text-[#8C1007] shadow-sm";
            btnK.className = "flex-1 py-1.5 text-xs font-medium rounded-lg transition-all text-gray-500";
            
            enableInputs(rutin);
            disableInputs(khusus);

        } else {
            rutin.classList.add('hidden');
            khusus.classList.remove('hidden');
            btnK.className = "flex-1 py-1.5 text-xs font-medium rounded-lg transition-all bg-white text-[#8C1007] shadow-sm";
            btnR.className = "flex-1 py-1.5 text-xs font-medium rounded-lg transition-all text-gray-500";

            const mode = document.querySelector('input[name="khusus_mode"]:checked').value;
            initDatePicker(mode);
            
            enableInputs(khusus);
            disableInputs(rutin);
        }
    }

    function disableInputs(container) {
        const inputs = container.querySelectorAll('input, select, textarea');
        inputs.forEach(input => input.disabled = true);
    }

    function enableInputs(container) {
        const inputs = container.querySelectorAll('input, select, textarea');
        inputs.forEach(input => input.disabled = false);
    }

    function toggleRutinMode(mode) {
        const divEnd = document.getElementById('divHariEnd');
        const labelStart = document.getElementById('labelHariStart');
        if (mode === 'range') {
            divEnd.classList.remove('hidden');
            labelStart.innerHTML = 'Dari Hari <span class="text-red-500">*</span>';
        } else {
            divEnd.classList.add('hidden');
            labelStart.innerHTML = 'Pilih Hari <span class="text-red-500">*</span>';
        }
    }

    function toggleKhususMode(mode) {
        initDatePicker(mode);
        document.getElementById('tanggal_picker').value = '';
    }

    function toggleWaktuMode(mode) {
        const divEnd = document.getElementById('divWaktuEnd');
        const labelStart = document.getElementById('labelWaktuStart');
        const inputEnd = document.getElementById('waktu_end');
        if (mode === 'range') {
            divEnd.classList.remove('hidden');
            labelStart.innerHTML = 'Mulai <span class="text-red-500">*</span>';
            inputEnd.required = true;
        } else {
            divEnd.classList.add('hidden');
            labelStart.innerHTML = 'Waktu <span class="text-red-500">*</span>';
            inputEnd.required = false;
        }
    }

    function initDatePicker(mode) {
        if (datePicker) datePicker.destroy();
        datePicker = flatpickr("#tanggal_picker", {
            mode: mode === 'range' ? 'range' : 'single',
            dateFormat: "d F Y",
            locale: "id",
            disableMobile: "true",
            minDate: "today",
            rangeSeparator: " - ",
            onChange: function(selectedDates, dateStr, instance) {
                const target = instance.altInput || instance.input;
                if (target) {
                    target.classList.remove('border-red-500', 'bg-red-50');
                    target.style.borderColor = '';
                    target.style.backgroundColor = '';
                    document.getElementById('tanggal-error').classList.add('hidden');
                }
            },
            onClose: function(selectedDates, dateStr, instance) {
                if (selectedDates.length === 0) {
                    const target = instance.altInput || instance.input;
                    if (target) {
                        target.classList.add('border-red-500', 'bg-red-50');
                        target.style.borderColor = '#ef4444';
                        target.style.backgroundColor = '#fef2f2';
                        document.getElementById('tanggal-error').classList.remove('hidden');
                    }
                }
            }
        });
    }

    const formJadwal = document.getElementById('formJadwal');
    
    function resetForm(){
        formJadwal.reset();
        switchScheduleType('rutin');
        toggleRutinMode('single');
        toggleWaktuMode('single');
        initDatePicker('single');
        document.getElementById('status_publish').checked = true;
    }

    function validateTimeInput() {
        const wMode = document.querySelector('input[name="waktu_mode"]:checked').value;
        const wStart = document.getElementById('waktu_start').value;
        const wEnd = document.getElementById('waktu_end').value;
        const inputEnd = document.getElementById('waktu_end');
        const errorMsg = document.getElementById('waktu_error');

        inputEnd.classList.remove('border-red-500', 'focus:border-red-500');
        inputEnd.classList.add('border-gray-200', 'focus:border-[#8C1007]');
        errorMsg.classList.add('hidden');

        if (wMode === 'range' && wStart && wEnd) {
             if (wEnd < wStart) {
                inputEnd.classList.remove('border-gray-200', 'focus:border-[#8C1007]');
                inputEnd.classList.add('border-red-500', 'focus:border-red-500');
                errorMsg.classList.remove('hidden');
                return false;
             }
        }
        return true;
    }

    document.getElementById('waktu_start').addEventListener('change', validateTimeInput);
    document.getElementById('waktu_end').addEventListener('change', validateTimeInput);

    document.addEventListener('DOMContentLoaded', function() {
        const validator = new FormValidator('formJadwal');
        
        validator.addValidation('nama_jadwal', [
            'required',
            validator.rules.minLength(5),
            validator.rules.maxLength(100)
        ]);
        
        validator.addValidation('kategori_jadwal_id', ['required']);
        validator.addValidation('waktu_start', ['required']);
        validator.addValidation('lokasi', ['required']);
        
        validator.init();
    });

    formJadwal.addEventListener('submit', function(e){
        e.preventDefault();

        const validator = new FormValidator('formJadwal');
        if (!validator.validateForm()) {
            return; 
        }
        if (!validateTimeInput()) {
            return; 
        }

        const type = document.getElementById('tipe_jadwal').value;
        const finalHari = document.getElementById('final_hari');
        const finalWaktu = document.getElementById('final_waktu');
        
        if (type === 'rutin') {
            const mode = document.querySelector('input[name="rutin_mode"]:checked').value;
            const start = document.getElementById('hari_start').value;
            const end = document.getElementById('hari_end').value;
            if (mode === 'range' && start === end) {
                finalHari.value = start;
            } else if (mode === 'range') {
                finalHari.value = start + " - " + end;
            } else {
                finalHari.value = start;
            }
        } else {
            const tanggalInput = document.getElementById('tanggal_picker');
            let val = tanggalInput.value;
            if (!val) {
                const target = (datePicker && (datePicker.altInput || datePicker.input)) || tanggalInput;
                if (target) {
                    target.classList.add('border-red-500', 'bg-red-50');
                    target.style.borderColor = '#ef4444';
                    target.style.backgroundColor = '#fef2f2';
                    target.focus();
                    document.getElementById('tanggal-error').classList.remove('hidden');
                }
                return;
            }
            if (val.includes(' - ')) {
                const [dStart, dEnd] = val.split(' - ');
                if (dStart === dEnd) finalHari.value = dStart;
                else finalHari.value = val;
            } else {
                finalHari.value = val;
            }
        }

        const wMode = document.querySelector('input[name="waktu_mode"]:checked').value;
        const wStart = document.getElementById('waktu_start').value;
        const wEnd = document.getElementById('waktu_end').value;

        if (wMode === 'range' && wStart === wEnd) {
            finalWaktu.value = wStart;
        } else if (wMode === 'range') {
            if (!wEnd) {
                document.getElementById('waktu_end').classList.add('border-red-500', 'bg-red-50');
                document.getElementById('waktu_end').focus();
                return;
            }
            finalWaktu.value = wStart + " - " + wEnd;
        } else {
            finalWaktu.value = wStart;
        }

        this.submit();
    });

    document.getElementById('tanggal_picker').addEventListener('change', function() {
        this.classList.remove('border-red-500', 'bg-red-50');
        this.classList.add('border-gray-300');
    });
    document.getElementById('waktu_end').addEventListener('change', function() {
        this.classList.remove('border-red-500', 'bg-red-50');
        this.classList.add('border-gray-300');
    });

    document.addEventListener('DOMContentLoaded', function() {
        switchScheduleType('rutin');
    });
</script>
@endpush






