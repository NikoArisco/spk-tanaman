<?php

namespace Tests\Unit;

use App\Services\SPKService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SPKServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_spk_service_calculates_saw_scores_correctly(): void
    {
        $this->seed();

        $spkService = new SPKService();

        $inputPetani = [
            'jenis_tanah' => 'Lempung',
            'suhu' => 28,
            'curah_hujan' => 300,
            'ketersediaan_air' => 'Banyak',
            'kelembaban' => 80,
        ];

        $result = $spkService->calculate($inputPetani);

        $this->assertArrayHasKey('hasilAkhir', $result);
        $this->assertArrayHasKey('normalizedMatrix', $result);
        $this->assertNotEmpty($result['hasilAkhir']);

        // Tanaman Padi (preferensi Lempung, 24-32°C, 200-400mm, Banyak, 70-90%) harus menduduki peringkat pertama dengan skor 1.0
        $topResult = $result['hasilAkhir'][0];
        $this->assertEquals('Padi', $topResult['nama_tanaman']);
        $this->assertEquals(1.0, $topResult['skor']);
    }
}
