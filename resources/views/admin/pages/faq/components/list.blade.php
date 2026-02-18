<div class="grid gap-4">
    @forelse ($faq as $item)
        <div class="bg-white border border-gray-200 rounded-2xl transition-all hover:shadow-sm">

            <button
                type="button"
                onclick="toggleFaq({{ $item->id }})"
                class="w-full flex justify-between items-start p-6 text-left transition-colors rounded-2xl hover:bg-gray-50 focus:outline-none focus:ring-0">

                <div class="flex items-start gap-5">
                    <div class="flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="#8C1007" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <span class="text-[16px] font-semibold text-gray-800 leading-normal block">{{ $item->pertanyaan }}</span>
                        <span class="text-xs text-secondary font-medium mt-1 inline-block">
                             {{ $item->kategoriFaq ? $item->kategoriFaq->nama_kategori : 'Tanpa Kategori' }}
                        </span>
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    @if($item->is_active)
                        <span class="bg-green-50 text-green-600 text-[10px] px-2 py-0.5 rounded-full font-semibold border border-green-100 uppercase tracking-widest">
                            Aktif
                        </span>
                    @else
                        <span class="bg-gray-100 text-gray-500 text-[10px] px-2 py-0.5 rounded-full font-semibold border border-gray-200 uppercase tracking-widest">
                            Nonaktif
                        </span>
                    @endif

                    <svg id="icon-{{ $item->id }}"
                        class="w-5 h-5 text-gray-400 transition-transform duration-300"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 9l-7 7-7-7" />
                    </svg>
                </div>
            </button>

            <div id="content-{{ $item->id }}"
                class="hidden px-5 pb-5 pl-16">
                
                <hr class="border-gray-100 mb-4">
                
                <p class="text-sm text-gray-600 leading-relaxed">
                    {{ $item->jawaban }}
                </p>

                <div class="flex items-center gap-2 mt-4">
                    <button
                        type="button"
                        class="p-2 hover:bg-yellow-50 rounded-lg transition-colors"
                        style="color: #eab308;"
                        title="Edit"
                        data-id="{{ $item->id }}"
                        data-pertanyaan="{{ e($item->pertanyaan) }}"
                        data-jawaban="{{ e($item->jawaban) }}"
                        data-kategori="{{ $item->kategori_faq_id }}"
                        data-status="{{ $item->is_active ? 1 : 0 }}"
                        onclick="bukaEdit(this)">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    </button>
                    <form id="form-delete-{{ $item->id }}"
                        action="{{ route('admin.faq.destroy', $item->id) }}"
                        method="POST"
                        class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="button"
                            onclick="hapusFaq({{ $item->id }})"
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
        <div class="flex flex-col items-center justify-center py-20 bg-gray-50 rounded-2xl border-2 border-dashed border-gray-200">
            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4 text-gray-400">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <p class="text-gray-500 font-medium">Tidak ada data FAQ</p>
            <p class="text-sm text-gray-400 mt-1">Sesuaikan filter atau tambahkan data baru</p>
        </div>
    @endforelse
</div>






