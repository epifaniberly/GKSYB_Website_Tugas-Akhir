<div class="max-w-4xl">
    <div class="bg-amber-50 border border-amber-100 p-6 rounded-2xl mb-8 flex items-start gap-4 text-amber-800">
        <div class="w-10 h-10 bg-amber-100 rounded-xl flex items-center justify-center shrink-0">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
            </svg>
        </div>
        <div>
            <h4 class="text-[12px] sm:text-sm font-semibold">SEO & Visibilitas Website</h4>
            <p class="text-xs mt-1 leading-relaxed opacity-80">
                Pengaturan ini membantu website gereja lebih mudah ditemukan di Google. Isi deskripsi dan kata kunci secara relevan agar umat dapat menjangkau informasi dengan cepat.
            </p>
        </div>
    </div>

    <form id="seoForm" action="{{ route('admin.seo.store') }}" method="POST" class="space-y-6" novalidate>
        @csrf
        <input type="hidden" name="id" value="{{ $seo->id ?? '' }}">
        <div id="meta_desc_container" class="space-y-2">
            <label class="block text-[12px] sm:text-sm font-semibold text-gray-700">Meta Description</label>
            <div class="relative">
                <textarea
                    name="meta_desc"
                    id="meta_desc"
                    rows="3"
                    placeholder="Berikan ringkasan singkat mengenai website paroki Anda..."
                    class="w-full px-4 py-3 bg-white border border-gray-200 rounded-xl focus:ring-1 focus:ring-[#8C1007] focus:border-[#8C1007] outline-none transition-all text-gray-700 font-medium text-sm placeholder-gray-400 shadow-sm resize-none"
                    required
                >{{ $seo->meta_desc ?? '' }}</textarea>
            </div>
            <p class="text-[11px] text-gray-400 font-medium">* Rekomendasi: 150 - 160 karakter untuk hasil pencarian Google terbaik.</p>
        </div>
        <div id="meta_keyword_container" class="space-y-2">
            <label class="block text-[12px] sm:text-sm font-semibold text-gray-700">Meta Keywords</label>
            <div class="relative">
                <input
                    name="meta_keyword"
                    id="meta_keyword"
                    value="{{ $seo->meta_keyword ?? '' }}"
                    placeholder="Masukkan kata kunci SEO (contoh: gereja bintaran, jadwal misa jogja, santo yusup...)"
                    class="w-full h-[42px] sm:h-[48px] px-4 bg-white border border-gray-200 rounded-xl focus:ring-1 focus:ring-[#8C1007] focus:border-[#8C1007] outline-none transition-all text-gray-700 font-medium text-sm placeholder-gray-400 shadow-sm"
                >
            </div>
            <p class="text-[11px] text-gray-400 font-medium">* Pisahkan setiap kata kunci dengan tanda koma (,)</p>
        </div>
        <div id="google_id_container" class="space-y-2">
            <label class="block text-[12px] sm:text-sm font-semibold text-gray-700">Google Analytics ID</label>
            <div class="relative">
                <input
                    name="google_id"
                    id="google_id"
                    value="{{ $seo->google_id ?? '' }}"
                    placeholder="Masukkan Google Analytics ID (contoh: G-XXXXXXXXXX)"
                    class="w-full h-[42px] sm:h-[48px] px-4 bg-white border border-gray-200 rounded-xl focus:ring-1 focus:ring-[#8C1007] focus:border-[#8C1007] outline-none transition-all text-gray-700 font-medium text-sm placeholder-gray-400 shadow-sm"
                >
            </div>
            <p class="text-[11px] text-gray-400 font-medium">* Masukkan kode ID Analytics untuk memantau trafik pengunjung website.</p>
        </div>
        <div class="pt-2">
            <div class="flex items-center justify-between p-4 bg-red-50 border border-red-100 rounded-xl transition-all">
                <div class="flex flex-col">
                    <span class="text-[12px] sm:text-sm font-semibold text-red-900">Maintenance Mode</span>
                    <p class="text-[11px] text-red-700 font-medium">Aktifkan untuk menutup akses publik sementara.</p>
                </div>
                
                <label class="relative inline-flex items-center cursor-pointer">
                    <input 
                        type="checkbox" 
                        name="maintenance_mode" 
                        value="1" 
                        {{ isset($seo) && $seo->maintenance_mode ? 'checked' : '' }}
                        class="sr-only peer"
                    >
                    <div class="w-11 h-6 bg-gray-300 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-red-600"></div>
                </label>
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
        const seoValidator = new FormValidator('seoForm');
        
        seoValidator.addValidation('meta_desc', ['required']);
        
        seoValidator.init();

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
        
        initChangeDetection('seoForm');

        const seoForm = document.getElementById('seoForm');
        seoForm.addEventListener('submit', function(e) {
            e.preventDefault();
            if (seoValidator.validateForm()) {
                SwalHelper.confirmEdit('Pengaturan SEO').then(result => {
                    if (result.isConfirmed) {
                        this.submit();
                    }
                });
            }
        });
    });
</script>
@endpush
