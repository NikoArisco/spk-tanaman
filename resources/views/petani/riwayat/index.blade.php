@extends('adminlte::page')

@section('title', 'Riwayat Perhitungan')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Riwayat Perhitungan SPK</h1>
        <div>
            <a href="{{ route('export.riwayat.pdf') }}" class="btn btn-danger btn-sm">
                <i class="fas fa-file-pdf mr-1"></i> Export PDF
            </a>
            <a href="{{ route('export.riwayat.excel') }}" class="btn btn-success btn-sm ml-1">
                <i class="fas fa-file-excel mr-1"></i> Export Excel (CSV)
            </a>
        </div>
    </div>
@stop

@section('content')
    @forelse ($riwayat as $item)
        <div class="card card-outline card-info">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-history mr-1"></i> Perhitungan pada: {{ $item->created_at->format('d F Y, H:i') }}
                </h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h5>Parameter Input Lahan:</h5>
                        <ul>
                            <li><strong>Jenis Tanah:</strong> {{ $item->jenis_tanah }}</li>
                            <li><strong>Suhu:</strong> {{ $item->suhu }} °C</li>
                            <li><strong>Curah Hujan:</strong> {{ $item->curah_hujan }} mm</li>
                            <li><strong>Ketersediaan Air:</strong> {{ $item->ketersediaan_air }}</li>
                            <li><strong>Kelembaban:</strong> {{ $item->kelembaban }} %</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h5>Hasil Rekomendasi Utama:</h5>
                        @if ($item->rekomendasi->isNotEmpty())
                            @php
                                $top = $item->rekomendasi->sortByDesc('skor')->first();
                            @endphp
                            <div class="text-center p-3 bg-light rounded">
                                <h2 class="text-success font-weight-bold">{{ $top->tanaman->nama_tanaman }}</h2>
                                <p class="mb-0">Dengan Skor Preferensi (V): <strong>{{ $top->skor }}</strong></p>
                            </div>
                        @else
                            <p>Tidak ada hasil rekomendasi untuk perhitungan ini.</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <a href="{{ route('riwayat.show', $item->id) }}" class="btn btn-info btn-sm">
                    <i class="fas fa-eye mr-1"></i> Lihat Detail Perhitungan
                </a>
            </div>
        </div>
    @empty
        <div class="card">
            <div class="card-body text-center py-5">
                <i class="fas fa-folder-open fa-3x text-muted mb-3"></i>
                <p class="text-muted">Anda belum memiliki riwayat perhitungan.</p>
                <a href="{{ route('perhitungan.index') }}" class="btn btn-primary">Mulai Perhitungan Baru</a>
            </div>
        </div>
    @endforelse
@stop