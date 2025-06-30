@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-4">
                    <div class="small-box bg-info">
                        <div class="inner">
                            {{-- Menampilkan variabel yang dikirim dari controller --}}
                            <h3>{{ $userCount }}</h3>
                            <p>Users</p>
                        </div>
                        <div class="icon"><i class="fas fa-user-plus"></i></div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $criteriaCount }}</h3>
                            <p>Kriteria</p>
                        </div>
                        <div class="icon"><i class="fas fa-list"></i></div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>
    </section>
    <!-- /.content -->
@endsection
