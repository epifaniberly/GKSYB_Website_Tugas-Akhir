@extends('layout.admin')

@section('title', 'Tilik Sejarah')

@push('styles')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

@section('content')
<div class="flex flex-col justify-start text-left fs-style-manrope py-6 mx-4 md:mx-0">
    <h1 class="admin-page-title">Tilik Sejarah</h1>
    <p class="text-sm text-gray-500 mt-1">Kelola informasi sejarah dan profil untuk halaman Tilik Sejarah</p>

    <div class="flex justify-start mt-4">
        <button
            id="btnEdit"
            onclick="toggleEdit(true)"
            class="text-white text-[9px] sm:text-[12px] font-medium hover:opacity-90 transition-opacity focus:outline-none inline-flex items-center gap-1.5 sm:gap-2 whitespace-nowrap !px-4 !py-2 sm:!px-8 sm:!py-2.5"
            style="background:#8C1007 !important; border-radius: 0.5rem !important;">
            <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
            <span class="inline-block">{{ $profil ? 'Edit' : 'Tambah' }} Data</span>
        </button>
    </div>
</div>

<div class="bg-white border border-gray-200 shadow-sm rounded-2xl fs-style-manrope overflow-hidden mx-4 md:mx-0">
    <div class="w-full px-6 py-4">
        <div id="viewMode" class="space-y-10">
            <div class="space-y-4">
                <div class="space-y-1">
                    <h3 class="text-[17px] font-extrabold text-[#3A0D0D]">Galeri Gambar Sejarah (untuk carousel)</h3>
                    <p class="text-[12px] text-gray-400 font-medium">Maksimal 5 gambar • Ukuran optimal: 1920x1080px</p>
                </div>

                <div class="space-y-4">
                    @php $no = 1; @endphp
                    @forelse($profil['galeri'] ?? [] as $index => $img)
                        <div class="flex flex-col sm:flex-row items-center gap-4 sm:gap-6 bg-white border border-gray-200 rounded-[1.5rem] p-4 sm:p-5 transition-shadow hover:shadow-md">
                            <div class="flex items-center gap-4 sm:gap-6 w-full sm:w-auto shrink-0">
                                <div class="w-8 h-8 sm:w-12 sm:h-12 bg-[#3A0D0D] text-white rounded-lg sm:rounded-xl flex items-center justify-center font-semibold text-sm sm:text-lg shrink-0 shadow-lg shadow-red-900/10">
                                    {{ $no++ }}
                                </div>
                                <div class="w-24 h-16 sm:w-32 sm:h-20 bg-gray-50 border border-gray-100 rounded-lg sm:rounded-xl overflow-hidden flex items-center justify-center shrink-0">
                                    @if(isset($img['file']))
                                        <img src="/storage/{{ $img['file'] }}" class="object-cover w-full h-full">
                                    @else
                                        <div class="flex flex-col items-center justify-center text-gray-200">
                                            <svg class="w-6 h-6 sm:w-8 sm:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="flex-1 w-full min-w-0">
                                <h3 class="text-[#3A0D0D] font-semibold text-[13px] sm:text-[16px] truncate" title="{{ $img['caption'] ?? 'Galeri Foto Gereja' }}">
                                   {{ $img['caption'] ?? 'Galeri Foto Gereja' }}
                                </h3>
                                <p class="text-[10px] sm:text-[12px] text-gray-400 font-semibold mt-0.5">Gambar Terupload</p>
                            </div>
                        </div>
                    @empty
                        <div class="bg-gray-50 rounded-2xl p-10 text-center border-2 border-dashed border-gray-200">
                            <p class="text-[14px] text-gray-400 font-medium font-manrope">Belum ada gambar yang diunggah.</p>
                        </div>
                    @endforelse
                </div>
            </div>
            <div class="space-y-8">
                <div class="space-y-3">
                    <h3 class="text-[16px] font-extrabold text-[#3A0D0D]">Deskripsi Sejarah</h3>
                    <p class="text-[14px] text-gray-500 leading-relaxed font-medium">{{ $profil['deskripsi'] ?? '-' }}</p>
                </div>

                <div class="space-y-3">
                    <h3 class="text-[16px] font-extrabold text-[#3A0D0D]">Detail Sejarah</h3>
                    <p class="text-[14px] text-gray-500 leading-relaxed font-medium">{{ $profil['sejarah'] ?? '-' }}</p>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-8 border-t border-gray-100 pt-10">
                <div class="space-y-3">
                    <h3 class="text-[16px] font-extrabold text-[#3A0D0D]">Visi</h3>
                    <p class="text-[14px] text-gray-500 leading-relaxed font-medium">{{ $profil['visi'] ?? '-' }}</p>
                </div>

                <div class="space-y-3">
                    <h3 class="text-[16px] font-extrabold text-[#3A0D0D]">Misi</h3>
                    <ul class="space-y-2">
                        @forelse($profil['misi'] ?? [] as $index => $m)
                            <li class="flex gap-2 text-[14px] text-gray-500 font-medium leading-relaxed">
                                <span class="shrink-0">{{ $index + 1 }}.</span>
                                <span>{{ $m }}</span>
                            </li>
                        @empty
                            <p class="text-[14px] text-gray-400">-</p>
                        @endforelse
                    </ul>
                </div>
            </div>
            <div class="space-y-4 pt-10 border-t border-gray-100">
                <h3 class="text-[16px] font-extrabold text-[#3A0D0D]">Lokasi Peta (Google Maps)</h3>
                <div class="rounded-2xl overflow-hidden border border-gray-200 shadow-sm bg-gray-50 min-h-[320px] flex items-center justify-center">
                    @if(isset($profil['maps']) && $profil['maps'] != '#' && $profil['maps'] != '')
                        <iframe class="w-full h-80 grayscale-[0.2] hover:grayscale-0 transition-all border-none"
                                src="{{ $profil['maps'] }}"
                                allowfullscreen="" loading="lazy"></iframe>
                    @else
                        <div class="flex flex-col items-center gap-3 text-gray-400">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            <p class="text-[12px] sm:text-sm font-medium">Link Google Maps belum dikonfigurasi</p>
                        </div>
                    @endif
                </div>
            </div>

        </div>
        <form id="formSejarah" class="hidden mt-6"
              method="POST"
              enctype="multipart/form-data"
              action="{{ $profil ? route('admin.sejarah.update', $profil->id) : route('admin.sejarah.store') }}"
              novalidate>

            @csrf

            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
                <div class="space-y-1">
                    <h3 class="text-[15px] sm:text-[17px] font-extrabold text-[#3A0D0D]">Galeri Gambar Sejarah (untuk carousel)</h3>
                    <p class="text-[11px] text-gray-400 font-medium">Maksimal 5 gambar • Ukuran optimal: 1920x1080px</p>
                </div>
                <div class="relative group/main w-full sm:w-auto">
                        <button
                            type="button"
                            id="addBtn"
                            onclick="openAddModal()"
                            class="text-white text-[9px] font-medium hover:opacity-90 transition-opacity focus:outline-none flex items-center gap-1.5 whitespace-nowrap shrink-0 disabled:opacity-50 disabled:cursor-not-allowed"
                            style="background:#8C1007 !important; border-radius: 0.5rem !important; padding: 6px 14px !important; display: inline-flex !important;">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
                            <span>Tambah Gambar</span> <span id="imgCount">({{ count($profil['galeri'] ?? []) }}/5)</span>
                        </button>
                    <div class="invisible group-hover/main:visible absolute right-0 bottom-full mb-3 w-56 p-3 bg-[#3A0D0D] text-white text-[10px] leading-relaxed font-semibold rounded-xl shadow-2xl z-50 transition-all opacity-0 group-hover/main:opacity-100 hidden sm:block">
                        <span id="tooltipText">Klik untuk menambah gambar (Maks. 5)</span>
                        <div class="absolute top-full right-4 -mt-1 border-4 border-transparent border-t-[#3A0D0D]"></div>
                    </div>
                </div>
            </div>

            <div id="editGallery" class="space-y-4">
                @php $no = 1; @endphp
                @foreach($profil['galeri'] ?? [] as $index => $img)
                    <div class="gallery-card flex items-center gap-3 sm:gap-6 bg-white border border-gray-100 rounded-[1.25rem] p-3 sm:p-5 relative group transition-all hover:border-[#8C1007] hover:shadow-md">
                        <div class="flex items-center gap-3 sm:gap-6 shrink-0">
                            <div class="w-7 h-7 sm:w-12 sm:h-12 bg-[#3A0D0D] text-white rounded-lg sm:rounded-xl flex items-center justify-center font-bold text-xs sm:text-lg shrink-0 shadow-lg shadow-red-900/10">
                                {{ $no++ }}
                            </div>
                            <div class="w-16 h-12 sm:w-32 sm:h-20 bg-gray-50 border border-gray-100 rounded-lg sm:rounded-xl overflow-hidden flex items-center justify-center shrink-0">
                                <img src="/storage/{{ $img['file'] }}" class="object-cover w-full h-full">
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <input type="text"
                                   name="keterangan_lama[]"
                                   value="{{ $img['caption'] ?? '' }}"
                                   class="w-full bg-transparent border-none focus:ring-0 text-[12px] sm:text-[16px] font-bold text-[#3A0D0D] p-0 placeholder:text-gray-300 truncate" 
                                   placeholder="Masukkan keterangan gambar" required>
                            <p class="text-[9px] sm:text-[12px] text-gray-400 font-semibold mt-0.5 sm:mt-1 uppercase tracking-wider">Gambar tersimpan</p>
                            <input type="hidden" name="gambar_lama[]" value="{{ $img['file'] }}">
                        </div>
                        <div class="shrink-0 ml-auto">
                            <button type="button" 
                                    onclick="markForDeletion(this, {{ $index }})"
                                    class="p-2 hover:bg-red-50 rounded-lg transition-colors focus:outline-none shrink-0"
                                    style="color: #ef4444;"
                                    title="Hapus Gambar">
                                <svg class="w-5 h-5 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7h6m-7 0V5a1 1 0 011-1h4a1 1 0 011 1v2"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>

            <div id="deletionInputs"></div>
            <div id="newImages"></div>

            <div class="mt-10 space-y-8">
                <div class="space-y-3">
                    <h3 class="text-[16px] font-extrabold text-[#3A0D0D]">Deskripsi Sejarah <span class="text-red-500">*</span></h3>
                    <div class="h-1.5"></div>
                    <div class="relative group">
                        <textarea name="deskripsi" id="deskripsi" class="w-full px-4 py-3 bg-white border border-gray-200 rounded-lg focus:border-[#8C1007] focus:ring-0 text-sm transition-colors min-h-[120px]" placeholder="Masukkan deskripsi sejarah" required>{{ $profil['deskripsi'] ?? '' }}</textarea>
                    </div>
                    <p id="deskripsi-error" class="hidden text-red-600 text-[11px] mt-4 flex items-center gap-2 font-medium">
                        <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                        <span>Kolom ini wajib diisi</span>
                    </p>
                </div>

                <div class="space-y-3">
                    <h3 class="text-[16px] font-extrabold text-[#3A0D0D]">Detail Sejarah <span class="text-red-500">*</span></h3>
                    <div class="h-1.5"></div>
                    <div class="relative group">
                        <textarea name="sejarah" id="sejarah" class="w-full px-4 py-3 bg-white border border-gray-200 rounded-lg focus:border-[#8C1007] focus:ring-0 text-sm transition-colors min-h-[120px]" placeholder="Masukkan detail sejarah secara lengkap" required>{{ $profil['sejarah'] ?? '' }}</textarea>
                    </div>
                    <p id="sejarah-error" class="hidden text-red-600 text-[11px] mt-4 flex items-center gap-2 font-medium">
                        <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                        <span>Kolom ini wajib diisi</span>
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-start">
                    <div class="flex flex-col h-full">
                        <h3 class="text-[16px] font-extrabold text-[#3A0D0D] mb-4.5">Visi <span class="text-red-500">*</span></h3>
                        <div class="flex-1 relative group">
                            <input name="visi" id="visi" type="text"
                                   placeholder="Masukkan visi"
                                   value="{{ $profil['visi'] ?? '' }}"
                                   class="w-full px-4 py-3 bg-white border border-gray-200 rounded-lg focus:border-[#8C1007] focus:ring-0 text-sm transition-colors min-h-[45px]" required>
                        </div>
                        <p id="visi-error" class="hidden text-red-600 text-[11px] mt-4 flex items-center gap-2 font-medium">
                            <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            <span>Kolom ini wajib diisi</span>
                        </p>
                    </div>

                    <div class="flex flex-col h-full">
                        <h3 class="text-[16px] font-extrabold text-[#3A0D0D] mb-4.5">Misi <span class="text-red-500">*</span></h3>
                        <div id="misiList" class="space-y-3 flex-1 mb-3">
                            @foreach($profil['misi'] ?? [] as $m)
                                <div class="flex gap-3 items-center relative group">
                                    <input type="text" name="misi[]" value="{{ $m }}" class="w-full px-4 py-3 bg-white border border-gray-200 rounded-lg focus:border-[#8C1007] focus:ring-0 text-sm transition-colors" placeholder="Tambah misi baru">
                                    <button type="button" onclick="this.parentElement.remove()" class="p-2.5 hover:bg-red-50 rounded-xl transition-colors border-none cursor-pointer focus:outline-none" style="color: #ef4444 !important;">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </div>
                            @endforeach
                        </div>

                        <div class="flex">
                            <button type="button"
                                    onclick="addMisi()"
                                    class="px-4 py-2 rounded-lg font-medium text-[11px] hover:scale-105 active:scale-95 transition-all shadow-md shadow-red-900/10 flex items-center gap-1.5 border-none cursor-pointer focus:outline-none"
                                    style="background-color: #8C1007 !important; color: white !important;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                    </svg>
                                    Tambah Misi
                            </button>
                        </div>
                        <p id="misi-error" class="hidden text-red-600 text-[11px] mt-4 flex items-center gap-2 font-medium">
                            <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            <span>Minimal harus ada satu misi yang diisi</span>
                        </p>
                    </div>
                </div>
            </div>

                <div class="pt-6 border-t border-gray-100">
                    <div class="mb-1.5">
                        <h3 class="text-sm font-semibold text-gray-800">Lokasi Peta (Google Maps) <span class="text-red-500">*</span></h3>
                    </div>
                    <div class="space-y-2">
                        <div class="relative group">
                            <input type="text" name="maps" id="maps" oninput="updateMapsPreview(this.value)" class="w-full px-4 py-3 bg-white border border-gray-200 rounded-lg focus:border-[#8C1007] focus:ring-0 text-sm transition-colors" placeholder="https://www.google.com/maps/embed?..."
                                   value="{{ $profil['maps'] ?? '' }}" required>
                        </div>
                        <p id="maps-error" class="hidden text-red-600 text-[11px] mt-4 flex items-center gap-2 font-medium">
                            <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            <span>Kolom ini wajib diisi</span>
                        </p>
                        <p class="text-[11px] text-gray-400 font-medium px-1 mt-2.5">
                            Cara: Buka Google Maps &rarr; Cari lokasi &rarr; Klik "Share" &rarr; Pilih "Embed a map" &rarr; Copy URL iframe
                        </p>
                    </div>
                    <div class="mt-4 rounded-2xl overflow-hidden border border-gray-200 bg-gray-50 min-h-[300px] relative">
                         <iframe id="maps_preview" class="w-full h-72 border-none"
                                 src="{{ $profil['maps'] ?? '' }}"
                                 allowfullscreen="" loading="lazy"></iframe>
                         <div id="maps_placeholder" class="absolute inset-0 flex items-center justify-center bg-gray-50 {{ isset($profil['maps']) && $profil['maps'] ? 'hidden' : '' }}">
                             <p class="text-sm text-gray-400">Pratinjau peta akan muncul di sini</p>
                         </div>
                    </div>
                </div>

                <div class="flex items-center gap-3 pt-6 border-t border-gray-100 mt-8 mb-6 text-sm">
                    <button type="submit" class="text-white text-[12px] font-medium hover:opacity-90 transition-opacity focus:outline-none" 
                        style="background:#8C1007 !important; border-radius: 0.5rem !important; padding: 10px 32px !important; display: inline-block !important;">
                        Simpan Perubahan
                    </button>

                    <button type="button" onclick="toggleEdit(false)" class="bg-white border border-gray-200 text-gray-700 text-[12px] font-medium hover:bg-gray-50 transition-colors focus:outline-none" 
                        style="border-radius: 0.5rem !important; padding: 10px 32px !important; display: inline-block !important;">
                        Batal
                    </button>
                </div>
            
        </form>

    </div>
