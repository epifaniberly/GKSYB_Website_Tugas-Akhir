@extends('layout.admin')

@section('title', 'Sakramen')

@section('content')
    <div class="fs-style-manrope">
    <script>
        window.sakramenMap = {!! json_encode($sakramen->keyBy('id')) !!};
    </script>
    <div class="flex flex-col justify-start text-left py-6">
        <h1 class="admin-page-title">Sakramen Gereja Katolik</h1>
        <p class="text-sm text-gray-500 mt-1">Kelola informasi 7 Sakramen Gereja Katolik yang ditampilkan di halaman publik</p>

        <div class="flex flex-row mt-5 p-3 rounded-lg" style="background-color: #EFF6FF; border: 2px solid #DBEAFE;">
            <div class="w-12 h-12 bg-[#8C1007] text-white rounded-full flex items-center justify-center font-semibold text-lg" style="background-color: #DBEAFE; ">
                <span class="font-thin text-md" style="color: #155DFC;">7</span>
            </div>
            <div class="flex flex-col ml-2">
                <h3 class="text-md font-semibold">Sakramen Gereja Katolik</h3>
                <p class="text-sm">Sistem menampung tepat 7 sakramen sesuai ajaran Gereja Katolik. Setiap sakramen dapat memiliki maksimal 5 gambar slide.</p>
            </div>
        </div>

        @if($sakramen->count() < 7)
            <div class="mt-4 flex items-center gap-3">
                <button onclick="openAddDialog()"
                    style="display:inline-flex;align-items:center;gap:6px;
                    padding:8px 12px;border-radius:8px;
                    color:#1D4ED8;font-weight:500;">
                    ✚ Tambah Sakramen
                </button>

                <p class="text-xs text-gray-500">
                    (Maksimal 7 data sakramen)
                </p>
            </div>
        @else
            <p class="mt-4 text-sm text-red-500">
                Jumlah sakramen sudah maksimal (7 data)
            </p>
        @endif
    </div>
    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
        @foreach ($sakramen as $s)
        <div class="bg-white rounded-lg border border-gray-100 shadow p-4 flex flex-col gap-2" style="border:1.5px solid #E5E7EB;">
            <div class="flex flex-row items-start gap-3">
                <div class="w-12 h-12 bg-gray-100 rounded flex items-center justify-center overflow-hidden">
                    @if($s->icon_sakramen)
                        <img src="{{ asset('storage/' . $s->icon_sakramen) }}" alt="icon" class="w-10 h-10 object-contain">
                    @else
                        <svg width="32" height="32" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="text-gray-400"><rect x="3" y="3" width="18" height="18" rx="4" fill="#F3F4F6"/><path d="M8 13l2.5 3.5a1 1 0 001.6 0L16 13m-8-2a2 2 0 114 0 2 2 0 01-4 0z" stroke="#9CA3AF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    @endif
                </div>
                <div class="flex-1">
                    <div class="font-semibold text-md">{{ $s->judul_sakramen }}</div>
                    <div class="text-sm text-gray-600">{{ $s->deskripsi_singkat }}</div>
                    <div class="flex flex-row items-center gap-2 mt-2 text-xs text-gray-500">
                        <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="text-gray-500"><path d="M4 7h2l2-3h4l2 3h2a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V9a2 2 0 012-2z" stroke="#707275" stroke-width="1.5"/><circle cx="12" cy="13" r="3" stroke="#707275" stroke-width="1.5"/></svg>
                        @php
                            $slidesData = $s->gambar_slide;
                            if (is_string($slidesData)) {
                                $slidesData = json_decode($slidesData, true);
                            }
                            if (is_string($slidesData)) {
                                $slidesData = json_decode($slidesData, true);
                            }
                            $count = is_array($slidesData) ? count($slidesData) : 0;
                        @endphp
                        <span>{{ $count }}/5 gambar</span>
                        <span class="mx-1">&bull;</span>
                        <span>{{ $s->icon_sakramen ? 'Ada icon' : 'Belum ada icon' }}</span>
                    </div>
                </div>
            </div>
            <div class="flex flex-row items-center gap-3 mt-2">
                <div class="w-12 flex justify-center shrink-0">
                    <button type="button" 
                        class="p-2 text-blue-500 hover:text-blue-700 hover:bg-blue-50 rounded-lg transition-colors" 
                        title="Lihat Detail"
                        onclick="openDetailDialog({{ $s->id }})">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                    </button>
                </div>
                <button class="flex-1 flex flex-row items-center justify-center gap-2 bg-[#8C1007] hover:opacity-90 text-white rounded-xl py-2 transition-colors duration-150 focus:outline-none" style="background-color: #8C1007;"
                    onclick="openEditDialog({{ $s->id }})">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                    <span class="text-[12px] sm:text-sm font-semibold">Edit</span>
                </button>
            </div>
            
        </div>
        @endforeach
    </div>

    </div>

    @include('admin.pages.sakramen.components.dialog')
@endsection






