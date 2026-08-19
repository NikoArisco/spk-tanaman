<?php

namespace App\Http\Controllers;

use App\Models\DataLingkungan;
use App\Services\SPKService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    protected SPKService $spkService;

    public function __construct(SPKService $spkService)
    {
        $this->spkService = $spkService;
    }

    /**
     * Export Hasil Perhitungan Rekomendasi ke PDF.
     */
    public function exportHasilPdf(Request $request)
    {
        $inputPetani = $request->validate([
            'jenis_tanah' => 'required|string',
            'suhu' => 'required|numeric',
            'curah_hujan' => 'required|numeric',
            'ketersediaan_air' => 'required|string',
            'kelembaban' => 'required|numeric',
        ]);

        $spkResult = $this->spkService->calculate($inputPetani);

        $pdf = Pdf::loadView('pdf.hasil_rekomendasi', [
            'hasilAkhir' => $spkResult['hasilAkhir'],
            'inputPetani' => $inputPetani,
            'alternatifs' => $spkResult['alternatifs'],
            'kriterias' => $spkResult['kriterias'],
            'normalizedMatrix' => $spkResult['normalizedMatrix'],
            'user' => Auth::user(),
            'tanggal' => now()->format('d F Y H:i'),
        ])->setPaper('a4', 'portrait');

        return $pdf->download('Laporan_Rekomendasi_Tanaman_' . date('Ymd_His') . '.pdf');
    }

    /**
     * Export Riwayat Rekomendasi Petani ke PDF.
     */
    public function exportRiwayatPdf()
    {
        $riwayat = DataLingkungan::where('id_user', Auth::id())
            ->with('rekomendasi.tanaman')
            ->latest()
            ->get();

        $pdf = Pdf::loadView('pdf.riwayat_rekomendasi', [
            'riwayat' => $riwayat,
            'user' => Auth::user(),
            'tanggal' => now()->format('d F Y H:i'),
        ])->setPaper('a4', 'landscape');

        return $pdf->download('Riwayat_Rekomendasi_Tanaman_' . date('Ymd_His') . '.pdf');
    }

    /**
     * Export Riwayat Rekomendasi ke Excel (.csv/.xlsx).
     */
    public function exportRiwayatExcel()
    {
        $riwayat = DataLingkungan::where('id_user', Auth::id())
            ->with('rekomendasi.tanaman')
            ->latest()
            ->get();

        $fileName = 'Riwayat_Rekomendasi_Tanaman_' . date('Ymd_His') . '.csv';

        $headers = [
            "Content-type" => "text/csv; charset=UTF-8",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        $callback = function () use ($riwayat) {
            $file = fopen('php://output', 'w');
            // Header kolom
            fputcsv($file, [
                'ID Transaksi',
                'Tanggal',
                'Jenis Tanah',
                'Suhu (°C)',
                'Curah Hujan (mm)',
                'Ketersediaan Air',
                'Kelembaban (%)',
                'Rekomendasi Teratas (Peringkat 1)',
                'Skor (V)'
            ]);

            foreach ($riwayat as $data) {
                $topRekomendasi = $data->rekomendasi->sortByDesc('skor')->first();
                fputcsv($file, [
                    '#TRX-' . $data->id,
                    $data->created_at->format('d/m/Y H:i'),
                    $data->jenis_tanah,
                    $data->suhu,
                    $data->curah_hujan,
                    $data->ketersediaan_air,
                    $data->kelembaban,
                    $topRekomendasi ? $topRekomendasi->tanaman->nama_tanaman : '-',
                    $topRekomendasi ? $topRekomendasi->skor : '0'
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
