<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class terhubungseed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('table_terhubung')->insert([
            [
                'user_id'        => 3,
                'email'          => 'umat1@example.com',
                'nomor_telepon'  => '081234567890',
                'tanggal_kirim'  => Carbon::now()->subDays(1),
                'status'         => 'baru',
                'isi_pesan'      => 'Saya ingin bertanya mengenai jadwal misa hari Minggu.',
                'created_at'     => Carbon::now(),
                'updated_at'     => Carbon::now(),
            ],
            [
                'user_id'        => 3,
                'email'          => 'umat2@example.com',
                'nomor_telepon'  => '089876543210',
                'tanggal_kirim'  => Carbon::now(),
                'status'         => 'diterima',
                'isi_pesan'      => 'Mohon informasi terkait kegiatan lingkungan bulan ini.',
                'created_at'     => Carbon::now(),
                'updated_at'     => Carbon::now(),
            ],
        ]);
    }
}
