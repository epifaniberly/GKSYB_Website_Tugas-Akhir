<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DoaSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('table_doa')->insert([
            [
                'nama' => 'Bapak John Doe',
                'isi_doa' => 'Semoga keluarga kami selalu diberkati dan dilindungi oleh Tuhan.',
                'tanggal_doa' => '2024-06-01',
                'status' => 'baru',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Ibu Jane Smith',
                'isi_doa' => 'Mohon doa untuk kesembuhan saya dari penyakit ini.',
                'tanggal_doa' => '2024-06-02',
                'status' => 'didoakan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => null,
                'isi_doa' => 'Tuhan, berikanlah kedamaian bagi dunia yang sedang dilanda konflik.',
                'tanggal_doa' => '2024-06-03',
                'status' => 'baru',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
