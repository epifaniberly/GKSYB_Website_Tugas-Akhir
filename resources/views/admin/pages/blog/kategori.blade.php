<div class="space-y-6 fs-style-manrope">
    <div class="space-y-4">
        <h3 class="text-base font-semibold text-gray-800">Tambah Kategori Baru</h3>
        
        <form
            class="flex gap-4 items-center"
            id="formKategoriBaru"
            method="POST"
            action="{{ route('admin.blog.kategori.store') }}"
        >
            @csrf
            <input type="hidden" name="id" id="input_kategori_id">
            <input type="hidden" name="_method" id="input_method" value="POST">
            <div class="flex-1">
                <input
                    type="text"
                    name="nama_kategori"
                    id="input_nama_kategori"
                    class="w-full h-[42px] px-4 bg-white border border-gray-300 rounded-lg focus:ring-1 focus:ring-[#8C1007] focus:border-[#8C1007] outline-none transition-all placeholder-gray-400 text-sm"
                    placeholder="Nama kategori"
                    required
                >
            </div>
            <div class="w-[42px] h-[42px] relative overflow-hidden rounded-lg border border-gray-200 cursor-pointer hover:border-gray-300 shrink-0">
                <input
                    type="color"
                    name="warna"
                    id="input_warna"
                    class="absolute -top-1/2 -left-1/2 w-[200%] h-[200%] p-0 border-0 cursor-pointer m-0"
                    value="#8C1007"
                    required
                >
            </div>
            <button
                type="submit"
                id="btnSimpanKategori"
                class="w-[42px] h-[42px] flex items-center justify-center text-white rounded-lg hover:opacity-90 transition-opacity shrink-0 focus:outline-none"
                style="background-color: #8C1007;"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path></svg>
            </button>
        </form>
    </div>
    <div class="space-y-3">
        @forelse($kategori as $item)
        <div class="flex items-center justify-between p-4 bg-white border border-gray-200 rounded-xl hover:border-gray-300 transition-colors">
            
            <div class="flex items-center gap-4">
                <div class="w-8 h-8 rounded-lg flex-shrink-0 shadow-sm" style="background-color: {{ $item->warna }}"></div>
                <span class="text-[12px] sm:text-sm font-medium text-gray-700">
                    {{ $item->nama_kategori }}
                </span>
            </div>
            <div class="flex items-center gap-2">
                <button
                    type="button"
                    onclick="editKategoriItem('{{ $item->id }}','{{ $item->nama_kategori }}','{{ $item->warna }}')"
                    class="p-2 hover:bg-yellow-50 rounded-lg transition-colors"
                    style="color: #eab308;"
                    title="Edit"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                </button>
                <form
                    id="delete-kategori-{{ $item->id }}"
                    action="{{ route('admin.blog.kategori.destroy', $item->id) }}"
                    method="POST"
                    class="inline"
                >
                    @csrf
                    @method('DELETE')

                    <button
                        type="button"
                        onclick="hapusKategoriItem('{{ $item->id }}')"
                        class="p-2 hover:bg-red-50 rounded-lg transition-colors"
                        style="color: #ef4444;"
                        title="Hapus"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                    </button>
                </form>
            </div>
        </div>
        @empty
        <div class="text-center p-4 text-gray-500 text-sm">
            Belum ada kategori. Silakan tambah kategori baru.
        </div>
        @endforelse
    </div>

</div>

@push('script')
<script>
    function editKategoriItem(id, nama, warna) {
        document.getElementById('input_kategori_id').value = id;
        document.getElementById('input_nama_kategori').value = nama;
        document.getElementById('input_warna').value = warna;

        document.getElementById('input_method').value = "PATCH";
        const updateBintaranKategoriUrl = "{{ route('admin.blog.kategori.update', ':id') }}";
        document.getElementById('formKategoriBaru').action = updateBintaranKategoriUrl.replace(':id', id);
        
        // Change button to checkmark
        const btn = document.getElementById('btnSimpanKategori');
        btn.innerHTML = '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>';
    }

    // Konfirmasi Edit Kategori
    document.addEventListener('DOMContentLoaded', function() {
        const formKategori = document.getElementById('formKategoriBaru');
        if (formKategori) {
            formKategori.addEventListener('submit', function(e) {
                const method = document.getElementById('input_method').value;
                
                // Jika PATCH (edit), tampilkan konfirmasi
                if (method === 'PATCH') {
                    e.preventDefault();
                    
                    SwalHelper.confirmEdit('kategori ini').then((result) => {
                        if (result.isConfirmed) {
                            this.submit();
                        }
                    });
                }
                // Jika POST (tambah), langsung submit tanpa konfirmasi
            });
        }
    });

    function hapusKategoriItem(id) {
        SwalHelper.confirmDelete('kategori ini').then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-kategori-' + id).submit();
            }
        });
    }
</script>
@endpush





