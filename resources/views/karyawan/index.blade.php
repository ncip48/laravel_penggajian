@extends('layouts.app')

@section('title', 'Karyawan')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Karyawan</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item ">
                                <a href="#">Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">Master Data</a>
                            </li>
                            <li class="breadcrumb-item active">
                                Data Karyawan
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
                                    <h3 class="card-title mt-1">
                                        Daftar Karyawan
                                    </h3>
                                    <div class="card-tools">
                                        @if (auth()->user()->level == 0)
                                            <a class="btn btn-sm btn-primary mt-1" href="{{ route('karyawan.create') }}"><i
                                                    class="fas fa-plus"></i>
                                                Add Karyawan</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="table-responsives">
                                    <table class="table table-striped table-hover table-full-width" id="main_table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>NIK</th>
                                                <th>Nama</th>
                                                <th>Jenis Kelamin</th>
                                                <th>Jabatan</th>
                                                <th>Tanggal Masuk</th>
                                                <th>Status</th>
                                                @if (auth()->user()->level == 0)
                                                    <th>Action</th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($karyawans as $index => $karyawan)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $karyawan->nik }}</td>
                                                    <td>{{ $karyawan->nama_karyawan }}</td>
                                                    <td>
                                                        @if ($karyawan->kelamin == 'L')
                                                            Laki-Laki
                                                        @else
                                                            Perempuan
                                                        @endif
                                                    </td>
                                                    <td>{{ $karyawan->jabatan->nama_jabatan }}</td>
                                                    <td>
                                                        {{ \Carbon\Carbon::parse($karyawan->tanggal_masuk)->locale('id')->isoFormat('DD MMMM Y') }}
                                                    </td>
                                                    <td>{{ $karyawan->status_perkawinan }}</td>
                                                    @if (auth()->user()->level == 0)
                                                        <td>
                                                            <div class="d-flex">
                                                                <a href="{{ route('karyawan.edit', $karyawan->id_karyawan) }}"
                                                                    class="btn btn-sm btn-warning"><i
                                                                        class="fas fa-edit"></i></a>
                                                                <form data-reload="true" id="main-form"
                                                                    action="{{ route('karyawan.destroy', $karyawan) }}"
                                                                    method="POST" class="ml-1 delete-form">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button class="confirm-text btn btn-sm btn-danger">
                                                                        <i class="fas fa-trash"></i>
                                                                    </button>
                                                                </form>
                                                            </div>
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
