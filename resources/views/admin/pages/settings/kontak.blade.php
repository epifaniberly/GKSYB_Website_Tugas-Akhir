<div class="max-w-4xl">
    <form id="kontakForm" action="{{ route('admin.kontak.store') }}" method="POST" class="space-y-5" novalidate>
        @csrf
        <input type="hidden" name="id" value="{{ $kontak->id ?? '' }}">
        <div id="alamat_container" class="space-y-2">
            <label class="block text-[12px] sm:text-sm font-semibold text-gray-700">
                Alamat Lengkap <span class="text-red-500">*</span>
            </label>
            <div class="relative">
                <textarea
                    name="alamat"
                    id="alamat"
                    rows="4"
                    placeholder="Masukkan alamat lengkap gereja..."
                    class="w-full px-4 py-3 bg-white border border-gray-200 rounded-xl focus:ring-1 focus:ring-[#8C1007] focus:border-[#8C1007] outline-none transition-all text-gray-700 font-medium text-sm placeholder-gray-400 resize-none font-manrope"
                    required
                >{{ ($kontak->alamat ?? '') == 'Alamat belum diatur' ? '' : ($kontak->alamat ?? '') }}</textarea>
            </div>
        </div>
        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
            <div id="telepon_container" class="space-y-2">
                <label class="block text-[12px] sm:text-sm font-semibold text-gray-700">
                    Nomor Telepon <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <input
                        name="telepon"
                        id="telepon"
                        value="{{ ($kontak->telepon ?? '') == '-' ? '' : ($kontak->telepon ?? '') }}"
                        placeholder="Masukkan nomor telepon (contoh: 0274-123456)"
                        class="w-full h-[42px] sm:h-[48px] pr-4 bg-white border border-gray-200 rounded-xl focus:ring-1 focus:ring-[#8C1007] focus:border-[#8C1007] outline-none transition-all text-gray-700 font-medium text-sm placeholder-gray-400"
                        style="padding-left: 3.2rem !important;"
                        required
                    >
                    <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                    </svg>
                </div>
            </div>

            <div id="whatsapp_container" class="space-y-2">
                <label class="block text-[12px] sm:text-sm font-semibold text-gray-700">
                    WhatsApp <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <input
                        name="whatsapp"
                        id="whatsapp"
                        value="{{ ($kontak->whatsapp ?? '') == '-' ? '' : ($kontak->whatsapp ?? '') }}"
                        placeholder="Masukkan nomor WhatsApp (contoh: 628123456789)"
                        class="w-full h-[42px] sm:h-[48px] pr-4 bg-white border border-gray-200 rounded-xl focus:ring-1 focus:ring-[#8C1007] focus:border-[#8C1007] outline-none transition-all text-gray-700 font-medium text-sm placeholder-gray-400"
                        style="padding-left: 3.2rem !important;"
                        oninput="updateWaLink(this.value)"
                        required
                    >
                    <div class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-green-500">
                        <svg fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                    </div>
                </div>
                <div class="mt-1.5 px-1">
                    <a id="wa_link_display" 
                       href="https://wa.me/{{ $kontak->whatsapp ?? '' }}" 
                       target="_blank"
                       class="inline-flex items-center gap-2 text-green-600 hover:text-green-700 font-semibold text-sm transition-colors group"
                    >
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                        <span class="group-hover:underline decoration-2 underline-offset-4">Kirim Pesan WhatsApp</span>
                    </a>
                </div>
            </div>
        </div>

        <div id="email_container" class="space-y-2">
            <label class="block text-[12px] sm:text-sm font-semibold text-gray-700">
                Email Sekretariat <span class="text-red-500">*</span>
            </label>
            <div class="relative">
                <input
                    type="email"
                    name="email"
                    id="email"
                    value="{{ ($kontak->email ?? '') == '-' ? '' : ($kontak->email ?? '') }}"
                    placeholder="Masukkan email (contoh: sekretariat@gksyb.com)"
                    class="w-full h-[42px] sm:h-[48px] pr-4 bg-white border border-gray-200 rounded-xl focus:ring-1 focus:ring-[#8C1007] focus:border-[#8C1007] outline-none transition-all text-gray-700 font-medium text-sm placeholder-gray-400"
                    style="padding-left: 3.2rem !important;"
                    required
                >
                <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                </svg>
            </div>
        </div>
        <div class="pt-8 border-t border-gray-100">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-medium text-gray-800">Jam Pelayanan Sekretariat</h3>

                <button
                    type="button"
                    onclick="openModal()"
                    class="text-white text-[9px] sm:text-[12px] font-medium hover:opacity-90 transition-opacity focus:outline-none inline-flex items-center gap-1.5 sm:gap-2 whitespace-nowrap !px-3.5 !py-1.5 sm:!px-8 sm:!py-2.5"
                    style="background:#8C1007 !important; border-radius: 0.5rem !important;"
                >
                    <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 opacity-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path>
                    </svg>
                    <span>Tambah Jam Pelayanan</span>
                </button>
            </div>
            <div class="space-y-3">
                @foreach($kontak->jamPelayanan ?? [] as $jam)
                    <div class="w-full bg-[#F9FAFB] border border-gray-100 p-5 rounded-xl flex items-center justify-between group transition-all">
                        <div class="space-y-1">
                            <h4 class="text-[16px] font-medium text-gray-800">{{ $jam->hari_dari }} - {{ $jam->hari_sampai }}</h4>
                            <p class="text-sm text-gray-400 font-medium">
                                {{ $jam->jam_mulai }} WIB - {{ $jam->jam_selesai }} WIB
                            </p>
                        </div>
                        
                        <div class="flex items-center gap-2">
                            <button type="button" @click='openEditJam(@json($jam))' class="p-2 hover:bg-yellow-50 rounded-lg transition-colors" style="color: #eab308;" title="Edit">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </button>
                            <button type="button" onclick="confirmDeleteJam('{{ route('admin.kontak.jam.destroy',$jam->id) }}')" class="p-2 hover:bg-red-50 rounded-lg transition-colors" style="color: #ef4444;" title="Hapus">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7h6m-7 0V5a1 1 0 011-1h4a1 1 0 011 1v2"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                @endforeach
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
        const kontakValidator = new FormValidator('kontakForm');
        const jamValidator = new FormValidator('jamForm');
        
        kontakValidator.addValidation('alamat', ['required']);
        kontakValidator.addValidation('telepon', ['required']);
        kontakValidator.addValidation('whatsapp', ['required']);
        kontakValidator.addValidation('email', ['required', 'email']);

        jamValidator.addValidation('hari_dari', ['required']);
        jamValidator.addValidation('jam_mulai', ['required']);
        jamValidator.addValidation('jam_selesai', ['required']);
        
        kontakValidator.init();
        jamValidator.init();

        const lastSuccessMessage = "{{ session('swal_success') }}";
        const isJamChange = lastSuccessMessage.toLowerCase().includes('jam pelayanan');

        const initChangeDetection = (formId) => {
            const form = document.getElementById(formId);
            const btn = form.querySelector('button[type="submit"]');
            if (!form || !btn) return;

            const serializeContactData = () => {
                const formData = new FormData(form);
                const data = {};
                for (let [key, val] of formData.entries()) {
                    if (key === '_token') continue;
                    data[key] = val;
                }
                return JSON.stringify(data);
            };

            const initialData = serializeContactData();

            const updateButton = () => {
                const currentData = serializeContactData();
                const hasChanged = currentData !== initialData;
                
                const shouldEnable = hasChanged || (isJamChange && !hasChanged);
                
                btn.disabled = !shouldEnable;
                if (shouldEnable) {
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
        
        initChangeDetection('kontakForm');

        const kontakForm = document.getElementById('kontakForm');
        kontakForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const form = this;
            if (kontakValidator.validateForm()) {
                SwalHelper.confirmEdit('Data Kontak').then(result => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            }
        });

        const jamForm = document.getElementById('jamForm');
        if (jamForm) {
            jamForm.addEventListener('submit', function(e) {
                e.preventDefault();
                const form = this;
                const method = document.getElementById('formMethod').value;
                const isEdit = method === 'PUT';

                if (jamValidator.validateForm()) {
                    if (isEdit) {
                        SwalHelper.confirmEdit('Jam Pelayanan').then(result => {
                            if (result.isConfirmed) form.submit();
                        });
                    } else {
                        form.submit();
                    }
                }
            });
        }

        window.jamValidator = jamValidator;
    });
