<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Hasil Rekomendasi Tanaman - Metode SAW</title>
    <style>
        body { font-family: sans-serif; font-size: 11px; color: #212922; line-height: 1.4; }
        .header { text-align: center; border-bottom: 3px solid #294936; padding-bottom: 10px; margin-bottom: 15px; }
        .header h2 { margin: 0; color: #294936; font-size: 18px; text-transform: uppercase; }
        .header p { margin: 3px 0 0; color: #5b8266; font-size: 11px; font-weight: bold; }
        .info-table, .data-table { width: 100%; border-collapse: collapse; margin-bottom: 15px; }
        .info-table td { padding: 4px 8px; }
        .data-table th, .data-table td { border: 1px solid #3e6259; padding: 6px 8px; }
        .data-table th { background-color: #294936; color: #ffffff; text-align: center; font-size: 11px; }
        .badge-success { background-color: #5b8266; color: #ffffff; padding: 3px 8px; border-radius: 4px; font-weight: bold; }
        .footer { margin-top: 30px; text-align: right; font-size: 9px; color: #5b8266; }
        h4 { color: #294936; margin-bottom: 6px; margin-top: 15px; }
    </style>
</head>
<body>
    <div class="header">
        <h2>SISTEM PENDUKUNG KEPUTUSAN REKOMENDASI TANAMAN</h2>
        <p>Hasil Perhitungan Metode Simple Additive Weighting (SAW)</p>
    </div>

    <table class="info-table">
        <tr>
            <td style="width: 15%;"><strong>Pemohon:</strong></td>
            <td style="width: 35%;">{{ $user->nama ?? 'Petani' }} ({{ $user->username ?? '-' }})</td>
            <td style="width: 15%;"><strong>Tanggal:</strong></td>
            <td style="width: 35%;">{{ $tanggal }}</td>
        </tr>
    </table>

    <h4>1. Parameter Kondisi Lingkungan Lahan</h4>
    <table class="data-table">
        <tr>
            <th>Jenis Tanah</th>
            <th>Suhu (°C)</th>
            <th>Curah Hujan (mm)</th>
            <th>Ketersediaan Air</th>
            <th>Kelembaban (%)</th>
        </tr>
        <tr style="text-align: center;">
            <td>{{ $inputPetani['jenis_tanah'] }}</td>
            <td>{{ $inputPetani['suhu'] }} °C</td>
            <td>{{ $inputPetani['curah_hujan'] }} mm</td>
            <td>{{ $inputPetani['ketersediaan_air'] }}</td>
            <td>{{ $inputPetani['kelembaban'] }} %</td>
        </tr>
    </table>

    <h4>2. Matriks Ternormalisasi (R)</h4>
    <table class="data-table">
        <thead>
            <tr>
                <th>Alternatif Tanaman</th>
                @foreach ($kriterias as $kriteria)
                    <th>{{ $kriteria->kode ?? ('C' . $loop->iteration) }} ({{ $kriteria->nama_kriteria }})</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($alternatifs as $alternatif)
                <tr>
                    <td><strong>{{ $alternatif->nama_tanaman }}</strong></td>
                    @foreach ($kriterias as $kriteria)
                        <td style="text-align: center;">
                            {{ round($normalizedMatrix[$alternatif->id][$kriteria->id], 4) }}
                        </td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>

    <h4>3. Hasil Perankingan Rekomendasi Tanaman</h4>
    <table class="data-table">
        <thead>
            <tr>
                <th style="width: 10%;">Peringkat</th>
                <th>Nama Tanaman</th>
                <th>Skor Akhir Preferensi (V)</th>
                <th>Keterangan Kesesuaian</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($hasilAkhir as $hasil)
                <tr>
                    <td style="text-align: center;"><strong>#{{ $loop->iteration }}</strong></td>
                    <td>{{ $hasil['nama_tanaman'] }}</td>
                    <td style="text-align: center;"><strong>{{ $hasil['skor'] }}</strong></td>
                    <td style="text-align: center;">
                        @if ($loop->first)
                            <span class="badge-success">Sangat Direkomendasikan</span>
                        @else
                            <span>Alternatif Opsional</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Dokumen ini dicetak secara otomatis oleh Sistem Pendukung Keputusan Rekomendasi Tanaman.</p>
    </div>
</body>
</html>
