<?php

namespace App\Http\Controllers;

use App\Models\DataLingkungan;
use App\Services\SPKService;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class RiwayatController extends Controller
{
    protected SPKService $spkService;

    public function __construct(SPKService $spkService)
    {
        $this->spkService = $spkService;
    }

    public function index(): View
    {
        $riwayat = DataLingkungan::where('id_user', Auth::id())
            ->with('rekomendasi.tanaman')
            ->latest()
            ->get();

        return view('petani.riwayat.index', compact('riwayat'));
    }

    public function show($id): View
    {
        $dataLingkungan = DataLingkungan::findOrFail($id);

        if ($dataLingkungan->id_user !== Auth::id()) {
            abort(403, 'AKSES DITOLAK');
        }

        $inputPetani = [
            'jenis_tanah' => $dataLingkungan->jenis_tanah,
            'suhu' => $dataLingkungan->suhu,
            'curah_hujan' => $dataLingkungan->curah_hujan,
            'ketersediaan_air' => $dataLingkungan->ketersediaan_air,
            'kelembaban' => $dataLingkungan->kelembaban,
        ];

        // Jalankan SPK Service untuk menghitung rincian matriks & hasil akhir
        $spkResult = $this->spkService->calculate($inputPetani);

        return view('petani.perhitungan.hasil', [
            'hasilAkhir' => $spkResult['hasilAkhir'],
            'inputPetani' => $inputPetani,
            'alternatifs' => $spkResult['alternatifs'],
            'kriterias' => $spkResult['kriterias'],
            'normalizedMatrix' => $spkResult['normalizedMatrix'],
        ]);
    }
}
