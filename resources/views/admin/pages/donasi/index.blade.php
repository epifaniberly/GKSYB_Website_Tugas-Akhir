@extends('layout.admin')

@section('title', 'Donasi & Persembahan')

@section('content')
    <div class="fs-style-manrope">
        <div class="flex flex-col justify-start text-left py-6">
            <h1 class="admin-page-title">Donasi & Persembahan</h1>
            <p class="text-sm text-gray-500 mt-1">Kelola metode pembayaran donasi & persembahan untuk umat (Transfer Bank dan QR Code)</p>
        </div>
        <div class="flex flex-col sm:flex-row gap-2 sm:gap-3">
            <button type="button" onclick="openDonasiDialog()" 
                class="text-white text-[10px] sm:text-[12px] font-medium hover:opacity-90 transition-opacity focus:outline-none w-full sm:w-auto" 
                style="background:#8C1007 !important; border-radius: 0.5rem !important; padding: 10px 24px !important; display: inline-block !important;">
                + Tambah Transfer Bank
            </button>
            @if ($qrcode->count() == 0)
                <button type="button" onclick="openQrDialog()"
                    class="text-white text-[10px] sm:text-[12px] font-medium hover:opacity-90 transition-opacity focus:outline-none w-full sm:w-auto"
                    style="background:#8C1007 !important; border-radius: 0.5rem !important; padding: 10px 24px !important; display: inline-block !important;">
                    + Tambah QR Code
                </button>
            @endif
        </div>
        <div class="flex flex-row gap-2.5 items-center mt-8">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#8C1007" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6">
                <path d="M3 21h18" />
                <path d="M3 10h18" />
                <path d="M5 6l7-3 7 3" />
                <path d="M4 10v11" />
                <path d="M20 10v11" />
                <path d="M8 14v3" />
                <path d="M12 14v3" />
                <path d="M16 14v3" />
            </svg>
            <h3 class="text-xl font-semibold text-[#8C1007]">Transfer Bank</h3>
        </div>

        @forelse ($transfer as $tf)
            <div class="bg-white rounded-2xl border border-gray-200 p-6 mt-5 hover:shadow-md transition-all group">
                <div class="flex justify-between items-start">
                    <div>
                        <h4 class="text-lg font-semibold text-[#8C1007]">{{ $tf->nama_bank }}</h4>
                        <p class="text-xs text-gray-400 mt-0.5 font-medium">Kode Bank: {{ $tf->kode_bank }}</p>
                    </div>
                    <div class="flex gap-2">
                        <button onclick='openEditDialog(@json($tf))' class="p-2 hover:bg-yellow-50 rounded-lg transition-colors" style="color: #eab308;" title="Edit">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                        </button>
                        <button onclick="confirmDelete({{ $tf->id }})" class="p-2 hover:bg-red-50 rounded-lg transition-colors" style="color: #ef4444;" title="Hapus">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        </button>
                    </div>
                </div>
                <div class="h-px bg-gray-300 w-full my-4"></div>
                <div class="space-y-4">
                    <div>
                        <span class="block text-[12px] text-gray-400 font-medium mb-0.5">Nomor Rekening</span>
                        <div class="flex items-center gap-2">
                            <span class="text-base font-medium text-gray-800 tracking-wide line-height-none">{{ $tf->nomor_rekening }}</span>
                            <button onclick="copyToClipboard('{{ $tf->nomor_rekening }}')" 
                                class="text-gray-400 hover:text-[#8C1007] transition-colors cursor-pointer inline-flex items-center justify-center p-0 m-0" 
                                title="Salin Rekening" 
                                style="appearance: none; background: none; border: none; outline: none !important; box-shadow: none !important; line-height: 0; transform: translateY(1px);">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2" style="display: block;">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div>
                        <span class="block text-[12px] text-gray-400 font-medium mb-0.5">Atas Nama</span>
                        <span class="text-base font-medium text-gray-800">{{ $tf->atas_nama }}</span>
                    </div>
                </div>
            </div>
        @empty
            <div class="bg-white rounded-2xl border border-gray-200 p-8 mt-5 flex flex-col items-center justify-center text-center">
                <div class="w-12 h-12 bg-gray-50 rounded-full flex items-center justify-center mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="text-gray-300">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                    </svg>
                </div>
                <p class="text-gray-500 font-medium">Belum ada data Transfer Bank.</p>
                <p class="text-xs text-gray-400 mt-1">Klik tombol di atas untuk menambahkan metode pembayaran.</p>
            </div>
        @endforelse        

        <div class="flex flex-row gap-2.5 items-center mt-10">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#8C1007" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6">
                <rect x="3" y="3" width="7" height="7" />
                <rect x="14" y="3" width="7" height="7" />
                <rect x="14" y="14" width="7" height="7" />
                <rect x="3" y="14" width="7" height="7" />
                <path d="M7 7h.01" />
                <path d="M17 7h.01" />
                <path d="M7 17h.01" />
            </svg>
            <h3 class="text-xl font-semibold text-[#8C1007]">QR Code Donasi</h3>
        </div>
        @forelse ($qrcode as $qr)
            <div class="bg-white rounded-2xl border border-gray-200 p-6 mt-5 hover:shadow-md transition-all group">
                <div class="flex justify-between items-start">
                    <div>
                    <h4 class="text-lg font-semibold text-[#8C1007]">QR Code Donasi</h4>
                    <p class="text-xs text-gray-400 mt-0.5 font-medium italic">Metode Pembayaran</p>
                </div>
                    <div class="flex gap-2">
                        <button onclick='openEditQr(@json($qr))' class="p-2 hover:bg-yellow-50 rounded-lg transition-colors" style="color: #eab308;" title="Edit">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                        </button>
                        <button onclick="confirmDeleteQr({{ $qr->id }})" class="p-2 hover:bg-red-50 rounded-lg transition-colors" style="color: #ef4444;" title="Hapus">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        </button>
                    </div>
                </div>
                <div class="h-px bg-gray-300 w-full my-4"></div>
                <div class="flex justify-center">
                    <div class="shrink-0">
                        @if($qr->qr_img)
                            <div class="relative group/qr">
                                <img src="{{ asset($qr->qr_img) }}" class="w-64 h-64 object-contain rounded-2xl border border-gray-100 p-3 bg-gray-50 shadow-inner group-hover/qr:scale-[1.02] transition-transform duration-300">
                                <div class="absolute inset-0 bg-black/5 rounded-2xl opacity-0 group-hover/qr:opacity-100 transition-opacity pointer-events-none"></div>
                            </div>
                        @else
                            <div class="w-64 h-64 flex items-center justify-center bg-gray-50 rounded-2xl border border-dashed border-gray-200 text-gray-400 text-sm text-center font-medium">
                                Tidak ada<br>gambar QR
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="bg-white rounded-2xl border border-gray-200 p-8 mt-5 flex flex-col items-center justify-center text-center">
                <div class="w-12 h-12 bg-gray-50 rounded-full flex items-center justify-center mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="text-gray-300">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h2M4 8h16" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <p class="text-gray-500 font-medium">Belum ada data QR Code.</p>
                <p class="text-xs text-gray-400 mt-1">Klik tombol di atas untuk menambahkan metode pembayaran QR Code.</p>
            </div>
        @endforelse    
    </div>

    @include('admin.pages.donasi.components.tfdialog')
    @include('admin.pages.donasi.components.qrdialog')

    <form id="deleteForm" method="POST" style="display:none;">
        @csrf
        @method('DELETE')
    </form>
