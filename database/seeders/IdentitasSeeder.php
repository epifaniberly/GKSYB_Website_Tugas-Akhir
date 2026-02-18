<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IdentitasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('identitas')->insert([
            'nama_website' => 'Gereja Santo Yusup Bintaran',
            'logo' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
