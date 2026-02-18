@include('sweetalert::alert')

<section data-aos="fade-up" class="max-w-4xl mx-auto px-6 py-12 fs-style-manrope">
    <div class="text-center mb-12">
        <h2 class="text-xl md:text-3xl lg:text-4xl font-semibold text-[#3E0703] mb-4 leading-tight">
            Permohonan Intensi dan Ujud Doa
        </h2>
        <p class="text-xs md:text-base text-[#3A0D0D] leading-relaxed max-w-4xl opacity-90 mx-auto mb-8">
            Sampaikan ujud dan intensi doa Anda agar dapat didoakan bersama dalam Perayaan Ekaristi Mingguan. Setiap permohonan yang masuk akan dikumpulkan dan didoakan dengan khidmat oleh umat dan imam.
        </p>

        <div class="w-full max-w-[315px] md:max-w-xl mx-auto">
            <div class="px-4 py-5 md:p-8 bg-white rounded-2xl border border-gray-100 shadow-sm transition-all hover:shadow-md text-left">
                <h3 class="font-semibold text-[#3E0703] mb-3 md:mb-4 text-sm md:text-xl">Panduan Pengisian</h3>
                <ul class="text-[11px] md:text-base text-[#3E0703]/70 space-y-2 md:space-y-3 list-disc list-outside ml-3 leading-relaxed tracking-tight">
                    <li>Pastikan nama dan nomor telepon valid untuk konfirmasi</li>
                    <li>Pilih jenis permohonan yang sesuai dengan ujud Anda</li>
                    <li>Tentukan tanggal dan jadwal misa permohonan dibacakan</li>
                    <li>Tuliskan isi doa dengan jelas, tulus, dan ringkas</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="w-full max-w-3xl mx-auto">
        <form id="ujudForm" action="{{ route('landing.ujud.store') }}" method="POST" class="border border-gray-100 rounded-2xl p-8 md:p-10 shadow-sm bg-white" novalidate>
            @csrf
            <div class="block">
                <div class="mb-6 md:mb-8">
                    <label class="block text-xs md:text-base text-[#3E0703] mb-2" for="nama">Nama Lengkap</label>
                    <input id="nama" name="nama" type="text" required value="{{ old('nama') }}" placeholder="Masukkan Nama Lengkap Anda" class="w-full border border-gray-100 rounded-lg px-3 py-2 text-xs md:text-base placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-[#3E0703] focus:border-[#3E0703] transition-colors @error('nama') border-red-500 @enderror" />
                    @error('nama')
                        <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                <div class="mb-6 md:mb-8">
                    <label class="block text-xs md:text-base text-[#3E0703] mb-2" for="nomor_telepon">Nomor Telepon</label>
                    <div class="flex items-center">
                        <span class="bg-gray-50 border border-r-0 border-gray-100 rounded-l-lg px-3 py-2 text-xs md:text-base text-gray-500 font-medium select-none">+62</span>
                        <input id="nomor_telepon" name="nomor_telepon" type="tel" required value="{{ old('nomor_telepon') }}" placeholder="81234567890" class="w-full border border-gray-100 rounded-r-lg px-3 py-2 text-xs md:text-base placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-[#3E0703] focus:border-[#3E0703] transition-colors @error('nomor_telepon') border-red-500 @enderror" oninput="this.value = this.value.replace(/[^0-9]/g, ''); if(this.value.startsWith('0')) this.value = this.value.substring(1);" />
                    </div>
                    @error('nomor_telepon')
                        <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 md:gap-6 mb-6 md:mb-8">
                    <div>
                        <label class="block text-xs md:text-base text-[#3E0703] mb-2" for="asal_paroki">Asal Paroki</label>
                        <input id="asal_paroki" name="asal_paroki" type="text" required value="{{ old('asal_paroki') }}" placeholder="Asal Paroki Anda" class="w-full border border-gray-100 rounded-lg px-3 py-2 text-xs md:text-base placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-[#3E0703] focus:border-[#3E0703] transition-colors @error('asal_paroki') border-red-500 @enderror" />
                        @error('asal_paroki')
                            <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-xs md:text-base text-[#3E0703] mb-2" for="asal_lingkungan">Asal Lingkungan <span class="text-gray-400 font-normal text-[10px]">(Opsional)</span></label>
                        <input id="asal_lingkungan" name="asal_lingkungan" type="text" value="{{ old('asal_lingkungan') }}" placeholder="Asal Lingkungan Anda" class="w-full border border-gray-100 rounded-lg px-3 py-2 text-xs md:text-base placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-[#3E0703] focus:border-[#3E0703] transition-colors @error('asal_lingkungan') border-red-500 @enderror" />
                        @error('asal_lingkungan')
                            <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mb-6 md:mb-8">
                    <label class="block text-xs md:text-base text-[#3E0703] mb-2" for="jenis_permohonan">Jenis Permohonan</label>
                    <select id="jenis_permohonan" name="jenis_permohonan" required class="w-full border border-gray-100 rounded-lg px-3 py-2 text-xs md:text-base focus:outline-none focus:ring-1 focus:ring-[#3E0703] focus:border-[#3E0703] transition-colors bg-white @error('jenis_permohonan') border-red-500 @enderror">
                        <option value="">-- Pilih Jenis --</option>
                        <option value="Syukur" {{ old('jenis_permohonan') == 'Syukur' ? 'selected' : '' }}>Syukur</option>
                        <option value="Kesembuhan" {{ old('jenis_permohonan') == 'Kesembuhan' ? 'selected' : '' }}>Kesembuhan</option>
                        <option value="Keluarga" {{ old('jenis_permohonan') == 'Keluarga' ? 'selected' : '' }}>Doa Keluarga</option>
                        <option value="Ujud Pribadi" {{ old('jenis_permohonan') == 'Ujud Pribadi' ? 'selected' : '' }}>Ujud Pribadi</option>
                        <option value="Lainnya" {{ old('jenis_permohonan') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                    </select>
                    @error('jenis_permohonan')
                        <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 md:gap-6 mb-6 md:mb-8">
                    <div>
                        <label class="block text-xs md:text-base text-[#3E0703] mb-2" for="jadwal_misa">Jadwal Misa</label>
                        <select id="jadwal_misa" name="jadwal_misa" required class="w-full border border-gray-100 rounded-lg px-3 py-2 text-xs md:text-base focus:outline-none focus:ring-1 focus:ring-[#3E0703] focus:border-[#3E0703] transition-colors bg-white @error('jadwal_misa') border-red-500 @enderror">
                            <option value="">-- Pilih Jadwal --</option>
                            <option value="sabtu sore jam 17.00" {{ old('jadwal_misa') == 'sabtu sore jam 17.00' ? 'selected' : '' }}>Sabtu Sore Jam 17.00</option>
                            <option value="minggu pagi jam 08.30" {{ old('jadwal_misa') == 'minggu pagi jam 08.30' ? 'selected' : '' }}>Minggu Pagi Jam 08.30</option>
                            <option value="minggu sore jam 17.00" {{ old('jadwal_misa') == 'minggu sore jam 17.00' ? 'selected' : '' }}>Minggu Sore Jam 17.00</option>
                        </select>
                        @error('jadwal_misa')
                            <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-xs md:text-base text-[#3E0703] mb-2" for="tanggal_intensi">Tanggal Intensi</label>
                        <input id="tanggal_intensi" name="tanggal_intensi" type="date" required value="{{ old('tanggal_intensi') }}" class="w-full border border-gray-100 rounded-lg px-3 py-2 text-xs md:text-base focus:outline-none focus:ring-1 focus:ring-[#3E0703] focus:border-[#3E0703] transition-colors @error('tanggal_intensi') border-red-500 @enderror" />
                        <p id="date-error" class="text-red-600 text-[10px] mt-1 hidden"></p>
                    </div>
                </div>

                <div class="mb-6 md:mb-8">
                    <label class="block text-xs md:text-base text-[#3E0703] mb-2" for="isi_doa">Isi Doa / Intensi</label>
                    <textarea id="isi_doa" name="isi_doa" rows="5" required placeholder="Tuliskan ujud atau intensi doa Anda di sini..." class="w-full border border-gray-100 rounded-lg px-3 py-2 text-xs md:text-base placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-[#3E0703] focus:border-[#3E0703] transition-colors @error('isi_doa') border-red-500 @enderror">{{ old('isi_doa') }}</textarea>
                    @error('isi_doa')
                        <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="p-6 bg-[#FCFAF7] border border-dashed border-[#3E0703]/20 rounded-xl flex flex-col sm:flex-row items-center justify-between gap-6 text-center sm:text-left">
                    <div class="flex flex-col sm:flex-row items-center gap-4">
                        <div class="w-12 h-12 bg-[#3E0703]/5 rounded-full flex items-center justify-center text-[#3E0703] flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a2.25 2.25 0 0 0-2.25-2.25H15a3 3 0 1 1-6 0H5.25A2.25 2.25 0 0 0 3 12m18 0v6a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 18v-6m18 0V9M3 12V9m18 0a2.25 2.25 0 0 0-2.25-2.25H5.25A2.25 2.25 0 0 0 3 9m18 0V6a2.25 2.25 0 0 0-2.25-2.25H5.25A2.25 2.25 0 0 0 3 6v3" />
                            </svg>
                        </div>
                        <div>
                            <h5 class="text-base font-semibold text-[#3E0703]">Persembahan Sukarela?</h5>
                            <p class="text-xs text-[#3E0703]/60 max-w-[240px] sm:max-w-none mx-auto sm:mx-0">Dukung pelayanan gereja kami melalui persembahan kasih.</p>
                        </div>
                    </div>
                    <div class="w-full sm:w-auto">
                        <a href="{{ route('landing.donasi') }}" class="btn-accent inline-block px-8 py-2.5 text-xs md:text-sm font-medium hover:opacity-90 transition-opacity w-full sm:w-auto">Donasi Sekarang</a>
                    </div>
                </div>

                <div class="pt-6 text-center">
                    <button type="submit" class="btn-accent inline-block px-4 py-1.5 md:px-8 md:py-2.5 text-[10px] md:text-sm font-medium hover:opacity-90 transition-opacity w-full sm:w-auto shadow-md hover:shadow-lg transition-all">Kirim Permohonan Doa</button>
                </div>
            </div>
        </form>
    </div>
</section>

<script src="{{ asset('js/form-validation.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const validator = new FormValidator('ujudForm');
        validator.init();

        const dateInput = document.getElementById('tanggal_intensi');
        const jadwalSelect = document.getElementById('jadwal_misa');
        const today = new Date();
        const yyyy = today.getFullYear();
        const mm = String(today.getMonth() + 1).padStart(2, '0');
        const dd = String(today.getDate()).padStart(2, '0');
        const minDate = `${yyyy}-${mm}-${dd}`;
        dateInput.setAttribute('min', minDate);

        function validateDay() {
            const dateValue = dateInput.value;
            const jadwalValue = jadwalSelect.value.toLowerCase();
            if (!dateValue || !jadwalValue) {
                validator.clearError(dateInput);
                return;
            }

            const parts = dateValue.split('-');
            const selectedDate = new Date(parts[0], parts[1] - 1, parts[2]);
            const dayIndex = selectedDate.getDay(); 

            let requiredDayIndex = -1;
            let requiredDayName = '';

            if (jadwalValue.includes('sabtu')) {
                requiredDayIndex = 6;
                requiredDayName = 'Sabtu';
            } else if (jadwalValue.includes('minggu')) {
                requiredDayIndex = 0; 
                requiredDayName = 'Minggu';
            }

            if (requiredDayIndex !== -1 && dayIndex !== requiredDayIndex) {
                 validator.showError(dateInput, `Tanggal tidak sesuai jadwal. Harap pilih hari ${requiredDayName}.`);
                 
                 dateInput.value = ''; 
            } else {
                 validator.clearError(dateInput);
            }
        }

        dateInput.addEventListener('change', validateDay);
        jadwalSelect.addEventListener('change', function() {
             if (dateInput.value) validateDay();
        });
    });
</script>
