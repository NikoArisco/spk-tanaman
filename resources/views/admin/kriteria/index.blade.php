@extends('adminlte::page')

@section('title', 'Manajemen Kriteria')

@section('content_header')
    <h1>Manajemen Kriteria</h1>
@stop

@section('content')
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    @if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Daftar Kriteria & Status Bobot</h3>
            <div class="card-tools">
                <span class="badge {{ round($totalBobot, 2) == 1.0 ? 'bg-success' : 'bg-warning' }} mr-2" style="font-size: 14px;">
                    Total Bobot: {{ round($totalBobot, 2) }} / 1.00 ({{ round($totalBobot * 100) }}%)
                </span>
                <a href="{{ route('admin.kriteria.create') }}" class="btn btn-primary btn-sm">Tambah Data</a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Kode</th>
                        <th>Nama Kriteria</th>
                        <th>Bobot (w)</th>
                        <th>Tipe</th>
                        <th style="width: 150px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($kriteria as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><span class="badge bg-secondary">{{ $data->kode ?? ('C' . $loop->iteration) }}</span></td>
                            <td>{{ $data->nama_kriteria }}</td>
                            <td><b>{{ $data->bobot }}</b></td>
                            <td>
                                @if(strtolower($data->tipe) == 'benefit')
                                    <span class="badge bg-info">Benefit</span>
                                @else
                                    <span class="badge bg-danger">Cost</span>
                                @endif
                            </td>
                            <td>
                                <form action="{{ route('admin.kriteria.destroy', $data->id) }}" method="POST">
                                    <a href="{{ route('admin.kriteria.edit', $data->id) }}" class="btn btn-xs btn-warning">Edit</a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-xs btn-danger" 
                                            onclick="return confirm('Anda yakin ingin menghapus data ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Data tidak ada</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@stop