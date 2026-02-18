<div id="tfDialog" class="fixed inset-0 z-[60] flex items-center justify-center p-4" style="display:none;">
    <div class="absolute inset-0 bg-black/40 backdrop-blur-sm" onclick="modalHide()"></div>
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg relative z-10 overflow-hidden animate-in fade-in zoom-in duration-200">
        <div class="px-6 py-4 flex items-center justify-between border-b border-gray-100">
            <div>
                <h2 id="modalTitle" class="text-xl font-semibold text-gray-800">Tambah Transfer Bank</h2>
                <p class="text-xs text-gray-400 mt-0.5">Tambahkan rekening bank untuk menerima donasi</p>
            </div>
        </div>

        <form id="tfForm" method="POST" enctype="multipart/form-data" action="{{ route('admin.donasi.transfer.store') }}" class="flex flex-col" novalidate>
            @csrf
            <input type="hidden" name="_method" id="formMethod" value="POST">
            <input type="hidden" name="id" id="tf_id">
            <div class="px-6 py-5 space-y-5 max-h-[70vh] overflow-y-auto">
                <div>
                    <label class="block text-sm font-semibold text-gray-800 mb-2">Nama Bank <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <input id="nama_bank" type="text" name="nama_bank" placeholder="Masukkan nama bank"
                            class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#8C1007]/5 focus:border-[#8C1007] transition-all" required>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-800 mb-2">Nomor Rekening <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <input id="nomor_rekening" type="text" name="nomor_rekening" placeholder="Masukkan nomor rekening"
                            inputmode="numeric"
                            class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#8C1007]/5 focus:border-[#8C1007] transition-all" required>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-800 mb-2">Atas Nama <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <input id="atas_nama" type="text" name="atas_nama" placeholder="Masukkan atas nama"
                            class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#8C1007]/5 focus:border-[#8C1007] transition-all" required>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-800 mb-2">Kode Bank (Opsional)</label>
                    <input id="kode_bank" type="text" name="kode_bank" placeholder="Masukkan kode bank"
                        inputmode="numeric"
                        class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#8C1007]/5 focus:border-[#8C1007] transition-all">
                </div>
            </div>
            <div class="px-8 py-6 bg-gray-50/50 flex items-center justify-end gap-4 border-t border-gray-100">
                <button type="button" onclick="modalHide()"
                    class="bg-white border border-gray-200 text-gray-700 text-[10px] font-semibold hover:bg-gray-50 transition-colors focus:outline-none"
                    style="border-radius: 0.5rem !important; padding: 7px 20px !important; display: inline-block !important;">
                    Batal
                </button>

                <button id="tfSubmitBtn" type="button" onclick="submitTfForm()"
                    class="text-white text-[10px] font-semibold hover:opacity-90 transition-opacity focus:outline-none"
                    style="background:#8C1007 !important; border-radius: 0.5rem !important; padding: 7px 20px !important; display: inline-block !important;">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('nomor_rekening').addEventListener('input', function (e) {
        let value = e.target.value.replace(/\D/g, '');
        
        value = value.substring(0, 16);
        
        let formattedValue = '';
        for (let i = 0; i < value.length; i++) {
            if (i > 0 && i % 3 === 0) {
                formattedValue += '-';
            }
            formattedValue += value[i];
        }
        
        e.target.value = formattedValue;
    });

    document.getElementById('kode_bank').addEventListener('input', function (e) {
        e.target.value = e.target.value.replace(/\D/g, '');
    });
</script>




