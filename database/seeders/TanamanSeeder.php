<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TanamanSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tanaman')->insert([
            ['id' => 1, 'nama_tanaman' => 'Padi', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'nama_tanaman' => 'Jagung', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'nama_tanaman' => 'Kedelai', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'nama_tanaman' => 'Cabai Merah', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 5, 'nama_tanaman' => 'Bawang Merah', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
