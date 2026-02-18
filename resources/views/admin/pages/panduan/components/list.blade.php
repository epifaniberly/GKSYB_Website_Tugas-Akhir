<div class="space-y-4">
@forelse($ekaristi as $d)
    <div class="bg-white border border-gray-200 rounded-xl p-6 flex flex-col md:flex-row gap-6 hover:border-gray-300 transition-colors items-start fs-style-manrope">
        <div class="w-12 h-12 bg-red-50 rounded-xl flex items-center justify-center shrink-0">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M14 2H6C5.46957 2 4.96086 2.21071 4.58579 2.58579C4.21071 2.96086 4 3.46957 4 4V20C4 20.5304 4.21071 21.0391 4.58579 21.4142C4.96086 21.7893 5.46957 22 6 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V8L14 2Z" stroke="#EF4444" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M14 2V8H20" stroke="#EF4444" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>

        <div class="flex-1 min-w-0">
            <div class="flex items-start justify-between gap-4">
                <h3 class="font-semibold text-gray-900 text-lg leading-tight">
                    {{ $d->jenis_misa }}{{ $d->perayaan ? ' - '.$d->perayaan : '' }}
                </h3>
                @if($d->is_publish)
                    <span class="bg-green-50 text-green-600 text-[10px] px-2.5 py-0.5 rounded-full font-semibold border border-green-100 uppercase tracking-widest shrink-0">Published</span>
                @else
                    <span class="bg-gray-100 text-gray-500 text-[10px] px-2.5 py-0.5 rounded-full font-semibold border border-gray-200 uppercase tracking-widest shrink-0">Draft</span>
                @endif
            </div>

            <p class="text-gray-500 text-sm mt-1 leading-relaxed">
                {{ $d->ket_perayaan }}
            </p>

            @if($d->ayat_alkitab)
            <p class="text-xs italic text-gray-400 mt-2 line-clamp-1 border-l-2 border-gray-100 pl-3">
                "{{ $d->ayat_alkitab }}" {{ $d->sumber_ayat ? '— '.$d->sumber_ayat : '' }}
            </p>
            @endif
            <div class="flex flex-wrap items-center gap-x-4 gap-y-2 text-xs text-gray-400 mt-4 font-medium">
                <div class="flex items-center gap-1.5">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    <span class="truncate max-w-[200px] md:max-w-[400px]">{{ $d->original_filename ?: $d->jenis_misa . '.pdf' }}</span>
                </div>
                <div class="flex items-center gap-1.5">
                    @php
                        $size = 0;
                        try {
                            $size = Storage::size('public/PanduanFile/'.$d->file);
                        } catch (\Exception $e) {}
                    @endphp
                    <span>• {{ number_format($size/1024/1024, 2) }} MB</span>
                </div>
                <div class="flex items-center gap-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    <span>
                        @if($d->tanggal)
                            {{ \Carbon\Carbon::parse($d->tanggal)->locale('id')->isoFormat('D MMMM YYYY') }}
                        @elseif($d->tanggal_mulai && $d->tanggal_akhir)
                            {{ \Carbon\Carbon::parse($d->tanggal_mulai)->locale('id')->isoFormat('D MMM') }} - {{ \Carbon\Carbon::parse($d->tanggal_akhir)->locale('id')->isoFormat('D MMM YYYY') }}
                        @else
                            Tanggal belum ditentukan
                        @endif
                    </span>
                </div>
            </div>
            <div class="flex items-center gap-1.5 sm:gap-2 pt-1 mt-4">
                <a href="{{ route('admin.panduan.download', $d->id) }}"
                    target="_blank"
                    class="p-2 text-gray-500 hover:text-gray-700 hover:bg-gray-50 rounded-lg transition-colors"
                    title="Download">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                </a>
                <button onclick='bukaEdit(@json($d), "view")'
                    class="p-2 text-blue-500 hover:text-blue-700 hover:bg-blue-50 rounded-lg transition-colors"
                    title="Lihat">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                </button>
                <button onclick='bukaEdit(@json($d), "edit")'
                    class="p-2 hover:bg-yellow-50 rounded-lg transition-colors"
                    style="color: #eab308;"
                    title="Edit">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                </button>
                <form id="form-delete-{{ $d->id }}"
                    action="{{ route('admin.panduan.destroy', $d->id) }}"
                    method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="button" onclick="hapus({{ $d->id }})"
                        class="p-2 hover:bg-red-50 rounded-lg transition-colors"
                        style="color: #ef4444;"
                        title="Hapus">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                    </button>
                </form>
            </div>
        </div>
    </div>
@empty
    <div class="text-center py-12">
        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        </div>
        <h3 class="text-gray-900 font-medium tracking-tight">Data tidak ditemukan</h3>
        <p class="text-gray-500 text-sm">Coba sesuaikan kata kunci atau filter pencarian Anda.</p>
    </div>
@endforelse
</div>
