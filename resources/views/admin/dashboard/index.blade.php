@extends('adminlte::page')

@section('title', 'Dashboard Analytics')

@section('content_header')
    <h1>Dashboard Analytics & Visualisasi SPK</h1>
@stop

@section('content')
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-4">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $userCount }}</h3>
                            <p>Total Pengguna</p>
                        </div>
                        <div class="icon"><i class="fas fa-users"></i></div>
                        <a href="{{ route('admin.users.index') }}" class="small-box-footer">Kelola Pengguna <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $criteriaCount }}</h3>
                            <p>Kriteria Evaluasi</p>
                        </div>
                        <div class="icon"><i class="fas fa-list-ol"></i></div>
                        <a href="{{ route('admin.kriteria.index') }}" class="small-box-footer">Kelola Kriteria <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $plantCount }}</h3>
                            <p>Alternatif Tanaman</p>
                        </div>
                        <div class="icon"><i class="fas fa-seedling"></i></div>
                        <a href="{{ route('admin.tanaman.index') }}" class="small-box-footer">Kelola Tanaman <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>

            <!-- GRAFIK RADAR & BAR -->
            <div class="row">
                <!-- RADAR CHART CARD -->
                <div class="col-lg-6">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-chart-pie mr-1"></i>
                                Visualisasi Radar Distribusi Rekomendasi
                            </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chart-container" style="position: relative; height:320px; width:100%;">
                                <canvas id="radarChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- BAR CHART CARD -->
                <div class="col-lg-6">
                    <div class="card card-success card-outline">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-chart-bar mr-1"></i>
                                Grafik Batang Rekomendasi Komoditas
                            </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chart-container" style="position: relative; height:320px; width:100%;">
                                <canvas id="rekomendasiChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop

@section('js')
    <script>
        $(function() {
            'use strict';

            const chartLabels = @json($chartLabels);
            const chartData = @json($chartData);

            const colorPalette = [
                'rgba(40, 167, 69, 0.6)',
                'rgba(23, 162, 184, 0.6)',
                'rgba(255, 193, 7, 0.6)',
                'rgba(220, 53, 69, 0.6)',
                'rgba(111, 66, 193, 0.6)',
                'rgba(253, 126, 20, 0.6)'
            ];

            const borderPalette = [
                '#28a745',
                '#17a2b8',
                '#ffc107',
                '#dc3545',
                '#6f42c1',
                '#fd7e14'
            ];

            // 1. RADAR CHART
            var radarCtx = document.getElementById('radarChart').getContext('2d');
            new Chart(radarCtx, {
                type: 'radar',
                data: {
                    labels: chartLabels,
                    datasets: [{
                        label: 'Frekuensi Rekomendasi Teratas',
                        backgroundColor: 'rgba(40, 167, 69, 0.25)',
                        borderColor: '#28a745',
                        pointBackgroundColor: '#28a745',
                        pointBorderColor: '#fff',
                        pointHoverBackgroundColor: '#fff',
                        pointHoverBorderColor: '#28a745',
                        data: chartData
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    responsive: true,
                    scale: {
                        ticks: {
                            beginAtZero: true,
                            stepSize: 1
                        }
                    }
                }
            });

            // 2. BAR CHART
            var barCtx = document.getElementById('rekomendasiChart').getContext('2d');
            new Chart(barCtx, {
                type: 'bar',
                data: {
                    labels: chartLabels,
                    datasets: [{
                        label: 'Total Rekomendasi',
                        backgroundColor: chartLabels.map((_, i) => colorPalette[i % colorPalette.length]),
                        borderColor: chartLabels.map((_, i) => borderPalette[i % borderPalette.length]),
                        borderWidth: 1.5,
                        data: chartData
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    responsive: true,
                    legend: { display: false },
                    scales: {
                        xAxes: [{ gridLines: { display: false } }],
                        yAxes: [{
                            ticks: {
                                beginAtZero: true,
                                callback: function(val) { if (val % 1 === 0) return val; }
                            }
                        }]
                    }
                }
            });
        });
    </script>
@stop
