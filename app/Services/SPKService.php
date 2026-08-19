<?php

namespace App\Services;

use App\Models\Kriteria;
use App\Models\Tanaman;

class SPKService
{
    /**
     * Hitung perankingan SAW berdasarkan input kondisi lingkungan.
     *
     * @param array $inputPetani
     * @return array
     */
    public function calculate(array $inputPetani): array
    {
        $alternatifs = Tanaman::with('kriteriaTanaman.kriteria')->get();
        $kriterias = Kriteria::all();

        $normalizedMatrix = [];

        foreach ($alternatifs as $alternatif) {
            foreach ($kriterias as $kriteria) {
                $preferensi = $alternatif->kriteriaTanaman->firstWhere('id_kriteria', $kriteria->id);

                if ($preferensi) {
                    $inputKey = $this->resolveInputKey($kriteria->nama_kriteria, $kriteria->kode);
                    $input = $inputPetani[$inputKey] ?? null;

                    $nilai_r = $this->calculateNormalization(
                        $preferensi->nilai,
                        $input,
                        $kriteria->nama_kriteria,
                        $kriteria->tipe
                    );

                    $normalizedMatrix[$alternatif->id][$kriteria->id] = $nilai_r;
                } else {
                    $normalizedMatrix[$alternatif->id][$kriteria->id] = 0;
                }
            }
        }

        $hasilAkhir = [];
        foreach ($alternatifs as $alternatif) {
            $totalSkor = 0;
            foreach ($kriterias as $kriteria) {
                $skorNormal = $normalizedMatrix[$alternatif->id][$kriteria->id];
                $totalSkor += $skorNormal * $kriteria->bobot;
            }

            $hasilAkhir[] = [
                'nama_tanaman' => $alternatif->nama_tanaman,
                'skor' => round($totalSkor, 4),
            ];
        }

        // Urutkan alternatif berdasarkan skor tertinggi (descending)
        usort($hasilAkhir, function ($a, $b) {
            return $b['skor'] <=> $a['skor'];
        });

        return [
            'hasilAkhir' => $hasilAkhir,
            'normalizedMatrix' => $normalizedMatrix,
            'alternatifs' => $alternatifs,
            'kriterias' => $kriterias,
        ];
    }

    /**
     * Normalisasi nilai kriteria (kategorikal maupun rentang numerik, benefit vs cost).
     *
     * @param string $preferensi
     * @param mixed $input
     * @param string $namaKriteria
     * @param string $tipe ('benefit'|'cost')
     * @return float
     */
    private function calculateNormalization($preferensi, $input, string $namaKriteria, string $tipe = 'benefit'): float
    {
        if ($input === null) {
            return 0;
        }

        $score = 0;

        // Kriteria Kategorikal (Jenis Tanah, Ketersediaan Air)
        if (in_array($namaKriteria, ['Jenis Tanah', 'Ketersediaan Air'])) {
            $score = strtolower(trim($preferensi)) === strtolower(trim($input)) ? 1 : 0;
        }
        // Kriteria Rentang Numerik (misal "24-32", "200-400")
        elseif (strpos($preferensi, '-') !== false) {
            list($min, $max) = explode('-', $preferensi);

            $minVal = (float) $min;
            $maxVal = (float) $max;
            $inputVal = (float) $input;

            $ideal = ($maxVal + $minVal) / 2;
            $halfRange = ($maxVal - $minVal) / 2;

            if ($halfRange == 0) {
                $score = ($inputVal == $ideal) ? 1 : 0;
            } else {
                $jarak = abs($inputVal - $ideal);
                if ($jarak > $halfRange) {
                    $score = 0;
                } else {
                    $score = 1 - ($jarak / $halfRange);
                }
            }
        }

        // Jika tipe kriteria adalah 'cost', balikkan skornya (semakin kecil nilai/jarak semakin baik)
        if (strtolower($tipe) === 'cost') {
            $score = 1 - $score;
        }

        return max(0, min(1, (float) $score));
    }

    /**
     * Memetakan nama kriteria/kode kriteria ke key input form.
     *
     * @param string $namaKriteria
     * @param string|null $kode
     * @return string
     */
    private function resolveInputKey(string $namaKriteria, ?string $kode = null): string
    {
        if ($kode) {
            $map = [
                'C1' => 'jenis_tanah',
                'C2' => 'suhu',
                'C3' => 'curah_hujan',
                'C4' => 'ketersediaan_air',
                'C5' => 'kelembaban',
            ];
            if (isset($map[strtoupper($kode)])) {
                return $map[strtoupper($kode)];
            }
        }

        $key = strtolower(str_replace([' (°C)', ' (mm)', ' (%)'], '', $namaKriteria));
        return str_replace(' ', '_', $key);
    }
}
