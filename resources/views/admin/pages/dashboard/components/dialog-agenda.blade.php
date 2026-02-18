<div id="modalAgenda" class="hidden fixed inset-0 z-50 bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-white rounded-lg w-full max-w-lg p-6">

        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold">Detail Agenda Kegiatan</h3>
            <button onclick="tutupAgenda()" class="text-gray-500 focus:outline-none">✖</button>
        </div>

        <div class="space-y-3 text-sm">

            <div>
                <p class="text-gray-500">Nama Kegiatan</p>
                <p id="agenda_nama" class="font-medium"></p>
            </div>

            <div>
                <p class="text-gray-500">Kategori</p>
                <p id="agenda_kategori"></p>
            </div>

            <div>
                <p class="text-gray-500">Tanggal</p>
                <p id="agenda_tanggal"></p>
            </div>

            <div>
                <p class="text-gray-500">Waktu</p>
                <p id="agenda_waktu"></p>
            </div>

            <div>
                <p class="text-gray-500">Lokasi</p>
                <p id="agenda_lokasi"></p>
            </div>

            <div>
                <p class="text-gray-500">Keterangan</p>
                <p id="agenda_keterangan" class="whitespace-pre-line"></p>
            </div>

            <div>
                <p class="text-gray-500">Status</p>
                <span id="agenda_status" class="px-2 py-1 text-xs rounded"></span>
            </div>

        </div>

        <div class="flex justify-end mt-6">
            <button onclick="tutupAgenda()" class="px-4 py-2 bg-gray-100 rounded text-sm focus:outline-none">
                Tutup
            </button>
        </div>

    </div>
</div>





