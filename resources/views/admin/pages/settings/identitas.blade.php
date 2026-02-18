@php
    $formData = $identitas ? [
        'route' => route('admin.identitas.update', $identitas->id),
        'method' => 'POST',
        'hasMethodPatch' => true,
        'nama' => $identitas->nama_website,
        'logo' => $identitas->logo
    ] : [
        'route' => route('admin.identitas.store'),
        'method' => 'POST',
        'hasMethodPatch' => false,
        'nama' => '',
        'logo' => null
    ];
@endphp

<div class="max-w-4xl" x-data="{ 
    isOver: false, 
    preview: '{{ $formData['logo'] ? asset('storage/'.$formData['logo']) : '' }}',
    fileName: '{{ $formData['logo'] ? basename($formData['logo']) : '' }}'
}">
    <form id="identitasForm" action="{{ $formData['route'] }}" method="POST" enctype="multipart/form-data" class="space-y-6" novalidate>
        @csrf
        @if($formData['hasMethodPatch'])
            @method('PATCH')
        @endif
        <div id="nama_website_container" class="space-y-2">
            <label class="block text-[12px] sm:text-sm font-semibold text-gray-700">Nama Website <span class="text-red-500">*</span></label>
            <div class="relative">
                <input 
                    type="text" 
                    name="nama_website" 
                    id="nama_website"
                    value="{{ old('nama_website', $formData['nama']) }}"
                    placeholder="Masukkan nama website"
                    class="w-full h-[40px] sm:h-[48px] px-4 bg-white border border-gray-200 rounded-xl focus:ring-1 focus:ring-[#8C1007] focus:border-[#8C1007] outline-none transition-all text-gray-700 font-medium text-sm placeholder-gray-400"
                    required
                >
            </div>
        </div>
        <div id="logo_container" class="space-y-2">
            <label class="block text-[12px] sm:text-sm font-semibold text-gray-700">Logo Website <span class="text-red-500">*</span></label>
            
            <div class="relative">
                <input 
                    type="text" 
                    id="logo_checker" 
                    name="logo_checker" 
                    :value="preview ? 'active' : ''" 
                    class="peer absolute opacity-0 pointer-events-none w-px h-px" 
                    required
                    readonly
                >

                <input 
                    type="file" 
                    name="logo" 
                    id="logo"
                    class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10"
                    accept="image/png, image/jpeg, image/jpg"
                    x-show="!preview"
                    @change="
                        const file = $event.target.files[0];
                        if (file) {
                            if (file.size > 10 * 1024 * 1024) {
                                SwalHelper.error('Ukuran Terlalu Besar', 'Ukuran file maksimal 10MB.');
                                $event.target.value = '';
                                return;
                            }
                            fileName = file.name;
                            const reader = new FileReader();
                            reader.onload = (e) => { preview = e.target.result; };
                            reader.readAsDataURL(file);
                        }
                    "
                    @dragover.prevent="isOver = true"
                    @dragleave.prevent="isOver = false"
                    @drop="isOver = false"
                >
                <div 
                    x-show="!preview"
                    :class="isOver ? 'border-[#8C1007] bg-[#FFF3F2]/30' : 'border-gray-200 bg-gray-50/30'"
                    class="w-full py-12 px-6 border-2 border-dashed border-gray-200 rounded-2xl transition-all flex flex-col items-center justify-center text-center group group-hover:border-[#8C1007] group-hover:bg-[#FFF3F2]/30 peer-[.border-red-500]:!border-red-500 peer-[.border-red-500]:!bg-red-50"
                >
                    <svg class="w-10 h-10 text-gray-400 mb-4 group-hover:text-[#8C1007] transition-colors peer-[.border-red-500]:text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <p class="text-[12px] sm:text-sm font-medium text-gray-700 mb-1 peer-[.border-red-500]:text-red-900">Klik untuk upload foto atau drag & drop</p>
                    <p class="text-xs text-gray-400 tracking-tight peer-[.border-red-500]:text-red-700">JPG, JPEG, PNG (Maks. 10MB)</p>
                </div>
                <div x-show="preview" x-cloak class="p-4 border border-gray-100 rounded-xl bg-gray-50 flex items-center gap-4">
                    <div class="w-16 h-16 bg-white rounded-lg overflow-hidden border border-gray-200 flex-shrink-0 flex items-center justify-center p-2">
                        <img :src="preview" class="max-w-full max-h-full object-contain">
                    </div>
                    <div class="flex-1 overflow-hidden">
                        <p class="text-[12px] sm:text-sm font-medium text-gray-700 truncate" x-text="fileName || 'logo-website.png'"></p>
                        <p class="text-xs text-gray-400 mt-1">Siap untuk diunggah</p>
                    </div>
                    <button type="button" 
                        @click="preview = ''; fileName = ''; document.getElementById('logo').value = ''" 
                        class="p-2 text-gray-400 hover:text-red-500 transition-colors focus:outline-none"
                    >
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
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
        const identitasValidator = new FormValidator('identitasForm');
        
        identitasValidator.addValidation('nama_website', ['required']);
        identitasValidator.addValidation('logo_checker', ['required']);
        
        identitasValidator.init();

        const initChangeDetection = (formId) => {
            const form = document.getElementById(formId);
            const btn = form.querySelector('button[type="submit"]');
            if (!form || !btn) return;

            const serializeForm = () => {
                const formData = new FormData(form);
                const data = {};
                for (let [key, val] of formData.entries()) {
                    if (key === '_token') continue;
                    if (val instanceof File) {
                        if (val.name && val.size > 0) data[key] = val.name + val.size;
                    } else {
                        data[key] = val;
                    }
                }
                return JSON.stringify(data);
            };

            const initialData = serializeForm();

            const updateButton = () => {
                const currentData = serializeForm();
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
        
        initChangeDetection('identitasForm');

        const identitasForm = document.getElementById('identitasForm');
        identitasForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const isValid = identitasValidator.validateForm();
            
            if (isValid) {
                SwalHelper.confirmEdit('Identitas Website').then(result => {
                    if (result.isConfirmed) {
                        this.submit();
                    }
                });
            }
        });
    });
</script>
@endpush
