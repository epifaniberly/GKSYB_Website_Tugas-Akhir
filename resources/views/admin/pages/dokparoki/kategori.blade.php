<div class="space-y-6 fs-style-manrope">

    <div class="w-full">
        <h3 class="text-base font-semibold text-gray-800 mb-4">Tambah Kategori Baru</h3>
        <form
            class="flex gap-4 mb-8"
            id="formKategori"
            method="POST"
            action="{{ route('admin.kategori-dokparoki.store') }}"
        >
            @csrf

            <input type="hidden" name="id" id="kategori_id">
            <input type="hidden" name="_method" id="method" value="POST">

            <div class="flex-1">
                <input
                    type="text"
                    name="nama_kategori"
                    id="nama_kategori"
                    class="w-full h-[42px] px-4 bg-white border border-gray-300 rounded-lg focus:ring-1 focus:ring-[#8C1007] focus:border-[#8C1007] outline-none transition-all placeholder-gray-400 text-sm"
                    placeholder="Nama kategori"
                    required
                >
            </div>
            
            <button
                type="submit"
                id="btnSubmit"
                class="w-[42px] h-[42px] flex items-center justify-center text-white rounded-lg hover:opacity-90 transition-opacity shrink-0 focus:outline-none"
                style="background-color: #8C1007;"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path></svg>
            </button>
        </form>

        <div class="space-y-3">
            @foreach($kategori as $item)
            <div class="flex items-center justify-between p-4 bg-white border border-gray-200 rounded-xl hover:border-gray-300 transition-colors">

                <div class="flex items-center gap-3">
                    <span class="font-semibold text-gray-700">
                        {{ $item->nama_kategori }}
                    </span>
                </div>

                <div class="flex items-center gap-2">

                    <button
                        type="button"
                        onclick="editKategori('{{ $item->id }}','{{ $item->nama_kategori }}')"
                        class="p-2 hover:bg-yellow-50 rounded-lg transition-colors"
                        style="color: #eab308;"
                        title="Edit"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    </button>

                    <form
                        id="delete-{{ $item->id }}"
                        action="{{ route('admin.kategori-dokparoki.destroy', $item->id) }}"
                        method="POST"
                        class="flex items-center"
                    >
                        @csrf
                        @method('DELETE')

                        <button
                            type="button"
                            onclick="hapusKategori('{{ $item->id }}')"
                            class="p-2 hover:bg-red-50 rounded-lg transition-colors"
                            style="color: #ef4444;"
                            title="Hapus"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7h6m-7 0V5a1 1 0 011-1h4a1 1 0 011 1v2"></path></svg>
                        </button>
                    </form>

                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>


@push('script')
<script>

    function editKategori(id, nama, warna) {
        document.getElementById('kategori_id').value = id
        document.getElementById('nama_kategori').value = nama

        document.getElementById('method').value = "PATCH"

        document.getElementById('formKategori').action =
            `/admin-kategori-dok-paroki/update/${id}`

        document.getElementById('btnSubmit').innerHTML = "✓"
    }

    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('formKategori');
        if (form) {
            form.addEventListener('submit', function(e) {
                const method = document.getElementById('method').value;
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

    function hapusKategori(id) {
        SwalHelper.confirmDelete('kategori ini').then((result) => {
            if (result.isConfirmed) {
                document.getElementById(`delete-${id}`).submit()
            }
        })
    }

</script>
@endpush