</script>
@endpush

@include('admin.pages.settings.components.dialog-jam')

<script>
    function openModal() {
        document.getElementById('modalJam').classList.remove('hidden')
        document.getElementById('modalJam').classList.add('flex')
        document.getElementById('modalTitle').innerText = 'Tambah Jam Pelayanan'
        document.getElementById('jamForm').action = "{{ route('admin.kontak.jam.store') }}"
        document.getElementById('formMethod').value = 'POST'
        document.getElementById('jamForm').reset()
        
        const btnSubmit = document.getElementById('btnSubmitJam');
        if (btnSubmit) btnSubmit.querySelector('span').innerText = 'Simpan Jam Pelayanan';

        if (window.jamValidator) window.jamValidator.clearErrors()
    }

    function openEditJam(jam) {
        openModal()
        document.getElementById('modalTitle').innerText = 'Edit Jam Pelayanan'
        document.getElementById('jamForm').action = `/admin/kontak/jam/${jam.id}`
        document.getElementById('jam_id').value = jam.id
        document.getElementById('formMethod').value = 'PUT'
        document.getElementById('hari_dari').value = jam.hari_dari
        document.getElementById('hari_sampai').value = jam.hari_sampai
        document.getElementById('jam_mulai').value = jam.jam_mulai
        document.getElementById('jam_selesai').value = jam.jam_selesai

        const btnSubmit = document.getElementById('btnSubmitJam');
        if (btnSubmit) btnSubmit.querySelector('span').innerText = 'Simpan Perubahan';

        if (window.jamValidator) window.jamValidator.clearErrors()
    }

    function closeModal() {
        document.getElementById('modalJam').classList.add('hidden')
        document.getElementById('modalJam').classList.remove('flex')
    }

    function confirmDeleteJam(url) {
        SwalHelper.confirmDelete('jam pelayanan ini').then((result) => {
            if (result.isConfirmed) {
                const form = document.createElement('form')
                form.method = 'POST'
                form.action = url
                form.innerHTML = `@csrf<input type="hidden" name="_method" value="DELETE">`
                document.body.appendChild(form)
                form.submit()
            }
        })
    }

    function updateWaLink(value) {
        const link = document.getElementById('wa_link_display');
        if(link) link.href = `https://wa.me/${value}`;
    }
</script>
