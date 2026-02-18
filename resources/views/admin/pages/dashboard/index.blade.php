@extends('layout.admin')

@section('title', 'Dashboard Sekre')

@section('content')
@php
    $role = auth()->user()->role_type;
@endphp

<div class="fs-style-manrope">
    <div class="flex flex-col justify-start text-left py-6">
        <h1 class="admin-page-title">
            @if($role == 1)
                Halo Admin 👋
            @else
                Halo Super Admin 👋
            @endif
        </h1>
        <p class="text-sm text-gray-500 mt-1">Pusat kendali informasi, publikasi, dan komunikasi umat Paroki Bintaran.</p>
    </div>
</div>

<div class="fs-style-manrope space-y-6">

    @if($totalDraftBintaran > 0)
    <div class="bg-white border text-red-700 px-4 py-3 rounded-lg relative" role="alert">
        <div class="flex items-center">
            <div class="py-1">
                <svg class="fill-current h-6 w-6 text-red-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/>
                </svg>
            </div>
            <div>
                <p class="font-semibold text-[#8C1007]">Konten Draft "Tulisan Bintaran"</p>
                <p class="text-sm text-gray-600">
                    Terdapat <span class="font-semibold">{{ $totalDraftBintaran }}</span> konten Tulisan Bintaran dengan status Draft yang perlu ditindaklanjuti.
                </p>
            </div>
        </div>
    </div>
    @endif

    <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 md:gap-4">

        <div class="bg-white border rounded-xl p-3 md:p-4 flex justify-between items-center shadow-sm">
            <div class="min-w-0">
                <p class="text-[10px] md:text-sm text-gray-500 truncate">Total Tulisan Bintaran</p>
                <h2 class="text-lg md:text-2xl font-semibold text-gray-800">{{ $totalBintaran }}</h2>
                <p class="text-[9px] md:text-xs mt-0.5 {{ $percentBintaran >= 0 ? 'text-green-500' : 'text-red-500' }}">
                    {{ $percentBintaran >= 0 ? '+' : '' }}{{ $percentBintaran }}%
                    <span class="text-gray-400 font-normal">bulan ini</span>
                </p>
            </div>
            <div class="w-8 h-8 md:w-12 md:h-12 shrink-0 flex items-center justify-center rounded-full bg-orange-100 text-sm md:text-xl">
                📝
            </div>
        </div>

        <div class="bg-white border rounded-xl p-3 md:p-4 flex justify-between items-center shadow-sm">
            <div class="min-w-0">
                <p class="text-[10px] md:text-sm text-gray-500 truncate">Kegiatan Mendatang</p>
                <h2 class="text-lg md:text-2xl font-semibold text-gray-800">{{ $totalKegiatan }}</h2>
                <p class="text-[9px] md:text-xs mt-0.5 {{ $percentKegiatan >= 0 ? 'text-green-500' : 'text-red-500' }}">
                    {{ $percentKegiatan >= 0 ? '+' : '' }}{{ $percentKegiatan }}%
                     <span class="text-gray-400 font-normal">bulan ini</span>
                </p>
            </div>
            <div class="w-8 h-8 md:w-12 md:h-12 shrink-0 flex items-center justify-center rounded-full bg-cyan-100 text-sm md:text-xl">
                📅
            </div>
        </div>

        <div class="bg-white border rounded-xl p-3 md:p-4 flex justify-between items-center shadow-sm">
            <div class="min-w-0">
                <p class="text-[10px] md:text-sm text-gray-500 truncate">Total Pesan Masuk</p>
                <h2 class="text-lg md:text-2xl font-semibold text-gray-800">{{ $totalTerhubung }}</h2>
                <p class="text-[9px] md:text-xs mt-0.5 {{ $percentTerhubung >= 0 ? 'text-green-500' : 'text-red-500' }}">
                    {{ $percentTerhubung >= 0 ? '+' : '' }}{{ $percentTerhubung }}%
                     <span class="text-gray-400 font-normal">bulan ini</span>
                </p>
            </div>
            <div class="w-8 h-8 md:w-12 md:h-12 shrink-0 flex items-center justify-center rounded-full bg-pink-100 text-sm md:text-xl">
                💬
            </div>
        </div>

        <div class="bg-white border rounded-xl p-3 md:p-4 flex justify-between items-center shadow-sm">
            <div class="min-w-0">
                <p class="text-[10px] md:text-sm text-gray-500 truncate">Intensi / Ujud Doa</p>
                <h2 class="text-lg md:text-2xl font-semibold text-gray-800">{{ $totalDoa }}</h2>
                <p class="text-[9px] md:text-xs mt-0.5 {{ $percentDoa >= 0 ? 'text-green-500' : 'text-red-500' }}">
                    {{ $percentDoa >= 0 ? '+' : '' }}{{ $percentDoa }}%
                     <span class="text-gray-400 font-normal">bulan ini</span>
                </p>
            </div>
            <div class="w-8 h-8 md:w-12 md:h-12 shrink-0 flex items-center justify-center rounded-full bg-yellow-100 text-sm md:text-xl">
                💛
            </div>
        </div>

    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 items-start">

        <div class="bg-white border rounded-lg p-4">
            <h3 class="text-sm font-semibold mb-1">Pesan Masuk "Mari Terhubung"</h3>
            <p class="text-xs text-gray-500 mb-4">
                Pesan dan pertanyaan terbaru dari umat melalui formulir website
            </p>

            <div class="space-y-4">
                @forelse($terhubungTerbaru as $item)
                    <div class="flex justify-between items-start border-b pb-3">
                        <div>
                            <p class="font-semibold text-sm text-gray-800">{{ $item->nama_lengkap }}</p>
                            <p class="text-[11px] text-gray-400 mt-0.5">
                                {{ $item->created_at->diffForHumans() }}
                                • {{ $item->email }}
                            </p>
                            <p class="text-xs text-gray-600 mt-2 italic line-clamp-1">
                                "{{ $item->isi_pesan }}"
                            </p>
                        </div>

                        <div class="flex items-center gap-2">
                            @if($item->status == 'read')
                                <span class="px-2 py-1 text-[10px] font-semibold rounded bg-gray-100 text-gray-500 uppercase tracking-wider">
                                    Dibaca
                                </span>
                            @else
                                <span class="px-2 py-1 text-[10px] font-semibold rounded bg-blue-100 text-blue-700 uppercase tracking-wider">
                                    Baru
                                </span>
                            @endif

                            <a href="javascript:void(0)"
                                onclick="bukaTerhubung(this)"
                                data-nama="{{ e($item->nama_lengkap) }}"
                                data-email="{{ e($item->email) }}"
                                data-whatsapp="{{ e($item->nomor_telepon) }}"
                                data-lingkungan="{{ e($item->asal_lingkungan ?? '-') }}"
                                data-paroki="{{ e($item->asal_paroki ?? '-') }}"
                                data-pesan="{{ e($item->isi_pesan) }}"
                                data-tanggal="{{ $item->created_at->format('d F Y, H:i') }}"
                                data-status="{{ $item->status == 'read' ? 'DIBACA' : 'BELUM DIBACA' }}"
                                class="p-2 text-blue-500 hover:text-blue-700 hover:bg-blue-50 rounded-lg transition-colors"
                                title="Lihat Detail">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            </a>
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-gray-500">Belum ada pesan masuk.</p>
                @endforelse
            </div>
        </div>

        <div class="bg-white border rounded-lg p-4">
            <h3 class="text-sm font-semibold mb-1">Tulisan Bintaran Terbaru</h3>
            <p class="text-xs text-gray-500 mb-4">
                Kelola dan pantau publikasi artikel terbaru dari Paroki Bintaran
            </p>

            <div class="space-y-4">
                @forelse($bintaranTerbaru as $item)
                    <div class="flex justify-between items-start border-b pb-3">
                        <div class="flex-1 min-w-0 pr-4">
                            <p class="font-semibold text-sm text-gray-800 truncate">{{ $item->judul_tulisan }}</p>
                            <p class="text-[11px] text-gray-400 mt-0.5">
                                {{ $item->created_at->diffForHumans() }} 
                                • {{ $item->kategoriBintaran->nama_kategori ?? 'Umum' }}
                            </p>
                            <p class="text-xs text-gray-600 mt-2 italic line-clamp-1">
                                "{{ $item->ringkasan }}"
                            </p>
                        </div>

                        <div class="flex items-center gap-2 shrink-0">
                            @if($item->is_published)
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-green-50 text-green-600 uppercase tracking-wider border border-green-100">
                                    Published
                                </span>
                            @else
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-gray-50 text-gray-400 uppercase tracking-wider border border-gray-100">
                                    Draft
                                </span>
                            @endif

                            <a href="javascript:void(0)"
                                onclick="bukaBintaran(this)"
                                data-id="{{ $item->id }}"
                                data-judul="{{ e($item->judul_tulisan) }}"
                                class="p-2 text-blue-500 hover:text-blue-700 hover:bg-blue-50 rounded-lg transition-colors"
                                title="Lihat Detail">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            </a>
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-gray-500 text-center py-4">Belum ada tulisan bintaran.</p>
                @endforelse
            </div>
        </div>

    </div>

