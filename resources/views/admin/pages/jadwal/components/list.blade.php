<div class="space-y-4">
    @forelse($jadwal as $item)
    <div class="bg-white border border-gray-200 rounded-xl p-6 hover:border-gray-300 transition-colors fs-style-manrope">
        <div class="flex flex-col sm:flex-row justify-between items-start gap-4">
            <div class="flex-1 space-y-3 min-w-0 w-full">
                <div class="flex flex-wrap items-center gap-2">
                    <h3 class="font-semibold text-gray-800 text-base md:text-lg break-words">
                        {{ $item->nama_jadwal }}
                    </h3>
                    @if($item->is_active)
                        <span class="bg-green-50 text-green-600 text-[10px] px-2 py-0.5 rounded-full font-semibold border border-green-100 uppercase tracking-widest">
                            Published
                        </span>
                    @else
                        <span class="bg-gray-100 text-gray-500 text-[10px] px-2 py-0.5 rounded-full font-semibold border border-gray-200 uppercase tracking-widest">
                            Draft
                        </span>
                    @endif
                </div>
                @if($item->keterangan)
                    <p class="text-gray-500 text-xs md:text-sm leading-relaxed line-clamp-2">
                        {{ $item->keterangan }}
                    </p>
                @endif
                <div class="flex flex-wrap items-center gap-x-3 gap-y-2 text-[11px] md:text-xs text-gray-400 mt-3 font-medium">
                    <div class="flex items-center gap-1.5 bg-gray-50 px-2.5 py-1 rounded-md">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path></svg>
                        <span>{{ $item->kategoriJadwal ? $item->kategoriJadwal->nama_kategori : 'Umum' }}</span>
                    </div>

                    <div class="hidden xs:block text-gray-300">•</div>
                    <div class="flex items-center gap-1.5 ">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span class="text-gray-500">{{ $item->hari }}, {{ preg_replace('/(\d{2}:\d{2}):00/', '$1', $item->waktu) }} WIB</span>
                    </div>

                    <div class="hidden xs:block text-gray-300">•</div>
                    <div class="flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        <span class="text-gray-500 truncate max-w-[150px] sm:max-w-none">{{ $item->lokasi }}</span>
                    </div>
                </div>
            </div>
            <div class="flex items-center gap-1.5 sm:gap-2 shrink-0 w-full sm:w-auto justify-end mt-2 sm:mt-0">
                <button onclick='bukaEdit(@json($item))' 
                    class="p-2 hover:bg-yellow-50 rounded-lg transition-colors" 
                    style="color: #eab308;" 
                    title="Edit">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                </button>
                <form id="form-delete-{{ $item->id }}" action="{{ route('admin.jadwal.destroy', $item->id) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="button" onclick="hapusJadwal({{ $item->id }})" 
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
    <div class="bg-gray-50 border border-dashed border-gray-200 rounded-2xl p-16 text-center">
        <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center shadow-sm mx-auto mb-4 border border-gray-100">
            <svg class="w-8 h-8 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
        </div>
        <h3 class="text-gray-900 font-bold text-lg">Belum Ada Jadwal</h3>
        <p class="text-gray-400 text-sm mt-1">Silakan tambahkan jadwal baru pada tab "Tambah Jadwal".</p>
    </div>
    @endforelse
</div>

@if($jadwal->hasPages())
<div class="mt-8">
    {{ $jadwal->links() }}
</div>
@endif





