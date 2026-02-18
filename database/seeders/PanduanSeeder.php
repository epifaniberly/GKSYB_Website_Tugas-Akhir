<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PanduanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\PanduanModel::create([
            'jenis_misa' => 'Misa Mingguan',
            'perayaan' => 'Minggu Adven II',
            'ket_perayaan' => 'Melalui Perayaan Misa Mingguan, umat berkumpul untuk bersekutu dalam doa, mendengarkan sabda Tuhan, dan dikuatkan dalam Ekaristi.',
            'ayat_alkitab' => 'Sebab di mana dua atau tiga orang berkumpul dalam nama-Ku, di situ Aku ada di tengah-tengah mereka. (Matius 18:20)',
            'tanggal' => '2025-12-07',
            'is_publish' => true,
            'file' => 'dokumen-ekaristi-1.pdf',
        ]);

        \App\Models\PanduanModel::create([
            'jenis_misa' => 'Misa Malam Natal',
            'perayaan' => 'Kelahiran Tuhan Kita Yesus Kristus',
            'ket_perayaan' => 'Melalui kelahiran Yesus Sang Juru Selamat, kita diajak menyambut terang kasih Allah yang hadir di tengah dunia dan kehidupan kita.',
            'ayat_alkitab' => 'Hari ini telah lahir bagimu Juruselamat, yaitu Kristus, Tuhan, di kota Daud. (Lukas 2:11)',
            'tanggal' => '2025-12-24',
            'is_publish' => true,
            'file' => 'dokumen-ekaristi-1.pdf',
        ]);
    }
}
