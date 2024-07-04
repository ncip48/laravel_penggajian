@extends('layouts.app')

@section('title', 'Lembur')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Lembur</h1>
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
                                Data Lembur
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
                                            Daftar Lembur
                                        </h3>
                                    </div>
                                    <div class="card-tools">
                                        <a class="btn btn-sm btn-primary mt-1" href="{{ route('lembur.create') }}"><i
                                                class="fas fa-plus"></i>
                                            Tambah Lembur</a>
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
                                                <th>Tanggal</th>
                                                <th>NIK</th>
                                                <th>Nama</th>
                                                <th>Jam</th>
                                                <th>Keterangan</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($lemburs as $index => $lembur)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($lembur->tanggal)->locale('id')->isoFormat('D MMMM Y') }}
                                                    </td>
                                                    <td>{{ $lembur->karyawan->nik }}</td>
                                                    <td>{{ $lembur->karyawan->nama_karyawan }}</td>
                                                    <td>{{ $lembur->jam }}</td>
                                                    <td>{{ $lembur->keterangan ?? '-' }}</td>
                                                    <td>
                                                        <div class="d-flex">
                                                            <a href="{{ route('lembur.edit', $lembur->id_lembur) }}"
                                                                class="btn btn-sm btn-warning"><i
                                                                    class="fas fa-edit"></i></a>
                                                            <form data-reload="true" id="main-form"
                                                                action="{{ route('lembur.destroy', $lembur) }}"
                                                                method="POST" class="ml-1 delete-form">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="confirm-text btn btn-sm btn-danger">
                                                                    <i class="fas fa-trash"></i>
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
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
