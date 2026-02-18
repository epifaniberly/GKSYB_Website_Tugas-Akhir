<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
           [
            'name' => 'komsos',
            'email' => 'komsos@example.com',
            'password' => Hash::make('komsos@example.com'),
            'role_type' => 2,
            'created_at' => now(),
            'updated_at' => now(),
           ],
           [
            'name' => 'sekretariat',
            'email' => 'sekretariat@example.com',
            'password' => Hash::make('sekretariat@example.com'),
            'role_type' => 1,
            'created_at' => now(),
            'updated_at' => now(),
           ],
           [
            'name' => 'user',
            'email' => 'user@example.com',
            'password' => Hash::make('user@example.com'),
            'role_type' => 0,
            'created_at' => now(),
            'updated_at' => now(),
           ],
        ]);
    }
}
