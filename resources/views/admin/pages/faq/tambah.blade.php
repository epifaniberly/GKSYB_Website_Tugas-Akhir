<div class="fs-style-manrope">
    <form id="formFaq" action="{{ route('admin.faq.store') }}" method="POST" class="space-y-6" novalidate>
    @csrf
    <input type="hidden" id="method_faq" name="_method" value="POST">
    <input type="hidden" id="faq_id">
    <div id="kategori_faq_container">
        <label for="kategori_faq_id" class="block text-sm font-semibold text-gray-800 mb-2">Kategori <span class="text-red-500">*</span></label>
        <div class="relative">
            <select name="kategori_faq_id" id="kategori_faq_id" required
                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-[#8C1007] focus:ring-1 focus:ring-[#8C1007] text-sm transition-colors outline-none appearance-none cursor-pointer">
                <option value="" disabled selected hidden>Pilih kategori</option>
                @foreach($kategori as $k)
                <option value="{{ $k->id }}">{{ $k->nama_kategori }}</option>
                @endforeach
            </select>
            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-gray-400">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
            </div>
        </div>
    </div>
    <div id="pertanyaan_container">
        <div class="flex justify-between items-center mb-2">
            <label for="pertanyaan" class="block text-sm font-semibold text-gray-800">Pertanyaan <span class="text-red-500">*</span></label>
            <span id="pertanyaanCounter" class="text-xs text-gray-400 font-medium">0/200</span>
        </div>
        <div class="relative">
            <input name="pertanyaan" id="pertanyaan" placeholder="Masukkan pertanyaan" required maxlength="200"
                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-[#8C1007] focus:ring-1 focus:ring-[#8C1007] text-sm transition-colors outline-none"
                oninput="updateCharCount('pertanyaan', 'pertanyaanCounter', 200)">
        </div>
    </div>
    <div id="jawaban_container">
        <div class="flex justify-between items-center mb-2">
            <label for="jawaban" class="block text-sm font-semibold text-gray-800">Jawaban <span class="text-red-500">*</span></label>
            <span id="jawabanCounter" class="text-xs text-gray-400 font-medium">0/500</span>
        </div>
        <div class="relative">
            <textarea name="jawaban" id="jawaban" rows="5" placeholder="Masukkan jawaban" required maxlength="500"
                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-[#8C1007] focus:ring-1 focus:ring-[#8C1007] text-sm transition-colors outline-none"
                oninput="updateCharCount('jawaban', 'jawabanCounter', 500)"></textarea>
        </div>
    </div>
    <div>
        <label class="block text-sm font-semibold text-gray-800 mb-3">Status FAQ</label>
        <div class="flex items-center gap-6">
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="radio" name="is_active" value="1" checked class="w-4 h-4 text-[#8C1007] focus:ring-[#8C1007] border-gray-300">
                <span class="text-sm text-gray-700 whitespace-nowrap">Aktif</span>
            </label>
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="radio" name="is_active" value="0" class="w-4 h-4 text-[#8C1007] focus:ring-[#8C1007] border-gray-300">
                <span class="text-sm text-gray-700 whitespace-nowrap">Nonaktif</span>
            </label>
        </div>
    </div>
    <div class="flex items-center gap-3 pt-6 border-t border-gray-100 mt-8 mb-6 text-sm">
        <button type="submit"
            class="text-white text-[12px] font-medium hover:opacity-90 transition-opacity focus:outline-none focus:ring-0"
            style="background:#8C1007 !important; border-radius: 0.5rem !important; padding: 10px 32px !important; display: inline-block !important;">
            Simpan SSD
        </button>

        <button type="button"
            onclick="resetForm()"
            class="bg-white border border-gray-200 text-gray-700 text-[12px] font-medium hover:bg-gray-50 transition-colors focus:outline-none focus:ring-0"
            style="border-radius: 0.5rem !important; padding: 10px 32px !important; display: inline-block !important;">
            Reset
        </button>
    </div>

    </form>
</div>

@push('script')
<script>
    function updateCharCount(inputId, counterId, maxLength) {
        const input = document.getElementById(inputId);
        const counter = document.getElementById(counterId);
        const currentLength = input.value.length;
        
        if (maxLength) {
            counter.textContent = `${currentLength}/${maxLength}`;
            
            if (currentLength >= maxLength) {
                counter.classList.remove('text-gray-400', 'text-yellow-500');
                counter.classList.add('text-red-500');
            } else if (currentLength >= maxLength * 0.9) {
                counter.classList.remove('text-gray-400', 'text-red-500');
                counter.classList.add('text-yellow-500');
            } else {
                counter.classList.remove('text-yellow-500', 'text-red-500');
                counter.classList.add('text-gray-400');
            }
        }
    }

    let faqValidator;
    document.addEventListener('DOMContentLoaded', function() {
        faqValidator = new FormValidator('formFaq');
        
        faqValidator.addValidation('kategori_faq_id', ['required']);
        faqValidator.addValidation('pertanyaan', [
            'required',
            faqValidator.rules.minLength(10),
            faqValidator.rules.maxLength(200)
        ]);
        faqValidator.addValidation('jawaban', [
            'required',
            faqValidator.rules.minLength(20),
            faqValidator.rules.maxLength(500)
        ]);
        
        faqValidator.init();

        const formFaq = document.getElementById('formFaq');
        formFaq.addEventListener('submit', function(e) {
            e.preventDefault();

            if (faqValidator.validateForm()) {
                this.submit();
            }
        });
    });

    function resetForm(){
        const form = document.getElementById('formFaq');
        form.action = "{{ route('admin.faq.store') }}";
        document.getElementById('method_faq').value = "POST";
        form.reset();
        if(faqValidator) faqValidator.clearErrors();
    }

</script>
@endpush







