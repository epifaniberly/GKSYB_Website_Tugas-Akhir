<div id="qrDialog" class="fixed inset-0 z-[60] flex items-center justify-center p-4" style="display:none;">
    <div class="absolute inset-0 bg-black/40 backdrop-blur-sm" onclick="qrHide()"></div>
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg relative z-10 overflow-hidden animate-in fade-in zoom-in duration-200">
        <div class="px-6 py-4 flex items-center justify-between border-b border-gray-100">
            <div>
                <h2 id="qrTitle" class="text-xl font-semibold text-gray-800">Tambah QR Code</h2>
                <p class="text-xs text-gray-400 mt-0.5">Tambahkan QR code untuk pembayaran digital</p>
            </div>
        </div>

        <form id="qrForm" method="POST" enctype="multipart/form-data" class="flex flex-col" novalidate>
            @csrf
            <input type="hidden" name="_method" id="qrMethod" value="POST">
            <input type="hidden" id="qr_id" name="qr_id">
            <div class="px-6 py-5 space-y-5 max-h-[70vh] overflow-y-auto">
                <div>
                    <label class="block text-sm font-semibold text-gray-800 mb-2">Upload Gambar <span class="text-red-500">*</span></label>
                    <div id="dropZone" class="relative group block cursor-pointer">
                        <div id="dropZoneContainer" class="border-2 border-dashed border-gray-200 rounded-2xl py-12 px-6 flex flex-col items-center justify-center bg-gray-50/30 group-hover:border-[#8C1007] group-hover:bg-[#FFF3F2]/30 transition-all min-h-[140px] relative overflow-hidden">
                            
                            <input id="qr_img" type="file" name="qr_img" accept="image/*" onchange="previewQr(event)"
                                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-20">
                            
                            <div id="uploadZone" class="flex flex-col items-center text-center z-10">
                                <svg class="w-10 h-10 text-gray-400 mb-4 group-hover:text-[#8C1007] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <p id="fileName" class="text-[12px] sm:text-sm font-medium text-gray-700 mb-1">Klik untuk upload foto atau drag & drop</p>
                                <p class="text-xs text-gray-400">JPG, JPEG, PNG (Maks. 10MB)</p>
                            </div>

                            <div id="qrImageSelected" class="hidden w-full h-full absolute inset-0 bg-white z-30 flex items-center justify-center p-6">
                                <div class="w-full bg-[#f9fafb] border border-gray-200 rounded-xl p-4 flex items-center justify-between gap-4 transition-all">
                                    <div class="flex items-center gap-4 overflow-hidden">
                                         <div class="w-10 h-10 bg-red-50 text-[#8C1007] rounded-lg flex items-center justify-center shrink-0">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                         </div>
                                         <div class="flex flex-col min-w-0 text-left">
                                             <span id="qrFileNameDisplay" class="text-[14px] font-semibold text-gray-700 truncate block max-w-[250px]"></span>
                                             <span id="qrFileSizeDisplay" class="text-[12px] text-gray-400 font-medium"></span>
                                         </div>
                                    </div>
                                    <button type="button" onclick="resetFile()" class="w-8 h-8 flex items-center justify-center text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition-all cursor-pointer focus:outline-none z-40">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="px-8 py-6 bg-gray-50/50 flex items-center justify-end gap-4 border-t border-gray-100">
                <button type="button" onclick="qrHide()"
                    class="bg-white border border-gray-200 text-gray-700 text-[10px] font-semibold hover:bg-gray-50 transition-colors focus:outline-none"
                    style="border-radius: 0.5rem !important; padding: 7px 20px !important; display: inline-block !important;">
                    Batal
                </button>

                <button id="qrSubmitBtn" type="button" onclick="submitQrForm()"
                    class="text-white text-[10px] font-semibold hover:opacity-90 transition-opacity focus:outline-none"
                    style="background:#8C1007 !important; border-radius: 0.5rem !important; padding: 7px 20px !important; display: inline-block !important;">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function previewQr(event){
        const file = event.target.files[0];
        if (file) {
            document.getElementById('qrFileNameDisplay').textContent = file.name;
            
            let sizeMB = file.size / 1024 / 1024;
            if (sizeMB < 1) {
                document.getElementById('qrFileSizeDisplay').textContent = (file.size / 1024).toFixed(2) + ' KB';
            } else {
                document.getElementById('qrFileSizeDisplay').textContent = sizeMB.toFixed(2) + ' MB';
            }
            
            document.getElementById('uploadZone').classList.add('hidden');
            document.getElementById('qrImageSelected').classList.remove('hidden');
        }
    }

    function resetFile() {
        document.getElementById('qr_img').value = '';
        document.getElementById('fileName').textContent = 'Klik untuk upload foto atau drag & drop';
        
        document.getElementById('uploadZone').classList.remove('hidden');
        document.getElementById('qrImageSelected').classList.add('hidden');
    }

    function qrHide(){
        document.getElementById('qrDialog').style.display = 'none';
        resetFile();
    }

    document.addEventListener('DOMContentLoaded', function() {
        const dropZone = document.getElementById('qr_img');
        const container = document.getElementById('dropZoneContainer');

        if (dropZone && container) {
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                dropZone.addEventListener(eventName, preventDefaults, false);
            });

            function preventDefaults(e) {
                e.preventDefault();
                e.stopPropagation();
            }

            ['dragenter', 'dragover'].forEach(eventName => {
                dropZone.addEventListener(eventName, () => {
                    container.classList.add('border-[#8C1007]', 'bg-[#FFF3F2]/30');
                }, false);
            });

            ['dragleave', 'drop'].forEach(eventName => {
                dropZone.addEventListener(eventName, () => {
                    container.classList.remove('border-[#8C1007]', 'bg-[#FFF3F2]/30');
                }, false);
            });

            dropZone.addEventListener('drop', (e) => {
                const dt = e.dataTransfer;
                const files = dt.files;
                
                if (files && files.length > 0) {
                    dropZone.files = files;
                    // Trigger change event manually
                    const event = new Event('change', { bubbles: true });
                    dropZone.dispatchEvent(event);
                }
            }, false);
        }
    });
</script>


