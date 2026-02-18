<div class="max-w-4xl">
    <div class="bg-blue-50 border border-blue-100 p-6 rounded-2xl mb-8 flex items-start gap-4">
        <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center text-blue-600 shrink-0">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
        </div>
        <div>
            <h4 class="text-[12px] sm:text-sm font-semibold text-blue-900">Panduan Tautan Media Sosial</h4>
            <p class="text-xs text-blue-700 mt-1 leading-relaxed">
                Pastikan Anda memasukkan URL lengkap (misal: https://instagram.com/akun-gereja) agar sistem dapat menghubungkannya dengan benar ke halaman publik.
            </p>
        </div>
    </div>

    <form id="sosmedForm" action="{{ route('admin.sosmed.store') }}" method="POST" class="space-y-6" novalidate>
        @csrf
        <input type="hidden" name="id" value="{{ $medsos->id ?? '' }}">

        <div class="grid grid-cols-1 gap-6">
            <div id="url_ig_container" class="space-y-2">
                <label class="block text-[12px] sm:text-sm font-semibold text-gray-700 ml-[60px]">Instagram</label>
                <div class="flex items-center gap-3">
                    <div class="w-[42px] sm:w-[48px] h-[42px] sm:h-[48px] flex items-center justify-center rounded-xl bg-gray-50 border border-gray-100 shrink-0 shadow-sm overflow-hidden p-2">
                        <img src="{{ asset('assets/Instagram.png') }}" class="w-8 h-8 object-contain" alt="Instagram">
                    </div>
                    <input
                        name="url_ig"
                        id="url_ig"
                        type="url"
                        value="{{ $medsos->url_ig ?? '' }}"
                        placeholder="Masukkan URL Instagram (contoh: https://instagram.com/nama-paroki)"
                        class="w-full h-[42px] sm:h-[48px] px-4 bg-white border border-gray-200 rounded-xl focus:ring-1 focus:ring-[#8C1007] focus:border-[#8C1007] outline-none transition-all text-gray-700 font-medium text-sm placeholder-gray-400 shadow-sm"
                    >
                </div>
            </div>
            <div id="url_yt_container" class="space-y-2">
                <label class="block text-[12px] sm:text-sm font-semibold text-gray-700 ml-[60px]">YouTube Channel</label>
                <div class="flex items-center gap-3">
                    <div class="w-[42px] sm:w-[48px] h-[42px] sm:h-[48px] flex items-center justify-center rounded-xl bg-gray-50 border border-gray-100 shrink-0 shadow-sm overflow-hidden p-2">
                        <img src="{{ asset('assets/YouTube.png') }}" class="w-8 h-8 object-contain" alt="YouTube">
                    </div>
                    <input
                        name="url_yt"
                        id="url_yt"
                        type="url"
                        value="{{ $medsos->url_yt ?? '' }}"
                        placeholder="Masukkan URL YouTube (contoh: https://youtube.com/@channel-paroki)"
                        class="w-full h-[42px] sm:h-[48px] px-4 bg-white border border-gray-200 rounded-xl focus:ring-1 focus:ring-[#8C1007] focus:border-[#8C1007] outline-none transition-all text-gray-700 font-medium text-sm placeholder-gray-400 shadow-sm"
                    >
                </div>
            </div>
            <div id="url_tiktok_container" class="space-y-2">
                <label class="block text-[12px] sm:text-sm font-semibold text-gray-700 ml-[60px]">TikTok</label>
                <div class="flex items-center gap-3">
                    <div class="w-[42px] sm:w-[48px] h-[42px] sm:h-[48px] flex items-center justify-center rounded-xl bg-gray-50 border border-gray-100 shrink-0 shadow-sm overflow-hidden p-2">
                        <img src="{{ asset('assets/TikTok.png') }}" class="w-8 h-8 object-contain" alt="TikTok">
                    </div>
                    <input
                        name="url_tiktok"
                        id="url_tiktok"
                        type="url"
                        value="{{ $medsos->url_tiktok ?? '' }}"
                        placeholder="Masukkan URL TikTok (contoh: https://tiktok.com/@akun-paroki)"
                        class="w-full h-[42px] sm:h-[48px] px-4 bg-white border border-gray-200 rounded-xl focus:ring-1 focus:ring-[#8C1007] focus:border-[#8C1007] outline-none transition-all text-gray-700 font-medium text-sm placeholder-gray-400 shadow-sm"
                    >
                </div>
            </div>
            <div class="space-y-2">
                <label class="block text-[12px] sm:text-sm font-semibold text-gray-700 ml-[60px]">WhatsApp <span class="text-[11px] font-medium text-gray-400 ml-1">(Dikelola di tab Kontak)</span></label>
                <div class="flex items-center gap-3">
                    <div class="w-[42px] sm:w-[48px] h-[42px] sm:h-[48px] flex items-center justify-center rounded-xl bg-gray-50 border border-gray-100 shrink-0 shadow-sm overflow-hidden p-2">
                        <img src="{{ asset('assets/WhatsApp.png') }}" class="w-8 h-8 object-contain" alt="WhatsApp">
                    </div>
                    <div class="flex-1 w-full h-[42px] sm:h-[48px] px-4 bg-gray-50 border border-gray-200 rounded-xl flex items-center justify-between shadow-sm">
                        <div class="flex items-center gap-2">
                            <div class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></div>
                            <span class="text-[12px] sm:text-sm font-medium text-gray-600">
                                {{ $kontakGlobal->whatsapp ?? 'Belum diatur' }}
                            </span>
                        </div>
                        <a href="{{ route('admin.settings.index', ['tab' => 'kontak']) }}" class="text-[11px] font-semibold text-[#8C1007] hover:underline uppercase tracking-wider shrink-0 ml-4">Ubah di Kontak</a>
                    </div>
                </div>
            </div>
            <div id="url_gmaps_container" class="space-y-2">
                <label class="block text-[12px] sm:text-sm font-semibold text-gray-700 ml-[60px]">Google Maps <span class="text-[11px] font-medium text-gray-400 ml-1">(Tampil di Footer & Social Bar)</span></label>
                <div class="flex items-center gap-3">
                    <div class="w-[42px] sm:w-[48px] h-[42px] sm:h-[48px] flex items-center justify-center rounded-xl bg-gray-50 border border-gray-100 shrink-0 shadow-sm overflow-hidden p-2">
                        <img src="{{ asset('assets/maps.png') }}" class="w-8 h-8 object-contain" alt="Maps">
                    </div>
                    <div class="flex-1">
                        <input
                            name="url_gmaps"
                            id="url_gmaps"
                            type="url"
                            value="{{ $medsos->url_gmaps ?? '' }}"
                            placeholder="Masukkan URL Google Maps (contoh: https://maps.google.com/...)"
                            class="w-full h-[42px] sm:h-[48px] px-4 bg-white border border-gray-200 rounded-xl focus:ring-1 focus:ring-[#8C1007] focus:border-[#8C1007] outline-none transition-all text-gray-700 font-medium text-sm placeholder-gray-400 shadow-sm"
                        >
                    </div>
                </div>
                <p class="text-[11px] text-gray-400 font-medium ml-[60px]">* Masukkan link berbagi (*share link*) dari Google Maps untuk navigasi umat.</p>
            </div>
        </div>
        <div class="flex items-center gap-3 pt-6 border-t border-gray-100 mt-8 mb-6 text-sm">
            <button 
                type="submit"
                class="text-white text-[12px] font-medium hover:opacity-90 transition-opacity focus:outline-none inline-flex items-center gap-2"
                style="background:#8C1007 !important; border-radius: 0.5rem !important; padding: 10px 32px !important;"
            >
                <svg class="w-4 h-4 opacity-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path>
                </svg>
                <span>Simpan Perubahan</span>
            </button>
        </div>
    </form>
</div>

@push('script')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sosmedValidator = new FormValidator('sosmedForm');
        
        sosmedValidator.addValidation('url_ig', ['url']);
        sosmedValidator.addValidation('url_yt', ['url']);
        sosmedValidator.addValidation('url_tiktok', ['url']);
        sosmedValidator.addValidation('url_gmaps', ['url']);
        
        sosmedValidator.init();

        const initChangeDetection = (formId) => {
            const form = document.getElementById(formId);
            const btn = form.querySelector('button[type="submit"]');
            if (!form || !btn) return;

            const serializeData = () => {
                const formData = new FormData(form);
                const data = {};
                for (let [key, val] of formData.entries()) {
                    if (key === '_token') continue;
                    data[key] = val;
                }
                return JSON.stringify(data);
            };

            const initialData = serializeData();

            const updateButton = () => {
                const currentData = serializeData();
                const hasChanged = currentData !== initialData;
                
                btn.disabled = !hasChanged;
                if (hasChanged) {
                    btn.style.opacity = '1';
                    btn.style.cursor = 'pointer';
                } else {
                    btn.style.opacity = '0.5';
                    btn.style.cursor = 'not-allowed';
                }
            };

            updateButton();

            form.addEventListener('input', updateButton);
            form.addEventListener('change', updateButton);
        };
        
        initChangeDetection('sosmedForm');

        const sosmedForm = document.getElementById('sosmedForm');
        sosmedForm.addEventListener('submit', function(e) {
            e.preventDefault();
            if (sosmedValidator.validateForm()) {
                SwalHelper.confirmEdit('Media Sosial').then(result => {
                    if (result.isConfirmed) {
                        this.submit();
                    }
                });
            }
        });
    });
</script>
@endpush
