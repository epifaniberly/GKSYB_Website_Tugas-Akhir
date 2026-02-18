<div class="space-y-4">
    @forelse($tulisan as $item)
    <div class="bg-white border border-gray-200 rounded-xl p-6 hover:border-gray-300 transition-colors">
        <div class="flex flex-col sm:flex-row justify-between items-start gap-4">
            <div class="flex-1 space-y-3 min-w-0">
                <h3 class="font-semibold text-gray-800 text-base md:text-lg break-words">
                    {{ $item->judul_tulisan }}
                </h3>
                <p class="text-gray-500 text-xs md:text-sm leading-relaxed line-clamp-2">
                    {{ $item->ringkasan }}
                </p>
                <div class="flex flex-wrap items-center gap-x-3 gap-y-2 text-[11px] md:text-xs text-gray-400 mt-3 font-medium">
                    <div class="flex items-center gap-1.5 bg-gray-50 px-2 py-1 rounded-md">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path></svg>
                        <span>{{ $item->kategoriBintaran ? $item->kategoriBintaran->nama_kategori : 'Umum' }}</span>
                    </div>

                    <div class="hidden xs:block text-gray-300">•</div>
                    <div class="flex items-center gap-1">
                        <span class="text-gray-300">Oleh:</span>
                        <span class="text-gray-500">{{ $item->user ? $item->user->name : 'Admin' }}</span>
                    </div>

                    <div class="hidden xs:block text-gray-300">•</div>
                    <span class="text-gray-500">{{ $item->created_at->format('d M Y') }}</span>

                    <div class="w-full sm:hidden"></div> 
                    @if($item->is_published)
                        <span class="bg-green-50 text-green-600 text-[10px] px-2 py-0.5 rounded-full font-semibold border border-green-100 uppercase tracking-widest">
                            Published
                        </span>
                    @else
                        <span class="bg-gray-100 text-gray-500 text-[10px] px-2 py-0.5 rounded-full font-semibold border border-gray-200 uppercase tracking-widest">
                            Draft
                        </span>
                    @endif
                </div>
            </div>
            <div class="flex items-center gap-1.5 sm:gap-2 shrink-0 w-full sm:w-auto justify-end">
                <button onclick='showDetailDialog({{ $item->id }})' class="p-2 text-blue-500 hover:text-blue-700 hover:bg-blue-50 rounded-lg transition-colors" title="Lihat">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                </button>
                <button onclick="openEditDialog({{ $item->id }})" class="p-2 hover:bg-yellow-50 rounded-lg transition-colors" style="color: #eab308;" title="Edit">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                </button>
                <form id="delete-tulisan-{{ $item->id }}" action="{{ route('admin.blog.destroy', $item->id) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="button" onclick="hapusTulisan('{{ $item->id }}')" class="p-2 hover:bg-red-50 rounded-lg transition-colors" style="color: #ef4444;" title="Hapus">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                    </button>
                </form>

            </div>

        </div>
    </div>
    @empty
    <div class="bg-white border border-gray-200 rounded-xl p-8 text-center text-gray-500">
        Belum ada tulisan bintaran yang dibuat.
    </div>
    @endforelse

    <div class="px-2">
        {{ $tulisan->links() }}
    </div>
</div>

<script>
    function hapusTulisan(id) {
        SwalHelper.confirmDelete('tulisan ini').then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-tulisan-' + id).submit();
            }
        });
    }
</script>





