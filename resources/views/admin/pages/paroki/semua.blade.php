<form action="{{ route('admin.paroki.index') }}" method="GET" id="filterForm" class="grid grid-cols-1 lg:grid-cols-4 gap-3 md:gap-4 mb-8 w-full">
    <div class="relative col-span-1 lg:col-span-3 min-w-0">
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
            </svg>
        </div>
        <input type="text" name="search" value="{{ request('search') }}"
            oninput="this.form.submit()"
            class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-[#8C1007] focus:border-[#8C1007] text-[12px] md:text-sm mobile-font-tiny text-gray-700 placeholder-gray-400 transition-all font-manrope bg-white h-[42px]"
            placeholder="Cari nama pastor atau jabatan...">
    </div>
    <div class="relative col-span-1 min-w-0">
        <select name="status" onchange="this.form.submit()"
            class="w-full px-4 py-2 bg-white border border-gray-300 rounded-lg text-[12px] md:text-sm mobile-font-tiny text-gray-700 focus:outline-none focus:ring-1 focus:ring-[#8C1007] focus:border-[#8C1007] transition-all cursor-pointer font-manrope h-[42px] appearance-none">
            <option value="">Semua Status</option>
            <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Aktif</option>
            <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Tidak Aktif</option>
        </select>
        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-gray-400">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
        </div>
    </div>
</form>
<div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-6">
    @forelse($data as $p)
        <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm hover:shadow-md transition-all flex items-center gap-6 relative overflow-hidden group">
            <div class="absolute left-0 top-0 bottom-0 w-1.5 {{ $p->status == 1 ? 'bg-green-500' : 'bg-gray-300' }}"></div>
            <div class="w-20 h-20 rounded-full bg-gray-100 flex items-center justify-center flex-shrink-0 overflow-hidden border border-gray-50">
                @if($p->foto_pastor)
                    <img src="{{ asset('storage/FotoPastor/'.$p->foto_pastor) }}" class="w-full h-full object-cover {{ $p->status == 0 ? 'opacity-60 grayscale-[40%]' : '' }}">
                @else
                    <div class="text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                    </div>
                @endif
            </div>
            <div class="flex-1 min-w-0 ml-2">
                <div class="flex items-center justify-between mb-1">
                    <h4 class="text-lg font-semibold text-gray-800 truncate">{{ $p->nama_pastor }}</h4>
                </div>
                
                @if($p->status == 1)
                    <p class="text-sm text-gray-500 font-medium mb-4">{{ $p->jabatan }}</p>
                @else
                    <p class="text-[11px] text-gray-400 font-medium mb-4">Masa Karya: {{ $p->tahun_mulai }} - {{ $p->tahun_selesai ?? 'Sekarang' }}</p>
                @endif
                
                <div class="flex items-center gap-1.5 sm:gap-2">
                    <button onclick='openEdit(@json($p), "view")' 
                        class="p-2 text-blue-500 hover:text-blue-700 hover:bg-blue-50 rounded-lg transition-colors"
                        title="Lihat">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                    </button>
                    <button onclick='openEdit(@json($p), "edit")' 
                        class="p-2 hover:bg-yellow-50 rounded-lg transition-colors"
                        style="color: #eab308;"
                        title="Edit">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    </button>
                    <button onclick="hapus({{ $p->id }})" 
                        class="p-2 hover:bg-red-50 rounded-lg transition-colors"
                        style="color: #ef4444;"
                        title="Hapus">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                    </button>
                </div>
            </div>
        </div>
    @empty
        <div class="col-span-full py-20 bg-gray-50 rounded-3xl border border-dashed border-gray-200 flex flex-col items-center justify-center text-center">
            <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center shadow-sm mb-4 text-gray-300">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                    <circle cx="12" cy="7" r="4"></circle>
                </svg>
            </div>
            <p class="text-gray-500 font-semibold font-manrope">Tidak ada data pastor ditemukan</p>
            <p class="text-sm text-gray-400 mt-1">Coba gunakan kata kunci pencarian atau filter yang berbeda</p>
        </div>
    @endforelse
</div>






