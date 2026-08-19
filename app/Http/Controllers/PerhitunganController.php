<?php

namespace App\Http\Controllers;

use App\Models\DataLingkungan;
use App\Models\Rekomendasi;
use App\Models\Tanaman;
use App\Services\SPKService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PerhitunganController extends Controller
{
    protected SPKService $spkService;

    public function __construct(SPKService $spkService)
    {
        $this->spkService = $spkService;
    }

    public function index(): View
    {
        return view('petani.perhitungan.index');
    }

    public function hitung(Request $request): View
    {
        // 1. Validasi Input Petani dengan batasan yang realistis
        $inputPetani = $request->validate([
            'jenis_tanah' => 'required|string',
            'suhu' => 'required|numeric|between:-10,60',
            'curah_hujan' => 'required|numeric|between:0,10000',
            'ketersediaan_air' => 'required|string',
            'kelembaban' => 'required|numeric|between:0,100',
        ]);

        // 2. Simpan Data Input Lingkungan Petani ke Database
        $dataLingkungan = DataLingkungan::create([
            'id_user' => auth()->id(),
            'jenis_tanah' => $inputPetani['jenis_tanah'],
            'suhu' => $inputPetani['suhu'],
            'curah_hujan' => $inputPetani['curah_hujan'],
            'ketersediaan_air' => $inputPetani['ketersediaan_air'],
            'kelembaban' => $inputPetani['kelembaban'],
        ]);

        // 3. Kalkulasi SPK Menggunakan SPKService
        $spkResult = $this->spkService->calculate($inputPetani);
        $hasilAkhir = $spkResult['hasilAkhir'];
        $normalizedMatrix = $spkResult['normalizedMatrix'];
        $alternatifs = $spkResult['alternatifs'];
        $kriterias = $spkResult['kriterias'];

        // 4. Simpan Hasil Rekomendasi ke Database
        foreach ($hasilAkhir as $hasil) {
            $tanaman = Tanaman::where('nama_tanaman', $hasil['nama_tanaman'])->first();

            if ($tanaman) {
                Rekomendasi::create([
                    'id_data' => $dataLingkungan->id,
                    'id_tanaman' => $tanaman->id,
                    'skor' => $hasil['skor'],
                ]);
            }
        }

        // 5. Kirim Hasil Perhitungan ke View
        return view('petani.perhitungan.hasil', compact(
            'hasilAkhir',
            'inputPetani',
            'alternatifs',
            'kriterias',
            'normalizedMatrix'
        ));
    }
}
