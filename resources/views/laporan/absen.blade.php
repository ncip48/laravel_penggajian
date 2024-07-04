@extends('layouts.app')

@section('title', 'Absen')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Absen</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item ">
                                <a href="#">Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">Laporan</a>
                            </li>
                            <li class="breadcrumb-item active">
                                Laporan Absen
                            </li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex flex-column">
                                        <h3 class="card-title mt-1">
                                            Laporan Absen
                                        </h3>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                Filter laporan absen karyawan
                                <div class="d-flex justify-content-between align-items-center mt-2">
                                    <div class="col-12">
                                        {{-- <li><a class="dropdown-item" href="#">Action</a></li> --}}
                                        <form method="POST" action="{{ route('laporan.absen.print') }}">
                                            <div class="row mb-1">
                                                @csrf
                                                <div class="form-group col-4 d-flex flex-row align-items-center">
                                                    <label class="mb-0 mr-2" for="">Bulan</label>
                                                    <select class="form-control month-filter" name="bulan">
                                                        @foreach (['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'] as $bulan)
                                                            <option value="{{ $loop->index + 1 }}"
                                                                {{ $loop->index == date('n') - 1 ? 'selected' : '' }}>
                                                                {{ $bulan }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group col-4 d-flex flex-row align-items-center">
                                                    <label class="mb-0 mr-2" for="">Tahun</label>
                                                    <select class="form-control year-filter" name="tahun">
                                                        @for ($tahun = date('Y') - 5; $tahun <= date('Y'); $tahun++)
                                                            <option value="{{ $tahun }}"
                                                                {{ $tahun == date('Y') ? 'selected' : '' }}>
                                                                {{ $tahun }}</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                                <div class="form-group col-4 d-flex flex-row align-items-center">
                                                    <button type="submit" class="btn btn-primary">
                                                        Cetak Laporan Absen</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
