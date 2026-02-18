<div class="space-y-6 fs-style-manrope">
    <div class="space-y-4">
        <h3 class="text-base font-semibold text-gray-800">Tambah Kategori Baru</h3>
        
        <form
            class="flex gap-4 items-center"
            id="formKategoriJadwal"
            method="POST"
            action="{{ route('admin.kategori.store') }}"
        >
            @csrf
            <input type="hidden" name="id" id="kategori_id_jadwal">
            <input type="hidden" name="_method" id="method_jadwal" value="POST">
            <div class="flex-1">
                <input
                    type="text"
                    name="nama_kategori"
                    id="nama_kategori_jadwal"
                    class="w-full h-[42px] px-4 bg-white border border-gray-300 rounded-lg focus:ring-1 focus:ring-[#8C1007] focus:border-[#8C1007] outline-none transition-all placeholder-gray-400 text-sm"
                    placeholder="Nama kategori"
                    required
                >
            </div>
            <button
                type="submit"
                id="btnSubmitKategoriJadwal"
                class="w-[42px] h-[42px] flex items-center justify-center text-white rounded-lg hover:opacity-90 transition-opacity shrink-0 focus:outline-none"
                style="background-color: #8C1007;"
            >
                <svg id="iconPlus" class="w-5 h-5" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path></svg>
                <span id="iconCheck" class="hidden text-white font-semibold">✓</span>
            </button>
        </form>
    </div>
    <div class="space-y-3">
        @foreach($kategori as $item)
        <div class="flex items-center justify-between p-4 bg-white border border-gray-200 rounded-xl hover:border-gray-300 transition-colors">
            
            <div class="flex items-center gap-4">
                <span class="text-[12px] sm:text-sm font-medium text-gray-700">
                    {{ $item->nama_kategori }}
                </span>
            </div>
            <div class="flex items-center gap-2">
                <button
                    type="button"
                    onclick="editKategoriJadwal('{{ $item->id }}','{{ $item->nama_kategori }}')"
                    class="p-2 hover:bg-yellow-50 rounded-lg transition-colors"
                    style="color: #eab308;"
                    title="Edit"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                </button>

                <form
                    id="delete-kategori-jadwal-{{ $item->id }}"
                    action="{{ route('admin.kategori.destroy', $item->id) }}"
                    method="POST"
                    class="inline"
                >
                    @csrf
                    @method('DELETE')

                    <button
                        type="button"
                        onclick="hapusKategoriJadwal('{{ $item->id }}')"
                        class="p-2 hover:bg-red-50 rounded-lg transition-colors"
                        style="color: #ef4444;"
                        title="Hapus"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                    </button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
</div>

@push('script')
<script>
    function editKategoriJadwal(id, nama) {
        document.getElementById('kategori_id_jadwal').value = id;
        document.getElementById('nama_kategori_jadwal').value = nama;

        document.getElementById('method_jadwal').value = "PATCH";
        document.getElementById('formKategoriJadwal').action = `/admin-kategori-jadwal/update/${id}`;
        
        document.getElementById('iconPlus').classList.add('hidden');
        document.getElementById('iconCheck').classList.remove('hidden');
        
        document.getElementById('nama_kategori_jadwal').focus();
    }

    document.addEventListener('DOMContentLoaded', function() {
        const formKategori = document.getElementById('formKategoriJadwal');
        if (formKategori) {
            formKategori.addEventListener('submit', function(e) {
                const method = document.getElementById('method_jadwal').value;
                
                if (method === 'PATCH') {
                    e.preventDefault();
                    
                    SwalHelper.confirmEdit('kategori ini').then((result) => {
                        if (result.isConfirmed) {
                            this.submit();
                        }
                    });
                }
            });
        }
    });

    function hapusKategoriJadwal(id) {
        SwalHelper.confirmDelete('kategori ini').then((result) => {
            if (result.isConfirmed) {
                document.getElementById(`delete-kategori-jadwal-${id}`).submit();
            }
        });
    }
</script>
@endpush






