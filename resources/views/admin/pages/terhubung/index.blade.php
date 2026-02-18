@extends('layout.admin')

@section('title', 'Pesan Mari Terhubung')

@section('content')
    <div class="flex flex-col justify-start text-left py-6">
        <h1 class="admin-page-title">Mari Terhubung</h1>
        <p class="text-sm text-gray-500 mt-1">
            Kelola pesan dan pertanyaan dari umat melalui formulir website
        </p>
    </div>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
        <div class="bg-white rounded-xl p-5 border border-gray-200 shadow-sm">
            <p class="text-sm font-semibold text-gray-400">Total Pesan</p>
            <h3 class="text-3xl font-semibold text-gray-800 mt-2">{{ number_format($total) }}</h3>
        </div>
        <div class="bg-white rounded-xl p-5 border border-gray-200 shadow-sm">
            <p class="text-sm font-semibold text-gray-400">Pesan Baru</p>
            <h3 class="text-3xl font-semibold text-blue-600 mt-2">{{ number_format($baru) }}</h3>
        </div>
        <div class="bg-white rounded-xl p-5 border border-gray-200 shadow-sm">
            <p class="text-sm font-semibold text-gray-400">Dibaca</p>
            <h3 class="text-3xl font-semibold text-orange-500 mt-2">{{ number_format($dibaca) }}</h3>
        </div>
        <div class="bg-white rounded-xl p-5 border border-gray-200 shadow-sm">
            <p class="text-sm font-semibold text-gray-400">Ditindaklanjuti</p>
            <h3 class="text-3xl font-semibold text-green-600 mt-2">{{ number_format($tindak) }}</h3>
        </div>
    </div>
    <div class="bg-white border rounded-xl p-5 border border-gray-200 mb-10 overflow-hidden">
        <form action="{{ route('admin.terhubung.index') }}" method="GET" id="filterForm" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-3 md:gap-4 w-full">
            <div class="relative col-span-1 md:col-span-2 lg:col-span-3 min-w-0">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                    </svg>
                </div>
                <input type="text" name="search" id="searchInput" value="{{ request('search') }}"
                    class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-[#8C1007] focus:border-[#8C1007] placeholder-gray-400 text-[12px] md:text-sm mobile-font-tiny text-gray-700 h-[42px]"
                    placeholder="Cari pesan...">
            </div>
            <div class="relative col-span-1 min-w-0">
                <select name="status" onchange="document.getElementById('filterForm').submit()"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 bg-white text-gray-700 focus:outline-none focus:ring-1 focus:ring-[#8C1007] focus:border-[#8C1007] text-[12px] md:text-sm mobile-font-tiny h-[42px] appearance-none cursor-pointer">
                    <option value="">Semua Status</option>
                    <option value="baru" {{ request('status') == 'baru' ? 'selected' : '' }}>Baru</option>
                    <option value="diterima" {{ request('status') == 'diterima' ? 'selected' : '' }}>Dibaca</option>
                    <option value="gagal" {{ request('status') == 'gagal' ? 'selected' : '' }}>Ditindaklanjuti</option>
                </select>
                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-gray-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </div>
            </div>
        </form>
    </div>
    <div class="space-y-4">
        @forelse($data as $item)
            <div class="bg-white border border-gray-200 rounded-xl p-5 sm:p-6 hover:border-gray-300 transition-colors group relative">
                <div class="flex items-center justify-between gap-3 mb-3">
                    <div class="flex items-center gap-2 sm:gap-3 min-w-0">
                        <h4 class="text-[14px] sm:text-[16px] font-bold text-gray-800 font-manrope truncate">
                            {{ $item->nama_lengkap ?? $item->email }}
                        </h4>
                        <div class="shrink-0">
                            @if($item->status == 'baru')
                                <span class="bg-blue-50 text-blue-600 text-[9px] sm:text-[10px] px-2 py-0.5 rounded-full font-bold border border-blue-100 uppercase tracking-widest">
                                    Baru
                                </span>
                            @elseif($item->status == 'diterima')
                                <span class="bg-amber-50 text-amber-600 text-[9px] sm:text-[10px] px-2 py-0.5 rounded-full font-bold border border-amber-100 uppercase tracking-widest">
                                    Dibaca
                                </span>
                            @else
                                <span class="bg-emerald-50 text-emerald-600 text-[9px] sm:text-[10px] px-2 py-0.5 rounded-full font-bold border border-emerald-100 uppercase tracking-widest">
                                    Ditindaklanjuti
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="mb-4">
                    <p class="text-gray-600 text-[13px] sm:text-[15px] font-medium leading-relaxed line-clamp-2 group-hover:line-clamp-none transition-all">
                        {{ $item->isi_pesan }}
                    </p>
                </div>
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mt-2 pt-4 border-t border-gray-50">
                    <div class="flex flex-wrap items-center gap-x-3 gap-y-1.5 text-[11px] sm:text-[13px] font-semibold text-gray-400 font-manrope">
                        <span class="truncate max-w-[150px] sm:max-w-none">{{ $item->email }}</span>
                        <span class="text-gray-200 hidden sm:inline">•</span>
                        <span>{{ $item->telp ?? $item->nomor_telepon ?? '-' }}</span>
                        <span class="text-gray-200 hidden sm:inline">•</span>
                        <span class="flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            <span class="whitespace-nowrap">{{ \Carbon\Carbon::parse($item->tanggal_kirim)->translatedFormat('d M Y') }}</span>
                        </span>
                    </div>
                    <div class="flex items-center gap-2 sm:ml-auto">
                        <button onclick='openDetail(@json($item))'
                            class="p-2 text-blue-500 hover:text-blue-700 hover:bg-blue-50 rounded-lg transition-colors"
                            title="Lihat Detail">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                        </button>
                        <button onclick='openEdit(@json($item))'
                            class="p-2 hover:bg-yellow-50 rounded-lg transition-colors"
                            style="color: #eab308;"
                            title="Update Status">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <div class="bg-white border border-gray-200 rounded-xl p-20 text-center">
                <div class="w-20 h-20 rounded-full bg-gray-50 flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900">Belum ada pesan</h3>
                <p class="text-gray-500 italic mt-1">Semua pesan dari formulir kontak akan muncul di sini.</p>
            </div>
        @endforelse
    </div>
<form id="deleteForm" method="POST" class="hidden">
    @csrf
    @method('DELETE')
</form>

@include('admin.pages.terhubung.components.dialog')
@endsection

@push('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        let searchTimeout;
        const searchInput = document.getElementById('searchInput');
        
        if(searchInput) {
            searchInput.addEventListener('input', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(function() {
                    document.getElementById('filterForm').submit();
                }, 800); 
            });

            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has('search')) {
                searchInput.focus();
                const val = searchInput.value;
                searchInput.value = '';
                searchInput.value = val;
            }
        }

        function openDetail(item) {
            document.getElementById('d_nama').innerText = item.nama_lengkap || item.nama || item.email;
            document.getElementById('d_email').innerText = item.email;
            document.getElementById('d_telp').innerText = item.telp || item.nomor_telepon || '-';
            document.getElementById('d_paroki').innerText = item.asal_paroki || '-';
            document.getElementById('d_lingkungan').innerText = item.asal_lingkungan || '-';
            
            let statusBadge = '';
            if(item.status === 'baru') {
                statusBadge = '<span class="bg-blue-50 text-blue-600 text-[10px] px-2 py-0.5 rounded-full font-semibold border border-blue-100 uppercase tracking-widest">Baru</span>';
            } else if(item.status === 'diterima') {
                statusBadge = '<span class="bg-amber-50 text-amber-600 text-[10px] px-2 py-0.5 rounded-full font-semibold border border-amber-100 uppercase tracking-widest">Dibaca</span>';
            } else {
                statusBadge = '<span class="bg-green-50 text-green-600 text-[10px] px-2 py-0.5 rounded-full font-semibold border border-green-100 uppercase tracking-widest">Ditindaklanjuti</span>';
            }
            document.getElementById('d_status_badge').innerHTML = statusBadge;

            const dateObj = new Date(item.tanggal_kirim || item.created_at);
            const dateStr = dateObj.toLocaleDateString('en-CA'); 
            document.getElementById('d_tgl').innerText = dateStr;
            
            document.getElementById('d_pesan').innerText = item.isi_pesan;

            document.getElementById('modalDetail').classList.remove('hidden');
            document.getElementById('modalDetail').classList.add('flex');
        }

        function hideDetail() {
            document.getElementById('modalDetail').classList.add('hidden');
            document.getElementById('modalDetail').classList.remove('flex');
        }

        function openEdit(item) {
            document.getElementById('e_status').value = item.status;
            const form = document.getElementById('formStatus');
            form.action = "{{ url('admin-terhubung/update-status') }}/" + item.id;

            document.getElementById('modalEdit').classList.remove('hidden');
            document.getElementById('modalEdit').classList.add('flex');
        }

        function hideEdit() {
            document.getElementById('modalEdit').classList.add('hidden');
            document.getElementById('modalEdit').classList.remove('flex');
        }

        function confirmDelete(id) {
            SwalHelper.confirmDelete('pesan ini').then((result) => {
                if (result.isConfirmed) {
                    const form = document.getElementById('deleteForm');
                    form.action = "{{ url('admin-terhubung/destroy') }}/" + id;
                    form.submit();
                }
            })
        }

        function submitStatus() {
            SwalHelper.confirmEdit('Status Pesan').then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('formStatus').submit();
                }
            });
        }
    </script>
@endpush





