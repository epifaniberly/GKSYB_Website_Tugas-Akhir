<div
    id="modalJam"
    class="fixed inset-0 z-50 hidden bg-black/40 items-center justify-center p-4 backdrop-blur-sm"
>
    <div class="w-full max-w-xl bg-white rounded-3xl shadow-2xl overflow-hidden transform transition-all border border-gray-200">
        <div class="flex items-center justify-between px-8 py-5 border-b border-gray-100">
            <h3 id="modalTitle" class="text-xl font-semibold text-gray-800">
                Tambah Jam Pelayanan
            </h3>
        </div>

        <form id="jamForm" method="POST" action="{{ route('admin.kontak.jam.store') }}" class="p-8 space-y-6" x-data="{ mode: 'rentang' }" novalidate>
            @csrf
            <input type="hidden" name="id" id="jam_id">
            <input type="hidden" name="kontak_id" value="{{ $kontak->id ?? '' }}">
            <input type="hidden" name="_method" id="formMethod">
            <div class="flex items-center gap-6 pb-2">
                <label class="flex items-center gap-2 cursor-pointer group">
                    <input type="radio" name="mode_hari" value="tunggal" x-model="mode" @change="updatePreview()" class="w-4 h-4 text-[#8C1007] border-gray-300 focus:ring-[#8C1007]">
                    <span class="text-[12px] sm:text-sm font-medium text-gray-700 group-hover:text-gray-900 transition-colors">Hari Tunggal</span>
                </label>
                <label class="flex items-center gap-2 cursor-pointer group">
                    <input type="radio" name="mode_hari" value="rentang" x-model="mode" @change="updatePreview()" class="w-4 h-4 text-[#8C1007] border-gray-300 focus:ring-[#8C1007]" checked>
                    <span class="text-[12px] sm:text-sm font-medium text-gray-700 group-hover:text-gray-900 transition-colors">Rentang Hari</span>
                </label>
            </div>
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <div class="space-y-2">
                    <label class="block text-[12px] sm:text-sm font-medium text-gray-700" x-text="mode === 'tunggal' ? 'Pilih Hari' : 'Dari Hari'"><span class="text-red-500">*</span></label>
                    <div class="relative">
                        <select
                            name="hari_dari"
                            id="hari_dari"
                            class="w-full h-10 px-4 bg-white border border-gray-200 rounded-xl focus:ring-1 focus:ring-[#8C1007] focus:border-[#8C1007] outline-none transition-all text-[12px] sm:text-sm font-medium appearance-none"
                            style="background-image: url('data:image/svg+xml;charset=UTF-8,%3csvg xmlns=\'http://www.w3.org/2000/svg\' fill=\'none\' stroke=\'%236b7280\' stroke-width=\'2\' stroke-linecap=\'round\' stroke-linejoin=\'round\' class=\'feather feather-chevron-down\' viewBox=\'0 0 24 24\'%3e%3cpolyline points=\'6 9 12 15 18 9\'%3e%3c/polyline%3e%3c/svg%3e'); background-repeat: no-repeat; background-position: right 1rem center; background-size: 1em;"
                            onchange="updatePreview()"
                            required
                        >
                            @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'] as $hari)
                                <option value="{{ $hari }}">{{ $hari }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="space-y-2" x-show="mode === 'rentang'" x-transition>
                    <label class="block text-[12px] sm:text-sm font-medium text-gray-700">Sampai Hari <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <select
                            name="hari_sampai"
                            id="hari_sampai"
                            class="w-full h-10 px-4 bg-white border border-gray-200 rounded-xl focus:ring-1 focus:ring-[#8C1007] focus:border-[#8C1007] outline-none transition-all text-[12px] sm:text-sm font-medium appearance-none"
                            style="background-image: url('data:image/svg+xml;charset=UTF-8,%3csvg xmlns=\'http://www.w3.org/2000/svg\' fill=\'none\' stroke=\'%236b7280\' stroke-width=\'2\' stroke-linecap=\'round\' stroke-linejoin=\'round\' class=\'feather feather-chevron-down\' viewBox=\'0 0 24 24\'%3e%3cpolyline points=\'6 9 12 15 18 9\'%3e%3c/polyline%3e%3c/svg%3e'); background-repeat: no-repeat; background-position: right 1rem center; background-size: 1em;"
                            onchange="updatePreview()"
                            :required="mode === 'rentang'"
                        >
                            <option value="" disabled selected hidden>- Pilih -</option>
                            @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'] as $hari)
                                <option value="{{ $hari }}">{{ $hari }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <div class="space-y-2">
                    <label class="block text-[12px] sm:text-sm font-medium text-gray-700">Jam Mulai <span class="text-red-500">*</span></label>
                    <input
                        type="time"
                        name="jam_mulai"
                        id="jam_mulai"
                        class="w-full h-10 px-4 bg-white border border-gray-200 rounded-xl focus:ring-1 focus:ring-[#8C1007] focus:border-[#8C1007] outline-none transition-all text-[12px] sm:text-sm font-medium"
                        required
                        oninput="updatePreview()"
                    >
                </div>

                <div class="space-y-2">
                    <label class="block text-[12px] sm:text-sm font-medium text-gray-700">Jam Selesai <span class="text-red-500">*</span></label>
                    <input
                        type="time"
                        id="jam_selesai"
                        name="jam_selesai"
                        class="w-full h-10 px-4 bg-white border border-gray-200 rounded-xl focus:ring-1 focus:ring-[#8C1007] focus:border-[#8C1007] outline-none transition-all text-[12px] sm:text-sm font-medium"
                        required
                        oninput="updatePreview()"
                    >
                </div>
            </div>
            <div class="rounded-xl border border-blue-100 bg-[#F0F7FF] p-4 space-y-2">
                <p class="text-[13px] font-medium text-gray-400">Preview:</p>
                <div id="jam_preview" class="space-y-0.5">
                    <p id="preview_hari" class="text-[16px] font-semibold text-gray-800">Senin - ...</p>
                    <p id="preview_jam" class="text-[15px] font-medium text-gray-500">00.00 WIB - 00.00 WIB</p>
                </div>
            </div>
            <div class="flex justify-end gap-3 pt-6 border-t border-gray-100">
                <button
                    type="button"
                    onclick="closeModal()"
                    class="px-6 h-10 rounded-xl border border-gray-200 text-gray-600 font-semibold text-sm hover:bg-gray-50 transition-all bg-white focus:outline-none"
                >
                    Batal
                </button>

                <button
                    type="submit"
                    id="btnSubmitJam"
                    class="text-white text-[12px] font-medium hover:opacity-90 transition-opacity focus:outline-none"
                    style="background:#8C1007 !important; border-radius: 0.5rem !important; padding: 10px 32px !important;"
                >
                    <span>Simpan Jam Pelayanan</span>
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function updatePreview() {
        const modeInput = document.querySelector('input[name="mode_hari"]:checked');
        const mode = modeInput ? modeInput.value : 'rentang';
        
        const dari = document.getElementById('hari_dari').value;
        const sampai = document.getElementById('hari_sampai').value;
        const mulai = document.getElementById('jam_mulai').value || '00:00';
        const selesai = document.getElementById('jam_selesai').value || '00:00';

        updateSampaiHariOptions();

        if(mode === 'tunggal') {
            document.getElementById('preview_hari').innerText = dari;
        } else {
            if(sampai) {
                document.getElementById('preview_hari').innerText = `${dari} - ${sampai}`;
            } else {
                document.getElementById('preview_hari').innerText = `${dari} - ...`;
            }
        }
        
        document.getElementById('preview_jam').innerText = `${mulai} WIB - ${selesai} WIB`;
    }

    function updateSampaiHariOptions() {
        const dariHari = document.getElementById('hari_dari').value;
        const sampaiSelect = document.getElementById('hari_sampai');
        const currentSampai = sampaiSelect.value;
        
        Array.from(sampaiSelect.options).forEach(option => {
            if(option.value !== '') {
                option.disabled = false;
            }
        });
        
        Array.from(sampaiSelect.options).forEach(option => {
            if(option.value === dariHari) {
                option.disabled = true;
                if(currentSampai === dariHari) {
                    sampaiSelect.value = '';
                    updatePreview();
                }
            }
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        updateSampaiHariOptions();
    });
</script>







