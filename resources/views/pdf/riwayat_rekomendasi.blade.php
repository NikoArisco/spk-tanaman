<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Riwayat Rekomendasi Tanaman</title>
    <style>
        body { font-family: sans-serif; font-size: 10px; color: #212922; }
        .header { text-align: center; border-bottom: 3px solid #294936; padding-bottom: 8px; margin-bottom: 15px; }
        .header h2 { margin: 0; color: #294936; font-size: 16px; text-transform: uppercase; }
        .header p { margin: 2px 0 0; color: #5b8266; font-size: 10px; }
        .data-table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        .data-table th, .data-table td { border: 1px solid #3e6259; padding: 5px 6px; }
        .data-table th { background-color: #294936; color: #ffffff; text-align: center; }
        .footer { margin-top: 20px; text-align: right; font-size: 9px; color: #5b8266; }
    </style>
</head>
<body>
    <div class="header">
        <h2>LAPORAN RIWAYAT KONSULTASI REKOMENDASI TANAMAN</h2>
        <p>Pengguna: {{ $user->nama }} ({{ $user->username }}) | Tanggal Cetak: {{ $tanggal }}</p>
    </div>

    <table class="data-table">
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th>Tanggal</th>
                <th>Jenis Tanah</th>
                <th>Suhu (°C)</th>
                <th>Curah Hujan</th>
                <th>Air</th>
                <th>Kelembaban</th>
                <th>Rekomendasi Utama (Peringkat 1)</th>
                <th>Skor (V)</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($riwayat as $data)
                @php
                    $topRekomendasi = $data->rekomendasi->sortByDesc('skor')->first();
                @endphp
                <tr>
                    <td style="text-align: center;">{{ $loop->iteration }}</td>
                    <td style="text-align: center;">{{ $data->created_at->format('d/m/Y H:i') }}</td>
                    <td>{{ $data->jenis_tanah }}</td>
                    <td style="text-align: center;">{{ $data->suhu }}°C</td>
                    <td style="text-align: center;">{{ $data->curah_hujan }} mm</td>
                    <td>{{ $data->ketersediaan_air }}</td>
                    <td style="text-align: center;">{{ $data->kelembaban }}%</td>
                    <td><strong>{{ $topRekomendasi ? $topRekomendasi->tanaman->nama_tanaman : '-' }}</strong></td>
                    <td style="text-align: center;"><strong>{{ $topRekomendasi ? $topRekomendasi->skor : '0' }}</strong></td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" style="text-align: center;">Belum ada riwayat perhitungan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>Dicetak dari Sistem Pendukung Keputusan Rekomendasi Tanaman.</p>
    </div>
</body>
</html>
