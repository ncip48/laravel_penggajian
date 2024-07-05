@extends('layouts.app')

@section('title', 'Absensi')

@section('content')
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="me-auto">
                <h4 class="page-title">Absensi</h4>
                <div class="d-inline-block align-items-center">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}"><i class="mdi mdi-home-outline"></i></a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">Transaksi</i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Absensi</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="box">
                    <div class="box-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex flex-column">
                                <h4 class="box-title mt-1">
                                    Absensi
                                </h4>
                            </div>
                            <div class="box-tools">
                                <a href="#" class="btn btn-sm btn-primary mt-1 ajax_modal"
                                    data-url="{{ route('absensi.create') }}"><i class="fa fa-plus"></i>
                                    Tambah</a>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        Filter data absensi karyawan
                        <div class="d-flex justify-content-between align-items-center mt-2">
                            <div class="col-12">
                                {{-- <li><a class="dropdown-item" href="#">Action</a></li> --}}
                                <form>
                                    <div class="mb-1 d-flex flex-row">
                                        {{-- @csrf --}}
                                        <div class="form-group d-flex flex-row align-items-center">
                                            <label class="mb-0 me-2" for="">Bulan</label>
                                            <select class="form-control month-filter" name="bulan">
                                                @foreach (['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'] as $bulan)
                                                    <option value="{{ $loop->index + 1 }}"
                                                        {{ $loop->index == date('n') - 1 ? 'selected' : '' }}>
                                                        {{ $bulan }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group d-flex flex-row align-items-center ms-2">
                                            <label class="mb-0 me-2" for="">Tahun</label>
                                            <select class="form-control year-filter" name="tahun">
                                                @for ($tahun = date('Y') - 5; $tahun <= date('Y'); $tahun++)
                                                    <option value="{{ $tahun }}"
                                                        {{ $tahun == date('Y') ? 'selected' : '' }}>
                                                        {{ $tahun }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                        <div class="form-group d-flex flex-row align-items-center ms-2">
                                            <button type="submit" class="btn btn-primary btn-sm">
                                                Tampilkan Data</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="alert alert-info alert-dismissible">
                            @if (request()->has('bulan') && request()->has('tahun'))
                                Menampilkan data kehadiran karyawan bulan
                                {{ \Carbon\Carbon::createFromFormat('m', request()->get('bulan'))->locale('id')->isoFormat('MMMM') }}
                                tahun
                                {{ request()->get('tahun') }}. <a class="badge badge-pill badge-dark"
                                    href="{{ route('absensi.index') }}">Reset</a>
                            @else
                                Menampilkan data kehadiran karyawan bulan semua
                            @endif
                        </div>

                        <div class="table-responsives">
                            <table class="table table-striped table-hover table-full-width" id="main_table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Periode</th>
                                        <th>NIK</th>
                                        <th>Nama</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Jabatan</th>
                                        <th>Hadir</th>
                                        <th>Izin</th>
                                        <th>Alpha</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($absensis as $index => $absensi)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ \Carbon\Carbon::parse($absensi->bulan)->locale('id')->isoFormat('MMMM Y') }}
                                            </td>
                                            <td>{{ $absensi->karyawan->nik }}</td>
                                            <td>{{ $absensi->karyawan->nama_karyawan }}</td>
                                            <td>
                                                @if ($absensi->karyawan->kelamin == 'L')
                                                    Laki-Laki
                                                @else
                                                    Perempuan
                                                @endif
                                            </td>
                                            <td>{{ $absensi->karyawan->jabatan->nama_jabatan }}</td>
                                            <td>{{ $absensi->masuk }}</td>
                                            <td>{{ $absensi->izin }}</td>
                                            <td>{{ $absensi->alpha }}</td>
                                            <td>
                                                <div class="d-flex">
                                                    <a href="#"
                                                        data-url="{{ route('absensi.edit', $absensi->id_absensi) }}"
                                                        class="btn btn-sm btn-warning ajax_modal"><i
                                                            class="fa fa-pencil"></i></a>
                                                    <form data-reload="true" id="main-form-delete"
                                                        action="{{ route('absensi.destroy', $absensi) }}" method="POST"
                                                        class="ms-1 delete-form">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="confirm-text btn btn-sm btn-danger">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{-- {{ $asets->links('vendor.pagination.bootstrap-4') }} --}}
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
@endsection
