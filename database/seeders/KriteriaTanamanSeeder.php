<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KriteriaTanamanSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('kriteria_tanaman')->insert([
            // Preferensi untuk Padi (id_tanaman = 1)
            ['id_tanaman' => 1, 'id_kriteria' => 1, 'nilai' => 'Lempung', 'created_at' => now(), 'updated_at' => now()],
            ['id_tanaman' => 1, 'id_kriteria' => 2, 'nilai' => '24-32', 'created_at' => now(), 'updated_at' => now()],
            ['id_tanaman' => 1, 'id_kriteria' => 3, 'nilai' => '200-400', 'created_at' => now(), 'updated_at' => now()],
            ['id_tanaman' => 1, 'id_kriteria' => 4, 'nilai' => 'Banyak', 'created_at' => now(), 'updated_at' => now()],
            ['id_tanaman' => 1, 'id_kriteria' => 5, 'nilai' => '70-90', 'created_at' => now(), 'updated_at' => now()],

            // Preferensi untuk Jagung (id_tanaman = 2)
            ['id_tanaman' => 2, 'id_kriteria' => 1, 'nilai' => 'Berpasir', 'created_at' => now(), 'updated_at' => now()],
            ['id_tanaman' => 2, 'id_kriteria' => 2, 'nilai' => '20-35', 'created_at' => now(), 'updated_at' => now()],
            ['id_tanaman' => 2, 'id_kriteria' => 3, 'nilai' => '100-200', 'created_at' => now(), 'updated_at' => now()],
            ['id_tanaman' => 2, 'id_kriteria' => 4, 'nilai' => 'Sedang', 'created_at' => now(), 'updated_at' => now()],
            ['id_tanaman' => 2, 'id_kriteria' => 5, 'nilai' => '60-80', 'created_at' => now(), 'updated_at' => now()],

            // Preferensi untuk Kedelai (id_tanaman = 3)
            ['id_tanaman' => 3, 'id_kriteria' => 1, 'nilai' => 'Liat', 'created_at' => now(), 'updated_at' => now()],
            ['id_tanaman' => 3, 'id_kriteria' => 2, 'nilai' => '25-30', 'created_at' => now(), 'updated_at' => now()],
            ['id_tanaman' => 3, 'id_kriteria' => 3, 'nilai' => '150-250', 'created_at' => now(), 'updated_at' => now()],
            ['id_tanaman' => 3, 'id_kriteria' => 4, 'nilai' => 'Banyak', 'created_at' => now(), 'updated_at' => now()],
            ['id_tanaman' => 3, 'id_kriteria' => 5, 'nilai' => '65-85', 'created_at' => now(), 'updated_at' => now()],

            // Preferensi untuk Cabai Merah (id_tanaman = 4)
            ['id_tanaman' => 4, 'id_kriteria' => 1, 'nilai' => 'Lempung Berpasir', 'created_at' => now(), 'updated_at' => now()],
            ['id_tanaman' => 4, 'id_kriteria' => 2, 'nilai' => '18-28', 'created_at' => now(), 'updated_at' => now()],
            ['id_tanaman' => 4, 'id_kriteria' => 3, 'nilai' => '120-220', 'created_at' => now(), 'updated_at' => now()],
            ['id_tanaman' => 4, 'id_kriteria' => 4, 'nilai' => 'Sedang', 'created_at' => now(), 'updated_at' => now()],
            ['id_tanaman' => 4, 'id_kriteria' => 5, 'nilai' => '60-75', 'created_at' => now(), 'updated_at' => now()],

            // Preferensi untuk Bawang Merah (id_tanaman = 5)
            ['id_tanaman' => 5, 'id_kriteria' => 1, 'nilai' => 'Aluvial', 'created_at' => now(), 'updated_at' => now()],
            ['id_tanaman' => 5, 'id_kriteria' => 2, 'nilai' => '25-32', 'created_at' => now(), 'updated_at' => now()],
            ['id_tanaman' => 5, 'id_kriteria' => 3, 'nilai' => '80-160', 'created_at' => now(), 'updated_at' => now()],
            ['id_tanaman' => 5, 'id_kriteria' => 4, 'nilai' => 'Sedang', 'created_at' => now(), 'updated_at' => now()],
            ['id_tanaman' => 5, 'id_kriteria' => 5, 'nilai' => '55-70', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