</div>

@include('admin.pages.sejarah.components.dialog')
@endsection


@push('script')
<script>
    let maxImages = 5;

    function toggleEdit(edit) {
        document.getElementById('viewMode').classList.toggle('hidden', edit);
        document.getElementById('formSejarah').classList.toggle('hidden', !edit);
        document.getElementById('btnEdit').classList.toggle('hidden', edit);
        
        if (edit) {
            window.scrollTo({ top: 0, behavior: 'smooth' });
            updateAddButtonState();
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        updateAddButtonState();
        
        const validator = new FormValidator('formSejarah');
        validator.addValidation('deskripsi', ['required']);
        validator.addValidation('sejarah', ['required']);
        validator.addValidation('visi', ['required']);
        validator.addValidation('maps', ['required']);
        validator.init();

        const form = document.getElementById('formSejarah');
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            let isMisiValid = true;
            const misiInputs = document.querySelectorAll('input[name="misi[]"]');
            const misiError = document.getElementById('misi-error');
            
            let filledMisi = 0;
            misiInputs.forEach(input => {
                if (input.value.trim() !== '') {
                    filledMisi++;
                    input.classList.remove('border-red-500', 'bg-red-50');
                }
            });

            if (filledMisi === 0) {
                isMisiValid = false;
                misiError.classList.remove('hidden');
                misiInputs.forEach(input => {
                    input.classList.add('border-red-500', 'bg-red-50');
                });
            } else {
                misiError.classList.add('hidden');
            }

            if (validator.validateForm() && isMisiValid) {
                const galleryCards = document.querySelectorAll('#editGallery .gallery-card');
                if (galleryCards.length === 0) {
                    Swal.fire({
                        title: 'Galeri Kosong',
                        text: 'Silakan tambahkan minimal satu gambar galeri.',
                        icon: 'warning',
                        confirmButtonColor: '#8C1007',
                        borderRadius: '1.25rem'
                    });
                    return;
                }
                SwalHelper.confirmEdit('Tilik Sejarah').then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            }
        });
    });

    function openAddModal() {
        document.getElementById('addImageModal').classList.remove('hidden');
    }

    function closeAddModal() {
        document.getElementById('addImageModal').classList.add('hidden');
        document.getElementById('modalCaption').value = '';
        document.getElementById('modalImage').value = '';
        document.getElementById('modalImagePlaceholder').classList.remove('hidden');
        document.getElementById('modalImageSelected').classList.add('hidden');
        updateWordCount({value: ''});
    }

    function updateWordCount(input) {
        const counter = document.getElementById('captionCounter');
        if (!counter) return;
        
        let text = input.value || '';
        let words = text.trim().split(/\s+/).filter(word => word.length > 0);
        let count = words.length;
        
        if (count > 15) {
            input.value = words.slice(0, 15).join(' ');
            count = 15;
        }
        
        counter.innerText = count + '/15 kata';
        
        if (count >= 15) {
            counter.classList.add('text-[#8C1007]', 'font-bold');
            counter.classList.remove('text-gray-400');
        } else {
            counter.classList.remove('text-[#8C1007]', 'font-bold');
            counter.classList.add('text-gray-400');
        }
    }

    function updateFileName(input) {
        const placeholder = document.getElementById('modalImagePlaceholder');
        const selected = document.getElementById('modalImageSelected');
        const nameDisplay = document.getElementById('fileNameDisplay');
        const sizeDisplay = document.getElementById('fileSizeDisplay');
        const errorMsg = document.getElementById('imageSizeError');
        
        if (input.files && input.files[0]) {
            const file = input.files[0];
            
            let sizeMB = file.size / 1024 / 1024; 
            
            if (sizeMB > 10) {
                if (errorMsg) errorMsg.classList.remove('hidden');
                resetModalImage(false); 
                return;
            }

            if (errorMsg) errorMsg.classList.add('hidden');
            placeholder.classList.add('hidden');
            selected.classList.remove('hidden');
            nameDisplay.innerText = file.name;
            
            if (sizeMB < 1) {
                 sizeDisplay.innerText = (file.size / 1024).toFixed(2) + ' KB';
            } else {
                 sizeDisplay.innerText = sizeMB.toFixed(2) + ' MB';
            }
        } else {
            resetModalImage();
        }
    }

    function resetModalImage(clearError = true) {
        const input = document.getElementById('modalImage');
        if (input) input.value = '';
        
        const placeholder = document.getElementById('modalImagePlaceholder');
        const selected = document.getElementById('modalImageSelected');
        const errorMsg = document.getElementById('imageSizeError');

        if (placeholder) placeholder.classList.remove('hidden');
        if (selected) selected.classList.add('hidden');
        if (clearError && errorMsg) errorMsg.classList.add('hidden');
    }

    function addMisi() {
        document.getElementById('misiList').insertAdjacentHTML('beforeend', `
            <div class="flex gap-3 items-center">
                <input type="text" name="misi[]" class="w-full px-4 py-3 bg-white border border-gray-200 rounded-lg focus:border-[#8C1007] focus:ring-0 text-sm transition-colors" placeholder="Tambah misi baru">
                <button type="button" onclick="this.parentElement.remove()" class="p-2.5 hover:bg-red-50 rounded-xl transition-colors border-none cursor-pointer focus:outline-none" style="color: #ef4444 !important;">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                </button>
            </div>
        `);
    }

    function updateMapsPreview(url) {
        const iframe = document.getElementById('maps_preview');
        const placeholder = document.getElementById('maps_placeholder');
        
        if (url && url.includes('google.com/maps/embed')) {
            iframe.src = url;
            placeholder.classList.add('hidden');
        } else {
            iframe.src = '';
            placeholder.classList.remove('hidden');
        }
    }

    function addImageToEdit() {
        const captionInput = document.getElementById('modalCaption');
        const imgInput = document.getElementById('modalImage');
        const caption = captionInput.value;

        const modalCaption = document.getElementById('modalCaption');
        const modalImage = document.getElementById('modalImage');
        const modalImageContainer = modalImage.closest('.border-2');
        let isValid = true;

        if (!caption) {
            modalCaption.classList.add('border-red-500', 'bg-red-50');
            isValid = false;
        } else {
            modalCaption.classList.remove('border-red-500', 'bg-red-50');
        }

        if (imgInput.files.length === 0) {
            modalImageContainer.classList.add('border-red-500', 'bg-red-50');
            isValid = false;
        } else {
            modalImageContainer.classList.remove('border-red-500', 'bg-red-50');
        }

        if (!isValid) return;

        const reader = new FileReader();
        reader.onload = function(e) {
            const container = document.getElementById('editGallery');
            const newImages = document.getElementById('newImages');

            if (container.querySelectorAll('.relative:not(.opacity-40)').length >= maxImages) {
                alert("Maksimal 5 gambar");
                return;
            }

            const no = container.querySelectorAll('.relative:not(.opacity-40)').length + 1;
            const card = document.createElement("div");
            card.className = "gallery-card flex items-center gap-3 sm:gap-6 bg-white border border-gray-100 rounded-[1.25rem] p-3 sm:p-5 relative group transition-all hover:border-[#8C1007] hover:shadow-md";
            const fileId = "new_img_" + Date.now();
            card.dataset.fileId = fileId;
            card.innerHTML = `
                <div class="flex items-center gap-3 sm:gap-6 shrink-0">
                    <div class="w-7 h-7 sm:w-12 sm:h-12 bg-[#3A0D0D] text-white rounded-lg sm:rounded-xl flex items-center justify-center font-bold text-xs sm:text-lg shrink-0 shadow-lg shadow-red-900/10">
                        ${no}
                    </div>
                    <div class="w-16 h-12 sm:w-32 sm:h-20 bg-gray-50 border border-gray-100 rounded-lg sm:rounded-xl overflow-hidden flex items-center justify-center shrink-0">
                        <img src="${e.target.result}" class="object-cover w-full h-full">
                    </div>
                </div>
                <div class="flex-1 min-w-0">
                    <div class="text-[12px] sm:text-[16px] font-bold text-[#3A0D0D] leading-tight truncate" title="${caption}">${caption}</div>
                    <p class="text-[9px] sm:text-[12px] text-gray-400 font-semibold mt-0.5 sm:mt-1 uppercase tracking-wider">Gambar baru ditambahkan</p>
                    <input type="hidden" name="keterangan_baru[]" value="${caption}">
                </div>

                <div class="shrink-0 ml-auto">
                    <button type="button" 
                            onclick="removeNewImage(this)"
                            class="p-2 hover:bg-red-50 rounded-lg transition-colors focus:outline-none"
                            style="color: #ef4444;"
                            title="Hapus Gambar">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7h6m-7 0V5a1 1 0 011-1h4a1 1 0 011 1v2"></path>
                        </svg>
                    </button>
                </div>
            `;
            container.appendChild(card);
            
            updateAddButtonState();

            const fileInput = document.createElement('input');
            fileInput.type = "file";
            fileInput.hidden = true;
            fileInput.id = fileId;
            fileInput.name = "gambar_baru[]";
            fileInput.dataset.id = fileId; 

            let dt = new DataTransfer();
            dt.items.add(imgInput.files[0]);
            fileInput.files = dt.files;

            const captionInputHidden = document.createElement('input');
            captionInputHidden.type = "text";
            captionInputHidden.hidden = true;
            captionInputHidden.name = "keterangan_baru[]";
            captionInputHidden.value = caption;
            captionInputHidden.dataset.id = fileId; 

            newImages.appendChild(fileInput);
            newImages.appendChild(captionInputHidden);

            closeAddModal();
            updateAddButtonState(); 
            refreshSequenceNumbers(); 

            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'Gambar berhasil ditambahkan',
                timer: 1500,
                showConfirmButton: false,
                confirmButtonColor: '#8C1007'
            });
        };

        reader.readAsDataURL(imgInput.files[0]);
    }

    function markForDeletion(btn, index) {
        SwalHelper.confirmDelete('gambar ini').then((result) => {
            if (result.isConfirmed) {
                const card = btn.closest('.gallery-card');
                
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'hapus_gambar[]';
                input.value = index;
                document.getElementById('deletionInputs').appendChild(input);
                
                card.remove();
                
                updateAddButtonState();
                refreshSequenceNumbers();
                
                SwalHelper.successDelete('Gambar telah ditandai untuk dihapus.');
            }
        });
    }

    function removeNewImage(btn) {
        SwalHelper.confirmDelete('gambar baru ini').then((result) => {
            if (result.isConfirmed) {
                const card = btn.closest('.gallery-card');
                const fileId = card.dataset.fileId;
                
                const inputs = document.querySelectorAll(`[data-id="${fileId}"]`);
                inputs.forEach(el => el.remove());
                
                card.remove();
                updateAddButtonState();
                refreshSequenceNumbers();
            }
        });
    }

    function updateAddButtonState() {
        const container = document.getElementById('editGallery');
        const count = container.querySelectorAll('.gallery-card:not(.opacity-40)').length;
        const addBtn = document.getElementById('addBtn');
        const imgCountSpan = document.getElementById('imgCount');
        const tooltip = document.getElementById('tooltipText');
        
        imgCountSpan.innerText = `(${count}/5)`;
        
        if (count >= 5) {
            addBtn.disabled = true;
            addBtn.classList.add('opacity-50', 'cursor-not-allowed');
            tooltip.innerText = "Batas maksimal 5 gambar tercapai";
        } else {
            addBtn.disabled = false;
            addBtn.classList.remove('opacity-50', 'cursor-not-allowed');
            tooltip.innerText = "Klik untuk menambah gambar (Maks. 5)";
        }
    }

    function refreshSequenceNumbers() {
        const cards = document.querySelectorAll('#editGallery .gallery-card');
        cards.forEach((card, idx) => {
            const numBox = card.querySelector('.shrink-0 div:first-child');
            if (numBox) numBox.innerText = idx + 1;
        });
    }
</script>
@endpush