@endsection

@push('script')
    <script>
        function openDonasiDialog(){
            document.getElementById('modalTitle').innerText = 'Tambah Transfer Bank';
            document.getElementById('tfSubmitBtn').innerText = 'Simpan Transfer Bank';
            document.getElementById('tfForm').reset();
            document.getElementById('formMethod').value = 'POST';
            document.getElementById('tfForm').action =
                "{{ route('admin.donasi.transfer.store') }}";

            modalShow();
        }

        function openEditDialog(data){
            document.getElementById('modalTitle').innerText = 'Edit Transfer Bank';
            document.getElementById('tf_id').value = data.id;
            document.getElementById('nama_bank').value = data.nama_bank;
            document.getElementById('nomor_rekening').value = data.nomor_rekening;
            document.getElementById('atas_nama').value = data.atas_nama;
            document.getElementById('kode_bank').value = data.kode_bank;
            document.getElementById('formMethod').value = 'PATCH';

            document.getElementById('tfSubmitBtn').innerText = 'Simpan Perubahan';
            document.getElementById('tfForm').action =
                "/admin-donasi/transfer/edit/" + data.id;

            modalShow();
        }

        function modalShow() {
            document.getElementById('tfDialog').style.display = 'flex';
        }

        function modalHide() {
            document.getElementById('tfDialog').style.display = 'none';
        }

        function confirmDelete(id) {
            SwalHelper.confirmDelete('data transfer bank ini').then((result) => {
                if (result.isConfirmed) {
                    const form = document.getElementById('deleteForm');
                    form.action = "/admin-donasi/transfer/destroy/" + id;
                    form.submit();
                }
            })
        }

        function openQrDialog(){
            document.getElementById('qrTitle').innerText = 'Tambah QR Code';
            document.getElementById('qrSubmitBtn').innerText = 'Simpan QR Code';
            document.getElementById('qrForm').reset();
            document.getElementById('qrMethod').value = 'POST';
            document.getElementById('qrForm').action = "{{ route('admin.donasi.qr.store') }}";
            
            document.getElementById('qrImageSelected').classList.add('hidden');
            document.getElementById('uploadZone').classList.remove('hidden');
            document.getElementById('fileName').textContent = 'Klik untuk upload foto atau drag & drop';

            qrShow();
        }

        function openEditQr(data){
            document.getElementById('qrTitle').innerText = 'Edit QR Code';
            document.getElementById('qr_id').value = data.id;

            const qrImageSelected = document.getElementById('qrImageSelected');
            const uploadZone = document.getElementById('uploadZone');

            if(data.qr_img){
                document.getElementById('qrFileNameDisplay').textContent = data.qr_img.split('/').pop();
                document.getElementById('qrFileSizeDisplay').textContent = 'File saat ini';
                
                qrImageSelected.classList.remove('hidden');
                uploadZone.classList.add('hidden');
            } else {
                qrImageSelected.classList.add('hidden');
                uploadZone.classList.remove('hidden');
            }

            document.getElementById('qrSubmitBtn').innerText = 'Simpan Perubahan';
            document.getElementById('qrMethod').value = 'PATCH';
            document.getElementById('qrForm').action = "/admin-donasi/qr/edit/" + data.id;

            qrShow();
        }

        function confirmDeleteQr(id){
            SwalHelper.confirmDelete('QR Code ini').then((result) => {
                if(result.isConfirmed){
                    const form = document.getElementById('deleteForm');
                    form.action = "/admin-donasi/qr/destroy/" + id;
                    form.submit();
                }
            })
        }

        function qrShow(){
            document.getElementById('qrDialog')
                .style.display = 'flex';
        }

        function qrHide(){
            document.getElementById('qrDialog')
                .style.display = 'none';
            if (typeof resetFile === 'function') resetFile();
        }

        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(() => {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil disalin!',
                    text: 'Nomor rekening ' + text + ' telah disalin.',
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true
                });
            });
        }
    </script>
