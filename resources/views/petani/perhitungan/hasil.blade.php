@extends('adminlte::page')

@section('title', 'Hasil Rekomendasi')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Hasil Rekomendasi Tanaman</h1>
        <div>
            <!-- Form Download PDF -->
            <form action="{{ route('export.hasil.pdf') }}" method="POST" style="display: inline-block;">
                @csrf
                <input type="hidden" name="jenis_tanah" value="{{ $inputPetani['jenis_tanah'] }}">
                <input type="hidden" name="suhu" value="{{ $inputPetani['suhu'] }}">
                <input type="hidden" name="curah_hujan" value="{{ $inputPetani['curah_hujan'] }}">
                <input type="hidden" name="ketersediaan_air" value="{{ $inputPetani['ketersediaan_air'] }}">
                <input type="hidden" name="kelembaban" value="{{ $inputPetani['kelembaban'] }}">
                <button type="submit" class="btn btn-danger btn-sm">
                    <i class="fas fa-file-pdf mr-1"></i> Unduh Laporan PDF
                </button>
            </form>
            <a href="{{ route('perhitungan.index') }}" class="btn btn-secondary btn-sm ml-1">
                <i class="fas fa-redo mr-1"></i> Hitung Ulang
            </a>
        </div>
    </div>
@stop

@section('content')

    <div class="card card-outline card-success">
        <div class="card-header">
            <h3 class="card-title"><i class="fas fa-info-circle mr-1"></i> Data Kondisi Lahan (Input Pengguna)</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-2 col-6"><strong>Jenis Tanah:</strong><br><span class="badge bg-info">{{ $inputPetani['jenis_tanah'] }}</span></div>
                <div class="col-md-2 col-6"><strong>Suhu:</strong><br><span class="badge bg-warning">{{ $inputPetani['suhu'] }} °C</span></div>
                <div class="col-md-3 col-6"><strong>Curah Hujan:</strong><br><span class="badge bg-primary">{{ $inputPetani['curah_hujan'] }} mm</span></div>
                <div class="col-md-3 col-6"><strong>Ketersediaan Air:</strong><br><span class="badge bg-success">{{ $inputPetani['ketersediaan_air'] }}</span></div>
                <div class="col-md-2 col-6"><strong>Kelembaban:</strong><br><span class="badge bg-secondary">{{ $inputPetani['kelembaban'] }} %</span></div>
            </div>
        </div>
    </div>

    <!-- RADAR CHART MATCH SCORE VISUALIZATION -->
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-chart-pie mr-1"></i>
                Visualisasi Radar Profil Kecocokan Kriteria (Match Radar)
            </h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="chart-container" style="position: relative; height:360px; width:100%;">
                <canvas id="matchRadarChart"></canvas>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tabel Alternatif</h3>
                </div>
                <div class="card-body p-0">
                    <table class="table table-bordered table-sm mb-0">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Nama Tanaman</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($alternatifs as $alternatif)
                                <tr>
                                    <td><span class="badge bg-secondary">A{{ $loop->iteration }}</span></td>
                                    <td>{{ $alternatif->nama_tanaman }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tabel Bobot Kriteria</h3>
                </div>
                <div class="card-body p-0">
                    <table class="table table-bordered table-sm mb-0">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Nama Kriteria</th>
                                <th>Bobot (w)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kriterias as $kriteria)
                                <tr>
                                    <td><span class="badge bg-info">{{ $kriteria->kode ?? ('C' . $loop->iteration) }}</span></td>
                                    <td>{{ $kriteria->nama_kriteria }}</td>
                                    <td><b>{{ $kriteria->bobot }}</b></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Matriks Ternormalisasi (R)</h3>
        </div>
        <div class="card-body p-0">
            <table class="table table-bordered table-sm text-center mb-0">
                <thead>
                    <tr>
                        <th>Alternatif</th>
                        @foreach ($kriterias as $kriteria)
                            <th>{{ $kriteria->kode ?? ('C' . $loop->iteration) }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($alternatifs as $alternatif)
                        <tr>
                            <td><b>{{ $alternatif->nama_tanaman }}</b></td>
                            @foreach ($kriterias as $kriteria)
                                <td>
                                    {{ round($normalizedMatrix[$alternatif->id][$kriteria->id], 4) }}
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="card card-success card-outline">
        <div class="card-header">
            <h3 class="card-title"><i class="fas fa-trophy mr-1 text-warning"></i> Hasil Akhir Perankingan SAW</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th style="width: 10px">Peringkat</th>
                        <th>Nama Tanaman</th>
                        <th>Skor Akhir (V)</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($hasilAkhir as $hasil)
                        <tr>
                            <td><strong>#{{ $loop->iteration }}</strong></td>
                            <td>{{ $hasil['nama_tanaman'] }}</td>
                            <td><b>{{ $hasil['skor'] }}</b></td>
                            <td>
                                @if ($loop->first)
                                    <span class="badge bg-success" style="font-size: 13px;"><i class="fas fa-check-circle mr-1"></i> Sangat Direkomendasikan</span>
                                @else
                                    <span class="badge bg-secondary">Alternatif</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('js')
    <script>
        $(function() {
            'use strict';

            const kriterias = @json($kriterias->pluck('nama_kriteria'));
            const alternatifs = @json($alternatifs);
            const normalizedMatrix = @json($normalizedMatrix);

            const colorPalette = [
                { bg: 'rgba(40, 167, 69, 0.25)', border: '#28a745' },
                { bg: 'rgba(23, 162, 184, 0.25)', border: '#17a2b8' },
                { bg: 'rgba(255, 193, 7, 0.25)', border: '#ffc107' },
                { bg: 'rgba(220, 53, 69, 0.25)', border: '#dc3545' },
                { bg: 'rgba(111, 66, 193, 0.25)', border: '#6f42c1' }
            ];

            const datasets = alternatifs.map((alt, index) => {
                const color = colorPalette[index % colorPalette.length];
                const scores = @json($kriterias).map(k => normalizedMatrix[alt.id][k.id] || 0);

                return {
                    label: alt.nama_tanaman,
                    backgroundColor: color.bg,
                    borderColor: color.border,
                    pointBackgroundColor: color.border,
                    pointBorderColor: '#fff',
                    data: scores
                };
            });

            var radarCtx = document.getElementById('matchRadarChart').getContext('2d');
            new Chart(radarCtx, {
                type: 'radar',
                data: {
                    labels: kriterias,
                    datasets: datasets
                },
                options: {
                    maintainAspectRatio: false,
                    responsive: true,
                    scale: {
                        ticks: {
                            beginAtZero: true,
                            max: 1.0,
                            stepSize: 0.2
                        }
                    }
                }
            });
        });
    </script>
@stop