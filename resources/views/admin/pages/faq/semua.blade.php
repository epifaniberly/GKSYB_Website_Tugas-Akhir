<div class="space-y-6 fs-style-manrope">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="relative col-span-1 md:col-span-2">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                </svg>
            </div>
            <input type="text" id="searchFaq" placeholder="Cari pertanyaan atau jawaban..." 
                class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-[#8C1007] focus:border-[#8C1007] placeholder-gray-400 text-[12px] md:text-sm mobile-font-tiny text-gray-700 h-[42px]">
        </div>
        <div class="relative">
            <select id="kategoriFaqFilter" 
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
        <div class="relative">
            <select id="statusFaqFilter" 
                class="w-full border border-gray-300 rounded-lg px-4 py-2 bg-white text-gray-700 focus:outline-none focus:ring-1 focus:ring-[#8C1007] focus:border-[#8C1007] text-[12px] md:text-sm mobile-font-tiny h-[42px] appearance-none cursor-pointer">
                <option value="">Semua Status</option>
                <option value="1">Aktif</option>
                <option value="0">Nonaktif</option>
            </select>
            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-gray-400">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
            </div>
        </div>
    </div>
    <div id="faq-list-container">
        @include('admin.pages.faq.components.list', ['faq' => $faq])
    </div>
</div>

@include('admin.pages.faq.components.dialog', [
    'kategori' => $kategori,
])

@push('script')
<script>
    const searchFaq = document.getElementById('searchFaq');
    const kategoriFaqFilter = document.getElementById('kategoriFaqFilter');
    const statusFaqFilter = document.getElementById('statusFaqFilter');

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

    function fetchFaq() {
        const search = searchFaq ? searchFaq.value : '';
        const kategori = kategoriFaqFilter ? kategoriFaqFilter.value : '';
        const status = statusFaqFilter ? statusFaqFilter.value : '';

        fetch(`{{ route('admin.faq.index') }}?search=${search}&kategori=${kategori}&status=${status}`, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(response => response.text())
        .then(html => {
            const container = document.getElementById('faq-list-container');
            if (container) container.innerHTML = html;
        });
    }

    if (searchFaq) searchFaq.addEventListener('input', debounce(fetchFaq, 500));
    if (kategoriFaqFilter) kategoriFaqFilter.addEventListener('change', fetchFaq);
    if (statusFaqFilter) statusFaqFilter.addEventListener('change', fetchFaq);

    function bukaEdit(el) {
        const modal = document.getElementById('modalEdit');
        modal.classList.remove('hidden');
        modal.classList.add('flex'); 

        document.getElementById('edit_id').value = el.dataset.id;
        document.getElementById('edit_pertanyaan').value = el.dataset.pertanyaan;
        document.getElementById('edit_jawaban').value = el.dataset.jawaban;
        document.getElementById('edit_kategori_faq_id').value = el.dataset.kategori;
        if (el.dataset.status == "1") {
            document.getElementById('edit_status_aktif').checked = true;
        } else {
            document.getElementById('edit_status_nonaktif').checked = true;
        }

        const updateFaqUrl = "{{ route('admin.faq.update', ':id') }}";
        document.getElementById('formEditFaq').action = updateFaqUrl.replace(':id', el.dataset.id);
    }

    function tutupModal(){
        const modal = document.getElementById('modalEdit');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    function submitFaqEdit() {
        const form = document.getElementById('formEditFaq');
        if (!form.reportValidity()) {
            return;
        }

        SwalHelper.confirmEdit('FAQ ini').then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    }

    function hapusFaq(id){
        SwalHelper.confirmDelete('FAQ ini').then((result) => {
            if(result.isConfirmed) document.getElementById(`form-delete-${id}`).submit();
        });
    }

    function toggleFaq(id) {
        const content = document.getElementById('content-' + id);
        const icon = document.getElementById('icon-' + id);
        if(!content || !icon) return;

        content.classList.toggle('hidden');
        icon.classList.toggle('rotate-180');
    }
</script>
@endpush






