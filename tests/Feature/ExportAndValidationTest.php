<?php

namespace Tests\Feature;

use App\Models\Kriteria;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExportAndValidationTest extends TestCase
{
    use RefreshDatabase;

    public function test_weight_validation_prevents_exceeding_total_weight_of_one(): void
    {
        $this->seed();

        $admin = User::where('peran', 'Admin')->first();

        // Kriteria default total bobot = 1.0 (0.20 + 0.25 + 0.20 + 0.20 + 0.15)
        // Mencoba menambah kriteria baru dengan bobot 0.20 harus ditolak
        $response = $this->actingAs($admin)->post(route('admin.kriteria.store'), [
            'kode' => 'C6',
            'nama_kriteria' => 'Kriteria Uji',
            'bobot' => 0.20,
            'tipe' => 'benefit',
        ]);

        $response->assertSessionHas('error');
    }

    public function test_export_riwayat_pdf_returns_successful_stream(): void
    {
        $this->seed();

        $petani = User::where('peran', 'Petani')->first();

        $response = $this->actingAs($petani)->get(route('export.riwayat.pdf'));

        $response->assertStatus(200);
        $response->assertHeader('content-type', 'application/pdf');
    }

    public function test_export_riwayat_excel_returns_csv_download(): void
    {
        $this->seed();

        $petani = User::where('peran', 'Petani')->first();

        $response = $this->actingAs($petani)->get(route('export.riwayat.excel'));

        $response->assertStatus(200);
        $this->assertTrue(str_contains($response->headers->get('content-type'), 'text/csv'));
    }
}