@endpush

@push('script')
<script>
    function submitTfForm() {
        const tfForm = document.getElementById('tfForm');
        if (!tfForm) return;

        const validator = new FormValidator('tfForm');
        validator.addValidation('nama_bank', ['required']);
        validator.addValidation('nomor_rekening', ['required']);
        validator.addValidation('atas_nama', ['required']);
        
        if (validator.validateForm()) {
            const method = document.getElementById('formMethod').value;
            const isEdit = (method === 'PUT' || method === 'PATCH');

            if (isEdit) {
                SwalHelper.confirmEdit('Transfer Bank').then((result) => {
                    if (result.isConfirmed) {
                        tfForm.submit();
                    }
                });
            } else {
                tfForm.submit();
            }
        }
    }

    function submitQrForm() {
        const qrForm = document.getElementById('qrForm');
        if (!qrForm) return;
        
        const fileInput = document.getElementById('qr_img');
        const qrId = document.getElementById('qr_id').value;
        const hasExistingFile = !document.getElementById('qrImageSelected').classList.contains('hidden');
        
        if (!qrId && !hasExistingFile && (!fileInput.files || fileInput.files.length === 0)) {
            const dashedBox = document.getElementById('uploadZone').parentElement;
            const fieldWrapper = dashedBox.parentElement.parentElement;
            
            const existingError = fieldWrapper.querySelector('.text-red-600');
            if (existingError) existingError.remove();

            const errorDiv = document.createElement('div');
            errorDiv.className = 'text-red-600 text-[11px] mt-2 flex items-center gap-2 font-medium';
            errorDiv.innerHTML = `
                <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                </svg>
                <span>Gambar QR Code wajib diunggah</span>
            `;
            fieldWrapper.appendChild(errorDiv);
            
            dashedBox.style.borderColor = '#ef4444';
            dashedBox.style.borderWidth = '2px';
            dashedBox.style.backgroundColor = '#fef2f2';
            return;
        }

        const method = document.getElementById('qrMethod').value;
        const isEdit = (method === 'PUT' || method === 'PATCH');

        if (isEdit) {
            SwalHelper.confirmEdit('QR Code').then((result) => {
                if (result.isConfirmed) {
                    qrForm.submit();
                }
            });
        } else {
            qrForm.submit();
        }
    }
    document.addEventListener('DOMContentLoaded', function() {
        const qrImg = document.getElementById('qr_img');
        if (qrImg) {
            qrImg.addEventListener('change', function() {
                const dashedBox = document.getElementById('uploadZone').parentElement;
                const fieldWrapper = dashedBox.parentElement.parentElement;
                
                const existingError = fieldWrapper.querySelector('.text-red-600');
                if (existingError) existingError.remove();
                
                dashedBox.style.borderColor = '';
                dashedBox.style.borderWidth = '';
                dashedBox.style.backgroundColor = '';
            });
        }
    });
</script>
@endpush





