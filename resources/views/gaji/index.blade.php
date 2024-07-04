@extends('layouts.app')

@section('title', 'Gaji')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Gaji</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item ">
                                <a href="#">Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">Transaksi</a>
                            </li>
                            <li class="breadcrumb-item active">
                                Data Gaji
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
                                            Daftar Gaji
                                        </h3>
                                    </div>
                                    <div class="card-tools">
                                        @if (auth()->user()->level == 0)
                                            <a class="btn btn-sm btn-primary mt-1" href="{{ route('gaji.create') }}"><i
                                                    class="fas fa-plus"></i>
                                                Input Gaji</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                Filter data gaji karyawan
                                <div class="d-flex justify-content-between align-items-center mt-2">
                                    <div class="col-12">
                                        {{-- <li><a class="dropdown-item" href="#">Action</a></li> --}}
                                        <form>
                                            <div class="row mb-1">
                                                {{-- @csrf --}}
                                                <div class="form-group d-flex flex-row align-items-center">
                                                    <label class="mb-0 mr-2" for="">Bulan</label>
                                                    <select class="form-control month-filter" name="bulan">
                                                        @foreach (['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'] as $bulan)
                                                            <option value="{{ $loop->index + 1 }}"
                                                                {{ $loop->index == date('n') - 1 ? 'selected' : '' }}>
                                                                {{ $bulan }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group d-flex flex-row align-items-center ml-2">
                                                    <label class="mb-0 mr-2" for="">Tahun</label>
                                                    <select class="form-control year-filter" name="tahun">
                                                        @for ($tahun = date('Y') - 5; $tahun <= date('Y'); $tahun++)
                                                            <option value="{{ $tahun }}"
                                                                {{ $tahun == date('Y') ? 'selected' : '' }}>
                                                                {{ $tahun }}</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                                <div class="form-group d-flex flex-row align-items-center ml-2">
                                                    <button type="submit" class="btn btn-primary">
                                                        Tampilkan Data</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="alert alert-info alert-dismissible">
                                    @if (request()->has('bulan') && request()->has('tahun'))
                                        Menampilkan data gaji karyawan bulan
                                        {{ \Carbon\Carbon::createFromFormat('m', request()->get('bulan'))->locale('id')->isoFormat('MMMM') }}
                                        tahun
                                        {{ request()->get('tahun') }}. <a class="badge badge-pill badge-dark"
                                            href="{{ route('gaji.index') }}">Reset</a>
                                    @else
                                        Menampilkan data gaji karyawan bulan semua
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
                                                <th>Gaji Pokok</th>
                                                <th>Potongan</th>
                                                <th>Total Gaji</th>
                                                <th>Status</th>
                                                @if (auth()->user()->level != 2)
                                                    <th>Action</th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($gajis as $index => $gaji)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($gaji->periode_gaji)->locale('id')->isoFormat('MMMM Y') }}
                                                    </td>
                                                    <td>{{ $gaji->karyawan->nik }}</td>
                                                    <td>{{ $gaji->karyawan->nama_karyawan }}</td>
                                                    <td>
                                                        @if ($gaji->karyawan->kelamin == 'L')
                                                            Laki-Laki
                                                        @else
                                                            Perempuan
                                                        @endif
                                                    </td>
                                                    <td>{{ $gaji->karyawan->jabatan->nama_jabatan }}</td>
                                                    <td>@currency($gaji->gaji_pokok)</td>
                                                    <td>@currency($gaji->potongan_gaji)</td>
                                                    <td>@currency($gaji->total_gaji)</td>
                                                    <td>
                                                        @if ($gaji->status == 0)
                                                            <span class="badge badge-info">Pending</span>
                                                        @elseif ($gaji->status == 1)
                                                            <span class="badge badge-success">Acc</span>
                                                        @else
                                                            <span class="badge badge-danger">Ditolak</span>
                                                        @endif
                                                    </td>
                                                    @if (auth()->user()->level != 2)
                                                        <td>
                                                            @if (auth()->user()->level == 1)
                                                                <div class="d-flex">
                                                                    <a href="{{ route('gaji.show', $gaji->id_gaji) }}"
                                                                        class="btn btn-sm btn-primary"><i
                                                                            class="fas fa-eye"></i></a>
                                                                    @if ($gaji->status == 0)
                                                                        <form data-reload="true" id="main-form"
                                                                            action="{{ route('gaji.approve', $gaji->id_gaji) }}"
                                                                            method="POST" class="ml-1 acc-form">
                                                                            @csrf
                                                                            @method('PUT')
                                                                            <button class="acc-text btn btn-sm btn-success">
                                                                                <i class="fas fa-check"></i>
                                                                            </button>
                                                                        </form>
                                                                        <form data-reload="true" id="main-form"
                                                                            action="{{ route('gaji.decline', $gaji->id_gaji) }}"
                                                                            method="POST" class="ml-1 acc-form">
                                                                            @csrf
                                                                            @method('PUT')
                                                                            <button
                                                                                class="tolak-text btn btn-sm btn-danger">
                                                                                <i class="fas fa-times-circle"></i>
                                                                            </button>
                                                                        </form>
                                                                    @endif
                                                                </div>
                                                            @endif
                                                            @if (auth()->user()->level == 0)
                                                                <div class="d-flex">
                                                                    <a href="{{ route('gaji.edit', $gaji->id_gaji) }}"
                                                                        class="btn btn-sm btn-warning"><i
                                                                            class="fas fa-edit"></i></a>
                                                                    <form data-reload="true" id="main-form"
                                                                        action="{{ route('gaji.destroy', $gaji) }}"
                                                                        method="POST" class="ml-1 delete-form">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button class="confirm-text btn btn-sm btn-danger">
                                                                            <i class="fas fa-trash"></i>
                                                                        </button>
                                                                    </form>
                                                                </div>
                                                            @endif
                                                        </td>
                                                    @endif
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
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
