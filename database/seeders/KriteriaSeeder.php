<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KriteriaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('kriteria')->insert([
            ['kode' => 'C1', 'nama_kriteria' => 'Jenis Tanah', 'bobot' => 0.20, 'tipe' => 'benefit', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'C2', 'nama_kriteria' => 'Suhu (°C)', 'bobot' => 0.25, 'tipe' => 'benefit', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'C3', 'nama_kriteria' => 'Curah Hujan (mm)', 'bobot' => 0.20, 'tipe' => 'benefit', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'C4', 'nama_kriteria' => 'Ketersediaan Air', 'bobot' => 0.20, 'tipe' => 'benefit', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'C5', 'nama_kriteria' => 'Kelembaban (%)', 'bobot' => 0.15, 'tipe' => 'benefit', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
