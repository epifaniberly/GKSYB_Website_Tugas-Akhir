@extends('layout.admin')

@section('title', 'Galeri dan Dokumentasi')

@section('content')
<div class="fs-style-manrope pb-10">
    <div class="flex flex-col justify-start text-left py-6">
        <h1 class="admin-page-title">Galeri dan Dokumentasi</h1>
        <p class="text-sm text-gray-500 mt-1">
            Kelola link Google Drive untuk galeri foto dan video kegiatan paroki
        </p>
    </div>

    <div class="max-w-4xl space-y-6">
        <div class="bg-blue-50/50 border border-blue-100 rounded-2xl p-4 sm:p-6">
            <div class="flex items-start gap-2.5 sm:gap-3">
                <div class="mt-0.5 sm:mt-1 w-5 h-5 sm:w-6 sm:h-6 rounded-lg bg-blue-100 flex items-center justify-center text-blue-600 shrink-0 shadow-sm">
                    <svg class="w-3.5 h-3.5 sm:w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div class="space-y-1.5 sm:space-y-2">
                    <h3 class="text-[11px] sm:text-sm font-semibold text-blue-900 tracking-wide">Informasi Penting</h3>
                    <ul class="text-[9.5px] sm:text-xs text-blue-700 space-y-1 sm:space-y-1.5 font-medium leading-relaxed">
                        <li class="flex items-start gap-1.5">
                            <span class="shrink-0">•</span>
                            <span>Galeri menggunakan Google Drive eksternal, tidak ada upload media di admin panel</span>
                        </li>
                        <li class="flex items-start gap-1.5">
                            <span class="shrink-0">•</span>
                            <span>Pastikan folder Google Drive diatur sebagai "Anyone with the link can view"</span>
                        </li>
                        <li class="flex items-start gap-1.5">
                            <span class="shrink-0">•</span>
                            <span>URL yang disimpan akan ditampilkan sebagai link di halaman publik website</span>
                        </li>
                        <li class="flex items-start gap-1.5">
                            <span class="shrink-0">•</span>
                            <span>Umat dapat mengakses galeri langsung melalui link Google Drive</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="space-y-4">
            <h2 class="text-[12px] sm:text-sm font-semibold text-gray-700">Link Google Drive Saat Ini</h2>
            <div class="bg-white rounded-[1.25rem] border border-gray-100 p-4 sm:p-6 flex items-center justify-between gap-4 shadow-sm hover:shadow-md transition-all">
                <div class="flex-1 min-w-0">
                    <p class="text-[10px] sm:text-[12px] text-gray-400 mb-2 sm:mb-2.5 font-bold">URL Galeri</p>
                    <div class="flex items-center gap-1.5 sm:gap-2">
                        <a href="{{ $data->url ?? '#' }}" target="_blank" class="text-blue-600 text-[13px] sm:text-base font-bold truncate hover:underline underline-offset-4 decoration-2 leading-tight">
                            {{ $data->url ?? 'https://drive.google.com/drive/folders/...' }}
                        </a>
                        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-blue-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                        </svg>
                    </div>
                </div>
                <button onclick="bukaModalEdit()" class="p-2 sm:p-2.5 hover:bg-yellow-50 rounded-xl transition-all focus:outline-none shrink-0" style="color: #eab308;" title="Edit">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                </button>
            </div>
        </div>
        <div class="space-y-4 pt-4">
            <h2 class="text-[12px] sm:text-sm font-semibold text-gray-700 flex items-center gap-2">
                Preview di Website Publik
            </h2>
            <div class="bg-white rounded-xl border border-gray-200 p-12 flex flex-col items-center gap-6 shadow-sm hover:shadow-md transition-shadow">
                <div class="w-20 h-20 rounded-full bg-green-50 flex items-center justify-center text-green-500 shadow-inner">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"></path></svg>
                </div>
                <div class="text-center space-y-2">
                    <h3 class="text-lg font-semibold text-gray-800">Galeri & Dokumentasi Paroki Bintaran</h3>
                    <p class="text-sm text-gray-500 font-medium">Lihat foto dan video kegiatan paroki di Google Drive</p>
                </div>
                <button onclick="openGallery()" class="w-auto h-[38px] sm:h-[48px] text-white text-[13px] sm:text-base font-semibold flex items-center justify-center gap-2.5 sm:gap-4 transition-all shadow-lg sm:shadow-xl shadow-red-900/10 group hover:opacity-95 border-none focus:outline-none px-4 sm:px-6" style="background-color: #8C1007 !important; border-radius: 0.75rem !important;">
                    <span>Buka Galeri</span>
                    <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 group-hover:translate-x-1 group-hover:-translate-y-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 3h7m0 0v7m0-7L10 14"></path></svg>
                </button>
            </div>
        </div>
        <div class="bg-amber-50/50 border border-amber-100 rounded-2xl p-6">
            <div class="flex items-start gap-3">
                <div class="mt-1 w-6 h-6 rounded-lg bg-amber-100 flex items-center justify-center text-amber-600 shrink-0 shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path></svg>
                </div>
                <div class="space-y-3">
                    <h3 class="text-[12px] sm:text-sm font-semibold text-amber-900 tracking-wide mb-2">Cara Mengatur Google Drive</h3>
                    <div class="text-xs text-amber-700/80 space-y-2 font-semibold">
                        <p>1. Buka Google Drive dan buat folder khusus untuk galeri paroki</p>
                        <p>2. Upload foto dan video kegiatan ke folder tersebut</p>
                        <p>3. Klik kanan pada folder &rarr; Pilih "Share" atau "Bagikan"</p>
                        <p>4. Ubah setting menjadi "Anyone with the link can view"</p>
                        <p>5. Copy link folder dan paste di form di atas</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="modalEdit" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-[100] backdrop-blur-sm p-4 animate-in fade-in duration-300">
    <div class="bg-white rounded-3xl w-full max-w-lg shadow-2xl overflow-hidden animate-in zoom-in-95 duration-300">
        <div class="p-8 space-y-6">
            <div class="text-center">
                <div class="w-16 h-16 bg-[#8C1007]/5 rounded-2xl flex items-center justify-center text-[#8C1007] mx-auto mb-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-800">Edit Link Galeri</h3>
                <p class="text-sm text-gray-400 mt-1">Pastikan URL Google Drive sudah benar dan dapat diakses</p>
            </div>

            <form action="{{ route('admin.gallery.store') }}" method="POST" id="formEdit" class="space-y-4">
                @csrf
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-gray-800 mb-1.5 ml-1">URL Galeri</label>
                    <input type="url" name="url" value="{{ $data->url ?? '' }}" 
                        class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-2 focus:ring-[#8C1007] focus:bg-white text-[12px] sm:text-sm font-medium transition-all" 
                        placeholder="https://drive.google.com/drive/folders/..." required>
                </div>

                <div class="flex gap-3 pt-4 justify-end">
                    <button type="button" onclick="tutupModalEdit()" class="bg-white border border-gray-200 text-gray-700 text-[12px] font-medium hover:bg-gray-50 transition-colors focus:outline-none" style="border-radius: 0.5rem !important; padding: 10px 32px !important; display: inline-block !important;">
                        Batal
                    </button>
                    <button type="submit" class="text-white text-[12px] font-medium hover:opacity-90 transition-opacity focus:outline-none" style="background:#8C1007 !important; border-radius: 0.5rem !important; padding: 10px 32px !important; display: inline-block !important;">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function bukaModalEdit() {
        document.getElementById('modalEdit').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function tutupModalEdit() {
        document.getElementById('modalEdit').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    document.getElementById('modalEdit').addEventListener('click', function(e) {
        if (e.target === this) tutupModalEdit();
    });

    function openGallery() {
        const url = @json($data->url ?? null);

        if (!url || url === '#' || url === '') {
            Swal.fire({
                icon: 'warning',
                title: 'Link Belum Tersedia',
                text: 'Silakan tambahkan link Google Drive terlebih dahulu melalui tombol Edit.',
                confirmButtonColor: '#8C1007'
            });
            return;
        }

        window.open(url, '_blank');
    }

    document.addEventListener('DOMContentLoaded', function() {
        const formEdit = document.getElementById('formEdit');
        if (formEdit) {
            formEdit.addEventListener('submit', function(e) {
                e.preventDefault();
                SwalHelper.confirmEdit('URL Galeri').then((result) => {
                    if (result.isConfirmed) {
                        this.submit();
                    }
                });
            });
        }
    });
</script>
@endsection