</div>

@include('admin.pages.dashboard.components.dialog-terhubung')
@include('admin.pages.dashboard.components.dialog-bintaran')
@endsection

@push('script')
<script>
    function bukaTerhubung(el) {
        document.getElementById('modalTerhubung').classList.remove('hidden');
        document.getElementById('modalTerhubung').classList.add('flex');

        document.getElementById('d_nama').innerText = el.dataset.nama;
        document.getElementById('d_email').innerText = el.dataset.email;
        document.getElementById('d_telp').innerText = el.dataset.whatsapp;
        document.getElementById('d_paroki').innerText = el.dataset.paroki;
        document.getElementById('d_lingkungan').innerText = el.dataset.lingkungan;
        document.getElementById('d_tgl').innerText = el.dataset.tanggal;
        document.getElementById('d_pesan').innerText = el.dataset.pesan;

        const status = el.dataset.status;
        const statusBadgeEl = document.getElementById('d_status_badge');

        if(status === 'DIBACA') {
            statusBadgeEl.innerHTML = '<span class="px-2 py-0.5 rounded text-[10px] bg-gray-100 text-gray-500 font-bold uppercase tracking-wider">Dibaca</span>';
        } else {
            statusBadgeEl.innerHTML = '<span class="px-2 py-0.5 rounded text-[10px] bg-blue-50 text-blue-600 font-bold uppercase tracking-wider border border-blue-100">Baru</span>';
        }
    }

    function tutupTerhubung() {
        document.getElementById('modalTerhubung').classList.add('hidden');
        document.getElementById('modalTerhubung').classList.remove('flex');
    }

    // --- DIALOG BINTARAN LOGIC ---
    window.storagePath = "{{ asset('storage/BintaranImage') }}";

    function bukaBintaran(el) {
        const id = el.dataset.id;
        
        // Show loading state
        document.getElementById('d_judul_header').innerText = 'Loading...';
        document.getElementById('d_konten').innerHTML = 'Memuat konten...';
        document.getElementById('modalBintaran').classList.remove('hidden');
        document.getElementById('modalBintaran').classList.add('flex');

        fetch(`/admin-blog/detail/${id}`)
            .then(res => res.json())
            .then(data => {
                document.getElementById('d_judul_header').innerText = data.judul_tulisan;
                document.getElementById('d_kategori_badge').innerText = data.kategori_bintaran ? data.kategori_bintaran.nama_kategori : 'Umum';
                document.getElementById('d_ringkasan').innerText = data.ringkasan;
                document.getElementById('d_konten').innerHTML = data.konten;
                
                const statusEl = document.getElementById('d_status_bintaran');
                if(data.is_published) {
                    statusEl.innerText = 'Published';
                    statusEl.className = 'inline-flex px-3 py-1 rounded-lg text-xs font-semibold bg-green-50 text-green-600 border border-green-100 uppercase tracking-widest';
                } else {
                    statusEl.innerText = 'Draft';
                    statusEl.className = 'inline-flex px-3 py-1 rounded-lg text-xs font-semibold bg-gray-50 text-gray-400 border border-gray-100 uppercase tracking-widest';
                }

                const galleryContainer = document.getElementById('d_gallery');
                const emptyState = document.getElementById('d_gallery_empty');
                galleryContainer.innerHTML = '';
                
                let images = [];
                if (data.images && data.images.length > 0) {
                    data.images.forEach(img => images.push(img.image));
                } else if (data.image) {
                    images.push(data.image);
                }

                if (images.length === 0) {
                    galleryContainer.classList.add('hidden');
                    emptyState.classList.remove('hidden');
                } else {
                    galleryContainer.classList.remove('hidden');
                    emptyState.classList.add('hidden');
                    
                    images.forEach(img => {
                        const div = document.createElement('div');
                        div.className = 'aspect-square rounded-xl overflow-hidden border border-gray-100 group relative';
                        div.innerHTML = `
                            <img src="${window.storagePath}/${img}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                            <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-colors duration-300"></div>
                        `;
                        galleryContainer.appendChild(div);
                    });
                }
            });
    }

    function tutupBintaran() {
        document.getElementById('modalBintaran').classList.add('hidden');
        document.getElementById('modalBintaran').classList.remove('flex');
    }
</script>
@endpush





